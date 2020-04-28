<?php

class Classes_model extends CI_Model{
	public function add_model($new_array){
		$this->db->insert('model',$new_array);
		return $this->db->insert_id();
	}
	public function model_manage(){
		$this->db->select('*');
		$this->db->from('model');
		$this->db->order_by('sorting','asc');
		$q=$this->db->get();
		return $q->result();
	}
	public function model_del($id){
		$this->db->where('id', $id);
		$this->db->delete('model');
	 	return $this->db->affected_rows();
	 			
	}
	public function model_update($id){
		$this->db->where('id', $id);
		$this->db->from('model');
		$q=$this->db->get();
		return $q->result();
	}
	public function model_update_value($new_array,$id){
		$this->db->where('id',$id);
		$this->db->update('model',$new_array);
		return $this->db->affected_rows();
	}
	public function get_model_name_by_id($id){
		$this->db->where('id',$id);
		$this->db->from('model');
		$q=$this->db->get();
		return $q->row(); 
	}
		





}	