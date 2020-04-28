<?php

class Provider_plan_model extends CI_Model
{
	public function get_plans_by_provider($provider_id){
		$this->db->select('*');
		$this->db->from('provider_plan');
		$this->db->where('provider_id', $provider_id);
		$this->db->order_by('id', "DESC");
		if ($query = $this->db->get()) {
			return $query->result();
		} else {
			return false;
		}
	}
	public function get_current_plan_by_provider($provider_id){
		$this->db->select('*');
		$this->db->from('provider_plan');
		$this->db->where('provider_id', $provider_id);
		$this->db->order_by('id', "DESC");
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 1) {
			return $query->result()[0];
		} else {
			return false;
		}
	}
	public function subscribe($provider_id, $plan_id, $extra_days){
		$this->db->insert('provider_plan', ["provider_id"=> $provider_id, "plan_id"=> $plan_id, "extra_days"=> $extra_days, "status"=> "active"]);
	}

}
