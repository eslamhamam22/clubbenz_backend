<?php

class Car_guide_model extends CI_Model {
	public function save_solution($arr) {
		$this->db->insert('cluster_error_solution', $arr);
		return $this->db->insert_id();
	}
	public function get_car_guide_chassis($chassis) {
		$this->db->select("*");
		$this->db->where("chassis", $chassis);
		$this->db->from("car_guide");
		$q = $this->db->get();
		return $q->row();
	}

	public function get_chassis() {
		$this->db->select('*');
		$this->db->from('chassis');
		$this->db->where('chassis_num  !=', 'All');
		$this->db->order_by('chassis_num', 'asc');
		$q = $this->db->get();
		return $q->result();
	}
	public function get_workshop($shop_id) {
		$this->db->select("*");
		$this->db->where("id", $shop_id);
		$this->db->from("workshop");
		$q = $this->db->get();
		return $q->row();
	}
	public function get_cluster_error_chassis($chassis) {
		$this->db->select("*");
		$this->db->where("chassis", $chassis);
		$this->db->or_where("chassis", 24);
		$this->db->from("cluster_error");
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			return $q->result();
		}
		return false;
	}
	public function get_cluster_error_chassis_id($id) {
		$this->db->select("*");
		$this->db->where("id", $id);
		$this->db->from("cluster_error");
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			return $q->row();
		}
		return false;
	}
	public function check_user_like_dislike_by_solution_id($id, $user_id) {
		$this->db->select("*");
		$this->db->where("solution_id", $id);
		$this->db->where("user_id", $user_id);
		$this->db->from(" user_solution_like_dislike");
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			return $q->result();
		}
		return false;
	}
	public function solution_likes($id) {
		$query = "SELECT count(*) as total FROM `user_solution_like_dislike` WHERE type= 'like' and solution_id = '$id'";
		$q = $this->db->query($query);
		if ($q->num_rows() > 0) {
			return $q->row()->total;
		}
		return 0;
	}
	public function solution_dislikes($id) {

		$query = "SELECT count(*) as total FROM `user_solution_like_dislike` WHERE type= 'dislike' and solution_id = '$id'";
		$q = $this->db->query($query);
		if ($q->num_rows() > 0) {
			return $q->row()->total;
		}
		return 0;
	}

	public function error_solution_by_id($id) {
		$this->db->select("*");
		$this->db->where("cluster_error_id", $id);
		$this->db->from("cluster_error_solution");
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			return $q->result();
		}
		return array();
	}
	public function submit_review($arr) {
		$this->db->select('*');
		$this->db->where('user_id', $arr['user_id']);
		$this->db->where('solution_id', $arr['solution_id']);
		$this->db->from('user_solution_like_dislike');
		$q = $this->db->get();
		$row = $q->row();
		if ($row) {
			$id = $row->id;
		}
//		print_r($row->id);
		//		die();
		if ($row) {
			$this->db->where('id', $id);
			$this->db->update('user_solution_like_dislike', $arr);
			return $this->db->affected_rows();

		} else {
			$this->db->insert('user_solution_like_dislike', $arr);
			return $this->db->insert_id();
		}
	}
	public function error_solution_by_like_id($id) {
		$this->db->select("*");
		$this->db->where("id", $id);
		$this->db->from("cluster_error_solution");
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			return $q->row();
		}
		return array();
	}
	public function error_solution_like_updte($data, $id) {
		$this->db->where("id", $id);
		$this->db->update("cluster_error_solution", $data);

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

	public function get_chassis_num() {
		$this->db->select('*');
		$this->db->from('chassis');
		$this->db->where('chassis_num  !=', 'All');
		$this->db->order_by('chassis_num', 'asc');
		$q = $this->db->get();
		return $q->result();
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

	public function get_car_guide() {
		$this->db->select("*");
		$this->db->from("car_guide");
		$q = $this->db->get();
		return $q->result();
	}
	public function get_car_chassis() {
//        $query = "select distinct(chassis) from cars";
		//        $q = $this->db->query($query);
		//        return $q->result();

		$this->db->select('*');
		$this->db->from('chassis');
		$this->db->where('chassis_num  !=', 'All');
		$this->db->order_by('chassis_num', 'asc');
		$q = $this->db->get();
		return $q->result();

	}
	public function get_shop_name_by_id($shop_type, $id) {
		if ($shop_type != '') {

			$this->db->select('*');
			$this->db->where('id', $id);
			if ($shop_type == 'workshop') {
				$this->db->from('workshop');
			} elseif ($shop_type == 'serviceshop') {
				$this->db->from('service_shop');
			} elseif ($shop_type == 'partshop') {
				$this->db->from('partshop');
			}
			$q = $this->db->get();
			if ($q->num_rows() > 0) {
				$name = $q->row();
				return $name;
			}
		}

	}
	public function get_shop($shop_type) {
		$this->db->select('*');
		if ($shop_type == 'workshop') {
			$this->db->from('workshop');
		} elseif ($shop_type == 'serviceshop') {
			$this->db->from('service_shop');
		} elseif ($shop_type == 'partshop') {
			$this->db->from('partshop');
		}

		$q = $this->db->get();
		$sub_item = '<option value="">select Shop</option>';
		foreach ($q->result() as $subcat) {
			$sub_item .= '<option value="' . $subcat->id . '">' . $subcat->name . '</option>';
		}
		return $sub_item;
	}
	public function delete_cluster_solution($id) {
		$this->db->where('id', $id);
		return $this->db->delete('cluster_error_solution');
		return $this->db->affected_rows();
	}

	public function add_car_guide($data) {
		$this->db->insert('car_guide', $data);
		return $this->db->insert_id();
	}
	public function del_car_guide($id) {
		$this->db->where('id', $id);
		return $this->db->delete('car_guide');
		return $this->db->affected_rows();
	}
	public function edit_car_guide($id) {
		$this->db->where('id', $id);
		$this->db->from('car_guide');
		$q = $this->db->get();
		return $q->row();
	}
	public function update_car_guide($data, $id) {
		$this->db->where('id', $id);
		$this->db->update('car_guide', $data);
		return $this->db->affected_rows();
	}
	public function get_cluster_error() {
		$this->db->select("*");
		$this->db->from("cluster_error");
		$q = $this->db->get();
		return $q->result();
	}

	public function get_cluster_error_by_id($id) {
		$this->db->select("*");
		$this->db->where('id', $id);
		$this->db->from("cluster_error");
		$q = $this->db->get();
		return $q->row();
	}

	public function add_cluster_error($data) {
		$this->db->insert('cluster_error', $data);
		return $this->db->insert_id();
	}
	public function del_cluster_error($id) {
		$this->db->where('id', $id);
		$this->db->delete('cluster_error');
		return $this->db->affected_rows();
	}
	public function del_cluster_error_solution($id) {
		$this->db->where('cluster_error_id', $id);
		$this->db->delete('cluster_error_solution');
		return $this->db->affected_rows();
	}
	public function edit_cluster_error($id) {
		$this->db->where('id', $id);
		$this->db->from('cluster_error');
		$q = $this->db->get();
		return $q->row();
	}
	public function update_cluster_error($data, $id) {
		$this->db->where('id', $id);
		$this->db->update('cluster_error', $data);
		return $this->db->affected_rows();
	}
	public function get_error_solution() {
		$this->db->select("*");
		$this->db->from(" cluster_error_solution");
		$q = $this->db->get();
		return $q->result();
	}
	public function get_error_solution_id($id) {
		$this->db->select("*");
		$this->db->where(" status", 'approve');
		$this->db->where(" cluster_error_id", $id);
		$this->db->from(" cluster_error_solution");
		$q = $this->db->get();
		return $q->result();
	}
	public function get_solution() {
		$this->db->select("*");
		$this->db->where('submited_by!=', 3);
		$this->db->where('submited_by!=', 186);
		$this->db->from("cluster_error_solution");
		$q = $this->db->get();
		return $q->result();
	}
	public function add_cluster_error_solution($data) {
		$this->db->insert('cluster_error_solution', $data);
		return $this->db->insert_id();
	}

	public function edit_cluster_error_solution($data, $id) {
		$this->db->where('id', $id);
		$this->db->update(' cluster_error_solution', $data);
	}
	public function del_error_solution($id) {
		$this->db->where('id', $id);
		$this->db->delete('cluster_error_solution');
		return $this->db->affected_rows();
	}
	public function update_error_solution($data, $id) {
		$this->db->where('id', $id);
		$this->db->update('cluster_error_solution', $data);
		return $this->db->affected_rows();
	}

	public function solution_status_update($data, $id) {
		$this->db->where('id', $id);
		$this->db->update('cluster_error_solution', $data);
	}
	public function edit_error_solution($id) {
		$this->db->select("*");
		$this->db->where('id', $id);
		$this->db->from("cluster_error_solution");
		$q = $this->db->get();
		return $q->row();
	}
}
