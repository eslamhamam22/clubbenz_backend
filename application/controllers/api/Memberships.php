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
		$memberships= $this->Membership_model->membership_features_manage();
		if($memberships){
			foreach ($memberships as $membership){
				$membership->benefits= $this->Membership_model->get_benefits_by_membership($membership->id);
				foreach ($membership->benefits as $benefit){
					$benefit->details= $this->Membership_model->get_membership_rel_id($benefit->id);
				}
			}
		}

		$data["current"]= null;
		if($user_id){
			$current_membership= $this->Membership_model->get_current_membership_by_user($user_id);
			$data["current"]= $current_membership;
			if($data["current"]){
				$data["current"]->end_date= $this->add_months_to_date($data["current"]->created_date, $data["current"]->duration);
				if (strtotime(date("Y-m-d H:i:s")) > strtotime($data["current"]->end_date)) {
					$data["current"] = false;
				}
			}
		}

		$data["memberships"]= $memberships;
		$this->response($data, 200);
	}
	public function add_months_to_date($date, $months) {
		return date("Y-m-d H:i:s", strtotime($months . " month", strtotime($date)));
	}

	public function subscribe_post(){
		$arr= array();
		$new_array["user_id"] = $this->post('user_id');
		$new_array["address"] = $this->post('address');
		$new_array["membership_id"] = $this->post('membership');
		$new_array["nid"] = $this->post('nid');
		if (isset($_FILES['idFrontPhoto']) && !empty($_FILES['idFrontPhoto'])) {
			$filename = $_FILES['idFrontPhoto']['name'];
			if ($filename != "") {
				$config['upload_path'] = './upload';
				$config['file_name'] = time() . $filename;
				$config['allowed_types'] = 'gif|jpg|png|jpeg|JPG|PNG';
				$this->upload->initialize($config);
				if (!$this->upload->do_upload('idFrontPhoto')) {
					$arr['error_picture'] = $this->upload->display_errors();
				} else {
					$data = $this->upload->data();
					$new_array['nid_front'] = $data['file_name'];
				}
			}
		}
		if (isset($_FILES['idBackPhoto']) && !empty($_FILES['idBackPhoto'])) {
			$filename = $_FILES['idBackPhoto']['name'];
			if ($filename != "") {
				$config['upload_path'] = './upload';
				$config['file_name'] = time() . $filename;
				$config['allowed_types'] = 'gif|jpg|png|jpeg|JPG|PNG';
				$this->upload->initialize($config);
				if (!$this->upload->do_upload('idBackPhoto')) {
					$arr['error_picture'] = $this->upload->display_errors();
				} else {
					$data = $this->upload->data();
					$new_array['nid_rear'] = $data['file_name'];
				}
			}
		}
		if (isset($_FILES['licenseFrontPhoto']) && !empty($_FILES['licenseFrontPhoto'])) {
			$filename = $_FILES['licenseFrontPhoto']['name'];
			if ($filename != "") {
				$config['upload_path'] = './upload';
				$config['file_name'] = time() . $filename;
				$config['allowed_types'] = 'gif|jpg|png|jpeg|JPG|PNG';
				$this->upload->initialize($config);
				if (!$this->upload->do_upload('licenseFrontPhoto')) {
					$arr['error_picture'] = $this->upload->display_errors();
				} else {
					$data = $this->upload->data();
					$new_array['licence_front'] = $data['file_name'];
				}
			}
		}
		if (isset($_FILES['licenseBackPhoto']) && !empty($_FILES['licenseBackPhoto'])) {
			$filename = $_FILES['licenseBackPhoto']['name'];
			if ($filename != "") {
				$config['upload_path'] = './upload';
				$config['file_name'] = time() . $filename;
				$config['allowed_types'] = 'gif|jpg|png|jpeg|JPG|PNG';
				$this->upload->initialize($config);
				if (!$this->upload->do_upload('licenseBackPhoto')) {
					$arr['error_picture'] = $this->upload->display_errors();
				} else {
					$data = $this->upload->data();
					$new_array['licence_rear'] = $data['file_name'];
				}
			}
		}

		$output= $this->Membership_model->subscribe($new_array);

		$this->response($arr, 200);
	}

}
