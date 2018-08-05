<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
* 
*/
class AdminModelKaryawan extends CI_Model
{
	
	function tambahKaryawanBaru($data)
	{
		$this->db->insert('tb_karyawan', $data);
	}

	function getKaryawan() {
		$this->db->select('id_karyawan, nama, alamat, umur, no_handphone, gaji, jabatan');
		$this->db->from('tb_karyawan');
		$this->db->where('status', 0);
		$this->db->order_by('id_karyawan', 'DESC');

		return $this->db->get()->result();
	}

	function pilihKaryawanById($id_karyawan)
	{
		$this->db->select('id_karyawan, nama, alamat, umur, no_handphone, gaji, jabatan, status');
		$this->db->where('id_karyawan', $id_karyawan);

		return $this->db->get('tb_karyawan')->result();
	}

	function updateKaryawan($data, $id) {
		$this->db->SET($data);
		$this->db->where('id_karyawan', $id);
		$this->db->update('tb_karyawan');
	}

	function deleteKaryawan($id_karyawan)
	{
		$this->db->set('status', 1);
		$this->db->where('id_karyawan', $id_karyawan);
		$this->db->update('tb_karyawan');
		
	}
}