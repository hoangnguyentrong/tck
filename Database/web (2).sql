-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 07, 2023 lúc 03:39 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `web`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `doctors`
--

CREATE TABLE `doctors` (
  `Email_doctor` varchar(255) NOT NULL,
  `FullName_doctor` varchar(255) NOT NULL,
  `passwords_doctor` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `doctors`
--

INSERT INTO `doctors` (`Email_doctor`, `FullName_doctor`, `passwords_doctor`) VALUES
('hoang@123', 'nguyễn trọng', '111111'),
('hoangnguyen30092003@gmail.com', 'hoangnguyen', '111111'),
('munii@gamil', 'hàuheuf', '111111'),
('viet.2k3.gm@gmail.com', 'hoangnguyen', '11111');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `medicines`
--

CREATE TABLE `medicines` (
  `Medicine_ID` varchar(255) NOT NULL,
  `Medicine_Name` varchar(255) NOT NULL,
  `Min_Dose` int(11) DEFAULT NULL,
  `Max_Dose` int(11) DEFAULT NULL,
  `Max_Frequency` int(11) DEFAULT NULL,
  `Unit` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `medicines`
--

INSERT INTO `medicines` (`Medicine_ID`, `Medicine_Name`, `Min_Dose`, `Max_Dose`, `Max_Frequency`, `Unit`) VALUES
('M01', 'Paracetamol', 50, 500, 3, 'mg'),
('M010', 'Chymotrypsin', 50, 400, 2, 'mg'),
('M011', 'Rodogyl', 10, 120, 3, 'mg'),
('M012', 'Elevit', 5, 150, 3, 'mg'),
('M02', 'Ibuprofen', 100, 800, 2, 'mg'),
('M03', 'Aspirin', 20, 200, 4, 'mg'),
('M04', 'Loratadine', 150, 1500, 3, 'mg'),
('M05', 'Omeprazole', 50, 425, 2, 'mg'),
('M06', 'Omeprazole', 250, 2500, 1, 'mg'),
('M07', 'Ciprofloxacin', 50, 500, 2, 'mg'),
('M08', 'Metformin', 20, 240, 3, 'mg'),
('M09', 'Simvastatin', 100, 1400, 4, 'mg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `patients`
--

CREATE TABLE `patients` (
  `Patient_ID` varchar(255) NOT NULL,
  `Full_Name_patient` varchar(255) NOT NULL,
  `Date_of_Birth` date NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Phone_number` varchar(15) NOT NULL,
  `Email_patient` varchar(255) NOT NULL,
  `Health_Insurance_ID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `patients`
--

INSERT INTO `patients` (`Patient_ID`, `Full_Name_patient`, `Date_of_Birth`, `Gender`, `Address`, `Phone_number`, `Email_patient`, `Health_Insurance_ID`) VALUES
('P008', 'Tâm Nguyễn', '1995-01-30', 'Nữ', '777 Đường Số 7, Thành phố', '03332221111', 'tam@example.com', 'H87654'),
('P009', 'Đức Nguyễn', '1988-11-12', 'Nam', '999 Đường Số 8, Thành phố', '05554443333', 'duc@example.com', 'H34567'),
('P010', 'Chị Lan Nguyễn', '1998-06-18', 'Nữ', '333 Đường Số 9, Thành phố', '02223334444', 'lan@example.com', 'H65432'),
('P011', 'Tùng Nguyễn', '1990-04-02', 'Nam', '888 Đường Số 10, Thành phố', '04445556666', 'tung@example.com', 'H98765'),
('P02', 'Hải Nguyễn', '1985-08-20', 'Nam', '789 Đường Số 1, Thành phố', '01112223333', 'hai@example.com', 'H67890'),
('P03', 'Lan Nguyễn', '1992-03-15', 'Nữ', '456 Đường Số 2, Thành phố', '03334445555', 'lan@example.com', 'H54321'),
('P04', 'Hà Nguyễn', '1980-12-10', 'Nữ', '123 Đường Số 3, Thành phố', '06667778888', 'ha@example.com', 'H12345'),
('P05', 'Hoàng Nguyễn', '2000-05-05', 'Nam', '987 Đường Số 4, Thành phố', '09998887777', 'hoang@example.com', 'H98765'),
('P06', 'Hương Nguyễn', '1977-09-25', 'Nữ', '111 Đường Số 5, Thành phố', '02221119999', 'huong@example.com', 'H45678'),
('P07', 'Trung Nguyễn', '1982-07-08', 'Nam', '555 Đường Số 6, Thành phố', '07778889999', 'trung@example.com', 'H23456');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `prescriptiondetails`
--

CREATE TABLE `prescriptiondetails` (
  `Prescription_ID` int(11) NOT NULL,
  `Medicine_ID` varchar(255) NOT NULL,
  `Single_Dose` int(11) DEFAULT NULL,
  `Frequency` int(11) DEFAULT NULL,
  `Duration` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `prescriptiondetails`
--

INSERT INTO `prescriptiondetails` (`Prescription_ID`, `Medicine_ID`, `Single_Dose`, `Frequency`, `Duration`) VALUES
(30, 'M011', 100, 2, 2),
(31, 'M011', 100, 2, 2),
(32, 'M01', 100, 2, 2),
(33, 'M011', 100, 2, 2),
(34, 'M011', 100, 2, 2),
(35, 'M011', 100, 2, 2),
(36, 'M011', 100, 2, 2),
(36, 'M012', 100, 2, 2),
(37, 'M011', 100, 2, 2),
(37, 'M012', 100, 2, 2),
(38, 'M011', 100, 2, 2),
(38, 'M012', 100, 2, 2),
(39, 'M011', 100, 2, 2),
(39, 'M012', 100, 2, 2),
(40, 'M011', 100, 2, 2),
(40, 'M012', 100, 2, 2),
(41, 'M011', 100, 2, 2),
(41, 'M012', 100, 2, 2),
(42, 'M011', 100, 2, 2),
(42, 'M012', 100, 2, 2),
(43, 'M011', 100, 2, 2),
(43, 'M012', 100, 2, 2),
(44, 'M011', 100, 2, 2),
(44, 'M012', 100, 2, 2),
(45, 'M011', 100, 2, 2),
(45, 'M012', 100, 2, 2),
(46, 'M011', 100, 2, 2),
(46, 'M012', 100, 2, 2),
(47, 'M011', 100, 2, 2),
(48, 'M011', 100, 2, 2),
(48, 'M012', 100, 2, 2),
(49, 'M011', 100, 2, 2),
(49, 'M012', 100, 2, 2),
(50, 'M011', 100, 2, 2),
(50, 'M012', 100, 2, 2),
(51, 'M011', 100, 2, 2),
(51, 'M012', 100, 2, 2),
(52, 'M011', 100, 2, 2),
(52, 'M012', 100, 2, 2),
(53, 'M011', 100, 2, 2),
(54, 'M011', 100, 2, 2),
(55, 'M011', 100, 2, 2),
(55, 'M012', 100, 2, 2),
(56, 'M011', 100, 2, 2),
(57, 'M011', 100, 2, 2),
(58, 'M011', 100, 2, 2),
(58, 'M012', 100, 2, 2),
(59, 'M011', 200, 2, 2),
(59, 'M012', 100, 2, 2),
(59, 'M01', 100, 2, 2),
(60, 'M011', 100, 2, 2),
(60, 'M012', 100, 2, 2),
(60, 'M01', 100, 2, 2),
(60, 'M03', 100, 2, 2),
(61, 'M011', 100, 2, 2),
(61, 'M012', 100, 2, 2),
(61, 'M01', 100, 2, 2),
(61, 'M03', 100, 2, 2),
(62, 'M011', 100, 2, 2),
(63, 'M011', 100, 2, 2),
(63, 'M012', 100, 2, 2),
(64, 'M011', 100, 2, 2),
(64, 'M012', 100, 2, 2),
(65, 'M03', 100, 2, 2),
(65, 'M011', 1000, 2, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `prescriptions`
--

CREATE TABLE `prescriptions` (
  `Prescription_ID` int(11) NOT NULL,
  `Patient_ID` varchar(255) NOT NULL,
  `Email_doctor` varchar(255) NOT NULL,
  `Date_print` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `prescriptions`
--

INSERT INTO `prescriptions` (`Prescription_ID`, `Patient_ID`, `Email_doctor`, `Date_print`) VALUES
(30, 'P04', 'hoangnguyen30092003@gmail.com', '2023-12-06 19:10:30'),
(31, 'P04', 'hoangnguyen30092003@gmail.com', '2023-12-06 19:22:05'),
(32, 'P011', 'hoangnguyen30092003@gmail.com', '2023-12-06 19:34:19'),
(33, 'P04', 'hoangnguyen30092003@gmail.com', '2023-12-06 19:35:19'),
(34, 'P04', 'hoangnguyen30092003@gmail.com', '2023-12-06 19:36:06'),
(35, 'P04', 'hoangnguyen30092003@gmail.com', '2023-12-06 19:41:08'),
(36, 'P04', 'hoangnguyen30092003@gmail.com', '2023-12-06 19:44:13'),
(37, 'P04', 'hoangnguyen30092003@gmail.com', '2023-12-06 19:44:37'),
(38, 'P04', 'hoangnguyen30092003@gmail.com', '2023-12-06 19:44:39'),
(39, 'P04', 'hoangnguyen30092003@gmail.com', '2023-12-06 19:45:08'),
(40, 'P04', 'hoangnguyen30092003@gmail.com', '2023-12-06 19:47:38'),
(41, 'P04', 'hoangnguyen30092003@gmail.com', '2023-12-06 19:47:42'),
(42, 'P04', 'hoangnguyen30092003@gmail.com', '2023-12-06 19:47:46'),
(43, 'P04', 'hoangnguyen30092003@gmail.com', '2023-12-06 19:47:48'),
(44, 'P04', 'hoangnguyen30092003@gmail.com', '2023-12-06 19:50:23'),
(45, 'P04', 'hoangnguyen30092003@gmail.com', '2023-12-06 19:50:25'),
(46, 'P04', 'hoangnguyen30092003@gmail.com', '2023-12-06 19:50:27'),
(47, 'P04', 'hoangnguyen30092003@gmail.com', '2023-12-06 19:53:35'),
(48, 'P04', 'hoangnguyen30092003@gmail.com', '2023-12-06 19:54:13'),
(49, 'P04', 'hoangnguyen30092003@gmail.com', '2023-12-06 19:54:48'),
(50, 'P04', 'hoangnguyen30092003@gmail.com', '2023-12-06 19:54:50'),
(51, 'P04', 'hoangnguyen30092003@gmail.com', '2023-12-06 19:54:52'),
(52, 'P04', 'hoangnguyen30092003@gmail.com', '2023-12-06 19:55:40'),
(53, 'P04', 'hoangnguyen30092003@gmail.com', '2023-12-06 20:02:20'),
(54, 'P04', 'hoangnguyen30092003@gmail.com', '2023-12-06 20:02:39'),
(55, 'P04', 'hoangnguyen30092003@gmail.com', '2023-12-06 20:07:32'),
(56, 'P04', 'hoangnguyen30092003@gmail.com', '2023-12-06 20:08:37'),
(57, 'P04', 'hoangnguyen30092003@gmail.com', '2023-12-06 20:09:11'),
(58, 'P04', 'hoangnguyen30092003@gmail.com', '2023-12-06 20:14:16'),
(59, 'P04', 'hoangnguyen30092003@gmail.com', '2023-12-07 01:59:03'),
(60, 'P04', 'hoangnguyen30092003@gmail.com', '2023-12-07 11:09:53'),
(61, 'P04', 'hoangnguyen30092003@gmail.com', '2023-12-07 11:11:21'),
(62, 'P04', 'hoangnguyen30092003@gmail.com', '2023-12-07 11:43:19'),
(63, 'P04', 'hoangnguyen30092003@gmail.com', '2023-12-07 13:47:04'),
(64, 'P04', 'hoangnguyen30092003@gmail.com', '2023-12-07 13:51:32'),
(65, 'P04', 'hoangnguyen30092003@gmail.com', '2023-12-07 13:57:13');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`Email_doctor`);

--
-- Chỉ mục cho bảng `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`Medicine_ID`);

--
-- Chỉ mục cho bảng `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`Patient_ID`);

--
-- Chỉ mục cho bảng `prescriptiondetails`
--
ALTER TABLE `prescriptiondetails`
  ADD KEY `Prescription_ID` (`Prescription_ID`),
  ADD KEY `Medicine_ID` (`Medicine_ID`);

--
-- Chỉ mục cho bảng `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`Prescription_ID`),
  ADD KEY `Patient_ID` (`Patient_ID`),
  ADD KEY `Email_doctor` (`Email_doctor`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `Prescription_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `prescriptiondetails`
--
ALTER TABLE `prescriptiondetails`
  ADD CONSTRAINT `prescriptiondetails_ibfk_1` FOREIGN KEY (`Prescription_ID`) REFERENCES `prescriptions` (`Prescription_ID`),
  ADD CONSTRAINT `prescriptiondetails_ibfk_2` FOREIGN KEY (`Medicine_ID`) REFERENCES `medicines` (`Medicine_ID`);

--
-- Các ràng buộc cho bảng `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD CONSTRAINT `prescriptions_ibfk_1` FOREIGN KEY (`Patient_ID`) REFERENCES `patients` (`Patient_ID`),
  ADD CONSTRAINT `prescriptions_ibfk_2` FOREIGN KEY (`Email_doctor`) REFERENCES `doctors` (`Email_doctor`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
