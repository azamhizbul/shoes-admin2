<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
* 
*/
class PenjualanModelHome extends CI_Model
{
	
	function getTotalPemesanan() {
		$query = $this->db->query('SELECT IFNULL(SUM(total_beli), 0) AS Total FROM tb_transaksi_vendor WHERE tgl_beli = CURRENT_DATE');

		return $query->result();
	}

	function getTotalRetur() {
		$query = $this->db->query('SELECT IFNULL(SUM(jumlah_retur_barang), 0) as total_retur FROM `tb_retur` WHERE tanggal_retur = CURRENT_DATE');

		return $query->result();
	}

	function getTotalPenjualan() {
		$query = $this->db->query('SELECT IFNULL(SUM(total_barang_terjual.barang_terjual), 0) AS Total
   					FROM 
   					(SELECT jumlah_jual as barang_terjual, tgl_jual
						FROM `tb_transaksi_reseller`
					UNION ALL 
					SELECT jumlah_jual as barang_terjual, tgl_jual
						FROM `tb_transaksi_merk`
					UNION ALL 
					SELECT jumlah_jual as barang_terjual, tgl_jual
						FROM `tb_transaksi_end_user`)
					total_barang_terjual
                    WHERE tgl_jual = CURRENT_DATE');

		return $query->result();
	}

	function getJumlahPenjualanCustomer(){
		 $query = $this->db->query('SELECT SUM(jumlah_jual) as jual, tgl_jual FROM tb_transaksi_end_user WHERE MONTH(tgl_jual) = MONTH(CURRENT_DATE) AND reference_2 = 0 GROUP BY tgl_jual')->result();
		 return $query;
	}

	function getJumlahPenjualanReseller(){
		 $query = $this->db->query('SELECT SUM(jumlah_jual) as jual, tgl_jual FROM tb_transaksi_reseller WHERE MONTH(tgl_jual) = MONTH(CURRENT_DATE) AND reference_2 = 0 GROUP BY tgl_jual')->result();
		 return $query;
	}

}