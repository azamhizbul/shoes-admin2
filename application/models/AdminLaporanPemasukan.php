<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminLaporanPemasukan extends CI_Model {

	function getTargetPendapatan() {
		$query = $this->db->query('SELECT pendapatan.id_barang, pendapatan.produk, SUM(pendapatan.total_penjualan) AS total_item_terjual, 
SUM(pendapatan.biaya_pembuatan) AS total_biaya_pembuatan, SUM(pendapatan.target_pemasukan) AS total_target_pemasukan, 
SUM(pendapatan.target_pendapatan) AS total_target_pendapatan
FROM (SELECT tb_barang.produk, tb_barang.harga AS harga_asal, tb_transaksi_end_user_peritem.id_barang, 
	SUM(tb_transaksi_end_user_peritem.total_item) AS total_penjualan, 
	(tb_barang.harga * SUM(tb_transaksi_end_user_peritem.total_item) + tb_barang.harga_packing * SUM(tb_transaksi_end_user_peritem.total_item)) AS biaya_pembuatan, 
	SUM(tb_transaksi_end_user_peritem.total_harga) AS target_pemasukan, 
	(SUM(tb_transaksi_end_user_peritem.total_harga) -  (tb_barang.harga * SUM(tb_transaksi_end_user_peritem.total_item) + tb_barang.harga_packing * SUM(tb_transaksi_end_user_peritem.total_item))) AS target_pendapatan
	FROM tb_transaksi_end_user_peritem, tb_transaksi_end_user, tb_barang
	WHERE tb_transaksi_end_user_peritem.id_transaksi_end_user = tb_transaksi_end_user.id_transaksi_end_user 
	AND tb_barang.id_barang = tb_transaksi_end_user_peritem.id_barang AND YEAR(tb_transaksi_end_user.tgl_jual) = YEAR(CURRENT_DATE)
	GROUP BY tb_barang.id_barang
	UNION ALL
	SELECT tb_barang.produk, tb_barang.harga AS harga_asal, tb_transaksi_merk_per_item.id_barang, 
	SUM(tb_transaksi_merk_per_item.total_item) AS total_penjualan, 
	(tb_barang.harga * SUM(tb_transaksi_merk_per_item.total_item) + tb_barang.harga_packing * SUM(tb_transaksi_merk_per_item.total_item)) AS biaya_pembuatan, 
	SUM(tb_transaksi_merk_per_item.total_harga) AS target_pemasukan, 
	(SUM(tb_transaksi_merk_per_item.total_harga) - (tb_barang.harga * SUM(tb_transaksi_merk_per_item.total_item) + tb_barang.harga_packing * SUM(tb_transaksi_merk_per_item.total_item))) AS target_pendapatan 
	FROM tb_transaksi_merk_per_item, tb_transaksi_merk, tb_barang 
	WHERE tb_transaksi_merk_per_item.id_transaksi_merk = tb_transaksi_merk.id_transaksi_merk 
	AND tb_barang.id_barang = tb_transaksi_merk_per_item.id_barang AND YEAR(tb_transaksi_merk.tgl_jual) = YEAR(CURRENT_DATE) 
	GROUP BY tb_barang.id_barang
	UNION ALL
	SELECT tb_barang.produk, tb_barang.harga AS harga_asal, tb_transaksi_reseller_peritem.id_barang, 
	SUM(tb_transaksi_reseller_peritem.total_item) AS total_penjualan, 
	(tb_barang.harga * SUM(tb_transaksi_reseller_peritem.total_item) + tb_barang.harga_packing * SUM(tb_transaksi_reseller_peritem.total_item)) AS biaya_pembuatan, 
	SUM(tb_transaksi_reseller_peritem.total_harga) AS target_pemasukan, 
	(SUM(tb_transaksi_reseller_peritem.total_harga) - (tb_barang.harga * SUM(tb_transaksi_reseller_peritem.total_item) + tb_barang.harga_packing * SUM(tb_transaksi_reseller_peritem.total_item))) AS target_pendapatan 
	FROM tb_transaksi_reseller_peritem, tb_transaksi_reseller, tb_barang 
	WHERE tb_transaksi_reseller_peritem.id_transaksi_reseller = tb_transaksi_reseller.id_transaksi_reseller 
	AND tb_barang.id_barang = tb_transaksi_reseller_peritem.id_barang AND YEAR(tb_transaksi_reseller.tgl_jual) = YEAR(CURRENT_DATE)
	GROUP BY tb_barang.id_barang) pendapatan
	GROUP BY pendapatan.id_barang');

		return $query->result();
	}

	
	function getPendapatan() {
		$query = $this->db->query('SELECT SUM(pendapatan.potongan_harga) AS total_potongan, SUM(pendapatan.total_item) AS total_transaksi, SUM(pendapatan.total_modal_pembuatan) AS total_modal, SUM(pendapatan.harga_jual) AS total_pemasukan, SUM(pendapatan.pendapatan) AS total_pendapatan
			FROM
			(SELECT potongan_harga, SUM(total.total_item) as total_item, SUM(total.modal_pembuatan) AS total_modal_pembuatan, harga_jual, (harga_jual - SUM(total.modal_pembuatan)) AS pendapatan
			FROM `tb_transaksi_end_user`, 
			(SELECT tb_transaksi_end_user_peritem.id_transaksi_end_user, tb_transaksi_end_user_peritem.id_barang, total_item, barang.harga, ((total_item * barang.harga) + (total_item * barang.harga_packing) ) AS modal_pembuatan
			FROM tb_transaksi_end_user_peritem, (SELECT id_barang, harga, harga_packing FROM tb_barang) barang
			WHERE tb_transaksi_end_user_peritem.id_barang = barang.id_barang) total
			WHERE tb_transaksi_end_user.id_transaksi_end_user = total.id_transaksi_end_user AND YEAR(tgl_jual) = YEAR(CURRENT_DATE)
			GROUP BY tb_transaksi_end_user.id_transaksi_end_user
			UNION ALL
			SELECT potongan_harga, SUM(total.total_item) as total_item, SUM(total.modal_pembuatan) AS total_modal_pembuatan, harga_jual, (harga_jual - SUM(total.modal_pembuatan)) AS pendapatan
			FROM `tb_transaksi_reseller`, 
			(SELECT tb_transaksi_reseller_peritem.id_transaksi_reseller, tb_transaksi_reseller_peritem.id_barang, total_item, barang.harga, ((total_item * barang.harga) + (total_item * barang.harga_packing)) AS modal_pembuatan
			FROM tb_transaksi_reseller_peritem, (SELECT id_barang, harga, harga_packing FROM tb_barang) barang
			WHERE tb_transaksi_reseller_peritem.id_barang = barang.id_barang) total
			WHERE tb_transaksi_reseller.id_transaksi_reseller = total.id_transaksi_reseller AND YEAR(tgl_jual) = YEAR(CURRENT_DATE)
			GROUP BY tb_transaksi_reseller.id_transaksi_reseller
			UNION ALL
			SELECT potongan_harga, SUM(total.total_item) as total_item, SUM(total.modal_pembuatan) AS total_modal_pembuatan, harga_jual, (harga_jual - SUM(total.modal_pembuatan)) AS pendapatan FROM `tb_transaksi_merk`, (SELECT tb_transaksi_merk_per_item.id_transaksi_merk, tb_transaksi_merk_per_item.id_barang, total_item, barang.harga, ((total_item * barang.harga) + (total_item * barang.harga_packing)) AS modal_pembuatan FROM tb_transaksi_merk_per_item, (SELECT id_barang, harga, harga_packing FROM tb_barang) barang WHERE tb_transaksi_merk_per_item.id_barang = barang.id_barang) total WHERE tb_transaksi_merk.id_transaksi_merk = total.id_transaksi_merk AND YEAR(tgl_jual) = YEAR(CURRENT_DATE) GROUP BY tb_transaksi_merk.id_transaksi_merk) pendapatan');

		return $query->result();
	}

	function getDetailPemasukanEndUser($idBarang){
		$query = $this->db->query("SELECT tb_transaksi_end_user.id_transaksi_end_user, tb_transaksi_end_user.tgl_jual, tb_barang.produk, tb_transaksi_end_user_peritem.total_item, tb_barang.harga_end_user, (tb_transaksi_end_user_peritem.total_item * tb_barang.harga_end_user) AS total_harga
			FROM tb_barang, tb_transaksi_end_user, tb_transaksi_end_user_peritem
			WHERE tb_transaksi_end_user.id_transaksi_end_user = tb_transaksi_end_user_peritem.id_transaksi_end_user
			AND tb_barang.id_barang = tb_transaksi_end_user_peritem.id_barang
			AND YEAR(tb_transaksi_end_user.tgl_jual) = YEAR(tb_transaksi_end_user.tgl_jual)
			AND tb_transaksi_end_user_peritem.id_barang = '$idBarang'");

		return $query->result();
	}

	function getDetailPemasukanReseller($idBarang){
		$query = $this->db->query("SELECT tb_transaksi_reseller.id_transaksi_reseller, tb_transaksi_reseller.tgl_jual, tb_barang.produk, tb_transaksi_reseller_peritem.total_item, tb_barang.harga_reseller, (tb_transaksi_reseller_peritem.total_item * tb_barang.harga_reseller) AS total_harga
			FROM tb_barang, tb_transaksi_reseller, tb_transaksi_reseller_peritem
			WHERE tb_transaksi_reseller.id_transaksi_reseller = tb_transaksi_reseller_peritem.id_transaksi_reseller
			AND tb_barang.id_barang = tb_transaksi_reseller_peritem.id_barang
			AND YEAR(tb_transaksi_reseller.tgl_jual) = YEAR(tb_transaksi_reseller.tgl_jual)
			AND tb_transaksi_reseller_peritem.id_barang = '$idBarang'");

		return $query->result();
	}

	function getDetailPemasukanMerk($idBarang){
		$query = $this->db->query("SELECT tb_transaksi_merk.id_transaksi_merk, tb_transaksi_merk.tgl_jual, tb_barang.produk, tb_transaksi_merk_per_item.total_item, tb_barang.harga_jual_vendor as harga_merk, (tb_transaksi_merk_per_item.total_item * tb_barang.harga_jual_vendor) AS total_harga
			FROM tb_barang, tb_transaksi_merk, tb_transaksi_merk_per_item
			WHERE tb_transaksi_merk.id_transaksi_merk = tb_transaksi_merk_per_item.id_transaksi_merk
			AND tb_barang.id_barang = tb_transaksi_merk_per_item.id_barang
			AND YEAR(tb_transaksi_merk.tgl_jual) = YEAR(tb_transaksi_merk.tgl_jual)
			AND tb_transaksi_merk_per_item.id_barang = '$idBarang'");

		return $query->result();
	}


}