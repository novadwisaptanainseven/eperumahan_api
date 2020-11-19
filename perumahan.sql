-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2020 at 08:57 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perumahan`
--

-- --------------------------------------------------------

--
-- Table structure for table `bangunan`
--

CREATE TABLE `bangunan` (
  `id_bangunan` int(11) NOT NULL,
  `id_perumahan` int(11) NOT NULL,
  `id_pengembang` int(11) DEFAULT NULL,
  `id_kecamatan` int(11) NOT NULL,
  `id_kelurahan` int(11) NOT NULL,
  `kategori_bangunan` varchar(100) NOT NULL,
  `tipe_bangunan` varchar(200) NOT NULL,
  `nama_bangunan` varchar(100) NOT NULL,
  `deskripsi_bangunan` text NOT NULL,
  `harga_bangunan` int(11) NOT NULL,
  `lokasi_bangunan` text NOT NULL,
  `jumlah_tersedia` varchar(200) NOT NULL,
  `luas_bangunan` int(11) NOT NULL,
  `luas_tanah` int(11) NOT NULL,
  `dimensi_bangunan` varchar(50) NOT NULL,
  `dimensi_tanah` varchar(50) NOT NULL,
  `jumlah_lantai` varchar(20) NOT NULL,
  `jumlah_kamar` varchar(20) NOT NULL,
  `jumlah_kamar_mandi` varchar(20) NOT NULL,
  `jumlah_garasi` varchar(10) NOT NULL,
  `listrik` varchar(20) NOT NULL,
  `longitude` varchar(200) NOT NULL,
  `latitude` varchar(200) NOT NULL,
  `sertifikat` text NOT NULL,
  `status_publish` varchar(10) NOT NULL,
  `bangunan_slug` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bangunan`
--

INSERT INTO `bangunan` (`id_bangunan`, `id_perumahan`, `id_pengembang`, `id_kecamatan`, `id_kelurahan`, `kategori_bangunan`, `tipe_bangunan`, `nama_bangunan`, `deskripsi_bangunan`, `harga_bangunan`, `lokasi_bangunan`, `jumlah_tersedia`, `luas_bangunan`, `luas_tanah`, `dimensi_bangunan`, `dimensi_tanah`, `jumlah_lantai`, `jumlah_kamar`, `jumlah_kamar_mandi`, `jumlah_garasi`, `listrik`, `longitude`, `latitude`, `sertifikat`, `status_publish`, `bangunan_slug`) VALUES
(9, 6, 7, 3, 21, 'MBR', '36', 'Rumah MBR murah', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 120000000, 'Jalan Dama', '200', 120, 130, '10 x 12', '10 x 12', '1', '2', '2', '1', '900', '', '', '', '1', 'rumah-mbr-murah-19050285'),
(10, 6, 7, 3, 21, 'NON MBR', '45', 'Rumah hunian sederhana', '-', 250000000, 'Jalan Dama', '100', 200, 210, '20 x 10', '21 x 10', '2', '3', '2', '1', '4400', '', '', '', '1', 'rumah-hunian-sederhana-190422945'),
(11, 6, 7, 3, 21, 'NON MBR', '45', 'Rumah Siap Huni', '-', 250000000, 'Jalan Dama', '100', 200, 210, '20 x 10', '20 x 10', '2', '3', '2', '1', '4400', '', '', '', '1', 'rumah-siap-huni-190820160'),
(12, 9, 7, 5, 6, 'MBR', '45', 'Rumah MBR keren', '-', 50000000, 'Jalan Keledang', '5', 200, 220, '20 x 10', '20 x 11', '1', '1', '1', '3', '4400', '', '', '', '1', 'rumah-mbr-keren-190502395'),
(13, 6, 7, 3, 21, 'MBR', '45', 'Rumah Siap Huni', '-', 123, 'Jalan Dama', '234', 200, 220, '22 x 11', '11 x 22', '1', '8', '6', '2', '10000', '', '', '', '1', 'rumah-siap-huni-190912213'),
(14, 6, 7, 3, 21, 'MBR', '36', 'Rumah MBR 2020', 'Ayo beli rumah MBR tahun 2020 di perumahan baru, bebas banjir dan akses mudah dengan pusat kota', 90000000, 'Jalan Dama', '5', 180, 200, '12 x 10', '10 x 20', '1', '3', '2', '1', '1300', '', '', '', '0', 'rumah-mbr-2020-200804964'),
(15, 15, 7, 10, 49, 'NON MBR', '36', 'Rumah tipe 36', 'dijual rumah tipe 36', 150000000, 'Jalan Panjaitan', '100', 80, 150, '10 x 8', '10 x 15', '2', '4', '2', '1', '2200', '', '', '', '1', 'rumah-tipe-36-201012747'),
(16, 16, 7, 6, 16, 'MBR', '36', 'Rumah tipe 36A', 'Rumah murah tipe 36 2020', 100000000, 'Jalan Kadrie Oneng', '100', 80, 150, '8 x 10', '10 x 15', '2', '4', '2', '1', '2200', '', '', '', '1', 'rumah-tipe-36a-201014558'),
(17, 6, 7, 3, 21, 'MBR', '45', 'tes', '1', 1, 'Jalan Dama', '1', 1, 1, '1 x 1', '1 x 1', '1', '1', '1', '1', '450', '', '', '', '2', 'tes-201015386'),
(18, 18, 23, 1, 61, 'NON MBR', '54/120', 'Cluster Kakaban', 'Rumah Unit Tipe 54/120', 802000000, 'Jl. H.A.M.M Riffadin Ruko E2-11, Harapan Baru, Kec. Loa Janan Ilir Kota Samarinda Kalimantan Timur 75131', '3', 54, 120, '8 x 7', '8 x 15', '1', '2', '1', '1', '1300', '', '', '', '1', 'cluster-kakaban-201015525'),
(19, 18, 23, 1, 61, 'NON MBR', '48/105', 'Cluster Kakaban', 'Rumah Unit  Tipe 48/105', 727000000, 'Jl. H.A.M.M Riffadin Ruko E2-11, Harapan Baru, Kec. Loa Janan Ilir Kota Samarinda Kalimantan Timur 75131', '5', 48, 105, '8 x 6', '7 x 15', '1', '2', '1', '1', '1300', '', '', '', '1', 'cluster-kakaban-201015875'),
(20, 18, 23, 1, 61, 'NON MBR', '96', 'Cluster Maya', 'Rumah Unit Tipe 96/200', 1381000000, 'Jl. H.A.M.M Riffadin Ruko E2-11, Harapan Baru, Kec. Loa Janan Ilir Kota Samarinda Kalimantan Timur 75131', '5', 96, 200, '8 x 6', '8 x 16', '2', '4', '3', '1', '1300', '', '', '', '1', 'cluster-maya-201015837'),
(21, 19, 7, 6, 16, 'MBR', '36', 'Rumah murah baru 2020', 'deksripsi', 140000000, 'lokasi perumahan', '100', 100, 150, '10 x 10', '10 x 15', '2', '3', '2', '1', '1300', '', '', '', '1', 'rumah-murah-baru-2020-201021153');

-- --------------------------------------------------------

--
-- Table structure for table `brosur_pengembang`
--

CREATE TABLE `brosur_pengembang` (
  `id_brosur_pengembang` int(11) NOT NULL,
  `id_pengembang` int(11) NOT NULL,
  `brosur_pengembang` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas`
--

CREATE TABLE `fasilitas` (
  `id_fasilitas` int(11) NOT NULL,
  `id_bangunan` int(11) NOT NULL,
  `nama_fasilitas` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas_perumahan`
--

CREATE TABLE `fasilitas_perumahan` (
  `id_fasilitas_perumahan` int(11) NOT NULL,
  `id_perumahan` int(11) NOT NULL,
  `nama_fasilitas_perumahan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fasilitas_perumahan`
--

INSERT INTO `fasilitas_perumahan` (`id_fasilitas_perumahan`, `id_perumahan`, `nama_fasilitas_perumahan`) VALUES
(5, 7, 'Fasilitas'),
(6, 8, 'Fasilitas'),
(9, 6, 'Fasilitas'),
(10, 6, 'Fasilitas12'),
(11, 1, 'Fasilitas'),
(12, 9, 'Fasilitas'),
(13, 10, 'Rumah Sehat'),
(14, 11, 'Fasilitas'),
(15, 12, 'Rumah Sehat'),
(16, 13, 'Fasilitas'),
(17, 14, 'Puskesmas'),
(18, 15, 'Keamanan'),
(19, 16, 'Keamanan'),
(20, 17, 'Security'),
(21, 17, 'Security'),
(23, 18, 'Playground'),
(24, 18, 'ATM Center'),
(26, 18, 'Area Komersil'),
(27, 18, 'Lake Side/ Area Danau'),
(28, 19, 'Keamanan'),
(29, 20, 'Alaya Food Festifal'),
(30, 20, 'Mall Giant Ekstra'),
(31, 20, 'Bank Mandiri'),
(32, 20, 'Kolam Renang dan Resto'),
(33, 20, 'Club House'),
(34, 20, 'Mesin ATM'),
(35, 20, 'Joging Track'),
(36, 21, 'tes'),
(37, 1, 'Kolam Renang');

-- --------------------------------------------------------

--
-- Table structure for table `form_data_perumahan`
--

CREATE TABLE `form_data_perumahan` (
  `id_form_data_perumahan` int(11) NOT NULL,
  `id_pengembang` int(11) NOT NULL,
  `file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `foto_bangunan`
--

CREATE TABLE `foto_bangunan` (
  `id_foto_bangunan` int(11) NOT NULL,
  `id_bangunan` int(11) NOT NULL,
  `foto_bangunan` text NOT NULL,
  `level_foto` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `foto_bangunan`
--

INSERT INTO `foto_bangunan` (`id_foto_bangunan`, `id_bangunan`, `foto_bangunan`, `level_foto`) VALUES
(9, 9, 'november_2017.jpg', '1'),
(12, 11, 'rumah21.jpg', '0'),
(14, 9, 'rumah3.jpg', '0'),
(15, 10, 'home_slider_1.jpg', '0'),
(16, 10, 'november_20171.jpg', '1'),
(17, 11, 'rumah.jpg', '1'),
(18, 9, 'Top-60-Employee-Engagement-image24-1024x511.png', '0'),
(19, 12, 'Screenshot_(6).png', '1'),
(20, 12, 'Screenshot_(5).png', '0'),
(22, 13, 'november_20172.jpg', '1'),
(23, 14, 'image-upload.png', '1'),
(24, 15, 'download_(1).jpg', '0'),
(25, 15, 'download.jpg', '1'),
(26, 16, 'download_(1)1.jpg', '0'),
(27, 16, 'download1.jpg', '1'),
(28, 17, 'file.png', '1'),
(29, 18, 'WhatsApp_Image_2020-10-05_at_12_25_33.jpeg', '1'),
(30, 19, 'tipe_48.jpg', '1'),
(31, 20, 'PHOTO_20200527_095931.jpg', '1'),
(32, 20, 'PHOTO_20200527_100127.jpg', '0'),
(33, 21, 'download2.jpg', '1');

-- --------------------------------------------------------

--
-- Table structure for table `foto_perumahan`
--

CREATE TABLE `foto_perumahan` (
  `id_foto_perumahan` int(11) NOT NULL,
  `id_perumahan` int(11) NOT NULL,
  `foto_perumahan` varchar(200) NOT NULL,
  `status_foto` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `foto_perumahan`
--

INSERT INTO `foto_perumahan` (`id_foto_perumahan`, `id_perumahan`, `foto_perumahan`, `status_foto`) VALUES
(16, 7, 'Screenshot_(1).png', '0'),
(19, 1, 'sports-time-woman-run-running-track-against-city-background-modern-vector-illustration-concept-woman-run-running-track-131162438.jpg', '1'),
(20, 1, 'home_slider_1.jpg', '0'),
(21, 6, 'rumah2.jpg', '0'),
(22, 7, 'rumah21.jpg', '1'),
(24, 6, 'november_20171.jpg', '1'),
(25, 9, 'Screenshot_(11).png', '0'),
(26, 9, 'Screenshot_(9).png', '1'),
(27, 10, 'Screenshot_(28).png', '0'),
(28, 10, 'Screenshot_(29).png', '1'),
(29, 11, 'Screenshot_(25).png', '0'),
(30, 11, 'Screenshot_(32).png', '1'),
(31, 12, 'Screenshot_(2).png', '1'),
(32, 12, 'Screenshot_(6)1.png', '0'),
(33, 13, 'Screenshot_(25)1.png', '1'),
(34, 14, 'image-upload.png', '1'),
(37, 16, 'download_(1)1.jpg', '1'),
(38, 17, 'citraland.jpg', '1'),
(39, 18, 'WhatsApp_Image_2020-10-05_at_12_25_33.jpeg', '1'),
(40, 19, 'download1.jpg', '1'),
(41, 20, 'Gerbang_cluster_damar_kembang_juni_2013_a_kirim.jpg', '1'),
(42, 21, 'IMG_20200917_094518.jpg', '1'),
(43, 15, 'bg-flat.png', '1'),
(44, 15, 'rumahsehar.png', '0');

-- --------------------------------------------------------

--
-- Table structure for table `kecamatan`
--

CREATE TABLE `kecamatan` (
  `id_kecamatan` int(11) NOT NULL,
  `nama_kecamatan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kecamatan`
--

INSERT INTO `kecamatan` (`id_kecamatan`, `nama_kecamatan`) VALUES
(1, 'Loa Janan Ilir'),
(2, 'Palaran'),
(3, 'Samarinda Ilir'),
(4, 'Samarinda Kota'),
(5, 'Samarinda Seberang'),
(6, 'Samarinda Ulu'),
(7, 'Samarinda Utara'),
(8, 'Sambutan'),
(9, 'Sungai Kunjang'),
(10, 'Sungai Pinang');

-- --------------------------------------------------------

--
-- Table structure for table `kelurahan`
--

CREATE TABLE `kelurahan` (
  `id_kelurahan` int(11) NOT NULL,
  `id_kecamatan` int(11) NOT NULL,
  `nama_kelurahan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelurahan`
--

INSERT INTO `kelurahan` (`id_kelurahan`, `id_kecamatan`, `nama_kelurahan`) VALUES
(1, 2, 'Rawa Makmur'),
(2, 2, 'Handil Bakti'),
(3, 2, 'Bukuan'),
(4, 2, 'Simpang Pasir'),
(5, 2, 'Bantuas'),
(6, 5, 'Sungai Keledang'),
(7, 5, 'Baqa'),
(8, 5, 'Mesjid'),
(9, 5, 'Mangkupalas'),
(10, 5, 'Tenun'),
(11, 5, 'Gunung Panjang'),
(12, 6, 'Teluk Lerong Ilir'),
(13, 6, 'Jawa'),
(14, 6, 'Air Putih'),
(15, 6, 'Sidodadi'),
(16, 6, 'Air Hitam'),
(17, 6, 'Dadi Mulya'),
(18, 6, 'Gunung Kelua'),
(19, 6, 'Bukit Pinang'),
(20, 3, 'Selili'),
(21, 3, 'Sungai Dama'),
(24, 3, 'Sidomulyo'),
(25, 3, 'Sidodamai'),
(26, 3, 'Pelita'),
(27, 7, 'Sempaja Selatan'),
(29, 7, 'Lempake'),
(30, 7, 'Sungai Siring'),
(31, 7, 'Sempaja Utara'),
(32, 7, 'Tanah Merah'),
(33, 7, 'Sempaja Barat'),
(34, 7, 'Sempaja Timur'),
(35, 7, 'Budaya Pampang'),
(36, 9, 'Loa Bakung'),
(37, 9, 'Loa Buah'),
(38, 9, 'Karang Asam Ulu'),
(39, 9, 'Lok Bahu'),
(40, 9, 'Teluk Lerong Ulu'),
(41, 9, 'Karang Asam Ilir'),
(42, 9, 'Karang Anyar'),
(43, 8, 'Sungai Kapih'),
(44, 8, 'Sambutan'),
(45, 8, 'Makroman'),
(46, 8, 'Sindang Sari'),
(47, 8, 'Pulau Atas'),
(48, 10, 'Temindung Permai'),
(49, 10, 'Sungai Pinang Dalam'),
(50, 10, 'Gunung Lingai'),
(51, 10, 'Mugirejo'),
(52, 10, 'Bandara'),
(53, 4, 'Karang Mumus'),
(54, 4, 'Pelabuhan'),
(55, 4, 'Pasar Pagi'),
(56, 4, 'Bugis'),
(57, 4, 'Sungai Pinang Luar'),
(58, 1, 'Simpang Tiga'),
(59, 1, 'Tani Aman'),
(60, 1, 'Sengkotek'),
(61, 1, 'Harapan Baru'),
(62, 1, 'Rapak Dalam');

-- --------------------------------------------------------

--
-- Table structure for table `kontak`
--

CREATE TABLE `kontak` (
  `id_kontak` int(11) NOT NULL,
  `kontak_nama` text NOT NULL,
  `kontak_telepon` text NOT NULL,
  `kontak_pesan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kontak`
--

INSERT INTO `kontak` (`id_kontak`, `kontak_nama`, `kontak_telepon`, `kontak_pesan`) VALUES
(2, 'iqbal wahyudi2', '082352260345', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod'),
(3, 'iqbal wahyudi', '082352260345', 'pesan pesan'),
(4, 'iqbal wahyudi', '0823542222341', 'ini pesanssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss'),
(5, 'iqbal wahyudi', '0823542222341', '-');

-- --------------------------------------------------------

--
-- Table structure for table `laporan_aktivitas`
--

CREATE TABLE `laporan_aktivitas` (
  `id_laporan_aktivitas` int(11) NOT NULL,
  `id_pengembang` int(11) NOT NULL,
  `bulan` varchar(25) NOT NULL,
  `tahun` int(11) NOT NULL,
  `status_laporan` varchar(10) NOT NULL,
  `verifikator` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `laporan_aktivitas`
--

INSERT INTO `laporan_aktivitas` (`id_laporan_aktivitas`, `id_pengembang`, `bulan`, `tahun`, `status_laporan`, `verifikator`) VALUES
(1, 7, 'januari', 2019, '1', 'admin'),
(2, 7, 'februari', 2020, '0', '');

-- --------------------------------------------------------

--
-- Table structure for table `laporan_aktivitas_detail`
--

CREATE TABLE `laporan_aktivitas_detail` (
  `id_laporan_aktivitas_detail` int(11) NOT NULL,
  `id_laporan_aktivitas` int(11) NOT NULL,
  `lokasi_kegiatan` varchar(250) NOT NULL,
  `kegiatan` text NOT NULL,
  `persentase_kegiatan` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `file` varchar(250) NOT NULL,
  `status_delete` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `laporan_aktivitas_detail`
--

INSERT INTO `laporan_aktivitas_detail` (`id_laporan_aktivitas_detail`, `id_laporan_aktivitas`, `lokasi_kegiatan`, `kegiatan`, `persentase_kegiatan`, `keterangan`, `file`, `status_delete`) VALUES
(1, 1, 'Jalan Lokasi Kegiatan1', '<p>Jalan Lokasi Kegiatan1Jalan Lokasi Kegiatan1Jalan Lokasi Kegiatan1Jalan Lokasi Kegiatan1Jalan Lokasi Kegiatan1Jalan Lokasi Kegiatan1Jalan Lokasi Kegiatan1Jalan Lokasi Kegiatan1Jalan Lokasi Kegiatan1Jalan Lokasi Kegiatan1Jalan Lokasi Kegiatan1Jalan Lokasi Kegiatan1Jalan Lokasi Kegiatan1Jalan Lokasi Kegiatan1Jalan Lokasi Kegiatan1Jalan Lokasi Kegiatan1Jalan Lokasi Kegiatan1Jalan Lokasi Kegiatan1Jalan Lokasi Kegiatan1Jalan Lokasi Kegiatan1</p>', '2%', '-', 'automation.png', '0');

-- --------------------------------------------------------

--
-- Table structure for table `laporan_penjualan`
--

CREATE TABLE `laporan_penjualan` (
  `id_laporan_penjualan` int(11) NOT NULL,
  `id_pengembang` int(11) NOT NULL,
  `bulan` varchar(25) NOT NULL,
  `tahun` int(11) NOT NULL,
  `status_laporan` varchar(20) NOT NULL,
  `verifikator` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `laporan_penjualan`
--

INSERT INTO `laporan_penjualan` (`id_laporan_penjualan`, `id_pengembang`, `bulan`, `tahun`, `status_laporan`, `verifikator`) VALUES
(1, 7, 'januari', 2019, '1', 'pengembang'),
(2, 7, 'februari', 2020, '0', '');

-- --------------------------------------------------------

--
-- Table structure for table `laporan_penjualan_detail`
--

CREATE TABLE `laporan_penjualan_detail` (
  `id_laporan_penjualan_detail` int(11) NOT NULL,
  `id_laporan_penjualan` int(11) NOT NULL,
  `jenis_terjual` varchar(200) NOT NULL,
  `unit_terjual` varchar(100) NOT NULL,
  `pembeli` varchar(200) NOT NULL,
  `keterangan` varchar(250) NOT NULL,
  `file` varchar(250) NOT NULL,
  `status_delete` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `laporan_penjualan_detail`
--

INSERT INTO `laporan_penjualan_detail` (`id_laporan_penjualan_detail`, `id_laporan_penjualan`, `jenis_terjual`, `unit_terjual`, `pembeli`, `keterangan`, `file`, `status_delete`) VALUES
(1, 1, 'Tipe 36', '5', 'Samarinda', 'asasd', '791793.jpg', '0');

-- --------------------------------------------------------

--
-- Table structure for table `main_bg`
--

CREATE TABLE `main_bg` (
  `id_main_bg` int(11) NOT NULL,
  `judul` text NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `main_bg`
--

INSERT INTO `main_bg` (`id_main_bg`, `judul`, `foto`) VALUES
(1, 'header', 'BANNER_WEB_PORTAL_DISPERKIM2.png'),
(2, 'middle', 'Backgrounds_web_transparan1.jpg'),
(3, 'footer', 'background_line_art.png');

-- --------------------------------------------------------

--
-- Table structure for table `main_info`
--

CREATE TABLE `main_info` (
  `id_main_info` int(11) NOT NULL,
  `judul` text NOT NULL,
  `deskripsi` text NOT NULL,
  `foto` text NOT NULL,
  `level_info` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `main_info`
--

INSERT INTO `main_info` (`id_main_info`, `judul`, `deskripsi`, `foto`, `level_info`) VALUES
(1, 'Membantu', 'Membantu memenuhi kebutuhan perumahan yang layak dan terjangkau dalam lingkungan yang sehat dan aman yang didukung prasarana, sarana, dan utilitas umum', 'info-dua.png', 1),
(2, 'Perantara', 'Memudahkan pengembang perumahan untuk memasarkan perumahan yang di bangun', 'agreement.png', 1),
(3, 'Memfasilitasi', 'Memudahkan masyarakat dalam pencarian penjualan perumahan yang telah dibangun pengembang di samarinda', 'kisspng-internet-search-engines-help-users-for-information-5bab580f13c878_822968081537955855081.png', 1),
(4, 'Tentang Kami', 'E-Perumahan Suatu landasan perumusan kebijakan, perencanaan, pemrograman, penganggaran, pemantauan dan evaluasi perumahan dan permukiman. Meningkatkan pelayanan kepada masyarakat dengan tingkat validitas yang tinggi yang dapat menjadi acuan/sumber data bagi masyarakat dalam menetapkan kebijakan pembangunan di bidang perumahan di Kota samarinda.', 'pplwapple.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `masyarakat`
--

CREATE TABLE `masyarakat` (
  `id_masyarakat` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `no_ktp` varchar(20) NOT NULL,
  `umur` int(3) NOT NULL,
  `status_penduduk` varchar(20) NOT NULL,
  `pekerjaan` varchar(200) NOT NULL,
  `no_hp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2020_11_18_111253_create-users-table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengembang`
--

CREATE TABLE `pengembang` (
  `id_pengembang` int(11) NOT NULL,
  `nik_pengembang` varchar(20) NOT NULL,
  `nama_pengembang` varchar(100) NOT NULL,
  `telepon_pengembang` varchar(15) NOT NULL,
  `email_pengembang` varchar(100) NOT NULL,
  `alamat_pengembang` text NOT NULL,
  `pengembang_slug` varchar(255) NOT NULL,
  `ijin_perusahaan` varchar(200) NOT NULL,
  `foto_pengembang` text NOT NULL,
  `id_user` int(11) NOT NULL,
  `status_aktif` varchar(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status_deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengembang`
--

INSERT INTO `pengembang` (`id_pengembang`, `nik_pengembang`, `nama_pengembang`, `telepon_pengembang`, `email_pengembang`, `alamat_pengembang`, `pengembang_slug`, `ijin_perusahaan`, `foto_pengembang`, `id_user`, `status_aktif`, `created_at`, `updated_at`, `status_deleted`) VALUES
(6, '01283981028', 'nama', '0823123121', 'emaaail@email.com1', 'jalan alamat1', 'nama-190617444', '', '539RUMAH_SEHAT_BIRU.png', 16, '0', '2020-11-19 06:07:56', '2020-11-19 06:07:56', 0),
(7, '6473839303183785', 'Iqbal wahyudi', '082352260345', 'iqbal.wahyudi_25@gmail.com', 'jalan m.said', 'iqbal-wahyudi-190430784', 'rumah.jpg', 'willsmith_actor.jpg', 17, '0', '2020-11-19 06:07:56', '2020-11-19 06:07:56', 0),
(8, '6472939181281823', 'Charlotte Von Einsbern', '08235227182', 'email@email.com', 'jalan alamat', 'charlotte-von-einsbern-190617834', '', 'Iqbal_Wahyudi.JPG', 19, '0', '2020-11-19 06:07:56', '2020-11-19 06:07:56', 0),
(9, '23489890890231', 'Jake Emblacne', '08236220981', 'pengembang@email.com1', 'alamat1', 'jake-emblacne-190617616', 'construction-worker.png', 'auth-img.jpg', 21, '0', '2020-11-19 06:07:56', '2020-11-19 06:07:56', 0),
(10, '-', 'Rika Bersaudara Sakti', '-', '-', '-', 'rika-bersaudara-sakti-190729233', 'sampel.txt', 'smd2.png', 27, '1', '2020-11-19 06:07:56', '2020-11-19 06:07:56', 0),
(11, '-', 'Cipta Inovasi Persada', '-', '-', '-', 'cipta-inovasi-persada-190729366', 'sampel1.txt', 'smd3.png', 28, '1', '2020-11-19 06:07:56', '2020-11-19 06:07:56', 0),
(12, '-', 'Grha Mandiri Kaltim', '-', '-', '-', 'grha-mandiri-kaltim-190729620', 'sampel2.txt', 'smd4.png', 29, '1', '2020-11-19 06:07:56', '2020-11-19 06:07:56', 0),
(13, '-', 'Hammam Nugroho', '-', '-', '-', 'hammam-nugroho-190729167', 'sampel3.txt', 'smd5.png', 30, '1', '2020-11-19 06:07:56', '2020-11-19 06:07:56', 0),
(14, '-', 'Prima Griya Perkasa', '-', '-', '-', 'prima-griya-perkasa-190729450', 'sampel4.txt', 'smd6.png', 31, '1', '2020-11-19 06:07:56', '2020-11-19 06:07:56', 0),
(15, '-', 'Alga Mas Propertindo', '-', '-', '-', 'alga-mas-propertindo-19072954', 'sampel5.txt', 'smd7.png', 32, '1', '2020-11-19 06:07:56', '2020-11-19 06:07:56', 0),
(16, '-', 'Smart Indoland Jaya', '-', '-', '-', 'smart-indoland-jaya-190729247', 'sampel6.txt', 'smd8.png', 33, '1', '2020-11-19 06:07:56', '2020-11-19 06:07:56', 0),
(17, '-', 'Embun Pagi Berseri', '-', '-', '-', 'embun-pagi-berseri-190729741', 'sampel7.txt', 'smd9.png', 34, '1', '2020-11-19 06:07:56', '2020-11-19 06:07:56', 0),
(18, '-', 'Bumi Hijau Abadi', '-', '-', '-', 'bumi-hijau-abadi-190729449', 'sampel8.txt', 'smd10.png', 35, '1', '2020-11-19 06:07:56', '2020-11-19 06:07:56', 0),
(19, '-', 'Mutiara Hitam Persada', '-', '-', '-', 'mutiara-hitam-persada-19072974', 'sampel9.txt', 'smd11.png', 36, '1', '2020-11-19 06:07:56', '2020-11-19 06:07:56', 0),
(20, '-', 'Sarana Reri Mandiri', '-', '-', '-', 'sarana-reri-mandiri-190729829', 'sampel10.txt', 'smd12.png', 37, '1', '2020-11-19 06:07:56', '2020-11-19 06:07:56', 0),
(21, '-', 'Perumahan Citra', '082352260345', 'perumahancitra@email.com', 'Jalan Perumahan Citra', 'perumahan-citra-200804834', 'image-upload.png', 'image-upload.png', 39, '1', '2020-11-19 06:07:56', '2020-11-19 06:07:56', 0),
(22, '-', 'PT Ciputra Graha Mitra', '0888888888', 'email@email.com', 'alamat', 'pt-ciputra-graha-mitra-201014227', 'download_(1).jpg', 'download.jpg', 41, '1', '2020-11-19 06:07:56', '2020-11-19 06:07:56', 0),
(23, '-', 'PT Wika Realty', '(0541) 7268999', 'tamansarigrandsamarinda.com', 'Jl. H. A. M. Rifaddin, Harapan Baru, Kec. Loa Janan Ilir, Kota Samarinda, Kalimantan Timur 75131', 'pt-wika-realty-201014425', 'download_(1)1.jpg', '111202053246grand-taman-sari-view-03.jpg', 42, '1', '2020-11-19 06:07:56', '2020-11-19 06:07:56', 0),
(24, '-', 'PT Grha Mandiri', '0888888888', 'email@email.com', 'alamat', 'pt-grha-mandiri-201021506', 'Untitled-1.png', 'user.png', 43, '1', '2020-11-19 06:07:56', '2020-11-19 06:07:56', 0),
(25, '-', 'PT Haidir Griya Karya', '081346604110', 'palaranindahresidences@yahoo.com', 'Jl. Niaga, RT 19, Kel. Handil Bhakti, Kec. Palaran', 'pt-haidir-griya-karya-201021297', 'Sertifikat_Induk.pdf', 'photo6267073617145735873.jpg', 44, '1', '2020-11-19 06:07:56', '2020-11-19 06:07:56', 0),
(26, '94 Tanggal 24 April ', 'PT Embun Pagi Berseri', '082331370800', 'newbumicitralestari@gmail.com ', 'Jl Jakarta Gg. Perjuangan Blok 9 No. 9D Rt. 72 Kel. Loa Bakung Kec. sungai Kunjang Samarinda Kalimantan Timur', 'pt-embun-pagi-berseri-201021330', 'NIB_9120009551889.pdf', 'Foto_Kantor.jpg', 45, '1', '2020-11-19 06:07:56', '2020-11-19 06:07:56', 0),
(27, '-', 'PT Timur Adya Citra', '08888888', 'email@email.com', 'Jl.Bukit Alaya Samarinda', 'pt-timur-adya-citra-201021334', 'Untitled-13.png', 'user3.png', 46, '1', '2020-11-19 06:07:56', '2020-11-19 06:07:56', 0),
(32, '123123', 'Nova Dwi Sapta', '0812444373231', 'novagitarisav7@gmail.com', 'Jalan Slamet Riadi', '28-nova-dwi-sapta', '/api/', '/api/', 13, '0', '2020-11-18 23:31:49', '2020-11-18 23:31:49', 0),
(33, '123123', 'Ikwal Ramadhani', '0812444373231', 'ikwal123@gmail.com', 'Jalan Slamet Riadi', '33-ikwal-ramadhani', '/api/pengembang/file/eOO8ueEiIzdg4rvfTU82bUcVUSsjMopXbdyciBd3.xlsx', '/api/pengembang/foto/a6QMhmd9hbPvwcdt43ECWiKSEvANK72uu9pbdShT.png', 14, '0', '2020-11-18 23:35:41', '2020-11-18 23:35:41', 0);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(4, 'App\\Models\\User', 2, 'user-token', '9d93ecfd5ea94d24a6d1c6fb57a20f67d710bfb4f572ae12efbd3d3131dc5841', '[\"*\"]', '2020-11-18 23:35:40', '2020-11-18 18:15:48', '2020-11-18 23:35:40');

-- --------------------------------------------------------

--
-- Table structure for table `perumahan`
--

CREATE TABLE `perumahan` (
  `id_perumahan` int(11) NOT NULL,
  `id_pengembang` int(11) NOT NULL,
  `id_kecamatan` int(11) NOT NULL,
  `id_kelurahan` int(11) NOT NULL,
  `nama_perumahan` varchar(200) NOT NULL,
  `deskripsi_perumahan` text NOT NULL,
  `lokasi` text NOT NULL,
  `longitude` varchar(200) NOT NULL,
  `latitude` varchar(200) NOT NULL,
  `legalitas` varchar(200) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `status_perumahan` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perumahan`
--

INSERT INTO `perumahan` (`id_perumahan`, `id_pengembang`, `id_kecamatan`, `id_kelurahan`, `nama_perumahan`, `deskripsi_perumahan`, `lokasi`, `longitude`, `latitude`, `legalitas`, `slug`, `status_perumahan`) VALUES
(1, 7, 2, 2, 'Perumahan Sejahtera1', '-', 'Lokasi perumahan disini', '117.03207022926154', '-0.5507962787262386', '117.16033352731438', 'perumahan-sejahtera1-190430969', '1'),
(6, 7, 3, 21, 'Perumahan Damai Sejahtera', 'opasdjkasopdasdoopasjdopjasdpjop', 'Jalan Dama', '117.11020840523383', '-0.5580592583990835', 'construction-worker.png', 'perumahan-damai-sejahtera-190513158', '2'),
(7, 7, 6, 14, 'Perumahan Damai1', '', 'Jalan Graha Indah', '117.13757260482294', '-0.49870532421209646', 'automation.png', 'perumahan-damai1-190422649', '2'),
(8, 7, 9, 37, 'Perumahan Hills', '', 'Jalan Graha Indaha', '117.29478281629076', '-0.5655634313352635', 'curve-24.png', 'perumahan-hills-190416579', '1'),
(9, 7, 5, 6, 'Perumahan Keren', '', 'Jalan Keledang', '117.30434045124355', '-0.45543945164118327', '1556180793388.jpg', 'perumahan-keren-190502690', '0'),
(10, 7, 9, 38, 'Perumahan Tes', '', 'Jalan Karang Asam', '117.03502072212723', '-0.4547231596136072', 'Screenshot_(21).png', 'perumahan-tes-190502770', '0'),
(11, 7, 3, 21, 'Perumahan Damaix', '', 'Jalan Dama', '117.03055752632622', '-0.4729186692780587', 'Screenshot_(9).png', 'perumahan-damaix-190502184', '0'),
(12, 7, 2, 2, 'Perumahan Hillsl', '', 'Jalan Graha Indah', '117.21457852242747', '-0.450260102997845', 'Screenshot_(23).png', 'perumahan-hillsl-190502625', '0'),
(13, 7, 4, 54, 'Perumahan Vrindavan', 'deskripsi1', 'Jalan Keledang', '117.08789242622606', '-0.48115812977056294', 'Screenshot_(28).png', 'perumahan-vrindavan-190507826', '0'),
(14, 7, 6, 16, 'Perumahan Baru', 'Perumahan modern dengan sistem cluster dan berlokasi strategis di Samarinda. Rumah Dengan Design Minimalis namun tetap Modern. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 'Jalan Lokasi Perumahan ', '117.06471814035172', '-0.5134292526477395', 'image-upload.png', 'perumahan-baru-200804368', '0'),
(15, 7, 10, 49, 'Citraland Panjaitan', 'perumahan citraland, rumah menengah dan rumah mewah', 'Jalan Panjaitan', '117.20232197582618', '-0.4774445211906624', 'download_(1).jpg', 'citraland-panjaitan-201012235', '1'),
(16, 7, 6, 16, 'Perumahan ABC', 'perumahan baru di samarinda', 'Jalan Kadrie Oneng', '117.12772210048843', '-0.483280160530569', 'download_(1)1.jpg', 'perumahan-abc-201014405', '1'),
(17, 22, 10, 51, 'CitraLand Samarinda', 'CitraLand city Samarinda merupakan masterpiece persembahan ciputra Group, developer terkemuka dengan berbagai proyek properti di Indonesia dan mancanegara, seperti CitraLand Surabaya, CitraGarden City Jakarta, CitraGran Cibubur, Ciputra World Jakarta, Ciputra World Surabaya, CitraSun Garden Semarang, CitraLand Pekanbaru, CitraLand Celebes, Ciputra Hanoi International City, Grand Phnom Penh International City dan masih banyak lagi yang lain. Selamlebih dari 30 tahun, Ciputra Group telah membangun reputasi unggul dalam pengembangan propertiyang berkualitas dalam infrastruktur, bangunan dan pelayanan pelanggan.\r\n\r\nDr. HC. Ir. Ciputra, pendiri Ciputra Group yang telah berkarya lebih dari 30 tahun, dianggap sebagai Begawan dalam dunia property Indonesia, beliau juga merupakan pendiri dari grup developer raksasa lain seperti Metropolitan Group dan Jaya Group. Dr. HC. Ir. Ciputra adalah seorang tokoh entrepreneurship nasional yang berkomitmen menciptakan generasi entrepreneur melalui sekolah dan universitas yang didirikannya.\r\n\r\nSetelah sukses dengan penjualan tahp pertama seluas 33 hektar, kini CitraLand City Samarinda menghadirkan masterplan tahap II dengan konsep “A New Dimension of Living” seluas 60 hektare. Residential area di CitraLand City Samarinda didesain dengan konsep private cluster, one gate system, rumah tanpa pagar, dengan lingkungan dan landscape yang tertata asri. Privasi dan keamanan penghuni semakin sempurna dengan adanya jaringan utilitas bawah tanah, system keamanan 24 jam serta fasilitas penghuni berupa Electronic Access Card pribadi, Security System & Alarm System dan CCTV, yang menjamin keamanan rumah dan privasi keluarga Anda. Komitmen jangka panjang Ciputra Group akan memastikan pengembangan berjalan kontinu dalam skala yang lebih besar, sekaligus memberikan peningkatan kualitas gaya hidup dan investasi bagi Anda yang menjadi bagian di dalamnya.\r\n\r\nTemui The Symphony of Park, thematic park seluas 5 hektar yang membelah site CitraLand City Samarinda sepanjang 1 km dan menjadi jantung kawasan untuk menghadirkan A New Dimension of Happiness.  Konsep Symphony of Park menggabungkan dimensi Leisure, Healthy Living dan Lifestyle menjadi sebuah harmoni, bagaikan gubahan simfoni yang selaras. Untuk mewujudkan Inner Personal Happiness penghuni, taman didesain untuk mensinergikan aspek Mind, Body & Soul melalui 3 tema taman yang selaras : Garden of Love (Soul/Lifestyle), garden of Sound (Mind/Leisure) dan Garden of Vigor (Body/Health). Sebagai ending – dimensi celebration of life, hadir Garden of Bliss, terdiri atas CitraLand Waterpark, Ballerina Lake dan Promenade of Joy.\r\n\r\nSebagai komitmen Ciputra Group untuk menciptakan hunian prestisius yang lengkap dan hidup, CitraLand City Samarinda menghadirkan Sekolah Citra Kasih dan Sparkling Taste @ I-Walk. Kehadiran sekolah swasta terbaik dan konsep baru kuliner ini akan semakin menaikkan image kawasan, sekaligus nilai investasi property Anda.\r\n\r\nSekolah Citra Kasih menempati site seluas 8.000m2, menawarkan pendidikan nasional plus berkualitas dengan spirit 21st century education & entrepreneurship, mulai jenjang TK, SD, SMP dan SMA. Sekolah Citra Kasih ini merupakan sekolah yang dikelola langsung oleh Ciputra Group.\r\n\r\nCitraLand City Samarinda memiliki lokasi yang strategis di Jalan D.I. Panjaitan, slah satu jalur utama kota Samarinda. Lokasi bisa dicapai hanya 10 menit dari pusat kota dan 25 menit dari bandara baru Samarinda.', 'Jl. DI Panjaitan, Mugirejo, Kec. Sungai Pinang, Kota Samarinda, Kalimantan Timur 75243', '117.18634159314058', '-0.4588224986897558', 'citraland.jpg', 'citraland-samarinda-201014795', '1'),
(18, 23, 1, 61, 'Tamansari Grand Samarinda Residence', 'Beauty Nature Within Your Window', 'Jl. H.A.M.M Riffadin Ruko E2-11, Harapan Baru, Kec. Loa Janan Ilir Kota Samarinda Kalimantan Timur 75131', '117.11716077857034', '-0.561919207545003', 'siteplan_kakaban.pdf', 'tamansari-grand-samarinda-residence-201015886', '1'),
(19, 7, 6, 16, 'Perumahan Sample', 'dekripsi perumahan', 'lokasi perumahan', '117.1294671839214', '-0.4977241180325649', 'download.jpg', 'perumahan-sample-201021553', '1'),
(20, 27, 10, 49, 'Alaya', 'Kawasan Hijau dengan Fasilitas Terlengkap di Samarinda dan Hunian Bebas Banjir', 'Jl.Bukit Alaya', '117.17545620611969', '-0.466335461147267', '05_brosur_ALAYA_copy_siteplan.jpg', 'alaya-201021479', '1'),
(21, 7, 2, 2, 'tes', 'tes', 'lokasi', '117.06832302925909', '-0.5148024883757074', 'Tugas_ke-2_Metode_Numerik.pdf', 'tes-201027657', '0');

-- --------------------------------------------------------

--
-- Table structure for table `sarana_prasarana`
--

CREATE TABLE `sarana_prasarana` (
  `id_sarana_prasarana` int(11) NOT NULL,
  `id_bangunan` int(11) NOT NULL,
  `nama_sarana_prasarana` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sarana_prasarana_perumahan`
--

CREATE TABLE `sarana_prasarana_perumahan` (
  `id_sarana_prasarana_perumahan` int(11) NOT NULL,
  `id_perumahan` int(11) NOT NULL,
  `nama_sarana_prasarana_perumahan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sarana_prasarana_perumahan`
--

INSERT INTO `sarana_prasarana_perumahan` (`id_sarana_prasarana_perumahan`, `id_perumahan`, `nama_sarana_prasarana_perumahan`) VALUES
(6, 8, 'Sarana'),
(9, 6, 'Mushola'),
(10, 6, 'Lapangan Bola'),
(11, 1, 'Lapangan Bola'),
(12, 7, 'Sarana'),
(13, 9, 'Sarana'),
(14, 10, 'Sarana'),
(15, 11, 'Sarana'),
(16, 12, 'Sarana'),
(17, 13, 'Sarana'),
(18, 14, 'Taman'),
(19, 15, 'Waterboom'),
(20, 15, 'Pusat Perbelanjaan'),
(21, 16, 'Pusat Perbelanjaan'),
(22, 16, 'Waterboom'),
(23, 17, 'WaterPark'),
(24, 17, 'Taman Bermain'),
(25, 17, 'Jogging Track'),
(26, 17, 'Pusat Pertokoan'),
(27, 17, 'WaterPark'),
(28, 18, 'Masjid'),
(31, 18, 'Lapangan Basket/ Voli'),
(32, 18, 'Barrier Gate System'),
(33, 18, 'Keamanan Security'),
(34, 19, 'Pusat Perbelanjaan'),
(35, 20, 'PLN'),
(36, 20, 'PDAM'),
(37, 20, 'Akses Jalan Tembus'),
(38, 20, 'Lampu PJU'),
(39, 20, 'Taman Bermain'),
(40, 20, ' Cluster ( One Gate System )'),
(41, 20, 'Security 24 Jam'),
(42, 20, 'Pengelolaan Lingkungan'),
(43, 20, 'Ruang Terbuka Hijau ( RTH)'),
(44, 21, 'tes');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id_setting` int(11) NOT NULL,
  `nama_website` varchar(255) NOT NULL,
  `deskripsi_website` text NOT NULL,
  `slogan_setting` text NOT NULL,
  `alamat_setting` text NOT NULL,
  `telepon_setting` varchar(50) NOT NULL,
  `email_setting` varchar(200) NOT NULL,
  `jam_setting` text NOT NULL,
  `copyright` varchar(200) NOT NULL,
  `embed_gmap` text NOT NULL,
  `logo_setting` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id_setting`, `nama_website`, `deskripsi_website`, `slogan_setting`, `alamat_setting`, `telepon_setting`, `email_setting`, `jam_setting`, `copyright`, `embed_gmap`, `logo_setting`) VALUES
(1, 'E-Perumahan', 'E-Perumahan Suatu landasan perumusan kebijakan, perencanaan, pemrograman, penganggaran, pemantauan dan evaluasi perumahan dan permukiman. Meningkatkan pelayanan kepada masyarakat dengan tingkat validitas yang tinggi yang dapat menjadi acuan/sumber data bagi masyarakat dalam menetapkan kebijakan pembangunan di bidang perumahan di Kota samarinda.', 'CARI RUMAH IMPIANMU', 'Jl. D.I Panjaitan Kel. Gn. Lingai Kec. Sungai Pinang, Samarinda 75117', '+ 123 345 6781', 'Dinaspkp2019@gmail.com', 'Senin - Jumat, 08.00 - 16.00 1', 'Copyright © 2018 . Powered by TIM IT Disperkim1', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.670691944743!2d117.14358171475344!3d-0.49288699964039895!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2df67f12748846d1%3A0x36ec5987bac50811!2sDinas+Perumahan+dan+Permukiman+Kota+Samarinda+(Disperkim)!5e0!3m2!1sid!2sid!4v1544076507895\" width=\"600\" height=\"450\" frameborder=\"0\" style=\"border:0\" allowfullscreen></iframe>', 'logo_biru.png');

-- --------------------------------------------------------

--
-- Table structure for table `spesifikasi_rumah`
--

CREATE TABLE `spesifikasi_rumah` (
  `id_spesifikasi_rumah` int(11) NOT NULL,
  `id_bangunan` int(11) NOT NULL,
  `nama_spesifikasi_rumah` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `spesifikasi_rumah`
--

INSERT INTO `spesifikasi_rumah` (`id_spesifikasi_rumah`, `id_bangunan`, `nama_spesifikasi_rumah`) VALUES
(15, 9, 'spesifikasi rumah 40'),
(18, 11, 'Gazebo'),
(19, 11, 'Halaman luas'),
(20, 9, 'spesifikasi rumah 3'),
(21, 9, 'spesifikasi rumah 2'),
(22, 10, 'spesifikasi rumah 3'),
(23, 10, 'spesifikasi rumah 2'),
(24, 10, 'spesifikasi rumah 40'),
(25, 12, 'spesifikasi rumah 3'),
(26, 13, 'spesifikasi rumah 4'),
(27, 14, 'Garasi'),
(28, 15, 'Lantai Keramik'),
(29, 15, 'Dinding plester'),
(30, 16, 'Dinding plester'),
(31, 16, 'Lantai Keramik'),
(32, 17, '1'),
(33, 18, 'Pondasi Batu Gunung, Sloof Beton Bertulang'),
(34, 18, 'Dinding Pasangan Bata Merah Diplester, Finishing Cat Tembok, Kolom dan RIngbalk Beton Bertulang'),
(35, 18, 'Atap Rangka Baja Ringan, Genteng Beton Finishing Cat'),
(36, 18, 'Kusen Alumunium, Pintu Engineering'),
(37, 18, 'Lantai Keramik 40x40'),
(38, 18, 'Santisai Closet Duduk'),
(39, 18, 'Listirk 1300 Watt'),
(40, 18, 'PDAM'),
(41, 19, 'Pondasi Batu Gunung, Sloof Beton Bertulang'),
(42, 19, 'Dinding Pasangan Bata Merah, Finishing Cat Tembok, Kolom dan Ringbalk Beton Bertulang'),
(43, 19, 'Atap Kerangaka Baja Ringan, Genteng Beton Finishing Cat'),
(44, 19, 'Kusen Alumunium, Pintu Engineering'),
(45, 19, 'Lantai Keramik 40x40'),
(46, 19, 'Sanitasi Kloset Duduk'),
(47, 19, 'Listrik 1300 Watt'),
(48, 19, 'PDAM'),
(49, 20, 'Pondasi Pasangan Batu Gunung, Sloof Beton Bertulang'),
(50, 20, 'Dinding Pasangan Bata Merah, Finishing Cat Tembok, Kolom dan Ringbalk Beton Bertulang'),
(51, 20, 'Atap Kerangka Baja RIngan,  Genteng Beton Finishing Cat,'),
(52, 20, 'Jendela Alumunium, Pintu Engineering'),
(53, 20, 'Lantai 40x40'),
(54, 20, 'Santitasi Closet Duduk'),
(55, 20, 'Listrik 1300 Watt'),
(56, 20, 'PDAM'),
(57, 21, 'Dinding plester'),
(58, 21, 'Lantai Keramik');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `level` varchar(25) NOT NULL,
  `status` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `level`, `status`) VALUES
(1, 'admin', '$2y$10$Ulm8EOyVxp29rkF4UpOPSesezZ7n5LA.n5bpECrnkEgK.tNTYfHO.', '1', 1),
(16, 'emaaasil@email.com', '$2y$10$O11DvMKYkN2K6VyWa0MDN.DIjp.mBWuoHCG3NG4M1TdITN6yni9I2', '2', 0),
(17, 'pengembang', '$2y$10$fkIkfp7O0JV5r2vXxJU/Z.KZkbanza6ASQAp8NzKuFprn3SaV3yTe', '2', 1),
(18, 'operator', '$2y$10$LBeUI2ZYQtIrqio2SmOaWuD3UbcHbNnXto7xYeFS4N2o5kxarj/ga', '3', 1),
(19, 'email@email.com', '$2y$10$s8wU8uQdxbdsNcNhQUIpauGNv5qhRcQScFmI71ikR87u5kTlW8Zri', '2', 1),
(21, 'pengembang@email.com', '$2y$10$quZBvRKwMtua0CE46u9a0e7lCZQ/LUxExDi5.NyRUz0FKDdUcUIGq', '2', 1),
(22, 'username', '$2y$10$0Va1.tAQSd6eLnq9.uhdVO.UtH9ao4NXWDtfFB2PDFcUPI3PMrstG', '2', 1),
(27, 'rikabersaudarasakti', '$2y$10$ZdfWgQMZKJOwpommUJmasuwyQfeZ8/tR5f4WiCz8gPW/vW.pFhd4O', '2', 1),
(28, 'ciptainovasipersada', '$2y$10$XjECjVwiF5Lkwk7Ih8/MgOCfgwB7HogBOieD.l3sUiZvYEtroGxP2', '2', 1),
(29, 'grhamandirikaltim', '$2y$10$yUtaNuF.rvyi3hlC05aY6OKUErx39xbC76egjwnPD80uTEYjoYNrG', '2', 1),
(30, 'hammamnugroho', '$2y$10$/M2DAr3i1wziteF7mZbtDu6ZVj6CA0KeB6IRw/r2WM1xUraqot1dG', '2', 1),
(31, 'primagriyaperkasa', '$2y$10$PygkpK2Ys6aD/fAkJ6YJFubdMgT0anwaQjqOl8c5Dg1ci7DSq1ToS', '2', 1),
(32, 'algamaspropertindo', '$2y$10$pHz3bgfYBaRwJ8Ne456PfeGZ70P95BgF4CqrZYDnGNsWugFfuLwpm', '2', 1),
(33, 'smartindolandjaya', '$2y$10$7kEsLypKw1MVGlg0wW/9e.cgVkXqFjx09ttRwxc1EHTCN8ZUIlh8C', '2', 1),
(34, 'embunpagiberseri', '$2y$10$qMKuwcgiMl7X8NlRhsgV9.1qWXH4bmpxx71SsP.vd/kF3/MWTFxwq', '2', 1),
(35, 'bumihijauabadi', '$2y$10$2c4DLe3CVfGQqr5TcTL3v.gXH/TtkZa25P2RmaBK3fJsJ8W17nEBW', '2', 1),
(36, 'mutiarahitampersada', '$2y$10$cmV8bqLro.608uswfNZYTuT9.xYs1gbKlbObbb3NqJtrtpLAQ.Omy', '2', 1),
(37, 'saranarerimandiri', '$2y$10$FbsdvmG5liPT8qdOglcNEu5djHRNrDhP3cCKirKJLn0VD3m2MOK6i', '2', 1),
(38, 'staffperumahan', '$2y$10$YMDnI7R8srGKdKarz5NE8uiZXDRJO3FMUNpw.JIv6JNlpix.0XpJ.', '1', 1),
(39, 'perumahancitra@email.com', '$2y$10$2CI29Ay0wc6A7.aZwkcELOPK9KSpemcA1enGzK5Bc7cIWek6injAK', '2', 1),
(40, 'tes', '$2y$10$BnwylVU/ysZpiogU6QBaqOxLCR8Lqg6NTzmGFiaO6z9YbmoHhXgh.', '2', 1),
(41, 'login_ciputra_graha_mitra', '$2y$10$o/84kOVvhr82eZ5YutidduBXi23GY6fVrV/w/tAesj277VciAdkEK', '2', 1),
(42, 'login_wika_realty', '$2y$10$X/TNH8r2odLcq7i4CWwZoOEgFpv0AnOnBB2C143XSyrLQVijMU9Tq', '2', 1),
(43, 'grha_mandiri', '$2y$10$EktDIgsZ10x4rdBGjwnpoexDeD2AIelg6Dug0iQVog8I3/dLbU.4G', '2', 1),
(44, 'haidir_griya_karya', '$2y$10$zM7QD4M3CficZUKwCisX4uipszlV8zFcsbiU5HQGqAVrWbCuyZMKy', '2', 1),
(45, 'embun_pagi_berseri', '$2y$10$OWe2fNmQQdJscpRBWApKTe5ZKdRnnZL2j6Ho4/8koIcjHH.q/xB.a', '2', 1),
(46, 'timur_adya_citra', '$2y$10$avpaAHD8fIFviNPwQz9jduVBRDJ47qn23UxFo3IiRvuASniyO3DI2', '2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(25) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `level`, `status`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'novadwisapta', 'admin', 1, NULL, '$2y$10$AateYE38SbdmwcGimblKJuAzQ.SWOueG.1f57WTRDYFfH.8SB7khG', NULL, '2020-11-18 17:47:56', '2020-11-18 18:32:45'),
(3, 'iqbalwahyudi', 'pengembang', 1, NULL, '$2y$10$USga3K138rprIA/TT6g5e./LvxtFDEFjRZmBZd8CJNN7Y3Q5UnqDm', NULL, '2020-11-18 17:54:11', '2020-11-18 18:32:12'),
(13, 'pengembang', '2', 0, NULL, '$2y$10$VX0jePxC3wzarh1WpkeyTOsafLrxJeqVdjY4nxDiVtJs9u/Ihr7K.', NULL, '2020-11-18 23:31:49', '2020-11-18 23:31:49'),
(14, 'pengembang2', '2', 0, NULL, '$2y$10$Z20B8ggY5RnuMzh1H1BLGun5z9S/ReFmaUVLaFbPDQ8MC53FGDmim', NULL, '2020-11-18 23:35:41', '2020-11-18 23:35:41');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id_wishlist` int(11) NOT NULL,
  `id_masyarakat` int(11) NOT NULL,
  `id_bangunan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bangunan`
--
ALTER TABLE `bangunan`
  ADD PRIMARY KEY (`id_bangunan`),
  ADD KEY `id_pengembang` (`id_pengembang`),
  ADD KEY `id_kecamatan` (`id_kecamatan`),
  ADD KEY `id_kelurahan` (`id_kelurahan`),
  ADD KEY `id_perumahan` (`id_perumahan`);

--
-- Indexes for table `brosur_pengembang`
--
ALTER TABLE `brosur_pengembang`
  ADD PRIMARY KEY (`id_brosur_pengembang`),
  ADD KEY `id_pengembang` (`id_pengembang`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`id_fasilitas`),
  ADD KEY `id_bangunan` (`id_bangunan`);

--
-- Indexes for table `fasilitas_perumahan`
--
ALTER TABLE `fasilitas_perumahan`
  ADD PRIMARY KEY (`id_fasilitas_perumahan`),
  ADD KEY `id_perumahan` (`id_perumahan`);

--
-- Indexes for table `form_data_perumahan`
--
ALTER TABLE `form_data_perumahan`
  ADD PRIMARY KEY (`id_form_data_perumahan`);

--
-- Indexes for table `foto_bangunan`
--
ALTER TABLE `foto_bangunan`
  ADD PRIMARY KEY (`id_foto_bangunan`),
  ADD KEY `id_bangunan` (`id_bangunan`);

--
-- Indexes for table `foto_perumahan`
--
ALTER TABLE `foto_perumahan`
  ADD PRIMARY KEY (`id_foto_perumahan`),
  ADD KEY `id_perumahan` (`id_perumahan`);

--
-- Indexes for table `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD PRIMARY KEY (`id_kecamatan`);

--
-- Indexes for table `kelurahan`
--
ALTER TABLE `kelurahan`
  ADD PRIMARY KEY (`id_kelurahan`),
  ADD KEY `id_kecamatan` (`id_kecamatan`);

--
-- Indexes for table `kontak`
--
ALTER TABLE `kontak`
  ADD PRIMARY KEY (`id_kontak`);

--
-- Indexes for table `laporan_aktivitas`
--
ALTER TABLE `laporan_aktivitas`
  ADD PRIMARY KEY (`id_laporan_aktivitas`),
  ADD KEY `id_pengembang` (`id_pengembang`);

--
-- Indexes for table `laporan_aktivitas_detail`
--
ALTER TABLE `laporan_aktivitas_detail`
  ADD PRIMARY KEY (`id_laporan_aktivitas_detail`),
  ADD KEY `id_laporan_aktivitas` (`id_laporan_aktivitas`);

--
-- Indexes for table `laporan_penjualan`
--
ALTER TABLE `laporan_penjualan`
  ADD PRIMARY KEY (`id_laporan_penjualan`),
  ADD KEY `id_pengembang` (`id_pengembang`);

--
-- Indexes for table `laporan_penjualan_detail`
--
ALTER TABLE `laporan_penjualan_detail`
  ADD PRIMARY KEY (`id_laporan_penjualan_detail`),
  ADD KEY `id_penjualan` (`id_laporan_penjualan`);

--
-- Indexes for table `main_bg`
--
ALTER TABLE `main_bg`
  ADD PRIMARY KEY (`id_main_bg`);

--
-- Indexes for table `main_info`
--
ALTER TABLE `main_info`
  ADD PRIMARY KEY (`id_main_info`);

--
-- Indexes for table `masyarakat`
--
ALTER TABLE `masyarakat`
  ADD PRIMARY KEY (`id_masyarakat`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pengembang`
--
ALTER TABLE `pengembang`
  ADD PRIMARY KEY (`id_pengembang`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `perumahan`
--
ALTER TABLE `perumahan`
  ADD PRIMARY KEY (`id_perumahan`),
  ADD KEY `id_pengembang` (`id_pengembang`),
  ADD KEY `id_kecamatan` (`id_kecamatan`),
  ADD KEY `id_kelurahan` (`id_kelurahan`);

--
-- Indexes for table `sarana_prasarana`
--
ALTER TABLE `sarana_prasarana`
  ADD PRIMARY KEY (`id_sarana_prasarana`),
  ADD KEY `id_bangunan` (`id_bangunan`);

--
-- Indexes for table `sarana_prasarana_perumahan`
--
ALTER TABLE `sarana_prasarana_perumahan`
  ADD PRIMARY KEY (`id_sarana_prasarana_perumahan`),
  ADD KEY `id_perumahan` (`id_perumahan`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indexes for table `spesifikasi_rumah`
--
ALTER TABLE `spesifikasi_rumah`
  ADD PRIMARY KEY (`id_spesifikasi_rumah`),
  ADD KEY `id_bangunan` (`id_bangunan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id_wishlist`),
  ADD KEY `id_masyarakat` (`id_masyarakat`),
  ADD KEY `id_bangunan` (`id_bangunan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bangunan`
--
ALTER TABLE `bangunan`
  MODIFY `id_bangunan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `brosur_pengembang`
--
ALTER TABLE `brosur_pengembang`
  MODIFY `id_brosur_pengembang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fasilitas`
--
ALTER TABLE `fasilitas`
  MODIFY `id_fasilitas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fasilitas_perumahan`
--
ALTER TABLE `fasilitas_perumahan`
  MODIFY `id_fasilitas_perumahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `form_data_perumahan`
--
ALTER TABLE `form_data_perumahan`
  MODIFY `id_form_data_perumahan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `foto_bangunan`
--
ALTER TABLE `foto_bangunan`
  MODIFY `id_foto_bangunan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `foto_perumahan`
--
ALTER TABLE `foto_perumahan`
  MODIFY `id_foto_perumahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `kecamatan`
--
ALTER TABLE `kecamatan`
  MODIFY `id_kecamatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `kelurahan`
--
ALTER TABLE `kelurahan`
  MODIFY `id_kelurahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `kontak`
--
ALTER TABLE `kontak`
  MODIFY `id_kontak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `laporan_aktivitas`
--
ALTER TABLE `laporan_aktivitas`
  MODIFY `id_laporan_aktivitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `laporan_aktivitas_detail`
--
ALTER TABLE `laporan_aktivitas_detail`
  MODIFY `id_laporan_aktivitas_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `laporan_penjualan`
--
ALTER TABLE `laporan_penjualan`
  MODIFY `id_laporan_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `laporan_penjualan_detail`
--
ALTER TABLE `laporan_penjualan_detail`
  MODIFY `id_laporan_penjualan_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `main_bg`
--
ALTER TABLE `main_bg`
  MODIFY `id_main_bg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `main_info`
--
ALTER TABLE `main_info`
  MODIFY `id_main_info` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `masyarakat`
--
ALTER TABLE `masyarakat`
  MODIFY `id_masyarakat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pengembang`
--
ALTER TABLE `pengembang`
  MODIFY `id_pengembang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `perumahan`
--
ALTER TABLE `perumahan`
  MODIFY `id_perumahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `sarana_prasarana`
--
ALTER TABLE `sarana_prasarana`
  MODIFY `id_sarana_prasarana` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sarana_prasarana_perumahan`
--
ALTER TABLE `sarana_prasarana_perumahan`
  MODIFY `id_sarana_prasarana_perumahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id_setting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `spesifikasi_rumah`
--
ALTER TABLE `spesifikasi_rumah`
  MODIFY `id_spesifikasi_rumah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id_wishlist` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bangunan`
--
ALTER TABLE `bangunan`
  ADD CONSTRAINT `bangunan_ibfk_4` FOREIGN KEY (`id_pengembang`) REFERENCES `pengembang` (`id_pengembang`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `bangunan_ibfk_5` FOREIGN KEY (`id_kecamatan`) REFERENCES `kecamatan` (`id_kecamatan`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `bangunan_ibfk_6` FOREIGN KEY (`id_kelurahan`) REFERENCES `kelurahan` (`id_kelurahan`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `bangunan_ibfk_7` FOREIGN KEY (`id_perumahan`) REFERENCES `perumahan` (`id_perumahan`) ON UPDATE CASCADE;

--
-- Constraints for table `brosur_pengembang`
--
ALTER TABLE `brosur_pengembang`
  ADD CONSTRAINT `brosur_pengembang_ibfk_1` FOREIGN KEY (`id_pengembang`) REFERENCES `pengembang` (`id_pengembang`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD CONSTRAINT `fasilitas_ibfk_1` FOREIGN KEY (`id_bangunan`) REFERENCES `bangunan` (`id_bangunan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fasilitas_perumahan`
--
ALTER TABLE `fasilitas_perumahan`
  ADD CONSTRAINT `fasilitas_perumahan_ibfk_1` FOREIGN KEY (`id_perumahan`) REFERENCES `perumahan` (`id_perumahan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `foto_bangunan`
--
ALTER TABLE `foto_bangunan`
  ADD CONSTRAINT `foto_bangunan_ibfk_1` FOREIGN KEY (`id_bangunan`) REFERENCES `bangunan` (`id_bangunan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `foto_perumahan`
--
ALTER TABLE `foto_perumahan`
  ADD CONSTRAINT `foto_perumahan_ibfk_1` FOREIGN KEY (`id_perumahan`) REFERENCES `perumahan` (`id_perumahan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kelurahan`
--
ALTER TABLE `kelurahan`
  ADD CONSTRAINT `kelurahan_ibfk_1` FOREIGN KEY (`id_kecamatan`) REFERENCES `kecamatan` (`id_kecamatan`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `laporan_aktivitas`
--
ALTER TABLE `laporan_aktivitas`
  ADD CONSTRAINT `laporan_aktivitas_ibfk_1` FOREIGN KEY (`id_pengembang`) REFERENCES `pengembang` (`id_pengembang`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `laporan_aktivitas_detail`
--
ALTER TABLE `laporan_aktivitas_detail`
  ADD CONSTRAINT `laporan_aktivitas_detail_ibfk_1` FOREIGN KEY (`id_laporan_aktivitas`) REFERENCES `laporan_aktivitas` (`id_laporan_aktivitas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `laporan_penjualan`
--
ALTER TABLE `laporan_penjualan`
  ADD CONSTRAINT `laporan_penjualan_ibfk_1` FOREIGN KEY (`id_pengembang`) REFERENCES `pengembang` (`id_pengembang`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `laporan_penjualan_detail`
--
ALTER TABLE `laporan_penjualan_detail`
  ADD CONSTRAINT `laporan_penjualan_detail_ibfk_1` FOREIGN KEY (`id_laporan_penjualan`) REFERENCES `laporan_penjualan` (`id_laporan_penjualan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `masyarakat`
--
ALTER TABLE `masyarakat`
  ADD CONSTRAINT `masyarakat_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `pengembang`
--
ALTER TABLE `pengembang`
  ADD CONSTRAINT `pengembang_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON UPDATE CASCADE;

--
-- Constraints for table `perumahan`
--
ALTER TABLE `perumahan`
  ADD CONSTRAINT `perumahan_ibfk_1` FOREIGN KEY (`id_pengembang`) REFERENCES `pengembang` (`id_pengembang`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `perumahan_ibfk_2` FOREIGN KEY (`id_kecamatan`) REFERENCES `kecamatan` (`id_kecamatan`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `perumahan_ibfk_3` FOREIGN KEY (`id_kelurahan`) REFERENCES `kelurahan` (`id_kelurahan`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `sarana_prasarana`
--
ALTER TABLE `sarana_prasarana`
  ADD CONSTRAINT `sarana_prasarana_ibfk_1` FOREIGN KEY (`id_bangunan`) REFERENCES `bangunan` (`id_bangunan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sarana_prasarana_perumahan`
--
ALTER TABLE `sarana_prasarana_perumahan`
  ADD CONSTRAINT `sarana_prasarana_perumahan_ibfk_1` FOREIGN KEY (`id_perumahan`) REFERENCES `perumahan` (`id_perumahan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `spesifikasi_rumah`
--
ALTER TABLE `spesifikasi_rumah`
  ADD CONSTRAINT `spesifikasi_rumah_ibfk_1` FOREIGN KEY (`id_bangunan`) REFERENCES `bangunan` (`id_bangunan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`id_masyarakat`) REFERENCES `masyarakat` (`id_masyarakat`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`id_bangunan`) REFERENCES `bangunan` (`id_bangunan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
