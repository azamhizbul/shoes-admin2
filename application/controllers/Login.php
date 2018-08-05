<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* class Authentication
*/
class Login extends MY_Controller
{

	function __construct() {
		parent::__construct();
		$this->load->model('LoginModel');
	}

	function index() {
		
		if (($this->session->userdata('logged_in') == "Sudah Login") && ($this->session->userdata('level') == "1")) {
			redirect('adminroot/home');
		} elseif (($this->session->userdata('logged_in') == "Sudah Login") && ($this->session->userdata('level') == "2")) {
			redirect('gudang/home');
		} elseif (($this->session->userdata('logged_in') == "Sudah Login") && ($this->session->userdata('level') == "3")) {
			redirect('penjualan/home');
		}

		$data['title'] = 'Login';
		$this->render_login('v_login', $data);
	}

	function cek_login() {

		$user = $this->input->post('userName');
		$pass = $this->input->post('passWord');
		$password = md5($pass);

		if ((!empty($user)) && (!empty($password))) {
			$hasil = $this->LoginModel->cek_user($user, $password);

			if ($hasil->num_rows() == 1) {
				foreach ($hasil->result() as $sess) {
					$sess_data['logged_in']	= 'Sudah Login';
					$sess_data['uid']		= $sess->id_user;
					$sess_data['nama']		= $sess->nama;
					$sess_data['username']	= $sess->username;
					$sess_data['level']		= $sess->hak_akses;
					$sess_data['kid']		= $sess->id_karyawan;
					$this->session->set_userdata($sess_data);
				}

				if ($this->session->userdata('level') == '1') {
					redirect('adminroot');
				} else if ($this->session->userdata('level') == '2') {
					redirect('gudang');
				} elseif ($this->session->userdata('level') == '3') {
					redirect('penjualan');
				}
			} else {
				flashMessage('error', 'Username atau Password salah!');
				redirect('Login');
			}

		} else {
			flashMessage('warning', 'Username & Password tidak boleh kosong!');
			redirect('Login');
		}
		
	}

	 public function loginJSON()
	 {
	 	echo json_encode($this->session->userdata());
	 }

	function logout() {
		$this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('uid');
		$this->session->unset_userdata('nama');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('level');
		$this->session->unset_userdata('kid');
		session_destroy();
		$this->index();
	}
}
