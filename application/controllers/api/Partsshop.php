<?php
require APPPATH . '/libraries/REST_Controller.php';
class Partsshop extends REST_Controller {
	public $data;
	function __construct() {
		parent::__construct();
		ini_set("display_errors", 1);
		error_reporting(1);
		$this->load->model('Users_model');
		$this->load->model('Emailtemplates_model');
		$this->load->model('Serviceshop_model');
		$this->load->model('Workshop_model');
		$this->load->model('Partsshop_model');
		$this->load->model('Cars_model');
		$this->load->model('Brand_model');
		$this->load->model('Service_model');
		$this->load->model('Service_tag_model');
		$this->load->library('upload');
		$this->load->database();
	}

	function shops_get() {
		$start = $this->get("start");
		$limit = 0;
		$lat = $this->get("lat");
		$lon = $this->get("lon");
		$search = $this->get('search');
		$service_id = $this->get('service_id');
		$search_arr['service_id'] = $service_id;
		$search_arr['search'] = $search;
		$search_arr['shop_open'] = '';
		$search_arr['sort'] = false;
		$search_arr['sort_type'] = "ASC";
		if ($this->get('shop_open') != '') {
			$search_arr['shop_open'] = true;
		}
//		if($this->get('sort') && $this->get('sort')!='' && $this->get('sort')!='none'){
		//			$search_arr['sort']= $this->get('sort');
		//		}
		//		if($this->get('sort_type')){
		//			$search_arr['sort_type']= $this->get('sort_type');
		//		}
		// $arr['total'] = $this->Partsshop_model->count_shop($search_arr,$start,$limit);
		//disable pagination so that we need to send 0 count
		$arr['total'] = 0;
		$arr['shops'] = $this->Partsshop_model->get_shop($search_arr, $start, $limit);

		$new_array = array();

		foreach ($arr['shops'] as $val) {
			$val->brand = $this->Brand_model->get_bands_by_ids($val->brand);
			$val->service_tag = $this->Service_tag_model->get_service_tag_by_ids($val->service_tag);
			$val->services = $this->Service_model->get_services_names_by_ids($val->services);
			$val->distance = $this->Service_tag_model->distance($val->location_latitude, $val->location_longitude, $lat, $lon, "K");
			$val->avg_rating = $this->Workshop_model->average_rating($val->id, "partsshop");
			$new_array[] = $val;

		}

		if ($arr['shops']) {
			if ($this->get('sort') && $this->get('sort') == 'distance') {
				if ($this->get('sort_type') && $this->get('sort_type') == "ASC") {
					usort($arr['shops'], function ($a, $b) {
						if ($a->distance == $b->distance) {
							return $a->avg_rating < $b->avg_rating;
						} else {
							return $a->distance > $b->distance;
						}
					});
				} else {
					usort($arr['shops'], function ($a, $b) {
						if ($a->distance == $b->distance) {
							return $a->avg_rating < $b->avg_rating;
						} else {
							return $a->distance < $b->distance;
						}
					});
				}
			} elseif ($this->get('sort') && $this->get('sort') == 'avg_rating') {
				if ($this->get('sort_type') && $this->get('sort_type') == "ASC") {
					usort($arr['shops'], function ($a, $b) {
						if ($a->avg_rating == $b->avg_rating) {
							return $a->distance > $b->distance;
						} else {
							return $a->avg_rating > $b->avg_rating;
						}
					});
				} else {
					usort($arr['shops'], function ($a, $b) {
						if ($a->avg_rating == $b->avg_rating) {
							return $a->distance > $b->distance;
						} else {
							return $a->avg_rating < $b->avg_rating;
						}
					});
				}
			} else {
				usort($arr['shops'], function ($a, $b) {
					if ($a->distance == $b->distance) {
						return $a->avg_rating > $b->avg_rating;
					} else {
						return $a->distance > $b->distance;
					}
				});
			}
		}

		$arr['shops'] = array_slice($arr['shops'], $start, 10);
		$this->response($arr, 200);
	}
	function shop_detail_get() {
		$id = $this->get("id");

		$arr['shop_detail'] = $this->Partsshop_model->get_details($id);
		$service_ids = $arr['shop_detail']->service_tag;
		$arr['shop_detail']->services = $this->Workshop_model->get_services($arr['shop_detail']->services);
		$arr['shop_detail']->service_tag = $this->Service_tag_model->get_service_tag_by_ids($service_ids);
		$arr['shop_detail']->brand = $this->Brand_model->get_bands_by_ids($arr['shop_detail']->brand);
		$arr['reviews'] = $this->Workshop_model->get_reviews($id, "partsshop");
		$arr['avg_rating'] = $this->Workshop_model->average_rating($id, "partsshop");
		foreach ($arr['reviews'] as $r) {
			$user = $this->Workshop_model->get_user_picture($r->user_id);
			$r->user_picture = $user->profile_picture;
			$r->user_name = $user->username;
		}
		$arr['offers'] = $this->Workshop_model->get_offers($id, "partsshop");
		if ($arr != "") {
			$response['success'] = true;
			$response['data'] = $arr;
		} else {
			$response['success'] = false;
			$response['message'] = "No Record found";
		}
		$this->response($response, 200);
	}

}
