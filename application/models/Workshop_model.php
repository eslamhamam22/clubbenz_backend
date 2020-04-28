<?php

class Workshop_model extends CI_Model {

	public function add_fuel($name) {
		$this->db->insert('fuel_type', $name);
		return $this->db->insert_id();
	}

	function count_workshop($data) {
		$this->db->select('*');

		if ($data['shop_open'] == true) {
			date_default_timezone_set('Egypt');
			$time = date("H:i");
			$day = date('l');

			$this->db->Where('opening_hour<=', $time);
			$this->db->Where('closing_hour>=', $time);
			$this->db->not_like('day_off', $day);
		}

		if ($data['search'] != '') {
			$this->db->like("serch_tag", $data['search']);
			$this->db->or_like("serch_tag_arabic", $data['search']);
			$this->db->or_like("address", $data['search']);
			$this->db->or_like("name", $data['search']);
			$this->db->or_like("arabic_name", $data['search']);
			$this->db->or_like("service_tag_string", $data['search']);
		}
		$this->db->from("workshop");
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			return $q->num_rows();
		}
		return 0;
	}

	function get_workshops($data, $start, $limit) {
//         $this->db->limit($limit,$start);
		$this->db->select('*');
		if ($data['shop_open'] == true) {
			date_default_timezone_set('Egypt');
			$time = date("H:i");
			$day = date('l');
			$this->db->Where('opening_hour<=', $time);
			$this->db->Where('closing_hour>=', $time);
			$this->db->not_like('day_off', $day);
		}
		if ($data['search'] != '') {
			$this->db->like("serch_tag", $data['search']);
			$this->db->or_like("serch_tag_arabic", $data['search']);
			$this->db->or_like("address", $data['search']);
			$this->db->or_like("name", $data['search']);
			$this->db->or_like("arabic_name", $data['search']);
			$this->db->or_like("service_tag_string", $data['search']);
		}
		$this->db->from("workshop");
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			return $q->result();
		}
		return 0;
	}

	function get_all_workshops() {

		$this->db->select('*');
		$this->db->from("workshop");
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			return $q->result();
		}
		return 0;
	}

	function get_workshop_search($data, $start, $limit) {

		$this->db->select("*,'workshop' as shop_type");
		if ($data['search'] != '') {
			$this->db->like("serch_tag", $data['search']);
			$this->db->or_like("serch_tag_arabic", $data['search']);
			$this->db->or_like("address", $data['search']);
			$this->db->or_like("name", $data['search']);
			$this->db->or_like("arabic_name", $data['search']);
			$this->db->or_like("service_tag_string", $data['search']);

		}
		$this->db->from("workshop");
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			return $q->result();
		}
		return 0;
	}

	function get_workshops_detail($id) {

		$this->db->select('*');
		$this->db->where("id", $id);
		$this->db->from("workshop");
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			return $q->row();
		}
	}

	function get_services($ids) {
		$ids_arr = explode(',', $ids);
		$this->db->where_in("id", $ids_arr);
		$this->db->select('*');
		$this->db->from("services");
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			return $q->result();
		}
	}

	function save_review($data) {
		$this->db->insert('reviews', $data);
		return $this->db->insert_id();
	}

	function get_reviews($id, $type) {
		$this->db->select('*');
		$this->db->where("shop_id", $id);
		$this->db->where("type", $type);
		$this->db->where("status", 'approve');
		$this->db->from("reviews");
		$q = $this->db->get();
		return $q->result();

	}

	function get_user_picture($id) {
		$this->db->where("id", $id);
		$this->db->from("users");
		$q = $this->db->get();
		return $q->row();

	}

	function get_offers($id, $type) {
		$this->db->select('*');
		$this->db->where("shop_id", $id);
		$this->db->where("type", $type);
		$this->db->where("offer_end >=", date("Y-m-d"));
		$this->db->from("offers");
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			return $q->result();
		}
		return false;
	}
	public function average_rating($id, $type) {

		$sumRate = 0;
		$this->db->select("rate");
		$this->db->where("shop_id", $id);
		$this->db->where("type", $type);
		$this->db->where("status", 'approve');
		$this->db->from("reviews");
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $item) {
				$sumRate = $sumRate + $item->rate;
			}
			return $sumRate / $q->num_rows();

		}
		return 0;
	}

	public function manage_workshop() {
		$this->db->select('*');
		$this->db->order_by("id", "desc");
		$this->db->from('workshop');
		$q = $this->db->get();
		return $q->result();
	}

	function fetch_data() {
		$this->db->select(array('name', 'arabic_name', 'web', 'city', 'country', 'location_lat', 'location_lon', 'address', 'opening_hour', 'closing_hour', 'day_off', 'phone', 'offers_photo', 'twitter', 'email', 'serch_tag', 'serch_tag_arabic', 'photo_selection', 'facebook_page_link', 'created_date'));
		$this->db->from("workshop");
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			return $q->result();
		}
		return 0;
	}

	public function add_workshop($data) {
		$this->db->insert('workshop', $data);
		return $this->db->insert_id();
	}
	public function ws_del($id) {
		$this->db->where('id', $id);
		$this->db->delete('workshop');
		return $this->db->affected_rows();

	}
	public function edit_workshop($id) {
		$this->db->where('id', $id);
		$this->db->from('workshop');
		$q = $this->db->get();
		return $q->row();
	}
	public function update_ws($data, $id) {
		$this->db->where('id', $id);
		$this->db->update('workshop', $data);
		return $this->db->affected_rows();
	}
	public function total_workshop() {
		return $this->db->count_all('workshop');
	}
	public function update_active() {
		$id = $_REQUEST['sid'];
		$sval = $_REQUEST['sval'];
		if ($sval == 1) {
			$active = 0;
		} else {
			$active = 1;
		}
		$data = array('active' => $active);
		$this->db->where('id', $id);
		return $this->db->update('workshop', $data);
	}
}