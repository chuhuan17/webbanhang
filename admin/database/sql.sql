-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2024 at 06:43 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30
CREATE DATABASE IF NOT EXISTS clothing_store DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE clothing_store;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clothing_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_name`) VALUES
(10, 'Áo'),
(11, 'Quần'),
(12, 'Đầm'),
(13, 'Chân váy');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
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
-- Dumping data for table `cart`
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
(10, 19, '8044', 0, '2024-12-04 23:06:56', 5950000.00, 'COD'),
(11, 19, '9172', 0, '2024-12-08 11:36:46', 15020000.00, 'COD');

-- --------------------------------------------------------

--
-- Table structure for table `cart_details`
--

CREATE TABLE `cart_details` (
  `cart_details_id` int(11) NOT NULL,
  `cart_code` varchar(10) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `size` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_details`
--

INSERT INTO `cart_details` (`cart_details_id`, `cart_code`, `product_id`, `quantity`, `size`) VALUES
(1, '2441', 40, 1, 'S'),
(2, '4109', 39, 1, 'XXL'),
(3, '3776', 44, 1, 'XL'),
(4, '2667', 44, 1, 'L'),
(5, '1965', 39, 1, 'S'),
(6, '8044', 39, 5, 'S'),
(7, '9172', 40, 2, 'S'),
(8, '9172', 40, 2, 'L'),
(9, '9172', 44, 1, 'S'),
(10, '9172', 40, 3, 'M');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `message`, `submitted_at`) VALUES
(2, '1', '1@1', '1', '2024-12-08 04:48:29');

-- --------------------------------------------------------

--
-- Table structure for table `momo`
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
-- Dumping data for table `momo`
--

INSERT INTO `momo` (`id_momo`, `partner_code`, `order_code`, `amount`, `order_info`, `order_type`, `trans_id`, `pay_type`) VALUES
(1, 'MOMOBKUN20180529', '3776', '2490000', 'Thanh toán qua MoMo ATM', 'momo_wallet', 2147483647, 'napas'),
(2, 'MOMOBKUN20180529', '3776', '2490000', 'Thanh toán qua MoMo ATM', 'momo_wallet', 2147483647, 'napas'),
(3, 'MOMOBKUN20180529', '3776', '2490000', 'Thanh toán qua MoMo ATM', 'momo_wallet', 2147483647, 'napas'),
(4, 'MOMOBKUN20180529', '3776', '2490000', 'Thanh toán qua MoMo ATM', 'momo_wallet', 2147483647, 'napas');

-- --------------------------------------------------------

--
-- Table structure for table `products`
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
  `price_sale` decimal(10,2) GENERATED ALWAYS AS (`product_price` - `product_price` * `product_sale` / 100) STORED,
  `product_size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_description`, `product_price`, `product_sale`, `product_quantity`, `product_image`, `brand_id`, `created_at`, `updated_at`, `product_color_image`, `product_color_name`, `remarkable`, `product_size`) VALUES
(26, 'Chân váy bút chì Lam cobalt', '\r\nDòng sản phẩm	You\r\nNhóm sản phẩm	Zuýp\r\nKiểu dáng	Bút chì\r\nĐộ dài	Qua gối\r\nHọa tiết	Trơn\r\nChất liệu	Tweed', 1190000.00, 11, 50, 'chân váy bút chì lam cobalt.webp', 13, '2024-10-31 15:11:23', '2024-12-04 16:00:30', 'xanh dương đậm.png', 'Xanh dương ', 0, 0),
(27, 'Đầm lụa xòe tay dài Hoa Pháp', 'Dòng sản phẩm	Ladies\r\nNhóm sản phẩm	Đầm\r\nCổ áo	Cổ tròn\r\nTay áo	Tay dài\r\nKiểu dáng	Đầm xòe\r\nĐộ dài	Ngang bắp\r\nHọa tiết	Hoa,Họa tiết khác\r\nChất liệu	Lụa', 2290000.00, 12, 50, 'Đầm lụa xòe tay dài Hoa Pháp.webp', 12, '2024-10-31 15:33:13', '2024-12-04 16:00:32', 'họa tiết đen.png', 'Họa tiết ', 0, 0),
(28, 'Chân váy lụa xòe Hoa Pháp', 'Dòng sản phẩm	You\r\nNhóm sản phẩm	Zuýp\r\nKiểu dáng	Xòe\r\nĐộ dài	Ngang bắp\r\nHọa tiết	Hoa\r\nChất liệu	Lụa', 1190000.00, 13, 50, 'Chân váy lụa xòe Hoa Pháp.webp', 13, '2024-11-01 00:58:31', '2024-12-04 16:00:33', 'Họa tiết xanh tím than.png', 'Họa tiết xanh tím ', 0, 0),
(29, 'Chân váy lụa xòe Hoa Pháp', 'Dòng sản phẩm	You\r\nNhóm sản phẩm	Zuýp\r\nKiểu dáng	Xòe\r\nĐộ dài	Ngang bắp\r\nHọa tiết	Hoa\r\nChất liệu	Lụa', 1190000.00, 14, 50, 'Chân váy lụa xòe Hoa Pháp.webp', 13, '2024-11-01 00:58:45', '2024-12-04 16:00:34', 'Họa tiết xanh tím than.png', 'Họa tiết xanh tím ', 0, 0),
(33, 'Áo Gile cổ V Dreamy', '1234', 1090000.00, 15, 50, '1731248938_2deaf42598c03e52ce5ea03b719b2d6c.webp', 10, '2024-11-10 14:25:47', '2024-12-04 16:00:35', '1731248938_001.png', 'Trắng', 0, 0),
(35, 'Chân váy Khaki xếp ly', '', 1090000.00, 16, 50, '0bdbc3a8914938b6634499d2ce62768f.webp', 13, '2024-11-10 14:38:48', '2024-12-04 16:00:36', '001.png', 'Trắng', 1, 0),
(39, 'Áo sơ mi Tuysi Peplum', '', 1190000.00, 17, 45, '9769693273954987ecba8cc04d916484.webp', 10, '2024-11-10 14:46:06', '2024-12-04 16:06:56', '001.png', 'Trắng', 0, 0),
(40, 'Đầm lụa chấm bi Lucille', '', 1790000.00, 18, 43, '43b404093e20713a23bfb10cea798ab6.webp', 12, '2024-11-10 14:48:08', '2024-12-08 04:36:46', '049.png', 'Đen', 1, 0),
(44, 'Đầm ôm cổ kiểu Pauline', '', 2490000.00, 19, 49, 'a2e5f733eb62034ff70bcd9015b09cb8.webp', 12, '2024-11-10 14:58:38', '2024-12-08 04:36:46', '003.png', 'Be', 1, 0),
(45, 'Đầm xòe Rosalie', '', 2390000.00, 20, 50, '1cc773085f22bcda0562d5877edb1a9a.webp', 12, '2024-11-10 15:00:27', '2024-12-04 16:00:43', '049.png', 'Đen', 0, 0),
(46, 'Đầm xòe Foral Lụa Midi', '', 1890000.00, 1, 50, '1e86e5194b950559f4ee6e0e6005e730.webp', 12, '2024-11-10 15:01:37', '2024-12-04 16:00:44', 'h15.png', 'Hồng kẹo', 1, 0),
(48, 'Quần suông tuysi', 'Nằm trong BST mùa thu đông 2024, “SOLAR - SHINE TOGETHER” được trình làng với giới mộ điệu như một bản hòa ca tôn vinh tinh thần tự do, sự lạc quan và vẻ đẹp rực rỡ của phái đẹp. Đánh dấu sự chuyển mình của phụ nữ trong thời hiện đại, vượt qua những tiêu chuẩn “kép” áp đặt lên họ.\r\n\r\nNhững thiết kế trong BST hướng tới tôn vinh tính nữ hiện đại thông qua từng đường nét – từ sự mềm mại và duyên dáng đến sự mạnh mẽ và tự chủ. Mỗi sản phẩm đều thể hiện tính kiêu hãnh, đồng thời phá bỏ mọi rào cản để phụ nữ tự do thể hiện cá tính riêng, sống đúng với con người thật của mình.\r\n\r\nSử dụng chất kiệu vải Tuysi mềm nhẹ, thoải mái, thiết kế dáng suông che khuyết điểm tốt giúp nàng tự tin mỗi khi xuất hiện.\r\n\r\nQuần kèm hai túi sườn và độ dài ngang mắt cá chân. Cắt may chỉn chu, tỉ mỉ, nhấn ly giữa độc đáo, tạo điểm nhấn mới lạ cho thiết kế. \r\n\r\nNàng công sở có thể kết hợp với nhiều kiểu áo khác nhau để mang đến những bộ trang phục chỉn chu và lịch sự.  \r\n\r\nThông tin mẫu:\r\n\r\nChiều cao: 165 cm\r\n\r\nCân nặng: 49 kg\r\n\r\nSố đo 3 vòng: 81-63-90 cm\r\n\r\nMẫu mặc size S\r\n\r\nLưu ý: Màu sắc sản phẩm thực tế sẽ có sự chênh lệch nhỏ so với ảnh do điều kiện ánh sáng khi chụp và màu sắc hiển thị qua màn hình máy tính/ điện thoại.', 1490000.00, 10, 10, 'túyi1.webp', 11, '2024-12-10 04:04:43', '2024-12-10 04:04:43', 'túyi6.png', 'Be', 0, 0),
(49, 'Quần kẻ Serge ống suông', 'Chiếc quần Tây hiện đại được pha trộn hoàn hảo giữa phong cách thời trang trẻ trung và sự sang trọng của môi trường công sở. \r\n\r\nThiết kế lưng quần cạp cao kết hợp ống suông giúp tôn lên vóc dáng, mang lại sự thoải mái cho người mặc. Chất liệu vải Serge kết cấu từ các sợi Poly, Rayon, Spandex cùng đặc tính mềm mịn, thoáng mát, co giãn nhẹ, phù hợp cho mọi hoạt động hàng ngày như đi làm, đi chơi.\r\n\r\nHọa tiết kẻ thanh lịch, màu sắc trung tính, quần dễ dàng phối hợp với các loại áo từ áo thun đơn giản đến áo sơ mi, áo blazer để tạo nên vẻ ngoài thời thượng nhưng không kém phần thanh lịch.\r\n\r\nThông tin mẫu:\r\n\r\nChiều cao: 165 cm\r\n\r\nCân nặng: 49 kg\r\n\r\nSố đo 3 vòng: 81-63-90 cm\r\n\r\nMẫu mặc size S\r\n\r\nLưu ý: Màu sắc sản phẩm thực tế sẽ có sự chênh lệch nhỏ so với ảnh do điều kiện ánh sáng khi chụp và màu sắc hiển thị qua màn hình máy tính/ điện thoại.', 1290000.00, 10, 10, 'serge1.webp', 11, '2024-12-10 04:07:51', '2024-12-10 04:07:51', 'serge6.png', 'Kẻ khói', 0, 0),
(50, 'Quần ống đứng DIVAS', 'Thiết kế được lựa chọn trong BST Office Divas, mang đậm dấu ấn phong cách hiện đại dành riêng cho phái đẹp. Ngôn ngữ thiết kế tối giản được điểm xuyết khéo léo bằng các chi tiết cách điệu mềm mại không chỉ nâng tầm vẻ đẹp thanh lịch mà còn thể hiện cá tính độc lập và gu thời trang đẳng cấp.\r\n\r\nQuần Tây dáng ống đứng cổ điển giúp tôn dáng, tạo cảm giác chân dài và vóc dáng cân đối, phù hợp với mọi kiểu dáng cơ thể.\r\n\r\n- Chất liệu Tuysi cao cấp, mềm mại, thoáng mát và bền đẹp\r\n\r\n- Phom dáng ống đứng cổ điển, tôn dáng và tạo cảm giác cân đối\r\n\r\n- Thiết kế tối giản, tinh tế với đường may sắc sảo\r\n\r\n- Dễ phối với nhiều loại trang phục như áo sơ mi, blazer, hoặc áo thun\r\n\r\n- Phù hợp cho các dịp từ công sở, họp hành đến sự kiện trang trọng hoặc dạo phố\r\n\r\nThông tin mẫu:\r\n\r\nChiều cao: 165 cm\r\n\r\nCân nặng: 49 kg\r\n\r\nSố đo 3 vòng: 81-63-90 cm\r\n\r\nMẫu mặc size S\r\n\r\nLưu ý: Màu sắc sản phẩm thực tế sẽ có sự chênh lệch nhỏ so với ảnh do điều kiện ánh sáng khi chụp và màu sắc hiển thị qua màn hình máy tính/ điện thoại.', 1300000.00, 15, 10, 'divas1.webp', 11, '2024-12-10 04:10:12', '2024-12-10 04:10:12', 'divas6.png', 'Đen', 0, 0),
(51, 'Quần Baggy Divas', 'Thiết kế được lựa chọn trong BST Office Divas, mang đậm dấu ấn phong cách hiện đại dành riêng cho phái đẹp. Ngôn ngữ thiết kế tối giản được điểm xuyết khéo léo bằng các chi tiết cách điệu mềm mại không chỉ nâng tầm vẻ đẹp thanh lịch mà còn thể hiện cá tính độc lập và gu thời trang đẳng cấp.\r\n\r\nQuần Baggy Divas với phần hông thoải mái, ống quần nhẹ nhàng thu nhỏ tạo phom thời thượng, vừa giúp tôn dáng và vẫn che khuyết điểm một cách tự nhiên. \r\n\r\n- Chất liệu Tuysi cao cấp, mềm mại, thoáng mát, giữ phom dáng tốt\r\n\r\n- Thiết kế baggy hiện đại, phù hợp với nhiều dáng người\r\n\r\n- Cạp quần vừa vặn, tôn vòng eo và tạo sự thoải mái khi mặc\r\n\r\n- Dễ dàng phối đồ với nhiều loại áo, từ sơ mi thanh lịch đến thun năng động\r\n\r\n- Phù hợp cho nhiều dịp: đi làm, dạo phố, gặp gỡ bạn bè hoặc sự kiện thường ngày\r\n\r\nThông tin mẫu:\r\n\r\nChiều cao: 165 cm\r\n\r\nCân nặng: 49 kg\r\n\r\nSố đo 3 vòng: 81-63-90 cm\r\n\r\nMẫu mặc size S\r\n\r\nLưu ý: Màu sắc sản phẩm thực tế sẽ có sự chênh lệch nhỏ so với ảnh do điều kiện ánh sáng khi chụp và màu sắc hiển thị qua màn hình máy tính/ điện thoại.', 1190000.00, 10, 10, 'baggy1.webp', 11, '2024-12-10 04:12:02', '2024-12-10 04:12:02', 'baggy6.png', 'Be', 0, 0),
(52, 'Quần dài suông Dreamy', 'Thiết kế nằm trong BST Dreamy Bloom, người bạn đồng hành hoàn hảo của phái đẹp, giúp nàng luôn tự tin, sang trọng và phong cách trong mọi khoảnh khắc.\r\n\r\nSử dụng chất kiệu vải Tuysi mềm nhẹ, thoải mái, thiết kế dáng suông che khuyết điểm tốt giúp nàng tự tin mỗi khi xuất hiện.\r\n\r\nQuần kèm hai túi sườn và độ dài ngang mắt cá chân. Cắt may chỉn chu, tỉ mỉ, nhấn ly giữa độc đáo, tạo điểm nhấn mới lạ cho thiết kế. \r\n\r\nNàng công sở có thể kết hợp với nhiều kiểu áo khác nhau để mang đến những bộ trang phục chỉn chu và lịch sự.  \r\n\r\nThông tin mẫu:\r\n\r\nChiều cao: 165 cm\r\n\r\nCân nặng: 49 kg\r\n\r\nSố đo 3 vòng: 81-63-90 cm\r\n\r\nMẫu mặc size S\r\n\r\nLưu ý: Màu sắc sản phẩm thực tế sẽ có sự chênh lệch nhỏ so với ảnh do điều kiện ánh sáng khi chụp và màu sắc hiển thị qua màn hình máy tính/ điện thoại.', 1490000.00, 15, 10, 'dreamy1.webp', 11, '2024-12-10 04:14:05', '2024-12-10 04:14:05', 'dreamy6.png', 'Khói đậm', 0, 0),
(53, 'Quần suông Tuysi Magic', '- Sử dụng chất kiệu vải Tuysi mềm nhẹ, thoải mái, thiết kế che khuyết điểm tốt giúp nàng tự tin mỗi khi xuất hiện.\r\n\r\n- Quần kèm hai túi sườn và độ dài ngang mắt cá chân. Thiết kế chỉn chu, tỉ mỉ, nhấn ly nhẹ nhàng.\r\n\r\n- Nàng công sở có thể kết hợp với nhiều kiểu áo khác nhau để mang đến những bộ trang phục chỉn chu và lịch sự.  \r\n\r\nThông tin mẫu:\r\n\r\nChiều cao: 165 cm\r\n\r\nCân nặng: 49 kg\r\n\r\nSố đo 3 vòng: 81-63-90 cm\r\n\r\nMẫu mặc size S\r\n\r\nLưu ý: Màu sắc sản phẩm thực tế sẽ có sự chênh lệch nhỏ so với ảnh do điều kiện ánh sáng khi chụp và màu sắc hiển thị qua màn hình máy tính/ điện thoại.', 1390000.00, 15, 10, 'tuysi1.webp', 11, '2024-12-10 04:16:04', '2024-12-10 04:16:04', 'tuysi6.png', 'Trắng', 0, 0),
(54, 'Quần ông loe Artiste', 'Thiết kế quần ống loe kết hợp hoàn hảo giữa nét cổ điển và phong cách hiện đại, mang đến vẻ ngoài quyến rũ, thời thượng cho người mặc.\r\n\r\n- Chất liệu Tuysi cao cấp, thoáng mát, mềm mại và giữ phom dáng đẹp\r\n\r\n- Thiết kế ống loe nhẹ nhàng, tôn lên chiều cao và vẻ thanh thoát\r\n\r\n- Cạp cao vừa vặn, tôn vòng eo, phù hợp với nhiều dáng người\r\n\r\n- Dễ dàng phối hợp với các kiểu áo để tạo phong cách khác nhau\r\n\r\n- Phù hợp cho nhiều dịp: đi làm, dạo phố, gặp gỡ bạn bè, hoặc các sự kiện quan trọng\r\n\r\nThông tin mẫu:\r\n\r\nChiều cao: 165 cm\r\n\r\nCân nặng: 49 kg\r\n\r\nSố đo 3 vòng: 81-63-90 cm\r\n\r\nMẫu mặc size S\r\n\r\nLưu ý: Màu sắc sản phẩm thực tế sẽ có sự chênh lệch nhỏ so với ảnh do điều kiện ánh sáng khi chụp và màu sắc hiển thị qua màn hình máy tính/ điện thoại.', 1111111.00, 10, 10, 'artiste1.webp', 11, '2024-12-10 04:18:41', '2024-12-10 04:18:41', 'artiste6.png', 'Đen', 0, 0),
(55, 'Quần Baggy Muse', 'Ánh nắng mùa thu, dù không còn chói chang, vẫn mang đến cảm giác ấm áp, nhẹ nhàng tựa như sự mềm mại và lãng mạn luôn hiện hữu bên trong mỗi người phụ nữ. Đây chính là nguồn cảm hứng chủ đạo cho những thiết kế tinh tế trong BST Muse of the Sun.\r\n\r\nQuần Tuysi ống Baggy cạp cao, độ dài trên ngang mắt cá chân. Ống có độ ôm nhẹ, chiết ly thân trước thanh lịch, trẻ trung. 2 bên quần có 2 túi chéo. \r\n\r\nThiết kế quần phù hợp để nàng phối cùng nhiều item khác nhau, từ thanh lịch công sở với sơ mi cho đến năng động trẻ trung cùng áo thun.\r\n\r\nChất liệu Tuysi thoáng mát và thấm hút mồ hôi tốt. Hơn nữa còn giữ form quần suốt cả ngày dài.\r\n\r\nThông tin mẫu:\r\n\r\nChiều cao: 165 cm\r\n\r\nCân nặng: 49 kg\r\n\r\nSố đo 3 vòng: 81-63-90 cm\r\n\r\nMẫu mặc size S\r\n\r\nLưu ý: Màu sắc sản phẩm thực tế sẽ có sự chênh lệch nhỏ so với ảnh do điều kiện ánh sáng khi chụp và màu sắc hiển thị qua màn hình máy tính/ điện thoại.', 1200000.00, 15, 10, 'muse1.webp', 11, '2024-12-10 04:21:04', '2024-12-10 04:21:04', 'muse6.png', 'Trắng', 0, 0),
(56, 'Quần Tây Poly', 'Quần Tây ống đứng là một item không thể thiếu trong tủ đồ của những ai yêu thích phong cách đơn giản, thanh lịch nhưng vẫn thời trang.\r\n\r\nThiết kế lựa chọn chất liệu Tuysi được dệt từ những sợi Poly cao cấp mang lại độ bền và khả năng giữ dáng tốt. Quần còn có đặc tính thoáng mát, giúp bạn cảm thấy thoải mái cả khi làm việc hay tham gia các sự kiện. \r\n\r\nQuần dáng ống đứng cổ điển, tôn lên vóc dáng thon gọn, tạo cảm giác chuyên nghiệp, chỉn chu cho người mặc. Phần túi sườn thiết kế khéo léo, không chỉ tăng thêm tính tiện dụng mà còn giữ được vẻ ngoài thời thượng và gọn gàng.\r\n\r\nQuần dễ dàng phối hợp với áo sơ mi, blazer hoặc áo thun, mang lại vẻ ngoài tinh tế cho cả công sở lẫn các buổi gặp gỡ quan trọng.\r\n\r\nThông tin mẫu:\r\n\r\nChiều cao: 165 cm\r\n\r\nCân nặng: 49 kg\r\n\r\nSố đo 3 vòng: 81-63-90 cm\r\n\r\nMẫu mặc size S\r\n\r\nLưu ý: Màu sắc sản phẩm thực tế sẽ có sự chênh lệch nhỏ so với ảnh do điều kiện ánh sáng khi chụp và màu sắc hiển thị qua màn hình máy tính/ điện thoại.', 1200000.00, 10, 10, 'poly1.webp', 11, '2024-12-10 04:22:59', '2024-12-10 04:22:59', 'poly6.png', 'Đen', 0, 0),
(57, 'Đầm ôm cổ V', 'Thiết kế được lựa chọn trong BST Office Divas, mang đậm dấu ấn phong cách hiện đại dành riêng cho phái đẹp. Ngôn ngữ thiết kế tối giản được điểm xuyết khéo léo bằng các chi tiết cách điệu mềm mại không chỉ nâng tầm vẻ đẹp thanh lịch mà còn thể hiện cá tính độc lập và gu thời trang đẳng cấp.\r\n\r\nĐầm Opulence nổi bật với phần thân tạo kiểu Gile thời thượng, mang đến vẻ đẹp sang trọng và cá tính. Cổ V kết hợp dáng ôm thanh thoát tôn lên vẻ đẹp người mặc, tạo cảm giác tinh tế mà quyến rũ.\r\n\r\n- Chất liệu Tuysi cao cấp, mềm mại, thoáng mát và giữ phom dáng chuẩn\r\n\r\n- Thiết kế cổ V thanh lịch, tôn dáng và tăng vẻ quyến rũ\r\n\r\n- Thân đầm cách điệu theo kiểu áo gile, mang lại phong cách thời thượng, sang trọng\r\n\r\n- Dáng ôm tôn lên đường cong cơ thể, phù hợp với nhiều dịp\r\n\r\n- Dễ phối hợp với giày cao gót và phụ kiện để tạo nên vẻ ngoài hoàn hảo\r\n\r\nThông tin mẫu:\r\n\r\nChiều cao: 165 cm\r\n\r\nCân nặng: 49 kg\r\n\r\nSố đo 3 vòng: 81-63-90 cm\r\n\r\nMẫu mặc size S\r\n\r\nLưu ý: Màu sắc sản phẩm thực tế sẽ có sự chênh lệch nhỏ so với ảnh do điều kiện ánh sáng khi chụp và màu sắc hiển thị qua màn hình máy tính/ điện thoại.', 999999.00, 15, 10, 'V1.webp', 12, '2024-12-10 05:06:40', '2024-12-10 05:06:40', 'v6.png', 'Đỏ mận', 0, 0),
(58, 'Đầm ôm cổ Pauline', 'Nằm trong BST mùa thu đông 2024, “SOLAR - SHINE TOGETHER” được trình làng với giới mộ điệu như một bản hòa ca tôn vinh tinh thần tự do, sự lạc quan và vẻ đẹp rực rỡ của phái đẹp. Đánh dấu sự chuyển mình của phụ nữ trong thời hiện đại, vượt qua những tiêu chuẩn “kép” áp đặt lên họ.\r\n\r\nNhững thiết kế trong BST hướng tới tôn vinh tính nữ hiện đại thông qua từng đường nét – từ sự mềm mại và duyên dáng đến sự mạnh mẽ và tự chủ. Mỗi sản phẩm đều thể hiện tính kiêu hãnh, đồng thời phá bỏ mọi rào cản để phụ nữ tự do thể hiện cá tính riêng, sống đúng với con người thật của mình.\r\n\r\n- Chất liệu Tuysi cao cấp, co giãn nhẹ, thoải mái và tôn dáng\r\n\r\n- Thiết kế cổ đức cách điệu, mang lại nét trang nhã, thanh lịch\r\n\r\n- Hàng khuy nổi bật ở thân trước, tạo điểm nhấn sang trọng\r\n\r\n- Chi tiết xếp ly ở vai, làm tăng vẻ mềm mại và tinh tế\r\n\r\n- Tay dài phù hợp cho thời tiết se lạnh cùng các dịp trang trọng\r\n\r\nThông tin mẫu:\r\n\r\nChiều cao: 165 cm\r\n\r\nCân nặng: 49 kg\r\n\r\nSố đo 3 vòng: 81-63-90 cm\r\n\r\nMẫu mặc size S Lưu ý: Màu sắc sản phẩm thực tế sẽ có sự chênh lệch nhỏ so với ảnh do điều kiện ánh sáng khi chụp và màu sắc hiển thị qua màn hình máy tính/ điện thoại.', 1300000.00, 15, 10, 'pau1.webp', 12, '2024-12-10 05:08:06', '2024-12-10 05:08:06', 'pau6.png', 'Be', 0, 0),
(59, 'Đầm xòe Rosalie', 'Rosalie  nằm trong BST Her Signature với những chi tiết thiết kế cách điệu tinh tế, kết hợp với họa tiết nhẹ nhàng, thể hiện tuyên ngôn về phong cách thời trang công sở kiểu mới – một phong cách tự tin, thanh lịch nhưng không kém phần duyên dáng.\r\n\r\n- Đầm lựa chọn chất liệu Tuysi cao cấp, mềm mại và thoáng mát, tạo sự thoải mái cho người mặc\r\n\r\n- Thiết kế cổ cách điệu độc đáo, mang lại vẻ thanh lịch, duyên dáng\r\n\r\n- Các chi tiết xếp ly nhẹ nhàng, tạo độ xòe uyển chuyển, tôn lên vẻ đẹp cơ thể\r\n\r\n- Tay dài thanh lịch, phù hợp cho nhiều dịp từ dạo phố đến sự kiện trang trọng\r\n\r\n- Dễ phối với giày cao gót và phụ kiện tinh tế để hoàn thiện phong cách\r\n\r\nThông tin mẫu:\r\n\r\nChiều cao: 165 cm\r\n\r\nCân nặng: 49 kg\r\n\r\nSố đo 3 vòng: 81-63-90 cm\r\n\r\nMẫu mặc size S\r\n\r\nLưu ý: Màu sắc sản phẩm thực tế sẽ có sự chênh lệch nhỏ so với ảnh do điều kiện ánh sáng khi chụp và màu sắc hiển thị qua màn hình máy tính/ điện thoại.', 1200000.00, 10, 10, 'rosa1.webp', 12, '2024-12-10 05:09:51', '2024-12-10 05:09:51', 'rosa6.png', 'Hồng san hô', 0, 0),
(60, 'Đầm lụa chấm bi Lucille', 'Thời thượng, sang trọng trong nền họa tiết chấm bi bắt mắt, thiết kế đầm lụa mới là lựa chọn hoàn hảo cho buổi tiệc, sự kiện hay dạo phố. Chất liệu lụa cao cấp mềm mại, bóng nhẹ giúp đầm ôm vừa vặn, tạo hiệu ứng uyển chuyển, mượt mà theo từng bước đi. \r\n\r\nThiết kế cổ đổ nhẹ nhàng, tay dài phù hợp cho cả những ngày se lạnh. Đầm dễ dàng kết hợp với giày cao gót và các phụ kiện tinh tế để tạo nên vẻ ngoài nổi bật, quyến rũ.\r\n\r\nThông tin mẫu:\r\n\r\nChiều cao: 165 cm\r\n\r\nCân nặng: 49 kg\r\n\r\nSố đo 3 vòng: 81-63-90 cm\r\n\r\nMẫu mặc size S\r\n\r\nLưu ý: Màu sắc sản phẩm thực tế sẽ có sự chênh lệch nhỏ so với ảnh do điều kiện ánh sáng khi chụp và màu sắc hiển thị qua màn hình máy tính/ điện thoại.', 1111111.00, 15, 10, 'lua1.webp', 12, '2024-12-10 05:11:16', '2024-12-10 05:11:16', 'lua6.png', 'Đen', 0, 0),
(61, 'Chân váy Costliness', 'Thiết kế được lựa chọn trong BST Office Divas, mang đậm dấu ấn phong cách hiện đại dành riêng cho phái đẹp. Ngôn ngữ thiết kế tối giản được điểm xuyết khéo léo bằng các chi tiết cách điệu mềm mại không chỉ nâng tầm vẻ đẹp thanh lịch mà còn thể hiện cá tính độc lập và gu thời trang đẳng cấp.\r\n\r\nChân váy Tuysi Costliness mang vẻ đẹp thanh lịch và dịu dàng, là lựa chọn lý tưởng cho những cô nàng yêu thích phong cách nữ tính và sang trọng.\r\n\r\n- Chất liệu Tuysi cao cấp, mềm mại, thoáng mát và giữ phom dáng tốt\r\n\r\n- Dáng xòe nhẹ nhàng, mang lại vẻ nữ tính và uyển chuyển\r\n\r\n- Cạp cao giúp tôn dáng, tạo cảm giác eo thon và chân dài\r\n\r\n- Độ dài qua gối, thanh lịch và phù hợp với nhiều hoàn cảnh\r\n\r\n- Dễ phối hợp với áo sơ mi, áo thun hoặc áo croptop để tạo phong cách đa dạng\r\n\r\nThông tin mẫu:\r\n\r\nChiều cao: 165 cm\r\n\r\nCân nặng: 49 kg\r\n\r\nSố đo 3 vòng: 81-63-90 cm\r\n\r\nMẫu mặc size S\r\n\r\nLưu ý: Màu sắc sản phẩm thực tế sẽ có sự chênh lệch nhỏ so với ảnh do điều kiện ánh sáng khi chụp và màu sắc hiển thị qua màn hình máy tính/ điện thoại.', 1000000.00, 15, 10, 'cost.webp', 13, '2024-12-10 05:22:05', '2024-12-10 05:22:05', 'cost5.png', 'Hồng san hô', 0, 0),
(62, 'Chân váy xòe Jacquard', 'Lựa chọn chất liệu Jacquard cao cấp, kết hợp giữa độ bền và hoa văn dệt nổi tinh xảo, chân váy có độ dày vừa phải, giúp giữ phom dáng tốt, mang lại cảm giác chắc chắn, nhưng vẫn đảm bảo sự mềm mại và thoải mái cho người mặc.Họa tiết chấm bi cổ điển mà sang trọng, thời thượng giúp bạn nổi bật trong bất kỳ dịp nào.\r\n\r\nThiết kế xòe nhẹ nhàng, độ dài vừa phải, tôn lên nét nữ tính và phù hợp với nhiều vóc dáng khác nhau. Bạn có thể dễ dàng kết hợp chân váy với áo sơ mi, áo thun hoặc áo blouse để tạo nên phong cách thời trang vừa thanh lịch vừa quyến rũ.\r\n\r\nThông tin mẫu:\r\n\r\nChiều cao: 165 cm\r\n\r\nCân nặng: 49 kg\r\n\r\nSố đo 3 vòng: 81-63-90 cm\r\n\r\nMẫu mặc size S\r\n\r\nLưu ý: Màu sắc sản phẩm thực tế sẽ có sự chênh lệch nhỏ so với ảnh do điều kiện ánh sáng khi chụp và màu sắc hiển thị qua màn hình máy tính/ điện thoại.', 11111111.00, 11, 10, 'jac1.webp', 13, '2024-12-10 05:23:53', '2024-12-10 05:23:53', 'jac6.png', 'Đen', 0, 0),
(63, 'Chân váy da chữ A', 'Thông tin mẫu:\r\n\r\nChiều cao: 165 cm\r\n\r\nCân nặng: 49 kg\r\n\r\nSố đo 3 vòng: 81-63-90 cm\r\n\r\nMẫu mặc size S\r\n\r\nLưu ý: Màu sắc sản phẩm thực tế sẽ có sự chênh lệch nhỏ so với ảnh do điều kiện ánh sáng khi chụp và màu sắc hiển thị qua màn hình máy tính/ điện thoại.', 1400000.00, 15, 10, 'A1.webp', 13, '2024-12-10 05:25:20', '2024-12-10 05:25:20', 'jac6.png', 'Đen', 0, 0),
(64, 'Chân váy Khaki A', 'Thiết kế được lựa chọn trong BST Office Divas, mang đậm dấu ấn phong cách hiện đại dành riêng cho phái đẹp. Ngôn ngữ thiết kế tối giản được điểm xuyết khéo léo bằng các chi tiết cách điệu mềm mại không chỉ nâng tầm vẻ đẹp thanh lịch mà còn thể hiện cá tính độc lập và gu thời trang đẳng cấp.\r\n\r\nChân váy Khaki A Office là biểu tượng của sự tối giản và thanh lịch, phù hợp cho môi trường công sở cũng như các dịp trang trọng.\r\n\r\n- Chất liệu khaki cao cấp, thoáng mát, bền đẹp và giữ phom tốt\r\n\r\n- Thiết kế dáng chữ A thanh lịch, dễ mặc và tôn dáng\r\n\r\n- Độ dài vừa phải, phù hợp với môi trường công sở và các dịp trang trọng\r\n\r\n- Dễ dàng phối đồ với áo sơ mi, áo thun hoặc blazer để tạo phong cách đa dạng\r\n\r\n- Phù hợp cho nhiều dịp: đi làm, gặp gỡ đối tác hoặc các sự kiện cần sự chỉn chu\r\n\r\nThông tin mẫu:\r\n\r\nChiều cao: 165 cm\r\n\r\nCân nặng: 49 kg\r\n\r\nSố đo 3 vòng: 81-63-90 cm\r\n\r\nMẫu mặc size S\r\n\r\nLưu ý: Màu sắc sản phẩm thực tế sẽ có sự chênh lệch nhỏ so với ảnh do điều kiện ánh sáng khi chụp và màu sắc hiển thị qua màn hình máy tính/ điện thoại.', 1200000.00, 15, 10, 'khaki1.webp', 13, '2024-12-10 05:26:49', '2024-12-10 05:26:49', 'khaki6.png', 'Be', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_img`
--

CREATE TABLE `product_img` (
  `img_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `img_url` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_img`
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
(102, 47, 'about.webp', '2024-12-04 15:13:35'),
(103, 48, 'túyi5.webp', '2024-12-10 04:04:43'),
(104, 48, 'túyi4.webp', '2024-12-10 04:04:43'),
(105, 48, 'túyi3.webp', '2024-12-10 04:04:43'),
(106, 48, 'túyi2.webp', '2024-12-10 04:04:43'),
(107, 49, 'serge5.webp', '2024-12-10 04:07:51'),
(108, 49, 'serge4.webp', '2024-12-10 04:07:51'),
(109, 49, 'serge3.webp', '2024-12-10 04:07:51'),
(110, 49, 'serge2.webp', '2024-12-10 04:07:51'),
(111, 50, 'divas5.webp', '2024-12-10 04:10:12'),
(112, 50, 'divas4.webp', '2024-12-10 04:10:12'),
(113, 50, 'divas3.webp', '2024-12-10 04:10:12'),
(114, 50, 'divas2.webp', '2024-12-10 04:10:12'),
(115, 51, 'baggy5.webp', '2024-12-10 04:12:02'),
(116, 51, 'baggy4.webp', '2024-12-10 04:12:02'),
(117, 51, 'baggy3.webp', '2024-12-10 04:12:02'),
(118, 51, 'baggy2.webp', '2024-12-10 04:12:02'),
(119, 52, 'dreamy5.webp', '2024-12-10 04:14:05'),
(120, 52, 'dreamy4.webp', '2024-12-10 04:14:05'),
(121, 52, 'dreamy3.webp', '2024-12-10 04:14:05'),
(122, 52, 'dreamy2.webp', '2024-12-10 04:14:05'),
(123, 53, 'tuysi5.webp', '2024-12-10 04:16:04'),
(124, 53, 'tuysi4.webp', '2024-12-10 04:16:04'),
(125, 53, 'tuysi3.webp', '2024-12-10 04:16:04'),
(126, 53, 'tuysi2.webp', '2024-12-10 04:16:04'),
(127, 54, 'artiste5.webp', '2024-12-10 04:18:41'),
(128, 54, 'artiste4.webp', '2024-12-10 04:18:41'),
(129, 54, 'artiste3.webp', '2024-12-10 04:18:41'),
(130, 54, 'artiste2.webp', '2024-12-10 04:18:41'),
(131, 55, 'muse5.webp', '2024-12-10 04:21:04'),
(132, 55, 'muse4.webp', '2024-12-10 04:21:04'),
(133, 55, 'muse3.webp', '2024-12-10 04:21:04'),
(134, 55, 'muse2.webp', '2024-12-10 04:21:04'),
(135, 56, 'poly5.webp', '2024-12-10 04:22:59'),
(136, 56, 'poly4.webp', '2024-12-10 04:22:59'),
(137, 56, 'poly3.webp', '2024-12-10 04:22:59'),
(138, 56, 'poly2.webp', '2024-12-10 04:22:59'),
(139, 57, 'v5.webp', '2024-12-10 05:06:40'),
(140, 57, 'v4.webp', '2024-12-10 05:06:40'),
(141, 57, 'v3.webp', '2024-12-10 05:06:40'),
(142, 57, 'V2.webp', '2024-12-10 05:06:40'),
(143, 58, 'pau5.webp', '2024-12-10 05:08:06'),
(144, 58, 'pau4.webp', '2024-12-10 05:08:06'),
(145, 58, 'pau3.webp', '2024-12-10 05:08:06'),
(146, 58, 'pau2.webp', '2024-12-10 05:08:06'),
(147, 59, 'rosa5.webp', '2024-12-10 05:09:51'),
(148, 59, 'rosa4.webp', '2024-12-10 05:09:51'),
(149, 59, 'rosa3.webp', '2024-12-10 05:09:51'),
(150, 59, 'rosa2.webp', '2024-12-10 05:09:51'),
(151, 60, 'lua5.webp', '2024-12-10 05:11:16'),
(152, 60, 'lua4.webp', '2024-12-10 05:11:16'),
(153, 60, 'lua3.webp', '2024-12-10 05:11:16'),
(154, 60, 'lua2.webp', '2024-12-10 05:11:16'),
(155, 61, 'cost4.webp', '2024-12-10 05:22:05'),
(156, 61, 'cost3.webp', '2024-12-10 05:22:05'),
(157, 61, 'cost2.webp', '2024-12-10 05:22:05'),
(158, 61, 'cost1.webp', '2024-12-10 05:22:05'),
(159, 62, 'jac5.webp', '2024-12-10 05:23:53'),
(160, 62, 'jac4.webp', '2024-12-10 05:23:53'),
(161, 62, 'jac3.webp', '2024-12-10 05:23:53'),
(162, 62, 'jac2.webp', '2024-12-10 05:23:53'),
(163, 63, 'A5.webp', '2024-12-10 05:25:20'),
(164, 63, 'A4.webp', '2024-12-10 05:25:20'),
(165, 63, 'A3.webp', '2024-12-10 05:25:20'),
(166, 63, 'A2.webp', '2024-12-10 05:25:20'),
(167, 64, 'khaki5.webp', '2024-12-10 05:26:49'),
(168, 64, 'khaki4.webp', '2024-12-10 05:26:49'),
(169, 64, 'khaki3.webp', '2024-12-10 05:26:49'),
(170, 64, 'khaki2.webp', '2024-12-10 05:26:49');

-- --------------------------------------------------------

--
-- Table structure for table `product_sizes`
--

CREATE TABLE `product_sizes` (
  `size_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `size_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_sizes`
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
(160, 47, 'S'),
(161, 48, 'S'),
(162, 48, 'M'),
(163, 48, 'L'),
(164, 48, 'XL'),
(165, 48, 'XXL'),
(166, 49, 'S'),
(167, 49, 'M'),
(168, 49, 'L'),
(169, 49, 'XL'),
(170, 49, 'XXL'),
(171, 50, 'S'),
(172, 50, 'M'),
(173, 50, 'L'),
(174, 50, 'XL'),
(175, 50, 'XXL'),
(176, 51, 'S'),
(177, 51, 'M'),
(178, 51, 'L'),
(179, 51, 'XL'),
(180, 51, 'XXL'),
(181, 52, 'S'),
(182, 52, 'M'),
(183, 52, 'L'),
(184, 52, 'XL'),
(185, 52, 'XXL'),
(186, 53, 'S'),
(187, 53, 'M'),
(188, 53, 'L'),
(189, 53, 'XL'),
(190, 53, 'XXL'),
(191, 54, 'S'),
(192, 54, 'M'),
(193, 54, 'L'),
(194, 54, 'XL'),
(195, 54, 'XXL'),
(196, 55, 'S'),
(197, 55, 'M'),
(198, 55, 'L'),
(199, 55, 'XL'),
(200, 55, 'XXL'),
(201, 56, 'S'),
(202, 56, 'M'),
(203, 56, 'L'),
(204, 56, 'XL'),
(205, 56, 'XXL'),
(206, 57, 'S'),
(207, 57, 'M'),
(208, 57, 'L'),
(209, 57, 'XL'),
(210, 57, 'XXL'),
(211, 58, 'S'),
(212, 58, 'M'),
(213, 58, 'L'),
(214, 58, 'XL'),
(215, 58, 'XXL'),
(216, 59, 'S'),
(217, 59, 'M'),
(218, 59, 'L'),
(219, 59, 'XL'),
(220, 59, 'XXL'),
(221, 60, 'S'),
(222, 60, 'M'),
(223, 60, 'L'),
(224, 60, 'XL'),
(225, 60, 'XXL'),
(226, 61, 'S'),
(227, 61, 'M'),
(228, 61, 'L'),
(229, 61, 'XL'),
(230, 61, 'XXL'),
(231, 62, 'S'),
(232, 62, 'M'),
(233, 62, 'L'),
(234, 62, 'XL'),
(235, 62, 'XXL'),
(236, 63, 'S'),
(237, 63, 'M'),
(238, 63, 'L'),
(239, 63, 'XL'),
(240, 63, 'XXL'),
(241, 64, 'S'),
(242, 64, 'M'),
(243, 64, 'L'),
(244, 64, 'XL'),
(245, 64, 'XXL');

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
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
-- Dumping data for table `shipping`
--

INSERT INTO `shipping` (`shipping_id`, `name`, `phone`, `address`, `note`, `user_id`) VALUES
(1, '1', '1', '1', '1', 19),
(2, '1', '1', '1', '1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `size_id` int(11) NOT NULL,
  `size_name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
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
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user`, `email`, `pass`, `created_at`, `role`, `address`, `phone`) VALUES
(11, 'admin', '0@0', '$2y$10$97kkR6yiFTAucVrYJPxaNOYg/CHSxmcKpmNTPXU.Wm/jwluVdSHqu', '2024-11-05 04:57:58', 1, '', ''),
(13, 'nam', '2@2', '$2y$10$qy8SVr80zwOIBr71ejRkNO8hCyR/Ufz68KGd/Gg0lZQ2lIO/1tn2.', '2024-11-05 10:35:17', 0, '2', '2'),
(15, 'quan', '10@10', '$2y$10$6WplivjY3zib0PtEj10j1eWhcPktrKduH4NtCHbss0pD2mxl97rpi', '2024-11-18 02:41:48', 0, '1', '1'),
(16, 'nam1', 'ya0058466@gmail.com', '$2y$10$tv1Qlrq3O2LqhsRq1d2G5OPDcVuIF0GafhoAnjbG6rc5RUeYKBGYe', '2024-11-24 13:58:10', 0, '1', '1'),
(19, 'huan', 'huantx33@gmail.com', '$2y$10$liczzHIGc1C2VNWTJVeG8.BIqZ/EdUsfJL1VQGHYcvJaP9sX5MsWK', '2024-11-24 14:24:42', 0, 'Hà Nội', '0798740688');

-- --------------------------------------------------------

--
-- Table structure for table `vnpay`
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
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD PRIMARY KEY (`cart_details_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `momo`
--
ALTER TABLE `momo`
  ADD PRIMARY KEY (`id_momo`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Indexes for table `product_img`
--
ALTER TABLE `product_img`
  ADD PRIMARY KEY (`img_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD PRIMARY KEY (`size_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`shipping_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`user`);

--
-- Indexes for table `vnpay`
--
ALTER TABLE `vnpay`
  ADD PRIMARY KEY (`vnpay_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `cart_details`
--
ALTER TABLE `cart_details`
  MODIFY `cart_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `momo`
--
ALTER TABLE `momo`
  MODIFY `id_momo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `product_img`
--
ALTER TABLE `product_img`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;

--
-- AUTO_INCREMENT for table `product_sizes`
--
ALTER TABLE `product_sizes`
  MODIFY `size_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;

--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `shipping_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `vnpay`
--
ALTER TABLE `vnpay`
  MODIFY `vnpay_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
