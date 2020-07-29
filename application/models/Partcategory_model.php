<?php
class Partcategory_model extends CI_Model {

	public function manage_parts_cat() {
		$this->db->select('*');
		$this->db->from('parts_categories');
		$this->db->order_by('sorting', 'asc');
		$q = $this->db->get();
		return $q->result();
	}
	public function get_car_chassis() {
		$this->db->select("*");
		$this->db->from("cars");
		$q = $this->db->get();
		return $q->result();
	}
	public function add_parts_categories($new_array) {
		$this->db->insert('parts_categories', $new_array);
		return $this->db->insert_id();
	}
	public function part_del($id) {
		$this->db->where('id', $id);
		$this->db->delete('parts_categories');
		return $this->db->affected_rows();
	}
	public function edit_parts_categories($id) {
		$this->db->where('id', $id);
		$this->db->from('parts_categories');
		$q = $this->db->get();
		return $q->result();
	}
	public function update_parts_categories($new_array, $id) {
		$this->db->where('id', $id);
		$this->db->update('parts_categories', $new_array);
		return $this->db->affected_rows();
	}
	public function get_category_by_id($id) {
		$this->db->select('*');
		$this->db->where_in('id', $id);
		$this->db->from('parts_categories');
		$q = $this->db->get();
		return $q->result();
	}
	public function get_cat_by_id($id) {
		$this->db->where('id', $id);
		$this->db->from('parts_categories');
		$q = $this->db->get();
		return $q->result();
	}
	public function get_by_id($id) {
		$this->db->select('*');
		$this->db->where('id', $id);
		$this->db->from('parts_categories');
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			return $q->result();
		}
		return false;
	}
	public function get_by_name($name) {
		$this->db->select('*');
		$this->db->where('name', $name);
		$this->db->from('parts_categories');
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			return $q->result();
		}
		return false;
	}

}
