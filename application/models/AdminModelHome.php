<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
* 
*/
class AdminModelHome extends CI_Model
{
	
	function getBarang() {
		$query = $this->db->query('SELECT IFNULL(SUM(stok), 0) as total_stok FROM tb_barang');

		return $query->result();
	}

	function getRetur() {
		$query = $this->db->query('SELECT * FROM tb_retur WHERE MONTH(tanggal_retur) = MONTH(CURRENT_DATE) AND status_retur = 0');

		return $query->result();
	}

	function getPenjualanPerHari() {
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

	function getInvoicePerHari() {
		$query = $this->db->query('SELECT MONTH(total_invoice.tgl_jual) as Bulan, IFNULL(SUM(total_invoice.invoice), 0) as total 
   					FROM 
				(SELECT tgl_jual, id_invoice as invoice 
					FROM tb_transaksi_merk
				UNION ALL 
				SELECT tgl_jual, id_invoice as invoice 
					FROM tb_transaksi_reseller
				UNION ALL
				SELECT tgl_jual, id_invoice as invoice
					FROM tb_transaksi_merk)
				total_invoice
                WHERE MONTH(total_invoice.tgl_jual) = MONTH(CURRENT_DATE)
                GROUP BY MONTH(tgl_jual)');

		return $query->result();
	}

	function getInvoice() {
		$query = $this->db->query("SELECT IFNULL(COUNT(id_history), 0) as invoice, tanggal_pembayaran FROM tb_history_invoice WHERE MONTH(tanggal_pembayaran) = MONTH(CURRENT_DATE) GROUP BY MONTH(tanggal_pembayaran)");
		return $query->result();
	}

	function getPenjualanCustomer(){
		 $query = $this->db->query('SELECT SUM(jumlah_jual) as jual, tgl_jual FROM tb_transaksi_end_user WHERE MONTH(tgl_jual) = MONTH(CURRENT_DATE) GROUP BY tgl_jual')->result();
		 return $query;
	}

	function getPenjualanReseller(){
		 $query = $this->db->query('SELECT SUM(jumlah_jual) as jual, tgl_jual FROM tb_transaksi_reseller WHERE MONTH(tgl_jual) = MONTH(CURRENT_DATE) GROUP BY tgl_jual')->result();
		 return $query;
	}

}