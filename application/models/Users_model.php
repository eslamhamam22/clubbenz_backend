<?php

class Users_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	function insert_in_table($table, $data) {
		$this->db->insert($table, $data);
		return $this->db->insert_id();
	}

	function get_user_name($id) {
		$this->db->select("*");
		$this->db->where('id', $id);
		$this->db->from('users');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$row = $query->row();
			return $row->first_name . " " . $row->last_name;
		}
	}
	function get_allusers_chassis() {
		$this->db->select("*");
		$this->db->from("chassis");
		$q = $this->db->get();
		return $q->result();
	}
	function get_allclasses() {
		$this->db->select("*");
		$this->db->from("model");
		$q = $this->db->get();
		return $q->result();
	}

	public function register_user($save_user) {
		$this->db->select('*');
		$this->db->where('email', $save_user['email']);
		$this->db->from('users');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return false;
		} else {
			$this->db->insert('users', $save_user);
			return $this->db->insert_id();
		}
	}

	public function login($login_data) {
		$this->db->select("*");
		$this->db->where('username', $login_data['username']);
		$this->db->where('password', $login_data['password']);
		$this->db->from('users');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row();
		}
		return false;
	}

	public function get_chassis_by_car_vin_prefix($id) {
		$this->db->select("chassis");
		$this->db->where('vin_prefix', $id);
		$this->db->from('cars');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$row = $query->row();
			if ($row->chassis != "") {
				return $row->chassis;
			}
		}
		return "";
	}

	public function get_car_vin_prefix($id) {
		$this->db->select("vin_prefix");
		$this->db->where('id', $id);
		$this->db->from('cars');
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}

	public function get_chassis() {
		$this->db->select("*");
		$this->db->from('cars');
		$query = $this->db->get();
		$result = $query->result();
		return $result;

	}
	public function get_chassis_by_vinPrefix($vinPre) {
		$this->db->select("chassis");
		$this->db->from('cars');
		$this->db->where('vin_prefix', $vinPre);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	public function get_unique_user_token($size = 8) {
		$alpha_key = '';
		$keys = range('A', 'Z');

		for ($i = 0; $i < 2; $i++) {
			$alpha_key .= $keys[array_rand($keys)];
		}

		$length = $size - 2;

		$key = '';
		$keys = range(0, 9);

		for ($i = 0; $i < $length; $i++) {
			$key .= $keys[array_rand($keys)];
		}

		$code = $alpha_key . $key;

		$this->db->select("*");
		$this->db->from("users");
		$this->db->where('token', $code);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $this->get_uniqe_checkin_id();
		}
		return $code;
	}

	function update($id, $data) {
		$this->db->where("id", $id);
		$this->db->update("users", $data);
	}

	function get_user_by_token($token) {
		$this->db->select("*");
		$this->db->from("users");
		$this->db->where("token", $token);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$data = $query->row();
			return $data;
		}
		return false;
	}
	function edit_user($data, $token) {
		$this->db->where("token", $token);
		$this->db->update("users", $data);
		$row = $this->db->affected_rows();
		$this->db->select("*");
		$this->db->from("users");
		$this->db->where("token", $token);
		$query = $this->db->get();
		$data = $query->row();
		return $data;
	}
	function get_user($token) {
		$this->db->select("*");
		$this->db->from("users");
		$this->db->where('token', $token);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row();
		}
		return false;
	}

	function get_user_by_id($id) {
		$this->db->select("*");
		$this->db->from("users");
		$this->db->where('id', $id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row();
		}
		return false;
	}

	function get_user_by_field($field, $value) {
		$this->db->select("*");
		$this->db->from("users");
		$this->db->where($field, $value);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row();
		}
		return false;
	}
	function check_user_by_phone($phone) {
		$this->db->select("*");
		$this->db->from("users");
		$this->db->where('phone', $phone);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return false;
		}
		return true;
	}

	function check_user_by_email($email) {
		$this->db->select("*");
		$this->db->from("users");
		$this->db->where('email', $email);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return false;
		}
		return true;
	}

	function get_user_by_email($email) {
		$this->db->select("*");
		$this->db->from("users");
		$this->db->where('email', $email);
		$this->db->or_where('phone', $email);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
		return true;
	}
	function get_user_by_mobile($phone) {
		$this->db->select("*");
		$this->db->from("users");
		$this->db->where('phone', $phone);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}

	}

	function reset_password_request($phone, $resetToken, $resetTimeStemp) {

		$this->db->where("phone", $phone);
		$this->db->update("users", array("resetToken" => $resetToken, "resetTimeStemp" => $resetTimeStemp));

		return true;
	}

	function get_user_by_resetToken($resetToken) {

		$this->db->select("*");
		$this->db->from("users");
		$this->db->where("resetToken", $resetToken);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$data = $query->row();
			return $data;
		}
		return false;
	}

	function updateVerificationCode($code, $phone) {

		$this->db->where("phone", $phone);
		$this->db->update("users", array("verification_code" => $code));
		return true;

	}

	function verification_phone($phone, $code) {
		$this->db->select("*");
		$this->db->from("users");
		$this->db->where("phone", $phone);
		$this->db->where("verification_code", $code);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {

			$this->db->where("phone", $phone);
			$this->db->update("users", array("verification_phone" => 1, "verification_code" => ''));
			return true;

		} else {
			return false;
		}
	}

	function logout($token) {
		$user_row = $this->get_user_by_token($token);
		if ($user_row) {
			$this->db->where("id", $user_row->id);
			$this->db->update("users", array("token" => ""));
			return true;
		}
		return false;
	}

	function check_activation_code($code, $token, $mobile, $email) {
		$this->db->select("*");
		$this->db->from("users");
		$this->db->where('verification_code', $code);
		$this->db->where('phone', $mobile);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$row = $query->row();
			if ($row->token == $token || $row->phone == $mobile || $row->email == $email) {
				$this->db->where("id", $row->id);
				$this->db->update("users", array("verification_code" => "", "verification_phone" => "1"));
				return true;
			} else {
				return false;
			}
		}
		return false;
	}

	function get_profile_pictures() {
		$this->db->select("*");
		$this->db->from("profile_image");
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return false;
	}
	public function user_type_ios($usertype) {
		$this->db->where('app_type', $usertype);
		$result = $this->db->get('users')->num_rows();
		return $result;
	}
	public function user_type_apl($date) {
		$this->db->select('distinct(created_date)');
		$this->db->where('created_date =', $date);
		$this->db->from('users');
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			return $date;
		}
		return $date;
	}
	public function get_ios_users($date) {
		$query = "SELECT count(*) as total FROM `users` WHERE created_date= '$date' and app_type='ios'";
		$q = $this->db->query($query);
		if ($q->num_rows() > 0) {
			return $q->result();
		}
		return 0;
	}
	public function get_users_by_chassis($date, $chassis) {
		$query = "SELECT count(*) as total FROM `users` WHERE created_date= '$date' and chassis='$chassis'";
		$q = $this->db->query($query);
		if ($q->num_rows() > 0) {
			return $q->result();
		}
		return 0;
	}
	public function count_classes($date, $class) {
		$query = "SELECT count(*) as total FROM `users` WHERE created_date= '$date' and model_id='$class'";
		$q = $this->db->query($query);

		if ($q->num_rows() > 0) {
			return $q->result();
		}
		return 0;
	}
	public function get_users_by_chassis_month($sdate, $ldate, $chassis) {
		$query = "SELECT COUNT(*) as total FROM users WHERE  created_date >= '$sdate' AND created_date <= '$ldate'and chassis='$chassis'";
		$q = $this->db->query($query);
		return $q->result();
	}
	public function month_workshop($sdate, $ldate) {
		$query = "SELECT COUNT(*) as total FROM workshop WHERE  created_date >= '$sdate' AND created_date <= '$ldate'";
		$q = $this->db->query($query);
		return $q->row()->total;
	}
	public function month_serviceshop($sdate, $ldate) {
		$query = "SELECT COUNT(*) as total FROM service_shop WHERE  created_date >= '$sdate' AND created_date <= '$ldate'";
		$q = $this->db->query($query);
		return $q->row()->total;
	}
	public function month_partshop($sdate, $ldate) {
		$query = "SELECT COUNT(*) as total FROM partshop WHERE  created_date >= '$sdate' AND created_date <= '$ldate'";
		$q = $this->db->query($query);
		return $q->row()->total;
	}
	public function month_carowners($sdate, $ldate) {
		$query = "SELECT COUNT(*) as total FROM users INNER JOIN users_groups ON users.id = users_groups.user_id  WHERE  users.created_date >= '$sdate' AND users.created_date <= '$ldate'";
		$q = $this->db->query($query);
		return $q->row()->total;
	}
	public function month_membership($sdate, $ldate) {
		$query = "SELECT COUNT(*) as total FROM users INNER JOIN memberships_users ON memberships_users.user_id = users.id WHERE memberships_users.status = 'approve' AND memberships_users.created_date >= '$sdate' AND memberships_users.created_date <= '$ldate'";
		$q = $this->db->query($query);
		return $q->row()->total;
	}
	public function month_memberships_users($sdate, $ldate) {
		// $query = "SELECT COUNT(*) as total FROM memberships_users WHERE  date_created >= '$sdate' AND date_created <= '$ldate'";
		// $q = $this->db->query($query);
		// return $q->row()->total;
		//
		$query = "SELECT COUNT(*) as total FROM memberships_users INNER JOIN memberships ON memberships.id = memberships_users.membership_id WHERE  DATE_ADD(memberships_users.created_date, INTERVAL memberships.duration *30 DAY) >= '$sdate' AND DATE_ADD(memberships_users.created_date, INTERVAL memberships.duration *30 DAY) <= '$ldate'";
		$q = $this->db->query($query);
		return $q->row()->total;
	}
	public function month_active_parts($sdate, $ldate) {
		$query = "SELECT COUNT(*) as total FROM parts WHERE active = 1 AND add_date >= '$sdate' AND add_date <= '$ldate'";
		$q = $this->db->query($query);
		return $q->row()->total;
	}
	public function month_in_active_parts($sdate, $ldate) {
		$query = "SELECT COUNT(*) as total FROM parts WHERE active = 0 AND add_date >= '$sdate' AND add_date <= '$ldate'";
		$q = $this->db->query($query);
		return $q->row()->total;
	}
	public function month_favorites($sdate, $ldate) {
		$query = "SELECT COUNT(*) as total FROM parts INNER JOIN favorites ON favorites.part_id = parts.id WHERE parts.add_date >= '$sdate' AND parts.add_date <= '$ldate'";
		$q = $this->db->query($query);
		return $q->row()->total;
	}
	public function count_classes_month($sdate, $ldate, $class) {
		$query = "SELECT COUNT(*) as total FROM users WHERE  created_date >= '$sdate' AND created_date <= '$ldate'and model_id='$class'";
		$q = $this->db->query($query);

		return $q->result();
	}

	public function month_ios_users($sdate, $ldate) {
		$query = "SELECT COUNT(*) as total FROM users WHERE app_type='ios'and created_date >= '$sdate' AND created_date <= '$ldate'";
		$q = $this->db->query($query);

		return $q->result();
	}

	public function month_android_users($sdate, $ldate) {
		$query = "SELECT COUNT(*) as total FROM users WHERE app_type='android'and created_date >= '$sdate' AND created_date <= '$ldate'";
		$q = $this->db->query($query);

		return $q->result();
	}

	public function get_android_users($date) {
		$query = "SELECT count(*) as total FROM `users` WHERE created_date= '$date' and app_type='android'";
		$q = $this->db->query($query);
		if ($q->num_rows() > 0) {
			return $q->result();
		}
		return 0;
	}
	public function month_booking_completed($sdate, $ldate) {
		$ldate = $ldate . ' 23:59:59';
		$query = "SELECT COUNT(*) as total FROM booking WHERE status = 'completed' AND created_date >= '$sdate' AND created_date <= '$ldate'";
		$q = $this->db->query($query);
		return $q->row()->total;
	}
	public function month_booking_pending($sdate, $ldate) {
		$ldate = $ldate . ' 23:59:59';
		$query = "SELECT COUNT(*) as total FROM booking WHERE status = 'pending' AND created_date >= '$sdate' AND created_date <= '$ldate'";
		$q = $this->db->query($query);
		return $q->row()->total;
	}
	public function month_booking_rejected($sdate, $ldate) {
		$ldate = $ldate . ' 23:59:59';
		$query = "SELECT COUNT(*) as total FROM booking WHERE status = 'rejected' AND created_date >= '$sdate' AND created_date <= '$ldate'";
		$q = $this->db->query($query);
		return $q->row()->total;
	}

	public function month_reviews_pending($sdate, $ldate) {
		$ldate = $ldate . ' 23:59:59';
		$query = "SELECT COUNT(*) as total FROM reviews WHERE status = 'pending' AND date_updated >= '$sdate' AND date_updated <= '$ldate'";
		$q = $this->db->query($query);
		return $q->row()->total;
	}

	public function month_reviews_rejected($sdate, $ldate) {
		$ldate = $ldate . ' 23:59:59';
		$query = "SELECT COUNT(*) as total FROM reviews WHERE status = 'reject' AND date_updated >= '$sdate' AND date_updated <= '$ldate'";
		$q = $this->db->query($query);
		return $q->row()->total;
	}

	public function month_reviews_approved($sdate, $ldate) {
		$ldate = $ldate . ' 23:59:59';
		$query = "SELECT COUNT(*) as total FROM reviews WHERE status = 'approve' AND date_updated >= '$sdate' AND date_updated <= '$ldate'";
		$q = $this->db->query($query);
		return $q->row()->total;
	}

	public function month_active_ads($sdate, $ldate) {
		$query = "SELECT COUNT(*) as total FROM advertisement WHERE status = 'active' AND created_date >= '$sdate' AND created_date <= '$ldate'";
		$q = $this->db->query($query);
		return $q->row()->total;
	}

	public function month_notification_provider($sdate, $ldate) {
		$ldate = $ldate . ' 23:59:59';
		$query = "SELECT COUNT(*) as total FROM notifications WHERE shop_id != 0 AND created_at >= '$sdate' AND created_at <= '$ldate'";
		$q = $this->db->query($query);
		return $q->row()->total;
	}
	public function month_notification_users($sdate, $ldate) {
		$ldate = $ldate . ' 23:59:59';
		$query = "SELECT COUNT(*) as total FROM notifications WHERE shop_id = 0 AND created_at >= '$sdate' AND created_at <= '$ldate'";
		$q = $this->db->query($query);
		return $q->row()->total;
	}

	public function month_provider_parts($sdate, $ldate) {
		$query = "SELECT COUNT(*) as total FROM parts INNER JOIN provider_user ON parts.provider_id = provider_user.id  WHERE parts.active = 1 AND  parts.add_date >= '$sdate' AND parts.add_date <= '$ldate'";
		$q = $this->db->query($query);
		return $q->row()->total;
	}

	public function user_type_and($usertype, $date, $datef) {
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('app_type', $usertype);
		$this->db->where('created_date >=', $date);
		$this->db->where('created_date <=', $datef);
		$query = $this->db->get();
		$result = $query->result();
		//$result = $this->db->get('users')->num_rows();
		return $result;
	}
	public function user_type_android($usertype) {
		$this->db->where('app_type', $usertype);
		$result = $this->db->get('users');
		return $result;
	}

	public function check_email_by_user_id($email, $id) {
		$this->db->select("*");
		$this->db->from("users");
		$this->db->where('email', $email);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$result = $query->row();
			if ($id == $result->id) {
				return true;
			}
			return false;
		}
		return true;
	}

	public function get_all_chassis() {
		$this->db->select("*");
		$this->db->where('chassis_num  !=', 'All');
		$this->db->order_by('chassis_num', 'asc');
		return $this->db->get("chassis")->result();

	}
}

?>
