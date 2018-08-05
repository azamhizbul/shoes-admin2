<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Profile extends MY_Controller
{
	function __construct() {
		parent::__construct();
		$this->load->model('AdminModelAkun');

		if ($this->session->userdata('username') == "") {
			flashMessage('warning', 'Anda belum masuk atau Sesi anda telah berakhir!');
			redirect('Login');
		} elseif ($this->session->userdata('level') == "2") {
			flashMessage('error', 'Anda tidak berhak mengakses halaman tersebut');
			redirect('gudang/home');
		} elseif ($this->session->userdata('level') == "3") {
			flashMessage('error', 'Anda tidak berhak mengakses halaman tersebut');
			redirect('penjualan/home');
		}
	}
	
	function index() {
		$data['title'] = 'Profil Pengguna';
		$this->render_admin('adminroot/profileUser', $data);
	}

	public function simpanUsername()
	{
		$this->form_validation->set_rules('username', 'Username', 'required|trim');

		if ($this->form_validation->run() != FALSE) {
			$id = $this->input->post('idUser');
			$user = $this->input->post('username');

			$sukses = $this->AdminModelAkun->updateUsernameProfile($user, $id);

			if (!$sukses) {
				flashMessage('success', 'Username berhasil diubah. Silahkan masuk kembali');
				redirect('login/logout');
			} else {
				flashMessage('error', 'Username gagal diubah! Silahkan coba lagi');
				redirect('adminroot/profile');
			}
		} else {
			flashMessage('error', 'Kesalahan pada inputan! Silahkah coba lagi');
			redirect('adminroot/profile');
		}
	}

	public function ubahPassword()
	{
		$data['title'] = 'Ubah Password';
		$this->render_admin('adminroot/UbahPassword', $data);
	}

	public function simpanPassword()
	{
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('konfirmPass', 'Konfirmasi Password', 'required|matches[password]');

		if ($this->form_validation->run() != FALSE) {
			$id = $this->input->post('idUser');
			$password = $this->input->post('password');

			$sukses = $this->AdminModelAkun->updatePasswordProfile($password, $id);

			if (!$sukses) {
				flashMessage('success', 'Password berhasil diubah. Silahkan masuk kembali');
				redirect('login/logout');
			} else {
				flashMessage('error', 'Password gagal diubah! Silahkan coba lagi');
				redirect('adminroot/profile/ubahPassword/');
			}

		} else {
			flashMessage('error', 'Kesalahan pada inputan atau Password tidak cocok! Silahkah coba lagi');
			redirect('adminroot/profile/ubahPassword/');
		}
	}
}