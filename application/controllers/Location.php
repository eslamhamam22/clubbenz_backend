<?php
class Location extends MY_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->library('upload');
		$this->load->helper(array('form', 'url'));
		$this->load->library(['ion_auth', 'form_validation']);
		$this->load->helper(['url', 'language']);
		$this->load->model('cars_model', 'cars');
		$this->load->model('offers_model', 'offers');
		$this->load->model('location_model', 'location');
		$this->load->model('acl_model');
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
		$this->data['rec'] = $this->location->manage_location();
		$this->data['title'] = 'Manage Location Zone';
		$this->load->view('manage_location', $this->data);
	}

	public function add_location() {
		if ($this->input->post()) {
			$rules = array(
				array(
					'field' => 'name',
					'label' => 'Location ZONE Name',
					'rules' => 'trim|required',
				),
			);

			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				$name = array(
					'name' => $this->input->post('name'),
					'arabic_name' => $this->input->post('arabic_name'),
					'sorting' => $this->input->post('sorting'),
				);
				$id = $this->location->add_location($name);
				if ($id) {
					redirect(base_url('location/?success= added successfully!'));
				} else {
					redirect(base_url('location/?success= added successfully!'));
				}
			} else {
				$error = validation_errors();
				redirect(base_url('location/add_location?error=' . $error));
			}
		}
		$this->data['title'] = 'Add Location Zone';
		$this->load->view('add_location', $this->data);
	}

	public function del_location($id) {
		$id = $this->location->del_location($id);
		if ($id) {
			redirect(base_url('location/?success= deleted successfully!'));
		} else {
			redirect(base_url('location/?error=Some error!'));
		}
	}
	public function edit_location($id) {

		$this->data['location'] = $this->location->edit_location($id);
		$this->data['title'] = 'Edit Location Zone';
		$this->load->view('edit_location', $this->data);
	}
	public function update_location() {
		if ($this->input->post()) {
			$rules = array(
				array(
					'field' => 'name',
					'label' => 'Location Zone Name',
					'rules' => 'trim|required',
				),
			);

			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				$id = $this->input->post('id');
				$data = array(
					'name' => $this->input->post('name'),
					'arabic_name' => $this->input->post('arabic_name'),
					'sorting' => $this->input->post('sorting'),
				);
				$id = $this->location->update_location($data, $id);
				if ($id) {
					redirect(base_url('location/?success= Update successfully!'));
				} else {
					redirect(base_url('location/?success= Update successfully!'));
				}
			} else {
				$error = validation_errors();
				redirect(base_url('location/update_location?error=' . $error));

			}
		}
	}

}