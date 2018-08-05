<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PengeluaranHarian extends MY_Controller {

	function __construct() {
		parent::__construct();

		// Load Model
		$this->load->model('AdminModelPengeluaranHarian');

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
		$data['title'] = 'Pengeluaran Karyawan';
		$this->load->model('AdminModelPengeluaranHarian');
		$data['karyawan'] = $this->AdminModelPengeluaranHarian->getKaryawan();
		$data['pengeluaran'] = $this->AdminModelPengeluaranHarian->getPengeluaranKaryawan();
		$this->render_admin('adminroot/PengeluaranHarian', $data);
		// var_dump($data['pengeluaran']);
	}

	public function insertPengeluaran()
	{
		$this->load->model('AdminModelPengeluaranHarian');
		$sukses = $this->AdminModelPengeluaranHarian->insertPengeluaranKaryawan();
		
        if (!$sukses) {
            flashMessage('success', 'Data pengeluaran berhasil ditambahkan');
            redirect('adminroot/PengeluaranBulanan/');
        } else {
            flashMessage('error', 'Data pengeluaran gagal ditambahkan! Silahkan coba lagi');
            redirect('adminroot/PengeluaranBulanan/');
        }

        redirect('adminroot/PengeluaranHarian/');
	}

	public function editPengeluaran() {
		$this->load->model('AdminModelPengeluaranHarian');
		$data['kar'] = $this->AdminModelPengeluaranHarian->getKaryawan();
		$data['editpengeluaran'] = $this->AdminModelPengeluaranHarian->editPengeluaran();
		echo json_encode($data);
	}

	public function saveUpdate(){
		$this->load->model('AdminModelPengeluaranHarian');
		$sukses = $this->AdminModelPengeluaranHarian->updatePengeluaran();
		
        if (!$sukses) {
            flashMessage('success', 'Data pengeluaran berhasil diubah');
            redirect('adminroot/PengeluaranBulanan/');
        } else {
            flashMessage('error', 'Data pengeluaran gagal diubah! Silahkan coba lagi');
            redirect('adminroot/PengeluaranBulanan/');
        }

        redirect('adminroot/PengeluaranHarian/');
	}

	public function deletePengeluaran($id){
		$this->load->model('AdminModelPengeluaranHarian');
		$sukses = $this->AdminModelPengeluaranHarian->deletePengeluaran($id);
		
        if (!$sukses) {
            flashMessage('success', 'Data pengeluaran berhasil dihapus');
            redirect('adminroot/PengeluaranBulanan/');
        } else {
            flashMessage('error', 'Data pengeluaran gagal dihapus! Silahkan coba lagi');
            redirect('adminroot/PengeluaranBulanan/');
        }

        redirect('adminroot/PengeluaranHarian/');
	}

	public function getDataGaji(){
		
		$data = $this->AdminModelPengeluaranHarian->getJumlahPengeluaranHarianGaji();
		$data['jumlah'] = $this->AdminModelPengeluaranHarian->getJumlahPengeluaranHarianGaji();
		
		
		$array = array(
    					"01"   => 0,
    					"02"    => 0,
    					"03"    => 0,
    					"04"    => 0,
    					"05"    => 0,
    					"06"    => 0,
    					"07"    => 0,
    					"08"    => 0,
    					"09"    => 0,
    					"10"    => 0,
    					"11"    => 0,
    					"12"    => 0,
    					"13"    => 0,
    					"14"    => 0,
    					"15"    => 0,
    					"16"    => 0,
    					"17"    => 0,
    					"18"    => 0,
    					"19"    => 0,
    					"20"    => 0,
    					"21"    => 0,
    					"22"    => 0,
    					"23"    => 0,
    					"24"    => 0,
    					"25"    => 0,
    					"26"    => 0,
    					"27"    => 0,
    					"28"    => 0,
    					"29"    => 0,
    					"30"    => 0,
    					"31"    => 0
						);
		

		foreach ($data['jumlah'] as $jml) {

			$rest = substr($jml->tgl_pengeluaran, -2);
			$array[$rest] = (int)$jml->pengeluaran;
			
		} 
		
		echo json_encode($array);
	}

	public function getDataAkomodasi(){
		
		$data = $this->AdminModelPengeluaranHarian->getJumlahPengeluaranHarianAkomodasi();
		$data['jumlah'] = $this->AdminModelPengeluaranHarian->getJumlahPengeluaranHarianAkomodasi();
		
		
		$array = array(
    					"01"   => 0,
    					"02"    => 0,
    					"03"    => 0,
    					"04"    => 0,
    					"05"    => 0,
    					"06"    => 0,
    					"07"    => 0,
    					"08"    => 0,
    					"09"    => 0,
    					"10"    => 0,
    					"11"    => 0,
    					"12"    => 0,
    					"13"    => 0,
    					"14"    => 0,
    					"15"    => 0,
    					"16"    => 0,
    					"17"    => 0,
    					"18"    => 0,
    					"19"    => 0,
    					"20"    => 0,
    					"21"    => 0,
    					"22"    => 0,
    					"23"    => 0,
    					"24"    => 0,
    					"25"    => 0,
    					"26"    => 0,
    					"27"    => 0,
    					"28"    => 0,
    					"29"    => 0,
    					"30"    => 0,
    					"31"    => 0
						);
		

		foreach ($data['jumlah'] as $jml) {

			$rest = substr($jml->tgl_pengeluaran, -2);
			$array[$rest] = (int)$jml->pengeluaran;
			
		} 
		
		echo json_encode($array);
	}

	public function getDataTransport(){

		$data = $this->AdminModelPengeluaranHarian->getJumlahPengeluaranHarianTransport();
		$data['jumlah'] = $this->AdminModelPengeluaranHarian->getJumlahPengeluaranHarianTransport();
		
		
		$array = array(
    					"01"   => 0,
    					"02"    => 0,
    					"03"    => 0,
    					"04"    => 0,
    					"05"    => 0,
    					"06"    => 0,
    					"07"    => 0,
    					"08"    => 0,
    					"09"    => 0,
    					"10"    => 0,
    					"11"    => 0,
    					"12"    => 0,
    					"13"    => 0,
    					"14"    => 0,
    					"15"    => 0,
    					"16"    => 0,
    					"17"    => 0,
    					"18"    => 0,
    					"19"    => 0,
    					"20"    => 0,
    					"21"    => 0,
    					"22"    => 0,
    					"23"    => 0,
    					"24"    => 0,
    					"25"    => 0,
    					"26"    => 0,
    					"27"    => 0,
    					"28"    => 0,
    					"29"    => 0,
    					"30"    => 0,
    					"31"    => 0
						);
		

		foreach ($data['jumlah'] as $jml) {

			$rest = substr($jml->tgl_pengeluaran, -2);
			$array[$rest] = (int)$jml->pengeluaran;
			
		} 
		
		echo json_encode($array);
	}

	public function getDataLainlain(){
		
		$data = $this->AdminModelPengeluaranHarian->getJumlahPengeluaranHarianLainlain();
		$data['jumlah'] = $this->AdminModelPengeluaranHarian->getJumlahPengeluaranHarianLainlain();
		
		
		$array = array(
    					"01"   => 0,
    					"02"    => 0,
    					"03"    => 0,
    					"04"    => 0,
    					"05"    => 0,
    					"06"    => 0,
    					"07"    => 0,
    					"08"    => 0,
    					"09"    => 0,
    					"10"    => 0,
    					"11"    => 0,
    					"12"    => 0,
    					"13"    => 0,
    					"14"    => 0,
    					"15"    => 0,
    					"16"    => 0,
    					"17"    => 0,
    					"18"    => 0,
    					"19"    => 0,
    					"20"    => 0,
    					"21"    => 0,
    					"22"    => 0,
    					"23"    => 0,
    					"24"    => 0,
    					"25"    => 0,
    					"26"    => 0,
    					"27"    => 0,
    					"28"    => 0,
    					"29"    => 0,
    					"30"    => 0,
    					"31"    => 0
						);
		

		foreach ($data['jumlah'] as $jml) {

			$rest = substr($jml->tgl_pengeluaran, -2);
			$array[$rest] = (int)$jml->pengeluaran;
			
		} 
		
		echo json_encode($array);
	}

}

/* End of file PengeluaranHarian.php */
/* Location: ./application/controllers/adminroot/PengeluaranHarian.php */