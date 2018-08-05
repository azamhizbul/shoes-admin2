<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminModelBarang extends CI_Model {

	function getBarang() {
		$this->db->where('status', 0);
		$this->db->where('kepemilikan_barang','Pribadi');
		$this->db->order_by('id_barang', 'DESC');

		$query = $this->db->get('tb_barang'); 
		return $query->result();
	}

	function getBarangTitipan() {
		$this->db->where('status', 0);
		$this->db->where('kepemilikan_barang','Titipan');
		$this->db->order_by('id_barang', 'DESC');

		$query = $this->db->get('tb_barang'); 
		return $query->result();
	}

	function getVendor() {
		$this->db->select('id_vendor, nama_vendor');
		return $this->db->get('tb_vendor')->result();
	}

	function editBarang(){
		$this->db->where('id_barang', $this->input->post('id'));
    	return $this->db->get('tb_barang')->result();
	}

	function insertBarang(){
		$x = $this->input->post('HargaPembuatanPost');
		$Y = str_replace(".", "", $x);

		$x1 = $this->input->post('HargaEndPost');
		$Y1 = str_replace(".", "", $x1);

		$x2 = $this->input->post('HargaResellPost');
		$Y2 = str_replace(".", "", $x2);

		$ar['nama_merk'] = $this->input->post('NamaMerkPost');
		$ar['produk'] = $this->input->post('NamaMerkPost')."-".$this->input->post('WarnaPost')."-".$this->input->post('UkuranPost');
		$ar['jenis_sepatu'] = $this->input->post('JenisSepatuPost');
		$ar['warna'] = $this->input->post('WarnaPost');
		$ar['ukuran'] = $this->input->post('UkuranPost');
		$ar['harga'] = $Y;

		$ar['harga_end_user'] = $Y1;
		$ar['harga_reseller'] = $Y2;
		$ar['kepemilikan_barang'] = "Pribadi";
		
		//var_dump($ar);
		$this->db->insert('tb_barang', $ar);
	}

	function insertBarangTitipan(){
		$x = $this->input->post('HargaPembuatanPost');
		$Y = str_replace(".", "", $x);

		$x1 = $this->input->post('HargaEndPost');
		$Y1 = str_replace(".", "", $x1);

		$x2 = $this->input->post('HargaResellPost');
		$Y2 = str_replace(".", "", $x2);

		$x3 = $this->input->post('HargaPackingPost');
		$Y3 = str_replace(".", "", $x3);

		$x4 = $this->input->post('HargaJualVemdorPost');
		$Y4 = str_replace(".", "", $x4);

		$ar['nama_merk'] = $this->input->post('NamaMerkPost');
		$ar['produk'] = $this->input->post('NamaMerkPost')."-".$this->input->post('WarnaPost')."-".$this->input->post('UkuranPost');
		$ar['jenis_sepatu'] = $this->input->post('JenisSepatuPost');
		$ar['warna'] = $this->input->post('WarnaPost');
		$ar['ukuran'] = $this->input->post('UkuranPost');
		$ar['harga'] = $Y;
		$ar['harga_end_user'] = $Y1;
		$ar['harga_reseller'] = $Y2;
		$ar['harga_packing'] = $Y3;
		$ar['harga_jual_vendor'] = $Y4;
		$ar['kepemilikan_barang'] = "Titipan";
		$this->db->insert('tb_barang', $ar);
	}
	
	function updateBarang(){
		$x = $this->input->post('HargaPembuatan');
		$Y = str_replace(".", "", $x);

		$x1 = $this->input->post('HargaEnd');
		$Y1 = str_replace(".", "", $x1);

		$x2 = $this->input->post('HargaResell');
		$Y2 = str_replace(".", "", $x2);

		$ar['nama_merk'] = $this->input->post('NamaMerk');
		$ar['produk'] = $this->input->post('NamaMerk')."-".$this->input->post('Warna')."-".$this->input->post('Ukuran');
		$ar['jenis_sepatu'] = $this->input->post('JenisSepatu');
		$ar['warna'] = $this->input->post('Warna');
		$ar['ukuran'] = $this->input->post('Ukuran');
		$ar['harga'] = $Y;
		$ar['harga_end_user'] = $Y1;
		$ar['harga_reseller'] = $Y2;
		$this->db->set($ar);
		$this->db->where('id_barang',$this->input->post('idBarang'));
		$this->db->update('tb_barang');
	}

	function updateBarangTitipan(){
		$x = $this->input->post('HargaPembuatan');
		$Y = str_replace(".", "", $x);

		$x1 = $this->input->post('HargaEnd');
		$Y1 = str_replace(".", "", $x1);

		$x2 = $this->input->post('HargaResell');
		$Y2 = str_replace(".", "", $x2);

		$x3 = $this->input->post('HargaPacking');
		$Y3 = str_replace(".", "", $x3);

		$x4 = $this->input->post('HargaVendor');
		$Y4 = str_replace(".", "", $x4);

		$ar['nama_merk'] = $this->input->post('NamaMerk');
		$ar['produk'] = $this->input->post('NamaMerk')."-".$this->input->post('Warna')."-".$this->input->post('Ukuran');
		$ar['jenis_sepatu'] = $this->input->post('JenisSepatu');
		$ar['warna'] = $this->input->post('Warna');
		$ar['ukuran'] = $this->input->post('Ukuran');
		$ar['harga'] = $Y;
		$ar['harga_end_user'] = $Y1;
		$ar['harga_reseller'] = $Y2;
		$ar['harga_jual_vendor'] = $Y4;
		$ar['harga_packing'] = $Y3;
		$this->db->set($ar);
		$this->db->where('id_barang',$this->input->post('idBarang'));
		$this->db->update('tb_barang');
	}

	function deleteBarang($id){
		$ar['status'] = 1;
		$this->db->set($ar);
		$this->db->where('id_barang',$id);
		$this->db->update('tb_barang');

	}

	function getReturBarang() {
		$this->db->select('id_retur, tb_retur.id_transaksi_vendor, tb_transaksi_vendor.id_vendor, nama_vendor,  tb_transaksi_vendor.id_barang, nama_merk, warna, ukuran,  total_beli, tgl_beli, jumlah_retur_barang, status_retur, tanggal_retur, tanggal_selesai_retur, keterangan');
		$this->db->join('tb_transaksi_vendor', 'tb_retur.id_transaksi_vendor = tb_transaksi_vendor.id_transaksi_vendor');
		$this->db->join('tb_barang', 'tb_transaksi_vendor.id_barang = tb_barang.id_barang');
		$this->db->join('tb_vendor', 'tb_transaksi_vendor.id_vendor = tb_vendor.id_vendor');

		return $this->db->get('tb_retur')->result();
	}

	function getDetailReturBarang($id) {
		$this->db->select('id_retur, tb_retur.id_transaksi_vendor, tb_transaksi_vendor.id_vendor, nama_vendor, nama_merk, warna, ukuran, stok, tb_transaksi_vendor.id_barang, stok, total_beli, tgl_beli, jumlah_retur_barang, tanggal_retur, tanggal_selesai_retur, keterangan');
		$this->db->where('id_retur', $id);
		$this->db->join('tb_transaksi_vendor', 'tb_retur.id_transaksi_vendor = tb_transaksi_vendor.id_transaksi_vendor');
		$this->db->join('tb_barang', 'tb_transaksi_vendor.id_barang = tb_barang.id_barang');
		$this->db->join('tb_vendor', 'tb_transaksi_vendor.id_vendor = tb_vendor.id_vendor');

		return $this->db->get('tb_retur')->result();
	}

	function updateStok($id, $updateStok, $data) {
		$this->db->set('stok', $updateStok);
		$this->db->where('id_barang', $id);
		$this->db->update('tb_barang');

		$this->db->insert('tb_transaksi_vendor', $data);
	}
	
	function riwayatTambahStokPribadiAdmin() {
		$this->db->select('id_transaksi_vendor, tgl_beli, total_beli, produk, nama_vendor, nama');
		$this->db->join('tb_barang', 'tb_transaksi_vendor.id_barang = tb_barang.id_barang');
		$this->db->join('tb_vendor', 'tb_transaksi_vendor.id_vendor = tb_vendor.id_vendor');
		$this->db->join('tb_karyawan', 'tb_transaksi_vendor.reference_2 = tb_karyawan.id_karyawan');
		$this->db->where('status_barang', 1);
		$this->db->where('status_transaksi', 1);
		$this->db->where('tb_barang.kepemilikan_barang', 'pribadi');
		$this->db->order_by('tgl_beli', 'DSC');

		return $this->db->get('tb_transaksi_vendor')->result();
	}

	function riwayatTambahStokPribadiGudang() {
		$this->db->select('id_transaksi_vendor, tgl_beli, total_beli, produk, nama_vendor, nama');
		$this->db->join('tb_barang', 'tb_transaksi_vendor.id_barang = tb_barang.id_barang');
		$this->db->join('tb_vendor', 'tb_transaksi_vendor.id_vendor = tb_vendor.id_vendor');
		$this->db->join('tb_karyawan', 'tb_transaksi_vendor.reference_1 = tb_karyawan.id_karyawan');
		$this->db->where('status_barang', 1);
		$this->db->where('status_transaksi', 1);
		$this->db->where('tb_barang.kepemilikan_barang', 'pribadi');
		$this->db->order_by('tgl_beli', 'DSC');

		return $this->db->get('tb_transaksi_vendor')->result();
	}

	function detailRiwayatTambahStokPribadiAdmin($id) {
		$this->db->select('tgl_beli, total_beli, nama_merk, jenis_sepatu, warna, ukuran, kepemilikan_barang, nama_vendor, nama');
		$this->db->join('tb_barang', 'tb_transaksi_vendor.id_barang = tb_barang.id_barang');
		$this->db->join('tb_vendor', 'tb_transaksi_vendor.id_vendor = tb_vendor.id_vendor');
		$this->db->join('tb_karyawan', 'tb_transaksi_vendor.reference_2 = tb_karyawan.id_karyawan');
		$this->db->where('id_transaksi_vendor', $id);

		return $this->db->get('tb_transaksi_vendor')->result();
	}

	function detailRiwayatTambahStokPribadiGudang($id) {
		$this->db->select('tgl_beli, total_beli, nama_merk, jenis_sepatu, warna, ukuran, kepemilikan_barang, nama_vendor, nama');
		$this->db->join('tb_barang', 'tb_transaksi_vendor.id_barang = tb_barang.id_barang');
		$this->db->join('tb_vendor', 'tb_transaksi_vendor.id_vendor = tb_vendor.id_vendor');
		$this->db->join('tb_karyawan', 'tb_transaksi_vendor.reference_1 = tb_karyawan.id_karyawan');
		$this->db->where('id_transaksi_vendor', $id);

		return $this->db->get('tb_transaksi_vendor')->result();
	}
}

/* End of file ModelBarang.php */
/* Location: ./application/models/AdminModel/ModelBarang.php */