<?php
ob_start();
class Car_guide extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->library('upload');
		$this->load->helper(array('form', 'url'));
		$this->load->library(['ion_auth', 'form_validation']);
		$this->load->helper(['url', 'language']);
		$this->load->model('Service_tag_model', 'service_tag');
		$this->load->model('Fuel_model', 'fuel');
		$this->load->model('Years_model', 'year');
		$this->load->model('Classes_model', 'classes');
		$this->load->model('Advertisement_model', 'advertisement');
		$this->load->model('Car_guide_model', 'car_guide');
		$this->load->model('Reviews_model', 'review');
		$this->load->model('Users_model');

		$this->load->model('acl_model');
		$this->load->model('Users_model');

		$this->load->library('session');

		if (!$this->ion_auth->logged_in()) {
			redirect('auth', 'refresh');
		}

		if ($this->input->get('error')) {
			$this->data['error'] = $this->input->get('error');
		}
		if ($this->input->get('success')) {
			$this->data['success'] = $this->input->get('success');
		}
	}
	public function index() {
		$this->data['rec'] = $this->car_guide->get_car_guide();
		$this->load->view('car_guide', $this->data);
	}
	public function add_car_guide() {

		if ($this->input->post()) {

			/*$rules = array(
				array(
					'field'   => 'link1',
					'label'   => 'Link1',
					'rules'   => 'trim|required'
				),
				array(
					'field'   => 'chassis',
					'label'   => 'Chassis',
					'rules'   => 'trim|required'
				)
			);*/

			/*$this->form_validation->set_rules($rules);		*/
			/*if ($this->form_validation->run()){*/

			$dataInfo = array();
			$files = $_FILES;
			$cpt = count($_FILES['image']['name']);
			for ($i = 0; $i < $cpt; $i++) {
				$_FILES['file']['name'] = $files['image']['name'][$i];
				$_FILES['file']['type'] = $_FILES['image']['type'][$i];
				$_FILES['file']['tmp_name'] = $_FILES['image']['tmp_name'][$i];
				$_FILES['file']['error'] = $_FILES['image']['error'][$i];
				$_FILES['file']['size'] = $_FILES['image']['size'][$i];
				$config = array();
				$config['upload_path'] = './upload/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg|JPG|PNG';
				$this->upload->initialize($config);
				if ($this->upload->do_upload('file')) {
					$dataInfo[] = $this->upload->data();
				}
			}

			if (isset($_FILES['file_pdf']) && !empty($_FILES['file_pdf'])) {
				$filename = $_FILES['file_pdf']['name'];
				if ($filename != "") {
					$config['upload_path'] = './upload/';
					$config['file_name'] = time() . $filename;
					$config['allowed_types'] = 'pdf';
					$this->upload->initialize($config);
					if ($this->upload->do_upload('file_pdf')) {
						$pdfdataInfo = $this->upload->data();
					}
				}
			}

			if ($this->input->post('listing_photo') == "file_pdf") {

				$file_pdf = $pdfdataInfo['file_name'];
				$link1 = "";

			} else {

				$file_pdf = "";
				$link1 = $this->input->post('link1');

			}

			if ($this->input->post('full_chassis_info') == "image") {

				$pic2 = $dataInfo[0]['file_name'];
				$link2 = "";

			} else {

				$pic2 = "";
				$link2 = $this->input->post('link2');

			}
			if ($this->input->post('fues_rely_location') == "image") {

				$pic3 = $dataInfo[1]['file_name'];
				$link3 = "";

			} else {

				$pic3 = "";
				$link3 = $this->input->post('link3');

			}
			if ($this->input->post('tire_pressure') == "image") {

				$pic4 = $dataInfo[2]['file_name'];
				$link4 = "";

			} else {

				$pic4 = "";
				$link4 = $this->input->post('link4');

			}

			$data = array(
				'pic1' => $pic2,
				'pic2' => $file_pdf,
				'pic3' => $pic3,
				'pic4' => $pic4,
				'link1' => $link2,
				'link2' => $link1,
				'link3' => $link3,
				'link4' => $link4,
				'chassis' => $this->input->post('chassis'),

			);

			$result = $this->car_guide->add_car_guide($data);

			if ($result) {
				redirect(base_url('car_guide/?success=Add  successfully!'));
			} else {
				redirect(base_url('car_guide/add_car_guide?error=Some error!'));
			}

		}
		$this->data['chassis'] = $this->car_guide->get_car_chassis();
		$this->load->view('add_car_guide', $this->data);
	}
	public function del_car_guide($id) {
		$id = $this->car_guide->del_car_guide($id);
		if ($id) {
			redirect(base_url('car_guide/?success= Delete successfully!'));
		} else {
			redirect(base_url('car_guide/?error=Some error!'));
		}

	}
	public function edit_car_guide($id) {
		if ($this->input->post()) {

			/*$rules = array(
				array(
					'field'   => 'link1',
					'label'   => 'Link1',
					'rules'   => 'trim|required'
				),
				array(
					'field'   => 'chassis',
					'label'   => 'Chassis',
					'rules'   => 'trim|required'
				)
			);*/

			/*$this->form_validation->set_rules($rules);		*/
			/*if ($this->form_validation->run()){*/
			$dataInfo = array();
			$files = $_FILES;

			$cpt = count($_FILES['image']['name']);
			for ($i = 0; $i < $cpt; $i++) {

				if (!empty($files['image']['name'][$i])) {
					$fname = $_FILES['file_name']['name'] = $files['image']['name'][$i];
					$_FILES['file_name']['tmp_name'] = $files['image']['tmp_name'][$i];
					$config = array();
					$config['upload_path'] = './upload/';
					$config['file_name'] = time() . $fname;
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$this->upload->initialize($config);
					$this->upload->do_upload('file_name');

					$dataInfo = $this->upload->data();
					if ($i == 0) {
						$picture1 = $dataInfo['file_name'];
					} else if ($i == 1) {
						$picture2 = $dataInfo['file_name'];
					} else if ($i == 2) {
						$picture3 = $dataInfo['file_name'];
					}
				}
			}

			if (!empty($files['file_pdf']['name'])) {
				$fname = $_FILES['file_name']['name'] = $files['file_pdf']['name'];
				$_FILES['file_name']['tmp_name'] = $files['file_pdf']['tmp_name'];
				$config = array();
				$config['upload_path'] = './upload/';
				$config['file_name'] = time() . $fname;
				$config['allowed_types'] = 'pdf';
				$this->upload->initialize($config);
				$this->upload->do_upload('file_name');
				$pdfdataInfo = $this->upload->data();
				$pdf = $pdfdataInfo['file_name'];
			}
			if ($this->input->post('listing_photo') == "file_pdf") {

				if (isset($pdf)) {

					$file_pdf = $pdf;
					$link1 = "";

				} else {
					$file_pdf = $this->input->post('is_listing_photo');
					$link1 = "";
				}

			} else {

				$file_pdf = "";
				$link1 = $this->input->post('link1');

			}

			if ($this->input->post('full_chassis_info') == "image") {

				if (isset($picture1)) {

					$pic2 = $picture1;
					$link2 = "";

				} else {

					$pic2 = $this->input->post('is_full_chassis_info');
					$link2 = "";

				}

			} else {

				$pic2 = "";
				$link2 = $this->input->post('link2');

			}
			if ($this->input->post('fues_rely_location') == "image") {
				if (isset($picture2)) {

					$pic3 = $picture2;
					$link3 = "";

				} else {

					$pic3 = $this->input->post('is_fues_rely_location');
					$link3 = "";

				}

			} else {

				$pic3 = "";
				$link3 = $this->input->post('link3');

			}
			if ($this->input->post('tire_pressure') == "image") {

				if (isset($picture3)) {

					$pic4 = $picture3;
					$link4 = "";

				} else {

					$pic4 = $this->input->post('is_tire_pressure');
					$link4 = "";

				}

			} else {

				$pic4 = "";
				$link4 = $this->input->post('link4');

			}

			$data = array(
				'pic1' => $pic2,
				'pic2' => $file_pdf,
				'pic3' => $pic3,
				'pic4' => $pic4,
				'link1' => $link1,
				'link2' => $link2,
				'link3' => $link3,
				'link4' => $link4,
				'chassis' => $this->input->post('chassis'),

			);

			$this->car_guide->update_car_guide($data, $id);
			redirect(base_url('car_guide/?success=update  successfully!'));
			/*}
				else{
					$error=validation_errors();
					$this->data['error'] = $error;
			*/
		}
		$this->data['chassis_number'] = $this->car_guide->get_chassis();
		$this->data['chassis'] = $this->car_guide->get_car_chassis();
		$this->data['rec'] = $this->car_guide->edit_car_guide($id);
		$this->load->view('edit_car_guide', $this->data);
	}
	public function manage_cluster_error() {
		$this->data['rec'] = $this->car_guide->get_cluster_error();
		$this->load->view('manage_cluster_error', $this->data);
	}
	public function add_cluster_error() {
		if ($this->input->post()) {
			$user = $this->ion_auth->user()->row();
			$userid = $user->id;

			$cha = implode(',', $this->input->post('chassis'));

			/*$rules = array(
				array(
					'field'   => 'link1',
					'label'   => 'Link1',
					'rules'   => 'trim|required'
				),
				array(
					'field'   => 'chassis',
					'label'   => 'Chassis',
					'rules'   => 'trim|required'
				)
			);*/

			/*$this->form_validation->set_rules($rules);		*/
			/*if ($this->form_validation->run()){*/

			$dataInfo = array();
			$files = $_FILES;
			$cpt = count($_FILES['image']['name']);
			for ($i = 0; $i < $cpt; $i++) {

				$_FILES['file']['name'] = $files['image']['name'][$i];
				$_FILES['file']['type'] = $_FILES['image']['type'][$i];
				$_FILES['file']['tmp_name'] = $_FILES['image']['tmp_name'][$i];
				$_FILES['file']['error'] = $_FILES['image']['error'][$i];
				$_FILES['file']['size'] = $_FILES['image']['size'][$i];
				$config = array();
				$config['upload_path'] = './upload/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$this->upload->initialize($config);
				$this->upload->do_upload('file');
				$dataInfo[] = $this->upload->data();
			}

			$data = array(
				'pic1' => $dataInfo[0]['file_name'],
				'pic2' => $dataInfo[1]['file_name'],
				'pic3' => $dataInfo[2]['file_name'],
				'pic4' => $dataInfo[3]['file_name'],
				'title' => $this->input->post('title'),
				'title_arabic' => $this->input->post('title_arabic'),
				'description' => $this->input->post('description'),
				'description_arabic' => $this->input->post('description_arabic'),
				// 'chassis' => $this->input->post('chassis'),
				'chassis' => $cha,
				'shop_type' => $this->input->post('shop_type'),
				'shop_id' => $this->input->post('shop'),

			);

			$last_id = $this->car_guide->add_cluster_error($data);
			if ($last_id) {
				$new_data = array();
				$ct = count($this->input->post('descriptions'));

				for ($i = 0; $i < $ct; $i++) {
					$pic = "";
					if ($_FILES['pic']['name'][$i] != '') {
						$_FILES['file']['name'] = $_FILES['pic']['name'][$i];
						$_FILES['file']['type'] = $_FILES['pic']['type'][$i];
						$_FILES['file']['tmp_name'] = $_FILES['pic']['tmp_name'][$i];
						$_FILES['file']['error'] = $_FILES['pic']['error'][$i];
						$_FILES['file']['size'] = $_FILES['pic']['size'][$i];
						$config['upload_path'] = './upload/';
						/*$config['file_name'] = time().$fname;*/
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						$this->upload->initialize($config);
						$this->upload->do_upload('file');
						$data = $this->upload->data();
						$pic = $data['file_name'];
					}
					$new_data['description'] = $this->input->post('descriptions')[$i];
					$new_data['description_arabic'] = $this->input->post('description_arabics')[$i];
					$new_data['cluster_error_id'] = $last_id;

					$new_data['submited_by'] = $userid;
					$new_data['picture'] = $pic;
					$new_data['status'] = "approve";

					$rec = $this->car_guide->add_cluster_error_solution($new_data);
				}
			}
			if ($rec) {
				redirect(base_url('car_guide/manage_cluster_error?success=Add  successfully!'));
			} else {
				redirect(base_url('car_guide/add_cluster_error?error=Some error!'));
			}

			/*}else{

				$error=validation_errors();

				$this->data['error'] = $error;
			}*/
		}
		$this->data['chassis'] = $this->car_guide->get_car_chassis();
		$this->load->view('add_cluster_error', $this->data);
	}
	private function pic($fname) {

		if ($fname != '') {
			$config['upload_path'] = './upload/';
			/*$config['file_name'] = time().$fname;*/
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->upload->initialize($config);
			$this->upload->do_upload('pic');
			return $data = $this->upload->data('file_name');
		}
	}
	public function del_cluster_error($id) {
		$res = $this->car_guide->del_cluster_error($id);
		if ($res) {

			$response = $this->car_guide->del_cluster_error_solution($id);
			redirect(base_url('car_guide/manage_cluster_error/?success= Delete successfully!'));
		} else {
			redirect(base_url('car_guide/manage_cluster_error?error=Some error!'));
		}
	}
	public function edit_cluster_error($id) {
		if ($this->input->post()) {
			$user = $this->ion_auth->user()->row();
			$userid = $user->id;
			// $cha = implode(',', $this->input->post('chassis'));
			$cha = !empty($this->input->post('chassis')) ? implode(',', $this->input->post('chassis')) : "";
			/*$rules = array(
				array(
					'field'   => 'link1',
					'label'   => 'Link1',
					'rules'   => 'trim|required'
				),
				array(
					'field'   => 'chassis',
					'label'   => 'Chassis',
					'rules'   => 'trim|required'
				)
			);*/

			/*$this->form_validation->set_rules($rules);		*/
			/*if ($this->form_validation->run()){*/
			$dataInfo = array();
			$files = $_FILES;
			$data = array(
				'title' => $this->input->post('title'),
				'title_arabic' => $this->input->post('title_arabic'),
				'description' => $this->input->post('description'),
				'description_arabic' => $this->input->post('description_arabic'),
				'chassis' => $cha,
				'shop_type' => $this->input->post('shop_type'),
				'shop_id' => $this->input->post('shop'),
			);

			$cpt = count($_FILES['image']['name']);
			for ($i = 0; $i < $cpt; $i++) {
				if (!empty($_FILES['image']['name'][$i])) {
					$_FILES['file']['name'] = $_FILES['image']['name'][$i];
					$_FILES['file']['type'] = $_FILES['image']['type'][$i];
					$_FILES['file']['tmp_name'] = $_FILES['image']['tmp_name'][$i];
					$_FILES['file']['error'] = $_FILES['image']['error'][$i];
					$_FILES['file']['size'] = $_FILES['image']['size'][$i];
					$config = array();
					$config['upload_path'] = './upload/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$this->upload->initialize($config);
					$this->upload->do_upload('file');
					$dataInfo[] = $this->upload->data();
					$dataInfo = $this->upload->data();
					if ($i == 0) {
						$data['pic1'] = $dataInfo['file_name'];
					} else if ($i == 1) {
						$data['pic2'] = $dataInfo['file_name'];
					} else if ($i == 2) {
						$data['pic3'] = $dataInfo['file_name'];
					} else if ($i == 3) {
						$data['pic4'] = $dataInfo['file_name'];
					}

				}
			}

			$this->car_guide->update_cluster_error($data, $id);

			if ($this->input->post('image_input_id_1')) {
				//	echo $this->input->post('image_input_id_1');
			} else {
				// echo "kocha";
			}
			// echo $this->input->post('image_input_id_1');
			$model_image = '';

			if (empty($data['pic1']) && empty($this->input->post('image_input_id_1'))) {
				//	echo  "p1";
				$data['pic1'] = '';

			}
			if (empty($data['pic2']) && empty($this->input->post('image_input_id_2'))) {
				//echo  "p2";
				$data['pic2'] = '';

			}
			if (empty($data['pic3']) && empty($this->input->post('image_input_id_3'))) {
				//	echo  "p3";
				$data['pic3'] = '';

			}
			if (empty($data['pic4']) && empty($this->input->post('image_input_id_4'))) {
				// echo  "p4";
				$data['pic4'] = '';

			}
			if ($data) {
				$this->car_guide->update_cluster_error($data, $id);
			}

			// $model_image = array(
			// 	'pic1'	=> $this->input->post('image_id_1'),
			// 	'pic2'	=> $this->input->post('image_id_2'),
			// 	'pic3' 	=> $this->input->post('image_id_3'),
			// 	'pic4' 	=> $this->input->post('image_id_4'),
			// );

			$files = $_FILES;
			$new_data = array();
			$ct = count($this->input->post('descriptions'));
			$indexx = 0;
			$counter = 0;
			for ($i = 0; $i < $ct; $i++) {
				$pic = "";
				$indexuse = $indexx++;
				if ($_FILES['pic']['name'][$i] != '') {
					$_FILES['file']['name'] = $_FILES['pic']['name'][$i];
					$_FILES['file']['type'] = $_FILES['pic']['type'][$i];
					$_FILES['file']['tmp_name'] = $_FILES['pic']['tmp_name'][$i];
					$_FILES['file']['error'] = $_FILES['pic']['error'][$i];
					$_FILES['file']['size'] = $_FILES['pic']['size'][$i];
					$config['upload_path'] = './upload/';
					/*$config['file_name'] = time().$fname;*/
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$this->upload->initialize($config);
					$this->upload->do_upload('file');
					$data = $this->upload->data();
					$pic = $data['file_name'];

				} else {
					if (isset($this->input->post('file')[$i])) {
						$pic = $this->input->post('file')[$i];
					}

				}
				$new_data['description'] = $this->input->post('descriptions')[$i];
				$new_data['status'] = "approve";
				$new_data['description_arabic'] = $this->input->post('description_arabics')[$i];
				$new_data['cluster_error_id'] = $id;
				$new_data['submited_by'] = $userid;
				$error_id = $this->input->post('error_id')[$i];
				$new_data['picture'] = $pic;
				if (!empty($error_id)) {

					if ($this->input->post('sol_' . $counter) == '' && $_FILES['pic']['name'][$i] == '') {
						$new_data['picture'] = "";
					} else {

					}

					$rec = $this->car_guide->edit_cluster_error_solution($new_data, $error_id);
					$counter++;

				} else {

					$this->car_guide->add_cluster_error_solution($new_data);
				}
			}

			// redirect(base_url('car_guide/manage_cluster_error?success=update  successfully!'));
			/*}
		else{
			$error=validation_errors();
			$this->data['error'] = $error;
		}*/
		}
		$this->data['chassis_number'] = $this->car_guide->get_chassis();
		$this->data['chassis'] = $this->car_guide->get_car_chassis();
		$this->data['rec'] = $this->car_guide->edit_cluster_error($id);
		$this->load->view('edit_cluster_error', $this->data);
	}

	public function manage_error_solution() {
		$this->data['rec'] = $this->car_guide->get_error_solution();
		$this->load->view('manage_error_solution', $this->data);
	}

	public function add_error_solution() {
		if ($this->input->post()) {
			$user = $this->ion_auth->user()->row();
			$userid = $user->id;

			$description = implode(',', $description);

			$description_arabic = implode(',', $description);
			/*$rules = array(
				array(
					'field'   => 'link1',
					'label'   => 'Link1',
					'rules'   => 'trim|required'
				),
				array(
					'field'   => 'chassis',
					'label'   => 'Chassis',
					'rules'   => 'trim|required'
				)
			);*/

			/*$this->form_validation->set_rules($rules);		*/
			/*if ($this->form_validation->run()){*/
			$file_name = $_FILES['image']['name'];
			$new_array = array(
				'cluster_error_id' => $this->input->post('cluster_error_id'),
				'title' => $this->input->post('title'),
				'title_arabic' => $this->input->post('title_arabic'),
				'description' => $description,
				'description_arabic' => $description_arabic,
				'status' => $this->input->post('status'),
				'submited_by' => $userid,
			);
			if ($file_name != '') {
				$config['upload_path'] = './upload/';
				$config['file_name'] = time() . $file_name;
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$this->upload->initialize($config);
				if (!$this->upload->do_upload('image')) {
					echo ($this->upload->display_errors());
				} else {
					$data = $this->upload->data();
					$new_array['picture'] = $data['file_name'];
				}
			}
			$result = $this->car_guide->add_error_solution($new_array);
			if ($result) {
				redirect(base_url('car_guide/manage_error_solution?success=Add  successfully!'));
			} else {
				redirect(base_url('car_guide/add_error_solution?error=Some error!'));
			}
			/*}else{

				$error=validation_errors();

				$this->data['error'] = $error;
			}*/
		}
		$this->data['cluster_error'] = $this->car_guide->manage_cluster_error();
		$this->load->view('add_error_solution', $this->data);
	}
	public function del_error_solution($id) {
		$id = $this->car_guide->del_error_solution($id);
		if ($id) {
			redirect(base_url('car_guide/solution/?success= Delete successfully!'));
		} else {
			redirect(base_url('car_guide/solution?error=Some error!'));
		}

	}
	public function edit_error_solution($id) {
		if ($this->input->post()) {

			date_default_timezone_set('Egypt');
			$user = $this->ion_auth->user()->row();
			$userid = $user->id;
			/*$rules = array(
				array(
					'field'   => 'link1',
					'label'   => 'Link1',
					'rules'   => 'trim|required'
				),
				array(
					'field'   => 'chassis',
					'label'   => 'Chassis',
					'rules'   => 'trim|required'
				)
			);*/

			/*$this->form_validation->set_rules($rules);		*/
			/*if ($this->form_validation->run()){*/
			$file_name = $_FILES['image']['name'];
			$new_array = array(
				'description' => $this->input->post('description'),
				'description_arabic' => $this->input->post('description_arabic'),
				'status' => $this->input->post('status'),
				'updated_by' => $userid,
				'updated_on' => date("Y-m-d H:i"),
			);
			if ($file_name != '') {
				$config['upload_path'] = './upload/';
				$config['file_name'] = time() . $file_name;
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$this->upload->initialize($config);
				if (!$this->upload->do_upload('image')) {
					echo ($this->upload->display_errors());
				} else {
					$data = $this->upload->data();
					$new_array['picture'] = $data['file_name'];
				}
			}

			$this->car_guide->update_error_solution($new_array, $id);
			redirect(base_url('car_guide/solution?success=update  successfully!'));
			/*}
				else{
					$error=validation_errors();
					$this->data['error'] = $error;
			*/
		}

		$this->data['id'] = $id;
		$this->data['us'] = $this->car_guide->edit_error_solution($id);
		$user = $this->Users_model->get_user_by_id($this->data['us']->submited_by);
		$this->data['cluster_error'] = $this->car_guide->get_cluster_error_by_id($this->data['us']->cluster_error_id);
		$this->data['user'] = $user;
		// echo "<pre>";
		// echo $this->data['user']->email;
		// return;
		$this->load->view('edit_error_solution', $this->data);
	}
	public function add_ajax_description() {

		$this->load->view('ajax_error_description');

	}
	public function get_shops() {

		$shop_type = $this->input->post('shop_type');

		echo $this->car_guide->get_shop($shop_type);
	}

	public function delete_cluster_solution() {

		$id = $this->input->post('id');

		echo $this->car_guide->delete_cluster_solution($id);
	}

	public function solution() {
		$this->data['rec'] = $this->car_guide->get_solution();
		$this->load->view('solution', $this->data);
	}
	public function status_update_solution() {
		if ($this->input->post()) {
			$id = $this->input->post('id');

			$data = array(
				'status' => $this->input->post('status'),
				'description' => $this->input->post('description'),
			);
			$this->car_guide->solution_status_update($data, $id);
			redirect(base_url('car_guide/solution'));

		}
	}

}?>





