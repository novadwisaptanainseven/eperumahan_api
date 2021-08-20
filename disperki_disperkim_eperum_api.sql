-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 20, 2021 at 10:57 AM
-- Server version: 5.7.35
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `disperki_disperkim_eperum_api`
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
  `bangunan_slug` varchar(200) NOT NULL,
  `status_deleted` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bangunan`
--

INSERT INTO `bangunan` (`id_bangunan`, `id_perumahan`, `id_pengembang`, `id_kecamatan`, `id_kelurahan`, `kategori_bangunan`, `tipe_bangunan`, `nama_bangunan`, `deskripsi_bangunan`, `harga_bangunan`, `lokasi_bangunan`, `jumlah_tersedia`, `luas_bangunan`, `luas_tanah`, `dimensi_bangunan`, `dimensi_tanah`, `jumlah_lantai`, `jumlah_kamar`, `jumlah_kamar_mandi`, `jumlah_garasi`, `listrik`, `longitude`, `latitude`, `sertifikat`, `status_publish`, `bangunan_slug`, `status_deleted`) VALUES
(9, 6, 7, 3, 21, 'MBR', '36', 'Rumah MBR murah', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 120000000, 'Jalan Dama', '200', 120, 130, '10 x 12', '10 x 12', '1', '2', '2', '1', '900', '', '', '', '1', 'rumah-mbr-murah-19050285', 0),
(10, 6, 7, 3, 21, 'NON MBR', '45', 'Rumah hunian sederhana', '-', 250000000, 'Jalan Dama', '100', 200, 210, '20 x 10', '21 x 10', '2', '3', '2', '1', '4400', '', '', '', '1', 'rumah-hunian-sederhana-190422945', 0),
(11, 6, 7, 3, 21, 'NON MBR', '45', 'Rumah Siap Huni', '-', 250000000, 'Jalan Dama', '100', 200, 210, '20 x 10', '20 x 10', '2', '3', '2', '1', '4400', '', '', '', '1', 'rumah-siap-huni-190820160', 0),
(12, 9, 7, 5, 6, 'MBR', '45', 'Rumah MBR keren', '-', 50000000, 'Jalan Keledang', '5', 200, 220, '20 x 10', '20 x 11', '1', '1', '1', '3', '4400', '', '', '', '1', 'rumah-mbr-keren-190502395', 0),
(13, 6, 7, 3, 21, 'MBR', '45', 'Rumah Siap Huni', '-', 123, 'Jalan Dama', '234', 200, 220, '22 x 11', '11 x 22', '1', '8', '6', '2', '10000', '', '', '', '1', 'rumah-siap-huni-190912213', 0),
(14, 6, 7, 3, 21, 'MBR', '36', 'Rumah MBR 2020', 'Ayo beli rumah MBR tahun 2020 di perumahan baru, bebas banjir dan akses mudah dengan pusat kota', 90000000, 'Jalan Dama', '5', 180, 200, '12 x 10', '10 x 20', '1', '3', '2', '1', '1300', '', '', '', '1', 'rumah-mbr-2020-200804964', 0),
(15, 15, 7, 10, 49, 'NON MBR', '36', 'Rumah tipe 36', 'dijual rumah tipe 36', 150000000, 'Jalan Panjaitan', '100', 80, 150, '10 x 8', '10 x 15', '2', '4', '2', '1', '2200', '', '', '', '1', 'rumah-tipe-36-201012747', 0),
(16, 16, 7, 6, 16, 'MBR', '36', 'Rumah tipe 36A', 'Rumah murah tipe 36 2020', 100000000, 'Jalan Kadrie Oneng', '100', 80, 150, '8 x 10', '10 x 15', '2', '4', '2', '1', '2200', '', '', '', '1', 'rumah-tipe-36a-201014558', 0),
(17, 6, 7, 3, 21, 'MBR', '45', 'tes', '1', 1, 'Jalan Dama', '1', 1, 1, '1 x 1', '1 x 1', '1', '1', '1', '1', '450', '', '', '', '2', 'tes-201015386', 0),
(18, 18, 23, 1, 61, 'NON MBR', '54/120', 'Cluster Kakaban', 'Rumah Unit Tipe 54/120', 802000000, 'Jl. H.A.M.M Riffadin Ruko E2-11, Harapan Baru, Kec. Loa Janan Ilir Kota Samarinda Kalimantan Timur 75131', '3', 54, 120, '8 x 7', '8 x 15', '1', '2', '1', '1', '1300', '', '', '', '1', 'cluster-kakaban-201015525', 0),
(19, 18, 23, 1, 61, 'NON MBR', '48/105', 'Cluster Kakaban', 'Rumah Unit  Tipe 48/105', 727000000, 'Jl. H.A.M.M Riffadin Ruko E2-11, Harapan Baru, Kec. Loa Janan Ilir Kota Samarinda Kalimantan Timur 75131', '5', 48, 105, '8 x 6', '7 x 15', '1', '2', '1', '1', '1300', '', '', '', '1', 'cluster-kakaban-201015875', 0),
(20, 18, 23, 1, 61, 'NON MBR', '96', 'Cluster Maya', 'Rumah Unit Tipe 96/200', 1381000000, 'Jl. H.A.M.M Riffadin Ruko E2-11, Harapan Baru, Kec. Loa Janan Ilir Kota Samarinda Kalimantan Timur 75131', '5', 96, 200, '8 x 6', '8 x 16', '2', '4', '3', '1', '1300', '', '', '', '1', 'cluster-maya-201015837', 0),
(21, 19, 7, 6, 16, 'MBR', '36', 'Rumah murah baru 2020', 'deksripsi', 140000000, 'lokasi perumahan', '100', 100, 150, '10 x 10', '10 x 15', '2', '3', '2', '1', '1300', '', '', '', '1', 'rumah-murah-baru-2020-201021153', 0),
(22, 23, 32, 1, 3, 'kategori', 'MBR', '123', 'deskripsi', 20000, 'Jalan Slamet Riyadi', '10', 10, 10, '10 x 10', '10 x 10', '10', '20', '30', '5', '200', '123', '123', '', '2', '22-123', 0),
(23, 23, 32, 1, 3, 'kategori', 'MBR', 'Ini bangunanku', 'deskripsi', 20000, 'Jalan Slamet Riyadi', '10', 10, 10, '10 x 10', '10 x 10', '10', '20', '30', '5', '200', '123', '123', '', '2', '23-ini-bangunanku', 0),
(24, 28, 32, 1, 60, 'MBR', '60/SA', 'Rumah Islamic 2', 'lorem ipsum dolor sit amet dfdf', 50000000, 'ddfdsfdz', '10', 166, 150, '13 x 13', '15 x 10', '2', '2', '2', '2', '1300', '1234', '1234', '', '2', '24-rumah-islamic-2', 0),
(25, 28, 32, 1, 60, 'NON MBR', '6A', 'Cluster Maratua 2', 'Rumah unit tipe 6A', 10000000, 'ddfdsfdz', '10', 100, 10, '10 x 10', '10 x 10', '1', '3', '3', '2', '1300', '1234', '1234', '', '2', '25-cluster-maratua-2', 0),
(26, 30, 32, 5, 6, 'MBR', '40/S', 'Cluster Maratua', 'dfdf', 999998, 'Jalan H.A.A.M Riffadin Ruko E2-11, Harapan', '3', 100, 100, '10 x 8', '100 x 100', '3', '2', '2', '2', '7700', '117.12134357804592', '-0.5230678418392927', '', '0', '26-cluster-maratua', 0),
(27, 30, 32, 5, 6, 'MBR', 'dfdf', 'Cluster Maratua 2', 'erere', 100, 'Jalan H.A.A.M Riffadin Ruko E2-11, Harapan', '100', 100, 100, '10 x 10', '10 x 10', '2', '2', '2', '7', '7700', '117.12134357804592', '-0.5230678418392927', '', '0', '27-cluster-maratua-2', 0),
(28, 31, 25, 3, 21, 'MBR', 'asd', 'kursi', 'kayu', 23122, 'jalan sejahtera', '1', 0, 0, '0 x 0', '0 x 0', '1', '1', '2', '2', '900', '117.11645545991382', '-0.5131278320735362', '', '0', '28-kursi', 0),
(29, 30, 32, 5, 6, 'MBR', 'MBR', 'Rumah Islamic', 'Lorem ipsum', 1, 'Jalan H.A.A.M Riffadin Ruko E2-11, Harapan', '2', 100, 100, '10 x 10', '10 x 10', '3', '2', '3', '6', '10600', '117.12134357804592', '-0.5230678418392927', '', '0', '29-rumah-islamic', 0),
(30, 35, 25, 5, 7, 'NON MBR', 'asd', 'sad', 'das', 1, 'asd', '-2', 1, 1, '11 x 1', '1 x 1', '2', '2', '7', '3', '10000', '0', '0', '', '0', '30-sad', 0);

-- --------------------------------------------------------

--
-- Table structure for table `brosur_pengembang`
--

CREATE TABLE `brosur_pengembang` (
  `id_brosur_pengembang` int(11) NOT NULL,
  `id_pengembang` int(11) NOT NULL,
  `brosur_pengembang` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brosur_pengembang`
--

INSERT INTO `brosur_pengembang` (`id_brosur_pengembang`, `id_pengembang`, `brosur_pengembang`) VALUES
(10, 32, 'pengembang/brosur/7126-20201224-perumahan-dregalle-menjadi-pilihan-yang-tepat.jpg'),
(11, 32, 'pengembang/brosur/9213-20201224-perumahan-grand-sejahtera-sungai-jawi.jpg'),
(12, 32, 'pengembang/brosur/8468-20201224-perumahan-terlaris-di-ponorogo.jpeg'),
(20, 32, 'pengembang/brosur/2484-20210107-3.jpg'),
(21, 32, 'pengembang/brosur/2661-20210107-6.jpg'),
(22, 32, 'pengembang/brosur/9936-20210107-ig.png'),
(23, 32, 'pengembang/brosur/7954-20210114-583px-logo-kota-samarinda.png'),
(24, 32, 'pengembang/brosur/3500-20210114-react.png'),
(25, 25, 'pengembang/brosur/5011-20210301-screenshot-13.png'),
(27, 25, 'pengembang/brosur/8508-20210302-screenshot-16.png');

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
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
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
(37, 1, 'Kolam Renang'),
(38, 22, 'Kamar Mandi'),
(39, 22, 'Kamera CCTV'),
(40, 23, 'Kamar Mandi'),
(41, 23, 'Kamera CCTV'),
(42, 24, 'Lampu taman'),
(43, 24, 'Kamera CCTV'),
(44, 25, 'mantap'),
(45, 25, 'Snapdragon'),
(46, 26, 'Playground'),
(47, 26, 'Area komersil'),
(48, 26, 'ATM Center'),
(49, 27, 'ATM Center'),
(50, 27, 'Keamanan Security'),
(51, 28, 'Snapdragon'),
(52, 28, 'Rest area'),
(53, 28, 'ATM Center'),
(57, 29, 'ATM Center'),
(58, 30, 'Snapdragon'),
(59, 31, 'jalan bagus'),
(60, 32, 'jalan bagus'),
(61, 33, 'jalan bagus'),
(62, 34, 'Keamanan Securuty'),
(63, 35, 'jalan bagus');

-- --------------------------------------------------------

--
-- Table structure for table `file_form_data_perumahan`
--

CREATE TABLE `file_form_data_perumahan` (
  `id_file_form` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  `status_active` int(1) NOT NULL DEFAULT '0',
  `status_deleted` int(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `file_form_data_perumahan`
--

INSERT INTO `file_form_data_perumahan` (`id_file_form`, `file`, `status_active`, `status_deleted`, `created_at`, `updated_at`) VALUES
(4, 'admin/form/9212-20201219-bukti-pendaftaran-wisuda.pdf', 0, 0, '2020-12-19 06:11:32', '2020-12-19 06:11:32'),
(5, 'admin/form/6524-20201219-bukti-pendaftaran-wisuda.pdf', 0, 0, '2020-12-19 06:14:28', '2020-12-19 06:14:28'),
(6, 'admin/form/2793-20201219-ika.pdf', 0, 0, '2020-12-19 06:16:38', '2020-12-19 06:16:38'),
(7, 'admin/form/2789-20201219-ika.pdf', 0, 1, '2020-12-19 06:29:45', '2020-12-19 14:32:49'),
(8, 'admin/form/9211-20201219-transkip-nilai.pdf', 0, 1, '2020-12-19 07:37:04', '2020-12-19 14:32:06');

-- --------------------------------------------------------

--
-- Table structure for table `form_data_perumahan`
--

CREATE TABLE `form_data_perumahan` (
  `id_form_data_perumahan` int(11) NOT NULL,
  `id_file_form` int(11) NOT NULL,
  `id_pengembang` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  `status_deleted` int(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `form_data_perumahan`
--

INSERT INTO `form_data_perumahan` (`id_form_data_perumahan`, `id_file_form`, `id_pengembang`, `file`, `status_deleted`, `created_at`, `updated_at`) VALUES
(6, 6, 32, 'pengembang/form/2839-20201224-ika.pdf', 0, '2020-12-24 07:46:33', '2020-12-24 07:46:33'),
(8, 6, 32, 'pengembang/form/2333-20201224-ika.pdf', 0, '2020-12-24 11:48:16', '2020-12-24 11:48:16'),
(9, 6, 32, 'pengembang/form/5508-20201224-bukti-pendaftaran-wisuda.pdf', 0, '2020-12-24 12:06:59', '2020-12-24 12:06:59'),
(10, 6, 32, 'pengembang/form/7828-20210105-bukti-pendaftaran-wisuda.pdf', 0, '2021-01-05 01:35:09', '2021-01-05 01:35:09'),
(13, 6, 25, 'pengembang/form/7401-20210302-2793-20201219-ika.pdf', 0, '2021-03-02 01:31:00', NULL);

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
(33, 21, 'download2.jpg', '1'),
(34, 22, 'bangunan/foto/4995-20201128-1.png', '1'),
(35, 22, 'bangunan/foto/3278-20201128-2.jpg', '0'),
(36, 23, 'bangunan/foto/7272-20201128-1.png', '1'),
(37, 23, 'bangunan/foto/5775-20201128-2.jpg', '0'),
(38, 24, 'bangunan/foto/8237-20201222-perumahan-dregalle-menjadi-pilihan-yang-tepat.jpg', '1'),
(39, 25, 'bangunan/foto/3396-20201222-5e5f5145e0948.jpeg', '0'),
(40, 25, 'bangunan/foto/9980-20201223-perumahan-grand-sejahtera-sungai-jawi.jpg', '0'),
(42, 25, 'bangunan/foto/8110-20201223-perumahan-quality-garden-luncurkan-dp-0-rupiah-untuk-tni-polri-asn-m-121462.jpg', '1'),
(43, 25, 'bangunan/foto/6720-20201224-5e5f5145e0948.jpeg', '0'),
(44, 25, 'bangunan/foto/1460-20201224-perumahan-dregalle-menjadi-pilihan-yang-tepat.jpg', '0'),
(45, 26, 'bangunan/foto/9376-20210301-5e5f5145e0948.jpeg', '1'),
(46, 27, 'bangunan/foto/9581-20210301-perumahan-grand-sejahtera-sungai-jawi.jpg', '1'),
(47, 28, 'bangunan/foto/8657-20210302-screenshot-16.png', '1'),
(48, 29, 'bangunan/foto/2179-20210302-perumahan-dregalle-menjadi-pilihan-yang-tepat.jpg', '1'),
(49, 29, 'bangunan/foto/35-20210302-perumahan-grand-sejahtera-sungai-jawi.jpg', '0'),
(50, 30, 'bangunan/foto/9779-20210302-screenshot-16.png', '1');

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
(44, 15, 'rumahsehar.png', '0'),
(45, 22, 'perumahan/foto/6844-20201127-3x4.jpg', '1'),
(57, 27, 'perumahan/foto/2165-20201222-perumahan-grand-sejahtera-sungai-jawi.jpg', '0'),
(58, 27, 'perumahan/foto/7682-20201222-perumahan-parayasa-0-km-stasiun-parung-panjang-baru-bogor-indonesia.jpg', '0'),
(59, 27, 'perumahan/foto/5901-20201222-perumahan-quality-garden-luncurkan-dp-0-rupiah-untuk-tni-polri-asn-m-121462.jpg', '1'),
(60, 27, 'perumahan/foto/7295-20201222-img-20200930-225638-862.jpg', '0'),
(61, 27, 'perumahan/foto/6217-20201222-img-20201002-231521-698.jpg', '0'),
(64, 27, 'perumahan/foto/7735-20201222-3x4.jpg', '0'),
(66, 28, 'perumahan/foto/7374-20201222-5e5f5145e0948.jpeg', '0'),
(67, 28, 'perumahan/foto/590-20201222-perumahan-dregalle-menjadi-pilihan-yang-tepat.jpg', '0'),
(68, 28, 'perumahan/foto/2350-20201222-perumahan-grand-sejahtera-sungai-jawi.jpg', '0'),
(71, 28, 'perumahan/foto/7721-20201226-img-20200930-225638-862.jpg', '1'),
(73, 29, 'perumahan/foto/8645-20210106-5e5f5145e0948.jpeg', '1'),
(74, 29, 'perumahan/foto/6799-20210106-perumahan-dregalle-menjadi-pilihan-yang-tepat.jpg', '0'),
(75, 29, 'perumahan/foto/1733-20210106-perumahan-grand-sejahtera-sungai-jawi.jpg', '0'),
(76, 30, 'perumahan/foto/555-20210106-5e5f5145e0948.jpeg', '1'),
(77, 30, 'perumahan/foto/920-20210106-perumahan-dregalle-menjadi-pilihan-yang-tepat.jpg', '0'),
(78, 26, 'perumahan/foto/7224-20210106-perumahan-parayasa-0-km-stasiun-parung-panjang-baru-bogor-indonesia.jpg', '1'),
(79, 26, 'perumahan/foto/3034-20210106-perumahan-quality-garden-luncurkan-dp-0-rupiah-untuk-tni-polri-asn-m-121462.jpg', '0'),
(80, 26, 'perumahan/foto/5405-20210106-perumahan-terlaris-di-ponorogo.jpeg', '0'),
(81, 25, 'perumahan/foto/7181-20210106-perumahan-grand-sejahtera-sungai-jawi.jpg', '1'),
(82, 25, 'perumahan/foto/2716-20210106-perumahan-parayasa-0-km-stasiun-parung-panjang-baru-bogor-indonesia.jpg', '0'),
(83, 24, 'perumahan/foto/4704-20210106-5e5f5145e0948.jpeg', '0'),
(84, 24, 'perumahan/foto/448-20210106-perumahan-dregalle-menjadi-pilihan-yang-tepat.jpg', '1'),
(85, 23, 'perumahan/foto/4450-20210106-perumahan-quality-garden-luncurkan-dp-0-rupiah-untuk-tni-polri-asn-m-121462.jpg', '1'),
(86, 31, 'perumahan/foto/3623-20210302-screenshot-16.png', '1'),
(87, 32, 'perumahan/foto/2266-20210302-screenshot-16.png', '1'),
(88, 33, 'perumahan/foto/4877-20210302-screenshot-16.png', '1'),
(89, 34, 'perumahan/foto/4732-20210302-583px-logo-kota-samarinda.png', '1'),
(90, 35, 'perumahan/foto/4518-20210302-screenshot-16.png', '1');

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
  `kontak_pesan` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kontak`
--

INSERT INTO `kontak` (`id_kontak`, `kontak_nama`, `kontak_telepon`, `kontak_pesan`, `created_at`) VALUES
(5, 'iqbal wahyudi', '0823542222341', '-', '2021-01-02 17:00:00'),
(6, 'Nova Dwi Sapta', '08123213123', 'Lorem Ipsum Bro', '2021-01-02 17:00:00'),
(7, 'Anto', '0812312321', 'Tolong mapnya diperbaiki', '2021-01-02 17:00:00'),
(8, 'Lyntom', '0812312321', 'Tolong mapnya diperbaiki', '2021-01-02 17:00:00'),
(9, 'Anto 2', '0812323442', 'Websitenya keren bang', '2021-01-02 17:00:00'),
(10, 'Nova', '0812323442', 'fdfdsfss', '2021-01-13 13:40:20'),
(11, 'Anto', '0812323442', 'dfdfafsdfs', '2021-01-13 15:08:47');

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
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status_deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengembang`
--

INSERT INTO `pengembang` (`id_pengembang`, `nik_pengembang`, `nama_pengembang`, `telepon_pengembang`, `email_pengembang`, `alamat_pengembang`, `pengembang_slug`, `ijin_perusahaan`, `foto_pengembang`, `id_user`, `status_aktif`, `created_at`, `updated_at`, `status_deleted`) VALUES
(6, '01283981028', 'nama', '0823123121', 'emaaail@email.com1', 'jalan alamat1', 'nama-190617444', '', '539RUMAH_SEHAT_BIRU.png', 16, '0', '2020-11-19 06:07:56', '2020-11-19 06:07:56', 0),
(7, '6473839303183785', 'Iqbal wahyudi', '082352260345', 'iqbal.wahyudi_25@gmail.com', 'jalan m.said', 'iqbal-wahyudi-190430784', 'rumah.jpg', 'willsmith_actor.jpg', 3, '0', '2020-11-19 06:07:56', '2020-11-19 06:07:56', 0),
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
(25, '-', 'PT Haidir Griya Karya', '081346604110', 'palaranindahresidences@yahoo.com', 'Jl. Niaga, RT 19, Kel. Handil Bhakti, Kec. Palaran', '25-pt-haidir-griya-karya', 'Sertifikat_Induk.pdf', 'photo6267073617145735873.jpg', 44, '1', '2020-11-19 06:07:56', '2021-03-01 18:38:59', 0),
(26, '94 Tanggal 24 April ', 'PT Embun Pagi Berseri', '082331370800', 'newbumicitralestari@gmail.com ', 'Jl Jakarta Gg. Perjuangan Blok 9 No. 9D Rt. 72 Kel. Loa Bakung Kec. sungai Kunjang Samarinda Kalimantan Timur', 'pt-embun-pagi-berseri-201021330', 'NIB_9120009551889.pdf', 'Foto_Kantor.jpg', 45, '1', '2020-11-19 06:07:56', '2020-11-19 06:07:56', 0),
(27, '-', 'PT Timur Adya Citra', '08888888', 'email@email.com', 'Jl.Bukit Alaya Samarinda', 'pt-timur-adya-citra-201021334', 'Untitled-13.png', 'user3.png', 46, '1', '2020-11-19 06:07:56', '2020-11-19 06:07:56', 0),
(32, '6403056711970001', 'Nova Dwi Sapta Nain Seven 123', '0812444373231', 'novagitarisav7@gmail.com', 'Jalan Slamet Riadi', '32-nova-dwi-sapta-nain-seven-123', 'pengembang/file/kVEw9Qhc9sh80XjexjA2rPfYrd4m7EZx6svAjN95.pdf', 'pengembang/foto/0dxnpz0XAS4Fzab0WsTaFS53U4TDTbX3dEhuAH8D.png', 13, '1', '2020-11-18 23:31:49', '2021-01-13 23:21:08', 0),
(33, '123123', 'Ikwal Ramadhani', '0812444373231', 'ikwal123@gmail.com', 'Jalan Slamet Riadi', '33-ikwal-ramadhani', '/api/pengembang/file/eOO8ueEiIzdg4rvfTU82bUcVUSsjMopXbdyciBd3.xlsx', '/api/pengembang/foto/a6QMhmd9hbPvwcdt43ECWiKSEvANK72uu9pbdShT.png', 14, '0', '2020-11-18 23:35:41', '2020-11-19 05:01:45', 0),
(34, '2312', 'Lyntom Irfan Darmawan', '082321453', 'lyntom123@gmail.com', 'Jalan Rajawali', '34-lyntom-irfan-darmawan', '/api/pengembang/file/kA4VFsZwsl2pLi9czoyVJlSESZWDgBjBrhuvD2JJ.pdf', 'pengembang/foto/vQJ086Ikd4H90LKFoISvRCLZjYyAMRWcp5MFfTaI.jpeg', 15, '1', '2020-11-20 05:08:57', '2020-12-29 20:39:14', 0),
(35, '6403056700970001', 'Riptcode', '082321453', 'riptcode@gmail.com', 'Jalan Rajawali', '35-riptcode', '/api/pengembang/file/ckMu7RpyexFQ56unNZnrkUmuprHDnVUwvyxdNtug.pdf', 'pengembang/foto/p4Ofkv8jqR5C77L2VYSaeKkoMwHfTX4ZqR6pXP9v.jpeg', 16, '1', '2020-12-17 05:55:54', '2020-12-29 20:44:12', 0),
(36, '6403056700970001', 'Riptcode', '082321453', 'riptcode@gmail.com', 'Jalan Rajawali', '36-riptcode', 'pengembang/file/JvXlpbWhC7GbnekIOJTUNy8iVZjEPyTscEQlMdj4.pdf', 'pengembang/foto/RbjQBgOWa34HQUV8mbz33iiWZivauFwHiAdDZF6a.jpeg', 17, '0', '2020-12-17 05:57:11', '2020-12-17 05:57:11', 0),
(37, '123', 'nova', '123', 'nova@gmail.com', 'fadfads', '37-nova', 'pengembang/file/tsxMMziUr6H4ZmSGjALDakzXk7Ysa7OjhwrIYwaZ.pdf', 'pengembang/foto/Qd8VuaWfjbvgCt5FPznGLMKxuy5e5iROjBnjEigx.jpeg', 18, '0', '2020-12-18 06:51:59', '2020-12-18 06:51:59', 0),
(38, '12345', 'Testing hapus', '1233456', 'testing@gmail.com', 'Jalan Testing', '38-testing-hapus', 'pengembang/file/J0P5ayTmvk6mZeFPrS60phUjF6vWwDZ0dRKIOQ3D.pdf', 'pengembang/foto/1ey2q1ATeDijU2qt3as8CHekjF9UajZpmvfGDMjX.jpeg', 19, '0', '2020-12-18 07:41:49', '2020-12-18 07:41:49', 0),
(39, '123', 'Riptcode123', '123', 'riptcode@gmail.com', 'Jalan Riptcode', '39-riptcode123', 'pengembang/file/qQjS73iM2e5ZwRpBRaxy1qiyOauXN7H5jQriVGzl.pdf', 'pengembang/foto/Bz7j6yjZO76DR2okj6qL1qoSfHbFbwIGNERXTZGV.jpeg', 20, '0', '2020-12-18 08:34:45', '2020-12-18 09:08:00', 0),
(40, '6403056700970001', 'Riptcode', '082321453', 'riptcode@gmail.com', 'Jalan Rajawali', '40-riptcode', 'pengembang/file/VfOCxPZxVSA67Ag6vIKUh3jUBrBXmcfknNNAgiCl.pdf', 'pengembang/foto/jHrjHVjFhxTu8cZNKlP29zQcqofk0IxXPWw6qdBq.jpeg', 21, '0', '2020-12-18 08:48:51', '2020-12-18 08:48:51', 0),
(41, '6403056700970001', 'Riptcode 123', '082321453', 'riptcode@gmail.com', 'Jalan Rajawali', '41-riptcode-123', 'pengembang/file/15dtgZzJ7y5q9D0iR1f3NAlHjicuFGP4FZpBfyVK.pdf', 'pengembang/foto/mDddSYj5JcOAx99WBFSE2TYMa2P6UKBQNvx4KLKJ.jpeg', 22, '0', '2020-12-18 09:01:10', '2020-12-18 20:23:12', 0),
(42, '12345', 'Arthur Morgan', '1233456', 'arthur@gmail.com', 'Jalan Pangeran Antasari', '42-arthur-morgan', 'pengembang/file/m0Xg99p3fBQQ37a0Q505RGw7ndZG4qqmBu1Jd6yL.pdf', 'pengembang/foto/yNE1FvxZBlxSSzXLyroeuRwWP8c4gPZY6SGN1LZp.jpeg', 25, '0', '2020-12-21 04:01:10', '2020-12-21 04:01:10', 0),
(43, '-', 'vandyfernanda', '-', 'vandyfernanda@gmail.com', 'Jalan merdeka', '43-vandyfernanda', 'pengembang/file/jiys6DEiI7Z43Skz3BFw9JS1baVxJgl7Q4m5PSRb.pdf', 'pengembang/foto/Iw2ve46psLci6SFEZ2ZRnORhVuZB4Q1Vn9jAoVrI.png', 44, '0', '2021-03-01 00:21:25', '2021-03-01 00:21:25', 0);

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
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(35, 'App\\Models\\User', 2, 'user-token', 'ea41bc1757a9a3c0b53d33b861871c13d62f793209ea1666de15b518910030f8', '[\"*\"]', '2020-12-14 03:58:14', '2020-12-14 03:57:59', '2020-12-14 03:58:14'),
(39, 'App\\Models\\User', 2, 'user-token', 'cb91c0dae8bc930ac5875d25bc477ad84300aad111b8940f18f88e2a6257424f', '[\"*\"]', '2020-12-14 04:11:52', '2020-12-14 04:10:35', '2020-12-14 04:11:52'),
(42, 'App\\Models\\User', 2, 'user-token', 'dbd224ee16f600bc5e683ca47317521a3a84d30bb5e8a16f4f84927c138508a1', '[\"*\"]', '2020-12-14 04:18:06', '2020-12-14 04:18:03', '2020-12-14 04:18:06'),
(43, 'App\\Models\\User', 13, 'user-token', 'b2f520fac0683e27c0a300c010795d56b6692a61a13e61b0d2802e4779defc4c', '[\"*\"]', '2020-12-14 04:20:25', '2020-12-14 04:20:23', '2020-12-14 04:20:25'),
(44, 'App\\Models\\User', 2, 'user-token', '3da6f9a17ddcc9c3e7dfbc464e8279db5150b118507e28118bef3472b6988f9d', '[\"*\"]', '2020-12-14 04:22:20', '2020-12-14 04:22:18', '2020-12-14 04:22:20'),
(48, 'App\\Models\\User', 2, 'user-token', '5e92aec1fb50dbd5ad761073e619f2fa9c979e23373622af8f2e5ff06916b671', '[\"*\"]', '2020-12-14 08:50:08', '2020-12-14 05:19:09', '2020-12-14 08:50:08'),
(49, 'App\\Models\\User', 2, 'user-token', '47e0f15203f759b6bd72c6ed3c86e24aff2fae398fbef73e0524f01cd6aa23b5', '[\"*\"]', '2020-12-14 05:24:14', '2020-12-14 05:20:49', '2020-12-14 05:24:14'),
(50, 'App\\Models\\User', 2, 'user-token', '2d2f1323b34a06006845e4117417be45464f4d02fabd41127313927405ea1e0c', '[\"*\"]', '2020-12-15 07:12:44', '2020-12-15 03:59:44', '2020-12-15 07:12:44'),
(51, 'App\\Models\\User', 2, 'user-token', 'f1cfbb66b5acc3fd48c64d4f35509d2395b777a560314d3a395f52dae3d22ceb', '[\"*\"]', '2020-12-15 06:04:12', '2020-12-15 04:11:05', '2020-12-15 06:04:12'),
(52, 'App\\Models\\User', 13, 'user-token', '4f25c71183078d1707c174d3e295f290c9b83d488072d2258d5dd4c692304468', '[\"*\"]', '2020-12-15 05:07:12', '2020-12-15 05:02:32', '2020-12-15 05:07:12'),
(53, 'App\\Models\\User', 2, 'user-token', 'f49f95f2876ba3e4c1875e0e40eb5147a0dc659ae5bceb4d2c63ded8a2a5f43a', '[\"*\"]', '2020-12-16 07:16:39', '2020-12-16 04:15:42', '2020-12-16 07:16:39'),
(54, 'App\\Models\\User', 2, 'user-token', '1d2e9662e3b48646110606983a945c688a59d830be2671fe515c165f8620b990', '[\"*\"]', '2020-12-17 06:27:15', '2020-12-16 04:22:23', '2020-12-17 06:27:15'),
(55, 'App\\Models\\User', 2, 'user-token', 'e251739152cdcc8b56343280db331a483b273fbb4f19cf297b6d2741188050af', '[\"*\"]', '2020-12-16 08:56:49', '2020-12-16 07:47:51', '2020-12-16 08:56:49'),
(56, 'App\\Models\\User', 2, 'user-token', '6c4607e037531b7e1253c309f74219a8d469f2afb805966783b4b2384144842b', '[\"*\"]', '2020-12-17 07:10:31', '2020-12-17 05:07:04', '2020-12-17 07:10:31'),
(57, 'App\\Models\\User', 2, 'user-token', '901bfbbb950962f49adfe2b60cc9c83a0b7b7b9c3b647ddbaa1130031a3494ab', '[\"*\"]', '2020-12-18 07:57:01', '2020-12-18 06:32:12', '2020-12-18 07:57:01'),
(58, 'App\\Models\\User', 2, 'user-token', 'fd3810691842c3e4084a9d1933433ccf9ab6f0857ca1eac7af879926a9675c81', '[\"*\"]', '2020-12-21 05:07:52', '2020-12-18 08:03:01', '2020-12-21 05:07:52'),
(59, 'App\\Models\\User', 2, 'user-token', '4717f0a1f0291281ee934e621286253c34943ecd3b20f0c14e1ff662f1e54f2c', '[\"*\"]', '2020-12-19 08:26:50', '2020-12-18 19:34:14', '2020-12-19 08:26:50'),
(60, 'App\\Models\\User', 2, 'user-token', '4eb87fb7e486d9acf09b4dcff875b32c2d34db0fb480cb4ecdf4ad8f5c2136a8', '[\"*\"]', '2020-12-19 08:58:43', '2020-12-19 08:39:30', '2020-12-19 08:58:43'),
(61, 'App\\Models\\User', 2, 'user-token', '8f3a5762ab49cf9f99f9ad218fa977ea74f41934ce8ab50baca9723fcabae597', '[\"*\"]', '2020-12-19 09:25:00', '2020-12-19 09:23:02', '2020-12-19 09:25:00'),
(62, 'App\\Models\\User', 2, 'user-token', '5d00904bbf704b6f320f6c87228e89e27f3b4d5ce43c7917834d1d39543fb97c', '[\"*\"]', '2020-12-20 05:55:32', '2020-12-20 01:22:10', '2020-12-20 05:55:32'),
(64, 'App\\Models\\User', 13, 'user-token', 'baf6151889423f2add47f471aa819dfd8e09c0bc70e65cc52fc683f071ee8104', '[\"*\"]', '2020-12-21 07:13:32', '2020-12-21 04:33:58', '2020-12-21 07:13:32'),
(65, 'App\\Models\\User', 13, 'user-token', 'd78687e32c43b2986859211560421287befb85832942b410ff8355ffadfd4742', '[\"*\"]', '2021-01-13 20:21:16', '2020-12-21 04:44:10', '2021-01-13 20:21:16'),
(66, 'App\\Models\\User', 13, 'user-token', 'beabc1c5960b037743f10332a482bbb733deff27fdb03162c4c895ffc6b9b289', '[\"*\"]', '2020-12-21 20:23:06', '2020-12-21 17:52:14', '2020-12-21 20:23:06'),
(67, 'App\\Models\\User', 13, 'user-token', '3263fb5ad10031a120a6c54e5b6eb37fed90954136a951aabfd65c0dbd6d497d', '[\"*\"]', '2020-12-21 21:07:36', '2020-12-21 20:25:07', '2020-12-21 21:07:36'),
(68, 'App\\Models\\User', 13, 'user-token', '193a866c3986e87217f931f2d083810c26ebb228dbe092f662e2cf2afa28f204', '[\"*\"]', '2020-12-22 00:16:03', '2020-12-21 21:08:33', '2020-12-22 00:16:03'),
(69, 'App\\Models\\User', 13, 'user-token', '320cd4f4ac67b64a69f18c13ed8690672c6879345e95ec5ccc49777df1a79c6d', '[\"*\"]', '2020-12-22 06:42:48', '2020-12-22 06:03:43', '2020-12-22 06:42:48'),
(73, 'App\\Models\\User', 13, 'user-token', 'ea36dda21b7327f97e1862f8cf7908dcf7789ee26322ad2e649ddc4d41ea8904', '[\"*\"]', '2020-12-22 22:15:43', '2020-12-22 17:09:16', '2020-12-22 22:15:43'),
(74, 'App\\Models\\User', 13, 'user-token', 'efeb85b8e667b4eb35e9a7e3d050b49ad6a853661b5ec7e669aefcd4d2da30f6', '[\"*\"]', '2020-12-22 22:38:46', '2020-12-22 22:36:02', '2020-12-22 22:38:46'),
(75, 'App\\Models\\User', 13, 'user-token', '534673327cd6b471b24457b4bf9250fa651eb70e73efddbc36265a0eb7db78a3', '[\"*\"]', '2020-12-23 00:32:19', '2020-12-22 22:39:13', '2020-12-23 00:32:19'),
(76, 'App\\Models\\User', 13, 'user-token', '395384562757908b3002e77ff4df0fcb5b874bfc2b7b374aa16757e7122a857e', '[\"*\"]', '2020-12-24 06:12:02', '2020-12-23 19:45:45', '2020-12-24 06:12:02'),
(78, 'App\\Models\\User', 13, 'user-token', '6eb85b0db774a52b1599858d75aa84e123183bc6db7cac48e91accc92d7fcf8a', '[\"*\"]', '2020-12-24 19:47:13', '2020-12-24 19:47:09', '2020-12-24 19:47:13'),
(79, 'App\\Models\\User', 13, 'user-token', '8abb1339ae9246f3171e35062e2e3d38b81e1988968fef9862d69e68a5fe2928', '[\"*\"]', '2020-12-25 23:47:02', '2020-12-25 23:00:52', '2020-12-25 23:47:02'),
(80, 'App\\Models\\User', 2, 'user-token', 'e1085024bee4b92176479d149485ca6e04f0108f97f3cd2856f9e5d80eace841', '[\"*\"]', '2020-12-27 20:47:08', '2020-12-27 20:47:03', '2020-12-27 20:47:08'),
(82, 'App\\Models\\User', 13, 'user-token', '9fcca65069eed240929a47a315ea1690d975925b0d5556b57c711a03b0ba4beb', '[\"*\"]', '2020-12-29 19:21:53', '2020-12-29 19:08:03', '2020-12-29 19:21:53'),
(83, 'App\\Models\\User', 2, 'user-token', 'aa22a9b3c3d76216adc5047140e89bf4941a808718929bc3e03bfccc86f8982d', '[\"*\"]', '2020-12-29 20:44:21', '2020-12-29 19:09:54', '2020-12-29 20:44:21'),
(84, 'App\\Models\\User', 13, 'user-token', '02832f8a3a49a6d915aa6d00dfa69650ba82bd4e6eaa89856322ddfdbaa3ef41', '[\"*\"]', '2021-01-01 23:20:40', '2021-01-01 23:06:28', '2021-01-01 23:20:40'),
(85, 'App\\Models\\User', 13, 'user-token', 'def2cf885934616086298c7ad67b233a82b751526c4bff8f7980ce4c051aca8e', '[\"*\"]', '2021-01-02 00:28:26', '2021-01-01 23:50:00', '2021-01-02 00:28:26'),
(86, 'App\\Models\\User', 13, 'user-token', '0eef194be802093a92feca53a37fc75fca5647eb68698f96b98aa8f7cf9da303', '[\"*\"]', '2021-01-02 01:53:57', '2021-01-02 01:14:05', '2021-01-02 01:53:57'),
(87, 'App\\Models\\User', 13, 'user-token', '06ea2398d6464158d8aba99e3243b7c0fd2cf586494a29b069f4e3b2484b83d9', '[\"*\"]', '2021-01-02 01:57:51', '2021-01-02 01:57:40', '2021-01-02 01:57:51'),
(91, 'App\\Models\\User', 2, 'user-token', 'f86808781c4ecf4d896e2c7f6fbe73e5485808588ff4c8b49ffc49a63f3c2d78', '[\"*\"]', '2021-01-03 05:58:30', '2021-01-03 05:24:24', '2021-01-03 05:58:30'),
(92, 'App\\Models\\User', 2, 'user-token', '17dc2d8d7c365af232439429806013fa805af5ab9cf4c82d218843037ee3b861', '[\"*\"]', '2021-01-03 08:11:07', '2021-01-03 06:12:21', '2021-01-03 08:11:07'),
(93, 'App\\Models\\User', 2, 'user-token', '28ed76f97a45ed4d1d45e5bf0bc4d1e003e2a1b4cb65a2023a8886a6bd78d528', '[\"*\"]', '2021-01-03 18:04:28', '2021-01-03 17:41:15', '2021-01-03 18:04:28'),
(98, 'App\\Models\\User', 2, 'user-token', 'b16ecdc8c5467383103048c47412a8a3e504dfe18286fcddcdab165a180d254b', '[\"*\"]', '2021-01-04 19:09:24', '2021-01-04 18:37:32', '2021-01-04 19:09:24'),
(99, 'App\\Models\\User', 2, 'user-token', '96ba17f5de5af83507cccddfb5cd6432965ad7f283093549d98c561ac7b2be12', '[\"*\"]', '2021-01-05 07:11:49', '2021-01-04 19:11:53', '2021-01-05 07:11:49'),
(100, 'App\\Models\\User', 2, 'user-token', '4af03c0b7d3d39ed062aa46fdc0e55801cf10dfcfd8dad0f4d10e75decb74f9e', '[\"*\"]', '2021-01-05 00:05:29', '2021-01-04 21:40:27', '2021-01-05 00:05:29'),
(101, 'App\\Models\\User', 2, 'user-token', '0e5022a653e7b26c3f6975535cad282d4b93638ce7064fc3343676e94d0c226b', '[\"*\"]', '2021-01-05 06:09:03', '2021-01-05 05:29:38', '2021-01-05 06:09:03'),
(105, 'App\\Models\\User', 13, 'user-token', 'a641aa73faf35905f48ac60a046e42f5583cc6328d404181b225781c794548e2', '[\"*\"]', '2021-01-05 08:05:36', '2021-01-05 07:12:32', '2021-01-05 08:05:36'),
(111, 'App\\Models\\User', 13, 'user-token', '34c86673ccf9faf1a537b10fc22d7f8162ab217b41295c7abcb3f29e1a84794d', '[\"*\"]', '2021-01-05 23:27:05', '2021-01-05 22:53:04', '2021-01-05 23:27:05'),
(112, 'App\\Models\\User', 13, 'user-token', 'aa7c5bebc6365735d85647f26daa755919a4ea4997c7a9395bc17092763462ae', '[\"*\"]', '2021-01-06 06:07:23', '2021-01-06 05:59:34', '2021-01-06 06:07:23'),
(113, 'App\\Models\\User', 13, 'user-token', '82ccca2663fc70fe9c8b7adb4d529e9ebb044344548afa189a9cca9b968a78ac', '[\"*\"]', '2021-01-07 01:05:29', '2021-01-07 00:38:01', '2021-01-07 01:05:29'),
(114, 'App\\Models\\User', 2, 'user-token', '10dc8abbdc555a8ba9c934d94475d33e3c2f88b404106ffa911662e1ddc144f6', '[\"*\"]', NULL, '2021-01-13 19:47:02', '2021-01-13 19:47:02'),
(115, 'App\\Models\\User', 2, 'user-token', 'e77da62f8988bb375d027b1c63ef28792b85b208d1e4d57a2d2bce3e379b737f', '[\"*\"]', '2021-01-13 19:51:27', '2021-01-13 19:51:25', '2021-01-13 19:51:27'),
(116, 'App\\Models\\User', 2, 'user-token', '4796d5b83f82c30573273f3fa99b8dede2b0a4818fe0b7a5c015366495d397f2', '[\"*\"]', '2021-01-13 19:52:48', '2021-01-13 19:52:12', '2021-01-13 19:52:48'),
(117, 'App\\Models\\User', 2, 'user-token', '8f86f039a7f8e46dc89eca2fba1a6262735cfc2ee8282d73c2126dee92cd2098', '[\"*\"]', '2021-01-13 19:52:58', '2021-01-13 19:52:56', '2021-01-13 19:52:58'),
(118, 'App\\Models\\User', 13, 'user-token', '13e8ec0e328b10af73cd30ffd50ee80ab95da796cfb6960385e7b5397871f0a1', '[\"*\"]', '2021-01-13 19:53:34', '2021-01-13 19:53:17', '2021-01-13 19:53:34'),
(119, 'App\\Models\\User', 2, 'user-token', 'aeb78b6df6b06a9c797ef37cdac0a6f7d331df99e2cd084305dd24a3c1256b23', '[\"*\"]', '2021-01-13 19:54:21', '2021-01-13 19:54:19', '2021-01-13 19:54:21'),
(120, 'App\\Models\\User', 2, 'user-token', '663831511cb90d3dfa007728b8dfed7cf901b1e9ea6bd8a064ad98faa739e138', '[\"*\"]', NULL, '2021-01-13 19:55:13', '2021-01-13 19:55:13'),
(121, 'App\\Models\\User', 2, 'user-token', '3005e1ded13190dcf13ba7d614a3588c3bceb13aa08c0d5a9e8e39560763846f', '[\"*\"]', '2021-01-13 19:55:59', '2021-01-13 19:55:56', '2021-01-13 19:55:59'),
(122, 'App\\Models\\User', 2, 'user-token', '14daecaf4298a85b8a6e34f190b2564e5bc86dce3686b3b405caae8a63f26513', '[\"*\"]', '2021-01-13 19:57:08', '2021-01-13 19:57:06', '2021-01-13 19:57:08'),
(123, 'App\\Models\\User', 2, 'user-token', '0efd5c274a467cee625e4437ee7cb900bbc5e7a1b7de7332ba03188f60820d06', '[\"*\"]', '2021-01-13 20:05:09', '2021-01-13 19:59:13', '2021-01-13 20:05:09'),
(125, 'App\\Models\\User', 13, 'user-token', 'eb0e4cd314692358bf9eea81ddee796683e59234586a91e3686d8e51dc482f09', '[\"*\"]', '2021-01-13 20:12:01', '2021-01-13 20:11:59', '2021-01-13 20:12:01'),
(126, 'App\\Models\\User', 13, 'user-token', '97a182c6bdd4d192fbc5b34e803d06bc58b61f127882327d7c582c6fb5860d05', '[\"*\"]', '2021-08-19 18:22:04', '2021-01-13 20:13:07', '2021-08-19 18:22:04'),
(127, 'App\\Models\\User', 13, 'user-token', '101cc9d27997bccd23879d6ba1865d49551066e252b4df628295f82059232f0a', '[\"*\"]', '2021-01-13 20:34:01', '2021-01-13 20:26:42', '2021-01-13 20:34:01'),
(128, 'App\\Models\\User', 13, 'user-token', '7e917e27ee54708c494766f0f06da74eaa557190c37d438b47eadb624dfeffd1', '[\"*\"]', '2021-01-13 20:58:14', '2021-01-13 20:58:11', '2021-01-13 20:58:14'),
(129, 'App\\Models\\User', 13, 'user-token', '71a4d1df03ec61e9c6ad891f33feaf174950ea9c569fc02c6bf3e9dab844c5a0', '[\"*\"]', '2021-01-13 21:23:23', '2021-01-13 20:59:07', '2021-01-13 21:23:23'),
(130, 'App\\Models\\User', 2, 'user-token', '68a05882c79b857472999477f2fae83df61de4481c7e831460d72b0c1354fcdf', '[\"*\"]', NULL, '2021-01-13 21:32:32', '2021-01-13 21:32:32'),
(131, 'App\\Models\\User', 2, 'user-token', '27b56698720a8c703367c91398dc86615615088b1198ee2976b2f37be92ce5b8', '[\"*\"]', NULL, '2021-01-13 21:35:05', '2021-01-13 21:35:05'),
(132, 'App\\Models\\User', 2, 'user-token', 'dffcc98ab504c0cfeacaefb03ac3f3f6ba455ae92508661317dc2283a8843c39', '[\"*\"]', NULL, '2021-01-13 21:39:33', '2021-01-13 21:39:33'),
(133, 'App\\Models\\User', 2, 'user-token', 'eddd253ff7b1994cf8cde2b4e4557422ff92e9950b931f66161ec8d65fd8620a', '[\"*\"]', NULL, '2021-01-13 21:42:44', '2021-01-13 21:42:44'),
(134, 'App\\Models\\User', 2, 'user-token', '3c54de8981417d679f5fcc7a19bb39e04911268f7857b888873b549ce5c37bcb', '[\"*\"]', NULL, '2021-01-13 21:44:50', '2021-01-13 21:44:50'),
(135, 'App\\Models\\User', 2, 'user-token', '9703858bf3cb180f55442417fa772894d0835f304deeda348ba83a9407207a64', '[\"*\"]', NULL, '2021-01-13 21:45:02', '2021-01-13 21:45:02'),
(136, 'App\\Models\\User', 2, 'user-token', 'adc4f401031ec4cd63b57703a949f6aab8de7b19a9776cf45801829139c9a405', '[\"*\"]', NULL, '2021-01-13 21:46:30', '2021-01-13 21:46:30'),
(138, 'App\\Models\\User', 2, 'user-token', 'fb9f52c3897adee3904e3614fe3a4033651e5884a0122385e43e593b7a2e85cf', '[\"*\"]', NULL, '2021-01-13 21:49:05', '2021-01-13 21:49:05'),
(139, 'App\\Models\\User', 2, 'user-token', 'de06ce2cbd3c7eef55e9cbc7f605af75b473768a851b0d0d28ec782c09d7d81f', '[\"*\"]', NULL, '2021-01-13 22:05:41', '2021-01-13 22:05:41'),
(140, 'App\\Models\\User', 2, 'user-token', '775ba53db86eddec00edce862ab20f0b686b5ec3671a0942b6f5b77375cd5a82', '[\"*\"]', NULL, '2021-01-13 22:06:39', '2021-01-13 22:06:39'),
(141, 'App\\Models\\User', 2, 'user-token', 'f18792471e4df5f8933a1605cbe27e224fa615f16e929281ee79d811f0992f97', '[\"*\"]', NULL, '2021-01-13 22:07:24', '2021-01-13 22:07:24'),
(142, 'App\\Models\\User', 2, 'user-token', 'd76e6e2153c86459b53b1bc4294af53c8287410cd7b07f0352f72c8e6d6261fa', '[\"*\"]', NULL, '2021-01-13 22:09:31', '2021-01-13 22:09:31'),
(146, 'App\\Models\\User', 13, 'user-token', '4ae485ded81b99bbd956d351443140d050c4e0c6016b7862ed8a823710283a93', '[\"*\"]', '2021-01-13 22:18:18', '2021-01-13 22:17:55', '2021-01-13 22:18:18'),
(148, 'App\\Models\\User', 13, 'user-token', '070e391d79b122ed78ac9d78863fa6940f7a4e5e41516f1792f680de178c9c5d', '[\"*\"]', '2021-01-13 22:20:59', '2021-01-13 22:20:46', '2021-01-13 22:20:59'),
(150, 'App\\Models\\User', 13, 'user-token', '968abff0743c054f0341235bc27eadcd508efc7c4531b3c773ab580adfbf9e20', '[\"*\"]', '2021-01-13 23:19:49', '2021-01-13 22:22:32', '2021-01-13 23:19:49'),
(151, 'App\\Models\\User', 13, 'user-token', 'f4c330710b4fc68a6f4dc43088375cda9765b7c7c94b394b4ab0fd4c6eccd286', '[\"*\"]', NULL, '2021-01-13 22:52:05', '2021-01-13 22:52:05'),
(152, 'App\\Models\\User', 13, 'user-token', 'a6c6b6ceb3751a81d44694d9ce58cd08927fb38921b51958c987d2d4e026f155', '[\"*\"]', NULL, '2021-01-13 22:52:23', '2021-01-13 22:52:23'),
(153, 'App\\Models\\User', 13, 'user-token', 'c61a43fede1c6c480c7a05ca1ee50ac971d718bde95a8d33d3b7d427aa790cc7', '[\"*\"]', NULL, '2021-01-13 22:52:58', '2021-01-13 22:52:58'),
(154, 'App\\Models\\User', 2, 'user-token', 'f1f48d06905c595c5c339b1ef290c762b590fd782747b826814f4e9cee2241ae', '[\"*\"]', NULL, '2021-01-13 22:53:17', '2021-01-13 22:53:17'),
(155, 'App\\Models\\User', 2, 'user-token', 'fcf4cbe41ddd721a60e4a4270452e26378c917143f41c7713a6c54ea8f008b55', '[\"*\"]', NULL, '2021-01-13 22:53:34', '2021-01-13 22:53:34'),
(156, 'App\\Models\\User', 2, 'user-token', 'bd13ebed68fa59dabf5008941afa1b00318a59f182ee2636ecd9b427a78544e1', '[\"*\"]', NULL, '2021-01-13 22:53:57', '2021-01-13 22:53:57'),
(157, 'App\\Models\\User', 2, 'user-token', '5c57ca8f018ee217077c463ad2c44bd88ac3ee2e3c310807b2256ebb8166fc64', '[\"*\"]', NULL, '2021-01-13 22:54:08', '2021-01-13 22:54:08'),
(159, 'App\\Models\\User', 13, 'user-token', 'c8f97be050585db6d3f778174bf6958c616c71352c0503fd670ebea811faeb9e', '[\"*\"]', '2021-01-13 23:00:59', '2021-01-13 22:57:33', '2021-01-13 23:00:59'),
(161, 'App\\Models\\User', 13, 'user-token', 'e5448cb9d46cb6b6f5d013b030b08c160172d863d4c25b674c56593ab29f70e2', '[\"*\"]', '2021-01-13 23:22:42', '2021-01-13 23:06:53', '2021-01-13 23:22:42'),
(162, 'App\\Models\\User', 13, 'user-token', 'c8d3908faa0608e22b0c0967f9ee43a8aaa90da0cc9e123e732a789e22e51062', '[\"*\"]', '2021-01-13 23:29:09', '2021-01-13 23:28:38', '2021-01-13 23:29:09'),
(163, 'App\\Models\\User', 13, 'user-token', 'b7c8f5d5417eeeb7b297c7e6780c38ecf64d3bbe415b1c1b49071c1b9cef794a', '[\"*\"]', '2021-01-14 00:41:25', '2021-01-13 23:52:10', '2021-01-14 00:41:25'),
(164, 'App\\Models\\User', 2, 'user-token', '4b5b6d2b62b2fd40badbb003a7443b8d15dacde72b72f7c1c266730e7ced1648', '[\"*\"]', '2021-01-14 03:37:41', '2021-01-14 03:35:05', '2021-01-14 03:37:41'),
(165, 'App\\Models\\User', 2, 'user-token', '64f7f7281293344237915ab5547c09641b951aa51ada1aeb7537c136bc5c812a', '[\"*\"]', '2021-01-18 19:52:04', '2021-01-18 19:52:02', '2021-01-18 19:52:04'),
(166, 'App\\Models\\User', 2, 'user-token', '1179cb294858cbc0e19a9812119192d72a7c8b0aae69f1fee4fb188d54ac5e2c', '[\"*\"]', '2021-01-26 06:20:23', '2021-01-26 06:20:14', '2021-01-26 06:20:23'),
(167, 'App\\Models\\User', 2, 'user-token', '6a9498f2f985075b3ac10d092e3430c1704a3015dcff17ad0d6d9af71dd58d93', '[\"*\"]', '2021-03-01 00:15:57', '2021-03-01 00:14:29', '2021-03-01 00:15:57'),
(168, 'App\\Models\\User', 43, 'user-token', 'ea8b1f16c56cd1f9079f82919388c3c31f33895deb690f8b8a481295258005d7', '[\"*\"]', '2021-03-01 00:21:24', '2021-03-01 00:16:52', '2021-03-01 00:21:24'),
(171, 'App\\Models\\User', 44, 'user-token', '4b3632e8599860fcaece3b218e3e8149c240cbdeb027db359da30a8986750792', '[\"*\"]', '2021-03-01 00:55:39', '2021-03-01 00:33:19', '2021-03-01 00:55:39'),
(173, 'App\\Models\\User', 44, 'user-token', 'ea31024fe619f7bef6481e29260e9d52cd8886709ef8efe0db7cc7f9007cd530', '[\"*\"]', '2021-03-01 00:51:02', '2021-03-01 00:46:16', '2021-03-01 00:51:02'),
(178, 'App\\Models\\User', 13, 'user-token', '3ecae76d53e14106b11f03b398fc8666fc233fee740d3a3cf31bc483a4a670aa', '[\"*\"]', '2021-03-01 01:15:48', '2021-03-01 01:13:22', '2021-03-01 01:15:48'),
(179, 'App\\Models\\User', 13, 'user-token', 'e8d708ace6730184d29e99393b77ce56b4eecd73dee3b5070067a15e754e5495', '[\"*\"]', '2021-03-01 01:18:39', '2021-03-01 01:17:42', '2021-03-01 01:18:39'),
(180, 'App\\Models\\User', 44, 'user-token', 'cb03bb0a563150d5a6f70eaa9fe5d084e16bef8f39b21e813a856df36c9de6e1', '[\"*\"]', '2021-03-01 18:48:40', '2021-03-01 17:30:27', '2021-03-01 18:48:40'),
(181, 'App\\Models\\User', 13, 'user-token', '1cf15ee3da645a8bc303bd17cae9783ced4d8487c814086505be24cf2a005bca', '[\"*\"]', '2021-03-01 18:08:33', '2021-03-01 18:05:20', '2021-03-01 18:08:33'),
(182, 'App\\Models\\User', 44, 'user-token', '93536b85a45f7d7abdf243653b943264ba396da5fd72a699101ca082a724f7c3', '[\"*\"]', '2021-03-01 18:52:11', '2021-03-01 18:48:54', '2021-03-01 18:52:11'),
(183, 'App\\Models\\User', 44, 'user-token', 'e5cd0bd7e5ba7972a7e09695554e8fded9dbe96926cdbbf9dc982eb8a278a32a', '[\"*\"]', '2021-03-01 18:57:49', '2021-03-01 18:52:26', '2021-03-01 18:57:49'),
(184, 'App\\Models\\User', 44, 'user-token', '55115ddaed75c74a4e83a516c5a4006232066378dce70f92bb42fde3104a0287', '[\"*\"]', '2021-03-01 18:58:29', '2021-03-01 18:58:17', '2021-03-01 18:58:29'),
(185, 'App\\Models\\User', 44, 'user-token', 'ac857b8a8dc069393498144ae6dccd1257deaee47396de04a6e45356ffb2f312', '[\"*\"]', '2021-03-01 19:00:57', '2021-03-01 18:58:35', '2021-03-01 19:00:57'),
(186, 'App\\Models\\User', 44, 'user-token', '281354a6fd257615e23dc8ba90784baebd9d46c6ebdf62931f526c3d20c82aed', '[\"*\"]', '2021-03-01 19:03:15', '2021-03-01 19:01:44', '2021-03-01 19:03:15'),
(189, 'App\\Models\\User', 13, 'user-token', '24a8c29d21b9d35844c1c150dfc53da3e8945d202d537e16d4538344d4b387cc', '[\"*\"]', '2021-03-01 20:00:29', '2021-03-01 19:57:22', '2021-03-01 20:00:29'),
(193, 'App\\Models\\User', 44, 'user-token', 'a2fc8be49c7ea882bfec05463c59d87ceea3cee8aa3e3fd41fd5b1d612281671', '[\"*\"]', '2021-03-01 22:28:21', '2021-03-01 22:27:31', '2021-03-01 22:28:21'),
(194, 'App\\Models\\User', 44, 'user-token', 'd125274f9735819f7210297e09edb1c51fc868d89563b6bd8c82395ef507b6b7', '[\"*\"]', '2021-03-01 22:29:57', '2021-03-01 22:28:30', '2021-03-01 22:29:57'),
(197, 'App\\Models\\User', 44, 'user-token', 'a3d2c872ac39186aa101350549ac47f4a46035d4cff1449860530e27d743a47b', '[\"*\"]', '2021-03-01 22:32:45', '2021-03-01 22:32:11', '2021-03-01 22:32:45'),
(198, 'App\\Models\\User', 43, 'user-token', '3166d7541d5e7cf5ae40a6a633d9f2cd6bbf78659f6366a797bff116e9a3c797', '[\"*\"]', '2021-03-01 22:33:21', '2021-03-01 22:33:21', '2021-03-01 22:33:21'),
(199, 'App\\Models\\User', 43, 'user-token', '0a4711945d0ccc576fec034d6e02ac871d5a4b6655968821ed6fc43b11bb6fe2', '[\"*\"]', '2021-03-01 22:33:58', '2021-03-01 22:33:57', '2021-03-01 22:33:58'),
(200, 'App\\Models\\User', 44, 'user-token', '22d00a524062966026ad15bdb1f871d62a2941466460ba3f7cbe1ee19ff43181', '[\"*\"]', '2021-03-03 22:53:58', '2021-03-03 22:53:51', '2021-03-03 22:53:58'),
(207, 'App\\Models\\User', 2, 'user-token', '7a7e69e43b49689ee749badcb5b2b92c375a7ef2776823bebaacfe126fbfadd9', '[\"*\"]', '2021-08-19 18:11:43', '2021-08-19 18:05:02', '2021-08-19 18:11:43'),
(208, 'App\\Models\\User', 45, 'user-token', '013f47a4c76c607c3ff05fbaf8c49140045b955baf99197cfc566acf3f585494', '[\"*\"]', '2021-08-19 18:17:49', '2021-08-19 18:07:59', '2021-08-19 18:17:49'),
(209, 'App\\Models\\User', 3, 'user-token', '0154f0fc41228fdc600144ab220e941e325bf2e318dabbb3d7b00818306a9126', '[\"*\"]', '2021-08-19 18:36:51', '2021-08-19 18:21:04', '2021-08-19 18:36:51');

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
  `longitude` varchar(200) NOT NULL DEFAULT '0',
  `latitude` varchar(200) NOT NULL DEFAULT '0',
  `legalitas` varchar(200) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `status_perumahan` varchar(25) NOT NULL,
  `status_deleted` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perumahan`
--

INSERT INTO `perumahan` (`id_perumahan`, `id_pengembang`, `id_kecamatan`, `id_kelurahan`, `nama_perumahan`, `deskripsi_perumahan`, `lokasi`, `longitude`, `latitude`, `legalitas`, `slug`, `status_perumahan`, `status_deleted`) VALUES
(1, 7, 2, 2, 'Perumahan Sejahtera1', '-', 'Lokasi perumahan disini', '117.03207022926154', '-0.5507962787262386', '117.16033352731438', 'perumahan-sejahtera1-190430969', '1', 0),
(6, 7, 3, 21, 'Perumahan Damai Sejahtera', 'opasdjkasopdasdoopasjdopjasdpjop', 'Jalan Dama', '117.11020840523383', '-0.5580592583990835', 'construction-worker.png', 'perumahan-damai-sejahtera-190513158', '2', 0),
(7, 7, 6, 14, 'Perumahan Damai1', '', 'Jalan Graha Indah', '117.13757260482294', '-0.49870532421209646', 'automation.png', 'perumahan-damai1-190422649', '2', 0),
(8, 7, 9, 37, 'Perumahan Hills', '', 'Jalan Graha Indaha', '117.29478281629076', '-0.5655634313352635', 'curve-24.png', 'perumahan-hills-190416579', '1', 0),
(9, 7, 5, 6, 'Perumahan Keren', '', 'Jalan Keledang', '117.30434045124355', '-0.45543945164118327', '1556180793388.jpg', 'perumahan-keren-190502690', '1', 0),
(10, 7, 9, 38, 'Perumahan Tes', '', 'Jalan Karang Asam', '117.03502072212723', '-0.4547231596136072', 'Screenshot_(21).png', 'perumahan-tes-190502770', '1', 0),
(11, 7, 3, 21, 'Perumahan Damaix', '', 'Jalan Dama', '117.03055752632622', '-0.4729186692780587', 'Screenshot_(9).png', 'perumahan-damaix-190502184', '0', 0),
(12, 7, 2, 2, 'Perumahan Hillsl', '', 'Jalan Graha Indah', '117.21457852242747', '-0.450260102997845', 'Screenshot_(23).png', 'perumahan-hillsl-190502625', '1', 0),
(13, 7, 4, 54, 'Perumahan Vrindavan', 'deskripsi1', 'Jalan Keledang', '117.08789242622606', '-0.48115812977056294', 'Screenshot_(28).png', 'perumahan-vrindavan-190507826', '0', 0),
(14, 7, 6, 16, 'Perumahan Baru', 'Perumahan modern dengan sistem cluster dan berlokasi strategis di Samarinda. Rumah Dengan Design Minimalis namun tetap Modern. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 'Jalan Lokasi Perumahan ', '117.06471814035172', '-0.5134292526477395', 'image-upload.png', 'perumahan-baru-200804368', '0', 0),
(15, 7, 10, 49, 'Citraland Panjaitan', 'perumahan citraland, rumah menengah dan rumah mewah', 'Jalan Panjaitan', '117.20232197582618', '-0.4774445211906624', 'download_(1).jpg', 'citraland-panjaitan-201012235', '1', 0),
(16, 7, 6, 16, 'Perumahan ABC', 'perumahan baru di samarinda', 'Jalan Kadrie Oneng', '117.12772210048843', '-0.483280160530569', 'download_(1)1.jpg', 'perumahan-abc-201014405', '1', 0),
(17, 22, 10, 51, 'CitraLand Samarinda', 'CitraLand city Samarinda merupakan masterpiece persembahan ciputra Group, developer terkemuka dengan berbagai proyek properti di Indonesia dan mancanegara, seperti CitraLand Surabaya, CitraGarden City Jakarta, CitraGran Cibubur, Ciputra World Jakarta, Ciputra World Surabaya, CitraSun Garden Semarang, CitraLand Pekanbaru, CitraLand Celebes, Ciputra Hanoi International City, Grand Phnom Penh International City dan masih banyak lagi yang lain. Selamlebih dari 30 tahun, Ciputra Group telah membangun reputasi unggul dalam pengembangan propertiyang berkualitas dalam infrastruktur, bangunan dan pelayanan pelanggan.\r\n\r\nDr. HC. Ir. Ciputra, pendiri Ciputra Group yang telah berkarya lebih dari 30 tahun, dianggap sebagai Begawan dalam dunia property Indonesia, beliau juga merupakan pendiri dari grup developer raksasa lain seperti Metropolitan Group dan Jaya Group. Dr. HC. Ir. Ciputra adalah seorang tokoh entrepreneurship nasional yang berkomitmen menciptakan generasi entrepreneur melalui sekolah dan universitas yang didirikannya.\r\n\r\nSetelah sukses dengan penjualan tahp pertama seluas 33 hektar, kini CitraLand City Samarinda menghadirkan masterplan tahap II dengan konsep “A New Dimension of Living” seluas 60 hektare. Residential area di CitraLand City Samarinda didesain dengan konsep private cluster, one gate system, rumah tanpa pagar, dengan lingkungan dan landscape yang tertata asri. Privasi dan keamanan penghuni semakin sempurna dengan adanya jaringan utilitas bawah tanah, system keamanan 24 jam serta fasilitas penghuni berupa Electronic Access Card pribadi, Security System & Alarm System dan CCTV, yang menjamin keamanan rumah dan privasi keluarga Anda. Komitmen jangka panjang Ciputra Group akan memastikan pengembangan berjalan kontinu dalam skala yang lebih besar, sekaligus memberikan peningkatan kualitas gaya hidup dan investasi bagi Anda yang menjadi bagian di dalamnya.\r\n\r\nTemui The Symphony of Park, thematic park seluas 5 hektar yang membelah site CitraLand City Samarinda sepanjang 1 km dan menjadi jantung kawasan untuk menghadirkan A New Dimension of Happiness.  Konsep Symphony of Park menggabungkan dimensi Leisure, Healthy Living dan Lifestyle menjadi sebuah harmoni, bagaikan gubahan simfoni yang selaras. Untuk mewujudkan Inner Personal Happiness penghuni, taman didesain untuk mensinergikan aspek Mind, Body & Soul melalui 3 tema taman yang selaras : Garden of Love (Soul/Lifestyle), garden of Sound (Mind/Leisure) dan Garden of Vigor (Body/Health). Sebagai ending – dimensi celebration of life, hadir Garden of Bliss, terdiri atas CitraLand Waterpark, Ballerina Lake dan Promenade of Joy.\r\n\r\nSebagai komitmen Ciputra Group untuk menciptakan hunian prestisius yang lengkap dan hidup, CitraLand City Samarinda menghadirkan Sekolah Citra Kasih dan Sparkling Taste @ I-Walk. Kehadiran sekolah swasta terbaik dan konsep baru kuliner ini akan semakin menaikkan image kawasan, sekaligus nilai investasi property Anda.\r\n\r\nSekolah Citra Kasih menempati site seluas 8.000m2, menawarkan pendidikan nasional plus berkualitas dengan spirit 21st century education & entrepreneurship, mulai jenjang TK, SD, SMP dan SMA. Sekolah Citra Kasih ini merupakan sekolah yang dikelola langsung oleh Ciputra Group.\r\n\r\nCitraLand City Samarinda memiliki lokasi yang strategis di Jalan D.I. Panjaitan, slah satu jalur utama kota Samarinda. Lokasi bisa dicapai hanya 10 menit dari pusat kota dan 25 menit dari bandara baru Samarinda.', 'Jl. DI Panjaitan, Mugirejo, Kec. Sungai Pinang, Kota Samarinda, Kalimantan Timur 75243', '117.18634159314058', '-0.4588224986897558', 'citraland.jpg', 'citraland-samarinda-201014795', '1', 0),
(18, 23, 1, 61, 'Tamansari Grand Samarinda Residence', 'Beauty Nature Within Your Window', 'Jl. H.A.M.M Riffadin Ruko E2-11, Harapan Baru, Kec. Loa Janan Ilir Kota Samarinda Kalimantan Timur 75131', '117.11716077857034', '-0.561919207545003', 'siteplan_kakaban.pdf', 'tamansari-grand-samarinda-residence-201015886', '1', 0),
(19, 7, 6, 16, 'Perumahan Sample', 'dekripsi perumahan', 'lokasi perumahan', '117.1294671839214', '-0.4977241180325649', 'download.jpg', 'perumahan-sample-201021553', '1', 0),
(20, 27, 10, 49, 'Alaya', 'Kawasan Hijau dengan Fasilitas Terlengkap di Samarinda dan Hunian Bebas Banjir', 'Jl.Bukit Alaya', '117.17545620611969', '-0.466335461147267', '05_brosur_ALAYA_copy_siteplan.jpg', 'alaya-201021479', '1', 0),
(21, 7, 2, 2, 'tes', 'tes', 'lokasi', '117.06832302925909', '-0.5148024883757074', 'Tugas_ke-2_Metode_Numerik.pdf', 'tes-201027657', '0', 0),
(22, 32, 6, 13, 'Rumah Impian Nova', 'Lorem Ipsum Dolor Sit Amet', 'Jalan Slamet Riyadi', '0', '0', '', '22-rumah-impian-nova', '0', 0),
(23, 32, 2, 3, 'Rumah Surga Nova test', 'Lorem Ipsum Dolor Sit Amet', 'Jalan Slamet Riyadi', '117.11226475817176', '-0.519468041040966', 'perumahan/file/2800-20201127-IKA.pdf', '23-rumah-surga-nova-test', '2', 0),
(24, 32, 4, 55, 'Perumahan Bayangkari', 'Perumahan yang indah dan murah', 'Jalan Slamet Riyadi 123', '117.14423030359154', '-0.48086533048656577', 'perumahan/file/1610-20201221-transkip-nilai.pdf', '24-perumahan-bayangkari', '2', 0),
(25, 32, 4, 54, 'Dinas Perumahan dan Permukiman Samarinda', 'Lorem Ipsum dolor sit amet', 'Jalan Balai Kota', '117.1605709683858', '-0.48575563052298776', 'perumahan/file/277-20201222-bukti-pendaftaran-wisuda.pdf', '25-dinas-perumahan-dan-permukiman-samarinda', '2', 0),
(26, 32, 2, 1, 'Tamansari Grand Samarinda Residance', 'Beauty nature within your window', 'Jl. H.A.M.M Riffadin Ruko E2-11, Harapan Baru, Kec. Loa Janan Ilir, Kota Samarinda Kalimantan Timur 75131', '117.13690966959183', '-0.49743452595875226', 'perumahan/file/7080-20201222-transkip-nilai.pdf', '26-tamansari-grand-samarinda-residance', '2', 0),
(27, 32, 1, 58, 'Perumahan Kuy Entertainment', 'Hidup itu dibawa santai saja', 'Jalan H.A.A.M Riffadin Ruko E2-11, Harapan', '117.12292255593968', '-0.4844511574235639', 'perumahan/file/760-20201222-bukti-pendaftaran-wisuda.pdf', '27-perumahan-kuy-entertainment', '2', 0),
(28, 32, 1, 60, 'Perumahan Bayangkari 2z', 'sddsdz', 'Jalan H.A.A.M Riffadin Ruko E2-11, Harapan', '117.11540789501248', '-0.4996933452444381', 'perumahan/file/8488-20201222-bukti-pendaftaran-wisuda.pdf', '28-perumahan-bayangkari-2z', '2', 0),
(29, 32, 3, 21, 'Perumahan Antasari', 'lorem ipsum dolor sit amet', 'Jalan Slamet Riyadi 123', '117.11490413940834', '-0.5151848219329764', 'perumahan/file/9593-20210106-bukti-pendaftaran-wisuda.pdf', '29-perumahan-antasari', '2', 0),
(30, 32, 5, 6, 'Perumahan Sungai Kledang', 'lorem ipsum dolor sit amet', 'Jalan H.A.A.M Riffadin Ruko E2-11, Harapan', '117.12134357804592', '-0.5230678418392927', 'perumahan/file/6668-20210106-bukti-pendaftaran-wisuda.pdf', '30-perumahan-sungai-kledang', '2', 0),
(31, 25, 3, 21, 'Perumahan Sejahtera', 'Jual Rumah', 'jalan sejahtera', '117.11645545991382', '-0.5131278320735362', 'perumahan/file/4283-20210302-manual-pengembang-eperumahan.pdf', '31-perumahan-sejahtera', '0', 0),
(32, 25, 1, 59, 'Perumahan Sejahtera 2', 'jual rumah', 'jalan sejahtera', '0', '0', 'perumahan/file/7278-20210302-manual-pengembang-eperumahan.pdf', '32-perumahan-sejahtera-2', '0', 0),
(33, 25, 1, 61, 'Perumahan Sejahtera 3', 'jual rumah', 'jalan sejahtera', '0', '0', 'perumahan/file/1587-20210302-2793-20201219-ika.pdf', '33-perumahan-sejahtera-3', '0', 0),
(34, 32, 4, 56, 'Tamansari Grand Samarinda Residance', 'sds', 'sdsdsd', '117.11489119639856', '-0.5114027041741878', 'perumahan/file/2692-20210302-file-pdf.pdf', '34-tamansari-grand-samarinda-residance', '0', 0),
(35, 25, 5, 7, 'asd', 'asd', 'asd', '0', '0', 'perumahan/file/1258-20210302-2793-20201219-ika.pdf', '35-asd', '1', 0);

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
(44, 21, 'tes'),
(45, 22, 'Taman Bermain'),
(46, 22, 'Lapangan Tenis'),
(47, 23, 'Taman Bermain'),
(48, 23, 'Lapangan Tenis'),
(49, 24, 'Taman Bermain'),
(50, 24, 'Lapangan Tenis'),
(51, 25, 'nasgor'),
(52, 25, 'Komputer'),
(53, 26, 'Keamanan Security'),
(54, 26, 'Masjid'),
(55, 26, 'Lapangan basket / volly'),
(57, 27, 'Lapangan basket / volly'),
(58, 27, 'Masjid'),
(61, 28, 'realme'),
(63, 27, 'Komputer'),
(64, 28, 'Komputer'),
(67, 29, 'Komputer'),
(68, 30, 'Komputer'),
(69, 31, 'ada jalan'),
(70, 32, 'ada jalan'),
(71, 33, 'ada jalan'),
(72, 34, 'Komputer'),
(73, 35, 'ada jalan');

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
(58, 21, 'Lantai Keramik'),
(59, 22, 'Warna merah'),
(60, 22, 'Remang - remang'),
(61, 23, 'Warna merah'),
(62, 23, 'Remang - remang'),
(63, 24, 'Kayu c'),
(64, 25, 'Dinding Plester'),
(65, 25, 'Lantai Keramik'),
(66, 26, 'Kayu c'),
(67, 27, 'Lantai Keramik'),
(68, 28, 'kuat'),
(69, 29, 'Dinding Plester'),
(70, 29, 'Lantai Keramik'),
(71, 30, 'asd');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(25) NOT NULL,
  `status_deleted` int(1) NOT NULL DEFAULT '0',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `level`, `status`, `status_deleted`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'novadwisapta', '1', 1, 0, NULL, '$2y$10$AateYE38SbdmwcGimblKJuAzQ.SWOueG.1f57WTRDYFfH.8SB7khG', NULL, '2020-11-18 17:47:56', '2020-11-18 18:32:45'),
(3, 'iqbalwahyudi', '2', 1, 0, NULL, '$2y$10$gOBe3XsWRGuy6ix1nnv5E.3qdXHovm10Qs97iv131ELzB.rXaxw/.', NULL, '2020-11-18 17:54:11', '2020-11-22 18:17:35'),
(13, 'pengembang', '2', 1, 0, NULL, '$2y$10$VX0jePxC3wzarh1WpkeyTOsafLrxJeqVdjY4nxDiVtJs9u/Ihr7K.', NULL, '2020-11-18 23:31:49', '2020-11-18 23:31:49'),
(14, 'pengembang2', '2', 1, 0, NULL, '$2y$10$Z20B8ggY5RnuMzh1H1BLGun5z9S/ReFmaUVLaFbPDQ8MC53FGDmim', NULL, '2020-11-18 23:35:41', '2021-03-01 01:12:43'),
(24, 'riptcode', '2', 1, 0, NULL, '$2y$10$Nk21mc2mUDv2zzYIpOOU5eCMgxCXKPvnFsKSQSomeJBNfg0p0BQ86', NULL, '2020-12-17 21:40:52', '2021-03-01 01:10:33'),
(25, 'riptcode3', '2', 0, 0, NULL, '$2y$10$5.jZidGUDcMq5USZgXe3aOkFm7Wa3ZNBXvSYv16gHIMdAqXvcLpgW', NULL, '2020-12-17 21:44:23', '2020-12-17 21:44:23'),
(26, 'riptcode312', '2', 0, 0, NULL, '$2y$10$m1Nb3JTU.4zPfgp3JhDM6eLJdr22wVSDyyKDRuAFF5N1GgTE8OQP2', NULL, '2020-12-17 21:45:28', '2020-12-17 21:45:28'),
(29, 'riptcode1997', '2', 0, 0, NULL, '$2y$10$o5mWpRUcKspsQh5Or36FrOeD8zGGIg57h7blAy2seuQATuoMOMiDu', NULL, '2020-12-17 22:41:59', '2020-12-17 22:41:59'),
(30, 'yudi', '2', 0, 0, NULL, '$2y$10$IRhhiN3wp15KnApn.j0l9.sah2t53Ez7xbLdFCiCREv3PJjsq8rAq', NULL, '2020-12-17 22:43:44', '2020-12-17 22:43:44'),
(31, 'mantap', '2', 0, 0, NULL, '$2y$10$psgdaV9kVxVhoYzA2xQrXOS63pLOAWMoHe2ivfxJHFKomWHkRn.42', NULL, '2020-12-17 22:45:01', '2020-12-17 22:45:01'),
(32, 'mantap123', '2', 0, 0, NULL, '$2y$10$WcMCfNTJneKQpdrmhNnanemPQTrYrBpbd10f.qDcMB39WVBW1vrfm', NULL, '2020-12-17 22:47:47', '2020-12-17 22:47:47'),
(33, 'yudi123', '2', 0, 0, NULL, '$2y$10$ZAsUbyX6lnN2oyy8q.XUS.dpxpvBDUszh.Lq..AF.pLx7AN2AxB5u', NULL, '2020-12-17 22:48:08', '2020-12-17 22:48:08'),
(34, 'yudiasik', '2', 0, 0, NULL, '$2y$10$KPjZGuhe4/V9zsm68fnEOukkM13Rmbji8pt.hzZtHWyAU.Pvm8VJ.', NULL, '2020-12-17 22:49:28', '2020-12-17 22:49:28'),
(35, 'yudiiii', '2', 0, 0, NULL, '$2y$10$g.f7SfsSYBMdKQkLuZtCVu24Sp6clsXPkb0dU2LX.9nCxK3eZZKai', NULL, '2020-12-17 22:51:18', '2020-12-17 22:51:18'),
(36, 'attaa', '2', 1, 0, NULL, '$2y$10$y6we4rEvviUAp.R2x/9XD.CnEhxUk71PmsyMkbsHiGmLDzp.zAxcW', NULL, '2020-12-17 22:52:01', '2020-12-20 17:24:49'),
(37, 'novadwisapta123', '2', 0, 0, NULL, '$2y$10$Absm8XNZWuvn55XRv7iJLOiRqPfFHeqAn1PJDNrT7uhqx3grR1q/y', NULL, '2020-12-21 00:09:24', '2020-12-21 00:09:24'),
(38, 'testtest', '2', 0, 0, NULL, '$2y$10$XcYo3zFAc.BQZfvZBtcx3O4rvaTk.1uHRiH5BUDIvmvm9y6W0y/FW', NULL, '2020-12-21 00:09:32', '2020-12-21 00:09:32'),
(39, 'dsfdsfdsfdsf', '2', 0, 0, NULL, '$2y$10$Ediz0s.GcP2tlyoMBZuJUO9aUlsK/HJhnvQjUTlbPcaXQBaceMiOa', NULL, '2020-12-21 00:10:00', '2020-12-21 00:10:00'),
(40, 'test nama baru', '2', 1, 0, NULL, '$2y$10$zrRVilfh7tgRb32jiTrUD.IbqBlabO4wIxWttAnXa4P65h2j/U6ke', NULL, '2020-12-21 00:10:50', '2020-12-21 00:16:52'),
(41, 'dfdfdfdf', '1', 1, 0, NULL, '$2y$10$XL3AkCeqBaCvM94HsoFfwORXagulV9mkYHt4Y0p0UpP9lttD9vTui', NULL, '2020-12-21 00:18:23', '2020-12-21 00:18:23'),
(42, 'novadwisaptans@gmail.com', '1', 1, 0, NULL, '$2y$10$ojw6qLlXKPled4LwxfcteeFOOsADDAEUZQcyoRt0GPJCp9oHCYgq2', NULL, '2021-01-13 20:05:09', '2021-01-13 20:05:09'),
(43, 'vandi_admin', '1', 1, 0, NULL, '$2y$10$p9At1KjmNJFSi47G3bPX3uR.XUavL5oRfrN219tEqXHODwku8XOwq', NULL, '2021-03-01 00:15:55', '2021-03-01 00:15:55'),
(44, 'vandy', '2', 1, 0, NULL, '$2y$10$RcaFGftrjQ.ftQ.hZkTDq.iUfArMKB68qfdD/i.VM3i5xj4lUu5fq', NULL, '2021-03-01 00:21:25', '2021-03-01 00:21:25'),
(45, 'lyntom', '2', 1, 0, NULL, '$2y$10$b.zTlFhjwLJ9q0JqB.eAk.oXC.FgWvR/W2GhQtbaTV1t5Gt.KR8dC', NULL, '2021-08-17 04:12:43', '2021-08-17 04:12:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bangunan`
--
ALTER TABLE `bangunan`
  ADD PRIMARY KEY (`id_bangunan`);

--
-- Indexes for table `brosur_pengembang`
--
ALTER TABLE `brosur_pengembang`
  ADD PRIMARY KEY (`id_brosur_pengembang`);

--
-- Indexes for table `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`id_fasilitas`);

--
-- Indexes for table `fasilitas_perumahan`
--
ALTER TABLE `fasilitas_perumahan`
  ADD PRIMARY KEY (`id_fasilitas_perumahan`);

--
-- Indexes for table `file_form_data_perumahan`
--
ALTER TABLE `file_form_data_perumahan`
  ADD PRIMARY KEY (`id_file_form`);

--
-- Indexes for table `form_data_perumahan`
--
ALTER TABLE `form_data_perumahan`
  ADD PRIMARY KEY (`id_form_data_perumahan`);

--
-- Indexes for table `foto_bangunan`
--
ALTER TABLE `foto_bangunan`
  ADD PRIMARY KEY (`id_foto_bangunan`);

--
-- Indexes for table `foto_perumahan`
--
ALTER TABLE `foto_perumahan`
  ADD PRIMARY KEY (`id_foto_perumahan`);

--
-- Indexes for table `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD PRIMARY KEY (`id_kecamatan`);

--
-- Indexes for table `kelurahan`
--
ALTER TABLE `kelurahan`
  ADD PRIMARY KEY (`id_kelurahan`);

--
-- Indexes for table `kontak`
--
ALTER TABLE `kontak`
  ADD PRIMARY KEY (`id_kontak`);

--
-- Indexes for table `pengembang`
--
ALTER TABLE `pengembang`
  ADD PRIMARY KEY (`id_pengembang`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `perumahan`
--
ALTER TABLE `perumahan`
  ADD PRIMARY KEY (`id_perumahan`);

--
-- Indexes for table `sarana_prasarana_perumahan`
--
ALTER TABLE `sarana_prasarana_perumahan`
  ADD PRIMARY KEY (`id_sarana_prasarana_perumahan`),
  ADD KEY `id_perumahan` (`id_perumahan`);

--
-- Indexes for table `spesifikasi_rumah`
--
ALTER TABLE `spesifikasi_rumah`
  ADD PRIMARY KEY (`id_spesifikasi_rumah`),
  ADD KEY `id_bangunan` (`id_bangunan`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bangunan`
--
ALTER TABLE `bangunan`
  MODIFY `id_bangunan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `brosur_pengembang`
--
ALTER TABLE `brosur_pengembang`
  MODIFY `id_brosur_pengembang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `fasilitas`
--
ALTER TABLE `fasilitas`
  MODIFY `id_fasilitas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fasilitas_perumahan`
--
ALTER TABLE `fasilitas_perumahan`
  MODIFY `id_fasilitas_perumahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `file_form_data_perumahan`
--
ALTER TABLE `file_form_data_perumahan`
  MODIFY `id_file_form` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `form_data_perumahan`
--
ALTER TABLE `form_data_perumahan`
  MODIFY `id_form_data_perumahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `foto_bangunan`
--
ALTER TABLE `foto_bangunan`
  MODIFY `id_foto_bangunan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `foto_perumahan`
--
ALTER TABLE `foto_perumahan`
  MODIFY `id_foto_perumahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

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
  MODIFY `id_kontak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pengembang`
--
ALTER TABLE `pengembang`
  MODIFY `id_pengembang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=210;

--
-- AUTO_INCREMENT for table `perumahan`
--
ALTER TABLE `perumahan`
  MODIFY `id_perumahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `sarana_prasarana_perumahan`
--
ALTER TABLE `sarana_prasarana_perumahan`
  MODIFY `id_sarana_prasarana_perumahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `spesifikasi_rumah`
--
ALTER TABLE `spesifikasi_rumah`
  MODIFY `id_spesifikasi_rumah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
