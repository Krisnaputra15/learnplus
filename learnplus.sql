-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2020 at 03:27 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `learnplus`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `level` varchar(5) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `about_urself` varchar(10000) DEFAULT NULL,
  `picture` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `level`, `nama`, `email`, `password`, `about_urself`, `picture`) VALUES
(1, 'admin', 'Krisna Putra Mariyanto', 'krisnaputra1530@gmail.com', '2f24e9589af756452524a76b58ecab1c', 'Hello my name is Krisna Putra Mariyanto and I\'m the admin of this website.\r\n\r\nPlease use this website wisely', 'SAVE_20181104_122731.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `attachment_guru`
--

CREATE TABLE `attachment_guru` (
  `id` int(11) NOT NULL,
  `id_topik` int(11) NOT NULL,
  `nama_file` varchar(10000) NOT NULL,
  `tgl_submit` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attachment_guru`
--

INSERT INTO `attachment_guru` (`id`, `id_topik`, `nama_file`, `tgl_submit`) VALUES
(6, 18, 'Arrofi IKhsan Nur Abror_06_XIRPL6_Latihan Soal IoT.docx', '2020-12-24'),
(7, 18, 'jobsheet IoT 2.docx', '2020-12-24'),
(8, 18, 'jobsheet IoT 3.docx', '2020-12-24'),
(11, 19, 'Folklore Group.pptx', '2020-12-24'),
(30, 36, 'script view controller route.7z', '2020-12-27'),
(31, 36, 'Latihan Soal_PPKN.pdf', '2020-12-27');

-- --------------------------------------------------------

--
-- Table structure for table `attachment_murid`
--

CREATE TABLE `attachment_murid` (
  `id` int(11) NOT NULL,
  `id_topik` int(11) NOT NULL,
  `id_murid` int(11) NOT NULL,
  `nama_file` varchar(10000) NOT NULL,
  `tgl_submit` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `nama_kelas` varchar(1000) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `jumlah_murid` int(11) NOT NULL,
  `picture` varchar(10000) DEFAULT NULL,
  `class_code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `nama_kelas`, `id_guru`, `jumlah_murid`, `picture`, `class_code`) VALUES
(13, 'Bahasa Inggris', 1, 1, 'Achevement 3.jpg', 'KUCP9c'),
(14, 'Internet of Things', 1, 1, 'wp1981460.png', 'oe4TqC'),
(18, 'Korean Language', 1, 2, 'd317ad97173f052e968e9c8ed1bf34a3.jpg', 'B5yPQE'),
(19, 'Economy Class', 3, 2, 'cgd-event-global-economy-2020-policymakers-adobe-stock.jpeg', 'm8u3T0');

-- --------------------------------------------------------

--
-- Table structure for table `data_murid`
--

CREATE TABLE `data_murid` (
  `id` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_murid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_murid`
--

INSERT INTO `data_murid` (`id`, `id_kelas`, `id_murid`) VALUES
(6, 19, 2),
(7, 18, 2);

-- --------------------------------------------------------

--
-- Table structure for table `data_topik`
--

CREATE TABLE `data_topik` (
  `id` int(11) NOT NULL,
  `id_topik` int(11) NOT NULL,
  `id_murid` int(11) NOT NULL,
  `status` varchar(11) NOT NULL,
  `turn_in_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_topik`
--

INSERT INTO `data_topik` (`id`, `id_topik`, `id_murid`, `status`, `turn_in_date`) VALUES
(2, 18, 1, 'turned in', '2020-12-29 19:57:22'),
(3, 19, 1, 'turned in', '2020-12-29 19:57:22'),
(4, 36, 1, 'turned in', '2020-12-27 04:12:05'),
(5, 36, 2, 'uncompleted', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `level` varchar(7) NOT NULL,
  `nama` varchar(1000) NOT NULL,
  `email` varchar(1000) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `about_urself` varchar(10000) DEFAULT NULL,
  `picture` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `level`, `nama`, `email`, `password`, `about_urself`, `picture`) VALUES
(2, 'student', 'Boo', 'boo@gmail.com', 'f39c38615f9a24068e53205305c8c73a', 'Testing bot\r\nboo', 'PrincessPresto1-56a775895f9b58b7d0eaad4f.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `level` varchar(7) NOT NULL,
  `nama` varchar(1000) NOT NULL,
  `email` varchar(1000) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `about_urself` varchar(10000) DEFAULT NULL,
  `picture` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `level`, `nama`, `email`, `password`, `about_urself`, `picture`) VALUES
(1, 'teacher', 'Yeji Hwang', 'Yejihwang19@gmail.com', '2f24e9589af756452524a76b58ecab1c', 'asdfghjk\r\nasdfghj\r\nasdfghj', '6hm65qwv.jpg'),
(3, 'teacher', 'Vicky Mariyanto', 'vickymariyanto@gmail.com', 'f39c38615f9a24068e53205305c8c73a', 'Hi I\'m Vicky Mariyanto.\r\nI\'m Krisna\'s older brother.\r\nNice to know you.', 'pp.jpg'),
(4, 'teacher', 'testing teacher', 'testing@gmail.com', 'f39c38615f9a24068e53205305c8c73a', 'KRisna ANjay', 'desain funa 2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `id` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `nama_topik` varchar(1000) NOT NULL,
  `deskripsi` varchar(10000) NOT NULL,
  `tgl_buat` datetime NOT NULL,
  `tgl_deadline` datetime DEFAULT NULL,
  `tgl_edit_terakhir` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `id_kelas`, `nama_topik`, `deskripsi`, `tgl_buat`, `tgl_deadline`, `tgl_edit_terakhir`) VALUES
(18, 14, 'Arduino Servo', 'lam;ada;dsld', '2020-12-24 09:30:22', '2020-12-29 18:00:00', NULL),
(19, 13, 'Studying Tenses', 'Alright my dear student, those file attached are your preparation material for the next exam.\r\nI hope you study it well so you can get the best result. :)\r\n\r\nfighting!!!', '2020-12-24 09:41:20', NULL, '2020-12-24 02:39:47'),
(36, 19, 'Fibonacci Retracement', 'This topic will talk about fibonacci retracement which we\'ll use in stock trading', '2020-12-27 12:22:25', NULL, NULL),
(40, 13, 'testing topic', 'asdasf\r\nwadada', '2020-12-28 02:19:31', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attachment_guru`
--
ALTER TABLE `attachment_guru`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_topik` (`id_topik`);

--
-- Indexes for table `attachment_murid`
--
ALTER TABLE `attachment_murid`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_topik` (`id_topik`),
  ADD KEY `id_murid` (`id_murid`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_guru` (`id_guru`);

--
-- Indexes for table `data_murid`
--
ALTER TABLE `data_murid`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `id_murid` (`id_murid`);

--
-- Indexes for table `data_topik`
--
ALTER TABLE `data_topik`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attachment_guru`
--
ALTER TABLE `attachment_guru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `attachment_murid`
--
ALTER TABLE `attachment_murid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `data_murid`
--
ALTER TABLE `data_murid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `data_topik`
--
ALTER TABLE `data_topik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attachment_guru`
--
ALTER TABLE `attachment_guru`
  ADD CONSTRAINT `attachment_guru_ibfk_1` FOREIGN KEY (`id_topik`) REFERENCES `topics` (`id`);

--
-- Constraints for table `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `topics_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `classes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
