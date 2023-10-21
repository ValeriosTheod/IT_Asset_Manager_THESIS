-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2023 at 05:12 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database_assetmanager`
--

-- --------------------------------------------------------

--
-- Table structure for table `asset`
--

CREATE TABLE `asset` (
  `asse_id` int(11) NOT NULL,
  `asse_model` varchar(255) DEFAULT NULL,
  `asse_image` blob DEFAULT NULL,
  `cate_id` int(11) DEFAULT NULL,
  `asse_status` int(11) DEFAULT NULL,
  `asse_assigned_to` int(11) DEFAULT NULL,
  `asse_depart_owner` int(11) DEFAULT NULL,
  `asse_user_owner` int(11) DEFAULT NULL,
  `lice_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `asset`
--

INSERT INTO `asset` (`asse_id`, `asse_model`, `asse_image`, `cate_id`, `asse_status`, `asse_assigned_to`, `asse_depart_owner`, `asse_user_owner`, `lice_id`) VALUES
(2, 'Apple MacBook Air 13.3\" (2020) IPS Retina Display (M1/8GB/256GB SSD) Air 13.3', NULL, 1, 3, 100, 3, 107, 1),
(3, 'Apple MacBook Pro 16', NULL, 1, 2, 102, 4, 105, 3),
(4, 'Lenovo IdeaPad 5 Pro 16ACH6 16\" IPS 120Hz (Ryzen 9-5900HX/32GB/1TB SSD/GeForce RTX 3050/W11 Home)', NULL, 1, 2, 101, 2, 104, 4),
(5, 'Dell Vostro 3910 MT Desktop PC (i7-12700/16GB DDR4/512GB SSD/W10 Pro)', NULL, 2, 5, 106, 2, 118, 3),
(6, 'HP Pro Tower 290 G9 Desktop PC (i3-12100/8GB DDR4/256GB SSD/W11 Pro) 6B2X1EA', NULL, 2, 3, 103, 5, 106, 2),
(7, 'Dell Inspiron 3020 Desktop PC (i5-13400/16GB DDR4/512GB SSD/W11 Pro)', NULL, 2, 4, 108, 3, 129, 7),
(8, 'Lenovo ThinkCentre Neo 50s Desktop PC (i5-12400/8GB DDR4/256GB SSD/W11 Pro)', NULL, 2, 1, 109, 4, 111, 9),
(9, 'Apple iPad Pro 2022 12.9\" με WiFi (8GB/128GB)', NULL, 3, 5, 110, 2, 114, 6),
(10, 'Apple iPad Pro 2022 11\" με WiFi (8GB/128GB)', NULL, 3, 1, 112, 1, 113, 6),
(11, 'Samsung Galaxy Tab A8 10.5\" με WiFi (4GB/64GB)', NULL, 3, 2, 125, 5, 130, 5),
(12, 'Xiaomi Redmi Pad 10.61\"  WiFi (4GB/128GB)', NULL, 3, 3, 126, 3, 127, 0),
(13, 'Xiaomi 13 5G Dual SIM (8GB/256GB)', NULL, 4, 1, 115, 2, 128, 8),
(14, 'Samsung Galaxy S23+ 5G Dual SIM (8GB/256GB)', NULL, 4, 2, 126, 5, 116, 9),
(15, 'Apple iPhone 15 5G (6GB/256GB)', NULL, 4, 5, 122, 1, 100, 3),
(16, 'Huawei P60 Pro Dual SIM (8GB/256GB)', NULL, 4, 3, 124, 3, 101, 1),
(17, 'Polycom Trio 8800', NULL, 5, 3, 121, 3, 119, 2),
(18, 'Cisco IP Conference Phone 8832', NULL, 5, 4, 120, 4, 123, 7),
(19, 'Yealink CP960', NULL, 5, 1, 117, 1, 131, 5),
(20, 'Avaya B179', NULL, 5, 4, 104, 4, 127, 8),
(21, 'Dell Ultrasharp U2720Q', NULL, 6, 1, 106, 3, 101, 3),
(22, 'ASUS ProArt PA278QV', NULL, 6, 2, 128, 2, 129, 6),
(23, 'LG 27GL83A-B', NULL, 6, 4, 103, 4, 112, 1),
(24, 'BenQ PD2700U', NULL, 6, 3, 108, 4, 118, 9),
(25, 'Macbook 13.3\'\'', NULL, 1, 3, 105, 5, 102, 10),
(26, 'Macbook 13.3 2025', NULL, 1, 1, 105, 2, 110, 3);

-- --------------------------------------------------------

--
-- Table structure for table `asset_history`
--

CREATE TABLE `asset_history` (
  `ashi_asset_id` int(11) NOT NULL,
  `asse_id` int(11) DEFAULT NULL,
  `ashi_created` datetime DEFAULT NULL,
  `stat_id` int(11) DEFAULT NULL,
  `loca_id` int(11) DEFAULT NULL,
  `ashi_assigned_to` int(11) DEFAULT NULL,
  `ashi_assigned_from` int(11) DEFAULT NULL,
  `status_changed_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `asset_location`
--

CREATE TABLE `asset_location` (
  `asloc_id` int(11) NOT NULL,
  `asse_id` int(11) DEFAULT NULL,
  `loca_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `asset_request`
--

CREATE TABLE `asset_request` (
  `asre_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `cate_id` int(11) DEFAULT NULL,
  `asre_details` varchar(255) DEFAULT NULL,
  `asre_datetime` datetime DEFAULT NULL,
  `asre_approver` int(11) DEFAULT NULL,
  `asre_status` int(11) DEFAULT NULL,
  `asre_expected_checkin` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `asset_statement`
--

CREATE TABLE `asset_statement` (
  `asst_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `asst_asset_id` int(11) DEFAULT NULL,
  `asst_request_datetime` datetime DEFAULT NULL,
  `stat_id` int(11) DEFAULT NULL,
  `asst_expected_checkin` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cate_id` int(11) NOT NULL,
  `cate_name` varchar(255) DEFAULT NULL,
  `cate_description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cate_id`, `cate_name`, `cate_description`) VALUES
(1, 'Laptops', NULL),
(2, 'Desktops', NULL),
(3, 'Tablets', NULL),
(4, 'Mobile Phones', NULL),
(5, 'Conference Phones', NULL),
(6, 'Displays', NULL),
(8, 'RAM', NULL),
(9, 'HDD/SDD', NULL),
(10, 'GPU', NULL),
(11, 'CPU', NULL),
(12, 'Keyboards', NULL),
(13, 'Mouses', NULL),
(14, 'Speakers', NULL),
(15, 'Headsets', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `compoment_location`
--

CREATE TABLE `compoment_location` (
  `id` int(11) NOT NULL,
  `comp_id` int(11) DEFAULT NULL,
  `loca_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `compoment_location`
--

INSERT INTO `compoment_location` (`id`, `comp_id`, `loca_id`) VALUES
(1, 1, 1),
(2, 2, 5),
(3, 3, 3),
(4, 4, 8),
(5, 5, 10),
(6, 6, 3),
(7, 7, 1),
(8, 8, 3),
(9, 9, 2),
(10, 10, 2),
(11, 11, 5),
(12, 12, 7),
(13, 13, 9),
(14, 14, 4),
(15, 15, 6),
(16, 16, 6),
(17, 17, 2),
(18, 18, 1),
(19, 19, 10),
(20, 20, 1),
(21, 21, 5),
(22, 1, 3),
(23, 2, 4),
(24, 3, 5),
(25, 4, 8),
(26, 5, 7),
(27, 6, 1),
(28, 7, 7),
(29, 8, 2),
(30, 9, 6),
(31, 10, 4),
(32, 11, 7),
(33, 12, 1),
(34, 13, 9),
(35, 14, 8),
(36, 15, 3),
(37, 16, 6),
(38, 17, 4),
(39, 18, 1),
(40, 19, 5),
(41, 20, 2);

-- --------------------------------------------------------

--
-- Table structure for table `component`
--

CREATE TABLE `component` (
  `comp_id` int(11) NOT NULL,
  `comp_name` varchar(255) DEFAULT NULL,
  `cate_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `component`
--

INSERT INTO `component` (`comp_id`, `comp_name`, `cate_id`) VALUES
(1, 'Crucial 4GB DDR3L-1600 SODIMM3', 8),
(2, 'Samsung 980 SSD 500GB M.2 NVMe PCI Express 3.0', 9),
(3, 'Kingston NV2 SSD 500GB M.2 NVMe PCI Express 4.0', 9),
(4, 'AMD Ryzen 7 5700G 3.8GHz Επεξεργαστής 8 Πυρήνων για Socket AM4', 11),
(5, 'Intel Core i5-12400F 2.5GHz Επεξεργαστής 6 Πυρήνων για Socket 1700', 11),
(6, 'MSI GeForce GT 730 2GB GDDR3 LP v1 Κάρτα Γραφικών', 10),
(7, 'Gigabyte GeForce RTX 2060 6GB GDDR6 D6 (rev. 2.0) Κάρτα Γραφικών', 10),
(8, 'Crucial MX500 SSD 1TB 2.5\'\' SATA III', 9),
(9, 'Samsung 870 QVO SSD 1TB 2.5\'\' SATA III', 9),
(10, 'Kioxia Exceria SSD 480GB 2.5\'\' SATA III', 9),
(11, 'G.Skill Aegis 32GB DDR4 RAM με 2 Modules (2x16GB) και Ταχύτητα 3200', 8),
(12, 'G.Skill Aegis 16GB DDR4 RAM με 2 Modules (2x8GB) και Ταχύτητα 3200 για Desktop', 8),
(13, 'Crucial 8GB DDR4 RAM με Ταχύτητα 3200 για Laptop', 8),
(14, 'Samsung 980 Pro SSD 1TB M.2 NVMe PCI Express 4.0', 9),
(15, 'Western Digital Blue 2TB HDD Σκληρός Δίσκος 3.5\" SATA III 7200rpm με 256MB', 9),
(16, 'Seagate Barracuda 1TB HDD Σκληρός Δίσκος 3.5\" SATA III 7200rpm με 64MB Cache', 9),
(17, 'Samsung Portable SSD T7 USB 3.2 / USB-C 500GB 2.5\" Metallic Red', 9),
(18, 'AMD Ryzen 7 7700X 4.5GHz Επεξεργαστής 8 Πυρήνων για Socket AM5 σε Κουτί', 11),
(19, 'Intel Core i5-12600K 2.8GHz Επεξεργαστής 10 Πυρήνων για Socket 1700 σε Κουτί', 11),
(20, 'MSI GeForce GTX 1650 4GB GDDR6 D6 Ventus XS OCV1 Κάρτα Γραφικών', 10),
(21, 'Asus Radeon RX 6650 XT 8GB GDDR6 Dual OC Κάρτα Γραφικών', 10),
(22, '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contained_in`
--

CREATE TABLE `contained_in` (
  `coin_contained_id` int(11) NOT NULL,
  `comp_id` int(11) DEFAULT NULL,
  `asse_id` int(11) DEFAULT NULL,
  `coin_quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contained_in`
--

INSERT INTO `contained_in` (`coin_contained_id`, `comp_id`, `asse_id`, `coin_quantity`) VALUES
(6, 13, 10, 5),
(7, 18, 10, 10),
(8, 8, 10, 5);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `depa_id` int(11) NOT NULL,
  `depa_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`depa_id`, `depa_name`) VALUES
(1, 'Client Services'),
(2, 'Human Resources'),
(3, 'Engineering'),
(4, 'Product Manager'),
(5, 'Marketing');

-- --------------------------------------------------------

--
-- Table structure for table `license`
--

CREATE TABLE `license` (
  `lice_id` int(11) NOT NULL,
  `lice_asset_id` int(11) DEFAULT NULL,
  `lice_name` varchar(255) DEFAULT NULL,
  `lice_expiration` date DEFAULT NULL,
  `lice_enabled` date DEFAULT NULL,
  `lice_manufacturer` varchar(255) DEFAULT NULL,
  `lice_total` int(11) DEFAULT NULL,
  `lice_available` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `license`
--

INSERT INTO `license` (`lice_id`, `lice_asset_id`, `lice_name`, `lice_expiration`, `lice_enabled`, `lice_manufacturer`, `lice_total`, `lice_available`) VALUES
(0, NULL, 'TeamViewer', '2023-10-29', '2024-10-28', 'TeamViewer GmbH', 18, 5),
(1, NULL, 'Acrobat', '2023-10-11', '2029-08-08', 'Adobe Inc.', 20, 7),
(2, NULL, 'InDesign', '2023-10-11', '2025-08-22', 'Adobe Inc.', 10, 0),
(3, NULL, 'Microsoft Office', '2023-10-11', '2032-08-22', 'Microsoft Corporation', 20, 13),
(4, NULL, 'Photoshop', '2023-10-11', '2029-08-22', 'Adobe Inc.', 25, 13),
(5, NULL, 'LibreOffice', '2023-10-11', '2024-11-04', 'The Document Foundation', 15, 5),
(6, NULL, 'OpenOffice', '2023-10-18', '2024-11-11', 'Apache Software Foundation', 23, 11),
(7, NULL, 'Zoom', '2023-10-19', '2024-10-19', 'Zoom Video Communications, Inc.', 25, 12),
(8, NULL, 'Dropbox', '0000-00-00', '0000-00-00', 'Dropbox, Inc.', 30, 8),
(9, NULL, 'Skype', '2023-10-15', '2024-12-31', 'Microsoft Corporation', 26, 13),
(10, NULL, 'Evernote', '2023-10-17', '2026-11-24', 'Evernote Corporation', 33, 11);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `loca_id` int(11) NOT NULL,
  `loca_name` varchar(255) DEFAULT NULL,
  `loca_description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`loca_id`, `loca_name`, `loca_description`) VALUES
(1, 'Alejandrinfurt', NULL),
(2, 'Abernathystad', NULL),
(3, 'Marcellusberg', NULL),
(4, 'Lake Aniyaton', NULL),
(5, 'Gerlachport', NULL),
(6, 'New Dorthy', NULL),
(7, 'New Christaton', NULL),
(8, 'Malliehaven', NULL),
(9, 'Jaydeburgh', NULL),
(10, 'Clovismouth', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role_title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_title`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `stat_id` int(11) NOT NULL,
  `stat_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`stat_id`, `stat_name`) VALUES
(1, 'Ready to Deploy'),
(2, 'Deployed'),
(3, 'Pending'),
(4, 'Un-deployable'),
(5, 'Archived');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_username` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `depa_id` int(11) DEFAULT NULL,
  `user_enabled` tinyint(1) DEFAULT NULL,
  `user_notes` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_username`, `firstname`, `lastname`, `role_id`, `user_email`, `depa_id`, `user_enabled`, `user_notes`) VALUES
(0, 'savatheo', 'Savvas', 'Theodoridis', 1, 'savatheo@gmail.com', 2, 1, ''),
(1, 'afroderm', 'Afroditi', 'Dermatidou', 2, 'afroderm@gmail.com', 4, 1, ''),
(100, 'valeretheod', 'Valerios', 'Theodoridis', NULL, 'valeriostheod@gmail.com', NULL, 1, NULL),
(101, 'anestistheod', 'Anestis', 'Theodoridis', NULL, 'anestistheod@gmail.com', NULL, 1, NULL),
(102, 'sofrontheod', 'Sofronis', 'Theodoridis', NULL, 'sofronis91@yahoo.gr', NULL, 1, NULL),
(103, 'alextheod', 'Alexios', 'Theodoridis', NULL, 'alexth2004@gmail.com', NULL, 1, NULL),
(104, 'emmakost', 'Emmanouela', 'Kostaki', NULL, 'emmakost@outlook.com', NULL, 1, NULL),
(105, 'stavrinapap', 'Stavrina', 'Papadopoulou', NULL, 'stavrina98@yahoo.gr', NULL, 1, NULL),
(106, 'pelopas', 'Leonidas', 'Karagianidis', NULL, 'myops95@gmail.com', NULL, 1, NULL),
(107, 'kymanto', 'Antonia', 'Kymtsari', NULL, 'antoniakym@yahoo.gr', NULL, 1, NULL),
(108, 'giangian', 'Ioannis', 'Papapetrou', NULL, 'johnyspap@mail.com', NULL, 1, NULL),
(109, 'livaj', 'Livaj', 'Garcia', NULL, 'livajaek@aekmail.com', NULL, 1, NULL),
(110, 'pinedaorb', 'Orbelin', 'Pineda', NULL, 'pineda13@aekmail.gr', NULL, 1, NULL),
(111, 'araujo11', 'Sergio', 'Araujo', NULL, 'araujo11@aekmail.gr', NULL, 1, NULL),
(112, 'karaflas7', 'Nordin', 'Amrabat', NULL, 'karaflas7', NULL, 1, NULL),
(113, 'vidalavida', 'Domagoj', 'Vida', NULL, 'vidalavida@aekmail.gr', NULL, 1, NULL),
(114, 'zubersteve', 'Steven', 'Zuber', NULL, 'zuber10@aekmail.gr', NULL, 1, NULL),
(115, 'rotalaz', 'Lazaros', 'Rota', NULL, 'lazrota@aekmail.gr', NULL, 1, NULL),
(116, 'jocker', 'Rodolfo', 'Pissaro', NULL, 'jocker24@aekmail.gr', NULL, 1, NULL),
(117, 'messi20', 'Petros', 'Mantalos', NULL, 'messi20@aekmail.gr', NULL, 1, NULL),
(118, 'piliostav', 'Stavros', 'Pilios', NULL, 'piliosstav@aekmail.gr', NULL, 1, NULL),
(119, 'fernades', 'Paolo', 'Fernades', NULL, 'paolofernades@aekmail.gr', NULL, 1, NULL),
(120, 'athanas', 'Georgios', 'Athanasiadis', NULL, 'portiero@aekmail.gr', NULL, 1, NULL),
(121, 'moukoudi', 'Arold', 'Moukoudi', NULL, 'aroldcb@aekmail.gr', NULL, 1, NULL),
(122, 'galano', 'Konstantinos', 'Galanopoulos', NULL, 'kosgala@aekmail.gr', NULL, 1, NULL),
(123, 'knife', 'Theodosis', 'Machairas', NULL, 'knifetheo@aekmai.gr', NULL, 1, NULL),
(124, 'mitoglou', 'Gerasimos', 'Mitoglou', NULL, 'mitoglou@aekmail.gr', NULL, 1, NULL),
(125, 'skondras', 'Spiros', 'Skondras', NULL, 'skondras@aekmail.gr', NULL, 1, NULL),
(126, 'tolisxrist', 'Apostolos', 'Xristopoulos', NULL, 'tolisxrist@aekmail.gr', NULL, 1, NULL),
(127, 'geortheo', 'Georgios', 'Theocharis', NULL, 'geortheo@aekmail.gr', NULL, 1, NULL),
(128, 'nikols', 'Ntemis', 'Nikolaidis', NULL, 'nikols11@aekmail.gr', NULL, 1, NULL),
(129, 'mavros', 'Thomas', 'Mavros', NULL, 'mavros@aekmail.gr', NULL, NULL, NULL),
(130, 'vasilotho', 'Thomas', 'Vasilopoulos', NULL, 'vasilothom@gmail.com', NULL, 1, NULL),
(131, 'liamitrou', 'Paschalia', 'Mitrou', NULL, 'liamitrou', NULL, 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `asset`
--
ALTER TABLE `asset`
  ADD PRIMARY KEY (`asse_id`),
  ADD KEY `lice_id` (`lice_id`),
  ADD KEY `asse_depart_owner` (`asse_depart_owner`),
  ADD KEY `asse_user_owner` (`asse_user_owner`),
  ADD KEY `cate_id` (`cate_id`),
  ADD KEY `asset_ibfk_5` (`asse_status`),
  ADD KEY `asset_ibfk_6` (`asse_assigned_to`);

--
-- Indexes for table `asset_history`
--
ALTER TABLE `asset_history`
  ADD PRIMARY KEY (`ashi_asset_id`),
  ADD KEY `asse_id` (`asse_id`),
  ADD KEY `loca_id` (`loca_id`),
  ADD KEY `ashi_assigned_to` (`ashi_assigned_to`),
  ADD KEY `ashi_assigned_from` (`ashi_assigned_from`);

--
-- Indexes for table `asset_location`
--
ALTER TABLE `asset_location`
  ADD PRIMARY KEY (`asloc_id`),
  ADD KEY `asse_id` (`asse_id`),
  ADD KEY `loca_id` (`loca_id`);

--
-- Indexes for table `asset_request`
--
ALTER TABLE `asset_request`
  ADD PRIMARY KEY (`asre_id`);

--
-- Indexes for table `asset_statement`
--
ALTER TABLE `asset_statement`
  ADD PRIMARY KEY (`asst_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cate_id`);

--
-- Indexes for table `compoment_location`
--
ALTER TABLE `compoment_location`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comp_id` (`comp_id`),
  ADD KEY `loca_id` (`loca_id`);

--
-- Indexes for table `component`
--
ALTER TABLE `component`
  ADD PRIMARY KEY (`comp_id`),
  ADD KEY `component_ibfk1` (`cate_id`);

--
-- Indexes for table `contained_in`
--
ALTER TABLE `contained_in`
  ADD PRIMARY KEY (`coin_contained_id`),
  ADD KEY `comp_id` (`comp_id`),
  ADD KEY `asse_id` (`asse_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`depa_id`);

--
-- Indexes for table `license`
--
ALTER TABLE `license`
  ADD PRIMARY KEY (`lice_id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`loca_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`stat_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `ibfk_1` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `asset`
--
ALTER TABLE `asset`
  MODIFY `asse_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `asset_history`
--
ALTER TABLE `asset_history`
  MODIFY `ashi_asset_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `asset_location`
--
ALTER TABLE `asset_location`
  MODIFY `asloc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `compoment_location`
--
ALTER TABLE `compoment_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `contained_in`
--
ALTER TABLE `contained_in`
  MODIFY `coin_contained_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `loca_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `asset`
--
ALTER TABLE `asset`
  ADD CONSTRAINT `asset_ibfk_1` FOREIGN KEY (`lice_id`) REFERENCES `license` (`lice_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `asset_ibfk_2` FOREIGN KEY (`asse_depart_owner`) REFERENCES `department` (`depa_id`),
  ADD CONSTRAINT `asset_ibfk_3` FOREIGN KEY (`asse_user_owner`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `asset_ibfk_4` FOREIGN KEY (`cate_id`) REFERENCES `category` (`cate_id`),
  ADD CONSTRAINT `asset_ibfk_5` FOREIGN KEY (`asse_status`) REFERENCES `status` (`stat_id`),
  ADD CONSTRAINT `asset_ibfk_6` FOREIGN KEY (`asse_assigned_to`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `asset_history`
--
ALTER TABLE `asset_history`
  ADD CONSTRAINT `asset_history_ibfk_1` FOREIGN KEY (`asse_id`) REFERENCES `asset` (`asse_id`),
  ADD CONSTRAINT `asset_history_ibfk_2` FOREIGN KEY (`loca_id`) REFERENCES `location` (`loca_id`),
  ADD CONSTRAINT `asset_history_ibfk_3` FOREIGN KEY (`ashi_assigned_to`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `asset_history_ibfk_4` FOREIGN KEY (`ashi_assigned_from`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `asset_location`
--
ALTER TABLE `asset_location`
  ADD CONSTRAINT `asset_location_ibfk_1` FOREIGN KEY (`asse_id`) REFERENCES `asset` (`asse_id`),
  ADD CONSTRAINT `asset_location_ibfk_2` FOREIGN KEY (`loca_id`) REFERENCES `location` (`loca_id`);

--
-- Constraints for table `compoment_location`
--
ALTER TABLE `compoment_location`
  ADD CONSTRAINT `component_location_ibfk_1` FOREIGN KEY (`comp_id`) REFERENCES `component` (`comp_id`),
  ADD CONSTRAINT `component_location_ibfk_2` FOREIGN KEY (`loca_id`) REFERENCES `location` (`loca_id`);

--
-- Constraints for table `component`
--
ALTER TABLE `component`
  ADD CONSTRAINT `component_ibfk1` FOREIGN KEY (`cate_id`) REFERENCES `category` (`cate_id`);

--
-- Constraints for table `contained_in`
--
ALTER TABLE `contained_in`
  ADD CONSTRAINT `contained_in_ibfk_1` FOREIGN KEY (`asse_id`) REFERENCES `asset` (`asse_id`),
  ADD CONSTRAINT `contained_in_ibfk_2` FOREIGN KEY (`comp_id`) REFERENCES `component` (`comp_id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
