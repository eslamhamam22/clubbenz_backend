<?php
class Comments_model extends CI_Model {
	public function get_comment() {
		$this->db->select("*");
		$this->db->from("comments");
		$q = $this->db->get();
		return $q->result();

	}
}

?>