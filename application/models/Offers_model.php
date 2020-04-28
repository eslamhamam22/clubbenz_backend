<?php

class Offers_model extends CI_Model{
	
	public function manage_offers($id,$type){

		$this->db->where('shop_id',$id);
		$this->db->where('type',$type);
		$this->db->from('offers');
		/*$this->db->order_by('sorting','asc');*/
		/*return $q->row();*/
		$q = $this->db->get();
		if($q->num_rows() > 0){
			$data= $q->result_array();
			
			return $data;

		}
	}

	public function add_offers($data){
		
		$this->db->insert('offers',$data);
		return $this->db->insert_id();
	}
	public function edit_offers($id){
		
		$this->db->where('id',$id);
		$this->db->from('offers');
		$q=$this->db->get();
		return $q->row(); 
	}

	
	public function del_offers($id){
		$this->db->where('id', $id);
		$this->db->delete('offers');
		return $this->db->affected_rows();
		

	}
	public function update_offers($data,$id){			
		$this->db->where('id',$id);
		$this->db->update('offers',$data);
		return $this->db->affected_rows();
		
		
	}




}