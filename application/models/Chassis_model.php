<?php

class Chassis_model extends CI_Model {

	public function get_chassis() {
		$this->db->select("*");
		$this->db->from("chassis");
		$this->db->where('chassis_num  !=', 'All');
		$this->db->order_by('chassis_num', 'asc');
		$q = $this->db->get();
		return $q->result();
	}
	public function get_car_chassis() {
		$query = "select distinct(chassis) from cars";
		$q = $this->db->query($query);
		return $q->result();
	}
	public function get_shop($shop_type) {
		$this->db->select('*');
		if ($shop_type == 'workshop') {
			$this->db->from('workshop');
		} elseif ($shop_type == 'serviceshop') {
			$this->db->from('service_shop');
		} elseif ($shop_type == 'partshop') {
			$this->db->from('partshop');
		}

		$q = $this->db->get();
		$sub_item = '<option value="">select Shop</option>';
		foreach ($q->result() as $subcat) {
			$sub_item .= '<option value="' . $subcat->id . '">' . $subcat->name . '</option>';
		}
		return $sub_item;
	}

	public function add_chassis($data) {
		$insert = $this->db->insert('chassis', $data);

		if (!$insert) {
			return false;
		} else {

			return $this->db->insert_id();
		}
	}
	public function get_chassis_info($id) {
		$this->db->where('id', $id);
		$this->db->from('chassis');
		$this->db->order_by('chassis_num', 'asc');
		$q = $this->db->get();
		return $q->row();
	}
	public function update_chassis($data) {
		$this->db->where('id', $data['id']);
		$insert = $this->db->update('chassis', $data);

		if (!$insert) {
			return false;
		} else {

			return $this->db->affected_rows();
		}

	}
	public function del_chassis($id) {
		$this->db->where('id', $id);
		return $this->db->delete('chassis');
		return $this->db->affected_rows();
	}
	public function edit_car_guide($id) {
		$this->db->where('id', $id);
		$this->db->from('car_guide');
		$q = $this->db->get();
		return $q->row();
	}
	public function update_car_guide($data, $id) {
		$this->db->where('id', $id);
		$this->db->update('car_guide', $data);
		return $this->db->affected_rows();
	}
	public function get_cluster_error() {
		$this->db->select("*");
		$this->db->from("cluster_error");
		$q = $this->db->get();
		return $q->result();
	}

	public function add_cluster_error($data) {
		$this->db->insert('cluster_error', $data);
		return $this->db->insert_id();
	}
	public function del_cluster_error($id) {
		$this->db->where('id', $id);
		$this->db->delete('cluster_error');
		return $this->db->affected_rows();
	}
	public function del_cluster_error_solution($id) {
		$this->db->where('cluster_error_id', $id);
		$this->db->delete('cluster_error_solution');
		return $this->db->affected_rows();
	}
	public function edit_cluster_error($id) {
		$this->db->where('id', $id);
		$this->db->from('cluster_error');
		$q = $this->db->get();
		return $q->row();
	}
	public function update_cluster_error($data, $id) {
		$this->db->where('id', $id);
		$this->db->update('cluster_error', $data);
		return $this->db->affected_rows();
	}
	public function get_error_solution() {
		$this->db->select("*");
		$this->db->from("cluster_error_solution");
		$q = $this->db->get();
		return $q->result();
	}
	public function get_error_solution_id($id) {
		$this->db->select("*");
		$this->db->where(" cluster_error_id", $id);
		$this->db->from(" cluster_error_solution");
		$q = $this->db->get();
		return $q->result_array();
	}
	public function get_solution() {
		$this->db->select("*");
		$this->db->from("cluster_error_solution");
		$q = $this->db->get();
		return $q->result();
	}
	public function add_cluster_error_solution($data) {
		$this->db->insert('cluster_error_solution', $data);
		return $this->db->insert_id();
	}

	public function edit_cluster_error_solution($data, $id) {
		$this->db->where('id', $id);
		$this->db->update(' cluster_error_solution', $data);
	}
	public function del_error_solution($id) {
		$this->db->where('id', $id);
		$this->db->delete('cluster_error_solution');
		return $this->db->affected_rows();
	}
	public function update_error_solution($data, $id) {
		$this->db->where('id', $id);
		$this->db->update('cluster_error_solution', $data);
		return $this->db->affected_rows();
	}

	public function solution_status_update($data, $id) {
		$this->db->where('id', $id);
		$this->db->update('cluster_error_solution', $data);
	}
	public function edit_error_solution() {
		$this->db->select("*");
		$this->db->from("cluster_error_solution");
		$q = $this->db->get();
		return $q->row();
	}
	public function get_by_id($id) {
		$this->db->select('*');
		$this->db->where('id', $id);
		$this->db->from('chassis');
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			return $q->result();
		}
		return false;
	}
	public function get_by_name($name) {
		$this->db->select('*');
		$this->db->where('chassis_num', $name);
		$this->db->from('chassis');
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			return $q->result();
		}
		return false;
	}

}
