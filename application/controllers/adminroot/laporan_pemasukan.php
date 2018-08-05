<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_Pemasukan extends MY_Controller {

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
		$data['title'] = 'Laporan Pemasukan';
		$this->load->model('AdminLaporanPemasukan');
		$data['pemasukan'] = $this->AdminLaporanPemasukan->getTargetPendapatan();
		$data['pendapatan'] = $this->AdminLaporanPemasukan->getPendapatan();
		$this->render_admin('adminroot/laporan_pemasukan', $data);
	}

	public function filterPemasukan()
	{
		$data['title'] = 'Filter Laporan Pendapatan';

		$dateStart = $this->input->post('dateStart');
		$dateEnd = $this->input->post('dateEnd');
		$data['startDate'] = date("d-m-Y", strtotime($dateStart));
		$data['endDate'] = date("d-m-Y", strtotime($dateEnd));
		// $bulan = $this->input->post('bulan');
		// $tahun = $this->input->post('tahun');
		$this->load->model('AdminFilterDateLaporanPemasukan');
		$data['laporanTargetPendapatan'] = $this->AdminFilterDateLaporanPemasukan->getTargetPendapatanByDate($dateStart, $dateEnd);
		$data['pendapatan'] = $this->AdminFilterDateLaporanPemasukan->getPendapatanByDate($dateStart, $dateEnd);
		$this->render_admin('adminroot/FilterLaporanPemasukan', $data);
	}

	public function getDetailByBarang($id){
		$data['title'] = 'Detail Pendapatan';

		$this->load->model('AdminLaporanPemasukan');
		$data['detailEndUser'] = $this->AdminLaporanPemasukan->getDetailPemasukanEndUser($id);
		$data['detailReseller'] = $this->AdminLaporanPemasukan->getDetailPemasukanReseller($id);
		$data['detailMerk'] = $this->AdminLaporanPemasukan->getDetailPemasukanMerk($id);
		$this->render_admin('adminroot/DetailLaporanPemasukan', $data);
	}

	

}