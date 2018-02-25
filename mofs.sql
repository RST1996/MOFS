-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2018 at 07:12 AM
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
(10, 1, 'Whether the teacher is well prepared and delivers lectures in well prepared manner?'),
(11, 1, 'Was the back board writing clear and organised?'),
(12, 1, ' Whether the voice is clear and audible?'),
(13, 1, 'Whether any audio visual aids like LCD,OHP'),
(14, 1, ' Whether the teacher is enthusiastic about teaching the subject?'),
(15, 1, 'Did the teacher use proper gestures and body language during lectures?'),
(16, 1, 'Whether the teacher reaches classroom i time and leave in time?'),
(17, 1, 'Does the teacher follow the timetable exactly?'),
(18, 1, 'Whether the syllabus is completed up to your expectations?'),
(19, 1, 'Did the teacher take effort to complete the syllabus?'),
(20, 1, 'Was the teacher able to deliver lecture with good communication skill and teacher in English language?'),
(21, 1, 'Did the teacher use proper pronunciation and have good clarity of speech? '),
(22, 1, 'Whether you are encouraged to ask questions to make lecture interactive and live?'),
(23, 1, 'Did the course improve your understanding of principle in the subject field and motivate you think and learn?'),
(24, 1, 'Did you understand the concepts taught by the teacher?'),
(25, 1, 'Whether the teacher was effective in preparing student for university exams?  '),
(26, 1, 'Whether the teacher was effective in preparing student for university exams?  '),
(27, 1, 'Did the teacher give additional technical knowledge, not available from text books related to subject?'),
(28, 1, 'Did the teacher use proper combination of discussion of theory/numerical and dictation of notes wherever necessary?'),
(29, 1, 'Whether the teacher was accessible to the students for counselling, guidance and solving queries after classroom hour?'),
(30, 2, 'Whether the experimental set up was well prepared and in good working condition?'),
(31, 2, 'Was the practicalâ€™s conducted with emphasize on fundamental concepts and with illustrative examples?'),
(32, 2, 'Was the teacher enthusiastic about teaching?'),
(33, 2, 'Did the teacher explain relevance of the practical with theory?'),
(34, 2, 'Was the teacher able to conduct practical with good communication skill?'),
(35, 2, 'Were you encouraged to ask questions to make the teaching interaction and lively?'),
(36, 2, 'Did the courses improve your understanding of concepts, principles in the field and motivate you to think learn?'),
(37, 2, 'Whether the teacher was effective in preparing students for exams?'),
(38, 2, 'Did the teacher give additional technical/non technical inputs by referring to internet/ additional books?'),
(39, 2, 'Did the teacher explain the experimental procedure, analysis and conclusions properly?'),
(40, 2, 'Was the lab Manual/write up mode available?'),
(41, 2, 'Was the lab. Manual/write up self explanatory/ useful for performing the practical?'),
(42, 2, 'Did the teacher have good control over students and the laboratory staff?'),
(43, 2, 'Did the teacher use continuous assessment?'),
(44, 2, 'Did the teacher have command over the subject?  ');

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
(1, 4, '15184213158ccc3e3ca0b17a2e717462add845db93b81b8de5', 1, 1),
(2, 4, '151842132759f3a94eca3ca411af1437876d0c6671d4f00aa8', 2, 1),
(3, 4, '151842137446e3561788567e68a92cd58627ed7d47b1229907', 1, 1),
(4, 4, '1518421385fcc90935fa6cac7c127dbddc67ef25ad020bd577', 2, 1),
(5, 4, '1518421401c7127a8f18255541c151cec8d9a30a28653d1c9f', 2, 1),
(6, 4, '1518421417e29fb4a22a67ca71081d446c98e3ebbd191b5626', 2, 1),
(7, 4, '1518421450f019ebc649126fc29e63bd520b73734d636684a2', 0, 0),
(8, 4, '15192859522fe6e8ad50678232dbc999c9e42691d9bacf9200', 0, 0),
(9, 4, '151928595558a76bfe916ffb16de4627a4b769c278d6d1566b', 0, 0),
(10, 4, '151928595913513a51059f2cbf14f090a4191e7736da5175b0', 0, 0),
(11, 4, '15192859621f2d9655b1456c05194901d3a98d095978dad6fc', 0, 0),
(12, 4, '1519285965f965b486fb95c129f5423a7cd28079cbbbf53537', 0, 0),
(13, 4, '1519286003f205c14903c4ac27373cbcc93a9e35c47f1619b1', 0, 0),
(14, 4, '15192860076cab6ae06d73443b4636df8d4009b7059927abc5', 0, 0),
(15, 4, '1519286010d1d730710625e78cf4f7ad3faa416bd6bf84fbfc', 0, 0),
(16, 4, '1519286018dd32659e52be0adf595675a5328cc710f4eed858', 0, 0),
(17, 4, '1519286025167a3c7a109524337b65597cd83c0fe8dfeecf7f', 0, 0),
(18, 4, '15192860276b8fff147048b647a109965487dbb5f929cb47ec', 0, 0),
(19, 4, '151928613952c162d98b7da906ec739e6b6cb90eef4c1bad24', 0, 0),
(20, 4, '15192861575d69bd44b186d10e596d99d597810a5b9d10a158', 0, 0),
(21, 4, '1519286212c07f597f913a468b932fc5c7fff35b23f2272edd', 0, 0),
(22, 4, '15192862230c631d6c017461149356793703280fbdfd6b5cc8', 0, 0),
(23, 4, '1519286237ed22087de938d107bccb2afc0785e1abd86c4705', 0, 0),
(24, 4, '15192862437bc404982167be13e3c49dea0f615ab42cb948f9', 0, 0);

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
(1, 1, 1, 10, 5, 4),
(1, 1, 1, 11, 4, 4),
(1, 1, 1, 12, 4, 4),
(1, 1, 1, 13, 4, 4),
(1, 1, 1, 14, 4, 4),
(1, 1, 1, 15, 4, 4),
(1, 1, 1, 16, 4, 4),
(1, 1, 1, 17, 4, 4),
(1, 1, 1, 18, 4, 4),
(1, 1, 1, 19, 3, 4),
(1, 1, 1, 20, 3, 4),
(1, 1, 1, 21, 4, 4),
(1, 1, 1, 22, 4, 4),
(1, 1, 1, 23, 3, 4),
(1, 1, 1, 24, 3, 4),
(1, 1, 1, 25, 4, 4),
(1, 1, 1, 26, 4, 4),
(1, 1, 1, 27, 4, 4),
(1, 1, 1, 28, 3, 4),
(1, 1, 1, 29, 3, 4),
(1, 1, 3, 30, 3, 4),
(1, 1, 3, 31, 4, 4),
(1, 1, 3, 32, 3, 4),
(1, 1, 3, 33, 4, 4),
(1, 1, 3, 34, 3, 4),
(1, 1, 3, 35, 4, 4),
(1, 1, 3, 36, 3, 4),
(1, 1, 3, 37, 4, 4),
(1, 1, 3, 38, 4, 4),
(1, 1, 3, 39, 4, 4),
(1, 1, 3, 40, 4, 4),
(1, 1, 3, 41, 3, 4),
(1, 1, 3, 42, 3, 4),
(1, 1, 3, 43, 3, 4),
(1, 1, 3, 44, 4, 4),
(1, 5, 4, 10, 4, 4),
(1, 5, 4, 11, 4, 4),
(1, 5, 4, 12, 4, 4),
(1, 5, 4, 13, 4, 4),
(1, 5, 4, 14, 4, 4),
(1, 5, 4, 15, 4, 4),
(1, 5, 4, 16, 3, 4),
(1, 5, 4, 17, 4, 4),
(1, 5, 4, 18, 3, 4),
(1, 5, 4, 19, 4, 4),
(1, 5, 4, 20, 4, 4),
(1, 5, 4, 21, 4, 4),
(1, 5, 4, 22, 4, 4),
(1, 5, 4, 23, 4, 4),
(1, 5, 4, 24, 3, 4),
(1, 5, 4, 25, 4, 4),
(1, 5, 4, 26, 4, 4),
(1, 5, 4, 27, 3, 4),
(1, 5, 4, 28, 3, 4),
(1, 5, 4, 29, 4, 4),
(1, 6, 5, 10, 3, 4),
(1, 6, 5, 11, 4, 4),
(1, 6, 5, 12, 4, 4),
(1, 6, 5, 13, 4, 4),
(1, 6, 5, 14, 4, 4),
(1, 6, 5, 15, 3, 4),
(1, 6, 5, 16, 4, 4),
(1, 6, 5, 17, 3, 4),
(1, 6, 5, 18, 4, 4),
(1, 6, 5, 19, 4, 4),
(1, 6, 5, 20, 4, 4),
(1, 6, 5, 21, 3, 4),
(1, 6, 5, 22, 4, 4),
(1, 6, 5, 23, 3, 4),
(1, 6, 5, 24, 4, 4),
(1, 6, 5, 25, 4, 4),
(1, 6, 5, 26, 4, 4),
(1, 6, 5, 27, 4, 4),
(1, 6, 5, 28, 4, 4),
(1, 6, 5, 29, 3, 4),
(1, 6, 6, 10, 4, 4),
(1, 6, 6, 11, 3, 4),
(1, 6, 6, 12, 4, 4),
(1, 6, 6, 13, 4, 4),
(1, 6, 6, 14, 3, 4),
(1, 6, 6, 15, 4, 4),
(1, 6, 6, 16, 4, 4),
(1, 6, 6, 17, 4, 4),
(1, 6, 6, 18, 4, 4),
(1, 6, 6, 19, 4, 4),
(1, 6, 6, 20, 3, 4),
(1, 6, 6, 21, 4, 4),
(1, 6, 6, 22, 4, 4),
(1, 6, 6, 23, 4, 4),
(1, 6, 6, 24, 3, 4),
(1, 6, 6, 25, 4, 4),
(1, 6, 6, 26, 3, 4),
(1, 6, 6, 27, 4, 4),
(1, 6, 6, 28, 4, 4),
(1, 6, 6, 29, 4, 4),
(1, 10, 2, 10, 4, 4),
(1, 10, 2, 11, 4, 4),
(1, 10, 2, 12, 4, 4),
(1, 10, 2, 13, 3, 4),
(1, 10, 2, 14, 3, 4),
(1, 10, 2, 15, 4, 4),
(1, 10, 2, 16, 4, 4),
(1, 10, 2, 17, 4, 4),
(1, 10, 2, 18, 4, 4),
(1, 10, 2, 19, 4, 4),
(1, 10, 2, 20, 4, 4),
(1, 10, 2, 21, 4, 4),
(1, 10, 2, 22, 3, 4),
(1, 10, 2, 23, 4, 4),
(1, 10, 2, 24, 4, 4),
(1, 10, 2, 25, 4, 4),
(1, 10, 2, 26, 3, 4),
(1, 10, 2, 27, 4, 4),
(1, 10, 2, 28, 4, 4),
(1, 10, 2, 29, 4, 4),
(2, 1, 1, 10, 5, 4),
(2, 1, 1, 11, 4, 4),
(2, 1, 1, 12, 3, 4),
(2, 1, 1, 13, 3, 4),
(2, 1, 1, 14, 4, 4),
(2, 1, 1, 15, 4, 4),
(2, 1, 1, 16, 3, 4),
(2, 1, 1, 17, 3, 4),
(2, 1, 1, 18, 3, 4),
(2, 1, 1, 19, 4, 4),
(2, 1, 1, 20, 3, 4),
(2, 1, 1, 21, 4, 4),
(2, 1, 1, 22, 4, 4),
(2, 1, 1, 23, 4, 4),
(2, 1, 1, 24, 4, 4),
(2, 1, 1, 25, 3, 4),
(2, 1, 1, 26, 3, 4),
(2, 1, 1, 27, 4, 4),
(2, 1, 1, 28, 4, 4),
(2, 1, 1, 29, 3, 4),
(2, 5, 4, 10, 4, 4),
(2, 5, 4, 11, 4, 4),
(2, 5, 4, 12, 3, 4),
(2, 5, 4, 13, 4, 4),
(2, 5, 4, 14, 4, 4),
(2, 5, 4, 15, 4, 4),
(2, 5, 4, 16, 3, 4),
(2, 5, 4, 17, 3, 4),
(2, 5, 4, 18, 4, 4),
(2, 5, 4, 19, 3, 4),
(2, 5, 4, 20, 3, 4),
(2, 5, 4, 21, 4, 4),
(2, 5, 4, 22, 3, 4),
(2, 5, 4, 23, 4, 4),
(2, 5, 4, 24, 4, 4),
(2, 5, 4, 25, 3, 4),
(2, 5, 4, 26, 4, 4),
(2, 5, 4, 27, 3, 4),
(2, 5, 4, 28, 4, 4),
(2, 5, 4, 29, 3, 4),
(2, 6, 5, 10, 4, 4),
(2, 6, 5, 11, 4, 4),
(2, 6, 5, 12, 4, 4),
(2, 6, 5, 13, 4, 4),
(2, 6, 5, 14, 4, 4),
(2, 6, 5, 15, 4, 4),
(2, 6, 5, 16, 4, 4),
(2, 6, 5, 17, 4, 4),
(2, 6, 5, 18, 4, 4),
(2, 6, 5, 19, 4, 4),
(2, 6, 5, 20, 4, 4),
(2, 6, 5, 21, 4, 4),
(2, 6, 5, 22, 4, 4),
(2, 6, 5, 23, 4, 4),
(2, 6, 5, 24, 4, 4),
(2, 6, 5, 25, 4, 4),
(2, 6, 5, 26, 3, 4),
(2, 6, 5, 27, 4, 4),
(2, 6, 5, 28, 3, 4),
(2, 6, 5, 29, 3, 4),
(2, 6, 6, 10, 3, 4),
(2, 6, 6, 11, 4, 4),
(2, 6, 6, 12, 4, 4),
(2, 6, 6, 13, 3, 4),
(2, 6, 6, 14, 3, 4),
(2, 6, 6, 15, 4, 4),
(2, 6, 6, 16, 4, 4),
(2, 6, 6, 17, 4, 4),
(2, 6, 6, 18, 3, 4),
(2, 6, 6, 19, 4, 4),
(2, 6, 6, 20, 3, 4),
(2, 6, 6, 21, 3, 4),
(2, 6, 6, 22, 4, 4),
(2, 6, 6, 23, 3, 4),
(2, 6, 6, 24, 4, 4),
(2, 6, 6, 25, 4, 4),
(2, 6, 6, 26, 3, 4),
(2, 6, 6, 27, 4, 4),
(2, 6, 6, 28, 4, 4),
(2, 6, 6, 29, 4, 4),
(2, 9, 3, 30, 3, 4),
(2, 9, 3, 31, 4, 4),
(2, 9, 3, 32, 4, 4),
(2, 9, 3, 33, 4, 4),
(2, 9, 3, 34, 4, 4),
(2, 9, 3, 35, 4, 4),
(2, 9, 3, 36, 3, 4),
(2, 9, 3, 37, 4, 4),
(2, 9, 3, 38, 4, 4),
(2, 9, 3, 39, 3, 4),
(2, 9, 3, 40, 4, 4),
(2, 9, 3, 41, 4, 4),
(2, 9, 3, 42, 4, 4),
(2, 9, 3, 43, 3, 4),
(2, 9, 3, 44, 4, 4),
(2, 10, 2, 10, 4, 4),
(2, 10, 2, 11, 4, 4),
(2, 10, 2, 12, 4, 4),
(2, 10, 2, 13, 4, 4),
(2, 10, 2, 14, 4, 4),
(2, 10, 2, 15, 4, 4),
(2, 10, 2, 16, 4, 4),
(2, 10, 2, 17, 4, 4),
(2, 10, 2, 18, 3, 4),
(2, 10, 2, 19, 3, 4),
(2, 10, 2, 20, 4, 4),
(2, 10, 2, 21, 3, 4),
(2, 10, 2, 22, 4, 4),
(2, 10, 2, 23, 3, 4),
(2, 10, 2, 24, 3, 4),
(2, 10, 2, 25, 4, 4),
(2, 10, 2, 26, 4, 4),
(2, 10, 2, 27, 4, 4),
(2, 10, 2, 28, 3, 4),
(2, 10, 2, 29, 4, 4),
(3, 1, 1, 10, 5, 4),
(3, 1, 1, 11, 4, 4),
(3, 1, 1, 12, 4, 4),
(3, 1, 1, 13, 4, 4),
(3, 1, 1, 14, 4, 4),
(3, 1, 1, 15, 4, 4),
(3, 1, 1, 16, 4, 4),
(3, 1, 1, 17, 4, 4),
(3, 1, 1, 18, 4, 4),
(3, 1, 1, 19, 4, 4),
(3, 1, 1, 20, 4, 4),
(3, 1, 1, 21, 4, 4),
(3, 1, 1, 22, 4, 4),
(3, 1, 1, 23, 3, 4),
(3, 1, 1, 24, 4, 4),
(3, 1, 1, 25, 3, 4),
(3, 1, 1, 26, 4, 4),
(3, 1, 1, 27, 4, 4),
(3, 1, 1, 28, 4, 4),
(3, 1, 1, 29, 4, 4),
(3, 1, 3, 30, 4, 4),
(3, 1, 3, 31, 4, 4),
(3, 1, 3, 32, 4, 4),
(3, 1, 3, 33, 4, 4),
(3, 1, 3, 34, 4, 4),
(3, 1, 3, 35, 3, 4),
(3, 1, 3, 36, 4, 4),
(3, 1, 3, 37, 4, 4),
(3, 1, 3, 38, 4, 4),
(3, 1, 3, 39, 4, 4),
(3, 1, 3, 40, 3, 4),
(3, 1, 3, 41, 4, 4),
(3, 1, 3, 42, 4, 4),
(3, 1, 3, 43, 4, 4),
(3, 1, 3, 44, 4, 4),
(3, 5, 4, 10, 4, 4),
(3, 5, 4, 11, 3, 4),
(3, 5, 4, 12, 4, 4),
(3, 5, 4, 13, 3, 4),
(3, 5, 4, 14, 4, 4),
(3, 5, 4, 15, 3, 4),
(3, 5, 4, 16, 3, 4),
(3, 5, 4, 17, 3, 4),
(3, 5, 4, 18, 4, 4),
(3, 5, 4, 19, 4, 4),
(3, 5, 4, 20, 4, 4),
(3, 5, 4, 21, 4, 4),
(3, 5, 4, 22, 3, 4),
(3, 5, 4, 23, 4, 4),
(3, 5, 4, 24, 4, 4),
(3, 5, 4, 25, 4, 4),
(3, 5, 4, 26, 4, 4),
(3, 5, 4, 27, 4, 4),
(3, 5, 4, 28, 4, 4),
(3, 5, 4, 29, 4, 4),
(3, 6, 5, 10, 3, 4),
(3, 6, 5, 11, 4, 4),
(3, 6, 5, 12, 4, 4),
(3, 6, 5, 13, 4, 4),
(3, 6, 5, 14, 3, 4),
(3, 6, 5, 15, 4, 4),
(3, 6, 5, 16, 4, 4),
(3, 6, 5, 17, 4, 4),
(3, 6, 5, 18, 4, 4),
(3, 6, 5, 19, 4, 4),
(3, 6, 5, 20, 3, 4),
(3, 6, 5, 21, 3, 4),
(3, 6, 5, 22, 4, 4),
(3, 6, 5, 23, 3, 4),
(3, 6, 5, 24, 4, 4),
(3, 6, 5, 25, 4, 4),
(3, 6, 5, 26, 3, 4),
(3, 6, 5, 27, 3, 4),
(3, 6, 5, 28, 4, 4),
(3, 6, 5, 29, 4, 4),
(3, 6, 6, 10, 4, 4),
(3, 6, 6, 11, 4, 4),
(3, 6, 6, 12, 4, 4),
(3, 6, 6, 13, 4, 4),
(3, 6, 6, 14, 4, 4),
(3, 6, 6, 15, 4, 4),
(3, 6, 6, 16, 4, 4),
(3, 6, 6, 17, 4, 4),
(3, 6, 6, 18, 4, 4),
(3, 6, 6, 19, 3, 4),
(3, 6, 6, 20, 4, 4),
(3, 6, 6, 21, 4, 4),
(3, 6, 6, 22, 4, 4),
(3, 6, 6, 23, 4, 4),
(3, 6, 6, 24, 4, 4),
(3, 6, 6, 25, 3, 4),
(3, 6, 6, 26, 4, 4),
(3, 6, 6, 27, 4, 4),
(3, 6, 6, 28, 4, 4),
(3, 6, 6, 29, 4, 4),
(3, 10, 2, 10, 4, 4),
(3, 10, 2, 11, 4, 4),
(3, 10, 2, 12, 3, 4),
(3, 10, 2, 13, 4, 4),
(3, 10, 2, 14, 3, 4),
(3, 10, 2, 15, 4, 4),
(3, 10, 2, 16, 4, 4),
(3, 10, 2, 17, 4, 4),
(3, 10, 2, 18, 3, 4),
(3, 10, 2, 19, 3, 4),
(3, 10, 2, 20, 4, 4),
(3, 10, 2, 21, 4, 4),
(3, 10, 2, 22, 4, 4),
(3, 10, 2, 23, 4, 4),
(3, 10, 2, 24, 3, 4),
(3, 10, 2, 25, 4, 4),
(3, 10, 2, 26, 4, 4),
(3, 10, 2, 27, 4, 4),
(3, 10, 2, 28, 3, 4),
(3, 10, 2, 29, 3, 4),
(4, 1, 1, 10, 5, 4),
(4, 1, 1, 11, 4, 4),
(4, 1, 1, 12, 4, 4),
(4, 1, 1, 13, 4, 4),
(4, 1, 1, 14, 4, 4),
(4, 1, 1, 15, 4, 4),
(4, 1, 1, 16, 4, 4),
(4, 1, 1, 17, 3, 4),
(4, 1, 1, 18, 3, 4),
(4, 1, 1, 19, 4, 4),
(4, 1, 1, 20, 4, 4),
(4, 1, 1, 21, 3, 4),
(4, 1, 1, 22, 3, 4),
(4, 1, 1, 23, 4, 4),
(4, 1, 1, 24, 3, 4),
(4, 1, 1, 25, 4, 4),
(4, 1, 1, 26, 3, 4),
(4, 1, 1, 27, 4, 4),
(4, 1, 1, 28, 4, 4),
(4, 1, 1, 29, 3, 4),
(4, 1, 3, 30, 3, 4),
(4, 1, 3, 31, 4, 4),
(4, 1, 3, 32, 4, 4),
(4, 1, 3, 33, 4, 4),
(4, 1, 3, 34, 3, 4),
(4, 1, 3, 35, 4, 4),
(4, 1, 3, 36, 4, 4),
(4, 1, 3, 37, 4, 4),
(4, 1, 3, 38, 3, 4),
(4, 1, 3, 39, 4, 4),
(4, 1, 3, 40, 3, 4),
(4, 1, 3, 41, 4, 4),
(4, 1, 3, 42, 4, 4),
(4, 1, 3, 43, 4, 4),
(4, 1, 3, 44, 4, 4),
(4, 5, 4, 10, 4, 4),
(4, 5, 4, 11, 4, 4),
(4, 5, 4, 12, 4, 4),
(4, 5, 4, 13, 4, 4),
(4, 5, 4, 14, 4, 4),
(4, 5, 4, 15, 4, 4),
(4, 5, 4, 16, 4, 4),
(4, 5, 4, 17, 3, 4),
(4, 5, 4, 18, 3, 4),
(4, 5, 4, 19, 4, 4),
(4, 5, 4, 20, 3, 4),
(4, 5, 4, 21, 3, 4),
(4, 5, 4, 22, 3, 4),
(4, 5, 4, 23, 4, 4),
(4, 5, 4, 24, 4, 4),
(4, 5, 4, 25, 4, 4),
(4, 5, 4, 26, 4, 4),
(4, 5, 4, 27, 4, 4),
(4, 5, 4, 28, 3, 4),
(4, 5, 4, 29, 3, 4),
(4, 6, 5, 10, 4, 4),
(4, 6, 5, 11, 3, 4),
(4, 6, 5, 12, 4, 4),
(4, 6, 5, 13, 4, 4),
(4, 6, 5, 14, 4, 4),
(4, 6, 5, 15, 3, 4),
(4, 6, 5, 16, 3, 4),
(4, 6, 5, 17, 4, 4),
(4, 6, 5, 18, 4, 4),
(4, 6, 5, 19, 4, 4),
(4, 6, 5, 20, 4, 4),
(4, 6, 5, 21, 4, 4),
(4, 6, 5, 22, 4, 4),
(4, 6, 5, 23, 4, 4),
(4, 6, 5, 24, 3, 4),
(4, 6, 5, 25, 4, 4),
(4, 6, 5, 26, 3, 4),
(4, 6, 5, 27, 3, 4),
(4, 6, 5, 28, 4, 4),
(4, 6, 5, 29, 4, 4),
(4, 6, 6, 10, 3, 4),
(4, 6, 6, 11, 4, 4),
(4, 6, 6, 12, 3, 4),
(4, 6, 6, 13, 4, 4),
(4, 6, 6, 14, 3, 4),
(4, 6, 6, 15, 4, 4),
(4, 6, 6, 16, 4, 4),
(4, 6, 6, 17, 4, 4),
(4, 6, 6, 18, 4, 4),
(4, 6, 6, 19, 3, 4),
(4, 6, 6, 20, 4, 4),
(4, 6, 6, 21, 4, 4),
(4, 6, 6, 22, 4, 4),
(4, 6, 6, 23, 4, 4),
(4, 6, 6, 24, 4, 4),
(4, 6, 6, 25, 4, 4),
(4, 6, 6, 26, 4, 4),
(4, 6, 6, 27, 4, 4),
(4, 6, 6, 28, 4, 4),
(4, 6, 6, 29, 4, 4),
(4, 10, 2, 10, 4, 4),
(4, 10, 2, 11, 4, 4),
(4, 10, 2, 12, 4, 4),
(4, 10, 2, 13, 3, 4),
(4, 10, 2, 14, 3, 4),
(4, 10, 2, 15, 3, 4),
(4, 10, 2, 16, 3, 4),
(4, 10, 2, 17, 4, 4),
(4, 10, 2, 18, 4, 4),
(4, 10, 2, 19, 3, 4),
(4, 10, 2, 20, 4, 4),
(4, 10, 2, 21, 4, 4),
(4, 10, 2, 22, 4, 4),
(4, 10, 2, 23, 3, 4),
(4, 10, 2, 24, 4, 4),
(4, 10, 2, 25, 3, 4),
(4, 10, 2, 26, 4, 4),
(4, 10, 2, 27, 4, 4),
(4, 10, 2, 28, 4, 4),
(4, 10, 2, 29, 4, 4),
(5, 1, 1, 10, 4, 4),
(5, 1, 1, 11, 4, 4),
(5, 1, 1, 12, 4, 4),
(5, 1, 1, 13, 4, 4),
(5, 1, 1, 14, 4, 4),
(5, 1, 1, 15, 4, 4),
(5, 1, 1, 16, 4, 4),
(5, 1, 1, 17, 4, 4),
(5, 1, 1, 18, 4, 4),
(5, 1, 1, 19, 4, 4),
(5, 1, 1, 20, 3, 4),
(5, 1, 1, 21, 4, 4),
(5, 1, 1, 22, 4, 4),
(5, 1, 1, 23, 3, 4),
(5, 1, 1, 24, 4, 4),
(5, 1, 1, 25, 3, 4),
(5, 1, 1, 26, 4, 4),
(5, 1, 1, 27, 3, 4),
(5, 1, 1, 28, 3, 4),
(5, 1, 1, 29, 4, 4),
(5, 5, 4, 10, 3, 4),
(5, 5, 4, 11, 4, 4),
(5, 5, 4, 12, 4, 4),
(5, 5, 4, 13, 3, 4),
(5, 5, 4, 14, 3, 4),
(5, 5, 4, 15, 4, 4),
(5, 5, 4, 16, 4, 4),
(5, 5, 4, 17, 4, 4),
(5, 5, 4, 18, 4, 4),
(5, 5, 4, 19, 4, 4),
(5, 5, 4, 20, 4, 4),
(5, 5, 4, 21, 4, 4),
(5, 5, 4, 22, 3, 4),
(5, 5, 4, 23, 4, 4),
(5, 5, 4, 24, 3, 4),
(5, 5, 4, 25, 4, 4),
(5, 5, 4, 26, 3, 4),
(5, 5, 4, 27, 4, 4),
(5, 5, 4, 28, 4, 4),
(5, 5, 4, 29, 4, 4),
(5, 6, 5, 10, 4, 4),
(5, 6, 5, 11, 4, 4),
(5, 6, 5, 12, 3, 4),
(5, 6, 5, 13, 4, 4),
(5, 6, 5, 14, 4, 4),
(5, 6, 5, 15, 4, 4),
(5, 6, 5, 16, 4, 4),
(5, 6, 5, 17, 4, 4),
(5, 6, 5, 18, 4, 4),
(5, 6, 5, 19, 4, 4),
(5, 6, 5, 20, 4, 4),
(5, 6, 5, 21, 4, 4),
(5, 6, 5, 22, 4, 4),
(5, 6, 5, 23, 3, 4),
(5, 6, 5, 24, 4, 4),
(5, 6, 5, 25, 3, 4),
(5, 6, 5, 26, 4, 4),
(5, 6, 5, 27, 3, 4),
(5, 6, 5, 28, 3, 4),
(5, 6, 5, 29, 4, 4),
(5, 6, 6, 10, 4, 4),
(5, 6, 6, 11, 3, 4),
(5, 6, 6, 12, 4, 4),
(5, 6, 6, 13, 4, 4),
(5, 6, 6, 14, 4, 4),
(5, 6, 6, 15, 4, 4),
(5, 6, 6, 16, 4, 4),
(5, 6, 6, 17, 3, 4),
(5, 6, 6, 18, 4, 4),
(5, 6, 6, 19, 4, 4),
(5, 6, 6, 20, 3, 4),
(5, 6, 6, 21, 4, 4),
(5, 6, 6, 22, 4, 4),
(5, 6, 6, 23, 4, 4),
(5, 6, 6, 24, 4, 4),
(5, 6, 6, 25, 4, 4),
(5, 6, 6, 26, 4, 4),
(5, 6, 6, 27, 4, 4),
(5, 6, 6, 28, 4, 4),
(5, 6, 6, 29, 3, 4),
(5, 9, 3, 30, 4, 4),
(5, 9, 3, 31, 4, 4),
(5, 9, 3, 32, 4, 4),
(5, 9, 3, 33, 3, 4),
(5, 9, 3, 34, 4, 4),
(5, 9, 3, 35, 4, 4),
(5, 9, 3, 36, 4, 4),
(5, 9, 3, 37, 4, 4),
(5, 9, 3, 38, 4, 4),
(5, 9, 3, 39, 3, 4),
(5, 9, 3, 40, 4, 4),
(5, 9, 3, 41, 4, 4),
(5, 9, 3, 42, 4, 4),
(5, 9, 3, 43, 4, 4),
(5, 9, 3, 44, 4, 4),
(5, 10, 2, 10, 4, 4),
(5, 10, 2, 11, 4, 4),
(5, 10, 2, 12, 3, 4),
(5, 10, 2, 13, 4, 4),
(5, 10, 2, 14, 4, 4),
(5, 10, 2, 15, 3, 4),
(5, 10, 2, 16, 3, 4),
(5, 10, 2, 17, 4, 4),
(5, 10, 2, 18, 4, 4),
(5, 10, 2, 19, 3, 4),
(5, 10, 2, 20, 4, 4),
(5, 10, 2, 21, 4, 4),
(5, 10, 2, 22, 4, 4),
(5, 10, 2, 23, 4, 4),
(5, 10, 2, 24, 4, 4),
(5, 10, 2, 25, 4, 4),
(5, 10, 2, 26, 4, 4),
(5, 10, 2, 27, 4, 4),
(5, 10, 2, 28, 4, 4),
(5, 10, 2, 29, 3, 4),
(6, 1, 1, 10, 5, 4),
(6, 1, 1, 11, 4, 4),
(6, 1, 1, 12, 4, 4),
(6, 1, 1, 13, 4, 4),
(6, 1, 1, 14, 4, 4),
(6, 1, 1, 15, 3, 4),
(6, 1, 1, 16, 4, 4),
(6, 1, 1, 17, 4, 4),
(6, 1, 1, 18, 4, 4),
(6, 1, 1, 19, 4, 4),
(6, 1, 1, 20, 4, 4),
(6, 1, 1, 21, 4, 4),
(6, 1, 1, 22, 4, 4),
(6, 1, 1, 23, 4, 4),
(6, 1, 1, 24, 4, 4),
(6, 1, 1, 25, 3, 4),
(6, 1, 1, 26, 4, 4),
(6, 1, 1, 27, 4, 4),
(6, 1, 1, 28, 4, 4),
(6, 1, 1, 29, 4, 4),
(6, 1, 3, 30, 3, 4),
(6, 1, 3, 31, 4, 4),
(6, 1, 3, 32, 4, 4),
(6, 1, 3, 33, 4, 4),
(6, 1, 3, 34, 4, 4),
(6, 1, 3, 35, 3, 4),
(6, 1, 3, 36, 4, 4),
(6, 1, 3, 37, 4, 4),
(6, 1, 3, 38, 4, 4),
(6, 1, 3, 39, 4, 4),
(6, 1, 3, 40, 3, 4),
(6, 1, 3, 41, 4, 4),
(6, 1, 3, 42, 4, 4),
(6, 1, 3, 43, 4, 4),
(6, 1, 3, 44, 3, 4),
(6, 5, 4, 10, 4, 4),
(6, 5, 4, 11, 3, 4),
(6, 5, 4, 12, 4, 4),
(6, 5, 4, 13, 4, 4),
(6, 5, 4, 14, 4, 4),
(6, 5, 4, 15, 4, 4),
(6, 5, 4, 16, 3, 4),
(6, 5, 4, 17, 4, 4),
(6, 5, 4, 18, 4, 4),
(6, 5, 4, 19, 4, 4),
(6, 5, 4, 20, 4, 4),
(6, 5, 4, 21, 3, 4),
(6, 5, 4, 22, 4, 4),
(6, 5, 4, 23, 4, 4),
(6, 5, 4, 24, 4, 4),
(6, 5, 4, 25, 4, 4),
(6, 5, 4, 26, 4, 4),
(6, 5, 4, 27, 4, 4),
(6, 5, 4, 28, 3, 4),
(6, 5, 4, 29, 4, 4),
(6, 6, 5, 10, 3, 4),
(6, 6, 5, 11, 4, 4),
(6, 6, 5, 12, 4, 4),
(6, 6, 5, 13, 4, 4),
(6, 6, 5, 14, 4, 4),
(6, 6, 5, 15, 3, 4),
(6, 6, 5, 16, 4, 4),
(6, 6, 5, 17, 3, 4),
(6, 6, 5, 18, 4, 4),
(6, 6, 5, 19, 4, 4),
(6, 6, 5, 20, 3, 4),
(6, 6, 5, 21, 4, 4),
(6, 6, 5, 22, 3, 4),
(6, 6, 5, 23, 3, 4),
(6, 6, 5, 24, 4, 4),
(6, 6, 5, 25, 4, 4),
(6, 6, 5, 26, 4, 4),
(6, 6, 5, 27, 3, 4),
(6, 6, 5, 28, 4, 4),
(6, 6, 5, 29, 4, 4),
(6, 6, 6, 10, 4, 4),
(6, 6, 6, 11, 4, 4),
(6, 6, 6, 12, 3, 4),
(6, 6, 6, 13, 3, 4),
(6, 6, 6, 14, 4, 4),
(6, 6, 6, 15, 4, 4),
(6, 6, 6, 16, 4, 4),
(6, 6, 6, 17, 4, 4),
(6, 6, 6, 18, 3, 4),
(6, 6, 6, 19, 3, 4),
(6, 6, 6, 20, 4, 4),
(6, 6, 6, 21, 4, 4),
(6, 6, 6, 22, 4, 4),
(6, 6, 6, 23, 4, 4),
(6, 6, 6, 24, 4, 4),
(6, 6, 6, 25, 3, 4),
(6, 6, 6, 26, 3, 4),
(6, 6, 6, 27, 4, 4),
(6, 6, 6, 28, 4, 4),
(6, 6, 6, 29, 4, 4),
(6, 10, 2, 10, 4, 4),
(6, 10, 2, 11, 4, 4),
(6, 10, 2, 12, 3, 4),
(6, 10, 2, 13, 4, 4),
(6, 10, 2, 14, 4, 4),
(6, 10, 2, 15, 4, 4),
(6, 10, 2, 16, 4, 4),
(6, 10, 2, 17, 4, 4),
(6, 10, 2, 18, 4, 4),
(6, 10, 2, 19, 4, 4),
(6, 10, 2, 20, 4, 4),
(6, 10, 2, 21, 4, 4),
(6, 10, 2, 22, 4, 4),
(6, 10, 2, 23, 4, 4),
(6, 10, 2, 24, 4, 4),
(6, 10, 2, 25, 4, 4),
(6, 10, 2, 26, 4, 4),
(6, 10, 2, 27, 4, 4),
(6, 10, 2, 28, 4, 4),
(6, 10, 2, 29, 3, 4);

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
(1, 4, 5),
(1, 5, 6),
(1, 6, 6),
(2, 1, 1),
(2, 2, 10),
(2, 3, 9),
(2, 4, 5),
(2, 5, 6),
(2, 6, 6),
(3, 1, 1),
(3, 2, 10),
(3, 3, 1),
(3, 4, 5),
(3, 5, 6),
(3, 6, 6),
(4, 1, 1),
(4, 2, 10),
(4, 3, 1),
(4, 4, 5),
(4, 5, 6),
(4, 6, 6),
(5, 1, 1),
(5, 2, 10),
(5, 3, 9),
(5, 4, 5),
(5, 5, 6),
(5, 6, 6),
(6, 1, 1),
(6, 2, 10),
(6, 3, 1),
(6, 4, 5),
(6, 5, 6),
(6, 6, 6);

-- --------------------------------------------------------

--
-- Table structure for table `acad_summary_ques`
--

CREATE TABLE `acad_summary_ques` (
  `id` int(11) NOT NULL,
  `sub_cat_id` int(11) NOT NULL,
  `question` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acad_summary_ques`
--

INSERT INTO `acad_summary_ques` (`id`, `sub_cat_id`, `question`) VALUES
(1, 1, 'Total Score '),
(2, 2, 'Total Score '),
(3, 1, 'What is your overall impression about the teacher?                      '),
(4, 2, 'What is your overall impression about the teacher?                      ');

-- --------------------------------------------------------

--
-- Table structure for table `acad_summary_results`
--

CREATE TABLE `acad_summary_results` (
  `resp_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `ques_id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `reponse` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acad_summary_results`
--

INSERT INTO `acad_summary_results` (`resp_id`, `teacher_id`, `sub_id`, `ques_id`, `form_id`, `reponse`) VALUES
(1, 1, 1, 1, 4, 75),
(1, 1, 3, 2, 4, 71),
(1, 5, 4, 1, 4, 75),
(1, 6, 5, 1, 4, 74),
(1, 6, 6, 1, 4, 75),
(1, 10, 2, 1, 4, 76),
(2, 1, 1, 1, 4, 72),
(2, 5, 4, 1, 4, 71),
(2, 6, 5, 1, 4, 77),
(2, 6, 6, 1, 4, 72),
(2, 9, 3, 2, 4, 75),
(2, 10, 2, 1, 4, 74),
(3, 1, 1, 1, 4, 74),
(3, 1, 1, 3, 4, 10),
(3, 1, 3, 2, 4, 75),
(3, 1, 3, 4, 4, 8),
(3, 5, 4, 1, 4, 74),
(3, 5, 4, 3, 4, 7),
(3, 6, 5, 1, 4, 72),
(3, 6, 5, 3, 4, 9),
(3, 6, 6, 1, 4, 77),
(3, 6, 6, 3, 4, 10),
(3, 10, 2, 1, 4, 76),
(3, 10, 2, 3, 4, 6),
(4, 1, 1, 1, 4, 74),
(4, 1, 1, 3, 4, 10),
(4, 1, 3, 2, 4, 75),
(4, 1, 3, 4, 4, 9),
(4, 5, 4, 1, 4, 73),
(4, 5, 4, 3, 4, 9),
(4, 6, 5, 1, 4, 74),
(4, 6, 5, 3, 4, 9),
(4, 6, 6, 1, 4, 76),
(4, 6, 6, 3, 4, 9),
(4, 10, 2, 1, 4, 73),
(4, 10, 2, 3, 4, 9),
(5, 1, 1, 1, 4, 75),
(5, 1, 1, 3, 4, 10),
(5, 5, 4, 1, 4, 74),
(5, 5, 4, 3, 4, 9),
(5, 6, 5, 1, 4, 75),
(5, 6, 5, 3, 4, 9),
(5, 6, 6, 1, 4, 76),
(5, 6, 6, 3, 4, 9),
(5, 9, 3, 2, 4, 77),
(5, 9, 3, 4, 4, 9),
(5, 10, 2, 1, 4, 75),
(5, 10, 2, 3, 4, 9),
(6, 1, 1, 1, 4, 79),
(6, 1, 1, 3, 4, 9),
(6, 1, 3, 2, 4, 75),
(6, 1, 3, 4, 4, 9),
(6, 5, 4, 1, 4, 76),
(6, 5, 4, 3, 4, 9),
(6, 6, 5, 1, 4, 73),
(6, 6, 5, 3, 4, 9),
(6, 6, 6, 1, 4, 74),
(6, 6, 6, 3, 4, 9),
(6, 10, 2, 1, 4, 78),
(6, 10, 2, 3, 4, 9);

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
(5, 6),
(6, 6);

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
(5, 'Fuzzy Logic and Neural Network', 1, 0, 0, 4),
(6, 'FNN', 1, 0, 0, 4);

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
-- Indexes for table `acad_summary_ques`
--
ALTER TABLE `acad_summary_ques`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `acad_summary_results`
--
ALTER TABLE `acad_summary_results`
  ADD PRIMARY KEY (`resp_id`,`teacher_id`,`sub_id`,`ques_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `acad_receipients`
--
ALTER TABLE `acad_receipients`
  MODIFY `resp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `acad_summary_ques`
--
ALTER TABLE `acad_summary_ques`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
