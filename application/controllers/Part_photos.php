<?php
	ob_start();
	class  Part_photos extends MY_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->database();
			$this->load->library('upload');
			$this->load->helper(array('form', 'url'));
			$this->load->library(['ion_auth', 'form_validation']);
			$this->load->helper(['url', 'language']);
			$this->load->model('cars_model','cars');
			$this->load->model('offers_model','offers');
			$this->load->model('Part_photos_model','partphotos');
			$this->load->model('acl_model');
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
		
		public function manage_part_photos($part_id){
			$this->data['part_id'] = $part_id;
			$this->data['rec'] = $this->partphotos->manage_part_photos($part_id);
			$this->load->view('manage_part_photos',$this->data);
		}
		/*public function add_part_photos($shop_id,$type){
			$this->data['shop_id'] = $shop_id;
			$this->data['type'] = $type;
			$this->load->view('add_offers',$this->data);*/
		
		public function add_part_photos($part_id){


			if($this->input->post()){
			
				$file_name= $_FILES['image']['name'];
				$new_array =array(

					'part_id'			=>		$this->input->post('part_id'),
					
					'is_default'		=>		$this->input->post('is_default')
				);
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
						$new_array['photo_name'] = $data['file_name'];
					}
				}
					
				$result=$this->partphotos->add_part_photos($new_array);	
				if($result){
					redirect(base_url('Part_photos/manage_part_photos/'.$part_id.'?success=Add  successfully!'));		
				}
				else{
					redirect( base_url('Part_photos/add_part_photos?error=Some error!') );
				}
			}
			
			
			$this->data['part_id'] = $part_id;
			$this->load->view('add_part_image',$this->data);
		}
		
		public function del_part_photos($id,$part_id){
			$rs=$this->partphotos->del_part_photos($id);
			if($rs){
				redirect(base_url('Part/edit_part/'.$part_id.'?success=Delet  successfully!'));
			}
			else{
					redirect( base_url('Part/edit_part?error=Some error!') );
				}	
		}
		public function edit_part_photos($id){
			$this->data['rec']=$this->partphotos->edit_part_phtos($id);
			$this->load->view('edit_part_phtos',$this->data);
				
		}
		public function update_part_photos(){

				if($this->input->post()){

					$file_name= $_FILES['image']['name'];

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
							$photoName = $data['file_name'];
						}
					}
						$id=$this->input->post('id');
						$part_id=$this->input->post('part_id');


					$val=$this->partphotos->update_part_photos($photoName,$id);
					if($val){

						redirect(base_url('Part/edit_part/'.$part_id.'?success=update  successfully!'));
					}
					else{
						redirect( base_url('Part/edit_part/'.$part_id.'?success=update  successfully!') );
					}
				}	
					
			
			}	

			
	}
	?>	
