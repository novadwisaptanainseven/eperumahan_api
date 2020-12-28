-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2020 at 02:47 AM
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
  `bangunan_slug` varchar(200) NOT NULL,
  `status_deleted` int(1) NOT NULL DEFAULT 0
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
(14, 6, 7, 3, 21, 'MBR', '36', 'Rumah MBR 2020', 'Ayo beli rumah MBR tahun 2020 di perumahan baru, bebas banjir dan akses mudah dengan pusat kota', 90000000, 'Jalan Dama', '5', 180, 200, '12 x 10', '10 x 20', '1', '3', '2', '1', '1300', '', '', '', '0', 'rumah-mbr-2020-200804964', 0),
(15, 15, 7, 10, 49, 'NON MBR', '36', 'Rumah tipe 36', 'dijual rumah tipe 36', 150000000, 'Jalan Panjaitan', '100', 80, 150, '10 x 8', '10 x 15', '2', '4', '2', '1', '2200', '', '', '', '1', 'rumah-tipe-36-201012747', 0),
(16, 16, 7, 6, 16, 'MBR', '36', 'Rumah tipe 36A', 'Rumah murah tipe 36 2020', 100000000, 'Jalan Kadrie Oneng', '100', 80, 150, '8 x 10', '10 x 15', '2', '4', '2', '1', '2200', '', '', '', '1', 'rumah-tipe-36a-201014558', 0),
(17, 6, 7, 3, 21, 'MBR', '45', 'tes', '1', 1, 'Jalan Dama', '1', 1, 1, '1 x 1', '1 x 1', '1', '1', '1', '1', '450', '', '', '', '2', 'tes-201015386', 0),
(18, 18, 23, 1, 61, 'NON MBR', '54/120', 'Cluster Kakaban', 'Rumah Unit Tipe 54/120', 802000000, 'Jl. H.A.M.M Riffadin Ruko E2-11, Harapan Baru, Kec. Loa Janan Ilir Kota Samarinda Kalimantan Timur 75131', '3', 54, 120, '8 x 7', '8 x 15', '1', '2', '1', '1', '1300', '', '', '', '1', 'cluster-kakaban-201015525', 0),
(19, 18, 23, 1, 61, 'NON MBR', '48/105', 'Cluster Kakaban', 'Rumah Unit  Tipe 48/105', 727000000, 'Jl. H.A.M.M Riffadin Ruko E2-11, Harapan Baru, Kec. Loa Janan Ilir Kota Samarinda Kalimantan Timur 75131', '5', 48, 105, '8 x 6', '7 x 15', '1', '2', '1', '1', '1300', '', '', '', '1', 'cluster-kakaban-201015875', 0),
(20, 18, 23, 1, 61, 'NON MBR', '96', 'Cluster Maya', 'Rumah Unit Tipe 96/200', 1381000000, 'Jl. H.A.M.M Riffadin Ruko E2-11, Harapan Baru, Kec. Loa Janan Ilir Kota Samarinda Kalimantan Timur 75131', '5', 96, 200, '8 x 6', '8 x 16', '2', '4', '3', '1', '1300', '', '', '', '1', 'cluster-maya-201015837', 0),
(21, 19, 7, 6, 16, 'MBR', '36', 'Rumah murah baru 2020', 'deksripsi', 140000000, 'lokasi perumahan', '100', 100, 150, '10 x 10', '10 x 15', '2', '3', '2', '1', '1300', '', '', '', '1', 'rumah-murah-baru-2020-201021153', 0),
(22, 23, 32, 1, 3, 'kategori', 'MBR', '123', 'deskripsi', 20000, 'Jalan Slamet Riyadi', '10', 10, 10, '10 x 10', '10 x 10', '10', '20', '30', '5', '200', '123', '123', '', '2', '22-123', 0),
(23, 23, 32, 1, 3, 'kategori', 'MBR', 'Ini bangunanku', 'deskripsi', 20000, 'Jalan Slamet Riyadi', '10', 10, 10, '10 x 10', '10 x 10', '10', '20', '30', '5', '200', '123', '123', '', '1', '23-ini-bangunanku', 0),
(24, 28, 32, 1, 60, 'MBR', '60/SA', 'Rumah Islamic 2', 'lorem ipsum dolor sit amet dfdf', 50000000, 'ddfdsfdz', '10', 166, 150, '13 x 13', '15 x 10', '2', '2', '2', '2', '1300', '1234', '1234', '', '0', '24-rumah-islamic-2', 0),
(25, 28, 32, 1, 60, 'NON MBR', '6A', 'Cluster Maratua 2', 'Rumah unit tipe 6A', 10000000, 'ddfdsfdz', '10', 100, 10, '10 x 10', '10 x 10', '1', '3', '3', '2', '1300', '1234', '1234', '', '2', '25-cluster-maratua-2', 0);

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
(12, 32, 'pengembang/brosur/8468-20201224-perumahan-terlaris-di-ponorogo.jpeg');

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
(53, 28, 'ATM Center');

-- --------------------------------------------------------

--
-- Table structure for table `file_form_data_perumahan`
--

CREATE TABLE `file_form_data_perumahan` (
  `id_file_form` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  `status_active` int(1) NOT NULL DEFAULT 0,
  `status_deleted` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
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
  `status_deleted` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `form_data_perumahan`
--

INSERT INTO `form_data_perumahan` (`id_form_data_perumahan`, `id_file_form`, `id_pengembang`, `file`, `status_deleted`, `created_at`, `updated_at`) VALUES
(6, 6, 32, 'pengembang/form/2839-20201224-ika.pdf', 0, '2020-12-24 07:46:33', '2020-12-24 07:46:33'),
(8, 6, 32, 'pengembang/form/2333-20201224-ika.pdf', 0, '2020-12-24 11:48:16', '2020-12-24 11:48:16'),
(9, 6, 32, 'pengembang/form/5508-20201224-bukti-pendaftaran-wisuda.pdf', 0, '2020-12-24 12:06:59', '2020-12-24 12:06:59');

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
(44, 25, 'bangunan/foto/1460-20201224-perumahan-dregalle-menjadi-pilihan-yang-tepat.jpg', '0');

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
(46, 23, 'perumahan/foto/8007-20201127-3x4.jpg', '1'),
(47, 24, 'perumahan/foto/5202-20201215-5e5f5145e0948-jpeg', '1'),
(48, 24, 'perumahan/foto/4462-20201215-perumahan-dregalle-menjadi-pilihan-yang-tepat-jpg', '0'),
(49, 24, 'perumahan/foto/7803-20201215-perumahan-grand-sejahtera-sungai-jawi-jpg', '0'),
(50, 24, 'perumahan/foto/1044-20201215-perumahan-parayasa-0-km-stasiun-parung-panjang-baru-bogor-indonesia-jpg', '0'),
(51, 25, 'perumahan/foto/9452-20201222-5e5f5145e0948-jpeg', '1'),
(52, 25, 'perumahan/foto/9372-20201222-perumahan-dregalle-menjadi-pilihan-yang-tepat-jpg', '0'),
(53, 25, 'perumahan/foto/1634-20201222-perumahan-grand-sejahtera-sungai-jawi-jpg', '0'),
(54, 26, 'perumahan/foto/1464-20201222-perumahan-parayasa-0-km-stasiun-parung-panjang-baru-bogor-indonesia-jpg', '1'),
(55, 26, 'perumahan/foto/7269-20201222-perumahan-quality-garden-luncurkan-dp-0-rupiah-untuk-tni-polri-asn-m-121462-jpg', '0'),
(56, 26, 'perumahan/foto/1010-20201222-perumahan-terlaris-di-ponorogo-jpeg', '0'),
(57, 27, 'perumahan/foto/2165-20201222-perumahan-grand-sejahtera-sungai-jawi.jpg', '0'),
(58, 27, 'perumahan/foto/7682-20201222-perumahan-parayasa-0-km-stasiun-parung-panjang-baru-bogor-indonesia.jpg', '0'),
(59, 27, 'perumahan/foto/5901-20201222-perumahan-quality-garden-luncurkan-dp-0-rupiah-untuk-tni-polri-asn-m-121462.jpg', '0'),
(60, 27, 'perumahan/foto/7295-20201222-img-20200930-225638-862.jpg', '0'),
(61, 27, 'perumahan/foto/6217-20201222-img-20201002-231521-698.jpg', '0'),
(64, 27, 'perumahan/foto/7735-20201222-3x4.jpg', '1'),
(66, 28, 'perumahan/foto/7374-20201222-5e5f5145e0948.jpeg', '0'),
(67, 28, 'perumahan/foto/590-20201222-perumahan-dregalle-menjadi-pilihan-yang-tepat.jpg', '0'),
(68, 28, 'perumahan/foto/2350-20201222-perumahan-grand-sejahtera-sungai-jawi.jpg', '0'),
(71, 28, 'perumahan/foto/7721-20201226-img-20200930-225638-862.jpg', '1');

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
(32, '6403056711970001', 'Nova Dwi Sapta Nain Seven', '0812444373231', 'novagitarisav7@gmail.com', 'Jalan Slamet Riadi', '32-nova-dwi-sapta-nain-seven', 'pengembang/file/kVEw9Qhc9sh80XjexjA2rPfYrd4m7EZx6svAjN95.pdf', 'pengembang/foto/MlFCpEKYSGKU4pSr0Twh0UHTMIwkzskURh9igvrI.jpeg', 13, '1', '2020-11-18 23:31:49', '2020-12-24 19:46:50', 0),
(33, '123123', 'Ikwal Ramadhani', '0812444373231', 'ikwal123@gmail.com', 'Jalan Slamet Riadi', '33-ikwal-ramadhani', '/api/pengembang/file/eOO8ueEiIzdg4rvfTU82bUcVUSsjMopXbdyciBd3.xlsx', '/api/pengembang/foto/a6QMhmd9hbPvwcdt43ECWiKSEvANK72uu9pbdShT.png', 14, '0', '2020-11-18 23:35:41', '2020-11-19 05:01:45', 1),
(34, '2312', 'Lyntom Irfan Darmawan', '082321453', 'lyntom123@gmail.com', 'Jalan Rajawali', '34-lyntom-irfan-darmawan', '/api/pengembang/file/kA4VFsZwsl2pLi9czoyVJlSESZWDgBjBrhuvD2JJ.pdf', '/api/pengembang/foto/lOqTbN85JF8IPQJ836hQIfQjrgr9obCqdlZYWivX.jpeg', 15, '1', '2020-11-20 05:08:57', '2020-11-20 05:31:10', 1),
(35, '6403056700970001', 'Riptcode', '082321453', 'riptcode@gmail.com', 'Jalan Rajawali', '35-riptcode', '/api/pengembang/file/ckMu7RpyexFQ56unNZnrkUmuprHDnVUwvyxdNtug.pdf', '/api/pengembang/foto/otwemq1F0lDT2AS8315LaQJmnVYtDOI5JAKaR3V0.jpeg', 16, '1', '2020-12-17 05:55:54', '2020-12-17 05:55:54', 1),
(36, '6403056700970001', 'Riptcode', '082321453', 'riptcode@gmail.com', 'Jalan Rajawali', '36-riptcode', 'pengembang/file/JvXlpbWhC7GbnekIOJTUNy8iVZjEPyTscEQlMdj4.pdf', 'pengembang/foto/RbjQBgOWa34HQUV8mbz33iiWZivauFwHiAdDZF6a.jpeg', 17, '0', '2020-12-17 05:57:11', '2020-12-17 05:57:11', 1),
(37, '123', 'nova', '123', 'nova@gmail.com', 'fadfads', '37-nova', 'pengembang/file/tsxMMziUr6H4ZmSGjALDakzXk7Ysa7OjhwrIYwaZ.pdf', 'pengembang/foto/Qd8VuaWfjbvgCt5FPznGLMKxuy5e5iROjBnjEigx.jpeg', 18, '0', '2020-12-18 06:51:59', '2020-12-18 06:51:59', 1),
(38, '12345', 'Testing hapus', '1233456', 'testing@gmail.com', 'Jalan Testing', '38-testing-hapus', 'pengembang/file/J0P5ayTmvk6mZeFPrS60phUjF6vWwDZ0dRKIOQ3D.pdf', 'pengembang/foto/1ey2q1ATeDijU2qt3as8CHekjF9UajZpmvfGDMjX.jpeg', 19, '0', '2020-12-18 07:41:49', '2020-12-18 07:41:49', 1),
(39, '123', 'Riptcode123', '123', 'riptcode@gmail.com', 'Jalan Riptcode', '39-riptcode123', 'pengembang/file/qQjS73iM2e5ZwRpBRaxy1qiyOauXN7H5jQriVGzl.pdf', 'pengembang/foto/Bz7j6yjZO76DR2okj6qL1qoSfHbFbwIGNERXTZGV.jpeg', 20, '0', '2020-12-18 08:34:45', '2020-12-18 09:08:00', 0),
(40, '6403056700970001', 'Riptcode', '082321453', 'riptcode@gmail.com', 'Jalan Rajawali', '40-riptcode', 'pengembang/file/VfOCxPZxVSA67Ag6vIKUh3jUBrBXmcfknNNAgiCl.pdf', 'pengembang/foto/jHrjHVjFhxTu8cZNKlP29zQcqofk0IxXPWw6qdBq.jpeg', 21, '0', '2020-12-18 08:48:51', '2020-12-18 08:48:51', 0),
(41, '6403056700970001', 'Riptcode 123', '082321453', 'riptcode@gmail.com', 'Jalan Rajawali', '41-riptcode-123', 'pengembang/file/15dtgZzJ7y5q9D0iR1f3NAlHjicuFGP4FZpBfyVK.pdf', 'pengembang/foto/mDddSYj5JcOAx99WBFSE2TYMa2P6UKBQNvx4KLKJ.jpeg', 22, '0', '2020-12-18 09:01:10', '2020-12-18 20:23:12', 0),
(42, '12345', 'Arthur Morgan', '1233456', 'arthur@gmail.com', 'Jalan Pangeran Antasari', '42-arthur-morgan', 'pengembang/file/m0Xg99p3fBQQ37a0Q505RGw7ndZG4qqmBu1Jd6yL.pdf', 'pengembang/foto/yNE1FvxZBlxSSzXLyroeuRwWP8c4gPZY6SGN1LZp.jpeg', 25, '0', '2020-12-21 04:01:10', '2020-12-21 04:01:10', 0);

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
(65, 'App\\Models\\User', 13, 'user-token', 'd78687e32c43b2986859211560421287befb85832942b410ff8355ffadfd4742', '[\"*\"]', '2020-12-24 19:45:02', '2020-12-21 04:44:10', '2020-12-24 19:45:02'),
(66, 'App\\Models\\User', 13, 'user-token', 'beabc1c5960b037743f10332a482bbb733deff27fdb03162c4c895ffc6b9b289', '[\"*\"]', '2020-12-21 20:23:06', '2020-12-21 17:52:14', '2020-12-21 20:23:06'),
(67, 'App\\Models\\User', 13, 'user-token', '3263fb5ad10031a120a6c54e5b6eb37fed90954136a951aabfd65c0dbd6d497d', '[\"*\"]', '2020-12-21 21:07:36', '2020-12-21 20:25:07', '2020-12-21 21:07:36'),
(68, 'App\\Models\\User', 13, 'user-token', '193a866c3986e87217f931f2d083810c26ebb228dbe092f662e2cf2afa28f204', '[\"*\"]', '2020-12-22 00:16:03', '2020-12-21 21:08:33', '2020-12-22 00:16:03'),
(69, 'App\\Models\\User', 13, 'user-token', '320cd4f4ac67b64a69f18c13ed8690672c6879345e95ec5ccc49777df1a79c6d', '[\"*\"]', '2020-12-22 06:42:48', '2020-12-22 06:03:43', '2020-12-22 06:42:48'),
(73, 'App\\Models\\User', 13, 'user-token', 'ea36dda21b7327f97e1862f8cf7908dcf7789ee26322ad2e649ddc4d41ea8904', '[\"*\"]', '2020-12-22 22:15:43', '2020-12-22 17:09:16', '2020-12-22 22:15:43'),
(74, 'App\\Models\\User', 13, 'user-token', 'efeb85b8e667b4eb35e9a7e3d050b49ad6a853661b5ec7e669aefcd4d2da30f6', '[\"*\"]', '2020-12-22 22:38:46', '2020-12-22 22:36:02', '2020-12-22 22:38:46'),
(75, 'App\\Models\\User', 13, 'user-token', '534673327cd6b471b24457b4bf9250fa651eb70e73efddbc36265a0eb7db78a3', '[\"*\"]', '2020-12-23 00:32:19', '2020-12-22 22:39:13', '2020-12-23 00:32:19'),
(76, 'App\\Models\\User', 13, 'user-token', '395384562757908b3002e77ff4df0fcb5b874bfc2b7b374aa16757e7122a857e', '[\"*\"]', '2020-12-24 06:12:02', '2020-12-23 19:45:45', '2020-12-24 06:12:02'),
(78, 'App\\Models\\User', 13, 'user-token', '6eb85b0db774a52b1599858d75aa84e123183bc6db7cac48e91accc92d7fcf8a', '[\"*\"]', '2020-12-24 19:47:13', '2020-12-24 19:47:09', '2020-12-24 19:47:13'),
(79, 'App\\Models\\User', 13, 'user-token', '8abb1339ae9246f3171e35062e2e3d38b81e1988968fef9862d69e68a5fe2928', '[\"*\"]', '2020-12-25 23:47:02', '2020-12-25 23:00:52', '2020-12-25 23:47:02');

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
(10, 7, 9, 38, 'Perumahan Tes', '', 'Jalan Karang Asam', '117.03502072212723', '-0.4547231596136072', 'Screenshot_(21).png', 'perumahan-tes-190502770', '0', 0),
(11, 7, 3, 21, 'Perumahan Damaix', '', 'Jalan Dama', '117.03055752632622', '-0.4729186692780587', 'Screenshot_(9).png', 'perumahan-damaix-190502184', '0', 0),
(12, 7, 2, 2, 'Perumahan Hillsl', '', 'Jalan Graha Indah', '117.21457852242747', '-0.450260102997845', 'Screenshot_(23).png', 'perumahan-hillsl-190502625', '0', 0),
(13, 7, 4, 54, 'Perumahan Vrindavan', 'deskripsi1', 'Jalan Keledang', '117.08789242622606', '-0.48115812977056294', 'Screenshot_(28).png', 'perumahan-vrindavan-190507826', '0', 0),
(14, 7, 6, 16, 'Perumahan Baru', 'Perumahan modern dengan sistem cluster dan berlokasi strategis di Samarinda. Rumah Dengan Design Minimalis namun tetap Modern. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 'Jalan Lokasi Perumahan ', '117.06471814035172', '-0.5134292526477395', 'image-upload.png', 'perumahan-baru-200804368', '0', 0),
(15, 7, 10, 49, 'Citraland Panjaitan', 'perumahan citraland, rumah menengah dan rumah mewah', 'Jalan Panjaitan', '117.20232197582618', '-0.4774445211906624', 'download_(1).jpg', 'citraland-panjaitan-201012235', '1', 0),
(16, 7, 6, 16, 'Perumahan ABC', 'perumahan baru di samarinda', 'Jalan Kadrie Oneng', '117.12772210048843', '-0.483280160530569', 'download_(1)1.jpg', 'perumahan-abc-201014405', '1', 0),
(17, 22, 10, 51, 'CitraLand Samarinda', 'CitraLand city Samarinda merupakan masterpiece persembahan ciputra Group, developer terkemuka dengan berbagai proyek properti di Indonesia dan mancanegara, seperti CitraLand Surabaya, CitraGarden City Jakarta, CitraGran Cibubur, Ciputra World Jakarta, Ciputra World Surabaya, CitraSun Garden Semarang, CitraLand Pekanbaru, CitraLand Celebes, Ciputra Hanoi International City, Grand Phnom Penh International City dan masih banyak lagi yang lain. Selamlebih dari 30 tahun, Ciputra Group telah membangun reputasi unggul dalam pengembangan propertiyang berkualitas dalam infrastruktur, bangunan dan pelayanan pelanggan.\r\n\r\nDr. HC. Ir. Ciputra, pendiri Ciputra Group yang telah berkarya lebih dari 30 tahun, dianggap sebagai Begawan dalam dunia property Indonesia, beliau juga merupakan pendiri dari grup developer raksasa lain seperti Metropolitan Group dan Jaya Group. Dr. HC. Ir. Ciputra adalah seorang tokoh entrepreneurship nasional yang berkomitmen menciptakan generasi entrepreneur melalui sekolah dan universitas yang didirikannya.\r\n\r\nSetelah sukses dengan penjualan tahp pertama seluas 33 hektar, kini CitraLand City Samarinda menghadirkan masterplan tahap II dengan konsep “A New Dimension of Living” seluas 60 hektare. Residential area di CitraLand City Samarinda didesain dengan konsep private cluster, one gate system, rumah tanpa pagar, dengan lingkungan dan landscape yang tertata asri. Privasi dan keamanan penghuni semakin sempurna dengan adanya jaringan utilitas bawah tanah, system keamanan 24 jam serta fasilitas penghuni berupa Electronic Access Card pribadi, Security System & Alarm System dan CCTV, yang menjamin keamanan rumah dan privasi keluarga Anda. Komitmen jangka panjang Ciputra Group akan memastikan pengembangan berjalan kontinu dalam skala yang lebih besar, sekaligus memberikan peningkatan kualitas gaya hidup dan investasi bagi Anda yang menjadi bagian di dalamnya.\r\n\r\nTemui The Symphony of Park, thematic park seluas 5 hektar yang membelah site CitraLand City Samarinda sepanjang 1 km dan menjadi jantung kawasan untuk menghadirkan A New Dimension of Happiness.  Konsep Symphony of Park menggabungkan dimensi Leisure, Healthy Living dan Lifestyle menjadi sebuah harmoni, bagaikan gubahan simfoni yang selaras. Untuk mewujudkan Inner Personal Happiness penghuni, taman didesain untuk mensinergikan aspek Mind, Body & Soul melalui 3 tema taman yang selaras : Garden of Love (Soul/Lifestyle), garden of Sound (Mind/Leisure) dan Garden of Vigor (Body/Health). Sebagai ending – dimensi celebration of life, hadir Garden of Bliss, terdiri atas CitraLand Waterpark, Ballerina Lake dan Promenade of Joy.\r\n\r\nSebagai komitmen Ciputra Group untuk menciptakan hunian prestisius yang lengkap dan hidup, CitraLand City Samarinda menghadirkan Sekolah Citra Kasih dan Sparkling Taste @ I-Walk. Kehadiran sekolah swasta terbaik dan konsep baru kuliner ini akan semakin menaikkan image kawasan, sekaligus nilai investasi property Anda.\r\n\r\nSekolah Citra Kasih menempati site seluas 8.000m2, menawarkan pendidikan nasional plus berkualitas dengan spirit 21st century education & entrepreneurship, mulai jenjang TK, SD, SMP dan SMA. Sekolah Citra Kasih ini merupakan sekolah yang dikelola langsung oleh Ciputra Group.\r\n\r\nCitraLand City Samarinda memiliki lokasi yang strategis di Jalan D.I. Panjaitan, slah satu jalur utama kota Samarinda. Lokasi bisa dicapai hanya 10 menit dari pusat kota dan 25 menit dari bandara baru Samarinda.', 'Jl. DI Panjaitan, Mugirejo, Kec. Sungai Pinang, Kota Samarinda, Kalimantan Timur 75243', '117.18634159314058', '-0.4588224986897558', 'citraland.jpg', 'citraland-samarinda-201014795', '1', 0),
(18, 23, 1, 61, 'Tamansari Grand Samarinda Residence', 'Beauty Nature Within Your Window', 'Jl. H.A.M.M Riffadin Ruko E2-11, Harapan Baru, Kec. Loa Janan Ilir Kota Samarinda Kalimantan Timur 75131', '117.11716077857034', '-0.561919207545003', 'siteplan_kakaban.pdf', 'tamansari-grand-samarinda-residence-201015886', '1', 0),
(19, 7, 6, 16, 'Perumahan Sample', 'dekripsi perumahan', 'lokasi perumahan', '117.1294671839214', '-0.4977241180325649', 'download.jpg', 'perumahan-sample-201021553', '1', 0),
(20, 27, 10, 49, 'Alaya', 'Kawasan Hijau dengan Fasilitas Terlengkap di Samarinda dan Hunian Bebas Banjir', 'Jl.Bukit Alaya', '117.17545620611969', '-0.466335461147267', '05_brosur_ALAYA_copy_siteplan.jpg', 'alaya-201021479', '1', 0),
(21, 7, 2, 2, 'tes', 'tes', 'lokasi', '117.06832302925909', '-0.5148024883757074', 'Tugas_ke-2_Metode_Numerik.pdf', 'tes-201027657', '0', 0),
(22, 32, 6, 13, 'Rumah Impian Nova', 'Lorem Ipsum Dolor Sit Amet', 'Jalan Slamet Riyadi', '123', '123', '', '22-rumah-impian-nova', '0', 0),
(23, 32, 1, 3, 'Rumah Surga Nova test', 'Lorem Ipsum Dolor Sit Amet', 'Jalan Slamet Riyadi', '123', '123', 'perumahan/file/2800-20201127-IKA.pdf', '23-rumah-surga-nova-test', '1', 0),
(24, 32, 4, 55, 'Perumahan Bayangkari', 'Perumahan yang indah dan murah', 'Jalan Slamet Riyadi 123', 'Ini Longitude 123', 'Ini Latitude 123', 'perumahan/file/1610-20201221-transkip-nilai.pdf', '24-perumahan-bayangkari', '2', 0),
(25, 32, 4, 54, 'Dinas Perumahan dan Permukiman Samarinda', 'Lorem Ipsum dolor sit amet', 'Jalan Balai Kota', '123', '123', 'perumahan/file/277-20201222-bukti-pendaftaran-wisuda.pdf', '25-dinas-perumahan-dan-permukiman-samarinda', '1', 0),
(26, 32, 2, 1, 'Tamansari Grand Samarinda Residance', 'Beauty nature within your window', 'Jl. H.A.M.M Riffadin Ruko E2-11, Harapan Baru, Kec. Loa Janan Ilir, Kota Samarinda Kalimantan Timur 75131', '123', '123', 'perumahan/file/7080-20201222-transkip-nilai.pdf', '26-tamansari-grand-samarinda-residance', '0', 0),
(27, 32, 1, 58, 'Perumahan Kuy Entertainment', 'Hidup itu dibawa santai saja', 'Jalan H.A.A.M Riffadin Ruko E2-11, Harapan', '123', '123', 'perumahan/file/760-20201222-bukti-pendaftaran-wisuda.pdf', '27-perumahan-kuy-entertainment', '1', 0),
(28, 32, 1, 60, 'Perumahan Bayangkari 2z', 'sddsdz', 'ddfdsfdz', '1234', '1234', 'perumahan/file/8488-20201222-bukti-pendaftaran-wisuda.pdf', '28-perumahan-bayangkari-2z', '0', 0);

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
(64, 28, 'Komputer');

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
(58, 21, 'Lantai Keramik'),
(59, 22, 'Warna merah'),
(60, 22, 'Remang - remang'),
(61, 23, 'Warna merah'),
(62, 23, 'Remang - remang'),
(63, 24, 'Kayu c'),
(64, 25, 'Dinding Plester'),
(65, 25, 'Lantai Keramik');

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
  `status_deleted` int(1) NOT NULL DEFAULT 0,
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
(2, 'novadwisapta', '1', 1, 0, NULL, '$2y$10$AateYE38SbdmwcGimblKJuAzQ.SWOueG.1f57WTRDYFfH.8SB7khG', NULL, '2020-11-18 17:47:56', '2020-12-20 03:24:57'),
(3, 'iqbalwahyudi', '2', 1, 0, NULL, '$2y$10$USga3K138rprIA/TT6g5e./LvxtFDEFjRZmBZd8CJNN7Y3Q5UnqDm', NULL, '2020-11-18 17:54:11', '2020-11-18 18:32:12'),
(13, 'pengembang', '2', 1, 0, NULL, '$2y$10$YdEWzi5UpMrq92gYrr.Hk.DtSgokmxlU2txxQ9.zPtSThOdRHAjCq', NULL, '2020-11-18 23:31:49', '2020-12-24 19:46:50'),
(14, 'pengembang2', '2', 0, 0, NULL, '$2y$10$xRj0Q1M3Ej9yeCgqRQum.eM0Icz2xJid9B8gsyMASSXRjf359kHIq', NULL, '2020-11-18 23:35:41', '2020-11-22 08:42:53'),
(15, 'lyntom', '2', 0, 0, NULL, '$2y$10$tD/P9M.fYcr/lBdX.bAlXObfel1JAO8R5LwaVMmjcZUt1gQ9yK4Ai', NULL, '2020-11-20 05:08:56', '2020-11-20 05:08:56'),
(16, 'riptcode', '2', 0, 0, NULL, '$2y$10$exMDkckoWbN3WSf4KIAZ4OP5UCNKsewH/xQiwG/yMbacj1xbFDqBW', NULL, '2020-12-17 05:55:53', '2020-12-17 05:55:53'),
(17, 'riptcode2', '2', 0, 0, NULL, '$2y$10$HbS.51N9.ulrTq7Mr6eac.gU8uF9Ny/lJySAr6TStGGBwyBTkOoK6', NULL, '2020-12-17 05:57:11', '2020-12-17 05:57:11'),
(18, 'riptcode3', '2', 0, 0, NULL, '$2y$10$ur45ASoG0WdQnrljJC/fLeHmUU65CY4hPa3JjZBkKCQf3biI7m4R6', NULL, '2020-12-18 06:51:59', '2020-12-18 06:51:59'),
(19, 'testing', '2', 0, 1, NULL, '$2y$10$qEFUgBCrWvp9uMV76TLq8OiJyM3CxwjceT/LLjGKiCtZnIuJy4TBK', NULL, '2020-12-18 07:41:49', '2020-12-18 07:41:49'),
(20, 'riptcode123', '2', 0, 0, NULL, '$2y$10$5dfyDc6J3HkGu1NZfztd.eINBwETQ9yxtHnadv7FhOIcy6U1eAKBG', NULL, '2020-12-18 08:34:45', '2020-12-20 03:39:40'),
(21, 'riptcode4', '2', 1, 0, NULL, '$2y$10$oD5ZkjO0DvDq70D40E7if.jGXwdFGsLqmUtctioD7d5yaE0Z07C.G', NULL, '2020-12-18 08:48:51', '2020-12-20 03:38:50'),
(22, 'riptcode5', '2', 1, 0, NULL, '$2y$10$27zYioJXwNOQ9./zM5PLiuqcVMf7Irq2pjQ4m6X1GUqvksiWDulcW', NULL, '2020-12-18 09:01:10', '2020-12-20 03:29:10'),
(23, 'milo kucing', 'admin', 1, 0, NULL, '$2y$10$ccN9d44inXjWPGNaUC2eFeytQyjSTwMS6PbbV5Dz46.6bnQ4qtD.m', NULL, '2020-12-20 04:42:31', '2020-12-20 04:42:31'),
(24, 'ada kucing', '2', 1, 0, NULL, '$2y$10$Woy1vDPuVKLop.Zq5FuUle/hKpP7WB9poE6PKF3vv4jxKXzoW99aK', NULL, '2020-12-20 04:44:11', '2020-12-20 05:46:24'),
(25, 'arthur', '2', 0, 0, NULL, '$2y$10$eWHE6RIzL3AyONL4g3px/u7C8HHx1RCQw1qKXmrJLV8JObcJQeCcm', NULL, '2020-12-21 04:01:09', '2020-12-21 04:01:09');

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
-- Indexes for table `file_form_data_perumahan`
--
ALTER TABLE `file_form_data_perumahan`
  ADD PRIMARY KEY (`id_file_form`);

--
-- Indexes for table `form_data_perumahan`
--
ALTER TABLE `form_data_perumahan`
  ADD PRIMARY KEY (`id_form_data_perumahan`),
  ADD KEY `id_pengembang` (`id_pengembang`),
  ADD KEY `id_file_form` (`id_file_form`);

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
  MODIFY `id_bangunan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `brosur_pengembang`
--
ALTER TABLE `brosur_pengembang`
  MODIFY `id_brosur_pengembang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

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
  MODIFY `id_fasilitas_perumahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `file_form_data_perumahan`
--
ALTER TABLE `file_form_data_perumahan`
  MODIFY `id_file_form` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `form_data_perumahan`
--
ALTER TABLE `form_data_perumahan`
  MODIFY `id_form_data_perumahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `foto_bangunan`
--
ALTER TABLE `foto_bangunan`
  MODIFY `id_foto_bangunan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `foto_perumahan`
--
ALTER TABLE `foto_perumahan`
  MODIFY `id_foto_perumahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

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
  MODIFY `id_pengembang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `perumahan`
--
ALTER TABLE `perumahan`
  MODIFY `id_perumahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `sarana_prasarana`
--
ALTER TABLE `sarana_prasarana`
  MODIFY `id_sarana_prasarana` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sarana_prasarana_perumahan`
--
ALTER TABLE `sarana_prasarana_perumahan`
  MODIFY `id_sarana_prasarana_perumahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id_setting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `spesifikasi_rumah`
--
ALTER TABLE `spesifikasi_rumah`
  MODIFY `id_spesifikasi_rumah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

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
-- Constraints for table `form_data_perumahan`
--
ALTER TABLE `form_data_perumahan`
  ADD CONSTRAINT `form_data_perumahan_ibfk_1` FOREIGN KEY (`id_file_form`) REFERENCES `file_form_data_perumahan` (`id_file_form`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `form_data_perumahan_ibfk_2` FOREIGN KEY (`id_pengembang`) REFERENCES `pengembang` (`id_pengembang`) ON DELETE NO ACTION ON UPDATE CASCADE;

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
-- Constraints for table `perumahan`
--
ALTER TABLE `perumahan`
  ADD CONSTRAINT `perumahan_ibfk_1` FOREIGN KEY (`id_pengembang`) REFERENCES `pengembang` (`id_pengembang`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `perumahan_ibfk_2` FOREIGN KEY (`id_kecamatan`) REFERENCES `kecamatan` (`id_kecamatan`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `perumahan_ibfk_3` FOREIGN KEY (`id_kelurahan`) REFERENCES `kelurahan` (`id_kelurahan`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
