<?php
ob_start();
class Catalog extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->library('upload');
		$this->load->helper(array('form', 'url'));
		$this->load->library(['ion_auth', 'form_validation']);
		$this->load->helper(['url', 'language']);
		$this->load->model('Catalog_model', 'cat');

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
		$this->data['rec'] = $this->cat->catalog_manage();
		$this->data['title'] = 'Parts Catalogue';
		$this->load->view('catalog_manage', $this->data);
	}

	public function update_status() {
		if (isset($_REQUEST['sval'])) {
			$this->load->model('catalog_model', 'part_catalog');
			$up_status = $this->cat->update_status();

			if ($up_status > 0) {
				$this->session->set_flashdata('msg', 'data updated successfully');
				$this->session->set_flashdata('msg_class', 'alert-success');
			} else {
				$this->session->set_flashdata('msg', 'data not updated successfully');
				$this->session->set_flashdata('msg_class', 'alert-danget');
			}
			return redirect('catalog');
		}
	}
}