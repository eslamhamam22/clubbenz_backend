<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Class Auth
 * @property Ion_auth|Ion_auth_model $ion_auth        The ION Auth spark
 * @property CI_Form_validation      $form_validation The form validation library
 */
class Plan extends CI_Controller {
	public $data = [];

	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->helper(['url', 'language']);
		$this->load->model('Provider_Model');
		$this->load->model('Provider_plan_model');
		$this->load->model('Plan_model');
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
		$this->load->library('session');
		$this->lang->load('auth');
		if(!$this->session->userdata("id"))
			redirect('/provider');

		$this->load->helper('language');
		$this->lang->load('provider/left_nav',$this->session->userdata('site_lang') == "arabic"? "arabic" : "english");
		$this->lang->load('provider/plan',$this->session->userdata('site_lang') == "arabic"? "arabic" : "english");
	}

	/**
	 * Redirect if needed, otherwise display the user list
	 */

	public function index() {
		$provider_id= $this->session->userdata("id");
		$plans= $this->Plan_model->plan_manage();
		$current_plan= $this->Provider_plan_model->get_current_plan_with_details_by_provider($provider_id);
		$this->load->view('provider/plan', ["plans"=> $plans, "current_plan" => $current_plan]);
	}
	public function history() {
		$provider_id= $this->session->userdata("id");
		$provider_plans= $this->get_current_provider_history($provider_id);
		$current_plan= $this->Provider_plan_model->get_current_plan_with_details_by_provider($provider_id);
		$this->load->view('provider/plan_history', ["plans"=> $provider_plans, "current_plan" => $current_plan]);
	}
	public function subscribe_form($plan_id) {
		$provider_id= $this->session->userdata("id");
		$plan= $this->Plan_model->get_plan_by_id($plan_id);
		$current_plan= $this->Provider_plan_model->get_current_plan_with_details_by_provider($provider_id);
		$this->load->view('provider/subscribe_form', ["plan"=> $plan[0], "current_plan" => $current_plan]);
	}

	public function subscribe($id){
		$provider_id= $this->session->userdata("id");
		$extra_days= $this->input->get("extra_days") || 0;
		$this->Provider_plan_model->subscribe($provider_id, $id, $extra_days);
		redirect(base_url('provider/plan?success=You subscribed successfully'));
	}
	private function get_current_provider_history($provider_id){
		$plans= $this->Provider_plan_model->get_plans_by_provider($provider_id);
		foreach ($plans as $plan){
			$plan= $this->Provider_plan_model->get_plan_data($plan);
		}
		return $plans;
	}
}
