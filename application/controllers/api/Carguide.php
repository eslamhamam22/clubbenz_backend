<?php
require APPPATH . '/libraries/REST_Controller.php';
class Carguide extends REST_Controller {
	public $data;
	function __construct() {
		parent::__construct();
		$this->load->model('Users_model', 'users_model');
		$this->load->model('Emailtemplates_model');
		$this->load->model('Serviceshop_model');
		$this->load->model('Workshop_model');
		$this->load->model('Part_model');
		$this->load->model('Brand_model');
		$this->load->model('Partcategory_model');
		$this->load->model('Partsubcategory_model');
		$this->load->model('Car_guide_model');
		$this->load->model('Reviews_model', 'review');
		$this->load->library('upload');
		$this->load->database();
		ini_set('display_errors', 1);
	}
	function submit_solution_post() {

		if ($this->post()) {
			$language = $this->post('language');

			$rules = array(
				array(
					'field' => 'language',
					'label' => 'language',
					'rules' => 'trim|required',
				),

			);

			$this->form_validation->set_error_delimiters('', '');
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				$picture_name = "";
				if (isset($_FILES['picture']) && !empty($_FILES['picture'])) {
					$filename = $_FILES['picture']['name'];
					if ($filename != "") {
						$config['upload_path'] = './upload/';
						$config['file_name'] = time() . $filename;
						$config['allowed_types'] = 'gif|jpg|png|jpeg|JPG|PNG';
						$this->upload->initialize($config);
						if (!$this->upload->do_upload('picture')) {
							$arr['error_picture'] = $this->upload->display_errors();
						} else {
							$data = $this->upload->data();
							$picture_name = $data['file_name'];
						}
					}
				}

				$user_row = $this->users_model->get_user_by_token($this->input->post("token"));

				date_default_timezone_set('Egypt');
				$arr = array(
					"submited_by" => $user_row->id,
					"status" => 'pending',
					"picture" => $picture_name,
					"created_on" => date("Y-m-d H:i"),
					"cluster_error_id" => $this->input->post('cluster_error_id'),
				);
				if ($language == 'english') {
					$arr['description'] = $this->input->post('description');
				}

				if ($language == 'arabic') {
					$arr['description_arabic'] = $this->input->post('description');
				}

				$result = $this->Car_guide_model->save_solution($arr);

				$arr['success'] = true;
				$arr['message'] = "Solution Saved successfully";

			} else {
				$arr['success'] = false;
				$arr['message'] = validation_errors();
			}
		} else {
			$arr['success'] = false;
			$arr['message'] = "All fields are requried";

		}
		$this->response($arr, 200);
	}

	function car_guide_post() {
		$chassis = $this->post('chassis');
		$arr = $this->Car_guide_model->get_car_guide_chassis($chassis);
		if ($arr) {
			$response['success'] = true;
			$response['data'] = $arr;
		} else {
			$response['success'] = false;
			$response['message'] = "No Record found";
		}
		$this->response($response, 200);
	}

	function cluster_error_post() {
		$chassis = $this->post('chassis');
		$arr = $this->Car_guide_model->get_cluster_error_chassis($chassis);

		if ($arr) {

//			if($arr['shop_type'] == "workshop"){
			//
			//				$arr['shop_id'] =$this->Car_guide_model->get_workshop($arr['shop_id']);
			//			}

			$response['success'] = true;
			$response['data'] = array_values($arr);
		} else {
			$response['success'] = false;
			$response['message'] = "No Record found";
		}
		$this->response($response, 200);
	}

	function cluster_error_solution_post() {
		$id = $this->post('cluster_error_id');
		$user_row = $this->users_model->get_user_by_token($this->input->post("token"));
		$arr1 = $this->Car_guide_model->get_cluster_error_chassis_id($id);
		$arr = $this->Car_guide_model->get_error_solution_id($id);
		$new_array = array();

		foreach ($arr as $r) {
			$r->is_user_like = $this->Car_guide_model->check_user_like_dislike_by_solution_id($r->id, $user_row->id);
			$r->total_likes = $this->Car_guide_model->solution_likes($r->id);
			$r->total_dislikes = $this->Car_guide_model->solution_dislikes($r->id);
			$new_array[] = $r->is_user_like;
		}

		if ($arr) {
			$response['success'] = true;
			$response['data'] = $arr;
			// $response['error_details'] = $new_array;

			$response['error_details'] = $this->Car_guide_model->get_cluster_error_by_id($id);

		} else {
			$response['success'] = false;
			$response['message'] = "No Record found";
		}

		$this->response($response, 200);
	}

	function error_solution_like_post() {
		$solution_id = $this->post('solution_id');
		$type = $this->post('type');
		$token = $this->post('token');
		$user_row = $this->users_model->get_user_by_token($token);
		if ($user_row->id != "") {
			$rules = array(
				array(
					'field' => 'solution_id',
					'label' => 'Solutiuon id',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'type',
					'label' => 'Type',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'token',
					'label' => 'Token',
					'rules' => 'trim|required',
				),

			);

			$this->form_validation->set_error_delimiters('', '');
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				$arr = array(
					"user_id" => $user_row->id,
					"solution_id" => $solution_id,
					"type" => $type,
				);
				$arr = $this->Car_guide_model->submit_review($arr);
				if ($arr) {
					$response['success'] = 'submited successfully';

				} else {
					$response['success'] = false;
					$response['message'] = "status already exist";
				}
				$this->response($response, 200);
			} else {
				$arr['success'] = false;
				$arr['message'] = validation_errors();
			}$this->response($arr, 200);
		} else {
			$response['success'] = false;
			$arr['message'] = 'User Not Exist';
			$this->response($arr, 200);
		}
	}

/*
$arr = $this->Car_guide_model->error_solution_by_like_id($id);
$like = $arr->likes;
$dislike = $arr->dislike;
if($rating == 'like'|| $rating == 'likes'){
$new_array = array(
'likes' =>  $like + 1
);
}
elseif($rating == 'dislike'|| $rating == 'dislikes'){
$new_array = array(
'dislike' =>  $dislike + 1
);
}
$this->Car_guide_model->error_solution_like_updte($new_array,$id);

$arr = $this->Car_guide_model->error_solution_by_like_id($id);

if($arr){
$response['success'] = true;
$response['data'] = $arr;
}else{
$response['success'] = false;
$response['message'] = "No Record found";
}
$this->response($response, 200);*/

}
