<?php
ob_start();
class Membership extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->library('upload');
		$this->load->helper(array('form', 'url'));
		$this->load->library(['ion_auth', 'form_validation']);
		$this->load->helper(['url', 'language']);
		$this->load->model('Membership_model', 'membership');
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
		$this->data['rec'] = $this->membership->membership_manage();
		$this->data['rel'] = $this->membership->membership_rel_manage();
		$this->data['title'] = 'Manage Membership details';
		$this->load->view('membership_manage', $this->data);
	}
	public function membership_request() {
		$this->data['st'] = $this->membership->membership_st_manage();
		$this->data['title'] = 'Manage Membership request ';
		$this->load->view('membership_request_manage', $this->data);
	}
	public function membership_setting() {
		$this->data['rec'] = $this->membership->membership_manage();
		$this->data['rel'] = $this->membership->membership_rel_manage();
		$this->data['fet'] = $this->membership->membership_features_manage();
		$this->data['title'] = 'Manage Membership Settings ';
		$this->load->view('membershipsetting_manage', $this->data);
	}
	public function membership_features() {
		$this->data['rec'] = $this->membership->membership_features_manage();
		$this->data['title'] = 'Manage Membership Features ';
		$this->load->view('memberships_features_manage', $this->data);
	}
	public function add_membership() {
		if ($this->input->post()) {

			$rules = array(
				array(
					'field' => 'name',
					'label' => 'Name',
					'rules' => 'trim|required',
				),
			);

			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {

				$new_array['name'] = $this->input->post('name');
				$new_array['name_ar'] = $this->input->post('name_ar');

				$result = $this->membership->add_membership($new_array);

				if ($result) {
					$new_data = array();
					$ct = count($this->input->post('details'));

					for ($i = 0; $i < $ct; $i++) {

						$new_data['details'] = $this->input->post('details')[$i];
						$new_data['details_ar'] = $this->input->post('details_ar')[$i];
						$new_data['benefit_id'] = $result;

						$rec = $this->membership->add_membership_rel($new_data);
					}
				}

				if ($result) {
					redirect(base_url('membership/?success=Add  successfully!'));
				} else {
					redirect(base_url('membership/?error=Some error!'));
				}
			} else {
				$error = validation_errors();
				redirect(base_url('membership/?error=' . $error));
			}
		}
		$this->data['title'] = 'Add Member ship';
		$this->load->view('add_membership', $this->data);
	}

	public function membership_del($id) {
		$id = $this->membership->membership_del($id);
		if ($id) {
			redirect(base_url('membership/?success= Delete successfully!'));
		} else {
			redirect(base_url('membership/?error=Some error!'));
		}
	}
	public function membership_request_del($id) {
		$id = $this->membership->membership_request_del($id);
		if ($id) {
			redirect(base_url('membership/membership_request/?success= Delete successfully!'));
		} else {
			redirect(base_url('membership/membership_request/?error=Some error!'));
		}
	}
	public function edit_membership($id) {
		$data['rec'] = $this->membership->edit_membership($id);
		$data['title'] = 'Edit Member ship';
		$this->load->view('edit_membership', $data);
	}

	public function membership_update() {

		$id = $this->input->post('id');
		if ($this->input->post()) {
			$rules = array(
				array(
					'field' => 'name',
					'label' => 'Name',
					'rules' => 'trim|required',
				),
			);

			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {

				$new_array['name'] = $this->input->post('name');
				$new_array['name_ar'] = $this->input->post('name_ar');

				$val = $this->membership->membership_update($new_array, $id);

				$new_data = array();
				$ct = count($this->input->post('details'));
				for ($i = 0; $i < $ct; $i++) {
					$new_data['details'] = $this->input->post('details')[$i];
					$new_data['details_ar'] = $this->input->post('details_ar')[$i];
					$new_data['benefit_id'] = $id;
					// $error_id = $this->input->post('error_id')[$i];

					if (isset($this->input->post('error_id')[$i])) {

						$rec = $this->membership->edit_membership_rel($new_data, $this->input->post('error_id')[$i]);
					} else {

						$this->membership->add_membership_rel($new_data);
					}

				}

				if ($val) {
					redirect(base_url('membership/?success=Update  successfully!'));
				} else {
					redirect(base_url('membership/?success=Update  successfully!'));
				}
			} else {
				// $error = validation_errors();
				redirect(base_url('membership/edit_membership/' . $id . '?error=' . $error));
			}
		}
	}

	public function add_ajax_details() {

		$this->load->view('ajax_error_details');

	}

	public function delete_membership_rel_solution() {

		$id = $this->input->post('id');

		echo $this->membership->delete_membership_rel_solution($id);
	}

	public function edit_membership_features($id) {
		$data['rec'] = $this->membership->edit_membership_fet($id);
		$data['title'] = 'Edit Member ship Features';
		$this->load->view('edit_membership_features', $data);
	}

	public function add_membership_features() {
		if ($this->input->post()) {

			$rules = array(
				array(
					'field' => 'name',
					'label' => 'Name',
					'rules' => 'trim|required',
				),
			);

			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				$file_name = $_FILES['image']['name'];
				$new_array['name'] = $this->input->post('name');
				$new_array['price'] = $this->input->post('price');
				$new_array['duration'] = $this->input->post('duration');
				$new_array['msg_en'] = $this->input->post('msg_en');
				$new_array['msg_ar'] = $this->input->post('msg_ar');
				date_default_timezone_set('Egypt');
				$new_array['created_date'] = date("Y-m-d");

				if ($file_name != '') {
					$config['upload_path'] = './upload/';
					$config['file_name'] = time() . $file_name;
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$this->upload->initialize($config);
					if (!$this->upload->do_upload('image')) {
						echo ($this->upload->display_errors());
					} else {
						$data = $this->upload->data();
						$new_array['image'] = $data['file_name'];
					}
				}
				$result = $this->membership->add_membership_features($new_array);
				if ($result) {
					redirect(base_url('membership/membership_features/?success=Add  successfully!'));
				} else {
					redirect(base_url('membership/membership_features/?error=Some error!'));
				}
			} else {
				$error = validation_errors();
				redirect(base_url('membership/membership_features/?error=' . $error));
			}
		}
		$this->data['title'] = 'Add';
		$this->load->view('add_membership_features', $this->data);
	}

	public function membership_features_update() {

		$id = $this->input->post('id');
		if ($this->input->post()) {

			$file_name = $_FILES['image']['name'];
			$new_array['name'] = $this->input->post('name');
			$new_array['price'] = $this->input->post('price');
			$new_array['duration'] = $this->input->post('duration');
			$new_array['msg_en'] = $this->input->post('msg_en');
			$new_array['msg_ar'] = $this->input->post('msg_ar');
			if ($file_name != '') {
				$config['upload_path'] = './upload/';
				$config['file_name'] = time() . $file_name;
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$this->upload->initialize($config);
				if (!$this->upload->do_upload('image')) {
					echo ($this->upload->display_errors());
				} else {
					$data = $this->upload->data();
					$new_array['image'] = $data['file_name'];
				}
			}

			$val = $this->membership->membership_fet_update($new_array, $id);

			if ($val) {
				redirect(base_url('membership/membership_features/?success=Update  successfully!'));
			} else {
				redirect(base_url('membership/membership_features/?success=Update  successfully!'));
			}

		}
	}

	public function membership_features_del($id) {
		$id = $this->membership->membership_features_del($id);
		if ($id) {
			redirect(base_url('membership/membership_features/?success= Delete successfully!'));
		} else {
			redirect(base_url('membership/membership_features/?error=Some error!'));
		}
	}
	public function approve($id) {
		$this->membership->approve_membership($id);
		redirect(base_url('membership/membership_request?success=updated  successfully!'));
	}
	public function reject($id) {
		$this->membership->reject_membership($id);
		redirect(base_url('membership/membership_request?success=updated  successfully!'));
	}

	public function membership_setting_update() {
		$this->membership->reset_membership();

		$new_array = array();
		$data = $this->input->post('data');
		foreach ($data as $membership_id => $benifits) {
			foreach ($benifits as $benefit_id => $value) {
				$this->membership->membership_setting_update(["membership_id" => $membership_id, "benefit_id" => $benefit_id]);
			}
		}
		redirect(base_url('membership/membership_setting/?success=Update  successfully!'));

	}

	public function edit_memberships_users($id) {
		$data['rec'] = $this->membership->edit_memberships_users($id);
		$data['title'] = 'Edit Member ship';
		$this->load->view('edit_memberships_users', $data);
	}

	public function memberships_users_update() {

		$id = $this->input->post('id');
		if ($this->input->post()) {
			$rules = array(
				array(
					'field' => 'address',
					'label' => 'address',
					'rules' => 'trim|required',
				),
			);

			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				$file_name = $_FILES['nid_front']['name'];
				$file_name = $_FILES['nid_rear']['name'];
				$file_name = $_FILES['licence_front']['name'];
				$file_name = $_FILES['licence_rear']['name'];
				$new_array['address'] = $this->input->post('address');
				$new_array['nid'] = $this->input->post('nid');
				$new_array['status'] = $this->input->post('status');

				if ($file_name != '') {
					$config['upload_path'] = './upload/';
					$config['file_name'] = time() . $file_name;
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$this->upload->initialize($config);
					if (!$this->upload->do_upload('nid_front')) {
						echo ($this->upload->display_errors());
					} else {
						$data = $this->upload->data();
						$new_array['nid_front'] = $data['file_name'];
					}
				}
				if ($file_name != '') {
					$config['upload_path'] = './upload/';
					$config['file_name'] = time() . $file_name;
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$this->upload->initialize($config);
					if (!$this->upload->do_upload('nid_rear')) {
						echo ($this->upload->display_errors());
					} else {
						$data = $this->upload->data();
						$new_array['nid_rear'] = $data['file_name'];
					}
				}
				if ($file_name != '') {
					$config['upload_path'] = './upload/';
					$config['file_name'] = time() . $file_name;
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$this->upload->initialize($config);
					if (!$this->upload->do_upload('licence_front')) {
						echo ($this->upload->display_errors());
					} else {
						$data = $this->upload->data();
						$new_array['licence_front'] = $data['file_name'];
					}
				}
				if ($file_name != '') {
					$config['upload_path'] = './upload/';
					$config['file_name'] = time() . $file_name;
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$this->upload->initialize($config);
					if (!$this->upload->do_upload('licence_rear')) {
						echo ($this->upload->display_errors());
					} else {
						$data = $this->upload->data();
						$new_array['licence_rear'] = $data['file_name'];
					}
				}

				$val = $this->membership->memberships_users_update($new_array, $id);

				if ($val) {
					redirect(base_url('membership/membership_request/?success=Update  successfully!'));
				} else {
					redirect(base_url('membership/membership_request/?success=Update  successfully!'));
				}
			} else {
				// $error = validation_errors();
				redirect(base_url('membership/membership_request/edit_membership/' . $id . '?error=' . $error));
			}
		}
	}

	public function states() {
		$this->data['rec'] = $this->membership->states_manage();
		$this->data['title'] = 'State details';
		$this->load->view('states_manage', $this->data);
	}

	public function add_states() {
		if ($this->input->post()) {

			$data = array(
				'name' => $this->input->post('name'),
				'name_ar' => $this->input->post('name_ar'),
			);
			$result = $this->membership->add_states($data);
			if ($result == false) {
				redirect(base_url('membership/add_states/?error=error!'));

			} else {
				redirect(base_url('membership/states/?success=Add  successfully!'));
			}

		}
		$this->data['title'] = 'Add State';
		$this->load->view('add_states', $this->data);

	}

	public function states_del($id) {
		$id = $this->membership->states_del($id);
		if ($id) {
			redirect(base_url('membership/states/?success= Delete successfully!'));
		} else {
			redirect(base_url('membership/states/?error=Some error!'));
		}
	}

	public function edit_states($id) {
		$data['rec'] = $this->membership->edit_states($id);
		$data['title'] = 'Edit State';
		$this->load->view('edit_states', $data);
	}

	public function states_update() {

		$id = $this->input->post('id');
		if ($this->input->post()) {

			$new_array['name'] = $this->input->post('name');
			$new_array['name_ar'] = $this->input->post('name_ar');

			$val = $this->membership->states_update($new_array, $id);

			if ($val) {
				redirect(base_url('membership/states/?success=Update  successfully!'));
			} else {
				redirect(base_url('membership/states/?error=Some error!'));
			}

		}
	}

	public function cities() {
		$this->data['rec'] = $this->membership->cities_manage();
		$this->data['states'] = $this->membership->states_manage();
		$this->data['title'] = 'Cities details';
		$this->load->view('cities_manage', $this->data);
	}

	public function add_cities() {
		if ($this->input->post()) {

			$data = array(
				'name' => $this->input->post('name'),
				'name_ar' => $this->input->post('name_ar'),
				'state_id' => $this->input->post('state_id'),
			);
			$result = $this->membership->add_cities($data);
			if ($result == false) {
				redirect(base_url('membership/add_cities/?error=error!'));

			} else {
				redirect(base_url('membership/cities/?success=Add  successfully!'));
			}

		}
		$this->data['states'] = $this->membership->states_manage();
		$this->data['title'] = 'Add State';
		$this->load->view('add_cities', $this->data);

	}

	public function cities_del($id) {
		$id = $this->membership->cities_del($id);
		if ($id) {
			redirect(base_url('membership/cities/?success= Delete successfully!'));
		} else {
			redirect(base_url('membership/cities/?error=Some error!'));
		}
	}

	public function edit_cities($id) {
		$data['rec'] = $this->membership->edit_cities($id);
		$data['states'] = $this->membership->states_manage();
		$data['title'] = 'Edit State';
		$this->load->view('edit_cities', $data);
	}

	public function cities_update() {

		$id = $this->input->post('id');
		if ($this->input->post()) {

			$new_array['name'] = $this->input->post('name');
			$new_array['name_ar'] = $this->input->post('name_ar');
			$new_array['state_id'] = $this->input->post('state_id');

			$val = $this->membership->cities_update($new_array, $id);

			if ($val) {
				redirect(base_url('membership/cities/?success=Update  successfully!'));
			} else {
				redirect(base_url('membership/cities/?error=Some error!'));
			}

		}
	}
}