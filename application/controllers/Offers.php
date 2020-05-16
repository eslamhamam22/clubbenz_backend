<?php
class Offers extends MY_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->library('upload');
		$this->load->helper(array('form', 'url'));
		$this->load->library(['ion_auth', 'form_validation']);
		$this->load->helper(['url', 'language']);
		$this->load->model('cars_model', 'cars');
		$this->load->model('offers_model', 'offers');
		$this->load->model('acl_model');
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

	public function manage_offers($shop_id, $type) {
		$this->data['shop_id'] = $shop_id;
		$this->data['type'] = $type;
		$this->data['rec'] = $this->offers->manage_offers($shop_id, $type);
		$this->data['title'] = 'Manage Offers';
		$this->load->view('manage_offers', $this->data);
	}
	public function add_offers($shop_id, $type) {
		$this->data['shop_id'] = $shop_id;
		$this->data['type'] = $type;
		$this->data['title'] = 'Add Offers';
		$this->load->view('add_offers', $this->data);
	}
	public function insert_offers() {
		if ($this->input->post()) {
			$shop_id = $this->input->post('shop_id');
			$type = $this->input->post('type');
			$rules = array(
				array(
					'field' => 'offer_text',
					'label' => 'Offer Text',
					'rules' => 'trim|required',
				),
			);

			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				$file_name = $_FILES['image']['name'];
				$new_array = array(

					'shop_id' => $this->input->post('shop_id'),
					'offer_end' => $this->input->post('offer_end'),
					'offer_text' => $this->input->post('offer_text'),
					'offer_text_arabic' => $this->input->post('offer_text_arabic'),
					'link' => $this->input->post('link'),
					'type' => $this->input->post('type'),

				);

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
				$result = $this->offers->add_offers($new_array);

				if ($result) {
					redirect(base_url('offers/manage_offers/' . $shop_id . "/" . $type . '?success=Add  successfully!'));
				} else {
					redirect(base_url('offers/add_offers?error=Some error!'));
				}
			} else {
				$error = validation_errors();
				redirect(base_url('offers/add_offers?error=' . $error));
			}
		}
	}

	public function del_offers($id, $shop_id, $type) {
		$rs = $this->offers->del_offers($id);
		if ($rs) {
			redirect(base_url('offers/manage_offers/' . $shop_id . "/" . $type . '?success=Delet  successfully!'));
		} else {
			redirect(base_url('offers/manage_offers?error=Some error!'));
		}
	}
	public function edit_offers($id) {
		$data['rec'] = $this->offers->edit_offers($id);
		$this->data['title'] = 'Edit Offers';
		$this->load->view('edit_offers', $data);

	}
	public function update_offers() {

		if ($this->input->post()) {

			$offer_id = $this->input->post('offer_id');
			$type = $this->input->post('type');

			$shop_id = $this->input->post('shop_id');

			$rules = array(
				array(
					'field' => 'offer_text',
					'label' => 'Offer Text',
					'rules' => 'trim|required',
				),
			);

			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				$file_name = $_FILES['image']['name'];
				$new_array = array(
					'offer_end' => $this->input->post('offer_end'),
					'shop_id' => $this->input->post('shop_id'),
					'offer_text' => $this->input->post('offer_text'),
					'offer_text_arabic' => $this->input->post('offer_text_arabic'),
					'link' => $this->input->post('link'),
					'type' => $this->input->post('type'),

				);
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
				$val = $this->offers->update_offers($new_array, $offer_id);
				if ($val) {
					redirect(base_url('offers/manage_offers/' . $shop_id . "/" . $type . '?success=update  successfully!'));
				} else {
					redirect(base_url('offers/manage_offers/' . $shop_id . "/" . $type . '?success=update  successfully!'));
				}
			} else {
				$error = validation_errors();
				redirect(base_url('carmodel/edit_offers/' . $id . '?error=' . $error));
			}
		}

	}
}