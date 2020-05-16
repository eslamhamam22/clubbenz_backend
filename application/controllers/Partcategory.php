<?php
ob_start();
class Partcategory extends MY_Controller {

	public function __construct() {
		ini_set('display_errors', 1);
		error_reporting(1);
		parent::__construct();
		$this->load->model('Service_tag_model');
		$this->load->model('Partcategory_model');
		$this->load->library('upload');

		$this->load->model('acl_model');
		$this->load->model('Users_model');

		if ($this->input->get('error')) {
			$this->data['error'] = $this->input->get('error');
		}
		if ($this->input->get('success')) {
			$this->data['success'] = $this->input->get('success');
		}
	}
	public function index() {
		$this->data['rec'] = $this->Partcategory_model->manage_parts_cat();
		$this->data['title'] = 'Manage Parts Categories';
		$this->load->view('manage_parts_categories', $this->data);
	}
	public function add_parts_categories() {
		ini_set('display_errors', 1);
		error_reporting(1);
		if ($this->input->post()) {
			$rules = array(
				array(
					'field' => 'name',
					'label' => 'Modelname',
					'rules' => 'trim|required',
				),
			);

			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				$file_name = $_FILES['image']['name'];
				$new_array['name'] = $this->input->post('name');
				$new_array['arabic_name'] = $this->input->post('arabic_name');
				$new_array['chassis'] = $this->input->post('chassis');
				$new_array['sorting'] = $this->input->post('sorting');
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

				$result = $this->Partcategory_model->add_parts_categories($new_array);

				redirect(base_url() . 'partcategory', refresh);
				exit();
			} else {
				$error = validation_errors();
				//redirect( base_url('partcategory/'.$id.'?error=Field Required') );
				$this->data['error'] = $error;
			}
		}
		$this->data['chassis'] = $this->Partcategory_model->get_car_chassis();
		$this->data['title'] = 'Add Parts Categories';
		$this->load->view('add_parts_categories', $this->data);
	}
	public function part_del($id) {
		$id = $this->Partcategory_model->part_del($id);
		if ($id) {
			redirect(base_url() . 'partcategory/?success= Delete successfully!');
		} else {
			redirect(base_url() . 'partcategory/?error=Some error!', 'refresh');
		}
	}
	public function edit_parts_categories($id) {
		$this->data['rec'] = $this->Partcategory_model->edit_parts_categories($id);
		$this->data['chassis'] = $this->Partcategory_model->get_car_chassis();
		$this->data['title'] = 'Edit Parts Categories';
		$this->load->view('edit_parts_categories', $this->data);
	}
	public function update_parts_categories() {
		if ($id = $this->input->post('id')) {
			$rules = array(
				array(
					'field' => 'name',
					'label' => 'Part Name',
					'rules' => 'trim|required',
				),
			);

			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				$file_name = $_FILES['image']['name'];
				$new_array['name'] = $this->input->post('name');
				$new_array['arabic_name'] = $this->input->post('arabic_name');
				$new_array['chassis'] = $this->input->post('chassis');
				$new_array['sorting'] = $this->input->post('sorting');
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
				$result = $this->Partcategory_model->update_parts_categories($new_array, $id);
				if ($result) {
					redirect(base_url('partcategory/?success=Add  successfully!'));
				} else {
					redirect(base_url('partcategory/?success=Add  successfully!'));
				}
			} else {
				$error = validation_errors();
				redirect(base_url('partcategory/?error=' . $error));
			}
		}
		$this->load->view('add_parts_categories');
	}

}
?>