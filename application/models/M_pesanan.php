<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Pesanan extends CI_Model
{

	var $table = 'pesanan';

	public function __construct(){
		
		parent::__construct();
		$this->load->database();
	}


	public function getRpesanan()
	{
		return $this->db->get('pesanan')->result();
	}

	public function get_by_id($id){
		
		$this->db->from($this->table);
		$this->db->where('id_pesanan',$id);
		$query = $this->db->get();
		return $query->row();
	}

	public function delete_pesanan($id){
		
		$this->db->where('id_pesanan', $id);
		$this->db->delete($this->table);
	}

	public function input_pesanan($data){
		$this->db->insert('pesanan',$data);
		return true;
	}

	function hasil()
    {
    	$data['pesanan']= $this->db->query("SELECT * FROM pesanan");
    	return $data['pesanan']->result();
    }
}
