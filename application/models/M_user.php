<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model
{

	var $table = 'member';

	public function __construct(){
		
		parent::__construct();
		$this->load->database();
	}

	public function get_all_books(){

		$this->db->from('member');
		$query=$this->db->get();
		return $query->result();
	}

	public function getRpesanan()
	{
		return $this->db->get('pesanan')->result();
	}

	public function get_by_id($id){
		
		$this->db->from($this->table);
		$this->db->where('id_member',$id);
		$query = $this->db->get();
		return $query->row();
	}

	public function book_add($data){
		
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function book_update($where, $data)
	{
		$this->db->where('id_member',$where);
		$this->db->update($this->table, $data);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id){
		
		$this->db->where('id_member', $id);
		$this->db->delete($this->table);
	}

	public function delete_pesanan($id){
		
		$this->db->where('id_pesanan', $id);
		$this->db->delete($this->table);
	}
}
