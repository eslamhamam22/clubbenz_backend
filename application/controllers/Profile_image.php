<?php
ob_start();
class Profile_image extends MY_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->library('upload');
		$this->load->helper(array('form', 'url'));
		$this->load->library(['ion_auth', 'form_validation']);
		$this->load->helper(['url', 'language']);
		$this->load->model('Service_tag_model', 'service_tag');
		$this->load->model('Profile_image_model', 'pimage');
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
		$this->data['rec'] = $this->pimage->manage_pimage();
		$this->data['title'] = 'Manage Profile Iamge';
		$this->load->view('manage_pimage', $this->data);
	}
	public function add_pimage() {

		if ($this->input->post()) {

			$file_name = $_FILES['image']['name'];

			if ($file_name != '') {
				$config['upload_path'] = './upload/';
				$config['file_name'] = time() . $file_name;
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$this->upload->initialize($config);
				if (!$this->upload->do_upload('image')) {
					echo ($this->upload->display_errors());
				} else {
					$data = $this->upload->data();
					$new_array['profile_image'] = $data['file_name'];
				}
			}
			$result = $this->pimage->add_pimage($new_array);
			if ($result) {
				redirect(base_url('profile_image/?success=Add successfully!'));
			} else {
				redirect(base_url('profile_image/?error=Some error!'));
			}

		}
		$this->data['title'] = 'Add Profile Iamge';
		$this->load->view('add_pimage', $this->data);
	}

	public function del_pimage($id) {
		$rs = $this->pimage->del_pimage($id);
		if ($rs) {
			redirect(base_url('profile_image/?success= Delete successfully!'));
		} else {
			redirect(base_url('profile_image/?error=Some error!'));
		}
	}
	public function edit_pimage($id) {

		$result['row'] = $this->pimage->edit_pimage($id);
		$result['title'] = 'Edit Profile Iamge';
		$this->load->view('edit_pimage', $result);
	}
	public function update_pimage() {
		$id = $this->input->post('id');

		if ($id) {

			$file_name = $_FILES['image']['name'];

			if ($file_name != '') {
				$config['upload_path'] = './upload/';
				$config['file_name'] = time() . $file_name;
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$this->upload->initialize($config);
				if (!$this->upload->do_upload('image')) {
					echo ($this->upload->display_errors());
				} else {
					$data = $this->upload->data();
					$new_array['profile_image'] = $data['file_name'];
				}
			}

			if (!empty($data['file_name'])) {
				$result = $this->pimage->update_pimage($new_array, $id);
				if ($result) {
					redirect(base_url('profile_image/?success=update successfully!'));
				} else {
					redirect(base_url('profile_image/?success=update successfully!'));
				}
			} else {
				redirect(base_url('profile_image/?success=update successfully!'));
			}

		}

	}
}