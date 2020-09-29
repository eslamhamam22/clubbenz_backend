<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Dataprivacy extends REST_Controller {
	public $data;
	function __construct() {
		parent::__construct();
		ini_set("display_errors", 1);
		error_reporting(1);
		$this->load->model('Dataprivacy_model');

		$this->load->database();
		ini_set('display_errors', 1);
	}

	function data_privacy_get() {
		$arr['data_privacy'] = $this->Dataprivacy_model->data_privacy_manage();

		$this->response($arr, 200);
	}

}
