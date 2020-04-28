<?php
class Years_model extends CI_Model{

public function __construct(){
		parent::__construct();
	}

public function add_year($name,$data){		
		$this->db->select('*');
		$this->db->from('years');
		$this->db->where('name',$name);
		$r=$this->db->get();
		$q=$r->num_rows();
		if($q==0){
			$this->db->insert('years',$data);
			return $this->db->insert_id();
		}
		return false;
	}

	public function year_manage(){
		$this->db->select('*');
		$this->db->from('years');
		$this->db->order_by('sorting','asc');
		$q=$this->db->get();
		return $q->result();
	}
	public function year_del($id){
		$this->db->where('id', $id);
		$this->db->delete('years');
		return	$this->db->affected_rows();
	}
	public function year_update_value($name,$id){

		$this->db->where('id',$id);
		$this->db->update('years',$name);
		return	$this->db->affected_rows();
	}

	public function get_year_by_id($id){
		$this->db->select("name")
				 ->where('id',$id);
		return $this->db->get('years')->row()->name;
	}
}