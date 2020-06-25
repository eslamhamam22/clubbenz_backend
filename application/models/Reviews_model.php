<?php
class Reviews_model extends CI_Model {
	public function get_review() {
		$this->db->select("*");
		$this->db->from("reviews");
		$q = $this->db->get();
		return $q->result();

	}
	public function get_provider_reviews() {
		$this->db->select("*");
		$this->db->from("reviews");
		$this->db->where("type", "provider");
		$q = $this->db->get();
		return $q->result();

	}

	public function get_user_name($id) {
		if ($id != 0 && $id != "") {
			$this->db->select("*");
			$this->db->where('id', $id);
			$this->db->from('users');
			$query = $this->db->get();
			if ($query->num_rows() > 0) {
				$result = $query->row();
				return $result;
				//return $result->first_name." ".$result->last_name;
			}
			return "";
		}
		return "";
	}

	public function get_user($id) {
		if ($id != 0 && $id != "") {
			$this->db->select("*");
			$this->db->where('id', $id);
			$this->db->from('users');
			$this->db->join('reviews', 'reviews.user_id = users.id');
			$this->db->limit(1);
			$query = $this->db->get();
			if ($query->num_rows() == 1) {
				$val = $query->row();
				return $val->email;
			}
		}
		return "";
	}

	public function get_shop_name($id, $type) {

		if ($id != 0 && $id != '' && $type != "") {
			$this->db->where('id', $id);
			if ($type == "workshop") {
				$this->db->select('name');
				$this->db->from('workshop');
			}
			if ($type == "partsshop") {
				$this->db->select('name');
				$this->db->from('partshop');
			}
			if ($type == "serviceshop") {
				$this->db->select('name');
				$this->db->from('service_shop');
			}
			if ($type == "provider") {
				$this->db->select('user_name as name');
				$this->db->from('provider_user');
			}
			$q = $this->db->get();
			if ($q->num_rows() > 0) {
				return $q->row()->name;
			}
			return "";
		}
		return "";
	}

	public function status_update($data, $id) {
		$this->db->where('id', $id);
		$this->db->update('reviews', $data);
		return true;
	}

	public function approve_part($id) {
		$this->db->where('id', $id);
		$this->db->update('reviews', ["status" => 'approve']);
		return $this->db->affected_rows();
	}

	public function reject_part($id) {
		$this->db->where('id', $id);
		$this->db->update('reviews', ["status" => 'reject']);
		return $this->db->affected_rows();
	}

	public function get_email($id) {
		$this->db->select('*');
		$this->db->from('users');
		$this->db->join('reviews', 'reviews.user_id = users.id');
		$this->db->where('reviews.id', $id);
		$q = $this->db->get();
		$rows = $q->result();
		foreach ($rows as $row) {
			$sendTo = $row->email;
		}
		return $sendTo;
	}

	public function get_name($id) {
		$this->db->select('*');
		$this->db->from('users');
		$this->db->join('reviews', 'reviews.user_id = users.id');
		$this->db->where('reviews.id', $id);
		$q = $this->db->get();
		$rows = $q->result();
		foreach ($rows as $row) {
			$sendTo = $row->first_name . " " . $row->last_name;
		}
		return $sendTo;
	}

	public function get_reviews_pending() {
		$this->db->select("*");
		$this->db->from("reviews");
		$this->db->where('status', 'pending');
		$q = $this->db->get();
		return $q->result();

	}

	public function get_reviews_approved() {
		$this->db->select("*");
		$this->db->from("reviews");
		$this->db->where('status', 'approve');
		$q = $this->db->get();
		return $q->result();

	}

	public function get_reviews_rejected() {
		$this->db->select("*");
		$this->db->from("reviews");
		$this->db->where('status', 'reject');
		$q = $this->db->get();
		return $q->result();

	}

}

?>
