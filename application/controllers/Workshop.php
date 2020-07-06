<?php
class Workshop extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->library('upload');
		$this->load->helper(array('form', 'url'));
		$this->load->library(['ion_auth', 'form_validation']);
		$this->load->helper(['url', 'language']);
		$this->load->model('Service_tag_model', 'service_tag');
		$this->load->model('Workshop_model', 'workshop');

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
		$this->data['rec'] = $this->workshop->manage_workshop();
		$this->data['title'] = 'Manage Worshops';
		$this->load->view('manage_workshop', $this->data);
	}

	public function add_workshop() {
		if ($this->input->post()) {

			$service_tag = !empty($this->input->post('service')) ? implode(',', $this->input->post('service')) : "";
			$day_off = !empty($this->input->post('day_off')) ? implode(',', $this->input->post('day_off')) : "";

			/*$service_tag_ar=!empty($this->input->post('service_arabic'))?implode(',',$this->input->post('service_arabic')) :"";
	        */
			$search_tag = implode(',', $this->input->post('serch_tag'));
			$search_tag_ar = implode(',', $this->input->post('serch_tag_arabic'));

			$service_tag_string = '';
			if ($this->input->post('service')) {
				$getSelectService = $this->service_tag->getSelectService($this->input->post('service'));
				$service_tag_string = '';
				foreach ($getSelectService as $service) {

					$service_tag_string = $service_tag_string . $service->keywords;
				}
			}

			$rules = array(

				array(
					'field' => 'ws_name',
					'label' => 'Workshop Name',
					'rules' => 'trim',
				),
				array(
					'field' => 'arabic_name',
					'label' => 'Arabic Name',
					'rules' => 'trim',
				),
				array(
					'field' => 'city',
					'label' => 'City Name ',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'country',
					'label' => 'Country Name ',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'opening_hour',
					'label' => 'Opening Hour',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'closing_hour',
					'label' => 'Closing Hour ',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'location_lat',
					'label' => 'Location Latitude ',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'phone',
					'label' => 'Phone No',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'address',
					'label' => 'Address',
					'rules' => 'trim|required',
				),
				// array(
				//     'field'   => 'day_off',
				//     'label'   => 'Day Off',
				//     'rules'   => 'trim|required'
				// )
				/*array(
	                    'field'   => $service_tag,
	                    'label'   => 'Service Type',
	                    'rules'   => 'trim|required'
	                ),
	                array(
	                    'field'   => $service_tag_ar,
	                    'label'   => 'Service Type AR ',
	                    'rules'   => 'trim|required'
*/
			);

			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				$dataInfo = array();
				$files = $_FILES;

				$cpt = count($_FILES['image']['name']);
				for ($i = 0; $i < $cpt; $i++) {

					$fname = $_FILES['file_name']['name'] = $files['image']['name'][$i];
					$_FILES['file_name']['tmp_name'] = $files['image']['tmp_name'][$i];
					$_FILES['file_name']['size'] = $_FILES['image']['size'][$i];

					$config = array();
					$config['upload_path'] = './upload/';
					$config['file_name'] = time() . $fname;
					$config['allowed_types'] = 'gif|jpg|png|jpeg';

					$this->upload->initialize($config);
					$this->upload->do_upload('file_name');
					$dataInfo[] = $this->upload->data();
				}

				$title = $this->input->post('ws_name');
				$arabicTitle = $this->input->post('arabic_name');

				if ($this->input->post('ws_name') == "") {
					$title = $arabicTitle;
				} elseif ($this->input->post('arabic_name') == "") {
					$arabicTitle = $title;
				}

				//	date_default_timezone_set('Africa/Cairo');
				$opening_hour = strtotime($this->input->post('opening_hour'));
				//	date_default_timezone_get();
				//	date_default_timezone_set("UTC");
				$opening_hours = date("H:i", $opening_hour);

				//	date_default_timezone_set('Africa/Cairo');
				$closing_hour = strtotime($this->input->post('closing_hour'));
				//	date_default_timezone_get();
				//	date_default_timezone_set("UTC");
				$closing_hours = date("H:i", $closing_hour);

				$data = array(

					'workshop_bg_img' => $dataInfo[0]['file_name'],
					'workshop_logo' => $dataInfo[1]['file_name'],
					'photo_selection_arround_rating' => $dataInfo[2]['file_name'],
					'name' => $title,
					'arabic_name' => $arabicTitle,
					'web' => $this->input->post('web'),
					'city' => $this->input->post('city'),
					'country' => $this->input->post('country'),
					'location_lat' => $this->input->post('location_lat'),
					'location_lon' => $this->input->post('location_lon'),
					'opening_hour' => $opening_hours,
					'closing_hour' => $closing_hours,
					'day_off' => $day_off,
					'phone' => $this->input->post('phone'),
					'facebook_page_link' => $this->input->post('fb_link'),
					'address' => $this->input->post('address'),
					"created_date" => date("Y-m-d"),
					'serch_tag' => $search_tag,
					'serch_tag_arabic' => $search_tag_ar,
					'service_tag' => $service_tag,
					'service_tag_string' => $service_tag_string,
					/*'service_tag_arabic'					=>$service_tag_ar ,             */
					'email' => $this->input->post('email'),
					'twitter' => $this->input->post('twitter'),
				);

				$result = $this->workshop->add_workshop($data);
				if ($result) {
					redirect(base_url('workshop/?success=Add  successfully!'));
				} else {
					redirect(base_url('workshop/add_workshop?error=Some error!'));
				}
			} else {
				$error = validation_errors();

				$this->data['error'] = $error;
			}
		}

		$this->data['service'] = $this->service_tag->manage_workshop();
		$this->data['title'] = 'Add Worshops';
		$this->load->view('add_workshop', $this->data);
	}

	/// end of test

	public function import_workshop() {
		if ($this->input->post()) {

			$service_tag = !empty($this->input->post('service')) ? implode(',', $this->input->post('service')) : "";
			$day_off = !empty($this->input->post('day_off')) ? implode(',', $this->input->post('day_off')) : "";

			$search_tag = implode(',', $this->input->post('serch_tag'));
			$search_tag_ar = implode(',', $this->input->post('serch_tag_arabic'));

			$service_tag_string = '';
			if ($this->input->post('service')) {
				$getSelectService = $this->service_tag->getSelectService($this->input->post('service'));
				$service_tag_string = '';
				foreach ($getSelectService as $service) {

					$service_tag_string = $service_tag_string . $service->keywords;
				}
			}

			$rules = array(

				array(
					'field' => 'ws_name',
					'label' => 'Workshop Name',
					'rules' => 'trim',
				),
				array(
					'field' => 'arabic_name',
					'label' => 'Arabic Name',
					'rules' => 'trim',
				),
				array(
					'field' => 'city',
					'label' => 'City Name ',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'country',
					'label' => 'Country Name ',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'opening_hour',
					'label' => 'Opening Hour',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'closing_hour',
					'label' => 'Closing Hour ',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'location_lat',
					'label' => 'Location Latitude ',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'phone',
					'label' => 'Phone No',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'address',
					'label' => 'Address',
					'rules' => 'trim|required',
				),
				// array(
				//     'field'   => 'day_off',
				//     'label'   => 'Day Off',
				//     'rules'   => 'trim|required'
				// )
				/*array(
	                    'field'   => $service_tag,
	                    'label'   => 'Service Type',
	                    'rules'   => 'trim|required'
	                ),
	                array(
	                    'field'   => $service_tag_ar,
	                    'label'   => 'Service Type AR ',
	                    'rules'   => 'trim|required'
*/
			);

			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				$dataInfo = array();
				$files = $_FILES;

				$cpt = count($_FILES['image']['name']);
				for ($i = 0; $i < $cpt; $i++) {

					$fname = $_FILES['file_name']['name'] = $files['image']['name'][$i];
					$_FILES['file_name']['tmp_name'] = $files['image']['tmp_name'][$i];
					$_FILES['file_name']['size'] = $_FILES['image']['size'][$i];

					$config = array();
					$config['upload_path'] = './upload/';
					$config['file_name'] = time() . $fname;
					$config['allowed_types'] = 'gif|jpg|png|jpeg';

					$this->upload->initialize($config);
					$this->upload->do_upload('file_name');
					$dataInfo[] = $this->upload->data();
				}

				$title = $this->input->post('ws_name');
				$arabicTitle = $this->input->post('arabic_name');

				if ($this->input->post('ws_name') == "") {
					$title = $arabicTitle;
				} elseif ($this->input->post('arabic_name') == "") {
					$arabicTitle = $title;
				}

				//	date_default_timezone_set('Africa/Cairo');
				$opening_hour = strtotime($this->input->post('opening_hour'));
				//	date_default_timezone_get();
				//	date_default_timezone_set("UTC");
				$opening_hours = date("H:i", $opening_hour);

				//	date_default_timezone_set('Africa/Cairo');
				$closing_hour = strtotime($this->input->post('closing_hour'));
				//	date_default_timezone_get();
				//	date_default_timezone_set("UTC");
				$closing_hours = date("H:i", $closing_hour);

				$data = array(

					// 'workshop_bg_img' => $dataInfo[0]['file_name'],
					// 'workshop_logo' => $dataInfo[1]['file_name'],
					// 'photo_selection_arround_rating' => $dataInfo[2]['file_name'],
					'name' => $title,
					'arabic_name' => $arabicTitle,
					'web' => $this->input->post('web'),
					'city' => $this->input->post('city'),
					'country' => $this->input->post('country'),
					'location_lat' => $this->input->post('location_lat'),
					'location_lon' => $this->input->post('location_lon'),
					'address' => $this->input->post('address'),
					'opening_hour' => $opening_hours,
					'closing_hour' => $closing_hours,
					'day_off' => $day_off,
					'phone' => $this->input->post('phone'),
					'twitter' => $this->input->post('twitter'),
					'email' => $this->input->post('email'),
					'serch_tag' => $search_tag,
					'serch_tag_arabic' => $search_tag_ar,
					'facebook_page_link' => $this->input->post('fb_link'),
					"created_date" => date("Y-m-d"),
					'service_tag_string' => $service_tag_string,
					// 'service_tag' => $service_tag,
				);

				$result = $this->workshop->add_workshop($data);
				if ($result) {
					redirect(base_url('workshop/?success=Add  successfully!'));
				} else {
					redirect(base_url('workshop/add_workshop?error=Some error!'));
				}
			} else {
				$error = validation_errors();

				$this->data['error'] = $error;
			}
		}

		$this->data['service'] = $this->service_tag->manage_workshop();
		$this->data['title'] = 'Import Worshops';
		$this->load->view('excel_workshop', $this->data);
	}

	function export() {
		$this->load->model("Workshop_model");
		// $this->this->workshop->fetch_data();
		$this->load->library("excel");
		$object = new PHPExcel();

		$object->setActiveSheetIndex(0);

		$table_columns = array("name", "arabic_name", "web", "city", "country", "location_lat", "location_lon", "address", "opening_hour", "closing_hour", "day_off", "phone", "twitter", "email", "serch_tag", "serch_tag_arabic", "facebook_page_link", "created_date");

		$column = 0;

		foreach ($table_columns as $field) {
			$object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
			$column++;
		}

		$employee_data = $this->Workshop_model->fetch_data();

		$excel_row = 2;

		foreach ($employee_data as $row) {
			$object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->name);
			$object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->arabic_name);
			$object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->web);
			$object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row->city);
			$object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->country);
			$object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row->location_lat);
			$object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row->location_lon);
			$object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $row->address);
			$object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $row->opening_hour);
			$object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $row->closing_hour);
			$object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, $row->day_off);
			$object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, $row->phone);
			$object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, $row->twitter);
			$object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row, $row->email);
			$object->getActiveSheet()->setCellValueByColumnAndRow(14, $excel_row, $row->serch_tag);
			$object->getActiveSheet()->setCellValueByColumnAndRow(15, $excel_row, $row->serch_tag_arabic);
			$object->getActiveSheet()->setCellValueByColumnAndRow(16, $excel_row, $row->facebook_page_link);
			$object->getActiveSheet()->setCellValueByColumnAndRow(17, $excel_row, $row->created_date);
			$excel_row++;
		}

		$object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel2007');
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="workshop Data.xlsx"');
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

	public function ws_del($id) {
		$id = $this->workshop->ws_del($id);
		if ($id) {
			redirect(base_url('workshop/?success= Delete successfully!'));
		} else {
			redirect(base_url('workshop/?error=Some error!'));
		}
	}
	public function edit_workshop($id) {
		$this->data['rec'] = $this->workshop->edit_workshop($id);
		$this->data['service'] = $this->service_tag->manage_workshop();
		$this->data['title'] = 'Edit Worshops';
		$this->load->view('edit_workshop', $this->data);
	}
	public function update_workshop() {

		if ($this->input->post()) {
			$id = $this->input->post('id');
			$search_tag = implode(',', $this->input->post('serch_tag'));
			$search_tag_ar = implode(',', $this->input->post('serch_tag_arabic'));
			$service_tag = !empty($this->input->post('service')) ? implode(',', $this->input->post('service')) : "";
			$day_off = !empty($this->input->post('day_off')) ? implode(',', $this->input->post('day_off')) : "";
			$service_tag_string = '';
			if ($this->input->post('service')) {
				$getSelectService = $this->service_tag->getSelectService($this->input->post('service'));
				$service_tag_string = '';
				foreach ($getSelectService as $service) {

					$service_tag_string = $service_tag_string . $service->keywords;
				}
			}
			$rules = array(

				array(
					'field' => 'ws_name',
					'label' => 'Workshop Name',
					'rules' => 'trim',
				),
				array(
					'field' => 'arabic_name',
					'label' => 'Arabic Name',
					'rules' => 'trim',
				),
				array(
					'field' => 'city',
					'label' => 'City Name ',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'country',
					'label' => 'Country Name ',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'opening_hour',
					'label' => 'Opening Hour',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'closing_hour',
					'label' => 'Closing Hour ',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'location_lat',
					'label' => 'Location Latitude ',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'phone',
					'label' => 'Phone No',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'address',
					'label' => 'Address',
					'rules' => 'trim|required',
				),
				// array(
				// 	'field'   => 'day_off',
				// 	'label'   => 'Day Off',
				// 	'rules'   => 'trim|required'
				// )
				/*array(
					'field'   => 'service_english',
					'label'   => 'Service Type',
					'rules'   => 'trim|required'
				),
				array(
					'field'   => 'service_arabic',
					'label'   => 'Service Type AR ',
					'rules'   => 'trim|required'
				)*/
			);

			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				$dataInfo = array();
				$files = $_FILES;
				$title = $this->input->post('ws_name');
				$arabicTitle = $this->input->post('arabic_name');

				if ($this->input->post('ws_name') == "") {
					$title = $arabicTitle;
				} elseif ($this->input->post('arabic_name') == "") {
					$arabicTitle = $title;
				}

				//		date_default_timezone_set('Africa/Cairo');
				$opening_hour = strtotime($this->input->post('opening_hour'));
				//		date_default_timezone_get();
				//		date_default_timezone_set("UTC");
				$opening_hours = date("H:i", $opening_hour);

				//		date_default_timezone_set('Africa/Cairo');
				$closing_hour = strtotime($this->input->post('closing_hour'));
				//			date_default_timezone_get();
				//			date_default_timezone_set("UTC");
				$closing_hours = date("H:i", $closing_hour);

				$data = array(
					'name' => $title,
					'arabic_name' => $arabicTitle,
					'web' => $this->input->post('web'),
					'city' => $this->input->post('city'),
					'country' => $this->input->post('country'),
					'location_lat' => $this->input->post('location_lat'),
					'location_lon' => $this->input->post('location_lon'),
					'opening_hour' => $opening_hours,
					'closing_hour' => $closing_hours,
					'day_off' => $day_off,
					'phone' => $this->input->post('phone'),
					'facebook_page_link' => $this->input->post('fb_link'),
					'address' => $this->input->post('address'),

					'serch_tag' => $search_tag,
					'serch_tag_arabic' => $search_tag_ar,
					'service_tag' => $service_tag,
					'service_tag_string' => $service_tag_string,
					/*'service_tag_arabic'					=>$service_tag_ar ,             */
					'email' => $this->input->post('email'),
					'twitter' => $this->input->post('twitter'),
				);

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
						$upload_data = $this->upload->data();
						if ($i == 0) {
							$data['workshop_bg_img'] = $upload_data['file_name'];
						} else if ($i == 1) {
							$data['workshop_logo'] = $upload_data['file_name'];
						} else if ($i == 2) {
							$data['photo_selection_arround_rating'] = $upload_data['file_name'];
						}

					}
				}

				if (empty($data['photo_selection_arround_rating']) && empty($this->input->post('image_input'))) {
					//	echo  "p1";
					$data['photo_selection_arround_rating'] = '';

				}

				$result = $this->workshop->update_ws($data, $id);
				if ($result) {
					redirect(base_url('workshop/?success=update  successfully!'));
				} else {
					redirect(base_url('workshop/?success=update  successfully!'));
				}
			} else {
				$error = validation_errors();

				$this->data['error'] = $error;

				$this->edit_workshop($id);
			}
		}
	}

	public function update_active() {
		if (isset($_REQUEST['sval'])) {
			$this->load->model('Workshop_model', 'workshop');
			$up_active = $this->workshop->update_active();

			if ($up_active > 0) {
				$this->session->set_flashdata('msg', 'data updated successfully');
				$this->session->set_flashdata('msg_class', 'alert-success');
			} else {
				$this->session->set_flashdata('msg', 'data not updated successfully');
				$this->session->set_flashdata('msg_class', 'alert-danget');
			}
			return redirect('workshop');
		}
	}

	public function delete_workshop_image() {

		$id = $this->input->post('id');

		echo $this->workshop->delete_workshop_image($id);
	}

}
