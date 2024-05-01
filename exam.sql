-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2018 at 08:02 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `exam`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `email`, `password`) VALUES
(1, 'admin@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE `answer` (
  `qid` text NOT NULL,
  `ansid` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`qid`, `ansid`) VALUES
('5b13ed3a6e006', '5b13ed3a9436a'),
('5b13ed72489d8', '5b13ed7263d70'),

('5b141d712647f', '5b141d71485b9'),
('5b141d718f873', '5b141d71978d1'),
('5b141d71ddb46', '5b141d71e5f3c'),
('5b141d721a738', '5b141d7222884'),

('5b1422651fdde', '5b141d7268b8a'),
('5b14226574ed5', '5b141d72aefd8'),
('5b142265b5d08', '5b141d72dfa88'),
('5b1422661d93f', '5b141d731c248');
-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `email` varchar(50) NOT NULL,
  `eid` text NOT NULL,
  `score` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `sahi` int(11) NOT NULL,
  `wrong` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`email`, `eid`, `score`, `level`, `sahi`, `wrong`, `date`) VALUES
('raju@gmail.com', '5b141b8009cf0', 30, 10, 10, 0, '2018-06-03 16:57:45'),
('student@gmail.com', '5b141b8009cf0', 22, 10, 8, 2, '2018-06-03 16:56:00');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `qid` varchar(50) NOT NULL,
  `option` varchar(5000) NOT NULL,
  `optionid` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`qid`, `option`, `optionid`) VALUES
('5b13ed3a6e006', 'sdb', '5b13ed3a9436a'),
('5b13ed3a6e006', 'jsdb', '5b13ed3a94374'),
('5b13ed3a6e006', 'dsbv', '5b13ed3a94377'),
('5b13ed3a6e006', 'jbdv', '5b13ed3a94379'),
('5b13ed72489d8', 'vsdv', '5b13ed7263d70'),
('5b13ed72489d8', 'vsdv', '5b13ed7263d7a'),
('5b13ed72489d8', 'vsdv', '5b13ed7263d7d'),
('5b13ed72489d8', 'vsdv', '5b13ed7263d80'),

('5b141d712647f', 'LIKE', '5b141d71485b9'),
('5b141d712647f', 'WHERE', '5b141d71485dc'),
('5b141d712647f', 'IS', '5b141d71485e0'),
('5b141d712647f', 'SAME', '5b141d71485e4'),

('5b141d718f873', 'sampdb', '5b141d71978be'),
('5b141d718f873', 'mysql', '5b141d71978cc'),
('5b141d718f873', 'information_schema', '5b141d71978d1'),
('5b141d718f873', 'readme_db', '5b141d71978d4'),

('5b141d71ddb46', 'value equal to zero', '5b141d71e5f2b'),
('5b141d71ddb46', 'unknown value','5b141d71e5f3c'),
('5b141d71ddb46', 'negative values', '5b141d71e5f43'),
('5b141d71ddb46', 'a large value', '5b141d71e5f48'),

('5b141d721a738', 'zero', '5b141d7222820'),
('5b141d721a738', 'a positive value', '5b141d722282f'),
('5b141d721a738', 'a negative value', '5b141d7222880'),
('5b141d721a738', 'null', '5b141d7222884'),

('5b1422651fdde', 'windowing', '5b141d7268b8a'),
('5b1422651fdde', 'running', '5b141d7268b95'),
('5b1422651fdde', 'interfacing', '5b141d7268b98'),
('5b1422651fdde', 'matrix', '5b141d7268b9a'),

('5b14226574ed5', 'Setting up a workstation to take full advantage of the customizable features of R is a straightforward thing', '5b141d72aefcb'),
('5b14226574ed5', 'q() is used to quit the R program', '5b141d72aefd8'),
('5b14226574ed5', 'R has an inbuilt help facility similar to the man facility of UNIX', '5b141d72aefdc'),
('5b14226574ed5', 'Windows versions of R have other optional help systems also', '5b141d72aefe0'),

('5b142265b5d08', 'Windows versions of R have other optional help system also', '5b141d72dfa7b'),
('5b142265b5d08', 'The help.search command (alternatively ??) allows searching for help in various ways', '5b141d72dfa85'),
('5b142265b5d08', 'R is case insensitive as are most UNIX based packages, so A and a are different symbols and would refer to different variables', '5b141d72dfa88'),
('5b142265b5d08', '$ R is used to start the R program', '5b141d72dfa8b'),

('5b1422661d93f', 'utilstats', '5b141d731c234'),
('5b1422661d93f', 'language', '5b141d731c242'),
('5b1422661d93f', 'expressions', '5b141d731c248'),
('5b1422661d93f', 'packages', '5b141d731c24b');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `eid` text NOT NULL,
  `qid` text NOT NULL,
  `qns` text NOT NULL,
  `choice` int(10) NOT NULL,
  `sn` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`eid`, `qid`, `qns`, `choice`, `sn`) VALUES
('5b13ed30cd71f', '5b13ed3a6e006', 'dbjb', 4, 1),
('5b13ed6bb8bcd', '5b13ed72489d8', 'dvsd', 4, 1),

('5b141b8009cf0', '5b141d712647f', 'Which of the following clauses is used to display information that match a given pattern?', 4, 1),
('5b141b8009cf0', '5b141d718f873', 'The special database that always exists after setting up MySQL in a computer is __________', 4, 2),
('5b141b8009cf0', '5b141d71ddb46', 'The NULL value also means ___________', 4, 3),
('5b141b8009cf0', '5b141d721a738', 'What does comparing a known value with NULL result into?', 4, 4),

('5b141f1e8399e', '5b1422651fdde', 'The most convenient way to use R is at a graphics workstation running a ________ system.', 4, 1),
('5b141f1e8399e', '5b14226574ed5', 'Point out the wrong statement?', 4, 2),
('5b141f1e8399e', '5b142265b5d08', 'Point out the wrong statement?', 4, 3),
('5b141f1e8399e', '5b1422661d93f', 'Elementary commands in R consist of either _______ or assignments.', 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `eid` text NOT NULL,
  `title` varchar(100) NOT NULL,
  `sahi` int(11) NOT NULL,
  `wrong` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`eid`, `title`, `sahi`, `wrong`, `total`, `date`) VALUES
('5b141b8009cf0', 'MySQL Basics', 3, 1, 10, '2018-06-03 16:46:56'),
('5b141f1e8399e', 'R PRogramming Basics', 3, 1, 10, '2018-06-03 17:02:22');

-- --------------------------------------------------------

--
-- Table structure for table `rank`
--

CREATE TABLE `rank` (
  `email` varchar(50) NOT NULL,
  `score` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rank`
--

INSERT INTO `rank` (`email`, `score`, `time`) VALUES
('student@gmail.com', 22, '2018-06-03 16:56:00'),
('raju@gmail.com',  30, '2018-06-03 16:57:45');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `name` varchar(50) NOT NULL,
  `college` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`name`, `college`, `email`, `password`) VALUES
('Raju', 'National Institute of Science and Technology, Chennai', 'Raju@gmail.com', 'raju'),
('Student', 'MIT, Chennai','student@gmail.com','student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
