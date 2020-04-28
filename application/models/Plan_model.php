<?php
class Plan_model extends CI_Model {

	public function get_plan_by_id($plan_id) {
		$this->db->select('*');
		$this->db->from('plans');
		$this->db->where('id', $plan_id);
		if ($query = $this->db->get()) {
			return $query->result();
		} else {
			return false;
		}
	}
	public function plan_manage() {
		$this->db->select('*');
		$this->db->from('plans');
		if ($query = $this->db->get()) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function add_plans($new_array) {
		$this->db->insert('plans', $new_array);
		return $this->db->insert_id();
	}
	public function plan_del($id) {
		$this->db->where('id', $id);
		$this->db->delete('plans');
		return $this->db->affected_rows();

	}
	public function edit_plan($id) {
		$this->db->where('id', $id);
		$this->db->from('plans');
		$q = $this->db->get();
		return $q->result();
	}
	public function plan_update($new_array, $id) {
		$this->db->where('id', $id);
		$this->db->update('plans', $new_array);
		return $this->db->affected_rows();
	}

}