<?php

class Car_model extends CI_Model {
	public function get_fuel() {
		$this->db->select('*');
		$this->db->from('fuel_type');
		$this->db->order_by('sorting', 'asc');
		$q = $this->db->get();
		return $q->result();
	}
	public function get_chassis() {
		$this->db->select('*');
		$this->db->from('chassis');
		$this->db->order_by('chassis_num', 'asc');
		$q = $this->db->get();
		return $q->result();
	}
	public function get_chassis_by_id($id) {
		$this->db->select('*');
		$this->db->where('id', $id);
		$this->db->from('chassis');
		$this->db->order_by('chassis_num', 'asc');
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			$name = $q->row();
			return $name;
		}
	}

	public function get_classes() {
		$this->db->select('*');
		$this->db->from('model');
		$this->db->order_by('sorting', 'asc');
		$q = $this->db->get();
		return $q->result();
	}
	public function add_car_data($data) {
		$this->db->insert('cars', $data);
		return $this->db->insert_id();
	}
	public function cars_manage() {
		$this->db->select('*');
		$this->db->order_by("id", "desc");
		$this->db->from('cars');
		$q = $this->db->get();
		return $q->result();
	}
	public function car_del($id) {
		$this->db->where('id', $id);
		$this->db->delete('cars');
		return $this->db->affected_rows();
	}
	public function car_information_update($id) {
		$this->db->where('id', $id);
		$this->db->from('cars');
		$q = $this->db->get();
		return $q->row();
	}
	public function car_information_update_value($data, $id) {
		$this->db->where('id', $id);
		$this->db->update('cars', $data);
		/*$this->db->last_qurey();*/
	}
	public function get_fuel_type($id) {
		$this->db->select('*');
		$this->db->where('id', $id);
		$this->db->from('fuel_type');
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			$name = $q->row();
			return $name;
		}

	}
	public function get_chassis_number($id) {
		$this->db->select('*');
		$this->db->where('id', $id);
		$this->db->from('chassis');
		$this->db->order_by('chassis_num', 'asc');
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			$name = $q->row();
			return $name;
		}

	}
	public function get_modell($id) {
		$this->db->select('*');
		$this->db->where('id', $id);
		$this->db->from('model');
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			$name = $q->row();
			return $name;

		}

	}

	public function get_cars($fuel_id, $year, $class_id, $chassis_id) {
		$this->db->where('fuel_type', $fuel_id);
		$this->db->where('model_id', $class_id);
		$this->db->where('chassis', $chassis_id);
		$this->db->where(" (model_year_start <='" . $year . "' or model_year_end >='" . $year . "')", null, true);
		$this->db->from('cars');
		$q = $this->db->get();

		$cars = '<option value="">select option</option>';
		foreach ($q->result_array() as $car) {
			if ($car['model'] != '') {
				$cars .= '<option value="' . $car['id'] . '">' . $car['model'] . '</option>';
			}
		}
		return $cars;
	}

	public function get_car_model_by_car_vin_prefix($car_vin_prefix) {
		if ($car_vin_prefix != "") {
			$this->db->select("model");
			$this->db->where('vin_prefix', $car_vin_prefix);
			$qurey = $this->db->get("cars");
			return $qurey->row()->model;
		}
		return "";
	}

}
