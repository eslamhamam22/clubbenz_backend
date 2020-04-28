<?php
class Brand_model extends CI_Model{
	
	public function manage_brand(){
		$this->db->select('*');
		$this->db->from('brands');
		$q=$this->db->get();
		return $q->result();
	}
	public function add_brand($new_array){
		$this->db->insert('brands',$new_array);
		return $this->db->insert_id();
	}
	public function brand_del($id){
		$this->db->where('id', $id);
		$this->db->delete('brands');
	 	return $this->db->affected_rows();
	 			
	}
	public function edit_brand($id){
		$this->db->where('id', $id);
		$this->db->from('brands');
		$q=$this->db->get();
		return $q->result();
	}
	public function update_brand($new_array,$id){
		$this->db->where('id',$id);
		$this->db->update('brands',$new_array);
		return $this->db->affected_rows();
	}

	public function get_bands_by_ids($ids){
		$ids_arr = explode(',',$ids);
		$this->db->where_in('id',$ids_arr);
		$this->db->select('*');
		$this->db->from('brands');
		$q=$this->db->get();
		return $q->result();
	}
}
?>