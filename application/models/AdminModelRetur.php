<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
* 
*/
class AdminModelRetur extends CI_Model
{
	
	function getReturPending()
	{
		$this->db->select('id_retur, nama_vendor, produk, jumlah_retur_barang, tanggal_retur, keterangan');
		$this->db->where('status_retur', 0);
		$this->db->join('tb_transaksi_vendor', 'tb_retur.id_transaksi_vendor = tb_transaksi_vendor.id_transaksi_vendor');
		$this->db->join('tb_barang', 'tb_transaksi_vendor.id_barang = tb_barang.id_barang');
		$this->db->join('tb_vendor', 'tb_transaksi_vendor.id_vendor = tb_vendor.id_vendor');
		$this->db->order_by('tanggal_retur', 'DSC');

		return $this->db->get('tb_retur')->result();
	}

	function getReturSukses()
	{
		$this->db->select('id_retur, nama_vendor, produk, jumlah_retur_barang, tanggal_retur, tanggal_selesai_retur, keterangan');
		$this->db->where('status_retur', 1);
		$this->db->join('tb_transaksi_vendor', 'tb_retur.id_transaksi_vendor = tb_transaksi_vendor.id_transaksi_vendor');
		$this->db->join('tb_barang', 'tb_transaksi_vendor.id_barang = tb_barang.id_barang');
		$this->db->join('tb_vendor', 'tb_transaksi_vendor.id_vendor = tb_vendor.id_vendor');
		$this->db->order_by('tanggal_retur', 'DSC');

		return $this->db->get('tb_retur')->result();
	}

	function verifikasiReturPemesanan($idRetur, $tglSelesai, $ket, $idBarang, $updateStok) {
		$this->db->set('tanggal_selesai_retur', $tglSelesai);
		$this->db->set('keterangan', $ket);
		$this->db->set('status_retur', 1);
		$this->db->where('id_retur', $idRetur);
		$this->db->update('tb_retur');

		$this->db->set('stok', $updateStok);
		$this->db->where('id_barang', $idBarang);
		$this->db->update('tb_barang');
	}

	function getDetailReturPemesananPending($id) {
		$this->db->select('id_retur, nama_vendor, tb_transaksi_vendor.id_barang, produk, nama_merk, warna, ukuran, stok, tgl_beli, jumlah_retur_barang, tanggal_retur, keterangan');
		$this->db->where('status_retur', 0);
		$this->db->where('id_retur', $id);
		$this->db->join('tb_transaksi_vendor', 'tb_retur.id_transaksi_vendor = tb_transaksi_vendor.id_transaksi_vendor');
		$this->db->join('tb_barang', 'tb_transaksi_vendor.id_barang = tb_barang.id_barang');
		$this->db->join('tb_vendor', 'tb_transaksi_vendor.id_vendor = tb_vendor.id_vendor');

		return $this->db->get('tb_retur')->result();
	}

	function getDetailReturPemesananSukses($id) {
		$this->db->select('id_retur, nama_vendor, nama_merk, warna, ukuran, tgl_beli, jumlah_retur_barang, tanggal_retur, tanggal_selesai_retur, keterangan');
		$this->db->where('status_retur', 1);
		$this->db->where('id_retur', $id);
		$this->db->join('tb_transaksi_vendor', 'tb_retur.id_transaksi_vendor = tb_transaksi_vendor.id_transaksi_vendor');
		$this->db->join('tb_barang', 'tb_transaksi_vendor.id_barang = tb_barang.id_barang');
		$this->db->join('tb_vendor', 'tb_transaksi_vendor.id_vendor = tb_vendor.id_vendor');

		return $this->db->get('tb_retur')->result();
	}
}