<?php

class Booking_model extends CI_Model {
	public function manage_booking() {
		/*$this->db->select('*');
			$this->db->from('booking');
		*/

		$query = "select b.*, w.name as workshop_name, u.first_name,u.last_name, u.phone from booking b, workshop w,users u where w.id=b.workshop_id and b.user_id=u.id";
		$q = $this->db->query($query);

		return $q->result();
	}
	public function status_update($data, $id) {

		$this->db->where('id', $id);
		$this->db->update('booking', $data);
	}

	public function get_user_booking($id) {
		$this->db->select('*');
		$this->db->from('booking');
		$this->db->where('user_id', $id);
		$this->db->order_by('id', 'DESC');
		$q = $this->db->get();
		return $q->result();
	}

	public function get_booking_completed() {
		$this->db->select('*');
		$this->db->from('booking');
		$this->db->where('status', 'completed');
		$this->db->order_by('id', 'DESC');
		$q = $this->db->get();
		return $q->result();
	}
	public function get_booking_pending() {
		$this->db->select('*');
		$this->db->from('booking');
		$this->db->where('status', 'pending');
		$this->db->order_by('id', 'DESC');
		$q = $this->db->get();
		return $q->result();
	}
	public function get_booking_rejected() {
		$this->db->select('*');
		$this->db->from('booking');
		$this->db->where('status', 'rejected');
		$this->db->order_by('id', 'DESC');
		$q = $this->db->get();
		return $q->result();
	}

	// public function update_active() {
	// 	$id = $_REQUEST['sid'];
	// 	$sval = $_REQUEST['sval'];
	// 	if ($sval == 1) {
	// 		$active = 0;
	// 	} else {
	// 		$active = 1;
	// 	}
	// 	$data = array('active' => $active);
	// 	$this->db->where('id', $id);
	// 	return $this->db->update('booking', $data);
	// }

}
?>