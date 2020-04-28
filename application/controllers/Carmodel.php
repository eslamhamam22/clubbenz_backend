<?php
class Carmodel extends MY_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->library('upload');
		$this->load->helper(array('form', 'url'));
		$this->load->library(['ion_auth', 'form_validation']);
		$this->load->helper(['url', 'language']);
		$this->load->model('cars_model','cars');
		$this->load->model('Fuel_model','Fuel');
		$this->load->model('location_model','location');
		$this->load->model('service_tag_model','service_tag');
		$this->load->model('acl_model');
		$this->load->model('Users_model');
		$this->load->model('Service_tag_model');
		$this->load->library('session');
		$this->load->model('Part_photos_model','partphotos');	
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

	public function user_update_value(){
		if($this->input->post('id')){
			$rules = array(
				array(
					'field'   => 'email',
					'label'   => 'Email',
					'rules'   => 'trim|required'
				),
				array(
					'field'   => 'username',
					'label'   => 'Username',
					'rules'   => 'trim|required'
				),
				array(
					'field'   => 'fname',
					'label'   => 'Fname',
					'rules'   => 'trim|required'
				),
				array(
					'field'   => 'lname',
					'label'   => 'Lname',
					'rules'   => 'trim|required'
				)
			);
			
			$this->form_validation->set_rules($rules);		
			if ($this->form_validation->run()){			
				$id=$this->input->post('id');
				$name = array( 
					'username'=>$this->input->post('username'),
					'email'=>$this->input->post('email'),
					'first_name'=>$this->input->post('fname'),
					'last_name'=>$this->input->post('lname')
				);	
				$result=$this->cars->user_update_value($name,$id);
				if($result){
					redirect(base_url('carmodel/user_manage?success=Update successfully!'));
				}
				else{
					redirect( base_url('carmodel/user_manage?success=Update successfully!') );
				}
			}
			else{
				$error=validation_errors();
				redirect( base_url('carmodel/user_manage?error='.$error) );
			}		
		}
	}	
	public function change_password($id){
		
		$this->data['user'] = $this->cars->user_data($id);
		$this->load->view('change_password',$this->data);
	}
	public function update_user_password(){
		if($this->input->post()){
			
			$email= $this->input->post('email');
			$password =$this->input->post('password');
			
			$change = $this->ion_auth->reset_password($email,$password);
			
			if($change>0){
				redirect(base_url('permissions/user_manage?success=Update successfully!'));
			}
		}
	
	}
	
	
	
	

}
?>