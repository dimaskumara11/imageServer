-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 19 Nov 2019 pada 07.17
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
(22, 'banner', '20191110_57_Screenshot_from_2019-11-09_22-02-52.png', '2019-11-11 02:30:57', '2019-11-10 19:30:57', 0),
(23, 'banner', '20191110_56_Screenshot_from_2019-11-09_22-02-52.png', '2019-11-11 02:45:56', '2019-11-10 19:45:56', 0),
(24, 'banner', '20191110_09_Screenshot_from_2019-11-09_22-02-52.png', '2019-11-11 02:46:09', '2019-11-10 19:46:09', 0),
(25, 'banner', '20191111_52_Screenshot_from_2019-11-09_22-02-52.png', '2019-11-11 10:30:52', '2019-11-11 03:30:52', 0),
(26, 'banner', '20191111_03_Screenshot_from_2019-11-09_22-02-52.png', '2019-11-11 11:27:03', '2019-11-11 04:27:03', 0),
(27, 'banner', '20191111_22_Screenshot_from_2019-11-09_22-02-52.png', '2019-11-11 11:28:22', '2019-11-11 04:28:22', 0),
(28, 'banner', '20191111_05_Screenshot_from_2019-11-09_22-02-52.png', '2019-11-11 11:44:05', '2019-11-11 04:44:05', 0),
(29, 'banner', '20191119_28_anjani.jpeg', '2019-11-19 12:16:28', '2019-11-19 05:16:28', 0),
(30, 'banner', '20191119_59_Screenshot_from_2019-11-09_22-02-52.png', '2019-11-19 12:45:59', '2019-11-19 05:45:59', 0);

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
(47, 22, 0, '600x600', '2019-11-11 02:30:57', '2019-11-10 19:30:57', 0),
(48, 22, 0, '500x500', '2019-11-11 02:30:57', '2019-11-10 19:30:57', 0),
(49, 22, 0, '400x400', '2019-11-11 02:30:57', '2019-11-10 19:30:57', 0),
(50, 23, 1, 'ori', '2019-11-11 02:45:56', '2019-11-10 19:45:56', 0),
(51, 23, 0, '600x600', '2019-11-11 02:45:56', '2019-11-10 19:45:56', 0),
(52, 23, 0, '500x500', '2019-11-11 02:45:56', '2019-11-10 19:45:56', 0),
(53, 23, 0, '400x400', '2019-11-11 02:45:56', '2019-11-10 19:45:56', 0),
(54, 24, 1, 'ori', '2019-11-11 02:46:09', '2019-11-10 19:46:09', 0),
(55, 24, 0, '600x600', '2019-11-11 02:46:09', '2019-11-10 19:46:09', 0),
(56, 24, 0, '500x500', '2019-11-11 02:46:09', '2019-11-10 19:46:09', 0),
(57, 24, 0, '400x400', '2019-11-11 02:46:09', '2019-11-10 19:46:09', 0),
(58, 25, 1, 'ori', '2019-11-11 10:30:52', '2019-11-11 03:30:52', 0),
(59, 25, 0, '600x600', '2019-11-11 10:30:52', '2019-11-11 03:30:52', 0),
(60, 25, 0, '500x500', '2019-11-11 10:30:52', '2019-11-11 03:30:52', 0),
(61, 25, 0, '400x400', '2019-11-11 10:30:52', '2019-11-11 03:30:52', 0),
(62, 26, 1, 'ori', '2019-11-11 11:27:03', '2019-11-11 04:27:03', 0),
(63, 26, 0, '600x600', '2019-11-11 11:27:03', '2019-11-11 04:27:03', 0),
(64, 26, 0, '500x500', '2019-11-11 11:27:03', '2019-11-11 04:27:03', 0),
(65, 26, 0, '400x400', '2019-11-11 11:27:03', '2019-11-11 04:27:03', 0),
(66, 27, 1, 'ori', '2019-11-11 11:28:22', '2019-11-11 04:28:22', 0),
(67, 27, 0, '600x600', '2019-11-11 11:28:23', '2019-11-11 04:28:23', 0),
(68, 27, 0, '500x500', '2019-11-11 11:28:23', '2019-11-11 04:28:23', 0),
(69, 27, 0, '400x400', '2019-11-11 11:28:23', '2019-11-11 04:28:23', 0),
(70, 28, 1, 'ori', '2019-11-11 11:44:05', '2019-11-11 04:44:05', 0),
(71, 28, 0, '600x600', '2019-11-11 11:44:05', '2019-11-11 04:44:05', 0),
(72, 28, 0, '500x500', '2019-11-11 11:44:05', '2019-11-11 04:44:05', 0),
(73, 28, 0, '400x400', '2019-11-11 11:44:05', '2019-11-11 04:44:05', 0),
(74, 29, 1, 'ori', '2019-11-19 12:16:28', '2019-11-19 05:16:28', 0),
(75, 29, 0, '600x600', '2019-11-19 12:16:28', '2019-11-19 05:16:28', 0),
(76, 29, 0, '500x500', '2019-11-19 12:16:28', '2019-11-19 05:16:28', 0),
(77, 29, 0, '400x400', '2019-11-19 12:16:28', '2019-11-19 05:16:28', 0),
(78, 30, 1, 'ori', '2019-11-19 12:45:59', '2019-11-19 05:45:59', 0),
(79, 30, 0, '600x600', '2019-11-19 12:45:59', '2019-11-19 05:45:59', 0),
(80, 30, 0, '500x500', '2019-11-19 12:45:59', '2019-11-19 05:45:59', 0),
(81, 30, 0, '400x400', '2019-11-19 12:45:59', '2019-11-19 05:45:59', 0);

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
  MODIFY `image_file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `tbl_image_thumbnail`
--
ALTER TABLE `tbl_image_thumbnail`
  MODIFY `image_thumbnail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

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
