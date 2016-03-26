-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 26 Mar 2016 pada 02.32
-- Versi Server: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fikomdb`
--

DELIMITER $$
--
-- Prosedur
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_hitungan_dns`(IN krsdnsId integer)
BEGIN
	DECLARE old_ips INT DEFAULT 0;
    DECLARE jlh_dns INT DEFAULT 0;
    DECLARE jlh_sks INT DEFAULT 0;
    DECLARE new_ips float DEFAULT 0;
    DECLARE npm1 VARCHAR(9) DEFAULT '';
    DECLARE jlh_ips float DEFAULT 0;
    DECLARE ipk1 float DEFAULT 0;
    DECLARE next_sks INT DEFAULT 0;
    DECLARE smt VARCHAR(6) DEFAULT '';
    
    -- Dapatkan IPS
    SELECT IFNULL(ips, 0) FROM krsdns WHERE id = krsdnsId INTO old_ips;
	SELECT IFNULL(sum(jumlah_dns),0) FROM krsdns_detail WHERE krsdns_id = krsdnsId INTO jlh_dns;
    SELECT IFNULL(sum(sks), 0) FROM krsdns_detail WHERE krsdns_id = krsdnsId INTO jlh_sks;
    SELECT ROUND(jlh_dns/jlh_sks, 2) INTO new_ips;
    
 --   if (new_ips <> old_ips) then        
        -- Dapatkan IPK
		select mahasiswa_npm from krsdns where id=krsdnsId into npm1;
		select semester from krsdns where id=krsdnsId into smt;
        if (smt <= 1) then
			SET jlh_ips = new_ips;
		else 
			select sum(ips)+new_ips from krsdns where semester < smt and mahasiswa_npm = npm1 into jlh_ips;
		end if;
		select ROUND(jlh_ips/smt, 2) into ipk1;  
        
        -- Dapatkan Beban SKS Semester Berikut
		CASE 
			WHEN (new_ips >= 0 and new_ips < 1.5) THEN SET next_sks = 12;
            WHEN (new_ips >= 1.5 and new_ips < 2) THEN SET next_sks = 15;
            WHEN (new_ips >= 2 and new_ips < 2.5) THEN SET next_sks = 18;
            WHEN (new_ips >= 2.5 and new_ips < 3) THEN SET next_sks = 21;
            WHEN (new_ips >= 3 and new_ips < 4) THEN SET next_sks = 24;
			ELSE SET next_sks = 0;
		END CASE;       
		-- select concat("IPS: ", new_ips, ",Jlh IPS: ", jlh_ips, ", Smt: ", smt, ", IPK: ", ipk1);        
        -- update ips, ipk dan beban sks berikutnya
		UPDATE krsdns SET ips = new_ips, ipk = ipk1, sks_berikutnya = next_sks WHERE id = krsdnsId;    
--	end if;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_jlh_sks_diampu`(in nidn1 varchar(12))
BEGIN
	declare jlh_sks_diampu varchar(2);
    
    select sum(sks) from pengampu where dosen_nidn = nidn1 into jlh_sks_diampu;
    
	update dosen set sks_diampu = jlh_sks_diampu where nidn = nidn1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_total_sks`(IN krsdnsId integer)
BEGIN
	DECLARE old_total_sks INT DEFAULT 0;
    DECLARE new_total_sks INT DEFAULT 0;
    
    SELECT IFNULL(total_sks, 0) FROM krsdns WHERE id = krsdnsId INTO old_total_sks;
	SELECT sum(sks) FROM krsdns_detail WHERE krsdns_id = krsdnsId INTO new_total_sks;
    
    if (new_total_sks <> old_total_sks) then
		UPDATE krsdns SET total_sks = new_total_sks where id = krsdnsId;
	end if;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dosen`
--

CREATE TABLE IF NOT EXISTS `dosen` (
  `nidn` varchar(12) NOT NULL,
  `nama_dosen` varchar(65) NOT NULL,
  `pangkat` varchar(15) DEFAULT NULL,
  `homebase` varchar(35) NOT NULL,
  `email` varchar(25) DEFAULT NULL,
  `foto` varchar(245) DEFAULT NULL,
  `sks_diampu` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `dosen`
--

INSERT INTO `dosen` (`nidn`, `nama_dosen`, `pangkat`, `homebase`, `email`, `foto`, `sks_diampu`) VALUES
('123131', 'Abrurrahman', 'Asisten Ahli', 'Sistem Informasi - S1', 'abdurrahman@yahoo.com', 'uploads/foto/123131.jpg', NULL),
('1404068101', 'Iyus Supriadi, MT.', 'Asisten Ahli', 'Sistem Informasi - S1', 'yubis.biz@gmail.com', '', NULL),
('23423456', 'Ahmad Sujana, MS.i', 'Asisten Ahli', 'Sistem Informasi - S1', 'ahmad@yahoo.com', 'uploads/foto/23423456.jpg', '9'),
('2345', 'Agus Supriatna, MT.', 'Asisten Ahli', 'Teknik Informatika - S1', 'agus@gmail.com', '', NULL),
('234536', 'Dahlan Sukarna, MT.', 'Asisten Ahli', 'Teknik Informatika - S1', 'dahlan@gmail.com', '', NULL),
('23453634', 'Abdullah Sukrisno, MT.', 'Lektor Kepala', 'Sistem Informasi - S1', 'abullah@yahoo.com', '', '2'),
('463', 'Abdul Gozi, ST., MT.', 'Lektor', 'Sistem Informasi - S1', 'abdulgozi@gmail.com', 'uploads/foto/463.jpg', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `krsdns`
--

CREATE TABLE IF NOT EXISTS `krsdns` (
`id` int(11) NOT NULL,
  `tahun_akademik` varchar(15) NOT NULL,
  `semester` varchar(6) NOT NULL,
  `mahasiswa_npm` varchar(9) NOT NULL,
  `nama_mhs` varchar(65) DEFAULT NULL,
  `prodi_nama_jenjang` varchar(35) NOT NULL,
  `dosen_wali` varchar(45) DEFAULT NULL,
  `total_sks` varchar(3) DEFAULT NULL,
  `ips` varchar(6) DEFAULT NULL,
  `ipk` varchar(6) DEFAULT NULL,
  `sks_berikutnya` varchar(3) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `krsdns`
--

INSERT INTO `krsdns` (`id`, `tahun_akademik`, `semester`, `mahasiswa_npm`, `nama_mhs`, `prodi_nama_jenjang`, `dosen_wali`, `total_sks`, `ips`, `ipk`, `sks_berikutnya`) VALUES
(14, '2015-2016', '3', '2323429', 'Lilis Susanti', 'Sistem Informasi - S1', 'Agus Supriatna, MT.', '8', '2.38', '0.67', '18'),
(15, '2015-2016', '3', '456546', 'abullah', 'Sistem Informasi - S1', 'Ahmad Sujana, MS.i', '11', NULL, NULL, NULL),
(17, '2015-2016', '3', '4565231', 'Ahmad Ginting', 'Teknik Informatika - S1', 'Dahlan Sukarna, MT.', '8', NULL, NULL, NULL),
(18, '2015-2016', '2', '4565231', 'Ahmad Ginting', 'Teknik Informatika - S1', 'Dahlan Sukarna, MT.', '5', NULL, NULL, NULL),
(22, '2015-2016', '1', '45634', 'Mince Susanti', 'Teknik Informatika - S1', 'Abdullah Sukrisno, MT.', '13', '3.31', '3.31', '24'),
(24, '2015-2016', '2', '45634', 'Mince Susanti', 'Teknik Informatika - S1', 'Abdullah Sukrisno, MT.', '17', '3.29', '3.3', '24'),
(25, '2015-2016', '1', '4565231', 'Ahmad Ginting', 'Teknik Informatika - S1', 'Dahlan Sukarna, MT.', '14', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `krsdns_detail`
--

CREATE TABLE IF NOT EXISTS `krsdns_detail` (
`id` int(11) NOT NULL,
  `krsdns_id` int(11) NOT NULL,
  `matakuliah_kode` varchar(9) NOT NULL,
  `nama_mk` varchar(65) DEFAULT NULL,
  `semester_mk` varchar(6) DEFAULT NULL,
  `sks` varchar(2) DEFAULT NULL,
  `gangen` varchar(6) DEFAULT NULL,
  `status` varchar(2) DEFAULT NULL,
  `nilai` varchar(2) DEFAULT NULL,
  `nilai_bobot` varchar(2) DEFAULT NULL,
  `jumlah_dns` varchar(2) DEFAULT NULL,
  `nama_pengampu` varchar(65) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `krsdns_detail`
--

INSERT INTO `krsdns_detail` (`id`, `krsdns_id`, `matakuliah_kode`, `nama_mk`, `semester_mk`, `sks`, `gangen`, `status`, `nilai`, `nilai_bobot`, `jumlah_dns`, `nama_pengampu`) VALUES
(9, 15, '34341', 'Struktur Data1', '2', '3', NULL, 'B', NULL, NULL, NULL, ''),
(13, 17, '23451', 'Kalkulus 1', '2', '3', NULL, 'B', NULL, NULL, NULL, ''),
(14, 17, '3456', 'Struktur Data 2', '3', '3', NULL, 'B', NULL, NULL, NULL, ''),
(19, 14, '20201', 'Paket Program Niaga', '2', '2', NULL, 'B', 'C', '2', '4', ''),
(20, 17, '20201', 'Paket Program Niaga', '2', '2', NULL, 'B', NULL, NULL, NULL, ''),
(35, 15, '23451', 'Kalkulus 1', '2', '3', NULL, 'B', NULL, NULL, NULL, ''),
(37, 15, '10401', 'Bahasa Ingris', '1', '3', NULL, 'B', NULL, NULL, NULL, ''),
(39, 14, '23451', 'Kalkulus 1', '2', '3', NULL, 'B', 'A', '4', '12', ''),
(40, 14, '23452', 'Kalkulus2', '3', '3', NULL, 'B', 'D', '1', '3', 'Ahmad Sujana, MS.i'),
(41, 18, '20101', 'Dasar Manajemen dan Bisnis', '2', '2', NULL, 'B', NULL, NULL, NULL, ''),
(42, 18, '23459', 'Probabilitas dan Statistik', '3', '3', NULL, 'U', NULL, NULL, NULL, ''),
(51, 22, '20101', 'Dasar Manajemen dan Bisnis', '2', '2', NULL, 'B', 'C', '2', '4', ''),
(52, 22, '23451', 'Kalkulus 1', '2', '3', NULL, 'B', 'A', '4', '12', ''),
(53, 22, '23452', 'Kalkulus2', '3', '3', NULL, 'B', 'A', '4', '12', ''),
(54, 22, '34341', 'Struktur Data1', '2', '3', NULL, 'B', 'B', '3', '9', ''),
(55, 22, '55678', 'Manajemen Sistem Informasi', '1', '2', NULL, 'B', 'B', '3', '6', ''),
(59, 24, '20201', 'Paket Program Niaga', '2', '2', NULL, 'B', 'A', '4', '8', ''),
(60, 24, '23451', 'Kalkulus 1', '2', '3', NULL, 'B', 'B', '3', '9', ''),
(61, 24, '34341', 'Struktur Data1', '2', '3', NULL, 'B', 'A', '4', '12', ''),
(62, 24, '10401', 'Bahasa Ingris', '1', '3', NULL, 'B', 'C', '2', '6', ''),
(63, 24, '3456', 'Struktur Data 2', '3', '3', NULL, 'B', 'B', '3', '9', ''),
(64, 24, '23459', 'Probabilitas dan Statistik', '3', '3', NULL, 'B', 'A', '4', '12', ''),
(65, 25, '20201', 'Paket Program Niaga', '2', '2', NULL, 'B', NULL, NULL, NULL, ''),
(66, 25, '10401', 'Bahasa Ingris', '1', '3', NULL, 'B', NULL, NULL, NULL, ''),
(67, 25, '23452', 'Kalkulus2', '3', '3', NULL, 'B', NULL, NULL, NULL, ''),
(68, 25, '23459', 'Probabilitas dan Statistik', '3', '3', NULL, 'B', NULL, NULL, NULL, ''),
(69, 25, '3456', 'Struktur Data 2', '3', '3', NULL, 'B', NULL, NULL, NULL, ''),
(70, 15, '20101', 'Dasar Manajemen dan Bisnis', '2', '2', NULL, 'B', NULL, NULL, NULL, 'Ahmad Sujana, MS.i');

--
-- Trigger `krsdns_detail`
--
DELIMITER //
CREATE TRIGGER `krsdns_detail_AFTER_INSERT` AFTER INSERT ON `krsdns_detail`
 FOR EACH ROW BEGIN
	CALL update_total_sks (NEW.krsdns_id);
END
//
DELIMITER ;
DELIMITER //
CREATE TRIGGER `krsdns_detail_AFTER_UPDATE` AFTER UPDATE ON `krsdns_detail`
 FOR EACH ROW BEGIN
	CALL update_total_sks (NEW.krsdns_id);
	CALL update_hitungan_dns (NEW.krsdns_id);
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE IF NOT EXISTS `mahasiswa` (
  `npm` varchar(9) NOT NULL,
  `nama_mhs` varchar(65) NOT NULL,
  `tpt_lahir_mhs` varchar(45) DEFAULT NULL,
  `tgl_lahir_mhs` varchar(19) DEFAULT NULL,
  `jk_mhs` varchar(12) DEFAULT NULL,
  `agama_mhs` varchar(20) DEFAULT NULL,
  `suku` varchar(15) DEFAULT NULL,
  `prodi_jenjang` varchar(35) NOT NULL,
  `alamat_mhs` varchar(145) DEFAULT NULL,
  `phone_mhs` varchar(15) DEFAULT NULL,
  `email_mhs` varchar(25) DEFAULT NULL,
  `asal_slta` varchar(25) DEFAULT NULL,
  `jurusan_slta` varchar(15) DEFAULT NULL,
  `status_masuk` varchar(15) DEFAULT NULL,
  `status_kuliah` varchar(15) DEFAULT NULL,
  `dosen_wali_nidn` varchar(12) NOT NULL,
  `dosen_wali_nama` varchar(45) DEFAULT NULL,
  `foto` varchar(245) DEFAULT NULL,
  `angkatan` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`npm`, `nama_mhs`, `tpt_lahir_mhs`, `tgl_lahir_mhs`, `jk_mhs`, `agama_mhs`, `suku`, `prodi_jenjang`, `alamat_mhs`, `phone_mhs`, `email_mhs`, `asal_slta`, `jurusan_slta`, `status_masuk`, `status_kuliah`, `dosen_wali_nidn`, `dosen_wali_nama`, `foto`, `angkatan`) VALUES
('2323429', 'Lilis Susanti', '', NULL, '', '', '', 'Sistem Informasi - S1', '', '', '', '', '', '', '', '2345', 'Agus Supriatna, MT.', '', ''),
('45634', 'Mince Susanti', '', NULL, '', '', '', 'Teknik Informatika - S1', '', '', '', '', '', '', '', '23453634', 'Abdullah Sukrisno, MT.', '', ''),
('4565231', 'Ahmad Ginting', '', NULL, '', '', '', 'Teknik Informatika - S1', '', '', '', '', '', '', '', '234536', 'Dahlan Sukarna, MT.', '', ''),
('45654', 'Yuyun Sulastri', 'Ciamis', NULL, '', '', '', 'Teknik Informatika - S1', '', '', '', '', '', '', '', '2345', 'Agus Supriatna, MT.', '', ''),
('456546', 'abullah', '', NULL, '', '', '', 'Sistem Informasi - S1', '', '', '', '', '', '', '', '23423456', 'Ahmad Sujana, MS.i', '', ''),
('45654609', 'Abdullah Akbar', '', NULL, '', '', '', 'Sistem Informasi - S1', '', '', '', '', '', '', '', '1404068101', 'Iyus Supriadi, MT.', '', ''),
('4565461', 'Abdullah Mahesa', 'Bandung', NULL, '', '', '', 'Sistem Informasi - S1', '', '', '', '', '', '', '', '23423456', 'Ahmad Sujana, MS.i', '', ''),
('45654623', 'Ahyar Sukandi', '', NULL, '', '', '', 'Teknik Informatika - S1', '', '', '', '', '', '', '', '1404068101', 'Iyus Supriadi, MT.', '', ''),
('4565468', 'Ahmad Sukron', '', NULL, '', '', '', 'Sistem Informasi - S1', '', '', '', '', '', '', '', '234536', 'Dahlan Sukarna, MT.', '', ''),
('4565469', 'Akbar Tanjung', '', NULL, '', '', '', 'Sistem Informasi - S1', '', '', '', '', '', '', '', '2345', 'Agus Supriatna, MT.', '', ''),
('4565476', 'Yuni Sahara', '', NULL, '', '', '', 'Sistem Informasi - S1', '', '', '', '', '', '', '', '2345', 'Agus Supriatna, MT.', '', ''),
('867676', 'Arjuna Mencari Rezeki', 'Jayapura', '20-Ags-1994', 'Laki-laki', 'Islam', 'Asmat', 'Teknik Informatika - S1', 'Jayapura Selatan - Papua', '081322462617', 'arjuna@yahoo.com', 'SMU 4 Jayapura', 'IPA', 'Baru', 'Aktif', '123131', 'Abrurrahman', 'uploads/foto/867676.jpg', '2016'),
('867677', 'Arjuna Mencari Rezeki', 'Jayapura', '12-Desember-1995', 'Laki-laki', 'Islam', 'Asmat', 'Teknik Informatika - S1', 'Jayapura Selatan - Papua', '081322462617', 'arjuna@yahoo.com', 'SMU 4 Jayapura', 'IPA', 'Baru', 'Aktif', '123131', 'Abrurrahman', 'uploads/foto/867677.jpg', '2016'),
('867678', 'Arjuna Mencari Rezeki', 'Jayapura', '13 Desember 1991', 'Laki-laki', 'Islam', 'Asmat', 'Teknik Informatika - S1', 'Jayapura Selatan - Papua', '081322462617', 'arjuna@yahoo.com', 'SMU 4 Jayapura', 'IPA', 'Baru', 'Aktif', '123131', 'Abrurrahman', 'uploads/foto/867678.jpg', '2016'),
('867679', 'Arjuna Mencari Rezeki', 'Jayapura', '0000-00-00', 'Laki-laki', 'Islam', 'Asmat', 'Teknik Informatika - S1', 'Jayapura Selatan - Papua', '081322462617', 'arjuna@yahoo.com', 'SMU 4 Jayapura', 'IPA', 'Baru', 'Aktif', '123131', 'Abrurrahman', NULL, '2016');

-- --------------------------------------------------------

--
-- Struktur dari tabel `matakuliah`
--

CREATE TABLE IF NOT EXISTS `matakuliah` (
  `kode` varchar(9) NOT NULL,
  `nama_mk` varchar(65) NOT NULL,
  `sks` varchar(2) NOT NULL,
  `semester_mk` varchar(6) NOT NULL,
  `gangen` varchar(6) NOT NULL,
  `kelompok_mk` varchar(15) DEFAULT NULL,
  `prasyarat` varchar(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `matakuliah`
--

INSERT INTO `matakuliah` (`kode`, `nama_mk`, `sks`, `semester_mk`, `gangen`, `kelompok_mk`, `prasyarat`) VALUES
('10401', 'Bahasa Ingris', '3', '1', 'Ganjil', '', NULL),
('20101', 'Dasar Manajemen dan Bisnis', '2', '2', 'Ganjil', '', NULL),
('20201', 'Paket Program Niaga', '2', '2', 'Ganjil', '', NULL),
('2345', 'Bahasa Ingris 2', '2', '1', 'Ganjil', '', '10401'),
('23451', 'Kalkulus 1', '3', '2', 'Genap', 'Penting', ''),
('23452', 'Kalkulus2', '3', '3', 'Ganjil', '', '23451'),
('23459', 'Probabilitas dan Statistik', '3', '3', 'Ganjil', '', ''),
('34341', 'Struktur Data1', '3', '2', 'Ganjil', '', NULL),
('3456', 'Struktur Data 2', '3', '3', 'Genap', 'Penting', '34341'),
('34561', 'Pendidikan Agama Islam', '2', '1', 'Genap', 'ty', NULL),
('55678', 'Manajemen Sistem Informasi', '2', '1', 'Ganjil', 'Penting', '10401');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengampu`
--

CREATE TABLE IF NOT EXISTS `pengampu` (
`id` int(11) NOT NULL,
  `matakuliah_kode` varchar(9) NOT NULL,
  `nama_mk` varchar(65) DEFAULT NULL,
  `sks` varchar(2) DEFAULT NULL,
  `semester_mk` varchar(6) DEFAULT NULL,
  `prodi_nama_jenjang` varchar(35) NOT NULL,
  `dosen_nidn` varchar(12) NOT NULL,
  `nama_pengampu` varchar(65) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `pengampu`
--

INSERT INTO `pengampu` (`id`, `matakuliah_kode`, `nama_mk`, `sks`, `semester_mk`, `prodi_nama_jenjang`, `dosen_nidn`, `nama_pengampu`) VALUES
(2, '20101', 'Dasar Manajemen dan Bisnis', '2', '2', 'Sistem Informasi - S1', '23423456', 'Ahmad Sujana, MS.i'),
(3, '20201', 'Paket Program Niaga', '2', '2', 'Teknik Informatika - S1', '23423456', 'Ahmad Sujana, MS.i'),
(4, '23452', 'Kalkulus2', '3', '3', 'Sistem Informasi - S1', '23423456', 'Ahmad Sujana, MS.i'),
(5, '20101', 'Dasar Manajemen dan Bisnis', '2', '2', 'Teknik Informatika - D3', '2345', 'Agus Supriatna, MT.'),
(6, '20201', 'Paket Program Niaga', '2', '2', 'Sistem Informasi - S1', '2345', 'Agus Supriatna, MT.'),
(7, '2345', 'Bahasa Ingris 2', '2', '1', 'Teknik Informatika - S1', '23453634', 'Abdullah Sukrisno, MT.'),
(8, '20101', 'Dasar Manajemen dan Bisnis', '2', '2', 'Teknik Informatika - S1', '23423456', 'Ahmad Sujana, MS.i');

--
-- Trigger `pengampu`
--
DELIMITER //
CREATE TRIGGER `pengampu_AFTER_DELETE` AFTER DELETE ON `pengampu`
 FOR EACH ROW BEGIN
	call update_jlh_sks_diampu(old.dosen_nidn);
END
//
DELIMITER ;
DELIMITER //
CREATE TRIGGER `pengampu_AFTER_INSERT` AFTER INSERT ON `pengampu`
 FOR EACH ROW BEGIN
	call update_jlh_sks_diampu(new.dosen_nidn);
END
//
DELIMITER ;
DELIMITER //
CREATE TRIGGER `pengampu_AFTER_UPDATE` AFTER UPDATE ON `pengampu`
 FOR EACH ROW BEGIN
	call update_jlh_sks_diampu(new.dosen_nidn);
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `prodi`
--

CREATE TABLE IF NOT EXISTS `prodi` (
  `nama_jenjang` varchar(35) NOT NULL,
  `kode` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `prodi`
--

INSERT INTO `prodi` (`nama_jenjang`, `kode`) VALUES
('Manajemen Informatika - D3', '422'),
('Sistem Informasi - S1', '421'),
('Teknik Informatika - D3', '412'),
('Teknik Informatika - S1', '411');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
 ADD PRIMARY KEY (`nidn`), ADD KEY `fk_dosen_prodi1_idx` (`homebase`);

--
-- Indexes for table `krsdns`
--
ALTER TABLE `krsdns`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_krsdns_mahasiswa1_idx` (`mahasiswa_npm`), ADD KEY `fk_krsdns_prodi1_idx` (`prodi_nama_jenjang`);

--
-- Indexes for table `krsdns_detail`
--
ALTER TABLE `krsdns_detail`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_krsdns_detail_krsdns1_idx` (`krsdns_id`), ADD KEY `fk_krsdns_detail_matakuliah1_idx` (`matakuliah_kode`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
 ADD PRIMARY KEY (`npm`), ADD UNIQUE KEY `npm_UNIQUE` (`npm`), ADD KEY `fk_mahasiswa_dosen1_idx` (`dosen_wali_nidn`), ADD KEY `fk_mahasiswa_prodi1_idx` (`prodi_jenjang`);

--
-- Indexes for table `matakuliah`
--
ALTER TABLE `matakuliah`
 ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
 ADD PRIMARY KEY (`version`);

--
-- Indexes for table `pengampu`
--
ALTER TABLE `pengampu`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_prodi_has_matakuliah_matakuliah1_idx` (`matakuliah_kode`), ADD KEY `fk_pengampu_prodi1_idx` (`prodi_nama_jenjang`), ADD KEY `fk_pengampu_dosen1_idx` (`dosen_nidn`);

--
-- Indexes for table `prodi`
--
ALTER TABLE `prodi`
 ADD PRIMARY KEY (`nama_jenjang`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `krsdns`
--
ALTER TABLE `krsdns`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `krsdns_detail`
--
ALTER TABLE `krsdns_detail`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=71;
--
-- AUTO_INCREMENT for table `pengampu`
--
ALTER TABLE `pengampu`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `dosen`
--
ALTER TABLE `dosen`
ADD CONSTRAINT `fk_dosen_prodi1` FOREIGN KEY (`homebase`) REFERENCES `prodi` (`nama_jenjang`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `krsdns`
--
ALTER TABLE `krsdns`
ADD CONSTRAINT `fk_krsdns_mahasiswa1` FOREIGN KEY (`mahasiswa_npm`) REFERENCES `mahasiswa` (`npm`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_krsdns_prodi1` FOREIGN KEY (`prodi_nama_jenjang`) REFERENCES `prodi` (`nama_jenjang`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `krsdns_detail`
--
ALTER TABLE `krsdns_detail`
ADD CONSTRAINT `fk_krsdns_detail_krsdns1` FOREIGN KEY (`krsdns_id`) REFERENCES `krsdns` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_krsdns_detail_matakuliah1` FOREIGN KEY (`matakuliah_kode`) REFERENCES `matakuliah` (`kode`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
ADD CONSTRAINT `fk_mahasiswa_dosen1` FOREIGN KEY (`dosen_wali_nidn`) REFERENCES `dosen` (`nidn`) ON DELETE NO ACTION ON UPDATE CASCADE,
ADD CONSTRAINT `fk_mahasiswa_prodi1` FOREIGN KEY (`prodi_jenjang`) REFERENCES `prodi` (`nama_jenjang`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pengampu`
--
ALTER TABLE `pengampu`
ADD CONSTRAINT `fk_pengampu_dosen1` FOREIGN KEY (`dosen_nidn`) REFERENCES `dosen` (`nidn`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_pengampu_prodi1` FOREIGN KEY (`prodi_nama_jenjang`) REFERENCES `prodi` (`nama_jenjang`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_prodi_has_matakuliah_matakuliah1` FOREIGN KEY (`matakuliah_kode`) REFERENCES `matakuliah` (`kode`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
