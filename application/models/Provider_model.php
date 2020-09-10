<?php
class Provider_model extends CI_model {

	public function select_provider() {
		$this->db->select('*');
		$this->db->from('provider_user');
		$this->db->order_by("status = 'pending'", 'DESC');
		$this->db->order_by('status');

		if ($query = $this->db->get()) {
			return $query->result_array();
		} else {
			return false;
		}
	}
	public function select_parts() {
		$this->db->select('*');
		$this->db->from('parts');
		$q = $this->db->get();
		return $q->result();
	}

	public function providerlist_del($id) {
		$this->db->where('id', $id);
		$this->db->delete('provider_user');
		return $this->db->affected_rows();

	}

	public function edit_providerlist($id) {
		$this->db->where('id', $id);
		$this->db->from('provider_user');
		$q = $this->db->get();
		return $q->result();
	}

	public function providerlist_update($new_array, $id) {
		$this->db->where('id', $id);
		$this->db->update('provider_user', $new_array);
		return $this->db->affected_rows();
	}
	public function register_user($provider_user) {

		$this->db->insert('provider_user', $provider_user);

	}

	public function login($email, $pass) {
		//$email,$pass
		$this->db->select('*');
		$this->db->from('provider_user');
		$this->db->where('user_email', $email);
		$this->db->where('user_password', $pass);

		if ($query = $this->db->get()) {
			return $query->result_array();
		} else {
			return false;
		}

	}
	public function email_check($email) {

		$this->db->select('*');
		$this->db->from('provider_user');
		$this->db->where('user_email', $email);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return false;
		} else {
			return true;
		}

	}
	public function signup($data) {
		$this->db->insert('provider_user', $data);
	}

	public function get_parts($id, $toArray = false) {
		$this->db->select('*');
		$this->db->where('provider_id', $id);

		$this->db->order_by("id", "desc");
		$this->db->from('parts');
		$q = $this->db->get();
		if ($toArray) {
			return $q->result_array();
		} else {
			return $q->result();
		}

	}

	public function get_parts_admin() {
		$this->db->select('*');
		$this->db->from('parts');
		$this->db->where('active', 1);
		if ($query = $this->db->get()) {
			return $query->result();
		} else {
			return false;
		}
	}
	public function in_active_parts() {
		$this->db->select('*');
		$this->db->from('parts');
		$this->db->where('active', 0);
		if ($query = $this->db->get()) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function get_partss() {
		$this->db->select('*');
		$this->db->from('parts');
		if ($query = $this->db->get()) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function provider_parts() {
		$this->db->select('*');
		$this->db->from('parts');
		$this->db->join('provider_user', 'parts.provider_id = provider_user.id');
		$this->db->where('parts.active', 1)->or_where('parts.active', 0);

		if ($query = $this->db->get()) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function get_chassis_num() {
		$this->db->select('*');
		$this->db->from('chassis');
		$this->db->where('chassis_num  !=', 'All');
		$this->db->order_by('chassis_num', 'asc');
		$q = $this->db->get();
		return $q->result();
	}
	public function get_parts_for_export($id, $toArray = false) {
		$this->db->select('id, title, title_arabic, part_number, part_category, part_sub_category, price, discount, part_case, part_brand, add_date as set_date, description, model_id as class_id, chassis_id, available_location, date_expire, num_stock');
		$this->db->where('provider_id', $id);

		$this->db->order_by("id", "desc");
		$this->db->from('parts');
		$q = $this->db->get();
		if ($toArray) {
			return $q->result_array();
		} else {
			return $q->result();
		}

	}

	public function get_parts_fet() {
		$this->db->select('*');
		$this->db->from('parts');
		$q = $this->db->get();
		return $q->result();
	}

	public function edit($data, $id) {
		$this->db->where('id', $id);
		$this->db->update('provider_user', $data);
	}
	public function get_provider_by_id($id) {
		$this->db->select('*');
		$this->db->from('provider_user');
		$this->db->where('id', $id);
		$q = $this->db->get();
		return $q->result();

	}

	public function update_status() {
		$id = $_REQUEST['sid'];
		$sval = $_REQUEST['sval'];
		if ($sval == 1) {
			$featured = 0;
		} else {
			$featured = 1;
		}
		$data = array('featured' => $featured);
		$this->db->where('id', $id);
		return $this->db->update('parts', $data);
	}
}

?>
