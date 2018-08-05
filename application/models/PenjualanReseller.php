<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
* kelas Model untuk reseller
*/
class PenjualanReseller extends CI_Model
{
	
	function getResellerInfo() {
		$this->db->select('id_reseller, nama_reseller, no_handphone, alamat, email');
		$this->db->from('tb_reseller');
		$this->db->order_by('nama_reseller', 'DSC');

		return $this->db->get()->result();
	}

	function getLastIdTransaksiReseller(){
     $this->db->select('id_transaksi_reseller');
     $this->db->order_by('id_transaksi_reseller', 'DESC');
     $res = $this->db->get('tb_transaksi_reseller');
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

    function getLastIdTransaksiInvoiceReseller(){
    $query = $this->db->query('SELECT id_invoice FROM tb_invoice WHERE SUBSTRING(id_invoice, 1, 10) = "TSRES-INV-" ORDER BY id_invoice DESC LIMIT 1');
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

	function getRiwayatPenjualanReseller() {
		$this->db->select('tb_transaksi_reseller.id_transaksi_reseller, tgl_jual, nama_reseller, jumlah_jual, potongan_harga, total_tagihan, sisa_tagihan');
		$this->db->where('reference_1', $this->session->userdata('kid'));
		$this->db->join('tb_history_invoice', 'tb_transaksi_reseller.id_invoice = tb_history_invoice.id_invoice');
		$this->db->join('tb_reseller', 'tb_transaksi_reseller.id_reseller = tb_reseller.id_reseller');
		$this->db->group_by('tb_history_invoice.id_invoice');

		return $this->db->get('tb_transaksi_reseller')->result();
	}

	function getRiwayatResellerById($id) {
		$this->db->select('tb_transaksi_reseller.id_transaksi_reseller, tgl_jual, jumlah_jual, nama_reseller, tb_reseller.alamat, tb_reseller.no_handphone, email, nama, nama_merk, warna, ukuran, harga_reseller, potongan_harga, uang_kembalian, total_item, total_harga, total_tagihan, pembayaran_tagihan, sisa_tagihan, reference_1');
		$this->db->join('tb_transaksi_reseller_peritem', 'tb_transaksi_reseller.id_transaksi_reseller = tb_transaksi_reseller_peritem.id_transaksi_reseller');
		$this->db->join('tb_reseller', 'tb_transaksi_reseller.id_reseller = tb_reseller.id_reseller');
		$this->db->join('tb_karyawan', 'tb_transaksi_reseller.reference_1 = tb_karyawan.id_karyawan');
		$this->db->join('tb_barang', 'tb_transaksi_reseller_peritem.id_barang = tb_barang.id_barang');
		$this->db->join('tb_history_invoice', 'tb_transaksi_reseller.id_invoice = tb_history_invoice.id_invoice');
		$this->db->where('tb_transaksi_reseller.id_transaksi_reseller', $id);
		$this->db->group_by('tb_transaksi_reseller_peritem.id_barang');

		return $this->db->get('tb_transaksi_reseller')->result();
	}

    function getHistoryPenjualanReseller() {
        $this->db->select('tb_transaksi_reseller.id_transaksi_reseller, tgl_jual, jumlah_jual, total_tagihan, sisa_tagihan, potongan_harga, nama_reseller');
        $this->db->from('tb_transaksi_reseller');
        $this->db->join('tb_reseller', 'tb_reseller.id_reseller = tb_transaksi_reseller.id_reseller');
        $this->db->join('tb_invoice', 'tb_invoice.id_invoice = tb_transaksi_reseller.id_invoice');
        $this->db->join('tb_history_invoice', 'tb_history_invoice.id_invoice = tb_transaksi_reseller.id_invoice');
        $this->db->where('reference_1', $this->session->userdata('kid'));
        $this->db->order_by('tgl_jual', 'DESC');

        return $this->db->get()->result();
    }

    function getHistoryPenjualanResellerPeritem($id)
    {
        $this->db->select('tb_transaksi_reseller.id_transaksi_reseller, nama_merk, warna, ukuran, total_item, potongan_harga, harga_reseller, uang_kembalian, total_tagihan, pembayaran_tagihan, tanggal_pembayaran, sisa_tagihan, nama_reseller, tb_reseller.alamat, tb_reseller.email, tb_reseller.no_handphone, nama, tgl_jual, reference_1');
        $this->db->from('tb_transaksi_reseller');
        $this->db->join('tb_transaksi_reseller_peritem', 'tb_transaksi_reseller_peritem.id_transaksi_reseller = tb_transaksi_reseller.id_transaksi_reseller');
        $this->db->join('tb_barang', 'tb_barang.id_barang = tb_transaksi_reseller_peritem.id_barang');
        $this->db->join('tb_reseller', 'tb_reseller.id_reseller = tb_transaksi_reseller.id_reseller');
        $this->db->join('tb_invoice', 'tb_invoice.id_invoice = tb_transaksi_reseller.id_invoice');
        $this->db->join('tb_history_invoice', 'tb_history_invoice.id_invoice = tb_invoice.id_invoice');
        $this->db->join('tb_karyawan', 'tb_transaksi_reseller.reference_1 = tb_karyawan.id_karyawan');
        $this->db->where('tb_transaksi_reseller.id_transaksi_reseller', $id);

        return $this->db->get()->result();
    }

	function getBarangResell(){
		$this->db->select('id_barang, nama_merk, produk, warna, ukuran, harga_reseller, stok');
		$this->db->where('status', 0);
		$this->db->order_by('produk', 'DSC');
		
		return $this->db->get('tb_barang')->result();
	}

	function insertTransaksiReseller($ar, $invoice, $hisInvoice){
		$this->db->insert('tb_transaksi_reseller',$ar);
		$this->db->insert('tb_invoice', $invoice);
		$this->db->insert('tb_history_invoice', $hisInvoice);
	}

	function insertTransaksiResellPerItem($data){
        $this->db->insert('tb_transaksi_reseller_peritem',$data);
	}

	function invoiceResellerById($id) {
		$this->db->select('tb_transaksi_reseller_peritem.id_transaksi_reseller, tgl_jual, potongan_harga, nama_reseller, tb_reseller.no_handphone, tb_reseller.alamat, tb_reseller.email, total_item, total_harga, nama_merk, warna, ukuran, harga_reseller, total_tagihan, pembayaran_tagihan, sisa_tagihan, nama');
		$this->db->from('tb_transaksi_reseller_peritem');
		$this->db->join('tb_transaksi_reseller', 'tb_transaksi_reseller_peritem.id_transaksi_reseller = tb_transaksi_reseller.id_transaksi_reseller');
		$this->db->join('tb_barang', 'tb_transaksi_reseller_peritem.id_barang = tb_barang.id_barang');
		$this->db->join('tb_history_invoice', 'tb_transaksi_reseller.id_invoice = tb_history_invoice.id_invoice');
		$this->db->join('tb_reseller', 'tb_transaksi_reseller.id_reseller = tb_reseller.id_reseller');
		$this->db->join('tb_karyawan', 'tb_transaksi_reseller.reference_1 = tb_karyawan.id_karyawan');
		$this->db->where('tb_transaksi_reseller_peritem.id_transaksi_reseller', $id);

		return $this->db->get()->result();
	}

}
