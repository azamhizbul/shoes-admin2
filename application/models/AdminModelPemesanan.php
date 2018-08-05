<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
* 
*/
class AdminModelPemesanan extends CI_Model
{

	function getBarang() {
		$this->db->select('id_barang, nama_merk, produk, warna, ukuran, harga');
		$this->db->from('tb_barang');
		$this->db->order_by('produk', 'asc');
		$this->db->where('kepemilikan_barang', 'titipan');
		$this->db->where('status', 0);

		return $this->db->get()->result();
	}

	function getBarangById($id) {
		$this->db->select('id_barang, nama_merk, produk, warna, ukuran, harga');
		$this->db->from('tb_barang');
		$this->db->where('id_barang', $id);

		return $this->db->get()->result();
	}

	function getVendor(){
		$this->db->select('id_vendor, nama_vendor');
		$this->db->from('tb_vendor');
		$this->db->order_by('nama_vendor', 'asc');

		return $this->db->get()->result();
	}

	function insertPemesanan($data, $invoice, $hisinvoice) {
		$this->db->insert('tb_transaksi_vendor', $data);
		$this->db->insert('tb_invoice', $invoice);
		$this->db->insert('tb_history_invoice', $hisinvoice);
	}
	
	function getPemesanan()
	{
		$this->db->select('id_transaksi_vendor, produk, total_beli, total_tagihan, sisa_tagihan, tgl_beli');
		$this->db->join('tb_barang', 'tb_transaksi_vendor.id_barang = tb_barang.id_barang');
		$this->db->join('tb_invoice', 'tb_transaksi_vendor.id_invoice = tb_invoice.id_invoice');
		$this->db->join('tb_history_invoice', 'tb_invoice.id_invoice = tb_history_invoice.id_invoice');
		$this->db->where('status_barang', 0);
		$this->db->order_by('tgl_beli', 'DESC');

		return $this->db->get('tb_transaksi_vendor')->result();
	}

	function getDetailPemesananById($id)
	{
		$this->db->select('id_transaksi_vendor, tb_transaksi_vendor.id_barang, stok, nama_merk, warna, ukuran, total_beli, pembayaran_tagihan, total_tagihan, uang_kembalian, sisa_tagihan, tgl_beli, nama_vendor, nama');
		$this->db->join('tb_barang', 'tb_transaksi_vendor.id_barang = tb_barang.id_barang');
		$this->db->join('tb_invoice', 'tb_transaksi_vendor.id_invoice = tb_invoice.id_invoice');
		$this->db->join('tb_history_invoice', 'tb_invoice.id_invoice = tb_history_invoice.id_invoice');
		$this->db->join('tb_karyawan', 'tb_transaksi_vendor.reference_2 = tb_karyawan.id_karyawan');
		$this->db->join('tb_vendor', 'tb_transaksi_vendor.id_vendor = tb_vendor.id_vendor');
		$this->db->where('id_transaksi_vendor', $id);

		return $this->db->get('tb_transaksi_vendor')->result();
	}

	function getPemesananSukses() {
		$this->db->select('tb_transaksi_vendor.id_transaksi_vendor, produk, total_beli, total_tagihan, sisa_tagihan, tgl_beli');
		$this->db->join('tb_barang', 'tb_transaksi_vendor.id_barang = tb_barang.id_barang');
		$this->db->join('tb_invoice', 'tb_transaksi_vendor.id_invoice = tb_invoice.id_invoice');
		$this->db->join('tb_history_invoice', 'tb_invoice.id_invoice = tb_history_invoice.id_invoice');
		$this->db->where('status_barang', 1);
		$this->db->order_by('tgl_beli', 'DESC');

		return $this->db->get('tb_transaksi_vendor')->result();
	}

	function getDetailPemesananSuksesById($id) {
		$this->db->select('id_transaksi_vendor, tb_transaksi_vendor.id_barang, stok, nama_merk, warna, ukuran, total_beli, pembayaran_tagihan, total_tagihan, uang_kembalian, sisa_tagihan, tgl_beli, nama_vendor, nama');
		$this->db->join('tb_barang', 'tb_transaksi_vendor.id_barang = tb_barang.id_barang');
		$this->db->join('tb_invoice', 'tb_transaksi_vendor.id_invoice = tb_invoice.id_invoice');
		$this->db->join('tb_history_invoice', 'tb_invoice.id_invoice = tb_history_invoice.id_invoice');
		$this->db->join('tb_karyawan', 'tb_transaksi_vendor.reference_2 = tb_karyawan.id_karyawan');
		$this->db->join('tb_vendor', 'tb_transaksi_vendor.id_vendor = tb_vendor.id_vendor');
		$this->db->where('id_transaksi_vendor', $id);

		return $this->db->get('tb_transaksi_vendor')->result();
	}

	function getPemesananRetur($id) {
		$this->db->select('id_transaksi_vendor, tb_transaksi_vendor.id_barang, nama_merk, produk, stok, total_beli, tgl_beli, tb_transaksi_vendor.id_vendor, nama_vendor, status_transaksi');
		$this->db->join('tb_barang', 'tb_transaksi_vendor.id_barang = tb_barang.id_barang');
		$this->db->join('tb_vendor', 'tb_transaksi_vendor.id_vendor = tb_vendor.id_vendor');
		$this->db->where('id_transaksi_vendor', $id);

		return $this->db->get('tb_transaksi_vendor')->result();
	}

	function verifikasiPemesananKeVendor($idTransaksi, $idBarang, $stok) {
		$this->db->set('status_barang', 1);
		$this->db->where('id_transaksi_vendor', $idTransaksi);
		$this->db->update('tb_transaksi_vendor');

		$this->db->set('stok', $stok);
		$this->db->where('id_barang', $idBarang);
		$this->db->update('tb_barang');
	}

	function insertReturPemesanan($data, $idBarang, $updateStok) {
		$this->db->insert('tb_retur', $data);

		$this->db->set('stok', $updateStok);
		$this->db->where('id_barang', $idBarang);
		$this->db->update('tb_barang');
	}


}