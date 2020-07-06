<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Class Auth
 * @property Ion_auth|Ion_auth_model $ion_auth        The ION Auth spark
 * @property CI_Form_validation      $form_validation The form validation library
 */
class Auth extends CI_Controller {
	public $data = [];

	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->library(['ion_auth', 'form_validation']);
		$this->load->helper(['url', 'language']);
		$this->load->model('Provider_Model');
		$this->load->model('World_model');
		$this->load->model('Acl_model');
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
		$this->load->library('session');
		$this->load->library('upload');
		$this->lang->load('auth');
		if ($this->session->userdata("id")) {
			redirect('/provider/home');
		}

		$this->load->helper('language');
		$this->lang->load('provider/auth', $this->session->userdata('site_lang') == "arabic" ? "arabic" : "english");

	}

	/**
	 * Redirect if needed, otherwise display the user list
	 */

	public function index() {
		$this->data['message'] = ($this->session->flashdata('message')) ? $this->session->flashdata('message') : $this->session->flashdata('error');
		$this->load->view('provider/login', $this->data);
	}
	/**
	 * Log the user in
	 */
	public function login() {
		//$this->data['title'] = $this->lang->line('login_heading');
		if ($_POST) {
			$email = $this->input->post("username");
			$pass = $this->input->post("password");
//			$remember = $this->input->post('remember_me');
			if (strlen($email) > 0 && strlen($pass) > 0) {
				$login = $this->Provider_Model->login($email, md5($pass));
				if ($login) {
//					print_r($login[0]);
					$this->session->set_userdata($login[0]);
//					print_r($this->session->userdata());
					redirect('/provider/home');
				} else {
					$this->session->set_flashdata('error', 'Wrong Username or Password');
					redirect('/provider');
				}
			} else {
				$this->session->set_flashdata('error', 'Username & Password are required');
				redirect('/provider');
			}
		}
//		redirect('/provider');
	}
	public function add() {
		//$this->data['title'] = $this->lang->line('login_heading');
		if ($_POST) {
//			print_r($_POST);
			$config['upload_path'] = './upload/';
			$fname = $_FILES['logo']['name'];
//			print_r($_FILES);
			$config['file_name'] = time() . $fname;
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->upload->initialize($config);
			$provider_user = array(
				'user_name' => $this->input->post('user_name'),
				'user_email' => $this->input->post('user_email'),
				'user_password' => md5($this->input->post('password')),
				'user_mobile' => $this->input->post('user_mobile'),
				'store_name' => $this->input->post('store_name'),
				'contact_person' => $this->input->post('contact_person'),
				'address' => $this->input->post('address'),
				'country' => $this->input->post('country'),
				'governorate' => $this->input->post('governorate'),
				'city' => $this->input->post('city'),
				'zip_code' => $this->input->post('zip_code'),
				'business_website' => $this->input->post('business_website'),
			);
			if (!$this->upload->do_upload('logo')) {
//				$this->session->set_flashdata('error', $this->upload->display_errors());
				//				redirect('/provider/auth/register');
			} else {
				$data = $this->upload->data();
				$file_name = $data["file_name"];
				$provider_user["logo"] = $file_name;
			}
			if ($this->Provider_Model->email_check($provider_user["user_email"])) {
				$this->session->set_flashdata('success', "You have signed up successfully");
				$this->Provider_Model->signup($provider_user);
				redirect('/provider');
				// } else {
				// redirect('/provider/auth/register');
			} else {
				$data = $this->upload->data();
				$file_name = $data["file_name"];
				$provider_user["logo"] = $file_name;
			}
			if ($this->Provider_Model->email_check($provider_user["user_email"])) {
				$this->session->set_flashdata('success', "You have signed up successfully");
				$this->Provider_Model->signup($provider_user);
				redirect('/provider');
			} else {
				$this->session->set_flashdata('error', "User already exists.");
				redirect('/provider/auth/register');
			}
		}
		redirect('/provider');
	}

	public function register() {
		$this->data['countries'] = $this->World_model->get_countries();
		$this->data['message'] = ($this->session->flashdata('message')) ? $this->session->flashdata('message') : $this->session->flashdata('error');
		$this->load->view('provider/register', $this->data);
	}

	public function forget_pass() {
		redirect('/provider');
	}

	public function forgotpassword_post() {
		if ($_POST) {
			$arr = $this->_forgotpassword($_POST);
		} else {
			$arr['message'] = "Please provide Email";
			$arr['success'] = false;
		}
		// $this->response($arr, 200);
		redirect('/provider', $ar);
	}

	private function _forgotpassword($data) {

		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'mail.clubenz.com';
		$config['smtp_crypto'] = 'tls';
		$config['smtp_port'] = '587';
		$config['smtp_timeout'] = '7';
		$config['smtp_user'] = 'support@clubenz.com';
		$config['smtp_pass'] = 'Support@2020';
		$config['charset'] = 'utf-8';
		$config['newline'] = "\r\n";
		$config['wordwrap'] = TRUE;
		$config['mailtype'] = 'html'; // or html
		$config['validation'] = TRUE; // bool whether to validate email or not

		if ($data['user_email']) {
			$user = $this->Acl_model->get_email($data['user_email']);
			if ($user) {
				$resetToken = md5($user->user_email);
				$resetTimeStemp = time();
				$resetToken = $resetToken . "" . $resetTimeStemp;
				$this->email->initialize($config);
				$this->email->from('support@clubenz.com', 'Clubenz--NoReply');
				$this->email->to($user->user_email);
				$users['resetlink'] = $resetToken;
				$mesg = $this->load->view('provider/reset_password_view', $users, true);
				$this->email->subject('Reset Password Request Clubenz');
				$this->email->message($mesg);
				$this->email->send();
				$user = $this->Acl_model->reset_password_request($data['user_email'], $resetToken, $resetTimeStemp);
				// $this->form_validation->set_error_delimiters('','');
				// $this->form_validation->set_rules($rules);
				$arr['message'] = "Password check your email to rest your password";
				$arr['success'] = true;

			} else {
				$arr['message'] = "Please provide valid user email";
				$arr['success'] = false;
			}

		} else {
			$arr['message'] = "Please provide valid user email";
			$arr['success'] = false;
		}
		return $arr;
	}

	public function updatepassword() {

		if ($_GET['resetToken']) {
			$user = $this->Acl_model->get_user_by_resetToken($_GET['resetToken']);

			if ($user) {
				$resetTimeStemp = time();
				if ($user->resetTimeStemp + 900 > $resetTimeStemp) {
					$this->load->view('provider/reset_password');
				} else {
					$data['message'] = "URL is expired, please reset your password again.";
					$this->load->view('provider/reset_password', $data);
				}

			} else {
				$data['message'] = "URL is not valid.";
				$this->load->view('provider/reset_password', $data);
			}
		} else {

		}

		// check if url does not get expired or token is valid

		// $this->load->view('reset_password', $this->data);
	}
	public function confirmupdatepassword() {

		$password = md5($this->input->post("user_password"));
		$c_password = md5($this->input->post("c_password"));
		if ($c_password == $password) {

			$resetToken = $this->input->post('resetToken');

			$this->db->query("update provider_user set user_password='" . $password . "' where resetToken='$resetToken' ");

			redirect('/provider');

		}

	}

}
