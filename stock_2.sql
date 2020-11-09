-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2020 at 01:24 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stock_2`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(191) NOT NULL,
  `phone` varchar(191) NOT NULL,
  `address` text NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Retailer,2=Industrail',
  `customer_status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_name`, `phone`, `address`, `type`, `customer_status`) VALUES
(34, 'Dipok motors', '01733459037', 'Monohordi', 1, 0),
(35, 'Golzar Auto', '01922435771', 'Monohordi', 1, 0),
(36, 'Sojon Auto', '01738628328', 'Shibpur', 1, 0),
(37, 'Riyad Motors', '0174424905', 'Itakhola', 1, 0),
(38, 'Ma Babar dowa Auto', '01994729224', 'Shibpur', 1, 0),
(39, 'Toshar Auto', '01734456351', 'Shibpur', 1, 0),
(40, 'Motalib Motors', '01716154557', 'Belabo', 1, 0),
(41, 'Mofazzol Auto', '01919167476', 'Madhobdi', 1, 0),
(42, 'S S Oil corporation, Modo shek', '01976660511', 'Itakhola', 1, 0),
(43, 'M/S Toba Motors, Delowar', '01727505294', 'Shaheprotab', 1, 0),
(44, 'Adry Motors', '01722600450', 'Monohordi', 1, 0),
(45, 'Rassel Auto, Jaj Mia', '01726605888', 'Morjal', 1, 0),
(46, 'Delowar Auto', '01721931955', 'Valanogor', 1, 0),
(47, 'High Auto, Rubel', '01903183399', 'Valanogor', 1, 0),
(48, 'Dolal Auto', '01992696998', 'Zelkhanar moor', 1, 0),
(49, 'Helmet Gelary, Mitho', '01712763829', 'Zelkhanar moor', 1, 0),
(50, 'Fabiya Motors, Homayon', '01712654158', 'Shayeprotab', 1, 0),
(51, 'H M Auto', '01711175369', 'Madhobdi', 1, 0),
(52, 'Alamin Motors', '01721746452', 'Varicha', 1, 0),
(53, 'Sowrab Motors', '01991817221', 'Pakoriya Bazar', 1, 0),
(54, 'Rahol Auto', '01816410585', 'Shibpur', 1, 0),
(55, 'Modina Motors, Hero honda', '01980962556', 'Valanogor', 1, 0),
(56, 'Bipul Motors', '***********', 'belabo', 1, 0),
(57, 'Samiya Motors', '**********', 'Velabo', 1, 0),
(58, 'Ma Babar Asirbad', '******', 'hasnabad', 1, 0),
(59, 'Babu Motors', '*******', 'Madhobdi', 1, 0),
(60, 'Bithi Enterprice', '********', 'Chornogordi Bazar', 1, 0),
(61, 'Jewel Engering Workshop', '**', 'Arshinogor', 1, 0),
(62, 'Rajib Motors', '01906555598', 'Gorashal', 1, 0),
(63, 'Sadiya Auto', '***', 'Itakhola', 1, 0),
(64, 'Modina Motors', '****', 'Hasnabad', 1, 0),
(65, 'Sojib Motors', '..', 'Polash', 1, 0),
(66, 'Momen Motors', ',,', 'Polash', 1, 0),
(67, 'Famus Auto', '...', 'Obda Polash', 1, 0),
(68, 'S N Tredars', ',.', 'Chorsindor Bazar', 1, 0),
(69, 'Sriti Motors', '.', 'Baricha', 1, 0),
(70, 'Moktar Motors', '123', 'Raipura ', 1, 0),
(71, 'Shamim Auto', '01781516985', 'Shibpur', 1, 0),
(72, 'Ma Motors ', '12', 'Shibpur', 1, 0),
(73, 'Ma Motors ', '14', 'Itakhola', 1, 0),
(74, 'Shanti Auto', '01732203258', 'Hatirdiya', 1, 0),
(75, 'Sojib Motors', '01839954013', 'Valanogor', 1, 0),
(76, 'Ma Babar Asirbad', '15', 'Hatirdiya', 1, 0),
(77, 'Mayer dowa Repairing Workshop', '11', 'Pasdona', 1, 0),
(78, 'Chowadanga Motors', '22', 'Itakhola', 1, 0),
(79, 'Ma Babar Asirbad', '21', 'Hatirdiya', 1, 0),
(80, 'Bismilla Auto', '211', 'Chalakchor', 1, 0),
(81, 'Ankor Motors', '16', 'Madhobdi', 1, 0),
(82, 'Shakil Enterprice', '00', 'Monohordi', 1, 0),
(83, 'Rabbi Motors', '01', 'Shibpur', 1, 0),
(84, 'Adiyat Motors', '001', 'Shibpur', 1, 0),
(85, 'Shikdar Motors', '000', 'Monohordi', 1, 0),
(86, 'Mowla Motors', '111', 'Monohordi', 1, 0),
(87, 'New Fabiya ', '212', 'Shaheprotab', 1, 0),
(88, 'Honda parts', '321', 'C N B Bzaar', 1, 0),
(89, 'Joi Enterprice', '311', 'Polash', 1, 0),
(90, 'Test 2', '+8806068829238', '126 North Bend River Road', 1, 0),
(91, 'meta', '6068829238', '126 North Bend River Road', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `investments`
--

CREATE TABLE `investments` (
  `id` int(5) NOT NULL,
  `title` varchar(100) NOT NULL,
  `amount` int(11) NOT NULL,
  `user_id` int(5) NOT NULL,
  `expense_date` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `investments`
--

INSERT INTO `investments` (`id`, `title`, `amount`, `user_id`, `expense_date`, `created_at`) VALUES
(3, 'test ', 5001, 1, '2020-09-08 18:14:42', '2020-10-07 19:46:52'),
(4, 'Invst test', 100, 1, '2020-10-01 01:26:39', '2020-10-07 19:26:39');

-- --------------------------------------------------------

--
-- Table structure for table `mi_membership`
--

CREATE TABLE `mi_membership` (
  `id` int(11) NOT NULL,
  `expired_in` datetime NOT NULL,
  `last_renew` datetime NOT NULL,
  `total_renew` int(11) NOT NULL,
  `user_id` varchar(250) NOT NULL,
  `started` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mi_membership`
--

INSERT INTO `mi_membership` (`id`, `expired_in`, `last_renew`, `total_renew`, `user_id`, `started`) VALUES
(1, '2019-06-20 02:10:03', '2019-06-01 03:03:26', 3, 'MIUSER49719T', '2019-03-01');

-- --------------------------------------------------------

--
-- Table structure for table `mi_orders`
--

CREATE TABLE `mi_orders` (
  `order_id` int(11) NOT NULL,
  `order_products_details` text NOT NULL,
  `trx_id` text NOT NULL,
  `total_due` float NOT NULL,
  `no_tax_amount` float NOT NULL,
  `tax_percentage` int(11) NOT NULL,
  `order_created` datetime NOT NULL DEFAULT current_timestamp(),
  `refund_date` datetime NOT NULL,
  `single_refund_date` datetime NOT NULL,
  `order_extra_note` text NOT NULL,
  `order_extra_amount` text NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` text DEFAULT NULL,
  `customer_phone` int(15) DEFAULT NULL,
  `customer_address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mi_orders`
--

INSERT INTO `mi_orders` (`order_id`, `order_products_details`, `trx_id`, `total_due`, `no_tax_amount`, `tax_percentage`, `order_created`, `refund_date`, `single_refund_date`, `order_extra_note`, `order_extra_amount`, `user_id`, `customer_id`, `customer_name`, `customer_phone`, `customer_address`) VALUES
(93, '{\"pro_id\":\"228\",\"pro_qty\":\"1\"}, {\"pro_id\":\"226\",\"pro_qty\":\"1\"}', '6c2e4eb9165', 40, 730, 5, '2020-10-18 21:41:14', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Extra Note and Add/Less Details', '-80', 1, 0, NULL, NULL, NULL),
(94, '{\"pro_id\":\"228\",\"pro_qty\":\"1\"}', '6ef1beda493', 40, 80, 5, '2020-10-18 21:45:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '0', 1, 0, NULL, NULL, NULL),
(95, '{\"pro_id\":\"228\",\"pro_qty\":\"1\"}, {\"pro_id\":\"226\",\"pro_qty\":\"1\"}', '4e42922c785', 60, 730, 5, '2020-10-18 21:51:07', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Extra Note and Add/Less Details', '-6', 1, 0, NULL, NULL, NULL),
(96, '{\"pro_id\":\"230\",\"pro_qty\":\"2\"}, {\"pro_id\":\"228\",\"pro_qty\":\"2\"}', 'ba964103248', 100, 800, 5, '2020-10-18 22:00:48', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Extra Note and Add/Less Details', '-40', 1, 0, NULL, NULL, NULL),
(97, '{\"pro_id\":\"230\",\"pro_qty\":\"2\"}, {\"pro_id\":\"228\",\"pro_qty\":\"2\"}', '3482a805919', 100, 800, 5, '2020-10-18 22:04:41', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Extra Note and Add/Less Details', '-40', 1, 0, NULL, NULL, NULL),
(98, '{\"pro_id\":\"230\",\"pro_qty\":\"1\"}, {\"pro_id\":\"228\",\"pro_qty\":\"2\"}', '6d0d2b8b46', 100, 480, 5, '2020-10-18 22:06:14', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Extra Note and Add/Less Details', '-4', 1, 0, NULL, NULL, NULL),
(99, '{\"pro_id\":\"230\",\"pro_qty\":\"1\"}, {\"pro_id\":\"228\",\"pro_qty\":\"1\"}', '012fb38a961', 0, 400, 5, '2020-10-18 22:06:57', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '0', 1, 0, NULL, NULL, NULL),
(100, '{\"pro_id\":\"230\",\"pro_qty\":\"1\"}, {\"pro_id\":\"228\",\"pro_qty\":\"1\"}', 'a7860fb1171', 50, 400, 5, '2020-10-18 22:07:28', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Extra Note and Add/Less Details', '-20', 1, 0, NULL, NULL, NULL),
(101, '{\"pro_id\":\"230\",\"pro_qty\":\"1\"}, {\"pro_id\":\"228\",\"pro_qty\":0}', '319153f4480', 10, 320, 5, '2020-10-18 22:09:47', '0000-00-00 00:00:00', '2020-10-19 00:39:37', 'Extra Note and Add/Less Details', '-20', 1, 0, NULL, NULL, NULL),
(102, '{\"pro_id\":\"228\",\"pro_qty\":\"1\"}, {\"pro_id\":\"230\",\"pro_qty\":0}', 'f61142ec161', 0, 80, 5, '2020-10-18 22:12:51', '0000-00-00 00:00:00', '2020-10-19 00:36:43', 'Extra Note and Add/Less Details', '-20', 1, 0, NULL, NULL, NULL),
(103, '{\"pro_id\":\"229\",\"pro_qty\":\"1\"}, {\"pro_id\":\"231\",\"pro_qty\":0}', 'ec4234a2513', 0, 150, 5, '2020-10-18 22:13:29', '2020-10-19 00:39:55', '2020-10-18 23:20:59', 'Extra Note and Add/Less Details', '-10', 1, 0, NULL, NULL, NULL),
(104, '{\"pro_id\":\"228\",\"pro_qty\":\"1\"}', '3eaece70540', 20, 80, 5, '2020-10-19 02:59:49', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Extra Note and Add/Less Details', '-4', 1, 0, NULL, NULL, NULL),
(105, '{\"pro_id\":\"228\",\"pro_qty\":\"2\"}, {\"pro_id\":\"226\",\"pro_qty\":\"2\"}', '4c0684ff879', 0, 1460, 5, '2020-10-19 03:11:04', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '0', 1, 0, NULL, NULL, NULL),
(106, '{\"pro_id\":\"230\",\"pro_qty\":\"2\"}, {\"pro_id\":\"228\",\"pro_qty\":\"2\"}', 'b64656f0952', 0, 800, 5, '2020-10-19 03:12:22', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '0', 1, 0, '', 0, ''),
(107, '{\"pro_id\":\"230\",\"pro_qty\":\"1\"}, {\"pro_id\":\"228\",\"pro_qty\":\"1\"}', '1d0e262b694', 0, 400, 5, '2020-10-19 03:19:06', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '0', 1, 0, 'Test 1', 2147483647, '126 North Bend River Road'),
(108, '{\"pro_id\":\"228\",\"pro_qty\":\"1\"}, {\"pro_id\":\"226\",\"pro_qty\":\"1\"}', 'be81884d520', 36, 730, 5, '2020-10-19 14:55:17', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Extra Note and Add/Less Details', '-30', 1, 0, '', 0, ''),
(109, '{\"pro_id\":\"230\",\"pro_qty\":\"2\"}, {\"pro_id\":\"228\",\"pro_qty\":\"2\"}', '1e48cdff630', 100, 800, 5, '2020-10-19 15:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Extra Note and Add/Less Details', '-40', 1, 91, '', 0, ''),
(110, '{\"pro_id\":\"230\",\"pro_qty\":\"1\"}, {\"pro_id\":\"228\",\"pro_qty\":\"1\"}', 'a7c3c79c253', 0, 400, 5, '2020-10-19 15:41:46', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '0', 1, 0, '', 0, ''),
(111, '{\"pro_id\":\"228\",\"pro_qty\":\"1\"}, {\"pro_id\":\"230\",\"pro_qty\":\"1\"}', 'fcae7cf0861', 0, 400, 5, '2020-10-19 15:44:56', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '0', 1, 0, '', 0, ''),
(112, '{\"pro_id\":\"226\",\"pro_qty\":\"1\"}, {\"pro_id\":\"228\",\"pro_qty\":\"1\"}', '3dfd78ec616', 0, 730, 5, '2020-10-20 17:01:21', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '0', 1, 90, '', 0, ''),
(113, '{\"pro_id\":\"227\",\"pro_qty\":\"1\"}', 'b0ce2b413', 0, 510, 5, '2020-10-22 00:05:31', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '0', 1, 0, '', 0, ''),
(114, '{\"pro_id\":\"229\",\"pro_qty\":\"2\"}, {\"pro_id\":\"227\",\"pro_qty\":\"2\"}', 'fc73b319851', 100, 1320, 5, '2020-10-22 00:06:17', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Extra Note and Add/Less Details', '-20', 1, 0, '', 0, ''),
(115, '{\"pro_id\":\"227\",\"pro_qty\":\"1\"}, {\"pro_id\":\"225\",\"pro_qty\":\"1\"}', 'a781905e288', 100, 830, 5, '2020-10-22 01:07:45', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Extra Note and Add/Less Details', '10', 1, 0, '', 0, ''),
(116, '{\"pro_id\":\"227\",\"pro_qty\":\"1\"}, {\"pro_id\":\"225\",\"pro_qty\":\"1\"}', '93e351cf266', 70, 830, 5, '2020-10-22 01:17:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Extra Note and Add/Less Details', '-1.5', 1, 0, '', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `mi_products`
--

CREATE TABLE `mi_products` (
  `pro_id` int(11) NOT NULL,
  `pro_title` text NOT NULL,
  `pro_price` float NOT NULL,
  `pro_img` text NOT NULL,
  `pro_stock` int(11) NOT NULL,
  `pro_stock_type` int(11) NOT NULL DEFAULT 1 COMMENT '1 = single; 2 = multiple',
  `pro_brand` int(11) NOT NULL,
  `pro_cat` int(11) NOT NULL,
  `pro_status` int(11) NOT NULL DEFAULT 1 COMMENT '1 = Activated, 0 = Deactivated',
  `pro_added` datetime NOT NULL DEFAULT current_timestamp(),
  `pro_supplier` int(11) NOT NULL,
  `pro_in_total_stock` int(11) NOT NULL,
  `last_stock_load_qty` int(11) NOT NULL,
  `last_stock_updated` datetime NOT NULL,
  `pro_serial` text NOT NULL,
  `buy_price` int(11) NOT NULL,
  `pro_model_number` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mi_products`
--

INSERT INTO `mi_products` (`pro_id`, `pro_title`, `pro_price`, `pro_img`, `pro_stock`, `pro_stock_type`, `pro_brand`, `pro_cat`, `pro_status`, `pro_added`, `pro_supplier`, `pro_in_total_stock`, `last_stock_load_qty`, `last_stock_updated`, `pro_serial`, `buy_price`, `pro_model_number`) VALUES
(222, 'Albaik', 450, 'f0ffe31187c0fd3149e14f33a9aeac54albaik.png', 50, 1, 46, 14, 1, '2020-09-10 15:22:02', 0, 15, 10, '2020-10-09 01:31:39', '', 350, 'AK-205'),
(223, 'Burger', 360, 'f3e5bbb3a4518ff9208f1d5195fe63aeburger.png', 40, 1, 46, 15, 1, '2020-09-10 15:22:38', 0, 20, 10, '2020-10-09 01:32:52', '', 300, 'BK-002'),
(224, 'French Fry', 120, 'd0e14c11c1da30484efcb1c58fcaa4e5french_fry.png', 49, 1, 46, 15, 1, '2020-09-10 15:23:12', 0, 25, 10, '2020-10-09 01:33:26', '', 80, 'FK-603'),
(225, 'Nugget', 320, '37c8b2e98edaaa0de9f87d1889bb9a1bnugget.png', 47, 1, 46, 14, 1, '2020-09-10 15:23:50', 0, 21, 10, '2020-10-09 01:33:44', '', 250, 'NK-807'),
(226, 'Pizza', 650, 'e4b2afb3c691cc6cc8ad7a70a7e5457apizza.png', 32, 1, 46, 14, 1, '2020-09-10 15:24:21', 0, 22, 10, '2020-10-09 01:34:04', '', 500, 'PK-608'),
(227, 'Pupps Nuggs Chili Cheese', 510, '8d7e47209d28c5ee13a7c149434a1df6PuppsNuggs_Chili_Cheese_Pup.png', 33, 1, 46, 14, 1, '2020-09-10 15:25:27', 0, 18, 10, '2020-10-09 01:34:37', '[]', 300, 'PK=903'),
(228, 'Samosa', 80, '5f9cdda2c0489400571080300ed6c3c2samosa.jpg', 18, 1, 46, 15, 1, '2020-09-10 15:25:57', 0, 15, 15, '2020-09-10 15:32:53', '', 100, 'SK-101'),
(229, 'Sandwich', 150, 'f67117ba2ac43947039c0ac9dac80535sandwich.png', 41, 1, 46, 14, 1, '2020-09-10 15:26:31', 0, 11, 11, '2020-09-10 15:33:20', '', 200, 'SK-505'),
(230, 'Spanish Omelette', 320, 'f91e9af6ba71f27507d13f55e93f3183spanish-omelette.png', 30, 1, 46, 14, 1, '2020-09-10 15:27:14', 0, 20, 20, '2020-09-10 15:33:48', '', 250, 'SO-777');

-- --------------------------------------------------------

--
-- Table structure for table `mi_product_brand`
--

CREATE TABLE `mi_product_brand` (
  `br_id` int(11) NOT NULL,
  `br_title` text NOT NULL,
  `br_slug` text NOT NULL,
  `br_icon` text NOT NULL,
  `br_icon_type` int(11) NOT NULL COMMENT '1 = Image, 2 = icon',
  `br_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mi_product_brand`
--

INSERT INTO `mi_product_brand` (`br_id`, `br_title`, `br_slug`, `br_icon`, `br_icon_type`, `br_added`) VALUES
(46, 'B-1', 'b-1', 'fab fa-adn', 2, '2020-09-10 15:21:14');

-- --------------------------------------------------------

--
-- Table structure for table `mi_product_cart`
--

CREATE TABLE `mi_product_cart` (
  `cart_id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `pro_qty` int(11) NOT NULL,
  `cart_added` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mi_product_cart`
--

INSERT INTO `mi_product_cart` (`cart_id`, `pro_id`, `pro_qty`, `cart_added`, `user_id`) VALUES
(140, 228, 1, '2020-10-18 20:28:21', 0);

-- --------------------------------------------------------

--
-- Table structure for table `mi_product_category`
--

CREATE TABLE `mi_product_category` (
  `cat_id` int(11) NOT NULL,
  `cat_title` text NOT NULL,
  `cat_slug` text NOT NULL,
  `cat_icn` text DEFAULT NULL,
  `cat_icon_type` int(11) DEFAULT NULL COMMENT '1 = Image, 2 = icon',
  `cat_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mi_product_category`
--

INSERT INTO `mi_product_category` (`cat_id`, `cat_title`, `cat_slug`, `cat_icn`, `cat_icon_type`, `cat_added`) VALUES
(14, 'Fast Food', 'fastfood', 'fas fa-atlas', 2, '2020-09-10 15:20:15'),
(15, 'Drinks', 'drinks', 'fab fa-affiliatetheme', 2, '2020-09-10 15:20:31');

-- --------------------------------------------------------

--
-- Table structure for table `mi_product_suppliers`
--

CREATE TABLE `mi_product_suppliers` (
  `sup_id` int(11) NOT NULL,
  `sup_name` varchar(100) NOT NULL,
  `sup_company` varchar(150) NOT NULL,
  `sup_email` text NOT NULL,
  `sup_phone` varchar(15) NOT NULL,
  `sup_address` text NOT NULL,
  `sup_img` text NOT NULL,
  `sup_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mi_product_suppliers`
--

INSERT INTO `mi_product_suppliers` (`sup_id`, `sup_name`, `sup_company`, `sup_email`, `sup_phone`, `sup_address`, `sup_img`, `sup_added`) VALUES
(5, 'Calvin Schwartz', 'Bradley and House Inc', 'holafejegi@mailinator.com', '+1 (759) 149-77', 'Voluptate expedita p', 'c17c2b4c438f3c678b8d2a0fa37c5e18s-1.jpg', '2020-08-12 17:32:30');

-- --------------------------------------------------------

--
-- Table structure for table `mi_purchase_vat`
--

CREATE TABLE `mi_purchase_vat` (
  `vid` int(11) NOT NULL,
  `vtax` int(11) DEFAULT NULL,
  `vtaxdetails` text NOT NULL,
  `vtaxadded` datetime NOT NULL DEFAULT current_timestamp(),
  `vtaxstatus` int(11) DEFAULT 1,
  `purchase_extra` text NOT NULL,
  `extra_amount` text DEFAULT NULL,
  `due` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mi_purchase_vat`
--

INSERT INTO `mi_purchase_vat` (`vid`, `vtax`, `vtaxdetails`, `vtaxadded`, `vtaxstatus`, `purchase_extra`, `extra_amount`, `due`, `user_id`) VALUES
(1, 5, 'VAT', '2019-08-22 01:14:47', 1, '', '0', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mi_stocks`
--

CREATE TABLE `mi_stocks` (
  `stock_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `stock_qty` int(11) NOT NULL,
  `invoice_id` varchar(50) NOT NULL,
  `invoice_picture` text NOT NULL,
  `expanse` int(11) NOT NULL,
  `unit_price` int(11) NOT NULL,
  `ex_due` int(11) NOT NULL,
  `ex_note` text NOT NULL,
  `upload_date` datetime NOT NULL DEFAULT current_timestamp(),
  `refund_date` datetime NOT NULL,
  `pro_serials` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mi_stocks`
--

INSERT INTO `mi_stocks` (`stock_id`, `supplier_id`, `product_id`, `stock_qty`, `invoice_id`, `invoice_picture`, `expanse`, `unit_price`, `ex_due`, `ex_note`, `upload_date`, `refund_date`, `pro_serials`) VALUES
(59, 5, 222, 10, '', '', 3500, 350, 150, '', '2020-10-09 01:31:39', '0000-00-00 00:00:00', ''),
(60, 5, 223, 10, '', '', 3000, 300, 0, '', '2020-10-09 01:32:52', '2020-10-19 01:28:57', ''),
(61, 5, 224, 10, '', '', 800, 80, 0, '', '2020-10-09 01:33:26', '0000-00-00 00:00:00', ''),
(62, 5, 225, 10, '', '', 2500, 250, 0, '', '2020-10-09 01:33:44', '0000-00-00 00:00:00', ''),
(63, 5, 226, 0, '', '', 0, 500, 0, '', '2020-10-09 01:34:04', '2020-10-19 01:28:45', ''),
(64, 5, 227, 10, '', '', 3000, 300, 0, '', '2020-10-09 01:34:37', '2020-10-19 01:21:30', '');

-- --------------------------------------------------------

--
-- Table structure for table `mi_users`
--

CREATE TABLE `mi_users` (
  `id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `pass` text NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_designation` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '1 = Activated; 2 = Deactivated;',
  `registered_from` datetime NOT NULL DEFAULT current_timestamp(),
  `user_type` int(11) NOT NULL DEFAULT 3 COMMENT '1=admin;2=shopmanager; 3=salesman',
  `created_by` int(11) NOT NULL,
  `email` text DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mi_users`
--

INSERT INTO `mi_users` (`id`, `user_id`, `pass`, `user_name`, `user_designation`, `status`, `registered_from`, `user_type`, `created_by`, `email`, `phone`) VALUES
(1, 'misujon', '202cb962ac59075b964b07152d234b70', 'Monirul Islam Sujon', 'Admin', 1, '2019-07-18 12:31:43', 1, 0, 'misujon58262@gmail.com', '01676707067'),
(2, 'gitasad', 'f791c101f3bdc0fc7e6c3b9c9e9c7938', 'S.M. Asad', 'Shop Manager', 1, '2019-07-18 12:31:43', 2, 1, 'smasad1200@gmail.com', '01842094184'),
(3, 'gitseller', '202cb962ac59075b964b07152d234b70', 'Sales Man', 'Shop Manager', 1, '2019-07-18 12:31:43', 2, 1, '', ''),
(4, 'akbar', '1c3767545f5231cbebd97aa1fb6ea236', 'M. A. Akber', 'Admin', 1, '2019-07-18 12:31:43', 1, 0, 'git01714094184@gmail.com', '01714094184'),
(6, 'gitm. a.5', 'dfdd61cf408037e44bcaa0f7afde1801', 'M. A. AKBAR1', 'Shop Manager', 1, '2019-08-07 18:55:14', 2, 4, 'akbar@geniusit.net', '1714094184'),
(10, 'mamun79', '202cb962ac59075b964b07152d234b70', 'Shafira Rowland', 'Sales Man', 1, '2020-08-12 22:08:14', 3, 1, 'vekofi@mailinator.com', '+1 (553) 877-44'),
(11, 'maamun78', '202cb962ac59075b964b07152d234b70', 'Emery Mullen', 'Sales Man', 1, '2020-08-12 22:09:40', 3, 1, 'gecykiv@mailinator.com', '+1 (403) 759-43'),
(12, 'test', '202cb962ac59075b964b07152d234b70', 'test79', 'Sales Man', 1, '2020-08-16 00:31:47', 3, 1, 'vekofi@mailinator.com', '+15538774489');

-- --------------------------------------------------------

--
-- Table structure for table `regular_expenses`
--

CREATE TABLE `regular_expenses` (
  `id` int(5) NOT NULL,
  `title` varchar(100) NOT NULL,
  `amount` int(11) NOT NULL,
  `user_id` int(5) NOT NULL,
  `expense_date` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `regular_expenses`
--

INSERT INTO `regular_expenses` (`id`, `title`, `amount`, `user_id`, `expense_date`, `created_at`) VALUES
(8, 'Test ', 125, 1, '2020-10-08 22:09:43', '2020-10-08 14:03:52'),
(9, 'Test 2', 500, 1, '2020-10-03 01:25:41', '2020-10-07 19:25:41'),
(10, 'Test 3', 250, 1, '2020-10-08 20:05:31', '2020-10-08 14:05:31');

-- --------------------------------------------------------

--
-- Table structure for table `settings_meta`
--

CREATE TABLE `settings_meta` (
  `id` int(5) NOT NULL,
  `meta_name` varchar(50) NOT NULL,
  `meta_value` varchar(200) NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings_meta`
--

INSERT INTO `settings_meta` (`id`, `meta_name`, `meta_value`, `type`) VALUES
(1, 'shop_logo', 'uploads/settings-img/9b7218b220d42cd685dc048f21d569bapngfind.com-restaurants-logo-png-3409742.png', 'image'),
(2, 'shop_address', 'Taher Tower Shopping Center, Suite-306 (2nd Floor) ', 'shop_details'),
(3, 'shop_email', 'contact@softminion.com', 'shop_details'),
(4, 'shop_phone', '01976-301-581', 'shop_details'),
(5, 'shop_note', 'Thank you for your business!  Payment is expected within 31 days; ', 'shop_details'),
(6, 'footer_text', 'Soft Minion', 'footer'),
(7, 'shop_currency', '$', 'currency'),
(8, 'footer_link', 'https://www.softminion.com/', 'footer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `investments`
--
ALTER TABLE `investments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mi_membership`
--
ALTER TABLE `mi_membership`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mi_orders`
--
ALTER TABLE `mi_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `mi_products`
--
ALTER TABLE `mi_products`
  ADD PRIMARY KEY (`pro_id`);

--
-- Indexes for table `mi_product_brand`
--
ALTER TABLE `mi_product_brand`
  ADD PRIMARY KEY (`br_id`);

--
-- Indexes for table `mi_product_cart`
--
ALTER TABLE `mi_product_cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `mi_product_category`
--
ALTER TABLE `mi_product_category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `mi_product_suppliers`
--
ALTER TABLE `mi_product_suppliers`
  ADD PRIMARY KEY (`sup_id`);

--
-- Indexes for table `mi_purchase_vat`
--
ALTER TABLE `mi_purchase_vat`
  ADD PRIMARY KEY (`vid`);

--
-- Indexes for table `mi_stocks`
--
ALTER TABLE `mi_stocks`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `mi_users`
--
ALTER TABLE `mi_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `regular_expenses`
--
ALTER TABLE `regular_expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings_meta`
--
ALTER TABLE `settings_meta`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `investments`
--
ALTER TABLE `investments`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mi_membership`
--
ALTER TABLE `mi_membership`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mi_orders`
--
ALTER TABLE `mi_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `mi_products`
--
ALTER TABLE `mi_products`
  MODIFY `pro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=232;

--
-- AUTO_INCREMENT for table `mi_product_brand`
--
ALTER TABLE `mi_product_brand`
  MODIFY `br_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `mi_product_cart`
--
ALTER TABLE `mi_product_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=204;

--
-- AUTO_INCREMENT for table `mi_product_category`
--
ALTER TABLE `mi_product_category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `mi_product_suppliers`
--
ALTER TABLE `mi_product_suppliers`
  MODIFY `sup_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mi_purchase_vat`
--
ALTER TABLE `mi_purchase_vat`
  MODIFY `vid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mi_stocks`
--
ALTER TABLE `mi_stocks`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `mi_users`
--
ALTER TABLE `mi_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `regular_expenses`
--
ALTER TABLE `regular_expenses`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `settings_meta`
--
ALTER TABLE `settings_meta`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
