<?php
ob_start();
class ChassisNumber extends MY_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->library('upload');
		$this->load->helper(array('form', 'url'));
		$this->load->library(['ion_auth', 'form_validation']);
		$this->load->helper(['url', 'language']);
		$this->load->model('Chassis_model', 'chassis');
		$this->load->model('Car_model', 'car');

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

		$this->data['rec'] = $this->chassis->get_chassis();
		$this->data['model_name'] = $this->car->get_classes();
		//print_r($this->data);
		$this->load->view('chassis', $this->data);
	}

	public function add_chassis() {
		if ($this->input->post()) {

			$data = array(
				'chassis_num' => $this->input->post('chassis_number'),
				'model_id' => $this->input->post('model_id'),
			);
			$result = $this->chassis->add_chassis($data);
			if ($result == false) {
				redirect(base_url('chassisNumber/?error=Already Added!'));

			} else {
				redirect(base_url('chassisNumber/?success=Add  successfully!'));
			}

		}
		$this->data['model_name'] = $this->car->get_classes();
		$this->load->view('add_chassis', $this->data);

	}

	public function edit_chassis() {
		if ($this->input->post()) {

			$data = array(
				'chassis_num' => $this->input->post('chassis_number'),
				'model_id' => $this->input->post('model_id'),
				'id' => $this->input->post('chassis_id'),
			);
			// print_r($data );

			$result = $this->chassis->update_chassis($data);
			if ($result == false) {
				redirect(base_url('chassisNumber/?error=Already Added!'));
			} else {
				redirect(base_url('chassisNumber/?success=Updated successfully!'));
			}

		} else {
			// echo $_GET['id'];
			// $chassis['chassis'] = $this->chassis->get_chassis_info($_GET['id']);
			$this->data['chassis'] = $this->chassis->get_chassis_info($_GET['id']);
			$this->data['model_name'] = $this->car->get_classes();
			$this->load->view('edit_chassis', $this->data);
		}

	}

	public function del_chassis($id) {
		$id = $this->chassis->del_chassis($id);
		if ($id) {
			redirect(base_url('chassisNumber/?success= Delete successfully!'));
		} else {
			redirect(base_url('chassisNumber/?error=Some error!'));
		}

	}

}
