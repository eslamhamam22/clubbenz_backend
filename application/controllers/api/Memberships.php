<?php
require APPPATH . '/libraries/REST_Controller.php';
class Memberships extends REST_Controller {
	public $data;
	function __construct() {
		parent::__construct();
		ini_set("display_errors", 1);
		error_reporting(1);
		$this->load->model('users_model');
		$this->load->model('Membership_model');

		$this->load->library('upload');
		$this->load->database();
		ini_set('display_errors', 1);
	}

	public function get_memberships_get(){
		$user_id = $this->get('user_id');
		$features= $this->Membership_model->membership_manage();
		$memberships["platinum"]["features"]= array();
		$details= $this->Membership_model->edit_membership_fet(1);
		$memberships["platinum"]["price"]= $details[0]->platinum_price;
		$memberships["platinum"]["image"]= $details[0]->platinum_image;
		$memberships["gold"]["features"]= array();
		$memberships["gold"]["price"]= $details[0]->price;
		$memberships["gold"]["image"]= $details[0]->gold_image;
		$data["current"]= null;
		if($user_id){
			$current_membership= $this->Membership_model->get_current_membership_by_user($user_id);
			$data["current"]= $current_membership;
		}

		foreach ($features as $feature){
			$feature->details= $this->Membership_model->get_membership_rel_id($feature->id);
			if($feature->platinum == "platinum")
				array_push($memberships["platinum"]["features"], $feature);
			if($feature->gold == "gold")
				array_push($memberships["gold"]["features"], $feature);
		}
		$data["memberships"]= $memberships;
		$this->response($data, 200);
	}
	public function subscribe_post(){
		$user_id = $this->post('user_id');
		$address = $this->post('address');
		$membership = $this->post('membership');
		$this->Membership_model->subscribe($user_id, $membership, $address);

		$this->response(true, 200);
	}

}
