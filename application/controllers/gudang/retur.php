<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Retur extends MY_Controller {

	protected $getID;
	function __construct() {
		parent::__construct();
		$this->load->model('GudangReturBarang');

		$this->getID = "TSVN-".date("YmdHis");

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
		$data['title'] = 'Retur';
		$data['returBarang'] = $this->GudangReturBarang->getReturBarang();
		$data['riwayatRetur'] = $this->GudangReturBarang->getRiwayatReturBarang();
		$this->render_gudang('gudang/retur', $data);
	}

	public function detailRetur()
	{
		$id = $this->input->post('id');
		$data['retur'] = $this->GudangReturBarang->getDetailReturBarang($id);

		echo json_encode($data);
	}

	public function detailRiwayatRetur()
	{
		$id = $this->input->post('id');
		$data['riwayatRetur'] = $this->GudangReturBarang->getDetailRiwayatReturBarang($id);

		echo json_encode($data);
	}

	public function verifikasiRetur()
	{
		$idRetur = $this->input->post('idReturVerifikasi');
		$tglSelesaiRetur = $this->input->post('tglSelesaiReturVerifikasi');
		$ket = $this->input->post('keteranganVerifikasi');
		$idBarang = $this->input->post('idBarangRetur');
		$jumlahRetur = $this->input->post('jumlahRetur');
		$stokLama = $this->input->post('stokLama');

		$updateStok = $stokLama + $jumlahRetur;

		$sukses = $this->GudangReturBarang->verifikasiReturBarang($idRetur, $tglSelesaiRetur, $ket, $idBarang, $updateStok);

		if (!$sukses) {
			flashMessage('success', 'Retur barang berhasil di verifikasi sesuai pesanan sebelumnya.');
			redirect('gudang/retur');
		} else {
			flashMessage('error', 'Retur barang gagal di verifikasi! Silahkan coba lagi');
			redirect('gudang/retur');
		}
		
	}

}

/* End of file home.php */
/* Location: ./application/controllers/gudang/home.php */