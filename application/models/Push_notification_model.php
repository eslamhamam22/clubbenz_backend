<?php
class Push_notification_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	public function manage_notification() {
		$this->db->select('*');
		$this->db->order_by("id", "desc");
		$this->db->from('notifications');
		$q = $this->db->get();
		return $q->result();
	}

	public function insert($data) {
		$this->db->insert("notifications", $data);
	}

	public function get_notifications($id) {
		$this->db->select('*');
		$this->db->where('user_id', $id);
		$this->db->from('notifications');
		$this->db->order_by('id', 'DESC');
		$q = $this->db->get();
		return $q->result();
	}

	public function get_cars($fuel_id, $year, $class_id, $chassis_id) {
		$this->db->select("*");
		$this->db->where('fuel_type', $fuel_id);
		$this->db->where('model_id', $class_id);
		$this->db->where('chassis', $chassis_id);
		$this->db->where(" (model_year_start <='" . $year . "' or model_year_end >='" . $year . "')", null, true);
		$this->db->from('cars');
		$q = $this->db->get();
		$cars = '<option value="">select option</option>';
		foreach ($q->result_array() as $car) {
			if ($car['model_text'] != '') {
				$cars .= '<option value="' . $car['vin_prefix'] . '">' . $car['model'] . '</option>';
			}
		}
		return $cars;
	}

	public function get_shops($type) {
		$this->db->select('*');
		if ($type == "workshop") {
			$this->db->from('workshop');
		}
		if ($type == "partsshop") {
			$this->db->from('partshop');
		}
		if ($type == "serviceshop") {
			$this->db->from('service_shop');
		}
		$q = $this->db->get();
		$shops = '<option value="">select Shop</option>';
		foreach ($q->result_array() as $s) {
			if ($s['name'] != '') {
				$shops .= '<option value="' . $s['id'] . '">' . $s['name'] . '</option>';
			}
		}
		return $shops;
	}

	public function get_users($car_vin_prefix) {
		$this->db->select('*');
		$this->db->where('car_vin_prefix', $car_vin_prefix);
		$this->db->from('users');
		$q = $this->db->get();
		return $q->result_array();
	}

	public function get_all_users($data) {
		$this->db->select('*');

		if ($data['class_id'] != '') {
			$this->db->where('model_id', $data['class_id']);
		}

		if ($data['year_id'] != '') {
			$this->db->where('year_id', $data['year_id']);
		}

		if ($data['fuel_id'] != '') {
			$this->db->where('car_type_id', $data['fuel_id']);
		}

		if ($data['chassis'] != '') {
			$this->db->where('chassis', $data['chassis']);
		}

		if ($data['car_vin_prefix'] != '') {
			$this->db->where('car_vin_prefix', $data['car_vin_prefix']);
		}

		$this->db->where('enablePushNotification', "true");

		$this->db->from('users');
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			return $q->result();
		}
		return array();
	}

	public function countnotification() {

		$this->db->where('id', 1);
		$this->db->set('count', 'count+1', FALSE);
		$this->db->update('autonotification');

	}

	function get_user_name($id) {
		$this->db->select('username');
		$this->db->where('id', $id);
		$this->db->from('users');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row()->username;
		}
		return "";
	}

	function get_part_shop_name($id) {
		$this->db->select('name');
		$this->db->where('id', $id);
		$this->db->from('partshop');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row()->name;
		}
		return "";
	}
}
?>