<?php
class Membership_model extends CI_Model {

	public function membership_manage() {
		$this->db->select('*');
		$this->db->from('membership');
		if ($query = $this->db->get()) {
			return $query->result();
		} else {
			return false;
		}
	}
	public function membership_rel_manage() {
		$this->db->select('*');
		$this->db->from('membership_rel');
		if ($query = $this->db->get()) {
			return $query->result();
		} else {
			return false;
		}
	}
	public function membership_features_manage() {
		$this->db->select('*');
		$this->db->from('membership_fet');
		if ($query = $this->db->get()) {
			return $query->result();
		} else {
			return false;
		}
	}
	public function add_membership($new_array) {
		$this->db->insert('membership', $new_array);
		return $this->db->insert_id();
	}
	public function add_membership_rel($new_array) {
		$this->db->insert('membership_rel', $new_array);
		return $this->db->insert_id();
	}
	public function edit_membership_rel($new_array, $id) {
		$this->db->where('id', $id);
		$this->db->update('membership_rel', $new_array);
	}
	public function get_membership_rel_id($id) {
		$this->db->select("*");
		$this->db->where("membership_id", $id);
		$this->db->from("membership_rel");
		$q = $this->db->get();
		return $q->result();
	}
	public function delete_membership_rel_solution($id) {
		$this->db->where('id', $id);
		return $this->db->delete('membership_rel');
		return $this->db->affected_rows();
	}
	public function membership_del($id) {
		$this->db->where('id', $id);
		$this->db->delete('membership');
		return $this->db->affected_rows();

	}
	public function edit_membership($id) {
		$this->db->where('id', $id);
		$this->db->from('membership');
		$q = $this->db->get();
		return $q->result();
	}
	public function membership_update($new_array, $id) {
		$this->db->where('id', $id);
		$this->db->update('membership', $new_array);
		return $this->db->affected_rows();
	}
	public function edit_membership_fet($id) {
		$this->db->where('id', $id);
		$this->db->from('membership_fet');
		$q = $this->db->get();
		return $q->result();
	}
	public function membership_fet_update($new_array, $id) {
		$this->db->where('id', $id);
		$this->db->update('membership_fet', $new_array);
		return $this->db->affected_rows();
	}

}