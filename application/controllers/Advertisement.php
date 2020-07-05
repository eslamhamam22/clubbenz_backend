<?php
ob_start();
class Advertisement extends MY_Controller {

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
		$this->load->model('Advertisement_model', 'advertisement');

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
		$this->data['home'] = $this->advertisement->manage_advertisement_home("all");
		$this->data['timeDisplay'] = $this->advertisement->manage_advertisement_timeDisplay("all");
		$this->data['banner'] = $this->advertisement->manage_advertisement_banner("all");
		$this->data['workshop'] = $this->advertisement->manage_workshop_banner("all");
		$this->data['partshops'] = $this->advertisement->manage_partshops_banner("all");
		$this->data['services'] = $this->advertisement->manage_services_banner("all");
		$this->data['partcatlog'] = $this->advertisement->manage_partcatlog_banner("all");
		$this->data['title'] = 'Advertisement';

		// echo "<pre>";
		// print_r($this->data['banner']);
		// return;
		$this->load->view('manage_advertisement', $this->data);
	}
	public function add_home_advertisement() {

		$i = 0;
		for ($i; $i <= 9; $i++) {
			$data = array();
			$data['image'] = $this->input->post('image_input_id_' . $i);
			$data['status'] = $this->input->post('home_' . $i) != "active" ? "deactive" : "active";
			$data['link'] = $this->input->post('link_' . $i);
			date_default_timezone_set('Egypt');
			$data['created_date'] = date("Y-m-d");
			$id = $this->input->post('id_' . $i);
			// print_r($data);
			// echo $id;
			$this->advertisement->update_advertisement($data, $id);
		}

		$dataInfo = array();
		$files = $_FILES;
		$cpt = count($_FILES['image']['name']);
		for ($i = 0; $i <= 9; $i++) {
			$id = $this->input->post('id_' . $i);
			$file_ext = pathinfo($_FILES["image"]["name"][$i], PATHINFO_EXTENSION);
			$fileName = $this->input->post('id_' . $i) . $files['image']['name'][$i];
			$_FILES['file']['name'] = $fileName;
			$_FILES['file']['type'] = $_FILES['image']['type'][$i];
			$_FILES['file']['tmp_name'] = $_FILES['image']['tmp_name'][$i];
			$_FILES['file']['error'] = $_FILES['image']['error'][$i];
			$_FILES['file']['size'] = $_FILES['image']['size'][$i];
			$config = array();
			$config['upload_path'] = './upload/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$new_name = time() . "HomeSlide";
			$config['file_name'] = $new_name;
			$this->upload->initialize($config);
			if ($this->upload->do_upload('file')) {
				$dataInfo[] = $this->upload->data();
				$new_array['image'] = $new_name . '.' . $file_ext;
				$result = $this->advertisement->update_advertisement($new_array, $id);
			} else {
				// echo ($this->upload->display_errors());
			}
		}

		redirect(base_url('advertisement/?success=Home Screen ads updated successfully!'));

	}

	public function add_timeOut_advertisement() {

		$i = 0;
		for ($i; $i <= 2; $i++) {
			$data = array();

			date_default_timezone_set('Africa/Cairo');
			$the_date = strtotime($this->input->post('timedate'));
			date_default_timezone_get();
			date_default_timezone_set("UTC");
			$datatime = date("Y-m-d H:i:s", $the_date);

			$data['image'] = $this->input->post('time_image_input_id_' . $i);
			$data['status'] = $this->input->post('time_status_' . $i) != "active" ? "deactive" : "active";
			$data['link'] = $this->input->post('link_' . $i);
			$data['time_out'] = $datatime;
			$id = $this->input->post('time_id_' . $i);
			$this->advertisement->update_advertisement($data, $id);
		}
		$dataInfo = array();
		$files = $_FILES;
		$cpt = count($_FILES['image']['name']);
		for ($i = 0; $i <= 2; $i++) {
			$id = $this->input->post('time_id_' . $i);
			$fileName = $this->input->post('id_' . $i) . $files['image']['name'][$i];
			$file_ext = pathinfo($_FILES["image"]["name"][$i], PATHINFO_EXTENSION);
			$fileName = 'CustomName.' . pathinfo($_FILES['image']['name'][$i], PATHINFO_EXTENSION);
			$_FILES['file']['name'] = $fileName;
			$_FILES['file']['type'] = $_FILES['image']['type'][$i];
			$_FILES['file']['tmp_name'] = $_FILES['image']['tmp_name'][$i];
			$_FILES['file']['error'] = $_FILES['image']['error'][$i];
			$_FILES['file']['size'] = $_FILES['image']['size'][$i];
			$config = array();
			$config['upload_path'] = './upload/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$new_name = time() . "timeOut";
			$config['file_name'] = $new_name;
			$this->upload->initialize($config);
			if ($this->upload->do_upload('file')) {
				$dataInfo[] = $this->upload->data();
				$new_array['image'] = $new_name . '.' . $file_ext;
				$result = $this->advertisement->update_advertisement($new_array, $id);
			} else {
				// echo ($this->upload->display_errors());
			}
		}
		redirect(base_url('advertisement/?success=Time Out Display ads updated successfully!'));

	}

	public function add_banner_advertisement() {

		$i = 0;
		for ($i; $i <= 3; $i++) {
			$data = array();
			$data['image'] = $this->input->post('banner_image_input_id_' . $i);
			$data['status'] = $this->input->post('status_' . $i) != "active" ? "deactive" : "active";
			$data['link'] = $this->input->post('link_' . $i);
			date_default_timezone_set('Egypt');
			$data['created_date'] = date("Y-m-d");
			$id = $this->input->post('id_' . $i);
			// echo "<pre>";
			// print_r($data);
			// echo $id;
			$this->advertisement->update_advertisement($data, $id);
		}
		$dataInfo = array();
		$files = $_FILES;
		$cpt = count($_FILES['image']['name']);
		for ($i = 0; $i <= 3; $i++) {
			$id = $this->input->post('id_' . $i);
			$file_ext = pathinfo($_FILES["image"]["name"][$i], PATHINFO_EXTENSION);
			$fileName = $this->input->post('id_' . $i) . $files['image']['name'][$i];
			$_FILES['file']['name'] = $fileName;
			$_FILES['file']['type'] = $_FILES['image']['type'][$i];
			$_FILES['file']['tmp_name'] = $_FILES['image']['tmp_name'][$i];
			$_FILES['file']['error'] = $_FILES['image']['error'][$i];
			$_FILES['file']['size'] = $_FILES['image']['size'][$i];
			$config = array();
			$config['upload_path'] = './upload/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$new_name = time() . rand() . "banner";
			$config['file_name'] = $new_name;
			$this->upload->initialize($config);
			if ($this->upload->do_upload('file')) {
				$dataInfo[] = $this->upload->data();
				$new_array['image'] = $new_name . '.' . $file_ext;
				$result = $this->advertisement->update_advertisement($new_array, $id);
			} else {
				// echo ($this->upload->display_errors());
			}
		}
		redirect(base_url('advertisement/?success=Banner ads updated successfully!'));
		return;
	}

	public function add_workshop_advertisement() {

		$i = 0;
		for ($i; $i <= 3; $i++) {
			$data = array();
			$data['image'] = $this->input->post('workshop_image_input_id_' . $i);
			$data['status'] = $this->input->post('status_' . $i) != "active" ? "deactive" : "active";
			$data['link'] = $this->input->post('link_' . $i);
			$data['created_date'] = date("Y-m-d");
			$id = $this->input->post('id_' . $i);
			// echo "<pre>";
			// print_r($data);
			// echo $id;
			$this->advertisement->update_advertisement($data, $id);
		}
		$dataInfo = array();
		$files = $_FILES;
		$cpt = count($_FILES['image']['name']);
		for ($i = 0; $i <= 3; $i++) {
			$id = $this->input->post('id_' . $i);
			$file_ext = pathinfo($_FILES["image"]["name"][$i], PATHINFO_EXTENSION);
			$fileName = $this->input->post('id_' . $i) . $files['image']['name'][$i];
			$_FILES['file']['name'] = $fileName;
			$_FILES['file']['type'] = $_FILES['image']['type'][$i];
			$_FILES['file']['tmp_name'] = $_FILES['image']['tmp_name'][$i];
			$_FILES['file']['error'] = $_FILES['image']['error'][$i];
			$_FILES['file']['size'] = $_FILES['image']['size'][$i];
			$config = array();
			$config['upload_path'] = './upload/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$new_name = time() . rand() . "workshop";
			$config['file_name'] = $new_name;
			$this->upload->initialize($config);
			if ($this->upload->do_upload('file')) {
				$dataInfo[] = $this->upload->data();
				$new_array['image'] = $new_name . '.' . $file_ext;
				$result = $this->advertisement->update_advertisement($new_array, $id);
			} else {
				// echo ($this->upload->display_errors());
			}
		}
		redirect(base_url('advertisement/?success=partshops ads updated successfully!'));
		return;
	}

	public function add_partshops_advertisement() {

		$i = 0;
		for ($i; $i <= 3; $i++) {
			$data = array();
			$data['image'] = $this->input->post('partshops_image_input_id_' . $i);
			$data['status'] = $this->input->post('status_' . $i) != "active" ? "deactive" : "active";
			$data['link'] = $this->input->post('link_' . $i);
			date_default_timezone_set('Egypt');
			$data['created_date'] = date("Y-m-d");
			$id = $this->input->post('id_' . $i);
			// echo "<pre>";
			// print_r($data);
			// echo $id;
			$this->advertisement->update_advertisement($data, $id);
		}
		$dataInfo = array();
		$files = $_FILES;
		$cpt = count($_FILES['image']['name']);
		for ($i = 0; $i <= 3; $i++) {
			$id = $this->input->post('id_' . $i);
			$file_ext = pathinfo($_FILES["image"]["name"][$i], PATHINFO_EXTENSION);
			$fileName = $this->input->post('id_' . $i) . $files['image']['name'][$i];
			$_FILES['file']['name'] = $fileName;
			$_FILES['file']['type'] = $_FILES['image']['type'][$i];
			$_FILES['file']['tmp_name'] = $_FILES['image']['tmp_name'][$i];
			$_FILES['file']['error'] = $_FILES['image']['error'][$i];
			$_FILES['file']['size'] = $_FILES['image']['size'][$i];
			$config = array();
			$config['upload_path'] = './upload/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$new_name = time() . rand() . "partshops";
			$config['file_name'] = $new_name;
			$this->upload->initialize($config);
			if ($this->upload->do_upload('file')) {
				$dataInfo[] = $this->upload->data();
				$new_array['image'] = $new_name . '.' . $file_ext;
				$result = $this->advertisement->update_advertisement($new_array, $id);
			} else {
				// echo ($this->upload->display_errors());
			}
		}
		redirect(base_url('advertisement/?success=partshops ads updated successfully!'));
		return;
	}

	public function add_services_advertisement() {

		$i = 0;
		for ($i; $i <= 3; $i++) {
			$data = array();
			$data['image'] = $this->input->post('services_image_input_id_' . $i);
			$data['status'] = $this->input->post('status_' . $i) != "active" ? "deactive" : "active";
			$data['link'] = $this->input->post('link_' . $i);
			date_default_timezone_set('Egypt');
			$data['created_date'] = date("Y-m-d");
			$id = $this->input->post('id_' . $i);
			// echo "<pre>";
			// print_r($data);
			// echo $id;
			$this->advertisement->update_advertisement($data, $id);
		}
		$dataInfo = array();
		$files = $_FILES;
		$cpt = count($_FILES['image']['name']);
		for ($i = 0; $i <= 3; $i++) {
			$id = $this->input->post('id_' . $i);
			$file_ext = pathinfo($_FILES["image"]["name"][$i], PATHINFO_EXTENSION);
			$fileName = $this->input->post('id_' . $i) . $files['image']['name'][$i];
			$_FILES['file']['name'] = $fileName;
			$_FILES['file']['type'] = $_FILES['image']['type'][$i];
			$_FILES['file']['tmp_name'] = $_FILES['image']['tmp_name'][$i];
			$_FILES['file']['error'] = $_FILES['image']['error'][$i];
			$_FILES['file']['size'] = $_FILES['image']['size'][$i];
			$config = array();
			$config['upload_path'] = './upload/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$new_name = time() . rand() . "services";
			$config['file_name'] = $new_name;
			$this->upload->initialize($config);
			if ($this->upload->do_upload('file')) {
				$dataInfo[] = $this->upload->data();
				$new_array['image'] = $new_name . '.' . $file_ext;
				$result = $this->advertisement->update_advertisement($new_array, $id);
			} else {
				// echo ($this->upload->display_errors());
			}
		}
		redirect(base_url('advertisement/?success=services ads updated successfully!'));
		return;
	}

	public function add_partcatlog_advertisement() {

		$i = 0;
		for ($i; $i <= 3; $i++) {
			$data = array();
			$data['image'] = $this->input->post('partcatlog_image_input_id_' . $i);
			$data['status'] = $this->input->post('status_' . $i) != "active" ? "deactive" : "active";
			$data['link'] = $this->input->post('link_' . $i);
			date_default_timezone_set('Egypt');
			$data['created_date'] = date("Y-m-d");
			$id = $this->input->post('id_' . $i);
			// echo "<pre>";
			// print_r($data);
			// echo $id;
			$this->advertisement->update_advertisement($data, $id);
		}
		$dataInfo = array();
		$files = $_FILES;
		$cpt = count($_FILES['image']['name']);
		for ($i = 0; $i <= 3; $i++) {
			$id = $this->input->post('id_' . $i);
			$file_ext = pathinfo($_FILES["image"]["name"][$i], PATHINFO_EXTENSION);
			$fileName = $this->input->post('id_' . $i) . $files['image']['name'][$i];
			$_FILES['file']['name'] = $fileName;
			$_FILES['file']['type'] = $_FILES['image']['type'][$i];
			$_FILES['file']['tmp_name'] = $_FILES['image']['tmp_name'][$i];
			$_FILES['file']['error'] = $_FILES['image']['error'][$i];
			$_FILES['file']['size'] = $_FILES['image']['size'][$i];
			$config = array();
			$config['upload_path'] = './upload/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$new_name = time() . rand() . "partcatlog";
			$config['file_name'] = $new_name;
			$this->upload->initialize($config);
			if ($this->upload->do_upload('file')) {
				$dataInfo[] = $this->upload->data();
				$new_array['image'] = $new_name . '.' . $file_ext;
				$result = $this->advertisement->update_advertisement($new_array, $id);
			} else {
				// echo ($this->upload->display_errors());
			}
		}
		redirect(base_url('advertisement/?success=partcatlog ads updated successfully!'));
		return;
	}

	public function add_advertisement() {
		if ($this->input->post()) {
			$rules = array(
				array(
					'field' => 'pagename',
					'label' => 'Page Name',
					'rules' => 'trim|required',
				),
			);

			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {

				$file_name = $_FILES['image']['name'];
				$new_array['pagename'] = $this->input->post('pagename');
				$new_array['link'] = $this->input->post('link');
				$new_array['type'] = $this->input->post('type');

				if ($file_name != '') {
					$config['upload_path'] = './upload/';
					$config['file_name'] = time() . $file_name;
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$this->upload->initialize($config);
					if (!$this->upload->do_upload('image')) {
						echo ($this->upload->display_errors());
					} else {
						$data = $this->upload->data();
						$new_array['image'] = $data['file_name'];
					}
				}
				$result = $this->advertisement->add_advertisement($new_array);
				if ($result) {
					redirect(base_url('advertisement/?success=Add  successfully!'));
				} else {
					redirect(base_url('advertisement/add_advertisement?error=Some error!'));
				}
			} else {
				$error = validation_errors();
				redirect(base_url('advertisement/add_advertisement?error=' . $error));
			}
		}
		$this->load->view('add_advertisement');
	}
	public function edit_advertisement($id) {

		$result['row'] = $this->advertisement->edit_advertisement($id);

		$this->load->view('edit_advertisement', $result);
	}
	public function update_advertisement() {

		if ($this->input->post()) {
			$id = $this->input->post('id');
			$rules = array(
				array(
					'field' => 'pagename',
					'label' => 'Page Name',
					'rules' => 'trim|required',
				),
			);

			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				$file_name = $_FILES['image']['name'];
				$new_array['pagename'] = $this->input->post('pagename');
				$new_array['link'] = $this->input->post('link');
				$new_array['type'] = $this->input->post('type');

				if ($file_name != '') {
					$config['upload_path'] = './upload/';
					$config['file_name'] = time() . $file_name;
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$this->upload->initialize($config);
					if (!$this->upload->do_upload('image')) {
						echo ($this->upload->display_errors());
					} else {
						$data = $this->upload->data();
						$new_array['image'] = $data['file_name'];
					}
				}
				$result = $this->advertisement->update_advertisement($new_array, $id);
				if ($result) {
					redirect(base_url('advertisement/?success=Update successfully!'));
				} else {
					redirect(base_url('advertisement/?success=Update  successfully!'));
				}
			} else {
				$error = validation_errors();
				redirect(base_url('advertisement/edit_advertisement?error=' . $error));
			}
		}

	}

	public function del_advertisement($id) {
		$rs = $this->advertisement->del_advertisement($id);
		if ($rs) {
			redirect(base_url('advertisement/?success= Delete successfully!'));
		} else {
			redirect(base_url('advertisement/?error=Some error!'));
		}
	}

}
?>