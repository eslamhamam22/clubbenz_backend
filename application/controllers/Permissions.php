<?php
class Permissions extends MY_Controller {
	public $data;
	function __construct() {
		parent::__construct();
		$this->load->model('acl_model');
		$this->load->model('Classes_model', 'classes');
		$this->load->model('Years_model');
		$this->load->model('Fuel_model');
		$this->load->model('Users_model');
		$this->load->model('Car_model');
		$this->load->library(['ion_auth', 'form_validation']);
		$this->load->model('Chassis_model');
		$this->load->library('upload');
		error_reporting(0);

		if ($this->input->get('error')) {
			$this->data['error'] = $this->input->get('error');
		}
		if ($this->input->get('success')) {
			$this->data['success'] = $this->input->get('success');
		}
	}

	public function index() {
		$this->data['groups'] = $this->acl_model->get_all_groups();
		$this->load->view('groups', $this->data);
	}

	public function user_manage() {
		$this->data['rec'] = $this->acl_model->get_all_users();
		$this->data['groups'] = $this->acl_model->get_all_groups();
		$this->load->view('user_manage', $this->data);
	}

	public function cars() {
		$class_id = $this->input->post('class_id');
		$fuel_id = $this->input->post('fuel_id');
		$year_id = $this->input->post('year_id');
		$chassis = $this->input->post('chassis_id');
		$year = $this->Years_model->get_year_by_id($year_id);

		echo $this->Car_model->get_cars($fuel_id, $year, $class_id, $chassis);

		return;
	}

	public function add_user() {
		if ($this->input->post()) {
			$save_data = $this->input->post();
			$rules = array(
				array(
					'field' => 'email',
					'label' => 'Email',
					'rules' => 'trim|required|valid_email',
				),
				array(
					'field' => 'first_name',
					'label' => 'Firstname',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'last_name',
					'label' => 'Lastname',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'password',
					'label' => 'Password',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'phone',
					'label' => 'Phone',
					'rules' => 'trim|required',
				),
			);
			$this->form_validation->set_error_delimiters('', '');
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				if ($this->Users_model->check_user_by_email($save_data['email'])) {
					if (isset($_FILES['profile_picture']) && !empty($_FILES['profile_picture'])) {
						$filename = $_FILES['profile_picture']['name'];
						if ($filename != "") {
							$config['upload_path'] = './upload/profile_picture';
							$config['file_name'] = time() . $filename;
							$config['allowed_types'] = 'gif|jpg|png|jpeg|JPG|PNG';
							$this->upload->initialize($config);
							if (!$this->upload->do_upload('profile_picture')) {
								$arr['error_picture'] = $this->upload->display_errors();
							} else {
								$data = $this->upload->data();
								$new_array['profile_picture'] = $data['file_name'];
							}
						}
					}
					$chassis = $this->Users_model->get_chassis_by_car_vin_prefix($save_data['car_vin_prefix']);
					$additional_detail = array(
						"first_name" => $save_data['first_name'],
						"last_name" => $save_data['last_name'],
						"phone" => $save_data['phone'],
						"model_id" => $save_data['model_id'],
						"car_type_id" => $save_data['car_type_id'],
						"car_vin_prefix" => $save_data['car_vin_prefix'],
						"year_id" => $save_data['year_id'],
						"profile_picture" => $new_array['profile_picture'] ? $new_array['profile_picture'] : "",
						//"app_type" 		=> $save_data['app_type'],
						//"fcm_token"		=> $this->post("fcm_token"),
						//"social_id"		=> $this->post("social_id"),
						"created_date" => date("Y-m-d"),
						"chassis" => $chassis,
					);
					$userID = $this->ion_auth->register($save_data['email'], $save_data['password'], $save_data['email'], $additional_detail, array(2));
					if ($userID) {
						$save_data['user_id'] = $userID;
						$this->acl_model->update_user_group($save_data);
						redirect(base_url('permissions/user_manage?success=User Added successfully!'));
					} else {
						redirect(base_url('permissions/user_manage?error=Some error!'));
					}
				} else {
					redirect(base_url('permissions/user_manage?error=User already exist!'));
				}
			} else {
				$error = validation_errors();
				$this->data['error'] = $error;
			}
		}
		$this->data['groups'] = $this->acl_model->get_all_groups();
		$this->data['model'] = $this->classes->model_manage();
		$this->data['years'] = $this->Years_model->year_manage();
		$this->data['fuel_types'] = $this->Fuel_model->fuel_manage();
		$this->data['chassis'] = $this->Users_model->get_all_chassis();
		$this->load->view('add_user', $this->data);
	}

	public function update_usergroup() {
		if ($this->input->post()) {
			$save_data = $this->input->post();
			$rules = array(
				array(
					'field' => 'email',
					'label' => 'Email',
					'rules' => 'trim|required|valid_email',
				),
				array(
					'field' => 'first_name',
					'label' => 'Firstname',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'last_name',
					'label' => 'Lastname',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'phone',
					'label' => 'Phone',
					'rules' => 'trim|required',
				),
			);
			$this->form_validation->set_error_delimiters('', '');
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				$user_id = $this->input->post('user_id');
				if ($this->Users_model->check_email_by_user_id($save_data['email'], $user_id)) {
					if (isset($_FILES['profile_picture']) && !empty($_FILES['profile_picture'])) {
						$filename = $_FILES['profile_picture']['name'];
						if ($filename != "") {
							$config['upload_path'] = './upload/profile_picture';
							$config['file_name'] = time() . $filename;
							$config['allowed_types'] = 'gif|jpg|png|jpeg|JPG|PNG';
							$this->upload->initialize($config);
							if (!$this->upload->do_upload('profile_picture')) {
								$arr['error_picture'] = $this->upload->display_errors();
							} else {
								$data = $this->upload->data();
								$new_array['profile_picture'] = $data['file_name'];
							}
						}
					}
					$car_vin_prefix = $this->Users_model->get_car_vin_prefix($save_data['car_id']);

					$additional_detail = array(
						"first_name" => $save_data['first_name'],
						"last_name" => $save_data['last_name'],
						"phone" => $save_data['phone'],
						"model_id" => $save_data['model_id'],
						"car_type_id" => $save_data['car_type_id'],
						"car_vin_prefix" => $car_vin_prefix && $car_vin_prefix->vin_prefix ? $car_vin_prefix->vin_prefix : '',
						"year_id" => $save_data['year_id'],
						//"profile_picture" => $new_array['profile_picture'] ? $new_array['profile_picture'] : "",
						//"app_type" 		=> $save_data['app_type'],
						//"fcm_token"		=> $this->post("fcm_token"),
						//"social_id"		=> $this->post("social_id"),
						//"created_date"	=> date("Y-m-d"),
						"chassis" => $save_data['chassis_id'],
					);

					if (isset($new_array['profile_picture']) && $new_array['profile_picture'] != "") {
						$additional_detail['profile_picture'] = $new_array['profile_picture'];
					}

					$result = $this->acl_model->update_user_details($additional_detail, $user_id);
					//$userID = $this->ion_auth->register($save_data['email'], $save_data['password'],$save_data['email'],$additional_detail, array(2));
					if ($result) {
						$save_data['user_id'] = $user_id;
						$this->acl_model->update_user_group($save_data);
						redirect(base_url() . "permissions/user_manage?success=User details updated successfully");
					} else {
						redirect(base_url('permissions/user_manage?error=Some error!'));
					}
				} else {
					redirect(base_url('permissions/user_manage?error=User already exist!'));
				}
			} else {
				$error = validation_errors();
				$this->data['error'] = $error;
			}
		}
	}

	public function user_update($id) {
		$this->data['rec'] = $this->acl_model->user_data($id);
		$this->data['groups'] = $this->acl_model->get_all_groups();
		$this->data['model'] = $this->classes->model_manage();
		$this->data['years'] = $this->Years_model->year_manage();
		$this->data['fuel_types'] = $this->Fuel_model->fuel_manage();
		$this->data['chassis'] = $this->Users_model->get_all_chassis();
		$this->load->view('user_update', $this->data);
	}

	public function user_del($id) {
		$id = $this->acl_model->user_del($id);
		if ($id) {
			redirect(base_url('permissions/user_manage?success=User delete successfully!'));
		} else {
			redirect(base_url('permissions/user_manage?error=Some error!'));
		}

	}
	public function add_permission_function() {
		if ($this->input->post()) {
			$this->_add_permissions_functions($_REQUEST);
		}
	}
	/** To populate permission table */
	public function hidden_permissions() {
		$data = array();
		$this->load->library('controllerlist');
		$view_role['all_roles_permissions'] = $this->controllerlist->getControllers();
		foreach ($view_role['all_roles_permissions'] as $controllers => $methodlist_array) {
			foreach ($methodlist_array as $methodlist) {
				$data = array(
					'controller' => $controllers,
					'action' => $methodlist,
					'name' => $methodlist,
				);
				$check_role = $this->acl_model->check_permissions($data['controller'], $data['action']);
				if ($check_role) {
					$this->acl_model->save_permission($data);
				}
			}
		}
	}

	public function add_groups() {
		if ($this->input->post()) {
			$this->_add_groups($_REQUEST);
		}
	}

	public function delete_group($id) {
		$row = $this->acl_model->unlink_group($id);
		if ($row) {
			redirect(base_url() . "permissions/index?success=Group deleted successfully");
		} else {
			redirect(base_url() . "permissions/index?error=some error");
		}
	}

	public function update_group() {
		if ($this->input->post()) {
			$this->_update_group($_REQUEST);
		}
	}

	public function group_base_permissions() {

		$this->data['group_id'] = $this->input->get('group_id') ? $this->input->get('group_id') : "";
		$this->data['groups'] = $this->acl_model->permissioned_groups();
		$this->data['permissions'] = $this->acl_model->get_all_permissions();
		$this->data['group_permissions'] = $this->acl_model->get_groups_permissions_ids($this->input->get('group_id'));
		//$this->data['view']="group_base_permissions";
		$this->load->view('group_base_permissions', $this->data);

	}

	public function set_group_permissions() {
		if ($this->input->post('groups')) {
			$data = array();
			$data['group_id'] = $this->input->post('groups');
			if ($this->input->post('permissions')) {
				$data['permission_id'] = $this->input->post('permissions');
			}
			if ($this->acl_model->set_groups_permissions($data)) {
				redirect(base_url() . "permissions/group_base_permissions?group_id=" . $data['group_id'] . "&success=Group Updated Successfully");
			} else {
				redirect(base_url() . "permissions/group_base_permissions?error=Some error");
			}
		} else {
			redirect(base_url() . "permissions/group_base_permissions?error=Some error");
		}
	}

	private function _add_permissions_functions($save_data) {
		$rules = array(
			array(
				'field' => 'module',
				'label' => 'Module',
				'rules' => 'trim|required',
			),
			array(
				'field' => 'controller',
				'label' => 'Controller',
				'rules' => 'trim|required',
			),
			array(
				'field' => 'function',
				'label' => 'Function',
				'rules' => 'trim|required',
			),
			array(
				'field' => 'name',
				'label' => 'Name',
				'rules' => 'trim|required',
			),
		);
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run()) {
			$data = array(
				"module" => $save_data['module'],
				"controller" => $save_data['controller'],
				"action" => $save_data['function'],
				"name" => $save_data['name'],
				"description" => $save_data['description'],
				"availability" => $save_data['permission_status'],
			);
			if ($save_data['parent_id']) {
				$data['parent_id'] = $save_data['parent_id'];
			}
			$id = $this->acl_model->add_permission($data);
			if ($id) {
				redirect(base_url() . "permissions/group_base_permissions?success=permissions added successfully");
			} else {
				redirect(base_url() . "permissions/group_base_permissions?error=permissions not added");
			}
		}
	}

	private function _add_groups($save_data) {
		$rules = array(
			array(
				'field' => 'name',
				'label' => 'Name',
				'rules' => 'trim|required',
			),
		);
		//"created_by"		=> $this->ion_auth->user()->row()->id,
		//"updated_by"		=> $this->ion_auth->user()->row()->id,
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run()) {
			$data = array(
				"name" => $save_data['name'],
				"description" => $save_data['description'],
				"check_permission" => $save_data['check_permission'] ? $save_data['check_permission'] : "off",
				//"redirect"			=> $save_data['redirect'],
				//"isdel"				=> '0'
			);
			$id = $this->acl_model->add_groups($data);
			if ($id) {
				redirect(base_url() . "permissions/index?success=Group added successfully");
			} else {
				redirect(base_url() . "permissions/index?error=some errors");
			}
		}
	}

	private function _update_group($save_data) {
		if ($save_data['check_permission'] == "") {
			$save_data['check_permission'] = "off";
		}
		$rules = array(
			array(
				'field' => 'name',
				'label' => 'Name',
				'rules' => 'trim|required',
			),
		);
		//"created_by"		=> $this->ion_auth->user()->row()->id,
		//"updated_by"		=> $this->ion_auth->user()->row()->id,
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run()) {
			$data = array(
				"name" => $save_data['name'],
				"description" => $save_data['description'],
				"check_permission" => $save_data['check_permission'] ? $save_data['check_permission'] : "off",
				//"redirect" 			=> $save_data['redirect']
			);
			if ($this->acl_model->update_group($save_data['group_id'], $data)) {
				redirect(base_url() . "permissions/index?success=Group updated successfully");
			} else {
				redirect(base_url() . "permissions/index?error=some error");
			}
		}
	}
}
