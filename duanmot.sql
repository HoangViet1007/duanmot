-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 16, 2021 lúc 05:43 PM
-- Phiên bản máy phục vụ: 10.4.16-MariaDB
-- Phiên bản PHP: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `duanmot`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `binh_luan`
--

CREATE TABLE `binh_luan` (
  `id` int(11) NOT NULL,
  `noi_dung` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ngay_binh_luan` date NOT NULL,
  `gio_binh_luan` time NOT NULL,
  `trang_thai` bit(1) NOT NULL,
  `ma_tin_tuc` int(11) NOT NULL,
  `ma_nguoi_binh_luan` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `binh_luan`
--

INSERT INTO `binh_luan` (`id`, `noi_dung`, `ngay_binh_luan`, `gio_binh_luan`, `trang_thai`, `ma_tin_tuc`, `ma_nguoi_binh_luan`) VALUES
(1, 'Very nice room, I am very satisfied, I think this is the most beautiful hotel I have ever been to', '2020-11-26', '18:31:38', b'0', 1, 'ps3'),
(4, 'Very nice room, I am very satisfied, I think this is the most beautiful hotel I have ever been to', '2020-11-28', '15:39:33', b'0', 2, 'ps4'),
(8, 'Very nice room, I am very satisfied, I think this is the most beautiful hotel I have ever been to', '2020-11-28', '15:59:41', b'0', 3, 'ps4'),
(9, 'Very nice room, I am very satisfied, I think this is the most beautiful hotel I have ever been to', '2020-11-29', '17:15:00', b'0', 3, 'ps3'),
(10, 'Very nice room, I am very satisfied, I think this is the most beautiful hotel I have ever been to', '2020-12-01', '07:16:46', b'0', 4, 'ps4');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danh_gia`
--

CREATE TABLE `danh_gia` (
  `id` int(11) NOT NULL,
  `so_sao` int(11) NOT NULL,
  `noi_dung` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ngay_danh_gia` date NOT NULL,
  `gio_danh_gia` time NOT NULL,
  `trang_thai` bit(1) NOT NULL,
  `ma_loai_phong` int(11) NOT NULL,
  `ma_nguoi_danh_gia` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `danh_gia`
--

INSERT INTO `danh_gia` (`id`, `so_sao`, `noi_dung`, `ngay_danh_gia`, `gio_danh_gia`, `trang_thai`, `ma_loai_phong`, `ma_nguoi_danh_gia`) VALUES
(1, 4, 'Very nice room, I am very satisfied, I think this is the most beautiful hotel I have ever been to', '2020-11-24', '18:34:16', b'0', 8, 'ps3'),
(2, 5, 'Very nice room, I am very satisfied, I think this is the most beautiful hotel I have ever been to\r\n', '2020-11-26', '18:57:16', b'0', 8, 'ps4'),
(4, 4, 'Very nice room, I am very satisfied, I think this is the most beautiful hotel I have ever been to', '2020-12-04', '17:55:06', b'0', 6, 'ps4'),
(6, 5, 'Very nice room, I am very satisfied, I think this is the most beautiful hotel I have ever been to', '2020-12-04', '18:36:59', b'0', 5, 'ps4'),
(7, 5, 'The room is very nice, I am very satisfied with the hotel room, I will recommend to my friends and relatives about this hotel, A great hotel', '2020-12-06', '17:48:03', b'0', 2, 'ps5'),
(8, 4, 'The room is very nice, I am very satisfied with the hotel room, I will recommend to my friends and relatives about this hotel, A great hotel', '2020-12-06', '17:48:41', b'0', 3, 'ps5'),
(13, 4, 'The room is very nice, I am very satisfied with the hotel room, I will recommend to my friends and relatives about this hotel, A great hotel\r\n\r\n', '2020-12-14', '09:53:54', b'0', 2, 'ps4'),
(15, 4, 'ahahhaha', '2020-12-14', '22:46:25', b'0', 6, 'ps8');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dat_phong`
--

CREATE TABLE `dat_phong` (
  `id` int(11) NOT NULL,
  `ten_nguoi_dat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sdt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ngay_tao` date NOT NULL,
  `ngay_den` date NOT NULL,
  `ngay_di` date NOT NULL,
  `trang_thai` int(11) NOT NULL,
  `ma_loai_phong` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `dat_phong`
--

INSERT INTO `dat_phong` (`id`, `ten_nguoi_dat`, `sdt`, `email`, `ngay_tao`, `ngay_den`, `ngay_di`, `trang_thai`, `ma_loai_phong`) VALUES
(1, 'Nguyễn Thanh Hương', '0355755698', 'hoangviet10072001@gmail.com', '2020-11-25', '2020-11-26', '2020-11-30', 2, 8),
(2, 'Nguyễn Anh Trung', '0583465712', 'viettuyet10072001@gmail.com', '2020-12-02', '2020-12-03', '2020-12-05', 2, 8),
(3, 'Ngô Hồng Nguyên', '0583765731', 'viettuyet23112001@gmail.com', '2020-10-02', '2020-10-05', '2020-10-08', 2, 7),
(4, 'Chúc Anh Quân ', '0855009301', 'chonggiongcho@gmail.com', '2020-09-02', '2020-09-05', '2020-09-07', 2, 6),
(5, 'Nguyễn Đức Thắng', '0583465730', 'thangndph10697@fpt.edu.vn', '2020-08-04', '2020-08-06', '2020-08-09', 2, 6),
(11, 'Hoàng Văn Hòa', '0364118111', 'hoangviet10072001@gmail.com', '2020-12-05', '2020-12-08', '2020-12-09', 2, 7),
(18, 'Hoàng Việt Dương', '0583465199', 'viettuyet10072001@gmail.com', '2020-12-14', '2020-12-15', '2020-12-17', 0, 9),
(20, 'Hoàng Việt Dương', '0583465199', 'viettuyet10072001@gmail.com', '2020-12-14', '2020-12-20', '2020-12-22', 0, 9),
(23, 'Hoàng Việt Dương', '0583465199', 'viettuyet10072001@gmail.com', '2020-12-14', '2020-12-23', '2020-12-25', 0, 9),
(32, 'Chúc Anh Quân', '0827541634', 'hoangviet10172001@gmail.com', '2020-12-14', '2020-12-16', '2020-12-20', 0, 2),
(34, 'Hoàng Văn Hòa', '0355755697', 'hoangviet10072001@gmail.com', '2020-12-14', '2020-12-16', '2020-12-18', 1, 7);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hinh_anh_khach_san`
--

CREATE TABLE `hinh_anh_khach_san` (
  `id` int(11) NOT NULL,
  `ten` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hinh` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `duong_dan` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hinh_anh_khach_san`
--

INSERT INTO `hinh_anh_khach_san` (`id`, `ten`, `hinh`, `duong_dan`) VALUES
(1, 'Hotel', 'public/image/thu_vien/5fbf8607abe5d_tv-hotel.jpg', '1'),
(2, 'Swimming Pool', 'public/image/thu_vien/5fbf863f81e35_tv-swim.jpg', '2'),
(3, 'Room Service', 'public/image/thu_vien/5fbf865f7e47e_image-gallery.jpg', '3'),
(4, 'Sea', 'public/image/thu_vien/5fbf8685f25ca_tv-sea.jpg', '4'),
(5, 'Room', 'public/image/thu_vien/5fbf869863dec_tv-room.jpg', '5'),
(6, 'Bask', 'public/image/thu_vien/5fbf86e6dd979_tv-tn.jpg', '6'),
(7, 'Restaurant', 'public/image/thu_vien/5fbf871b30d90_tv-re.jpg', '7');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hinh_anh_loai_phong`
--

CREATE TABLE `hinh_anh_loai_phong` (
  `id` int(11) NOT NULL,
  `hinh` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ma_loai_phong` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hinh_anh_loai_phong`
--

INSERT INTO `hinh_anh_loai_phong` (`id`, `hinh`, `ma_loai_phong`) VALUES
(1, 'public/image/loai_phong/5fb60f3307b97_deluxe-room1.jpg', 1),
(2, 'public/image/loai_phong/5fb60f4c9f846_deluxe-room2.jpg', 1),
(3, 'public/image/loai_phong/5fb60f574d56c_deluxe-room3.jpg', 1),
(4, 'public/image/loai_phong/5fbf8b806db3c_deluxe-room1.jpg', 2),
(5, 'public/image/loai_phong/5fbf8b8bf0e93_deluxe-room2.jpg', 2),
(6, 'public/image/loai_phong/5fbf8b959c713_deluxe-room3.jpg', 2),
(9, 'public/image/loai_phong/5fbf8bc187de8_double-room3.jpg', 3),
(10, 'public/image/loai_phong/5fbf8bcd5ade2_double-room4.jpg', 3),
(11, 'public/image/loai_phong/5fbf8bfff2107_single-room1.jpg', 4),
(12, 'public/image/loai_phong/5fbf8c0b31981_single-room5.jpg', 4),
(13, 'public/image/loai_phong/5fbf8c27f2c87_single-room4.jpg', 4),
(14, 'public/image/loai_phong/5fbf8c58ebdac_single-room3.jpg', 4),
(16, 'public/image/loai_phong/5fbf8c882d51b_family_room1.jpg', 5),
(17, 'public/image/loai_phong/5fbf8c94759a5_family_room2.jpg', 5),
(18, 'public/image/loai_phong/5fbf8c9f9a2b7_family_room3.jpg', 5),
(19, 'public/image/loai_phong/5fbf8caf25c2f_family_room4.jpg', 5),
(20, 'public/image/loai_phong/5fbf8cbb60c5b_neo-room1.jpg', 8),
(21, 'public/image/loai_phong/5fbf8cc4e6a4e_neo-room2.jpg', 8),
(22, 'public/image/loai_phong/5fbf8cd26c7a6_neo-room3.jpg', 8),
(23, 'public/image/loai_phong/5fbf8ce198de6_honey-room1.jpg', 7),
(24, 'public/image/loai_phong/5fbf8cf30052c_honey-room5.jpg', 7),
(25, 'public/image/loai_phong/5fbf8cffca831_honey-room4.jpg', 7),
(26, 'public/image/loai_phong/5fbf8d106ddd5_honey-room2.jpg', 7),
(27, 'public/image/loai_phong/5fbf8d959bbce_king-room2.jpg', 6),
(28, 'public/image/loai_phong/5fbf8da0c358b_king3.jpg', 6);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lien_he`
--

CREATE TABLE `lien_he` (
  `id` int(11) NOT NULL,
  `ho_ten` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sdt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tieu_de` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `noi_dung` text COLLATE utf8_unicode_ci NOT NULL,
  `trang_thai` bit(1) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `lien_he`
--

INSERT INTO `lien_he` (`id`, `ho_ten`, `sdt`, `tieu_de`, `noi_dung`, `trang_thai`, `email`) VALUES
(1, 'Đào Ánh Tuyết', '0827541636', 'Xin chào', 'Chúng tôi thay mặt chõ khách sạn Sao Xanh chân trọng mời khách sạn marvella đến tham dự buổi khai chương của chúng tôi ', b'0', 'tuyet@gmail.com'),
(2, 'Chúc Anh Quân', '0827541634', 'Thông báo', 'Mở thẻ thanh toán nhanh với VNPay hỗ trợ cho khách sạn ', b'0', 'quan@gmail.com');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loai_phong`
--

CREATE TABLE `loai_phong` (
  `id` int(11) NOT NULL,
  `ten_loai` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hinh` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `so_luong_phong` int(11) NOT NULL,
  `so_phong_da_dat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `so_phong_trong` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `don_gia` float NOT NULL,
  `gioi_thieu` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mo_ta` text COLLATE utf8_unicode_ci NOT NULL,
  `dac_biet` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `loai_phong`
--

INSERT INTO `loai_phong` (`id`, `ten_loai`, `hinh`, `so_luong_phong`, `so_phong_da_dat`, `so_phong_trong`, `don_gia`, `gioi_thieu`, `mo_ta`, `dac_biet`) VALUES
(2, 'Deluxe Room', 'public/image/loai_phong/5fbf897c72cbd_deluxe-room.jpg', 10, '2', '8', 800, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod.', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit… Zril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur.', b'0'),
(3, 'Double Room', 'public/image/loai_phong/5fbf89caa9db4_double-room.jpg', 12, '0', '12', 1200, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod.', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit… Zril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur.', b'0'),
(4, 'Single Room', 'public/image/loai_phong/5fbf89faba561_single-room.jpg', 12, '0', '12', 790, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit… Zril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur.', b'0'),
(5, 'Family Room', 'public/image/loai_phong/5fbf8a48a2924_family_room.jpg', 14, '0', '14', 1090, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit… Zril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur.', b'0'),
(6, 'King Room', 'public/image/loai_phong/5fbf8aa68fa99_king-room.jpg', 9, '0', '9', 900, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit… Zril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur.', b'0'),
(7, 'Honeymoon Room', 'public/image/loai_phong/5fbf8b1312877_honey-room.jpg', 12, '2', '10', 780, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod.', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit… Zril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur.', b'0'),
(8, 'Neoclassical Room', 'public/image/loai_phong/5fbf8b5ecdf9f_tan-co-dien-room.jpg', 13, '4', '9', 1200, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod.', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit… Zril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur.', b'0'),
(9, 'haha', 'public/image/loai_phong/5fd70414072f6_nhung-mau-ke-sach-dep_040525836.jpg', 2, '2', '0', 1200, 'phòng đẹp', 'phòng đẹp', b'0');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `thue_VAT` float NOT NULL,
  `tong_tien` float NOT NULL,
  `ngay_tao` date NOT NULL,
  `ma_dat_phong` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `thue_VAT`, `tong_tien`, `ngay_tao`, `ma_dat_phong`) VALUES
(1, 0.05, 5040, '2020-11-05', 1),
(2, 0.05, 2520, '2020-12-05', 2),
(3, 0.05, 2457, '2020-10-08', 3),
(4, 0.05, 1890, '2020-09-07', 4),
(5, 0.05, 2835, '2020-08-09', 5),
(7, 0.05, 819, '2020-12-09', 11);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `slide_anh`
--

CREATE TABLE `slide_anh` (
  `id` int(11) NOT NULL,
  `hinh` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `noi_dung` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `slide_anh`
--

INSERT INTO `slide_anh` (`id`, `hinh`, `noi_dung`) VALUES
(1, 'public/image/slide_anh/5fb60e322ba34_banner5.jpg', 'LUXURY IS PERSONAL'),
(3, 'public/image/slide_anh/5fb60e4bb1be3_banner2.jpg', 'LUXURY IS PERSONAL'),
(4, 'public/image/slide_anh/5fb60e6c012b9_banner4.jpg', 'LUXURY IS PERSONAL');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thong_tin_website`
--

CREATE TABLE `thong_tin_website` (
  `id` int(11) NOT NULL,
  `ten_web` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sdt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dia_chi` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `map_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `thong_tin_website`
--

INSERT INTO `thong_tin_website` (`id`, `ten_web`, `logo`, `sdt`, `dia_chi`, `email`, `map_url`) VALUES
(1, 'Marvella', 'public/image/website/5fb60cf949462_logo1.png', '0355755697', '89 Hoai Duc-Ha Noi', 'viet1@gmail.com', '1'),
(2, 'Marvella', 'public/image/website/5fbf814730818_5fb69ccf066bf_logo2.png', '0355755697', '89 Hoai Duc - Ha Noi', 'hoangviet10072001@gmail.com', '2');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tin_tuc`
--

CREATE TABLE `tin_tuc` (
  `id` int(11) NOT NULL,
  `tieu_de` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `noi_dung` longtext COLLATE utf8_unicode_ci NOT NULL,
  `hinh` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `trang_thai` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tin_tuc`
--

INSERT INTO `tin_tuc` (`id`, `tieu_de`, `noi_dung`, `hinh`, `trang_thai`) VALUES
(1, '10 THINGS YOU SHOULD KNOW', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit&hellip;</p>\r\n<p>Zril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur.</p>', 'public/image/tin_tuc/5fbf8f28cbb11_blog1.jpg', b'0'),
(2, 'HOTEL ZANTE IN PICTURES', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit<strong>,</strong>&nbsp;sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit&hellip;</p>\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit<strong>,</strong>&nbsp;sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit&hellip;</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit Mauris non laoreet dui, Morbi lacus massa, euismod ut turpis molestie, tristique sodales est There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration.</p>\r\n<p>Mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.</p>', 'public/image/tin_tuc/5fc242bec04ec_blog3.jpg', b'0'),
(3, 'HOTEL ZANTE WEDDINGS', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit&hellip;</p>\r\n<p>Zril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur.</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit Mauris non laoreet dui, Morbi lacus massa, euismod ut turpis molestie, tristique sodales est There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration.</p>\r\n<p>Mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.</p>', 'public/image/tin_tuc/5fc243178662d_blog4.jpg', b'0'),
(4, 'HOTEL ZANTE FAMILY PARTY', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit&hellip;</p>\r\n<p>Zril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur.</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit Mauris non laoreet dui, Morbi lacus massa, euismod ut turpis molestie, tristique sodales est There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration.</p>\r\n<p>Mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.</p>', 'public/image/tin_tuc/5fc2438b4f5bd_blog5.jpg', b'0'),
(5, 'LIVE YOUR MYTH IN GREECE', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit&hellip;</p>\r\n<p>Zril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur.</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit Mauris non laoreet dui, Morbi lacus massa, euismod ut turpis molestie, tristique sodales est There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration.</p>\r\n<p>Mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.</p>', 'public/image/tin_tuc/5fc244048f707_blog6.jpg', b'0');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mat_khau` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ho_ten` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hinh` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `so_chung_minh` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sdt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ma_vai_tro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `mat_khau`, `ho_ten`, `hinh`, `email`, `so_chung_minh`, `sdt`, `ma_vai_tro`) VALUES
('ps1', '123456789', 'Hoàng Quốc Bảo Việt', 'public/image/users/5fb60ee3adfa5_87559561_219037232826776_616655835103232000_n.jpg', 'hoangviet10072001@gmail.com', '033201001239', '0355755697', 1),
('ps2', '123456789', 'Đào Ánh Tuyết', 'public/image/users/5fbf87b459a43_vk.jpg', 'tuyet@gmail.com', '033201001238', '0827541636', 1),
('ps3', '123456789', 'Nguyễn Duy Việt Anh', 'public/image/users/5fbf8801e4452_56b1277997b26aec33a3.jpg', 'anhndvph10550@fpt.edu.vn', '033201001228', '0859850000', 2),
('ps4', '123456789', 'Chúc Anh Quân', 'public/image/users/5fc1357ca22df_123310298_996218494220871_5114419063741368147_n.jpg', 'hoangviet10172001@gmail.com', '033201001211', '0827541656', 2),
('ps5', '123456789', 'Trần Hoài Thương', 'public/image/users/5fcd0aba9ba2c_121092441_359184295201933_6285663945253883419_o.jpg', 'viettuyet10072001@gmail.com', '032001001289', '0583465190', 2),
('ps8', '123456789', 'Hoàng anh', 'public/image/users/5fd7dd0d8fbf9_31.jpg', 'hoangviet10072001@gmail.com', '033201001228', '0355755697', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vai_tro`
--

CREATE TABLE `vai_tro` (
  `id` int(11) NOT NULL,
  `ten_vai_tro` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `vai_tro`
--

INSERT INTO `vai_tro` (`id`, `ten_vai_tro`) VALUES
(1, 'Nhân viên'),
(2, 'Khách hàng');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `binh_luan`
--
ALTER TABLE `binh_luan`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `danh_gia`
--
ALTER TABLE `danh_gia`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `dat_phong`
--
ALTER TABLE `dat_phong`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `hinh_anh_khach_san`
--
ALTER TABLE `hinh_anh_khach_san`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `hinh_anh_loai_phong`
--
ALTER TABLE `hinh_anh_loai_phong`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `lien_he`
--
ALTER TABLE `lien_he`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `loai_phong`
--
ALTER TABLE `loai_phong`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `slide_anh`
--
ALTER TABLE `slide_anh`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `thong_tin_website`
--
ALTER TABLE `thong_tin_website`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tin_tuc`
--
ALTER TABLE `tin_tuc`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `vai_tro`
--
ALTER TABLE `vai_tro`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `binh_luan`
--
ALTER TABLE `binh_luan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `danh_gia`
--
ALTER TABLE `danh_gia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `dat_phong`
--
ALTER TABLE `dat_phong`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT cho bảng `hinh_anh_khach_san`
--
ALTER TABLE `hinh_anh_khach_san`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `hinh_anh_loai_phong`
--
ALTER TABLE `hinh_anh_loai_phong`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `lien_he`
--
ALTER TABLE `lien_he`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `loai_phong`
--
ALTER TABLE `loai_phong`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `slide_anh`
--
ALTER TABLE `slide_anh`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `thong_tin_website`
--
ALTER TABLE `thong_tin_website`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `tin_tuc`
--
ALTER TABLE `tin_tuc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `vai_tro`
--
ALTER TABLE `vai_tro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
