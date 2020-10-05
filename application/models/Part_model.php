<?php
class Part_model extends CI_Model {
	function count_shop($data, $start, $limit, $chassis) {
		if ($data['search']) {
			$this->db->like("title", $data['search']);
			$this->db->like("title", $data['brand_id']);

		}
		if ($data['type'] == 'New') {
			$where = " (part_case='New' or part_case='New&Used') ";
			$this->db->where($where, NULL, FALSE);
		} else if ($data['type'] == 'Used') {
			$where = " (part_case='Used' or part_case='New&Used') ";
			$this->db->where($where, NULL, FALSE);
		}
		$this->db->where("chassis_id", '24');
		$this->db->or_where("chassis_id", $chassis);

		//	$where ="(chassis_id='.$chassis.' or chassis_id='24')";
		//$this->db->where($where, NULL, FALSE);
		if ($data['sub_category']) {
			$this->db->where("part_sub_category", $data['sub_category']);
		}

		if ($data['brand_id']) {

			$this->db->like("part_brand", $data['brand_id']);
		}
		// if($data['chassis_id']){
		//     $this->db->where("chassis_id",$data['chassis_id']);
		// }

		$this->db->select('*');
		$q = $this->db->get("parts");

		if ($q->num_rows() > 0) {
			return $q->num_rows();
		}
		return 0;

	}
	public function get_chassis_by_id($id) {
		$this->db->select('*');
		$this->db->where('id', $id);
		$this->db->from('chassis');
		$this->db->order_by('chassis_num', 'asc');
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			$name = $q->row();
			return $name;
		}
	}

	public function get_chassis_by_model($model_id) {
		$this->db->select("id");
		$this->db->from("chassis");
		$this->db->where('model_id', $model_id);
		$q = $this->db->get();
		return $q->result();
	}

	public function get_chassis() {
		$this->db->select('*');
		$this->db->from('chassis');
		$this->db->where('chassis_num  !=', 'All');
		$this->db->order_by('chassis_num', 'asc');
		$q = $this->db->get();
		return $q->result();
	}
	public function get_user($email) {
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('email', $email);
		$q = $this->db->get();
		return $q->result();
	}

	function get_shop($data, $start, $limit, $chassis, $phone) {

		$chassis_ids = array('24', $chassis);

		if ($data['search']) {

			$this->db->like("title", $data['search']);
			$this->db->or_like('part_number', $data['search']);
			$this->db->or_like('parts.id', $data['search']);
		}

		if ($data['type'] == 'New') {
			$where = " (part_case='New' or part_case='New&Used') ";

			$this->db->where($where, NULL, FALSE);

		} else if ($data['type'] == 'Used') {

			$where = " (part_case='Used' or part_case='New&Used') ";
			$this->db->where($where, NULL, FALSE);

		}

		if ($data['sub_category']) {
			$this->db->where("part_sub_category", $data['sub_category']);
		}
		if ($data['brand_id']) {
			$this->db->like("part_brand", $data['brand_id']);

		}

		$this->db->select('parts.*');
		$this->db->from("parts");
		$this->db->where('parts.active', 1);
		$this->db->where('parts.status', "approve");

		$this->db->join('provider_user', 'parts.provider_id = provider_user.id');
		$this->db->join('countries', 'provider_user.country = countries.name');
		$this->db->join('parts_sub_categories', 'parts.part_sub_category = parts_sub_categories.id');
		$q = $this->db->get();

		if ($q->num_rows() > 0) {
			$arr['shops'] = $q->result();
			foreach ($arr['shops'] as $val) {
				$val->plan = $this->Provider_plan_model->get_current_plan_with_details_by_provider($val->provider_id);
			}
			$arr['shops'] = array_filter($arr['shops'], function ($part) use ($phone, $chassis) {
				$chassis_arr = explode(',', $part->chassis_id);
				if (in_array($chassis, $chassis_arr)) {

					return true;
				}
				if ($part->date_expire && !empty($part->date_expire) && strtotime(date("Y-m-d")) > strtotime($part->date_expire)) {
					return false;
				}

				if (!$part->plan || $part->plan->status != "active") {
					return false;
				}

				if ($part->available_location == "National" && $phone) {
					$phonecode = "+" . $part->phonecode;
					if (strpos($phone, $phonecode) !== false) {
						return true;
					} else {
						return false;
					}
				}
				return true;
			});
			//
			$arr['shops'] = array_slice($arr['shops'], $start, $limit);
			return $arr['shops'];
		}
		return array();
	}
	function get_brand($brand) {
		$this->db->where("id", $brand);
		$this->db->from("brands");
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			return $q->row();

		}
		return 0;
	}

	function get_details($id) {
		$this->db->select('*');
		$this->db->where("id", $id);
		$this->db->from("parts");
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			return $q->row();
		}
	}
	public function manage_part($email) {
		$this->db->select('*');
		if ($email && $email != 'admin@admin.com') {
			$this->db->where('email', $email);
		}

		$this->db->order_by("status = 'pending'", 'DESC');
		$this->db->order_by('status');
		$this->db->order_by("id", "desc");
		$this->db->from('parts');
		$q = $this->db->get();
		return $q->result();
	}

	public function get_chassis_number($id) {
		$this->db->select('*');
		$this->db->where('id', $id);
		$this->db->from('chassis');
		$this->db->order_by('chassis_num', 'asc');
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			$name = $q->row();
			return $name;
		}
	}
	public function get_model_number($id) {
		$this->db->select('*');
		$this->db->where('id', $id);
		$this->db->from('model');
		// $this->db->order_by('chassis_num', 'asc');
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			$name = $q->row();
			return $name;
		}

	}
	public function add_part($data) {
		$this->db->insert('parts', $data);
		return $this->db->insert_id();
	}

	public function del_part($id) {
		$this->db->where('id', $id);
		$this->db->delete('parts');
		return $this->db->affected_rows();
	}

	public function approve_part($id) {
		$this->db->where('id', $id);
		$this->db->update('parts', ["status" => 'approve']);
		return $this->db->affected_rows();
	}

	public function reject_part($id) {
		$this->db->where('id', $id);
		$this->db->update('parts', ["status" => 'reject']);
		return $this->db->affected_rows();
	}

	public function pending_part($id) {
		$this->db->where('id', $id);
		$this->db->update('parts', ["status" => 'pending']);
		return $this->db->affected_rows();
	}

	public function edit_part($id) {
		$this->db->where('id', $id);
		$this->db->from('parts');
		$q = $this->db->get();
		return $q->row();
	}
	public function same_part($part, $id) {
		$this->db->limit('10');
		$this->db->where('id !=', $id);
		$this->db->where('part_category', $part);
		$this->db->select('*');
		$this->db->from('parts');
		$q = $this->db->get();
		return $q->result_array();
	}
	public function part_brand() {
		$this->db->select("*");
		$this->db->from("brands");
		$q = $this->db->get();
		return $q->result();

	}
	public function update_part($data, $id) {
		$this->db->where('id', $id);
		$this->db->update('parts', $data);
		return $this->db->affected_rows();
	}
	public function views_update($id, $data) {
		$this->db->where('id', $id);
		$this->db->update('parts', $data);
		return $this->db->affected_rows();
	}
	public function manage_parts_cat() {
		$this->db->select('*');
		$this->db->from('parts_categories');
		$this->db->order_by('sorting', 'asc');
		$q = $this->db->get();
		return $q->result();
	}
	public function get_all_parts() {
		$this->db->order_by('sorting', 'asc');
		$this->db->from('parts_categories');
		$q = $this->db->get();
		return $q->result();
	}
	public function get_part_by_chassis($chassis) {
		$this->db->where('chassis', $chassis);
		$this->db->order_by('sorting', 'asc');
		$this->db->from('parts_categories');
		$q = $this->db->get();
		return $q->result();
	}
	public function get_parts_by_categories_id($chassis) {
		//	$this->db->where_in('part_category',$ids);
		$this->db->select('*');
		$this->db->like("chassis_id", $chassis);
		//		$this->db->or_where("chassis_id", $chassis);
		$this->db->limit(10, 0);
		$this->db->order_by("views", "desc");
		$this->db->where("active", 1);
		$this->db->from('parts');
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			return $q->result();
		}
		return false;
	}

	public function get_part_main_image($id, $type) {
		$this->db->select('*');
		$this->db->where('part_id', $id);
		if ($type == 'main') {
			$this->db->where('is_default', 'yes');
		}
		$this->db->from('part_photos');
		$q = $this->db->get();
		$name = $q->row();

		if ($q->num_rows() > 0) {
			$name = $q->row();
			if ($type == 'main') {
				return $name->photo_name;
			} else {
				return $q->result();
			}
		}
	}
	public function manage_parts_sub_cat() {
		$this->db->select('psc.*');
		$this->db->from('parts_sub_categories psc');
		$this->db->order_by('sorting', 'asc');
		$q = $this->db->get();
		return $q->result();
	}
	public function manage_brand() {
		$this->db->select('*');
		$this->db->from('brands');
		$q = $this->db->get();
		return $q->result();
	}
	public function brand_data($id) {
		$this->db->select('*');
		$this->db->where('id', $id);
		$this->db->from('brands');
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			$name = $q->row();
			return $name;

		}

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
	public function get_subcategory_name($id) {
		$this->db->select('*');
		$this->db->where('id', $id);
		$this->db->from('parts_sub_categories');
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			$name = $q->row();
			return $name;

		}

	}
	public function part_sub_cat($id) {
		$this->db->select('*');
		$this->db->where('category', $id);
		$this->db->order_by('sorting', 'asc');
		$this->db->from('parts_sub_categories');
		$q = $this->db->get();
		$sub_item = '<option value="">select Part Subctegory item</option>';
		foreach ($q->result() as $subcat) {
			$sub_item .= '<option value="' . $subcat->id . '">' . $subcat->name . '</option>';
		}
		return $sub_item;
	}
	public function activate($id) {
		date_default_timezone_set('Egypt');
		$this->db->where('id', $id);
		$this->db->update('parts', ["active" => 1, "update_date" => date("Y-m-d H:i:s")]);
		return $this->db->affected_rows();
	}
	public function deactivate($id) {
		date_default_timezone_set('Egypt');
		$this->db->where('id', $id);
		$this->db->update('parts', ["active" => 0, "update_date" => date("Y-m-d H:i:s")]);
		return $this->db->affected_rows();
	}
	public function add_to_featured($id) {
		$this->db->where('id', $id);
		$this->db->update('parts', ["featured" => 1]);
		return $this->db->affected_rows();
	}
	public function remove_from_featured($id) {
		$this->db->where('id', $id);
		$this->db->update('parts', ["featured" => 0]);
		return $this->db->affected_rows();
	}

	public function get_parts($provider_id) {
		$this->db->select('*');
		$this->db->from('parts');
		$this->db->where('provider_id', $provider_id);
		$q = $this->db->get();
		return $q->result();
	}

	public function get_parts_id() {
		$this->db->select('*');
		$this->db->from('parts');
		if ($query = $this->db->get()) {
			return $query->result();
		} else {
			return false;
		}
	}

}

?>