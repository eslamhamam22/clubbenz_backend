<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Auth
 * @property Ion_auth|Ion_auth_model $ion_auth        The ION Auth spark
 * @property CI_Form_validation $form_validation The form validation library
 */
class Shipping extends CI_Controller {
	public $data = [];

	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->helper(['url', 'language']);
		$this->load->model('Provider_model');
		$this->load->model('Shipping_model');
		$this->load->model('Shippment_model');
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
		$this->load->library('session');
		$this->lang->load('auth');
		if (!$this->session->userdata("id")) {
			redirect('/provider');
		}

		$this->load->helper('language');
		$this->lang->load('provider/left_nav', $this->session->userdata('site_lang') == "arabic" ? "arabic" : "english");
		$this->lang->load('provider/shipping', $this->session->userdata('site_lang') == "arabic" ? "arabic" : "english");

	}

	public function index() {
		$file = $this->Shippment_model->shipment_manage();
		$data["file"] = $file[0];
		$data['title'] = 'Shipping';
		$this->load->view('provider/shipping', $data);
	}

	public function request() {
		$provider_id = $this->session->userdata("id");
		$data["requests"] = $this->Shipping_model->select_shipping_by_provider($provider_id);
		$data['title'] = 'Shipping Request';
		$this->load->view('provider/shipping_request', $data);
	}
	public function add_request() {
		$provider_id = $this->session->userdata("id");
		$data['parts'] = $this->Provider_model->get_parts($provider_id);
		$data["requests"] = $this->Shipping_model->select_shipping_by_provider($provider_id);
		$data['title'] = 'Add Shipping Request';
		$this->load->view('provider/add_request', $data);
	}

	public function add_request_submit() {
		if ($_POST) {
			$provider_id = $this->session->userdata("id");
//			print_r($_POST);
			$data = array(
				"part_id" => $this->input->post('part'),
				"provider_id" => $provider_id,
				"width" => $this->input->post('width'),
				"height" => $this->input->post('height'),
				"length" => $this->input->post('length'),
				"weight" => $this->input->post('weight'),
				"address" => $this->input->post('address'),
				"city" => $this->input->post('city'),
				"shippment_date" => $this->input->post('shippment_date'),
				"message" => $this->input->post('message'),
			);

			$this->Shipping_model->add($data);
		}
		redirect('/provider/shipping/request');
	}
}
