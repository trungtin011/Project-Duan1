-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 06, 2024 lúc 01:59 AM
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
-- Cơ sở dữ liệu: `duan2`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `addresses`
--

CREATE TABLE `addresses` (
  `address_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `house_number` varchar(50) NOT NULL,
  `village` varchar(255) NOT NULL,
  `ward` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `addresses`
--

INSERT INTO `addresses` (`address_id`, `user_id`, `name`, `house_number`, `village`, `ward`, `district`, `city`, `phone`, `created_at`) VALUES
(1, 1, 'Nguyễn Văn A', 'Số 10, Đường ABC', 'Thôn 1', 'Phường 2', 'Quận 3', 'Hà Nội', '0987654321', '2024-11-27 03:02:47'),
(2, 2, 'Trần Thị B', 'Số 20, Đường DEF', 'Thôn 2', 'Phường 3', 'Quận 4', 'Hà Nội', '0981234567', '2024-11-27 03:02:47'),
(3, 2, 'Lê Minh C', 'Số 30, Đường GHI', 'Thôn 3', 'Phường 4', 'Quận 5', 'Hà Nội', '0976543210', '2024-11-27 03:02:47'),
(20, 3, 'Y Khoa Êban', 'Buôn Pôk A, Huyện CưMgar, Tỉnh Đắk Lắk ', 'Thôn A, Buôn Pôk A', 'abc', 'CưMgar', 'Buôn mê thuật', '0389195765', '2024-12-04 03:38:15');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`category_id`, `name`, `description`) VALUES
(1, 'Áo', 'High-performance laptops designed for gaming enthusiasts.'),
(2, 'Quần', 'Additional peripherals and tools for better gaming experience.');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories_post`
--

CREATE TABLE `categories_post` (
  `category_post_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories_post`
--

INSERT INTO `categories_post` (`category_post_id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(19, 'Tin Tức Mỗi Ngày', 'fewfew', '2024-11-30 03:58:40', '2024-12-03 01:30:08'),
(26, 'Hóng Drama', 'Lorem ipsum odor amet, consectetuer adipiscing elit. Per senectus nec per molestie vehicula. Arcu auctor adipiscing sed finibus tristique. Leo tincidunt platea ex vehicula volutpat mauris aptent orci tempor. Consectetur tempus purus aptent tincidunt nulla placerat. Quam convallis quisque magnis est nibh aliquet magna.\r\n\r\nUltrices condimentum integer bibendum nec cubilia in. Commodo turpis platea habitasse nam tempor morbi. Commodo nullam eget ullamcorper vivamus fermentum etiam. Netus est magna auctor lobortis massa. Rutrum augue feugiat feugiat nascetur at molestie vulputate porttitor aptent. Cras id nam nullam mi donec urna senectus efficitur. Vivamus posuere arcu; tempor luctus cras nibh metus. Justo ex phasellus sodales hac sem montes.\r\n\r\nId lobortis dictum nisl curabitur venenatis morbi. Odio vulputate et magna ante praesent. Hendrerit sed efficitur taciti ornare; vel commodo commodo sit. Semper euismod velit phasellus cubilia tincidunt fringilla posuere orci. Litora congue luctus varius; ligula fermentum vehicula. Pretium duis platea torquent nunc hac consequat vel est. Fusce aenean venenatis ullamcorper habitant at. Adipiscing ad sociosqu mi; nisl posuere viverra montes. Leo malesuada ultrices sem viverra nostra fusce montes sodales.\r\n\r\nConsectetur senectus bibendum torquent eleifend hendrerit. Placerat in dolor habitasse fermentum duis sollicitudin. Integer blandit sed metus posuere, lobortis hac libero ultrices nec. Dictumst quis a suscipit id eu efficitur. Sollicitudin convallis fusce pellentesque; sapien parturient pulvinar fusce molestie. Nisl sed aptent integer enim justo mattis vehicula habitant. Sed semper rutrum laoreet venenatis molestie eros; auctor sociosqu volutpat. Blandit arcu ut sollicitudin nullam condimentum praesent diam quam dapibus.\r\n\r\nTorquent curabitur primis cubilia luctus orci hac amet ex. Condimentum ac fringilla aenean ac nibh etiam, molestie nullam augue. Dapibus amet vulputate erat mattis per habitasse. Ligula per est ad sed dictumst; pellentesque per. Donec tincidunt eros gravida a facilisi. Nullam risus magna himenaeos aenean, ligula nisi hendrerit. Torquent rhoncus arcu vel vestibulum platea nisl varius vestibulum pretium. Quis eros ornare et eleifend, interdum lacinia. Nunc lectus ornare porta elementum diam per ultricies senectus. Etiam varius potenti maximus penatibus magnis sodales duis?', '2024-12-03 01:43:18', '2024-12-03 01:43:18');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `colors`
--

CREATE TABLE `colors` (
  `color_id` int(11) NOT NULL,
  `color` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `stock_quantity` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `colors`
--

INSERT INTO `colors` (`color_id`, `color`, `created_at`, `updated_at`, `stock_quantity`) VALUES
(13, 'Black', '2024-12-05 02:57:38', '2024-12-05 02:57:38', 0),
(14, 'Blue', '2024-12-05 03:24:08', '2024-12-05 03:24:08', 0),
(15, 'Brown', '2024-12-05 07:01:45', '2024-12-05 07:01:45', 0),
(16, 'Beige', '2024-12-05 07:01:51', '2024-12-05 07:01:51', 0),
(17, 'Yellow', '2024-12-05 07:01:58', '2024-12-05 07:01:58', 0),
(18, 'Red', '2024-12-05 07:02:05', '2024-12-05 07:02:05', 0),
(19, 'Purple', '2024-12-05 07:02:11', '2024-12-05 07:02:11', 0),
(20, 'Orange', '2024-12-05 07:02:19', '2024-12-05 07:02:19', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_date` datetime DEFAULT current_timestamp(),
  `total_amount` decimal(10,2) NOT NULL,
  `status` enum('pending','shipped','delivered','canceled') DEFAULT 'pending',
  `payment_method` varchar(50) NOT NULL,
  `shipping_address` varchar(255) DEFAULT NULL,
  `address_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `order_date`, `total_amount`, `status`, `payment_method`, `shipping_address`, `address_id`) VALUES
(62, 1, '2024-12-03 08:01:10', 334235.00, 'pending', 'cod', 'Số 10, Đường ABC, Thôn 1, Phường 2, Quận 3, Hà Nội', NULL),
(65, 1, '2024-12-03 09:12:32', 674100.00, 'shipped', 'cod', 'Số 10, Đường ABC, Thôn 1, Phường 2, Quận 3, Hà Nội', NULL),
(71, 3, '2024-12-05 18:39:27', 199000.00, 'delivered', 'cod', 'Buôn Pôk A, Huyện CưMgar, Tỉnh Đắk Lắk , Thôn A, Buôn Pôk A, abc, CưMgar, Buôn mê thuật', NULL),
(72, 3, '2024-12-05 12:42:48', 179100.00, 'shipped', 'cod', 'Buôn Pôk A, Huyện CưMgar, Tỉnh Đắk Lắk , Thôn A, Buôn Pôk A, abc, CưMgar, Buôn mê thuật', NULL),
(73, 3, '2024-12-05 15:18:09', 224500.00, 'shipped', 'cod', 'Buôn Pôk A, Huyện CưMgar, Tỉnh Đắk Lắk , Thôn A, Buôn Pôk A, abc, CưMgar, Buôn mê thuật', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `size` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_id`, `product_id`, `name`, `quantity`, `price`, `size`, `color`, `total_amount`) VALUES
(71, 71, 88, 'Áo Polo', 1, 150000.00, 'M', 'Beige', 150000.00),
(72, 72, 88, 'Áo Polo', 1, 150000.00, 'S', 'Beige', 150000.00),
(73, 73, 91, 'Áo giữ nhiệt nam thun lạnh tay dài ôm body co giãn 4 chiều chất đẹp Misu hàng Việt Nam chất lượng cao TD41', 1, 175500.00, 'M', 'Beige', 175500.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `reset_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `otp` varchar(6) NOT NULL,
  `expiry` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `password_resets`
--

INSERT INTO `password_resets` (`reset_id`, `user_id`, `otp`, `expiry`) VALUES
(1, 1, '379896', '2024-11-18 08:20:04'),
(2, 1, '659046', '2024-11-18 08:24:02'),
(3, 1, '663878', '2024-11-18 08:27:10'),
(4, 2, '474135', '2024-11-18 08:28:19'),
(5, 3, '617534', '2024-11-20 08:51:03'),
(6, 2, '201522', '2024-11-20 08:51:28'),
(7, 2, '319142', '2024-11-21 01:53:39');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `category_post_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `post`
--

INSERT INTO `post` (`post_id`, `title`, `content`, `image`, `category_post_id`, `created_at`, `updated_at`) VALUES
(24, 'Hot tin tức Nguyễn Công Hoang Sơn', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.\r\n\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', 'https://static-images.vnncdn.net/vps_images_publish/000001/000003/2024/11/30/quoc-hoi-se-co-phuong-an-sap-xep-sap-nhap-bo-may-vao-dau-nam-2025-95877.jpg?width=760&s=SKJuyMqWAb-4IMmEO6hang', 19, '2024-12-03 01:14:51', '2024-12-03 01:14:51'),
(27, 'Tin hót mỗi ngày', 'Lorem ipsum odor amet, consectetuer adipiscing elit. Netus efficitur ridiculus pretium egestas phasellus suspendisse. Eu cursus conubia ante ligula facilisi. Conubia vulputate ligula mollis ex potenti integer. Felis netus lectus per quis convallis eleifend. Facilisi ultrices fringilla amet neque pellentesque tellus adipiscing lacinia et. Nascetur laoreet congue hendrerit nec iaculis himenaeos. Integer eleifend conubia urna; integer potenti habitant volutpat sagittis phasellus. Metus ac ac consectetur blandit taciti cursus molestie etiam.\r\n\r\nInceptos et ex curabitur volutpat risus mi. Sed pellentesque amet mi sagittis in, tempor metus. Posuere vestibulum facilisis imperdiet amet sociosqu vivamus posuere. Praesent eros facilisis volutpat odio morbi nascetur velit suscipit. Tellus quam conubia luctus rutrum tortor montes ornare hac. Et class scelerisque accumsan sed; congue non tempus. Senectus libero quisque eu malesuada iaculis dignissim faucibus.\r\n\r\nConsectetur volutpat sagittis metus magnis dui iaculis lectus. Est tortor dapibus mollis sed posuere leo. Interdum facilisis sem dictum himenaeos natoque risus nisi nunc. Tellus euismod nec est ullamcorper quis. Maximus convallis blandit, eleifend potenti accumsan parturient. Fringilla vivamus luctus etiam feugiat ut sit sit porttitor sed. Cras cras mollis nunc phasellus nunc montes.\r\n\r\nMagna venenatis gravida placerat netus ut arcu luctus. Hendrerit vitae at nullam porta ridiculus lacinia pretium faucibus. Iaculis nec tristique taciti interdum dis non purus felis id. Etiam dignissim bibendum justo ligula elit cubilia viverra mattis. Tortor suspendisse ultrices commodo justo vivamus penatibus faucibus. Dolor maximus facilisi justo facilisis bibendum; maecenas lacus aenean elementum? Nisi eu eros rutrum proin in odio mollis vestibulum. Ex proin amet mi pellentesque quam natoque commodo eleifend. Imperdiet accumsan semper, ligula hac elit lacus. Et maecenas commodo ipsum platea nec ex?\r\n\r\nTempor tincidunt nisi lobortis in et dictumst. Leo lobortis sapien neque egestas aenean vivamus ut magnis. Hac nostra porta augue eget lobortis faucibus eget. Aptent congue phasellus porttitor magna per pretium suscipit. Mattis orci inceptos turpis; enim conubia enim dignissim libero. Rhoncus vestibulum mauris taciti mollis montes magna luctus. Nec adipiscing fames non sem ultricies. Euismod nunc lectus mollis gravida tristique montes ad.\r\n\r\nProin platea pellentesque per porta nulla vel. Fusce commodo enim praesent aliquam, potenti torquent justo tellus. Montes vel himenaeos elementum rhoncus fermentum. Natoque a finibus consequat purus ut penatibus. Phasellus aliquet bibendum in facilisis; posuere hendrerit pharetra. Fermentum ligula per massa iaculis nunc luctus libero velit. In senectus quis non, interdum cras ultricies efficitur fusce interdum.\r\n\r\nLacus vestibulum taciti vel felis lacus, ligula nullam. Pellentesque nascetur nascetur non scelerisque velit. Varius maecenas phasellus quam in pulvinar. Maximus primis porttitor turpis eget orci morbi eleifend. Hac platea pulvinar scelerisque vestibulum rutrum tristique. Finibus ullamcorper integer facilisi netus mollis duis purus libero sagittis. Rutrum himenaeos pulvinar sociosqu pharetra vulputate hendrerit eleifend.\r\n\r\nTincidunt ut cursus, torquent quisque phasellus sollicitudin. Mattis bibendum dui taciti pharetra euismod interdum penatibus malesuada mi. Sem platea cubilia ex justo augue vivamus efficitur tristique. Vulputate fusce bibendum rhoncus consectetur lacinia facilisis habitasse porttitor. Per cras bibendum interdum tempor adipiscing imperdiet praesent in ridiculus. Efficitur habitant ullamcorper mus at massa turpis congue etiam. Dui nostra nunc commodo ac luctus euismod libero nisl. Amet risus nec proin parturient arcu luctus ut. Urna dis convallis elementum est; consectetur vulputate dis.\r\n\r\nOrnare venenatis tempor eget augue ultricies finibus tempus netus egestas. Nec parturient penatibus, tortor montes pharetra magnis curae finibus. Accumsan consequat dapibus nostra at neque. Sapien dui nunc tempus sed congue pretium purus. Elit interdum est per congue elit quisque. Morbi ut urna congue erat dolor lobortis montes dapibus finibus. Tempus dis sem facilisi sociosqu imperdiet massa cursus mus. Semper eros habitasse lorem nam malesuada scelerisque euismod tristique.\r\n\r\nSed id dictum sem, mus nullam tortor feugiat. Posuere arcu maximus arcu vehicula nisi eleifend massa. Auctor sed mollis torquent praesent donec ex. Placerat pharetra mollis vestibulum congue consequat leo nostra lacinia cras. Elit suspendisse orci nulla libero a cubilia nisl pretium interdum. Sodales morbi finibus mauris sollicitudin sed at in mattis.\r\n\r\nAccumsan parturient tellus aliquam purus mollis est, ante massa. Faucibus cursus fermentum porta pellentesque condimentum elit vel. Magnis class torquent; vulputate nisl tristique purus himenaeos convallis. Aptent potenti mollis amet habitasse convallis dapibus porttitor viverra aptent. Neque phasellus ornare proin euismod urna. Fermentum at pellentesque placerat natoque ex, placerat donec. Pellentesque egestas metus gravida porta fringilla dignissim dui.\r\n\r\nQuam dictum facilisi mauris nascetur auctor natoque tempus. Vitae egestas imperdiet ad aptent morbi curabitur. Tempor hendrerit mus integer neque dolor. Iaculis convallis tristique urna non iaculis cubilia. Scelerisque aptent gravida facilisis morbi ornare, mus vestibulum. Magnis a metus arcu primis aliquam duis himenaeos lobortis. Pretium quam adipiscing fusce ullamcorper quam malesuada primis. Semper nullam per eleifend montes per ante. Vestibulum morbi felis dis feugiat, suscipit habitasse feugiat mi dis. Convallis elit sociosqu tristique platea fusce vehicula mollis dictum.\r\n\r\nInteger urna orci adipiscing nulla posuere! Senectus dignissim iaculis rhoncus pharetra, et arcu ex nascetur orci. Magna nibh sem a dolor cubilia a interdum, per nec. Class nisl tristique id curabitur montes felis ipsum porttitor. Ex tellus volutpat elit, tristique a pretium sed. Netus accumsan cursus erat est proin luctus ante! Ultricies semper gravida at nunc montes. Quam efficitur orci pretium inceptos tempor justo sed posuere convallis.\r\n\r\nProin morbi purus leo semper eu. Ullamcorper litora aliquam lorem facilisi penatibus nullam velit. Urna porta dictum litora dictumst accumsan magnis dolor. Luctus ad morbi id conubia pharetra inceptos lectus. Nec habitant habitasse dolor potenti finibus himenaeos nisl. Orci dolor ad habitasse rhoncus nisi lectus blandit. Fringilla fames felis velit, dapibus magna lacus. Rhoncus hendrerit pharetra nascetur ipsum condimentum, gravida duis ligula fringilla.\r\n\r\nLaoreet sociosqu penatibus suspendisse montes imperdiet curabitur. Quis leo nec platea sed, ut rhoncus eget cursus? Fusce sem tempus tincidunt elit in. In vivamus malesuada maximus accumsan sodales tempor congue. Venenatis venenatis consectetur sapien dignissim montes consectetur. Sapien pharetra quam habitant sit auctor euismod non fermentum.', 'https://thethaovanhoa.mediacdn.vn/372676912336973824/2023/8/9/viec-nha-thi-nhac-hong-drama-thien-ha-sieng-nang-khong-lo-chuyen-gi-c9194766-1691572539352-1691572539443466316900.jpeg', 26, '2024-12-03 01:44:33', '2024-12-03 01:44:33');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_featured` tinyint(1) DEFAULT 0,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `image`, `is_featured`, `created_at`) VALUES
(1, 'Tổng Bí thư Tô Lâm khảo sát Dự án Nhà máy điện hạt nhân Ninh Thuận 1', '<p style=\"text-align: center;\">Tại buổi khảo s&aacute;t địa điểm quy hoạch x&acirc;y dựng Nh&agrave; m&aacute;y ĐHN Ninh Thuận 1, &ocirc;ng Trịnh Minh Ho&agrave;ng, Ph&oacute; chủ tịch UBND tỉnh Ninh Thuận đ&atilde; b&aacute;o c&aacute;o nhanh hiện trạng sử dụng đất trong v&ugrave;ng dự &aacute;n; b&aacute;o c&aacute;o quy hoạch c&aacute;c dự &aacute;n th&agrave;nh phần của Dự &aacute;n ĐHN Ninh Thuận.</p>\r\n<p style=\"text-align: center;\"><img src=\"https://images2.thanhnien.vn/thumb_w/640/528068263637045248/2024/12/5/img2073-17333897416701444162752.jpg\" alt=\"Tổng B&iacute; thư T&ocirc; L&acirc;m khảo s&aacute;t Dự &aacute;n Nh&agrave; m&aacute;y điện hạt nh&acirc;n Ninh Thuận 1- Ảnh 2.\"></p>\r\n<p style=\"text-align: center;\">Theo đ&oacute;, tổng diện t&iacute;ch quy hoạch x&acirc;y dựng Nh&agrave; m&aacute;y ĐHN Ninh Thuận 1 v&agrave; 2 l&agrave; 1.642,22 ha; ri&ecirc;ng đối với Nh&agrave; m&aacute;y ĐHN Ninh Thuận 1 c&oacute; diện t&iacute;ch x&acirc;y dựng 883,68 ha, trong đ&oacute; diện t&iacute;ch tr&ecirc;n đất liền l&agrave; 443,11 ha, diện t&iacute;ch sử dụng tr&ecirc;n biển l&agrave; 440,57 ha; c&oacute; 477 hộ/2.084 khẩu thuộc diện phải di d&acirc;n t&aacute;i định cư để thực hiện dự &aacute;n. Qu&aacute; tr&igrave;nh triển khai dự &aacute;n đến nay, tỉnh đ&atilde; thực hiện c&ocirc;ng t&aacute;c bồi thường, giải ph&oacute;ng mặt bằng, di d&acirc;n t&aacute;i định canh, định cư cho Nh&agrave; m&aacute;y ĐHN Ninh Thuận 1 tr&ecirc;n diện t&iacute;ch 479 ha v&agrave; triển khai 10 dự &aacute;n th&agrave;nh phần phục vụ t&aacute;i định cư.</p>\r\n<p>&nbsp;</p>', 'https://images2.thanhnien.vn/thumb_w/640/528068263637045248/2024/12/5/img2104-1733389984644603784673.jpg', 1, '2024-12-05 20:27:59');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post_comments`
--

CREATE TABLE `post_comments` (
  `comment_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `likes` int(11) DEFAULT 0,
  `dislikes` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `liked_by` text DEFAULT NULL,
  `disliked_by` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `post_comments`
--

INSERT INTO `post_comments` (`comment_id`, `post_id`, `user_id`, `comment`, `likes`, `dislikes`, `created_at`, `liked_by`, `disliked_by`) VALUES
(51, 1, 3, 'àdawf', 0, 0, '2024-12-05 14:22:41', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post_comments_reactions`
--

CREATE TABLE `post_comments_reactions` (
  `reaction_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reaction` enum('like','dislike') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `post_comments_reactions`
--

INSERT INTO `post_comments_reactions` (`reaction_id`, `comment_id`, `user_id`, `reaction`) VALUES
(17, 51, 3, 'dislike');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock_quantity` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`product_id`, `name`, `description`, `price`, `stock_quantity`, `category_id`, `image`) VALUES
(88, 'Áo Polo', 'Áo Polo vãi lụa cotton 2 chiều.', 150000.00, 290, 1, 'https://taru.vn/image/data/product-3841/220457.jpg'),
(89, 'Áo Ba Lổ', 'Áo Ba Lổ vãi cotton co dãn hai chiều', 150000.00, 75, 1, 'https://owen.cdn.vccloud.vn/media/catalog/product/cache/d52d7e242fac6dae82288d9a793c0676/l/a/law232583.png'),
(90, 'Áo khoác phao nam nữ Misuofficial form boxy cổ cao trần bông dày dặn siêu ấm vải chống gió chống nước nhẹ', 'Áo khoác phao nam nữ Misuofficial form boxy cổ cao trần bông dày dặn siêu ấm vải chống gió chống nước nhẹ\r\n\r\n- Xuất xứ: Việt Nam\r\n\r\n- Chất liệu: vải không thấm nước\r\n\r\n- Đường may tỉ mỉ chắc chắc\r\n\r\n- Thiết kế: hiện đại, trẻ trung, dễ phối\r\n\r\n- Đủ size: M-L-XL (các bạn tham khảo tại bảng size nhé)', 175500.00, 150, 1, 'https://down-vn.img.susercontent.com/file/vn-11134207-7r98o-lzsrh0nb76apa8.webp'),
(91, 'Áo giữ nhiệt nam thun lạnh tay dài ôm body co giãn 4 chiều chất đẹp Misu hàng Việt Nam chất lượng cao TD41', 'ÁO GIỮ NHIỆT MẶC FORM ÔM BODY, QUÝ KHÁCH LẤY TĂNG 1-2 SIZE NẾU THÍCH MẶC THOẢI MÁI\r\n\r\nThông tin sản phẩm áo thể thao nam:\r\n\r\n- Áo thể thao nam được thiết kế theo đúng form chuẩn của nam giới Việt Nam\r\n\r\n- Chất liệu cực mềm mịn (áo vải thun mịn co dãn)\r\n\r\n- Đem lại sự thoải mái tiện lợi nhất cho người mặc\r\n\r\nHướng dẫn chọn size bộ đồ nam:', 175500.00, 75, 1, 'https://down-vn.img.susercontent.com/file/vn-11134207-7r98o-lwwag6b6yuor63.webp'),
(92, 'Áo Thun NY Form Unisex MISU Vải Cotton 100% Cao Cấp Nhiều Màu', 'Thông tin sản phẩm Áo phông cổ tròn LOVENA \r\n\r\n\r\n\r\n✔️ GIỚI THIỆU THƯƠNG HIỆU : Áo cộc tay nam, áo phông nam tay ngắn cổ tròn Unisex chất thun cotton 4 chiều mềm mại Là 1 trong những shop thời trang nam được xứng danh “MẪU MÃ ĐẸP - CHẤT LƯỢNG TỐT- GIÁ TẬN XƯỞNG” nên Shop luôn chú trọng nghiên cứu phát triển mẫu mã cải tiến và đặc biệt tối ưu giá tốt nhất, giá tận xưởng đến tay khách hàng. \r\n\r\n............................\r\n\r\nÁo Thun Nam, Áo Phông Tay Ngắn Cổ Tròn Form Rộng Unisex Chất Dày Dặn Thoáng Mát in chữ Cloudy Lovena\r\n\r\n- Áo phông layer cổ tròn LOVENA được thiết kế theo đúng form chuẩn của nam giới Việt Nam\r\n\r\n- Sản phẩm chính là mẫu thiết kế mới nhất cho mùa hè này\r\n\r\n- Chất liệu cực mềm mịn, thoáng mát: Vải cotton 100%, dày dặn\r\n\r\n- Đem lại sự thoải mái tiện lợi nhất cho người mặc', 175500.00, 60, 1, 'https://down-vn.img.susercontent.com/file/vn-11134207-7r98o-lqgcxywoqqj64c.webp'),
(93, 'Áo Thun Unisex Trơn Dáng Rộng, Chất Cotton Thoáng Mát, 5 Màu Trẻ Trung', '', 175500.00, 280, 1, 'https://down-vn.img.susercontent.com/file/vn-11134207-7r98o-lsm5o1ms4jo92f.webp'),
(94, 'Áo thun trơn nam nữ unisex form rộng Misuofficial vải cotton thoáng mát cổ tròn basic', '', 99000.00, 20, 1, 'https://down-vn.img.susercontent.com/file/vn-11134207-7r98o-lwqjor030lwb99.webp'),
(95, 'Áo Chống Nắng Nữ 2 Lớp Dáng Dài, Áo Chống Nắng Toàn Thân Mũ Có Vành Chất Thun Lạnh Cao Cấp Chống Tia UV', '', 175500.00, 30, 1, 'https://down-vn.img.susercontent.com/file/vn-11134207-7r98o-ls7u9hvvpr5w07.webp');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_colors`
--

CREATE TABLE `product_colors` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `color` varchar(255) NOT NULL,
  `stock_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_combinations`
--

CREATE TABLE `product_combinations` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `color` varchar(50) NOT NULL,
  `size` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `quantity` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product_combinations`
--

INSERT INTO `product_combinations` (`id`, `product_id`, `color`, `size`, `created_at`, `updated_at`, `quantity`) VALUES
(77, 88, 'Blue', 'S', '2024-12-05 07:04:57', '2024-12-05 07:04:57', 50),
(78, 88, 'Blue', 'M', '2024-12-05 07:04:57', '2024-12-05 07:04:57', 60),
(79, 88, 'Blue', 'L', '2024-12-05 07:04:57', '2024-12-05 07:04:57', 25),
(80, 88, 'Blue', 'XL', '2024-12-05 07:04:57', '2024-12-05 07:04:57', 10),
(81, 88, 'Beige', 'S', '2024-12-05 07:04:57', '2024-12-05 07:04:57', 50),
(82, 88, 'Beige', 'M', '2024-12-05 07:04:57', '2024-12-05 07:04:57', 60),
(83, 88, 'Beige', 'L', '2024-12-05 07:04:57', '2024-12-05 07:04:57', 30),
(84, 88, 'Beige', 'XL', '2024-12-05 07:04:57', '2024-12-05 07:04:57', 5),
(85, 89, 'Black', 'S', '2024-12-05 08:15:32', '2024-12-05 08:15:32', 20),
(86, 89, 'Black', 'L', '2024-12-05 08:15:32', '2024-12-05 08:15:32', 30),
(87, 89, 'Black', 'M', '2024-12-05 08:15:32', '2024-12-05 08:15:32', 25),
(88, 90, 'Black', 'M', '2024-12-05 08:33:29', '2024-12-05 08:33:29', 50),
(89, 90, 'Black', 'S', '2024-12-05 08:33:29', '2024-12-05 08:33:29', 50),
(90, 90, 'Black', 'L', '2024-12-05 08:33:29', '2024-12-05 08:33:29', 50),
(91, 91, 'Beige', 'S', '2024-12-05 08:38:39', '2024-12-05 08:38:39', 10),
(92, 91, 'Beige', 'L', '2024-12-05 08:38:39', '2024-12-05 08:38:39', 30),
(93, 91, 'Beige', 'M', '2024-12-05 08:38:39', '2024-12-05 08:38:39', 35),
(94, 92, 'Beige', 'S', '2024-12-05 08:39:48', '2024-12-05 08:39:48', 30),
(95, 92, 'Beige', 'M', '2024-12-05 08:39:48', '2024-12-05 08:39:48', 30),
(96, 93, 'Black', 'S', '2024-12-05 08:41:08', '2024-12-05 08:41:08', 35),
(97, 93, 'Black', 'M', '2024-12-05 08:41:08', '2024-12-05 08:41:08', 35),
(98, 93, 'Black', 'L', '2024-12-05 08:41:08', '2024-12-05 08:41:08', 35),
(99, 93, 'Black', 'XL', '2024-12-05 08:41:08', '2024-12-05 08:41:08', 35),
(100, 93, 'Blue', 'S', '2024-12-05 08:41:08', '2024-12-05 08:41:08', 35),
(101, 93, 'Blue', 'M', '2024-12-05 08:41:08', '2024-12-05 08:41:08', 35),
(102, 93, 'Blue', 'L', '2024-12-05 08:41:08', '2024-12-05 08:41:08', 35),
(103, 93, 'Blue', 'XL', '2024-12-05 08:41:08', '2024-12-05 08:41:08', 35),
(104, 94, 'Black', 'L', '2024-12-05 08:49:40', '2024-12-05 08:49:40', 20),
(105, 95, 'Blue', 'XL', '2024-12-05 08:53:46', '2024-12-05 08:53:46', 30);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_comments`
--

CREATE TABLE `product_comments` (
  `comment_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `rating` int(11) NOT NULL CHECK (`rating` between 1 and 5),
  `likes` int(11) DEFAULT 0,
  `dislikes` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_images`
--

CREATE TABLE `product_images` (
  `image_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_sizes`
--

CREATE TABLE `product_sizes` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size` varchar(255) NOT NULL,
  `stock_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `promotions`
--

CREATE TABLE `promotions` (
  `promotion_id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `discount` decimal(5,2) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `promotions`
--

INSERT INTO `promotions` (`promotion_id`, `code`, `discount`, `start_date`, `end_date`, `description`) VALUES
(1, 'TINMAGIC123', 10.00, '2024-11-01 00:00:00', '2024-12-31 23:59:59', 'Giảm 10% cho đơn hàng từ 500,000 VND'),
(2, 'Sale12/12', 80.00, '2024-12-29 00:00:00', '2024-12-31 00:00:00', 'Săn ngay');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` tinyint(4) NOT NULL CHECK (`rating` between 1 and 5),
  `comment` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `reviews`
--

INSERT INTO `reviews` (`review_id`, `product_id`, `user_id`, `rating`, `comment`, `created_at`, `updated_at`) VALUES
(1, 88, 4, 5, 'Sản phẩm chất lượng', '2024-12-05 18:00:39', NULL),
(2, 88, 3, 5, 'Áo đẹp nha mọi người mua thử đi 5 sao nha', '2024-12-05 16:03:16', '2024-12-05 16:25:37'),
(3, 91, 3, 5, 'Áo đẹp! Rất thích hợp cho mua đông này', '2024-12-05 16:30:00', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sizes`
--

CREATE TABLE `sizes` (
  `size_id` int(11) NOT NULL,
  `size` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `stock_quantity` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sizes`
--

INSERT INTO `sizes` (`size_id`, `size`, `created_at`, `updated_at`, `stock_quantity`) VALUES
(6, 'M', '2024-12-05 02:57:42', '2024-12-05 02:57:42', 0),
(7, 'XXL', '2024-12-05 03:24:16', '2024-12-05 03:24:16', 0),
(8, 'S', '2024-12-05 07:02:25', '2024-12-05 07:02:25', 0),
(9, 'L', '2024-12-05 07:02:28', '2024-12-05 07:02:28', 0),
(10, 'XL', '2024-12-05 07:02:32', '2024-12-05 07:02:32', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `otp` varchar(6) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `role` enum('admin','customer') DEFAULT 'customer',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `avatar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `phone`, `otp`, `address`, `role`, `created_at`, `avatar`) VALUES
(1, 'kakakaka', 'trungtin@gmail.com', '12345678', '0987654321', NULL, 'Hà Nội, Việt Nam', 'customer', '2024-11-15 03:55:52', '../View/uploads/674d4d2d2efe1.jpg'),
(2, 'NGUYỄN TRUNG TÍN', 'linkshot01@gmail.com', 'ssikia123', '0986295356', NULL, 'Thôn 1 Cư Suê Cư Mgar, Đắk Lắk', 'admin', '2024-11-18 07:23:06', 'https://9anime.vn/wp-content/uploads/2024/04/1713779857_207_499-Hinh-Anh-Anime-Nu-Dep-Ngau-Cute-Dang-Yeu.jpg'),
(3, 'User', 'dauxanh008@gmail.com', '12345678', '0389195765', NULL, 'Buôn Pôk A, Huyện CưMgar, Tỉnh Đắk Lắk , Thôn A, Buôn Pôk A, abc, CưMgar, Buôn mê thuật', 'customer', '2024-11-20 07:43:29', '../View/uploads/6751c76eabc92.jpeg'),
(4, 'khoaeban', 'khoaebanypk03641@gmail.com', '12345678', '0986295356', NULL, 'Thôn 1 Cư Suê Cư Mgar, Đắk Lắk', 'admin', '2024-11-21 00:40:08', NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Chỉ mục cho bảng `categories_post`
--
ALTER TABLE `categories_post`
  ADD PRIMARY KEY (`category_post_id`);

--
-- Chỉ mục cho bảng `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`color_id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `orders_ibfk_2` (`address_id`);

--
-- Chỉ mục cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`reset_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `category_post_id` (`category_post_id`);

--
-- Chỉ mục cho bảng `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `post_comments`
--
ALTER TABLE `post_comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `post_comments_reactions`
--
ALTER TABLE `post_comments_reactions`
  ADD PRIMARY KEY (`reaction_id`),
  ADD UNIQUE KEY `unique_user_comment` (`comment_id`,`user_id`),
  ADD KEY `post_comments_reactions_user_fk` (`user_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Chỉ mục cho bảng `product_colors`
--
ALTER TABLE `product_colors`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `product_combinations`
--
ALTER TABLE `product_combinations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `product_comments`
--
ALTER TABLE `product_comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`promotion_id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Chỉ mục cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`size_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `addresses`
--
ALTER TABLE `addresses`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `categories_post`
--
ALTER TABLE `categories_post`
  MODIFY `category_post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT cho bảng `colors`
--
ALTER TABLE `colors`
  MODIFY `color_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT cho bảng `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `reset_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `post_comments`
--
ALTER TABLE `post_comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT cho bảng `post_comments_reactions`
--
ALTER TABLE `post_comments_reactions`
  MODIFY `reaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT cho bảng `product_colors`
--
ALTER TABLE `product_colors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT cho bảng `product_combinations`
--
ALTER TABLE `product_combinations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT cho bảng `product_comments`
--
ALTER TABLE `product_comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `product_images`
--
ALTER TABLE `product_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `product_sizes`
--
ALTER TABLE `product_sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT cho bảng `promotions`
--
ALTER TABLE `promotions`
  MODIFY `promotion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `sizes`
--
ALTER TABLE `sizes`
  MODIFY `size_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`address_id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Các ràng buộc cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD CONSTRAINT `password_resets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Các ràng buộc cho bảng `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`category_post_id`) REFERENCES `categories_post` (`category_post_id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `post_comments`
--
ALTER TABLE `post_comments`
  ADD CONSTRAINT `post_comments_fk` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `post_comments_reactions`
--
ALTER TABLE `post_comments_reactions`
  ADD CONSTRAINT `post_comments_reactions_comment_fk` FOREIGN KEY (`comment_id`) REFERENCES `post_comments` (`comment_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_comments_reactions_user_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Các ràng buộc cho bảng `product_combinations`
--
ALTER TABLE `product_combinations`
  ADD CONSTRAINT `product_combinations_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `product_comments`
--
ALTER TABLE `product_comments`
  ADD CONSTRAINT `product_comments_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
