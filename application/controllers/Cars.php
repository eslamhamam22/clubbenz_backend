<?php
class Cars extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->library('upload');
		$this->load->helper(array('form', 'url'));
		$this->load->library(['ion_auth', 'form_validation']);
		$this->load->helper(['url', 'language']);
		$this->load->model('Car_model', 'car');
		$this->load->model('Part_model', 'part');
		$this->load->model('Car_guide_model', 'car_guide');
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

		$this->data['rec'] = $this->car->cars_manage();
		$this->data['chassis_number'] = $this->car->get_chassis_num();
		$this->data['get_modell'] = $this->car->get_model_num();
		$this->data['title'] = 'Cars';
		$this->load->view('cars_manage', $this->data);
	}

	public function add_cars() {
		if ($this->input->post()) {
			$rules = array(
				array(
					'field' => 'year_start',
					'label' => 'Start Year',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'year_end',
					'label' => 'End Year',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'model_text',
					'label' => 'Model Text',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'vin_prefix',
					'label' => 'Vin Prefix',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'fuel_type',
					'label' => 'Fuel Type',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'model',
					'label' => 'Model',
					'rules' => 'trim|required',
				),
			);
			$this->form_validation->set_rules($rules);
			$cha = implode(',', $this->input->post('chassis'));
			$model_id = implode(',', $this->input->post('model_id'));

			if ($cha == "all") {

				$model_list = explode(",", $model_id);
				$chassis_list = [];
				foreach ($model_list as $single_model) {
					$model_chassis = $this->part->get_chassis_by_model($single_model);
					foreach ($model_chassis as $single_chassis) {
						echo $single_chassis->id;
						$chassis_list = array_merge($chassis_list, array($single_chassis->id));
					}
				}
				$cha = implode(',', $chassis_list);

			}
			if ($this->form_validation->run()) {
				$data = array(
					'model_id' => $model_id,
					'chassis' => $cha,
					'model_year_start' => $this->input->post('year_start'),
					'model_year_end' => $this->input->post('year_end'),
					'fuel_type' => $this->input->post('fuel_type'),
					'vin_prefix' => $this->input->post('vin_prefix'),
					'model' => $this->input->post('model'),
					'model_text' => $this->input->post('model_text'),
					'displacement' => $this->input->post('displacement'),
					'motor_code' => $this->input->post('motor_code'),
					'horse_power' => $this->input->post('horse_power'),
					'oil_capacity_liter' => $this->input->post('oil_capacity_letter'),
					'top_speed' => $this->input->post('top_speed'),
					'fuel_per_hundred_km' => $this->input->post('fuel_hundred'),
					'acceleretion_second' => $this->input->post('ac_sec'),
					'wheels' => $this->input->post('wheeles'),
					'tires' => $this->input->post('tyres'),
					'text1' => $this->input->post('text'),
					'text2' => $this->input->post('text_one'),
				);

				$id = $this->car->add_car_data($data);
				if ($id) {
					redirect(base_url('cars/?success=Add Year successfully!'));
					//$this->data['success'] = "Added successfully";
				} else {
					//redirect( base_url('carmodel/cars_manage?error=Some error!') );
					$this->data['error'] = "Some Error";
				}
			} else {

				$error = validation_errors();

				$this->data['error'] = $error;

			}
		}
		$this->data['fuel_name'] = $this->car->get_fuel();
		$this->data['chassis_number'] = $this->car->get_chassis();
		$this->data['year'] = $this->car->get_classes();
		$this->data['model_name'] = $this->car->get_classes();
		$this->data['title'] = 'Add Cars';
		$this->load->view('add_cars', $this->data);
	}
	public function import_cars() {
		if ($this->input->post()) {
			$rules = array(
				array(
					'field' => 'year',
					'label' => 'Year',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'year_start',
					'label' => 'Start Year',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'year_end',
					'label' => 'End Year',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'model_text',
					'label' => 'Model Text',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'vin_prefix',
					'label' => 'Vin Prefix',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'fuel_type',
					'label' => 'Fuel Type',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'chassis',
					'label' => 'Chassis',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'model',
					'label' => 'Model',
					'rules' => 'trim|required',
				),
			);
			$cha = implode(',', $this->input->post('chassis'));
			$model_id = implode(',', $this->input->post('model_id'));

			if ($cha == "all") {

				$model_list = explode(",", $model_id);
				$chassis_list = [];
				foreach ($model_list as $single_model) {
					$model_chassis = $this->part->get_chassis_by_model($single_model);
					foreach ($model_chassis as $single_chassis) {
						echo $single_chassis->id;
						$chassis_list = array_merge($chassis_list, array($single_chassis->id));
					}
				}
				$cha = implode(',', $chassis_list);

			}
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				$data = array(
					'model_id' => $cha,
					'chassis' => $model_id,
					'model_year_start' => $this->input->post('year_start'),
					'model_year_end' => $this->input->post('year_end'),
					'fuel_type' => $this->input->post('fuel_type'),
					'vin_prefix' => $this->input->post('vin_prefix'),
					'model' => $this->input->post('year'),
					'model_text' => $this->input->post('model_text'),
					'displacement' => $this->input->post('displacement'),
					'motor_code' => $this->input->post('motor_code'),
					'horse_power' => $this->input->post('horse_power'),
					'oil_capacity_liter' => $this->input->post('oil_capacity_letter'),
					'top_speed' => $this->input->post('top_speed'),
					'fuel_per_hundred_km' => $this->input->post('fuel_hundred'),
					'acceleretion_second' => $this->input->post('ac_sec'),
					'wheels' => $this->input->post('wheeles'),
					'tires' => $this->input->post('tyres'),
					'text1' => $this->input->post('text'),
					'text2' => $this->input->post('text_one'),
				);

				$id = $this->car->add_car_data($data);
				if ($id) {
					redirect(base_url('cars/?success=Add Year successfully!'));
					//$this->data['success'] = "Added successfully";
				} else {
					//redirect( base_url('carmodel/cars_manage?error=Some error!') );
					$this->data['error'] = "Some Error";
				}
			} else {

				$error = validation_errors();

				$this->data['error'] = $error;

			}
		}
		$this->data['fuel_name'] = $this->car->get_fuel();
		$this->data['chassis_number'] = $this->car->get_chassis();
		$this->data['year'] = $this->car->get_classes();
		$this->data['model_name'] = $this->car->get_classes();
		$this->data['title'] = 'Import Excel Sheet';
		$this->load->view('excel_index', $this->data);
	}

	public function car_del($id) {
		$id = $this->car->car_del($id);
		if ($id) {
			redirect(base_url('cars/?success=Model Delete successfully!'));
		} else {
			redirect(base_url('cars/?error=Some error!'));
		}
	}
	public function edit_car($id) {
		if ($this->input->post()) {
			$cha = !empty($this->input->post('chassis')) ? implode(',', $this->input->post('chassis')) : "";
			$model_id = !empty($this->input->post('model_id')) ? implode(',', $this->input->post('model_id')) : "";

			if ($cha == "all") {

				$model_list = explode(",", $model_id);
				$chassis_list = [];
				foreach ($model_list as $single_model) {
					$model_chassis = $this->part->get_chassis_by_model($single_model);
					foreach ($model_chassis as $single_chassis) {
						echo $single_chassis->id;
						$chassis_list = array_merge($chassis_list, array($single_chassis->id));
					}
				}
				$cha = implode(',', $chassis_list);

			}$rules = array(
				array(
					'field' => 'year_start',
					'label' => 'Start Year',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'year_end',
					'label' => 'End Year',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'model_text',
					'label' => 'Model Text',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'vin_prefix',
					'label' => 'Vin Prefix',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'fuel_type',
					'label' => 'Fuel Type',
					'rules' => 'trim|required',
				),
			);

			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run()) {
				$data = array(
					'model_id' => $model_id,
					'chassis' => $cha,
					'model_year_start' => $this->input->post('year_start'),
					'model_year_end' => $this->input->post('year_end'),
					'fuel_type' => $this->input->post('fuel_type'),
					'vin_prefix' => $this->input->post('vin_prefix'),
					'model' => $this->input->post('model'),
					'model_text' => $this->input->post('model_text'),
					'displacement' => $this->input->post('displacement'),
					'motor_code' => $this->input->post('motor_code'),
					'horse_power' => $this->input->post('horse_power'),
					'oil_capacity_liter' => $this->input->post('oil_capacity_letter'),
					'top_speed' => $this->input->post('top_speed'),
					'fuel_per_hundred_km' => $this->input->post('fuel_hundred'),
					'acceleretion_second' => $this->input->post('ac_sec'),
					'wheels' => $this->input->post('wheeles'),
					'tires' => $this->input->post('tyres'),
					'text1' => $this->input->post('text'),
					'text2' => $this->input->post('text_one'),
				);

				$this->car->car_information_update_value($data, $id);

				redirect(base_url('cars/?success=Update car information successfully!'));
			} else {
				$error = validation_errors();
				$this->data['error'] = $error;
			}
		}

		$this->data['chassis_number'] = $this->car->get_chassis();
		// $this->data['chassis'] = $this->data['chassis_number'];
		$this->data['fuel_name'] = $this->car->get_fuel();
		$this->data['models'] = $this->car->get_classes();
		$this->data['model_name'] = $this->car->get_classes();
		$this->data['rec'] = $this->car->car_information_update($id);
		$this->data['title'] = 'Edit Cars';

		$this->load->view('car_information_update', $this->data);
	}

}