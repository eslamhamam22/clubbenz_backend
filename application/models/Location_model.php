<?php

class Location_model extends CI_Model{

	public function manage_location(){
		$this->db->select('*');
		$this->db->from('location_zone');
		$this->db->order_by('sorting','asc');
		$q = $this->db->get();
		return $q->result();
	}
	
	public function add_location($data){
		$this->db->insert('location_zone',$data);
		return $this->db->insert_id();
	}
	public function edit_location($id){
		
		$this->db->where('id',$id);
		$this->db->from('location_zone');
		$q=$this->db->get();
		return $q->row(); 
	}
	public function update_location($data,$id){			
		$this->db->where('id',$id);
		$this->db->update('location_zone',$data);
		return $this->db->affected_rows();
		
		
	}
	
	public function del_location($id){
		$this->db->where('id', $id);
		$this->db->delete('location_zone');
		return $this->db->affected_rows();
		

	}
	
}	

