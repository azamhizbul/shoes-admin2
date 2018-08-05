<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PengeluaranBulanan extends MY_Controller {

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
		$data['title'] = 'Pengeluaran Perusahaan';
		$this->load->model('AdminModelPengeluaranBulanan');
		$data['pengeluaran'] = $this->AdminModelPengeluaranBulanan->getPengeluaranKantor();
		
		 $this->render_admin('adminroot/PengeluaranBulanan', $data);
	}

	public function getDataAir(){
		$this->load->model('AdminModelPengeluaranBulanan');
		$data = $this->AdminModelPengeluaranBulanan->getJumlahPengeluaranBulanByAir();
		$data['jumlah'] = $this->AdminModelPengeluaranBulanan->getJumlahPengeluaranBulanByAir();
		
		
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

	public function getDataJumlah(){
		$this->load->model('AdminModelPengeluaranBulanan');
		$data = $this->AdminModelPengeluaranBulanan->getJumlahPengeluaranBulan();
		$data['jumlah'] = $this->AdminModelPengeluaranBulanan->getJumlahPengeluaranBulan();
		
		
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

	public function getDataListrik(){
		$this->load->model('AdminModelPengeluaranBulanan');
		$data = $this->AdminModelPengeluaranBulanan->getJumlahPengeluaranBulanByListrik();
		$data['jumlah'] = $this->AdminModelPengeluaranBulanan->getJumlahPengeluaranBulanByListrik();
		
		
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

	public function getDataInternet(){
		$this->load->model('AdminModelPengeluaranBulanan');
		$data = $this->AdminModelPengeluaranBulanan->getJumlahPengeluaranBulanByInternet();
		$data['jumlah'] = $this->AdminModelPengeluaranBulanan->getJumlahPengeluaranBulanByInternet();
		
		
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

	public function getDataSewa(){
		$this->load->model('AdminModelPengeluaranBulanan');
		$data = $this->AdminModelPengeluaranBulanan->getJumlahPengeluaranBulanBySewa();
		$data['jumlah'] = $this->AdminModelPengeluaranBulanan->getJumlahPengeluaranBulanBySewa();
		
		
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

	public function getDataATK(){
		$this->load->model('AdminModelPengeluaranBulanan');
		$data = $this->AdminModelPengeluaranBulanan->getJumlahPengeluaranBulanByATK();
		$data['jumlah'] = $this->AdminModelPengeluaranBulanan->getJumlahPengeluaranBulanByATK();
		
		
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

	public function getDataLainLain(){
		$this->load->model('AdminModelPengeluaranBulanan');
		$data = $this->AdminModelPengeluaranBulanan->getJumlahPengeluaranBulanByLainLain();
		$data['jumlah'] = $this->AdminModelPengeluaranBulanan->getJumlahPengeluaranBulanByLainLain();
		
		
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




	public function insertPengeluaran()
	{
		$this->load->model('AdminModelPengeluaranBulanan');
		$sukses = $this->AdminModelPengeluaranBulanan->insertPengeluaranKantor();

        if (!$sukses) {
            flashMessage('success', 'Data pengeluaran berhasil ditambahkan');
            redirect('adminroot/PengeluaranBulanan/');
        } else {
            flashMessage('error', 'Data pengeluaran gagal ditambahkan! Silahkan coba lagi');
            redirect('adminroot/PengeluaranBulanan/');
        }

	}

	public function editPengeluaran() {
		$this->load->model('AdminModelPengeluaranBulanan');
		$data['editpengeluaran'] = $this->AdminModelPengeluaranBulanan->editPengeluaran();
		echo json_encode($data);
	}

	public function saveUpdate(){
		$this->load->model('AdminModelPengeluaranBulanan');
		$sukses = $this->AdminModelPengeluaranBulanan->updatePengeluaran();

        if (!$sukses) {
            flashMessage('success', 'Data pengeluaran berhasil diubah');
            redirect('adminroot/PengeluaranBulanan/');
        } else {
            flashMessage('error', 'Data pengeluaran gagal diubah! Silahkan coba lagi');
            redirect('adminroot/PengeluaranBulanan/');
        }
		
	}

	public function deletePengeluaran($id){
		$this->load->model('AdminModelPengeluaranBulanan');
		$sukses = $this->AdminModelPengeluaranBulanan->deletePengeluaran($id);

        if (!$sukses) {
            flashMessage('success', 'Data pengeluaran berhasil dihapus');
            redirect('adminroot/PengeluaranBulanan/');
        } else {
            flashMessage('error', 'Data pengeluaran gagal dihapus! Silahkan coba lagi');
            redirect('adminroot/PengeluaranBulanan/');
        }
        
	}

}

/* End of file PengeluaranBulanan.php */
/* Location: ./application/controllers/adminroot/PengeluaranBulanan.php */