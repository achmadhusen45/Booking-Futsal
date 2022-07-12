<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Pesan extends CI_Model
{

	var $table = 'pesan';

	public function __construct(){
		
		parent::__construct();
		$this->load->database();
	}


	public function getRpesanan()
	{
		return $this->db->get('pesan')->result();
	}

	public function get_by_id($id){
		
		$this->db->from($this->table);
		$this->db->where('id_pesan',$id);
		$query = $this->db->get();
		return $query->row();
	}

	public function input_pesan($data)
	{
		$this->db->insert('pesan',$data);
		return true;
	}

	public function delete_by_id($id){
		
		$this->db->where('id_pesan', $id);
		$this->db->delete($this->table);
	}
}