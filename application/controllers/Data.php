<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends CI_Controller {

	public function __construct(){
	 		
	 	parent::__construct();
		$this->load->helper('url');
 		$this->load->model('M_data');
	 }

	public function index(){

		$data['books']=$this->m_data->get_all_books();
		$this->load->view('book_view',$data);
	}
	
	public function book_add(){
			
		$data = array(
				'book_isbn' => $this->input->post('book_isbn'),
				'book_title' => $this->input->post('book_title'),
				'book_author' => $this->input->post('book_author'),
				'book_category' => $this->input->post('book_category'),
		);
		$insert = $this->m_data->book_add($data);
		echo json_encode(array("status" => TRUE));
	}
		
	public function ajax_edit($id){
			
		$data = $this->m_data->get_by_id($id);
		echo json_encode($data);
	}

	public function book_update(){
		
		$data = array(
			'book_isbn' => $this->input->post('book_isbn'),
			'book_title' => $this->input->post('book_title'),
			'book_author' => $this->input->post('book_author'),
			'book_category' => $this->input->post('book_category'),
			);
		$this->m_data->book_update(array('id_pesanan' => $this->input->post('id_pesanan')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function book_delete($id){
		
		$this->m_data->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}
}