<?php 

/**
* kelas Untuk pengelolaan Stok Barang
*/
class GudangStokBarang extends CI_Model
{
	
	function getStokBarang() {
		$this->db->select('id_barang, nama_merk, jenis_sepatu, warna, ukuran, stok');
		$this->db->from('tb_barang');
		$this->db->where('kepemilikan_barang', 'pribadi');
		$this->db->where('status', 0);
		$this->db->order_by('nama_merk', 'DSC');

		return $this->db->get()->result();
	}

	function getVendor() {
		$this->db->select('id_vendor, nama_vendor');
		return $this->db->get('tb_vendor')->result();
	}

	function detailBarang($id_barang) {
		$this->db->select('id_barang, nama_merk, jenis_sepatu, warna, ukuran, stok, harga, harga_end_user, harga_reseller, kepemilikan_barang, harga_packing');
		$this->db->from('tb_barang');
		$this->db->where('id_barang', $id_barang);

		return $this->db->get()->result();
	}

	function insertBarang($id, $updateStok, $data) {
		$this->db->SET('stok', $updateStok);
		$this->db->where('id_barang', $id);
		$this->db->update('tb_barang');

		$this->db->insert('tb_transaksi_vendor', $data);
	}

	function riwayatTambahStok() {
		$this->db->select('id_transaksi_vendor, tgl_beli, total_beli, produk, nama_vendor, nama');
		$this->db->join('tb_barang', 'tb_transaksi_vendor.id_barang = tb_barang.id_barang');
		$this->db->join('tb_vendor', 'tb_transaksi_vendor.id_vendor = tb_vendor.id_vendor');
		$this->db->join('tb_karyawan', 'tb_transaksi_vendor.reference_1 = tb_karyawan.id_karyawan');
		$this->db->where('status_barang', 1);
		$this->db->where('status_transaksi', 1);
		$this->db->where('tb_barang.kepemilikan_barang', 'pribadi');
		$this->db->where('reference_1', $this->session->userdata('kid'));
		$this->db->order_by('tgl_beli', 'dsc');

		return $this->db->get('tb_transaksi_vendor')->result();
	}

	function detailRiwayatTambahStok($id) {
		$this->db->select('tgl_beli, total_beli, nama_merk, jenis_sepatu, warna, ukuran, kepemilikan_barang, nama_vendor, nama');
		$this->db->where('id_transaksi_vendor', $id);
		$this->db->join('tb_barang', 'tb_transaksi_vendor.id_barang = tb_barang.id_barang');
		$this->db->join('tb_vendor', 'tb_transaksi_vendor.id_vendor = tb_vendor.id_vendor');
		$this->db->join('tb_karyawan', 'tb_transaksi_vendor.reference_1 = tb_karyawan.id_karyawan');
		
		return $this->db->get('tb_transaksi_vendor')->result();
	}
}

 ?>