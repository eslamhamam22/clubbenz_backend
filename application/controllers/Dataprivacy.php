<?php
ob_start();
class Dataprivacy extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->library('upload');
		$this->load->helper(array('form', 'url'));
		$this->load->library(['ion_auth', 'form_validation']);
		$this->load->helper(['url', 'language']);
		$this->load->model('Dataprivacy_model', 'data_privacy');

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
		$this->data['rec'] = $this->data_privacy->data_privacy_manage();
		$this->data['title'] = 'Data privacy Manage';
		$this->load->view('data_privacy_manage', $this->data);
	}

	public function edit_data_privacy($id) {
		$data['rec'] = $this->data_privacy->edit_data_privacy($id);
		$data['title'] = 'Edit Data privacy';
		$this->load->view('edit_data_privacy', $data);
	}
	public function data_privacy_update() {

		$id = $this->input->post('id');
		if ($this->input->post()) {
			$rules = array(
				array(
					'field' => 'name_en',
					'label' => 'name_en',
					'rules' => 'trim|required',
				), array(
					'field' => 'name_ar',
					'label' => 'name_ar',
					'rules' => 'trim|required',
				),
			);

			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				$new_array['name_en'] = $this->input->post('name_en');
				$new_array['name_ar'] = $this->input->post('name_ar');

				$val = $this->data_privacy->data_privacy_update($new_array, $id);
				if ($val) {
					redirect(base_url('Dataprivacy/?success=Update  successfully!'));
				} else {
					redirect(base_url('Dataprivacy/?success=Update  successfully!'));
				}
			} else {
				$error = validation_errors();
				redirect(base_url('Dataprivacy/edit_data_privacy/' . $id . '?error=' . $error));
			}
		}
	}

}