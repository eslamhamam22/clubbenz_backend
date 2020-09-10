<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Import Model
 *
 * @author Coders Mag Team
 *
 * @email  info@techarise.com
 */

class Site extends CI_Model {

	public function getModelId($model_name) {

		$this->db->select('*');
		$this->db->from('model');
		$this->db->where('name', $model_name);
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			$name = $q->row();
			return $name;
		}

	}

	public function getChassisId($chassis_num) {

		$this->db->select('*');
		$this->db->from('chassis');
		$this->db->where('chassis_num', $chassis_num);
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			$name = $q->row();
			return $name;
		}

	}

	public function getFuelTypeId($fuel_name) {

		$this->db->select('*');
		$this->db->from('fuel_type');
		$this->db->where('name', $fuel_name);
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			$name = $q->row();
			return $name;
		}

	}

	public function add_car_data($data) {
		$this->db->insert('cars', $data);
		return $this->db->insert_id();
	}

}
