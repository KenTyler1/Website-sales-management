-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 24, 2022 lúc 02:14 PM
-- Phiên bản máy phục vụ: 10.4.21-MariaDB
-- Phiên bản PHP: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `webbanhang`
--
CREATE DATABASE IF NOT EXISTS `webbanhang` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `webbanhang`;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietdathang`
--

CREATE TABLE `chitietdathang` (
  `SoDonDH` int(50) NOT NULL COMMENT 'Số đơn đặt hàng',
  `MSHH` int(11) NOT NULL COMMENT 'Mã số hàng hóa',
  `SoLuong` int(50) NOT NULL COMMENT 'Số lượng',
  `GiaDatHang` int(11) NOT NULL COMMENT 'Giá đặt hàng',
  `GiamGia` float NOT NULL COMMENT 'Giảm giá'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `chitietdathang`
--

INSERT INTO `chitietdathang` (`SoDonDH`, `MSHH`, `SoLuong`, `GiaDatHang`, `GiamGia`) VALUES
(1, 1, 1, 43990000, 20),
(1, 4, 3, 26370000, 10),
(2, 4, 2, 17580000, 7),
(2, 5, 2, 18980000, 7),
(3, 9, 3, 8970000, 5),
(3, 10, 2, 22780000, 10),
(4, 1, 1, 43990000, 20);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dathang`
--

CREATE TABLE `dathang` (
  `SoDonDH` int(50) NOT NULL COMMENT 'Số đơn đặt hàng',
  `MSKH` int(20) NOT NULL COMMENT 'Mã số khách hàng',
  `MSNV` int(20) NOT NULL COMMENT 'Mã số nhân viên',
  `NgayDH` datetime NOT NULL COMMENT 'Ngày đăt hàng',
  `NgayGH` datetime NOT NULL COMMENT 'Ngày giao hàng',
  `TrangThaiDH` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'Trạng thái đặt hàng'
) ;

--
-- Đang đổ dữ liệu cho bảng `dathang`
--

INSERT INTO `dathang` (`SoDonDH`, `MSKH`, `MSNV`, `NgayDH`, `NgayGH`, `TrangThaiDH`) VALUES
(1, 1, 1, '2021-12-27 10:07:10', '2022-01-03 10:07:10', 1),
(2, 1, 1, '2021-12-27 10:11:38', '2022-01-03 10:11:38', 3),
(3, 2, 1, '2021-12-27 10:14:13', '2022-01-03 10:14:13', 1),
(4, 2, 1, '2021-12-27 10:15:40', '2022-01-03 10:15:40', 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `diachikh`
--

CREATE TABLE `diachikh` (
  `MaDC` int(20) NOT NULL COMMENT 'Mã số địa chỉ',
  `DiaChi` varchar(255) NOT NULL COMMENT 'Địa chỉ',
  `MSKH` int(20) NOT NULL COMMENT 'Mã số khách hàng '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `diachikh`
--

INSERT INTO `diachikh` (`MaDC`, `DiaChi`, `MSKH`) VALUES
(1, 'Chợ Mới - An Giang', 1),
(2, '22 đường Hai Bà Trưng ấp thị 1 thị trấn mỹ luông huyện chợ mới tỉnh an giang', 2),
(3, 'KDC Hưng Phú', 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hanghoa`
--

CREATE TABLE `hanghoa` (
  `MSHH` int(20) NOT NULL COMMENT 'Mã số hàng hóa',
  `TenHH` varchar(255) NOT NULL COMMENT 'Tên hàng hóa',
  `QuyCach` varchar(500) NOT NULL COMMENT 'Quy cách ',
  `Gia` int(11) NOT NULL COMMENT 'Giá',
  `SoLuongHang` int(50) NOT NULL COMMENT 'Số Lượng hàng hóa',
  `MaLoaiHang` int(20) NOT NULL COMMENT 'Mã loại hàng'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `hanghoa`
--

INSERT INTO `hanghoa` (`MSHH`, `TenHH`, `QuyCach`, `Gia`, `SoLuongHang`, `MaLoaiHang`) VALUES
(1, 'Samsung Galaxy Z Fold3 5G', '* Tính năng chính có thể khác với Thông số kỹ thuật chính.\r\n* Pin : Thời lượng pin thực tế thay đổi tùy thuộc vào môi trường mạng, các tính năng và ứng dụng được dùng, tần suất cuộc gọi và tin nhắn, số lần sạc và nhiều yếu tố khác.\r\n* Bộ nhớ người dùng kh', 43990000, 98, 1),
(2, 'Iphone 12 64GB', 'Công nghệ màn hình: OLED\r\nĐộ phân giải: 1170 x 2532 Pixels\r\nMàn hình rộng: 6.1\" - Tần số quét 60 Hz\r\nĐộ sáng tối đa: 1200 nits\r\nMặt kính cảm ứng:Kính cường lực Ceramic Shield\r\nĐộ phân giải:2 camera 12 MP', 20490000, 100, 2),
(3, 'Xiaomi 11 Lite 5G NE', 'Màn hình: 7.6 inch (màn hình chính), 6.2 inch (màn hình phụ), Dynamic AMOLED 2X, 120 Hz. Chip: Snapdragon 888, tiến trình 5 nm, hỗ trợ 5G. RAM: 12 GB. Bộ nhớ trong: 256 GB hoặc 512 GB.', 9490000, 100, 3),
(4, 'Galaxy A52 8GB/128GB', 'Galaxy A52 (8GB/128GB) mẫu smartphone thuộc dòng Galaxy A của Samsung, với nhiều sự thay đổi lớn về thiết kế lẫn cấu hình, cung cấp những công nghệ đột phá, thiết lập tiêu chuẩn trải nghiệm mới cho người dùng ở phân khúc tầm trung.', 8790000, 95, 1),
(5, 'OPPO Reno6 Z 5G', 'Một công nghệ đặc biệt đã được áp dụng nhằm ẩn cảm biến ở mặt trên của chiếc điện thoại OPPO, từ đó giúp điện thoại trông đơn giản hơn. Có thể sẽ giảm chức năng trên nếu tấm film hay tấm bảo vệ phủ lên vùng cảm biến này. Tham khảo thông tin chính thức từ ', 9490000, 98, 4),
(6, 'Samsung Galaxy S20 FE', 'Đo theo đường chéo hình chữ nhật, kích thước màn hình Galaxy S20 FE là 6.5 inch trong hình chữ nhật đầy đủ và 6.3 inch sau khi đã trừ các góc bo tròn; Kích thước màn hình Galaxy S20 là 6.2 inch trong hình chữ nhật đầy đủ và 6.1 inch sau khi đã trừ các ', 12990000, 100, 1),
(7, 'OPPO A74', 'OPPO luôn đa dạng hoá các sản phẩm của mình từ giá rẻ cho đến cao cấp. Trong đó, điện thoại OPPO A74 4G được nằm trong phân khúc tầm trung rất đáng chú ý với nhiều tính năng và smartphone cũng chính là bản nâng cấp của OPPO A73 ra mắt trước đó.', 6690000, 100, 4),
(8, 'Realme C21Y 4GB', 'Realme C21Y chiếc điện thoại với thiết kế đẹp mắt, tinh tế hướng đến đối tượng người dùng phổ thông đang tìm kiếm một sản phẩm với cấu hình tốt, đầy đủ tính năng hấp dẫn và đặc biệt là pin khủng cho một ngày làm việc sử dụng lâu dài. \r\n', 3990000, 100, 5),
(9, 'Realme C11 (2021)', 'Realme C11 được trang bị màn hình kích thước lớn 6.5 inch, mang phong cách thiết kế quen thuộc trên các dòng điện thoại giá rẻ Realme với phần notch giọt nước phía trên và phần viền bezel đã được tối giản nhất có thể để có thể mang tới những trải nghi', 2990000, 97, 5),
(10, 'Xiaomi 11T 5G 256GB', 'Xiaomi 11T 5G sở hữu màn hình AMOLED, viên pin siêu khủng cùng camera độ phân giải 108 MP, chiếc smartphone này của Xiaomi sẽ đáp ứng mọi nhu cầu sử dụng của bạn, từ giải trí đến làm việc đều vô cùng mượt mà.', 11390000, 98, 3),
(11, 'OPPO A95', 'OPPO A95 có thiết kế trẻ trung hiện đại với công nghệ phủ màu độc quyền OPPO. Nó mềm mại mượt mà, chống mài mòn và chống bám vân tay một cách hiệu quả', 6990000, 100, 4),
(12, 'OPPO Find X3 Pro 5G', 'OPPO đã làm khuynh đảo thị trường smartphone khi cho ra đời chiếc điện thoại OPPO Find X3 Pro 5G. Đây là một sản phẩm có thiết kế độc đáo, sở hữu cụm camera khủng, cấu hình thuộc top đầu trong thế giới Android.', 23990000, 100, 4),
(13, 'Xiaomi Redmi Note 10 Pro 8GB-128GB ', 'Xiaomi Redmi Note 10 Pro MFF là phiên bản đặc biệt với khẩu hiệu \"Khai phá Tiềm năng Vô cực\" được Xiaomi ra mắt dành cho người hâm mộ. Cấu hình tương tự Redmi Note 10 Pro còn thiết kế thì được cách tân một ít để phù hợp với đối tượng Mi Fan.', 7490000, 100, 3),
(14, 'Xiaomi Redmi 9C (4GB/128GB)', 'Redmi 9C (4GB/128GB) được trang bị màn hình lớn, viên pin trâu, 3 camera AI cùng một hiệu năng đầy ổn định sẽ là lựa chọn tốt cho khách hàng đang muốn tìm một chiếc smartphone giá rẻ đầy đủ tính năng đến từ Xiaomi', 3490000, 100, 3),
(15, 'IPhone 13 128GB ', 'Trong khi sức hút đến từ bộ 4 phiên bản iPhone 12 vẫn chưa nguội đi, thì Apple đã mang đến cho người dùng một siêu phẩm mới iPhone 13 - điện thoại có nhiều cải tiến thú vị sẽ mang lại những trải nghiệm hấp dẫn nhất cho người dùng.', 24490000, 100, 2),
(16, 'IPhone 13 Pro Max 128GB', 'iPhone 13 Pro Max 128GB - siêu phẩm được mong chờ nhất ở nửa cuối năm 2021 đến từ Apple. Máy có thiết kế không mấy đột phá khi so với người tiền nhiệm, bên trong đây vẫn là một sản phẩm có màn hình siêu đẹp, tần số quét được nâng cấp lên 120 Hz mượt mà, cảm biến camera có kích thước lớn hơn, cùng hiệu năng mạnh mẽ với sức mạnh đến từ Apple A15 Bionic, sẵn sàng cùng bạn chinh phục mọi thử thách.', 33990000, 100, 2),
(17, 'IPhone 12 Pro Max 256GB', 'Chiếc điện thoại iPhone 12 Pro Max 256 GB là mẫu smartphone sở hữu nhiều tính năng nổi bật với hệ thống camera chất lượng, hiệu năng vượ00t trội hay hỗ trợ kết nối 5G hứa hẹn sẽ là mẫu sản phẩm mang lại cảm giác trải nghiệm tối ưu cho người dùng.', 36990000, 100, 2),
(18, 'Realme 7 Pro', 'Chiếc điện thoại Realme 7 Pro của Realme chính thức ra mắt. Nổi bật với 4 camera sau AI chuyên nghiệp, cấu hình mạnh mẽ và công nghệ sạc cực nhanh SuperDart 65 W đi kèm nhiều tính năng nổi trội khác.', 8790000, 100, 5),
(19, 'Realme 6i ', 'Thể hiện đẳng cấp Pro trong mức giá bình dân, Xiaomi Redmi Note 10 Pro mang đến cho người dùng chiếc điện thoại thực sự mạnh mẽ với bộ vi xử lý Snapdragon 732G, màn hình 120Hz và 4 camera 108MP chuyên nghiệp.', 7490000, 100, 5),
(20, 'Samsung Galaxy Z Flip3 5G 256GB', 'Nối tiếp thành công của Galaxy Z Flip 5G, trong sự kiện Galaxy Unpacked vừa qua Samsung tiếp tục giới thiệu đến thế giới về Galaxy Z Flip3 5G 256GB. Sản phẩm có nhiều cải tiến từ độ bền cho đến hiệu năng và thậm chí nó còn vượt xa hơn mong đợi của mọi người.', 26990000, 100, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hinhhanghoa`
--

CREATE TABLE `hinhhanghoa` (
  `MaHinh` int(20) NOT NULL COMMENT 'Mã hình ',
  `TenHinh` varchar(255) NOT NULL COMMENT 'Tên Hình',
  `MSHH` int(20) NOT NULL COMMENT 'Mã số hàng hóa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `hinhhanghoa`
--

INSERT INTO `hinhhanghoa` (`MaHinh`, `TenHinh`, `MSHH`) VALUES
(1, 'sp1.1.jpg', 1),
(2, 'sp2.jpg', 2),
(3, 'sp3.jpg', 3),
(4, 'sp4.jpg', 4),
(5, 'sp5.jpg', 5),
(6, 'sp6.jpg', 6),
(7, 'sp7.jpg', 7),
(8, 'sp8.jpg', 8),
(9, 'sp9.jpg', 9),
(10, 'sp10.jpg', 10),
(11, 'sp11.jpg', 11),
(12, 'sp12.jpg', 12),
(13, 'sp13.jpg', 13),
(14, 'sp14.jpg', 14),
(15, 'sp15.jpg', 15),
(16, 'sp16.jpg', 16),
(17, 'sp17.jpg', 17),
(18, 'sp18.jpg', 18),
(19, 'sp19.jpg', 19),
(20, 'sp20.jpg', 20);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

CREATE TABLE `khachhang` (
  `MSKH` int(20) NOT NULL COMMENT 'Mã số khách hàng',
  `HoTenKH` varchar(255) NOT NULL COMMENT 'Họ tên khách hàng',
  `username` varchar(20) NOT NULL COMMENT 'Tên đăng nhập',
  `Password` varchar(255) NOT NULL COMMENT 'Mật khẩu',
  `TenCongTy` varchar(255) NOT NULL COMMENT 'Tên công ty',
  `SoDienThoai` int(20) NOT NULL COMMENT 'Số điện thoại',
  `SoFax` int(20) NOT NULL COMMENT 'Số Fax'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`MSKH`, `HoTenKH`, `username`, `Password`, `TenCongTy`, `SoDienThoai`, `SoFax`) VALUES
(1, 'Nguyễn Thanh Hưng', 'hungctu', '$2y$10$.HAEqd1UW1fu5t.bhIvBE.JNKsJ.ANCRh14jYXAJyknVAahiDaIHa', 'TonyK', 1682629001, 84336996),
(2, 'Tăng Gia Khánh', 'khách lẻ', '', 'TNHH SuperIdol', 989793085, 2147483647),
(3, 'Bao Thanh Thiên', 'baochanctu', '$2y$10$81qkvQOXtkwakLWZOVtG5uGz5hEpKVGiJ8PRe20XNPPpN3jJNnyS6', 'TonyK', 763885442, 845568793);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaihanghoa`
--

CREATE TABLE `loaihanghoa` (
  `MaLoaiHang` int(20) NOT NULL COMMENT 'Mã loại hàng',
  `TenLoaiHang` varchar(255) NOT NULL COMMENT 'Tên loại hàng hóa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `loaihanghoa`
--

INSERT INTO `loaihanghoa` (`MaLoaiHang`, `TenLoaiHang`) VALUES
(1, 'SamSung Galaxy'),
(2, 'Iphone'),
(3, 'Xiaomi'),
(4, 'OPPO'),
(5, 'Realme'),
(6, 'Tai nghe'),
(7, 'Pin sạc dự phòng ');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhanvien`
--

CREATE TABLE `nhanvien` (
  `MSNV` int(20) NOT NULL COMMENT 'Mã số nhân viên',
  `HoTenNV` varchar(255) NOT NULL COMMENT 'Họ tên nhân viên',
  `username` varchar(20) NOT NULL COMMENT 'Tên đăng nhập',
  `Password` varchar(20) NOT NULL COMMENT 'Mật khẩu',
  `ChucVu` varchar(20) NOT NULL COMMENT 'Chức vụ',
  `DiaChi` varchar(255) NOT NULL COMMENT 'Địa chỉ nhân viên',
  `SoDienThoai` int(20) NOT NULL COMMENT 'Số điện thoại'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `nhanvien`
--

INSERT INTO `nhanvien` (`MSNV`, `HoTenNV`, `username`, `Password`, `ChucVu`, `DiaChi`, `SoDienThoai`) VALUES
(1, 'Trần Nguyễn Dương Chi', 'cochictu', '$2y$10$VpNUVFpGW5Zlh', 'Admin', 'Cái Răng Cần Thơ', 9476531);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chitietdathang`
--
ALTER TABLE `chitietdathang`
  ADD PRIMARY KEY (`SoDonDH`,`MSHH`),
  ADD KEY `MSHH` (`MSHH`);

--
-- Chỉ mục cho bảng `dathang`
--
ALTER TABLE `dathang`
  ADD PRIMARY KEY (`SoDonDH`),
  ADD KEY `MSKH` (`MSKH`),
  ADD KEY `MSNV` (`MSNV`);

--
-- Chỉ mục cho bảng `diachikh`
--
ALTER TABLE `diachikh`
  ADD PRIMARY KEY (`MaDC`),
  ADD KEY `MSKH` (`MSKH`);

--
-- Chỉ mục cho bảng `hanghoa`
--
ALTER TABLE `hanghoa`
  ADD PRIMARY KEY (`MSHH`),
  ADD KEY `MaLoaiHang` (`MaLoaiHang`);

--
-- Chỉ mục cho bảng `hinhhanghoa`
--
ALTER TABLE `hinhhanghoa`
  ADD PRIMARY KEY (`MaHinh`),
  ADD KEY `MSHH` (`MSHH`);

--
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`MSKH`);

--
-- Chỉ mục cho bảng `loaihanghoa`
--
ALTER TABLE `loaihanghoa`
  ADD PRIMARY KEY (`MaLoaiHang`);

--
-- Chỉ mục cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`MSNV`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `dathang`
--
ALTER TABLE `dathang`
  MODIFY `SoDonDH` int(50) NOT NULL AUTO_INCREMENT COMMENT 'Số đơn đặt hàng';

--
-- AUTO_INCREMENT cho bảng `diachikh`
--
ALTER TABLE `diachikh`
  MODIFY `MaDC` int(20) NOT NULL AUTO_INCREMENT COMMENT 'Mã số địa chỉ', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `hanghoa`
--
ALTER TABLE `hanghoa`
  MODIFY `MSHH` int(20) NOT NULL AUTO_INCREMENT COMMENT 'Mã số hàng hóa', AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `hinhhanghoa`
--
ALTER TABLE `hinhhanghoa`
  MODIFY `MaHinh` int(20) NOT NULL AUTO_INCREMENT COMMENT 'Mã hình ', AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `MSKH` int(20) NOT NULL AUTO_INCREMENT COMMENT 'Mã số khách hàng', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `loaihanghoa`
--
ALTER TABLE `loaihanghoa`
  MODIFY `MaLoaiHang` int(20) NOT NULL AUTO_INCREMENT COMMENT 'Mã loại hàng', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `MSNV` int(20) NOT NULL AUTO_INCREMENT COMMENT 'Mã số nhân viên', AUTO_INCREMENT=2;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chitietdathang`
--
ALTER TABLE `chitietdathang`
  ADD CONSTRAINT `chitietdathang_ibfk_1` FOREIGN KEY (`MSHH`) REFERENCES `hanghoa` (`MSHH`),
  ADD CONSTRAINT `chitietdathang_ibfk_2` FOREIGN KEY (`SoDonDH`) REFERENCES `dathang` (`SoDonDH`);

--
-- Các ràng buộc cho bảng `dathang`
--
ALTER TABLE `dathang`
  ADD CONSTRAINT `dathang_ibfk_1` FOREIGN KEY (`MSKH`) REFERENCES `khachhang` (`MSKH`),
  ADD CONSTRAINT `dathang_ibfk_2` FOREIGN KEY (`MSNV`) REFERENCES `nhanvien` (`MSNV`);

--
-- Các ràng buộc cho bảng `diachikh`
--
ALTER TABLE `diachikh`
  ADD CONSTRAINT `diachikh_ibfk_1` FOREIGN KEY (`MSKH`) REFERENCES `khachhang` (`MSKH`);

--
-- Các ràng buộc cho bảng `hanghoa`
--
ALTER TABLE `hanghoa`
  ADD CONSTRAINT `hanghoa_ibfk_1` FOREIGN KEY (`MaLoaiHang`) REFERENCES `loaihanghoa` (`MaLoaiHang`);

--
-- Các ràng buộc cho bảng `hinhhanghoa`
--
ALTER TABLE `hinhhanghoa`
  ADD CONSTRAINT `hinhhanghoa_ibfk_1` FOREIGN KEY (`MSHH`) REFERENCES `hanghoa` (`MSHH`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
