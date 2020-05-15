<?php
class Reviews extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->library('upload');
		$this->load->helper(array('form', 'url'));
		$this->load->library(['ion_auth', 'form_validation']);
		$this->load->helper(['url', 'language']);
		$this->load->model('Reviews_model', 'review');
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
		$this->data['rec'] = $this->review->get_review();
		$this->data['title'] = 'Manage Review';
		$this->load->view('review', $this->data);
	}
	public function provider() {
		$this->data['rec'] = $this->review->get_provider_reviews();
		$this->data['title'] = 'Provider User Review';
		$this->load->view('provider_review', $this->data);
	}

	public function status_update() {
		if ($this->input->post()) {
			$id = $this->input->post('id');
			date_default_timezone_set('Egypt');
			$data = array(
				'status' => $this->input->post('status'),
				"updated_by" => $this->ion_auth->user()->row()->id,
				"date_updated" => date("Y-m-d H:i"),
			);
			$result = $this->review->status_update($data, $id);
			if ($result) {
				redirect(base_url('reviews?success=status updated successfully!'));
			}
		}
	}
	public function provider_status_update() {
		if ($this->input->post()) {
			$id = $this->input->post('id');
			date_default_timezone_set('Egypt');
			$data = array(
				'status' => $this->input->post('status'),
				"updated_by" => $this->ion_auth->user()->row()->id,
				"date_updated" => date("Y-m-d H:i"),
			);
			$result = $this->review->status_update($data, $id);
			if ($result) {
				redirect(base_url('reviews/provider?success=status updated successfully!'));
			}
		}
	}
}
?>
