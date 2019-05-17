-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 17, 2019 at 03:42 PM
-- Server version: 5.7.25-0ubuntu0.16.04.2
-- PHP Version: 5.6.40-6+ubuntu16.04.1+deb.sury.org+3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dr_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `file_id` int(11) NOT NULL,
  `file_name` text NOT NULL,
  `file_title` text NOT NULL,
  `file_description` text NOT NULL,
  `file_author` text NOT NULL,
  `search_target` text NOT NULL,
  `file_contributor` text NOT NULL,
  `year` int(11) NOT NULL DEFAULT '2017',
  `file_rc` int(11) NOT NULL,
  `file_uploader` text NOT NULL,
  `access_level` int(11) NOT NULL DEFAULT '0',
  `downloadCode` text NOT NULL,
  `upload_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`file_id`, `file_name`, `file_title`, `file_description`, `file_author`, `search_target`, `file_contributor`, `year`, `file_rc`, `file_uploader`, `access_level`, `downloadCode`, `upload_time`) VALUES
(1, 'AMU - Customer Satisfaction1.pdf', 'Amu customer satisfaction', 'amu customer satisfation is the customer satisfaction surver in amu', 'Ermiyas Kebede', 'Amu customer satisfactio namu customer satisfation is the customer satisfaction surver in amu Ermiyas Kebede 2008', '', 2008, 4, 'wuletaw.wonte', 1, '79317', '2017-08-04 01:05:48'),
(2, 'Wimis have to category1.docx', 'wimis category', 'WIMIS is a system in amu and this is category', 'Cherotaw Kentib', 'wimis category WIMIS is a system in amu and this is category Cherotaw Kentib 1998', '', 1998, 4, 'wuletaw.wonte', 0, '7f47d', '2017-08-04 01:05:48'),
(3, 'Ke ekide hu halafiw yakidal  mrt matariyal documt plan.docx', 'Kidat mrt material document', 'The merial document plan', 'Kebede Ayalew', 'Kidat mrt material document The merial document plan Kebede Ayalew 2003', '', 2003, 4, 'wuletaw.wonte', 1, '92090', '2017-08-04 01:05:48'),
(4, 'Ict workshop.docx', 'ICT workshop', 'This workshop is about ICT', 'Daniel Tilahun', 'ICT workshop Daniel Tilahun This workshop is about ICT 1990', '', 1990, 4, 'wuletaw.wonte', 0, '719b1', '2017-08-04 01:05:48'),
(5, 'research software user actions.docx', 'Research Software user action', 'This document is about research software and its user action', 'Prof. Tagel Wegayehu', 'Research Software user actionThis document is about research software and its user actionProf. Tagel Wegayehu', '', 2001, 4, 'wuletaw.wonte', 0, '348f0', '2017-08-10 01:10:45'),
(6, 'scan00041.pdf', 'Amet ereft atekakem', 'This document is about amet ereft atekakem', 'Amarech Deneke', 'Amet ereft atekakem This document is about amet ereft atekakem Amarech Deneke 1999', '', 1999, 6, 'chirotaw.kentib', 0, '80e04', '2017-08-10 01:59:55');

-- --------------------------------------------------------

--
-- Table structure for table `rc`
--

CREATE TABLE `rc` (
  `rc_id` int(11) NOT NULL,
  `rc_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rc`
--

INSERT INTO `rc` (`rc_id`, `rc_name`) VALUES
(4, 'Water Resource Research Center'),
(6, 'Biodiversity Research Center'),
(0, 'Agriculture College Research Coordination Office '),
(0, 'Arba Minch Technology Institute Research Coordination Office '),
(0, 'Business and Economics College research Coordination Office '),
(0, 'Law School Research Coordination office '),
(0, 'Medicine and Health Sciences Research Coordination Office '),
(0, 'Natural Sciences Research Coordination Offices'),
(0, 'Sawula Campus Research Coordination office '),
(0, 'Social Science and Humanities College Research Coordination Office');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `request_id` int(11) NOT NULL,
  `requester` text NOT NULL,
  `file_name` text NOT NULL,
  `uploader` text NOT NULL,
  `reason` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`request_id`, `requester`, `file_name`, `uploader`, `reason`) VALUES
(1, 'samuel Azanaw', 'license.txt', 'wuletaw.wonte', 'To use as a raw data for the project i am working on');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `research_center` int(50) NOT NULL,
  `view` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `research_center`, `view`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 0, 1),
(17, 'wuletaw.wonte', 'wuletaw', 4, 0),
(20, 'chirotaw.kentib', 'chirotaw', 6, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
