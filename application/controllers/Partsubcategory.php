<?php
ob_start();
class Partsubcategory extends MY_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->library('upload');
		$this->load->helper(array('form', 'url'));
		$this->load->library(['ion_auth', 'form_validation']);
		$this->load->helper(['url', 'language']);
		$this->load->model('Service_tag_model', 'service_tag');
		$this->load->model('Partsubcategory_model', 'partsubcategory');

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
		$this->data['rec'] = $this->partsubcategory->manage_parts_sub_cat();
		$this->data['title'] = 'Part SubCatagories';
		$this->data['partcat'] = $this->partsubcategory->parts_cat();

		$this->load->view('manage_parts_sub_categories', $this->data);
	}
	public function add_parts_sub_categories() {
		if ($this->input->post()) {
			$rules = array(
				array(
					'field' => 'name',
					'label' => 'Name',
					'rules' => 'trim|required',
				),
			);

			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
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
						$new_array['image'] = $data['file_name'];
					}
				}

				$new_array['category'] = $this->input->post('category');
				$new_array['name'] = $this->input->post('name');
				$new_array['arabic_name'] = $this->input->post('arabic_name');
				$new_array['sorting'] = $this->input->post('sorting');
				$result = $this->partsubcategory->add_parts_sub_categories($new_array);
				if ($result) {
					redirect(base_url('partsubcategory/?success=Add  successfully!'));
				} else {
					redirect(base_url('partsubcategory/add_parts_sub_categories?error=Some error!'));
				}
			} else {
				$error = validation_errors();
				redirect(base_url('partsubcategory/add_parts_sub_categories?error=' . $error));
			}
		}
		$data['rec'] = $this->partsubcategory->manage_parts_cat();
		$data['title'] = 'Add Part SubCategory';
		$this->load->view('add_parts_sub_categories', $data);
	}
	public function part_sub_categories_del($id) {
		$id = $this->partsubcategory->part_sub_categories_del($id);
		if ($id) {
			redirect(base_url('partsubcategory/?success=Parts Delete successfully!'));
		} else {
			redirect(base_url('partsubcategory/?error=Some error!'));
		}

	}
	public function edit_parts_sub_categories($id) {
		$this->data['rec'] = $this->partsubcategory->manage_parts_cat();
		$this->data['scat'] = $this->partsubcategory->edit_parts_sub_cat($id);
		$this->data['title'] = 'Edit Part Sub Category';
		$this->load->view('edit_parts_sub_categories', $this->data);
	}

	public function update_parts_sub_categories() {
		$id = $this->input->post('id');

		if ($id) {
			$rules = array(
				array(
					'field' => 'name',
					'label' => 'Name',
					'rules' => 'trim|required',
				),
			);

			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
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
						$new_array['image'] = $data['file_name'];
					}
				}
				$new_array['category'] = $this->input->post('category');
				$new_array['name'] = $this->input->post('name');
				$new_array['arabic_name'] = $this->input->post('arabic_name');
				$new_array['sorting'] = $this->input->post('sorting');

				$this->partsubcategory->update_parts_sub_categories($new_array, $id);

				redirect(base_url('partsubcategory/?success=Update successfully!'));

			} else {
				$error = validation_errors();
				redirect(base_url('partsubcategory/edit_parts_sub_categories?error=' . $error));
			}
		}

	}

	public function update_status() {
		if (isset($_REQUEST['sval'])) {
			$this->load->model('Partsubcategory_model', 'parts_sub_categories');
			$up_status = $this->partsubcategory->update_status();

			if ($up_status > 0) {
				$this->session->set_flashdata('msg', 'data updated successfully');
				$this->session->set_flashdata('msg_class', 'alert-success');
			} else {
				$this->session->set_flashdata('msg', 'data not updated successfully');
				$this->session->set_flashdata('msg_class', 'alert-danget');
			}
			return redirect('partsubcategory');
		}
	}

}
?>
