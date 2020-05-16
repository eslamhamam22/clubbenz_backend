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

class Phpspreadsheet extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->database();
		// load model
		$this->load->helper('url');
		$this->load->model('Site', 'site');
		$this->load->model('Cars_model', 'test');

	}
	// index
	public function index() {
		$this->data['title'] = 'ExcelSheet';
		$this->load->view('excel_index', $this->data);
	}

	// file upload functionality
	public function upload() {
		// Load form validation library
		$this->load->library('form_validation');
		$this->form_validation->set_rules('fileURL', 'Upload File', 'callback_checkFileValidation');
		if ($this->form_validation->run() == false) {

			redirect(base_url('cars/?error= invalid File or No file'));
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

				if ($arrayCount > 0) {
					$this->db->empty_table('cars');
				}

				for ($row = 2; $row <= count($allDataInSheet); $row++) {

					$model_name = $allDataInSheet[$row]['A'];
					$fuel_name = $allDataInSheet[$row]['D'];
					$chassis_number = $allDataInSheet[$row]['F'];

					$model_id = $this->site->getModelId($model_name);
					$fuel_id = $this->site->getFuelTypeId($fuel_name);
					$chassis_id = $this->site->getChassisId($chassis_number);
					$data = array(
						'model_id' => $model_id->id,
						'chassis' => $chassis_id->id,
						'model_year_start' => $allDataInSheet[$row]['B'],
						'model_year_end' => $allDataInSheet[$row]['C'],
						'fuel_type' => $fuel_id->id,
						'vin_prefix' => $allDataInSheet[$row]['E'],
						'model' => $allDataInSheet[$row]['G'],
						'model_text' => $allDataInSheet[$row]['H'],
						'displacement' => $allDataInSheet[$row]['I'],
						'motor_code' => $allDataInSheet[$row]['J'],
						'horse_power' => $allDataInSheet[$row]['K'],
						'oil_capacity_liter' => $allDataInSheet[$row]['L'],
						'top_speed' => $allDataInSheet[$row]['M'],
						'fuel_per_hundred_km' => $allDataInSheet[$row]['N'],
						'acceleretion_second' => $allDataInSheet[$row]['O'],
						'wheels' => $allDataInSheet[$row]['P'],
						'tires' => $allDataInSheet[$row]['Q'],
					);

					$this->db->insert('cars', $data);
					$id = $this->db->insert_id();
					//  $this->$flag = $this->site->add_car_data($data);
					// echo base_url('cars/?success=Data%20Imported%20successfully!') ;

				}
				if (true) {

					$this->load->helper('url');
					redirect('http://66.45.230.53/~clubenz/live/cars/?success=Data%20Imported%20successfully!', 'refresh');
					return;
				}
				// else{
				//       redirect( base_url('cars/?success=Error'));

				// }

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