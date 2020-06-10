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

	public function edit_memberships_users($id) {
		$this->db->where('id', $id);
		$this->db->from('memberships_users');
		$q = $this->db->get();
		return $q->result();
	}
	public function membership_update($new_array, $id) {
		$this->db->where('id', $id);
		$this->db->update('benefits', $new_array);
		return $this->db->affected_rows();
	}
	public function memberships_users_update($new_array, $id) {
		$this->db->where('id', $id);
		$this->db->update('memberships_users', $new_array);
		return $this->db->affected_rows();
	}
	public function reset_membership() {
		// $this->db->from('memberships_benefits');
		$this->db->empty_table('memberships_benefits');

	}
	public function membership_setting_update($data_arr) {

		// $this->db->where('id', $id);
		$this->db->insert('memberships_benefits', $data_arr);
		// $this->db->insert('benefits', $new_array);
		// return $this->db->insert_id();
		// return true;
	}
	public function get_membership_set($membership_id, $benefit_id) {
		$this->db->select('*');
		$this->db->from('memberships_benefits');
		$this->db->where('membership_id', $membership_id);
		$this->db->where('benefit_id', $benefit_id);
		$query = $this->db->get();
		if ($query->num_rows() >= 1) {
			return true;
		} else {
			return false;
		}
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
	public function subscribe($new_array) {
		$new_array["status"]= "pending";
		$this->db->insert('memberships_users', $new_array);
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
	public function get_benefits_by_membership($id) {
		$this->db->where('membership_id', $id);
		$this->db->from('memberships_benefits');
		$this->db->join('benefits', 'memberships_benefits.benefit_id = benefits.id');
		$q = $this->db->get();
		return $q->result();
	}
	public function get_user_name($id) {
		if ($id != 0 && $id != "") {
			$this->db->select("*");
			$this->db->where('id', $id);
			$this->db->from('users');
			$query = $this->db->get();
			if ($query->num_rows() > 0) {
				$result = $query->row();
				return $result;
				//return $result->first_name." ".$result->last_name;
			}
			return "";
		}
		return "";
	}
	public function get_membership_features($id) {
		if ($id != 0 && $id != "") {
			$this->db->select("*");
			$this->db->where('id', $id);
			$this->db->from('memberships');
			$query = $this->db->get();
			if ($query->num_rows() > 0) {
				$result = $query->row();
				return $result;
				//return $result->first_name." ".$result->last_name;
			}
			return "";
		}
		return "";
	}

	function get_all_users() {
		$this->db->select('*');
		$this->db->from('users');
		$this->db->join('users_groups', 'users.id = users_groups.user_id');
		$this->db->where('users_groups.group_id', 2);
		$q = $this->db->get();
		return $q->result();
	}

	function get_users_membership() {
		$this->db->select('*');
		$this->db->from('memberships_users');
		$this->db->join('users', 'users.id = memberships_users.user_id');
		$q = $this->db->get();
		return $q->result();
	}
}
