<?php
class Shipping_model extends CI_model {

	public function select_shipping() {
		$this->db->select('*');
		$this->db->from('shippings');
		if ($query = $this->db->get()) {
			return $query->result_array();
		} else {
			return false;
		}
	}
	public function select_shipping_by_provider($provider_id) {
		$this->db->select('*');
		$this->db->from('shippings');
		$this->db->where('provider_id', $provider_id);
		$this->db->order_by('id', "DESC");
		if ($query = $this->db->get()) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function shipping_del($id) {
		$this->db->where('id', $id);
		$this->db->delete('shippings');
		return $this->db->affected_rows();
	}

	public function edit_shippinglist($id) {
		$this->db->where('id', $id);
		$this->db->from('shippings');
		$q = $this->db->get();
		return $q->result();
	}

	public function update_shippinglist($new_array, $id) {
		$this->db->where('id', $id);
		$this->db->update('shippings', $new_array);
		return $this->db->affected_rows();
	}

	public function add($data) {
		$this->db->insert('shippings', $data);
	}

}

?>