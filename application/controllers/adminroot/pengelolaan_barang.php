<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengelolaan_Barang extends MY_Controller {

	protected $getID;

	function __construct() {
		parent::__construct();
		
		$this->getID = "TSVN-".date('YmdHis');

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
	
	// Barang Pribadi
	public function index()
	{
		$data['title'] = 'Pengelolaan Barang';

		$this->load->model('AdminModelBarang');
		$data['listbarang'] = $this->AdminModelBarang->getBarang();
		$data['vendor'] = $this->AdminModelBarang->getVendor();

		$this->render_admin('adminroot/pengelolaan_barang', $data);
	}

	public function insertBarang(){
		$this->load->model('AdminModelBarang');
		$sukses = $this->AdminModelBarang->insertBarang();
		

		if (!$sukses) {
			flashMessage('success', 'Data barang berhasil ditambahkan.');
			redirect('adminroot/Pengelolaan_Barang/');
		} else {
			flashMessage('error', 'Data barang gagal ditambahkan! Silahkan coba lagi');
			redirect('adminroot/Pengelolaan_Barang/');
		}
		
	}

	public function editBarang() {
		$this->load->model('AdminModelBarang');
		$data['editbarang'] = $this->AdminModelBarang->editBarang();
		$data['editbarang'][0]->harga = strrev(implode('.',str_split(strrev(strval($data['editbarang'][0]->harga)),3)));
		$data['editbarang'][0]->harga_reseller = strrev(implode('.',str_split(strrev(strval($data['editbarang'][0]->harga_reseller)),3)));
		$data['editbarang'][0]->harga_end_user = strrev(implode('.',str_split(strrev(strval($data['editbarang'][0]->harga_end_user)),3)));
		$data['editbarang'][0]->harga_jual_vendor = strrev(implode('.',str_split(strrev(strval($data['editbarang'][0]->harga_jual_vendor)),3)));
		$data['editbarang'][0]->harga_packing = strrev(implode('.',str_split(strrev(strval($data['editbarang'][0]->harga_packing)),3)));
		
		
		echo json_encode($data);
	}

	public function saveUpdate(){
		$this->load->model('AdminModelBarang');
		$sukses = $this->AdminModelBarang->updateBarang();
		
		if (!$sukses) {
			flashMessage('success', 'Data barang berhasil diubah.');
			redirect('adminroot/Pengelolaan_Barang/');
		} else {
			flashMessage('error', 'Data barang gagal diubah! Silahkan coba lagi');
			redirect('adminroot/Pengelolaan_Barang/');
		}

	}

	public function deleteBarang($id) {
		$this->load->model('AdminModelBarang');
		$sukses = $this->AdminModelBarang->deleteBarang($id);

		if (!$sukses) {
			flashMessage('success', 'Data barang berhasil dihapus.');
			redirect('adminroot/Pengelolaan_Barang');
		} else {
			flashMessage('error', 'Data barang gagal dihapus! Silahkan coba lagi');
			redirect('adminroot/Pengelolaan_Barang');
		}

	}

	public function addStokBarang()
	{
		$this->load->model('AdminModelBarang');

		$id = $this->input->post('idBarangAdd');
		$stokLama = $this->input->post('stokLama');
		$jumlah = $this->input->post('jumlahAddStok');

		$updateStok = $stokLama + $jumlah;

		$hargaSatuan = $this->input->post('hargaSatuanAdd');
		$totalHargaBeli = $hargaSatuan * $jumlah;

		$data['id_transaksi_vendor'] = $this->getID;
		$data['tgl_beli'] = date('Y-m-d');
		$data['total_beli'] = $jumlah;
		$data['harga_satuan'] = $hargaSatuan;
		$data['total_harga_beli'] = $totalHargaBeli;
		$data['uang_keluar'] = $totalHargaBeli;
		$data['uang_kembalian'] = 0;
		$data['status_transaksi'] = 1;
		$data['status_barang'] = 1;
		$data['id_invoice'] = 0;
		$data['id_vendor'] = $this->input->post('vendorPost');
		$data['id_barang'] = $id;
		$data['reference_1'] = 0;
		$data['reference_2'] = $this->session->userdata('kid');

		$sukses = $this->AdminModelBarang->updateStok($id,$updateStok, $data);

		if (!$sukses) {
			flashMessage('success', 'Stok sepatu berhasil ditambahkan.');
			redirect('adminroot/Pengelolaan_barang');
		} else {
			flashMessage('error', 'Stok sepatu gagal ditambahkan! Silahkan coba lagi.');
			redirect('adminroot/Pengelolaan_barang');
		}

	}

	public function riwayatTambahStok() {
		$this->load->model('AdminModelBarang');

		$data['title'] = 'Riwayat Tambah Stok Barang Pribadi';
		$data['riwayatstokadmin'] = $this->AdminModelBarang->riwayatTambahStokPribadiAdmin();
		$data['riwayatstokgudang'] = $this->AdminModelBarang->riwayatTambahStokPribadiGudang();
		$this->render_admin('adminroot/RiwayatTambahStok', $data);
	}

	public function detailRiwayatTambahStokAdmin() {
		$this->load->model('AdminModelBarang');

		$id = $this->input->post('id');
		$data['detailadmin'] = $this->AdminModelBarang->detailRiwayatTambahStokPribadiAdmin($id);
		echo json_encode($data);
	}

	public function detailRiwayatTambahStokGudang() {
		$this->load->model('AdminModelBarang');

		$id = $this->input->post('id');
		$data['detailgudang'] = $this->AdminModelBarang->detailRiwayatTambahStokPribadiGudang($id);
		echo json_encode($data);
	}

	// Barang Titipan
	public function barangTitipan(){
		$data['title'] = 'Pengelolaan Barang Titipan';
		$this->load->model('AdminModelBarang');
		$data['listbarang'] = $this->AdminModelBarang->getBarangTitipan();
		$this->render_admin('adminroot/PengelolaanBarangTitipan', $data);
	}

	public function tambahBarangTitipan(){
		$this->load->model('AdminModelBarang');
		$sukses = $this->AdminModelBarang->insertBarangTitipan();
		
		if (!$sukses) {
			flashMessage('success', 'Data barang berhasil ditambahkan.');
			redirect('adminroot/Pengelolaan_Barang/barangTitipan');
		} else {
			flashMessage('error', 'Data barang gagal ditambahkan! Silahkan coba lagi');
			redirect('adminroot/Pengelolaan_Barang/barangTitipan');
		}
		
	}

	public function saveUpdateTitipan() {
		$this->load->model('AdminModelBarang');
		$sukses = $this->AdminModelBarang->updateBarangTitipan();
		
		if (!$sukses) {
			flashMessage('success', 'Data barang berhasil diubah.');
			redirect('adminroot/Pengelolaan_Barang/barangTitipan');
		} else {
			flashMessage('error', 'Data barang gagal diubah! Silahkan coba lagi');
			redirect('adminroot/Pengelolaan_Barang/barangTitipan');
		}

	}

	public function hapusBarangTitipan($id) {
		$this->load->model('AdminModelBarang');
		$sukses = $this->AdminModelBarang->deleteBarang($id);

		if (!$sukses) {
			flashMessage('success', 'Data barang berhasil dihapus.');
			redirect('adminroot/Pengelolaan_Barang/barangTitipan');
		} else {
			flashMessage('error', 'Data barang gagal dihapus! Silahkan coba lagi');
			redirect('adminroot/Pengelolaan_Barang/barangTitipan');
		}

	}

}