<?php
class Brand extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->library('upload');
		$this->load->helper(array('form', 'url'));
		$this->load->library(['ion_auth', 'form_validation']);
		$this->load->helper(['url', 'language']);
		$this->load->model('Service_tag_model', 'service_tag');
		$this->load->model('Brand_model', 'brand');

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
		$this->data['rec'] = $this->brand->manage_brand();
		$this->data['title'] = 'Brand';
		$this->load->view('manage_brand', $this->data);
	}
	public function add_brand() {
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
				if ($file_name != '') {
					$config['upload_path'] = './upload/';
					$config['file_name'] = time() . $file_name;
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['max_width'] = 400;
					$config['max_height'] = 100;
					$this->upload->initialize($config);
					if (!$this->upload->do_upload('image')) {
						$error = $this->upload->display_errors();
						redirect(base_url('brand/add_brand?error=' . $error));
					} else {
						$data = $this->upload->data();
						$new_array['image'] = $data['file_name'];
					}
				}
				$result = $this->brand->add_brand($new_array);
				if ($result) {
					redirect(base_url('brand/?success=Add successfully!'));
				} else {
					redirect(base_url('brand/add_brand?error=Some error!'));
				}
			} else {
				$error = validation_errors();
				redirect(base_url('brand/add_brand?error=' . $error));
			}
		}
		$this->data['result'] = "";
		$this->data['title'] = 'Add Brand';
		$this->load->view('add_brand', $this->data);
	}
	public function brand_del($id) {
		$id = $this->brand->brand_del($id);
		if ($id) {
			redirect(base_url('brand/?success= Delete successfully!'));
		} else {
			redirect(base_url('brand/?error=Some error!'));
		}

	}
	public function edit_brand($id) {
		$data['rec'] = $this->brand->edit_brand($id);
		$data['title'] = 'Edit Brand';
		$this->load->view('edit_brand', $data);
	}
	public function update_brand() {
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
				$result = $this->brand->update_brand($new_array, $id);
				if ($result) {
					redirect(base_url('brand/?success=Add successfully!'));
				} else {
					redirect(base_url('brand/?success=Add  successfully!'));
				}
			} else {
				$error = validation_errors();
				redirect(base_url('brand/update_brand?error=' . $error));
			}
		}
		$this->load->view('add_parts_categories');
	}

}