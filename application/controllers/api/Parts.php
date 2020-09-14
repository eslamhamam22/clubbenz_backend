<?php
require APPPATH . '/libraries/REST_Controller.php';
class Parts extends REST_Controller {
	public $data;
	function __construct() {
		parent::__construct();
		ini_set("display_errors", 1);
		error_reporting(1);
		$this->load->model('Users_model', 'users_model');
		$this->load->model('Emailtemplates_model');
		$this->load->model('Serviceshop_model');
		$this->load->model('Workshop_model');
		$this->load->model('Part_model', 'part_model');
		$this->load->model('Brand_model');
		$this->load->model('Partcategory_model');
		$this->load->model('Partsubcategory_model');
		$this->load->model('Provider_plan_model');
		$this->load->library('upload');
		$this->load->database();
		ini_set('display_errors', 1);
	}

	function parts_get() {
		$chassis = $this->get('chassis');
		$start = $this->get("start");
		$limit = 10;
		$search = $this->get('search');
		$type = $this->get('type');
		$sub_category = $this->get('sub_category');
		$search_arr['brand_id'] = $this->get('brand_id');
		$search_arr['sub_category'] = $sub_category;
		$search_arr['search'] = $search;
		$phone = $this->get('phone');

		$search_arr['type'] = $type;
		$arr['total'] = $this->part_model->count_shop($search_arr, $start, $limit, $chassis);
		$arr['shops'] = $this->part_model->get_shop($search_arr, $start, $limit, $chassis, $phone);

		$new_array = array();
		foreach ($arr['shops'] as $val) {
			if ($val->featured == "0") {
				$val->featured = false;
			}

			$val->main_image = $this->part_model->get_part_main_image($val->id, 'main');
			$val->part_brand = $this->Brand_model->get_bands_by_ids($val->part_brand);
			$val->part_category = $this->Partcategory_model->get_category_by_id($val->part_category);
			$val->part_sub_category = $this->Partsubcategory_model->get_subcategory_by_id($val->part_sub_category);
//			$val->plan = $this->Provider_plan_model->get_current_plan_with_details_by_provider($val->provider_id);
			$new_array[] = $val;
		}
		$country = null;
//		$arr['shops']= array_filter($arr['shops'], function ($part) use ($phone) {
		//			if(!$part->plan || $part->plan->status != "active")
		//				return false;
		//			if($part->available_location == "National" && $phone){
		//				$phonecode= "+".$part->phonecode;
		//				if(strpos($phone, $phonecode) !== false){
		//					return true;
		//				}else{
		//					return false;
		//				}
		//			}
		//			return true;
		//		});
		//		$arr['shops'] = array_slice($arr['shops'], $start, $limit);
		$this->response($arr, 200);
	}

	function part_detail_get() {
		$id = $this->get("id");
		$arr['shop_detail'] = $this->part_model->get_details($id);
		$arr['reviews'] = $this->Workshop_model->get_reviews($id, "parts");
		foreach ($arr['reviews'] as $r) {
			$user = $this->Workshop_model->get_user_picture($r->user_id);
			$r->user_picture = $user->profile_picture;
			$r->user_name = $user->username;
		}
		$arr['offers'] = $this->Workshop_model->get_offers($id, "workshop");
		$arr['shop_detail']->part_brand = $this->Brand_model->get_bands_by_ids($arr['shop_detail']->part_brand);
		$part_category = $arr['shop_detail']->part_category;
		$arr['shop_detail']->part_category = $this->Partcategory_model->get_category_by_id($arr['shop_detail']->part_category);
		$arr['similer_parts'] = $this->part_model->same_part($part_category, $id);
		$arr['parts_brand'] = $this->part_model->part_brand();
		$arr['images'] = $this->part_model->get_part_main_image($id, 'all');

		$views = $arr['shop_detail']->views;
		$data = array(
			'views' => $views + 1,
		);
		$this->part_model->views_update($id, $data);
		$arr['shop_detail']->part_sub_category = $this->Partsubcategory_model->get_subcategory_by_id($arr['shop_detail']->part_sub_category);
		$this->response($arr, 200);
	}

	function get_partcategory_post() {
		$chassis = $this->post('chassis');
		$data = $this->part_model->get_all_parts();
		$arr['part_categories'] = $data;
		$part_cat_ids = array(0);
		foreach ($data as $row) {
			$part_cat_ids[] = $row->id;
		}
		$arr['top_products'] = $this->part_model->get_parts_by_categories_id($chassis);
		$new_array = array();
		foreach ($arr['top_products'] as $val) {
			$val->plan = $this->Provider_plan_model->get_current_plan_with_details_by_provider($val->provider_id);
			$val->main_image = $this->part_model->get_part_main_image($val->id, 'main');
			$new_array[] = $val;
		}
		$arr['top_products'] = array_filter($arr['top_products'], function ($part) use ($chassis) {
			$chassis_ids = explode(",", $part->chassis_id);
			if (!in_array($chassis, $chassis_ids)) {
				return false;
			}
			if ($part->date_expire && !empty($part->date_expire) && strtotime(date("Y-m-d")) > strtotime($part->date_expire)) {
				return false;
			}

			if (!$part->plan || $part->plan->status != "active") {
				return false;
			}

			return true;
		});
		$arr['top_products'] = array_values($arr['top_products']);
		$arr['success'] = true;
		$arr['data'] = $data;
		$this->response($arr, 200);
	}

	function get_partsubcategory_post() {
		$id = $this->post('id');
		$phone = $this->post('phone');
		$chassis_id = $this->post('chassis_id');
		$data = $this->Partsubcategory_model->get_subcategory_with_parts($id, $chassis_id, $phone);
		$arr['success'] = true;
		$arr['data'] = $data;
		$arr['id'] = $id;
		$arr['chassis_id'] = $chassis_id;
		$this->response($arr, 200);
	}

}
