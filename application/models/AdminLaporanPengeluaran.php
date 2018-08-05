<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminLaporanPengeluaran extends CI_Model {

	function getAllTahun() {
		$query = $this->db->query('SELECT YEAR(`tgl_beli`) as Tahun FROM `tb_transaksi_vendor` GROUP BY YEAR(tgl_beli) UNION SELECT YEAR(`tgl_pengeluaran`) as Tahun FROM `tb_pengeluaran_kantor` GROUP BY YEAR(tgl_pengeluaran) UNION SELECT YEAR(`tgl_pengeluaran`) as Tahun FROM `tb_pengeluaran_karyawan` GROUP BY YEAR(tgl_pengeluaran) ORDER BY Tahun DESC');

		return $query->result();
	}

	function getLaporanPerBulan($bulan, $tahun) {
		$query = $this->db->query("SELECT DATE_FORMAT(total_pengeluaran.tgl_pengeluaran, '%d-%m-%Y') AS Tanggal, MONTHNAME(total_pengeluaran.tgl_pengeluaran) AS Bulan, MONTH(total_pengeluaran.tgl_pengeluaran) AS Bln, YEAR(total_pengeluaran.tgl_pengeluaran) AS Tahun, SUM(total_pengeluaran.jumlah_pengeluaran) AS Total FROM (SELECT tgl_pengeluaran, COALESCE(jumlah_pengeluaran,0) jumlah_pengeluaran FROM tb_pengeluaran_karyawan UNION ALL SELECT tgl_beli, COALESCE(total_harga_beli,0) total_harga_beli FROM tb_transaksi_vendor UNION ALL SELECT tgl_pengeluaran, COALESCE(jumlah_pengeluaran, 0) jumlah_pengeluaran FROM tb_pengeluaran_kantor) total_pengeluaran WHERE MONTH(total_pengeluaran.tgl_pengeluaran) = '$bulan' AND YEAR(total_pengeluaran.tgl_pengeluaran) = '$tahun' GROUP BY total_pengeluaran.tgl_pengeluaran");

		return $query->result();
	}

	function cetakLaporanPerBulan($bln, $thn) {
		$query = $this->db->query("SELECT DATE_FORMAT(total_pengeluaran.tgl_pengeluaran, '%d-%m-%Y') AS Tanggal, MONTHNAME(total_pengeluaran.tgl_pengeluaran) AS Bulan, YEAR(total_pengeluaran.tgl_pengeluaran) AS Tahun, SUM(total_pengeluaran.jumlah_pengeluaran) AS Total FROM (SELECT tgl_pengeluaran, COALESCE(jumlah_pengeluaran,0) jumlah_pengeluaran FROM tb_pengeluaran_karyawan UNION ALL SELECT tgl_beli, COALESCE(total_harga_beli,0) total_harga_beli FROM tb_transaksi_vendor UNION ALL SELECT tgl_pengeluaran, COALESCE(jumlah_pengeluaran, 0) jumlah_pengeluaran FROM tb_pengeluaran_kantor) total_pengeluaran WHERE MONTH(total_pengeluaran.tgl_pengeluaran) = '$bln' AND YEAR(total_pengeluaran.tgl_pengeluaran) = '$thn' GROUP BY total_pengeluaran.tgl_pengeluaran");

		return $query->result();
	}

	function getLaporanPerTahun($tahun) {
		$query = $this->db->query("SELECT DATE_FORMAT(total_pengeluaran.tgl_pengeluaran,'%m-%Y') AS BulanTahun, MONTHNAME(total_pengeluaran.tgl_pengeluaran) AS Bulan, YEAR(total_pengeluaran.tgl_pengeluaran) AS Tahun, SUM(total_pengeluaran.jumlah_pengeluaran) AS Total FROM (SELECT tgl_pengeluaran, COALESCE(jumlah_pengeluaran,0) jumlah_pengeluaran FROM tb_pengeluaran_karyawan UNION ALL SELECT tgl_beli, COALESCE(total_harga_beli,0) total_harga_beli FROM tb_transaksi_vendor UNION ALL SELECT tgl_pengeluaran, COALESCE(jumlah_pengeluaran, 0) jumlah_pengeluaran FROM tb_pengeluaran_kantor) total_pengeluaran WHERE YEAR(total_pengeluaran.tgl_pengeluaran) = '$tahun' GROUP BY MONTH(total_pengeluaran.tgl_pengeluaran)");

		return $query->result();
	}

	function cetakLaporanPerTahun($thn) {
		$query = $this->db->query("SELECT DATE_FORMAT(total_pengeluaran.tgl_pengeluaran,'%m-%Y') AS BulanTahun, MONTHNAME(total_pengeluaran.tgl_pengeluaran) AS Bulan, YEAR(total_pengeluaran.tgl_pengeluaran) AS Tahun, SUM(total_pengeluaran.jumlah_pengeluaran) AS Total FROM (SELECT tgl_pengeluaran, COALESCE(jumlah_pengeluaran,0) jumlah_pengeluaran FROM tb_pengeluaran_karyawan UNION ALL SELECT tgl_beli, COALESCE(total_harga_beli,0) total_harga_beli FROM tb_transaksi_vendor UNION ALL SELECT tgl_pengeluaran, COALESCE(jumlah_pengeluaran, 0) jumlah_pengeluaran FROM tb_pengeluaran_kantor) total_pengeluaran WHERE YEAR(total_pengeluaran.tgl_pengeluaran) = '$thn' GROUP BY MONTH(total_pengeluaran.tgl_pengeluaran)");

		return $query->result();
	}

	function getDataPengeluaranPerTahun() {
		$query = $this->db->query("SELECT MONTH(total_pengeluaran.tgl_pengeluaran) AS Bulan,
			SUM(total_pengeluaran.jumlah_pengeluaran) AS Total 
			FROM 
				(SELECT tgl_pengeluaran, COALESCE(jumlah_pengeluaran,0) jumlah_pengeluaran FROM tb_pengeluaran_karyawan 
				UNION ALL SELECT tgl_beli, COALESCE(total_harga_beli,0) total_harga_beli FROM tb_transaksi_vendor 
				UNION ALL SELECT tgl_pengeluaran, COALESCE(jumlah_pengeluaran, 0) jumlah_pengeluaran FROM tb_pengeluaran_kantor) total_pengeluaran 
				WHERE YEAR(total_pengeluaran.tgl_pengeluaran) = YEAR(CURRENT_DATE) 
				GROUP BY MONTH(total_pengeluaran.tgl_pengeluaran)")->result();

		return $query;
	}


}