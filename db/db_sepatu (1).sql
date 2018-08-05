-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 15, 2018 at 01:36 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sepatu`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang`
--

CREATE TABLE IF NOT EXISTS `tb_barang` (
  `id_barang` int(11) NOT NULL,
  `nama_merk` varchar(32) NOT NULL,
  `produk` varchar(225) NOT NULL,
  `jenis_sepatu` varchar(32) NOT NULL,
  `ukuran` int(2) NOT NULL,
  `warna` varchar(25) NOT NULL,
  `stok` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `harga_reseller` int(11) NOT NULL,
  `harga_end_user` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `kepemilikan_barang` varchar(10) NOT NULL,
  `harga_packing` int(11) NOT NULL,
  `harga_jual_vendor` int(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_barang`
--

INSERT INTO `tb_barang` (`id_barang`, `nama_merk`, `produk`, `jenis_sepatu`, `ukuran`, `warna`, `stok`, `harga`, `harga_reseller`, `harga_end_user`, `status`, `kepemilikan_barang`, `harga_packing`, `harga_jual_vendor`) VALUES
(1, 'Tubular', 'Tubular-Abu-40', 'Running', 40, 'Abu', 40, 150000, 220000, 240000, 0, 'Pribadi', 0, 0),
(2, 'Flyknit Racer', 'Flyknit Racer-Hitam-41', 'Running', 41, 'Hitam', 78, 200000, 250000, 280000, 0, 'Pribadi', 0, 0),
(3, 'Evospeed', 'Evospeed - Kuning - 42', 'Futsal', 42, 'Kuning', 7, 250000, 300000, 330000, 0, 'Titipan', 20000, 280000),
(4, 'Hilton', 'Hilton - Hitam - 40', 'Running', 40, 'Hitam', 0, 390000, 400000, 450000, 1, 'Pribadi', 0, 0),
(5, 'Crock', 'Crock - Abu abu - 43', 'Sandal', 43, 'Abu abu', 0, 100000, 120000, 150000, 1, 'Titipan', 50000, 110000),
(9, 'Dakka', 'Dakka - Kuning - 30', 'Casual', 30, 'Kuning', 0, 100, 120, 140, 1, 'Pribadi', 0, 0),
(10, 'Dakka', 'Dakka - Hijau - 40', 'Casual', 40, 'Hijau', 0, 130000, 150000, 180000, 0, 'Pribadi', 0, 0),
(11, 'Tiger', 'Tiger - Biru-40', 'Running', 40, 'Biru', 40, 800000, 1000000, 1200000, 0, 'Pribadi', 0, 0),
(12, 'q', 'q-q-12', 'q', 12, 'q', 0, 1000000, 1500000, 2000000, 1, 'Pribadi', 0, 0),
(13, 'Bata', 'Bata - Hitam-40', 'Casual', 40, 'Hitam', 0, 1000000, 1200000, 1300000, 0, 'Pribadi', 0, 0),
(14, '', ' - -', '', 0, '', 0, 0, 0, 0, 1, 'Titipan', 0, 0),
(15, 'Venom', 'Venom-Hiatm-40', 'Casual', 40, 'Hiatm', 0, 1200000, 1300000, 1700000, 0, 'Titipan', 50000, 1250000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_history_invoice`
--

CREATE TABLE IF NOT EXISTS `tb_history_invoice` (
  `id_history` int(11) NOT NULL,
  `id_invoice` varchar(32) NOT NULL,
  `total_tagihan` int(11) NOT NULL,
  `pembayaran_tagihan` int(11) NOT NULL,
  `tanggal_pembayaran` date NOT NULL,
  `sisa_tagihan` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_history_invoice`
--

INSERT INTO `tb_history_invoice` (`id_history`, `id_invoice`, `total_tagihan`, `pembayaran_tagihan`, `tanggal_pembayaran`, `sisa_tagihan`) VALUES
(6, 'TSVN-INV-20180618080630', 2500000, 2500000, '2018-06-18', 0),
(7, 'TSRES-INV-20180618084729', 600000, 600000, '2018-05-18', 0),
(8, 'TSRES-INV-20180618085434', 600000, 500000, '2018-05-18', 100000),
(9, 'TSMRK-INV-20180618085854', 560000, 600000, '2018-06-18', 0),
(10, 'TSRES-INV-20180618090752', 300000, 300000, '2018-05-18', 0),
(11, 'TSRES-INV-20180618091054', 300000, 300000, '2018-05-18', 0),
(12, 'TSRES-INV-20180618091152', 300000, 300000, '2018-05-18', 0),
(13, 'TSRES-INV-20180618091412', 250000, 250000, '2018-05-18', 0),
(14, 'TSRES-INV-20180618091847', 440000, 450000, '2018-05-18', 0),
(15, 'TSRES-INV-20180619095310', 1100000, 700000, '2018-05-19', 400000),
(16, 'TSRES-INV-20180619110734', 500000, 500000, '2018-05-19', 0),
(17, 'TSRES-INV-20180619122746', 250000, 250000, '2018-05-19', 0),
(18, 'TSRES-INV-20180619124022', 2500000, 2500000, '2018-06-19', 0),
(19, 'TSVN-INV-20180701110158', 100000, 100000, '2018-07-01', 0),
(20, 'TSRES-INV-20180701133141', 3000000, 3000000, '2018-06-01', 0),
(21, 'TSMRK-INV-20180701134848', 110000, 110000, '2018-07-01', 0),
(22, 'TSMRK-INV-20180715133519', 840000, 840000, '2018-07-15', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_invoice`
--

CREATE TABLE IF NOT EXISTS `tb_invoice` (
  `id_invoice` varchar(32) NOT NULL,
  `status_invoice` char(1) NOT NULL,
  `tgl_jatuh_tempo` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_invoice`
--

INSERT INTO `tb_invoice` (`id_invoice`, `status_invoice`, `tgl_jatuh_tempo`) VALUES
('TSMRK-INV-20180618085854', '1', '0000-00-00'),
('TSMRK-INV-20180701134848', '1', '0000-00-00'),
('TSMRK-INV-20180715133519', '1', '0000-00-00'),
('TSRES-INV-20180618084729', '1', '2018-06-18'),
('TSRES-INV-20180618085434', '0', '2018-06-25'),
('TSRES-INV-20180618090752', '1', '2018-06-18'),
('TSRES-INV-20180618091054', '1', '2018-06-18'),
('TSRES-INV-20180618091152', '1', '2018-06-18'),
('TSRES-INV-20180618091412', '1', '2018-06-18'),
('TSRES-INV-20180618091847', '1', '2018-06-18'),
('TSRES-INV-20180619095310', '0', '2018-06-26'),
('TSRES-INV-20180619110734', '1', '2018-06-19'),
('TSRES-INV-20180619122746', '1', '2018-06-19'),
('TSRES-INV-20180619124022', '1', '2018-06-19'),
('TSRES-INV-20180701133141', '1', '0000-00-00'),
('TSVN-INV-20180618080630', '1', '0000-00-00'),
('TSVN-INV-20180701110158', '1', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_karyawan`
--

CREATE TABLE IF NOT EXISTS `tb_karyawan` (
  `id_karyawan` int(11) NOT NULL,
  `nama` varchar(32) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `umur` int(11) NOT NULL,
  `no_handphone` varchar(12) NOT NULL,
  `gaji` int(11) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_karyawan`
--

INSERT INTO `tb_karyawan` (`id_karyawan`, `nama`, `alamat`, `umur`, `no_handphone`, `gaji`, `jabatan`, `status`) VALUES
(1, 'Indro u', 'Bandung1', 21, '12344', 200001, 'Kasir', 0),
(2, 'Indro x', 'Bandung1', 21, '12344', 200001, 'Kasir', 0),
(3, 'Indro i', 'Bandung1', 21, '12344', 2000000, 'Kasir', 0),
(4, 'Indro i', 'Bandung1', 21, '12344', 200001, 'Kasir', 0),
(5, 'Indro i', 'Bandung1', 21, '12344', 200001, 'Kasir', 1),
(6, 'Adit', 'Bandung', 25, '000000', 2800000, 'Kasir', 0),
(7, 'Aji', 'Jakarta', 25, '00000000', 2500000, 'Kasir', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_merk`
--

CREATE TABLE IF NOT EXISTS `tb_merk` (
  `id_merk` int(11) NOT NULL,
  `nama_merk` varchar(50) NOT NULL,
  `no_handphone` varchar(12) NOT NULL,
  `alamat` varchar(225) NOT NULL,
  `email` varchar(50) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_merk`
--

INSERT INTO `tb_merk` (`id_merk`, `nama_merk`, `no_handphone`, `alamat`, `email`, `status`) VALUES
(1, 'ssssss', '192412940', 'bandung', 'sssssss@ffff', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengeluaran_kantor`
--

CREATE TABLE IF NOT EXISTS `tb_pengeluaran_kantor` (
  `id_pengeluaran_kantor` int(11) NOT NULL,
  `tgl_pengeluaran` date NOT NULL,
  `kategori_pengeluaran` varchar(50) NOT NULL,
  `jumlah_pengeluaran` int(11) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pengeluaran_kantor`
--

INSERT INTO `tb_pengeluaran_kantor` (`id_pengeluaran_kantor`, `tgl_pengeluaran`, `kategori_pengeluaran`, `jumlah_pengeluaran`, `keterangan`) VALUES
(1, '2018-04-28', 'Bayar Listrik', 2000000, 'pembayaran listrik bulan april'),
(2, '2018-04-24', 'Bayar Air', 500000, 'Pembayaran air bulan April'),
(3, '2018-03-28', 'Bayar listrik', 2000000, 'Bayar listirk bulan Maret'),
(4, '2018-03-24', 'Bayar Air', 500000, 'Pembayaran air bulan Maret'),
(5, '2018-02-28', 'Bayar listrik', 2000000, 'Bayar listirk bulan Februari'),
(6, '2018-02-24', 'Bayar Air', 500000, 'Pembayaran air bulan Februari'),
(7, '2018-01-28', 'Bayar listrik', 2000000, 'Bayar listirk bulan Januari'),
(8, '2018-01-24', 'Bayar Air', 500000, 'Pembayaran air bulan Januari'),
(9, '2017-12-28', 'Bayar listrik', 2000000, 'Bayar listirk bulan Desember'),
(10, '2017-12-24', 'Bayar Air', 500000, 'Pembayaran air bulan Desember'),
(11, '2017-11-28', 'Bayar listrik', 2000000, 'Bayar listirk bulan November'),
(12, '2018-05-05', 'Bayar Listrik', 70000, 'Bayar Listirk Bulan Mei'),
(13, '2018-04-28', 'Bayar Listrik', 100000, 'Bayar listrilk'),
(14, '2018-05-04', 'Bayar Air', 100000, 'asgqgqwg'),
(15, '2018-05-03', 'Bayar Air', 200000, 'asfasgqw'),
(16, '2018-05-04', 'Bayar Listrik', 120000, 'sgwegqwfqw');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengeluaran_karyawan`
--

CREATE TABLE IF NOT EXISTS `tb_pengeluaran_karyawan` (
  `id_pengeluaran` int(11) NOT NULL,
  `tgl_pengeluaran` date NOT NULL,
  `kategori_pengeluaran` varchar(50) NOT NULL,
  `jumlah_pengeluaran` int(11) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `id_karyawan` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pengeluaran_karyawan`
--

INSERT INTO `tb_pengeluaran_karyawan` (`id_pengeluaran`, `tgl_pengeluaran`, `kategori_pengeluaran`, `jumlah_pengeluaran`, `keterangan`, `id_karyawan`) VALUES
(1, '2018-05-01', 'Gaji', 700000, NULL, 1),
(2, '2018-05-01', 'Gaji', 700000, '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_reseller`
--

CREATE TABLE IF NOT EXISTS `tb_reseller` (
  `id_reseller` int(11) NOT NULL,
  `nama_reseller` varchar(32) NOT NULL,
  `no_handphone` varchar(12) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `email` varchar(32) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_reseller`
--

INSERT INTO `tb_reseller` (`id_reseller`, `nama_reseller`, `no_handphone`, `alamat`, `email`, `status`) VALUES
(2, 'Lut Dinar Fadila', '087820093686', 'Bandung', 'lutdinarfadila10@gmail.com', 1),
(3, 'Azam H', '0001', 'Bandung1', 'azamhizbul@unpas.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_retur`
--

CREATE TABLE IF NOT EXISTS `tb_retur` (
  `id_retur` int(11) NOT NULL,
  `id_transaksi_vendor` varchar(100) NOT NULL,
  `jumlah_retur_barang` int(11) NOT NULL,
  `status_retur` char(1) NOT NULL,
  `tanggal_retur` date NOT NULL,
  `tanggal_selesai_retur` date DEFAULT NULL,
  `keterangan` varchar(225) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_retur`
--

INSERT INTO `tb_retur` (`id_retur`, `id_transaksi_vendor`, `jumlah_retur_barang`, `status_retur`, `tanggal_retur`, `tanggal_selesai_retur`, `keterangan`) VALUES
(1, 'TSVN-20180701110158', 1, '1', '2018-07-01', '2018-07-01', 'Sesuai'),
(2, 'TSVN-20180701110158', 1, '1', '2018-07-01', '2018-07-01', 'Sesuai dengan yang inginkan');

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi_end_user`
--

CREATE TABLE IF NOT EXISTS `tb_transaksi_end_user` (
  `id_transaksi_end_user` varchar(100) NOT NULL,
  `tgl_jual` date NOT NULL,
  `jumlah_jual` int(11) NOT NULL,
  `potongan_harga` int(11) DEFAULT NULL,
  `harga_jual` int(11) NOT NULL,
  `status_transaksi` char(1) NOT NULL DEFAULT '1',
  `uang_diterima` int(11) NOT NULL,
  `uang_kembalian` int(11) NOT NULL,
  `nama_pembeli` varchar(50) DEFAULT NULL,
  `reference_1` int(11) NOT NULL,
  `reference_2` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_transaksi_end_user`
--

INSERT INTO `tb_transaksi_end_user` (`id_transaksi_end_user`, `tgl_jual`, `jumlah_jual`, `potongan_harga`, `harga_jual`, `status_transaksi`, `uang_diterima`, `uang_kembalian`, `nama_pembeli`, `reference_1`, `reference_2`) VALUES
('CODE-20180618080204', '2018-06-18', 1, 0, 330000, '0', 250000, -80000, 'Dinar', 2, NULL),
('CODE-20180618083554', '2018-06-18', 1, 0, 280000, '0', 300000, 20000, 'itha', 2, NULL),
('CODE-20180618083747', '2018-06-18', 1, 0, 240000, '0', 250000, 10000, 'Admin', 0, 2),
('CODE-20180618091458', '2018-06-18', 1, 0, 240000, '0', 250000, 10000, 'Juna', 1, NULL),
('CODE-20180619100808', '2018-06-19', 2, 0, 660000, '1', 660000, 0, 'ddd', 3, NULL),
('CODE-20180619101036', '2018-06-19', 3, 0, 990000, '1', 990000, 0, 'ddd', 3, NULL),
('CODE-20180619101210', '2018-06-19', 1, 0, 330000, '1', 330000, 0, 'erere', 3, NULL),
('CODE-20180701113810', '2018-07-01', 1, 0, 240000, '0', 250000, 10000, 'Lukman', 0, 2),
('CODE-20180701132716', '2018-07-01', 12, 0, 2880000, '0', 2900000, 20000, 'Bandro', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi_end_user_peritem`
--

CREATE TABLE IF NOT EXISTS `tb_transaksi_end_user_peritem` (
  `id_barang` int(11) NOT NULL,
  `id_transaksi_end_user` varchar(100) NOT NULL,
  `total_item` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_transaksi_end_user_peritem`
--

INSERT INTO `tb_transaksi_end_user_peritem` (`id_barang`, `id_transaksi_end_user`, `total_item`, `total_harga`) VALUES
(3, 'CODE-20180618080204', 1, 330000),
(2, 'CODE-20180618083554', 1, 280000),
(1, 'CODE-20180618083747', 1, 240000),
(1, 'CODE-20180618091458', 1, 240000),
(3, 'CODE-20180619100808', 2, 660000),
(3, 'CODE-20180619101036', 3, 990000),
(3, 'CODE-20180619101210', 1, 330000),
(1, 'CODE-20180701113810', 1, 240000),
(1, 'CODE-20180701132716', 12, 2880000);

--
-- Triggers `tb_transaksi_end_user_peritem`
--
DELIMITER $$
CREATE TRIGGER `update_stok_by_end_user` AFTER INSERT ON `tb_transaksi_end_user_peritem`
 FOR EACH ROW UPDATE tb_barang SET tb_barang.stok = tb_barang.stok - NEW.total_item
WHERE tb_barang.id_barang = NEW.id_barang
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi_merk`
--

CREATE TABLE IF NOT EXISTS `tb_transaksi_merk` (
  `id_transaksi_merk` varchar(100) NOT NULL,
  `tgl_jual` date NOT NULL,
  `jumlah_jual` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `potongan_harga` int(11) NOT NULL,
  `uang_diterima` int(11) NOT NULL,
  `uang_kembalian` int(11) NOT NULL,
  `nama_pembeli` varchar(100) NOT NULL,
  `status_transaksi` varchar(1) NOT NULL,
  `id_invoice` varchar(100) NOT NULL,
  `referensi_1` int(11) NOT NULL,
  `referensi_2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_transaksi_merk`
--

INSERT INTO `tb_transaksi_merk` (`id_transaksi_merk`, `tgl_jual`, `jumlah_jual`, `harga_jual`, `potongan_harga`, `uang_diterima`, `uang_kembalian`, `nama_pembeli`, `status_transaksi`, `id_invoice`, `referensi_1`, `referensi_2`) VALUES
('TSMRK-20180618085854', '2018-06-18', 2, 560000, 0, 600000, 40000, 'Dinar', '1', 'TSMRK-INV-20180618085854', 1, 0),
('TSMRK-20180701134848', '2018-07-01', 1, 110000, 0, 110000, 0, 'Ridwan', '1', 'TSMRK-INV-20180701134848', 1, 0),
('TSMRK-20180715133519', '2018-07-15', 3, 840000, 0, 840000, 0, 'ujang', '1', 'TSMRK-INV-20180715133519', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi_merk_per_item`
--

CREATE TABLE IF NOT EXISTS `tb_transaksi_merk_per_item` (
  `id_transaksi_merk` varchar(100) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `total_item` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_transaksi_merk_per_item`
--

INSERT INTO `tb_transaksi_merk_per_item` (`id_transaksi_merk`, `id_barang`, `total_item`, `total_harga`) VALUES
('TSMRK-20180618085854', 3, 2, 560000),
('TSMRK-20180701134848', 5, 1, 110000),
('TSMRK-20180715133519', 3, 3, 840000);

--
-- Triggers `tb_transaksi_merk_per_item`
--
DELIMITER $$
CREATE TRIGGER `update_stok_by_merk` AFTER INSERT ON `tb_transaksi_merk_per_item`
 FOR EACH ROW UPDATE tb_barang SET tb_barang.stok = tb_barang.stok - NEW.total_item
WHERE tb_barang.id_barang = NEW.id_barang
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi_reseller`
--

CREATE TABLE IF NOT EXISTS `tb_transaksi_reseller` (
  `id_transaksi_reseller` varchar(100) NOT NULL,
  `tgl_jual` date NOT NULL,
  `jumlah_jual` int(11) NOT NULL,
  `potongan_harga` int(11) DEFAULT NULL,
  `harga_jual` int(11) NOT NULL,
  `uang_diterima` int(11) NOT NULL,
  `uang_kembalian` int(11) NOT NULL,
  `status_transaksi` varchar(1) NOT NULL DEFAULT '0',
  `id_reseller` int(11) NOT NULL,
  `id_invoice` varchar(32) DEFAULT NULL,
  `reference_1` int(11) NOT NULL,
  `reference_2` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_transaksi_reseller`
--

INSERT INTO `tb_transaksi_reseller` (`id_transaksi_reseller`, `tgl_jual`, `jumlah_jual`, `potongan_harga`, `harga_jual`, `uang_diterima`, `uang_kembalian`, `status_transaksi`, `id_reseller`, `id_invoice`, `reference_1`, `reference_2`) VALUES
('TSRES-20180618084729', '2018-05-18', 2, 0, 600000, 600000, 0, '1', 2, 'TSRES-INV-20180618084729', 0, 2),
('TSRES-20180618085434', '2018-05-18', 2, 0, 600000, 500000, 0, '0', 2, 'TSRES-INV-20180618085434', 1, NULL),
('TSRES-20180618090752', '2018-05-18', 1, 0, 300000, 300000, 0, '1', 2, 'TSRES-INV-20180618090752', 1, NULL),
('TSRES-20180618091054', '2018-05-18', 1, 0, 300000, 300000, 0, '1', 2, 'TSRES-INV-20180618091054', 1, NULL),
('TSRES-20180618091152', '2018-05-18', 1, 0, 300000, 300000, 0, '1', 2, 'TSRES-INV-20180618091152', 1, NULL),
('TSRES-20180618091412', '2018-05-18', 1, 0, 250000, 250000, 0, '1', 2, 'TSRES-INV-20180618091412', 1, NULL),
('TSRES-20180618091847', '2018-05-18', 2, 0, 440000, 450000, 10000, '1', 2, 'TSRES-INV-20180618091847', 3, NULL),
('TSRES-20180619095310', '2018-05-19', 4, 0, 1100000, 700000, 0, '0', 2, 'TSRES-INV-20180619095310', 3, NULL),
('TSRES-20180619110734', '2018-05-19', 2, 0, 500000, 500000, 0, '1', 2, 'TSRES-INV-20180619110734', 0, 2),
('TSRES-20180619122746', '2018-06-19', 1, 0, 250000, 250000, 0, '1', 2, 'TSRES-INV-20180619122746', 0, 2),
('TSRES-20180619124022', '2018-06-19', 10, 0, 2500000, 2500000, 0, '1', 2, 'TSRES-INV-20180619124022', 0, 2),
('TSRES-20180701133141', '2018-06-01', 12, 0, 3000000, 3000000, 0, '1', 3, 'TSRES-INV-20180701133141', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi_reseller_peritem`
--

CREATE TABLE IF NOT EXISTS `tb_transaksi_reseller_peritem` (
  `id_barang` int(11) NOT NULL,
  `id_transaksi_reseller` varchar(100) NOT NULL,
  `total_item` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_transaksi_reseller_peritem`
--

INSERT INTO `tb_transaksi_reseller_peritem` (`id_barang`, `id_transaksi_reseller`, `total_item`, `total_harga`) VALUES
(3, 'TSRES-20180618084729', 2, 600000),
(3, 'TSRES-20180618085433', 2, 600000),
(3, 'TSRES-20180618090752', 1, 300000),
(2, 'TSRES-20180618091412', 1, 250000),
(1, 'TSRES-20180618091847', 2, 440000),
(2, 'TSRES-20180619095310', 2, 500000),
(3, 'TSRES-20180619095310', 2, 600000),
(2, 'TSRES-20180619110734', 2, 500000),
(2, 'TSRES-20180619122746', 1, 250000),
(2, 'TSRES-20180619124022', 10, 2500000),
(2, 'TSRES-20180701133141', 12, 3000000);

--
-- Triggers `tb_transaksi_reseller_peritem`
--
DELIMITER $$
CREATE TRIGGER `update_stok_by_reseller` AFTER INSERT ON `tb_transaksi_reseller_peritem`
 FOR EACH ROW UPDATE tb_barang SET tb_barang.stok = tb_barang.stok - NEW.total_item
WHERE tb_barang.id_barang = NEW.id_barang
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi_vendor`
--

CREATE TABLE IF NOT EXISTS `tb_transaksi_vendor` (
  `id_transaksi_vendor` varchar(100) NOT NULL,
  `tgl_beli` date NOT NULL,
  `total_beli` int(11) NOT NULL,
  `harga_satuan` int(11) NOT NULL,
  `total_harga_beli` int(11) NOT NULL,
  `uang_keluar` int(11) NOT NULL,
  `uang_kembalian` int(11) NOT NULL,
  `status_transaksi` char(1) NOT NULL,
  `status_barang` varchar(2) NOT NULL,
  `id_invoice` varchar(32) NOT NULL,
  `id_vendor` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `reference_1` int(11) NOT NULL,
  `reference_2` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_transaksi_vendor`
--

INSERT INTO `tb_transaksi_vendor` (`id_transaksi_vendor`, `tgl_beli`, `total_beli`, `harga_satuan`, `total_harga_beli`, `uang_keluar`, `uang_kembalian`, `status_transaksi`, `status_barang`, `id_invoice`, `id_vendor`, `id_barang`, `reference_1`, `reference_2`) VALUES
('TSVN-20180618080630', '2018-06-18', 10, 250000, 2500000, 2500000, 0, '1', '1', 'TSVN-INV-20180618080630', 4, 3, 0, 2),
('TSVN-20180624101149', '2018-06-24', 40, 150000, 6000000, 6000000, 0, '1', '1', '', 1, 1, 0, 2),
('TSVN-20180701110158', '2018-07-01', 1, 100000, 100000, 100000, 0, '1', '1', 'TSVN-INV-20180701110158', 1, 5, 0, 2),
('TSVN-20180701144023', '2018-07-01', 10, 150000, 1500000, 0, 0, '1', '1', '', 1, 1, 1, 0),
('TSVN-20180701144039', '2018-07-01', 3, 150000, 450000, 0, 0, '1', '1', '', 1, 1, 1, 0),
('TSVN-20180714123203', '2018-07-14', 40, 700, 28000, 28000, 0, '1', '1', '0', 2, 11, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE IF NOT EXISTS `tb_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `hak_akses` varchar(6) NOT NULL,
  `id_karyawan` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `password`, `hak_akses`, `id_karyawan`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '1', 2),
(2, 'lutdinar', '856f2cbead4b490272ec67c31f593d9c', '3', 3),
(3, 'Kasir', 'c7911af3adbd12a035b289556d96470a', '3', 1),
(4, 'Gudang', '202446dd1d6028084426867365b0c7a1', '2', 1),
(5, 'Indra', '202cb962ac59075b964b07152d234b70', '2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_vendor`
--

CREATE TABLE IF NOT EXISTS `tb_vendor` (
  `id_vendor` int(11) NOT NULL,
  `nama_vendor` varchar(32) NOT NULL,
  `no_handphone` varchar(12) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_vendor`
--

INSERT INTO `tb_vendor` (`id_vendor`, `nama_vendor`, `no_handphone`, `alamat`, `status`) VALUES
(1, 'Adidas', '012345678102', 'Bandung', 0),
(2, 'Nike', '087820093686', 'Bandung', 0),
(3, 'Asic', '089877882290', 'Tangerang', 0),
(4, 'Puma', '081346982211', 'Jakarta', 0),
(5, 'Arca1', '0001', 'Bandung1', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD UNIQUE KEY `produk` (`produk`);

--
-- Indexes for table `tb_history_invoice`
--
ALTER TABLE `tb_history_invoice`
  ADD PRIMARY KEY (`id_history`),
  ADD KEY `fk_invoice` (`id_invoice`);

--
-- Indexes for table `tb_invoice`
--
ALTER TABLE `tb_invoice`
  ADD PRIMARY KEY (`id_invoice`);

--
-- Indexes for table `tb_karyawan`
--
ALTER TABLE `tb_karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indexes for table `tb_merk`
--
ALTER TABLE `tb_merk`
  ADD PRIMARY KEY (`id_merk`);

--
-- Indexes for table `tb_pengeluaran_kantor`
--
ALTER TABLE `tb_pengeluaran_kantor`
  ADD PRIMARY KEY (`id_pengeluaran_kantor`);

--
-- Indexes for table `tb_pengeluaran_karyawan`
--
ALTER TABLE `tb_pengeluaran_karyawan`
  ADD PRIMARY KEY (`id_pengeluaran`),
  ADD KEY `id_karyawan` (`id_karyawan`);

--
-- Indexes for table `tb_reseller`
--
ALTER TABLE `tb_reseller`
  ADD PRIMARY KEY (`id_reseller`);

--
-- Indexes for table `tb_retur`
--
ALTER TABLE `tb_retur`
  ADD PRIMARY KEY (`id_retur`),
  ADD KEY `fK_transaksi_vendor` (`id_transaksi_vendor`);

--
-- Indexes for table `tb_transaksi_end_user`
--
ALTER TABLE `tb_transaksi_end_user`
  ADD PRIMARY KEY (`id_transaksi_end_user`);

--
-- Indexes for table `tb_transaksi_end_user_peritem`
--
ALTER TABLE `tb_transaksi_end_user_peritem`
  ADD KEY `fk_barang` (`id_barang`),
  ADD KEY `fk_transaksi_end_user` (`id_transaksi_end_user`);

--
-- Indexes for table `tb_transaksi_merk`
--
ALTER TABLE `tb_transaksi_merk`
  ADD PRIMARY KEY (`id_transaksi_merk`);

--
-- Indexes for table `tb_transaksi_merk_per_item`
--
ALTER TABLE `tb_transaksi_merk_per_item`
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_transaksi_merk` (`id_transaksi_merk`);

--
-- Indexes for table `tb_transaksi_reseller`
--
ALTER TABLE `tb_transaksi_reseller`
  ADD PRIMARY KEY (`id_transaksi_reseller`),
  ADD KEY `id_reseller` (`id_reseller`),
  ADD KEY `id_invoice` (`id_invoice`);

--
-- Indexes for table `tb_transaksi_reseller_peritem`
--
ALTER TABLE `tb_transaksi_reseller_peritem`
  ADD KEY `fk_barang` (`id_barang`),
  ADD KEY `fk_transaksi_reseller` (`id_transaksi_reseller`);

--
-- Indexes for table `tb_transaksi_vendor`
--
ALTER TABLE `tb_transaksi_vendor`
  ADD PRIMARY KEY (`id_transaksi_vendor`),
  ADD KEY `id_vendor` (`id_vendor`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `fk_karyawan` (`id_karyawan`);

--
-- Indexes for table `tb_vendor`
--
ALTER TABLE `tb_vendor`
  ADD PRIMARY KEY (`id_vendor`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `tb_history_invoice`
--
ALTER TABLE `tb_history_invoice`
  MODIFY `id_history` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `tb_karyawan`
--
ALTER TABLE `tb_karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tb_merk`
--
ALTER TABLE `tb_merk`
  MODIFY `id_merk` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tb_pengeluaran_kantor`
--
ALTER TABLE `tb_pengeluaran_kantor`
  MODIFY `id_pengeluaran_kantor` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `tb_pengeluaran_karyawan`
--
ALTER TABLE `tb_pengeluaran_karyawan`
  MODIFY `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_reseller`
--
ALTER TABLE `tb_reseller`
  MODIFY `id_reseller` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tb_retur`
--
ALTER TABLE `tb_retur`
  MODIFY `id_retur` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tb_vendor`
--
ALTER TABLE `tb_vendor`
  MODIFY `id_vendor` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_pengeluaran_karyawan`
--
ALTER TABLE `tb_pengeluaran_karyawan`
  ADD CONSTRAINT `tb_pengeluaran_karyawan_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `tb_karyawan` (`id_karyawan`) ON DELETE CASCADE;

--
-- Constraints for table `tb_retur`
--
ALTER TABLE `tb_retur`
  ADD CONSTRAINT `tb_retur_ibfk_1` FOREIGN KEY (`id_transaksi_vendor`) REFERENCES `tb_transaksi_vendor` (`id_transaksi_vendor`);

--
-- Constraints for table `tb_transaksi_end_user_peritem`
--
ALTER TABLE `tb_transaksi_end_user_peritem`
  ADD CONSTRAINT `tb_transaksi_end_user_peritem_ibfk_3` FOREIGN KEY (`id_barang`) REFERENCES `tb_barang` (`id_barang`) ON DELETE CASCADE;

--
-- Constraints for table `tb_transaksi_merk_per_item`
--
ALTER TABLE `tb_transaksi_merk_per_item`
  ADD CONSTRAINT `id_merk` FOREIGN KEY (`id_barang`) REFERENCES `tb_barang` (`id_barang`) ON DELETE CASCADE;

--
-- Constraints for table `tb_transaksi_reseller`
--
ALTER TABLE `tb_transaksi_reseller`
  ADD CONSTRAINT `tb_transaksi_reseller_ibfk_1` FOREIGN KEY (`id_reseller`) REFERENCES `tb_reseller` (`id_reseller`) ON DELETE CASCADE;

--
-- Constraints for table `tb_transaksi_reseller_peritem`
--
ALTER TABLE `tb_transaksi_reseller_peritem`
  ADD CONSTRAINT `tb_transaksi_reseller_peritem_ibfk_3` FOREIGN KEY (`id_barang`) REFERENCES `tb_barang` (`id_barang`) ON DELETE CASCADE;

--
-- Constraints for table `tb_transaksi_vendor`
--
ALTER TABLE `tb_transaksi_vendor`
  ADD CONSTRAINT `tb_transaksi_vendor_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `tb_barang` (`id_barang`) ON DELETE CASCADE,
  ADD CONSTRAINT `tb_transaksi_vendor_ibfk_3` FOREIGN KEY (`id_vendor`) REFERENCES `tb_vendor` (`id_vendor`);

--
-- Constraints for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD CONSTRAINT `tb_user_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `tb_karyawan` (`id_karyawan`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
