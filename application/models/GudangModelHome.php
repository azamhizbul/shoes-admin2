<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
* 
*/
class GudangModelHome extends CI_Model
{
	
	function getJumlahPemesanan() {
		$query = $this->db->query('SELECT IFNULL(SUM(total_beli), 0) AS Total FROM tb_transaksi_vendor WHERE tgl_beli = CURRENT_DATE AND id_invoice != "0" ');

		return $query->result();
	}

	function getStokBarang() {
		$query = $this->db->query('SELECT IFNULL(SUM(stok),0) as Total FROM tb_barang WHERE kepemilikan_barang = "pribadi" AND status = 0');

		return $query->result();
	}

	function getReturBarang() {
		$query = $this->db->query('SELECT IFNULL(SUM(jumlah_retur_barang), 0) as total_retur FROM `tb_retur` WHERE tanggal_retur = CURRENT_DATE');

		return $query->result();
	}

	function getJumlahPemasukanBarang(){
		$query = $this->db->query('SELECT IFNULL(SUM(total_beli), 0) as beli, tgl_beli FROM tb_transaksi_vendor WHERE MONTH(tgl_beli) = MONTH(CURRENT_DATE) AND status_transaksi = 1 GROUP BY tgl_beli')->result();
		
		return $query;
	}

}