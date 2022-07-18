-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Jul 2022 pada 15.58
-- Versi server: 10.4.13-MariaDB
-- Versi PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `malayuhijab`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akses_role`
--

CREATE TABLE `akses_role` (
  `akses_role` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `c` int(11) NOT NULL,
  `u` int(11) NOT NULL,
  `d` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `akses_role`
--

INSERT INTO `akses_role` (`akses_role`, `id_menu`, `id_role`, `c`, `u`, `d`) VALUES
(212, 9, 1, 0, 0, 0),
(213, 10, 1, 1, 1, 1),
(214, 11, 1, 0, 0, 0),
(215, 1, 1, 0, 0, 0),
(218, 23, 1, 0, 0, 0),
(220, 27, 1, 0, 0, 0),
(221, 22, 1, 0, 0, 0),
(222, 57, 1, 0, 0, 0),
(223, 62, 1, 0, 0, 0),
(227, 24, 1, 0, 0, 0),
(228, 64, 1, 0, 0, 0),
(235, 71, 1, 1, 1, 1),
(236, 74, 1, 1, 1, 1),
(237, 72, 1, 1, 1, 1),
(238, 73, 1, 1, 1, 1),
(239, 75, 1, 1, 1, 1),
(241, 76, 1, 1, 1, 1),
(242, 77, 1, 1, 1, 1),
(243, 78, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `backup`
--

CREATE TABLE `backup` (
  `id_backup` int(11) NOT NULL,
  `tgl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `file` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `gambar_produk`
--

CREATE TABLE `gambar_produk` (
  `id_gambar_produk` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `gambar_produk`
--

INSERT INTO `gambar_produk` (`id_gambar_produk`, `id_produk`, `type`, `gambar`) VALUES
(26, 2, '', 'avatar.jpg'),
(27, 2, '', 'hero.jpg'),
(28, 1, '', 'slider1.jpg'),
(29, 1, '', 'slider2.jpg'),
(30, 1, '', 'slider3.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `marketplace`
--

CREATE TABLE `marketplace` (
  `id_marketplace` int(11) NOT NULL,
  `nama_marketplace` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `link_marketplace` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `marketplace`
--

INSERT INTO `marketplace` (`id_marketplace`, `nama_marketplace`, `deskripsi`, `gambar`, `link_marketplace`) VALUES
(1, 'Lazada', '-', 'Lazada-Logo.png', 'https://google.com'),
(2, 'Shoppee', '-', 'Shopee_logo_svg.png', 'https://google.com'),
(3, 'Tokopedia', '-', 'tokopedia-logo-7AC053EC2E-seeklogo_com.png', 'https://google.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `marketplace_produk`
--

CREATE TABLE `marketplace_produk` (
  `id_marketplace_produk` int(11) NOT NULL,
  `id_marketplace` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `marketplace_produk`
--

INSERT INTO `marketplace_produk` (`id_marketplace_produk`, `id_marketplace`, `id_produk`, `link`) VALUES
(4, 3, 1, 'https://tokopedia.com'),
(5, 2, 1, 'https://tokopedia.com'),
(6, 1, 1, 'https://tokopedia.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `nama_menu` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `ada_submenu` int(11) NOT NULL,
  `submenu` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `urutan` int(11) NOT NULL,
  `crudable` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`id_menu`, `nama_menu`, `icon`, `ada_submenu`, `submenu`, `url`, `urutan`, `crudable`) VALUES
(1, 'Dashboard', 'fa fa-tachometer-alt', 0, 0, 'dashboard', 1, 0),
(9, 'Pengelola User', 'fas fa-user-friends', 1, 0, 'users', 10, 0),
(10, 'Data User', 'fas fa-user-shield', 0, 9, 'user', 1, 1),
(11, 'Akses Menu User', 'fas fa-shield-alt', 0, 9, 'user/akses', 2, 0),
(22, 'Profil Saya', 'fa fa-user', 0, 0, 'profil', 12, 0),
(23, 'Utilitas', 'fas fa-cog', 1, 0, 'utilitas', 11, 0),
(24, 'Backup Database', 'fas fa-database', 0, 23, 'utilitas/backup', 1, 0),
(27, 'Pengaturan', 'fas fa-cogs', 0, 0, 'pengaturan', 13, 0),
(62, 'Pengelola Menu', 'fa fa-bars', 0, 23, 'menu', 3, 0),
(64, 'CRUD Generator', 'fas fa-edit', 0, 23, 'crud_generator', 2, 0),
(71, 'Pengaturan Website', 'fas fa-globe', 0, 0, 'website', 2, 0),
(72, 'Data Service', 'fas fa-server', 0, 0, 'service', 5, 1),
(73, 'Data Testimoni', 'fas fa-user', 0, 0, 'testimoni', 6, 1),
(74, 'Tentang', 'fas fa-envelope', 0, 0, 'tentang', 3, 0),
(75, 'Data Sosial Media', 'fab fa-facebook-square', 0, 0, 'sosial_media', 7, 1),
(76, 'Data Produk', 'fab fa-product-hunt', 0, 0, 'produk', 9, 1),
(77, 'Data Marketplace', 'fas fa-shopping-bag', 0, 0, 'marketplace', 8, 1),
(78, 'Data Slider', 'fas fa-images', 0, 0, 'slider', 4, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengaturan`
--

CREATE TABLE `pengaturan` (
  `id_pengaturan` int(11) NOT NULL,
  `nama_aplikasi` varchar(255) NOT NULL,
  `logo` varchar(128) NOT NULL,
  `smtp_host` varchar(128) NOT NULL,
  `smtp_email` varchar(128) NOT NULL,
  `smtp_username` varchar(128) NOT NULL,
  `smtp_password` varchar(128) NOT NULL,
  `smtp_port` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengaturan`
--

INSERT INTO `pengaturan` (`id_pengaturan`, `nama_aplikasi`, `logo`, `smtp_host`, `smtp_email`, `smtp_username`, `smtp_password`, `smtp_port`) VALUES
(1, 'CI 3 BOILERPLATE', 'layers.png', 'ssl://smtp.gmail.com', 'email@email.com', 'email@email.com', 'password', 465);

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` int(11) NOT NULL,
  `thumbnail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `slug`, `deskripsi`, `harga`, `thumbnail`) VALUES
(1, 'Produk 1', 'produk-1', 'Vivamus suscipit tortor eget felis porttitor volutpat. Nulla quis lorem ut libero malesuada feugiat. Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Nulla quis lorem ut libero malesuada feugiat. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Curabitur aliquet quam id dui posuere blandit. Nulla porttitor accumsan tincidunt. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque in ipsum id orci porta dapibus.', 50000, 'hero.jpg'),
(2, 'Produk 2', 'produk-2', '<p><strong>Ini adalah produk kedua kami</strong></p><p><i><strong>Terima kasih telah berkunjung ke website kami ya teman 2</strong></i></p>', 100000, 'hero1.jpg'),
(22, 'Product 1', 'product-1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam, quos.', 185, 'hero.jpg'),
(23, 'Product 2', 'product-2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam, quos.', 415, 'hero.jpg'),
(24, 'Product 3', 'product-3', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam, quos.', 147, 'hero.jpg'),
(25, 'Product 4', 'product-4', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam, quos.', 190, 'hero.jpg'),
(26, 'Product 5', 'product-5', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam, quos.', 775, 'hero.jpg'),
(27, 'Product 6', 'product-6', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam, quos.', 888, 'hero.jpg'),
(28, 'Product 7', 'product-7', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam, quos.', 129, 'hero.jpg'),
(29, 'Product 8', 'product-8', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam, quos.', 390, 'hero.jpg'),
(30, 'Product 9', 'product-9', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam, quos.', 660, 'hero.jpg'),
(31, 'Product 10', 'product-10', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam, quos.', 584, 'hero.jpg'),
(32, 'Product 11', 'product-11', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam, quos.', 765, 'hero.jpg'),
(33, 'Product 12', 'product-12', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam, quos.', 652, 'hero.jpg'),
(34, 'Product 13', 'product-13', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam, quos.', 629, 'hero.jpg'),
(35, 'Product 14', 'product-14', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam, quos.', 792, 'hero.jpg'),
(36, 'Product 15', 'product-15', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam, quos.', 895, 'hero.jpg'),
(37, 'Product 16', 'product-16', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam, quos.', 496, 'hero.jpg'),
(38, 'Product 17', 'product-17', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam, quos.', 876, 'hero.jpg'),
(39, 'Product 18', 'product-18', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam, quos.', 207, 'hero.jpg'),
(40, 'Product 19', 'product-19', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam, quos.', 598, 'hero.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `nama_role` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`id_role`, `nama_role`) VALUES
(1, 'Admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `service`
--

CREATE TABLE `service` (
  `id_service` int(11) NOT NULL,
  `nama_service` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `service`
--

INSERT INTO `service` (`id_service`, `nama_service`, `deskripsi`, `gambar`) VALUES
(1, 'Modi asperiores', 'Some quick example text to build on the card title and make up the bulk of the card\'s content.', 'item.jpg'),
(2, 'Modi asperiores', 'Some quick example text to build on the card title and make up the bulk of the card\'s content.', 'item1.jpg'),
(3, 'Modi asperiores', 'Some quick example text to build on the card title and make up the bulk of the card\'s content.', 'item2.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `slider`
--

CREATE TABLE `slider` (
  `id_slider` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `slider`
--

INSERT INTO `slider` (`id_slider`, `keterangan`, `gambar`) VALUES
(1, '-', 'slider1.jpg'),
(2, '-', 'slider2.jpg'),
(3, '-', 'slider3.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sosial_media`
--

CREATE TABLE `sosial_media` (
  `id_sosial_media` int(11) NOT NULL,
  `nama_sosial_media` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `sosial_media`
--

INSERT INTO `sosial_media` (`id_sosial_media`, `nama_sosial_media`, `link`, `gambar`) VALUES
(1, 'Malayu_hijab_store', 'https://instagram.com/Malayu_hijab_store', 'fa-brands fa-instagram'),
(2, 'MalayuHijab', 'https://tiktok.com/@MalayuHijab', 'fa-brands fa-tiktok'),
(3, 'Malayu_Hijab', 'https://fb.com/Malayu_Hijab', 'fa-brands fa-facebook');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tentang`
--

CREATE TABLE `tentang` (
  `id_tentang` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `maps` text NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `whatsapp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tentang`
--

INSERT INTO `tentang` (`id_tentang`, `deskripsi`, `maps`, `alamat`, `whatsapp`) VALUES
(1, 'Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Quisque velit nisi, pretium ut lacinia in, elementum id enim. Curabitur aliquet quam id dui posuere blandit. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Donec rutrum congue leo eget malesuada. Cras ultricies ligula sed magna dictum porta. Vivamus suscipit tortor eget felis porttitor volutpat. Vivamus suscipit tortor eget felis porttitor volutpat. Vivamus suscipit tortor eget felis porttitor volutpat. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a.', 'https://maps.google.com/maps?q=2880 Broadway, New York&t=&z=13&ie=UTF8&iwloc=&output=embed', 'jl.raya ciwidey', '6283822623170');

-- --------------------------------------------------------

--
-- Struktur dari tabel `testimoni`
--

CREATE TABLE `testimoni` (
  `id_testimoni` int(11) NOT NULL,
  `nama_testimoni` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `testimoni`
--

INSERT INTO `testimoni` (`id_testimoni`, `nama_testimoni`, `deskripsi`, `gambar`) VALUES
(1, 'Jhon Doe', 'Some quick example text to build on the card title and make up the bulk of the card\'s content.', 'avatar.jpg'),
(2, 'Jhon', 'Some quick example text to build on the card title and make up the bulk of the card\'s content.', 'avatar1.jpg'),
(3, 'Jhon Doe', 'Some quick example text to build on the card title and make up the bulk of the card\'s content.', 'avatar3.jpg'),
(4, 'Jhon Doe', 'Some quick example text to build on the card title and make up the bulk of the card\'s content.', 'avatar2.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `token_user`
--

CREATE TABLE `token_user` (
  `id` int(11) NOT NULL,
  `id_user` char(10) NOT NULL,
  `tgl` timestamp NOT NULL DEFAULT current_timestamp(),
  `token` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` char(10) NOT NULL,
  `nama_user` varchar(128) NOT NULL,
  `alamat` varchar(128) NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `telepon` char(12) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(128) NOT NULL,
  `gambar` varchar(128) NOT NULL,
  `id_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `alamat`, `jk`, `telepon`, `email`, `password`, `gambar`, `id_role`) VALUES
('PTS00001', 'Administrator', 'Bandung', 'L', '085864273756', 'admin@admin.com', '$2y$10$t2LIGNkyTgoo.wfFq65HU.RMH3.maKSCVMYL1.ix0l.xZjAOfi1PK', 'man-1.png', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `website`
--

CREATE TABLE `website` (
  `id_website` int(11) NOT NULL,
  `nama_website` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `deskripsi_service` text NOT NULL,
  `deskripsi_testimoni` text NOT NULL,
  `gambar_tentang` varchar(255) NOT NULL,
  `gambar_kontak` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `website`
--

INSERT INTO `website` (`id_website`, `nama_website`, `logo`, `deskripsi`, `deskripsi_service`, `deskripsi_testimoni`, `gambar_tentang`, `gambar_kontak`) VALUES
(1, 'Malayuhijab', 'logo.png', 'Lorem ipsum dolor, sit amet consectetur, adipisicing elit. Perspiciatis, magni deleniti. Autem iste est possimus qui quibusdam similique nisi, unde id velit iusto ipsum quod molestias blanditiis cupiditate aut, enim.', 'Lorem ipsum dolor, sit amet consectetur, adipisicing elit. Perspiciatis, magni deleniti. Autem iste est possimus qui quibusdam similique nisi, unde id velit iusto ipsum quod molestias blanditiis cupiditate aut, enim.', 'Lorem ipsum dolor, sit amet consectetur, adipisicing elit. Perspiciatis, magni deleniti. Autem iste est possimus qui quibusdam similique nisi, unde id velit iusto ipsum quod molestias blanditiis cupiditate aut, enim.', 'hero2.jpg', 'hero.jpg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akses_role`
--
ALTER TABLE `akses_role`
  ADD PRIMARY KEY (`akses_role`);

--
-- Indeks untuk tabel `backup`
--
ALTER TABLE `backup`
  ADD PRIMARY KEY (`id_backup`);

--
-- Indeks untuk tabel `gambar_produk`
--
ALTER TABLE `gambar_produk`
  ADD PRIMARY KEY (`id_gambar_produk`);

--
-- Indeks untuk tabel `marketplace`
--
ALTER TABLE `marketplace`
  ADD PRIMARY KEY (`id_marketplace`);

--
-- Indeks untuk tabel `marketplace_produk`
--
ALTER TABLE `marketplace_produk`
  ADD PRIMARY KEY (`id_marketplace_produk`);

--
-- Indeks untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indeks untuk tabel `pengaturan`
--
ALTER TABLE `pengaturan`
  ADD PRIMARY KEY (`id_pengaturan`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indeks untuk tabel `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id_service`);

--
-- Indeks untuk tabel `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id_slider`);

--
-- Indeks untuk tabel `sosial_media`
--
ALTER TABLE `sosial_media`
  ADD PRIMARY KEY (`id_sosial_media`);

--
-- Indeks untuk tabel `tentang`
--
ALTER TABLE `tentang`
  ADD PRIMARY KEY (`id_tentang`);

--
-- Indeks untuk tabel `testimoni`
--
ALTER TABLE `testimoni`
  ADD PRIMARY KEY (`id_testimoni`);

--
-- Indeks untuk tabel `token_user`
--
ALTER TABLE `token_user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `website`
--
ALTER TABLE `website`
  ADD PRIMARY KEY (`id_website`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `akses_role`
--
ALTER TABLE `akses_role`
  MODIFY `akses_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=244;

--
-- AUTO_INCREMENT untuk tabel `backup`
--
ALTER TABLE `backup`
  MODIFY `id_backup` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `gambar_produk`
--
ALTER TABLE `gambar_produk`
  MODIFY `id_gambar_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `marketplace`
--
ALTER TABLE `marketplace`
  MODIFY `id_marketplace` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `marketplace_produk`
--
ALTER TABLE `marketplace_produk`
  MODIFY `id_marketplace_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT untuk tabel `pengaturan`
--
ALTER TABLE `pengaturan`
  MODIFY `id_pengaturan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `service`
--
ALTER TABLE `service`
  MODIFY `id_service` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `slider`
--
ALTER TABLE `slider`
  MODIFY `id_slider` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `sosial_media`
--
ALTER TABLE `sosial_media`
  MODIFY `id_sosial_media` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tentang`
--
ALTER TABLE `tentang`
  MODIFY `id_tentang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `testimoni`
--
ALTER TABLE `testimoni`
  MODIFY `id_testimoni` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `token_user`
--
ALTER TABLE `token_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `website`
--
ALTER TABLE `website`
  MODIFY `id_website` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
