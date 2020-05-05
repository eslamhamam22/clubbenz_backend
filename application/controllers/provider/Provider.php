<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Class Auth
 * @property Ion_auth|Ion_auth_model $ion_auth        The ION Auth spark
 * @property CI_Form_validation      $form_validation The form validation library
 */
class Provider extends CI_Controller {
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
		$this->lang->load('auth');
		$this->load->library('upload');
		if ($this->input->get('error')) {
			$this->data['error'] = $this->input->get('error');
		}
		if ($this->input->get('success')) {
			$this->data['success'] = $this->input->get('success');
		}
		if(!$this->session->userdata("id"))
			redirect('/provider');

		$this->load->helper('language');
		$this->lang->load('provider/left_nav',$this->session->userdata('site_lang') == "arabic"? "arabic" : "english");
		$this->lang->load('provider/auth',$this->session->userdata('site_lang') == "arabic"? "arabic" : "english");
	}


	public function index() {
		$provider_id= $this->session->userdata("id");
		$user= $this->Provider_Model->get_provider_by_id($provider_id);
		$this->data['countries'] = $this->World_model->get_countries();
		$this->data["user"]= $user[0];
		$this->data['states'] = $this->World_model->get_states_by_country($user[0]->country);
		$this->load->view('provider/profile', $this->data);
	}

	public function edit() {
		//$this->data['title'] = $this->lang->line('login_heading');
		if ($_POST) {
			$provider_id= $this->session->userdata("id");
			$provider_user = array(
				'user_email' => $this->input->post('user_email'),
				'user_name' => $this->input->post('user_name'),
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
			if($this->input->post('user_password'))
				$provider_user["user_password"] = md5($this->input->post('user_password'));
			if(!empty($_FILES['logo']['name'])){
				$config['upload_path'] = './upload/';
				$fname = $_FILES['logo']['name'];
				$config['file_name'] = time() . $fname;
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$this->upload->initialize($config);
				if (!$this->upload->do_upload('logo')) {
					$this->session->set_flashdata('error', $this->upload->display_errors());
//					print_r($this->upload->display_errors());
					redirect(base_url('provider/provider?error=Something wrong happened.'));
				}
				$data = $this->upload->data();
				$file_name= $data["file_name"];
				$provider_user["logo"]= $file_name;
			}
			$this->Provider_Model->edit($provider_user, $provider_id);
			$this->session->set_flashdata('success', "You have edited your profile successfully");
		}

		redirect(base_url('provider/provider?success=You have edited your profile successfully'));
	}

}
