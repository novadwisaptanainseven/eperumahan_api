-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2021 at 01:51 PM
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
  `updated_at` timestamp NULL DEFAULT NULL,
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
(33, '123123', 'Ikwal Ramadhani', '0812444373231', 'ikwal123@gmail.com', 'Jalan Slamet Riadi', '33-ikwal-ramadhani', '/api/pengembang/file/eOO8ueEiIzdg4rvfTU82bUcVUSsjMopXbdyciBd3.xlsx', '/api/pengembang/foto/a6QMhmd9hbPvwcdt43ECWiKSEvANK72uu9pbdShT.png', 14, '0', '2020-11-18 23:35:41', '2020-11-19 05:01:45', 0),
(34, '2312', 'Lyntom Irfan Darmawan', '082321453', 'lyntom123@gmail.com', 'Jalan Rajawali', '34-lyntom-irfan-darmawan', '/api/pengembang/file/kA4VFsZwsl2pLi9czoyVJlSESZWDgBjBrhuvD2JJ.pdf', 'pengembang/foto/vQJ086Ikd4H90LKFoISvRCLZjYyAMRWcp5MFfTaI.jpeg', 15, '1', '2020-11-20 05:08:57', '2020-12-29 20:39:14', 0),
(35, '6403056700970001', 'Riptcode', '082321453', 'riptcode@gmail.com', 'Jalan Rajawali', '35-riptcode', '/api/pengembang/file/ckMu7RpyexFQ56unNZnrkUmuprHDnVUwvyxdNtug.pdf', 'pengembang/foto/p4Ofkv8jqR5C77L2VYSaeKkoMwHfTX4ZqR6pXP9v.jpeg', 16, '1', '2020-12-17 05:55:54', '2020-12-29 20:44:12', 0),
(36, '6403056700970001', 'Riptcode', '082321453', 'riptcode@gmail.com', 'Jalan Rajawali', '36-riptcode', 'pengembang/file/JvXlpbWhC7GbnekIOJTUNy8iVZjEPyTscEQlMdj4.pdf', 'pengembang/foto/RbjQBgOWa34HQUV8mbz33iiWZivauFwHiAdDZF6a.jpeg', 17, '0', '2020-12-17 05:57:11', '2020-12-17 05:57:11', 0),
(37, '123', 'nova', '123', 'nova@gmail.com', 'fadfads', '37-nova', 'pengembang/file/tsxMMziUr6H4ZmSGjALDakzXk7Ysa7OjhwrIYwaZ.pdf', 'pengembang/foto/Qd8VuaWfjbvgCt5FPznGLMKxuy5e5iROjBnjEigx.jpeg', 18, '0', '2020-12-18 06:51:59', '2020-12-18 06:51:59', 0),
(38, '12345', 'Testing hapus', '1233456', 'testing@gmail.com', 'Jalan Testing', '38-testing-hapus', 'pengembang/file/J0P5ayTmvk6mZeFPrS60phUjF6vWwDZ0dRKIOQ3D.pdf', 'pengembang/foto/1ey2q1ATeDijU2qt3as8CHekjF9UajZpmvfGDMjX.jpeg', 19, '0', '2020-12-18 07:41:49', '2020-12-18 07:41:49', 0),
(39, '123', 'Riptcode123', '123', 'riptcode@gmail.com', 'Jalan Riptcode', '39-riptcode123', 'pengembang/file/qQjS73iM2e5ZwRpBRaxy1qiyOauXN7H5jQriVGzl.pdf', 'pengembang/foto/Bz7j6yjZO76DR2okj6qL1qoSfHbFbwIGNERXTZGV.jpeg', 20, '0', '2020-12-18 08:34:45', '2020-12-18 09:08:00', 0),
(40, '6403056700970001', 'Riptcode', '082321453', 'riptcode@gmail.com', 'Jalan Rajawali', '40-riptcode', 'pengembang/file/VfOCxPZxVSA67Ag6vIKUh3jUBrBXmcfknNNAgiCl.pdf', 'pengembang/foto/jHrjHVjFhxTu8cZNKlP29zQcqofk0IxXPWw6qdBq.jpeg', 21, '0', '2020-12-18 08:48:51', '2020-12-18 08:48:51', 0),
(41, '6403056700970001', 'Riptcode 123', '082321453', 'riptcode@gmail.com', 'Jalan Rajawali', '41-riptcode-123', 'pengembang/file/15dtgZzJ7y5q9D0iR1f3NAlHjicuFGP4FZpBfyVK.pdf', 'pengembang/foto/mDddSYj5JcOAx99WBFSE2TYMa2P6UKBQNvx4KLKJ.jpeg', 22, '0', '2020-12-18 09:01:10', '2020-12-18 20:23:12', 0),
(42, '12345', 'Arthur Morgan', '1233456', 'arthur@gmail.com', 'Jalan Pangeran Antasari', '42-arthur-morgan', 'pengembang/file/m0Xg99p3fBQQ37a0Q505RGw7ndZG4qqmBu1Jd6yL.pdf', 'pengembang/foto/yNE1FvxZBlxSSzXLyroeuRwWP8c4gPZY6SGN1LZp.jpeg', 25, '0', '2020-12-21 04:01:10', '2020-12-21 04:01:10', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pengembang`
--
ALTER TABLE `pengembang`
  ADD PRIMARY KEY (`id_pengembang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pengembang`
--
ALTER TABLE `pengembang`
  MODIFY `id_pengembang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
