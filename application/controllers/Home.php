<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('M_pesan');
		$this->load->model('M_login');
		$this->load->model('M_pesanan');
		// var_dump($this->session->userdata('email');
		// die();
	}

	public function index()
	{
		$data = array(
			'read' => $this->M_pesan->getRpesanan(), 
			);

		$this->load->view('home',$data);
	}

	public function aksi_tambah()
	{
		$data = array(
				'tanggal' => $this->input->post('tanggal'),
				'jam' => $this->input->post('jam'),
				'lapangan' => $this->input->post('lapangan'),
				'metodepembayaran' => $this->input->post('metodepembayaran'),
		);
		$insert = $this->M_pesan->input_pesan($data);
		echo json_encode(array("status" => TRUE));
	}

	public function pesan($id) {
	
		$pesan = $this->M_pesan->get_by_id($id);
		$user= $this->M_login->get_admin();

		$data = [
			'tanggal' => $pesan->tanggal,
			'jam' => $pesan->jam,
			'lapangan' => $pesan->lapangan,
			'nama' => $user->email,
			'no_telp' => '',
			'metodepembayaran' => $pesan->metodepembayaran
		];

		$this->M_pesanan->input_pesanan($data);

		$this->M_pesan->delete_by_id($pesan->id_pesan);
		
		echo json_encode(array("status" => TRUE));
	}
}
