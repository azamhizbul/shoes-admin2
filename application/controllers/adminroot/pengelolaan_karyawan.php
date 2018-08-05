<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengelolaan_Karyawan extends MY_Controller {

	function __construct() {
		parent::__construct();

		// Load Model
		$this->load->model('AdminModelKaryawan');
		
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
		$data['title'] = 'Pengelolaan Karyawan';
		$data['listkaryawan'] = $this->AdminModelKaryawan->getKaryawan();

		$this->render_admin('adminroot/pengelolaan_karyawan', $data);
	}

	public function insertKaryawan()
	{
		$x = $this->input->post('GajiKaryawanPost');
		$Y = str_replace(".", "", $x);

		$data['nama'] = $this->input->post('NamaKaryawanPost');
		$data['alamat'] = $this->input->post('AlamatKaryawanPost');
		$data['umur'] = $this->input->post('UmurKaryawanPost');
		$data['no_handphone'] = $this->input->post('NoHpKaryawanPost');
		$data['gaji'] = $Y;
		$data['jabatan'] = $this->input->post('JabatanKaryawanPost');
		$data['status'] = "0";

		$sukses = $this->AdminModelKaryawan->tambahKaryawanBaru($data);

		if (!$sukses) {
			flashMessage('success', 'Karyawan baru berhasil ditambahkan.');
			redirect('adminroot/pengelolaan_karyawan');
		} else {
			flashMessage('error', 'Karyawan baru gagal ditambahkan! Silahkan coba lagi');
			redirect('adminroot/pengelolaan_karyawan');
		}
	}

	public function editKaryawan()
	{
		$id = $this->input->post('id');
		$data['karyawan'] = $this->AdminModelKaryawan->pilihKaryawanById($id);
		$data['karyawan'][0]->gaji = strrev(implode('.',str_split(strrev(strval($data['karyawan'][0]->gaji)),3)));
		echo json_encode($data);
	}

	public function saveUpdate()
	{

		$x = $this->input->post('gajiKaryawan');
		$Y = str_replace(".", "", $x);

		$id = $this->input->post('idKaryawan');

		$data['nama'] = $this->input->post('namaKaryawan');
		$data['alamat'] = $this->input->post('alamatKaryawan');
		$data['umur'] = $this->input->post('umurKaryawan');
		$data['no_handphone'] = $this->input->post('noHpKaryawan');
		$data['gaji'] = $Y;
		$data['jabatan'] = $this->input->post('jabatanKaryawan');
		$data['status'] = "0";

		// var_dump($data, $id);
		
		$sukses = $this->AdminModelKaryawan->updateKaryawan($data, $id);

		if (!$sukses) {
			flashMessage('success', 'Data karyawan berhasil diubah.');
			redirect('adminroot/Pengelolaan_karyawan/');
		} else {
			flashMessage('error', 'Data karyawan gagal diubah! Silahkan coba lagi');
			redirect('adminroot/Pengelolaan_karyawan/');
		}
	}

	public function hapusKaryawan($id)
	{
		$sukses = $this->AdminModelKaryawan->deleteKaryawan($id);

		if (!$sukses) {
			flashMessage('success', 'Data karyawan berhasil dihapus');
			redirect('adminroot/Pengelolaan_karyawan/');
		} else {
			flashMessage('error', 'Data karyawan gagal dihapus! Silahkan coba lagi');
			redirect('adminroot/Pengelolaan_karyawan/');
		}
	}

}