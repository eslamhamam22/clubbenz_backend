<?php

	class Partgroup_model extends CI_Model{
		public function manage_part_group(){
		$this->db->select('*');
		$this->db->from('part_group');
		$q=$this->db->get();
		return $q->result();
	}
	public function add_part_group($new_array){
		$this->db->insert('part_group',$new_array);
		return $this->db->insert_id();
	}
	public function part_group_del($id){
		$this->db->where('id', $id);
		$this->db->delete('part_group');
	 	return $this->db->affected_rows();
	 			
	}
	public function edit_part_group($id){
		$this->db->where('id', $id);
		$this->db->from('part_group');
		$q=$this->db->get();
		return $q->result();
	}
	public function update_part_group($new_array,$id){
		$this->db->where('id',$id);
		$this->db->update('part_group',$new_array);
		return $this->db->affected_rows();
	}


	}
?>	