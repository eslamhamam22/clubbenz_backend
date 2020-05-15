<?php
class Partgroup extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->library('upload');
		$this->load->helper(array('form', 'url'));
		$this->load->library(['ion_auth', 'form_validation']);
		$this->load->helper(['url', 'language']);
		$this->load->model('Service_tag_model', 'service_tag');
		$this->load->model('Partgroup_model', 'partgroup');

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
		$this->data['rec'] = $this->partgroup->manage_part_group();
		$this->data['title'] = 'Part Group';
		$this->load->view('manage_part_group', $this->data);
	}
	public function add_part_group() {
		if ($this->input->post()) {
			$rules = array(
				array(
					'field' => 'name',
					'label' => 'Modelname',
					'rules' => 'trim|required',
				),
			);

			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {

				$new_array['name'] = $this->input->post('name');
				$new_array['arabic_name'] = $this->input->post('arabic_name');

				$result = $this->partgroup->add_part_group($new_array);
				if ($result) {
					redirect(base_url('partgroup/?success=Add successfully!'));
				} else {
					redirect(base_url('partgroup/?success=Add successfully!'));
				}
			} else {
				$error = validation_errors();
				redirect(base_url('partgroup/?error=' . $error));
			}
		}
		$this->data['title'] = 'Add Part Group';
		$this->load->view('add_part_group', $this->data);
	}
	public function part_group_del($id) {
		$id = $this->partgroup->part_group_del($id);
		if ($id) {
			redirect(base_url('partgroup/?success=Parts Delete successfully!'));
		} else {
			redirect(base_url('partgroup/?error=Some error!'));
		}

	}
	public function edit_part_group($id) {
		$data['rec'] = $this->partgroup->edit_part_group($id);
		$this->data['title'] = 'Edit Part Group';
		$this->load->view('edit_part_group', $data);
	}
	public function update_part_group() {
		if ($id = $this->input->post('id')) {
			$rules = array(
				array(
					'field' => 'name',
					'label' => 'Part Name',
					'rules' => 'trim|required',
				),
			);

			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {

				$new_array['name'] = $this->input->post('name');
				$new_array['arabic_name'] = $this->input->post('arabic_name');

				$result = $this->partgroup->update_part_group($new_array, $id);
				if ($result) {
					redirect(base_url('partgroup/?success=update successfully!'));
				} else {
					redirect(base_url('partgroup/?success=Add successfully!'));
				}
			} else {
				$error = validation_errors();
				redirect(base_url('partgroup/?error=' . $error));
			}
		}
		$this->load->view('add_parts_group');
	}

}
?>