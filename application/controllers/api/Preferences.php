<?php
require APPPATH . '/libraries/REST_Controller.php';
class Preferences extends REST_Controller {
	public $data;
	function __construct() {
		parent::__construct();
		$this->load->model('Users_model', 'users_model');
		$this->load->model('Cars_model');
		$this->load->model('Years_model');
		$this->load->model('Fuel_model');
		$this->load->library('upload');
		$this->load->model('Car_guide_model', 'car_guide');
		$this->load->model('Classes_model');
		$this->load->model('Workshop_model');
		$this->load->model('Service_model');
		$this->load->model('Serviceshop_model');
		$this->load->model('Classes_model');
		$this->load->model('Advertisement_model');
		$this->load->model('Part_model');
		$this->load->model('Partsshop_model');
		$this->load->model('Service_tag_model');
		$this->load->model('Catalog_model', 'cat');
		$this->load->model('Push_notification_model', 'notification');
		define('FIREBASE_API_KEY', 'AAAAIDGWJ6Y:APA91bFyMeIkXy_kSS6R_l5VfCox6UqjMiv5uU8CVnzlmavattG1_hZFAv3m_HHbPGMgeSslcy8d_rcZIMZIXsXPjf3ItXM6An2i2Ljvw8bKXvsDHogx1FZO388tJ6qJBmxkINXvFjRJ');
	}

	function get_preferences_post() {
		$arr['years'] = $this->Years_model->year_manage();
		$arr['fuel_types'] = $this->Fuel_model->fuel_manage();
		$arr['models'] = $this->Classes_model->model_manage();
		$arr['home_page_services'] = $this->Service_model->get_home_page_service_api();
		$arr['profile_pictures'] = $this->Users_model->get_profile_pictures();
		$arr['home_ads'] = $this->Advertisement_model->manage_advertisement();

		$arr['home_slide'] = $this->Advertisement_model->manage_advertisement_home("active");
		$arr['timeDisplay'] = $this->Advertisement_model->manage_advertisement_timeDisplay("active");
		$arr['banner'] = $this->Advertisement_model->manage_advertisement_banner("active");
		$arr['workshop'] = $this->Advertisement_model->manage_workshop_banner_active("active");
		$arr['partshops'] = $this->Advertisement_model->manage_partshops_banner_active("active");
		$arr['services'] = $this->Advertisement_model->manage_services_banner_active("active");
		$arr['partcatlog'] = $this->Advertisement_model->manage_partcatlog_banner_active("active");
		$arr['activate_part_catalogue'] = true;
		$part_catalogue = $this->cat->catalog_manage();

		if ($part_catalogue) {
			$arr['activate_part_catalogue'] = $part_catalogue[0]->status == 0 ? false : true;
		}

		$this->response($arr, 200);
	}
	function search_result_get() {
		$start = $this->get("start");
		$limit = 10;
		$search = $this->get('search');
		$search_arr['search'] = $search;
		$search_arr['shop_open'] = '';
		$search_arr['service_id'] = '';
		$lat = $this->get("lat");
		$lon = $this->get("lon");

		$arr_serviceshop = $this->Serviceshop_model->get_shop($search_arr, $start, $limit) ? $this->Serviceshop_model->get_shop($search_arr, $start, $limit) : [];
		$arr_workshops = $this->Workshop_model->get_workshop_search($search_arr, $start, $limit) ? $this->Workshop_model->get_workshop_search($search_arr, $start, $limit) : [];
		$arr_partshops = $this->Partsshop_model->get_partshop($search_arr, $start, $limit) ? $this->Partsshop_model->get_partshop($search_arr, $start, $limit) : [];
		$new_arr_serviceshop = array();
		$new_arr_workshops = array();
		$new_arr_partshops = array();

		foreach ($arr_serviceshop as $val) {
			$val->distance = $this->Service_tag_model->distance($val->location_latitude, $val->location_longitude, $lat, $lon, "K");
			$new_arr_serviceshop[] = $val;
		}

		foreach ($arr_workshops as $val) {
			$val->distance = $this->Service_tag_model->distance($val->location_lat, $val->location_lon, $lat, $lon, "K");
			$new_arr_workshops[] = $val;
		}

		foreach ($arr_partshops as $val) {
			$val->distance = $this->Service_tag_model->distance($val->location_latitude, $val->location_longitude, $lat, $lon, "K");
			$new_arr_partshops[] = $val;
		}
		$arr = array_merge($new_arr_serviceshop, $new_arr_workshops, $new_arr_partshops);

		if ($arr_serviceshop == 0 && $arr_workshops == 0 && $arr_partshops == 0) {
			$arr['message'] = "No Record found";
			$this->response($arr['message'], 200);
		} else {

			if ($lat != 0 && $lon != 0) {
				usort($arr, function ($a, $b) {
					return strcmp($a->distance, $b->distance);
				});
			}
			$this->response($arr, 200);
		}
	}

	function nearest_shop_get() {

		$start = $this->get("start");
		$limit = 10;
		$search = $this->get('search');
		$search_arr['search'] = $search;
		$search_arr['shop_open'] = '';
		$search_arr['service_id'] = '';
		$lat = $this->get("lat");
		$lon = $this->get("lon");
		$user_id = $this->get("user_id");
		$language = $this->get("language");

		$arr_serviceshop = $this->Serviceshop_model->get_shop($search_arr, $start, $limit) ? $this->Serviceshop_model->get_shop($search_arr, $start, $limit) : [];
		$arr_workshops = $this->Workshop_model->get_workshop_search($search_arr, $start, $limit) ? $this->Workshop_model->get_workshop_search($search_arr, $start, $limit) : [];
		$arr_partshops = $this->Partsshop_model->get_partshop($search_arr, $start, $limit) ? $this->Partsshop_model->get_partshop($search_arr, $start, $limit) : [];
		$new_arr_serviceshop = array();
		$new_arr_workshops = array();
		$new_arr_partshops = array();

		foreach ($arr_serviceshop as $val) {
			if ($this->Service_tag_model->distance($val->location_latitude, $val->location_longitude, $lat, $lon, "K") < 0.3) {

				$val->distance = $this->Service_tag_model->distance($val->location_latitude, $val->location_longitude, $lat, $lon, "K");
				$new_arr_serviceshop[] = $val;
			}
		}

		foreach ($arr_workshops as $val) {
			if ($this->Service_tag_model->distance($val->location_lat, $val->location_lon, $lat, $lon, "K") < 0.3) {
				$val->distance = $this->Service_tag_model->distance($val->location_lat, $val->location_lon, $lat, $lon, "K");
				$new_arr_workshops[] = $val;
			}
		}

		foreach ($arr_partshops as $val) {
			if ($this->Service_tag_model->distance($val->location_latitude, $val->location_longitude, $lat, $lon, "K") < 0.3) {
				$val->distance = $this->Service_tag_model->distance($val->location_latitude, $val->location_longitude, $lat, $lon, "K");
				$new_arr_partshops[] = $val;
			}
		}

		$arr = array_merge($new_arr_serviceshop, $new_arr_workshops, $new_arr_partshops);
		if ($arr_serviceshop == 0 && $arr_workshops == 0 && $arr_partshops == 0) {
			$arr['message'] = "No Record found";
			$this->response($arr['message'], 200);
		} else {
			if ($arr) {

				if ($lat != 0 && $lon != 0) {
					usort($arr, function ($a, $b) {
						return strcmp($a->distance, $b->distance);
					});
				}

				// $this->response($arr[0], 200);

				if ($arr[0]) {
					$user = $this->Users_model->get_user_by_id($user_id);
					if ($user->fcm_token) {
						$arr[0]->fcm_token = $user->fcm_token;
					}

					$arr[0]->language = $language;
					$this->send_push_notification($arr[0]);
				}

			} else {
				$arr['message'] = "No Record found";
				$this->response($arr, 200);
			}

		}
	}

	public function send_push_notification($user_data) {
		if ($user_data) {
			$this->load->library('firebase');
			$posted_data = $this->input->post();
			//$shop_name = $this->review->get_shop_name($posted_data['shop_id'], $posted_data['type_name']);

			$payload = array();
			$payload['body'] = $user_data->language == 'ar' ? "أنت قريب من " . $user_data->arabic_name . "هل تريد تقييمه ؟ " : "You are near to " . $user_data->name . " Do you want to rate it?";
			$payload['title'] = $user_data->language == 'ar' ? "Clubenz Ar" : "Clubenz";
			$payload['message'] = $user_data->language == 'ar' ? "أنت قريب من " . $user_data->arabic_name . "هل تريد تقييمه ؟ " : "You are near to " . $user_data->name . " Do you want to rate it?";
			$payload['shop_id'] = $user_data->id;
			$payload['shop_type'] = $user_data->shop_type;
			$payload['badge'] = 1;
			$payload['priority'] = "high";
			$payload['icon'] = "ic_stat";
			$payload['show_in_foreground'] = true;

			// $payload['data']['body'] 	= $data->language == 'en' ? "You are near to ".$data->name." Do you want to rate it?" : "أنت قريب من ".$data->arabic_name."هل تريد تقييمه ؟ ";
			// $payload['data']['title'] 	= $data->language == 'en' ? "Clubenz" : "Clubenz Ar";
			// $payload['data']['message'] = $data->language == 'en' ? "You are near to ".$data->name." Do you want to rate it?" : "أنت قريب من ".$data->arabic_name."هل تريد تقييمه ؟ ";
			// $payload['data']['shop_id'] = $data->id;
			// $payload['data']['shop_type'] = $data->shop_type;
			// $payload['data']['badge'] = 1;

			$data['body'] = $user_data->language == 'ar' ? "أنت قريب من " . $user_data->arabic_name . "هل تريد تقييمه ؟ " : "You are near to " . $user_data->name . " Do you want to rate it?";
			$data['title'] = $user_data->language == 'ar' ? "Clubenz Ar" : "Clubenz";
			$data['message'] = $user_data->language == 'ar' ? "أنت قريب من " . $user_data->arabic_name . "هل تريد تقييمه ؟ " : "You are near to " . $user_data->name . " Do you want to rate it?";
			$data['shop_id'] = $user_data->id;
			$data['shop_type'] = $user_data->shop_type;
			$data['icon'] = "ic_stat";
			$data['badge'] = 1;
			$data['priority'] = "high";
			$data['show_in_foreground'] = true;

			if (!empty($payload)) {
				$response = $this->firebase->send($user_data->fcm_token, $payload, $data);
				$response = $this->firebase->sendGoogleCloudMessage($payload, $user_data->fcm_token);
			}
		}
	}
	public function send_data_notification_get() {
		$this->load->library('firebase');
		$payload = array();
		$NotifData = array();
		$NotifData['class_id'] = "";
		$NotifData['year_id'] = "";
		$NotifData['fuel_id'] = "";
		$NotifData['chassis'] = "";
		$NotifData['car_vin_prefix'] = "";

		// notif

		$payload['priority'] = "high";
		$payload['content_available'] = true;
		$payload['data']['body'] = "My DAta";
		$payload['data']['title'] = "Test Clubenz";
		$payload['data']['priority'] = "high";
		$payload['data']['sound'] = "default";
		$payload['data']['icon'] = "ic_stat";
		$result = $this->notification->get_all_users($NotifData);

		$data['body'] = "My DAta";
		$data['title'] = "Clubenz";
		$data['message'] = "You are near to ";
		$data['icon'] = "ic_stat";
		$data['badge'] = 1;
		$data['priority'] = "high";
		$data['show_in_foreground'] = true;
		$this->notification->countnotification();

		if (!empty($result)) {
			foreach ($result as $value) {
				echo $value->fcm_token;
				if ($value->fcm_token != "") {
					$response = '';
					$response = $this->firebase->send($value->fcm_token, $payload, $data);
					$response = $this->firebase->sendGoogleCloudMessage($payload, $value->fcm_token);
				}
			}

		}
	}

	function get_home_page_seveices_get() {

		$arr['home_page_services'] = $this->Service_model->get_home_page_service_api();

		if ($arr) {
			$this->response($arr, 200);
		} else {
			$this->response("Home page Services Not Available", 200);

		}

	}

	function services_post() {
		$arr['services'] = $this->Service_model->service_manage();
		$this->response($arr, 200);
	}
	function get_car_by_vin_prefix_post() {
		$vin_prefix = $this->post('vin_prefix');
		$arr = $this->cars_model->get_car_by_vin_prefix($vin_prefix);

		if ($arr) {
			$end_year = $this->cars_model->get_year_by_yearEnd($arr->model_year_end);
			if ($end_year) {
				$arr->year_id = $end_year->id;

				$arr->fuel_type = $this->Fuel_model->get_fuel_name_by__id($arr->fuel_type);
				$arr->model_id = $this->Classes_model->get_model_name_by_id($arr->model_id);

				$response['success'] = true;
				$response['data'] = $arr;

			} else {
				$start_year = $this->cars_model->get_year_by_yearStart($arr->model_year_start);
				if ($start_year) {
					$arr->year_id = $start_year->id;

					$arr->fuel_type = $this->Fuel_model->get_fuel_name_by__id($arr->fuel_type);
					$arr->model_id = $this->Classes_model->get_model_name_by_id($arr->model_id);

					$response['success'] = true;
					$response['data'] = $arr;

				} else {
					$response['success'] = false;
					$response['message'] = "No Record found for Model year Range";

				}
			}
		} else {

			$response['success'] = false;
			$response['message'] = "No Record found";

		}
		$this->response($response, 200);
	}

	function get_cars_information_post() {
		if ($this->post()) {
			$model_id = $this->post('model_id');
			$fuel_type = $this->post('fuel_type');
			$year = $this->post('year');
			$arr['cars_information'] = $this->cars_model->get_cars_information($model_id, $fuel_type, $year);
			$new_array = array();

			foreach ($arr['cars_information'] as $val) {

				$val->fuel_type = $this->Fuel_model->get_fuel_name_by__id($val->fuel_type);
				$val->model_id = $this->Classes_model->get_model_name_by_id($val->model_id);
				$new_array[] = $val;
			}
			$this->response($arr, 200);
		}
	}

	function submit_review_post() {

		if ($this->post()) {
			$rules = array(
				array(
					'field' => 'rate',
					'label' => 'Rate',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'shop_id',
					'label' => 'Shop Id',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'detail',
					'label' => 'Detail',
					'rules' => 'trim',
				),
			);

			$this->form_validation->set_error_delimiters('', '');
			$this->form_validation->set_rules($rules);
			$this->form_validation->set_data($this->post());
			if ($this->form_validation->run()) {
				$picture_name = "";
				if (isset($_FILES['picture']) && !empty($_FILES['picture'])) {
					$filename = $_FILES['picture']['name'];
					if ($filename != "") {
						$config['upload_path'] = './upload/';
						$config['file_name'] = time() . $filename;
						$config['allowed_types'] = 'gif|jpg|png|jpeg|JPG|PNG';
						$this->upload->initialize($config);
						if (!$this->upload->do_upload('picture')) {
							$arr['error_picture'] = $this->upload->display_errors();
						} else {
							$data = $this->upload->data();
							$picture_name = $data['file_name'];
						}
					}
				}
				$user_row = $this->Users_model->get_user_by_token($this->post("token"));

				date_default_timezone_set('Egypt');

				$arr = array(
					"user_id" => $user_row->id,
					"shop_id" => $this->post("shop_id"),
					"rate" => $this->post("rate"),
					"service" => $this->post("service") || 0,
					"value" => $this->post("value") || 0,
					"cleanliness" => $this->post("cleanliness") || 0,
					"competency" => $this->post("competency") || 0,
					"detail" => $this->post("detail"),
					"type" => $this->post("shop_type"),
					"status" => "pending",
					"date_created" => date("Y-m-d H:i"),
					"picture" => $picture_name,
				);
				//print_r($arr);
				$result = $this->Workshop_model->save_review($arr);

				$arr['success'] = true;
				$arr['message'] = "Review Saved successfully";

			} else {
				$arr['success'] = false;
				$arr['message'] = validation_errors();
			}
		} else {
			$arr['success'] = false;
			$arr['message'] = "All fields are requried";

		}
		$this->response($arr, 200);
	}
	public function get_advertisement_post() {
		if ($this->input->post()) {
			$type = $this->input->post('type');
			$arr['type'] = $this->Advertisement_model->get_advertisement($type);
			$this->response($arr, 200);
		}
	}
	public function brands_post() {
		$arr['parts_brand'] = $this->Part_model->part_brand();
		$this->response($arr, 200);

	}

}
