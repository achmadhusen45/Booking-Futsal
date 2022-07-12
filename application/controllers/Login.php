<?php 
 
class Login extends CI_Controller{
 
	function __construct(){
		parent::__construct();		
		$this->load->model('m_login');
 
	}
 
	function index(){
		$this->load->view('login');
	}
 
	function aksi_login(){
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$where = array(
			'email' => $email,
			'password' => md5($password)
			);
		$cek = $this->m_login->cek_login("admin",$where)->num_rows();
		if($cek > 0){
 
			$data_session = array(
				'email' => $email,
				'status' => "login",
				'logged_in' => TRUE
				);
 
			$this->session->set_userdata($email);
 
			redirect(base_url("home"));
 
		}else{
			echo "Email dan password salah !";
		}
	}
 
	function logout(){
		$this->session->sess_destroy();
		redirect(base_url('login'));
	}
}