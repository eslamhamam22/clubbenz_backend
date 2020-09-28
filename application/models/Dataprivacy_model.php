<?php
class Dataprivacy_model extends CI_Model {

	public function data_privacy_manage() {
		$this->db->select('*');
		$this->db->from('data_privacy');
		if ($query = $this->db->get()) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function edit_data_privacy($id) {
		$this->db->where('id', $id);
		$this->db->from('data_privacy');
		$q = $this->db->get();
		return $q->result();
	}
	public function data_privacy_update($new_array, $id) {
		$this->db->where('id', $id);
		$this->db->update('data_privacy', $new_array);
		return $this->db->affected_rows();
	}

}