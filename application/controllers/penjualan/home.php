<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('PenjualanModelHome');

		if ($this->session->userdata('username') == "") {
			flashMessage('warning', 'Anda belum masuk atau Sesi anda telah berakhir!');
			redirect('Login');
		} elseif ($this->session->userdata('level') == "2") {
			flashMessage('error', 'Anda tidak berhak mengakses halaman tersebut');
			redirect('gudang/home');
		}
	}

	public function index()
	{
		$data['title'] = 'Beranda Penjualan';
		$data['pemesanan'] = $this->PenjualanModelHome->getTotalPemesanan();
        $data['penjualan'] = $this->PenjualanModelHome->getTotalPenjualan();
		$data['retur'] = $this->PenjualanModelHome->getTotalRetur();
		$this->render_penjualan('penjualan/home', $data);
	}

	public function getDataJumlahPenjualanCustomer(){
		$data = $this->PenjualanModelHome->getJumlahPenjualanCustomer();
		$data['jumlah'] = $this->PenjualanModelHome->getJumlahPenjualanCustomer();
		
		$array = array(
    					"01"   	=> 0,
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
    					"31"   	=> 0
						);
		

		foreach ($data['jumlah'] as $jml) {

			$rest = substr($jml->tgl_jual, -2);
			$array[$rest] = (int)$jml->jual;
			
		} 
		
		echo json_encode($array);
	}

	public function getDataJumlahPenjualanReseller(){
		$data = $this->PenjualanModelHome->getJumlahPenjualanReseller();
		$data['jumlah'] = $this->PenjualanModelHome->getJumlahPenjualanReseller();
		
		$array = array(
    					"01"   	=> 0,
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
    					"31"   	=> 0
						);
		

		foreach ($data['jumlah'] as $jml) {

			$rest = substr($jml->tgl_jual, -2);
			$array[$rest] = (int)$jml->jual;
			
		} 
		
		echo json_encode($array);
	}

}

/* End of file home.php */
/* Location: ./application/controllers/penjualan/home.php */