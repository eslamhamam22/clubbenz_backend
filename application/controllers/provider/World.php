<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Class Auth
 * @property Ion_auth|Ion_auth_model $ion_auth        The ION Auth spark
 * @property CI_Form_validation      $form_validation The form validation library
 */
class World extends CI_Controller {
	public $data = [];

	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->helper(['url', 'language']);
		$this->load->model('World_model');
	}

	/**
	 * Redirect if needed, otherwise display the user list
	 */

	public function states() {
		$id=$this->input->post('id');
		echo $this->World_model->get_states_by_country_as_options($id);
	}

}
