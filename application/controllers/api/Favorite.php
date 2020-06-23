<?php
require APPPATH . '/libraries/REST_Controller.php';
class Favorite extends REST_Controller {
	public $data;
	function __construct() {
		parent::__construct();
		ini_set("display_errors", 1);
		error_reporting(1);
		$this->load->model('users_model');
		$this->load->model('Part_model');
		$this->load->model('Brand_model');
		$this->load->model('Partcategory_model');
		$this->load->model('Partsubcategory_model');
		$this->load->model('Provider_plan_model');
		$this->load->model('Favorite_model');
		$this->load->library('upload');
		$this->load->database();
		ini_set('display_errors', 1);
	}

	function get_favorites_by_user_id_get(){
		$user_id = $this->get('user_id');
		$favorites= $this->Favorite_model->get_favorites_by_user_id($user_id);
		foreach ($favorites as $favorite){
			$favorite->part= $this->Part_model->get_details($favorite->part_id);
			$favorite->part->plan = $this->Provider_plan_model->get_current_plan_with_details_by_provider($favorite->part->provider_id);
			$favorite->part->main_image = $this->Part_model->get_part_main_image($favorite->part->id, 'main');
			$favorite->part->part_brand = $this->Brand_model->get_bands_by_ids($favorite->part->part_brand);
			$favorite->part->part_category = $this->Partcategory_model->get_category_by_id($favorite->part->part_category);
			$favorite->part->part_sub_category = $this->Partsubcategory_model->get_subcategory_by_id($favorite->part->part_sub_category);
		}
		$favorites = array_filter($favorites, function ($favorite) {
			$part= $favorite->part;
			if ($part->date_expire && !empty($part->date_expire) && strtotime(date("Y-m-d")) > strtotime($part->date_expire)) {
				return false;
			}

			if (!$part->plan || $part->plan->status != "active") {
				return false;
			}

			return true;
		});
		$this->response($favorites, 200);
	}
	function add_favorite_post(){
		$user_id = $this->post('user_id');
		$part_id = $this->post('part_id');
		$favorites= $this->Favorite_model->add_favorite($user_id, $part_id);

		$this->response($favorites, 200);
	}
	function remove_favorite_post(){
		$user_id = $this->post('user_id');
		$part_id = $this->post('part_id');
		$favorites= $this->Favorite_model->remove_favorite($user_id, $part_id);
		$this->response($favorites, 200);
	}
	function is_favorite_post(){
		$user_id = $this->post('user_id');
		$part_id = $this->post('part_id');
		$favorites= $this->Favorite_model->is_favorite($user_id, $part_id);
		$this->response($favorites, 200);
	}
}
