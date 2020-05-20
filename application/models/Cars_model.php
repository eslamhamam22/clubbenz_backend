<?php

class Cars_model extends CI_Model {
	public function get_by_table_and_field_name($table, $field, $val) {
		$this->db->select('*');
		$this->db->where($field, $val);
		$this->db->from($table);
		$q = $this->db->get();
		return $q->result();
	}
	public function get_car_by_vin_prefix($vin_prefix) {
		$this->db->select("*");
		$this->db->where("vin_prefix", $vin_prefix);
		$this->db->from("cars");
		$this->db->limit(1, 0);
		$q = $this->db->get();
		return $q->row();
	}
	public function get_year_by_yearStart($year) {
		$this->db->select("*");
		$this->db->where("name", $year);
		$this->db->from("years");
		$q = $this->db->get();
		return $q->row();
	}

	public function get_year_by_yearEnd($year) {
		$this->db->select("*");
		$this->db->where("name", $year);
		$this->db->from("years");
		$q = $this->db->get();
		return $q->row();
	}

	public function user_manage() {
		$this->db->select('*');
		$this->db->from('users');
		$q = $this->db->get();
		return $q->result();
	}
	public function user_del($id) {
		$this->db->where('id ,$id');
		$this->db->delete('users');
		return $this->db->affected_rows();

	}

	public function user_data($id) {
		$this->db->where('id', $id);
		$this->db->from('users');
		$q = $this->db->get();
		return $q->row();
	}
	public function user_update_value($name, $id) {
		$this->db->where('id', $id);
		$this->db->update('users', $name);
		return $this->db->affected_rows();
	}

	/*public function get_home_services(){
		$this->db->select("*");
		$this->db->where("show_on_home",1);
		$this->db->from('services');
		$query =  $this->db->get();
		if($query->num_rows() > 0){
			return $query->result_array();
		}
		return false;
	}*/

	public function get_cars_information($model_id, $fuel_type, $year) {
		// $q = "select * from cars where model_id ='$model_id' and fuel_type = '$fuel_type' and (model_year_start <= '$year' or model_year_end >= '$year' )";
		// $query =  $this->db->query($q);
		$this->db->select('*');
		$this->db->where('model_id', $model_id);
		$this->db->where('fuel_type', $fuel_type);
		$this->db->where('model_year_start <=', $year);
		$this->db->where('model_year_end >=', $year);
		$this->db->from('cars');
		$q = $this->db->get();
		return $q->result();
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
	public function get_fuel_type($id) {
		$this->db->select('*');
		$this->db->where('id', $id);
		$this->db->from('fuel_type');
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			$name = $q->row();
			return $name;

		}

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
	public function get_model($id) {
		$this->db->select('*');
		$this->db->where('id', $id);
		$this->db->from('years');
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			$name = $q->row();
			return $name;

		}

	}
	public function get_modell($id) {
		$this->db->select('*');
		$this->db->where('id', $id);
		$this->db->from('model');
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			$name = $q->row();
			return $name;

		}

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

	public function services_data($id) {
		$this->db->select('*');
		$this->db->where('id', $id);
		$this->db->from('services');
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			$name = $q->row();
			return $name;
		}
	}

	public function part_group_data($id) {
		$this->db->select('*');
		$this->db->where('id', $id);
		$this->db->from('part_group');
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			$name = $q->row();
			return $name;
		}
		return false;
	}
	public function manage_part() {
		$this->db->select('*');
		$this->db->order_by("id", "desc");
		$this->db->from('parts');
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
	public function workshop_tag($id) {
		$this->db->from('service_tag');
		$this->db->where('id', $id);
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			$name = $q->row();
			return $name;

		}
	}

	public function services_tag($id) {
		$this->db->from('service_tag');
		$this->db->where('id', $id);
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			$name = $q->row();
			return $name;

		}
	}
	public function part_sub_cat($id) {
		$this->db->select('*');
		$this->db->where('category', $id);
		$this->db->from('parts_sub_categories');
		$q = $this->db->get();
		$sub_item = '<option value="">select Part Subctegory item</option>';
		foreach ($q->result() as $subcat) {
			$sub_item .= '<option value="' . $subcat->id . '">' . $subcat->name . '</option>';
		}
		return $sub_item;
	}

}

?>
