<?php
class Favorite_model extends CI_Model {
	public function get_favorites_by_user_id($id) {
		$this->db->select("*");
		$this->db->from("favorites");
		$this->db->where("user_id", $id);
		$q = $this->db->get();
		return $q->result();
	}
	public function add_favorite($user_id, $part_id) {
		$data= array();
		$data["user_id"]= $user_id;
		$data["part_id"]= $part_id;
		return $this->db->insert('favorites', $data);
	}
	public function remove_favorite($user_id, $part_id) {
		$data= array();
		$data["user_id"]= $user_id;
		$data["part_id"]= $part_id;
		return $this->db->delete('favorites', $data);
	}
	public function is_favorite($user_id, $part_id) {
		$this->db->select("*");
		$this->db->from("favorites");
		$this->db->where("user_id", $user_id);
		$this->db->where("part_id", $part_id);
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			return true;
		}
		return false;
	}
}

?>
