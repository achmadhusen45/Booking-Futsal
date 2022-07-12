<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesanan extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('M_pesanan');
		$this->load->library('session','pdf');
	}

	public function index()
	{
		$data = array(
			'read' => $this->M_pesanan->getRpesanan(), 
			);

		$this->load->view('pesanan',$data);
	}

	public function delete_pesanan($id){
		
		$this->M_pesanan->delete_pesanan($id);

		echo json_encode(array("status" => TRUE));
	}

	
}
		