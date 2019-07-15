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

-- Membuang data untuk tabel rental.tbl_admin: ~5 rows (lebih kurang)
/*!40000 ALTER TABLE `tbl_admin` DISABLE KEYS */;
INSERT INTO `tbl_admin` (`id_admin`, `nik`, `nama_lengkap`, `email`, `foto`, `tlp`, `password`, `tempat_lahir`, `alamat`, `tanggal_lahir`, `tipe`, `status`) VALUES
	(1, NULL, 'administrator', 'admin@gmail.com', 'assets/img/team-1.jpg', '08977153192871', '21232f297a57a5a743894a0e4a801fc3', 'jakarta', NULL, '2019-07-06', 'admin', '1'),
	(2, NULL, 'Nur Kholis', 'nur@gmail.com', 'assets/img/team-1.jpg', '08977153624', 'b55178b011bfb206965f2638d0f87047', 'jakarta', NULL, '2019-07-06', 'supir', '1'),
	(3, NULL, 'Boediman', 'budi@gmail.com', 'assets/img/team-2.jpg', '0829372818', 'b21d4a84c3111f99683ed80a510c43cb', 'tangerang', NULL, '2019-07-06', 'supir', '1'),
	(4, NULL, 'Tisna', 'tisna@gmail.com', 'assets/img/team-3.jpg', '089771872627', '9665d25f7ce138d128326ce263588cc2', 'bandung', NULL, '2019-07-06', 'supir', '1'),
	(5, NULL, 'Endang', 'endang@gmail.com', 'assets/img/team-4.jpg', '08787282911', 'b38a3c70e97a06b85bbd6693b1aaa25a', 'Sukabumi', NULL, '2019-07-06', 'supir', '1'),
	(7, '34567', 'tes', 'aa@fasd.com', '/assets/img/client/client_1562980235.jpg', '98765456789', '674f3c2c1a8a6f90461e8a66fb5550ba', 'jakarta', 'jalan', '2011-05-10', 'supir', '1');
/*!40000 ALTER TABLE `tbl_admin` ENABLE KEYS */;

-- membuang struktur untuk table rental.tbl_customer
CREATE TABLE IF NOT EXISTS `tbl_customer` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nik` int(20) DEFAULT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `alamat` text,
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
INSERT INTO `tbl_customer` (`id_user`, `nik`, `nama_lengkap`, `email`, `alamat`, `password`, `tempat_lahir`, `tanggal_lahir`, `foto`, `tlp`, `tipe`, `status`) VALUES
	(1, 1234, 'udiin ', 'udin@gmail.com', NULL, 'udin', 'tangerang', '2019-07-06', NULL, NULL, 'siswa', '1'),
	(2, 123, 'Dina', 'dina@gmail.com', NULL, 'dina', 'Bandung', '2019-07-06', NULL, NULL, 'siswa', '1'),
	(7, 23456789, 'dimas', 'a@gmail.com', NULL, '7d49e40f4b3d8f68c19406a58303f826', 'jakarta', '2013-04-04', '/assets/img/client/client_1562475619', '08977153624', 'siswa', '1'),
	(8, 345678, 'dimas', 'a@gmail.com', NULL, '0cc175b9c0f1b6a831c399e269772661', 'jakarta', '2016-05-04', '/assets/img/client/client_1562475853..png', '08977153624', 'siswa', '1'),
	(9, 12345678, 'dimas', 'asdasd@adsad.com', 'jalan buntu', '0cc175b9c0f1b6a831c399e269772661', 'tangerang', '2019-07-08', '/assets/img/client/client_1562676611..png', '08977565464566', 'siswa', '1');
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel rental.tbl_jadwal: ~2 rows (lebih kurang)
/*!40000 ALTER TABLE `tbl_jadwal` DISABLE KEYS */;
INSERT INTO `tbl_jadwal` (`id_jadwal`, `id_penyewa`, `id_supir`, `id_mobil`, `supir`, `alamat_sewa`, `tanggal`, `lama_hari`, `jam`, `status_jadwal`) VALUES
	(6, 9, 0, 2, 'true', 'jalan buntu', '2019-07-13', 2, NULL, 'waiting'),
	(9, 9, 0, 3, 'true', 'jalan buntu', '2019-07-14', 1, NULL, 'waiting'),
	(11, 9, 0, 3, 'true', 'jalan buntu', '2019-07-14', 2, NULL, 'waiting');
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

-- Membuang data untuk tabel rental.tbl_mobil: ~9 rows (lebih kurang)
/*!40000 ALTER TABLE `tbl_mobil` DISABLE KEYS */;
INSERT INTO `tbl_mobil` (`id_mobil`, `nama_mobil`, `gambar`, `tahun_keluar`, `jenis`, `qty`, `harga`) VALUES
	(1, 'agya', 'assets/img/mobil/agya.png', '2017', 'AT', 1, 500000),
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
  `nama_paket` varchar(100) NOT NULL,
  `harga` int(10) NOT NULL,
  PRIMARY KEY (`id_paket`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel rental.tbl_paket: ~3 rows (lebih kurang)
/*!40000 ALTER TABLE `tbl_paket` DISABLE KEYS */;
INSERT INTO `tbl_paket` (`id_paket`, `jml_hari`, `nama_paket`, `harga`) VALUES
	(1, 3, 'Regular', 300000),
	(2, 7, 'Medium', 400000),
	(3, 10, 'Pro', 600000);
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel rental.tbl_testimoni: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `tbl_testimoni` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel rental.tbl_transaksi: ~3 rows (lebih kurang)
/*!40000 ALTER TABLE `tbl_transaksi` DISABLE KEYS */;
INSERT INTO `tbl_transaksi` (`id_transaksi`, `no_invoice`, `id_jadwal`, `resi`, `tagihan`, `waktu_upload`, `waktu_approve`) VALUES
	(2, 'INV20190712155210', 6, '/assets/img/resi/resi_1562974979.jpg', 1125000, '2019-07-12 00:00:00', '2019-07-13 07:02:00'),
	(5, 'INV20190712230844', 9, '/assets/img/resi/resi_1562975102.jpg', 625000, '2019-07-13 06:45:02', '2019-07-13 07:00:20'),
	(6, 'INV20190713071614', 11, NULL, 1125000, NULL, NULL);
/*!40000 ALTER TABLE `tbl_transaksi` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
