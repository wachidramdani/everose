-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Feb 2020 pada 09.36
-- Versi server: 10.1.31-MariaDB
-- Versi PHP: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cycommerce`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `usn_admin` varchar(32) NOT NULL,
  `pass_admin` varchar(300) NOT NULL,
  `id_level` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `usn_admin`, `pass_admin`, `id_level`) VALUES
(1, 'admin', '$2y$10$RQqrhrRIx2AO8DM9O0fk5u60pBxi7hSGWa1EidcX1nHMXqgpC.d2.', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `category`
--

CREATE TABLE `category` (
  `id_category` int(11) NOT NULL,
  `name_category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `comment`
--

CREATE TABLE `comment` (
  `id_comment` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `name_comment` varchar(300) NOT NULL,
  `email_comment` varchar(300) NOT NULL,
  `body_comment` text NOT NULL,
  `rating_comment` int(1) NOT NULL,
  `date_comment` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_invoice`
--

CREATE TABLE `detail_invoice` (
  `id_detail` int(11) NOT NULL,
  `id_invoice` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `product_detail` varchar(300) NOT NULL,
  `price_detail` int(11) NOT NULL,
  `qty_detail` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `invoice`
--

CREATE TABLE `invoice` (
  `id_invoice` int(11) NOT NULL,
  `no_invoice` varchar(200) NOT NULL,
  `name_invoice` varchar(200) NOT NULL,
  `hp_invoice` varchar(12) NOT NULL,
  `email_invoice` varchar(200) NOT NULL,
  `address_invoice` text NOT NULL,
  `courier_invoice` varchar(200) NOT NULL,
  `total_invoice` int(11) NOT NULL,
  `shipping_invoice` int(11) NOT NULL,
  `status_invoice` int(2) NOT NULL,
  `date_invoice` timestamp NULL DEFAULT NULL,
  `token_invoice` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `midtrans_api`
--

CREATE TABLE `midtrans_api` (
  `id_midtrans` int(11) NOT NULL,
  `serverkey_midtrans` varchar(300) NOT NULL,
  `clientkey_midtrans` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `midtrans_api`
--

INSERT INTO `midtrans_api` (`id_midtrans`, `serverkey_midtrans`, `clientkey_midtrans`) VALUES
(1, 'SB-Mid-server-Q3E64OTED_tfHqqNDbGodLmZ', 'SB-Mid-client-HVV0g1mGTOee1Z7-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `page`
--

CREATE TABLE `page` (
  `id_page` int(11) NOT NULL,
  `title_page` varchar(300) NOT NULL,
  `body_page` text NOT NULL,
  `url_page` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `photo_product`
--

CREATE TABLE `photo_product` (
  `id_photo` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `url_photo` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `product`
--

CREATE TABLE `product` (
  `id_product` int(11) NOT NULL,
  `name_product` varchar(200) NOT NULL,
  `description_product` text NOT NULL,
  `price_product` int(11) NOT NULL,
  `weight_product` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `stock_product` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `updated_product` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `profile`
--

CREATE TABLE `profile` (
  `id_profile` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `name_profile` varchar(300) NOT NULL,
  `gender_profile` varchar(10) NOT NULL,
  `email_profile` varchar(300) NOT NULL,
  `phone_profile` varchar(12) NOT NULL,
  `address_profile` text NOT NULL,
  `photo_profile` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `profile`
--

INSERT INTO `profile` (`id_profile`, `id_admin`, `name_profile`, `gender_profile`, `email_profile`, `phone_profile`, `address_profile`, `photo_profile`) VALUES
(1, 1, 'Akbar Aditama', 'Laki-laki', 'sylvia@gmail.com', '081271762774', 'Desa. Betung, Kec. Gelumbang, Kab. Muara Enim, Sumatera Selatan', 'upload/profile_pic/158275114521673805.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rajaongkir_api`
--

CREATE TABLE `rajaongkir_api` (
  `id_api` int(11) NOT NULL,
  `key_api` varchar(200) NOT NULL,
  `type_api` varchar(100) NOT NULL,
  `province_api` int(11) NOT NULL,
  `city_api` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `rajaongkir_api`
--

INSERT INTO `rajaongkir_api` (`id_api`, `key_api`, `type_api`, `province_api`, `city_api`) VALUES
(1, '18abfeaf31d348ce3e0df66d57748162', 'starter', 9, 23);

-- --------------------------------------------------------

--
-- Struktur dari tabel `rajaongkir_courier`
--

CREATE TABLE `rajaongkir_courier` (
  `id_courier` int(11) NOT NULL,
  `name_courier` varchar(150) NOT NULL,
  `type_courier` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `rajaongkir_courier`
--

INSERT INTO `rajaongkir_courier` (`id_courier`, `name_courier`, `type_courier`) VALUES
(1, 'JNE', 'REG'),
(2, 'JNE', 'YES'),
(3, 'JNE', 'OKE'),
(6, 'TIKI', 'REG'),
(7, 'TIKI', 'ECO'),
(8, 'TIKI', 'HDS'),
(9, 'TIKI', 'SDS'),
(10, 'TIKI', 'ONS'),
(11, 'TIKI', 'TDS');

-- --------------------------------------------------------

--
-- Struktur dari tabel `resi`
--

CREATE TABLE `resi` (
  `id_resi` int(11) NOT NULL,
  `id_invoice` int(11) NOT NULL,
  `no_resi` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `setting`
--

CREATE TABLE `setting` (
  `id_setting` int(11) NOT NULL,
  `key_setting` varchar(300) NOT NULL,
  `value_setting` text NOT NULL,
  `name_setting` varchar(200) NOT NULL,
  `type_setting` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `setting`
--

INSERT INTO `setting` (`id_setting`, `key_setting`, `value_setting`, `name_setting`, `type_setting`) VALUES
(1, 'sitename', 'SBN Cloth', 'Nama Toko', 'text'),
(2, 'logo', 'assets/logo.png', 'Logo Toko', 'file'),
(3, 'description', 'Menjual berbagai macam kebutuhan fashion yang sedang trend', 'Deskripsi Toko', 'textarea');

-- --------------------------------------------------------

--
-- Struktur dari tabel `slider`
--

CREATE TABLE `slider` (
  `id_slider` int(11) NOT NULL,
  `title_slider` varchar(300) NOT NULL,
  `img_slider` varchar(300) NOT NULL,
  `link_slider` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `visitor`
--

CREATE TABLE `visitor` (
  `id_visitor` int(11) NOT NULL,
  `date_visitor` timestamp NULL DEFAULT NULL,
  `hit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `visitor`
--

INSERT INTO `visitor` (`id_visitor`, `date_visitor`, `hit`) VALUES
(1, '2020-02-26 17:00:00', 3);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indeks untuk tabel `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id_comment`);

--
-- Indeks untuk tabel `detail_invoice`
--
ALTER TABLE `detail_invoice`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indeks untuk tabel `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id_invoice`);

--
-- Indeks untuk tabel `midtrans_api`
--
ALTER TABLE `midtrans_api`
  ADD PRIMARY KEY (`id_midtrans`);

--
-- Indeks untuk tabel `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id_page`);

--
-- Indeks untuk tabel `photo_product`
--
ALTER TABLE `photo_product`
  ADD PRIMARY KEY (`id_photo`);

--
-- Indeks untuk tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_product`);

--
-- Indeks untuk tabel `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id_profile`);

--
-- Indeks untuk tabel `rajaongkir_api`
--
ALTER TABLE `rajaongkir_api`
  ADD PRIMARY KEY (`id_api`);

--
-- Indeks untuk tabel `rajaongkir_courier`
--
ALTER TABLE `rajaongkir_courier`
  ADD PRIMARY KEY (`id_courier`);

--
-- Indeks untuk tabel `resi`
--
ALTER TABLE `resi`
  ADD PRIMARY KEY (`id_resi`);

--
-- Indeks untuk tabel `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indeks untuk tabel `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id_slider`);

--
-- Indeks untuk tabel `visitor`
--
ALTER TABLE `visitor`
  ADD PRIMARY KEY (`id_visitor`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `comment`
--
ALTER TABLE `comment`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `detail_invoice`
--
ALTER TABLE `detail_invoice`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id_invoice` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `midtrans_api`
--
ALTER TABLE `midtrans_api`
  MODIFY `id_midtrans` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `page`
--
ALTER TABLE `page`
  MODIFY `id_page` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `photo_product`
--
ALTER TABLE `photo_product`
  MODIFY `id_photo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `product`
--
ALTER TABLE `product`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `profile`
--
ALTER TABLE `profile`
  MODIFY `id_profile` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `rajaongkir_api`
--
ALTER TABLE `rajaongkir_api`
  MODIFY `id_api` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `rajaongkir_courier`
--
ALTER TABLE `rajaongkir_courier`
  MODIFY `id_courier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `resi`
--
ALTER TABLE `resi`
  MODIFY `id_resi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `setting`
--
ALTER TABLE `setting`
  MODIFY `id_setting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `slider`
--
ALTER TABLE `slider`
  MODIFY `id_slider` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `visitor`
--
ALTER TABLE `visitor`
  MODIFY `id_visitor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
