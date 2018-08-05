<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengelolaan_Reseller extends MY_Controller {

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
		$data['title'] = 'Pengelolaan Reseller';
		$this->load->model('AdminModelReseller');
		$data['listreseller'] = $this->AdminModelReseller->getReseller();
		$this->render_admin('adminroot/pengelolaan_reseller', $data);

	}

	public function findOneReseller(){
		$this->load->model('AdminModelReseller');
		$data['reseller'] = $this->AdminModelReseller->findOne();
		echo json_encode($data);
	}

	public function saveUpdteReseller(){
		$this->load->model('AdminModelReseller');
		$sukses = $this->AdminModelReseller->updateReseller();
		
		if (!$sukses) {
			flashMessage('success', 'Data reseller berhasil diubah.');
			redirect('adminroot/pengelolaan_reseller');
		} else {
			flashMessage('error', 'Data reseller gagal diubah! Silahkan coba lagi');
			redirect('adminroot/pengelolaan_reseller');
		}
		
	}

	public function insertReseller(){
		$this->load->model('AdminModelReseller');
		$sukses = $this->AdminModelReseller->insertReseller();
		
		if (!$sukses) {
			flashMessage('success', 'Data reseller berhasil ditambahkan.');
			redirect('adminroot/pengelolaan_reseller');
		} else {
			flashMessage('error', 'Data reseller gagal ditambahkan! Silahkan coba lagi');
			redirect('adminroot/pengelolaan_reseller');
		}
		
	}

	public function deleteReseller($id){
		$this->load->model('AdminModelReseller');
		$sukses = $this->AdminModelReseller->deleteReseller($id);
		
		if (!$sukses) {
			flashMessage('success', 'Data reseller berhasil dihapus.');
			redirect('adminroot/pengelolaan_reseller');
		} else {
			flashMessage('error', 'Data reseller gagal dihapus! Silahkan coba lagi');
			redirect('adminroot/pengelolaan_reseller');
		}
		
	}

}