CREATE TRIGGER `update_stok` AFTER INSERT ON `tb_transaksi_merk`
 FOR EACH ROW UPDATE tb_barang SET tb_barang.stok = tb_barang.stok - NEW.jumlah_jual
WHERE tb_barang.id_barang = NEW.id_barang