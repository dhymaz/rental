-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 5.7.24 - MySQL Community Server (GPL)
-- OS Server:                    Win64
-- HeidiSQL Versi:               10.1.0.5464
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Membuang struktur basisdata untuk rental
CREATE DATABASE IF NOT EXISTS `rental` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `rental`;

-- membuang struktur untuk table rental.tbl_admin
CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `nik` varchar(50) DEFAULT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `foto` text,
  `tlp` varchar(15) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `tipe` varchar(10) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel rental.tbl_admin: ~6 rows (lebih kurang)
/*!40000 ALTER TABLE `tbl_admin` DISABLE KEYS */;
INSERT INTO `tbl_admin` (`id_admin`, `nik`, `nama_lengkap`, `email`, `foto`, `tlp`, `password`, `tempat_lahir`, `alamat`, `tanggal_lahir`, `tipe`, `status`) VALUES
	(1, NULL, 'administrator', 'admin@gmail.com', 'assets/img/team-1.jpg', '08977153192871', '21232f297a57a5a743894a0e4a801fc3', 'jakarta', NULL, '2019-07-06', 'admin', '1'),
	(2, NULL, 'Nur Kholis', 'nur@gmail.com', 'assets/img/team-1.jpg', '08977153624', 'b55178b011bfb206965f2638d0f87047', 'jakarta', NULL, '2019-07-06', 'supir', '1'),
	(3, NULL, 'Boediman', 'budi@gmail.com', 'assets/img/team-2.jpg', '0829372818', 'b21d4a84c3111f99683ed80a510c43cb', 'tangerang', NULL, '2019-07-06', 'supir', '1'),
	(4, NULL, 'Tisna', 'tisna@gmail.com', 'assets/img/team-3.jpg', '089771872627', '9665d25f7ce138d128326ce263588cc2', 'bandung', NULL, '2019-07-06', 'supir', '1'),
	(5, NULL, 'Endang', 'endang@gmail.com', 'assets/img/client_1562988375.jpg', '08787282911', 'd41d8cd98f00b204e9800998ecf8427e', 'Sukabumi', 'jalan mawar', '2019-07-06', 'supir', '1'),
	(7, '34567', 'tes', 'aa@fasd.com', '/assets/img/client/client_1562980235.jpg', '98765456789', '674f3c2c1a8a6f90461e8a66fb5550ba', 'jakarta', 'jalan', '2011-05-10', 'supir', '1');
/*!40000 ALTER TABLE `tbl_admin` ENABLE KEYS */;

-- membuang struktur untuk table rental.tbl_customer
CREATE TABLE IF NOT EXISTS `tbl_customer` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nik` int(20) DEFAULT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `alamat` text,
  `jenkel` enum('L','p') NOT NULL DEFAULT 'L',
  `password` varchar(100) DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `tlp` varchar(100) DEFAULT NULL,
  `tipe` varchar(10) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `nik` (`nik`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel rental.tbl_customer: ~5 rows (lebih kurang)
/*!40000 ALTER TABLE `tbl_customer` DISABLE KEYS */;
INSERT INTO `tbl_customer` (`id_user`, `nik`, `nama_lengkap`, `email`, `alamat`, `jenkel`, `password`, `tempat_lahir`, `tanggal_lahir`, `foto`, `tlp`, `tipe`, `status`) VALUES
	(1, 1234, 'udiin ', 'udin@gmail.com', NULL, 'L', 'udin', 'tangerang', '2019-07-06', '/assets/img/client/client_1562475619', NULL, 'siswa', '1'),
	(2, 123, 'Dina', 'dina@gmail.com', NULL, 'L', 'dina', 'Bandung', '2019-07-06', '/assets/img/client/client_1562475619', NULL, 'siswa', '1'),
	(7, 23456789, 'danu', 'a@gmail.com', NULL, 'L', '7d49e40f4b3d8f68c19406a58303f826', 'jakarta', '2013-04-04', '/assets/img/client/client_1562475619', '08977153624', 'siswa', '1'),
	(8, 345678, 'arnold', 'a@gmail.com', NULL, 'L', '0cc175b9c0f1b6a831c399e269772661', 'jakarta', '2016-05-04', '/assets/img/client/client_1562475853.png', '08977153624', 'siswa', '1'),
	(9, 12345678, 'dimas', 'dimas@gmail.com', 'jalan buntu', 'L', '0cc175b9c0f1b6a831c399e269772661', NULL, NULL, '/assets/img/client/client_1562676611.png', '08977565464566', 'siswa', '1');
/*!40000 ALTER TABLE `tbl_customer` ENABLE KEYS */;

-- membuang struktur untuk table rental.tbl_jadwal
CREATE TABLE IF NOT EXISTS `tbl_jadwal` (
  `id_jadwal` int(11) NOT NULL AUTO_INCREMENT,
  `id_penyewa` int(11) DEFAULT '0',
  `id_supir` int(11) DEFAULT '0',
  `id_mobil` int(11) DEFAULT '0',
  `supir` enum('true','false') NOT NULL DEFAULT 'false',
  `alamat_sewa` text,
  `tanggal` date DEFAULT NULL,
  `lama_hari` int(2) DEFAULT NULL,
  `jam` varchar(50) DEFAULT NULL,
  `status_jadwal` varchar(50) DEFAULT 'wait',
  PRIMARY KEY (`id_jadwal`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel rental.tbl_jadwal: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `tbl_jadwal` DISABLE KEYS */;
INSERT INTO `tbl_jadwal` (`id_jadwal`, `id_penyewa`, `id_supir`, `id_mobil`, `supir`, `alamat_sewa`, `tanggal`, `lama_hari`, `jam`, `status_jadwal`) VALUES
	(16, 9, 0, 1, 'true', 'jalan buntu', '2019-07-16', 3, NULL, 'finish'),
	(17, 9, 4, 1, 'true', 'jalan buntu', '2019-07-17', 3, NULL, 'ok'),
	(18, 9, 5, 1, 'true', 'jalan buntu', '2019-07-15', 3, NULL, 'ok');
/*!40000 ALTER TABLE `tbl_jadwal` ENABLE KEYS */;

-- membuang struktur untuk table rental.tbl_mobil
CREATE TABLE IF NOT EXISTS `tbl_mobil` (
  `id_mobil` int(11) NOT NULL AUTO_INCREMENT,
  `nama_mobil` varchar(100) DEFAULT NULL,
  `gambar` text,
  `tahun_keluar` varchar(5) DEFAULT NULL,
  `jenis` varchar(2) DEFAULT NULL,
  `qty` int(5) DEFAULT '0',
  `harga` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_mobil`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel rental.tbl_mobil: ~10 rows (lebih kurang)
/*!40000 ALTER TABLE `tbl_mobil` DISABLE KEYS */;
INSERT INTO `tbl_mobil` (`id_mobil`, `nama_mobil`, `gambar`, `tahun_keluar`, `jenis`, `qty`, `harga`) VALUES
	(1, 'agya', 'assets/img/mobil/agya.png', NULL, NULL, 1, NULL),
	(2, 'agya-kuning', 'assets/img/mobil/agya-yellow.png', '2017', 'AT', 1, 500000),
	(3, 'avanza', 'assets/img/mobil/avanza.png', '2017', 'AT', 1, 500000),
	(4, 'avanza-biru', 'assets/img/mobil/avanza-blue.png', '2017', 'AT', 1, 500000),
	(5, 'calya', 'assets/img/mobil/calya.png', '2017', 'AT', 1, 500000),
	(6, 'inova', 'assets/img/mobil/inova.png', '2017', 'AT', 1, 550000),
	(7, 'veloz', 'assets/img/mobil/veloz.png', '2017', 'MT', 1, 500000),
	(8, 'terios', 'assets/img/mobil/terrios.png', '2017', 'AT', 1, 500000),
	(9, 'Elf', 'assets/img/mobil/elf.png', '2017', 'MT', 1, 700000),
	(11, 'tess', 'assets/img/mobil/mobil_1562979174.jpg', '2019', 'AT', 0, 5000000);
/*!40000 ALTER TABLE `tbl_mobil` ENABLE KEYS */;

-- membuang struktur untuk table rental.tbl_paket
CREATE TABLE IF NOT EXISTS `tbl_paket` (
  `id_paket` int(5) NOT NULL AUTO_INCREMENT,
  `jml_hari` int(5) NOT NULL DEFAULT '0',
  `id_mobil` int(5) DEFAULT NULL,
  `nama_paket` varchar(100) NOT NULL,
  `harga_paket` int(10) NOT NULL,
  PRIMARY KEY (`id_paket`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel rental.tbl_paket: ~3 rows (lebih kurang)
/*!40000 ALTER TABLE `tbl_paket` DISABLE KEYS */;
INSERT INTO `tbl_paket` (`id_paket`, `jml_hari`, `id_mobil`, `nama_paket`, `harga_paket`) VALUES
	(1, 3, 1, 'Regular', 300000),
	(2, 7, 1, 'Medium', 400000),
	(3, 10, 3, 'Pro', 1000000);
/*!40000 ALTER TABLE `tbl_paket` ENABLE KEYS */;

-- membuang struktur untuk table rental.tbl_rating
CREATE TABLE IF NOT EXISTS `tbl_rating` (
  `id_rating` int(5) NOT NULL AUTO_INCREMENT,
  `id_user` int(5) DEFAULT '0',
  `id_transaksi` int(5) DEFAULT '0',
  `komentar` text,
  `tanggal` int(5) DEFAULT '0',
  PRIMARY KEY (`id_rating`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel rental.tbl_rating: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `tbl_rating` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_rating` ENABLE KEYS */;

-- membuang struktur untuk table rental.tbl_testimoni
CREATE TABLE IF NOT EXISTS `tbl_testimoni` (
  `id_testimoni` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `testimoni` text,
  `waktu` datetime DEFAULT NULL,
  PRIMARY KEY (`id_testimoni`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel rental.tbl_testimoni: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `tbl_testimoni` DISABLE KEYS */;
INSERT INTO `tbl_testimoni` (`id_testimoni`, `id_user`, `testimoni`, `waktu`) VALUES
	(1, 7, 'Mantap banget', '2019-07-13 21:19:18'),
	(2, 8, 'Saya udah lancar naik mobil, thx', '2019-07-13 21:19:36'),
	(3, 9, 'Saya sudah berani jalan di jalan raya', '2019-07-13 21:19:53');
/*!40000 ALTER TABLE `tbl_testimoni` ENABLE KEYS */;

-- membuang struktur untuk table rental.tbl_transaksi
CREATE TABLE IF NOT EXISTS `tbl_transaksi` (
  `id_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `no_invoice` varchar(50) DEFAULT NULL,
  `id_jadwal` int(5) DEFAULT NULL,
  `resi` text,
  `tagihan` int(10) DEFAULT NULL,
  `waktu_upload` timestamp NULL DEFAULT NULL,
  `waktu_approve` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_transaksi`),
  UNIQUE KEY `no_invoice` (`no_invoice`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel rental.tbl_transaksi: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `tbl_transaksi` DISABLE KEYS */;
INSERT INTO `tbl_transaksi` (`id_transaksi`, `no_invoice`, `id_jadwal`, `resi`, `tagihan`, `waktu_upload`, `waktu_approve`) VALUES
	(1, 'INV20190713124315', 16, NULL, 300000, NULL, '2019-07-13 19:12:15'),
	(2, 'INV20190713124857', 17, '/assets/img/resi/resi_1563017963.jpg', 300000, '2019-07-13 18:39:23', '2019-07-13 18:41:37'),
	(3, 'INV20190714000534', 18, '/assets/img/resi/resi_1563037567.jpg', 300000, '2019-07-14 00:06:07', '2019-07-14 00:07:23');
/*!40000 ALTER TABLE `tbl_transaksi` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
