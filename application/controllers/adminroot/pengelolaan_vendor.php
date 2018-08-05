<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengelolaan_Vendor extends MY_Controller {

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
		$data['title'] = 'Pengelolaan Vendor';
		$this->load->model('AdminModelVendor');
		$data['listvendor'] = $this->AdminModelVendor->getVendor();
		$this->render_admin('adminroot/pengelolaan_vendor', $data);
	}

	public function inserVendor(){
		$this->load->model('AdminModelVendor');
		$sukses = $this->AdminModelVendor->insertVendor();
		
		if (!$sukses) {
			flashMessage('success', 'Data vendor berhasil ditambahkan.');
			redirect('adminroot/pengelolaan_vendor');
		} else {
			flashMessage('error', 'Data vendor gagal ditambahkan! Silahkan coba lagi');
			redirect('adminroot/pengelolaan_vendor');
		}

	}

	public function findOneVendor(){
		$this->load->model('AdminModelVendor');
		$data['unk'] ="TS-".date("Ymdhis")."-".uniqid(); 
		$data['vendor'] = $this->AdminModelVendor->findOne();
		echo json_encode($data);
	}

	public function saveUpadteVendor(){
		$this->load->model('AdminModelVendor');
		$sukses = $this->AdminModelVendor->updateVendor();
		
		if (!$sukses) {
			flashMessage('success', 'Data vendor berhasil diubah.');
			redirect('adminroot/pengelolaan_vendor');
		} else {
			flashMessage('error', 'Data vendor gagal diubah! Silahkan coba lagi');
			redirect('adminroot/pengelolaan_vendor');
		}

	}

	public function deleteVendor($id){
		$this->load->model('AdminModelVendor');
		$sukses = $this->AdminModelVendor->deleteVendor($id);
		
		if (!$sukses) {
			flashMessage('success', 'Data vendor berhasil dihapus');
			redirect('adminroot/pengelolaan_vendor');
		} else {
			flashMessage('error', 'Data vendor gagal dihapus! Silahkan coba lagi');
			redirect('adminroot/pengelolaan_vendor');
		}

	}

}