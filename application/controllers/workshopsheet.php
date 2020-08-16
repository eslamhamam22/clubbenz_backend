<?php
/**
 * @package Phpspreadsheet :  Phpspreadsheet
 * @author TechArise Team
 *
 * @email  info@techarise.com
 *
 * Description of Phpspreadsheet Controller
 */

defined('BASEPATH') OR exit('No direct script access allowed');
//PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class workshopsheet extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->database();
		// load model
		$this->load->helper('url');
		$this->load->model('Workshop_excel', 'workshopex');
		$this->load->model('workshop_model', 'test');
		$this->load->model('Workshop_model', 'workshop');

	}
	// index
	public function index() {
		$this->data['title'] = 'Import Excel Sheet';

		$this->load->view('excel_workshop', $this->data);
	}

	// file upload functionality
	public function upload() {
		// Load form validation library
		$this->load->library('form_validation');
		$this->form_validation->set_rules('fileURL', 'Upload File', 'callback_checkFileValidation');
		if ($this->form_validation->run() == false) {

			redirect(base_url('workshop/?error= invalid File or No file'));
		} else {
			// If file uploaded
			if (!empty($_FILES['fileURL']['name'])) {
				// get file extension
				$extension = pathinfo($_FILES['fileURL']['name'], PATHINFO_EXTENSION);

				if ($extension == 'csv') {
					$reader = IOFactory::createReader('Csv');

					$reader->setReadDataOnly(true);
				} elseif ($extension == 'xlsx') {
					$reader = IOFactory::createReader('Xlsx');

					$reader->setReadDataOnly(true);

				} else {
					$reader = IOFactory::createReader('Xls');

					$reader->setReadDataOnly(true);
				}
				// file path
				$spreadsheet = $reader->load($_FILES['fileURL']['tmp_name']);
				$allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

				$conn = new mysqli($this->db->hostname, $this->db->username, $this->db->password, $this->db->database);

				$arrayCount = count($allDataInSheet);

				if ($conn->connect_error) {
					die("Connection Failed :" . $conn->connect_error);
				}
				$flag = '';

				// if ($arrayCount > 0) {
				// 	$this->db->empty_table('workshop');
				// }
				//
				$counter = 0;
				$failed = 0;

				for ($row = 2; $row <= count($allDataInSheet); $row++) {
					$data = array(
						'name' => $allDataInSheet[$row]['A'],
						'arabic_name' => $allDataInSheet[$row]['B'],
						'city' => $allDataInSheet[$row]['C'],
						'country' => $allDataInSheet[$row]['D'],
						'location_lat' => $allDataInSheet[$row]['E'],
						'location_lon' => $allDataInSheet[$row]['F'],
						'address' => $allDataInSheet[$row]['G'],
						'opening_hour' => $allDataInSheet[$row]['H'],
						'closing_hour' => $allDataInSheet[$row]['I'],
						'day_off' => $allDataInSheet[$row]['J'],
						'phone' => $allDataInSheet[$row]['K'],
						'twitter' => $allDataInSheet[$row]['L'],
						'email' => $allDataInSheet[$row]['M'],
						'serch_tag' => $allDataInSheet[$row]['N'],
						'serch_tag_arabic' => $allDataInSheet[$row]['O'],
						'facebook_page_link' => $allDataInSheet[$row]['P'],
						'created_date' => $allDataInSheet[$row]['Q'],
					);

					if ($result = $this->workshop->add_workshop($data)) {
//						print_r($column);
						$counter++;
					} else {
						$failed++;
					}

				}
				if ($failed > 0) {
					redirect(base_url('workshop/?success=' . $counter . ' Workshops were added successfully!&error=' . $failed . ' failed to be added'));
				}
				redirect(base_url('workshop/?success=' . $counter . ' Workshops were added successfully!'));

			} else {
				echo "Please import correct file, did not match excel sheet column";
			}
		}
	}

	// checkFileValidation
	public function checkFileValidation($string) {
		$file_mimes = array('text/x-comma-separated-values',
			'text/comma-separated-values',
			'application/octet-stream',
			'application/vnd.ms-excel',
			'application/x-csv',
			'text/x-csv',
			'text/csv',
			'application/csv',
			'application/excel',
			'application/vnd.msexcel',
			'text/plain',
			'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
		);
		if (isset($_FILES['fileURL']['name'])) {
			$arr_file = explode('.', $_FILES['fileURL']['name']);
			$extension = end($arr_file);
			if (($extension == 'xlsx' || $extension == 'xls' || $extension == 'csv') && in_array($_FILES['fileURL']['type'], $file_mimes)) {
				return true;
			} else {
				$this->form_validation->set_message('checkFileValidation', 'Please choose correct file.');
				return false;
			}
		} else {
			$this->form_validation->set_message('checkFileValidation', 'Please choose a file.');
			return false;
		}
	}

}

?>