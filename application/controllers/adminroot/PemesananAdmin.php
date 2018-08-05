<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PemesananAdmin extends MY_Controller {

	protected $getID, $getIdInvoice;

	function __construct() {
		parent::__construct();

		$this->getID = "TSVN-".date("YmdHis");
		$this->getIdInvoice = "TSVN-INV-".date('YmdHis');

		// Load Model
		$this->load->model('AdminModelPemesanan');

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
		$data['title'] = 'Pemesanan Barang';
		$data['vendor'] = $this->AdminModelPemesanan->getVendor();
		$data['barang'] = $this->AdminModelPemesanan->getBarang();
		$this->render_admin('adminroot/Pemesanan', $data);
	}

	public function getBarangJson()
	{
		$id = $this->input->post('id');
		$data['produk'] = $this->AdminModelPemesanan->getBarangById($id);
		echo json_encode($data);
	}

	public function tambahPemesanan()
	{	
		$sisaTagihan = $this->input->post('sisaBayarPost');

		$data['id_transaksi_vendor'] = $this->getID;
		$data['tgl_beli'] = $this->input->post('tglBeliPost');
		$data['total_beli'] = $this->input->post('totalBeliPost');
		$data['harga_satuan'] = $this->input->post('hargaSatuanPost');
		$data['total_harga_beli'] = $this->input->post('totalHargaPost');
		$data['uang_keluar'] = $this->input->post('jumlahUang');
		$data['uang_kembalian'] = $this->input->post('uangKembalianPost');

		if ($sisaTagihan == 0) {
			$data['status_transaksi'] = 1;
			$invoice['status_invoice'] = 1;
		} else {
			$data['status_transaksi'] = 0;
			$invoice['status_invoice'] = 0;
		}

		$data['status_barang'] = 0;
		$data['id_invoice'] = $this->getIdInvoice;
		$data['id_vendor'] = $this->input->post('IdVendorPost');
		$data['id_barang'] = $this->input->post('IdBarangPost');
		$data['reference_1'] = 0;
		$data['reference_2'] = $this->input->post('reference2');

		$invoice['id_invoice'] = $this->getIdInvoice;
		$invoice['tgl_jatuh_tempo'] = 0000-00-00;

		$hisinvoice['id_invoice'] = $this->getIdInvoice;
		$hisinvoice['total_tagihan'] = $this->input->post('totalHargaPost');
		$hisinvoice['pembayaran_tagihan'] = $this->input->post('jumlahUang');
		$hisinvoice['tanggal_pembayaran'] = $this->input->post('tglBeliPost');
		$hisinvoice['sisa_tagihan'] = $this->input->post('sisaBayarPost');

		// var_dump($data, $invoice, $hisinvoice);
		$sukses = $this->AdminModelPemesanan->insertPemesanan($data, $invoice, $hisinvoice);

		if (!$sukses) {
			flashMessage('success', 'Pemesanan berhasil ditambahkan');
			redirect('adminroot/PemesananAdmin/riwayatPemesanan/');				
		} else {
			flashMessage('error', 'Pemesanan gagal ditambahkan! Silahkan coba lagi');
			redirect('adminroot/PemesananAdmin/');
		}
	}

	public function riwayatPemesanan()
	{
		$data['title'] = 'Riwayat Pemesanan';
		$data['listpemesanan'] = $this->AdminModelPemesanan->getPemesanan();
		$data['listpemesanansukses'] = $this->AdminModelPemesanan->getPemesananSukses();

		$this->render_admin('adminroot/RiwayatPemesanan', $data);
	}

	public function detailRiwayatPemesananPending()
	{
		$id = $this->input->post('id');
		$data['detailpemesanan'] = $this->AdminModelPemesanan->getDetailPemesananById($id);

		echo json_encode($data);
	}

	public function detailRiwayatPemesananSukses()
	{
		$id = $this->input->post('id');
		$data['detailpemesanan'] = $this->AdminModelPemesanan->getDetailPemesananSuksesById($id);

		echo json_encode($data);
	}

	public function pemesananRetur()
	{
		$id = $this->input->post('id');
		$data['pemesanan'] = $this->AdminModelPemesanan->getPemesananRetur($id);

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
		$totalBeli = $this->input->post('totalBeliSukses');

		// menjumlahkan stok digudang dengan pesanan yg di retur
		$updateStok = $stokLama - $jumlahRetur;

		$sukses = $this->AdminModelPemesanan->insertReturPemesanan($data, $idBarang, $updateStok);

		if (!$sukses) {
			flashMessage('success', 'Retur barang berhasil ditambahkan.');
			redirect('adminroot/ReturPemesananAdmin/');
		} else {
			flashMessage('error', 'Retur barang gagal ditambahkan! Silahkan coba lagi.');
			redirect('adminroot/PemesananAdmin/riwayatPemesanan/');
		}
	}

	public function verifikasiPemesanan()
	{
		$idTransaksi = $this->input->post('idPemesananVendor');
		$idBarang = $this->input->post('idBarangPemesananVendor');
		$stoklama = $this->input->post('stoklama');
		$totalbeli = $this->input->post('totalbeli');

		$updateStok = $stoklama + $totalbeli;

		$sukses = $this->AdminModelPemesanan->verifikasiPemesananKeVendor($idTransaksi, $idBarang, $updateStok);

		if (!$sukses) {
			flashMessage('success', 'Verifikasi berhasil');
			redirect('adminroot/PemesananAdmin/riwayatPemesanan/', 'refresh');
		} else {
			flashMessage('error', 'Verifikasi gagal');
			redirect('adminroot/PemesananAdmin', 'refresh');
		}
	}

}

/* End of file home.php */
/* Location: ./application/controllers/gudang/home.php */