<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		if(!$this->ion_auth->logged_in()){		
			$this->session->set_flashdata( 'error', 'Session expired' );
			redirect('/', 'refresh');
		}

		$this->_check_role_permissions();
		
	}

	private function _check_role_permissions(){
		$this->load->model('Acl_model'); 
		$group_id = $this->ion_auth->get_users_groups()->result();
		$check_admin_permission = 0;
		foreach($group_id as $g ){
			if($g->name == 'admin' && $g->check_permission == 'off') $check_admin_permission++;
		}
		if($check_admin_permission == 0){//$group_id[0]->check_permission == "on"
			if (!$this->Acl_model->has_permission($this->router->fetch_class(), $this->router->fetch_method(),$group_id)){
				redirect('access_error', 'refresh'); 
			}
		}
		
	}
}
