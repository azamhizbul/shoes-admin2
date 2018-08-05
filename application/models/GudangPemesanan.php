<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
* kelas Pemesanan bagian Gudang
*/
class GudangPemesanan extends CI_model
{
	function getJumlahPemesanan() {
		$this->db->select('id_transaksi_vendor, id_barang, status_transaksi');
		$this->db->from('tb_transaksi_vendor');
		$this->db->where('status_transaksi', 0);

		return $this->db->get()->result();
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
		$this->db->select('id_transaksi_vendor, tb_transaksi_vendor.id_barang, nama_merk, warna, ukuran, stok, total_beli, pembayaran_tagihan, total_tagihan, sisa_tagihan, tgl_beli, nama_vendor, nama');
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
		$this->db->select('nama_merk, warna, ukuran, total_beli, pembayaran_tagihan, total_tagihan, sisa_tagihan, tgl_beli, nama_vendor, nama');
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

}