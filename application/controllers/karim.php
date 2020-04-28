<?php

class karim extends CI_Controller {

	public function __construct() {

		parent::__construct();
		$this->load->helper('url');
		$this->load->model('provider_model');
		$this->load->library('session');
		$this->load->library('upload');

	}

	public function index() {
		$this->load->view("register.php");
	}

	public function register_user() {

		if (!empty($this->input->post('logo'))) {
			$filename = $this->input->post('logo');
			// $filename = $_FILES['logo']['name'];
			if ($filename != "") {
				$config['upload_path'] = './upload/logo';
				$config['file_name'] = time() . $filename;
				$config['allowed_types'] = 'gif|jpg|png|jpeg|JPG|PNG';
				$this->upload->initialize($config);
				if (!$this->upload->do_upload('logo')) {
					$arr['error_picture'] = $this->upload->display_errors();
				} else {
					$data = $this->upload->data();
					$new_array['logo'] = $data['file_name'];
				}
			}
		}

		$provider_user = array(
			'user_name' => $this->input->post('user_name'),
			'user_email' => $this->input->post('user_email'),
			'user_password' => md5($this->input->post('user_password')),
			'user_mobile' => $this->input->post('user_mobile'),
			'store_name' => $this->input->post('store_name'),
			'contact_person' => $this->input->post('contact_person'),
			'address' => $this->input->post('address'),
			'country' => $this->input->post('country'),
			'governorate' => $this->input->post('governorate'),
			'city' => $this->input->post('city'),
			'zip_code' => $this->input->post('zip_code'),
			'business_website' => $this->input->post('business_website'),
			// 'logo' => $this->input->post('logo'),
			"logo" => $new_array['logo'] ? $new_array['logo'] : "",
		);

		$email_check = $this->provider_model->email_check($provider_user['user_email']);

		if ($email_check) {
			$this->provider_model->register_user($provider_user);
			$this->session->set_flashdata('success_msg', 'Registered successfully.Now login to your account.');
			redirect('provider/login_view');

		} else {

			$this->session->set_flashdata('error_msg', 'Error occured,Try again.');
			redirect('provider');

		}

	}

	public function login_view() {

		$this->load->view("provider_login.php");

	}

	function login_user() {
		$user_login = array(

			'user_email' => $this->input->post('user_email'),
			'user_password' => md5($this->input->post('user_password')),

		);
//$user_login['user_email'],$user_login['user_password']
		$data['provider_user'] = $this->provider_model->login_user();
		//  if($data)
		//{

		$this->session->set_userdata('id', $data['provider_user'][0]['id']);
		$this->session->set_userdata('user_email', $data['provider_user'][0]['user_email']);
		$this->session->set_userdata('user_name', $data['provider_user'][0]['user_name']);
		$this->session->set_userdata('user_mobile', $data['provider_user'][0]['user_mobile']);
		echo $this->session->set_userdata('id');
		$this->load->view('user_profile.php', $data);

		//  }
		//  else{
		//   $this->session->set_flashdata('error_msg', 'Error occured,Try again.');
		//   $this->load->view("login.php");

		// }

	}

	function user_profile() {

		$this->load->view('user_profile.php');

	}
	public function user_logout() {

		$this->session->sess_destroy();
		redirect('provider/login_view', 'refresh');
	}

}

?>
