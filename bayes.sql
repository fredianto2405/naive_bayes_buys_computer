-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Mar 2021 pada 17.09
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bayes`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `buys_computer`
--

CREATE TABLE `buys_computer` (
  `id` int(11) NOT NULL,
  `age` enum('<=30','31...40','>40') NOT NULL,
  `income` enum('high','medium','low') NOT NULL,
  `student` enum('yes','no') NOT NULL,
  `credit_rating` enum('fair','excellent') NOT NULL,
  `buys_computer` enum('yes','no') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `buys_computer`
--

INSERT INTO `buys_computer` (`id`, `age`, `income`, `student`, `credit_rating`, `buys_computer`) VALUES
(1, '<=30', 'high', 'no', 'fair', 'no'),
(2, '<=30', 'high', 'no', 'excellent', 'no'),
(3, '31...40', 'high', 'no', 'fair', 'yes'),
(4, '>40', 'medium', 'no', 'fair', 'yes'),
(5, '>40', 'low', 'yes', 'fair', 'yes'),
(6, '>40', 'low', 'yes', 'excellent', 'no'),
(7, '31...40', 'low', 'yes', 'excellent', 'yes'),
(8, '<=30', 'medium', 'no', 'fair', 'no'),
(9, '<=30', 'low', 'yes', 'fair', 'yes'),
(10, '>40', 'medium', 'yes', 'fair', 'yes'),
(11, '<=30', 'medium', 'yes', 'excellent', 'yes'),
(12, '31...40', 'medium', 'no', 'excellent', 'yes'),
(13, '31...40', 'high', 'yes', 'fair', 'yes'),
(14, '>40', 'medium', 'no', 'excellent', 'no');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buys_computer`
--
ALTER TABLE `buys_computer`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `buys_computer`
--
ALTER TABLE `buys_computer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
