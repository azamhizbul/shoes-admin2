<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ReturPemesananAdmin extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('AdminModelRetur');

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
		$data['title'] = 'Retur - Pemesanan Vendor';
		$data['returpending'] = $this->AdminModelRetur->getReturPending();
		$data['retursukses'] = $this->AdminModelRetur->getReturSukses();

		$this->render_admin('adminroot/ReturPemesanan', $data);
	}

	public function detailReturPemesananPending()
	{
		$id = $this->input->post('id');
		$data['retur'] = $this->AdminModelRetur->getDetailReturPemesananPending($id);

		echo json_encode($data);
	}

	public function detailReturPemesananSukses()
	{
		$id = $this->input->post('id');
		$data['riwayatRetur'] = $this->AdminModelRetur->getDetailReturPemesananSukses($id);

		echo json_encode($data);
	}

	public function verifikasiRetur()
	{
		$idRetur = $this->input->post('idReturVerifikasi');
		$tglSelesaiRetur = $this->input->post('tglSelesaiReturVerifikasi');
		$ket = $this->input->post('keteranganVerifikasi');
		$jumlahRetur = $this->input->post('jumlahRetur');
		$stokLama = $this->input->post('stokLama');
		$idBarang = $this->input->post('idBarangRetur');

		$updateStok = $stokLama + $jumlahRetur;

		$sukses = $this->AdminModelRetur->verifikasiReturPemesanan($idRetur, $tglSelesaiRetur, $ket, $idBarang, $updateStok);

		if (!$sukses) {
			flashMessage('success', 'Retur barang berhasil di verifikasi sesuai pesanan sebelumnya.');
			redirect('adminroot/ReturPemesananAdmin');
		} else {
			flashMessage('error', 'Retur barang gagal di verifikasi! Silahkan coba lagi');
			redirect('admin/ReturPemesananAdmin');
		}
		
	}

	public function returReseller()
	{
		$title['title'] = 'Retur - Reseller';
		$this->render_penjualan('adminroot/ReturReseller', $title);
	}

}

/* End of file home.php */
/* Location: ./application/controllers/gudang/home.php */