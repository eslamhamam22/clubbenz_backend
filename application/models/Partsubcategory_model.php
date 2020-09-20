<?php

class Partsubcategory_model extends CI_Model {

	public function __construct() {
		parent::__construct();

		/* Load Models - Model_1 */
		$this->load->model('Part_model');
	}

	public function manage_parts_sub_cat() {
		$this->db->select('*');
		$this->db->from('parts_sub_categories');
		$this->db->order_by('sorting', 'asc');
		$q = $this->db->get();
		return $q->result();
	}

	public function parts_cat() {

		$this->db->select('*');
		$this->db->from('parts_categories');
		$this->db->order_by('sorting', 'asc');
		$q = $this->db->get();
		return $q->result();
	}
	public function add_parts_sub_categories($new_array) {
		$this->db->insert('parts_sub_categories', $new_array);
		return $this->db->insert_id();
	}
	public function part_sub_categories_del($id) {
		$this->db->where('id', $id);
		$this->db->delete('parts_sub_categories');
		return $this->db->affected_rows();

	}
	public function edit_parts_sub_cat($id) {
		$this->db->where('id', $id);
		$this->db->from('parts_sub_categories');
		$q = $this->db->get();
		return $q->row();
	}

	public function update_parts_sub_categories($new_array, $id) {
		$this->db->where('id', $id);
		$this->db->update('parts_sub_categories', $new_array);

	}
	public function get_category_name($id) {
		$this->db->select('*');
		$this->db->where('id', $id);
		$this->db->from('parts_categories');
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			$name = $q->row();
			return $name;
		}
	}
	public function get_subcategory($id) {

		$this->db->select('*');
		$this->db->where('category', $id);
		$this->db->from('parts_sub_categories');
		$this->db->order_by('sorting', 'asc');
		$q = $this->db->get();
		$data = array();
		if ($q->num_rows() > 0) {
			$data = $q->result_array();

			return $data;
		}
		return $data;

	}
	public function get_subcategory_with_parts($id, $chassis_id, $phone = "") {

		$this->db->select('*');
		$this->db->where('category', $id);
		$this->db->from('parts_sub_categories');
		// $this->db->join('parts', 'parts_sub_categories.id = parts.part_sub_category');
		//		$this->db->where('active', 1);
		$this->db->order_by('sorting', 'asc');
		$q = $this->db->get();
		$data = array();
		if ($q->num_rows() > 0) {
			$data = $q->result_array();
			foreach ($data as $key => $value) {
//				$this->db->select('*');
				//				$this->db->where('part_sub_category', $data[$key]["id"]);
				//				$this->db->where('chassis_id', $chassis_id);
				//				$this->db->where('active', 1);
				//				$this->db->from('parts');
				//				$data[$key]["parts"] = $this->db->get()->num_rows();
				$search_data['sub_category'] = $data[$key]["id"];
				$data[$key]["all_parts"] = $this->Part_model->get_shop($search_data, 0, 10, $chassis_id, $phone);
				$data[$key]["parts"] = count($data[$key]["all_parts"]);
			}
			return $data;
		}
		return $data;

	}
	public function manage_parts_cat() {
		$this->db->select('*');
		$this->db->from('parts_categories');
		$this->db->order_by('sorting', 'asc');
		$q = $this->db->get();
		return $q->result();
	}
	public function get_subcategory_by_id($id) {
		$this->db->where_in('id', $id);
		$this->db->select('*');
		$this->db->from('parts_sub_categories');
		$q = $this->db->get();
		return $q->result();
	}
	public function get_subcat_by_id($id) {
		$this->db->where_in('id', $id);
		$this->db->from('parts_sub_categories');
		$q = $this->db->get();
		return $q->row();
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
		return $this->db->update('parts_sub_categories', $data);
	}

	public function get_by_id($id) {
		$this->db->select('*');
		$this->db->where('id', $id);
		$this->db->from('parts_sub_categories');
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			return $q->result();
		}
		return false;
	}
	public function get_by_name($name) {
		$this->db->select('*');
		$this->db->where('name', $name);
		$this->db->from('parts_sub_categories');
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			return $q->result();
		}
		return false;
	}

}
?>
