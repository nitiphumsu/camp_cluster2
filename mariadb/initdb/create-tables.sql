-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Apr 12, 2022 at 04:04 PM
-- Server version: 10.3.34-MariaDB-1:10.3.34+maria~focal
-- PHP Version: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cluster2`
--

-- --------------------------------------------------------

--
-- Table structure for table `approval_document`
--

CREATE TABLE `approval_document` (
  `approve_number` int(10) NOT NULL,
  `approve_date` date NOT NULL,
  `approve_time` time NOT NULL,
  `approve_reason` varchar(255) NOT NULL,
  `withdraw_number` int(10) NOT NULL,
  `approve_emp_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `approval_document`
--

INSERT INTO `approval_document` (`approve_number`, `approve_date`, `approve_time`, `approve_reason`, `withdraw_number`, `approve_emp_id`) VALUES
(1, '2022-04-01', '11:00:00', 'เหตุผลสมควร', 1, 2),
(2, '2022-04-01', '12:15:00', 'เหตุผลสมควร', 1, 2),
(3, '2022-04-01', '13:00:00', 'เหตุผลสมควร', 3, 2),
(4, '2022-04-01', '14:00:00', 'เหตุผลสมควร', 4, 2),
(5, '2022-04-01', '14:11:00', 'เหตุผลสมควร', 5, 2),
(6, '2022-04-01', '14:21:00', 'เหตุผลสมควร', 7, 2),
(7, '2022-04-01', '14:43:00', 'เหตุผลสมควร', 11, 2),
(8, '2022-04-01', '14:45:00', 'เหตุผลสมควร', 12, 2),
(9, '2022-04-01', '14:45:00', 'เหตุผลสมควร', 13, 2),
(10, '2022-04-01', '15:45:00', 'เหตุผลสมควร', 18, 2),
(11, '2022-04-01', '14:49:24', 'เหตุผลสมควร', 19, 2),
(12, '2022-04-02', '12:00:00', 'เหตุผลไม่สมควร', 8, 2),
(13, '2022-04-03', '12:00:00', 'เหตุผลไม่สมควร', 16, 2),
(14, '2022-04-04', '12:00:00', 'เหตุผลไม่สมควร', 17, 2);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dep_id` int(4) NOT NULL,
  `dep_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dep_id`, `dep_name`) VALUES
(1, 'Accounting Manager'),
(2, 'Accounting Officer'),
(3, 'Project Manager'),
(4, 'Developer'),
(5, 'Employee');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_id` int(5) NOT NULL,
  `emp_email` varchar(255) NOT NULL,
  `emp_password` varchar(1000) NOT NULL,
  `emp_firstname` varchar(255) NOT NULL,
  `emp_lastname` varchar(255) NOT NULL,
  `emp_status` int(1) NOT NULL,
  `dep_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_id`, `emp_email`, `emp_password`, `emp_firstname`, `emp_lastname`, `emp_status`, `dep_id`) VALUES
(1, 'test@gmail.com', 'eyJjaXBoZXJ0ZXh0IjoiRzM5Rk5XdXBPSFl5ZTh3QkFXeVwvSEE9PSIsIml2IjoiZTkwY2ZmMjIyYTNmZDA4MDhmYjM2ZDBhZmQzOWIyMzgiLCJzYWx0IjoiMDcyNjRmMGRkODcwZjMxMDcwMDg2NzBjZmU3Njk3ODFkMGI1NjY5MGI3Y2I2Y2NkMTY1MzRiY2FmMDI1YzExMGM5MWQ4MDQ5MmNlYWU4YTNmZDljYjVlZWE5OGQwNWY0YzA0NzIzYTViYTBhMWFkZDYyYTJjMDI5Yjk1N2IzMDU5NWJjYzBmMmNjOGI4MmU0OWI3MThlOTFkZmEzODM2NDk0ZWI0Njk0ZDkwMzg0ZDg4ZWI5MzIwYjY2NTc0NTgxY2JmMWEyMmU3OTQ4Mjk3M2QzMjNmNzE2YzNmNGYwYzIzNGNjZjAyMDM0NTgzNDQ4ZTQ0OGVjNDAwODAwN2YxZGFhODJlOTNiNzY1ZDNmMDEyNzg2YjIwNDRiMjU1MGM5NmQ1ZDZiN2Q5MGEzZjg4ZGYxNmNiYzg1OTQ4N2U4ODc4MTBlMmEwNjViODc3ZDk1MTQyYzkxYjYzMWVlMzkzOTBiNWQwNDE3OWNlNDRlMDcwYWJkNjhmOWZmMTNkZjRmOTI1NjlmNDQwOGQ5NDg5ZDMyMTk5MzkyZjExMTg3Zjc5ZGM3MTc2NmU0ZjU4MjFhMzQ2ODA3MGQ1ZjhiNmIxMzNmMDBiMWU4MmJlOGZjYmUwYzI1YmU0MDcwOTE5NGVjMDE5YmU1NmI0Mzg5NTUxZGZjNGMzYzQ3NzY4ZmZmMDUiLCJpdGVyYXRpb25zIjo5OTl9', 'Adam', 'John', 1, 1),
(2, 'pm@gmail.com', 'eyJjaXBoZXJ0ZXh0IjoieWRsWkxNTWNQbExQaFVTVVQ0dDN2QT09IiwiaXYiOiJiN2JhNTg0N2I2MWNjZmU5NjkzYjc3MTkxY2E3MTQ0MCIsInNhbHQiOiJlMDllYjQ1ZDY4NWMzNTIxMTNkMjEyNzM4NDVkZTQzNmE3MGRhM2E2M2E0MjA3ZmFiMTZlMzI3MTQ2MmNlZWFmZDI5MTJmMDJiY2U0MTRmOWVmNDRiNDE4ZTA5ZDkxYjVkMjFjNDFjMmQxNzFhZTZhN2Q2NWM3OTc5ZTUwMmIyMGM2M2Q1MGY2NDBhZjM4YThmZDUwZjcwNDZhYThmNWMzZmVlZjQzOWMwNDM1OGQ4Njc4YWNjZDdjMjYyYzkwMjYxZDhlNGEzNzllZGE5OThhMDE5NDM2NDM0YmJjY2Y0NTc1YTQwZTZlY2I0ODhkMzQwYzk3ODQ0NmU4OTU4YzIzOGM4M2JmZDg4OWY2YmI2NjFlNjI2ZTg2ZWVlM2Y1YTRmYmJmN2EwZDcxMWFjODkwN2U5ZDg5YWUwNGFiNzEwNWMwM2VmNTFmZDZlOWVjNzVjMmM5ZTlmY2NmMDg3N2FmZTg0N2IyYTBlYTc3YjY1NTBlOTViN2Q3ZGVhZGM3MmE1ZTliYWQwYjVkOTRjMDRkZGY0YWEzYWI0ZGMzZGRjYjk1MjYwYWQ4ODhjMWQzNTFjMmVlNWRmMzc2ZDkzZmRhNTZiZTU1YjBmOGNlZWEzMWRjZDhlZGIyNzA1ZjU2MGU3ZWEzZjE2M2EyMzYzY2JiOTcwMjNkMDQ2YmI4YWM1YyIsIml0ZXJhdGlvbnMiOjk5OX0', 'Denny', 'Sky', 1, 3),
(3, 'dev@gmail.com', 'eyJjaXBoZXJ0ZXh0IjoiUVpkdzFpOTAzYjR5VUVKUjJYZFo5QT09IiwiaXYiOiIxZGZhOTMzMGExODhhMjBjOWUxNTdjZGI4YzJhNDRiYiIsInNhbHQiOiI3M2I0NGIxYzk0YmFiN2JjMTQ5NzZjNjAyMGY0ZDcyMTMwMTE2ZTc1YzU0MmQxN2QyZmI2N2RlMDYxNTQxZTA4NzMwYTlmNjA4NjM0Y2ZiZmM4YTM0N2FkY2M4YTQwOGMyOGE2NjdmMzUzYWRmZGU4MmY4N2FiMDdhMmM1YTRmZmFkMDM1Y2RlZTYwNWFkMzE4ZjBkOGI0OGRhMDE1YTI1ZDQ0YWE4ZWVhNzNiOWM1NjNjMmFkYzA5MzA4NWEzNmJmMGY0ZmVjNjA3NjUwNGExZWQ5ODIyYTUwOTA1NDg3MmI4YmMxYWY4OGE1Nzc1OTUwYzBlYjczMjMzZTU3YWRjMTYzOWVkZTUwZDRjNDg5YWM5ZTE0NGM3YjAwNThmMTcyOGYwNDU4NDE1NDIxOWRjZGFjZjYyNTE2ZDYyNjQ3ZjVhYWMyNTFkODE1NTUwMGFkYWI1ODIwY2NhOTY1MDE1MjUwMDk2OTIzNWM4NjA3ZGNkMzM5MTJlZTJhYTZlYjcwYjk0ZDczZTJmZGMwODA3ZjdmMDY4NjA4OGIwZjY5M2M0MTFhNzBiODE1ODRlZThhYzM4M2E5YzU2YTlmYTlmZTYzMzNhZmFjZWI3NTFiMjgxNDQzZDY1ZWE4ZWFiNWIzMjVkMThiZWIxMzU0NjU4Yzc1ODM4MjcwMTI0ZGZjNiIsIml0ZXJhdGlvbnMiOjk5OX0', 'Yohan', 'Fansis', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `withdrawal_document`
--

CREATE TABLE `withdrawal_document` (
  `withdraw_number` int(10) NOT NULL,
  `withdraw_date` date NOT NULL,
  `withdraw_time` time NOT NULL,
  `withdraw_datetravel` date DEFAULT NULL,
  `withdraw_reason` varchar(255) NOT NULL,
  `withdraw_amount` float NOT NULL,
  `withdraw_status` int(1) NOT NULL,
  `withdraw_distance` float NOT NULL,
  `withdraw_traveltype` varchar(100) NOT NULL,
  `withdraw_startlocation` varchar(255) NOT NULL,
  `withdraw_startlon` float NOT NULL,
  `withdraw_startlat` float NOT NULL,
  `withdraw_stoplocation` varchar(255) NOT NULL,
  `withdraw_stoplon` float NOT NULL,
  `withdraw_stoplat` float NOT NULL,
  `withdraw_fuel` float NOT NULL,
  `emp_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `withdrawal_document`
--

INSERT INTO `withdrawal_document` (`withdraw_number`, `withdraw_date`, `withdraw_time`, `withdraw_datetravel`, `withdraw_reason`, `withdraw_amount`, `withdraw_status`, `withdraw_distance`, `withdraw_traveltype`, `withdraw_startlocation`, `withdraw_startlon`, `withdraw_startlat`, `withdraw_stoplocation`, `withdraw_stoplon`, `withdraw_stoplat`, `withdraw_fuel`, `emp_id`) VALUES
(1, '2022-03-01', '12:00:00', '2022-02-12', 'ติดต่องาน', 500, 1, 140.5, 'รถยนต์ส่วนตัว', 'บ้าน', 100.538, 13.765, 'บริษัท ABC', 160.538, 20.765, 34.45, 3),
(2, '2022-03-02', '12:00:00', '2022-02-12', 'ประชุมสัมมนา', 1200, 2, 240, 'รถยนต์ส่วนตัว', 'บริษัทคลิกเน็กซ์ จํากัด', 98.5383, 20.765, 'บริษัท DEF จำกัด', 230.538, 23.765, 36.45, 3),
(3, '2022-03-03', '00:00:00', '2022-02-12', 'ประชุมสัมมนา', 1200, 1, 240, 'รถยนต์ส่วนตัว', 'บริษัทคลิกเน็กซ์ จํากัด', 98.5383, 20.765, 'บริษัท DEF จำกัด', 230.538, 23.765, 36.45, 3),
(4, '2022-03-04', '00:00:00', '2022-02-12', 'ประชุมสัมมนา', 1100, 1, 240, 'รถยนต์ส่วนตัว', 'บริษัทคลิกเน็กซ์ จํากัด', 98.5383, 20.765, 'บริษัท DEF จำกัด', 230.538, 23.765, 36.45, 3),
(5, '2022-03-05', '00:00:00', '2022-02-12', 'ประชุมสัมมนา', 1000, 1, 240, 'รถยนต์ส่วนตัว', 'บริษัทคลิกเน็กซ์ จํากัด', 98.5383, 20.765, 'บริษัท DEF จำกัด', 230.538, 23.765, 35.45, 3),
(6, '2022-03-06', '00:00:00', '2022-02-12', 'ประชุมสัมมนา', 1200, 2, 240, 'รถยนต์ส่วนตัว', 'บริษัทคลิกเน็กซ์ จํากัด', 98.5383, 20.765, 'บริษัท DEF จำกัด', 230.538, 23.765, 36.45, 3),
(7, '2022-03-07', '00:00:00', '2022-02-12', 'ประชุมสัมมนา', 1200, 1, 240, 'รถยนต์ส่วนตัว', 'บริษัทคลิกเน็กซ์ จํากัด', 98.5383, 20.765, 'บริษัท DEF จำกัด', 230.538, 23.765, 36.45, 3),
(8, '2022-03-08', '00:00:00', '2022-02-12', 'ประชุมสัมมนา', 1200, 0, 240, 'รถยนต์ส่วนตัว', 'บริษัทคลิกเน็กซ์ จํากัด', 98.5383, 20.765, 'บริษัท DEF จำกัด', 230.538, 23.765, 36.45, 3),
(9, '2022-03-09', '00:00:00', '2022-02-12', 'ประชุมสัมมนา', 1200, 2, 240, 'รถยนต์ส่วนตัว', 'บริษัทคลิกเน็กซ์ จํากัด', 98.5383, 20.765, 'บริษัท DEF จำกัด', 230.538, 23.765, 36.45, 3),
(10, '2022-03-10', '00:00:00', '2022-02-12', 'ประชุมสัมมนา', 1200, 2, 240, 'รถยนต์ส่วนตัว', 'บริษัทคลิกเน็กซ์ จํากัด', 98.5383, 20.765, 'บริษัท DEF จำกัด', 230.538, 23.765, 36.45, 3),
(11, '2022-03-11', '00:00:00', '2022-02-13', 'ประชุมสัมมนา', 1200, 1, 240, 'รถยนต์ส่วนตัว', 'บริษัทคลิกเน็กซ์ จํากัด', 98.5383, 20.765, 'บริษัท DEF จำกัด', 230.538, 23.765, 36.45, 3),
(12, '2022-03-12', '00:00:00', '2022-02-13', 'ประชุมสัมมนา', 1200, 1, 240, 'รถยนต์ส่วนตัว', 'บริษัทคลิกเน็กซ์ จํากัด', 98.5383, 20.765, 'บริษัท DEF จำกัด', 230.538, 23.765, 36.45, 3),
(13, '2022-03-13', '00:00:00', '2022-02-14', 'ประชุมสัมมนา', 1200, 1, 240, 'รถยนต์ส่วนตัว', 'บริษัทคลิกเน็กซ์ จํากัด', 98.5383, 20.765, 'บริษัท DEF จำกัด', 230.538, 23.765, 36.45, 3),
(14, '2022-03-14', '00:00:00', '2022-02-14', 'ประชุมสัมมนา', 1200, 2, 240, 'รถยนต์ส่วนตัว', 'บริษัทคลิกเน็กซ์ จํากัด', 98.5383, 20.765, 'บริษัท DEF จำกัด', 230.538, 23.765, 36.45, 3),
(15, '2022-03-15', '00:00:00', '2022-02-15', 'ประชุมสัมมนา', 1200, 2, 240, 'รถยนต์ส่วนตัว', 'บริษัทคลิกเน็กซ์ จํากัด', 98.5383, 20.765, 'บริษัท DEF จำกัด', 230.538, 23.765, 36.45, 3),
(16, '2022-03-16', '00:00:00', '2022-02-15', 'ประชุมสัมมนา', 1200, 0, 240, 'รถยนต์ส่วนตัว', 'บริษัทคลิกเน็กซ์ จํากัด', 98.5383, 20.765, 'บริษัท DEF จำกัด', 230.538, 23.765, 36.45, 3),
(17, '2022-03-17', '00:00:00', '2022-02-15', 'ประชุมสัมมนา', 1200, 0, 240, 'รถยนต์ส่วนตัว', 'บริษัทคลิกเน็กซ์ จํากัด', 98.5383, 20.765, 'บริษัท DEF จำกัด', 230.538, 23.765, 36.45, 3),
(18, '2022-02-01', '00:00:00', '2022-02-16', 'ประชุมสัมมนา', 2500, 1, 240, 'รถยนต์ส่วนตัว', 'บริษัทคลิกเน็กซ์ จํากัด', 98.5383, 20.765, 'บริษัท DEF จำกัด', 230.538, 23.765, 36.45, 2),
(19, '2022-04-01', '00:00:00', '2022-02-16', 'ประชุมสัมมนา', 5500, 1, 240, 'รถยนต์ส่วนตัว', 'บริษัทคลิกเน็กซ์ จํากัด', 98.5383, 20.765, 'บริษัท DEF จำกัด', 230.538, 23.765, 36.45, 2),
(21, '2022-03-05', '00:00:00', '2022-02-16', 'ติดต่องานนอกสถานที่', 500, 1, 120, 'รถยนต์ส่วนตัว', 'บริษัทคลิกเน็กซ์ จํากัด', 100.538, 13.765, 'บริษัท ACD ', 160.538, 20.765, 20.45, 2),
(22, '2022-04-12', '00:39:58', '2022-04-06', 'ติดต่อราชการ', 1312.6, 3, 248.33, 'เครื่องบิน', 'มหาวิทยาลัยบูรพา', 100.924, 13.2854, 'จ.ตราด', 102.522, 12.316, 23, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `approval_document`
--
ALTER TABLE `approval_document`
  ADD PRIMARY KEY (`approve_number`),
  ADD KEY `withdraw_number` (`withdraw_number`),
  ADD KEY `emp_id` (`approve_emp_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dep_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`emp_id`),
  ADD KEY `dep_id` (`dep_id`);

--
-- Indexes for table `withdrawal_document`
--
ALTER TABLE `withdrawal_document`
  ADD PRIMARY KEY (`withdraw_number`),
  ADD KEY `emp_id` (`emp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `approval_document`
--
ALTER TABLE `approval_document`
  MODIFY `approve_number` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `dep_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `emp_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `withdrawal_document`
--
ALTER TABLE `withdrawal_document`
  MODIFY `withdraw_number` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `approval_document`
--
ALTER TABLE `approval_document`
  ADD CONSTRAINT `approval_document_ibfk_1` FOREIGN KEY (`withdraw_number`) REFERENCES `withdrawal_document` (`withdraw_number`),
  ADD CONSTRAINT `approval_document_ibfk_2` FOREIGN KEY (`approve_emp_id`) REFERENCES `employee` (`emp_id`);

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`dep_id`) REFERENCES `department` (`dep_id`);

--
-- Constraints for table `withdrawal_document`
--
ALTER TABLE `withdrawal_document`
  ADD CONSTRAINT `withdrawal_document_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`emp_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
