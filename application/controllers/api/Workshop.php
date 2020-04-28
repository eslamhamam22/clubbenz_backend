<?php
require APPPATH . '/libraries/REST_Controller.php';
class Workshop extends REST_Controller {
	public $data;
	function __construct() {
		parent::__construct();
		ini_set("display_errors", 1);
		error_reporting(1);
		$this->load->model('users_model');
		$this->load->model('Emailtemplates_model');
		$this->load->model('Workshop_model');
		$this->load->model('Cars_model');
		$this->load->model('Service_tag_model');
		$this->load->library('upload');
		$this->load->model('Booking_model');
		$this->load->database();
	}

	function workshops_get() {

		$start = $this->get("start");
		$lat = $this->get("lat");
		$lon = $this->get("lon");
		$limit = 0;
		$search = $this->get('search');
		$search_arr['search'] = $search;
		$search_arr['shop_open'] = '';
		if ($this->get('shop_open') != '') {
			$search_arr['shop_open'] = true;
		}

		// $arr['total'] = $this->Workshop_model->count_workshop($search_arr,$start,$limit);
		//disable pagination so that we need to send 0 count
		$arr['total'] = 0;
		$workShops = $this->Workshop_model->get_workshops($search_arr, $start, $limit);
		if ($workShops === 0) {
			$arr['workshops'] = [];
		} else {
			$arr['workshops'] = $workShops;
		}

		$new_array = array();
		foreach ($arr['workshops'] as $val) {

			$val->service_tag = $this->Service_tag_model->get_service_tag_by_ids($val->service_tag);
			$val->distance = $this->Service_tag_model->distance($val->location_lat, $val->location_lon, $lat, $lon, "K");
			$val->avg_rating = $this->Workshop_model->average_rating($val->id, "workshop");
			$new_array[] = $val;

		}

		if ($arr['workshops']) {
			if ($this->get('sort') && $this->get('sort') == 'distance') {
				if ($this->get('sort_type') && $this->get('sort_type') == "ASC") {
					usort($arr['workshops'], function ($a, $b) {
						if ($a->distance == $b->distance) {
							return $a->avg_rating < $b->avg_rating;
						} else {
							return $a->distance > $b->distance;
						}
					});
				} else {
					usort($arr['workshops'], function ($a, $b) {
						if ($a->distance == $b->distance) {
							return $a->avg_rating < $b->avg_rating;
						} else {
							return $a->distance < $b->distance;
						}
					});
				}
			} elseif ($this->get('sort') && $this->get('sort') == 'avg_rating') {
				if ($this->get('sort_type') && $this->get('sort_type') == "ASC") {
					usort($arr['workshops'], function ($a, $b) {
						if ($a->avg_rating == $b->avg_rating) {
							return $a->distance > $b->distance;
						} else {
							return $a->avg_rating > $b->avg_rating;
						}
					});
				} else {
					usort($arr['workshops'], function ($a, $b) {
						if ($a->avg_rating == $b->avg_rating) {
							return $a->distance > $b->distance;
						} else {
							return $a->avg_rating < $b->avg_rating;
						}
					});
				}
			} else {
				usort($arr['workshops'], function ($a, $b) {
					if ($a->distance == $b->distance) {
						return $a->avg_rating > $b->avg_rating;
					} else {
						return $a->distance > $b->distance;
					}
				});
			}
		}

		$arr['workshops'] = array_slice($arr['workshops'], $start, 10);
		$this->response($arr, 200);

	}

	function workshop_detail_get() {
		$id = $this->get("id");
		$arr['shop_detail'] = $this->Workshop_model->get_workshops_detail($id);
		/*$service_ids = explode(',',$arr['shop_detail']->service_tag);
		$arr['services'] = $this->Workshop_model->get_services($service_ids);*/
		$arr['reviews'] = $this->Workshop_model->get_reviews($id, "workshop");
		foreach ($arr['reviews'] as $r) {
			$user = $this->Workshop_model->get_user_picture($r->user_id);
			$r->user_picture = $user->profile_picture;
			$r->user_name = $user->username;
		}
		$arr['offers'] = $this->Workshop_model->get_offers($id, "workshop");
		$arr['avg_rating'] = $this->Workshop_model->average_rating($id, "workshop");

		$arr['shop_detail']->service_tag = $this->Service_tag_model->get_service_tag_by_ids($arr['shop_detail']->service_tag);

		$this->response($arr, 200);

	}

	function bookings_get() {
		$id = $this->get('user_id');

		$arr['bookings'] = $this->Booking_model->get_user_booking($id);
		foreach ($arr['bookings'] as $val) {
			$val->workshop_details = $this->Workshop_model->get_workshops_detail($val->workshop_id);
		}
		$this->response($arr, 200);
	}
}
