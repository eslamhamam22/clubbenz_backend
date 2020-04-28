<?php

class Part_photos_model extends CI_Model{
	public function select_photo($id){
		$this->db->where('part_id',$id);
		$this->db->where('is_default','yes');
		$this->db->from('part_photos');
		$q = $this->db->get();
		
		if($q->num_rows() > 0){
			$data= $q->row();
			return $data;
		}
		
	}
	public function manage_part_photos($id){
		$this->db->where('part_id',$id);
		$this->db->from('part_photos');
		$q = $this->db->get();
		$data = array();
		if($q->num_rows() > 0){
			$data= $q->result_array();
			return $data;
		}
		return $data;
	}
	public function add_part_photos($data){
		$this->db->insert('part_photos',$data);
		return $this->db->insert_id();
	}
	public function del_part_photos($id){
		$this->db->where('id', $id);
		$this->db->delete('part_photos');
		return	$this->db->affected_rows();
	}
	public function edit_part_photos($id){
		$this->db->where('id', $id);
		$this->db->from('part_photos');
		$q=$this->db->get();
		return $q->row();
	}
	
	
	public function update_part_photos($photo,$id){
		$this->db->set('photo_name',$photo);
		$this->db->where('id',$id);
	$this->db->update('part_photos');
		return	$this->db->affected_rows();
	}
	




}
