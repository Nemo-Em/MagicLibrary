-- phpMyAdmin SQL Dump
-- version 4.6.6deb1+deb.cihar.com~xenial.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 22, 2017 at 09:34 PM
-- Server version: 5.7.18-0ubuntu0.16.04.1
-- PHP Version: 7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Library`
--

-- --------------------------------------------------------

--
-- Table structure for table `Books`
--

CREATE TABLE `Books` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `author` varchar(250) NOT NULL,
  `description` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Books`
--

INSERT INTO `Books` (`id`, `title`, `author`, `description`) VALUES
(1, 'The Lion, the Witch, and the Wardrobe', 'C.S Lewis', '1950\'s book'),
(2, 'Harry Potter and the Philosopher\'s Stone', 'J.K Rowling', 'First of Harry Potter series'),
(3, 'Fallen', 'Lauren Kate', 'About Angels & Demons'),
(4, 'Charlie and the Chocolate Factory', 'Roald Dahl', 'chocolate!'),
(5, 'Alice in Wonderland', 'Lewis Carroll', 'magic :)');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Books`
--
ALTER TABLE `Books`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Books`
--
ALTER TABLE `Books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
