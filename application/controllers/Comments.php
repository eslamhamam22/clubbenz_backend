<?php
class Comments extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->library('upload');
		$this->load->helper(array('form', 'url'));
		$this->load->library(['ion_auth', 'form_validation']);
		$this->load->helper(['url', 'language']);
		$this->load->model('Comments_model', 'comment');
		$this->load->model('provider_model');
		$this->load->model('acl_model');
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
		$this->data['rec'] = $this->comment->get_comment();
		$this->data['providers'] = $this->provider_model->select_provider();
		$this->data['users'] = $this->acl_model->get_all_users();
		$this->data['title'] = 'Reviews';
		$this->load->view('comment', $this->data);
	}
}
?>
