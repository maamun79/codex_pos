-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2020 at 02:34 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.32

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
(171, '{\"pro_id\":\"254\",\"pro_qty\":\"2\",\"pro_price\":\"155\",\"discount\":\"2\",\"vat_id\":\"1\",\"vat\":\"5\"}, {\"pro_id\":\"252\",\"pro_qty\":\"2\",\"pro_price\":\"125\",\"discount\":\"3\",\"vat_id\":\"3\",\"vat\":\"10\"}, {\"pro_id\":\"253\",\"pro_qty\":\"1\",\"pro_price\":\"160\",\"discount\":\"0\",\"vat_id\":\"0\",\"vat\":null}, {\"pro_id\":\"251\",\"pro_qty\":\"1\",\"pro_price\":\"130\",\"discount\":\"0\",\"vat_id\":\"0\",\"vat\":null}', 'e6c493ef744', 875.74, 800, '2020-11-21 19:01:30', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 1, 88, NULL, NULL, NULL),
(172, '{\"pro_id\":\"253\",\"pro_qty\":\"1\",\"pro_price\":\"160\",\"discount\":\"0\",\"vat_id\":\"0\",\"vat\":null}, {\"pro_id\":\"248\",\"pro_qty\":\"1\",\"pro_price\":\"130\",\"discount\":\"0\",\"vat_id\":\"0\",\"vat\":null}', 'eecc9cf8203', 290, 290, '2020-11-21 19:21:14', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 1, 0, NULL, NULL, NULL);

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
(246, 'Valvoline', 150, 'uploads/product/d85b567cf3570db994a63d2e3cd874304a7a251aa741983b183f3f2b4d34dca31155.05.png', 100, 1, 47, 17, 1, '2020-11-21 18:37:57', 0, 100, 100, '2020-11-21 18:52:07', '', 120, 'VL-001'),
(247, 'G-Energy', 120, 'uploads/product/bb99d376d68c5303be8309fcd0f129915a7911694327ba624169137828e75dd5155285.png', 50, 1, 48, 16, 1, '2020-11-21 18:38:53', 0, 50, 50, '2020-11-21 18:53:40', '', 100, 'GE-003'),
(248, 'Compressor Oil', 130, 'uploads/product/d8a14198ce7747e45a7228d7c9b52a4b5e74d90269546c4fdcd59a8990eaf90fmak-compressor-oil-500x500.png', 69, 1, 47, 16, 1, '2020-11-21 18:44:02', 0, 70, 70, '2020-11-21 18:54:14', '', 110, 'CO-002'),
(249, 'Dahne Oil', 150, 'uploads/product/634ad65c66acbe2110626563cbd5c8fb74bb2815a1fa1560c26083efcebe6addIdemitsu-lubricant.png', 80, 1, 47, 17, 1, '2020-11-21 18:44:49', 0, 80, 80, '2020-11-21 18:54:38', '', 120, 'DO-007'),
(250, 'AMS Oil', 120, 'uploads/product/49963d1474432b043eb8a60561ea532a1642f43985ea6975776ff68f3fe4a8f707ace4ec70536130b0023fd96e63573d.jpg', 100, 1, 47, 17, 1, '2020-11-21 18:45:45', 0, 100, 100, '2020-11-21 18:55:23', '', 100, 'SAE -60'),
(251, 'Mobil 1', 130, 'uploads/product/723408082cac8df0ff6316628bb5f02eb7f9900f46af160e153df8f4df639f09Mobil 1 V Twin Oil 20W 50 fs square md.jpg', 89, 1, 47, 17, 1, '2020-11-21 18:47:46', 0, 90, 90, '2020-11-21 18:55:54', '', 115, '20W-50'),
(252, 'Rock Dril Oil', 125, 'uploads/product/8b434bc6d70685a56aff7ea7d02c438ce503148cf1bd3af800e322ccb91e3c5f20L-ROCK-DRILL-100-460.png', 98, 1, 47, 18, 1, '2020-11-21 18:48:30', 0, 100, 100, '2020-11-21 18:56:18', '', 100, 'RD-05'),
(253, 'PennZoil', 160, 'uploads/product/e2041b9aba14ab4d0e93662b5784f85bf232d18c23b3b2e161877dd59304a0c1pennzoil-gt-performance-racing-25w-50.png', 78, 1, 48, 18, 1, '2020-11-21 18:49:30', 0, 80, 80, '2020-11-21 18:56:49', '', 130, 'PO-008'),
(254, 'Turbine Oil', 155, 'uploads/product/15b9134d6c0490eb155f17d59ae00891fa11ba6b8f9010f6dbf0ce62936dc77bP66_1Q_TURBINE_OIL_32-1.png', 98, 1, 48, 18, 1, '2020-11-21 18:50:21', 0, 100, 100, '2020-11-21 18:57:10', '', 140, 'TO-008');

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
  `expanse` float NOT NULL,
  `unit_price` float NOT NULL,
  `ex_paid` float NOT NULL,
  `ex_note` text NOT NULL,
  `upload_date` datetime NOT NULL DEFAULT current_timestamp(),
  `refund_date` datetime NOT NULL,
  `pro_serials` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mi_stocks`
--

INSERT INTO `mi_stocks` (`stock_id`, `supplier_id`, `product_id`, `stock_qty`, `invoice_id`, `invoice_picture`, `expanse`, `unit_price`, `ex_paid`, `ex_note`, `upload_date`, `refund_date`, `pro_serials`) VALUES
(81, 5, 246, 100, '', '', 12000, 120, 12000, '', '2020-11-21 18:52:07', '0000-00-00 00:00:00', ''),
(82, 5, 247, 50, '', '', 5000, 100, 5000, '', '2020-11-21 18:53:40', '0000-00-00 00:00:00', ''),
(83, 5, 248, 70, '', '', 7700, 110, 7700, '', '2020-11-21 18:54:13', '0000-00-00 00:00:00', ''),
(84, 5, 249, 80, '', '', 9600, 120, 9600, '', '2020-11-21 18:54:38', '0000-00-00 00:00:00', ''),
(85, 5, 250, 100, '', '', 10000, 100, 10000, '', '2020-11-21 18:55:23', '0000-00-00 00:00:00', ''),
(86, 5, 251, 90, '', '', 10350, 115, 10350, '', '2020-11-21 18:55:54', '0000-00-00 00:00:00', ''),
(87, 5, 252, 100, '', '', 10000, 100, 10000, '', '2020-11-21 18:56:17', '0000-00-00 00:00:00', ''),
(88, 5, 253, 80, '', '', 10400, 130, 10400, '', '2020-11-21 18:56:49', '0000-00-00 00:00:00', ''),
(89, 5, 254, 100, '', '', 14000, 140, 14000, '', '2020-11-21 18:57:10', '0000-00-00 00:00:00', '');

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
  `user_type` int(11) NOT NULL DEFAULT 3 COMMENT '1=admin;2=accounts; 3=salesman',
  `created_by` int(11) NOT NULL,
  `email` text DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `father_name` varchar(100) DEFAULT NULL,
  `mother_name` varchar(100) DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `nid_no` varchar(100) DEFAULT NULL,
  `nid_photo` text DEFAULT NULL,
  `user_photo` text DEFAULT NULL,
  `salary` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mi_users`
--

INSERT INTO `mi_users` (`id`, `user_id`, `pass`, `user_name`, `user_designation`, `status`, `registered_from`, `user_type`, `created_by`, `email`, `phone`, `father_name`, `mother_name`, `address`, `nid_no`, `nid_photo`, `user_photo`, `salary`) VALUES
(1, 'misujon', '202cb962ac59075b964b07152d234b70', 'Monirul Islam Sujon', 'Admin', 1, '2019-07-18 12:31:43', 1, 0, 'misujon58262@gmail.com', '01676707067', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'gitasad', 'f791c101f3bdc0fc7e6c3b9c9e9c7938', 'S.M. Asad', 'Accounts', 1, '2019-07-18 12:31:43', 2, 1, 'smasad1200@gmail.com', '01842094184', '', '', '', '', '', '', 30000),
(3, 'gitseller', '202cb962ac59075b964b07152d234b70', 'Sales Man', 'Accounts', 1, '2019-07-18 12:31:43', 2, 1, '', '', '', '', '', '', '', '', 10000),
(4, 'akbar', '1c3767545f5231cbebd97aa1fb6ea236', 'M. A. Akber', 'Admin', 1, '2019-07-18 12:31:43', 1, 0, 'git01714094184@gmail.com', '01714094184', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'gitm. a.5', 'dfdd61cf408037e44bcaa0f7afde1801', 'M. A. AKBAR1', 'Accounts', 1, '2019-08-07 18:55:14', 2, 4, 'akbar@geniusit.net', '1714094184', '', '', '', '', '', '', 20000),
(10, 'mamun79', '202cb962ac59075b964b07152d234b70', 'Shafira Rowland', 'Sales Man', 1, '2020-08-12 22:08:14', 3, 1, 'vekofi@mailinator.com', '+1 (553) 877-44', '', '', '', '', '', '', 15000),
(11, 'maamun78', '202cb962ac59075b964b07152d234b70', 'Emery Mullen', 'Sales Man', 1, '2020-08-12 22:09:40', 3, 1, 'gecykiv@mailinator.com', '+1 (403) 759-43', '', '', '', '123456', 'uploads/staff-images/634d585e241b9ca2b07eb19b843c19d7Untitled design.png', 'uploads/staff-images/70126d2f62520bb93fe356771d8e1818user.png', 11000);

-- --------------------------------------------------------

--
-- Table structure for table `regular_expenses`
--

CREATE TABLE `regular_expenses` (
  `id` int(5) NOT NULL,
  `type_id` int(11) DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `user_id` int(5) DEFAULT NULL,
  `expense_date` datetime NOT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `regular_expenses`
--

INSERT INTO `regular_expenses` (`id`, `type_id`, `amount`, `user_id`, `expense_date`, `staff_id`, `type`, `created_at`) VALUES
(8, 2, 125, 1, '2020-10-08 22:09:43', NULL, 'regular', '2020-11-18 17:21:43'),
(9, 1, 500, 1, '2020-10-03 01:25:41', NULL, 'regular', '2020-11-18 17:21:50'),
(16, NULL, 11000, 1, '2020-11-18 10:59:04', 11, 'salary', '2020-11-18 16:59:04'),
(17, NULL, 5000, 1, '2020-11-19 02:18:50', 10, 'salary', '2020-11-18 20:18:51');

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
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;

--
-- AUTO_INCREMENT for table `mi_products`
--
ALTER TABLE `mi_products`
  MODIFY `pro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=255;

--
-- AUTO_INCREMENT for table `mi_product_brand`
--
ALTER TABLE `mi_product_brand`
  MODIFY `br_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `mi_product_cart`
--
ALTER TABLE `mi_product_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=423;

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
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `mi_users`
--
ALTER TABLE `mi_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `regular_expenses`
--
ALTER TABLE `regular_expenses`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `sales_meta`
--
ALTER TABLE `sales_meta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `settings_meta`
--
ALTER TABLE `settings_meta`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
