<?php
class Catalog_model extends CI_Model {
	public function catalog_manage() {
		$this->db->select('*');
		$this->db->from('part_catalog');
		$q = $this->db->get();
		return $q->result();
	}

	public function update_status() {
		$id = $_REQUEST['sid'];
		$sval = $_REQUEST['sval'];
		if ($sval == 1) {
			$status = 0;
		} else {
			$status = 1;
		}
		$data = array('status' => $status);
		$this->db->where('id', $id);
		return $this->db->update('part_catalog', $data);
	}
}