<?php
class Fuel extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->library('upload');
		$this->load->helper(array('form', 'url'));
		$this->load->library(['ion_auth', 'form_validation']);
		$this->load->helper(['url', 'language']);
		$this->load->model('Fuel_model', 'fuels');

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
		$this->data['rec'] = $this->fuels->fuel_manage();
		$this->data['title'] = 'Fuel Type';
		$this->load->view('fuel_manage', $this->data);
	}

	public function add_fuel() {
		if ($this->input->post()) {
			$rules = array(
				array(
					'field' => 'fueltype',
					'label' => 'Fueltype',
					'rules' => 'trim|required',
				),
			);

			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				$name = array(
					'name' => $this->input->post('fueltype'),
					'arabic_name' => $this->input->post('fueltype_arabic'),
					'sorting' => $this->input->post('sorting'),
				);
				$id = $this->fuels->add_fuel($name);
				if ($id) {
					redirect(base_url('fuel/?success=Fuel type added successfully!'));
				} else {
					redirect(base_url('fuel/?error=Some error!'));
				}
			} else {
				$error = validation_errors();
				redirect(base_url('fuel/?error=' . $error));
			}
		}
		$this->data['title'] = 'Add Fuel Type';
		$this->load->view('add_fuel', $this->data);
	}

	public function fuel_del($id) {
		$id = $this->fuels->fuel_del($id);
		if ($id) {
			redirect(base_url('fuel/?success=Fuel type deleted successfully!'));
		} else {
			redirect(base_url('fuel/?error=Some error!'));
		}
	}
	public function fuel_update($id) {
		$data['fuel'] = $this->fuels->edit_fuel($id);
		$data['title'] = 'Edit Fuel Type';
		$this->load->view('fuel_update', $data);
	}
	public function fuel_update_value() {
		if ($this->input->post()) {
			$rules = array(
				array(
					'field' => 'name',
					'label' => 'Name',
					'rules' => 'trim|required',
				),
			);

			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				$id = $this->input->post('id');
				$name = array(
					'name' => $this->input->post('name'),
					'arabic_name' => $this->input->post('fueltype_arabic'),
					'sorting' => $this->input->post('sorting'),
				);
				$id = $this->fuels->fuel_update_value($name, $id);
				if ($id) {
					redirect(base_url('fuel/?success=Update successfully!'));
				} else {
					redirect(base_url('fuel/?success=Update successfully!'));
				}
			} else {
				$error = validation_errors();
				redirect(base_url('fuel/?error=' . $error));

			}
		}
	}
}