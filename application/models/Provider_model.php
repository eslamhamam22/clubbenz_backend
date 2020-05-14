<?php
class Provider_model extends CI_model {

	public function select_provider() {
		$this->db->select('*');
		$this->db->from('provider_user');

		if ($query = $this->db->get()) {
			return $query->result_array();
		} else {
			return false;
		}
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

	public function get_parts($id) {
		$this->db->select('*');
		$this->db->where('provider_id', $id);

		$this->db->order_by("id", "desc");
		$this->db->from('parts');
		$q = $this->db->get();
		return $q->result();
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
