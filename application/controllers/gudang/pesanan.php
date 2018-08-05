<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesanan extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('PenjualanPemesanan');
		$this->load->model('GudangPemesanan');
		$this->load->model('GudangReturBarang');

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
		$data['title'] = 'Pemesanan Barang';
		$data['listpemesanan'] = $this->GudangPemesanan->getPemesanan();
		$data['listpemesanansukses'] = $this->GudangPemesanan->getPemesananSukses();

		$this->render_gudang('gudang/pesanan', $data); // load view
	}

	public function detailRiwayatPemesananPending()
	{
		$id = $this->input->post('id');
		$data['detailpemesanan'] = $this->GudangPemesanan->getDetailPemesananById($id);

		echo json_encode($data);
	}

	public function detailRiwayatPemesananSukses()
	{
		$id = $this->input->post('id');
		$data['detailpemesanan'] = $this->GudangPemesanan->getDetailPemesananSuksesById($id);

		echo json_encode($data);
	}

	public function pemesananRetur()
	{
		$id = $this->input->post('id');
		$data['pemesanan'] = $this->GudangPemesanan->getPemesananRetur($id);

		echo json_encode($data);
	}

	public function tambahReturBarang()
	{
		$jumlahRetur = $this->input->post('jumlahRetur');

		$data['id_transaksi_vendor'] = $this->input->post('idTransaksi');
		$data['jumlah_retur_barang'] = $jumlahRetur;
		$data['status_retur'] = 0;
		$data['tanggal_retur'] = $this->input->post('tglRetur');
		$data['tanggal_selesai_retur'] = "0000-00-00";
		$data['keterangan'] = $this->input->post('keterangan');

		$stokLama = $this->input->post('stokLamaRetur');
		$idBarang = $this->input->post('idBarang');
		$updateStok = $stokLama - $jumlahRetur;

		$sukses = $this->GudangReturBarang->insertReturBarang($data, $idBarang, $updateStok);

		if (!$sukses) {
			flashMessage('success', 'Retur barang berhasil ditambahkan.');
			redirect('gudang/retur');
		} else {
			flashMessage('error', 'Retur barang gagal ditambahkan! Silahkan coba lagi.');
			redirect('gudang/pesanan');
		}
	}

	public function verifikasiPemesanan()
	{
		$idTransaksi = $this->input->post('idPemesananVendor');
		$idBarang = $this->input->post('idBarangPemesananVendor');
		$stoklama = $this->input->post('stoklama');
		$totalbeli = $this->input->post('totalbeli');

		$updateStok = $stoklama + $totalbeli;

		$sukses = $this->GudangPemesanan->verifikasiPemesananKeVendor($idTransaksi, $idBarang, $updateStok);

		if (!$sukses) {
			flashMessage('success', 'Verifikasi berhasil');
			redirect('gudang/pesanan', 'refresh');
		} else {
			flashMessage('error', 'Verifikasi gagal');
			redirect('gudang/pesanan', 'refresh');
		}
	}

}

/* End of file home.php */
/* Location: ./application/controllers/gudang/home.php */