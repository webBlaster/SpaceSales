-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 14, 2019 at 05:42 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Table structure for table `agentdetails`
--

CREATE TABLE IF NOT EXISTS `agentdetails` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `email` varchar(225) NOT NULL,
  `password` varchar(100) NOT NULL,
  `notification` int(225) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `agentdetails`
--

INSERT INTO `agentdetails` (`id`, `username`, `email`, `password`, `notification`) VALUES
(1, 'webblaster', 'yekinnijibola@gmail.com', '1c116ace12b00b0fb88a5d22a33a0431', 2);

-- --------------------------------------------------------

--
-- Table structure for table `negotiations`
--

CREATE TABLE IF NOT EXISTS `negotiations` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `customer` varchar(255) NOT NULL,
  `mobile` varchar(225) NOT NULL,
  `title` varchar(225) NOT NULL,
  `productid` int(11) NOT NULL,
  `agent` varchar(255) NOT NULL,
  `user` varchar(25) NOT NULL,
  `time` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `negotiations`
--

INSERT INTO `negotiations` (`id`, `customer`, `mobile`, `title`, `productid`, `agent`, `user`, `time`) VALUES
(1, 'Coded guy', '08133340956', 'sweet deal', 2, 'yekinnijibola@gmail.com', 'yekinnijibola@gmail.com', '2019-05-14 08:53:32.477806'),
(2, 'Ajibola', '08133340956', 'sweet deal', 2, 'yekinnijibola@gmail.com', 'yekinnijibola@gmail.com', '2019-06-08 17:54:59.402404');

-- --------------------------------------------------------

--
-- Table structure for table `spaces`
--

CREATE TABLE IF NOT EXISTS `spaces` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `agent` varchar(25) NOT NULL,
  `title` varchar(225) NOT NULL,
  `location` varchar(25) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `spaces`
--

INSERT INTO `spaces` (`id`, `agent`, `title`, `location`, `description`, `image`, `price`, `status`) VALUES
(2, 'yekinnijibola@gmail.com', 'sweet deal', 'ketu Alapere', 'there is very little information at the moment', '../Spaceimage/169.jpg', 200000, 'available');

-- --------------------------------------------------------

--
-- Table structure for table `userdetails`
--

CREATE TABLE IF NOT EXISTS `userdetails` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `email` varchar(225) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `userdetails`
--

INSERT INTO `userdetails` (`id`, `email`, `password`) VALUES
(1, 'yekinnijibola@gmail.com', '1c116ace12b00b0fb88a5d22a33a0431'),
(2, 'example@gmail.com', 'f694ed6247fbbe76c7046c2892b78b3a');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
