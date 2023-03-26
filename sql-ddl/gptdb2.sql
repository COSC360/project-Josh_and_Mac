-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 26, 2023 at 08:26 PM
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
-- Database: `gptdb2`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `updates` tinyint(1) NOT NULL DEFAULT 0,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `username`, `email`, `password`, `updates`, `is_admin`) VALUES
(1, 'josh', 'josh96753@gmail.com', 'josh123', 1, 1),
(2, 'mac', 'mac@gmail.com', 'mac123', 1, 1),
(3, 'testuser', 'test@gmail.com', 'test123', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `account_basket`
--

CREATE TABLE `account_basket` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `total_basket_items` int(11) DEFAULT NULL,
  `total_basket_price` decimal(9,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `basket_item`
--

CREATE TABLE `basket_item` (
  `id` int(11) NOT NULL,
  `account_basket_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_item_price` decimal(9,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chain`
--

CREATE TABLE `chain` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chain`
--

INSERT INTO `chain` (`id`, `name`) VALUES
(1, 'saveonfoods'),
(2, 'walmart'),
(3, 'superstore');

-- --------------------------------------------------------

--
-- Table structure for table `chain_location`
--

CREATE TABLE `chain_location` (
  `id` int(11) NOT NULL,
  `chain_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `location` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chain_location`
--

INSERT INTO `chain_location` (`id`, `chain_id`, `name`, `location`, `url`) VALUES
(1, 1, 'kelowna', '1876 Cooper Rd, Kelowna BC V1Y 9N6, Canada', 'https://www.saveonfoods.com/sm/planning/rsid/980/'),
(2, 1, 'westkelowna', '2475 Dobbin Rd, Westbank BC V4T 2E9, Canada', 'https://www.saveonfoods.com/sm/planning/rsid/956/'),
(3, 1, 'vernon', '4900 27th Street\r\nVernon, BC V1T 7G7', 'https://www.saveonfoods.com/sm/planning/rsid/988/'),
(4, 2, 'kelowna', '1555 Banks Rd, Kelowna, BC, V1X 7Y8', 'https://www.walmart.ca/en'),
(5, 2, 'westkelowna', '2170 Louie Dr, Westbank, BC', 'https://www.walmart.ca/en'),
(6, 2, 'vernon', '2200-58 Th Ave, Vernon, BC, V1T 9T2', 'https://www.walmart.ca/en/stores-near-me/vernon-supercentre-3169'),
(7, 3, 'kelowna', '2280 Baron Rd, Kelowna BC V1X 7W3, Canada', 'https://www.realcanadiansuperstore.ca/'),
(8, 3, 'westkelowna', '3020 Louie Dr, Westbank, British Columbia V4T 3E1', 'https://www.realcanadiansuperstore.ca/'),
(9, 3, 'vernon', '5001 Anderson Way, Vernon, British Columbia V1T 9V1', 'https://www.realcanadiansuperstore.ca/');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `comment` varchar(100) NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `imgsrc` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `imgsrc`, `description`, `category_id`) VALUES
(1, 'HoneyCrisp Apple', 'https://storage.googleapis.com/images-sof-prd-9fa6b8b.sof.prd.v8.commerce.mi9cloud.com/product-images/detail/3283.jpg', 'The honeycrisp apple is a cross between Honeygold and Macoun. Honeycrisp apples have developed relatively thin skin, are amazingly crisp with a good sweet-tart balance. Juicy, crunchy, sweet and packed with nutrients and antioxidants.', 1),
(2, 'Gala Apple', 'https://storage.googleapis.com/images-sof-prd-9fa6b8b.sof.prd.v8.commerce.mi9cloud.com/product-images/detail/4133.jpg', 'Extra Fancy Grade, BC. A Mildly Sweet Flavor and Long Availability Window.', 1),
(3, 'Granny Smith Apple', 'https://storage.googleapis.com/images-sof-prd-9fa6b8b.sof.prd.v8.commerce.mi9cloud.com/product-images/detail/4139.jpg', 'Granny Smith Apples are a Crisp, Tart Apple that Make a Delicious Snack or a Tasteful Addition to Recipes.', 1),
(4, 'Banana', 'https://storage.googleapis.com/images-sof-prd-9fa6b8b.sof.prd.v8.commerce.mi9cloud.com/product-images/detail/4011.jpg', 'A long, curved fruit with a yellow skin and a soft inside', 1),
(5, 'Orange', 'https://storage.googleapis.com/images-sof-prd-9fa6b8b.sof.prd.v8.commerce.mi9cloud.com/product-images/cell/4012.jpg', 'A round fruit with an orange skin and a juicy inside', 1),
(6, 'Broccoli', 'https://storage.googleapis.com/images-sof-prd-9fa6b8b.sof.prd.v8.commerce.mi9cloud.com/product-images/detail/4548.jpg', 'Green vegetable high in vitamin C and fiber', 2),
(7, 'Carrots', 'https://storage.googleapis.com/images-sof-prd-9fa6b8b.sof.prd.v8.commerce.mi9cloud.com/product-images/detail/4562.jpg', 'Root vegetable high in vitamin A and fiber', 2),
(8, 'Kale', 'https://storage.googleapis.com/images-sof-prd-9fa6b8b.sof.prd.v8.commerce.mi9cloud.com/product-images/detail/4627.jpg', 'Leafy green vegetable high in vitamins K, A, and C', 2),
(9, 'Red Bell pepper', 'https://storage.googleapis.com/images-sof-prd-9fa6b8b.sof.prd.v8.commerce.mi9cloud.com/product-images/detail/4688.jpg', 'Sweet vegetable high in vitamin C and antioxidants', 2),
(10, 'Roma Tomato', 'https://storage.googleapis.com/images-sof-prd-9fa6b8b.sof.prd.v8.commerce.mi9cloud.com/product-images/detail/4087.jpg', 'Juicy fruit-vegetable high in vitamin C and lycopene', 2),
(11, '2% Milk', 'https://storage.googleapis.com/images-sof-prd-9fa6b8b.sof.prd.v8.commerce.mi9cloud.com/product-images/detail/00068700011016.jpg', 'Fresh cow milk', 3),
(12, 'Salted Butter', 'https://storage.googleapis.com/images-sof-prd-9fa6b8b.sof.prd.v8.commerce.mi9cloud.com/product-images/detail/00068700045059.jpg', 'Pure butter made from fresh milk', 3),
(13, 'Cheddar Cheese', 'https://storage.googleapis.com/images-sof-prd-9fa6b8b.sof.prd.v8.commerce.mi9cloud.com/product-images/detail/00056364021854.jpg', 'Mature cheddar cheese', 3),
(14, 'Beef', 'https://storage.googleapis.com/images-sof-prd-9fa6b8b.sof.prd.v8.commerce.mi9cloud.com/product-images/detail/00056364902603.jpg', 'Fresh beef from local farms', 4),
(15, 'Chicken Breast', 'https://storage.googleapis.com/images-sof-prd-9fa6b8b.sof.prd.v8.commerce.mi9cloud.com/product-images/detail/00292614000006.jpg', 'Free-range chicken with no antibiotics', 4),
(16, 'Pork', 'https://storage.googleapis.com/images-sof-prd-9fa6b8b.sof.prd.v8.commerce.mi9cloud.com/product-images/detail/00290004000001.jpg', 'Locally-sourced pork', 4);

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`id`, `name`) VALUES
(1, 'fruit'),
(2, 'vegetable'),
(3, 'dairy'),
(4, 'meat');

-- --------------------------------------------------------

--
-- Table structure for table `product_price`
--

CREATE TABLE `product_price` (
  `chain_location_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_price`
--

INSERT INTO `product_price` (`chain_location_id`, `product_id`, `price`, `created_at`) VALUES
(1, 1, '0.65', '2023-03-25 22:33:07'),
(1, 2, '0.78', '2023-03-25 22:33:07'),
(1, 3, '0.89', '2023-03-25 22:33:07'),
(1, 4, '0.90', '2023-03-25 22:33:07'),
(1, 5, '1.20', '2023-03-25 22:33:07'),
(2, 1, '0.60', '2023-03-25 22:33:07'),
(2, 2, '0.72', '2023-03-25 22:33:07'),
(2, 3, '0.62', '2023-03-25 22:33:07'),
(2, 4, '0.95', '2023-03-25 22:33:07'),
(2, 5, '1.02', '2023-03-25 22:33:07'),
(3, 1, '0.40', '2023-03-25 22:33:07'),
(3, 2, '0.45', '2023-03-25 22:33:07'),
(3, 3, '0.65', '2023-03-25 22:33:07'),
(3, 4, '0.92', '2023-03-25 22:33:07'),
(3, 5, '1.56', '2023-03-25 22:33:07'),
(1, 1, '0.92', '2023-03-25 22:35:02'),
(1, 2, '0.67', '2023-03-25 22:35:02'),
(1, 3, '1.10', '2023-03-25 22:35:02'),
(1, 4, '1.24', '2023-03-25 22:35:02'),
(1, 5, '0.82', '2023-03-25 22:35:02'),
(2, 1, '1.43', '2023-03-25 22:35:02'),
(2, 2, '1.15', '2023-03-25 22:35:02'),
(2, 3, '0.44', '2023-03-25 22:35:02'),
(2, 4, '1.09', '2023-03-25 22:35:02'),
(2, 5, '0.71', '2023-03-25 22:35:02'),
(3, 1, '0.49', '2023-03-25 22:35:02'),
(3, 2, '0.93', '2023-03-25 22:35:02'),
(3, 3, '1.34', '2023-03-25 22:35:02'),
(3, 4, '0.73', '2023-03-25 22:35:02'),
(3, 5, '1.30', '2023-03-25 22:35:02'),
(4, 1, '0.52', '2023-03-26 02:02:11'),
(4, 2, '1.22', '2023-03-26 02:02:11'),
(4, 3, '0.85', '2023-03-26 02:02:11'),
(4, 4, '1.27', '2023-03-26 02:02:11'),
(4, 5, '1.22', '2023-03-26 02:02:11'),
(5, 1, '0.79', '2023-03-26 02:02:11'),
(5, 2, '0.97', '2023-03-26 02:02:11'),
(5, 3, '0.99', '2023-03-26 02:02:11'),
(5, 4, '0.55', '2023-03-26 02:02:11'),
(5, 5, '0.49', '2023-03-26 02:02:11'),
(6, 1, '1.48', '2023-03-26 02:02:11'),
(6, 2, '1.16', '2023-03-26 02:02:11'),
(6, 3, '0.92', '2023-03-26 02:02:11'),
(6, 4, '0.75', '2023-03-26 02:02:11'),
(6, 5, '0.57', '2023-03-26 02:02:11'),
(7, 1, '0.73', '2023-03-26 02:03:24'),
(7, 2, '1.28', '2023-03-26 02:03:24'),
(7, 3, '0.94', '2023-03-26 02:03:24'),
(7, 4, '1.42', '2023-03-26 02:03:24'),
(7, 5, '1.27', '2023-03-26 02:03:24'),
(8, 1, '0.58', '2023-03-26 02:03:24'),
(8, 2, '1.18', '2023-03-26 02:03:24'),
(8, 3, '0.64', '2023-03-26 02:03:24'),
(8, 4, '1.48', '2023-03-26 02:03:24'),
(8, 5, '1.31', '2023-03-26 02:03:24'),
(9, 1, '0.97', '2023-03-26 02:03:24'),
(9, 2, '1.22', '2023-03-26 02:03:24'),
(9, 3, '1.39', '2023-03-26 02:03:24'),
(9, 4, '0.81', '2023-03-26 02:03:24'),
(9, 5, '1.11', '2023-03-26 02:03:24'),
(1, 6, '1.23', '2023-03-26 02:09:16'),
(1, 7, '1.98', '2023-03-26 02:09:16'),
(1, 8, '2.11', '2023-03-26 02:09:16'),
(1, 9, '2.00', '2023-03-26 02:09:16'),
(1, 10, '1.77', '2023-03-26 02:09:16'),
(2, 6, '1.65', '2023-03-26 02:09:16'),
(2, 7, '1.25', '2023-03-26 02:09:16'),
(2, 8, '1.47', '2023-03-26 02:09:16'),
(2, 9, '2.02', '2023-03-26 02:09:16'),
(2, 10, '1.68', '2023-03-26 02:09:16'),
(3, 6, '1.34', '2023-03-26 02:09:16'),
(3, 7, '1.55', '2023-03-26 02:09:16'),
(3, 8, '1.12', '2023-03-26 02:09:16'),
(3, 9, '2.25', '2023-03-26 02:09:16'),
(3, 10, '1.98', '2023-03-26 02:09:16'),
(4, 6, '2.25', '2023-03-26 02:09:16'),
(4, 7, '1.35', '2023-03-26 02:09:16'),
(4, 8, '1.55', '2023-03-26 02:09:16'),
(4, 9, '2.00', '2023-03-26 02:09:16'),
(4, 10, '1.70', '2023-03-26 02:09:16'),
(5, 6, '1.78', '2023-03-26 02:09:16'),
(5, 7, '1.50', '2023-03-26 02:09:16'),
(5, 8, '1.25', '2023-03-26 02:09:16'),
(5, 9, '2.18', '2023-03-26 02:09:16'),
(5, 10, '1.35', '2023-03-26 02:09:16'),
(6, 6, '1.05', '2023-03-26 02:09:16'),
(6, 7, '1.25', '2023-03-26 02:09:16'),
(6, 8, '2.10', '2023-03-26 02:09:16'),
(6, 9, '1.78', '2023-03-26 02:09:16'),
(6, 10, '1.66', '2023-03-26 02:09:16'),
(7, 6, '2.00', '2023-03-26 02:09:16'),
(7, 7, '1.42', '2023-03-26 02:09:16'),
(7, 8, '1.99', '2023-03-26 02:09:16'),
(7, 9, '2.22', '2023-03-26 02:09:16'),
(7, 10, '1.43', '2023-03-26 02:09:16'),
(8, 6, '1.98', '2023-03-26 02:09:16'),
(8, 7, '1.11', '2023-03-26 02:09:16'),
(8, 8, '1.87', '2023-03-26 02:09:16'),
(8, 9, '1.23', '2023-03-26 02:09:16'),
(8, 10, '2.10', '2023-03-26 02:09:16'),
(9, 6, '2.00', '2023-03-26 02:09:16'),
(9, 7, '1.68', '2023-03-26 02:09:16'),
(9, 8, '1.56', '2023-03-26 02:09:16'),
(9, 9, '1.98', '2023-03-26 02:09:16'),
(9, 10, '1.25', '2023-03-26 02:09:16'),
(1, 11, '4.25', '2023-03-26 02:11:24'),
(1, 12, '4.62', '2023-03-26 02:11:24'),
(1, 13, '3.98', '2023-03-26 02:11:24'),
(1, 14, '3.75', '2023-03-26 02:11:24'),
(1, 15, '4.89', '2023-03-26 02:11:24'),
(1, 16, '6.10', '2023-03-26 02:11:24'),
(2, 11, '3.25', '2023-03-26 02:11:24'),
(2, 12, '3.90', '2023-03-26 02:11:24'),
(2, 13, '5.00', '2023-03-26 02:11:24'),
(2, 14, '6.25', '2023-03-26 02:11:24'),
(2, 15, '5.50', '2023-03-26 02:11:24'),
(2, 16, '5.75', '2023-03-26 02:11:24'),
(3, 11, '6.50', '2023-03-26 02:11:24'),
(3, 12, '5.50', '2023-03-26 02:11:24'),
(3, 13, '3.00', '2023-03-26 02:11:24'),
(3, 14, '3.50', '2023-03-26 02:11:24'),
(3, 15, '4.25', '2023-03-26 02:11:24'),
(3, 16, '4.50', '2023-03-26 02:11:24'),
(4, 11, '4.75', '2023-03-26 02:11:24'),
(4, 12, '5.75', '2023-03-26 02:11:24'),
(4, 13, '6.00', '2023-03-26 02:11:24'),
(4, 14, '4.00', '2023-03-26 02:11:24'),
(4, 15, '3.98', '2023-03-26 02:11:24'),
(4, 16, '4.85', '2023-03-26 02:11:24'),
(5, 11, '4.25', '2023-03-26 02:11:24'),
(5, 12, '4.75', '2023-03-26 02:11:24'),
(5, 13, '6.25', '2023-03-26 02:11:24'),
(5, 14, '5.50', '2023-03-26 02:11:24'),
(5, 15, '3.75', '2023-03-26 02:11:24'),
(5, 16, '5.10', '2023-03-26 02:11:24'),
(6, 11, '6.25', '2023-03-26 02:11:24'),
(6, 12, '5.10', '2023-03-26 02:11:24'),
(6, 13, '4.50', '2023-03-26 02:11:24'),
(6, 14, '4.75', '2023-03-26 02:11:24'),
(6, 15, '4.98', '2023-03-26 02:11:24'),
(6, 16, '3.25', '2023-03-26 02:11:24'),
(7, 11, '3.00', '2023-03-26 02:11:24'),
(7, 12, '4.00', '2023-03-26 02:11:24'),
(7, 13, '5.25', '2023-03-26 02:11:24'),
(7, 14, '6.50', '2023-03-26 02:11:24'),
(7, 15, '4.50', '2023-03-26 02:11:24'),
(7, 16, '4.25', '2023-03-26 02:11:24'),
(8, 11, '4.50', '2023-03-26 02:11:24'),
(8, 12, '4.75', '2023-03-26 02:11:24'),
(8, 13, '5.00', '2023-03-26 02:11:24'),
(8, 14, '5.50', '2023-03-26 02:11:24'),
(8, 15, '5.75', '2023-03-26 02:11:24'),
(8, 16, '6.25', '2023-03-26 02:11:24'),
(9, 11, '3.75', '2023-03-26 02:11:24'),
(9, 12, '3.00', '2023-03-26 02:11:24'),
(9, 13, '5.50', '2023-03-26 02:11:24'),
(9, 14, '4.50', '2023-03-26 02:11:24'),
(9, 15, '6.25', '2023-03-26 02:11:24'),
(9, 16, '6.50', '2023-03-26 02:11:24'),
(1, 6, '1.23', '2023-03-26 02:13:05'),
(1, 7, '1.98', '2023-03-26 02:13:05'),
(1, 8, '2.11', '2023-03-26 02:13:05'),
(1, 9, '2.00', '2023-03-26 02:13:05'),
(1, 10, '1.77', '2023-03-26 02:13:05'),
(2, 6, '1.65', '2023-03-26 02:13:05'),
(2, 7, '1.25', '2023-03-26 02:13:05'),
(2, 8, '1.47', '2023-03-26 02:13:05'),
(2, 9, '2.02', '2023-03-26 02:13:05'),
(2, 10, '1.68', '2023-03-26 02:13:05'),
(3, 6, '1.34', '2023-03-26 02:13:05'),
(3, 7, '1.55', '2023-03-26 02:13:05'),
(3, 8, '1.12', '2023-03-26 02:13:05'),
(3, 9, '2.25', '2023-03-26 02:13:05'),
(3, 10, '1.98', '2023-03-26 02:13:05'),
(4, 6, '2.25', '2023-03-26 02:13:05'),
(4, 7, '1.35', '2023-03-26 02:13:05'),
(4, 8, '1.55', '2023-03-26 02:13:05'),
(4, 9, '2.00', '2023-03-26 02:13:05'),
(4, 10, '1.70', '2023-03-26 02:13:05'),
(5, 6, '1.78', '2023-03-26 02:13:05'),
(5, 7, '1.50', '2023-03-26 02:13:05'),
(5, 8, '1.25', '2023-03-26 02:13:05'),
(5, 9, '2.18', '2023-03-26 02:13:05'),
(5, 10, '1.35', '2023-03-26 02:13:05'),
(6, 6, '1.05', '2023-03-26 02:13:05'),
(6, 7, '1.25', '2023-03-26 02:13:05'),
(6, 8, '2.10', '2023-03-26 02:13:05'),
(6, 9, '1.78', '2023-03-26 02:13:05'),
(6, 10, '1.66', '2023-03-26 02:13:05'),
(7, 6, '2.00', '2023-03-26 02:13:05'),
(7, 7, '1.42', '2023-03-26 02:13:05'),
(7, 8, '1.99', '2023-03-26 02:13:05'),
(7, 9, '2.22', '2023-03-26 02:13:05'),
(7, 10, '1.43', '2023-03-26 02:13:05'),
(8, 6, '1.98', '2023-03-26 02:13:05'),
(8, 7, '1.11', '2023-03-26 02:13:05'),
(8, 8, '1.87', '2023-03-26 02:13:05'),
(8, 9, '1.23', '2023-03-26 02:13:05'),
(8, 10, '2.10', '2023-03-26 02:13:05'),
(9, 6, '2.00', '2023-03-26 02:13:05'),
(9, 7, '1.68', '2023-03-26 02:13:05'),
(9, 8, '1.56', '2023-03-26 02:13:05'),
(9, 9, '1.98', '2023-03-26 02:13:05'),
(9, 10, '1.25', '2023-03-26 02:13:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `account_basket`
--
ALTER TABLE `account_basket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_id` (`account_id`);

--
-- Indexes for table `basket_item`
--
ALTER TABLE `basket_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_basket_id` (`account_basket_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `chain`
--
ALTER TABLE `chain`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chain_location`
--
ALTER TABLE `chain_location`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chain_id` (`chain_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_id` (`account_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_price`
--
ALTER TABLE `product_price`
  ADD KEY `chain_location_id` (`chain_location_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `account_basket`
--
ALTER TABLE `account_basket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `basket_item`
--
ALTER TABLE `basket_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chain`
--
ALTER TABLE `chain`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `chain_location`
--
ALTER TABLE `chain_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account_basket`
--
ALTER TABLE `account_basket`
  ADD CONSTRAINT `account_basket_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`);

--
-- Constraints for table `basket_item`
--
ALTER TABLE `basket_item`
  ADD CONSTRAINT `basket_item_ibfk_1` FOREIGN KEY (`account_basket_id`) REFERENCES `account_basket` (`id`),
  ADD CONSTRAINT `basket_item_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `chain_location`
--
ALTER TABLE `chain_location`
  ADD CONSTRAINT `chain_location_ibfk_1` FOREIGN KEY (`chain_id`) REFERENCES `chain` (`id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `product_category` (`id`);

--
-- Constraints for table `product_price`
--
ALTER TABLE `product_price`
  ADD CONSTRAINT `product_price_ibfk_1` FOREIGN KEY (`chain_location_id`) REFERENCES `chain_location` (`id`),
  ADD CONSTRAINT `product_price_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
