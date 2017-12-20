-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1


-- Generation Time: Dec 09, 2017 at 06:20 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7



SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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



INSERT INTO `acad_form` (`id`, `name`, `description`, `status`, `created_by`) VALUES
(1, 'Academic Feedback Form', 'This is a academic Feedback form to collect common feedback from students', 0, 1);



--
-- Table structure for table `acad_form_questions`
--

CREATE TABLE `acad_form_questions` (
  `id` int(11) NOT NULL,
  `sub_cat_id` int(11) NOT NULL,
  `question` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



INSERT INTO `acad_form_questions` (`id`, `sub_cat_id`, `question`) VALUES
(1, 1, 'Whether the teacher is well prepared and delivers lectures in well prepared manner?'),
(2, 1, 'Was the back board writing clear and organised?'),
(3, 1, 'what'),
(4, 1, 'When'),
(5, 1, 'what'),
(6, 2, 'what'),
(7, 2, 'when'),
(8, 2, 'what'),
(9, 2, 'what'),
(10, 2, 'when'),
(11, 2, 'how'),
(12, 1, 'how');


-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `sub_category` (`id`, `name`) VALUES
(1, 'Theory'),
(2, 'Practical');



--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin_role` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `admin_role`, `status`) VALUES
(1, 'Admin', 'rishabh.s.thakur.1996@gmail.com', '$2y$10$2vGAzZcbKZapW7dBcYcX9e9Cifr2FkuriYIvi0dw9BL0FU3fR53mC', 1, 1),
(2, 'Alex', 'alex@alex.com', '$2y$10$T310zWHPSUeXjChVa1LaNuym0cJ2HncRRS1.XVDDI3ag0Xj2UrssS', 0, 1),
(4, 'Rishabh', 'rst.1996.dev@gmail.com', '$2y$10$8gP8X2nI08TbxxER7CZY8.eS3KhyKkI0RDJgQGd21eJocJN0WcvlG', 0, 1);

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
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `acad_form_questions`
--
ALTER TABLE `acad_form_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
