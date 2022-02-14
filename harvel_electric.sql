-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 14, 2022 at 11:46 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `harvel_electric`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` bigint(20) NOT NULL,
  `username` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin', '6ac7d77f8bf7fd473acfae31e0bebc72', '2022-02-13 09:06:08', '2022-02-13 09:06:08');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `parent_id`, `created_at`, `updated_at`) VALUES
(3, 'Mật ong', 'Mật ong đến từ pHú tộ', 4, '2022-02-12 18:06:00', '2022-02-12 18:06:00'),
(4, 'Sáp ong từ Bắc Ninh', 'sáp ong đến từ bà rịa, bla bla', 0, '2022-02-12 18:06:42', '2022-02-12 18:06:42');

--
-- Triggers `categories`
--
DELIMITER $$
CREATE TRIGGER `delete_related_products_by_categories` BEFORE DELETE ON `categories` FOR EACH ROW DELETE from products where products.category_id = OLD.id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_02_07_141655_create_products_table', 1),
(6, '2022_02_07_141830_create_shops_table', 1),
(7, '2022_02_07_141901_create_categories_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` bigint(20) NOT NULL,
  `image` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `feature_sum` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `srs_file` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Triggers `products`
--
DELIMITER $$
CREATE TRIGGER `delete_in_product_shop_of_products` BEFORE DELETE ON `products` FOR EACH ROW DELETE from product_shop where product_shop.product_id = OLD.id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `product_shop`
--

CREATE TABLE `product_shop` (
  `product_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

CREATE TABLE `shops` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`id`, `name`, `address`, `owner`, `email`, `created_at`, `updated_at`) VALUES
(52, 'AAA Pharmaceutical, Inc.', '6 Park Meadow Court, bla', 'Jana Bresman', 'jbresman1@eepurl.com', '2022-02-12 17:42:09', '2022-02-12 17:42:09'),
(53, 'Bryant Ranch Prepack', '7 Service Plaza', 'Bebe Lorne', 'blorne2@yellowpages.com', '2022-02-12 17:42:09', '2022-02-12 17:42:09'),
(54, 'Nelco Laboratories, Inc.', '2 Shasta Trail', 'Gabrila Blaksley', 'gblaksley3@intel.com', '2022-02-12 17:42:09', '2022-02-12 17:42:09'),
(55, 'Unit Dose Services', '5137 Veith Parkway', 'Philippe Bletso', 'pbletso4@merriam-webster.com', '2022-02-12 17:42:09', '2022-02-12 17:42:09'),
(56, 'Upsher-Smith Laboratories, Inc.', '73061 Kings Alley', 'Helen-elizabeth Tamblingson', 'htamblingson5@patch.com', '2022-02-12 17:42:09', '2022-02-12 17:42:09'),
(57, 'Jubilant HollisterStier LLC', '166 Red Cloud Street', 'Doro Dingivan', 'ddingivan6@unicef.org', '2022-02-12 17:42:10', '2022-02-12 17:42:10'),
(58, 'Par Pharmaceutical Inc.', '039 Starling Court', 'Sumner Trembath', 'strembath7@japanpost.jp', '2022-02-12 17:42:10', '2022-02-12 17:42:10'),
(59, 'Preferred Pharmaceuticals, Inc', '7541 American Park', 'Brendis Chown', 'bchown8@reddit.com', '2022-02-12 17:42:10', '2022-02-12 17:42:10'),
(62, 'Wal-Mart Stores Inc', '83287 Grim Street', 'Allys Grigoli', 'agrigolib@topsy.com', '2022-02-12 17:42:10', '2022-02-12 17:42:10'),
(63, 'Rebel Distributors Corp.', '22 Arizona Center', 'Selig Dummigan', 'sdummiganc@europa.eu', '2022-02-12 17:42:10', '2022-02-12 17:42:10'),
(64, 'Advance Pharmaceutical Inc.', '54 Grasskamp Center', 'Allissa Lilburn', 'alilburnd@guardian.co.uk', '2022-02-12 17:42:10', '2022-02-12 17:42:10'),
(65, 'H E B', '081 Columbus Avenue', 'Pasquale Dobrowlski', 'pdobrowlskie@walmart.com', '2022-02-12 17:42:10', '2022-02-12 17:42:10'),
(66, 'Preferred Pharmaceuticals, Inc', '456 Waubesa Hill', 'Mattheus Jellico', 'mjellicof@scribd.com', '2022-02-12 17:42:10', '2022-02-12 17:42:10'),
(67, 'Bausch & Lomb Incorporated', '96 Crowley Crossing', 'Whit Cayzer', 'wcayzerg@pcworld.com', '2022-02-12 17:42:11', '2022-02-12 17:42:11'),
(68, 'Aphena Pharma Solutions - Tennessee, LLC', '4754 Eastwood Lane', 'Ferdy Althrope', 'falthropeh@deliciousdays.com', '2022-02-12 17:42:11', '2022-02-12 17:42:11'),
(69, 'Rising Pharmaceuticals, Inc.', '73 Rowland Park', 'Bobbye Gurnee', 'bgurneei@istockphoto.com', '2022-02-12 17:42:11', '2022-02-12 17:42:11'),
(70, 'Gurwitch Products', '5804 Grasskamp Drive', 'Lorita Slavin', 'lslavinj@opera.com', '2022-02-12 17:42:11', '2022-02-12 17:42:11'),
(71, 'Novartis Pharmaceuticals Corporation', '6 Veith Junction', 'Leyla Goodsal', 'lgoodsalk@booking.com', '2022-02-12 17:42:11', '2022-02-12 17:42:11'),
(72, 'Franklin Pharmaceutical LLC', '6 3rd Crossing', 'Ricard Corona', 'rcoronal@time.com', '2022-02-12 17:42:11', '2022-02-12 17:42:11'),
(73, 'Guna spa', '7854 Norway Maple Circle', 'Livy Grennan', 'lgrennanm@istockphoto.com', '2022-02-12 17:42:11', '2022-02-12 17:42:11'),
(74, 'STAT RX USA LLC', '7857 Northwestern Alley', 'Bryan Cawston', 'bcawstonn@ucla.edu', '2022-02-12 17:42:11', '2022-02-12 17:42:11'),
(75, 'Option Labs', '66 Erie Way', 'Coralyn Coomes', 'ccoomeso@geocities.jp', '2022-02-12 17:42:11', '2022-02-12 17:42:11'),
(76, 'Qualitest Pharmaceuticals', '9649 Huxley Terrace', 'Mitchell Melliard', 'mmelliardp@xing.com', '2022-02-12 17:42:11', '2022-02-12 17:42:11'),
(77, 'ARMY AND AIR FORCE EXCHANGE SERVICE', '53 Saint Paul Terrace', 'Penn Kellough', 'pkelloughq@amazon.de', '2022-02-12 17:42:11', '2022-02-12 17:42:11'),
(78, 'Merck Sharp & Dohme Corp.', '944 Fair Oaks Court', 'Andrea Stonary', 'astonaryr@irs.gov', '2022-02-12 17:42:11', '2022-02-12 17:42:11'),
(79, 'Dharma Research, inc.', '07 Memorial Park', 'Annalee Thaim', 'athaims@digg.com', '2022-02-12 17:42:11', '2022-02-12 17:42:11'),
(80, 'AstraZeneca LP', '143 Packers Way', 'Audi Cornu', 'acornut@vinaora.com', '2022-02-12 17:42:11', '2022-02-12 17:42:11'),
(81, 'Teva Parenteral Medicines, Inc.', '064 Carberry Road', 'Valentine Binton', 'vbintonu@illinois.edu', '2022-02-12 17:42:11', '2022-02-12 17:42:11'),
(82, 'RITE AID CORPORATION', '6421 Stephen Terrace', 'Cyndi Martinec', 'cmartinecv@bloglovin.com', '2022-02-12 17:42:11', '2022-02-12 17:42:11'),
(83, 'AR Medicom Inc', '01056 Lotheville Parkway', 'Karyn Meaders', 'kmeadersw@telegraph.co.uk', '2022-02-12 17:42:11', '2022-02-12 17:42:11'),
(84, 'AMERICAN SALES COMPANY', '41816 Northland Lane', 'Burlie Ever', 'beverx@free.fr', '2022-02-12 17:42:11', '2022-02-12 17:42:11'),
(85, 'Mylan Institutional Inc.', '7 Bashford Pass', 'Tessi Crisall', 'tcrisally@aboutads.info', '2022-02-12 17:42:11', '2022-02-12 17:42:11'),
(86, 'American Sales Company', '847 Moulton Junction', 'Ramsey Arney', 'rarneyz@technorati.com', '2022-02-12 17:42:11', '2022-02-12 17:42:11'),
(87, 'McKesson', '5 Mayer Alley', 'Adrian McSperrin', 'amcsperrin10@ocn.ne.jp', '2022-02-12 17:42:12', '2022-02-12 17:42:12'),
(88, 'Guna spa', '2328 Harper Pass', 'Enrica Yukhnov', 'eyukhnov11@salon.com', '2022-02-12 17:42:12', '2022-02-12 17:42:12'),
(89, 'Aurobindo Pharma Limited', '62942 Mosinee Circle', 'Nobe Kellington', 'nkellington12@yahoo.com', '2022-02-12 17:42:12', '2022-02-12 17:42:12'),
(90, 'Rebel Distributors Corp', '501 Mifflin Way', 'Phillida Judge', 'pjudge13@geocities.com', '2022-02-12 17:42:12', '2022-02-12 17:42:12'),
(91, 'Western Family Foods Inc', '98 Bowman Court', 'Coleman Lamberteschi', 'clamberteschi14@ning.com', '2022-02-12 17:42:12', '2022-02-12 17:42:12'),
(92, 'General Injectables & Vaccines, Inc', '29 Northland Terrace', 'Clare Fothergill', 'cfothergill15@mediafire.com', '2022-02-12 17:42:12', '2022-02-12 17:42:12'),
(93, 'KAISER FOUNDATION HOSPITALS', '261 Golden Leaf Crossing', 'Vitia Lawland', 'vlawland16@globo.com', '2022-02-12 17:42:12', '2022-02-12 17:42:12'),
(94, 'Zep Inc.', '7753 Farwell Circle', 'Roselle Stanford', 'rstanford17@google.cn', '2022-02-12 17:42:12', '2022-02-12 17:42:12'),
(95, 'STAT Rx USA LLC', '04246 Anniversary Lane', 'Dalston Drillingcourt', 'ddrillingcourt18@cocolog-nifty.com', '2022-02-12 17:42:12', '2022-02-12 17:42:12'),
(96, 'SHISEIDO AMERICA INC.', '7588 Veith Plaza', 'Milena Chennells', 'mchennells19@usatoday.com', '2022-02-12 17:42:12', '2022-02-12 17:42:12'),
(97, 'Lifetech Resources, LLC', '00 Melody Center', 'Melisenda Follos', 'mfollos1a@posterous.com', '2022-02-12 17:42:12', '2022-02-12 17:42:12'),
(98, 'Teva Pharmaceuticals USA Inc', '824 Bayside Parkway', 'Hamish De Gowe', 'hde1b@paypal.com', '2022-02-12 17:42:12', '2022-02-12 17:42:12'),
(99, 'Teva Pharmaceuticals USA Inc', '275 Jackson Junction', 'Bert Koppe', 'bkoppe1c@cafepress.com', '2022-02-12 17:42:12', '2022-02-12 17:42:12'),
(100, 'RITE AID', '8 Cherokee Park', 'Kienan Welfare', 'kwelfare1d@webmd.com', '2022-02-12 17:42:12', '2022-02-12 17:42:12');

--
-- Triggers `shops`
--
DELIMITER $$
CREATE TRIGGER `delete_in_product_shop_of_shops` BEFORE DELETE ON `shops` FOR EACH ROW DELETE FROM product_shop where product_shop.shop_id = OLD.id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_shop`
--
ALTER TABLE `product_shop`
  ADD PRIMARY KEY (`product_id`,`shop_id`);

--
-- Indexes for table `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `shops`
--
ALTER TABLE `shops`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
