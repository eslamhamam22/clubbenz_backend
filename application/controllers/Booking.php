<?php
ob_start();
class Booking extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->library('upload');
		$this->load->helper(array('form', 'url'));
		$this->load->library(['ion_auth', 'form_validation']);
		$this->load->helper(['url', 'language']);
		$this->load->model('Service_tag_model', 'service_tag');
		$this->load->model('Serviceshop_model', 'serviceshop');
		$this->load->model('Part_model', 'part');
		$this->load->model('Booking_model', 'booking');
		$this->load->model('location_model', 'location');

		$this->load->model('acl_model');
		$this->load->model('Users_model');

		$this->load->library('session');

		if (!$this->ion_auth->logged_in()) {
			redirect('auth', 'refresh');
		}

		if ($this->input->get('error')) {
			$this->data['error'] = $this->input->get('error');
		}
		if ($this->input->get('success')) {
			$this->data['success'] = $this->input->get('success');
		}
	}
	public function index() {
		$this->data['rec'] = $this->booking->manage_booking();
		$this->data['title'] = 'Booking';
		$this->load->view('manage_booking', $this->data);

	}
	public function status_update() {
		if ($this->input->post()) {
			$id = $this->input->post('id');
			date_default_timezone_set('Egypt');
			$data = array(
				'status' => $this->input->post('status'),
				'description' => $this->input->post('description'),
				"updated_by" => $this->ion_auth->user()->row()->id,
				"updated_at" => date("Y-m-d H:i"),
			);
			$this->booking->status_update($data, $id);
			redirect(base_url('booking/'));

		}

	}

}
?>
