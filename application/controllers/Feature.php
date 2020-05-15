<?php
ob_start();
class Feature extends MY_Controller {

	public function __construct() {
		ini_set('display_errors', 1);
		error_reporting(1);
		parent::__construct();
		$this->load->model('provider_model');
		$this->load->library('session');
		$this->load->library('upload');
		$this->load->model('Provider_plan_model');
		$this->load->model('Plan_model');
		$this->load->library(['ion_auth', 'form_validation']);

		if ($this->input->get('error')) {
			$this->data['error'] = $this->input->get('error');
		}
		if ($this->input->get('success')) {
			$this->data['success'] = $this->input->get('success');
		}
	}
	public function index() {
		$this->data['rec'] = $this->provider_model->select_provider();
		$this->data['parts'] = $this->provider_model->get_parts_fet();
		$this->data['title'] = 'Features';
		$this->load->view('mange_feature', $this->data);
	}

	public function update_status() {
		if (isset($_REQUEST['sval'])) {
			$this->load->model('provider_model', 'parts');
			$up_status = $this->provider_model->update_status();

			if ($up_status > 0) {
				$this->session->set_flashdata('msg', 'data updated successfully');
				$this->session->set_flashdata('msg_class', 'alert-success');
			} else {
				$this->session->set_flashdata('msg', 'data not updated successfully');
				$this->session->set_flashdata('msg_class', 'alert-danget');
			}
			return redirect('feature');
		}
	}

}
?>
