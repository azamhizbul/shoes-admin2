<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
* 
*/
class AdminModelPenjualan extends CI_Model
{

	function getBarangEnd() {
		$this->db->select('id_barang, nama_merk, produk, warna, ukuran, harga_end_user, stok');
		$this->db->where('status', 0);
		$this->db->order_by('produk', 'ASC');
		
		return $this->db->get('tb_barang')->result();
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

    function getLastIdTransaksiInvoiceReseller(){
    $query = $this->db->query('SELECT id_invoice FROM tb_invoice WHERE SUBSTRING(id_invoice, 1, 10) = "TSRES-INV-" ORDER BY id_invoice DESC LIMIT 1');

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

	function saveTransaksiEndCustomer($ar) {
		$this->db->insert('tb_transaksi_end_user', $ar);
	}

	function saveTransaksiEndPerItem($data) {
		$this->db->insert('tb_transaksi_end_user_peritem',$data);
    }

    function riwayatPenjualanEndUserAdmin() {
		$this->db->select('id_transaksi_end_user, tgl_jual, nama_pembeli, jumlah_jual, potongan_harga, nama');
		$this->db->join('tb_karyawan', 'tb_transaksi_end_user.reference_2 = tb_karyawan.id_karyawan');
		$this->db->where('reference_1', 0);
		$this->db->order_by('id_transaksi_end_user', 'DESC');

		return $this->db->get('tb_transaksi_end_user')->result();
	}

	function riwayatPenjualanEndUserKasir() {
		$this->db->select('id_transaksi_end_user, tgl_jual, nama_pembeli, jumlah_jual, potongan_harga, nama');
		$this->db->join('tb_karyawan', 'tb_transaksi_end_user.reference_1 = tb_karyawan.id_karyawan');
		$this->db->where('reference_2', 0);
		$this->db->order_by('id_transaksi_end_user', 'DESC');

		return $this->db->get('tb_transaksi_end_user')->result();
	}

	function getDetailPenjualanPerItemAdmin($id_transaksi_end_user) {
		$this->db->select('tb_transaksi_end_user_peritem.id_transaksi_end_user, nama_merk, produk, warna, ukuran, harga_end_user, nama_pembeli, total_item, total_harga, jumlah_jual, harga_jual, tgl_jual, potongan_harga, uang_diterima, uang_kembalian, nama, reference_1');
		$this->db->from('tb_transaksi_end_user');
		$this->db->join('tb_transaksi_end_user_peritem', 'tb_transaksi_end_user.id_transaksi_end_user = tb_transaksi_end_user_peritem.id_transaksi_end_user');
		$this->db->join('tb_barang', 'tb_transaksi_end_user_peritem.id_barang = tb_barang.id_barang');
		$this->db->join('tb_karyawan', 'tb_transaksi_end_user.reference_2 = tb_karyawan.id_karyawan');
		$this->db->where('tb_transaksi_end_user.id_transaksi_end_user', $id_transaksi_end_user);

		return $this->db->get()->result();
	}

	function getDetailPenjualanPerItemKasir($id_transaksi_end_user) {
		$this->db->select('tb_transaksi_end_user_peritem.id_transaksi_end_user, nama_merk, produk, warna, ukuran, harga_end_user, nama_pembeli, total_item, total_harga, jumlah_jual, harga_jual, tgl_jual, potongan_harga, uang_diterima, uang_kembalian, nama, reference_1');
		$this->db->from('tb_transaksi_end_user');
		$this->db->join('tb_transaksi_end_user_peritem', 'tb_transaksi_end_user.id_transaksi_end_user = tb_transaksi_end_user_peritem.id_transaksi_end_user');
		$this->db->join('tb_barang', 'tb_transaksi_end_user_peritem.id_barang = tb_barang.id_barang');
		$this->db->join('tb_karyawan', 'tb_transaksi_end_user.reference_1 = tb_karyawan.id_karyawan');
		$this->db->where('tb_transaksi_end_user.id_transaksi_end_user', $id_transaksi_end_user);

		return $this->db->get()->result();
	}

	function getResellerInfo() {
		$this->db->select('id_reseller, nama_reseller, no_handphone, alamat, email');
		$this->db->from('tb_reseller');
		$this->db->order_by('nama_reseller', 'ASC');

		return $this->db->get()->result();
	}

	function getBarangResell(){
		$this->db->select('id_barang, nama_merk, produk, warna, ukuran, harga_reseller, stok');
		$this->db->where('status', 0);
		$this->db->order_by('produk', 'ASC');
		
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

	function getHistoryPenjualanResellerAdmin() {
        $query = $this->db->query("SELECT tb_transaksi_reseller.id_transaksi_reseller, tgl_jual, jumlah_jual, total_tagihan, MIN(sisa_tagihan) as sisa_tagihan, potongan_harga, nama_reseller
                                    FROM tb_transaksi_reseller
                                    JOIN tb_reseller ON tb_reseller.id_reseller = tb_transaksi_reseller.id_reseller
                                    JOIN tb_invoice ON tb_invoice.id_invoice = tb_transaksi_reseller.id_invoice
                                    JOIN tb_history_invoice ON tb_history_invoice.id_invoice = tb_transaksi_reseller.id_invoice
                                    WHERE reference_1 = 0
                                    GROUP BY `tb_transaksi_reseller`.`id_transaksi_reseller`
                                    ORDER BY id_transaksi_reseller DESC")->result();
        return $query;
	}

	function getHistoryPenjualanResellerKasir() {
        $query = $this->db->query("SELECT tb_transaksi_reseller.id_transaksi_reseller, tgl_jual, jumlah_jual, total_tagihan, MIN(sisa_tagihan) as sisa_tagihan, potongan_harga, nama_reseller
                                    FROM tb_transaksi_reseller
                                    JOIN tb_reseller ON tb_reseller.id_reseller = tb_transaksi_reseller.id_reseller
                                    JOIN tb_invoice ON tb_invoice.id_invoice = tb_transaksi_reseller.id_invoice
                                    JOIN tb_history_invoice ON tb_history_invoice.id_invoice = tb_transaksi_reseller.id_invoice
                                    WHERE reference_2 = 0
                                    GROUP BY `tb_transaksi_reseller`.`id_transaksi_reseller`
                                    ORDER BY tgl_jual DESC")->result();
        return $query;
	}

	function getRiwayatPenjualanResellerAdmin() {
		$this->db->select('tb_transaksi_reseller.id_transaksi_reseller, tgl_jual, nama_reseller, jumlah_jual, potongan_harga, total_tagihan, sisa_tagihan');
		$this->db->where('reference_1', 0);
		$this->db->join('tb_history_invoice', 'tb_transaksi_reseller.id_invoice = tb_history_invoice.id_invoice');
		$this->db->join('tb_reseller', 'tb_transaksi_reseller.id_reseller = tb_reseller.id_reseller');
		$this->db->group_by('tb_history_invoice.id_invoice');

		return $this->db->get('tb_transaksi_reseller')->result();
	}

	function getRiwayatPenjualanResellerKasir() {
		$this->db->select('tb_transaksi_reseller.id_transaksi_reseller, tgl_jual, nama_reseller, jumlah_jual, potongan_harga, total_tagihan, sisa_tagihan');
		$this->db->where('reference_2', 0);
		$this->db->join('tb_history_invoice', 'tb_transaksi_reseller.id_invoice = tb_history_invoice.id_invoice');
		$this->db->join('tb_reseller', 'tb_transaksi_reseller.id_reseller = tb_reseller.id_reseller');
		$this->db->group_by('tb_history_invoice.id_invoice');

		return $this->db->get('tb_transaksi_reseller')->result();
	}

	function getRiwayatResellerAdminById($id) {
		$this->db->select('tb_transaksi_reseller.id_transaksi_reseller, tgl_jual, jumlah_jual, nama_reseller, tb_reseller.alamat, tb_reseller.no_handphone, email, nama, nama_merk, warna, ukuran, harga_reseller, potongan_harga, uang_kembalian, total_item, total_harga, total_tagihan, pembayaran_tagihan, sisa_tagihan, reference_1');
		$this->db->join('tb_transaksi_reseller_peritem', 'tb_transaksi_reseller.id_transaksi_reseller = tb_transaksi_reseller_peritem.id_transaksi_reseller');
		$this->db->join('tb_reseller', 'tb_transaksi_reseller.id_reseller = tb_reseller.id_reseller');
		$this->db->join('tb_karyawan', 'tb_transaksi_reseller.reference_2 = tb_karyawan.id_karyawan');
		$this->db->join('tb_barang', 'tb_transaksi_reseller_peritem.id_barang = tb_barang.id_barang');
		$this->db->join('tb_history_invoice', 'tb_transaksi_reseller.id_invoice = tb_history_invoice.id_invoice');
		$this->db->where('tb_transaksi_reseller.id_transaksi_reseller', $id);
		$this->db->group_by('tb_transaksi_reseller_peritem.id_barang');

		return $this->db->get('tb_transaksi_reseller')->result();
	}

	function getRiwayatResellerKasirById($id) {
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

	function getHistoryPenjualanResellerPeritemAdmin($id)
	{
        $query = $this->db->query("SELECT tb_transaksi_reseller.id_transaksi_reseller, nama_merk, warna, ukuran, total_item, potongan_harga, harga_reseller, uang_kembalian, MAX(total_tagihan) AS total_tagihan, SUM(pembayaran_tagihan) AS pembayaran_tagihan, tanggal_pembayaran, MIN(sisa_tagihan) AS sisa_tagihan, nama_reseller, tb_reseller.alamat, tb_reseller.email, tb_reseller.no_handphone, nama, tgl_jual, reference_1
                                        FROM tb_transaksi_reseller
                                        JOIN tb_transaksi_reseller_peritem ON tb_transaksi_reseller.id_transaksi_reseller = tb_transaksi_reseller_peritem.id_transaksi_reseller
                                        JOIN tb_barang ON tb_barang.id_barang = tb_transaksi_reseller_peritem.id_barang
                                        JOIN tb_reseller ON tb_reseller.id_reseller = tb_transaksi_reseller.id_reseller
                                        JOIN tb_invoice ON tb_invoice.id_invoice = tb_transaksi_reseller.id_invoice
                                        JOIN tb_history_invoice ON tb_history_invoice.id_invoice = tb_invoice.id_invoice
                                        JOIN tb_karyawan ON tb_transaksi_reseller.reference_2 = tb_karyawan.id_karyawan
                                        WHERE tb_transaksi_reseller.id_transaksi_reseller = '$id'
                                        GROUP BY `tb_transaksi_reseller`.`id_transaksi_reseller`")->result();
        return $query;
	}

	function getHistoryPenjualanResellerPeritemKasir($id)
	{
        $query = $this->db->query("SELECT tb_transaksi_reseller.id_transaksi_reseller, nama_merk, warna, ukuran, total_item, potongan_harga, harga_reseller, uang_kembalian, MAX(total_tagihan) AS total_tagihan, SUM(pembayaran_tagihan) AS pembayaran_tagihan, tanggal_pembayaran, MIN(sisa_tagihan) AS sisa_tagihan, nama_reseller, tb_reseller.alamat, tb_reseller.email, tb_reseller.no_handphone, nama, tgl_jual, reference_1
                                        FROM tb_transaksi_reseller
                                        JOIN tb_transaksi_reseller_peritem ON tb_transaksi_reseller.id_transaksi_reseller = tb_transaksi_reseller_peritem.id_transaksi_reseller
                                        JOIN tb_barang ON tb_barang.id_barang = tb_transaksi_reseller_peritem.id_barang
                                        JOIN tb_reseller ON tb_reseller.id_reseller = tb_transaksi_reseller.id_reseller
                                        JOIN tb_invoice ON tb_invoice.id_invoice = tb_transaksi_reseller.id_invoice
                                        JOIN tb_history_invoice ON tb_history_invoice.id_invoice = tb_invoice.id_invoice
                                        JOIN tb_karyawan ON tb_transaksi_reseller.reference_1 = tb_karyawan.id_karyawan
                                        WHERE tb_transaksi_reseller.id_transaksi_reseller = '$id'
                                        GROUP BY `tb_transaksi_reseller`.`id_transaksi_reseller`")->result();
        return $query;
	}

	function getBarangTitipanEnd() {
		$this->db->select('id_barang, nama_merk, produk, warna, ukuran, stok, harga_jual_vendor');
		$this->db->where('kepemilikan_barang', 'titipan');
		$this->db->where('status', 0);
		$this->db->order_by('produk', 'ASC');
		
		return $this->db->get('tb_barang')->result();
	}

	function insertTransaksiMerk($ar, $invoice, $hisInvoice) {
		$this->db->insert('tb_transaksi_merk', $ar);
		$this->db->insert('tb_invoice', $invoice);
		$this->db->insert('tb_history_invoice', $hisInvoice);
	}

	function insertTransaksiMerkPerItem($data) {
		$this->db->insert('tb_transaksi_merk_per_item', $data);
	}

	function getDetailPenjualanMerkPerItemAdmin($id) {
		$this->db->select('tb_transaksi_merk_per_item.id_transaksi_merk, tgl_jual, potongan_harga, nama_pembeli, tb_transaksi_merk.id_invoice, total_item, total_harga, nama_merk, warna, ukuran, harga_jual_vendor, total_tagihan, pembayaran_tagihan, sisa_tagihan, nama, referensi_1, uang_kembalian');
		$this->db->from('tb_transaksi_merk_per_item');
		$this->db->join('tb_transaksi_merk', 'tb_transaksi_merk_per_item.id_transaksi_merk = tb_transaksi_merk.id_transaksi_merk');
		$this->db->join('tb_barang', 'tb_transaksi_merk_per_item.id_barang = tb_barang.id_barang');
		$this->db->join('tb_history_invoice', 'tb_transaksi_merk.id_invoice = tb_history_invoice.id_invoice');
		$this->db->join('tb_karyawan', 'tb_transaksi_merk.referensi_2 = tb_karyawan.id_karyawan');
		$this->db->where('tb_transaksi_merk_per_item.id_transaksi_merk', $id);

		return $this->db->get()->result();
	}

	function getDetailPenjualanMerkPerItemKasir($id) {
		$this->db->select('tb_transaksi_merk_per_item.id_transaksi_merk, tgl_jual, potongan_harga, nama_pembeli, tb_transaksi_merk.id_invoice, total_item, total_harga, nama_merk, warna, ukuran, harga_jual_vendor, total_tagihan, pembayaran_tagihan, sisa_tagihan, nama, referensi_1, uang_kembalian');
		$this->db->from('tb_transaksi_merk');
		$this->db->join('tb_transaksi_merk_per_item', 'tb_transaksi_merk.id_transaksi_merk = tb_transaksi_merk_per_item.id_transaksi_merk');
		$this->db->join('tb_barang', 'tb_transaksi_merk_per_item.id_barang = tb_barang.id_barang');
		$this->db->join('tb_history_invoice', 'tb_transaksi_merk.id_invoice = tb_history_invoice.id_invoice');
		$this->db->join('tb_karyawan', 'tb_transaksi_merk.referensi_1 = tb_karyawan.id_karyawan');
		$this->db->where('tb_transaksi_merk.id_transaksi_merk', $id);

		return $this->db->get()->result();
	}

	function riwayatTransaksiMerkAdmin() {
		$this->db->select('tb_transaksi_merk.id_transaksi_merk, tgl_jual, nama_pembeli, jumlah_jual, total_tagihan, potongan_harga, sisa_tagihan');
		$this->db->join('tb_history_invoice', 'tb_transaksi_merk.id_invoice = tb_history_invoice.id_invoice');
		$this->db->where('referensi_1', 0);
		$this->db->order_by('tgl_jual', 'DESC');

		return $this->db->get('tb_transaksi_merk')->result();
	}

	function riwayatTransaksiMerkKasir() {
		$this->db->select('tb_transaksi_merk.id_transaksi_merk, tgl_jual, nama_pembeli, jumlah_jual, total_tagihan, potongan_harga, sisa_tagihan');
		$this->db->join('tb_history_invoice', 'tb_transaksi_merk.id_invoice = tb_history_invoice.id_invoice');
		$this->db->where('referensi_2', 0);
		$this->db->order_by('tgl_jual', 'DESC');

		return $this->db->get('tb_transaksi_merk')->result();
	}
	
}
