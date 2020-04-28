<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Import Model
 *
 * @author Coders Mag Team
 *
 * @email  info@techarise.com
 */

class Workshop_excel extends CI_Model {

	public function getservice_tagId($service_tag_name) {

		$this->db->select('*');
		$this->db->from('service_tag');
		$this->db->where('name', $service_tag_name);
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			$name = $q->row();
			return $name;
		}
	}

}
