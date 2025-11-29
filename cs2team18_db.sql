-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 29, 2025 at 07:34 PM
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
('352893d0-cd3f-11f0-982a-005056b707be', 'Coaching & Services', 'coaching-services', 'Padel coaching lessons and services', 1, '2025-11-29 16:19:40');

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
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `category_id`, `name`, `slug`, `description`, `image_url`, `base_price`, `is_active`, `created_at`, `updated_at`) VALUES
('650e3d6b-cd3f-11f0-982a-005056b707be', '352883ba-cd3f-11f0-982a-005056b707be', 'ViboraUK Venom Pro Padel Racket', 'viborauk-venom-pro-padel-racket', 'Advanced-level racket with teardrop shape and medium balance.', '/images/products/rackets/venom-pro.jpg', '199.99', 1, '2025-11-29 16:21:01', '2025-11-29 16:21:01'),
('650f7cec-cd3f-11f0-982a-005056b707be', '352883ba-cd3f-11f0-982a-005056b707be', 'ViboraUK Strike Control Padel Racket', 'viborauk-strike-control-padel-racket', 'Control-oriented round-shaped racket ideal for intermediate players.', '/images/products/rackets/strike-control.jpg', '159.99', 1, '2025-11-29 16:21:01', '2025-11-29 16:21:01'),
('78bbde7a-cd3f-11f0-982a-005056b707be', '352893d0-cd3f-11f0-982a-005056b707be', '1-to-1 Padel Coaching Session', '1-to-1-padel-coaching-session', 'Personal coaching session with a ViboraUK certified coach.', '/images/products/coaching/1-to-1-session.jpg', '40.00', 1, '2025-11-29 16:21:34', '2025-11-29 16:21:34');

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
