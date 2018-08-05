<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class AdminModelInvoice extends CI_Model
{
	
	function getInvoiceReseller()
	{

        $query = $this->db->query('SELECT tb_invoice.id_invoice AS id, tgl_jual AS tgl_transaksi, tb_reseller.nama_reseller,
                                    tb_transaksi_reseller.harga_jual AS jumlah_transaksi,  
                                    (SELECT SUM(`pembayaran_tagihan`) FROM `tb_history_invoice` WHERE `tb_history_invoice`.`id_invoice` = id) 
                                    AS total_pembayaran,
                                        IF(`tb_transaksi_reseller`.`harga_jual` < (SELECT SUM(`pembayaran_tagihan`) 
                                                                FROM `tb_history_invoice` WHERE `tb_history_invoice`.`id_invoice` = id),
                                        0,(tb_transaksi_reseller.harga_jual - (SELECT SUM(`pembayaran_tagihan`) 
                                        FROM `tb_history_invoice` WHERE `tb_history_invoice`.`id_invoice` = id)))
                                        AS total_tagihan, 
                                     IF(tb_invoice.status_invoice = 1, "Lunas", "Belum Lunas") AS status_invoice 
                                     FROM tb_invoice, tb_transaksi_reseller, `tb_reseller` WHERE tb_invoice.id_invoice = tb_transaksi_reseller.id_invoice
                                     AND `tb_reseller`.`id_reseller` = `tb_transaksi_reseller`.`id_reseller` ORDER BY tgl_jual DESC')->result();
        return $query;
	}

	function getBarangInvoiceReseller($id){
        $query = $this->db->query("SELECT tb_transaksi_reseller.id_invoice, tb_transaksi_reseller.id_transaksi_reseller, total_item, tb_transaksi_reseller.id_reseller,
                                    tb_transaksi_reseller_peritem.id_barang, produk, tb_barang.harga_reseller AS harga, (total_item * harga_reseller) AS total 
                                    FROM tb_transaksi_reseller, tb_invoice, tb_transaksi_reseller_peritem, tb_barang 
                                    WHERE tb_transaksi_reseller.id_transaksi_reseller = tb_transaksi_reseller_peritem.id_transaksi_reseller 
                                    AND tb_barang.id_barang = tb_transaksi_reseller_peritem.id_barang AND tb_invoice.id_invoice = tb_transaksi_reseller.id_invoice 
                                    AND tb_invoice.id_invoice = '$id'")->result();
        return $query;
    }

    function getBarangInvoiceMerk($id){
        $query = $this->db->query("SELECT tb_transaksi_merk.id_invoice, tb_transaksi_merk.id_transaksi_merk, total_item, 
                                    tb_transaksi_merk_per_item.id_barang, produk, tb_barang.harga_jual_vendor AS harga, (total_item * harga_jual_vendor) AS total 
                                    FROM tb_transaksi_merk, tb_invoice, tb_transaksi_merk_per_item, tb_barang 
                                    WHERE tb_transaksi_merk.id_transaksi_merk = tb_transaksi_merk_per_item.id_transaksi_merk 
                                    AND tb_barang.id_barang = tb_transaksi_merk_per_item.id_barang AND tb_invoice.id_invoice = tb_transaksi_merk.id_invoice 
                                    AND tb_invoice.id_invoice = '$id'")->result();
        return $query;
    }

    function getInfoReseller($id){
        $query = $this->db->query("SELECT tb_transaksi_reseller.id_invoice, tb_reseller.nama_reseller, tb_reseller.alamat, tb_reseller.no_handphone, tb_reseller.email, IF(tb_transaksi_reseller.reference_1 = 0, tb_transaksi_reseller.reference_2, tb_transaksi_reseller.reference_1) AS admin, tb_transaksi_reseller.tgl_jual FROM tb_reseller, tb_transaksi_reseller WHERE tb_transaksi_reseller.id_reseller = tb_reseller.id_reseller AND tb_transaksi_reseller.id_invoice = '$id'")->result();
        return $query;   
    }

    function getHistoryInvoiceReseller($id){
	    $query = $this->db->query("SELECT id_history, id_invoice, tanggal_pembayaran, total_tagihan, pembayaran_tagihan, sisa_tagihan 
                              FROM `tb_history_invoice` WHERE id_invoice = '$id' 
                              ORDER BY tanggal_pembayaran ASC")->result();
	    return $query;
    }

    function getHistoryInvoiceResellerByIdHistory($id){
        $query = $this->db->query("SELECT id_history, id_invoice, tanggal_pembayaran, total_tagihan, pembayaran_tagihan, sisa_tagihan 
                              FROM `tb_history_invoice` WHERE id_history = '$id'")->result();
        return $query;
    }

    function getHistoryTransactionInvoiceReseller($id){
        $query = $this->db->query("SELECT `tb_transaksi_reseller`.`id_transaksi_reseller`, `tb_transaksi_reseller`.`tgl_jual`, `tb_karyawan`.`nama`, `tb_reseller`.`nama_reseller`
                                    FROM `tb_transaksi_reseller`, `tb_karyawan`, `tb_invoice`, `tb_reseller`
                                    WHERE `tb_transaksi_reseller`.`id_invoice` = `tb_invoice`.`id_invoice`
                                    AND `tb_transaksi_reseller`.`id_reseller` = `tb_reseller`.`id_reseller`
                                    AND (`tb_transaksi_reseller`.`reference_1` = `tb_karyawan`.`id_karyawan`
                                    OR `tb_transaksi_reseller`.`reference_2` = `tb_karyawan`.`id_karyawan`)
                                    AND `tb_transaksi_reseller`.`id_invoice` = '$id'")->result();
        return $query;
    }

    function getHistoryTransactionInvoiceMerk($id){
        $query = $this->db->query("SELECT `tb_transaksi_merk`.`id_transaksi_merk` as id_transaksi_reseller, `tb_transaksi_merk`.`tgl_jual`, `tb_karyawan`.`nama`, `tb_transaksi_merk`.`nama_pembeli` AS nama_reseller
                                    FROM `tb_transaksi_merk`, `tb_karyawan`, `tb_invoice`
                                    WHERE `tb_transaksi_merk`.`id_invoice` = `tb_invoice`.`id_invoice`
                                    AND (`tb_transaksi_merk`.`referensi_1` = `tb_karyawan`.`id_karyawan`
                                    OR `tb_transaksi_merk`.`referensi_2` = `tb_karyawan`.`id_karyawan`)
                                    AND `tb_transaksi_merk`.`id_invoice` = '$id'")->result();
        return $query;
    }


    function getInvoiceResellerById($id)
	{

        $query = $this->db->query("SELECT tb_invoice.id_invoice AS id, tgl_jual AS tgl_transaksi, tb_reseller.nama_reseller,
                                    tb_transaksi_reseller.harga_jual AS jumlah_transaksi,  
                                    (SELECT SUM(`pembayaran_tagihan`) FROM `tb_history_invoice` WHERE `tb_history_invoice`.`id_invoice` = id) 
                                    AS total_pembayaran,(tb_transaksi_reseller.harga_jual - (SELECT SUM(`pembayaran_tagihan`) 
                                    FROM `tb_history_invoice` WHERE `tb_history_invoice`.`id_invoice` = id))
                                     AS total_tagihan, IF(tb_invoice.status_invoice = 1, 'Lunas', 'Belum Lunas') AS status_invoice 
                                     FROM tb_invoice, tb_transaksi_reseller, `tb_reseller` WHERE tb_invoice.id_invoice = tb_transaksi_reseller.id_invoice
                                     AND `tb_reseller`.`id_reseller` = `tb_transaksi_reseller`.`id_reseller`
                                     AND `tb_invoice`.`id_invoice` = '$id'")->result();
        return $query;
	}


	function updateStatusInvoice($id){
        $this->db->query("UPDATE `tb_invoice` SET `status_invoice`=1 WHERE id_invoice = '$id'");

    }

	function insertHistoryInvoice($data){
        $this->db->insert('tb_history_invoice', $data);
    }

	function getInvoiceMerk()
	{

        $query = $this->db->query("SELECT tb_invoice.id_invoice AS id, tgl_jual AS tgl_transaksi, `tb_transaksi_merk`.`nama_pembeli`,
                                    `tb_transaksi_merk`.`harga_jual` AS jumlah_transaksi,  
                                    (SELECT SUM(`pembayaran_tagihan`) FROM `tb_history_invoice` WHERE `tb_history_invoice`.`id_invoice` = id) 
                                    AS total_pembayaran,
                                            IF(`tb_transaksi_merk`.`harga_jual` < (SELECT SUM(`pembayaran_tagihan`) 
											FROM `tb_history_invoice` WHERE `tb_history_invoice`.`id_invoice` = id),
                                            0,(tb_transaksi_merk.harga_jual - (SELECT SUM(`pembayaran_tagihan`) 
                                            FROM `tb_history_invoice` WHERE `tb_history_invoice`.`id_invoice` = id)))
                                     AS total_tagihan, 
                                     IF(tb_invoice.status_invoice = 1, 'Lunas', 'Belum Lunas') AS status_invoice 
                                     FROM tb_invoice, tb_transaksi_merk WHERE tb_invoice.id_invoice = tb_transaksi_merk.id_invoice
                                     ORDER BY tgl_jual DESC")->result();
        return $query;
	}

	function getInvoiceMerkById($id)
	{

        $query = $this->db->query("SELECT tb_invoice.id_invoice AS id, tgl_jual AS tgl_transaksi, `tb_transaksi_merk`.`nama_pembeli`,
                                    tb_transaksi_merk.harga_jual AS jumlah_transaksi,  
                                    (SELECT SUM(`pembayaran_tagihan`) FROM `tb_history_invoice` WHERE `tb_history_invoice`.`id_invoice` = id) 
                                    AS total_pembayaran,(tb_transaksi_merk.harga_jual - (SELECT SUM(`pembayaran_tagihan`) 
                                    FROM `tb_history_invoice` WHERE `tb_history_invoice`.`id_invoice` = id))
                                     AS total_tagihan, IF(tb_invoice.status_invoice = 1, 'Lunas', 'Belum Lunas') AS status_invoice 
                                     FROM tb_invoice, tb_transaksi_merk WHERE tb_invoice.id_invoice = tb_transaksi_merk.id_invoice
                                     AND `tb_invoice`.`id_invoice` = '$id'")->result();
        return $query;
	}
}