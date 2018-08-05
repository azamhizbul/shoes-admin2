<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
* 
*/
class LoginModel extends CI_Model
{

	function cek_user($user, $pass)
	{
		$this->db->select('id_user, username, password, hak_akses, nama, tb_user.id_karyawan');
		$this->db->where('username', $user);
		$this->db->where('password', $pass);
		$this->db->join('tb_karyawan', 'tb_user.id_karyawan = tb_karyawan.id_karyawan');

		return $this->db->get('tb_user');
	}

	function getNamaUser($id) {
		$this->db->select('id_user, nama, jabatan, username, password, tb_user.id_karyawan');
		$this->db->where('id_user', $id);
		$this->db->join('tb_karyawan', 'tb_user.id_karyawan = tb_karyawan.id_karyawan');

		$hasil = $this->db->get('tb_user');

		if ($hasil->num_rows() > 0) {
			return $hasil->row();
		} else {
			return null;
		}
	}

}
