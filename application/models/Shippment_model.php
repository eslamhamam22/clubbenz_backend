<?php
class Shippment_model extends CI_Model {
	public function shipment_manage() {
		$this->db->select('*');
		$this->db->from('shipments');
		if ($query = $this->db->get()) {
			return $query->result_array();
		} else {
			return false;
		}
	}

	public function shipment_update($new_array, $id) {
		$this->db->where('id', $id);
		$this->db->update('shipments', $new_array);
		return $this->db->affected_rows();
	}

}