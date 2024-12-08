-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 08, 2024 lúc 04:28 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `clothing_store`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_name`) VALUES
(10, 'Áo'),
(11, 'Quần'),
(12, 'Đầm'),
(13, 'Chân váy');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cart_code` varchar(10) NOT NULL,
  `cart_status` tinyint(1) DEFAULT NULL,
  `cart_date` datetime DEFAULT current_timestamp(),
  `total_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `cart_payment` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `cart_code`, `cart_status`, `cart_date`, `total_amount`, `cart_payment`) VALUES
(1, 19, '2441', 2, '2024-12-02 23:49:18', 1790000.00, 'VNPAY'),
(2, 19, '3885', 2, '2024-12-02 23:49:37', 0.00, 'VNPAY'),
(3, 19, '1758', 2, '2024-12-02 23:49:46', 0.00, 'MOMO'),
(4, 19, '4109', 2, '2024-12-02 23:50:33', 2380000.00, 'MOMO'),
(5, 19, '3776', 2, '2024-12-02 23:50:58', 4980000.00, 'MOMO-ATM'),
(6, 19, '2667', 0, '2024-12-02 23:56:42', 2490000.00, 'COD'),
(7, 19, '6189', 0, '2024-12-02 23:58:31', 0.00, 'COD'),
(8, 19, '1965', 0, '2024-12-04 23:05:04', 1190000.00, 'COD'),
(9, 19, '1956', 0, '2024-12-04 23:06:39', 5950000.00, 'COD'),
(10, 19, '8044', 0, '2024-12-04 23:06:56', 5950000.00, 'COD');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart_details`
--

CREATE TABLE `cart_details` (
  `cart_details_id` int(11) NOT NULL,
  `cart_code` varchar(10) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `size` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `cart_details`
--

INSERT INTO `cart_details` (`cart_details_id`, `cart_code`, `product_id`, `quantity`, `size`) VALUES
(1, '2441', 40, 1, 'S'),
(2, '4109', 39, 1, 'XXL'),
(3, '3776', 44, 1, 'XL'),
(4, '2667', 44, 1, 'L'),
(5, '1965', 39, 1, 'S'),
(6, '8044', 39, 5, 'S');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `momo`
--

CREATE TABLE `momo` (
  `id_momo` int(11) NOT NULL,
  `partner_code` varchar(50) NOT NULL,
  `order_code` varchar(8) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `order_info` varchar(100) NOT NULL,
  `order_type` varchar(50) NOT NULL,
  `trans_id` int(11) NOT NULL,
  `pay_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `momo`
--

INSERT INTO `momo` (`id_momo`, `partner_code`, `order_code`, `amount`, `order_info`, `order_type`, `trans_id`, `pay_type`) VALUES
(1, 'MOMOBKUN20180529', '3776', '2490000', 'Thanh toán qua MoMo ATM', 'momo_wallet', 2147483647, 'napas'),
(2, 'MOMOBKUN20180529', '3776', '2490000', 'Thanh toán qua MoMo ATM', 'momo_wallet', 2147483647, 'napas'),
(3, 'MOMOBKUN20180529', '3776', '2490000', 'Thanh toán qua MoMo ATM', 'momo_wallet', 2147483647, 'napas'),
(4, 'MOMOBKUN20180529', '3776', '2490000', 'Thanh toán qua MoMo ATM', 'momo_wallet', 2147483647, 'napas');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_description` text DEFAULT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `product_sale` int(11) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_image` varchar(255) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `product_color_image` varchar(255) DEFAULT NULL,
  `product_color_name` varchar(255) DEFAULT NULL,
  `remarkable` tinyint(1) DEFAULT 0,
  `price_sale` decimal(10,2) GENERATED ALWAYS AS (`product_price` - `product_price` * `product_sale` / 100) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_description`, `product_price`, `product_sale`, `product_quantity`, `product_image`, `brand_id`, `created_at`, `updated_at`, `product_color_image`, `product_color_name`, `remarkable`) VALUES
(26, 'Chân váy bút chì Lam cobalt', '\r\nDòng sản phẩm	You\r\nNhóm sản phẩm	Zuýp\r\nKiểu dáng	Bút chì\r\nĐộ dài	Qua gối\r\nHọa tiết	Trơn\r\nChất liệu	Tweed', 1190000.00, 11, 50, 'chân váy bút chì lam cobalt.webp', 13, '2024-10-31 15:11:23', '2024-12-04 16:00:30', 'xanh dương đậm.png', 'Xanh dương ', 0),
(27, 'Đầm lụa xòe tay dài Hoa Pháp', 'Dòng sản phẩm	Ladies\r\nNhóm sản phẩm	Đầm\r\nCổ áo	Cổ tròn\r\nTay áo	Tay dài\r\nKiểu dáng	Đầm xòe\r\nĐộ dài	Ngang bắp\r\nHọa tiết	Hoa,Họa tiết khác\r\nChất liệu	Lụa', 2290000.00, 12, 50, 'Đầm lụa xòe tay dài Hoa Pháp.webp', 12, '2024-10-31 15:33:13', '2024-12-04 16:00:32', 'họa tiết đen.png', 'Họa tiết ', 0),
(28, 'Chân váy lụa xòe Hoa Pháp', 'Dòng sản phẩm	You\r\nNhóm sản phẩm	Zuýp\r\nKiểu dáng	Xòe\r\nĐộ dài	Ngang bắp\r\nHọa tiết	Hoa\r\nChất liệu	Lụa', 1190000.00, 13, 50, 'Chân váy lụa xòe Hoa Pháp.webp', 13, '2024-11-01 00:58:31', '2024-12-04 16:00:33', 'Họa tiết xanh tím than.png', 'Họa tiết xanh tím ', 0),
(29, 'Chân váy lụa xòe Hoa Pháp', 'Dòng sản phẩm	You\r\nNhóm sản phẩm	Zuýp\r\nKiểu dáng	Xòe\r\nĐộ dài	Ngang bắp\r\nHọa tiết	Hoa\r\nChất liệu	Lụa', 1190000.00, 14, 50, 'Chân váy lụa xòe Hoa Pháp.webp', 13, '2024-11-01 00:58:45', '2024-12-04 16:00:34', 'Họa tiết xanh tím than.png', 'Họa tiết xanh tím ', 0),
(33, 'Áo Gile cổ V Dreamy', '1234', 1090000.00, 15, 50, '1731248938_2deaf42598c03e52ce5ea03b719b2d6c.webp', 10, '2024-11-10 14:25:47', '2024-12-04 16:00:35', '1731248938_001.png', 'Trắng', 0),
(35, 'Chân váy Khaki xếp ly', '', 1090000.00, 16, 50, '0bdbc3a8914938b6634499d2ce62768f.webp', 13, '2024-11-10 14:38:48', '2024-12-04 16:00:36', '001.png', 'Trắng', 1),
(39, 'Áo sơ mi Tuysi Peplum', '', 1190000.00, 17, 45, '9769693273954987ecba8cc04d916484.webp', 10, '2024-11-10 14:46:06', '2024-12-04 16:06:56', '001.png', 'Trắng', 0),
(40, 'Đầm lụa chấm bi Lucille', '', 1790000.00, 18, 50, '43b404093e20713a23bfb10cea798ab6.webp', 12, '2024-11-10 14:48:08', '2024-12-04 16:00:40', '049.png', 'Đen', 1),
(44, 'Đầm ôm cổ kiểu Pauline', '', 2490000.00, 19, 50, 'a2e5f733eb62034ff70bcd9015b09cb8.webp', 12, '2024-11-10 14:58:38', '2024-12-04 16:00:41', '003.png', 'Be', 1),
(45, 'Đầm xòe Rosalie', '', 2390000.00, 20, 50, '1cc773085f22bcda0562d5877edb1a9a.webp', 12, '2024-11-10 15:00:27', '2024-12-04 16:00:43', '049.png', 'Đen', 0),
(46, 'Đầm xòe Foral Lụa Midi', '', 1890000.00, 1, 50, '1e86e5194b950559f4ee6e0e6005e730.webp', 12, '2024-11-10 15:01:37', '2024-12-04 16:00:44', 'h15.png', 'Hồng kẹo', 1),
(47, '1', '1', 1.00, 1, 1, 'about.webp', 13, '2024-12-04 15:13:35', '2024-12-04 15:13:35', 'about.webp', '1', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_img`
--

CREATE TABLE `product_img` (
  `img_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `img_url` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product_img`
--

INSERT INTO `product_img` (`img_id`, `product_id`, `img_url`, `created_at`) VALUES
(31, 26, 'Chân váy bút chì Lam cobalt mt 1.webp', '2024-10-31 15:11:23'),
(32, 26, 'Chân váy bút chì Lam cobalt mt 2.webp', '2024-10-31 15:11:23'),
(33, 26, 'Chân váy bút chì Lam cobalt mt 3.webp', '2024-10-31 15:11:23'),
(34, 26, 'Chân váy bút chì Lam cobalt mt 4.webp', '2024-10-31 15:11:23'),
(35, 27, 'Đầm lụa xòe tay dài Hoa Pháp mt 1.webp', '2024-10-31 15:33:13'),
(36, 27, 'Đầm lụa xòe tay dài Hoa Pháp mt 2.webp', '2024-10-31 15:33:13'),
(37, 27, 'Đầm lụa xòe tay dài Hoa Pháp mt 3.webp', '2024-10-31 15:33:13'),
(38, 27, 'Đầm lụa xòe tay dài Hoa Pháp mt 4.webp', '2024-10-31 15:33:13'),
(39, 28, 'Chân váy lụa xòe Hoa Pháp mt1.webp', '2024-11-01 00:58:31'),
(40, 29, 'Chân váy lụa xòe Hoa Pháp mt1.webp', '2024-11-01 00:58:45'),
(41, 29, 'Chân váy lụa xòe Hoa Pháp mt2.webp', '2024-11-01 00:58:45'),
(42, 29, 'Chân váy lụa xòe Hoa Pháp mt3.webp', '2024-11-01 00:58:45'),
(43, 29, 'Chân váy lụa xòe Hoa Pháp mt4.webp', '2024-11-01 00:58:45'),
(46, 32, 'visa.png', '2024-11-10 10:58:56'),
(47, 33, '2deaf42598c03e52ce5ea03b719b2d6c.webp', '2024-11-10 14:25:47'),
(48, 33, '4ce4d1ae29f48af60805d539b480c9b6.webp', '2024-11-10 14:25:47'),
(49, 33, '806ab1f1ef7e72bc9a8ca8cdbb1ef9f8.webp', '2024-11-10 14:25:47'),
(50, 33, 'dff8c661ea5131f52425cb0b5bc725d2.webp', '2024-11-10 14:25:47'),
(51, 34, '8c34833b69619165ee72bcb26ff57c08.webp', '2024-11-10 14:37:51'),
(52, 34, '8f54643e282969ac6280122088c80355.webp', '2024-11-10 14:37:51'),
(53, 34, 'b52caa62cd0b0df0684eb590c9531325.webp', '2024-11-10 14:37:51'),
(54, 34, 'bca8b48c107e2152f7d5eba42253c5cf.webp', '2024-11-10 14:37:51'),
(55, 35, '0bdbc3a8914938b6634499d2ce62768f.webp', '2024-11-10 14:38:48'),
(56, 35, '21b39b93058a3b6b1ba163b0f62579b9.webp', '2024-11-10 14:38:48'),
(57, 35, 'd726816d39834550abcd944061e0d533.webp', '2024-11-10 14:38:48'),
(58, 35, 'e16b1f40c4761b2a919da059d590be4c.webp', '2024-11-10 14:38:48'),
(59, 36, '78157ad2040847fb924eed46c4d24a7a.jpg', '2024-11-10 14:41:37'),
(60, 36, 'c1c0cdb2e7ae27d4ba4f59d68bcaaa68.jpg', '2024-11-10 14:41:37'),
(61, 36, 'd2ca4253aefd41a95354f9e571840824.jpg', '2024-11-10 14:41:37'),
(62, 37, '61bb6ee4c5859c1cc47a635010545110.webp', '2024-11-10 14:42:31'),
(63, 37, '8749c4aafa19c8a1cc44ca9afd7fd13b.webp', '2024-11-10 14:42:31'),
(64, 37, 'c697b302b346fe7417c4495b088461d7.webp', '2024-11-10 14:42:31'),
(65, 37, 'de88b283fa13e3ae8573de992d4ef324.webp', '2024-11-10 14:42:31'),
(66, 38, '2cc96023fa747949d90fa0eb94ea4fd9.webp', '2024-11-10 14:45:19'),
(67, 38, '5d7af86554139c33f1a79e780d7d483b.webp', '2024-11-10 14:45:19'),
(68, 38, '49f1ae98c320eb221150b0560206d830.webp', '2024-11-10 14:45:19'),
(69, 38, '7489bc12e861e9c783b43efbcc7d936d.webp', '2024-11-10 14:45:19'),
(70, 39, '9769693273954987ecba8cc04d916484.webp', '2024-11-10 14:46:06'),
(71, 39, 'c3b8da9e5b4e5b0e427443d1374ca6df.webp', '2024-11-10 14:46:06'),
(72, 39, 'd84dbd507e95f16293e28793e86322e8.webp', '2024-11-10 14:46:06'),
(73, 39, 'fa7cc199bc40ae324b3fcc451a1ecb6c.webp', '2024-11-10 14:46:06'),
(74, 40, '43b404093e20713a23bfb10cea798ab6.webp', '2024-11-10 14:48:08'),
(75, 40, '613f4ceee503b65ae0da7f43505850b0.webp', '2024-11-10 14:48:08'),
(76, 40, 'a5a6af1b0c387b54b7c569bf2328a8b3.webp', '2024-11-10 14:48:08'),
(77, 40, 'd22aad650297b077ccf9f7ee491e62f5.webp', '2024-11-10 14:48:08'),
(78, 41, '4d68031b41a83a8d07bd80c16ada3d60.webp', '2024-11-10 14:54:45'),
(79, 41, '50ac43123598deec9b59588f86d1446d.webp', '2024-11-10 14:54:45'),
(80, 41, '81d31b77d637e63354b40c8ec60abb65.webp', '2024-11-10 14:54:45'),
(81, 41, 'dba6d876547e224c945ba57c007fe912.webp', '2024-11-10 14:54:45'),
(82, 42, '5a440309c62e6db0808744d8681465b0.webp', '2024-11-10 14:55:36'),
(83, 42, '5abd2440991255bc749eb79cd11b36ea.webp', '2024-11-10 14:55:36'),
(84, 42, '261febc9f9e9f88e175279b1b3b0dd11.webp', '2024-11-10 14:55:36'),
(85, 42, '427e4551620c117f14845ab4571d8de8.webp', '2024-11-10 14:55:36'),
(86, 43, '14832f4ed6a34024aa5eb70d41b8bbec.webp', '2024-11-10 14:57:47'),
(87, 43, '15365fa6016196188288906e38939d59.webp', '2024-11-10 14:57:47'),
(88, 43, 'c4094c1819a13fff097f1f82987e23e0.webp', '2024-11-10 14:57:47'),
(89, 43, 'cf3710a9c9dc00f35b02ff0400eda679.webp', '2024-11-10 14:57:47'),
(90, 44, '029aad5c56a75b52aedd8145094163e6.webp', '2024-11-10 14:58:38'),
(91, 44, 'a2e5f733eb62034ff70bcd9015b09cb8.webp', '2024-11-10 14:58:38'),
(92, 44, 'e634cd5adee501b1f3517b50d0699ff2.webp', '2024-11-10 14:58:38'),
(93, 44, 'f21ed0bb7da26d6cb4c6cd5e863c8608.webp', '2024-11-10 14:58:38'),
(94, 45, '1cc773085f22bcda0562d5877edb1a9a.webp', '2024-11-10 15:00:27'),
(95, 45, 'cd39572fdbe1babf263b35aa0f174316.webp', '2024-11-10 15:00:27'),
(96, 45, 'd68b9d2bf8376807d69f37c52f1dc328.webp', '2024-11-10 15:00:27'),
(97, 45, 'f03494a6b1649438b7c19e29df9708c6.webp', '2024-11-10 15:00:27'),
(98, 46, '1e86e5194b950559f4ee6e0e6005e730.webp', '2024-11-10 15:01:37'),
(99, 46, '2a17824a833201351bd75a50d3376a2c.webp', '2024-11-10 15:01:37'),
(100, 46, '9aaa93093650bf387b9f50d6115e4e02.webp', '2024-11-10 15:01:37'),
(101, 46, '73b3291b9b2fc2e2122fc0b25487754a.webp', '2024-11-10 15:01:37'),
(102, 47, 'about.webp', '2024-12-04 15:13:35');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_sizes`
--

CREATE TABLE `product_sizes` (
  `size_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `size_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product_sizes`
--

INSERT INTO `product_sizes` (`size_id`, `product_id`, `size_name`) VALUES
(63, 26, 'S'),
(64, 26, 'M'),
(65, 26, 'L'),
(66, 26, 'XL'),
(67, 26, 'XXL'),
(68, 27, 'S'),
(69, 27, 'M'),
(70, 27, 'L'),
(71, 27, 'XL'),
(72, 27, 'XXL'),
(73, 28, 'S'),
(74, 28, 'M'),
(75, 28, 'L'),
(76, 28, 'XL'),
(77, 28, 'XXL'),
(78, 29, 'S'),
(79, 29, 'M'),
(80, 29, 'L'),
(81, 29, 'XL'),
(82, 29, 'XXL'),
(85, 32, 'S'),
(86, 32, 'M'),
(87, 32, 'L'),
(88, 32, 'XL'),
(89, 32, 'XXL'),
(90, 33, 'S'),
(91, 33, 'M'),
(92, 33, 'L'),
(93, 33, 'XL'),
(94, 33, 'XXL'),
(95, 34, 'S'),
(96, 34, 'M'),
(97, 34, 'L'),
(98, 34, 'XL'),
(99, 34, 'XXL'),
(100, 35, 'S'),
(101, 35, 'M'),
(102, 35, 'L'),
(103, 35, 'XL'),
(104, 35, 'XXL'),
(105, 36, 'S'),
(106, 36, 'M'),
(107, 36, 'L'),
(108, 36, 'XL'),
(109, 36, 'XXL'),
(110, 37, 'S'),
(111, 37, 'M'),
(112, 37, 'L'),
(113, 37, 'XL'),
(114, 37, 'XXL'),
(115, 38, 'S'),
(116, 38, 'M'),
(117, 38, 'L'),
(118, 38, 'XL'),
(119, 38, 'XXL'),
(120, 39, 'S'),
(121, 39, 'M'),
(122, 39, 'L'),
(123, 39, 'XL'),
(124, 39, 'XXL'),
(125, 40, 'S'),
(126, 40, 'M'),
(127, 40, 'L'),
(128, 40, 'XL'),
(129, 40, 'XXL'),
(130, 41, 'S'),
(131, 41, 'M'),
(132, 41, 'L'),
(133, 41, 'XL'),
(134, 41, 'XXL'),
(135, 42, 'S'),
(136, 42, 'M'),
(137, 42, 'L'),
(138, 42, 'XL'),
(139, 42, 'XXL'),
(140, 43, 'S'),
(141, 43, 'M'),
(142, 43, 'L'),
(143, 43, 'XL'),
(144, 43, 'XXL'),
(145, 44, 'S'),
(146, 44, 'M'),
(147, 44, 'L'),
(148, 44, 'XL'),
(149, 44, 'XXL'),
(150, 45, 'S'),
(151, 45, 'M'),
(152, 45, 'L'),
(153, 45, 'XL'),
(154, 45, 'XXL'),
(155, 46, 'S'),
(156, 46, 'M'),
(157, 46, 'L'),
(158, 46, 'XL'),
(159, 46, 'XXL'),
(160, 47, 'S');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `shipping`
--

CREATE TABLE `shipping` (
  `shipping_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL,
  `note` varchar(200) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `shipping`
--

INSERT INTO `shipping` (`shipping_id`, `name`, `phone`, `address`, `note`, `user_id`) VALUES
(1, 'Chử Trung Huân', '0387102703', 'Lâm Thao', 'Giao nhanh nhé', 19);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sizes`
--

CREATE TABLE `sizes` (
  `size_id` int(11) NOT NULL,
  `size_name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` tinyint(1) NOT NULL DEFAULT 0,
  `address` varchar(200) NOT NULL,
  `phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`user_id`, `user`, `email`, `pass`, `created_at`, `role`, `address`, `phone`) VALUES
(11, 'admin', '0@0', '$2y$10$97kkR6yiFTAucVrYJPxaNOYg/CHSxmcKpmNTPXU.Wm/jwluVdSHqu', '2024-11-05 04:57:58', 1, '', ''),
(13, 'nam', '2@2', '$2y$10$qy8SVr80zwOIBr71ejRkNO8hCyR/Ufz68KGd/Gg0lZQ2lIO/1tn2.', '2024-11-05 10:35:17', 0, '2', '2'),
(15, 'quan', '10@10', '$2y$10$6WplivjY3zib0PtEj10j1eWhcPktrKduH4NtCHbss0pD2mxl97rpi', '2024-11-18 02:41:48', 0, '1', '1'),
(16, 'nam1', 'ya0058466@gmail.com', '$2y$10$tv1Qlrq3O2LqhsRq1d2G5OPDcVuIF0GafhoAnjbG6rc5RUeYKBGYe', '2024-11-24 13:58:10', 0, '1', '1'),
(19, 'huan', 'huantx33@gmail.com', '$2y$10$liczzHIGc1C2VNWTJVeG8.BIqZ/EdUsfJL1VQGHYcvJaP9sX5MsWK', '2024-11-24 14:24:42', 0, 'Hà Nội', '0798740688');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vnpay`
--

CREATE TABLE `vnpay` (
  `vnpay_id` int(11) NOT NULL,
  `vnpay_amount` varchar(50) NOT NULL,
  `vnpay_bankcode` varchar(50) NOT NULL,
  `vnpay_banktranno` varchar(50) NOT NULL,
  `vnpay_cardtype` varchar(50) NOT NULL,
  `vnpay_orderinfo` varchar(100) NOT NULL,
  `vnpay_paydate` varchar(50) NOT NULL,
  `vnpay_tmncode` varchar(50) NOT NULL,
  `vnpay_transactionno` varchar(50) NOT NULL,
  `cart_code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Chỉ mục cho bảng `cart_details`
--
ALTER TABLE `cart_details`
  ADD PRIMARY KEY (`cart_details_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `momo`
--
ALTER TABLE `momo`
  ADD PRIMARY KEY (`id_momo`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Chỉ mục cho bảng `product_img`
--
ALTER TABLE `product_img`
  ADD PRIMARY KEY (`img_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD PRIMARY KEY (`size_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`shipping_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`user`);

--
-- Chỉ mục cho bảng `vnpay`
--
ALTER TABLE `vnpay`
  ADD PRIMARY KEY (`vnpay_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `cart_details`
--
ALTER TABLE `cart_details`
  MODIFY `cart_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `momo`
--
ALTER TABLE `momo`
  MODIFY `id_momo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT cho bảng `product_img`
--
ALTER TABLE `product_img`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT cho bảng `product_sizes`
--
ALTER TABLE `product_sizes`
  MODIFY `size_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT cho bảng `shipping`
--
ALTER TABLE `shipping`
  MODIFY `shipping_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `vnpay`
--
ALTER TABLE `vnpay`
  MODIFY `vnpay_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
