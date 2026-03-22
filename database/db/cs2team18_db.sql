-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 22, 2026 at 10:08 PM
-- Server version: 8.0.45-0ubuntu0.22.04.1
-- PHP Version: 8.3.30

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
  `address_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT (uuid()),
  `user_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `line1` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `line2` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci,
  `city` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `postcode` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `country` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `cart_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT (uuid()),
  `user_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`cart_id`, `user_id`, `created_at`, `updated_at`) VALUES
('26e6ad43-d1dd-11f0-a24b-005056b707be', 'fa27a8ef-d115-11f0-a24b-005056b707be', '2025-12-05 13:20:21', '2025-12-05 13:20:21'),
('45b95e59-d1da-11f0-a24b-005056b707be', 'f7ed5451-d1d9-11f0-a24b-005056b707be', '2025-12-05 12:59:45', '2025-12-05 12:59:45');

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `cart_item_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT (uuid()),
  `cart_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `product_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `quantity` int NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `line_total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT (uuid()),
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci,
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
('e6660501-cf7e-11f0-a24b-005056b707be', 'T-Shirts', 't-shirts', 'High-quality padel apparel including performance T-shirts for training and matches.', 1, '2025-12-02 13:00:38'),
('e6660920-cf7e-11f0-a24b-005056b707be', 'Balls', 'balls', 'Premium padel balls designed for training and professional play.', 1, '2025-12-02 13:00:38'),
('e6660a4e-cf7e-11f0-a24b-005056b707be', 'Shoes', 'shoes', 'Professional padel shoes engineered for grip, stability, and performance on court.', 1, '2025-12-02 13:00:38'),
('e6660af2-cf7e-11f0-a24b-005056b707be', 'Bags', 'bags', 'Durable padel bags designed to carry and protect rackets, gear, and accessories.', 1, '2025-12-02 13:00:38');

-- --------------------------------------------------------

--
-- Table structure for table `contact_requests`
--

CREATE TABLE `contact_requests` (
  `contact_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT (uuid()),
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `email` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `subject` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `handled_by_admin_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `status` enum('open','in_progress','closed') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'open'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `enquiries`
--

CREATE TABLE `enquiries` (
  `enquiry_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `enquiries`
--

INSERT INTO `enquiries` (`enquiry_id`, `email`, `message`, `created_at`) VALUES
('f3209468-a449-4cf2-b90d-200b426ee5a6', 'ajaysangha1@gmail.com', 'This is a test', '2025-12-04 22:49:02');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_alerts`
--

CREATE TABLE `inventory_alerts` (
  `alert_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT (uuid()),
  `variant_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `alert_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `triggered_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `acknowledged_by_admin_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `acknowledged_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT (uuid()),
  `user_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `order_number` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'pending',
  `subtotal` decimal(10,2) NOT NULL DEFAULT '0.00',
  `discount_total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `tax_total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `shipping_total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `grand_total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `placed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `order_number`, `status`, `subtotal`, `discount_total`, `tax_total`, `shipping_total`, `grand_total`, `placed_at`) VALUES
('0f62362f-d1de-11f0-a24b-005056b707be', 'fa27a8ef-d115-11f0-a24b-005056b707be', 'ORD-1764941212168', 'paid', '2529.89', '0.00', '505.98', '0.00', '3035.87', '2025-12-05 13:26:51'),
('c265d846-d1de-11f0-a24b-005056b707be', 'fa27a8ef-d115-11f0-a24b-005056b707be', 'ORD-1764941512504', 'paid', '2779.88', '0.00', '555.98', '0.00', '3335.86', '2025-12-05 13:31:52'),
('cecd84c1-d1dd-11f0-a24b-005056b707be', 'fa27a8ef-d115-11f0-a24b-005056b707be', 'ORD-1764941103821', 'paid', '2249.91', '224.99', '404.98', '0.00', '2429.90', '2025-12-05 13:25:03');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT (uuid()),
  `order_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `variant_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `quantity` int NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `line_total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `padel_attributes`
--

CREATE TABLE `padel_attributes` (
  `attribute_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT (uuid()),
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL
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
  `product_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT (uuid()),
  `category_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `brand` varchar(100) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `gender` varchar(20) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `shape` varchar(30) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `colour` varchar(50) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci,
  `image_url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci,
  `base_price` decimal(10,2) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `product_url` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `category_id`, `brand`, `gender`, `shape`, `colour`, `name`, `slug`, `description`, `image_url`, `base_price`, `is_active`, `created_at`, `updated_at`, `product_url`) VALUES
('33de1609-cf7e-11f0-a24b-005056b707be', '352883ba-cd3f-11f0-982a-005056b707be', 'Babolat', NULL, 'Hybrid', 'Green', 'Babolat X Lamborghini BL002 Scandal Green', 'babolat-x-lamborghini-bl002-scandal-green', 'Babolat X Lamborghini BL002 Scandal Green, a premium collaboration racket with aggressive aesthetics and high-performance construction for players who demand the best.', 'images/products/rackets/babolat-x-lamborghini-bl002-scandal-green.jpg', '249.99', 1, '2025-12-02 12:55:39', '2026-03-20 16:11:25', 'https://www.padelnuestro.com/uk/babolat-x-lamborghini-bl002-scandal-green'),
('3a281d9f-cf7f-11f0-a24b-005056b707be', 'e6660501-cf7e-11f0-a24b-005056b707be', 'Bullpadel', 'Women', NULL, 'Blue', 'T-Shirt Bullpadel Batea Woman', 't-shirt-bullpadel-batea-woman', 'Bullpadel Batea women\'s T-shirt with a feminine fit and soft, quick-dry fabric, perfect for both matches and training sessions.', 'T-SHIRT BULLPADEL BATEA WOMAN.jpg', '34.99', 1, '2025-12-02 13:02:59', '2026-03-22 17:32:32', 'https://www.padelnuestro.com/uk/t-shirt-bullpadel-batea-woman'),
('3a281e9b-cf7f-11f0-a24b-005056b707be', 'e6660501-cf7e-11f0-a24b-005056b707be', 'Bullpadel', 'Women', NULL, 'Green', 'T-Shirt Bullpadel Gemma 25V Woman', 't-shirt-bullpadel-gemma-25v-woman', 'Bullpadel Gemma 25V women\'s T-shirt inspired by Gemma Triay, offering an athletic cut, lightweight fabric and stylish design for competitive padel players.', 't-shirt-bullpadel-gemma-25v-water-green.jpg', '34.99', 1, '2025-12-02 13:02:59', '2026-03-22 17:33:09', 'https://www.padelnuestro.com/uk/t-shirt-bullpadel-gemma-25v-woman'),
('4c5a0fb8-cf7f-11f0-a24b-005056b707be', 'e6660920-cf7e-11f0-a24b-005056b707be', 'Wilson', NULL, NULL, NULL, 'Wilson Premier Padel Balls Canister', 'wilson-premier-padel-balls', 'Wilson Premier padel balls supplied in a pressurised canister, designed for official circuits with excellent visibility, feel and long-lasting performance.', 'WILSON PREMIER PADEL BALLS CANISTER.jpg', '8.99', 1, '2025-12-02 13:03:29', '2026-03-20 16:42:00', 'https://www.padelnuestro.com/uk/wilson-premier-padel-balls-canister-113567-p'),
('4c5a1220-cf7f-11f0-a24b-005056b707be', 'e6660920-cf7e-11f0-a24b-005056b707be', 'Bullpadel', NULL, NULL, NULL, 'Bullpadel Premium Pro Boat', 'bullpadel-premium-pro-boat', 'Bullpadel Premium Pro balls, ideal for competition and high-level training, with a consistent flight and extra-durable felt for extended play.', 'BULLPADEL PREMIUM PRO BOAT.jpg', '7.99', 1, '2025-12-02 13:03:29', '2026-03-20 16:42:20', 'https://www.padelnuestro.com/uk/bullpadel-premium-pro-boat-4151-p'),
('4c5a1330-cf7f-11f0-a24b-005056b707be', 'e6660920-cf7e-11f0-a24b-005056b707be', 'Bullpadel', NULL, NULL, NULL, 'Bullpadel Train Ball Jar 465464', 'bullpadel-train-ball-465464', 'Bullpadel Train Ball Jar 465464, developed specifically for coaching and practice, offering reliable bounce and durability for intensive use on court.', 'BULLPADEL TRAIN BALL JAR 465464.jpg', '5.99', 1, '2025-12-02 13:03:29', '2026-03-20 16:42:36', 'https://www.padelnuestro.com/uk/bullpadel-train-ball-jar-465464-108760-p'),
('536c00bf-2188-11f1-b595-005056b707be', '352893d0-cd3f-11f0-982a-005056b707be', NULL, NULL, NULL, NULL, 'Group Padel Coaching Session', 'group-padel-coaching-session', 'Group padel coaching session with a certified coach. Ideal for group training with structured guidance.', '/images/products/coaching/group-coaching-session.jpg', '25.00', 1, '2026-03-16 22:34:42', '2026-03-16 22:45:29', NULL),
('5c4d1dfb-cf7f-11f0-a24b-005056b707be', 'e6660a4e-cf7e-11f0-a24b-005056b707be', 'Bullpadel', NULL, NULL, 'Orange', 'Bullpadel Neuron Vibram 25V Clay', 'bullpadel-neuron-vibram-25v-clay', 'Bullpadel Neuron Vibram 25V Clay shoes featuring Vibram outsole for exceptional grip on clay and padel surfaces, with reinforced upper for stability and protection during aggressive movements.', 'TRAINERS BULLPADEL NEURON VIBRAM 25V CLAY.jpg', '99.99', 1, '2025-12-02 13:03:56', '2026-03-20 16:47:38', 'https://www.bullpadel.com/gb/man/4893-16336-trainers-bullpadel-neuron-vibram-25v-clay.html'),
('5c4d226a-cf7f-11f0-a24b-005056b707be', 'e6660a4e-cf7e-11f0-a24b-005056b707be', 'Bullpadel', NULL, NULL, 'Blue', 'Bullpadel Hybrid Fly 25I Steel Blue', 'bullpadel-hybrid-fly-25i-steel-blue', 'Bullpadel Hybrid Fly 25I in steel blue, a lightweight, responsive shoe with excellent cushioning and lateral support for fast, explosive padel play.', 'trainers-bullpadel-hybrid-fly-25i-steel-blue-154344606.jpg', '109.99', 1, '2025-12-02 13:03:56', '2026-03-22 17:18:39', 'https://www.bullpadel.com/gb/man/5561-19285-trainers-bullpadel-hybrid-fly-25i-steel-blue.html'),
('5c4d23b4-cf7f-11f0-a24b-005056b707be', 'e6660a4e-cf7e-11f0-a24b-005056b707be', 'Bullpadel', NULL, NULL, 'Yellow', 'Bullpadel Vertex Vibram 25V Yellow', 'bullpadel-vertex-vibram-25v-yellow', 'Bullpadel Vertex Vibram 25V Yellow shoes equipped with Vibram outsole and reinforced toe, giving maximum traction and durability for advanced tournament players.', 'trainers-bullpadel-vertex-vibram-25v-yellow-1522073331.jpg', '119.99', 1, '2025-12-02 13:03:56', '2026-03-22 17:18:55', 'https://www.bullpadel.com/gb/man/4839-16235-trainers-bullpadel-vertex-vibram-25v-yellow.html'),
('5c4d24c0-cf7f-11f0-a24b-005056b707be', 'e6660a4e-cf7e-11f0-a24b-005056b707be', 'Bullpadel', NULL, NULL, 'White', 'Bullpadel Premier P1 White', 'bullpadel-premier-p1-white', 'Bullpadel Premier P1 white shoes combining low-profile cushioning, breathable mesh and strong lateral support for comfortable, stable movement on court.', 'trainers-bullpadel-premier-p1-white-687461239.jpg', '89.99', 1, '2025-12-02 13:03:56', '2026-03-22 17:18:22', 'https://www.bullpadel.com/gb/man/4591-15718-trainers-bullpadel-premier-p1-white.html'),
('5c4d25ea-cf7f-11f0-a24b-005056b707be', 'e6660a4e-cf7e-11f0-a24b-005056b707be', 'Babolat', 'Men', NULL, 'Orange', 'Babolat Jet Mach 3 All Court Blue/Orange Men 30523629', 'babolat-jet-mach-3-blue-orange', 'Babolat Jet Mach 3 All Court Blue/Orange padel and tennis shoes, designed with a lightweight chassis and durable outsole for explosive acceleration and quick changes of direction.', 'BABOLAT JET MACH 3 ALL COURT BLUE ORANGE MEN.jpg', '129.99', 1, '2025-12-02 13:03:56', '2026-03-20 16:49:04', 'https://www.padelnuestro.com/uk/babolat-jet-mach-3-all-court-blue-orange-men-30523629'),
('5c4d26e9-cf7f-11f0-a24b-005056b707be', 'e6660a4e-cf7e-11f0-a24b-005056b707be', 'K-Swiss', NULL, NULL, 'White', 'K-Swiss Hypercourt Supreme 2 White 09071102', 'kswiss-hypercourt-supreme-2-white', 'K-Swiss Hypercourt Supreme 2 White offers plush cushioning, wide platform stability and a grippy outsole, ideal for players who demand comfort over long matches.', 'KSWISS HYPERCOURT SUPREME 2 WHITE 09071102.jpg', '119.99', 1, '2025-12-02 13:03:56', '2026-03-20 16:49:56', 'https://www.padelnuestro.com/uk/kswiss-hypercourt-supreme-2-white-09071102'),
('5c4d283b-cf7f-11f0-a24b-005056b707be', 'e6660a4e-cf7e-11f0-a24b-005056b707be', 'Joma', 'Men', NULL, 'Yellow', 'Joma Master 1000 Men 25 Clay Fluorescent Yellow TM100S2599CC', 'joma-master-1000-men-yellow', 'Joma Master 1000 clay shoes in fluorescent yellow, built with a resistant sole pattern for clay and padel courts and cushioning that absorbs impacts on every step.', 'JOMA MASTER 1000 MEN 25 CLAY FLUORESCENT YELLOW.jpg', '69.99', 1, '2025-12-02 13:03:56', '2026-03-20 16:50:08', 'https://www.padelnuestro.com/uk/joma-master-1000-men-25-clay-fluorescent-yellow-tm100s2599cc'),
('5c4d2b8c-cf7f-11f0-a24b-005056b707be', 'e6660a4e-cf7e-11f0-a24b-005056b707be', 'Wilson', NULL, NULL, 'White', 'Wilson Rush Pro 4.5 White/Blue', 'wilson-rush-pro-45-white-blue', 'Wilson Rush Pro 4.5 shoes in white and blue, providing explosive propulsion, strong heel stability and a durable outsole engineered for padel and tennis courts.', 'wilson-rush-pro-4-5-white-blue.jpeg', '109.99', 1, '2025-12-02 13:03:56', '2026-03-22 17:19:26', 'https://www.padelnuestro.com/uk/wilson-rush-pro-4-5-white-blue'),
('67e5789d-cf7f-11f0-a24b-005056b707be', 'e6660af2-cf7e-11f0-a24b-005056b707be', 'Y1', NULL, NULL, NULL, 'Padel Core Carry Case', 'padel-core-carry-case', 'Durable carry case designed specifically for padel, with padded racket compartment and additional space for balls, towel and small accessories. Ideal for everyday training or matches.', 'Padel Core Carry Case.JPG', '49.99', 1, '2025-12-02 13:04:15', '2026-03-22 17:04:09', 'https://y1sport.com/products/padel-core-carry-case-copy'),
('67e57d21-cf7f-11f0-a24b-005056b707be', 'e6660af2-cf7e-11f0-a24b-005056b707be', 'Bullpadel', NULL, NULL, 'Green', 'Bullpadel BPP26013 Hack Racket Bag Grey-Green', 'bullpadel-bpp26013-hack-bag', 'Large Bullpadel Hack racket bag with multiple compartments for rackets, clothing and accessories, plus reinforced straps for comfortable transport to and from the club.', 'Bullpadel BPP26013 Hack Bag.jpg', '59.99', 1, '2025-12-02 13:04:15', '2026-03-22 17:04:30', 'https://www.bullpadel.com/gb/racket-bags/5745-paletero-bullpadel-bpp26013-hack-gris-verdoso.html'),
('67e57e8e-cf7f-11f0-a24b-005056b707be', 'e6660af2-cf7e-11f0-a24b-005056b707be', 'Bullpadel', NULL, NULL, 'Blue', 'Bullpadel BPP26021 Pearl Racket Bag Greenish Blue', 'bullpadel-bpp26021-pearl-bag', 'Bullpadel Pearl racket bag in greenish blue, featuring separate sections for rackets, clothes and footwear, perfect for players who travel frequently to tournaments and training sessions.', 'Bullpadel BPP26021 Pearl Bag.jpg', '59.99', 1, '2025-12-02 13:04:15', '2026-03-22 17:04:52', 'https://www.bullpadel.com/gb/bea-gonzalez/5626-racket-bag-bullpadel-bpp26021-pearl-greenish-blue.html'),
('67e57fcc-cf7f-11f0-a24b-005056b707be', 'e6660af2-cf7e-11f0-a24b-005056b707be', 'Bullpadel', NULL, NULL, 'Red', 'Bullpadel BPP25022 Xplo Red Racket Bag', 'bullpadel-bpp25022-xplo-bag', 'Compact Bullpadel BPP25022 Xplo red racket bag with enough space for several rackets and basic gear, ideal for players who want a light and easy-to-carry option.', 'Bullpadel BPP25022 Xplo Red Bag.jpg', '49.99', 1, '2025-12-02 13:04:15', '2026-03-22 17:05:15', 'https://www.bullpadel.com/gb/racket-bags/4984-rackets-bag-bullpadel-bpp25022-xplo-red.html'),
('67e58114-cf7f-11f0-a24b-005056b707be', 'e6660af2-cf7e-11f0-a24b-005056b707be', 'Bullpadel', NULL, NULL, 'Green', 'Bullpadel BPP25015 Tour Greenish Blue Bag', 'bullpadel-bpp25015-tour-bag', 'Versatile Bullpadel BPP25015 Tour racket bag in greenish blue, offering multiple compartments to organise rackets, clothing, shoes and accessories for both training and competition.', 'Bullpadel BPP25015 Tour Greenish Blue Bag.jpg', '49.99', 1, '2025-12-02 13:04:15', '2026-03-22 17:01:28', 'https://www.bullpadel.com/gb/racket-bags/4980-bolsa-bullpadel-bpp25015-tour-verde-azulado.html'),
('67e58211-cf7f-11f0-a24b-005056b707be', 'e6660af2-cf7e-11f0-a24b-005056b707be', 'Varlion', NULL, NULL, 'Green', 'Lime Green Varlion Summum Padel Bag', 'varlion-summum-lime-green-bag', 'Varlion Summum padel bag in lime green with spacious central compartment, separate racket area and additional pockets, perfect for players who carry a full set of equipment to the court.', 'lime-green-varlion-summum-padel-bag-3338933439.jpg', '69.99', 1, '2025-12-02 13:04:15', '2026-03-22 17:03:28', 'https://www.padelnuestro.com/uk/lime-green-varlion-summum-padel-bag-29217-p'),
('7781f3c8-2188-11f1-b595-005056b707be', '352893d0-cd3f-11f0-982a-005056b707be', NULL, NULL, NULL, NULL, 'Padel Court Booking', 'padel-court-booking', 'Book a padel court for matches, training, or casual play. Choose from 60, 90, or 120 minute slots.', '/images/products/coaching/court-booking.jpg', '20.00', 1, '2026-03-16 22:35:42', '2026-03-16 22:45:29', NULL),
('78bbde7a-cd3f-11f0-982a-005056b707be', '352893d0-cd3f-11f0-982a-005056b707be', NULL, NULL, NULL, NULL, '1-to-1 Padel Coaching Session', '1-to-1-padel-coaching-session', 'Personal 1-to-1 padel coaching session with a certified coach. Choose your preferred session length.', '/images/products/coaching/1-to-1-session.jpg', '40.00', 1, '2025-11-29 16:21:34', '2026-03-16 22:45:29', NULL),
('ac601922-d12f-11f0-a24b-005056b707be', '352883ba-cd3f-11f0-982a-005056b707be', 'Y1', NULL, 'Diamond', 'Green', 'Mirage 25 Padel Racket', 'mirage-25-padel-racket', 'Mirage 25 padel racket from Y1Sport, designed for intermediate to advanced players who want a balanced mix of power and control in a manoeuvrable frame.', '/images/products/rackets/Mirage 25 Padel Racket.JPG', '119.99', 1, '2025-12-04 16:38:33', '2026-03-22 16:54:55', 'https://y1sport.com/products/padel-mirage-25'),
('ac601e4f-d12f-11f0-a24b-005056b707be', '352883ba-cd3f-11f0-982a-005056b707be', 'Y1', NULL, 'Diamond', 'Black', 'Panna 25 Padel Racket', 'panna-25-padel-racket', 'Panna 25 padel racket from Y1Sport, offering easy handling and a forgiving sweet spot, ideal for players who prioritise control without losing power.', '/images/products/rackets/Panna TF Padel Racket.jpg', '99.99', 1, '2025-12-04 16:38:33', '2026-03-20 15:42:11', 'https://y1sport.com/products/padel-panna-25'),
('ac6021c2-d12f-11f0-a24b-005056b707be', '352883ba-cd3f-11f0-982a-005056b707be', 'Y1', NULL, 'Diamond', 'Gold', 'Pro X 25 Padel Racket', 'pro-x-25-padel-racket', 'Pro X 25 padel racket from Y1Sport, a more aggressive model with a powerful response and precise feel for attacking players who dominate at the net.', '/images/products/rackets/pro-x-25-padel-racket.jpeg', '179.99', 1, '2025-12-04 16:38:33', '2026-03-20 15:41:47', 'https://y1sport.com/products/padel-pro-x-25'),
('ac6022ee-d12f-11f0-a24b-005056b707be', '352883ba-cd3f-11f0-982a-005056b707be', 'Y1', NULL, 'Round', 'Pink', 'Arlo 25 Padel Racket', 'arlo-25-padel-racket', 'Arlo 25 padel racket from Y1Sport, built for all-round performance with a comfortable feel, great control and enough power for confident finishing shots.', '/images/products/rackets/Babolat-Air-Vertuo-Padel-Racket-2025.png', '99.99', 1, '2025-12-04 16:38:33', '2026-03-20 15:40:56', 'https://y1sport.com/products/padel-arlo-25'),
('ac602414-d12f-11f0-a24b-005056b707be', '352883ba-cd3f-11f0-982a-005056b707be', 'Bullpadel', NULL, 'Diamond', 'Purple', 'Bullpadel Vertex 04 25', 'bullpadel-vertex-04-25', 'Bullpadel Vertex 04 2025 professional racket with diamond shape and high balance, delivering maximum power for advanced players who like to finish points quickly.', '/images/products/rackets/pala-bullpadel-vertex-04-25.jpg', '169.99', 1, '2025-12-04 16:38:33', '2026-03-20 15:39:44', 'https://www.bullpadel.com/gb/proline/4547-pala-bullpadel-vertex-04-25.html'),
('ac602534-d12f-11f0-a24b-005056b707be', '352883ba-cd3f-11f0-982a-005056b707be', 'Bullpadel', NULL, 'Diamond', 'Brown', 'Bullpadel Vertex 04 MX 24', 'bullpadel-vertex-04-mx-24', 'Limited-edition Bullpadel Vertex 04 MX 24, combining premium materials and an aggressive profile for players seeking explosive power and a distinctive look.', '/images/products/rackets/RACKET BULLPADEL VERTEX 04 MX 24.jpg', '199.99', 1, '2025-12-04 16:38:33', '2026-03-20 15:30:11', 'https://www.bullpadel.com/gb/ltd-collection/3790-racket-bullpadel-vertex-04-mx-24.html'),
('ac602649-d12f-11f0-a24b-005056b707be', '352883ba-cd3f-11f0-982a-005056b707be', 'Bullpadel', NULL, 'Diamond', 'White', 'Bullpadel Pearl 25', 'bullpadel-pearl-25', 'Bullpadel Pearl 25 racket designed for versatile players, offering a comfortable touch, wide sweet spot and easy access to both control and power.', '/images/products/rackets/racket-bullpadel-pearl-25.jpg', '149.99', 1, '2025-12-04 16:38:33', '2026-03-20 15:27:00', 'https://www.bullpadel.com/gb/proline/4552-racket-bullpadel-pearl-25.html'),
('ac602749-d12f-11f0-a24b-005056b707be', '352883ba-cd3f-11f0-982a-005056b707be', 'Bullpadel', NULL, 'Diamond', 'Black', 'Bullpadel Vertex JR 25', 'bullpadel-vertex-jr-25', 'Bullpadel Vertex JR 25 junior racket, inspired by the adult Vertex line but with a lighter construction that helps young players develop proper technique.', '/images/products/rackets/bullpadel-vertex-jr-25.jpeg', '89.99', 1, '2025-12-04 16:38:33', '2026-03-20 15:55:24', 'https://www.bullpadel.com/gb/junior/4920-racket-bullpadel-vertex-jr-25.html'),
('ac602889-d12f-11f0-a24b-005056b707be', '352883ba-cd3f-11f0-982a-005056b707be', 'NOX', NULL, 'Teardrop', 'Black', 'Nox AT10 Genius 18K Alum 2026', 'nox-at10-genius-18k-alum-2026', 'Nox AT10 Genius 18K Alum 2026, signature racket of Agustin Tapia, built with 18K carbon and advanced core for exceptional power, spin and precision.', '/images/products/rackets/nox-at10-genius-18k-alum-2026.jpeg', '179.99', 1, '2025-12-04 16:38:33', '2026-03-20 15:57:47', 'https://www.padelnuestro.com/uk/nox-at10-genius-18k-alum-by-agustin-tapia-2026'),
('ac602bac-d12f-11f0-a24b-005056b707be', '352883ba-cd3f-11f0-982a-005056b707be', 'NOX', NULL, 'Round', 'White', 'Nox X-One Casual Series 23', 'nox-x-one-casual-series-23', 'Nox X-One Casual Series 23, an easy-to-play padel racket that combines comfort and control, perfect for improving players who want a quality feel at a good price.', '/images/products/rackets/nox-x-one-casual-series-23.jpeg', '99.99', 1, '2025-12-04 16:38:33', '2026-03-20 15:58:15', 'https://www.padelnuestro.com/uk/nox-x-one-casual-series-23-31592-p'),
('ac603612-d12f-11f0-a24b-005056b707be', '352883ba-cd3f-11f0-982a-005056b707be', 'Head', NULL, 'Teardrop', 'Blue', 'Head Evo Extreme 2025', 'head-evo-extreme-2025', 'HEAD Evo Extreme 2025 padel racket with a comfortable soft feel and enlarged sweet spot, ideal for beginners and intermediate players wanting confidence on every shot.', 'images/products/rackets/head-evo-extreme-2025.jpg', '129.99', 1, '2025-12-04 16:38:33', '2026-03-20 16:09:58', 'https://www.padelnuestro.com/uk/head-evo-extreme-2025'),
('ac603906-d12f-11f0-a24b-005056b707be', '352883ba-cd3f-11f0-982a-005056b707be', 'Head', NULL, 'Teardrop', 'Copper', 'Head Speed Motion 2025', 'head-speed-motion-2025', 'HEAD Speed Motion 2025, a lightweight and highly manoeuvrable racket used on tour, offering fast swing speed and excellent blend of power and control.', '/images/products/rackets/head-speed-motion-2025.jpeg', '159.99', 1, '2025-12-04 16:38:33', '2026-03-20 16:09:09', 'https://www.padelnuestro.com/uk/head-speed-motion-2025'),
('ac603b52-d12f-11f0-a24b-005056b707be', '352883ba-cd3f-11f0-982a-005056b707be', 'Babolat', NULL, 'Teardrop', 'Blue', 'Babolat Air Origin', 'babolat-air-origin', 'Babolat Air Origin racket focused on speed and manoeuvrability, allowing quick reactions at the net while still providing plenty of power from the back of the court.', 'images/products/rackets/babolat-air-origin.jpg', '139.99', 1, '2025-12-04 16:38:33', '2026-03-20 15:27:16', 'https://www.padelnuestro.com/uk/babolat-air-origin'),
('d4d75ec4-d12e-11f0-a24b-005056b707be', 'e6660501-cf7e-11f0-a24b-005056b707be', 'Y1', 'Men', NULL, 'Red', 'Short Sleeve Training Top Womens Red', 'sst-womens-red', 'Lightweight short sleeve training top for women in red, made from breathable performance fabric to keep you cool and comfortable during intense padel sessions.', 'Short Sleeve Training Top Womens Red.jpg', '29.99', 1, '2025-12-04 16:32:31', '2026-03-20 16:39:58', 'https://y1sport.com/products/short-sleeve-training-top-womens-red'),
('d4d76400-d12e-11f0-a24b-005056b707be', 'e6660501-cf7e-11f0-a24b-005056b707be', 'Y1', 'Men', NULL, 'Red', 'Short Sleeve Training Top Mens Red', 'sst-mens-red', 'Short sleeve men\'s training top in red, using moisture-wicking material with an athletic cut that allows full freedom of movement on court.', 'Short Sleeve Training Top Mens Red.jpg', '29.99', 1, '2025-12-04 16:32:31', '2026-03-22 17:35:29', 'https://y1sport.com/products/short-sleeve-training-top-mens-red'),
('d4d76640-d12e-11f0-a24b-005056b707be', 'e6660501-cf7e-11f0-a24b-005056b707be', 'Y1', 'Men', NULL, 'Blue', 'Short Sleeve Training Top Mens Navy', 'sst-mens-navy', 'Men\'s navy short sleeve training top crafted from soft, quick-dry fabric, ideal for regular padel practice or gym workouts.', 'Short Sleeve Training Top Mens Navy.jpg', '29.99', 1, '2025-12-04 16:32:31', '2026-03-22 17:35:55', 'https://y1sport.com/products/short-sleeve-training-top-mens-navy'),
('d4d7aeeb-d12e-11f0-a24b-005056b707be', 'e6660501-cf7e-11f0-a24b-005056b707be', 'Y1', 'Women', NULL, 'Blue', 'Short Sleeve Training Top Womens Navy', 'sst-womens-navy', 'Women\'s navy training top with short sleeves and a flattering athletic fit, designed to combine comfort, style and performance on court.', 'Short Sleeve Training Top Womens Navy.jpg', '29.99', 1, '2025-12-04 16:32:31', '2026-03-20 16:32:28', 'https://y1sport.com/products/short-sleeve-training-top-womens-navy'),
('d4d7b041-d12e-11f0-a24b-005056b707be', 'e6660501-cf7e-11f0-a24b-005056b707be', 'Y1', 'Men', NULL, 'Black', 'Short Sleeve Training Top Mens Black', 'sst-mens-black', 'Black short sleeve training top for men, built with breathable stretch fabric that manages sweat and moves with you through every shot.', 'Short Sleeve Training Top Mens Black.jpg', '29.99', 1, '2025-12-04 16:32:31', '2026-03-22 17:36:29', 'https://y1sport.com/products/short-sleeve-training-top-mens-black'),
('d4d7b162-d12e-11f0-a24b-005056b707be', 'e6660501-cf7e-11f0-a24b-005056b707be', 'Y1', 'Men', NULL, 'White', 'Short Sleeve Training Top Mens White', 'sst-mens-white', 'Classic white men\'s training top in a lightweight, quick-dry fabric that makes it perfect for padel matches, fitness sessions or casual wear.', 'Short Sleeve Training Top Mens White.jpg', '29.99', 1, '2025-12-04 16:32:31', '2026-03-22 17:36:46', 'https://y1sport.com/products/short-sleeve-training-top-mens-white'),
('d4d7b265-d12e-11f0-a24b-005056b707be', 'e6660501-cf7e-11f0-a24b-005056b707be', 'Bullpadel', 'Men', NULL, 'White', 'T-Shirt Bullpadel Paquito 25I White', 'bp-paquito-25i', 'Official Bullpadel Paquito Navarro 25I match T-shirt in white, featuring high-performance fabric and the signature style of one of the world’s top padel players.', 'T-SHIRT BULLPADEL PAQUITO 25I WHITE.jpg', '34.99', 1, '2025-12-04 16:32:31', '2026-03-20 16:33:20', 'https://www.bullpadel.com/gb/official-t-shirts/5470-18711-t-shirt-bullpadel-paquito-25i-white.html'),
('d4d7b3ae-d12e-11f0-a24b-005056b707be', 'e6660501-cf7e-11f0-a24b-005056b707be', 'Bullpadel', 'Men', NULL, 'Grey', 'T-Shirt Bullpadel Chingotto 25I Stone', 'bp-chingotto-25i', 'Official Bullpadel Chingotto 25I T-shirt in stone colour, designed with breathable materials and the look worn by professional player Fede Chingotto.', 'T-Shirt Bullpadel Chingotto 25I Stone.jpg', '34.99', 1, '2025-12-04 16:32:31', '2026-03-22 17:37:06', 'https://www.bullpadel.com/gb/official-t-shirts/5439-18571-t-shirt-bullpadel-chingotto-25i-stone.html'),
('d4d7b4a9-d12e-11f0-a24b-005056b707be', 'e6660501-cf7e-11f0-a24b-005056b707be', 'Bullpadel', 'Men', NULL, 'Red', 'T-Shirt Bullpadel Di Nenno 25I Hybiscus', 'bp-dinenno-25i', 'Official Bullpadel Di Nenno 25I T-shirt in hibiscus, made from lightweight technical fabric and inspired by the on-court style of Franco Stupaczuk’s partner Martín Di Nenno.', 'T-Shirt Bullpadel Di Nenno 25I Hybiscus.jpg', '34.99', 1, '2025-12-04 16:32:31', '2026-03-20 16:35:14', 'https://www.bullpadel.com/gb/official-t-shirts/5460-18676-t-shirt-bullpadel-di-nenno-25i-hybiscus.html'),
('d4d7b5a9-d12e-11f0-a24b-005056b707be', 'e6660501-cf7e-11f0-a24b-005056b707be', 'Bullpadel', 'Men', NULL, 'Blue', 'T-Shirt Bullpadel Tello 25I Blue Green', 'bp-tello-25i', 'Official Bullpadel Tello 25I T-shirt in blue and green, combining striking design with breathable fabric for high-intensity padel play.', 'T-Shirt Bullpadel Tello 25I Blue Green.jpg', '34.99', 1, '2025-12-04 16:32:31', '2026-03-20 16:35:27', 'https://www.bullpadel.com/gb/official-t-shirts/5450-18671-t-shirt-bullpadel-tello-25i-blue-green.html'),
('d4d7b8fe-d12e-11f0-a24b-005056b707be', 'e6660501-cf7e-11f0-a24b-005056b707be', 'NOX', 'Men', NULL, 'Purple', 'T-Shirt Nox Pro 2025', 'nox-pro-2025', 'Nox Pro 2025 performance T-shirt with technical fabric that wicks away sweat, ideal for players who value comfort and a clean, professional look.', 'T-SHIRT NOX PRO 2025.jpg', '34.99', 1, '2025-12-04 16:32:31', '2026-03-20 16:36:31', 'https://www.padelnuestro.com/uk/t-shirt-nox-pro-2025'),
('d4d7ba58-d12e-11f0-a24b-005056b707be', 'e6660501-cf7e-11f0-a24b-005056b707be', 'Lacoste', 'Men', NULL, 'Blue', 'T-Shirt Lacoste TH5195', 'lacoste-th5195', 'Lacoste TH5195 padel T-shirt combining the brand’s classic style with breathable sports fabric, suitable for both on-court performance and casual wear.', 'T-SHIRT LACOSTE TH5195.jpg', '44.99', 1, '2025-12-04 16:32:31', '2026-03-20 16:36:58', 'https://www.padelnuestro.com/uk/t-shirt-lacoste-th5195'),
('e0a64b34-d12e-11f0-a24b-005056b707be', 'e6660920-cf7e-11f0-a24b-005056b707be', 'Babolat', NULL, NULL, NULL, 'Babolat Court Padel X3 Balls Canister', 'babolat-x3', 'Pressurised can of Babolat Court Padel X3 balls, offering consistent bounce and durability for both training sessions and competitive matches.', 'BABOLAT COURT PADEL X3 BALLS CANISTER.jpg', '7.99', 1, '2025-12-04 16:32:51', '2026-03-20 16:41:40', 'https://www.padelnuestro.com/uk/babolat-court-padel-x3-balls-canister-24650-p'),
('e0a65179-d12e-11f0-a24b-005056b707be', 'e6660920-cf7e-11f0-a24b-005056b707be', 'NOX', NULL, NULL, NULL, '3-Ball Can Nox Nerbo', 'nox-nerbo-3ball', 'Nox Nerbo padel balls in a 3-ball can, providing a lively bounce and great control for advanced players who demand precision in every rally.', '3-BALL CAN NOX NERBO.jpg', '6.99', 1, '2025-12-04 16:32:51', '2026-03-20 16:41:14', 'https://www.padelnuestro.com/uk/3-ball-can-nox-nerbo'),
('e75614f4-d12e-11f0-a24b-005056b707be', 'e6660a4e-cf7e-11f0-a24b-005056b707be', 'Wilson', NULL, NULL, 'White', 'Wilson Rush Pro 4.5 White/Blue', 'wilson-rush-pro-45', 'Wilson Rush Pro 4.5 shoes in white and blue, providing explosive propulsion, strong heel stability and a durable outsole engineered for padel and tennis courts.', 'WILSON RUSH PRO 4.5 WHITE BLUE.jpg', '109.99', 1, '2025-12-04 16:33:02', '2026-03-20 16:46:35', 'https://www.padelnuestro.com/uk/wilson-rush-pro-4-5-white-blue');

-- --------------------------------------------------------

--
-- Table structure for table `product_variants`
--

CREATE TABLE `product_variants` (
  `variant_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT (uuid()),
  `product_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `sku` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `variant_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `product_variants`
--

INSERT INTO `product_variants` (`variant_id`, `product_id`, `sku`, `variant_name`, `price`, `is_active`, `created_at`) VALUES
('6650cb06-2188-11f1-b595-005056b707be', '536c00bf-2188-11f1-b595-005056b707be', 'COACH-GROUP-60', 'Group Coaching 60 Minutes', '25.00', 1, '2026-03-16 22:35:14'),
('8450bf27-2188-11f1-b595-005056b707be', '7781f3c8-2188-11f1-b595-005056b707be', 'COURT-60', 'Court Booking 60 Minutes', '20.00', 1, '2026-03-16 22:36:04'),
('8451f117-2188-11f1-b595-005056b707be', '7781f3c8-2188-11f1-b595-005056b707be', 'COURT-90', 'Court Booking 90 Minutes', '30.00', 1, '2026-03-16 22:36:04'),
('84530f63-2188-11f1-b595-005056b707be', '7781f3c8-2188-11f1-b595-005056b707be', 'COURT-120', 'Court Booking 120 Minutes', '40.00', 1, '2026-03-16 22:36:04'),
('f2aec2a8-cd3f-11f0-982a-005056b707be', '78bbde7a-cd3f-11f0-982a-005056b707be', 'COACH-1TO1-60', '1-to-1 Coaching 60 Minutes', '40.00', 1, '2025-11-29 16:24:58'),
('f2b02b11-cd3f-11f0-982a-005056b707be', '78bbde7a-cd3f-11f0-982a-005056b707be', 'COACH-1TO1-90', '1-to-1 Coaching 90 Minutes', '55.00', 1, '2025-11-29 16:24:58');

-- --------------------------------------------------------

--
-- Table structure for table `product_variant_attributes`
--

CREATE TABLE `product_variant_attributes` (
  `variant_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `attribute_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `product_variant_attributes`
--

INSERT INTO `product_variant_attributes` (`variant_id`, `attribute_id`, `value`) VALUES
('f2aec2a8-cd3f-11f0-982a-005056b707be', '40ffe0f4-cd3f-11f0-982a-005056b707be', '60');

-- --------------------------------------------------------

--
-- Table structure for table `restock_items`
--

CREATE TABLE `restock_items` (
  `restock_item_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT (uuid()),
  `restock_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `variant_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `quantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `restock_orders`
--

CREATE TABLE `restock_orders` (
  `restock_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT (uuid()),
  `created_by_admin_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'draft',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `returns`
--

CREATE TABLE `returns` (
  `return_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT (uuid()),
  `order_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `user_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `requested_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'requested',
  `reason` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `return_items`
--

CREATE TABLE `return_items` (
  `return_item_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT (uuid()),
  `return_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `order_item_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `quantity` int NOT NULL,
  `condition_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci,
  `resolution` enum('refund','exchange') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT (uuid()),
  `user_id` char(36) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `product_id` char(36) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `rating` tinyint NOT NULL,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci,
  `body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci,
  `is_verified_purchase` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `user_id`, `product_id`, `rating`, `title`, `body`, `is_verified_purchase`, `created_at`) VALUES
('174d3368-3dda-4432-994e-5339237787f8', NULL, NULL, 5, 'penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis', 'penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis penis', 0, '2026-03-21 20:23:23'),
('3ad9969f-0f27-46fc-9199-ab3a594b4470', NULL, 'ac6022ee-d12f-11f0-a24b-005056b707be', 1, 'z', 'z', 0, '2026-03-20 15:15:02'),
('511a850d-4c30-4cc1-b33d-74d50813cd18', NULL, 'ac602bac-d12f-11f0-a24b-005056b707be', 5, 'penis', 'penis', 0, '2026-03-21 20:20:09'),
('586923fe-986a-412e-a2b8-4ad54074000d', NULL, '4c5a0fb8-cf7f-11f0-a24b-005056b707be', 4, 'Wilson Premier Padel Balls Canister', 'great balls', 0, '2026-03-19 14:48:56'),
('816c8922-24c5-49f9-b156-2fa110ae5b86', NULL, '33de1609-cf7e-11f0-a24b-005056b707be', 1, 'Joseba lies', 'Joseba told me to buy this racket and i got nothing. SCAM ALERT!!!!', 0, '2026-03-21 20:22:07'),
('8319848b-22fb-11f1-8b35-005056b707be', NULL, NULL, 5, 'Amazing shop', 'Really liked the service and products.', 0, '2026-03-18 18:51:45'),
('c804c89c-57ff-412c-b8d0-65cba8214232', NULL, NULL, 5, 'long', 'was really long and pointy. Felt great, but will take time to adjust. Will recomend, for patient users for the ultimate experience!!!', 0, '2026-03-21 20:22:03'),
('cd4bc3fd-3071-479a-b54b-a0314c9073a7', NULL, '4c5a1220-cf7f-11f0-a24b-005056b707be', 1, 'racket', 'terrible quality', 0, '2026-03-19 23:53:22'),
('d5cf864e-2b91-47d3-a6b1-cfd5f909ca88', '54bc6452-0c1a-47b3-a429-f4fdf4ab506a', NULL, 5, 'Test review', 'Really good looking store !', 0, '2026-03-18 19:22:39'),
('e493c181-0dbe-4848-9050-6c6f29a2c8f4', NULL, 'ac602bac-d12f-11f0-a24b-005056b707be', 5, 'penis', 'penis penis penis', 0, '2026-03-21 20:19:14'),
('f17acca4-c87f-4658-8809-ab7df43a81dc', NULL, 'ac602bac-d12f-11f0-a24b-005056b707be', 5, 'penis', 'penis', 0, '2026-03-21 20:20:19');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT (uuid()),
  `role_name` enum('customer','admin') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL
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
  `shipment_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT (uuid()),
  `order_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `carrier` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci,
  `tracking_no` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci,
  `shipped_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'processing'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock_ledger`
--

CREATE TABLE `stock_ledger` (
  `movement_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT (uuid()),
  `variant_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `movement_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `qty_delta` int NOT NULL,
  `reference_type` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci,
  `reference_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock_levels`
--

CREATE TABLE `stock_levels` (
  `variant_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `on_hand` int NOT NULL DEFAULT '0',
  `reserved` int NOT NULL DEFAULT '0',
  `reorder_threshold` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `stock_levels`
--

INSERT INTO `stock_levels` (`variant_id`, `on_hand`, `reserved`, `reorder_threshold`) VALUES
('f2aec2a8-cd3f-11f0-982a-005056b707be', 0, 0, 0),
('f2b02b11-cd3f-11f0-982a-005056b707be', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT (uuid()),
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `password_hash` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `first_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `last_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `phone` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci,
  `profile_picture` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `must_change_password` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `password_hash`, `first_name`, `last_name`, `phone`, `profile_picture`, `must_change_password`, `created_at`, `updated_at`) VALUES
('04d6998f-b387-4e5c-bc9d-c5bb29246d75', 'ahmed2@vibora.com', '$2y$12$unTK7mkNOvUz4eKbONRui.XRXneXvIiEumD6qimZGcwtW6mCAiGVa', 'ahmeda', 'ahmed aa', NULL, 'images/profile_pictures/1773688952_xebec1.jpg', 1, '2026-03-16 16:19:11', '2026-03-16 19:22:32'),
('54bc6452-0c1a-47b3-a429-f4fdf4ab506a', 'ajaysangha14@gmail.com', '$2y$12$1QSm3PpqHlcz25aPj/VxX.wrEGem1jWu8.JQkEqJb9lvrARaBJV7e', 'Ajay', 'Sangha', '07309857660', 'images/profile_pictures/1773688607_Jujutsu_Kaisen.jpg', 1, '2026-03-16 15:49:52', '2026-03-16 19:16:47'),
('6f78ffb6-8ce9-4329-b661-efffa12707f3', 'joseba@test.com', '$2y$12$S.CxX6zHofia95Xe3yWUqeJMW/cFNnSFOWPG5Vog0Tt0ap.OAr0Hq', 'Joseba', 'Bilbao', '0777777777', NULL, 1, '2026-03-22 16:35:46', '2026-03-22 16:35:46'),
('8224bc98-f558-4951-9662-461aa9ecf445', 'ajaysangha12@gmail.com', '$2y$12$q9tZGnufqYRUr0sCJ33mX.x4GBibrcQ.Eod4vsAO.rTu9dOGdLywq', 'Ajay', 'Sangha', '07309857660', NULL, 1, '2026-03-17 15:50:26', '2026-03-17 15:50:26'),
('f5403f50-cd3e-11f0-982a-005056b707be', 'macdonald@viborauk.com', '<HASHED_ADMIN_PASSWORD>', 'Macdonald', 'Admin', '07000000000', NULL, 1, '2025-11-29 16:17:53', '2025-11-29 16:17:53'),
('f5404352-cd3e-11f0-982a-005056b707be', 'customer1@viborauk.com', '<HASHED_CUSTOMER_PASSWORD>', 'Alex', 'Player', '07111111111', NULL, 0, '2025-11-29 16:17:53', '2025-11-29 16:17:53'),
('f68b9344-c72c-4c17-b117-5c7fdad958c4', 'joseba@testing.com', '$2y$12$uhEhnBiUbkVBXrILr/TME.TCXUGRWrYeJvdJYhRJwAw1AQ/fGtrtq', 'Joseba', 'Bilbao', '0777777777', NULL, 1, '2026-03-22 16:37:08', '2026-03-22 16:37:08'),
('f7ed5451-d1d9-11f0-a24b-005056b707be', 'ajaysangha1@gmail.com', '$2b$10$6TereW9aS5ske7V.j/ul9Ofh9Bt122z13hT4gUYCYB97xDKqdu72m', 'Ajay', 'Sangha', '07309857660', NULL, 1, '2025-12-05 12:57:34', '2025-12-05 12:57:34'),
('fa27a8ef-d115-11f0-a24b-005056b707be', 'ajaysangha56@gmail.com', '$2b$10$X.sOYO2BzARGsqREs075I.RcWPTByzrBigAD/LXTv.DZeZmj8gxVq', 'Ajay', 'Sangha', '07309857660', NULL, 1, '2025-12-04 13:34:36', '2025-12-04 13:34:36');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `user_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `role_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`user_id`, `role_id`) VALUES
('f5403f50-cd3e-11f0-982a-005056b707be', '3470626c-cd3e-11f0-982a-005056b707be'),
('f5404352-cd3e-11f0-982a-005056b707be', '3470626c-cd3e-11f0-982a-005056b707be'),
('54bc6452-0c1a-47b3-a429-f4fdf4ab506a', '347065ea-cd3e-11f0-982a-005056b707be'),
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
-- Indexes for table `enquiries`
--
ALTER TABLE `enquiries`
  ADD PRIMARY KEY (`enquiry_id`);

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
  ADD KEY `fk_reviews_product` (`product_id`),
  ADD KEY `idx_reviews_product_id` (`product_id`),
  ADD KEY `idx_reviews_user_id` (`user_id`);

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
  ADD CONSTRAINT `fk_cart_items_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE RESTRICT ON UPDATE CASCADE;

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
