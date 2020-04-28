<?php
ob_start();
class Service extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->library('upload');
		$this->load->helper(array('form', 'url'));
		$this->load->library(['ion_auth', 'form_validation']);
		$this->load->helper(['url', 'language']);
		$this->load->model('Service_tag_model', 'service_tag');
		$this->load->model('Service_model', 'service');

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
		$this->data['rec'] = $this->service->service_manage();
		$this->load->view('service_manage', $this->data);
	}
	public function add_services() {
		if ($this->input->post()) {
			$show_services = $this->input->post('show_services');
			if ($show_services == "") {
				$show_services = "off";
			}

			$rules = array(
				array(
					'field' => 'service_name',
					'label' => 'Modelname',
					'rules' => 'trim|required',
				),
			);

			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				$file_name = $_FILES['s_image']['name'];
				$new_array['name'] = $this->input->post('service_name');
				$new_array['arabic_name'] = $this->input->post('service_name_arabic');
				$new_array['sorting'] = $this->input->post('sorting');
				$new_array['show_services'] = $show_services;

				if ($file_name != '') {
					$config['upload_path'] = './upload/';
					$config['file_name'] = time() . $file_name;
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$this->upload->initialize($config);
					if (!$this->upload->do_upload('s_image')) {
						echo ($this->upload->display_errors());
					} else {
						$data = $this->upload->data();
						$new_array['image'] = $data['file_name'];
					}
				}
				$result = $this->service->add_services($new_array);
				if ($result) {
					redirect(base_url('service/?success=Add  successfully!'));
				} else {
					redirect(base_url('service/?error=Some error!'));
				}
			} else {
				$error = validation_errors();
				redirect(base_url('service/?error=' . $error));
			}
		}
		$this->load->view('add_services');
	}

	public function import_services() {
		if ($this->input->post()) {
			$show_services = $this->input->post('show_services');
			if ($show_services == "") {
				$show_services = "off";
			}

			$rules = array(
				array(
					'field' => 'service_name',
					'label' => 'Modelname',
					'rules' => 'trim|required',
				),
			);

			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				$file_name = $_FILES['s_image']['name'];
				$new_array['name'] = $this->input->post('service_name');
				$new_array['arabic_name'] = $this->input->post('service_name_arabic');
				$new_array['sorting'] = $this->input->post('sorting');
				$new_array['show_services'] = $show_services;

				if ($file_name != '') {
					$config['upload_path'] = './upload/';
					$config['file_name'] = time() . $file_name;
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$this->upload->initialize($config);
					if (!$this->upload->do_upload('s_image')) {
						echo ($this->upload->display_errors());
					} else {
						$data = $this->upload->data();
						$new_array['image'] = $data['file_name'];
					}
				}
				$result = $this->service->add_services($new_array);
				if ($result) {
					redirect(base_url('service/?success=Add  successfully!'));
				} else {
					redirect(base_url('service/?error=Some error!'));
				}
			} else {
				$error = validation_errors();
				redirect(base_url('service/?error=' . $error));
			}
		}
		$this->load->view('excel_service');
	}

	function export() {
		$this->load->model("Service_model");
		// $this->this->workshop->fetch_data();
		$this->load->library("excel");
		$object = new PHPExcel();

		$object->setActiveSheetIndex(0);

		$table_columns = array("sorting", "name", "arabic_name", "show_services");

		$column = 0;

		foreach ($table_columns as $field) {
			$object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
			$column++;
		}

		$employee_data = $this->Service_model->fetch_data();

		$excel_row = 2;

		foreach ($employee_data as $row) {
			$object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->sorting);
			$object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->name);
			$object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->arabic_name);
			$object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row->show_services);
			$excel_row++;
		}

		$object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel2007');
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="service Data.xlsx"');
		$object_writer->save('php://output');
	}

	public function service_del($id) {
		$id = $this->service->service_del($id);
		if ($id) {
			redirect(base_url('service/?success= Delete successfully!'));
		} else {
			redirect(base_url('service/?error=Some error!'));
		}
	}
	public function edit_service($id) {
		$data['rec'] = $this->service->edit_service($id);
		$this->load->view('edit_service', $data);
	}
	public function service_update() {

		$id = $this->input->post('id');
		if ($this->input->post()) {

			$show_services = $this->input->post('show_services');
			if ($show_services == "") {
				$show_services = "off";
			}
			$rules = array(
				array(
					'field' => 'service_name',
					'label' => 'Model',
					'rules' => 'trim|required',
				),
			);

			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				$file_name = $_FILES['s_image']['name'];
				$new_array['name'] = $this->input->post('service_name');
				$new_array['arabic_name'] = $this->input->post('service_name_arabic');
				$new_array['sorting'] = $this->input->post('sorting');
				$new_array['show_services'] = $show_services;
				if ($file_name != '') {
					$config['upload_path'] = './upload/';
					$config['file_name'] = time() . $file_name;
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$this->upload->initialize($config);
					if (!$this->upload->do_upload('s_image')) {
						echo ($this->upload->display_errors());
					} else {
						$data = $this->upload->data();
						$new_array['image'] = $data['file_name'];
					}
				}

				$val = $this->service->service_update($new_array, $id);
				if ($val) {
					redirect(base_url('service/?success=Update  successfully!'));
				} else {
					redirect(base_url('service/?success=Update  successfully!'));
				}
			} else {
				$error = validation_errors();
				redirect(base_url('service/edit_service/' . $id . '?error=' . $error));
			}
		}
	}

}