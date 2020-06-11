<?php
class Parts extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->library('upload');
		$this->load->helper(array('form', 'url'));
		$this->load->library(['ion_auth', 'form_validation']);
		$this->load->helper(['url', 'language']);
		$this->load->model('Service_tag_model', 'service_tag');
		$this->load->model('Serviceshop_model', 'serviceshop');
		$this->load->model('Part_model', 'part');
		$this->load->model('Part_photos_model', 'partphotos');
		$this->load->model('location_model', 'location');
		$this->load->model('Provider_Model');
		$this->load->model('Provider_plan_model');
		$this->load->model('Plan_model');

		$this->load->model('acl_model');
		$this->load->model('Users_model');
		$this->load->model('Partsubcategory_model');
		$this->load->model('Partcategory_model');
		$this->load->model('Chassis_model');
		$this->load->model('Brand_model');

		$this->load->model('Car_model', 'car');

		$this->load->library('session');

		if ($this->input->get('error')) {
			$this->data['error'] = $this->input->get('error');
		}
		if ($this->input->get('success')) {
			$this->data['success'] = $this->input->get('success');
		}
		if (!$this->session->userdata("id")) {
			redirect('/provider');
		}

		$this->load->helper('language');
		$this->lang->load('provider/left_nav', $this->session->userdata('site_lang') == "arabic" ? "arabic" : "english");
		$this->lang->load('provider/parts', $this->session->userdata('site_lang') == "arabic" ? "arabic" : "english");

	}
	public function index() {

		$identity = $this->session->userdata('identity');
		$this->data['title'] = 'Manage Part';
		$this->data['rec'] = $this->Provider_Model->get_parts($this->session->userdata("id"));
		$this->load->view('provider/manage_part', $this->data);
	}
	public function add_part() {

		if ($this->input->post()) {

//			if(empty($this->input->post('username'))){
			//				$user = $this->ion_auth->user()->row();
			//				$usname = $user->username;
			//			}
			//			else{
			//				$usname = $this->input->post('username');
			//
			//			}
			/*$brand=implode(',',$this->input->post('part_brand'));*/
			$rules = array(
				array(
					'field' => 'price',
					'label' => 'Price',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'title',
					'label' => 'Titile',
					'rules' => 'trim',
				),

				array(
					'field' => 'datepicker',
					'label' => 'Set Date of Listing',
					'rules' => 'trim',
				),
				array(
					'field' => 'part_category',
					'label' => 'part_category',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'part_sub_category',
					'label' => 'Part Sub Category',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'part_case',
					'label' => 'Part Status',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'part_brand[]',
					'label' => 'Part Brand',
					'rules' => 'trim|required',
				),
			);

			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				$file_name = $_FILES['image']['name'];

				$cha = implode(',', $this->input->post('chassis'));
				$model_select= implode(',', $this->input->post('model_id'));
				if(!$model_select || $model_select == "all" || $model_select == "" || (is_array($model_select) && (in_array(0, $model_select) || in_array("0", $model_select)))){
					$all_models=$this->car->get_classes();
					$model_select= array();
					foreach ($all_models as $single_model) {
						$model_select = array_merge($model_select, array($single_model->id));
					}

					$model_select = implode(',', $model_select);
				}

				if ($cha == "all") {

					$model_list = explode(",", $model_select);
					$chassis_list = [];
					foreach ($model_list as $single_model) {
						$model_chassis = $this->part->get_chassis_by_model($single_model);
						foreach ($model_chassis as $single_chassis) {
//							echo $single_chassis->id;
							$chassis_list = array_merge($chassis_list, array($single_chassis->id));
						}
					}
					$cha = implode(',', $chassis_list);

				}

				$part_brand = ($this->input->post('part_brand') != '') ? implode(',', $this->input->post('part_brand')) : "";
				//$part_case = ($this->input->post('part_case')!='') ? implode(',',$this->input->post('part_case')) : "";
				$title = $this->input->post('title');
				$arabicTitle = $this->input->post('title_arabic');

				if ($this->input->post('title') == "") {
					$title = $arabicTitle;
				} elseif ($this->input->post('title_arabic') == "") {
					$arabicTitle = $title;
				}
				$new_array = array(
					'title' => $title,
					'title_arabic' => $arabicTitle,
					'part_number' => $this->input->post('part_number'),
					'part_category' => $this->input->post('part_category'),
					'part_sub_category' => $this->input->post('part_sub_category'),
					'price' => $this->input->post('price'),
					'discount' => $this->input->post('discount'),
					'part_case' => $this->input->post('part_case'),
					'part_brand' => $part_brand,
					'add_date' => $this->input->post('add_date'),
					'description' => $this->input->post('description'),

//					'location_latitude'	 =>   $this->input->post('location_lat'),
					//					'location_longitude' =>   $this->input->post('location_lon'),

//					'location_zone' => $this->input->post('location_zone'),
					'username' => $this->session->userdata("user_name"),
					'email' => $this->session->userdata("user_email"),
					'phone' => $this->session->userdata("user_mobile"),
					'chassis_id' => $cha,
					'model_id' => $model_select,
//					'sort_order' => $this->input->post('sort_order'),
					'available_location' => $this->input->post('available_location'),
					// 'date_active' => $this->input->post('date_active'),
					'date_expire' => $this->input->post('date_expire'),
					'num_stock' => $this->input->post('num_stock'),
					'provider_id' => $this->session->userdata("id"),
				);
				print_r($new_array);
				$result = $this->part->add_part($new_array);

				$photo_array = array(

					'part_id' => $result,

				);

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
					if ($this->upload->do_upload('file')) {
						$dataInfo[] = $this->upload->data();
					}
				}

				for ($i = 0; $i < sizeof($dataInfo); $i++) {

					if ($i == 0) {
						$photo_array['is_default'] = "yes";
						$photo_array['photo_name'] = $dataInfo[0]['file_name'];
					} else {
						$photo_array['is_default'] = "no";
						$photo_array['photo_name'] = $dataInfo[$i]['file_name'];
					}
					$this->partphotos->add_part_photos($photo_array);

				}
				if ($result) {

					redirect(base_url('provider/Parts/?success=Added successfully!'));
				} else {
//					print_r($new_array);

					redirect(base_url('provider/Parts/?error=Unknown error!'));
				}
			} else {
				$error = validation_errors();
				$this->data['error'] = $error;
			}
		}

		$this->data['user'] = $this->part->get_user($this->session->userdata('user_email'));
		$this->data['chassis'] = $this->part->get_chassis();
		$this->data['location'] = $this->location->manage_location();
		$this->data['parts_category'] = $this->part->manage_parts_cat();
		$this->data['parts_sub_cat'] = $this->part->manage_parts_sub_cat();
		$this->data['brand'] = $this->part->manage_brand();
		$this->data['model_name'] = $this->car->get_classes();
		$this->data['title'] = 'Add Part';

		$this->load->view('provider/add_part', $this->data);
	}
	public function del_part($id) {
		$id = $this->part->del_part($id);
		if ($id) {
			redirect(base_url('provider/parts/?success= Deleted successfully!'));
		} else {
			redirect(base_url('provider/parts/?error=unknown error!'));
		}
	}
	public function edit_part($id) {

//		$user = $this->ion_auth->user()->row();
		//		$usname = $user->username;

		if ($this->input->post()) {

			$cha = !empty($this->input->post('chassis')) ? implode(',', $this->input->post('chassis')) : "";
			$model_select = !empty($this->input->post('model_id')) ? implode(',', $this->input->post('model_id')) : "";

			$rules = array(
				array(
					'field' => 'price',
					'label' => 'Price',
					'rules' => 'trim|required',
				),

				array(
					'field' => 'add_date',
					'label' => 'Date Of Add',
					'rules' => 'trim',
				),
				array(
					'field' => 'part_category',
					'label' => 'part_category',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'part_sub_category',
					'label' => 'Part Sub Category',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'discount',
					'label' => 'Discount',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'part_case',
					'label' => 'Part Case',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'part_brand[]',
					'label' => 'Part Brand',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'description',
					'label' => 'Description',
					'rules' => 'trim|required',
				),
			);

			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				$file_name = $_FILES['image']['name'];
				$part_brand = ($this->input->post('part_brand') != '') ? implode(',', $this->input->post('part_brand')) : "";
				//$part_case = ($this->input->post('part_case')!='') ? implode(',',$this->input->post('part_case')) : "";
				//
				$cha = implode(',', $this->input->post('chassis'));
				$model_select= implode(',', $this->input->post('model_id'));
				if(!$model_select || $model_select == "all" || $model_select == "" || (is_array($model_select) && (in_array(0, $model_select) || in_array("0", $model_select)))){
					$all_models=$this->car->get_classes();
					$model_select= array();
					foreach ($all_models as $single_model) {
						$model_select = array_merge($model_select, array($single_model->id));
					}

					$model_select = implode(',', $model_select);
				}

				if ($cha == "all") {

					$model_list = explode(",", $model_select);
					$chassis_list = [];
					foreach ($model_list as $single_model) {
						$model_chassis = $this->part->get_chassis_by_model($single_model);
						foreach ($model_chassis as $single_chassis) {
//							echo $single_chassis->id;
							$chassis_list = array_merge($chassis_list, array($single_chassis->id));
						}
					}
					$cha = implode(',', $chassis_list);

				}
				$title = $this->input->post('title');
				$arabicTitle = $this->input->post('title_arabic');

				if ($this->input->post('title') == "") {
					$title = $arabicTitle;
				} elseif ($this->input->post('title_arabic') == "") {
					$arabicTitle = $title;
				}
				if ($this->input->post('updated_date')) {
					$addDate = $this->input->post('updated_date');
				} else {
					$addDate = $this->input->post('add_date');
				}

				$new_array = array(
					'title' => $title,
					'title_arabic' => $arabicTitle,
					'part_number' => $this->input->post('part_number'),
					'part_category' => $this->input->post('part_category'),
					'part_sub_category' => $this->input->post('part_sub_category'),
					'price' => $this->input->post('price'),
					'discount' => $this->input->post('discount'),
					'part_case' => $this->input->post('part_case'),
					'part_brand' => $part_brand,
					'add_date' => $addDate,
					'description' => $this->input->post('description'),

//					'location_latitude'	 =>   $this->input->post('location_lat'),
					//					'location_longitude' =>   $this->input->post('location_lon'),

//					'location' => $this->input->post('location'),
					'location_zone' => $this->input->post('location_zone'),
					'username' => $this->session->userdata("user_name"),
					'email' => $this->session->userdata("user_email"),
					'phone' => $this->session->userdata("user_mobile"),
					'chassis_id' => $cha,
					'model_id' => $model_select,
//					'sort_order' => $this->input->post('sort_order'),
					'available_location' => $this->input->post('available_location'),
					// 'date_active' => $this->input->post('date_active'),
					'date_expire' => $this->input->post('date_expire'),
					'num_stock' => $this->input->post('num_stock'),
					'provider_id' => $this->session->userdata("id"),

				);

				$val = $this->part->update_part($new_array, $id);

				$photo_array = array(

					'part_id' => $id,

				);

				$previous_photos = $this->partphotos->manage_part_photos($id);
//				print_r($_POST["old"]);
				//				print_r($previous_photos);
				//				return;
				$deleted_photos = $this->partphotos->del_part_photos_by_part_id($id);
				$i = 0;
				$j = 0;
				$files = $_FILES;
//				$dataInfo = array();
				if(isset($_POST["old"])) {
					foreach ($_POST["old"] as $key => $value) {
						if ($value) {
							//OLD
							$single_img = array_search($value, array_column($previous_photos, 'id'));
							//						print_r($single_img);
							//						return;
							//						echo $j;
							$photo_array['photo_name'] = $previous_photos[$single_img]["photo_name"];
						} else {
							//New
							$_FILES['file']['name'] = $files['image']['name'][$i];
							$_FILES['file']['type'] = $_FILES['image']['type'][$i];
							$_FILES['file']['tmp_name'] = $_FILES['image']['tmp_name'][$i];
							$_FILES['file']['error'] = $_FILES['image']['error'][$i];
							$_FILES['file']['size'] = $_FILES['image']['size'][$i];
							$config = array();
							$config['upload_path'] = './upload/';
							$config['allowed_types'] = 'gif|jpg|png|jpeg';
							$this->upload->initialize($config);
							if ($this->upload->do_upload('file')) {
								//							$dataInfo[] = $this->upload->data();
								$photo_array['photo_name'] = $this->upload->data()['file_name'];
							}
							$i++;
						}
						if ($j == 0) {
							$photo_array['is_default'] = "yes";
						} else {
							$photo_array['is_default'] = "no";
						}

						$this->partphotos->add_part_photos($photo_array);
						$j++;
					}
				}else{
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
						if ($this->upload->do_upload('file')) {
							$dataInfo[] = $this->upload->data();
						}
					}

					for ($i = 0; $i < sizeof($dataInfo); $i++) {

						if ($i == 0) {
							$photo_array['is_default'] = "yes";
							$photo_array['photo_name'] = $dataInfo[0]['file_name'];
						} else {
							$photo_array['is_default'] = "no";
							$photo_array['photo_name'] = $dataInfo[$i]['file_name'];
						}
						$this->partphotos->add_part_photos($photo_array);

					}
				}
//				return;
				//				$dataInfo = array();
				//				$files = $_FILES;
				//				$cpt = count($_FILES['image']['name']);
				//				for($i=0; $i<$cpt; $i++){
				//
				//					$_FILES['file']['name'] 	= $files['image']['name'][$i];
				//					$_FILES['file']['type']     = $_FILES['image']['type'][$i];
				//					$_FILES['file']['tmp_name'] = $_FILES['image']['tmp_name'][$i];
				//					$_FILES['file']['error']     = $_FILES['image']['error'][$i];
				//					$_FILES['file']['size']     = $_FILES['image']['size'][$i];
				//					$config= array();
				//					$config['upload_path'] ='./upload/';
				//					$config['allowed_types'] = 'gif|jpg|png|jpeg';
				//					$this->upload->initialize($config);
				//					if($this->upload->do_upload('file')){
				//						$dataInfo[] = $this->upload->data();
				//					}
				//				}
				//
				//				for($i=0; $i<sizeof($dataInfo); $i++){
				//
				//					if($i==0){
				//						$photo_array['is_default'] = "yes";
				//						$photo_array['photo_name'] = $dataInfo[0]['file_name'];
				//					}
				//					else{
				//						$photo_array['is_default'] = "no";
				//						$photo_array['photo_name'] = $dataInfo[$i]['file_name'];
				//					}
				//					$this->partphotos->add_part_photos($photo_array);
				//
				//				}

				$this->data['success'] = "Updated successfully!";
			} else {
				$error = validation_errors();
				$this->data['error'] = $error;
			}
		}
		$photos_array = $this->partphotos->manage_part_photos($id);
		$photo_array_count = count($photos_array);
		$remaining_count = 10 - $photo_array_count;
		$this->data['chassis_number'] = $this->part->get_chassis();
		$this->data['chassis'] = $this->data['chassis_number'];
		$this->data['usname'] = $this->session->userdata("user_name");
		$this->data['location'] = $this->location->manage_location();
		$this->data['rec'] = $this->part->edit_part($id);
		$this->data['part_photos'] = $photos_array;
		$this->data['remaining_count'] = $remaining_count;
		$this->data['brand'] = $this->part->manage_brand();
		$this->data['parts_category'] = $this->part->manage_parts_cat();
		$this->data['parts_sub_cat'] = $this->part->manage_parts_sub_cat();
		$this->data['part_id'] = $id;
		$this->data['model_name'] = $this->car->get_classes();
		$this->data['title'] = 'Edit Part';

		$this->load->view('provider/edit_part', $this->data);
	}
	public function sub_cat() {

		$id = $this->input->post('id');
		echo $this->part->part_sub_cat($id);
	}

	public function update_part_photos() {

		if ($this->input->post()) {

			$file_name = $_FILES['image']['name'];

			if ($file_name != '') {
				$config['upload_path'] = './upload/';
				$config['file_name'] = time() . $file_name;
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$this->upload->initialize($config);
				if (!$this->upload->do_upload('image')) {
					echo ($this->upload->display_errors());
				} else {
					$data = $this->upload->data();
					$photoName = $data['file_name'];
				}
			}
			$id = $this->input->post('id');
			$part_id = $this->input->post('part_id');

			$val = $this->partphotos->update_part_photos($photoName, $id);
			if ($val) {

				redirect(base_url('provider/parts/edit_part/' . $part_id . '?success=updated successfully!'));
			} else {
				redirect(base_url('provider/parts/edit_part/' . $part_id . '?success=updated  successfully!'));
			}
		}

	}

	private function check_maximum_parts_for_plan() {
		$provider_id = $this->session->userdata("id");
		$active_parts = array_filter($this->Provider_Model->get_parts($provider_id), function ($part) {
			return $part->active == 1 ? true : false;
		});
		$current_plan = $this->Provider_plan_model->get_current_plan_with_details_by_provider($provider_id);

		if (!$current_plan) {
			return "Please subscribe to a plan first";
		}

		if ($current_plan->status == "expired") {
			return "Please renew your plan first";
		}

		if (count($active_parts) >= $current_plan->plan->num_parts) {
			return "According to your plan you cannot activate more than " . $current_plan->plan->num_parts . " parts";
		}

		return false;
	}
	private function check_maximum_featured_for_plan() {
		$provider_id = $this->session->userdata("id");
		$featured_parts = array_filter($this->Provider_Model->get_parts($provider_id), function ($part) {
			return $part->featured == 1 ? true : false;
		});
		$current_plan = $this->Provider_plan_model->get_current_plan_with_details_by_provider($provider_id);

		if (!$current_plan) {
			return "Please subscribe to a plan first";
		}

		if ($current_plan->status == "expired") {
			return "Please renew your plan first";
		}

		if (count($featured_parts) >= $current_plan->plan->num_featured) {
			return "According to your plan you cannot mark more than " . $current_plan->plan->num_parts . " parts as featured";
		}

		return false;
	}
	public function activate($id) {
		$check = $this->check_maximum_parts_for_plan();
		if ($check) {
			redirect(base_url('provider/parts?error=' . $check));
		}

		$this->part->activate($id);
		redirect(base_url('provider/parts?success=updated  successfully!'));
	}
	public function deactivate($id) {
		$this->part->deactivate($id);
		redirect(base_url('provider/parts?success=updated  successfully!'));
	}
	public function add_to_featured($id) {
		$check = $this->check_maximum_featured_for_plan();
		if ($check) {
			redirect(base_url('provider/parts?error=' . $check));
		}

		$this->part->add_to_featured($id);
		redirect(base_url('provider/parts?success=updated  successfully!'));
	}
	public function remove_from_featured($id) {
		$this->part->remove_from_featured($id);
		redirect(base_url('provider/parts?success=updated  successfully!'));
	}
	public function activate_many() {
		if ($_POST["parts"]) {
			$parts = $_POST["parts"];
			foreach ($parts as $part) {
				$check = $this->check_maximum_parts_for_plan();
				if ($check) {
					echo base_url('provider/parts?error=' . $check);
					return;
				}
				$this->part->activate($part);
			}
		}
		echo base_url('provider/parts?success=Updated Successfully');
		return true;
	}
	public function deactivate_many() {
		if ($_POST["parts"]) {
			$parts = $_POST["parts"];
			foreach ($parts as $part) {
				$this->part->deactivate($part);
			}
		}
		echo base_url('provider/parts?success=Updated Successfully');
		return true;
	}
	public function add_to_featured_many() {
		if ($_POST["parts"]) {
			$parts = $_POST["parts"];
			foreach ($parts as $part) {
				$check = $this->check_maximum_featured_for_plan();
				if ($check) {
					echo base_url('provider/parts?error=' . $check);
					return;
				}
				$this->part->add_to_featured($part);
			}
		}
		echo base_url('provider/parts?success=Updated Successfully');
		return true;
	}
	public function remove_from_featured_many() {
		if ($_POST["parts"]) {
			$parts = $_POST["parts"];
			foreach ($parts as $part) {
				$this->part->remove_from_featured($part);
			}
		}
		echo base_url('provider/parts?success=Updated Successfully');
		return true;
	}
	public function delete_many() {
		if ($_POST["parts"]) {
			$parts = $_POST["parts"];
			foreach ($parts as $part) {
				$this->part->del_part($part);
			}
		}
		echo base_url('provider/parts?success=Deleted Successfully');
		return true;
	}

	function array2csv(array &$array) {
		if (count($array) == 0) {
			return null;
		}
		ob_start();
		$df = fopen("php://output", 'w');
		fputcsv($df, array_keys(reset($array)));
		foreach ($array as $row) {
			fputcsv($df, $row);
		}
		fclose($df);
		return ob_get_clean();
	}
	function download_send_headers($filename) {
		// disable caching
		$now = gmdate("D, d M Y H:i:s");
		header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
		header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
		header("Last-Modified: {$now} GMT");

		// force download
		header("Content-Type: application/force-download");
		header("Content-Type: application/octet-stream");
		header("Content-Type: application/download");

		// disposition / encoding on response body
		header("Content-Disposition: attachment;filename={$filename}");
		header("Content-Transfer-Encoding: binary");
	}
	public function export() {
		$array = $this->Provider_Model->get_parts_for_export($this->session->userdata("id"), true);
		$this->download_send_headers("data_export_" . date("Y-m-d") . ".csv");
		echo $this->array2csv($array);
		die();
	}

	public function import() {
		if (isset($_POST["import"])) {

			$fileName = $_FILES["file"]["tmp_name"];

			if ($_FILES["file"]["size"] > 0) {

				$file = fopen($fileName, "r");
				$counter = 0;
				$failed = 0;
				while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
					if (isset($column[0]) && ($column[0] == "id" || $column[0] == "title")) {
						continue;
					}
					$start_index = 0;
					if (is_numeric($column[0])) {
						$start_index = 1;
					}
					echo $start_index;
					$title = $column[$start_index + 0];
					$title_arabic = $column[$start_index + 1];
					$part_number = $column[$start_index + 2];
					$part_category = $column[$start_index + 3];
					$part_sub_category = $column[$start_index + 4];
					$price = $column[$start_index + 5];
					$discount = $column[$start_index + 6];
					$part_case = $column[$start_index + 7];
					$part_brand = $column[$start_index + 8];
					$add_date = $column[$start_index + 9];
					$description = $column[$start_index + 10];
					$chassis_id = $column[$start_index + 11];
					$available_location = $column[$start_index + 12];
					$date_active = $column[$start_index + 13];
					$num_stock = $column[$start_index + 14];

					$new_array = array(
						'title' => $title,
						'title_arabic' => $title_arabic,
						'part_number' => $part_number,
						'part_category' => $part_category,
						'part_sub_category' => $part_sub_category,
						'price' => $price,
						'discount' => $discount,
						'part_case' => $part_case,
						'part_brand' => $part_brand,
						'add_date' => $add_date,
						'description' => $description,
						'username' => $this->session->userdata("user_name"),
						'email' => $this->session->userdata("user_email"),
						'phone' => $this->session->userdata("user_mobile"),
						'chassis_id' => $chassis_id,
						'available_location' => $available_location,
						'date_active' => $date_active,
						'num_stock' => $num_stock,
						'provider_id' => $this->session->userdata("id"),
					);

					if (is_numeric($part_category)) {
						if (!$this->Partcategory_model->get_by_id($part_category)) {
							continue;
						}

					} else {
						$object = $this->Partcategory_model->get_by_name($part_category);
						if ($object) {
							continue;
						} else {
							$new_array['part_category'] = $object[0]->id;
						}

					}

					if (is_numeric($part_sub_category)) {
						if (!$this->Partsubcategory_model->get_by_id($part_sub_category)) {
							continue;
						}

					} else {
						$object = $this->Partsubcategory_model->get_by_name($part_sub_category);
						if ($object) {
							continue;
						} else {
							$new_array['part_sub_category'] = $object[0]->id;
						}

					}
					if (is_numeric($part_brand)) {
						if (!$this->Brand_model->get_by_id($part_brand)) {
							continue;
						}

					} else {
						$object = $this->Brand_model->get_by_name($part_brand);
						if ($object) {
							continue;
						} else {
							$new_array['part_brand'] = $object[0]->id;
						}

					}
					if (is_numeric($chassis_id)) {
						if (!$this->Chassis_model->get_by_id($chassis_id)) {
							continue;
						}

					} else {
						$object = $this->Chassis_model->get_by_name($chassis_id);
						if ($object) {
							continue;
						} else {
							$new_array['chassis_id'] = $object[0]->id;
						}

					}

					if ($result = $this->part->add_part($new_array)) {
//						print_r($column);
						$counter++;
					} else {
						$failed++;
					}
				}
				if ($failed > 0) {
					redirect(base_url('provider/Parts/?success=' . $counter . ' parts were added successfully!&error=' . $failed . ' failed to be added'));
				}
				redirect(base_url('provider/Parts/?success=' . $counter . ' parts were added successfully!'));
			}
		}
	}

}
