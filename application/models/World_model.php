<?php

class World_model extends CI_Model {
	public function get_countries() {
		$this->db->select('*');
		$this->db->from('countries');
		if ($query = $this->db->get()) {
			return $query->result();
		} else {
			return false;
		}
	}
	public function get_cities() {
		$this->db->select('*');
		$this->db->from('cities');
		if ($query = $this->db->get()) {
			return $query->result();
		} else {
			return false;
		}
	}
	public function get_country_by_id($id) {
		$this->db->select('*');
		$this->db->where('id', $id);
		$this->db->from('countries');
		if ($query = $this->db->get()) {
			return $query->result()[0];
		} else {
			return false;
		}
	}
	public function get_state_by_id($id) {
		$this->db->select('*');
		$this->db->where('id', $id);
		$this->db->from('states');
		if ($query = $this->db->get()) {
			return $query->result()[0];
		} else {
			return false;
		}
	}
	public function get_states_by_country($country_id) {
		$this->db->select('*');
		$this->db->from('states');
		$this->db->where('country_id', $country_id);
		if ($query = $this->db->get()) {
			return $query->result();
		} else {
			return false;
		}
	}
	public function get_states_by_country_as_options($country_id) {
		$this->db->select('*');
		$this->db->where('country_id', $country_id);
		$this->db->from('states');
		$q = $this->db->get();
		$sub_item = '<option value="">Select</option>';
		foreach ($q->result() as $state) {
			$sub_item .= '<option value="' . $state->id . '">' . $state->name . '</option>';
		}
		return $sub_item;
	}
}
