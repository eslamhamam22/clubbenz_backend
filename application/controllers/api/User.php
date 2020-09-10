<?php require APPPATH . '/libraries/REST_Controller.php';
class User extends REST_Controller {
	public $data;
	function __construct() {
		parent::__construct();
		$this->load->model('Users_model');
		$this->load->model('Emailtemplates_model');
		$this->load->model('Cars_model');
		$this->load->library('upload');
		$this->load->library(['ion_auth', 'form_validation']);
		$this->load->model('Push_notification_model', 'notification');
		$this->load->database();
		$this->load->library('email');
		$this->load->model('Serviceshop_model');
		$this->load->model('Workshop_model');
		$this->load->model('Partsshop_model');
		$this->load->model('Service_tag_model');
		define('FIREBASE_API_KEY', 'AAAAFGlvySM:APA91bEGYmrBnqQ42KtKRTZUhwNQBD7VXifw1JDOTfAkUcrFnhRz3TQ-0duk4bFqqCdjubuv0gBNvbivDA0SK5Ydl3S6oy7HebFPRIRj-R0IWKsuqq2EMTcExpDtEZH3nj3qfWmuq7qD');
	}
	function get_notifications_get() {
		$id = $this->get('id');
		$arr = $this->notification->get_notifications_limit_10($id);

		foreach ($arr as $val) {
			if ($val->shop_type == "workshop") {
				$val->shop_details = $this->Workshop_model->get_workshops_detail($val->shop_id);
			} elseif ($val->shop_type == "partsshop") {
				$val->shop_details = $this->Partsshop_model->get_details($val->shop_id);
			} elseif ($val->shop_type == "serviceshop") {
				$val->shop_details = $this->Serviceshop_model->get_details($val->shop_id);
			} else {
				$val->shop_details = null;
			}

		}

		$this->response($arr, 200);
	}

	public function login_post() {
		if ($this->post()) {
			$arr = $this->_login($this->post());
		} else {
			$arr['message'] = "Please provide username and password to login";
			$arr['success'] = false;
		}
		$this->response($arr, 200);
	}

	public function changepassword_post() {
		if ($this->post()) {
			$arr = $this->_changepassowrd($this->post());
		} else {
			$arr['message'] = "Please provide token";
			$arr['success'] = false;
		}
		$this->response($arr, 200);
	}

	public function fb_login_post() {
		if ($this->post()) {
			$arr = $this->_login_fb($this->post());
		} else {
			$arr['message'] = "Please provide username and password to login";
			$arr['success'] = false;
		}
		$this->response($arr, 200);
	}

	public function resend_code_post() {
		$phone = $this->input->post('phone');
		if ($phone) {
			$user = $this->users_model->get_user_by_mobile($phone);
			if ($user) {
				$verification_code = rand(100000, 999999);
				$this->send_code($verification_code, $phone);

				$this->users_model->update($user->id, array("verification_code" => $verification_code, "verification_phone" => 0));
				$arr['message'] = "Code send successfully";
				$arr['success'] = true;

			} else {
				$arr['message'] = "User Not exist";
				$arr['success'] = false;
			}

		} else {
			$arr['message'] = "Please Provide Phone Number";
			$arr['success'] = false;
		}
		$this->response($arr, 200);
	}
	public function resend_code_email_post() {
		$phone = $this->input->post('phone');
		$code = $this->input->post('code');
		if ($phone) {
			$user = $this->users_model->get_user_by_mobile($phone);
			if ($user) {
				$this->send_code($code, $phone);
				$this->send_email($user->email, $code);

				$arr['message'] = "Code send successfully";
				$arr['success'] = true;

			} else {
				$arr['message'] = "User Not exist";
				$arr['success'] = false;
			}

		} else {
			$arr['message'] = "Please Provide Phone Number";
			$arr['success'] = false;
		}
		$this->response($arr, 200);
	}
	public function forgotpassword_post() {
		if ($this->post()) {
			$arr = $this->_forgotpassword($this->post());
		} else {
			$arr['message'] = "Please provide Email";
			$arr['success'] = false;
		}
		$this->response($arr, 200);
	}

	public function logout_post() {
		if ($this->post()) {
			$arr = $this->_logout($this->post());
		} else {
			$arr['success'] = false;
			$arr['message'] = "Invalid request";
		}
		$this->response($arr, 200);
	}

	public function register_user_post() {
		if ($this->post()) {
			$arr = $this->_register_user($this->post());
			$this->response($arr, 200);
		}
	}

	public function activate_post() {
		$code = $this->input->post('verification_code');
		$token = $this->input->post('token');
		$mobile = $this->input->post('mobile');
		$email = $this->input->post('email');
		$result = $this->users_model->check_activation_code($code, $token, $mobile, $email);
		if ($result) {
			$arr['success'] = true;
			$arr['message'] = "Verified successfully";
		} else {
			$arr['success'] = false;
			$arr['message'] = "Invalid verification code";
		}
		$this->response($arr, 200);
	}

	public function booking_post() {
		$token = $this->input->post('token');
		if ($token) {
			$user_row = $this->users_model->get_user_by_token($token);

			$user_id = $user_row->id;
			$workshop_id = $this->post("workshop_id");
			if ($user_id) {
				$workshop_id = $this->post("workshop_id");
				$date = $this->post("date");
				$time = $this->post("time");
				$comments = $this->post("comments");

				$arr = array("user_id" => $user_id, "workshop_id" => $workshop_id, "date" => $date . " " . $time, "status" => "pending", "comments" => $comments, "created_date" => date('Y-m-d H:i'));
				$this->users_model->insert_in_table("booking", $arr);

				$arr['success'] = true;
				$arr['message'] = "Booking placed successfully";
			} else {
				$arr['success'] = true;
				$arr['message'] = "Invalid User";
			}
		} else {
			$arr['success'] = false;
			$arr['message'] = "Invalid verification code";
		}
		$this->response($arr, 200);
	}

	/////////////////////// Private Functions //////////////////////////////

	private function _login($data) {
		$rules = array(
			array(
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'trim|required',
			),
			array(
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'trim|required',
			),
		);
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run()) {
			$login_data = array(
				"email" => $data['email'],
				"password" => $data['password'],
			);
			$identity = $data['email'];
			$password = $data['password'];

			if ($this->ion_auth->login($identity, $password)) {
				$user = $this->users_model->get_user_by_email($data['email']);
				$token = $this->users_model->get_unique_user_token();

				$this->users_model->update($user->id, array("token" => $token, "fcm_token" => $this->post("fcm_token")));
				$user = $this->users_model->get_user_by_email($data['email']);

				$user->created_on = date("Y-m-d H:i", $user->created_on);

				$arr['year'] = $this->Cars_model->get_by_table_and_field_name("years", "id", $user->year_id);
				$arr['model'] = $this->Cars_model->get_by_table_and_field_name("model", "id", $user->model_id);
				$arr['car_type'] = $this->Cars_model->get_by_table_and_field_name("fuel_type", "id", $user->car_type_id);
				$arr['car'] = $this->Cars_model->get_by_table_and_field_name("cars", "vin_prefix", $user->car_vin_prefix);

				$arr['user'] = $user;
				$arr['success'] = true;
			} else {
				$arr['message'] = "Invalid Username and Password";
				$arr['success'] = false;
			}
		} else {
			$arr['message'] = validation_errors();
			$arr['success'] = false;
		}
		return $arr;
	}

	private function _login_fb($data) {
		$rules = array(
			array(
				'field' => 'social_id',
				'label' => 'Social id',
				'rules' => 'trim|required',
			),
		);
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run()) {
			if ($user_row = $this->users_model->get_user_by_field('social_id', $data['social_id'])) {
				$token = $this->users_model->get_unique_user_token();
				$this->users_model->update($user_row->id, array("token" => $token, "fcm_token" => $this->post("fcm_token")));
				$user_row = $this->users_model->get_user_by_field('social_id', $data['social_id']);
				$user_row->created_on = date("Y-m-d H:i", $user_row->created_on);
				$arr['year'] = $this->Cars_model->get_by_table_and_field_name("years", "id", $user_row->year_id);
				$arr['model'] = $this->Cars_model->get_by_table_and_field_name("model", "id", $user_row->model_id);
				$arr['car_type'] = $this->Cars_model->get_by_table_and_field_name("fuel_type", "id", $user_row->car_type_id);
				$arr['car'] = $this->Cars_model->get_by_table_and_field_name("cars", "vin_prefix", $user_row->car_vin_prefix);

				$arr['user'] = $user_row;
				$arr['success'] = true;
			} else {
				$arr['message'] = "Your Facebook Id is not connected to any user yet , Please create a new account";
				$arr['success'] = false;
			}
		} else {
			$arr['message'] = validation_errors();
			$arr['success'] = false;
		}
		return $arr;
	}

	private function _logout($data) {
		$rules = array(
			array(
				'field' => 'token',
				'label' => 'Token',
				'rules' => 'trim|required',
			),
		);
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run()) {
			$result = $this->users_model->logout($login_data);
			if ($result) {
				$arr['success'] = true;
				$arr['message'] = "Logout successfully!";
			} else {
				$arr['message'] = "Invalid device or site ID!";
				$arr['success'] = false;
			}
		} else {
			$arr['message'] = validation_errors();
			$arr['success'] = false;
		}
		return $arr;
	}

	private function _register_user($save_data) {
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
		);

		if (isset($save_data['social_id']) && $save_data['social_id'] == '') {
			$rules[] = array(
				'field' => 'last_name',
				'label' => 'Lastname',
				'rules' => 'trim|required',
			);
			$rules[] = array(
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'trim|required',
			);
			$rules[] = array(
				'field' => 'mobile',
				'label' => 'Mobile',
				'rules' => 'trim|required',
			);
		}

		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules($rules);
		if (true) {
			$json = json_encode($save_data);
			$this->db->query("insert into data_logs(data) values('" . $json . "')");

			if (isset($save_data['social_id']) && $save_data['social_id'] != "") {
				$user_row = $this->users_model->get_user_by_field('social_id', $save_data['social_id']);
				if ($user_row) {
					/*$user_row->created_on	= date("Y-m-d H:i",$user_row->created_on);

						$arr['year']		= $this->Cars_model->get_by_table_and_field_name("years","id",$user_row->year_id);
						$arr['model']		= $this->Cars_model->get_by_table_and_field_name("model","id",$user_row->model_id);
						$arr['car_type']	= $this->Cars_model->get_by_table_and_field_name("fuel_type","id",$user_row->car_type_id);
					*/

					$arr['message'] = "Use different facebook profile for registering, the current user already exists";
					$arr['success'] = false;
				} else {
					if ($this->users_model->check_user_by_email($save_data['email']) && $this->users_model->check_user_by_phone($save_data['mobile'])) {
						$arr = array();
						$additional_detail = array();
						$new_array = array(
							"username" => ($save_data['email'] != '') ? $save_data['email'] : "",
							"first_name" => ($save_data['first_name'] != '') ? $save_data['first_name'] : "",
							"last_name" => ($save_data['last_name'] != '') ? $save_data['last_name'] : "",
							"email" => ($save_data['email'] != '') ? $save_data['email'] : "",
							"password" => ($save_data['password'] != '') ? $save_data['password'] : "",
							"phone" => ($save_data['mobile'] != '') ? $save_data['mobile'] : "",
						);

						$new_array['social_id'] = $save_data['social_id'];
						if ($save_data['fb_picture']) {

							$new_array['fb_picture'] = isset($save_data['fb_picture']) ? $save_data['fb_picture'] : "";
							$new_array['profile_picture'] = isset($save_data['fb_picture']) ? $save_data['fb_picture'] : "";
						}
						$additional_detail['social_id'] = $save_data['social_id'];

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
						$token = $this->users_model->get_unique_user_token();
						$verification_code = rand(100000, 999999);
						$save_data['password'] = ($save_data['password'] != '') ? $save_data['password'] : rand(100000, 999999);
						$chassis = $this->users_model->get_chassis_by_car_vin_prefix($save_data['car_vin_prefix']);
						$additional_detail = array(
							"username" => $save_data['first_name'] . $save_data['last_name'],
							"first_name" => $save_data['first_name'],
							"last_name" => $save_data['last_name'],
							"phone" => $save_data['mobile'],
							"token" => $token,
							"verification_code" => $verification_code,
							"model_id" => $save_data['model_id'],
							"car_type_id" => $save_data['car_type_id'],
							"car_vin_prefix" => $save_data['car_vin_prefix'],
							"year_id" => $save_data['year_id'],
							"profile_picture" => isset($new_array['profile_picture']) ? $new_array['profile_picture'] : "",
							"app_type" => $save_data['app_type'],
							"fcm_token" => $this->post("fcm_token"),
							"fb_picture" => $new_array['fb_picture'],
							"social_id" => $this->post("social_id"),
							"created_date" => date("Y-m-d"),
							"chassis" => $chassis,
						);
						$userID = $this->ion_auth->register($new_array['email'], $save_data['password'], $new_array['email'], $additional_detail, array(2));

						if ($userID) {
							$user = $this->users_model->get_user_by_id($userID);
							$this->send_code($verification_code, $user->phone);
							$arr['message'] = "Code sent successfully!";

							$arr["name"] = $user->first_name . " " . $user->last_name;
							$arr["verification_code"] = $verification_code;
							$arr["email"] = $user->email;

							//$result = $this->Emailtemplates_model->sendMail('verification',$arr);

							$arr['year'] = $this->Cars_model->get_by_table_and_field_name("years", "id", $user->year_id);
							$arr['model'] = $this->Cars_model->get_by_table_and_field_name("model", "id", $user->model_id);
							$arr['car_type'] = $this->Cars_model->get_by_table_and_field_name("fuel_type", "id", $user->car_type_id);
							$arr['car'] = $this->Cars_model->get_by_table_and_field_name("cars", "vin_prefix", $user->car_vin_prefix);

							$user->created_on = date("Y-m-d H:i", $user->created_on);

							$arr['message'] = "User registered successfully!";
							$arr['user'] = $user;
							$arr['success'] = true;
						} else {
							$arr['message'] = "Some Error try again later";
							$arr['success'] = false;
						}
					} else {
						$arr['message'] = "User already exist! please check email and mobile number";
						$arr['success'] = false;
					}
				}
			} else {
				if ($this->users_model->check_user_by_email($save_data['email']) && $this->users_model->check_user_by_phone($save_data['mobile'])) {

					$arr = array();
					$additional_detail = array();
					$new_array = array(
						"username" => ($save_data['email'] != '') ? $save_data['email'] : "",
						"first_name" => ($save_data['first_name'] != '') ? $save_data['first_name'] : "",
						"last_name" => ($save_data['last_name'] != '') ? $save_data['last_name'] : "",
						"email" => ($save_data['email'] != '') ? $save_data['email'] : "",
						"password" => ($save_data['password'] != '') ? $save_data['password'] : "",
						"phone" => ($save_data['mobile'] != '') ? $save_data['mobile'] : "",
					);
					$new_array['fb_picture'] = "";
					$new_array['profile_picture'] = "";
					if (isset($_FILES['profile_picture']) && !empty($_FILES['profile_picture'])) {
						$filename = $_FILES['profile_picture']['name'];
						if ($filename != "") {
							$config['upload_path'] = './upload/profile_picture';
							$config['file_name'] = time() . $filename;
							$config['allowed_types'] = 'gif|jpg|png|jpeg|JPG|PNG';
							$this->upload->initialize($config);
							if (!$this->upload->do_upload('profile_picture')) {
								$arr['error_picture'] = $this->upload->display_errors();
								$new_array['profile_picture'] = $arr['error_picture'];
							} else {
								$data = $this->upload->data();
								$new_array['profile_picture'] = $data['file_name'];
							}
						}
					}
					$token = $this->users_model->get_unique_user_token();
					$verification_code = rand(100000, 999999);
					$save_data['password'] = ($save_data['password'] != '') ? $save_data['password'] : rand(100000, 999999);
					$chassis = $this->users_model->get_chassis_by_car_vin_prefix($save_data['car_vin_prefix']);
					$additional_detail = array(
						"first_name" => $save_data['first_name'],
						"last_name" => $save_data['last_name'],
						"phone" => $save_data['mobile'],
						"token" => $token,
						"verification_code" => $verification_code,
						"model_id" => $save_data['model_id'],
						"car_type_id" => $save_data['car_type_id'],
						"car_vin_prefix" => $save_data['car_vin_prefix'],
						"year_id" => $save_data['year_id'],
						"profile_picture" => $new_array['profile_picture'] ? $new_array['profile_picture'] : "",
						"app_type" => $save_data['app_type'],
						"fcm_token" => $this->post("fcm_token"),
						"fb_picture" => "",
						"created_date" => date("Y-m-d"),
						"chassis" => $chassis,
					);
					$userID = $this->ion_auth->register($new_array['email'], $save_data['password'], $new_array['email'], $additional_detail, array(2));
					if ($userID) {
						$user = $this->users_model->get_user_by_id($userID);
						$this->send_code($verification_code, $user->phone);
						$arr['message'] = "Code sent successfully!";

						$arr["name"] = $user->first_name . " " . $user->last_name;
						$arr["verification_code"] = $verification_code;
						$arr["email"] = $user->email;

						//$result = $this->Emailtemplates_model->sendMail('verification',$arr);

						$arr['year'] = $this->Cars_model->get_by_table_and_field_name("years", "id", $user->year_id);
						$arr['model'] = $this->Cars_model->get_by_table_and_field_name("model", "id", $user->model_id);
						$arr['car_type'] = $this->Cars_model->get_by_table_and_field_name("fuel_type", "id", $user->car_type_id);
						$arr['car'] = $this->Cars_model->get_by_table_and_field_name("cars", "vin_prefix", $user->car_vin_prefix);

						$user->created_on = date("Y-m-d H:i", $user->created_on);

						//$arr['message']		= "User registered successfully!";
						$arr['user'] = $user;
						$arr['success'] = true;
					} else {
						$arr['message'] = "Some Error try again later";
						$arr['success'] = false;
					}

				} else {
					$arr['message'] = "User already exist! please check email and mobile number";
					$arr['success'] = false;
				}
			}
		} else {
			$errors = validation_errors();
			$arr['message'] = $errors;
			$arr['success'] = false;
		}
		return $arr;
	}

	private function _changepassowrd($save_data) {
		$rules = array(
			array(
				'field' => 'token',
				'label' => 'Token',
				'rules' => 'trim|required',
			),
			array(
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'trim|required',
			),
		);

		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run()) {
			$userRow = $this->users_model->get_user_by_token($save_data['token']);
			if ($userRow) {
				$change = $this->ion_auth->reset_password($userRow->email, $save_data['password']);
				$arr['message'] = "Password change successfully!";
				$arr['user'] = $user;
				$arr['success'] = true;
			} else {
				$arr['message'] = "Invalid token";
				$arr['success'] = false;
			}
		} else {
			$errors = validation_errors();
			$arr['message'] = $errors;
			$arr['success'] = false;
		}
		return $arr;
	}
	private function _forgotpassword($data) {
		// $rules = array(
		// 	array(
		// 		'field'   => 'email',
		// 		'label'   => 'Email',
		// 		'rules'   => 'trim|required|valid_email'
		// 	)
		// );

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
		// $this->email->initialize($config);
		// $this->email->from('carigologistics@gmail.com', 'Clubenz--NoReply');
		// $this->email->to($data['email']);
		// $mesg = 	$this->load->view('reset_password_view','',true);
		// $this->email->subject('Reset Password Request Clubenz');
		// $this->email->message($mesg);
		// $this->email->send();
		// $this->form_validation->set_error_delimiters('','');
		// $this->form_validation->set_rules($rules);

		if ($data['phone']) {
			$user = $this->users_model->get_user_by_mobile($data['phone']);
			if ($user) {
				$resetToken = md5($user->email);
				$resetTimeStemp = time();
				$resetToken = $resetToken . "" . $resetTimeStemp;
				$this->email->initialize($config);
				$this->email->from('support@clubenz.com', 'Clubenz--NoReply');
				$this->email->to($user->email);
				$users['resetlink'] = $resetToken;
				$mesg = $this->load->view('reset_password_view', $users, true);
				$this->email->subject('Reset Password Request Clubenz');
				$this->email->message($mesg);
				$this->email->send();
				$user = $this->users_model->reset_password_request($data['phone'], $resetToken, $resetTimeStemp);
				// $this->form_validation->set_error_delimiters('','');
				// $this->form_validation->set_rules($rules);
				$arr['message'] = "Password check your email to rest your password";
				$arr['success'] = true;

			} else {
				$arr['message'] = "Please provide valid Phone number";
				$arr['success'] = false;
			}

		} else {
			$arr['message'] = "Please provide valid Phone number";
			$arr['success'] = false;
		}
		return $arr;
	}
	private function send_email($email, $code) {

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
		// $this->email->initialize($config);
		// $this->email->from('carigologistics@gmail.com', 'Clubenz--NoReply');
		// $this->email->to($data['email']);
		// $mesg = 	$this->load->view('reset_password_view','',true);
		// $this->email->subject('Reset Password Request Clubenz');
		// $this->email->message($mesg);
		// $this->email->send();
		// $this->form_validation->set_error_delimiters('','');
		// $this->form_validation->set_rules($rules);

		$this->email->initialize($config);
		$this->email->from('support@clubenz.com', 'Clubenz--NoReply');
		$this->email->to($email);
		$users['code'] = $code;
		$mesg = $this->load->view('verify_account_email', $users, true);
		$this->email->subject('Verify Account Request Clubenz');
		$this->email->message($mesg);
		$this->email->send();

		$arr['message'] = "The code was sent successfully";
		$arr['success'] = true;

		return $arr;
	}

	function verification_phone_post() {
		$phone = $this->post('phone');
		$verification_code = $this->post('verification_code');

		if ($phone && $verification_code) {
			$varified = $this->users_model->verification_phone($phone, $verification_code);
			if ($varified) {

				$arr['message'] = "Phone varified Successfully";
				$arr['success'] = true;

			} else {

				$arr['message'] = "Invalid verrification code";
				$arr['success'] = false;
			}

		} else {
			$arr['message'] = "Phone Number and code is missing";
			$arr['success'] = false;
		}
		$this->response($arr, 200);

	}
	function edit_profile_post() {

		if ($this->post('token')) {
			$token = $this->post('token');
			$email = $this->post('email');
			$mobile = $this->post('mobile');

			$user = $this->users_model->get_user_by_token($token);
			if ($user) {

				$user1 = $this->users_model->get_user_by_field("phone", $mobile);

				if ($user1) {
					if ($user1->email == $email) {
						if ($this->post('password') != "") {
							$change = $this->ion_auth->reset_password($user->email, $this->post('password'));
						}
						$token = $this->post('token');

						$chassis = $this->users_model->get_chassis_by_vinPrefix($this->post('car_vin_prefix'));

						if ($_FILES) {
							$file_name = $_FILES['profile_picture']['name'];
						} else {
							$file_name = "";
						}
						$data = array(
							"first_name" => $this->post('first_name'),
							"last_name" => $this->post('last_name'),
							"phone" => $this->post('mobile'),
							"email" => $this->post('email'),
							"chassis" => $chassis[0]->chassis,
							//"password"		=> $this->post('password'),
							"enablePushNotification" => $this->post('enablePushNotification'),
							"enableLocation" => $this->post('enableLocation'),
							"enableFacebook" => $this->post('enableFacebook'),
							"year_id" => $this->post('year_id'),
							"car_type_id" => $this->post('car_type_id'),
							"model_id" => $this->post('model_id'),
							"car_vin_prefix" => $this->post('car_vin_prefix'),

						);
//						if($this->post('password') && $this->post('password') != ""){
						//							$data["password"]= md5($this->post('password'));
						//						}

						if ($file_name != '') {
							$config['upload_path'] = './upload/profile_picture';
							$config['file_name'] = time() . $file_name;
							$config['allowed_types'] = 'gif|jpg|png|jpeg';
							$this->upload->initialize($config);
							if (!$this->upload->do_upload('profile_picture')) {
								echo ($this->upload->display_errors());
							} else {
								$pic = $this->upload->data();
								$data['profile_picture'] = $pic['file_name'];
							}
						}
						if ($this->post('enableFacebook') == "true") {
							$data['fb_picture'] = $this->post('fb_picture');
							$data['profile_picture'] = $this->post('fb_picture');

						}

						$res = $this->users_model->edit_user($data, $token);
						if ($res) {
							$arr['success'] = true;
							$arr['year'] = $this->Cars_model->get_by_table_and_field_name("years", "id", $user->year_id);
							$arr['model'] = $this->Cars_model->get_by_table_and_field_name("model", "id", $user->model_id);
							$arr['car_type'] = $this->Cars_model->get_by_table_and_field_name("fuel_type", "id", $user->car_type_id);
							$arr['car'] = $this->Cars_model->get_by_table_and_field_name("cars", "vin_prefix", $user->car_vin_prefix);
							$arr['data'] = $res;
						} else {
							$arr['success'] = false;
						}

					} else {
						$user2 = $this->users_model->get_user_by_email($email);

						if ($user2) {

							$arr['success'] = false;
							$arr['message'] = "Email Already Exist ! Please try another";
							$this->response($arr, 200);

						} else {
							if ($this->post('password') != "") {
								$change = $this->ion_auth->reset_password($user->email, $this->post('password'));
							}
							$token = $this->post('token');

							$chassis = $this->users_model->get_chassis_by_vinPrefix($this->post('car_vin_prefix'));

							if ($_FILES) {
								$file_name = $_FILES['profile_picture']['name'];
							} else {
								$file_name = "";
							}
							$data = array(
								"first_name" => $this->post('first_name'),
								"last_name" => $this->post('last_name'),
								"phone" => $this->post('mobile'),
								"email" => $this->post('email'),
								"chassis" => $chassis[0]->chassis,
								//"password"		=> $this->post('password'),
								"enablePushNotification" => $this->post('enablePushNotification'),
								"enableLocation" => $this->post('enableLocation'),
								"enableFacebook" => $this->post('enableFacebook'),
								"year_id" => $this->post('year_id'),
								"car_type_id" => $this->post('car_type_id'),
								"model_id" => $this->post('model_id'),
								"car_vin_prefix" => $this->post('car_vin_prefix'),

							);

							if ($file_name != '') {
								$config['upload_path'] = './upload/profile_picture';
								$config['file_name'] = time() . $file_name;
								$config['allowed_types'] = 'gif|jpg|png|jpeg';
								$this->upload->initialize($config);
								if (!$this->upload->do_upload('profile_picture')) {
									echo ($this->upload->display_errors());
								} else {
									$pic = $this->upload->data();
									$data['profile_picture'] = $pic['file_name'];
								}
							}
							if ($this->post('enableFacebook') == "true") {
								$data['fb_picture'] = $this->post('fb_picture');
								$data['profile_picture'] = $this->post('fb_picture');

							}
							$res = $this->users_model->edit_user($data, $token);
							if ($res) {
								$arr['success'] = true;
								$arr['year'] = $this->Cars_model->get_by_table_and_field_name("years", "id", $user->year_id);
								$arr['model'] = $this->Cars_model->get_by_table_and_field_name("model", "id", $user->model_id);
								$arr['car_type'] = $this->Cars_model->get_by_table_and_field_name("fuel_type", "id", $user->car_type_id);
								$arr['car'] = $this->Cars_model->get_by_table_and_field_name("cars", "vin_prefix", $user->car_vin_prefix);
								$arr['data'] = $res;
							} else {
								$arr['success'] = false;
							}

						}
					}

				}

			} else {
				$arr['data'] = 'invilid user';
			}
			$this->response($arr, 200);
		}
	}

	function get_profile_post() {
		$token = $this->post('token');
		$data = $this->users_model->get_user_by_token($token);
		$arr['success'] = true;
		$arr['data'] = $data;
		$this->response($arr, 200);

	}

	private function send_code($code, $phone) {

		require APPPATH . 'twilio-php/Services/Twilio.php';
		$AccountSid = "AC9f4bc85142a5c39b294ca30b7d955785"; // Your Account SID from www.twilio.com/console
		$AuthToken = "8a83dacb2633979386aa14ad6de4df48"; // Your Auth Token from www.twilio.com/console
		$this->client = new Services_Twilio($AccountSid, $AuthToken);

		$sms_msg = "Verification Code:" . $code;
		try {
			$message = $this->client->account->messages->sendMessage(
				"+12052368461", // From a valid Twilio number  "+17082527577"
				$phone, // Text this number
				$sms_msg
			);

			$data = $this->users_model->updateVerificationCode($code, $phone);
		} catch (Exception $e) {
			$arr['message'] = $e->getMessage();
			$arr['success'] = false;
			$this->response($arr, 200);
		}
	}
	public function schedule_notifications_post() {
		$user_id = $this->post('user_id');
		$position = $this->post('position');
		$notification_settings = $this->notification->settings();
		$interval_hours = $notification_settings->interval_hours;
		$this->load->library('firebase');

		$start = 0;
		$lat = $position["coords"]["latitude"];
		$lon = $position["coords"]["longitude"];
		$limit = 0;
		$search = "";
		$search_arr['search'] = $search;
		$search_arr['shop_open'] = '';

		$arr['total'] = 0;
		$workShops = $this->Workshop_model->get_workshops($search_arr, $start, $limit);
		$partshops = $this->Partsshop_model->get_shop($search_arr, $start, $limit);
		$serviceshops = $this->Serviceshop_model->get_shop($search_arr, $start, $limit);

//		$workshop= $workShops[0];

		$user = $this->users_model->get_user_by_id($user_id);

		$this->send_auto_notifications($workShops, $notification_settings, $user_id, $interval_hours, $user, $lat, $lon, "workshop");
		$this->send_auto_notifications($partshops, $notification_settings, $user_id, $interval_hours, $user, $lat, $lon, "partshop");
		$this->send_auto_notifications($serviceshops, $notification_settings, $user_id, $interval_hours, $user, $lat, $lon, "serviceshop");
		$this->response([], 200);

	}
	public function send_auto_notifications($workShops, $notification_settings, $user_id, $interval_hours, $user, $lat, $lon, $type) {
		$new_array = array();
		foreach ($workShops as $val) {
			if ($type == "workshop") {
				$val->distance = $this->Service_tag_model->distance($val->location_lat, $val->location_lon, $lat, $lon, "K");
			} else {
				$val->distance = $this->Service_tag_model->distance($val->location_latitude, $val->location_longitude, $lat, $lon, "K");
			}
//			echo $val->distance."\n";
			$val->shop_type = $type;
			$new_array[] = $val;
		}

//		if ($workShops) {
		//			usort($workShops, function ($a, $b) {
		//				if ($a->distance == $b->distance) {
		//					return $a->avg_rating < $b->avg_rating;
		//				} else {
		//					return $a->distance > $b->distance;
		//				}
		//			});
		//		}
		foreach ($workShops as $workshop) {
			if ($workshop->distance <= $notification_settings->max_distance) {

				$latest_notification = $this->notification->get_latest_notification($user_id, $workshop->shop_type, $workshop->id);
				$send = false;
				if ($latest_notification) {
//					echo date("Y-m-d H:i:s")."\n";
					//					echo $latest_notification->created_at."\n";
					$difference = (strtotime(date("Y-m-d H:i:s")) - strtotime($latest_notification->created_at)) / 3600;
//					echo $difference;
					if ($difference >= $interval_hours) {
						$send = true;
					}

				} else {
					$send = true;
				}
				if ($send) {
					echo $type . "\n";
					$payload = array();
					$payload['body'] = $notification_settings->message;
					$payload['title'] = $workshop->name;
					$payload['message'] = $notification_settings->message;
					$payload['shop_id'] = $workshop->id;
					$payload['shop_type'] = $workshop->shop_type;
					$payload['badge'] = 1;
					$payload['priority'] = "high";
					$payload['icon'] = "ic_stat";
					$payload['auto'] = 1;
//					$payload['created_at'] = date("Y-m-d H:i:s");
					$payload['show_in_foreground'] = true;

					$data['body'] = $notification_settings->message;
					$data['title'] = $workshop->name;
					$data['message'] = $notification_settings->message;
					$data['shop_id'] = $workshop->id;
					$data['shop_type'] = $workshop->shop_type;
					$data['badge'] = 1;
					$data['priority'] = "high";
					$data['icon'] = "ic_stat";
					$data['auto'] = 1;
//					$data['created_at'] = date("Y-m-d H:i:s");
					$data['show_in_foreground'] = true;

					if ($user->fcm_token != "") {
						$response = '';
						$response = $this->firebase->send($user->fcm_token, $payload, $data);
						$response = $this->firebase->sendGoogleCloudMessage($payload, $user->fcm_token);
						$d['data'] = json_encode($response);
						$this->db->insert("data_logs", $d);
						$data['user_id'] = $user->id;
						$this->db->insert("notifications", $data);
					}
				}

			}
		}
	}
	public function remove_user_post() {
		$phone = $this->post('phone');
		$user = $this->users_model->delete_by_phone($phone);
	}

}
