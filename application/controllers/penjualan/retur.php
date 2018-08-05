<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Retur extends MY_Controller {

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
		$data['title'] = 'Retur - Pemesanan Vendor';
		$data['listretur'] = $this->PenjualanPemesanan->getListRetur();
		$data['riwayatRetur'] = $this->PenjualanPemesanan->getRiwayatReturBarang();

		$this->render_penjualan('penjualan/returPemesanan', $data);
	}

	public function detailRetur()
	{
		$id = $this->input->post('id');
		$data['retur'] = $this->PenjualanPemesanan->getDetailReturBarang($id);

		echo json_encode($data);
	}

	public function detailRiwayatRetur()
	{
		$id = $this->input->post('id');
		$data['riwayatRetur'] = $this->PenjualanPemesanan->getDetailRiwayatReturBarang($id);

		echo json_encode($data);
	}

	public function returReseller()
	{
		$title['title'] = 'Retur - Reseller';
		$this->render_penjualan('penjualan/returReseller', $title);
	}

}

/* End of file home.php */
/* Location: ./application/controllers/gudang/home.php */