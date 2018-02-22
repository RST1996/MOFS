-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2018 at 05:08 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mofs`
--

-- --------------------------------------------------------

--
-- Table structure for table `acad_form`
--

CREATE TABLE `acad_form` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acad_form`
--

INSERT INTO `acad_form` (`id`, `name`, `description`, `status`, `created_by`) VALUES
(4, 'Academic Form 2018', 'Test', 0, 1),
(5, 'A Test Form', 'Test form for dvelopment ', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `acad_form_questions`
--

CREATE TABLE `acad_form_questions` (
  `id` int(11) NOT NULL,
  `sub_cat_id` int(11) NOT NULL,
  `question` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acad_form_questions`
--

INSERT INTO `acad_form_questions` (`id`, `sub_cat_id`, `question`) VALUES
(4, 2, 'What is your overall grading about understanding of the subject?'),
(8, 1, 'Use of blackboard'),
(9, 1, 'Use of LCD/OHP');

-- --------------------------------------------------------

--
-- Table structure for table `acad_receipients`
--

CREATE TABLE `acad_receipients` (
  `resp_id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `hash` varchar(100) NOT NULL,
  `percentage_group` int(11) DEFAULT NULL,
  `submit_flag` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acad_receipients`
--

INSERT INTO `acad_receipients` (`resp_id`, `form_id`, `hash`, `percentage_group`, `submit_flag`) VALUES
(1, 4, '15184213158ccc3e3ca0b17a2e717462add845db93b81b8de5', 2, 0),
(2, 4, '151842132759f3a94eca3ca411af1437876d0c6671d4f00aa8', NULL, 0),
(3, 4, '151842137446e3561788567e68a92cd58627ed7d47b1229907', 2, 0),
(4, 4, '1518421385fcc90935fa6cac7c127dbddc67ef25ad020bd577', NULL, 0),
(5, 4, '1518421401c7127a8f18255541c151cec8d9a30a28653d1c9f', 3, 0),
(6, 4, '1518421417e29fb4a22a67ca71081d446c98e3ebbd191b5626', NULL, 0),
(7, 4, '1518421450f019ebc649126fc29e63bd520b73734d636684a2', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `acad_response`
--

CREATE TABLE `acad_response` (
  `resp_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `ques_id` int(11) NOT NULL,
  `response` int(11) NOT NULL,
  `form_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acad_response`
--

INSERT INTO `acad_response` (`resp_id`, `teacher_id`, `sub_id`, `ques_id`, `response`, `form_id`) VALUES
(1, 1, 1, 8, 5, 4),
(1, 1, 1, 9, 3, 4),
(1, 1, 3, 4, 1, 4),
(1, 9, 3, 4, 1, 4),
(1, 10, 2, 8, 4, 4),
(1, 10, 2, 9, 2, 4),
(2, 1, 1, 8, 5, 4),
(2, 1, 1, 9, 5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `acad_sub_selection`
--

CREATE TABLE `acad_sub_selection` (
  `resp_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acad_sub_selection`
--

INSERT INTO `acad_sub_selection` (`resp_id`, `sub_id`, `teacher_id`) VALUES
(1, 1, 1),
(1, 2, 10),
(1, 3, 1),
(1, 3, 9),
(1, 4, 5),
(1, 5, 6),
(3, 1, 1),
(3, 2, 10),
(3, 3, 1),
(3, 3, 9),
(3, 4, 5),
(3, 5, 6),
(5, 1, 1),
(5, 2, 10),
(5, 3, 1),
(5, 3, 9),
(5, 4, 5),
(5, 5, 6),
(7, 1, 1),
(7, 2, 10),
(7, 3, 9),
(7, 4, 5),
(7, 5, 6);

-- --------------------------------------------------------

--
-- Table structure for table `assigned_teachers`
--

CREATE TABLE `assigned_teachers` (
  `sub_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assigned_teachers`
--

INSERT INTO `assigned_teachers` (`sub_id`, `teacher_id`) VALUES
(1, 1),
(2, 10),
(3, 1),
(3, 9),
(4, 5),
(5, 6);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `name`) VALUES
(1, 'Computer Department'),
(2, 'Civil Department'),
(3, 'Electrical Department'),
(4, 'Electronics and Telecommunication Department'),
(5, 'mechanical Department'),
(6, 'Instrumentation Department');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `sub_name` varchar(100) NOT NULL,
  `sub_type` int(11) NOT NULL,
  `optional_flag` int(11) NOT NULL,
  `multiple_teachers` int(11) NOT NULL,
  `form_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `sub_name`, `sub_type`, `optional_flag`, `multiple_teachers`, `form_id`) VALUES
(1, 'Distributed Operating System', 1, 0, 0, 4),
(2, 'Data Warehousing and Data Mining', 1, 0, 0, 4),
(3, 'Distributed Operating System Lab', 2, 0, 1, 4),
(4, 'WSO', 1, 1, 0, 4),
(5, 'Fuzzy Logic and Neural Network', 1, 0, 0, 4);

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`id`, `name`) VALUES
(1, 'Theory'),
(2, 'Practical');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(80) NOT NULL,
  `department` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `name`, `email`, `department`) VALUES
(1, 'H.D.Gadade', '', 0),
(2, 'D.V.Chaudhari', '', 0),
(3, 'Vinit Kakde', 'vk@adc.com', 1),
(4, 'Kavita Patil', 'ktp@abc.com', 1),
(5, 'Shrutika Mahajan', 'sm@abc.com', 1),
(6, 'Archana Chitte', 'ac@abc.com', 1),
(7, 'Sharayu Bonde', 'sbonde@abc.com', 1),
(8, 'Shubhangi Dusane', 'shubhangi@abc.com', 1),
(9, 'Priyanka gadade', 'pg@abc.com', 1),
(10, 'K.R. Sarode', 'krs@abc.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin_role` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `admin_role`) VALUES
(1, 'Admin', 'rishabh.s.thakur.1996@gmail.com', '$2y$10$2vGAzZcbKZapW7dBcYcX9e9Cifr2FkuriYIvi0dw9BL0FU3fR53mC', 1),
(2, 'Alex', 'alex@alex.com', '$2y$10$T310zWHPSUeXjChVa1LaNuym0cJ2HncRRS1.XVDDI3ag0Xj2UrssS', 0),
(6, 'Rishabh', 'rst.1996.dev@gmail.com', '$2y$10$5F26BHLmmyDtOIhRbqPXze3nuFb9qq.ccPHo8qrjjbNUEhz/Fb2EG', 0),
(8, 'prajakta', 'prajaktapatil1208@gmail.com', '$2y$10$aMm8hLKFOmOgyoLVEGAt0etMrUNnILVO3PzLIF/gv7FnOEAuc/pnC', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acad_form`
--
ALTER TABLE `acad_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `acad_form_questions`
--
ALTER TABLE `acad_form_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `acad_receipients`
--
ALTER TABLE `acad_receipients`
  ADD PRIMARY KEY (`resp_id`);

--
-- Indexes for table `acad_response`
--
ALTER TABLE `acad_response`
  ADD PRIMARY KEY (`resp_id`,`teacher_id`,`sub_id`,`ques_id`);

--
-- Indexes for table `acad_sub_selection`
--
ALTER TABLE `acad_sub_selection`
  ADD PRIMARY KEY (`resp_id`,`sub_id`,`teacher_id`);

--
-- Indexes for table `assigned_teachers`
--
ALTER TABLE `assigned_teachers`
  ADD PRIMARY KEY (`sub_id`,`teacher_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acad_form`
--
ALTER TABLE `acad_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `acad_form_questions`
--
ALTER TABLE `acad_form_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `acad_receipients`
--
ALTER TABLE `acad_receipients`
  MODIFY `resp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
