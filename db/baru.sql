-- --------------------------------------------------------
-- Host:                         localhost
-- Versi server:                 5.7.19 - MySQL Community Server (GPL)
-- OS Server:                    Win64
-- HeidiSQL Versi:               9.4.0.5125
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
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `foto` text,
  `tlp` varchar(15) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `tipe` varchar(10) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel rental.tbl_admin: ~5 rows (lebih kurang)
/*!40000 ALTER TABLE `tbl_admin` DISABLE KEYS */;
INSERT INTO `tbl_admin` (`id_admin`, `nama_lengkap`, `email`, `foto`, `tlp`, `password`, `tempat_lahir`, `tanggal_lahir`, `tipe`, `status`) VALUES
	(1, 'administrator', 'admin@gmail.com', 'assets/img/team-1.jpg', '08977153192871', 'admin', 'jakarta', '2019-07-06', 'admin', '1'),
	(2, 'Nur Kholis', 'nur@gmail.com', 'assets/img/team-1.jpg', '08977153624', 'nur', 'jakarta', '2019-07-06', 'pengajar', '1'),
	(3, 'Boediman', 'budi@gmail.com', 'assets/img/team-2.jpg', '0829372818', 'boedi', 'tangerang', '2019-07-06', 'pengajar', '1'),
	(4, 'Tisna', 'tisna@gmail.com', 'assets/img/team-3.jpg', '089771872627', 'tisna', 'bandung', '2019-07-06', 'pengajar', '1'),
	(5, 'Endang', 'endang@gmail.com', 'assets/img/team-4.jpg', '08787282911', 'emung', 'Sukabumi', '2019-07-06', 'pengajar', '1');
/*!40000 ALTER TABLE `tbl_admin` ENABLE KEYS */;

-- membuang struktur untuk table rental.tbl_customer
CREATE TABLE IF NOT EXISTS `tbl_customer` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nik` int(20) DEFAULT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `tlp` varchar(100) DEFAULT NULL,
  `tipe` varchar(10) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `nik` (`nik`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel rental.tbl_customer: ~4 rows (lebih kurang)
/*!40000 ALTER TABLE `tbl_customer` DISABLE KEYS */;
INSERT INTO `tbl_customer` (`id_user`, `nik`, `nama_lengkap`, `email`, `password`, `tempat_lahir`, `tanggal_lahir`, `foto`, `tlp`, `tipe`, `status`) VALUES
	(1, 1234, 'udiin ', 'udin@gmail.com', 'udin', 'tangerang', '2019-07-06', NULL, NULL, 'siswa', '1'),
	(2, 123, 'Dina', 'dina@gmail.com', 'dina', 'Bandung', '2019-07-06', NULL, NULL, 'siswa', '1'),
	(7, 23456789, 'dimas', 'a@gmail.com', '7d49e40f4b3d8f68c19406a58303f826', 'jakarta', '2013-04-04', '/assets/img/client/client_1562475619', '08977153624', 'siswa', '1'),
	(8, 345678, 'dimas', 'a@gmail.com', '0cc175b9c0f1b6a831c399e269772661', 'jakarta', '2016-05-04', '/assets/img/client/client_1562475853..png', '08977153624', 'siswa', '1');
/*!40000 ALTER TABLE `tbl_customer` ENABLE KEYS */;

-- membuang struktur untuk table rental.tbl_jadwal
CREATE TABLE IF NOT EXISTS `tbl_jadwal` (
  `id_jadwal` int(11) NOT NULL AUTO_INCREMENT,
  `id_penyewa` int(11) DEFAULT '0',
  `id_supir` int(11) DEFAULT '0',
  `id_mobil` int(11) DEFAULT '0',
  `tanggal` date DEFAULT NULL,
  `jam` varchar(50) DEFAULT NULL,
  `status_jadwal` varchar(50) DEFAULT 'wait',
  PRIMARY KEY (`id_jadwal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel rental.tbl_jadwal: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `tbl_jadwal` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_jadwal` ENABLE KEYS */;

-- membuang struktur untuk table rental.tbl_mobil
CREATE TABLE IF NOT EXISTS `tbl_mobil` (
  `id_mobil` int(11) NOT NULL AUTO_INCREMENT,
  `nama_mobil` varchar(100) DEFAULT NULL,
  `gambar` text,
  `tahun_keluar` varchar(5) DEFAULT NULL,
  `jenis` varchar(2) DEFAULT NULL,
  `qty` int(5) DEFAULT '0',
  PRIMARY KEY (`id_mobil`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel rental.tbl_mobil: ~9 rows (lebih kurang)
/*!40000 ALTER TABLE `tbl_mobil` DISABLE KEYS */;
INSERT INTO `tbl_mobil` (`id_mobil`, `nama_mobil`, `gambar`, `tahun_keluar`, `jenis`, `qty`) VALUES
	(1, 'agya', 'assets/img/mobil/agya.png', '2017', 'AT', 1),
	(2, 'agya-kuning', 'assets/img/mobil/agya-yellow.png', '2017', 'AT', 1),
	(3, 'avanza', 'assets/img/mobil/avanza.png', '2017', 'AT', 1),
	(4, 'avanza-biru', 'assets/img/mobil/avanza-blue.png', '2017', 'AT', 1),
	(5, 'calya', 'assets/img/mobil/calya.png', '2017', 'AT', 1),
	(6, 'inova', 'assets/img/mobil/inova.png', '2017', 'AT', 1),
	(7, 'inova', 'assets/img/mobil/veloz.png', '2017', 'AT', 1),
	(8, 'terios', 'assets/img/mobil/terrios.png', '2017', 'AT', 1),
	(9, 'Elf', 'assets/img/mobil/elf.png', '2017', 'AT', 1);
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
  `id_trasaksi` int(11) NOT NULL,
  `no_invoice` varchar(50) DEFAULT NULL,
  `id_jadwal` int(5) DEFAULT NULL,
  `resi` int(5) DEFAULT NULL,
  `waktu_upload` timestamp NULL DEFAULT NULL,
  `waktu_approve` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_trasaksi`),
  UNIQUE KEY `no_invoice` (`no_invoice`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel rental.tbl_transaksi: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `tbl_transaksi` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_transaksi` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
