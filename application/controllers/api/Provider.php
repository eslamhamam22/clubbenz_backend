<?php require APPPATH . '/libraries/REST_Controller.php';
class Provider extends REST_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('upload');
		$this->load->library(['ion_auth', 'form_validation']);
		$this->load->database();
		$this->load->model('Provider_Model');
		$this->load->model('Shipping_model');
		$this->load->model('World_model');
		$this->load->model('Workshop_model');
		$this->load->model('Provider_plan_model');
		$this->load->model('Plan_model');
	}

	function providers_get() {
		$arr = array();
		$this->response($arr, 200);
	}

	function get_provider_by_id_get() {
		$provider_id = $this->get('provider_id');
		$provider = $this->Provider_Model->get_provider_by_id($provider_id);
		$provider[0]->reviews = $this->Workshop_model->get_reviews($provider_id, "provider");
		foreach ($provider[0]->reviews as $r) {
			$user = $this->Workshop_model->get_user_picture($r->user_id);
			$r->user_picture = $user->profile_picture;
			$r->user_name = $user->username;
		}
		$provider[0]->avg_rating = $this->Workshop_model->average_rating($provider_id, "provider");
		$provider[0]->country = $this->World_model->get_country_by_id($provider[0]->country);
		$provider[0]->governorate = $this->World_model->get_state_by_id($provider[0]->governorate);
		$this->response($provider[0], 200);
	}
}
