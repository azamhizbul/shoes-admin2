<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminModelPengeluaranHarian extends CI_Model {

	function getKaryawan() {
		$query = $this->db->get('tb_karyawan'); 
		return $query->result();
	}

	function getPengeluaranKaryawan()
	{
		$this->db->select('tb_pengeluaran_karyawan.id_pengeluaran, tb_pengeluaran_karyawan.tgl_pengeluaran, tb_pengeluaran_karyawan.kategori_pengeluaran, tb_pengeluaran_karyawan.jumlah_pengeluaran, tb_pengeluaran_karyawan.keterangan, tb_karyawan.nama as nama');
		$this->db->from('tb_pengeluaran_karyawan');
		$this->db->join('tb_karyawan', 'tb_pengeluaran_karyawan.id_karyawan = tb_karyawan.id_karyawan');
		$this->db->order_by('tgl_pengeluaran','DESC');
		return $this->db->get()->result();
	}

	function insertPengeluaranKaryawan()
	{
		$date = strtotime($this->input->post('tglPengeluaranPost'));
		$newDate = date('Y-m-d',$date);
		$ar['tgl_pengeluaran'] = $newDate;
		$ar['kategori_pengeluaran'] = $this->input->post('kategoriPengeluaranPost');
		$ar['jumlah_pengeluaran'] = $this->input->post('jumlahPengeluaranPost');
		$ar['keterangan'] = $this->input->post('keteranganPost');
		$ar['id_karyawan'] = $this->input->post('idKaryawanPost');
		$this->db->insert('tb_pengeluaran_karyawan', $ar);
		//var_dump($ar);
	}

	function editPengeluaran(){
		$this->db->where('id_pengeluaran', $this->input->post('id'));
    	return $this->db->get('tb_pengeluaran_karyawan')->result();
	}

	function updatePengeluaran(){
		$ar['tgl_pengeluaran'] = $this->input->post('tglPengeluaran');
		$ar['kategori_pengeluaran'] = $this->input->post('kategoriPengeluaran');
		$ar['jumlah_pengeluaran'] = $this->input->post('jumlahPengeluaran');
		$ar['keterangan'] = $this->input->post('keterangan');
		$ar['id_karyawan'] = $this->input->post('idKaryawan');
		$this->db->set($ar);
		$this->db->where('id_pengeluaran',$this->input->post('idPengeluaran'));
		$this->db->update('tb_pengeluaran_karyawan');
	}

	function deletePengeluaran($id){
		$this->db->where('id_pengeluaran',$id);
		$this->db->delete('tb_pengeluaran_karyawan');

	}

	function getJumlahPengeluaranHarianGaji(){
		 $query = $this->db->query('SELECT kategori_pengeluaran, sum(jumlah_pengeluaran) as pengeluaran, tgl_pengeluaran FROM tb_pengeluaran_karyawan WHERE MONTH(tgl_pengeluaran) = MONTH(CURRENT_DATE) AND kategori_pengeluaran = "Gaji" GROUP BY tgl_pengeluaran')->result();
		 return $query;

	}

	function getJumlahPengeluaranHarianAkomodasi(){
		 $query = $this->db->query('SELECT kategori_pengeluaran, sum(jumlah_pengeluaran) as pengeluaran, tgl_pengeluaran FROM tb_pengeluaran_karyawan WHERE MONTH(tgl_pengeluaran) = MONTH(CURRENT_DATE) AND kategori_pengeluaran = "Akomodasi" GROUP BY tgl_pengeluaran')->result();
		 return $query;

	}

	function getJumlahPengeluaranHarianTransport(){
		 $query = $this->db->query('SELECT kategori_pengeluaran, sum(jumlah_pengeluaran) as pengeluaran, tgl_pengeluaran FROM tb_pengeluaran_karyawan WHERE MONTH(tgl_pengeluaran) = MONTH(CURRENT_DATE) AND kategori_pengeluaran = "Transport" GROUP BY tgl_pengeluaran')->result();
		 return $query;

	}

	function getJumlahPengeluaranHarianLainlain(){
		 $query = $this->db->query('SELECT kategori_pengeluaran, sum(jumlah_pengeluaran) as pengeluaran, tgl_pengeluaran FROM tb_pengeluaran_karyawan WHERE MONTH(tgl_pengeluaran) = MONTH(CURRENT_DATE) AND kategori_pengeluaran = "Lain-lain" GROUP BY tgl_pengeluaran')->result();
		 return $query;

	}
	

}

/* End of file ModelBarang.php */
/* Location: ./application/models/AdminModel/ModelBarang.php */