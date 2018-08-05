<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
* 
*/
class Pengelolaan_akun extends MY_Controller
{

    function __construct() {
        parent::__construct();

        // Load Model
        $this->load->model('AdminModelAkun');

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
        $data['title'] = "Pengelolaan Akun";
        $data['listakun'] = $this->AdminModelAkun->getAkun();
        $data['listkaryawan'] = $this->AdminModelAkun->getKariawan();
        $data['karyawan'] = $this->AdminModelAkun->getKaryawan();

        $this->render_admin('adminroot/pengelolaan_akun', $data);
    }

	public function addAkun()
	{
		$this->form_validation->set_rules('passwordPost', 'Password', 'required|trim');
		$this->form_validation->set_rules('konfirmPasswordPost', 'Konfirmasi Password', 'required|trim|matches[passwordPost]');

		$data['username'] = $this->input->post('UsernamePost');
		$data['password'] = md5($this->input->post('PasswordPost'));
		$data['hak_akses'] = $this->input->post('HakAksesPost');
		$data['id_karyawan'] = $this->input->post('AkunKaryawanPost');

		$sukses = $this->AdminModelAkun->insertAkun($data);

		if (!$sukses) {
			flashMessage('success', 'Data akun berhasil ditambahkan.');
			redirect('adminroot/pengelolaan_akun');
		} else {
			flashMessage('error', 'Data akun gagal ditambahkan! Silahkan coba lagi');
			redirect('adminroot/pengelolaan_akun');
		}
	}

	public function editAkun()
	{
		$id = $this->input->post('id');
		$data['akun'] = $this->AdminModelAkun->getAkunById($id);

		echo json_encode($data);
	}

	public function saveUpdate()
	{
		$this->form_validation->set_rules('username', 'Password', 'required|trim');
		$this->form_validation->set_rules('hakAkses', 'Hak Akses', 'required');
		$this->form_validation->set_rules('idKaryawan', 'Nama Karyawan', 'required');

		if ($this->form_validation->run() != FALSE) {
			
			$id = $this->input->post('idUser');

			$data['username'] = $this->input->post('username');
			$data['hak_akses'] = $this->input->post('hakAkses');
			$data['id_karyawan'] = $this->input->post('idKaryawan');

			$sukses = $this->AdminModelAkun->updateAkun($data, $id);

			if (!$sukses) {
				flashMessage('success', 'Data akun berhasil diubah.');
				redirect('adminroot/pengelolaan_akun');
			} else {
				flashMessage('error', 'Data akun gagal diubah! Silahkan coba lagi');
				redirect('adminroot/pengelolaan_akun');
			}
		} else {
			flashMessage('error', 'Mohon isi form dengan benar!');
			redirect('adminroot/Pengelolaan_akun');
		}
		
	}

	public function deleteAkun($id)
	{
		$sukses = $this->AdminModelAkun->hapusAkun($id);

		if (!$sukses) {
			flashMessage('success', 'Data akun berhasil dihapus.');
			redirect('adminroot/pengelolaan_akun');
		} else {
			flashMessage('error', 'Data akun gagal dihapus! Silahkan coba lagi');
			redirect('adminroot/pengelolaan_akun');
		}
	}

	public function saveResetPassword()
	{
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('konfirmPassword', 'Konfirmasi Password', 'trim|required|matches[password]');

		if ($this->form_validation->run() != false) {
			$id = $this->input->post('idUserReset');
			$password = $this->input->post('password');

			// var_dump($id, $data);
			$sukses = $this->AdminModelAkun->updatePasswordProfile($password, $id);

			if (!$sukses) {
				flashMessage('success', 'Reset password telah berhasil.');
				redirect('adminroot/Pengelolaan_akun');	
			} else {
				flashMessage('error', 'Reset password gagal! Silahkan coba lagi.');
				redirect('adminroot/Pengelolaan_akun');
			}
		} else {
			flashMessage('error', 'Kesalahan pada inputan atau Password tidak cocok! Silahkah coba lagi');
			redirect('adminroot/Pengelolaan_akun');
		}
	}

}