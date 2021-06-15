-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Okt 2019 pada 09.14
-- Versi server: 10.4.6-MariaDB
-- Versi PHP: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ppl_ecommerce`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `banners`
--

INSERT INTO `banners` (`id`, `image`, `created_at`, `updated_at`) VALUES
(8, 'image_banner/zCJCIBfBOi7nYFXmkjPvKsio9eWrAhDVfCvXpGiX.jpeg', '2019-10-02 23:33:45', '2019-10-11 03:39:30'),
(9, 'image_banner/jdNTvpTyg7d3GAP9ULXxTnP76eQCX9wx5P3oDPnl.jpeg', '2019-10-02 23:33:53', '2019-10-08 01:08:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `updated_by`, `deleted_by`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Arabica', 'arabica', 'sihap', '', 'sihap', '2019-09-27 01:37:11', '2019-10-06 22:47:40'),
(2, 'Robusta', 'robusta', '', '', 'sihap', '2019-09-27 02:03:01', '2019-09-27 02:03:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `category_product`
--

CREATE TABLE `category_product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `category_product`
--

INSERT INTO `category_product` (`id`, `product_id`, `category_id`, `created_at`, `updated_at`) VALUES
(4, 9, 2, NULL, NULL),
(10, 7, 2, NULL, NULL),
(11, 10, 1, NULL, NULL),
(12, 13, 1, NULL, NULL),
(13, 13, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(64, '2014_10_12_000000_create_users_table', 1),
(65, '2014_10_12_100000_create_password_resets_table', 1),
(66, '2019_09_19_041314_create_roles_table', 1),
(67, '2019_09_19_044847_create_role_user_table', 1),
(68, '2019_09_25_074503_create_categories_table', 1),
(70, '2019_09_25_194434_create_product_table', 2),
(71, '2019_09_25_194434_create_products_table', 3),
(72, '2019_09_26_025715_create_product_category_table', 4),
(75, '2019_09_26_155104_create_penyesuainusers_table', 5),
(77, '2019_09_27_095447_create_category_product_table', 6),
(78, '2019_09_29_063646_create_orders_table', 7),
(79, '2019_09_29_065139_create_product_order_table', 8),
(80, '2019_09_29_065139_create_order_product_table', 9),
(81, '2019_10_01_152731_create_orders_table', 10),
(83, '2019_10_02_092928_create_banners_table', 11);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `status` enum('SUBMIT','PROCESS','FINISH','CANCEL') COLLATE utf8mb4_unicode_ci NOT NULL,
  `bukti_tf` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_product`
--

CREATE TABLE `order_product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `order_product`
--

INSERT INTO `order_product` (`id`, `order_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 2, 9, NULL, NULL),
(2, 4, 7, NULL, NULL),
(5, 11, 7, NULL, NULL),
(6, 12, 7, NULL, NULL),
(7, 13, 7, NULL, NULL),
(8, 14, 10, NULL, NULL),
(9, 15, 7, NULL, NULL),
(10, 16, 7, NULL, NULL),
(11, 17, 7, NULL, NULL),
(12, 18, 7, NULL, NULL),
(13, 19, 12, NULL, NULL),
(14, 20, 12, NULL, NULL),
(15, 21, 7, NULL, NULL),
(16, 22, 12, NULL, NULL),
(17, 23, 7, NULL, NULL),
(18, 24, 7, NULL, NULL),
(19, 25, 9, NULL, NULL),
(20, 26, 10, NULL, NULL),
(21, 27, 7, NULL, NULL),
(22, 28, 7, NULL, NULL),
(23, 29, 7, NULL, NULL),
(24, 30, 7, NULL, NULL),
(25, 31, 7, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL,
  `address` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `views` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `stock` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `avatar` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `product_name`, `category_id`, `slug`, `description`, `price`, `address`, `views`, `stock`, `avatar`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(7, 'Kopi Robusta', 2, 'hmmm', 'Kopi berkualitas dan terjamin kelezatannya', 1000.00, 'Wuluhan-Jember1', 0, 10, 'images_product/PTfi6hDJXvnXWQBQh79KP0ijOb7QQ090ZyrWNTlF.jpeg', 1, 1, NULL, '2019-09-27 06:48:42', '2019-10-08 00:59:24', NULL),
(9, 'Kopi Enak', 2, 'iwak', 'Kopi berkualitas dan terjamin kelezatannya', 5000.00, 'Universitas Jember aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 0, 1000, 'images_product/BFptvz8PxQUekzr0JXte0MGjdBnCoihztMy220W3.jpeg', 9, 1, NULL, '2019-09-29 20:26:04', '2019-10-08 00:59:42', NULL),
(10, 'Kopi Pait', 2, 'test', 'Kopi berkualitas dan terjamin kelezatannya', 8000.00, 'Patrang-Jember-Jawatimur hhhhhhhhhhhhhhhhh', 0, 10, 'images_product/mNnTfZNXl3qrA5lrYwlXPIaRRyQGAasd4FvE8BOt.jpeg', 1, 1, NULL, '2019-09-30 05:59:27', '2019-10-08 00:59:58', NULL),
(13, 'kopi mantap', 0, 'kopi-mantap', 'enaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaakkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk', 1000.00, 'Wuluhan-Jemberaaaaaaaaaaaaaaaaaaaaaaaaaa', 0, 2, 'images_product/bRJjozSBVAUPDQBN1e7LjFEjSZwKkMkUdhWTzs4a.jpeg', 1, NULL, NULL, '2019-10-15 12:39:32', '2019-10-15 12:39:32', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2019-09-25 19:45:40', '2019-09-25 19:45:40'),
(2, 'user', '2019-09-25 19:45:40', '2019-09-25 19:45:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_user`
--

CREATE TABLE `role_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 2, NULL, NULL),
(4, 2, 4, NULL, NULL),
(5, 2, 5, NULL, NULL),
(8, 2, 8, NULL, NULL),
(11, 1, 9, NULL, NULL),
(12, 1, 10, NULL, NULL),
(13, 1, 11, NULL, NULL),
(14, 1, 12, NULL, NULL),
(15, 1, 13, NULL, NULL),
(16, 1, 14, NULL, NULL),
(17, 1, 15, NULL, NULL),
(18, 2, 16, NULL, NULL),
(19, 2, 17, NULL, NULL),
(20, 1, 18, NULL, NULL),
(21, 2, 19, NULL, NULL),
(22, 1, 20, NULL, NULL),
(24, 1, 21, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('ACTIVE','INACTIVE') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `address`, `phone`, `avatar`, `status`) VALUES
(1, 'sihap', 'baharuddinsihap@gmail.com', NULL, '$2y$10$5R3dniTzUCUSHQTpR5QHDeFV5H8frRFNRBTWC.f7tdaZ3TtdukZ3u', NULL, '2019-09-25 19:45:40', '2019-10-07 19:57:06', 'Wuluhan-Jember jawa timur indonesia', '087741496667', '', 'ACTIVE'),
(2, 'Sihap6', 'sihapbaharuddins@gmail.com', NULL, '$2y$10$D59XLXcrWh8YP.QV/vlc9eZpcLvsx042vFcRzCusCg7r0tfpQ.Y92', NULL, '2019-09-26 08:57:38', '2019-10-07 19:44:08', 'Jemberrrrrrrrrrrrrrrrrrrrrraaaaaaaaaaaa', '087741496667', 'avatars/Ag1MeEb0HDf4s2BZh9i1nCpNhYNseblpWyrtFibr.png', 'INACTIVE'),
(4, 'tester', 'test1@gmail.com', NULL, '$2y$10$.OtBbM/aXh.07.N6SbHPWOG9YbH62abn/Gh3.Wcxz4TLkfv2QrRUK', NULL, '2019-09-26 09:18:48', '2019-10-09 19:11:34', 'Wuluhan-Jember', '087741496667', 'avatars/3841xXoUuH14jxSt7MYb8VttBvO2kfbGdXvStI8I.png', 'ACTIVE'),
(9, 'contoh', 'contoh@example.com', NULL, '$2y$10$RSajfRvvvJgp0ewbwAYb2eSy6mB0EWe8heEOmcZRVKfyNd53XEb.i', NULL, '2019-09-29 19:59:56', '2019-09-29 20:10:59', 'jalan aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '087741496667', 'avatars/JaWDWid0u7aG1D3Xazb8S63UKisiSEDLPtlGPg26.jpeg', 'ACTIVE'),
(10, 'example', 'example@contoh.com', NULL, '$2y$10$2WpzQ0oFm5Oj06t4pXK3dei8PiyCXK55XCkqXK1bq5deONDCp66m.', NULL, '2019-09-29 21:24:40', '2019-10-07 20:10:16', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '098765432161', 'avatars/kbk8tjOpjZTpMRX5QnoAA5kgj6289iQV0BlUqQHu.jpeg', 'ACTIVE'),
(11, 'viokemem', 'vio@gmail.com', NULL, '$2y$10$vlcQPWqp6ryC5F2ZsPpQL.snO1..lSPgWaJF6mASfakZN1xhbDhXq', NULL, '2019-10-01 09:51:20', '2019-10-01 09:51:20', 'Patrang-Jember-Jawatimur Indonesia', '087741496667', 'avatars/xvRkTWn5pKSJbrxoJygWJ5FfRfJHTjJRtBx88Rrj.png', 'ACTIVE'),
(12, 'user2', 'user2@example.com', NULL, '$2y$10$AjuDfMeb3/WGJxf34U0gRe1ciIdi.SJOzzJzcomUbEbvTvtk90oGi', NULL, '2019-10-03 10:09:44', '2019-10-03 10:09:44', 'Wuluhan-Jemberaaaaaaaaaaaaaaaaaaaaaaaaaa', '087741496667', 'avatars/DDn8rb9Bhy5a3dOjUyRN37cm8mipvMxXGRuKTqpY.jpeg', 'ACTIVE'),
(13, 'user1', 'user1@gmail.com', NULL, '$2y$10$xrJvV4ffhrgAbV7.80M9Kef06ZaAP5/ahsPJGCEQm6aEHPc2iuF/u', NULL, '2019-10-03 10:10:22', '2019-10-03 10:10:22', 'Wuluhan-Jemberaaaaaaaaaaaaaaaaaaaaaaaaaa', '087741496667', 'avatars/7a4Q8tUCjzroc9HbPmMXaYeIMOuVYlV4xYP44SXb.jpeg', 'ACTIVE');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indeks untuk tabel `category_product`
--
ALTER TABLE `category_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_product_product_id_foreign` (`product_id`),
  ADD KEY `category_product_category_id_foreign` (`category_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_product_id_foreign` (`product_id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `category_product`
--
ALTER TABLE `category_product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `order_product`
--
ALTER TABLE `order_product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `category_product`
--
ALTER TABLE `category_product`
  ADD CONSTRAINT `category_product_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `category_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
