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
	}

	/**
	 * Redirect if needed, otherwise display the user list
	 */

	public function index() {
		$provider_id= $this->session->userdata("id");
		$plans= $this->Plan_model->plan_manage();
		$current_plan= $this->get_current_provider_plan($provider_id);
		$this->load->view('provider/plan', ["plans"=> $plans, "current_plan" => $current_plan]);
	}
	public function history() {
		$provider_id= $this->session->userdata("id");
		$provider_plans= $this->get_current_provider_history($provider_id);
		$current_plan= $this->get_current_provider_plan($provider_id);
		$this->load->view('provider/plan_history', ["plans"=> $provider_plans, "current_plan" => $current_plan]);
	}
	public function subscribe_form($plan_id) {
		$provider_id= $this->session->userdata("id");
		$plan= $this->Plan_model->get_plan_by_id($plan_id);
		$current_plan= $this->get_current_provider_plan($provider_id);
		$this->load->view('provider/subscribe_form', ["plan"=> $plan[0], "current_plan" => $current_plan]);
	}

	public function subscribe($id){
		$provider_id= $this->session->userdata("id");
		$extra_days= $this->input->get("extra_days");
		$this->Provider_plan_model->subscribe($provider_id, $id, $extra_days);
		redirect(base_url('provider/plan?success=You subscribed successfully'));
	}
	private function get_current_provider_plan($provider_id){
		$current_plan= $this->Provider_plan_model->get_current_plan_by_provider($provider_id);
		if($current_plan){
			$current_plan->plan= $this->Plan_model->get_plan_by_id($current_plan->plan_id)[0];
			$current_plan->end_date= $this->add_months_to_date($current_plan->created_at, $current_plan->plan->frequency, $current_plan->extra_days);
			if(strtotime(date("Y-m-d H:i:s")) > strtotime($current_plan->end_date))
				$current_plan->status= "expired";
			return $current_plan;
		}
		return false;
	}
	private function get_current_provider_history($provider_id){
		$plans= $this->Provider_plan_model->get_plans_by_provider($provider_id);
		foreach ($plans as $plan){
			$plan->plan= $this->Plan_model->get_plan_by_id($plan->plan_id)[0];
			$plan->end_date= $this->add_months_to_date($plan->created_at, $plan->plan->frequency, $plan->extra_days);
			if(strtotime(date("Y-m-d H:i:s")) > strtotime($plan->end_date))
				$plan->status= "expired";
		}
		return $plans;
	}
	private function add_months_to_date($date, $months, $extra_days){
		$date= date("Y-m-d H:i:s", strtotime($extra_days." days", strtotime($date)));
		return date("Y-m-d H:i:s", strtotime($months." month", strtotime($date)));
	}
}
