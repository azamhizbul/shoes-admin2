<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class PenjualanMerk extends CI_Model
{

function getLastIdTransaksiMerk(){
     $this->db->select('id_transaksi_merk');
     $this->db->order_by('id_transaksi_merk', 'DESC');
     $res = $this->db->get('tb_transaksi_merk');
     $x;

     $arrResult = $res->row();

     if (empty($arrResult)) {
     	$x = 0;
     } else {
     	 foreach ($arrResult as $key) {
     	 $x = $key;
     	}

     }
    return $x;
    }

function getLastIdTransaksiInvoiceMerk(){
    $query = $this->db->query('SELECT id_invoice FROM tb_invoice WHERE SUBSTRING(id_invoice, 1, 10) = "TSMRK-INV-" ORDER BY id_invoice DESC LIMIT 1');

     // $this->db->select('id_invoice');
     // $this->db->order_by('id_invoice', 'DESC');
     // $res = $this->db->get('tb_invoice');
     $x;

     $arrResult = $query->row();

     if (empty($arrResult)) {
     	$x = 0;
     } else {
     	 foreach ($arrResult as $key) {
     	 $x = $key;
     	}

     }
    return $x;
    }

	function getBarangTitipanEnd() {
		$this->db->select('total_beli, tb_transaksi_vendor.id_barang, nama_merk, produk, warna, ukuran, stok, harga_jual_vendor');
		$this->db->join('tb_barang', 'tb_transaksi_vendor.id_barang = tb_barang.id_barang');
		$this->db->where('kepemilikan_barang', 'titipan');
		$this->db->where('status_barang', 1);
		$this->db->where('status', 0);
		$this->db->order_by('produk', 'DSC');
		
		return $this->db->get('tb_transaksi_vendor')->result();
	}

	function insertTransaksiMerk($ar, $invoice, $hisInvoice) {
		$this->db->insert('tb_transaksi_merk', $ar);
		$this->db->insert('tb_invoice', $invoice);
		$this->db->insert('tb_history_invoice', $hisInvoice);
	}

	function insertTransaksiMerkPerItem($data) {
		$this->db->insert('tb_transaksi_merk_per_item', $data);
	}

	function invoiceMerkById($id) {
		$this->db->select('tb_transaksi_merk_per_item.id_transaksi_merk, tgl_jual, potongan_harga, nama_pembeli, tb_transaksi_merk.id_invoice, total_item, total_harga, nama_merk, warna, ukuran, harga_jual_vendor, total_tagihan, pembayaran_tagihan, sisa_tagihan, nama, uang_kembalian');
		$this->db->from('tb_transaksi_merk_per_item');
		$this->db->join('tb_transaksi_merk', 'tb_transaksi_merk_per_item.id_transaksi_merk = tb_transaksi_merk.id_transaksi_merk');
		$this->db->join('tb_barang', 'tb_transaksi_merk_per_item.id_barang = tb_barang.id_barang');
		$this->db->join('tb_history_invoice', 'tb_transaksi_merk.id_invoice = tb_history_invoice.id_invoice');
		$this->db->join('tb_karyawan', 'tb_transaksi_merk.referensi_1 = tb_karyawan.id_karyawan');
		$this->db->where('tb_transaksi_merk_per_item.id_transaksi_merk', $id);

		return $this->db->get()->result();
	}

	function riwayatTransaksiMerk() {
		$this->db->select('tb_transaksi_merk_per_item.id_transaksi_merk, tgl_jual, nama_pembeli, jumlah_jual, total_tagihan, potongan_harga, sisa_tagihan');
		$this->db->join('tb_transaksi_merk', 'tb_transaksi_merk_per_item.id_transaksi_merk = tb_transaksi_merk.id_transaksi_merk');
		$this->db->join('tb_history_invoice', 'tb_transaksi_merk.id_invoice = tb_history_invoice.id_invoice');
		$this->db->where('referensi_1', $this->session->userdata('kid'));
		$this->db->order_by('tgl_jual', 'DSC');

		return $this->db->get('tb_transaksi_merk_per_item')->result();
	}

}