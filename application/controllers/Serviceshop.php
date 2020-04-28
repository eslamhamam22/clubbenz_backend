<?php
class Serviceshop extends MY_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->library('upload');
		$this->load->helper(array('form', 'url'));
		$this->load->library(['ion_auth', 'form_validation']);
		$this->load->helper(['url', 'language']);
		$this->load->model('Service_tag_model','service_tag');
		$this->load->model('Serviceshop_model','serviceshop');
		
		
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
		$this->data['service'] = $this->serviceshop->service_manage();
		$this->data['rec']=$this->serviceshop->manage_service_shop();
		$this->load->view('manage_service_shop',$this->data);
	}
	public function add_service_shop(){
		
		if($this->input->post()){
			$search_tag=implode(',',$this->input->post('serch_tag'));
			$search_tag_ar=implode(',',$this->input->post('serch_tag_arabic'));
			$servicetag=!empty($this->input->post('service_tag')) ? implode(',',$this->input->post('service_tag')) : "";
	        $day_off= !empty($this->input->post('day_off')) ? implode(',',$this->input->post('day_off')) : "";			
		
			$service_english = ($this->input->post('service_english')!='') ? implode(',',$this->input->post('service_english')) : "";
			
			if($this->input->post('service_tag')){
				$getSelectService = $this->service_tag->getSelectService($this->input->post('service_tag'));
				$service_tag_string = '';
				foreach($getSelectService as $service){
					
					$service_tag_string =  	$service_tag_string . $service->keywords;
				}	
			}

			$rules = array(
				array(
					'field'   => 'ws_name',
					'label'   => 'Workshop Name',
					'rules'   => 'trim'
				),
				array(
					'field'   => 'arabic_name',
					'label'   => 'Arabic Name',
					'rules'   => 'trim'
				),
				array(
					'field'   => 'city',
					'label'   => 'City Name',
					'rules'   => 'trim|required'
				),
				array(
					'field'   => 'country',
					'label'   => 'Country Name',
					'rules'   => 'trim|required'
				),
				array(
					'field'   => 'opening_hour',
					'label'   => 'Opening Hour',
					'rules'   => 'trim|required'
				),
				array(
					'field'   => 'closing_hour',
					'label'   => 'Closing Hour',
					'rules'   => 'trim|required'
				),
				array(
					'field'   => 'location_lat',
					'label'   => 'Location Latitude',
					'rules'   => 'trim|required'
				),
				array(
					'field'   => 'phone',
					'label'   => 'Phone No',
					'rules'   => 'trim|required'
				),
				array(
					'field'   => 'address',
					'label'   => 'Address',
					'rules'   => 'trim|required'
				),
				// array(
				// 	'field'   => 'day_off',
				// 	'label'   => 'Day Off',
				// 	'rules'   => 'trim|required'
				// ),
				array(
					'field'   => 'service_english[]',
					'label'   => 'Service Type',
					'rules'   => 'trim|required'
				),
				array(
					'field'   => 'service_tag[]',
					'label'   => 'Service Tags',
					'rules'   => 'trim|required'
				)
			);
			
			$this->form_validation->set_rules($rules);		
			if ($this->form_validation->run()){	
				$dataInfo = array();
			    $files = $_FILES;
			    
			    $cpt = count($_FILES['image']['name']);
			    for($i=0; $i<$cpt; $i++){  

        			$fname=$_FILES['file_name']['name']= $files['image']['name'][$i];
				    $_FILES['file_name']['tmp_name']= $files['image']['tmp_name'][$i];
					$_FILES['file_name']['size'] = $_FILES['image']['size'][$i];
			        $config= array();
				    $config['upload_path'] ='./upload/';
				   	$config['file_name'] = time().$fname;
				    $config['allowed_types'] = 'gif|jpg|png|jpeg';
			        $this->upload->initialize($config);
					$this->upload->do_upload('file_name');
			        $dataInfo[] = $this->upload->data();
			    }
				$title = $this->input->post('ws_name') ;
				$arabicTitle = $this->input->post('arabic_name');

				if($this->input->post('ws_name') == ""){
					$title = $arabicTitle ;
				}
				elseif($this->input->post('arabic_name') == ""){
					$arabicTitle = $title ;
				}


			//	date_default_timezone_set('Africa/Cairo');
				$opening_hour = strtotime($this->input->post('opening_hour'));
			//	date_default_timezone_get();
			//	date_default_timezone_set("UTC");
				$opening_hours = date("H:i", $opening_hour);


			//	date_default_timezone_set('Africa/Cairo');
				$closing_hour = strtotime($this->input->post('closing_hour'));
			//	date_default_timezone_get();
			//	date_default_timezone_set("UTC");
				$closing_hours = date("H:i", $closing_hour);

				$data = array(
			        'service_bg_image'		=>   $dataInfo[0]['file_name'],
			        'service_logo_image'	=>   $dataInfo[1]['file_name'],
			        'rating_image'			=>   $dataInfo[2]['file_name'],
			        'name'					=> $title,
			        'arabic_name'			=> $arabicTitle,
					'web_link'				=> $this->input->post('web'),
					'city' 					=> $this->input->post('city'),
					'country' 				=> $this->input->post('country'),
					'location_latitude'		=> $this->input->post('location_lat'),
					'location_longitude'	=> $this->input->post('location_lon'),
					'opening_hours'			=> $opening_hours,
					'closing_hours'			=> $closing_hours,
					'off_day'				=> $day_off,	
					'phone'					=> $this->input->post('phone'),
					'facebok_link'			=> $this->input->post('fb_link'),
					'address'				=> $this->input->post('address'),
					'serch_tag'				=> $search_tag,			
					'serch_tag_arabic'		=> $search_tag_ar,
					'service_type'			=> $service_english,
					'service_tag'			=> $servicetag,		
					'service_tag_string'					=> $service_tag_string,		
					'email'					=> $this->input->post('email'),
					"created_date"			=> date("Y-m-d"),
					'tweeter'				=> $this->input->post('twitter')

			     );
				$result=$this->serviceshop->add_service_shop($data);	
				if($result){
					redirect(base_url('serviceshop/?success=Add Service Shop successfully!'));		
				}
				else{
					redirect( base_url('serviceshop/add_service_shop?error=Some error!') );
				}
			}else{
				$error=validation_errors();

				$this->data['error'] = $error;
			}
		}
		$this->data['service'] = $this->serviceshop->service_manage();
		$this->data['service_tag'] = $this->service_tag->manage_serviceshop();
		$this->load->view('add_service_shop',$this->data);
	}
	public function serviceshop_del($id){
		$id=$this->serviceshop->serviceshop_del($id);
		if($id){
			redirect(base_url('serviceshop/?success=Service Shop Delete successfully!'));		
		}
		else{
				redirect( base_url('serviceshop/?error=Some error!') );
		}		
	}
	public function edit_service_shop($id){
		if($this->input->post()){
			$rules = array(
				array(
					'field'   => 'ws_name',
					'label'   => 'Workshop Name',
					'rules'   => 'trim'
				),
				array(
					'field'   => 'arabic_name',
					'label'   => 'Arabic Name',
					'rules'   => 'trim'
				),
				array(
					'field'   => 'city',
					'label'   => 'City Name',
					'rules'   => 'trim|required'
				),
				array(
					'field'   => 'country',
					'label'   => 'Country Name',
					'rules'   => 'trim|required'
				),
				array(
					'field'   => 'opening_hour',
					'label'   => 'Opening Hour',
					'rules'   => 'trim|required'
				),
				array(
					'field'   => 'closing_hour',
					'label'   => 'Closing Hour ',
					'rules'   => 'trim|required'
				),
				array(
					'field'   => 'location_lat',
					'label'   => 'Location Latitude',
					'rules'   => 'trim|required'
				),
				array(
					'field'   => 'phone',
					'label'   => 'Phone No',
					'rules'   => 'trim|required'
				),
				array(
					'field'   => 'address',
					'label'   => 'Address',
					'rules'   => 'trim|required'
				),
				// array(
				// 	'field'   => 'day_off',
				// 	'label'   => 'Day Off',
				// 	'rules'   => 'trim|required'
				// ),
				array(
					'field'   => 'service_english[]',
					'label'   => 'Service Type',
					'rules'   => 'trim|required'
				)
			);
			$this->form_validation->set_rules($rules);		
			if ($this->form_validation->run()){	
				$search_tag=implode(',',$this->input->post('serch_tag'));
				$search_tag_ar=implode(',',$this->input->post('serch_tag_arabic'));
				$servicetag=!empty($this->input->post('service_tag')) ? implode(',',$this->input->post('service_tag')) : "";
				$day_off= !empty($this->input->post('day_off')) ? implode(',',$this->input->post('day_off')) : "";			
			
				$service_tag_string = '';
				if($this->input->post('service_tag')){
					$getSelectService = $this->service_tag->getSelectService($this->input->post('service_tag'));
					$service_tag_string = '';
					foreach($getSelectService as $service){
						
						$service_tag_string =  	$service_tag_string . $service->keywords;
					}	
				}
				$dataInfo = array();
			    $files = $_FILES;
			    $service_english = ($this->input->post('service_english')!='') ? implode(',',$this->input->post('service_english')) : "";

				$title = $this->input->post('ws_name') ;
				$arabicTitle = $this->input->post('arabic_name');

				if($this->input->post('ws_name') == ""){
					$title = $arabicTitle ;
				}
				elseif($this->input->post('arabic_name') == ""){
					$arabicTitle = $title ;
				}

			//	date_default_timezone_set('Africa/Cairo');
				$opening_hour = strtotime($this->input->post('opening_hour'));
			//	date_default_timezone_get();
			//	date_default_timezone_set("UTC");
				$opening_hours = date("H:i", $opening_hour);


			//	date_default_timezone_set('Africa/Cairo');
				$closing_hour = strtotime($this->input->post('closing_hour'));
			//	date_default_timezone_get();
			//	date_default_timezone_set("UTC");
				$closing_hours = date("H:i", $closing_hour);

			    $data = array(
			        'name' 					=> $title,
			        'arabic_name' 			=> $arabicTitle,
					'web_link' 				=> $this->input->post('web'),
					'city' 					=> $this->input->post('city'),
					'country' 				=> $this->input->post('country'),
					'location_latitude' 	=> $this->input->post('location_lat'),
					'location_longitude' 	=> $this->input->post('location_lon'),
					'opening_hours'			=> $opening_hours,
					'closing_hours'			=> $closing_hours,
					'off_day'				=> $day_off,	
					'phone'					=> $this->input->post('phone'),
					'facebok_link'			=> $this->input->post('fb_link'),
					'address'				=> $this->input->post('address'),
					'serch_tag'				=> $search_tag,			
					'serch_tag_arabic'		=> $search_tag_ar,
					'service_type'			=> $service_english,
					'service_tag'			=> $servicetag,
					'service_tag_string'	=> $service_tag_string,
					'email'					=> $this->input->post('email'),
					'tweeter'				=> $this->input->post('twitter')
			     );
			    
			    $cpt = count($_FILES['image']['name']);
			    for($i=0; $i<$cpt; $i++){  
			    	if(!empty($files['image']['name'][$i])){
	        			$fname=$_FILES['file_name']['name']= $files['image']['name'][$i];
					    $_FILES['file_name']['tmp_name']= $files['image']['tmp_name'][$i];
				        $config= array();
					    $config['upload_path'] ='./upload/';
					   	$config['file_name'] = time().$fname;
					    $config['allowed_types'] = 'gif|jpg|png|jpeg';
				        $this->upload->initialize($config);
						$this->upload->do_upload('file_name');
				        $upload_data = $this->upload->data();
				        if($i==0)
				        	$data['service_bg_image'] 				= $upload_data['file_name'];
				        else if($i==1)
				        	$data['service_logo_image'] 			= $upload_data['file_name'];
				       else if($i==2)
				       		$data['rating_image'] 				= $upload_data['file_name'];
				    }
			    }
				$this->serviceshop->update_service_shop($data,$id);
				redirect(base_url('serviceshop/?success=update Service Shop successfully!'));		
			}
			else{
				$error = validation_errors();
				$this->data['error'] = $error;
			}
		}
		$this->data['service_tag'] = $this->service_tag->manage_serviceshop();
		$this->data['rec']=$this->serviceshop->edit_service_shop($id);
		$this->data['service'] = $this->serviceshop->service_manage();		
		$this->load->view('edit_service_shop',$this->data);
	}


}	
