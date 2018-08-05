<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Profile extends MY_Controller
{

	function __construct() {
		parent::__construct();
		$this->load->model('ProfileUserModel');

		if ($this->session->userdata('username') == "") {
			flashMessage('warning', 'Anda belum masuk atau Sesi anda telah berakhir!');
			redirect('Login');
		} elseif ($this->session->userdata('level') == "2") {
			flashMessage('error', 'Anda tidak berhak mengakses halaman tersebut');
			redirect('gudang/home');
		}
	}
	
	function index() {
		$title['title'] = 'Profil Pengguna';
		$this->render_penjualan('penjualan/profileUser', $title);
	}

	public function ubahPassword()
	{
		$data['title'] = 'Ubah Password';
		$this->render_penjualan('penjualan/UbahPassword', $data);
	}

	public function simpanUsername()
	{
		$this->form_validation->set_rules('username', 'Username', 'required|trim');

		if ($this->form_validation->run() != FALSE) {
			$id = $this->input->post('idUser');
			$user = $this->input->post('username');

			$sukses = $this->ProfileUserModel->updateUsername($user, $id);

			if (!$sukses) {
				flashMessage('success', 'Username berhasil diubah. Silahkan masuk kembali');
				redirect('login/logout');
			} else {
				flashMessage('error', 'Username gagal diubah! Silahkan coba lagi');
				redirect('gudang/profile');
			}
		} else {
			flashMessage('error', 'Kesalahan pada inputan! Silahkah coba lagi');
			redirect('gudang/profile');
		}
	}

	public function simpanPassword()
	{
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('konfirmPass', 'Konfirmasi Password', 'required|matches[password]');

		if ($this->form_validation->run() != FALSE) {
			$id = $this->input->post('idUser');
			$pass = $this->input->post('password');

			$sukses = $this->ProfileUserModel->updatePassword($pass, $id);

			if (!$sukses) {
				flashMessage('success', 'Password berhasil diubah. Silahkan masuk kembali');
				redirect('login/logout/');
			} else {
				flashMessage('error', 'Password gagal diubah! Silahkan coba lagi');
				redirect('gudang/profile/ubahPassword/');
			}
		} else {
			flashMessage('error', 'Kesalahan pada inputan atau Password tidak cocok! Silahkah coba lagi');
			redirect('gudang/profile/ubahPassword/');
		}
	}
}