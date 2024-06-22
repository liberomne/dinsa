-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2024 at 03:58 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dinsa`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `tanggal_input` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama`, `email`, `image`, `password`, `tanggal_input`) VALUES
(1, 'Libero', 'libero@gmail.com', 'pro1718185521.jpg', '$2y$10$HS0/bE2gI2HzS.6Ias0f5.iAMETzwCILH3P2dz3HvVdzxavxVWtLS', 1718116426),
(2, 'Meteora', 'meteora@gmail.com', 'default.jpg', '$2y$10$0lU4xYVHNo1Fl604vIdRHOcG/r5aBMJnzuPAYp7RyBNNr6hU6byL6', 1718185567),
(3, 'Admin', 'admin@gmail.com', 'pro1718443056.jpg', '$2y$10$RmBtFbnVmgsXHiVO4iLfn.zFaP/KEPNE4p4tMP.xVzs2AORhcgyE.', 1718283733);

-- --------------------------------------------------------

--
-- Table structure for table `katalog`
--

CREATE TABLE `katalog` (
  `kode_katalog` varchar(12) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `detail_katalog` text NOT NULL,
  `jenis_katalog` varchar(50) NOT NULL,
  `gambar` varchar(128) NOT NULL,
  `harga_satuan` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `katalog`
--

INSERT INTO `katalog` (`kode_katalog`, `id_admin`, `detail_katalog`, `jenis_katalog`, `gambar`, `harga_satuan`) VALUES
('K001', 2, '  Semua Jenis Baju', 'Kaos', 'kaos.jpg', 12000),
('K002', 1, 'Semua Jenis Kemeja', 'Kemeja', 'kemeja.jpg', 12000),
('K003', 1, 'Semua Jenis Rok', 'Rok', 'rok.jpg', 10000),
('K004', 1, 'Semua Jenis Celana', 'Celana', 'celana.jpg', 10000),
('K005', 1, 'Semua Jenis Jas', 'Jas', 'jas.jpg', 15000),
('K006', 1, 'Semua Jenis Gaun', 'Gaun', 'gaun.jpg', 15000),
('K007', 1, 'Semua Jenis Kebaya', 'Kebaya', 'kebaya.jpg', 15000),
('K008', 1, ' Semua Jenis Bahan Kulit', 'Bahan Kulit', 'bahan_kulit.jpg', 20000),
('K009', 1, 'Semua Jenis Bahan Jeans ', 'Jeans', 'jeans.jpg', 20000),
('K010', 1, ' Semua Jenis Kerudung', 'Kerudung', 'kerudung.jpg', 5000),
('K011', 1, 'Semua Jenis Handuk', 'Handuk', 'handuk.jpg', 10000),
('K012', 1, 'Semua Jenis Selimut', 'Selimut', 'selimut.jpg', 20000),
('K013', 1, 'Semua Jenis Bed Cover', 'Bed Cover', 'bed_cover.jpg', 25000),
('K014', 1, 'Semua Jenis Karpet', 'Karpet', 'karpet.jpg', 25000),
('K015', 1, 'Semua Jenis Gorden ', 'Gorden', 'gorden.jpg', 20000),
('K016', 1, 'Selain Daftar di Atas', 'Request', 'request.jpg', 25000);

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `kode_katalog` varchar(12) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `kode_transaksi` varchar(128) NOT NULL,
  `jenis_katalog` varchar(50) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `bukti` varchar(128) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `lunas` int(1) NOT NULL,
  `alamat` text NOT NULL,
  `subtotal` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`id_keranjang`, `kode_katalog`, `id_pelanggan`, `kode_transaksi`, `jenis_katalog`, `jumlah`, `bukti`, `no_hp`, `tgl_masuk`, `lunas`, `alamat`, `subtotal`, `nama`) VALUES
(14, 'K007', 4, 'TR202406130001', 'Kebaya', 1, 'buktibener.jpg', '089675342183', '2024-06-13', 1, 'Jl. Mataram No. 04', 15000, 'Anggun'),
(15, 'K003', 4, 'TR202406130001', 'Rok', 2, 'buktibener.jpg', '089675342183', '2024-06-13', 1, 'Jl. Mataram No. 04', 20000, 'Anggun'),
(16, 'K009', 4, 'TR202406130001', 'Jeans', 1, 'buktibener.jpg', '089675342183', '2024-06-13', 1, 'Jl. Mataram No. 04', 20000, 'Anggun'),
(17, 'K012', 5, 'TR202406130002', 'Selimut', 2, 'buktisalah.png', '089622143882', '2024-06-13', 1, 'Jl. Bangau No. 34', 40000, 'Nurul'),
(18, 'K008', 1, 'TR202406130003', 'Bahan Kulit', 1, 'buktii.png', '087875432215', '2024-06-13', 1, 'Jl. Mangga No. 07', 20000, 'Rafa'),
(19, 'K004', 1, 'TR202406130003', 'Celana', 1, 'buktii.png', '087875432215', '2024-06-13', 1, 'Jl. Mangga No. 07', 10000, 'Rafa'),
(20, 'K002', 1, 'TR202406130003', 'Kemeja', 1, 'buktii.png', '087875432215', '2024-06-13', 1, 'Jl. Mangga No. 07', 12000, 'Rafa'),
(22, 'K013', 2, 'TR202406140001', 'Bed Cover', 1, 'buktii.png', '085711258283', '2024-06-14', 1, 'Jl. Melati No. 98', 25000, 'Talitha'),
(23, 'K014', 2, 'TR202406140001', 'Karpet', 1, 'buktii.png', '085711258283', '2024-06-14', 1, 'Jl. Melati No. 98', 25000, 'Talitha'),
(24, 'K015', 2, 'TR202406140001', 'Gorden', 1, 'buktii.png', '085711258283', '2024-06-14', 1, 'Jl. Melati No. 98', 20000, 'Talitha'),
(25, 'K012', 2, 'TR202406140001', 'Selimut', 1, 'buktii.png', '085711258283', '2024-06-14', 1, 'Jl. Melati No. 98', 20000, 'Talitha'),
(26, 'K011', 2, 'TR202406140001', 'Handuk', 1, 'buktii.png', '085711258283', '2024-06-14', 1, 'Jl. Melati No. 98', 10000, 'Talitha'),
(29, 'K015', 6, 'TR202406140002', 'Gorden', 1, 'buktii.png', '081265432188', '2024-06-14', 1, 'Jl. Sawo No. 78', 20000, 'Kienan'),
(30, 'K014', 6, 'TR202406140002', 'Karpet', 1, 'buktii.png', '081265432188', '2024-06-14', 1, 'Jl. Sawo No. 78', 25000, 'Kienan'),
(31, 'K006', 7, 'TR202406140003', 'Gaun', 1, 'buktii.png', '081257432182', '2024-06-14', 1, 'Jl. Mawar No. 42', 15000, 'Dinda'),
(32, 'K007', 7, 'TR202406140003', 'Kebaya', 1, 'buktii.png', '081257432182', '2024-06-14', 1, 'Jl. Mawar No. 42', 15000, 'Dinda'),
(33, 'K003', 7, 'TR202406140003', 'Rok', 1, 'buktii.png', '081257432182', '2024-06-14', 1, 'Jl. Mawar No. 42', 10000, 'Dinda'),
(34, 'K010', 7, 'TR202406140003', 'Kerudung', 2, 'buktii.png', '081257432182', '2024-06-14', 1, 'Jl. Mawar No. 42', 10000, 'Dinda'),
(50, 'K005', 3, 'TR202406150001', 'Jas', 2, 'buktii.png', '087712543762', '2024-06-15', 1, 'Jl. Sudirman No. 12', 30000, 'Farhan'),
(51, 'K004', 3, 'TR202406150001', 'Celana', 3, 'buktii.png', '087712543762', '2024-06-15', 1, 'Jl. Sudirman No. 12', 30000, 'Farhan'),
(52, 'K002', 3, 'TR202406150001', 'Kemeja', 1, 'buktii.png', '087712543762', '2024-06-15', 1, 'Jl. Sudirman No. 12', 12000, 'Farhan'),
(53, 'K006', 8, 'TR202406150002', 'Gaun', 3, 'buktii.png', '081310827643', '2024-06-15', 1, 'Jl. Juanda No. 28', 45000, 'Nabila'),
(54, 'K003', 8, 'TR202406150002', 'Rok', 2, 'buktii.png', '081310827643', '2024-06-15', 1, 'Jl. Juanda No. 28', 20000, 'Nabila'),
(55, 'K002', 8, 'TR202406150002', 'Kemeja', 1, 'buktii.png', '081310827643', '2024-06-15', 1, 'Jl. Juanda No. 28', 12000, 'Nabila'),
(56, 'K010', 8, 'TR202406150002', 'Kerudung', 2, 'buktii.png', '081310827643', '2024-06-15', 1, 'Jl. Juanda No. 28', 10000, 'Nabila'),
(57, 'K008', 9, 'TR202406150003', 'Bahan Kulit', 1, 'buktii.png', '089788265314', '2024-06-15', 1, 'Jl. Manggis No. 06', 20000, 'Radit'),
(58, 'K001', 9, 'TR202406150003', 'Kaos', 1, 'buktii.png', '089788265314', '2024-06-15', 1, 'Jl. Manggis No. 06', 12000, 'Radit'),
(59, 'K004', 9, 'TR202406150003', 'Celana', 1, 'buktii.png', '089788265314', '2024-06-15', 1, 'Jl. Manggis No. 06', 10000, 'Radit'),
(60, 'K011', 9, 'TR202406150003', 'Handuk', 1, 'buktii.png', '089788265314', '2024-06-15', 1, 'Jl. Manggis No. 06', 10000, 'Radit'),
(61, 'K009', 9, 'TR202406150003', 'Jeans', 2, 'buktii.png', '089788265314', '2024-06-15', 1, 'Jl. Manggis No. 06', 40000, 'Radit'),
(62, 'K007', 10, 'TR202406150004', 'Kebaya', 2, 'buktii.png', '081233215731', '2024-06-15', 1, 'Jl. Kelapa Dua No. 55', 30000, 'Putri'),
(63, 'K010', 10, 'TR202406150004', 'Kerudung', 2, 'buktii.png', '081233215731', '2024-06-15', 1, 'Jl. Kelapa Dua No. 55', 10000, 'Putri'),
(64, 'K014', 10, 'TR202406150004', 'Karpet', 1, 'buktii.png', '081233215731', '2024-06-15', 1, 'Jl. Kelapa Dua No. 55', 25000, 'Putri'),
(66, 'K016', 10, 'TR202406150004', 'Request', 1, 'buktii.png', '081233215731', '2024-06-15', 1, 'Jl. Kelapa Dua No. 55', 25000, 'Putri'),
(67, 'K008', 10, 'TR202406150004', 'Bahan Kulit', 1, 'buktii.png', '081233215731', '2024-06-15', 1, 'Jl. Kelapa Dua No. 55', 20000, 'Putri');

-- --------------------------------------------------------

--
-- Table structure for table `krisar`
--

CREATE TABLE `krisar` (
  `id_saran` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `kritik_saran` text NOT NULL,
  `tanggal` date NOT NULL,
  `nama_pelanggan` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `krisar`
--

INSERT INTO `krisar` (`id_saran`, `id_pelanggan`, `email`, `kritik_saran`, `tanggal`, `nama_pelanggan`) VALUES
(6, 1, 'rafa@gmail.com', 'Header nya kegedean min', '2024-06-14', 'Rafa'),
(7, 2, 'talitha@gmail.com', 'Hasil laundry bersih, wangi, dan rapih. Namun, untuk harga laundry satuan cukup mahal', '2024-06-15', 'Talitha'),
(8, 3, 'farhan@gmail.com', 'Tambahin helpdesk dong min', '2024-06-16', 'Farhan');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `tanggal_input` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama`, `email`, `image`, `password`, `tanggal_input`) VALUES
(1, 'Rafa', 'rafa@gmail.com', 'default.jpg', '$2y$10$ZckE1B43JhvAzw8wLNDcwugAl4H9AsLO9JiktdtZtAjIbc35d5yhm', 1718206115),
(2, 'Talitha', 'talitha@gmail.com', 'default.jpg', '$2y$10$q52w1CfXunkAOT5V0vQc9OVbTSdFsR9GKidZ0PgOS4K9T9AyQ3HKO', 1718277633),
(3, 'Farhan', 'farhan@gmail.com', 'default.jpg', '$2y$10$y8QVLgd00aF4273xJuOUhuUTZkaduw1Q179x89g8Z6FSkLVdamZta', 1718279793),
(4, 'Anggun', 'anggun@gmail.com', 'default.jpg', '$2y$10$xCiRf.iXmkt3Nj8zG3aCC.40BJYVYvXRNUnT9rlUsNjLPrCV8qJE2', 1718284151),
(5, 'Nurul', 'nurul@gmail.com', 'default.jpg', '$2y$10$vvONQmRg73Xxgs2lRLQdtuei8hKgOPS8JEZ1g51YOTRbeiI68PWuW', 1718284475),
(6, 'Kienan', 'kienan@gmail.com', 'default.jpg', '$2y$10$WHTow8LzuWTk7f6YCuzAx.oWpl1doBLz4uwj.wsHJMFoGrfnW5hHW', 1718345100),
(7, 'Dinda', 'dinda@gmail.com', 'default.jpg', '$2y$10$XiUdifQRuAj/aC/Wwr2PaOpNpYf33Y2hLCQrEDo06NlMM/KCrMMku', 1718345551),
(8, 'Nabila', 'nabila@gmail.com', 'default.jpg', '$2y$10$H5HEp/.48yx.LLnP9FHTCOMoS1r293m7H0c7wB7f9RxCJzO6U15s6', 1718441861),
(9, 'Radit', 'radit@gmail.com', 'default.jpg', '$2y$10$qpMkBlIcbgUnX.WaDPTcRO721S54OSK3UnJjB97NV5M1C6mPIQHU6', 1718441966),
(10, 'Putri', 'putri@gmail.com', 'default.jpg', '$2y$10$6OPXh7uiNFcEjQua3jY5/O5ICYL3rzIyZXis9pVxf6kiveIM50SV.', 1718442059);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(12) NOT NULL,
  `nomor_pembayaran` varchar(128) NOT NULL,
  `nama_merchant` varchar(128) NOT NULL,
  `atas_nama` varchar(128) NOT NULL,
  `gambar` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `nomor_pembayaran`, `nama_merchant`, `atas_nama`, `gambar`) VALUES
(1, '71543479120', 'Bank BCA', 'Luthfia Rosmala Dewi', 'logo-dan-profile-bank-bca-logo-dan-profile-52.png'),
(2, '091110584342185', 'Bank BRI', 'Divana Rabbani Baihaqi', 'BRI_2020_svg.png'),
(3, '085674215478', 'Gopay', 'Libero Meteora Nefertiri', 'logo-gopay-vector.png'),
(4, '081298554321', 'OVO', 'Astifa Deswanti Talosi', '6042c3148add711c946833bbc2b90f6d2.jpg'),
(5, '087822715843', 'DANA', 'Rr. Parama Ayu Janitra', 'Logo_dana_blue_svg.png');

-- --------------------------------------------------------

--
-- Table structure for table `profil_laundry`
--

CREATE TABLE `profil_laundry` (
  `id` int(12) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `nama_laundry` varchar(128) NOT NULL,
  `deskripsi` text NOT NULL,
  `alamat` varchar(128) NOT NULL,
  `nomor_telepon` varchar(17) NOT NULL,
  `email` varchar(100) NOT NULL,
  `link_maps` text NOT NULL,
  `gambar` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profil_laundry`
--

INSERT INTO `profil_laundry` (`id`, `id_admin`, `nama_laundry`, `deskripsi`, `alamat`, `nomor_telepon`, `email`, `link_maps`, `gambar`) VALUES
(1, 0, 'Dinsa Laundry', 'Selamat datang di Dinsa Laundry, Anda tidak perlu lagi khawatir tentang mencuci pakaian dan menyetrika. Cukup pesan layanan melalui website kami, dan tim profesional kami akan menjemput, mencuci, menyetrika, dan mengantarkan pakaian Anda! Dinsa Laundry juga menawarkan berbagai pilihan layanan tambahan seperti pembersihan karpet, seprai, dan lainnya untuk memenuhi segala kebutuhan rumah tangga Anda. Bersama Dinsa Laundry, nikmati kebersihan tanpa beban dan luangkan waktu lebih banyak untuk hal-hal yang benar-benar penting dalam hidup Anda.     ', 'Jl. As Sakinah Raya RT 006/RW 002 No.1 Kebagusan, Pasar Minggu, Jakarta Selatan     ', '087880801725', 'dinsalaundry@gmail.com', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d991.4232770739741!2d106.83303816949474!3d-6.3039929666093535!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69edf133625dd7%3A0xf7ecd747f8e10556!2sJl.%20Assakinah%20Raya%20No.18%2C%20RT.6%2FRW.2%2C%20Kebagusan%2C%20Ps.%20Minggu%2C%20Kota%20Jakarta%20Selatan%2C%20Daerah%20Khusus%20Ibukota%20Jakarta%2012520!5e0!3m2!1sid!2sid!4v1717311666120!5m2!1sid!2sid', '66013d89dbab43.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `kode_transaksi` varchar(128) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_pembayaran` int(11) NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `status` varchar(128) NOT NULL,
  `bukti` varchar(128) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `alamat` text NOT NULL,
  `tgl_ambil` date NOT NULL,
  `no_hp` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`kode_transaksi`, `id_pelanggan`, `id_pembayaran`, `total_bayar`, `nama`, `status`, `bukti`, `tgl_masuk`, `alamat`, `tgl_ambil`, `no_hp`) VALUES
('TR202406130001', 4, 2, 55000, 'Anggun', 'Selesai', 'buktibener1.jpg', '2024-06-13', 'Jl. Mataram No. 04', '2024-06-14', '089675342183'),
('TR202406130002', 5, 1, 40000, 'Nurul', 'Ditolak', 'buktisalah.png', '2024-06-13', 'Jl. Bangau No. 34', '0000-00-00', '089622143882'),
('TR202406130003', 1, 2, 42000, 'Rafa', 'Selesai', 'buktii.png', '2024-06-13', 'Jl. Mangga No. 07', '2024-06-14', '087875432215'),
('TR202406140001', 2, 3, 100000, 'Talitha', 'Selesai', 'buktii2.png', '2024-06-14', 'Jl. Melati No. 98', '2024-06-15', '085711258283'),
('TR202406140002', 6, 4, 45000, 'Kienan', 'Selesai', 'buktii3.png', '2024-06-14', 'Jl. Sawo No. 78', '2024-06-15', '081265432188'),
('TR202406140003', 7, 5, 50000, 'Dinda', 'Selesai', 'buktii4.png', '2024-06-14', 'Jl. Mawar No. 42', '2024-06-16', '081257432182'),
('TR202406150001', 3, 2, 72000, 'Farhan', 'Selesai', 'buktii5.png', '2024-06-15', 'Jl. Sudirman No. 12', '2024-06-16', '087712543762'),
('TR202406150002', 8, 3, 87000, 'Nabila', 'Selesai', 'buktii6.png', '2024-06-15', 'Jl. Juanda No. 28', '2024-06-16', '081310827643'),
('TR202406150003', 9, 5, 92000, 'Radit', 'Selesai', 'buktii7.png', '2024-06-15', 'Jl. Manggis No. 06', '2024-06-17', '089788265314'),
('TR202406150004', 10, 4, 110000, 'Putri', 'Selesai', 'buktii8.png', '2024-06-15', 'Jl. Kelapa Dua No. 55', '2024-06-17', '081233215731');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `katalog`
--
ALTER TABLE `katalog`
  ADD PRIMARY KEY (`kode_katalog`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`);

--
-- Indexes for table `krisar`
--
ALTER TABLE `krisar`
  ADD PRIMARY KEY (`id_saran`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `profil_laundry`
--
ALTER TABLE `profil_laundry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`kode_transaksi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `krisar`
--
ALTER TABLE `krisar`
  MODIFY `id_saran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `profil_laundry`
--
ALTER TABLE `profil_laundry`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
