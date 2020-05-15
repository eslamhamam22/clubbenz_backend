<?php
ob_start();
class Plan extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->library('upload');
		$this->load->helper(array('form', 'url'));
		$this->load->library(['ion_auth', 'form_validation']);
		$this->load->helper(['url', 'language']);
		$this->load->model('Plan_model', 'plan');

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
		$this->data['rec'] = $this->plan->plan_manage();
		$this->data['title'] = 'Plan Manage';
		$this->load->view('plan_manage', $this->data);
	}
	public function add_plans() {
		if ($this->input->post()) {

			$rules = array(
				array(
					'field' => 'title',
					'label' => 'Title',
					'rules' => 'trim|required',
				), array(
					'field' => 'num_parts',
					'label' => 'num parts',
					'rules' => 'trim|required',
				),
			);

			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				$file_name = $_FILES['photo']['name'];
				$new_array['title'] = $this->input->post('title');
				$new_array['num_parts'] = $this->input->post('num_parts');
				$new_array['num_featured'] = $this->input->post('num_featured');
				$new_array['price'] = $this->input->post('price');
				$new_array['frequency'] = $this->input->post('frequency');
				$new_array['extra_days'] = $this->input->post('extra_days');

				if ($file_name != '') {
					$config['upload_path'] = './upload/';
					$config['file_name'] = time() . $file_name;
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$this->upload->initialize($config);
					if (!$this->upload->do_upload('photo')) {
						echo ($this->upload->display_errors());
					} else {
						$data = $this->upload->data();
						$new_array['photo'] = $data['file_name'];
					}
				}
				$result = $this->plan->add_plans($new_array);

				if ($result) {
					redirect(base_url('plan/?success=Add  successfully!'));
				} else {
					redirect(base_url('plan/?error=Some error!'));
				}
			} else {
				$error = validation_errors();
				redirect(base_url('plan/?error=' . $error));
			}
		}
		$this->data['title'] = 'Add Plan';
		$this->load->view('add_plans', $this->data);
	}

	public function plan_del($id) {
		$id = $this->plan->plan_del($id);
		if ($id) {
			redirect(base_url('plan/?success= Delete successfully!'));
		} else {
			redirect(base_url('plan/?error=Some error!'));
		}
	}
	public function edit_plan($id) {
		$data['rec'] = $this->plan->edit_plan($id);
		$data['title'] = 'Edit Plan';
		$this->load->view('edit_plan', $data);
	}
	public function plan_update() {

		$id = $this->input->post('id');
		if ($this->input->post()) {
			$rules = array(
				array(
					'field' => 'title',
					'label' => 'Title',
					'rules' => 'trim|required',
				), array(
					'field' => 'num_parts',
					'label' => 'num parts',
					'rules' => 'trim|required',
				),
			);

			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				$file_name = $_FILES['photo']['name'];
				$new_array['title'] = $this->input->post('title');
				$new_array['num_parts'] = $this->input->post('num_parts');
				$new_array['num_featured'] = $this->input->post('num_featured');
				$new_array['price'] = $this->input->post('price');
				$new_array['frequency'] = $this->input->post('frequency');
				$new_array['extra_days'] = $this->input->post('extra_days');
				if ($file_name != '') {
					$config['upload_path'] = './upload/';
					$config['file_name'] = time() . $file_name;
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$this->upload->initialize($config);
					if (!$this->upload->do_upload('photo')) {
						echo ($this->upload->display_errors());
					} else {
						$data = $this->upload->data();
						$new_array['photo'] = $data['file_name'];
					}
				}

				$val = $this->plan->plan_update($new_array, $id);
				if ($val) {
					redirect(base_url('plan/?success=Update  successfully!'));
				} else {
					redirect(base_url('plan/?success=Update  successfully!'));
				}
			} else {
				$error = validation_errors();
				redirect(base_url('plan/edit_plan/' . $id . '?error=' . $error));
			}
		}
	}

}