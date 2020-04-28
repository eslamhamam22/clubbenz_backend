<?php

class Fuel_model extends CI_Model{
	
	public function add_fuel($name){
		$this->db->insert('fuel_type',$name);
		return $this->db->insert_id();
	}
	public function edit_fuel($id){
		
		$this->db->where('id',$id);
		$this->db->from('fuel_type');
		$q=$this->db->get();
		return $q->row(); 
	}


	public function fuel_manage(){
		$this->db->select('*');
		$this->db->from('fuel_type');
		$this->db->order_by('sorting','asc');
		$q = $this->db->get();
		return $q->result();
	}
	public function fuel_del($id){
		$this->db->where('id', $id);
		$this->db->delete('fuel_type');
		return $this->db->affected_rows();
		

	}
	public function fuel_update_value($name,$id){			
		$this->db->where('id',$id);
		$this->db->update('fuel_type',$name);
		return $this->db->affected_rows();
	}	
	public function get_fuel_name_by__id($id){
		$this->db->where('id',$id);
		$this->db->from('fuel_type');
		$q=$this->db->get();
		return $q->row(); 
	}

}