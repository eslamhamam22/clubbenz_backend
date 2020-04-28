<?php
ob_start();
class Providerlist extends MY_Controller {

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
		// $this->data['plan'] = $this->Provider_plan_model->get_current_plan_by_provider();
		$this->load->view('mange_providerlist', $this->data);
	}

	public function providerlist_del($id) {
		$id = $this->provider_model->providerlist_del($id);
		if ($id) {
			redirect(base_url('providerlist/?success= Delete successfully!'));
		} else {
			redirect(base_url('providerlist/?error=Some error!'));
		}
	}

	public function edit_providerlist($id) {
		$data['rec'] = $this->provider_model->edit_providerlist($id);
		$this->load->view('edit_providerlist', $data);
	}

	public function update_providerlist() {

		$id = $this->input->post('id');
		if ($this->input->post()) {
			$rules = array(
				array(
					'field' => 'user_name',
					'label' => 'Username',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'user_email',
					'label' => 'Email',
					'rules' => 'trim|required|valid_email',
				),
				array(
					'field' => 'user_mobile',
					'label' => 'Phone Number',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'city',
					'label' => 'City',
					'rules' => 'trim|required',
				),
			);

			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				$file_name = $_FILES['logo']['name'];
				$id = $this->input->post('id');

				$new_array['user_name'] = $this->input->post('user_name');
				$new_array['user_email'] = $this->input->post('user_email');
				$new_array['user_mobile'] = $this->input->post('user_mobile');
				$new_array['store_name'] = $this->input->post('store_name');
				$new_array['contact_person'] = $this->input->post('contact_person');
				$new_array['address'] = $this->input->post('address');
				$new_array['country'] = $this->input->post('country');
				$new_array['governorate'] = $this->input->post('governorate');
				$new_array['city'] = $this->input->post('city');
				$new_array['zip_code'] = $this->input->post('zip_code');
				$new_array['business_website'] = $this->input->post('business_website');
				$new_array['status'] = $this->input->post('status');

				if ($file_name != '') {
					$config['upload_path'] = './upload/';
					$config['file_name'] = time() . $file_name;
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$this->upload->initialize($config);
					if (!$this->upload->do_upload('logo')) {
						echo ($this->upload->display_errors());
					} else {
						$data = $this->upload->data();
						$new_array['logo'] = $data['file_name'];
					}
				}
				$val = $this->provider_model->providerlist_update($new_array, $id);
				if ($val) {
					redirect(base_url('providerlist/?success=Update successfully!'));
				} else {
					redirect(base_url('providerlist/?success= Update successfully!'));
				}
			} else {
				$error = validation_errors();
				redirect(base_url('providerlist/?error=' . $error));
			}
		}
	}
	private function get_current_provider_plan($provider_id) {
		$current_plan = $this->Provider_plan_model->get_current_plan_by_provider($provider_id);
		if ($current_plan) {
			$current_plan->plan = $this->Plan_model->get_plan_by_id($current_plan->plan_id)[0];
			$current_plan->end_date = $this->add_months_to_date($current_plan->created_at, $current_plan->plan->frequency);
			if (strtotime(date("Y-m-d H:i:s")) > strtotime($current_plan->end_date)) {
				$current_plan->status = "expired";
			}

			return $current_plan;
		}
		return false;
	}
	private function add_months_to_date($date, $months) {
		return date("Y-m-d H:i:s", strtotime($months . " month", strtotime($date)));
	}

}
?>