-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 27 Nov 2019 pada 11.48
-- Versi server: 10.3.16-MariaDB
-- Versi PHP: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db4_image_server`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_image_file`
--

CREATE TABLE `tbl_image_file` (
  `image_file_id` int(11) NOT NULL,
  `image_file_title` varchar(80) NOT NULL,
  `image_file_name` varchar(80) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_image_file`
--

INSERT INTO `tbl_image_file` (`image_file_id`, `image_file_title`, `image_file_name`, `created_at`, `updated_at`, `updated_by`) VALUES
(35, 'banner', '20191121_39_Screenshot_from_2019-11-19_15-25-38.png', '2019-11-21 10:44:39', '2019-11-21 03:44:39', 0),
(36, 'banner', '20191121_57_Screenshot_from_2019-11-19_15-25-38.png', '2019-11-21 10:45:57', '2019-11-21 03:45:57', 0),
(37, 'banner', '20191121_03_Screenshot_from_2019-11-19_15-25-38.png', '2019-11-21 10:55:03', '2019-11-21 03:55:03', 0),
(38, 'soal', '20191121_26_Screenshot_from_2019-11-09_22-02-52.png', '2019-11-21 11:09:26', '2019-11-21 04:09:26', 0),
(39, 'soal', '20191121_30_Screenshot_from_2019-11-19_15-25-38.png', '2019-11-21 11:15:30', '2019-11-21 04:15:30', 0),
(40, 'soal', '20191121_35_Screenshot_from_2019-11-09_06-16-37.png', '2019-11-21 11:17:35', '2019-11-21 04:17:35', 0),
(41, 'soal', '20191121_55_Screenshot_from_2019-11-13_11-42-58.png', '2019-11-21 11:18:55', '2019-11-21 04:18:55', 0),
(42, 'soal', '20191121_37_Screenshot_from_2019-11-09_06-16-37.png', '2019-11-21 11:19:37', '2019-11-21 04:19:37', 0),
(43, 'soal', '20191121_25_Screenshot_from_2019-11-19_15-25-38.png', '2019-11-21 11:20:25', '2019-11-21 04:20:25', 0),
(44, 'soal', '20191127_52_Screenshot_from_2019-11-19_15-25-38.png', '2019-11-27 14:27:52', '2019-11-27 07:27:52', 0),
(45, 'soal', '20191127_35_Screenshot_from_2019-11-15_16-17-38.png', '2019-11-27 14:56:35', '2019-11-27 07:56:35', 0),
(46, 'soal', '20191127_56_Screenshot_from_2019-11-07_21-52-08.png', '2019-11-27 15:06:56', '2019-11-27 08:06:56', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_image_thumbnail`
--

CREATE TABLE `tbl_image_thumbnail` (
  `image_thumbnail_id` int(11) NOT NULL,
  `image_file_id` int(11) NOT NULL,
  `image_thumbnail_type` int(1) NOT NULL,
  `image_thumbnail_size` varchar(45) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_image_thumbnail`
--

INSERT INTO `tbl_image_thumbnail` (`image_thumbnail_id`, `image_file_id`, `image_thumbnail_type`, `image_thumbnail_size`, `created_at`, `updated_at`, `updated_by`) VALUES
(98, 35, 1, 'ori', '2019-11-21 10:44:39', '2019-11-21 03:44:39', 0),
(99, 35, 0, '600x600', '2019-11-21 10:44:39', '2019-11-21 03:44:39', 0),
(100, 35, 0, '500x500', '2019-11-21 10:44:39', '2019-11-21 03:44:39', 0),
(101, 35, 0, '400x400', '2019-11-21 10:44:39', '2019-11-21 03:44:39', 0),
(102, 36, 1, 'ori', '2019-11-21 10:45:57', '2019-11-21 03:45:57', 0),
(103, 36, 0, '600x600', '2019-11-21 10:45:57', '2019-11-21 03:45:57', 0),
(104, 36, 0, '500x500', '2019-11-21 10:45:58', '2019-11-21 03:45:58', 0),
(105, 36, 0, '400x400', '2019-11-21 10:45:58', '2019-11-21 03:45:58', 0),
(106, 37, 1, 'ori', '2019-11-21 10:55:03', '2019-11-21 03:55:03', 0),
(107, 37, 0, '600x600', '2019-11-21 10:55:03', '2019-11-21 03:55:03', 0),
(108, 37, 0, '500x500', '2019-11-21 10:55:03', '2019-11-21 03:55:03', 0),
(109, 37, 0, '400x400', '2019-11-21 10:55:03', '2019-11-21 03:55:03', 0),
(110, 38, 1, 'ori', '2019-11-21 11:09:26', '2019-11-21 04:09:26', 0),
(111, 38, 0, '600x600', '2019-11-21 11:09:27', '2019-11-21 04:09:27', 0),
(112, 38, 0, '500x500', '2019-11-21 11:09:27', '2019-11-21 04:09:27', 0),
(113, 38, 0, '400x400', '2019-11-21 11:09:27', '2019-11-21 04:09:27', 0),
(114, 39, 1, 'ori', '2019-11-21 11:15:30', '2019-11-21 04:15:30', 0),
(115, 39, 0, '600x600', '2019-11-21 11:15:31', '2019-11-21 04:15:31', 0),
(116, 39, 0, '500x500', '2019-11-21 11:15:31', '2019-11-21 04:15:31', 0),
(117, 39, 0, '400x400', '2019-11-21 11:15:31', '2019-11-21 04:15:31', 0),
(118, 40, 1, 'ori', '2019-11-21 11:17:35', '2019-11-21 04:17:35', 0),
(119, 40, 0, '600x600', '2019-11-21 11:17:36', '2019-11-21 04:17:36', 0),
(120, 40, 0, '500x500', '2019-11-21 11:17:36', '2019-11-21 04:17:36', 0),
(121, 40, 0, '400x400', '2019-11-21 11:17:36', '2019-11-21 04:17:36', 0),
(122, 41, 1, 'ori', '2019-11-21 11:18:55', '2019-11-21 04:18:55', 0),
(123, 41, 0, '600x600', '2019-11-21 11:18:55', '2019-11-21 04:18:55', 0),
(124, 41, 0, '500x500', '2019-11-21 11:18:55', '2019-11-21 04:18:55', 0),
(125, 41, 0, '400x400', '2019-11-21 11:18:55', '2019-11-21 04:18:55', 0),
(126, 42, 1, 'ori', '2019-11-21 11:19:37', '2019-11-21 04:19:37', 0),
(127, 42, 0, '600x600', '2019-11-21 11:19:38', '2019-11-21 04:19:38', 0),
(128, 42, 0, '500x500', '2019-11-21 11:19:38', '2019-11-21 04:19:38', 0),
(129, 42, 0, '400x400', '2019-11-21 11:19:38', '2019-11-21 04:19:38', 0),
(130, 43, 1, 'ori', '2019-11-21 11:20:25', '2019-11-21 04:20:25', 0),
(131, 43, 0, '600x600', '2019-11-21 11:20:26', '2019-11-21 04:20:26', 0),
(132, 43, 0, '500x500', '2019-11-21 11:20:26', '2019-11-21 04:20:26', 0),
(133, 43, 0, '400x400', '2019-11-21 11:20:26', '2019-11-21 04:20:26', 0),
(134, 44, 1, 'ori', '2019-11-27 14:27:52', '2019-11-27 07:27:52', 0),
(135, 44, 0, '600x600', '2019-11-27 14:27:52', '2019-11-27 07:27:52', 0),
(136, 44, 0, '500x500', '2019-11-27 14:27:52', '2019-11-27 07:27:52', 0),
(137, 44, 0, '400x400', '2019-11-27 14:27:52', '2019-11-27 07:27:52', 0),
(138, 45, 1, 'ori', '2019-11-27 14:56:35', '2019-11-27 07:56:35', 0),
(139, 45, 0, '600x600', '2019-11-27 14:56:35', '2019-11-27 07:56:35', 0),
(140, 45, 0, '500x500', '2019-11-27 14:56:35', '2019-11-27 07:56:35', 0),
(141, 45, 0, '400x400', '2019-11-27 14:56:35', '2019-11-27 07:56:35', 0),
(142, 46, 1, 'ori', '2019-11-27 15:06:56', '2019-11-27 08:06:56', 0),
(143, 46, 0, '600x600', '2019-11-27 15:06:56', '2019-11-27 08:06:56', 0),
(144, 46, 0, '500x500', '2019-11-27 15:06:56', '2019-11-27 08:06:56', 0),
(145, 46, 0, '400x400', '2019-11-27 15:06:56', '2019-11-27 08:06:56', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_size_thumbnail`
--

CREATE TABLE `tbl_size_thumbnail` (
  `size_thumbnail_id` int(11) NOT NULL,
  `size_thumbnail_width` int(5) NOT NULL,
  `size_thumbnail_height` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_size_thumbnail`
--

INSERT INTO `tbl_size_thumbnail` (`size_thumbnail_id`, `size_thumbnail_width`, `size_thumbnail_height`) VALUES
(1, 600, 600),
(2, 500, 500),
(3, 400, 400);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `is_active` int(1) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `username`, `password`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'c4ca4238a0b923820dcc509a6f75849b', 1, '2019-11-19 10:49:03', '2019-11-19 03:49:03');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_image_file`
--
ALTER TABLE `tbl_image_file`
  ADD PRIMARY KEY (`image_file_id`);

--
-- Indeks untuk tabel `tbl_image_thumbnail`
--
ALTER TABLE `tbl_image_thumbnail`
  ADD PRIMARY KEY (`image_thumbnail_id`);

--
-- Indeks untuk tabel `tbl_size_thumbnail`
--
ALTER TABLE `tbl_size_thumbnail`
  ADD PRIMARY KEY (`size_thumbnail_id`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_image_file`
--
ALTER TABLE `tbl_image_file`
  MODIFY `image_file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT untuk tabel `tbl_image_thumbnail`
--
ALTER TABLE `tbl_image_thumbnail`
  MODIFY `image_thumbnail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT untuk tabel `tbl_size_thumbnail`
--
ALTER TABLE `tbl_size_thumbnail`
  MODIFY `size_thumbnail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
