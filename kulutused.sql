-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 28, 2017 at 11:02 PM
-- Server version: 5.5.55-0+deb8u1
-- PHP Version: 5.6.30-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kulutused`
--

-- --------------------------------------------------------

--
-- Table structure for table `kasutajad`
--

CREATE TABLE IF NOT EXISTS `kasutajad` (
`id` int(11) NOT NULL,
  `user` varchar(64) NOT NULL,
  `pass` varchar(64) NOT NULL,
  `admin` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kasutajad`
--

INSERT INTO `kasutajad` (`id`, `user`, `pass`, `admin`) VALUES
(1, 'kaarel', 'e068381bbd9eec031347912c57dac0f67479ba23', NULL),
(2, 'kaareladmin', 'e068381bbd9eec031347912c57dac0f67479ba23', NULL),
(3, 'root', 'e068381bbd9eec031347912c57dac0f67479ba23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kulud`
--

CREATE TABLE IF NOT EXISTS `kulud` (
`id` int(11) NOT NULL,
  `aeg` date NOT NULL,
  `liik` int(11) NOT NULL,
  `summa` decimal(10,2) NOT NULL,
  `kommentaar` varchar(1024) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kulud`
--

INSERT INTO `kulud` (`id`, `aeg`, `liik`, `summa`, `kommentaar`) VALUES;

-- --------------------------------------------------------

--
-- Table structure for table `kululiigid`
--

CREATE TABLE IF NOT EXISTS `kululiigid` (
`id` int(11) NOT NULL,
  `liik` varchar(64) NOT NULL,
  `kommentaar` varchar(128) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kululiigid`
--

INSERT INTO `kululiigid` (`id`, `liik`, `kommentaar`) VALUES
(1, 'toit', 'poest ja restoranist');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kasutajad`
--
ALTER TABLE `kasutajad`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kulud`
--
ALTER TABLE `kulud`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kululiigid`
--
ALTER TABLE `kululiigid`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kasutajad`
--
ALTER TABLE `kasutajad`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `kulud`
--
ALTER TABLE `kulud`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `kululiigid`
--
ALTER TABLE `kululiigid`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
