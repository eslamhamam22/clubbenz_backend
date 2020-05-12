<?php

class Provider_plan_model extends CI_Model {
	public function __construct() {
		parent::__construct();

		$this->load->model('Plan_model');
	}
	public function get_plans_by_provider($provider_id) {
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
	public function get_current_plan_by_provider($provider_id) {
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
	public function get_current_plan_with_details_by_provider($provider_id) {
		$this->db->select('*');
		$this->db->from('provider_plan');
		$this->db->where('provider_id', $provider_id);
		$this->db->order_by('id', "DESC");
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 1) {
			$current_plan = $query->result()[0];
			return $this->get_plan_data($current_plan);
		} else {
			return false;
		}
	}
	public function get_plan_data($current_plan) {
		if ($current_plan) {
			$current_plan->plan = $this->Plan_model->get_plan_by_id($current_plan->plan_id)[0];
			$current_plan->end_date = $this->add_months_to_date($current_plan->created_at, $current_plan->plan->frequency, $current_plan->plan->extra_days);
			if (strtotime(date("Y-m-d H:i:s")) > strtotime($current_plan->end_date)) {
				$current_plan->status = "expired";
			}

			return $current_plan;
		}
		return false;
	}
	public function add_months_to_date($date, $months, $extra_days) {
		$date = date("Y-m-d H:i:s", strtotime($extra_days . " days", strtotime($date)));
		return date("Y-m-d H:i:s", strtotime($months . " month", strtotime($date)));
	}
	public function subscribe($provider_id, $plan_id, $extra_days) {
		$this->db->insert('provider_plan', ["provider_id" => $provider_id, "plan_id" => $plan_id, "extra_days" => $extra_days, "status" => "active"]);
	}

}
