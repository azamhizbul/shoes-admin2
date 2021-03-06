<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stok extends MY_Controller {

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
		$title['title'] = 'Stok Barang';
		$this->render_admin('adminroot/stok', $title);
	}

}

/* End of file home.php */
/* Location: ./application/controllers/gudang/home.php */