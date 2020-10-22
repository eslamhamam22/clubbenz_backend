<?php
class years extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->library('upload');
		$this->load->helper(array('form', 'url'));
		$this->load->library(['ion_auth', 'form_validation']);
		$this->load->helper(['url', 'language']);
		$this->load->model('Years_model', 'years');

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
		$this->data['rec'] = $this->years->year_manage();
		$this->data['title'] = 'Manage Years';
		$this->load->view('year_manage', $this->data);
	}
	public function add_year() {
		if ($this->input->post()) {
			$rules = array(
				array(
					'field' => 'year',
					'label' => 'Year',
					'rules' => 'trim|required',
				),
			);

			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				$data = $this->input->post('year');
				$name = array(
					'name' => $data,
					'sorting' => $this->input->post('sorting'),

				);

				$id = $this->years->add_year($data, $name);
				if ($id) {
					redirect(base_url('years/?success=Add Year successfully!'));
				} else {
					redirect(base_url('years/?error=All Ready Exist!'));
				}
			} else {
				$error = validation_errors();
				redirect(base_url('years/?error=' . $error));
			}
		}
		$this->data['title'] = 'Add Years';
		$this->load->view('add_year', $this->data);
	}

	public function year_del($id) {
		$id = $this->years->year_del($id);
		if ($id) {
			redirect(base_url('years/?success=Year deleted successfully!'));
		} else {
			redirect(base_url('years/?error=some error!'));
		}
	}
	public function year_update($id) {
		$this->data['title'] = 'Edit Years';
		$this->data['years'] = $this->years->year_update($id);
		$this->load->view('year_update', $this->data);
	}
	public function year_update_value() {
		if ($this->input->post()) {
			$rules = array(
				array(
					'field' => 'year',
					'label' => 'Year',
					'rules' => 'trim|required',
				),
			);

			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				$id = $this->input->post('id');
				$name = array(
					'name' => $this->input->post('year'),
					'sorting' => $this->input->post('sorting'),
				);
				$id = $this->years->year_update_value($name, $id);
				if ($id) {
					redirect(base_url('years/?success=Update successfully!'));
				} else {
					redirect(base_url('years/?success=Update successfully!'));
				}
			} else {
				$error = validation_errors();
				redirect(base_url('years/?error=' . $error));
			}
		}
	}

}
