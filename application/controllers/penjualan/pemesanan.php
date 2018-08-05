<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemesanan extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('PenjualanPemesanan');

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
		$data['title'] = 'Pemesanan';
		$data['vendor']	= $this->PenjualanPemesanan->getVendor();
		$data['barang']	= $this->PenjualanPemesanan->getBarang();
		$this->render_penjualan('penjualan/pemesanan', $data);
	}

	public function tambahPemesanan()
	{
		$vendor = $this->input->post('vendor');
		$produk = $this->input->post('produk');
		$jumlah = $this->input->post('jumlahbarang');
		$tglbeli = $this->input->post('tgl_beli');
		$hargasatuan = $this->input->post('harga');

		$totalhargabeli = $hargasatuan * $jumlah;

		$vendor = array(
			'id_transaksi_vendor' => '3',
			'tgl_beli' => $tglbeli,
			'total_beli' => $jumlah,
			'harga_satuan' => $hargasatuan,
			'total_harga_beli' => $totalhargabeli,
			'uang_keluar' => '800000',
			'uang_kembalian' => '0',
			'status_transaksi' => '0',
			'id_vendor' => $vendor,
			'id_barang' => $produk,
			'reference_1' => '1'
		); 

		$sukses = $this->PenjualanPemesanan->insertPemesananKeVendor($vendor);

		if (!$sukses) {
			flashMessage('success', 'Pemesanan telah berhasil ditambahkan');
			redirect('penjualan/pemesanan', 'refresh');				
		} else {
			flashMessage('error', 'Pemesanan gagal ditambahkan');
			redirect('penjualan/pemesanan', 'refresh');
		}
		
	}

	public function historyPemesanan()
	{
		$data['title'] = 'Riwayat Pemesanan';
		$data['listpesanan'] = $this->PenjualanPemesanan->getPemesananKeVendor();
		$data['riwayatpesanan'] = $this->PenjualanPemesanan->getRiwayatPemesananKeVendor();

		$this->render_penjualan('penjualan/historyPemesanan', $data);
	}

	public function detailHistoryPemesananPending()
	{
		$id = $this->input->post('id');
		$data['detailpemesanan'] = $this->PenjualanPemesanan->getDetailRiwayatPemesananPendingKeVendor($id);

		echo json_encode($data);
	}

	public function detailHistoryPemesananSukses()
	{
		$id = $this->input->post('id');
		$data['detailpemesanan'] = $this->PenjualanPemesanan->getDetailRiwayatPemesananSuksesKeVendor($id);

		echo json_encode($data);
	}

}

/* End of file home.php */
/* Location: ./application/controllers/gudang/home.php */