<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct(){
	 		
	 	parent::__construct();
		$this->load->helper('url');
 		$this->load->model('M_user');
	 }

	public function index(){

		$data['books']=$this->M_user->get_all_books();
		$this->load->view('member',$data);
	}
	
	public function book_add(){
			
		$data = array(
				'nama' => $this->input->post('nama'),
				'jeniskel' => $this->input->post('jeniskel'),
				'alamat' => $this->input->post('alamat'),
				'no_telp' => $this->input->post('no_telp'),
		);
		$insert = $this->M_user->book_add($data);
		echo json_encode(array("status" => TRUE));
	}
		
	public function ajax_edit($id){
			
		$data = $this->M_user->get_by_id($id);
		echo json_encode($data);
	}

	public function book_update(){

		// echo $this->input->post('id_member');

		$data = array(
				'nama' => $this->input->post('nama'),
				'jeniskel' => $this->input->post('jeniskel'),
				'alamat' => $this->input->post('alamat'),
				'no_telp' => $this->input->post('no_telp')
			);
		// die();
		$this->M_user->book_update($this->input->post('id_member'), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function book_delete($id){
		
		$this->M_user->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}
}