<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Class Auth
 * @property Ion_auth|Ion_auth_model $ion_auth        The ION Auth spark
 * @property CI_Form_validation      $form_validation The form validation library
 */
class Home extends CI_Controller {
	public $data = [];

	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->library(['ion_auth', 'form_validation']);
		$this->load->helper(['url', 'language']);
		$this->load->model('Provider_Model');
		$this->load->model('Shipping_model');
		$this->load->model('Provider_plan_model');
		$this->load->model('Plan_model');
		$this->load->model('Acl_model');
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
		$data['parts'] = $this->Provider_Model->get_parts($provider_id);
		$data['active_parts'] = array_filter($this->Provider_Model->get_parts($provider_id), function ($part){
			return $part->active == 1 ? true : false;
		});
		$data["current_plan"]= $this->get_current_provider_plan($provider_id);
		$data["requests"]= $this->Shipping_model->select_shipping_by_provider($provider_id);
		$this->load->view('provider/dashboard', $data);
	}

	/**
	 * Log the user out
	 */
	public function logout() {
		$this->session->sess_destroy();
		redirect('provider', 'refresh');
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
	private function add_months_to_date($date, $months, $extra_days){
		$date= date("Y-m-d H:i:s", strtotime($extra_days." days", strtotime($date)));
		return date("Y-m-d H:i:s", strtotime($months." month", strtotime($date)));
	}

}
