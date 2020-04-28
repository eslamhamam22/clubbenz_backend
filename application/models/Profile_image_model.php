<?php

	class Profile_image_model extends CI_Model{
		public function manage_pimage(){
		$this->db->select('*');
		$this->db->from('profile_image');
		$q=$this->db->get();
		return $q->result();
	}
	public function add_pimage($new_array){

		$this->db->insert('profile_image',$new_array);
		return $this->db->insert_id();
	}
	public function del_pimage($id){
		$this->db->where('id', $id);
		$this->db->delete('profile_image');
		return $this->db->affected_rows();
		

	}
	public function edit_pimage($id){
		$this->db->select('*');
		$this->db->where('id',$id);
		$this->db->from('profile_image');
		$q=$this->db->get();
		return $q->row();
	}
	public function update_pimage($data,$id){			
		$this->db->where('id',$id);
		$this->db->update('profile_image',$data);
		return $this->db->affected_rows();
	}

}
?>	