CREATE TRIGGER `update_stok_by_end_user` AFTER INSERT ON `tb_transaksi_end_user_peritem`
 FOR EACH ROW UPDATE tb_barang SET tb_barang.stok = tb_barang.stok - NEW.total_item
WHERE tb_barang.id_barang = NEW.id_barang