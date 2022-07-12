<?php 
 
class M_login extends CI_Model{	
	function cek_login($table,$where){		
		return $this->db->get_where($table,$where);
	}

	public function get_admin(){
		
		$this->db->from('admin');
		$this->db->where('id_admin',1);
		$query = $this->db->get();
		return $query->row();
	}	
}