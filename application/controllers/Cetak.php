<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cetak extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('pdf');
		$this->load->model('M_pesanan');
	}

	function index(){
        $pdf = new FPDF('l','mm','A5');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);
        // mencetak string
        $pdf->Cell(190,7,'Laporan Pesanan',0,1,'C');
        $pdf->SetFont('Arial','B',12);
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,7,'',0,1);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(10,6,'Id',1,0);
        $pdf->Cell(30,6,'Tanggal',1,0);
        $pdf->Cell(20,6,'Jam',1,0);
        $pdf->Cell(30,6,'Lapangan',1,0);
        $pdf->Cell(20,6,'Nama',1,0);
        $pdf->Cell(20,6,'No. Telp',1,0);
        $pdf->Cell(24,6,'Metode Pembayaran',1,1);
        $pdf->SetFont('Arial','',10);
        $data = $this->M_pesanan->hasil();
        foreach ($data as $row){
            $pdf->Cell(10,6,$row->id_pesanan,1,0);
            $pdf->Cell(30,6,$row->tanggal,1,0);
            $pdf->Cell(20,6,$row->jam,1,0);
            $pdf->Cell(30,6,$row->lapangan,1,0);
            $pdf->Cell(20,6,$row->nama,1,0);
            $pdf->Cell(20,6,$row->no_telp,1,0);
            $pdf->Cell(24,6,$row->metodepembayaran,1,1);
        }
        $pdf->Output();
    }
}
