<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminModelPengeluaranBulanan extends CI_Model {


	function getPengeluaranKantor()
	{
		$this->db->select('*');
		$this->db->from('tb_pengeluaran_kantor');
		$this->db->order_by("tgl_pengeluaran","DESC");
		return $this->db->get()->result();
	}

	function insertPengeluaranKantor()
	{
		$date = strtotime($this->input->post('tglPengeluaranPost'));
		$newDate = date('Y-m-d',$date);
		$ar['tgl_pengeluaran'] = $newDate;
		$ar['kategori_pengeluaran'] = $this->input->post('kategoriPengeluaranPost');
		$ar['jumlah_pengeluaran'] = $this->input->post('jumlahPengeluaranPost');
		$ar['keterangan'] = $this->input->post('keteranganPost');
		$this->db->insert('tb_pengeluaran_kantor', $ar);
		//var_dump($ar);
	}

	function editPengeluaran(){
		$this->db->where('id_pengeluaran_kantor', $this->input->post('id'));
    	return $this->db->get('tb_pengeluaran_kantor')->result();
	}

	function updatePengeluaran(){
		$ar['tgl_pengeluaran'] = $this->input->post('tglPengeluaran');
		$ar['kategori_pengeluaran'] = $this->input->post('kategoriPengeluaran');
		$ar['jumlah_pengeluaran'] = $this->input->post('jumlahPengeluaran');
		$ar['keterangan'] = $this->input->post('keterangan');
		$this->db->set($ar);
		$this->db->where('id_pengeluaran_kantor',$this->input->post('idPengeluaran'));
		$this->db->update('tb_pengeluaran_kantor');
	}

	function deletePengeluaran($id){
		$this->db->where('id_pengeluaran_kantor',$id);
		$this->db->delete('tb_pengeluaran_kantor');

	}

	function getJumlahPengeluaranBulan(){
		 $query = $this->db->query('SELECT sum(jumlah_pengeluaran) as pengeluaran, tgl_pengeluaran FROM tb_pengeluaran_kantor WHERE MONTH(tgl_pengeluaran) = MONTH(CURRENT_DATE) GROUP BY tgl_pengeluaran')->result();
		 return $query;

	}

	function getJumlahPengeluaranBulanByAir(){
		 $query = $this->db->query('SELECT kategori_pengeluaran, sum(jumlah_pengeluaran) as pengeluaran, tgl_pengeluaran FROM tb_pengeluaran_kantor WHERE MONTH(tgl_pengeluaran) = MONTH(CURRENT_DATE) AND kategori_pengeluaran = "Bayar Air" GROUP BY tgl_pengeluaran')->result();
		 return $query;

	}

	function getJumlahPengeluaranBulanByListrik(){
		 $query = $this->db->query('SELECT kategori_pengeluaran, sum(jumlah_pengeluaran) as pengeluaran, tgl_pengeluaran FROM tb_pengeluaran_kantor WHERE MONTH(tgl_pengeluaran) = MONTH(CURRENT_DATE) AND kategori_pengeluaran = "Bayar Listrik" GROUP BY tgl_pengeluaran')->result();
		 return $query;

	}

	function getJumlahPengeluaranBulanByInternet(){
		 $query = $this->db->query('SELECT kategori_pengeluaran, sum(jumlah_pengeluaran) as pengeluaran, tgl_pengeluaran FROM tb_pengeluaran_kantor WHERE MONTH(tgl_pengeluaran) = MONTH(CURRENT_DATE) AND kategori_pengeluaran = "Bayar Internet" GROUP BY tgl_pengeluaran')->result();
		 return $query;

	}

	function getJumlahPengeluaranBulanBySewa(){
		 $query = $this->db->query('SELECT kategori_pengeluaran, sum(jumlah_pengeluaran) as pengeluaran, tgl_pengeluaran FROM tb_pengeluaran_kantor WHERE MONTH(tgl_pengeluaran) = MONTH(CURRENT_DATE) AND kategori_pengeluaran = "Bayar Sewa" GROUP BY tgl_pengeluaran')->result();
		 return $query;

	}

	function getJumlahPengeluaranBulanByATK(){
		 $query = $this->db->query('SELECT kategori_pengeluaran, sum(jumlah_pengeluaran) as pengeluaran, tgl_pengeluaran FROM tb_pengeluaran_kantor WHERE MONTH(tgl_pengeluaran) = MONTH(CURRENT_DATE) AND kategori_pengeluaran = "Bayar ATK" GROUP BY tgl_pengeluaran')->result();
		 return $query;

	}

	function getJumlahPengeluaranBulanByLainLain(){
		 $query = $this->db->query('SELECT kategori_pengeluaran, sum(jumlah_pengeluaran) as pengeluaran, tgl_pengeluaran FROM tb_pengeluaran_kantor WHERE MONTH(tgl_pengeluaran) = MONTH(CURRENT_DATE) AND kategori_pengeluaran = "Lain-lain" GROUP BY tgl_pengeluaran')->result();
		 return $query;

	}

	function detailPengeluaranPerBulan() {

		$id = $this->input->post('id');

		$query =$this->db->query( "SELECT IFNULL(SUM(`jumlah_pengeluaran`), 0) AS total_pengeluaran_kantor, IFNULL((SELECT SUM(`jumlah_pengeluaran`) FROM `tb_pengeluaran_karyawan` WHERE DATE_FORMAT(`tgl_pengeluaran`,'%d-%m-%Y') ='".$id."'),0) AS total_pengeluaran_karyawan, IFNULL((SELECT SUM(`total_harga_beli`) FROM `tb_transaksi_vendor` WHERE DATE_FORMAT(`tgl_beli`,'%d-%m-%Y') = '".$id."'),0) AS total_transaksi_vendor FROM `tb_pengeluaran_kantor` WHERE DATE_FORMAT(`tgl_pengeluaran`,'%d-%m-%Y') ='".$id."'")->result();

		return $query;
	}

	function detailPengeluaranPerTahun() {

		$id = $this->input->post('id');

		$query =$this->db->query( "SELECT IFNULL(SUM(`jumlah_pengeluaran`), 0) AS total_pengeluaran_kantor, IFNULL((SELECT SUM(`jumlah_pengeluaran`) FROM `tb_pengeluaran_karyawan` WHERE  DATE_FORMAT(`tgl_pengeluaran`,'%m-%Y') ='".$id."'),0) AS total_pengeluaran_karyawan, IFNULL((SELECT SUM(`total_harga_beli`) FROM `tb_transaksi_vendor` WHERE  DATE_FORMAT(`tgl_beli`,'%m-%Y') = '".$id."'),0) AS total_transaksi_vendor FROM `tb_pengeluaran_kantor` WHERE  DATE_FORMAT(`tgl_pengeluaran`,'%m-%Y') ='".$id."'")->result();

		return $query;
	}



}