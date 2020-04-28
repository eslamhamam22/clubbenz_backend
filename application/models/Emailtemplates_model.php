<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
class Emailtemplates_model extends CI_Model {
	
	var $_tableName = "emailtemplates";
	var $_options = "";
	
	function __construct() {
		parent::__construct();
	}
	
	/* save row... */
	function saveRow($data) {
		$this->db->insert($this->_tableName, $data);

		return $this->db->insert_id();
	}
	function saveNotificationEmail($data) {
		$this->db->where('id', '1');
		return $this->db->update('notifications_email', $data);
	}
	function saveRowCustom($data,$tableName) {
		$this->db->insert($tableName, $data);
		return $this->db->insert_id();
	}
	
	/* update row... */
	function updateRow($data, $id) {
		$this->db->where('id', $id);
		return $this->db->update($this->_tableName, $data);
	}
	
	/* delete row... */
	function deleteRow($id) {
		$this->db->where('id', $id);
		$this->db->delete($this->_tableName);
		return 1;
	}
	
	/* get all rows count... */
	function getAllRowsCount() {
		$this->db->select('id');
		$query = $this->db->get($this->_tableName);
		
		return $query->num_rows();
	}
	
	/* get all rows... */
	function getAllRows($limit = NULL, $offset = NULL) {
		$this->db->select('*');
		$this->db->from($this->_tableName);
		if ($limit) {
			$this->db->limit($limit, $offset);
		}
		$query = $this->db->get();
		$data = $query->result();
		
		return $data;
	}
	
	/* get single row... */
	function getSingleRow($id) {
		$this->db->where('id', $id);
		$query = $this->db->get($this->_tableName);
		$data = $query->row();
		
		return $data;
	}
	
	/* get single row with all details... */
	function getSingleRowDetails($id) {
		$this->db->where('id', $id);
		$query = $this->db->get($this->_tableName);
		$data = $query->result_array();
		return $data[0];
	}
	
	function getSingleRowDetailsByName($name){
		$this->db->where('name', $name);
		$query = $this->db->get($this->_tableName);
		$data = $query->row();
		
		return $data;
	}
	
	/* get all active rows... */
	function getAllActiveRows($limit=NULL, $orderBy='ordering') {
		$this->db->where("published", 1);
		$this->db->order_by($orderBy, 'ASC');
		$this->db->limit($limit, 0);
		$query = $this->db->get($this->_tableName);
		$data = $query->result();
		
		return $data;
	}

	function getNotificationEmail() {
		$this->db->limit(1);
		$this->db->where('id', '1');
		$query = $this->db->get('notifications_email');
		return $query->row();
	}

	
	function sendMail($template_name,$arr,$attachment=''){
		
		$row         = $this->getSingleRowDetailsByName($template_name);
		$from_name   = $row->from_name;
		$from_email  = $row->from_email;
		$subject     = $row->subject;
		
		/*$config['protocol'] = 'sendmail';
		$config['mailpath'] = '/usr/sbin/sendmail';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;
		$config['mailtype'] = 'html';*/
		$this->load->library('email');
		

		foreach($arr as $key=>$val){
			if(preg_match("/\[(".$key.")]/",$from_name,$m)){
			//if(!strpos($subject,'['.$key.']')===false){
				$from_name=str_replace('['.$key.']',$val,$from_name);
			}
		}
		foreach($arr as $key=>$val){
			if(preg_match("/\[(".$key.")]/",$from_email,$m)){
			//if(!strpos($subject,'['.$key.']')===false){
				$from_email=str_replace('['.$key.']',$val,$from_email);
			}
		}
		
		foreach($arr as $key=>$val){
			if(preg_match("/\[(".$key.")]/",$subject,$m)){
			//if(!strpos($subject,'['.$key.']')===false){
				$subject=str_replace('['.$key.']',$val,$subject);
			}
		}
		
		
		$message=$row->message;
		foreach($arr as $key=>$val){
			if(preg_match("/\[(".$key.")]/",$message,$m)){
				$message=str_replace('['.$key.']',$val,$message);
			}
		}
		
		$header="From: $from_name <$from_email>\r\n";
		$header.="Content-type:text/html";
		
		if($_SERVER['HTTP_HOST']=='localhost'){
			$ok=true;
		}else{		
			/*$this->email->to($arr['email']);
			$this->email->from($from_email, $from_name);
			$this->email->subject($subject);
			$this->email->message($message);
			$this->email->reply_to($from_email, $from_name);
			$this->email->set_mailtype("html");
			if($attachment!=''){
				$this->email->attach($attachment);
			}
			$result = $this->email->send();*/
							/*$this->load->library('email');

				$this->email->initialize(array(
				  'protocol' => 'smtp',
				  'smtp_host' => 'smtp.sendgrid.net',
				  'smtp_user' => 'link_atif',
				  'smtp_pass' => 'atif$$786',
				  'smtp_port' => 587,
				  'crlf' => "\r\n",
				  'newline' => "\r\n"
				));
				
				$this->email->from($from_email, $from_name);
				$this->email->to($arr['email']);
				$this->email->subject($subject);
				$this->email->message($message);
				$this->email->send();*/
				
				/*$sendgrid_user = "upmart";
				$sendgrid_pass = "atif$$786";
				
				$url = 'https://api.sendgrid.com/';
				$user = $sendgrid_user;
				$pass = $sendgrid_pass;
	
				$json_string = array(
  					'to' => array(
    				$arr['email']
  					)
				);


				$params = array(
					'api_user'  => $user,
					'api_key'   => $pass,
					'x-smtpapi' => json_encode($json_string),
					'to'        => $arr['email'],
					'subject'   => $subject,
					'html'      => $message,
					'text'      => $message,
					'from'      => $from_email,
				  );
				
				
				$request =  $url.'api/mail.send.json';
				
				// Generate curl request
				$session = curl_init($request);
				// Tell curl to use HTTP POST
				curl_setopt ($session, CURLOPT_POST, true);
				// Tell curl that this is the body of the POST
				curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
				// Tell curl not to return headers, but do return the response
				curl_setopt($session, CURLOPT_HEADER, false);
				// Tell PHP not to use SSLv3 (instead opting for TLS)
				curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
				curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
				
				// obtain response
				$response = curl_exec($session);
				curl_close($session);
			//echo $this->email->print_debugger();
			//print_r($result);*/
			$ok=mail($arr['email'],$subject,$message,$header);
			$result = 1;
		}
		//$ok=1;
		if($result=='1'){
			$data = array(
				"name" 		=> $template_name ,
				"from_name" => $from_name ,
				"from_email"=> $from_email ,
				"email_to" 	=> $arr['email'],
				"subject" 	=> $subject ,
				"message" 	=> stripslashes($message),
				"date" 		=> date("Y-m-d H:i:s")
			);
			$this->saveRowCustom($data,'emaillogs');
			return true;
		}
		else{
			return false;
		}
	}
}
?>