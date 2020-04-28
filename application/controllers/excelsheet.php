<?php
class Excelsheet extends MY_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('upload');
        $this->load->helper(array('form', 'url'));
        $this->load->library(['ion_auth', 'form_validation']);
        $this->load->helper(['url', 'language']);
        $this->load->model('Car_model','car');

        $this->load->model('acl_model');
        $this->load->model('Users_model');

        $this->load->library('session');

        if (!$this->ion_auth->logged_in()){
            redirect('auth', 'refresh');
        }
        if ($this->input->get('error')) {
            $this->data['error'] = $this->input->get('error');
        }
        if ($this->input->get('success')) {
            $this->data['success'] = $this->input->get('success');
        }
    }
    public function index(){

        $this->load->view('excel_index');
    }




}