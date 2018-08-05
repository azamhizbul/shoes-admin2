<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
* 
*/
class AdminModelAkun extends CI_Model {
	
	function getAkun()
	{
		$this->db->select('id_user, tb_karyawan.id_karyawan, nama, no_handphone, username, hak_akses');
		$this->db->from('tb_user');
		$this->db->join('tb_karyawan', 'tb_user.id_karyawan = tb_karyawan.id_karyawan');
		$this->db->order_by('nama', 'DSC');
		
		return $this->db->get()->result();
	}


	function getKariawan(){
		$this->db->select('id_karyawan, nama');
		$this->db->from('tb_karyawan');
		$this->db->where('status', 0);
		return $this->db->get()->result();
	}

	function getKaryawan() {
		$this->db->select('id_karyawan, nama');
		$this->db->where('status', 0);
		return $this->db->get('tb_karyawan')->result();

	}

	function getAkunById($id_user)
	{
		$this->db->select('id_user, id_karyawan, username, password, hak_akses');
		$this->db->from('tb_user');
		$this->db->where('id_user', $id_user);
		return $this->db->get()->result();
	}


	function insertAkun($data) {
		$this->db->insert('tb_user', $data);
	}


	function updateAkun($data, $iduser)
	{
		$this->db->where('id_user', $iduser);
		$this->db->update('tb_user', $data);	
	}

	function hapusAkun($id_user)
	{
		$this->db->where('id_user', $id_user);
		$this->db->delete('tb_user');
	}

	function getAkunId($id_user)
	{
		$this->db->select('id_user, username, password');
		$this->db->where('id_user', $id_user);

		$query = $this->db->get('tb_user');

		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return null;
		}
	}

	function updateUsernameProfile($user, $id_user){
		$this->db->set('username', $user);
		$this->db->where('id_user', $id_user);
		$this->db->update('tb_user');
	}

	function updatePasswordProfile($pass, $id_user)
	{
		$this->db->set('password', do_hash($pass, 'md5'));
		$this->db->where('id_user', $id_user);
		$this->db->update('tb_user');
	}
}