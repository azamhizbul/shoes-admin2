<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_Pengeluaran extends MY_Controller {

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
		$data['title'] = 'Laporan Pengeluaran';
		$this->load->model('AdminLaporanPengeluaran');
		$data['tahun'] = $this->AdminLaporanPengeluaran->getAllTahun();
		$this->render_admin('adminroot/laporan_pengeluaran', $data);
	}

	public function sendParam(){

		$data['title'] = 'Laporan Bulanan';

		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$this->load->model('AdminLaporanPengeluaran');
		$data['laporanPengeluaranPerBulan'] = $this->AdminLaporanPengeluaran->getLaporanPerBulan($bulan, $tahun);
		$this->render_admin('adminroot/LaporanPengeluaranBulanan', $data);
	}

	public function sendParamTahun(){
		
		$data['title'] = 'Laporan Tahunan';

		$tahun = $this->input->post('tahun');
		$this->load->model('AdminLaporanPengeluaran');
		$data['laporanPengeluaranPerTahun'] = $this->AdminLaporanPengeluaran->getLaporanPerTahun( $tahun);
		$this->render_admin('adminroot/LaporanPengeluaranTahunan', $data);
	}

	public function getPengeluaranPerTahun()
	{
		$this->load->model('AdminLaporanPengeluaran');
		$data = $this->AdminLaporanPengeluaran->getDataPengeluaranPerTahun();
		$data['jumlah'] = $this->AdminLaporanPengeluaran->getDataPengeluaranPerTahun();

		$array = array(
			"1"		=> 0,
			"2"		=> 0,
			"3"		=> 0,
			"4"		=> 0,
			"5"		=> 0,
			"6"		=> 0,
			"7"		=> 0,
			"8"		=> 0,
			"9"		=> 0,
			"10"	=> 0,
			"11"	=> 0,
			"12"	=> 0
		);

		foreach ($data['jumlah'] as $jml) {

			$rest = substr($jml->Bulan, -2);
			$array[$rest] = (int)$jml->Total;
			
		}

		echo json_encode($array);
	}

	public function printLaporanBulanan($bulan, $tahun)
	{
		$this->load->model('AdminLaporanPengeluaran');
		$data['laporanPengeluaranPerBulan'] = $this->AdminLaporanPengeluaran->cetakLaporanPerBulan($bulan, $tahun);

		//echo json_encode($data);

		$this->load->view('adminroot/CetakLaporanBulanan', $data);
		$html = $this->output->get_output();

		$filename = $data['laporanPengeluaranPerBulan'][0]->Bulan."-".$data['laporanPengeluaranPerBulan'][0]->Tahun;

		$this->dompdf->load_html($html);
		$this->dompdf->set_paper('A4', 'potrait');
		$this->dompdf->render();
		$this->dompdf->stream("Laporan Pengeluaran Bulan ".$filename.".pdf", array('Attachment' => 0));
	}

	public function printLaporanTahunan($tahun)
	{
		$this->load->model('AdminLaporanPengeluaran');
		$data['laporanPengeluaranPerTahun'] = $this->AdminLaporanPengeluaran->cetakLaporanPerTahun($tahun);

		//echo json_encode($data);

		$this->load->view('adminroot/CetakLaporanTahunan', $data);
		$html = $this->output->get_output();

		$filename = $data['laporanPengeluaranPerTahun'][0]->Tahun;

		$this->dompdf->load_html($html);
		$this->dompdf->set_paper('A4', 'potrait');
		$this->dompdf->render();
		$this->dompdf->stream("Laporan Pengeluaran Tahun ".$filename.".pdf", array('Attachment' => 0));
	}

}