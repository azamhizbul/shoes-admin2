<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
* 
*/
class PenjualanEndCustomer extends CI_Model
{

	protected $getID;

	function __construct() {
		 $this->getID = "CODE-".date("YmdHis");
	}

	function getLastIdTransaksi(){
     $this->db->select('id_transaksi_end_user');
     $this->db->order_by('id_transaksi_end_user', 'DESC');
     $res = $this->db->get('tb_transaksi_end_user');
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

	function riwayatPenjualanEndUser() {
		$this->db->select('id_transaksi_end_user, tgl_jual, nama_pembeli, jumlah_jual, potongan_harga');
		$this->db->where('reference_1', $this->session->userdata('kid'));
		$this->db->order_by('tgl_jual', 'DESC');

		return $this->db->get('tb_transaksi_end_user')->result();
	}

	function getDetailPenjualanPerItem($id_transaksi_end_user) {
		$this->db->select('tb_transaksi_end_user_peritem.id_transaksi_end_user, nama_merk, produk, warna, ukuran, harga_end_user, nama_pembeli, total_item, total_harga, jumlah_jual, harga_jual, tgl_jual, potongan_harga, uang_diterima, uang_kembalian, nama');
		$this->db->from('tb_transaksi_end_user_peritem');
		$this->db->join('tb_barang', 'tb_transaksi_end_user_peritem.id_barang = tb_barang.id_barang');
		$this->db->join('tb_transaksi_end_user', 'tb_transaksi_end_user_peritem.id_transaksi_end_user = tb_transaksi_end_user.id_transaksi_end_user');
		$this->db->join('tb_karyawan', 'tb_transaksi_end_user.reference_1 = tb_karyawan.id_karyawan');
		$this->db->where('tb_transaksi_end_user_peritem.id_transaksi_end_user', $id_transaksi_end_user);

		return $this->db->get()->result();
	}

	function getBarangEnd() {
		$this->db->select('id_barang, nama_merk, produk, warna, ukuran, harga_end_user, stok');
		$this->db->where('status', 0);
		$this->db->order_by('produk', 'DSC');
		
		return $this->db->get('tb_barang')->result();
	}

	function saveTransaksiEndCustomer($ar) {
		$this->db->insert('tb_transaksi_end_user', $ar);
	}

	function saveTransaksiEndPerItem($data) {
		$this->db->insert('tb_transaksi_end_user_peritem',$data);
    }

}
