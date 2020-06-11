<?php
class Service_tag_model extends CI_Model{

	public function manage_partshop(){
		$this->db->select('*');
		$this->db->from('service_tag');
		$this->db->where('shop_type',"partshop");
		$this->db->order_by('sorting','asc');
		$q = $this->db->get();
		return $q->result();
	}
	
	function distance($lat1, $lon1, $lat2, $lon2, $unit) {
		if($lat1 && $lon1 && $lat2 && $lon2 && is_numeric($lat1) && is_numeric($lon1) && is_numeric($lat2) && is_numeric($lon2)){
			if (($lat1 == $lat2) && ($lon1 == $lon2)) {
				return 0;
			}
			else {
				$theta = $lon1 - $lon2;
				$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
				$dist = acos($dist);
				$dist = rad2deg($dist);
				$miles = $dist * 60 * 1.1515;
				$unit = strtoupper($unit);

				if ($unit == "K") {
					return ($miles * 1.609344);
				} else if ($unit == "N") {
					return ($miles * 0.8684);
				} else {
					return $miles;
				}
			}

		}
	}
		
	
	public function manage_serviceshop(){
		$this->db->select('*');
		$this->db->from('service_tag');
		$this->db->where('shop_type',"serviceshop");
		$this->db->order_by('sorting','asc');
		$q = $this->db->get();
		return $q->result();
	}
	public function manage_workshop(){
		$this->db->select('*');
		$this->db->from('service_tag');
		$this->db->where('shop_type',"workshop");
		$this->db->order_by('sorting','asc');
		$q = $this->db->get();
		return $q->result();
	}
	
	public function getSelectService($arrTID){

		// $this->db->where_in('TraineeID', $arrTID);

		$this->db->select('*');
		$this->db->from('service_tag');
		// $this->db->where('shop_type',"serviceshop");
	  $this->db->where_in('id', $arrTID);
		$this->db->order_by('sorting','asc');
		$q = $this->db->get();
		return $q->result();


	}
	public function add_service_tag($data){
		$this->db->insert('service_tag',$data);
		return $this->db->insert_id();
	}
	public function edit_service_tag($id){
		
		$this->db->where('id',$id);
		$this->db->from('service_tag');
		$q=$this->db->get();
		return $q->row(); 
	}
	public function update_service_tag($data,$id){			
		$this->db->where('id',$id);
		$this->db->update('service_tag',$data);
		return $this->db->affected_rows();
		
		
	}
	
	public function del_service_tag($id){
		$this->db->where('id', $id);
		$this->db->delete('service_tag');
		return $this->db->affected_rows();
	}

	function get_tags_names_by_ids($ids){
		$ids = explode(',',$ids);
		$this->db->where_in('id',$ids);
		$this->db->from('service_tag');
		$q=$this->db->get();
		$rows = $q->result(); 
		$names = "";
		foreach($rows as $r){
			$names = $r->name.", ";
		}
		return trim($names,', ');
	}
	public function get_service_tag_by_ids($ids){
		$ids_arr = explode(',',$ids);
		$this->db->where_in('id',$ids_arr);
		$this->db->select('*');
		$this->db->from('service_tag');
		$q=$this->db->get();
		return $q->result();
	}
}	
