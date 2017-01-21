-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2017 at 06:57 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oes`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `correct` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `question_id`, `answer`, `correct`) VALUES
(97, 38, 'True', '1'),
(98, 38, 'False', '0'),
(107, 41, 'student', '1'),
(108, 41, 'justin', '0'),
(109, 41, 'Businessman', '0'),
(110, 41, 'farmer', '0'),
(117, 45, 'True', '1'),
(118, 45, 'False', '0'),
(119, 46, 'True', '1'),
(120, 46, 'False', '0'),
(121, 47, 'True', '1'),
(122, 47, 'False', '0'),
(123, 48, 'sadfs', '1'),
(124, 48, 'sadfsaf', '0'),
(125, 48, 'good', '0'),
(126, 48, 'sadfasf', '0'),
(187, 70, 'True', '1'),
(188, 70, 'False', '0'),
(193, 72, 'good', '1'),
(194, 72, 'asd', '0'),
(195, 72, 'asdsadfs', '0'),
(196, 72, 'asd', '0'),
(197, 73, 'True', '1'),
(198, 73, 'False', '0'),
(199, 74, 'ys', '1'),
(200, 74, 'ry', '0'),
(201, 74, 'rg', '0'),
(202, 74, 'kd', '0'),
(203, 75, 'True', '1'),
(204, 75, 'False', '0'),
(205, 76, 'True', '1'),
(206, 76, 'False', '0'),
(207, 77, 'True', '1'),
(208, 77, 'False', '0'),
(209, 78, 'ys', '1'),
(210, 78, 'asfasf', '0'),
(211, 78, 'asdf', '0'),
(212, 78, 'asdfasf', '0'),
(213, 79, 'True', '1'),
(214, 79, 'False', '0'),
(215, 80, 'True', '1'),
(216, 80, 'False', '0'),
(217, 81, 'no', '1'),
(218, 81, 'asdfasf', '0'),
(219, 81, 'asdfad', '0'),
(220, 81, 'adsfasf', '0'),
(221, 82, 'True', '1'),
(222, 82, 'False', '0'),
(223, 83, 'student', '1'),
(224, 83, 'asdfas', '0'),
(225, 83, 'fasf', '0'),
(226, 83, 'asf', '0'),
(227, 84, 'true', '1'),
(228, 84, 'asdfadsf', '0'),
(229, 84, 'dasfadsf', '0'),
(230, 84, 'asdfadsf', '0');

-- --------------------------------------------------------

--
-- Table structure for table `examinees_info`
--

CREATE TABLE `examinees_info` (
  `id` int(15) NOT NULL,
  `token_id` varchar(256) NOT NULL,
  `name` varchar(256) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `exam_id` int(15) NOT NULL,
  `used` int(15) NOT NULL DEFAULT '0',
  `result` int(16) DEFAULT NULL,
  `published` int(16) NOT NULL DEFAULT '0',
  `suspended` int(16) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `examinees_info`
--

INSERT INTO `examinees_info` (`id`, `token_id`, `name`, `email`, `username`, `password`, `exam_id`, `used`, `result`, `published`, `suspended`) VALUES
(25, '286120184c8d04224e7', 'sfdsaf', 'jdsfd@rfdg', 'raju11', '$2y$10$JcjYUaFGNY4K8PfUzhoSk.owoLJiMEgXv2RmWDcBL94Baihphi0yS', 1, 1, 0, 1, 1),
(26, '822295776c8d04224e7', 'fsdf', 'fsdfs@fdsgfdg', 'baju', '$2y$10$MttvjJa5uXfA5nakTEzkb.GnXWl5e8ICpQeaFSIds2LITNiXhkVLK', 1, 1, 2, 1, 0),
(27, '887233886c8d04224e7', 'dsfs', 'fdasf@dseg', 'tt', '$2y$10$ByQbHS3r7X3Bkd9aOJRUaefq2Y14GcgA/x6.ediqTXEHZF0pwRcs6', 1, 0, 0, 1, 1),
(28, '763224420c8d04224e7', 'fasdf', 'fgsd@fg', 'lul', '$2y$10$3Xp2CmLeNlp9uWS/jycIpeI3GnvNEJRnaJ5ymU7oSJUQjJxo.87ZC', 1, 1, NULL, 0, 0),
(29, '200358921789ee4fcac', 'lkdajfklajsf', 'jahidulpathan@gmail.com', 'fa99asdfadsf', '$2y$10$rWzfNngpIJ3uXyEeukpF4eaArSiuaM1VM/6dOxMzTLwYK0PQLvC3y', 2, 1, NULL, 0, 0),
(30, '820046422789ee4fcac', '', '', '', '', 2, 0, NULL, 0, 0),
(31, '631915853789ee4fcac', '', '', '', '', 2, 0, NULL, 0, 0),
(32, '695836325697904e0ba', 'fasfd', 'sdfs@eaf', 'fa99', '$2y$10$vqEaCc4Z10sgxNQo7PIawOlVsmBo4QDllnLF2ysqTbtHz5BdYMBeq', 4, 1, 1, 0, 0),
(33, '828776246697904e0ba', '', '', '', '', 4, 0, NULL, 1, 0),
(34, '7441848697904e0ba', '', '', '', '', 4, 0, NULL, 1, 0),
(82, '578457347d79db9bf21', '', '', '', '', 5, 0, NULL, 0, 0),
(83, '733364030d79db9bf21', '', '', '', '', 5, 0, NULL, 0, 0),
(84, '583843648d79db9bf21', '', '', '', '', 5, 0, NULL, 0, 0),
(85, '282876758d79db9bf21', '', '', '', '', 5, 0, NULL, 0, 0),
(86, '142351552d79db9bf21', '', '', '', '', 5, 0, NULL, 0, 0),
(87, '114932463d79db9bf21', '', '', '', '', 5, 0, NULL, 0, 0),
(88, '216179151d79db9bf21', '', '', '', '', 5, 0, NULL, 0, 0),
(89, '156482400d79db9bf21', '', '', '', '', 5, 0, NULL, 0, 0),
(90, '89681745d79db9bf21', '', '', '', '', 5, 0, NULL, 0, 0),
(91, '770811652d79db9bf21', '', '', '', '', 5, 0, NULL, 0, 0),
(92, '817018337d79db9bf21', '', '', '', '', 5, 0, NULL, 0, 0),
(93, '219598373d79db9bf21', '', '', '', '', 5, 0, NULL, 0, 0),
(94, '138605686d79db9bf21', '', '', '', '', 5, 0, NULL, 0, 0),
(95, '575563048d79db9bf21', '', '', '', '', 5, 0, NULL, 0, 0),
(96, '495126175d79db9bf21', '', '', '', '', 5, 0, NULL, 0, 0),
(97, '674222267d79db9bf21', '', '', '', '', 5, 0, NULL, 0, 0),
(98, '349965558d79db9bf21', '', '', '', '', 5, 0, NULL, 0, 0),
(99, '720238692d79db9bf21', '', '', '', '', 5, 0, NULL, 0, 0),
(100, '422374775d79db9bf21', '', '', '', '', 5, 0, NULL, 0, 0),
(101, '792727020d79db9bf21', '', '', '', '', 5, 0, NULL, 0, 0),
(102, '886294418d79db9bf21', '', '', '', '', 5, 0, NULL, 0, 0),
(103, '355328d79db9bf21', '', '', '', '', 5, 0, NULL, 0, 0),
(104, '115943032d79db9bf21', '', '', '', '', 5, 0, NULL, 0, 0),
(105, '50779640d79db9bf21', '', '', '', '', 5, 0, NULL, 0, 0),
(106, '548370964d79db9bf21', '', '', '', '', 5, 0, NULL, 0, 0),
(107, '350160352d79db9bf21', '', '', '', '', 5, 0, NULL, 0, 0),
(108, '591909963d79db9bf21', '', '', '', '', 5, 0, NULL, 0, 0),
(109, '261177427d79db9bf21', '', '', '', '', 5, 0, NULL, 0, 0),
(110, '560087928d79db9bf21', '', '', '', '', 5, 0, NULL, 0, 0),
(111, '198023988d79db9bf21', '', '', '', '', 5, 0, NULL, 0, 0),
(112, '857401967d79db9bf21', '', '', '', '', 5, 0, NULL, 0, 0),
(113, '675574311d79db9bf21', '', '', '', '', 5, 0, NULL, 0, 0),
(114, '233499357d79db9bf21', '', '', '', '', 5, 0, NULL, 0, 0),
(115, '497892593d79db9bf21', '', '', '', '', 5, 0, NULL, 0, 0),
(116, '7054249041b0b71d2b2', '', '', '', '', 6, 0, NULL, 0, 0),
(117, '8519794521b0b71d2b2', '', '', '', '', 6, 0, NULL, 0, 0),
(118, '3310118371b0b71d2b2', '', '', '', '', 6, 0, NULL, 0, 0),
(119, '4537791861b0b71d2b2', '', '', '', '', 6, 0, NULL, 0, 0),
(120, '9057227321b0b71d2b2', '', '', '', '', 6, 0, NULL, 0, 0),
(121, '8411449621b0b71d2b2', '', '', '', '', 6, 0, NULL, 0, 0),
(122, '5302141111b0b71d2b2', '', '', '', '', 6, 0, NULL, 0, 0),
(123, '5495619191b0b71d2b2', '', '', '', '', 6, 0, NULL, 0, 0),
(124, '2197818641b0b71d2b2', '', '', '', '', 6, 0, NULL, 0, 0),
(125, '6868975041b0b71d2b2', '', '', '', '', 6, 0, NULL, 0, 0),
(126, '4470239651b0b71d2b2', '', '', '', '', 6, 0, NULL, 0, 0),
(127, '5618045451b0b71d2b2', '', '', '', '', 6, 0, NULL, 0, 0),
(128, '523155711b0b71d2b2', '', '', '', '', 6, 0, NULL, 0, 0),
(129, '2373531701b0b71d2b2', '', '', '', '', 6, 0, NULL, 0, 0),
(130, '4695158311b0b71d2b2', '', '', '', '', 6, 0, NULL, 0, 0),
(131, '5471041901b0b71d2b2', '', '', '', '', 6, 0, NULL, 0, 0),
(132, '1673275471b0b71d2b2', '', '', '', '', 6, 0, NULL, 0, 0),
(133, '6279375281b0b71d2b2', '', '', '', '', 6, 0, NULL, 0, 0),
(134, '1128303621b0b71d2b2', '', '', '', '', 6, 0, NULL, 0, 0),
(135, '4429447961b0b71d2b2', '', '', '', '', 6, 0, NULL, 0, 0),
(136, '5924741841b0b71d2b2', '', '', '', '', 6, 0, NULL, 0, 0),
(137, '5011685681b0b71d2b2', '', '', '', '', 6, 0, NULL, 0, 0),
(138, '7716856361b0b71d2b2', '', '', '', '', 6, 0, NULL, 0, 0),
(139, '6197640881b0b71d2b2', '', '', '', '', 6, 0, NULL, 0, 0),
(140, '9241982861b0b71d2b2', '', '', '', '', 6, 0, NULL, 0, 0),
(141, '2199082321b0b71d2b2', '', '', '', '', 6, 0, NULL, 0, 0),
(142, '7892018341b0b71d2b2', '', '', '', '', 6, 0, NULL, 0, 0),
(143, '6042642951b0b71d2b2', '', '', '', '', 6, 0, NULL, 0, 0),
(144, '8244053741b0b71d2b2', '', '', '', '', 6, 0, NULL, 0, 0),
(145, '4069209851b0b71d2b2', '', '', '', '', 6, 0, NULL, 0, 0),
(146, '6281487071b0b71d2b2', '', '', '', '', 6, 0, NULL, 0, 0),
(147, '6381047891b0b71d2b2', '', '', '', '', 6, 0, NULL, 0, 0),
(148, '5912430461b0b71d2b2', '', '', '', '', 6, 0, NULL, 0, 0),
(149, '1122200071b0b71d2b2', '', '', '', '', 6, 0, NULL, 0, 0),
(150, '2162228621930158c82', 'la', 'la@gmail.com', 'la99', '$2y$10$FBl.nP17OcwKsdOmVqCGv.j1DKpCpVqbQVtETOt.kCsduUYjWnP3C', 7, 1, 1, 1, 0),
(151, '3966264061930158c82', '', '', '', '', 7, 0, NULL, 1, 0),
(152, '5870713457407a83861', 'bil', 'bil@hhhd', 'bil99', '$2y$10$u7PyufZkyeP3jIuSEwmEyOpkrNczlQqbkiZl74UGTVDLituhYf8Ei', 8, 1, 4, 1, 0),
(153, '7691067247407a83861', '', '', '', '', 8, 0, NULL, 1, 0),
(154, '733944936dafa2f87c0', 'saf', 'sdf@eg', 'hm99', '$2y$10$NQyahkiNxIVlC/AMMG5TQeF4reppxlo7s/B0mXmrQz1HzX7SehsJi', 9, 1, 1, 1, 0),
(155, '463573666dafa2f87c0', '', '', '', '', 9, 0, NULL, 1, 0),
(156, '910098764e979f39cea', 'kam', 'asdfasf@rg', 'kam99', '$2y$10$/vYppKKv1ezTIWQ2VnJDXekoL1yGiIHDQzWxiEstFodqaww8fHlkS', 10, 1, 4, 0, 0),
(157, '70902769e979f39cea', '', '', '', '', 10, 0, NULL, 0, 0),
(158, '272618718e979f39cea', '', '', '', '', 10, 0, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `exam_count`
--

CREATE TABLE `exam_count` (
  `id` int(15) NOT NULL,
  `topic_name` varchar(255) NOT NULL,
  `sir_exam_id` int(15) NOT NULL,
  `exam_no` int(15) NOT NULL,
  `q_limit` int(15) DEFAULT NULL,
  `per_q_time` int(16) NOT NULL DEFAULT '20',
  `start_and_end_exam_time` varchar(256) DEFAULT '06/01/2017 20:00:00 06/01/2020 20:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exam_count`
--

INSERT INTO `exam_count` (`id`, `topic_name`, `sir_exam_id`, `exam_no`, `q_limit`, `per_q_time`, `start_and_end_exam_time`) VALUES
(16, 'EA sportss', 58, 1, 3, 23, '01/01/2017 20:00:00 06/01/2020 20:00:00'),
(17, 'à¦œà¦¾à¦¹à¦¿à¦¦', 58, 2, 2, 3, '06/01/2017 20:00:00 06/01/2020 20:00:00'),
(19, 'asdasd', 58, 3, 2, 32, '06/01/2017 20:00:00 06/01/2020 20:00:00'),
(20, 'nstu', 60, 4, 2, 22, '01/12/2017 14:49:59 06/01/2019 20:00:00'),
(26, 'qerer', 60, 5, 23, 22, '06/01/2017 20:00:00 06/01/2020 20:00:00'),
(27, 'sdfgsd', 60, 6, 23, 23, '06/01/2017 20:00:00 06/01/2020 20:00:00'),
(28, 'lara', 60, 7, 1, 70, '01/01/2017 20:00:00 06/01/2020 20:00:00'),
(29, 'database', 63, 8, 4, 70, '01/01/2017 20:00:00 06/01/2020 20:00:00'),
(30, 'falaa', 64, 9, 2, 120, '01/01/2017 20:00:00 06/01/2020 20:00:00'),
(31, 'database', 65, 10, 5, 23, '01/01/2017 20:00:00 06/01/2020 20:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `exam_no` int(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question_id`, `question`, `type`, `exam_no`) VALUES
(38, 38, 'jahid is goodasdsad', 'tf', 1),
(41, 41, 'who is jahid?', 'mc', 1),
(45, 45, 'sdf', 'tf', 1),
(46, 46, 'jahid is good', 'tf', 4),
(47, 47, 'jahid is bad', 'tf', 4),
(48, 48, 'laravel', 'mc', 4),
(70, 70, 'sdfsdfs', 'tf', 4),
(72, 72, 'laravel is', 'mc', 7),
(73, 73, 'I luv php', 'tf', 8),
(74, 74, 'php is good', 'mc', 8),
(75, 75, 'dg', 'tf', 8),
(76, 76, 'dghjjd', 'tf', 8),
(77, 77, 'asfdas', 'tf', 9),
(78, 78, 'asdfa', 'mc', 9),
(79, 79, 'adsfasf', 'tf', 9),
(80, 80, 'jahid is good', 'tf', 10),
(81, 81, 'jahid is bad', 'mc', 10),
(82, 82, 'I am jahid', 'tf', 10),
(83, 83, 'jahid is', 'mc', 10),
(84, 84, 'jahid knows c', 'mc', 10);

-- --------------------------------------------------------

--
-- Table structure for table `reset_password`
--

CREATE TABLE `reset_password` (
  `id` int(16) NOT NULL,
  `userid` int(16) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expirydate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `used` int(15) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reset_password`
--

INSERT INTO `reset_password` (`id`, `userid`, `token`, `expirydate`, `used`) VALUES
(3, 1, '6541560229f41c8ea83', '2017-01-08 08:58:50', 0),
(4, 1, '2609849915158218cda', '2017-01-08 09:00:46', 0),
(5, 1, '593951453ee99a3f034', '2017-01-08 09:02:20', 0),
(19, 24, '1688681950822b78e2e', '2017-01-13 12:07:36', 0),
(20, 24, '461264474f597bababe', '2017-01-13 12:36:31', 0);

-- --------------------------------------------------------

--
-- Table structure for table `teachers_info`
--

CREATE TABLE `teachers_info` (
  `id` int(16) NOT NULL,
  `name` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `username` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teachers_info`
--

INSERT INTO `teachers_info` (`id`, `name`, `email`, `username`, `password`) VALUES
(58, 'jahid', 'jahidulpathan@gmail.com', 'jahid99', '$2y$10$JhyP6KK2eGjfG.NjwIYByuXGNiXeRFx5pShVbJgwFQie38wx4j2Vm'),
(59, 'lu', 'asdfas@fesa', 'lu99', '$2y$10$11t/9Glnil4fAYmY4IKAW.dGjCS0DABoEFXg82z8ZFTiv0tFjXT1y'),
(60, 'faisal', 'sdfasf@fsdbsfd', 'faisal99', '$2y$10$cyxqEFWSuDyVQwjrnixcceTSu0IoP/UpQkQhP5re6sa0GOB2c.aVC'),
(61, 'pathan', 'forg3tful.mind@gmail.com', 'pathan99', '$2y$10$kSX2rp.P4VwSsR8PnXZeV.T59aQu3G8bUY6PiMwVvKU27CsrLCATW'),
(62, 'jaasdasdhd', '', '', ''),
(63, 'hum', 'hum@gmail.com', 'hum99', '$2y$10$0a/zvLBRDo6eHrH4ACMUJ.ITU0cPFHIzrdjq3o0zxNJn6e.AJAbYu'),
(64, 'fal', 'fal@gmail.com', 'fal99', '$2y$10$DxJXvoU3rzlONxTFp74xI.4kX.Q6Vhx/hTZ28qfB0nVCWeWmCmwWa'),
(65, 'hasnat', 'hasnat@gmail.com', 'hasnat99', '$2y$10$MugRdW54iGtB4ruyrql7Ku.Dc15W5KVMdLaUsk00b0IkSjPP6vfjq');

-- --------------------------------------------------------

--
-- Table structure for table `time_maintain`
--

CREATE TABLE `time_maintain` (
  `id` int(11) NOT NULL,
  `the_time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `time_maintain`
--

INSERT INTO `time_maintain` (`id`, `the_time`) VALUES
(1, '2017/01/21, 22:38:24'),
(2, '2017/01/21, 22:38:51'),
(3, '2017/01/21, 22:44:18'),
(4, '2017/01/21, 23:54:38'),
(5, '2017/01/21, 22:46:08'),
(6, '2017/01/21, 22:46:13'),
(7, '2017/01/21, 22:51:56'),
(8, '2017/01/21, 22:53:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `examinees_info`
--
ALTER TABLE `examinees_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token_id` (`token_id`),
  ADD UNIQUE KEY `token_id_2` (`token_id`),
  ADD UNIQUE KEY `token_id_3` (`token_id`),
  ADD UNIQUE KEY `final_exam` (`token_id`),
  ADD KEY `token_id_4` (`token_id`),
  ADD KEY `exam_id` (`exam_id`);

--
-- Indexes for table `exam_count`
--
ALTER TABLE `exam_count`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `exam_no_2` (`exam_no`),
  ADD KEY `exam_no` (`exam_no`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `exam_no` (`exam_no`) USING BTREE;

--
-- Indexes for table `reset_password`
--
ALTER TABLE `reset_password`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers_info`
--
ALTER TABLE `teachers_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `time_maintain`
--
ALTER TABLE `time_maintain`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=231;
--
-- AUTO_INCREMENT for table `examinees_info`
--
ALTER TABLE `examinees_info`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;
--
-- AUTO_INCREMENT for table `exam_count`
--
ALTER TABLE `exam_count`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;
--
-- AUTO_INCREMENT for table `reset_password`
--
ALTER TABLE `reset_password`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `teachers_info`
--
ALTER TABLE `teachers_info`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT for table `time_maintain`
--
ALTER TABLE `time_maintain`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `sdfdsf` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `examinees_info`
--
ALTER TABLE `examinees_info`
  ADD CONSTRAINT `fghchj,` FOREIGN KEY (`exam_id`) REFERENCES `exam_count` (`exam_no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `sdfzsdf` FOREIGN KEY (`exam_no`) REFERENCES `exam_count` (`exam_no`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
