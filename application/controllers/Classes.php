<?php
class Classes extends MY_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->library('upload');
		$this->load->helper(array('form', 'url'));
		$this->load->library(['ion_auth', 'form_validation']);
		$this->load->helper(['url', 'language']);
		$this->load->model('Classes_model','classes');
		
		
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
		$this->data['rec'] = $this->classes->model_manage();
		$this->load->view('model_manage',$this->data);
	}
	public function add_model(){
		if($this->input->post()){
			$rules = array(
				array(
					'field'   => 'model_name',
					'label'   => 'Modelname',
					'rules'   => 'trim|required'
				)
			);
			
			$this->form_validation->set_rules($rules);		
			if ($this->form_validation->run()){			
				$fname= $_FILES['image']['name'];

				$new_array['name'] = $this->input->post('model_name');
				$new_array['arabic_name'] = $this->input->post('model_name_arabic');
				$new_array['sorting'] = $this->input->post('sorting');
					
					
					/*$_FILES['file']['name'] 	= $_FILES['image']['name'];
	        		$_FILES['file']['type']     = $_FILES['image']['type'];
	                $_FILES['file']['tmp_name'] = $_FILES['image']['tmp_name'];
	                $_FILES['file']['error']     = $_FILES['image']['error'];
	                $_FILES['file']['size']     = $_FILES['image']['size'];*/
					$config['upload_path'] = './upload/';
					$config['file_name'] = time().$fname;
					$config['allowed_types']        = 'gif|jpg|png|jpeg';
					$this->upload->initialize($config);
					$this->upload->do_upload('image');
					$data = $this->upload->data();
					$new_array['image'] = $data['file_name'];
/*
					$this->upload->initialize($config);
					if(!$this->upload->do_upload('file')){
						echo ($this->upload->display_errors());	
					}
					else{
						$data = $this->upload->data();
						$new_array['image'] = $data['file_name'];
					}*/
				
				$result=$this->classes->add_model($new_array);	
				if($result){
					redirect(base_url('classes/?success=Add Model successfully!'));		
				}
				else{
					redirect(base_url('classes/?error=Some error!') );
				}
			}else{
				$error=validation_errors();
				redirect( base_url('classes/?error='.$error) );
			}
		}
		$this->load->view('add_model');
	}
	
	public function model_del($id){
		$id=$this->classes->model_del($id);
		if($id){
			redirect(base_url('classes/?success=Model Delete successfully!'));		
		}
		else{
				redirect( base_url('classes/?error=Some error!') );
			}	
	}
	public function model_update($id){
		$data['rec']=$this->classes->model_update($id);
		$this->load->view('model_update',$data);
	}
	public function model_update_value(){
		
		$id=$this->input->post('id');
		if($this->input->post()){
			$rules = array(
				array(
					'field'   => 'model_name',
					'label'   => 'Model',
					'rules'   => 'trim|required'
				)
			);
			
			$this->form_validation->set_rules($rules);		
			if ($this->form_validation->run()){	
				$file_name= $_FILES['image']['name'];
				$new_array['name'] = $this->input->post('model_name');
				$new_array['arabic_name'] = $this->input->post('model_name_arabic');
				$new_array['sorting'] = $this->input->post('sorting');
				if($file_name!=''){
					$config['upload_path'] = './upload/';
					$config['file_name'] = time().$file_name;
					$config['allowed_types']        = 'gif|jpg|png|jpeg';
					$this->upload->initialize($config);
					if(!$this->upload->do_upload('image')){
						echo ($this->upload->display_errors());	
					}
					else{
						$data = $this->upload->data();
						$new_array['image'] = $data['file_name'];
					}
				}
				$val=$this->classes->model_update_value($new_array,$id);	
				if($val){
					redirect(base_url('classes/?success=Update successfully!'));		
				}
				else{
					redirect( base_url('classes/?success= Update successfully!') );
				}
			}else{
				$error=validation_errors();
				redirect( base_url('classes/?error='.$error) );
			}		
		}
	}	



}	
	