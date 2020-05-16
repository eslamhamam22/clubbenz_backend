<?php
ob_start();
class Shippment extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->library('upload');
		$this->load->helper(array('form', 'url'));
		$this->load->library(['ion_auth', 'form_validation']);
		$this->load->helper(['url', 'language']);
		$this->load->model('Shippment_model', 'shippment');

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
		$this->data['rec'] = $this->shippment->shipment_manage();
		$this->data['title'] = 'Manage Shippment';
		$this->load->view('shippment_manage', $this->data);
	}

	public function shippment_update() {

		$id = $this->input->post('id');
		if ($this->input->post()) {

			$file_name = $_FILES['file']['name'];
			if ($file_name != '') {
				$config['upload_path'] = './upload/';
				$config['file_name'] = time() . $file_name;
				$config['allowed_types'] = 'pdf';
				$this->upload->initialize($config);
				if (!$this->upload->do_upload('file')) {
					echo ($this->upload->display_errors());
				} else {
					$data = $this->upload->data();
					$new_array['file'] = $data['file_name'];
				}
			}

			$val = $this->shippment->shipment_update($new_array, $id);
			if ($val) {
				redirect(base_url('shippment/?success=Update  successfully!'));
			} else {
				redirect(base_url('shippment/?success=Update  successfully!'));
			}
		}
	}

}