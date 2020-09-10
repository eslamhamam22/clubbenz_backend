<?php
class Service_tag extends MY_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->library('upload');
		$this->load->helper(array('form', 'url'));
		$this->load->library(['ion_auth', 'form_validation']);
		$this->load->helper(['url', 'language']);
		$this->load->model('cars_model', 'cars');
		$this->load->model('offers_model', 'offers');
		$this->load->model('service_tag_model', 'service');
		$this->load->model('Service_model', 'service_model');
		$this->load->model('location_model', 'location');
		$this->load->model('acl_model');
		$this->load->model('Workshop_model');
		$this->load->model('Partsshop_model', 'partshop');
		$this->load->model('Serviceshop_model', 'serviceshop');
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
		$this->data['serviceshop'] = $this->service->manage_serviceshop();
		$this->data['partshop'] = $this->service->manage_partshop();
		$this->data['workshop'] = $this->service->manage_workshop();
		$this->data['title'] = 'Manage Services Tag';
		$this->load->view('manage_service_tag', $this->data);
	}

	public function add_service_tag() {
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
				$name = array(
					'name' => $this->input->post('name'),
					'arabic_name' => $this->input->post('arabic_name'),
					'shop_type' => $this->input->post('shop_type'),
					'keywords' => $this->input->post('keywords'),
					'sorting' => $this->input->post('sorting'),
					'service_type_id' => $this->input->post('service_type_id'),
				);
				$id = $this->service->add_service_tag($name);
				if ($id) {
					redirect(base_url('service_tag/?success= added successfully!'));
				} else {
					redirect(base_url('service_tag/add_service_tag?error=Some error!'));
				}
			} else {
				$error = validation_errors();
				redirect(base_url('service_tag/add_service_tag?error=' . $error));
			}
		}
		$this->data['service_type'] = $this->service_model->manage_service_type();
		$this->data['title'] = 'Add Services Tag';
		$this->load->view('add_service_tag', $this->data);
	}

	public function del_service_tag($id) {
		$id = $this->service->del_service_tag($id);
		if ($id) {
			redirect(base_url('service_tag/?success= deleted successfully!'));
		} else {
			redirect(base_url('location/?error=Some error!'));
		}
	}
	public function edit_service_tag($id) {

		$this->data['service'] = $this->service->edit_service_tag($id);
		$this->data['service_type'] = $this->service_model->manage_service_type();
		$this->data['title'] = 'Edit Services Tag';
		$this->load->view('edit_service_tag', $this->data);
	}
	public function update_service_tag() {
		if ($this->input->post()) {
			$rules = array(
				array(
					'field' => 'name',
					'label' => 'Location Zone Name',
					'rules' => 'trim|required',
				),
			);

			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				$id = $this->input->post('id');

				$data = array(
					'name' => $this->input->post('name'),
					'arabic_name' => $this->input->post('arabic_name'),
					'shop_type' => $this->input->post('shop_type'),
					'keywords' => $this->input->post('keywords'),
					'sorting' => $this->input->post('sorting'),
					'service_type_id' => $this->input->post('service_type_id'),
				);

				$id = $this->service->update_service_tag($data, $id);

				if ($this->input->post('shop_type') == 'workshop') {

					$get_all_workshops = $this->Workshop_model->get_all_workshops();

				} else if ($this->input->post('shop_type') == 'partshop') {

					$get_all_workshops = $this->partshop->get_all_partshop();

				} else if ($this->input->post('shop_type') == 'serviceshop') {

					$get_all_workshops = $this->serviceshop->get_all_service_shop();

				}

				if ($get_all_workshops) {
					foreach ($get_all_workshops as $workshop) {

						$service_tagID = explode(',', $workshop->service_tag);

						foreach ($service_tagID as $idInshop) {
							if ($idInshop == $this->input->post('id')) {

								$getSelectService = $this->service->getSelectService($service_tagID);

								$service_tag_string = '';
								foreach ($getSelectService as $service) {

									$service_tag_string = $service_tag_string . $service->keywords;
								}
								// update keyword
								$workshopdata['service_tag_string'] = $service_tag_string;

								if ($this->input->post('shop_type') == 'workshop') {

									$this->Workshop_model->update_ws($workshopdata, $workshop->id);

								} else if ($this->input->post('shop_type') == 'partshop') {

									$this->partshop->update_part_shop($workshopdata, $workshop->id);

								} else if ($this->input->post('shop_type') == 'serviceshop') {

									$this->serviceshop->update_service_shop($workshopdata, $workshop->id);

								}

							}
						}
					}
				}

				if ($id) {
					redirect(base_url('service_tag/?success=Update successfully!'));
				} else {
					redirect(base_url('service_tag/?success=Update successfully!'));
				}
			} else {
				$error = validation_errors();
				redirect(base_url('service_tag/update_service_tag?error=' . $error));

			}
		}
	}

	// Services Type

	public function manage_service_type() {
		$this->data['service_type'] = $this->service_model->manage_service_type();
		$this->data['title'] = 'Manage Services Type';
		$this->load->view('manage_service_type', $this->data);
	}

	public function add_services_type() {
		if ($this->input->post()) {
			$rules = array(
				array(
					'field' => 'name',
					'label' => 'name',
					'rules' => 'trim|required',
				),
			);

			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				$new_array['name'] = $this->input->post('name');

				$result = $this->service_model->add_services_type($new_array);
				if ($result) {
					redirect(base_url('service_tag/manage_service_type/?success=Add  successfully!'));
				} else {
					redirect(base_url('service_tag/manage_service_type/?error=Some error!'));
				}
			} else {
				$error = validation_errors();
				redirect(base_url('service/?error=' . $error));
			}
		}
		$this->data['title'] = 'Add Services Type';
		$this->load->view('add_services_type', $this->data);
	}

	public function service_type_del($id) {
		$id = $this->service_model->service_type_del($id);
		if ($id) {
			redirect(base_url('service_tag/manage_service_type/?success= Delete successfully!'));
		} else {
			redirect(base_url('service_tag/manage_service_type/?error=Some error!'));
		}
	}

	public function edit_service_type($id) {
		$data['rec'] = $this->service_model->edit_service_type($id);
		$data['title'] = 'Edit Services Type';
		$this->load->view('edit_service_type', $data);
	}

	public function service_type_update() {

		$id = $this->input->post('id');
		if ($this->input->post()) {

			$rules = array(
				array(
					'field' => 'name',
					'label' => 'name',
					'rules' => 'trim|required',
				),
			);

			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				$new_array['name'] = $this->input->post('name');

				$val = $this->service_model->service_type_update($new_array, $id);
				if ($val) {
					redirect(base_url('service_tag/manage_service_type/?success=Update  successfully!'));
				} else {
					redirect(base_url('service_tag/manage_service_type/?success=Update  successfully!'));
				}
			} else {
				$error = validation_errors();
				redirect(base_url('service_tag/edit_service_type/' . $id . '?error=' . $error));
			}
		}
	}

}