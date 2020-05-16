<?php
ob_start();
class Shippinglist extends MY_Controller {

	public function __construct() {
		ini_set('display_errors', 1);
		error_reporting(1);
		parent::__construct();
		$this->load->model('shipping_model');
		$this->load->model('provider_model');
		$this->load->library('session');
		$this->load->library('upload');
		$this->load->library(['ion_auth', 'form_validation']);

		if ($this->input->get('error')) {
			$this->data['error'] = $this->input->get('error');
		}
		if ($this->input->get('success')) {
			$this->data['success'] = $this->input->get('success');
		}
	}
	public function index() {
		$this->data['rec'] = $this->shipping_model->select_shipping();
		$this->data['providers'] = $this->provider_model->select_provider();
		$this->data['title'] = 'Manage Shipping Request';
		$this->load->view('shipping', $this->data);
	}

	public function edit_shippinglist($id) {
		$data['rec'] = $this->shipping_model->edit_shippinglist($id);
		$data['providers'] = $this->provider_model->select_provider();
		$data['title'] = 'Edit Shipping Request';
		$this->load->view('edit_shippinglist', $data);
	}

	public function shippinglist_del($id) {
		$id = $this->shipping_model->shipping_del($id);
		if ($id) {
			redirect(base_url('shippinglist/?success= Delete successfully!'));
		} else {
			redirect(base_url('shippinglist/?error=Some error!'));
		}
	}

	public function update_shippinglist() {

		$id = $this->input->post('id');
		if ($this->input->post()) {
			$rules = array(
				array(
					'field' => 'status',
					'label' => 'status',
					'rules' => 'trim|required',
				),
			);

			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				$new_array['price'] = $this->input->post('price');
				$new_array['message'] = $this->input->post('message');
				$new_array['status'] = $this->input->post('status');

				$val = $this->shipping_model->update_shippinglist($new_array, $id);
				if ($val) {
					redirect(base_url('shippinglist/?success=Update  successfully!'));
				} else {
					redirect(base_url('shippinglist/?success=Update  successfully!'));
				}
			} else {
				$error = validation_errors();
				redirect(base_url('shippinglist/edit_shippinglist/' . $id . '?error=' . $error));
			}
		}
	}

}
?>