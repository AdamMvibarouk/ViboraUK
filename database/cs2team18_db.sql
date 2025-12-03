-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 02, 2025 at 04:06 PM
-- Server version: 8.0.44-0ubuntu0.22.04.1
-- PHP Version: 8.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cs2team18_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `address_id` char(36) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT (uuid()),
  `user_id` char(36) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `line1` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `line2` text COLLATE utf8mb4_unicode_520_ci,
  `city` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `postcode` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `country` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `cart_id` char(36) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT (uuid()),
  `user_id` char(36) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `cart_item_id` char(36) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT (uuid()),
  `cart_id` char(36) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `product_id` char(36) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `quantity` int NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `line_total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` char(36) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT (uuid()),
  `name` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_520_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`, `slug`, `description`, `is_active`, `created_at`) VALUES
('352883ba-cd3f-11f0-982a-005056b707be', 'Padel Rackets', 'padel-rackets', 'Performance padel rackets for all levels', 1, '2025-11-29 16:19:40'),
('352887e2-cd3f-11f0-982a-005056b707be', 'Padel Balls', 'padel-balls', 'High-quality padel balls', 1, '2025-11-29 16:19:40'),
('352891b3-cd3f-11f0-982a-005056b707be', 'Racket Bags', 'racket-bags', 'Bags to carry and protect your padel rackets', 1, '2025-11-29 16:19:40'),
('3528928f-cd3f-11f0-982a-005056b707be', 'Grips & Accessories', 'grips-accessories', 'Overgrips and accessories', 1, '2025-11-29 16:19:40'),
('35289332-cd3f-11f0-982a-005056b707be', 'Sportswear', 'sportswear', 'Padel clothing and apparel', 1, '2025-11-29 16:19:40'),
('352893d0-cd3f-11f0-982a-005056b707be', 'Coaching & Services', 'coaching-services', 'Padel coaching lessons and services', 1, '2025-11-29 16:19:40'),
('e6660501-cf7e-11f0-a24b-005056b707be', 'T-Shirts', 't-shirts', NULL, 1, '2025-12-02 13:00:38'),
('e6660920-cf7e-11f0-a24b-005056b707be', 'Balls', 'balls', NULL, 1, '2025-12-02 13:00:38'),
('e6660a4e-cf7e-11f0-a24b-005056b707be', 'Shoes', 'shoes', NULL, 1, '2025-12-02 13:00:38'),
('e6660af2-cf7e-11f0-a24b-005056b707be', 'Bags', 'bags', NULL, 1, '2025-12-02 13:00:38');

-- --------------------------------------------------------

--
-- Table structure for table `contact_requests`
--

CREATE TABLE `contact_requests` (
  `contact_id` char(36) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT (uuid()),
  `name` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `email` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `subject` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `handled_by_admin_id` char(36) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `status` enum('open','in_progress','closed') COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'open'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory_alerts`
--

CREATE TABLE `inventory_alerts` (
  `alert_id` char(36) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT (uuid()),
  `variant_id` char(36) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `alert_type` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `triggered_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `message` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `acknowledged_by_admin_id` char(36) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `acknowledged_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` char(36) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT (uuid()),
  `user_id` char(36) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `order_number` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'pending',
  `subtotal` decimal(10,2) NOT NULL DEFAULT '0.00',
  `discount_total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `tax_total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `shipping_total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `grand_total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `placed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` char(36) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT (uuid()),
  `order_id` char(36) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `variant_id` char(36) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `quantity` int NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `line_total` decimal(10,2) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `padel_attributes`
--

CREATE TABLE `padel_attributes` (
  `attribute_id` char(36) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT (uuid()),
  `name` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `padel_attributes`
--

INSERT INTO `padel_attributes` (`attribute_id`, `name`) VALUES
('40ffd25b-cd3f-11f0-982a-005056b707be', 'Balance'),
('40ffde32-cd3f-11f0-982a-005056b707be', 'Ball Pack Size'),
('40ffded5-cd3f-11f0-982a-005056b707be', 'Clothing Size'),
('40ffdd89-cd3f-11f0-982a-005056b707be', 'Colour'),
('40ffdc2d-cd3f-11f0-982a-005056b707be', 'Core'),
('40ffe0f4-cd3f-11f0-982a-005056b707be', 'Duration (minutes)'),
('40ffdfa8-cd3f-11f0-982a-005056b707be', 'Gender'),
('40ffdcd8-cd3f-11f0-982a-005056b707be', 'Grip Size'),
('40ffe04e-cd3f-11f0-982a-005056b707be', 'Level'),
('40ffdb4a-cd3f-11f0-982a-005056b707be', 'Shape'),
('40ffce70-cd3f-11f0-982a-005056b707be', 'Weight (g)');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` char(36) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT (uuid()),
  `category_id` char(36) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `name` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_520_ci,
  `image_url` text COLLATE utf8mb4_unicode_520_ci,
  `base_price` decimal(10,2) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `product_url` varchar(500) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `category_id`, `name`, `slug`, `description`, `image_url`, `base_price`, `is_active`, `created_at`, `updated_at`, `product_url`) VALUES
('33de03fd-cf7e-11f0-a24b-005056b707be', '352883ba-cd3f-11f0-982a-005056b707be', 'Mirage 25 Padel Racket', 'mirage-25-padel-racket', 'Mirage 25 padel racket from Y1Sport.', NULL, '0.00', 1, '2025-12-02 12:55:39', '2025-12-02 12:55:39', 'https://y1sport.com/products/padel-mirage-25'),
('33de098a-cf7e-11f0-a24b-005056b707be', '352883ba-cd3f-11f0-982a-005056b707be', 'Panna 25 Padel Racket', 'panna-25-padel-racket', 'Panna 25 padel racket from Y1Sport.', NULL, '0.00', 1, '2025-12-02 12:55:39', '2025-12-02 12:55:39', 'https://y1sport.com/products/padel-panna-25'),
('33de0b2b-cf7e-11f0-a24b-005056b707be', '352883ba-cd3f-11f0-982a-005056b707be', 'Pro X 25 Padel Racket', 'pro-x-25-padel-racket', 'Pro X 25 padel racket from Y1Sport.', NULL, '0.00', 1, '2025-12-02 12:55:39', '2025-12-02 12:55:39', 'https://y1sport.com/products/padel-pro-x-25'),
('33de0c32-cf7e-11f0-a24b-005056b707be', '352883ba-cd3f-11f0-982a-005056b707be', 'Arlo 25 Padel Racket', 'arlo-25-padel-racket', 'Arlo 25 padel racket from Y1Sport.', NULL, '0.00', 1, '2025-12-02 12:55:39', '2025-12-02 12:55:39', 'https://y1sport.com/products/padel-arlo-25'),
('33de0d3b-cf7e-11f0-a24b-005056b707be', '352883ba-cd3f-11f0-982a-005056b707be', 'Bullpadel Vertex 04 25', 'bullpadel-vertex-04-25', 'Bullpadel Vertex 04 2025 padel racket.', NULL, '0.00', 1, '2025-12-02 12:55:39', '2025-12-02 12:55:39', 'https://www.bullpadel.com/gb/proline/4547-pala-bullpadel-vertex-04-25.html'),
('33de0e5c-cf7e-11f0-a24b-005056b707be', '352883ba-cd3f-11f0-982a-005056b707be', 'Bullpadel Vertex 04 MX 24', 'bullpadel-vertex-04-mx-24', 'Bullpadel Vertex 04 MX 2024 limited edition.', NULL, '0.00', 1, '2025-12-02 12:55:39', '2025-12-02 12:55:39', 'https://www.bullpadel.com/gb/ltd-collection/3790-racket-bullpadel-vertex-04-mx-24.html'),
('33de0f66-cf7e-11f0-a24b-005056b707be', '352883ba-cd3f-11f0-982a-005056b707be', 'Bullpadel Pearl 25', 'bullpadel-pearl-25', 'Bullpadel Pearl 2025 padel racket.', NULL, '0.00', 1, '2025-12-02 12:55:39', '2025-12-02 12:55:39', 'https://www.bullpadel.com/gb/proline/4552-racket-bullpadel-pearl-25.html'),
('33de1060-cf7e-11f0-a24b-005056b707be', '352883ba-cd3f-11f0-982a-005056b707be', 'Bullpadel Vertex JR 25', 'bullpadel-vertex-jr-25', 'Bullpadel Vertex Junior 2025 racket.', NULL, '0.00', 1, '2025-12-02 12:55:39', '2025-12-02 12:55:39', 'https://www.bullpadel.com/gb/junior/4920-racket-bullpadel-vertex-jr-25.html'),
('33de115a-cf7e-11f0-a24b-005056b707be', '352883ba-cd3f-11f0-982a-005056b707be', 'Nox AT10 Genius 18K Alum by Agustin Tapia 2026', 'nox-at10-genius-18k-alum-2026', 'Nox AT10 Genius 18K Alum 2026 Agustin Tapia padel racket.', NULL, '0.00', 1, '2025-12-02 12:55:39', '2025-12-02 12:55:39', 'https://www.padelnuestro.com/uk/nox-at10-genius-18k-alum-by-agustin-tapia-2026'),
('33de132d-cf7e-11f0-a24b-005056b707be', '352883ba-cd3f-11f0-982a-005056b707be', 'Nox X-One Casual Series 23', 'nox-x-one-casual-series-23', 'Nox X-One Casual Series 23 padel racket.', NULL, '0.00', 1, '2025-12-02 12:55:39', '2025-12-02 12:55:39', 'https://www.padelnuestro.com/uk/nox-x-one-casual-series-23-31592-p'),
('33de1422-cf7e-11f0-a24b-005056b707be', '352883ba-cd3f-11f0-982a-005056b707be', 'Head Evo Extreme 2025', 'head-evo-extreme-2025', 'HEAD Evo Extreme 2025 padel racket.', NULL, '0.00', 1, '2025-12-02 12:55:39', '2025-12-02 12:55:39', 'https://www.padelnuestro.com/uk/head-evo-extreme-2025'),
('33de1512-cf7e-11f0-a24b-005056b707be', '352883ba-cd3f-11f0-982a-005056b707be', 'Head Speed Motion 2025', 'head-speed-motion-2025', 'HEAD Speed Motion 2025 Ari Sánchez padel racket.', NULL, '0.00', 1, '2025-12-02 12:55:39', '2025-12-02 12:55:39', 'https://www.padelnuestro.com/uk/head-speed-motion-2025'),
('33de1609-cf7e-11f0-a24b-005056b707be', '352883ba-cd3f-11f0-982a-005056b707be', 'Babolat X Lamborghini BL002 Scandal Green', 'babolat-x-lamborghini-bl002-scandal-green', 'Babolat x Lamborghini BL002 Scandal Green padel racket.', NULL, '0.00', 1, '2025-12-02 12:55:39', '2025-12-02 12:55:39', 'https://www.padelnuestro.com/uk/babolat-x-lamborghini-bl002-scandal-green'),
('33de1709-cf7e-11f0-a24b-005056b707be', '352883ba-cd3f-11f0-982a-005056b707be', 'Babolat Air Origin', 'babolat-air-origin', 'Babolat Air Origin padel racket.', NULL, '0.00', 1, '2025-12-02 12:55:39', '2025-12-02 12:55:39', 'https://www.padelnuestro.com/uk/babolat-air-origin'),
('3a280bd4-cf7f-11f0-a24b-005056b707be', 'e6660501-cf7e-11f0-a24b-005056b707be', 'Short Sleeve Training Top Womens Red', 'short-sleeve-training-top-womens-red', 'Short sleeve training top (women) in red.', NULL, '0.00', 1, '2025-12-02 13:02:59', '2025-12-02 13:02:59', 'https://y1sport.com/products/short-sleeve-training-top-womens-red'),
('3a2810ed-cf7f-11f0-a24b-005056b707be', 'e6660501-cf7e-11f0-a24b-005056b707be', 'Short Sleeve Training Top Mens Red', 'short-sleeve-training-top-mens-red', 'Short sleeve training top (men) in red.', NULL, '0.00', 1, '2025-12-02 13:02:59', '2025-12-02 13:02:59', 'https://y1sport.com/products/short-sleeve-training-top-mens-red'),
('3a281241-cf7f-11f0-a24b-005056b707be', 'e6660501-cf7e-11f0-a24b-005056b707be', 'Short Sleeve Training Top Mens Navy', 'short-sleeve-training-top-mens-navy', 'Short sleeve training top (men) navy.', NULL, '0.00', 1, '2025-12-02 13:02:59', '2025-12-02 13:02:59', 'https://y1sport.com/products/short-sleeve-training-top-mens-navy'),
('3a281352-cf7f-11f0-a24b-005056b707be', 'e6660501-cf7e-11f0-a24b-005056b707be', 'Short Sleeve Training Top Womens Navy', 'short-sleeve-training-top-womens-navy', 'Short sleeve training top (women) navy.', NULL, '0.00', 1, '2025-12-02 13:02:59', '2025-12-02 13:02:59', 'https://y1sport.com/products/short-sleeve-training-top-womens-navy'),
('3a2814c0-cf7f-11f0-a24b-005056b707be', 'e6660501-cf7e-11f0-a24b-005056b707be', 'Short Sleeve Training Top Mens Black', 'short-sleeve-training-top-mens-black', 'Short sleeve training top (men) black.', NULL, '0.00', 1, '2025-12-02 13:02:59', '2025-12-02 13:02:59', 'https://y1sport.com/products/short-sleeve-training-top-mens-black'),
('3a2817d3-cf7f-11f0-a24b-005056b707be', 'e6660501-cf7e-11f0-a24b-005056b707be', 'Short Sleeve Training Top Mens White', 'short-sleeve-training-top-mens-white', 'Short sleeve training top (men) white.', NULL, '0.00', 1, '2025-12-02 13:02:59', '2025-12-02 13:02:59', 'https://y1sport.com/products/short-sleeve-training-top-mens-white'),
('3a2818d6-cf7f-11f0-a24b-005056b707be', 'e6660501-cf7e-11f0-a24b-005056b707be', 'T-Shirt Bullpadel Paquito 25I White', 't-shirt-bullpadel-paquito-25i-white', 'Official Bullpadel Paquito 25I t-shirt.', NULL, '0.00', 1, '2025-12-02 13:02:59', '2025-12-02 13:02:59', 'https://www.bullpadel.com/gb/official-t-shirts/5470-18711-t-shirt-bullpadel-paquito-25i-white.html'),
('3a2819d8-cf7f-11f0-a24b-005056b707be', 'e6660501-cf7e-11f0-a24b-005056b707be', 'T-Shirt Bullpadel Chingotto 25I Stone', 't-shirt-bullpadel-chingotto-25i-stone', 'Official Bullpadel Chingotto 25I t-shirt.', NULL, '0.00', 1, '2025-12-02 13:02:59', '2025-12-02 13:02:59', 'https://www.bullpadel.com/gb/official-t-shirts/5439-18571-t-shirt-bullpadel-chingotto-25i-stone.html'),
('3a281ad3-cf7f-11f0-a24b-005056b707be', 'e6660501-cf7e-11f0-a24b-005056b707be', 'T-Shirt Bullpadel Di Nenno 25I Hybiscus', 't-shirt-bullpadel-di-nenno-25i-hybiscus', 'Official Bullpadel Di Nenno 25I t-shirt.', NULL, '0.00', 1, '2025-12-02 13:02:59', '2025-12-02 13:02:59', 'https://www.bullpadel.com/gb/official-t-shirts/5460-18676-t-shirt-bullpadel-di-nenno-25i-hybiscus.html'),
('3a281ca0-cf7f-11f0-a24b-005056b707be', 'e6660501-cf7e-11f0-a24b-005056b707be', 'T-Shirt Bullpadel Tello 25I Blue Green', 't-shirt-bullpadel-tello-25i-blue-green', 'Official Bullpadel Tello 25I t-shirt.', NULL, '0.00', 1, '2025-12-02 13:02:59', '2025-12-02 13:02:59', 'https://www.bullpadel.com/gb/official-t-shirts/5450-18671-t-shirt-bullpadel-tello-25i-blue-green.html'),
('3a281d9f-cf7f-11f0-a24b-005056b707be', 'e6660501-cf7e-11f0-a24b-005056b707be', 'T-Shirt Bullpadel Batea Woman', 't-shirt-bullpadel-batea-woman', 'Bullpadel Batea women’s t-shirt.', NULL, '0.00', 1, '2025-12-02 13:02:59', '2025-12-02 13:02:59', 'https://www.padelnuestro.com/uk/t-shirt-bullpadel-batea-woman'),
('3a281e9b-cf7f-11f0-a24b-005056b707be', 'e6660501-cf7e-11f0-a24b-005056b707be', 'T-Shirt Bullpadel Gemma 25V Woman', 't-shirt-bullpadel-gemma-25v-woman', 'Bullpadel Gemma 25V women’s t-shirt.', NULL, '0.00', 1, '2025-12-02 13:02:59', '2025-12-02 13:02:59', 'https://www.padelnuestro.com/uk/t-shirt-bullpadel-gemma-25v-woman'),
('3a281f89-cf7f-11f0-a24b-005056b707be', 'e6660501-cf7e-11f0-a24b-005056b707be', 'T-Shirt Nox Pro 2025', 't-shirt-nox-pro-2025', 'Nox Pro 2025 performance t-shirt.', NULL, '0.00', 1, '2025-12-02 13:02:59', '2025-12-02 13:02:59', 'https://www.padelnuestro.com/uk/t-shirt-nox-pro-2025'),
('3a282085-cf7f-11f0-a24b-005056b707be', 'e6660501-cf7e-11f0-a24b-005056b707be', 'T-Shirt Lacoste TH5195', 't-shirt-lacoste-th5195', 'Lacoste TH5195 padel t-shirt.', NULL, '0.00', 1, '2025-12-02 13:02:59', '2025-12-02 13:02:59', 'https://www.padelnuestro.com/uk/t-shirt-lacoste-th5195'),
('4c5a0ac5-cf7f-11f0-a24b-005056b707be', 'e6660920-cf7e-11f0-a24b-005056b707be', 'Babolat Court Padel X3 Balls Canister', 'babolat-court-padel-x3', 'Babolat Court Padel X3 premium balls.', NULL, '0.00', 1, '2025-12-02 13:03:29', '2025-12-02 13:03:29', 'https://www.padelnuestro.com/uk/babolat-court-padel-x3-balls-canister-24650-p'),
('4c5a0fb8-cf7f-11f0-a24b-005056b707be', 'e6660920-cf7e-11f0-a24b-005056b707be', 'Wilson Premier Padel Balls Canister', 'wilson-premier-padel-balls', 'Wilson Premier Padel match balls.', 'https://www.padelnuestro.com/media/catalog/product/i/m/imagen_1_14782_287f511e_6fd5.jpg?optimize=high&bg-color=255,255,255&fit=bounds&height=220&width=220&canvas=220:220&dpr=2', '0.00', 1, '2025-12-02 13:03:29', '2025-12-02 13:03:29', 'https://www.padelnuestro.com/uk/wilson-premier-padel-balls-canister-113567-p'),
('4c5a1116-cf7f-11f0-a24b-005056b707be', 'e6660920-cf7e-11f0-a24b-005056b707be', '3-Ball Can Nox Nerbo', '3-ball-can-nox-nerbo', 'Nox Nerbo premium padel balls.', NULL, '0.00', 1, '2025-12-02 13:03:29', '2025-12-02 13:03:29', 'https://www.padelnuestro.com/uk/3-ball-can-nox-nerbo'),
('4c5a1220-cf7f-11f0-a24b-005056b707be', 'e6660920-cf7e-11f0-a24b-005056b707be', 'Bullpadel Premium Pro Boat', 'bullpadel-premium-pro-boat', 'Bullpadel Premium Pro professional balls.', NULL, '0.00', 1, '2025-12-02 13:03:29', '2025-12-02 13:03:29', 'https://www.padelnuestro.com/uk/bullpadel-premium-pro-boat-4151-p'),
('4c5a1330-cf7f-11f0-a24b-005056b707be', 'e6660920-cf7e-11f0-a24b-005056b707be', 'Bullpadel Train Ball Jar 465464', 'bullpadel-train-ball-465464', 'Bullpadel training balls (465464).', NULL, '0.00', 1, '2025-12-02 13:03:29', '2025-12-02 13:03:29', 'https://www.padelnuestro.com/uk/bullpadel-train-ball-jar-465464-108760-p'),
('5c4d1dfb-cf7f-11f0-a24b-005056b707be', 'e6660a4e-cf7e-11f0-a24b-005056b707be', 'Bullpadel Neuron Vibram 25V Clay', 'bullpadel-neuron-vibram-25v-clay', 'Bullpadel Neuron Vibram 25V Clay shoes.', NULL, '0.00', 1, '2025-12-02 13:03:56', '2025-12-02 13:03:56', 'https://www.bullpadel.com/gb/man/4893-16336-trainers-bullpadel-neuron-vibram-25v-clay.html'),
('5c4d226a-cf7f-11f0-a24b-005056b707be', 'e6660a4e-cf7e-11f0-a24b-005056b707be', 'Bullpadel Hybrid Fly 25I Steel Blue', 'bullpadel-hybrid-fly-25i-steel-blue', 'Bullpadel Hybrid Fly 25I in steel blue.', NULL, '0.00', 1, '2025-12-02 13:03:56', '2025-12-02 13:03:56', 'https://www.bullpadel.com/gb/man/5561-19285-trainers-bullpadel-hybrid-fly-25i-steel-blue.html'),
('5c4d23b4-cf7f-11f0-a24b-005056b707be', 'e6660a4e-cf7e-11f0-a24b-005056b707be', 'Bullpadel Vertex Vibram 25V Yellow', 'bullpadel-vertex-vibram-25v-yellow', 'Bullpadel Vertex Vibram 25V in yellow.', NULL, '0.00', 1, '2025-12-02 13:03:56', '2025-12-02 13:03:56', 'https://www.bullpadel.com/gb/man/4839-16235-trainers-bullpadel-vertex-vibram-25v-yellow.html'),
('5c4d24c0-cf7f-11f0-a24b-005056b707be', 'e6660a4e-cf7e-11f0-a24b-005056b707be', 'Bullpadel Premier P1 White', 'bullpadel-premier-p1-white', 'Bullpadel Premier P1 white shoes.', NULL, '0.00', 1, '2025-12-02 13:03:56', '2025-12-02 13:03:56', 'https://www.bullpadel.com/gb/man/4591-15718-trainers-bullpadel-premier-p1-white.html'),
('5c4d25ea-cf7f-11f0-a24b-005056b707be', 'e6660a4e-cf7e-11f0-a24b-005056b707be', 'Babolat Jet Mach 3 All Court Blue/Orange Men 30523629', 'babolat-jet-mach-3-blue-orange', 'Babolat Jet Mach 3 All Court blue/orange.', NULL, '0.00', 1, '2025-12-02 13:03:56', '2025-12-02 13:03:56', 'https://www.padelnuestro.com/uk/babolat-jet-mach-3-all-court-blue-orange-men-30523629'),
('5c4d26e9-cf7f-11f0-a24b-005056b707be', 'e6660a4e-cf7e-11f0-a24b-005056b707be', 'K-Swiss Hypercourt Supreme 2 White 09071102', 'kswiss-hypercourt-supreme-2-white', 'K-Swiss Hypercourt Supreme 2 white.', NULL, '0.00', 1, '2025-12-02 13:03:56', '2025-12-02 13:03:56', 'https://www.padelnuestro.com/uk/kswiss-hypercourt-supreme-2-white-09071102'),
('5c4d283b-cf7f-11f0-a24b-005056b707be', 'e6660a4e-cf7e-11f0-a24b-005056b707be', 'Joma Master 1000 Men 25 Clay Fluorescent Yellow TM100S2599CC', 'joma-master-1000-men-yellow', 'Joma Master 1000 clay fluorescent yellow.', NULL, '0.00', 1, '2025-12-02 13:03:56', '2025-12-02 13:03:56', 'https://www.padelnuestro.com/uk/joma-master-1000-men-25-clay-fluorescent-yellow-tm100s2599cc'),
('5c4d29b9-cf7f-11f0-a24b-005056b707be', 'e6660a4e-cf7e-11f0-a24b-005056b707be', 'Bullpadel Trainers Buker JR 25I White', 'bullpadel-buker-jr-25i-white', 'Bullpadel Buker JR 25I white shoes.', 'https://www.bullpadel.com/17544-home_default/bullpadel-trainers-buker-jr-25i-white.jpg', '0.00', 1, '2025-12-02 13:03:56', '2025-12-02 13:03:56', 'https://www.bullpadel.com/17544-home_default/bullpadel-trainers-buker-jr-25i-white.jpg'),
('5c4d2b8c-cf7f-11f0-a24b-005056b707be', 'e6660a4e-cf7e-11f0-a24b-005056b707be', 'Wilson Rush Pro 4.5 White/Blue', 'wilson-rush-pro-45-white-blue', 'Wilson Rush Pro 4.5 shoes in white/blue.', NULL, '0.00', 1, '2025-12-02 13:03:56', '2025-12-02 13:03:56', 'https://www.padelnuestro.com/uk/wilson-rush-pro-4-5-white-blue'),
('650e3d6b-cd3f-11f0-982a-005056b707be', '352883ba-cd3f-11f0-982a-005056b707be', 'ViboraUK Venom Pro Padel Racket', 'viborauk-venom-pro-padel-racket', 'Advanced-level racket with teardrop shape and medium balance.', '/images/products/rackets/venom-pro.jpg', '199.99', 1, '2025-11-29 16:21:01', '2025-11-29 16:21:01', NULL),
('650f7cec-cd3f-11f0-982a-005056b707be', '352883ba-cd3f-11f0-982a-005056b707be', 'ViboraUK Strike Control Padel Racket', 'viborauk-strike-control-padel-racket', 'Control-oriented round-shaped racket ideal for intermediate players.', '/images/products/rackets/strike-control.jpg', '159.99', 1, '2025-11-29 16:21:01', '2025-11-29 16:21:01', NULL),
('67e5789d-cf7f-11f0-a24b-005056b707be', 'e6660af2-cf7e-11f0-a24b-005056b707be', 'Padel Core Carry Case', 'padel-core-carry-case', 'Y1Sport padel core carry case.', NULL, '0.00', 1, '2025-12-02 13:04:15', '2025-12-02 13:04:15', 'https://y1sport.com/products/padel-core-carry-case-copy'),
('67e57d21-cf7f-11f0-a24b-005056b707be', 'e6660af2-cf7e-11f0-a24b-005056b707be', 'Bullpadel BPP26013 Hack Racket Bag Grey-Green', 'bullpadel-bpp26013-hack-bag', 'Bullpadel BPP26013 Hack racket bag.', NULL, '0.00', 1, '2025-12-02 13:04:15', '2025-12-02 13:04:15', 'https://www.bullpadel.com/gb/racket-bags/5745-paletero-bullpadel-bpp26013-hack-gris-verdoso.html'),
('67e57e8e-cf7f-11f0-a24b-005056b707be', 'e6660af2-cf7e-11f0-a24b-005056b707be', 'Bullpadel BPP26021 Pearl Racket Bag Greenish Blue', 'bullpadel-bpp26021-pearl-bag', 'Bullpadel BPP26021 Pearl racket bag.', NULL, '0.00', 1, '2025-12-02 13:04:15', '2025-12-02 13:04:15', 'https://www.bullpadel.com/gb/bea-gonzalez/5626-racket-bag-bullpadel-bpp26021-pearl-greenish-blue.html'),
('67e57fcc-cf7f-11f0-a24b-005056b707be', 'e6660af2-cf7e-11f0-a24b-005056b707be', 'Bullpadel BPP25022 Xplo Red Racket Bag', 'bullpadel-bpp25022-xplo-bag', 'Bullpadel BPP25022 Xplo red racket bag.', NULL, '0.00', 1, '2025-12-02 13:04:15', '2025-12-02 13:04:15', 'https://www.bullpadel.com/gb/racket-bags/4984-rackets-bag-bullpadel-bpp25022-xplo-red.html'),
('67e58114-cf7f-11f0-a24b-005056b707be', 'e6660af2-cf7e-11f0-a24b-005056b707be', 'Bullpadel BPP25015 Tour Greenish Blue Bag', 'bullpadel-bpp25015-tour-bag', 'Bullpadel BPP25015 Tour greenish blue bag.', NULL, '0.00', 1, '2025-12-02 13:04:15', '2025-12-02 13:04:15', 'https://www.bullpadel.com/gb/racket-bags/4980-bolsa-bullpadel-bpp25015-tour-verde-azulado.html'),
('67e58211-cf7f-11f0-a24b-005056b707be', 'e6660af2-cf7e-11f0-a24b-005056b707be', 'Lime Green Varlion Summum Padel Bag', 'varlion-summum-lime-green-bag', 'Varlion Summum padel bag in lime green.', NULL, '0.00', 1, '2025-12-02 13:04:15', '2025-12-02 13:04:15', 'https://www.padelnuestro.com/uk/lime-green-varlion-summum-padel-bag-29217-p'),
('78bbde7a-cd3f-11f0-982a-005056b707be', '352893d0-cd3f-11f0-982a-005056b707be', '1-to-1 Padel Coaching Session', '1-to-1-padel-coaching-session', 'Personal coaching session with a ViboraUK certified coach.', '/images/products/coaching/1-to-1-session.jpg', '40.00', 1, '2025-11-29 16:21:34', '2025-11-29 16:21:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_variants`
--

CREATE TABLE `product_variants` (
  `variant_id` char(36) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT (uuid()),
  `product_id` char(36) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `sku` varchar(64) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `variant_name` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `product_variants`
--

INSERT INTO `product_variants` (`variant_id`, `product_id`, `sku`, `variant_name`, `price`, `is_active`, `created_at`) VALUES
('e85ae4e1-cd3f-11f0-982a-005056b707be', '650e3d6b-cd3f-11f0-982a-005056b707be', 'VB-VENOMPRO-360-BLK', 'Venom Pro 360g - Black', '199.99', 1, '2025-11-29 16:24:41'),
('e85c3963-cd3f-11f0-982a-005056b707be', '650e3d6b-cd3f-11f0-982a-005056b707be', 'VB-VENOMPRO-370-BLU', 'Venom Pro 370g - Blue', '209.99', 1, '2025-11-29 16:24:41'),
('f2aec2a8-cd3f-11f0-982a-005056b707be', '78bbde7a-cd3f-11f0-982a-005056b707be', 'COACH-1TO1-60', '1-to-1 Coaching 60 Minutes', '40.00', 1, '2025-11-29 16:24:58'),
('f2b02b11-cd3f-11f0-982a-005056b707be', '78bbde7a-cd3f-11f0-982a-005056b707be', 'COACH-1TO1-90', '1-to-1 Coaching 90 Minutes', '55.00', 1, '2025-11-29 16:24:58');

-- --------------------------------------------------------

--
-- Table structure for table `product_variant_attributes`
--

CREATE TABLE `product_variant_attributes` (
  `variant_id` char(36) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `attribute_id` char(36) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_520_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `product_variant_attributes`
--

INSERT INTO `product_variant_attributes` (`variant_id`, `attribute_id`, `value`) VALUES
('e85ae4e1-cd3f-11f0-982a-005056b707be', '40ffce70-cd3f-11f0-982a-005056b707be', '360'),
('e85ae4e1-cd3f-11f0-982a-005056b707be', '40ffdd89-cd3f-11f0-982a-005056b707be', 'Black'),
('e85c3963-cd3f-11f0-982a-005056b707be', '40ffce70-cd3f-11f0-982a-005056b707be', '370'),
('e85c3963-cd3f-11f0-982a-005056b707be', '40ffdd89-cd3f-11f0-982a-005056b707be', 'Blue'),
('f2aec2a8-cd3f-11f0-982a-005056b707be', '40ffe0f4-cd3f-11f0-982a-005056b707be', '60');

-- --------------------------------------------------------

--
-- Table structure for table `restock_items`
--

CREATE TABLE `restock_items` (
  `restock_item_id` char(36) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT (uuid()),
  `restock_id` char(36) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `variant_id` char(36) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `quantity` int NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `restock_orders`
--

CREATE TABLE `restock_orders` (
  `restock_id` char(36) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT (uuid()),
  `created_by_admin_id` char(36) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'draft',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `returns`
--

CREATE TABLE `returns` (
  `return_id` char(36) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT (uuid()),
  `order_id` char(36) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `requested_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'requested',
  `reason` text COLLATE utf8mb4_unicode_520_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `return_items`
--

CREATE TABLE `return_items` (
  `return_item_id` char(36) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT (uuid()),
  `return_id` char(36) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `order_item_id` char(36) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `quantity` int NOT NULL,
  `condition_text` text COLLATE utf8mb4_unicode_520_ci,
  `resolution` enum('refund','exchange') COLLATE utf8mb4_unicode_520_ci DEFAULT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` char(36) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT (uuid()),
  `user_id` char(36) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `product_id` char(36) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `rating` tinyint NOT NULL,
  `title` text COLLATE utf8mb4_unicode_520_ci,
  `body` text COLLATE utf8mb4_unicode_520_ci,
  `is_verified_purchase` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` char(36) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT (uuid()),
  `role_name` enum('customer','admin') COLLATE utf8mb4_unicode_520_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
('3470626c-cd3e-11f0-982a-005056b707be', 'customer'),
('347065ea-cd3e-11f0-982a-005056b707be', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `shipments`
--

CREATE TABLE `shipments` (
  `shipment_id` char(36) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT (uuid()),
  `order_id` char(36) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `carrier` text COLLATE utf8mb4_unicode_520_ci,
  `tracking_no` text COLLATE utf8mb4_unicode_520_ci,
  `shipped_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'processing'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock_ledger`
--

CREATE TABLE `stock_ledger` (
  `movement_id` char(36) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT (uuid()),
  `variant_id` char(36) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `movement_type` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `qty_delta` int NOT NULL,
  `reference_type` text COLLATE utf8mb4_unicode_520_ci,
  `reference_id` char(36) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock_levels`
--

CREATE TABLE `stock_levels` (
  `variant_id` char(36) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `on_hand` int NOT NULL DEFAULT '0',
  `reserved` int NOT NULL DEFAULT '0',
  `reorder_threshold` int NOT NULL DEFAULT '0'
) ;

--
-- Dumping data for table `stock_levels`
--

INSERT INTO `stock_levels` (`variant_id`, `on_hand`, `reserved`, `reorder_threshold`) VALUES
('e85ae4e1-cd3f-11f0-982a-005056b707be', 20, 0, 5),
('e85c3963-cd3f-11f0-982a-005056b707be', 15, 0, 5),
('f2aec2a8-cd3f-11f0-982a-005056b707be', 0, 0, 0),
('f2b02b11-cd3f-11f0-982a-005056b707be', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` char(36) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT (uuid()),
  `email` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `password_hash` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `first_name` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `last_name` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `phone` text COLLATE utf8mb4_unicode_520_ci,
  `must_change_password` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `password_hash`, `first_name`, `last_name`, `phone`, `must_change_password`, `created_at`, `updated_at`) VALUES
('f5403f50-cd3e-11f0-982a-005056b707be', 'macdonald@viborauk.com', '<HASHED_ADMIN_PASSWORD>', 'Macdonald', 'Admin', '07000000000', 1, '2025-11-29 16:17:53', '2025-11-29 16:17:53'),
('f5404352-cd3e-11f0-982a-005056b707be', 'customer1@viborauk.com', '<HASHED_CUSTOMER_PASSWORD>', 'Alex', 'Player', '07111111111', 0, '2025-11-29 16:17:53', '2025-11-29 16:17:53');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `user_id` char(36) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `role_id` char(36) COLLATE utf8mb4_unicode_520_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`user_id`, `role_id`) VALUES
('f5403f50-cd3e-11f0-982a-005056b707be', '3470626c-cd3e-11f0-982a-005056b707be'),
('f5404352-cd3e-11f0-982a-005056b707be', '3470626c-cd3e-11f0-982a-005056b707be'),
('f5403f50-cd3e-11f0-982a-005056b707be', '347065ea-cd3e-11f0-982a-005056b707be');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `fk_addresses_user` (`user_id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `fk_carts_user` (`user_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`cart_item_id`),
  ADD KEY `fk_cart_items_cart` (`cart_id`),
  ADD KEY `fk_cart_items_product` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `contact_requests`
--
ALTER TABLE `contact_requests`
  ADD PRIMARY KEY (`contact_id`),
  ADD KEY `fk_contact_requests_admin` (`handled_by_admin_id`);

--
-- Indexes for table `inventory_alerts`
--
ALTER TABLE `inventory_alerts`
  ADD PRIMARY KEY (`alert_id`),
  ADD KEY `fk_inventory_alert_variant` (`variant_id`),
  ADD KEY `fk_inventory_alert_ack_admin` (`acknowledged_by_admin_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD UNIQUE KEY `order_number` (`order_number`),
  ADD KEY `fk_orders_user` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `fk_order_items_order` (`order_id`),
  ADD KEY `fk_order_items_variant` (`variant_id`);

--
-- Indexes for table `padel_attributes`
--
ALTER TABLE `padel_attributes`
  ADD PRIMARY KEY (`attribute_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `fk_products_category` (`category_id`);

--
-- Indexes for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`variant_id`),
  ADD UNIQUE KEY `sku` (`sku`),
  ADD KEY `fk_variants_product` (`product_id`);

--
-- Indexes for table `product_variant_attributes`
--
ALTER TABLE `product_variant_attributes`
  ADD PRIMARY KEY (`variant_id`,`attribute_id`),
  ADD KEY `fk_pva_attribute` (`attribute_id`);

--
-- Indexes for table `restock_items`
--
ALTER TABLE `restock_items`
  ADD PRIMARY KEY (`restock_item_id`),
  ADD KEY `fk_restock_items_restock` (`restock_id`),
  ADD KEY `fk_restock_items_variant` (`variant_id`);

--
-- Indexes for table `restock_orders`
--
ALTER TABLE `restock_orders`
  ADD PRIMARY KEY (`restock_id`),
  ADD KEY `fk_restock_orders_admin` (`created_by_admin_id`);

--
-- Indexes for table `returns`
--
ALTER TABLE `returns`
  ADD PRIMARY KEY (`return_id`),
  ADD KEY `fk_returns_order` (`order_id`),
  ADD KEY `fk_returns_user` (`user_id`);

--
-- Indexes for table `return_items`
--
ALTER TABLE `return_items`
  ADD PRIMARY KEY (`return_item_id`),
  ADD KEY `fk_return_items_return` (`return_id`),
  ADD KEY `fk_return_items_order_item` (`order_item_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `fk_reviews_user` (`user_id`),
  ADD KEY `fk_reviews_product` (`product_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- Indexes for table `shipments`
--
ALTER TABLE `shipments`
  ADD PRIMARY KEY (`shipment_id`),
  ADD KEY `fk_shipments_order` (`order_id`);

--
-- Indexes for table `stock_ledger`
--
ALTER TABLE `stock_ledger`
  ADD PRIMARY KEY (`movement_id`),
  ADD KEY `fk_stock_ledger_variant` (`variant_id`);

--
-- Indexes for table `stock_levels`
--
ALTER TABLE `stock_levels`
  ADD PRIMARY KEY (`variant_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `fk_user_roles_role` (`role_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `fk_addresses_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `fk_carts_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `fk_cart_items_cart` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`cart_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_cart_items_product` FOREIGN KEY (`product_id`) REFERENCES `product_variants` (`variant_id`) ON DELETE RESTRICT;

--
-- Constraints for table `contact_requests`
--
ALTER TABLE `contact_requests`
  ADD CONSTRAINT `fk_contact_requests_admin` FOREIGN KEY (`handled_by_admin_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `inventory_alerts`
--
ALTER TABLE `inventory_alerts`
  ADD CONSTRAINT `fk_inventory_alert_ack_admin` FOREIGN KEY (`acknowledged_by_admin_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `fk_inventory_alert_variant` FOREIGN KEY (`variant_id`) REFERENCES `product_variants` (`variant_id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `fk_order_items_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_order_items_variant` FOREIGN KEY (`variant_id`) REFERENCES `product_variants` (`variant_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE RESTRICT;

--
-- Constraints for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD CONSTRAINT `fk_variants_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `product_variant_attributes`
--
ALTER TABLE `product_variant_attributes`
  ADD CONSTRAINT `fk_pva_attribute` FOREIGN KEY (`attribute_id`) REFERENCES `padel_attributes` (`attribute_id`),
  ADD CONSTRAINT `fk_pva_variant` FOREIGN KEY (`variant_id`) REFERENCES `product_variants` (`variant_id`) ON DELETE CASCADE;

--
-- Constraints for table `restock_items`
--
ALTER TABLE `restock_items`
  ADD CONSTRAINT `fk_restock_items_restock` FOREIGN KEY (`restock_id`) REFERENCES `restock_orders` (`restock_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_restock_items_variant` FOREIGN KEY (`variant_id`) REFERENCES `product_variants` (`variant_id`);

--
-- Constraints for table `restock_orders`
--
ALTER TABLE `restock_orders`
  ADD CONSTRAINT `fk_restock_orders_admin` FOREIGN KEY (`created_by_admin_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `returns`
--
ALTER TABLE `returns`
  ADD CONSTRAINT `fk_returns_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_returns_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `return_items`
--
ALTER TABLE `return_items`
  ADD CONSTRAINT `fk_return_items_order_item` FOREIGN KEY (`order_item_id`) REFERENCES `order_items` (`order_item_id`),
  ADD CONSTRAINT `fk_return_items_return` FOREIGN KEY (`return_id`) REFERENCES `returns` (`return_id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `fk_reviews_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_reviews_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `shipments`
--
ALTER TABLE `shipments`
  ADD CONSTRAINT `fk_shipments_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE;

--
-- Constraints for table `stock_ledger`
--
ALTER TABLE `stock_ledger`
  ADD CONSTRAINT `fk_stock_ledger_variant` FOREIGN KEY (`variant_id`) REFERENCES `product_variants` (`variant_id`);

--
-- Constraints for table `stock_levels`
--
ALTER TABLE `stock_levels`
  ADD CONSTRAINT `fk_stock_levels_variant` FOREIGN KEY (`variant_id`) REFERENCES `product_variants` (`variant_id`) ON DELETE CASCADE;

--
-- Constraints for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `fk_user_roles_role` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_user_roles_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
