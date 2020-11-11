-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2020 at 04:15 PM
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
-- Database: `codex_pos`
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
(91, 'meta1', '6068829238', '126 North Bend River Road', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `expense_type`
--

CREATE TABLE `expense_type` (
  `id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expense_type`
--

INSERT INTO `expense_type` (`id`, `type`, `created_at`) VALUES
(1, 'Tea cost', '2020-11-09 20:46:24'),
(2, 'Biscuit', '2020-11-09 21:01:18');

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
  `total_amount` float NOT NULL,
  `paid_amount` float NOT NULL,
  `order_created` datetime NOT NULL DEFAULT current_timestamp(),
  `refund_date` datetime NOT NULL,
  `single_refund_date` datetime NOT NULL,
  `order_extra_note` text NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` text DEFAULT NULL,
  `customer_phone` int(15) DEFAULT NULL,
  `customer_address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mi_orders`
--

INSERT INTO `mi_orders` (`order_id`, `order_products_details`, `trx_id`, `total_amount`, `paid_amount`, `order_created`, `refund_date`, `single_refund_date`, `order_extra_note`, `user_id`, `customer_id`, `customer_name`, `customer_phone`, `customer_address`) VALUES
(150, '{\"pro_id\":\"240\",\"pro_qty\":4,\"pro_price\":\"200\",\"discount\":\"5\",\"vat_id\":\"1\",\"vat\":\"5\"}, {\"pro_id\":\"238\",\"pro_qty\":3,\"pro_price\":\"115\",\"discount\":\"2\",\"vat_id\":\"3\",\"vat\":\"10\"}', '79419168343', 1293.88, 1293.88, '2020-11-10 15:27:03', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 1, 90, NULL, NULL, NULL),
(151, '{\"pro_id\":\"240\",\"pro_qty\":1,\"pro_price\":\"200\",\"discount\":\"0\",\"vat_id\":\"0\",\"vat\":null}', '3ddb048b15', 400, 400, '2020-11-10 15:47:02', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 1, 89, NULL, NULL, NULL),
(152, '{\"pro_id\":\"240\",\"pro_qty\":\"3\",\"pro_price\":\"200\",\"discount\":\"0\",\"vat_id\":\"0\",\"vat\":null}', 'f32d69a3518', 600, 0, '2020-11-10 15:55:19', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 1, 0, NULL, NULL, NULL),
(153, '{\"pro_id\":\"240\",\"pro_qty\":2,\"pro_price\":\"200\",\"discount\":\"0\",\"vat_id\":\"0\",\"vat\":null}', '7259dbe6576', 400, 400, '2020-11-10 15:56:43', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 1, 0, NULL, NULL, NULL),
(154, '{\"pro_id\":\"240\",\"pro_qty\":\"2\",\"pro_price\":\"200\",\"discount\":\"0\",\"vat_id\":\"0\",\"vat\":null}', 'a48eb1ca68', 400, 300, '2020-11-10 16:27:37', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 1, 0, NULL, NULL, NULL),
(155, '{\"pro_id\":\"236\",\"pro_qty\":\"3\",\"pro_price\":\"100\",\"discount\":\"5\",\"vat_id\":\"1\",\"vat\":\"5\"}, {\"pro_id\":\"240\",\"pro_qty\":\"2\",\"pro_price\":\"200\",\"discount\":\"2\",\"vat_id\":\"3\",\"vat\":\"10\"}', '009a574a736', 730.45, 0, '2020-11-10 16:44:25', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 1, 0, NULL, NULL, NULL),
(156, '{\"pro_id\":\"239\",\"pro_qty\":\"1\",\"pro_price\":\"120\",\"discount\":\"5\",\"vat_id\":\"1\",\"vat\":\"5\"}, {\"pro_id\":\"237\",\"pro_qty\":\"1\",\"pro_price\":\"110\",\"discount\":\"2\",\"vat_id\":\"3\",\"vat\":\"10\"}', 'f17786b1358', 238.28, 238.28, '2020-11-10 17:36:03', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 1, 0, NULL, NULL, NULL),
(157, '{\"pro_id\":\"240\",\"pro_qty\":\"1\",\"pro_price\":\"200\",\"discount\":\"5\",\"vat_id\":\"1\",\"vat\":\"5\"}, {\"pro_id\":\"238\",\"pro_qty\":\"1\",\"pro_price\":\"115\",\"discount\":\"2\",\"vat_id\":\"3\",\"vat\":\"10\"}', 'b7aec494384', 323.47, 320, '2020-11-10 17:37:16', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 1, 0, NULL, NULL, NULL),
(158, '{\"pro_id\":\"239\",\"pro_qty\":\"1\",\"pro_price\":\"120\",\"discount\":\"0\",\"vat_id\":\"0\",\"vat\":null}, {\"pro_id\":\"240\",\"pro_qty\":\"1\",\"pro_price\":\"200\",\"discount\":\"0\",\"vat_id\":\"0\",\"vat\":null}', '7bd69efa943', 320, 320, '2020-11-10 18:15:20', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 1, 0, NULL, NULL, NULL),
(159, '{\"pro_id\":\"240\",\"pro_qty\":0,\"pro_price\":\"200\",\"discount\":\"0\",\"vat_id\":\"0\",\"vat\":null}, {\"pro_id\":\"238\",\"pro_qty\":\"1\",\"pro_price\":\"115\",\"discount\":\"0\",\"vat_id\":\"0\",\"vat\":null}', 'cfceb794238', 115, 115, '2020-11-10 18:15:37', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 1, 0, NULL, NULL, NULL),
(160, '{\"pro_id\":\"240\",\"pro_qty\":0,\"pro_price\":\"200\",\"discount\":\"0\",\"vat_id\":\"0\",\"vat\":null}, {\"pro_id\":\"238\",\"pro_qty\":\"1\",\"pro_price\":\"115\",\"discount\":\"0\",\"vat_id\":\"0\",\"vat\":null}', '0d137126295', 115, 115, '2020-11-10 18:23:16', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'test', 1, 0, NULL, NULL, NULL),
(161, '{\"pro_id\":\"239\",\"pro_qty\":\"1\",\"pro_price\":\"120\",\"discount\":\"0\",\"vat_id\":\"0\",\"vat\":null}, {\"pro_id\":\"237\",\"pro_qty\":\"1\",\"pro_price\":\"110\",\"discount\":\"0\",\"vat_id\":\"0\",\"vat\":null}', '59d3829492', 230, 230, '2020-11-10 18:41:14', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 1, 0, NULL, NULL, NULL),
(162, '{\"pro_id\":\"239\",\"pro_qty\":\"1\",\"pro_price\":\"120\",\"discount\":\"0\",\"vat_id\":\"0\",\"vat\":null}, {\"pro_id\":\"237\",\"pro_qty\":\"1\",\"pro_price\":\"110\",\"discount\":\"0\",\"vat_id\":\"0\",\"vat\":null}', 'cd7f80d2969', 230, 230, '2020-11-10 18:41:28', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'test1', 1, 0, NULL, NULL, NULL),
(163, '{\"pro_id\":\"240\",\"pro_qty\":\"1\",\"pro_price\":\"200\",\"discount\":\"0\",\"vat_id\":\"0\",\"vat\":null}, {\"pro_id\":\"238\",\"pro_qty\":\"1\",\"pro_price\":\"115\",\"discount\":\"0\",\"vat_id\":\"0\",\"vat\":null}', 'c1345fb7705', 315, 315, '2020-11-10 18:44:27', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'test', 1, 0, NULL, NULL, NULL),
(164, '{\"pro_id\":\"239\",\"pro_qty\":1,\"pro_price\":\"120\",\"discount\":\"2\",\"vat_id\":\"1\",\"vat\":\"5\"}, {\"pro_id\":\"237\",\"pro_qty\":1,\"pro_price\":\"110\",\"discount\":\"5\",\"vat_id\":\"3\",\"vat\":\"10\"}', 'f6fd5473182', 238.43, 238.43, '2020-11-10 19:07:57', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 1, 91, NULL, NULL, NULL),
(165, '{\"pro_id\":\"237\",\"pro_qty\":\"2\",\"pro_price\":\"110\",\"discount\":\"0\",\"vat_id\":\"1\",\"vat\":\"5\"}, {\"pro_id\":\"239\",\"pro_qty\":\"2\",\"pro_price\":\"120\",\"discount\":\"0\",\"vat_id\":\"3\",\"vat\":\"10\"}, {\"pro_id\":\"236\",\"pro_qty\":\"2\",\"pro_price\":\"100\",\"discount\":\"0\",\"vat_id\":\"1\",\"vat\":\"5\"}, {\"pro_id\":\"234\",\"pro_qty\":\"2\",\"pro_price\":\"135\",\"discount\":\"0\",\"vat_id\":\"3\",\"vat\":\"10\"}, {\"pro_id\":\"235\",\"pro_qty\":\"2\",\"pro_price\":\"140\",\"discount\":\"0\",\"vat_id\":\"0\",\"vat\":null}, {\"pro_id\":\"232\",\"pro_qty\":\"1\",\"pro_price\":\"120\",\"discount\":\"0\",\"vat_id\":\"0\",\"vat\":null}, {\"pro_id\":\"238\",\"pro_qty\":\"1\",\"pro_price\":\"115\",\"discount\":\"0\",\"vat_id\":\"0\",\"vat\":null}, {\"pro_id\":\"240\",\"pro_qty\":\"1\",\"pro_price\":\"200\",\"discount\":\"0\",\"vat_id\":\"0\",\"vat\":null}, {\"pro_id\":\"233\",\"pro_qty\":\"1\",\"pro_price\":\"150\",\"discount\":\"0\",\"vat_id\":\"0\",\"vat\":null}', '9a2d6414257', 1867, 1867, '2020-11-11 00:09:31', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 1, 0, NULL, NULL, NULL),
(166, '{\"pro_id\":\"239\",\"pro_qty\":\"2\",\"pro_price\":\"120\",\"discount\":\"0\",\"vat_id\":\"0\",\"vat\":null}, {\"pro_id\":\"237\",\"pro_qty\":\"1\",\"pro_price\":\"110\",\"discount\":\"0\",\"vat_id\":\"0\",\"vat\":null}, {\"pro_id\":\"240\",\"pro_qty\":\"1\",\"pro_price\":\"200\",\"discount\":\"0\",\"vat_id\":\"0\",\"vat\":null}, {\"pro_id\":\"238\",\"pro_qty\":\"1\",\"pro_price\":\"115\",\"discount\":\"0\",\"vat_id\":\"0\",\"vat\":null}', 'e9fa90af940', 665, 665, '2020-11-11 20:42:07', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 1, 0, NULL, NULL, NULL);

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
(232, 'Air Compressor Oils', 120, '5e74d90269546c4fdcd59a8990eaf90fmak-compressor-oil-500x500.png', 499, 1, 47, 16, 1, '2020-11-10 14:21:23', 0, 500, 500, '2020-11-10 15:18:18', '', 80, 'SB-05'),
(233, 'Hydraulic Oil', 150, '5a7911694327ba624169137828e75dd5155285.png', 199, 1, 48, 16, 1, '2020-11-10 14:22:36', 0, 200, 200, '2020-11-10 15:19:22', '', 120, 'SK-101'),
(234, 'Turbine Oil', 135, 'fa11ba6b8f9010f6dbf0ce62936dc77bP66_1Q_TURBINE_OIL_32-1.png', 148, 1, 48, 16, 1, '2020-11-10 14:23:28', 0, 150, 150, '2020-11-10 15:19:54', '', 110, 'ST-002'),
(235, 'Rock Drill Lubricant', 140, 'e503148cf1bd3af800e322ccb91e3c5f20L-ROCK-DRILL-100-460.png', 198, 1, 47, 17, 1, '2020-11-10 14:24:18', 0, 200, 200, '2020-11-10 15:21:08', '', 120, 'SD-005'),
(236, 'Mobil 1', 100, 'b7f9900f46af160e153df8f4df639f09Mobil 1 V Twin Oil 20W 50 fs square md.jpg', 245, 1, 47, 17, 1, '2020-11-10 14:58:50', 0, 250, 250, '2020-11-10 15:21:30', '', 80, '20W-50'),
(237, 'Valvoline Motor Oil', 110, '4a7a251aa741983b183f3f2b4d34dca31155.05.png', 193, 1, 48, 17, 1, '2020-11-10 15:00:43', 0, 200, 200, '2020-11-10 15:22:01', '', 90, 'VM-007'),
(238, 'Pennzoil Motor Oil', 115, 'f232d18c23b3b2e161877dd59304a0c1pennzoil-gt-performance-racing-25w-50.png', 91, 1, 47, 17, 1, '2020-11-10 15:02:01', 0, 100, 100, '2020-11-10 15:22:39', '', 100, 'PM-001'),
(239, 'Amsoil Synthetic Motor Oil', 120, '1642f43985ea6975776ff68f3fe4a8f707ace4ec70536130b0023fd96e63573d.jpg', 141, 1, 48, 17, 1, '2020-11-10 15:03:19', 0, 150, 150, '2020-11-10 15:23:04', '', 105, 'AS-002'),
(240, 'Daphne Marine Oil', 200, '74bb2815a1fa1560c26083efcebe6addIdemitsu-lubricant.png', 181, 1, 47, 18, 1, '2020-11-10 15:06:02', 0, 200, 200, '2020-11-10 15:23:31', '', 180, '15W-40');

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
(47, 'Red', 'red', '', 2, '2020-11-07 16:14:42'),
(48, 'Natural', 'natural', '', 0, '2020-11-07 16:15:11');

-- --------------------------------------------------------

--
-- Table structure for table `mi_product_cart`
--

CREATE TABLE `mi_product_cart` (
  `cart_id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `pro_qty` int(11) NOT NULL,
  `vat_id` int(11) NOT NULL,
  `discount` float NOT NULL,
  `cart_added` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(16, 'Industrial', 'industrial', 'fas fa-archway', 2, '2020-11-07 16:02:10'),
(17, 'Automotive', 'automotive', 'fas fa-ambulance', 2, '2020-11-07 16:02:44'),
(18, 'Marine', 'marine', 'fab fa-docker', 2, '2020-11-07 16:04:01');

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
  `note` text NOT NULL,
  `extra_amount` text DEFAULT NULL,
  `paid` float NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mi_purchase_vat`
--

INSERT INTO `mi_purchase_vat` (`vid`, `vtax`, `vtaxdetails`, `vtaxadded`, `vtaxstatus`, `note`, `extra_amount`, `paid`, `user_id`) VALUES
(1, 5, 'VAT', '2019-08-22 01:14:47', 1, 'Extra Note and Add/Less Details', '0', 0, 1),
(3, 10, 'Tax', '2019-08-22 01:14:47', 1, 'Extra Note and Add/Less Details', '0', 0, 1);

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
(69, 5, 232, 500, '', '', 40000, 80, 0, '', '2020-11-10 15:18:17', '0000-00-00 00:00:00', ''),
(70, 5, 233, 200, '', '', 24000, 120, 0, '', '2020-11-10 15:19:22', '0000-00-00 00:00:00', ''),
(71, 5, 234, 150, '', '', 16500, 110, 0, '', '2020-11-10 15:19:54', '0000-00-00 00:00:00', ''),
(72, 5, 235, 200, '', '', 24000, 120, 0, '', '2020-11-10 15:21:08', '0000-00-00 00:00:00', ''),
(73, 5, 236, 250, '', '', 20000, 80, 0, '', '2020-11-10 15:21:30', '0000-00-00 00:00:00', ''),
(74, 5, 237, 200, '', '', 18000, 90, 0, '', '2020-11-10 15:22:01', '0000-00-00 00:00:00', ''),
(75, 5, 238, 100, '', '', 10000, 100, 0, '', '2020-11-10 15:22:39', '0000-00-00 00:00:00', ''),
(76, 5, 239, 150, '', '', 15750, 105, 0, '', '2020-11-10 15:23:04', '0000-00-00 00:00:00', ''),
(77, 5, 240, 200, '', '', 36000, 180, 0, '', '2020-11-10 15:23:31', '0000-00-00 00:00:00', '');

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
  `type_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `user_id` int(5) NOT NULL,
  `expense_date` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `regular_expenses`
--

INSERT INTO `regular_expenses` (`id`, `type_id`, `amount`, `user_id`, `expense_date`, `created_at`) VALUES
(8, 2, 125, 1, '2020-10-08 22:09:43', '2020-11-09 21:11:00'),
(9, 1, 500, 1, '2020-10-03 01:25:41', '2020-11-09 20:50:08');

-- --------------------------------------------------------

--
-- Table structure for table `sales_meta`
--

CREATE TABLE `sales_meta` (
  `id` int(11) NOT NULL,
  `paid_amount` float DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `note` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(1, 'shop_logo', 'uploads/settings-img/428ea692ce174a13f4f01d24e15a1340castrol.png', 'image'),
(2, 'shop_address', 'Taher Tower Shopping Center, Suite-306 (2nd Floor) ', 'shop_details'),
(3, 'shop_email', 'contact@softminion.com', 'shop_details'),
(4, 'shop_phone', '01976-301-581', 'shop_details'),
(5, 'shop_note', 'Thank you for your business!  Payment is expected within 31 days; ', 'shop_details'),
(6, 'footer_text', 'Soft Minion', 'footer'),
(7, 'shop_currency', 'Tk', 'currency'),
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
-- Indexes for table `expense_type`
--
ALTER TABLE `expense_type`
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
-- Indexes for table `sales_meta`
--
ALTER TABLE `sales_meta`
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
-- AUTO_INCREMENT for table `expense_type`
--
ALTER TABLE `expense_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- AUTO_INCREMENT for table `mi_products`
--
ALTER TABLE `mi_products`
  MODIFY `pro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=241;

--
-- AUTO_INCREMENT for table `mi_product_brand`
--
ALTER TABLE `mi_product_brand`
  MODIFY `br_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `mi_product_cart`
--
ALTER TABLE `mi_product_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=400;

--
-- AUTO_INCREMENT for table `mi_product_category`
--
ALTER TABLE `mi_product_category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `mi_product_suppliers`
--
ALTER TABLE `mi_product_suppliers`
  MODIFY `sup_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mi_purchase_vat`
--
ALTER TABLE `mi_purchase_vat`
  MODIFY `vid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mi_stocks`
--
ALTER TABLE `mi_stocks`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `mi_users`
--
ALTER TABLE `mi_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `regular_expenses`
--
ALTER TABLE `regular_expenses`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sales_meta`
--
ALTER TABLE `sales_meta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `settings_meta`
--
ALTER TABLE `settings_meta`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
