<?php
class Serviceshop_model extends CI_Model {
	public function add_fuel($name) {
		$this->db->insert('fuel_type', $name);
		return $this->db->insert_id();
	}
	function count_shop($data) {
		$this->db->select('*');
		$where = " 1 ";
		if ($data['search'] != '') {
			// $where.=" and (serch_tag like '%".$data['search']."%' )";
			$this->db->like("serch_tag_arabic", $data['search']);
			$this->db->or_like("serch_tag", $data['search']);
			$this->db->or_like("arabic_name", $data['search']);
			$this->db->or_like("name", $data['search']);
			$this->db->or_like("service_tag_string", $data['search']);
		}
		if ($data['shop_open'] == true) {
			date_default_timezone_set('Egypt');
			$time = date("H:i");
			$day = date('l');

			$this->db->Where('opening_hours<=', $time);
			$this->db->Where('closing_hours>=', $time);
			$this->db->not_like('off_day', $day);
		}
		if ($data['service_id'] != '') {
			$where .= " and (service_type like '%" . $data['service_id'] . "%' )";
		}
		$this->db->where($where, NULL, FALSE);

		$q = $this->db->get("service_shop");
		//echo $this->db->last_query();
		if ($q->num_rows() > 0) {
			return $q->num_rows();
		}
		return 0;
	}

	function get_shop($data, $start, $limit) {
//		 $this->db->limit($limit,$start);
		$this->db->select("*,'service_shop' as shop_type");

		if ($data['search'] != '') {
			// $where.=" and (serch_tag like '%".$data['search']."%' )";
			$this->db->group_start()
				->like("serch_tag_arabic", $data['search'])
				->or_like("serch_tag", $data['search'])
				->or_like("arabic_name", $data['search'])
				->or_like("name", $data['search'])
				->or_like("service_tag_string", $data['search'])
				->group_end();
		}
		if (array_key_exists('service_id', $data) && $data['service_id'] != '') {
			$this->db->like("service_type", $data['service_id']);

			// $where.=" and (service_type like '%".$data['service_id']."%' )";

		}
		//  $this->db->where($where,NULL,FALSE);

		if ($data['shop_open'] == true) {
			date_default_timezone_set('Egypt');
			$time = date("H:i");
			$day = date('l');

			$this->db->Where('opening_hours<=', $time);
			$this->db->Where('closing_hours>=', $time);
			$this->db->not_like('off_day', $day);
		}
		$q = $this->db->get("service_shop");
		if ($q->num_rows() > 0) {
			return $q->result();
		}
		return 0;
	}
	function get_all_service_shop() {

		$this->db->select('*');
		$this->db->from("service_shop");
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			return $q->result();
		}
		return 0;
	}

	function get_details($id) {
		$this->db->select('*');
		$this->db->where("id", $id);
		$this->db->from("service_shop");
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			return $q->row();
		}
	}
	public function manage_service_shop() {
		$this->db->select('*');
		$this->db->order_by("id", "desc");
		$this->db->from('service_shop');
		$q = $this->db->get();
		return $q->result();
	}
	public function add_service_shop($data) {
		$this->db->insert('service_shop', $data);
		return $this->db->insert_id();
	}

	public function get_by_id($id) {
		$this->db->select('*');
		$this->db->where('id', $id);
		$this->db->from('services');
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			return $q->result();
		}
		return false;
	}

	public function get_by_name($name) {
		$this->db->select('*');
		$this->db->where('name', $name);
		$this->db->from('services');
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			return $q->result();
		}
		return false;
	}
	public function get_service_tag_by_id($id) {
		$this->db->select('*');
		$this->db->where('id', $id);
		$this->db->from('service_tag');
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			return $q->result();
		}
		return false;
	}

	public function get_service_tag_by_name($name) {
		$this->db->select('*');
		$this->db->where('name', $name);
		$this->db->from('service_tag');
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			return $q->result();
		}
		return false;
	}
	public function service_data($id) {
		$this->db->select('*');
		$this->db->where('id', $id);
		$this->db->from('services');
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			$name = $q->row();
			return $name;
		}
	}
	public function service_manage() {
		$this->db->select('*');
		$this->db->from('services');
		$this->db->order_by('sorting', 'asc');
		$q = $this->db->get();
		return $q->result();
	}
	public function serviceshop_del($id) {
		$this->db->where('id', $id);
		$this->db->delete('service_shop');
		return $this->db->affected_rows();
	}
	public function edit_service_shop($id) {
		$this->db->where('id', $id);
		$this->db->from('service_shop');
		$q = $this->db->get();
		return $q->row();
	}
	public function update_service_shop($data, $id) {
		$this->db->where('id', $id);
		$this->db->update('service_shop', $data);

	}
	public function total_serviceshop() {
		return $this->db->count_all('service_shop');
	}
	function fetch_data() {
		$this->db->select(array("name", "arabic_name", "web_link", "city", "country", "location_latitude", "location_longitude", "opening_hours", "closing_hours", "off_day", "phone", "facebok_link", "address", "serch_tag", "serch_tag_arabic", "email", "created_date", "tweeter", "service_type", "service_tag"));
		$this->db->from("service_shop");
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			return $q->result();
		}
		return 0;
	}
}

?>
