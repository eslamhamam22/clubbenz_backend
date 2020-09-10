<?php
class Service_model extends CI_Model {
	public function service_manage() {
		$this->db->select('*');
		$this->db->from('services');
		$this->db->order_by('sorting', 'asc');
		$q = $this->db->get();
		$data = array();
		if ($q->num_rows() > 0) {
			$data = $q->result_array();
			foreach ($data as $key => $value) {
				$this->db->select('*');
				// $this->db->where('part_sub_category', $data[$key]["id"]);
				$this->db->or_like("service_type", $data[$key]["id"]);
				// $this->db->where('chassis_id', $chassis_id);
				$this->db->from('service_shop');
				$data[$key]["service_shop"] = $this->db->get()->num_rows();
			}
			return $data;
		}
		return $data;
		// return $q->result_array();
	}
	public function get_home_page_service($data) {
		$this->db->insert_batch('services', $data);
	}

	public function get_home_page_service_api() {
		$this->db->select('*');
		$this->db->from('services');
		$this->db->where('show_services', 'on');
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			return $q->result_array();
		} else {
			return "Home page Services Not Available";
		}

	}

	public function insertexcel() {
		$this->db->select(array('sorting', 'name', 'arabic_name', 'show_services'));
		$this->db->from('services');
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			return $q->result();
		}
		return 0;
	}

	public function fetch_data() {
		$this->db->select(array('sorting', 'name', 'arabic_name', 'show_services'));
		$this->db->from('services');
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			return $q->result();
		}
		return 0;
	}

	public function add_services($new_array) {
		$this->db->insert('services', $new_array);
		return $this->db->insert_id();
	}
	public function service_del($id) {
		$this->db->where('id', $id);
		$this->db->delete('services');
		return $this->db->affected_rows();

	}
	public function edit_service($id) {
		$this->db->where('id', $id);
		$this->db->from('services');
		$q = $this->db->get();
		return $q->result();
	}
	public function service_update($new_array, $id) {
		$this->db->where('id', $id);
		$this->db->update('services', $new_array);
		return $this->db->affected_rows();
	}
	function get_services_names_by_ids($ids) {
		$ids_arr = explode(',', $ids);
		$this->db->where_in('id', $ids_arr);
		$this->db->select('*');
		$this->db->from('services');
		$q = $this->db->get();
		return $q->result();
	}
	public function add_services_type($new_array) {
		$this->db->insert('services_type', $new_array);
		return $this->db->insert_id();
	}

	public function manage_service_type() {
		$this->db->select('*');
		$this->db->from('services_type');
		$q = $this->db->get();
		return $q->result();
	}

	public function service_type_del($id) {
		$this->db->where('id', $id);
		$this->db->delete('services_type');
		return $this->db->affected_rows();

	}

	public function edit_service_type($id) {
		$this->db->where('id', $id);
		$this->db->from('services_type');
		$q = $this->db->get();
		return $q->result();
	}

	public function service_type_update($new_array, $id) {
		$this->db->where('id', $id);
		$this->db->update('services_type', $new_array);
		return $this->db->affected_rows();
	}

}