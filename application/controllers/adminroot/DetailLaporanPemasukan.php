<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DetailLaporanPemasukan extends MY_Controller {

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
		$data['title'] = 'Filter Laporan Pendapatan';
		$this->render_admin('adminroot/DetailLaporanPemasukan', $data);
	}

	public function getDetailByBarangBetween(){
		$data['title'] = 'Detail Pendapatan';
		$data1 = $this->uri->segment(4);
		$data2 = $this->uri->segment(5);
		$data3 = $this->uri->segment(6);

		$startDate = date("Y-m-d", strtotime($data2));
		$endDate = date("Y-m-d", strtotime($data3));
		// echo "Ini Id ".$data1;
		// echo "Ini tanggal Awal ".$startDate;
		// echo "Ini tanggal Akhir ".$endDate;

		$this->load->model('AdminFilterDateLaporanPemasukan');
		$data['detailEndUser'] = $this->AdminFilterDateLaporanPemasukan->getFilterDetailPemasukanEndUser($data1, $startDate, $endDate);
		$data['detailReseller'] = $this->AdminFilterDateLaporanPemasukan->getFilterDetailPemasukanReseller($data1, $startDate, $endDate);
		$data['detailMerk'] = $this->AdminFilterDateLaporanPemasukan->getFilterDetailPemasukanMerk($data1, $startDate, $endDate);
		$this->render_admin('adminroot/FilterDetailLaporanPemasukan', $data);
	}


}