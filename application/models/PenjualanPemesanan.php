<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
* kelas model Penjualan Pemesanan
*/
class PenjualanPemesanan extends CI_Model
{

	function getBarang() {
		$this->db->select('id_barang, nama_merk, produk, warna, ukuran, harga');
		$this->db->from('tb_barang');
		$this->db->order_by('produk', 'asc');

		return $this->db->get()->result();
	}

	function getVendor(){
		$this->db->select('id_vendor, nama_vendor');
		$this->db->from('tb_vendor');
		// $this->db->order_by('produk', 'asc');

		return $this->db->get()->result();
	}

	function insertPemesananKeVendor($vendor) {
		$this->db->insert('tb_transaksi_vendor', $vendor);
	}

	function getPemesananKeVendor() {
		$this->db->select('id_transaksi_vendor, nama_merk, produk, warna, ukuran, total_beli, total_harga_beli, tgl_beli, nama_vendor, uang_kembalian');
		$this->db->from('tb_transaksi_vendor');
		$this->db->join('tb_barang', 'tb_transaksi_vendor.id_barang = tb_barang.id_barang');
		$this->db->join('tb_vendor', 'tb_transaksi_vendor.id_vendor = tb_vendor.id_vendor');
		$this->db->where('status_transaksi', '0');
		$this->db->order_by('id_transaksi_vendor', 'DESC');

		return $this->db->get()->result();
	}

	function getRiwayatPemesananKeVendor() {
		$this->db->select('id_transaksi_vendor, produk, warna, ukuran, total_beli, total_harga_beli, tgl_beli, nama_vendor');
		$this->db->from('tb_transaksi_vendor');
		$this->db->join('tb_barang', 'tb_transaksi_vendor.id_barang = tb_barang.id_barang');
		$this->db->join('tb_vendor', 'tb_transaksi_vendor.id_vendor = tb_vendor.id_vendor');
		$this->db->where('status_transaksi', '1');

		return $this->db->get()->result();
	}

	function getDetailRiwayatPemesananPendingKeVendor($id_transaksi_vendor) {
		$this->db->select('id_transaksi_vendor, nama_merk, warna, ukuran, total_beli, total_harga_beli, tgl_beli, nama_vendor, uang_keluar, uang_kembalian');
		$this->db->from('tb_transaksi_vendor');
		$this->db->join('tb_barang', 'tb_transaksi_vendor.id_barang = tb_barang.id_barang');
		$this->db->join('tb_vendor', 'tb_transaksi_vendor.id_vendor = tb_vendor.id_vendor');
		$this->db->where('status_transaksi', 0);
		$this->db->where('id_transaksi_vendor', $id_transaksi_vendor);

		return $this->db->get()->result();
	}

	function getDetailRiwayatPemesananSuksesKeVendor($id_transaksi_vendor) {
		$this->db->select('id_transaksi_vendor, nama_merk, warna, ukuran, total_beli, total_harga_beli, tgl_beli, nama_vendor, uang_keluar, uang_kembalian');
		$this->db->from('tb_transaksi_vendor');
		$this->db->join('tb_barang', 'tb_transaksi_vendor.id_barang = tb_barang.id_barang');
		$this->db->join('tb_vendor', 'tb_transaksi_vendor.id_vendor = tb_vendor.id_vendor');
		$this->db->where('status_transaksi', 1);
		$this->db->where('id_transaksi_vendor', $id_transaksi_vendor);

		return $this->db->get()->result();
	}

	function getListRetur() {
		$this->db->select('id_retur, tb_retur.id_transaksi_vendor, tb_transaksi_vendor.id_vendor, nama_vendor,  tb_transaksi_vendor.id_barang, nama_merk, warna, ukuran,  total_beli, tgl_beli, jumlah_retur_barang, status_retur, tanggal_retur, tanggal_selesai_retur, keterangan');
		$this->db->where('status_retur', 0);
		$this->db->join('tb_transaksi_vendor', 'tb_retur.id_transaksi_vendor = tb_transaksi_vendor.id_transaksi_vendor');
		$this->db->join('tb_barang', 'tb_transaksi_vendor.id_barang = tb_barang.id_barang');
		$this->db->join('tb_vendor', 'tb_transaksi_vendor.id_vendor = tb_vendor.id_vendor');

		return $this->db->get('tb_retur')->result();
	}

	function getRiwayatReturBarang() {
		$this->db->select('id_retur, tb_transaksi_vendor.id_vendor, nama_vendor, tb_transaksi_vendor.id_barang, nama_merk, warna, ukuran, tgl_beli, jumlah_retur_barang, status_retur, tanggal_retur, tanggal_selesai_retur, keterangan');
		$this->db->where('status_retur', 1);
		$this->db->join('tb_transaksi_vendor', 'tb_retur.id_transaksi_vendor = tb_transaksi_vendor.id_transaksi_vendor');
		$this->db->join('tb_barang', 'tb_transaksi_vendor.id_barang = tb_barang.id_barang');
		$this->db->join('tb_vendor', 'tb_transaksi_vendor.id_vendor = tb_vendor.id_vendor');

		return $this->db->get('tb_retur')->result();
	}

	function getDetailReturBarang($id) {
		$this->db->select('id_retur, tb_retur.id_transaksi_vendor, tb_transaksi_vendor.id_vendor, nama_vendor, nama_merk, warna, ukuran, stok, tb_transaksi_vendor.id_barang, stok, total_beli, tgl_beli, jumlah_retur_barang, tanggal_retur, tanggal_selesai_retur, keterangan');
		$this->db->where('status_retur', 0);
		$this->db->where('id_retur', $id);
		$this->db->join('tb_transaksi_vendor', 'tb_retur.id_transaksi_vendor = tb_transaksi_vendor.id_transaksi_vendor');
		$this->db->join('tb_barang', 'tb_transaksi_vendor.id_barang = tb_barang.id_barang');
		$this->db->join('tb_vendor', 'tb_transaksi_vendor.id_vendor = tb_vendor.id_vendor');

		return $this->db->get('tb_retur')->result();
	}

	function getDetailRiwayatReturBarang($id) {
		$this->db->select('id_retur, tb_retur.id_transaksi_vendor, tb_transaksi_vendor.id_vendor, nama_vendor, nama_merk, warna, ukuran,  total_beli, tgl_beli, jumlah_retur_barang, tanggal_retur, tanggal_selesai_retur, keterangan');
		$this->db->where('status_retur', 1);
		$this->db->where('id_retur', $id);
		$this->db->join('tb_transaksi_vendor', 'tb_retur.id_transaksi_vendor = tb_transaksi_vendor.id_transaksi_vendor');
		$this->db->join('tb_barang', 'tb_transaksi_vendor.id_barang = tb_barang.id_barang');
		$this->db->join('tb_vendor', 'tb_transaksi_vendor.id_vendor = tb_vendor.id_vendor');

		return $this->db->get('tb_retur')->result();
	}

}