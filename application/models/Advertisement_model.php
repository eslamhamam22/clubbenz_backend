<?php
class Advertisement_model extends CI_Model {
	public function manage_advertisement() {
		$this->db->select('*');
		$this->db->order_by("id", "desc");
		$this->db->from('advertisement');
		$q = $this->db->get();
		return $q->result();
	}

	public function manage_advertisement_home($type) {
		$this->db->select('*');
		if ($type == "active") {
			$this->db->where("status", "active");
		}
		$this->db->where("type", "Slider");
		$this->db->from('advertisement');
		$q = $this->db->get();
		return $q->result();
	}
	public function manage_advertisement_timeDisplay($type) {
		$this->db->select('*');
		$this->db->where("type", "Walk Out");
		if ($type == "active") {
			$this->db->where("status", "active");
		}

		$this->db->from('advertisement');
		$q = $this->db->get();
		return $q->result();
	}
	public function manage_advertisement_banner($type) {
		$this->db->select('*');
		$this->db->where("type", "Home Page Bottom")->where("pagename", "banner")
			->or_where("type", "Provider Listing")->where("pagename", "banner")
			->or_where("type", "Company Profile")->where("pagename", "banner")
			->or_where("type", "Review Comment")->where("pagename", "banner");
		$this->db->from('advertisement');
		$q = $this->db->get();
		return $q->result();
	}

	public function manage_partshops_banner($type) {
		$this->db->select('*');
		$this->db->where("type", "Home Page Bottom")->where("pagename", "partshops")
			->or_where("type", "Provider Listing")->where("pagename", "partshops")
			->or_where("type", "Company Profile")->where("pagename", "partshops")
			->or_where("type", "Review Comment")->where("pagename", "partshops");
		$this->db->from('advertisement');
		$q = $this->db->get();
		return $q->result();
	}

	public function manage_services_banner($type) {
		$this->db->select('*');
		$this->db->where("type", "Home Page Bottom")->where("pagename", "services")
			->or_where("type", "Provider Listing")->where("pagename", "services")
			->or_where("type", "Company Profile")->where("pagename", "services")
			->or_where("type", "Review Comment")->where("pagename", "services");
		$this->db->from('advertisement');
		$q = $this->db->get();
		return $q->result();
	}

	public function manage_partcatlog_banner($type) {
		$this->db->select('*');
		$this->db->where("type", "Home Page Bottom")->where("pagename", "partcatlog")
			->or_where("type", "Provider Listing")->where("pagename", "partcatlog")
			->or_where("type", "Company Profile")->where("pagename", "partcatlog")
			->or_where("type", "Review Comment")->where("pagename", "partcatlog");
		$this->db->from('advertisement');
		$q = $this->db->get();
		return $q->result();
	}

	public function add_advertisement($new_array) {
		$this->db->insert('advertisement', $new_array);
		return $this->db->affected_rows();
	}
	public function del_advertisement($id) {
		$this->db->where('id', $id);
		$this->db->delete('advertisement');
		return $this->db->affected_rows();

	}
	public function edit_advertisement($id) {
		$this->db->select('*');
		$this->db->where('id', $id);
		$this->db->from('advertisement');
		$q = $this->db->get();
		return $q->row();
	}
	public function update_advertisement($data, $id) {
		$this->db->where('id', $id);
		$this->db->update('advertisement', $data);
		return $this->db->affected_rows();
	}
	public function get_advertisement($type) {
		$this->db->select('*');
		$this->db->where('type', $type);
		$this->db->from('advertisement');
		$q = $this->db->get();
		return $q->result();
	}

}
?>