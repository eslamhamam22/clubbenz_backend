<?php
class Membership_model extends CI_Model {

	public function membership_manage() {
		$this->db->select('*');
		$this->db->from('benefits');
		if ($query = $this->db->get()) {
			return $query->result();
		} else {
			return false;
		}
	}
	public function membership_setting_manage() {
		$this->db->where('id', $id);
		$this->db->from('benefits');
		$q = $this->db->get();
		return $q->result();
	}
	public function membership_rel_manage() {
		$this->db->select('*');
		$this->db->from('details');
		if ($query = $this->db->get()) {
			return $query->result();
		} else {
			return false;
		}
	}
	public function membership_st_manage() {
		$this->db->select('*');
		$this->db->from('memberships_users');
		if ($query = $this->db->get()) {
			return $query->result();
		} else {
			return false;
		}
	}
	public function membership_features_manage() {
		$this->db->select('*');
		$this->db->from('memberships');
		if ($query = $this->db->get()) {
			return $query->result();
		} else {
			return false;
		}
	}
	public function add_membership($new_array) {
		$this->db->insert('benefits', $new_array);
		return $this->db->insert_id();
	}
	public function add_membership_rel($new_array) {
		$this->db->insert('details', $new_array);
		return $this->db->insert_id();
	}
	public function edit_membership_rel($new_array, $id) {
		$this->db->where('id', $id);
		$this->db->update('details', $new_array);
	}
	public function get_membership_rel_id($id) {
		$this->db->select("*");
		$this->db->where("benefit_id", $id);
		$this->db->from("details");
		$q = $this->db->get();
		return $q->result();
	}
	public function delete_membership_rel_solution($id) {
		$this->db->where('id', $id);
		return $this->db->delete('details');
		return $this->db->affected_rows();
	}
	public function membership_del($id) {
		$this->db->where('id', $id);
		$this->db->delete('benefits');
		return $this->db->affected_rows();

	}
	public function membership_features_del($id) {
		$this->db->where('id', $id);
		$this->db->delete('memberships');
		return $this->db->affected_rows();

	}
	public function membership_request_del($id) {
		$this->db->where('id', $id);
		$this->db->delete('memberships_users');
		return $this->db->affected_rows();

	}
	public function edit_membership($id) {
		$this->db->where('id', $id);
		$this->db->from('benefits');
		$q = $this->db->get();
		return $q->result();
	}
	public function membership_update($new_array, $id) {
		$this->db->where('id', $id);
		$this->db->update('benefits', $new_array);
		return $this->db->affected_rows();
	}
	public function reset_membership() {
		$this->db->update('benefits', ["gold" => "", "platinum" => ""]);

	}
	public function membership_setting_update($id, $data_arr) {

		$this->db->where('id', $id);
		$this->db->update('benefits', $data_arr);
		// return true;
	}
	public function edit_membership_fet($id) {
		$this->db->where('id', $id);
		$this->db->from('memberships');
		$q = $this->db->get();
		return $q->result();
	}
	public function membership_fet_update($new_array, $id) {
		$this->db->where('id', $id);
		$this->db->update('memberships', $new_array);
		return $this->db->affected_rows();
	}

	public function get_current_membership_by_user($user_id) {
		$this->db->select('*');
		$this->db->from('memberships_users');
		$this->db->where('user_id', $user_id);
		$this->db->order_by('id', "DESC");
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 1) {
			return $query->result()[0];
		} else {
			return false;
		}
	}
	public function subscribe($user_id, $membership, $address) {
		$this->db->insert('memberships_users', ["user_id" => $user_id, "membership" => $membership, "address" => $address, "status" => "pending"]);
	}

	public function approve_membership($id) {
		$this->db->where('id', $id);
		$this->db->update('memberships_users', ["status" => 'approve']);
		return $this->db->affected_rows();
	}

	public function reject_membership($id) {
		$this->db->where('id', $id);
		$this->db->update('memberships_users', ["status" => 'reject']);
		return $this->db->affected_rows();
	}

	public function add_membership_features($new_array) {
		$this->db->insert('memberships', $new_array);
		return $this->db->insert_id();
	}
}
