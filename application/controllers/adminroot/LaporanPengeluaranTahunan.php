<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LaporanPengeluaranTahunan extends MY_Controller {

	function __construct() {
		parent::__construct();

		// Load Model

		// Cek hak akses
		if ($this->session->userdata('username') == "") {
			flashMessage('warning', 'Anda belum masuk atau Sesi anda telah berakhir!');
			redirect('Login');
		} elseif ($this->session->userdata('level') == "2") {
			flashMessage('error', 'Anda tidak berhak mengakses halaman tersebut!');
			redirect('gudang/home');
		} elseif ($this->session->userdata('level') == "3") {
			flashMessage('error', 'Anda tidak berhak mengakses halaman tersebut!');
			redirect('penjualan/home');
		}
	}
	
	public function index()
	{
		$data['title'] = 'Laporan Pengeluaran Perbulan';
		$this->render_admin('adminroot/LaporanPengeluaranTahunan', $data);
	}

	public function getBulanPengeluaranTahunan()
	{
		
		$this->load->model('AdminModelPengeluaranBulanan');
		$data['pengeluaran'] = $this->AdminModelPengeluaranBulanan->detailPengeluaranPerTahun();
		
		echo json_encode($data);
	}



}