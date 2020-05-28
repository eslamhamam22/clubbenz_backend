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
		$this->data['title'] = 'Memberships Manage';
		$this->load->view('membership_manage', $this->data);
	}
	public function membership_setting() {
		$this->data['rec'] = $this->membership->membership_manage();
		$this->data['rel'] = $this->membership->membership_rel_manage();
		$this->data['fet'] = $this->membership->membership_features_manage();
		$this->data['title'] = 'Memberships Setting Manage';
		$this->load->view('membershipsetting_manage', $this->data);
	}
	public function membership_features() {
		$this->data['rec'] = $this->membership->membership_features_manage();
		$this->data['title'] = 'Memberships Features Manage';
		$this->load->view('memberships_features_manage', $this->data);
	}
	public function add_membership() {
		if ($this->input->post()) {

			$rules = array(
				array(
					'field' => 'benefit',
					'label' => 'Benefit',
					'rules' => 'trim|required',
				),
			);

			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {

				$new_array['benefit'] = $this->input->post('benefit');

				$result = $this->membership->add_membership($new_array);

				if ($result) {
					$new_data = array();
					$ct = count($this->input->post('details'));

					for ($i = 0; $i < $ct; $i++) {

						$new_data['details'] = $this->input->post('details')[$i];
						$new_data['membership_id'] = $result;

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
					'field' => 'benefit',
					'label' => 'Benefit',
					'rules' => 'trim|required',
				),
			);

			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {

				$new_array['benefit'] = $this->input->post('benefit');

				$val = $this->membership->membership_update($new_array, $id);

				$new_data = array();
				$ct = count($this->input->post('details'));
				for ($i = 0; $i < $ct; $i++) {

					$new_data['details'] = $this->input->post('details')[$i];
					$new_data['membership_id'] = $id;
					$error_id = $this->input->post('error_id')[$i];

					if (!empty($error_id)) {

						$rec = $this->membership->edit_membership_rel($new_data, $error_id);

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
				$error = validation_errors();
				redirect(base_url('membership/edit_membership/' . $id . '?error=' . $error));
			}
		}
	}

	public function membership_setting_update() {
//
		$id = $this->input->post('id');
		print_r($_POST);

		$new_array['gold'] = $this->input->post('gold');
		$new_array['platinum'] = $this->input->post('platinum');

		$val = $this->membership->membership_update($new_array, $id);

		echo $val;
		if ($val) {
			// redirect(base_url('membership/membership_setting/?success=Update  successfully!'));
		} else {
			// redirect(base_url('membership/membership_setting/?success=Update  successfully!'));
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

	public function membership_features_update() {

		$id = $this->input->post('id');
		if ($this->input->post()) {

			$file_name = $_FILES['gold_image']['name'];
			$pla_image = $_FILES['platinum_image']['name'];
			$new_array['price'] = $this->input->post('price');
			$new_array['platinum_price'] = $this->input->post('platinum_price');
			if ($file_name != '') {
				$config['upload_path'] = './upload/';
				$config['file_name'] = time() . $file_name;
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$this->upload->initialize($config);
				if (!$this->upload->do_upload('gold_image')) {
					echo ($this->upload->display_errors());
				} else {
					$data = $this->upload->data();
					$new_array['gold_image'] = $data['file_name'];
				}
			}
			if ($pla_image != '') {
				$config['upload_path'] = './upload/';
				$config['file_name'] = time() . $pla_image;
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$this->upload->initialize($config);
				if (!$this->upload->do_upload('platinum_image')) {
					echo ($this->upload->display_errors());
				} else {
					$data = $this->upload->data();
					$new_array['platinum_image'] = $data['file_name'];
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
}