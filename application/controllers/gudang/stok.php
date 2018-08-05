<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stok extends MY_Controller {

	protected $getID;

	function __construct() {
		parent::__construct();

		$this->getID = "TSVN-".date("YmdHis");

		// Load Model
		$this->load->model('GudangStokBarang');

		// Cek Session
		if ($this->session->userdata('username') == "") {
			flashMessage('warning', 'Anda belum masuk atau Sesi anda telah berakhir!');
			redirect('Login');
		} elseif ($this->session->userdata('level') == "3") {
			flashMessage('error', 'Anda tidak berhak mengakses halaman tersebut');
			redirect('penjualan/home');
		}
		
	}

	public function index()
	{
		$data['title'] = 'Stok Barang';
		$data['stok'] = $this->GudangStokBarang->getStokBarang();
		$data['vendor'] = $this->GudangStokBarang->getVendor();

		$this->render_gudang('gudang/stok', $data);
	}

	public function detailStokBarang()
	{
		$id = $this->input->post('id');
		$data['detailBarang'] = $this->GudangStokBarang->detailBarang($id);

		echo json_encode($data);
	}

	public function tambahBarang()
	{
		// UPDATE STOK BARANG
		$idBarang = $this->input->post('idBarangPost');
		$stokLama = $this->input->post('stokLama');
		$jumlahBarang = $this->input->post('jumlahPost');

		$updateStok = $stokLama + $jumlahBarang;

		// TAMBAH KE TRANSAKSI VENDOR
		$hargaSatuan = $this->input->post('hargaSatuanPost');
		$totalHargaBeli = $hargaSatuan * $jumlahBarang;
 		
 		$data['id_transaksi_vendor'] = $this->getID;
 		$data['tgl_beli'] = date('Y-m-d');
 		$data['total_beli'] = $jumlahBarang;
 		$data['harga_satuan'] = $hargaSatuan;
 		$data['total_harga_beli'] = $totalHargaBeli;
 		$data['uang_keluar'] = $totalHargaBeli;
 		$data['uang_kembalian'] = 0;
 		$data['status_transaksi'] = 1;
 		$data['status_barang'] = 1;
 		$data['id_invoice'] = 0;
  		$data['id_vendor'] = $this->input->post('vendorPost');
 		$data['id_barang'] = $idBarang;
 		$data['reference_1'] = $this->session->userdata('kid');
 		$data['reference_2'] = 0;
 		
		$sukses = $this->GudangStokBarang->insertBarang($idBarang, $updateStok, $data);

		if (!$sukses) {
			flashMessage('success', 'Stok barang berhasil ditambahkan');
			redirect('gudang/Stok');
		} else {
			flashMessage('error', 'Stok barang gagal ditambahkan! Silahkan coba lagi');
			redirect('gudang/stok');
		}
	}

	public function riwayatTambahStokBarang()
	{
		$data['title'] = 'Riwayat Tambah Stok Barang';
		$data['riwayatTambah'] = $this->GudangStokBarang->riwayatTambahStok();
		//echo json_encode($data);
		$this->render_gudang('gudang/RiwayatTambahStok', $data);
	}

	public function detailRiwayatTambahStokBarang()
	{
		$id = $this->input->post('id');
		$data['detailRiwayatBarang'] = $this->GudangStokBarang->detailRiwayatTambahStok($id);

		echo json_encode($data);
	}

}

/* End of file home.php */
/* Location: ./application/controllers/gudang/home.php */