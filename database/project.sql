-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2022 at 05:52 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(32) NOT NULL,
  `lvl` int(11) NOT NULL,
  `par` int(32) NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp(),
  `user` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `votes` int(32) NOT NULL DEFAULT 0,
  `content` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `author` varchar(150) NOT NULL,
  `startTime` datetime NOT NULL DEFAULT current_timestamp(),
  `endTime` datetime NOT NULL DEFAULT current_timestamp(),
  `isFinished` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `message` varchar(2500) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leaderboard`
--

CREATE TABLE `leaderboard` (
  `user` varchar(50) NOT NULL,
  `Structured Programming Language` int(11) NOT NULL DEFAULT 0,
  `Structured Programming Language Total` int(11) NOT NULL DEFAULT 0,
  `Discrete Math` int(11) NOT NULL DEFAULT 0,
  `Discrete Math Total` int(11) NOT NULL DEFAULT 0,
  `Data Structures` int(11) NOT NULL DEFAULT 0,
  `Data Structures Total` int(11) NOT NULL DEFAULT 0,
  `Algorithm Design & Analysis` int(11) NOT NULL DEFAULT 0,
  `Algorithm Design & Analysis Total` int(11) NOT NULL DEFAULT 0,
  `Object Oriented Programming` int(11) NOT NULL DEFAULT 0,
  `Object Oriented Programming Total` int(11) NOT NULL DEFAULT 0,
  `Numerical Analysis` int(11) NOT NULL DEFAULT 0,
  `Numerical Analysis Total` int(11) NOT NULL DEFAULT 0,
  `Theory of Computation` int(11) NOT NULL DEFAULT 0,
  `Theory of Computation Total` int(11) NOT NULL DEFAULT 0,
  `Ethics & Cyber Law` int(11) NOT NULL DEFAULT 0,
  `Ethics & Cyber Law Total` int(11) NOT NULL DEFAULT 0,
  `Digital Signal Processing` int(11) NOT NULL DEFAULT 0,
  `Digital Signal Processing Total` int(11) NOT NULL DEFAULT 0,
  `Database System` int(11) NOT NULL DEFAULT 0,
  `Database System Total` int(11) NOT NULL DEFAULT 0,
  `Operating System` int(11) NOT NULL DEFAULT 0,
  `Operating System Total` int(11) NOT NULL DEFAULT 0,
  `Computer Networking` int(11) NOT NULL DEFAULT 0,
  `Computer Networking Total` int(11) NOT NULL DEFAULT 0,
  `Computer Graphics` int(11) NOT NULL DEFAULT 0,
  `Computer Graphics Total` int(11) NOT NULL DEFAULT 0,
  `Computer Architecture` int(11) NOT NULL DEFAULT 0,
  `Computer Architecture Total` int(11) NOT NULL DEFAULT 0,
  `Artificial Intelligence` int(11) NOT NULL DEFAULT 0,
  `Artificial Intelligence Total` int(11) NOT NULL DEFAULT 0,
  `Machine Learning` int(11) NOT NULL DEFAULT 0,
  `Machine Learning Total` int(11) NOT NULL DEFAULT 0,
  `Others` int(11) NOT NULL DEFAULT 0,
  `Others Total` int(11) NOT NULL DEFAULT 0,
  `any` int(11) NOT NULL DEFAULT 0,
  `any Total` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `ID` int(11) NOT NULL,
  `Author` varchar(255) NOT NULL,
  `Course` varchar(50) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Type` varchar(10) NOT NULL,
  `Time` datetime NOT NULL DEFAULT current_timestamp(),
  `Size` decimal(3,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int(32) NOT NULL,
  `question` int(32) NOT NULL,
  `option` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(32) NOT NULL,
  `title` varchar(350) COLLATE utf8_unicode_ci NOT NULL,
  `author` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp(),
  `votes` int(32) NOT NULL DEFAULT 0,
  `content` varchar(5000) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `exam` int(11) DEFAULT NULL,
  `question` varchar(200) NOT NULL,
  `answer` int(11) NOT NULL,
  `course` varchar(255) NOT NULL DEFAULT 'others',
  `marks` int(5) NOT NULL DEFAULT 1,
  `difficulty` varchar(20) NOT NULL DEFAULT 'easy'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `quizs`
--

CREATE TABLE `quizs` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `exam` int(32) DEFAULT NULL,
  `user` varchar(200) DEFAULT NULL,
  `score` int(32) DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `entryTime` datetime NOT NULL DEFAULT current_timestamp(),
  `reg_no` bigint(20) NOT NULL,
  `isAdmin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `post` int(32) NOT NULL,
  `user` varchar(150) NOT NULL,
  `vote` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
