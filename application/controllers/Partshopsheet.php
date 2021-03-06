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

class Partshopsheet extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->database();
		// load model
		$this->load->helper('url');
		// $this->load->model('Workshop_excel', 'workshopex');
		// $this->load->model('workshop_model', 'test');
		$this->load->model('Partsshop_model', 'partshop');

	}
	// index
	public function index() {
		$this->data['title'] = 'Import Excel Sheet';

		$this->load->view('excel_part_shop', $this->data);
	}

	// file upload functionality
	public function upload() {
		// Load form validation library
		$this->load->library('form_validation');
		$this->form_validation->set_rules('fileURL', 'Upload File', 'callback_checkFileValidation');
		if ($this->form_validation->run() == false) {

			redirect(base_url('partshop/?error= invalid File or No file'));
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

					$name = $allDataInSheet[$row]['A'];
					$arabic_name = $allDataInSheet[$row]['B'];
					$web_link = $allDataInSheet[$row]['C'];
					$city = $allDataInSheet[$row]['D'];
					$country = $allDataInSheet[$row]['E'];
					$location_latitude = $allDataInSheet[$row]['F'];
					$location_longitude = $allDataInSheet[$row]['G'];
					$opening_hours = $allDataInSheet[$row]['H'];
					$closing_hours = $allDataInSheet[$row]['I'];
					$part_type = $allDataInSheet[$row]['J'];
					$off_day = $allDataInSheet[$row]['K'];
					$phone = $allDataInSheet[$row]['L'];
					$facebok_link = $allDataInSheet[$row]['M'];
					$address = $allDataInSheet[$row]['N'];
					$serch_tag = $allDataInSheet[$row]['O'];
					$serch_tag_arabic = $allDataInSheet[$row]['P'];
					$created_date = $allDataInSheet[$row]['Q'];
					$email = $allDataInSheet[$row]['R'];
					$tweeter = $allDataInSheet[$row]['S'];
					$brand = $allDataInSheet[$row]['T'];
					$service_tag = $allDataInSheet[$row]['U'];

					$data = array(
						'name' => $name,
						'arabic_name' => $arabic_name,
						'web_link' => $web_link,
						'city' => $city,
						'country' => $country,
						'location_longitude' => $location_longitude,
						'location_longitude' => $location_longitude,
						'opening_hours' => $opening_hours,
						'closing_hours' => $closing_hours,
						'part_type' => $part_type,
						'off_day' => $off_day,
						'phone' => $phone,
						'facebok_link' => $facebok_link,
						'address' => $address,
						'serch_tag' => $serch_tag,
						'serch_tag_arabic' => $serch_tag_arabic,
						'created_date' => $created_date,
						'email' => $email,
						'tweeter' => $tweeter,
						'brand' => $brand,
						'service_tag' => $service_tag,
					);

					if ($brand == "" || $service_tag == "") {
						continue;
					}

					if (is_numeric($brand)) {
						if (!$this->partshop->get_by_id($brand)) {
							echo $start_index . ": No Services Type with the given ID or Name\n";
							continue;
						}

					} else {
						$object = $this->partshop->get_by_name($brand);
						if (!$object) {
							$new_array['brand'] = $brand;
						} else {
							$new_array['brand'] = $object[0]->id;
						}

					}

					if (is_numeric($service_tag)) {
						if (!$this->partshop->get_service_tag_by_id($service_tag)) {
							echo $start_index . ": No Services Type with the given ID or Name\n";
							continue;
						}

					} else {
						$object = $this->partshop->get_service_tag_by_name($service_tag);
						if (!$object) {
							$new_array['service_tag'] = $service_tag;
						} else {
							$new_array['service_tag'] = $object[0]->id;
						}

					}

					if ($result = $this->partshop->add_part_shop($data)) {
//						print_r($column);
						$counter++;
					} else {
						$failed++;
					}

				}
				if ($failed > 0) {
					redirect(base_url('partshop/?success=' . $counter . ' Partshops were added successfully!&error=' . $failed . ' failed to be added'));
				}
				redirect(base_url('partshop/?success=' . $counter . ' Partshops were added successfully!'));

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