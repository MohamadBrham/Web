-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2016 at 01:52 PM
-- Server version: 5.7.9-log
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `books_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `bid` int(11) NOT NULL AUTO_INCREMENT,
  `bname` varchar(50) DEFAULT NULL,
  `author` varchar(50) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  PRIMARY KEY (`bid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`bid`, `bname`, `author`, `year`, `price`) VALUES
(1, 'JavaScript', 'Douglas Crockford', 2008, 75),
(2, 'Data and Goliath', ' Bruce Schneier', 2015, 205),
(3, 'Introduction to Algorithms', 'Thomas H. Cormen', 2001, 120),
(4, 'Computer Networks', ' Andrew S. Tanenbaum', 2002, 98),
(5, 'Clean Code', 'Robert C. Martin', 2008, 112),
(6, 'Design Patterns', ' Erich Gamma, Ralph Johnson', 1994, 95),
(7, 'The C Programming Language', ' Brian W. Kernighan', 1988, 130),
(8, 'The C++ Programming Language', 'Bjarne Stroustrup', 2000, 124),
(9, 'Learning Python', 'Mark Lutz, David Ascher', 2003, 150),
(10, 'Thinking in Java', 'Bruce Eckel', 2006, 99),
(11, 'In Our Own Image', 'George Zarkadakis', 2016, 199),
(12, 'Little One', 'Jo Weaver', 2016, 109),
(13, 'The Hidden Reality', 'Brian Greene', 2011, 139),
(14, 'Plastic', ' Susan Freinkel', 2011, 144),
(15, 'Poisons', 'Peter Macinnis', 2005, 170),
(16, 'Engineers of Victory', 'Paul Kennedy', 2012, 112),
(17, 'Lean how to code', 'Emad', 2015, 150),
(18, 'Learn C++', 'Nabeel', 2012, 120);

-- --------------------------------------------------------

--
-- Table structure for table `branch_has`
--

CREATE TABLE IF NOT EXISTS `branch_has` (
  `bid` int(11) NOT NULL,
  `sid` char(8) NOT NULL,
  `stock` int(11) DEFAULT NULL,
  PRIMARY KEY (`bid`,`sid`),
  KEY `sid` (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `branch_has`
--

INSERT INTO `branch_has` (`bid`, `sid`, `stock`) VALUES
(1, '111', 2),
(2, '111', 0),
(3, '113', 3),
(4, '113', 5),
(5, '113', 3),
(6, '112', 3),
(7, '114', 3),
(8, '114', 6),
(9, '111', 0),
(10, '111', 3),
(11, '113', 3),
(12, '113', 5),
(13, '114', 5),
(14, '113', 3),
(15, '114', 3),
(16, '112', 4),
(17, '111', 20),
(18, '112', 15);

-- --------------------------------------------------------

--
-- Table structure for table `customer_has`
--

CREATE TABLE IF NOT EXISTS `customer_has` (
  `uid` int(11) DEFAULT NULL,
  `bid` int(11) DEFAULT NULL,
  `sid` char(8) DEFAULT NULL,
  KEY `uid` (`uid`),
  KEY `bid` (`bid`),
  KEY `sid` (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer_has`
--

INSERT INTO `customer_has` (`uid`, `bid`, `sid`) VALUES
(1, 3, '111'),
(3, 2, '111'),
(1, 4, '114'),
(2, 5, '113'),
(3, 1, '113'),
(1, 9, '111'),
(1, 13, '114'),
(1, 10, '111'),
(1, 9, '111'),
(1, 17, '111'),
(1, 17, '111'),
(1, 17, '111'),
(1, 17, '111'),
(1, 17, '111'),
(1, 17, '111'),
(1, 17, '111'),
(1, 17, '111'),
(1, 17, '111'),
(1, 17, '111'),
(3, 2, '111'),
(1, 2, '111'),
(1, 2, '111'),
(1, 2, '111'),
(8, 1, '111'),
(8, 1, '111'),
(8, 9, '111'),
(8, 9, '111'),
(8, 9, '111'),
(8, 9, '111'),
(9, 6, '112'),
(9, 1, '111'),
(9, 1, '111');

-- --------------------------------------------------------

--
-- Table structure for table `store_branch`
--

CREATE TABLE IF NOT EXISTS `store_branch` (
  `sid` char(8) NOT NULL,
  `sname` varchar(20) DEFAULT NULL,
  `mid` int(11) DEFAULT NULL,
  `location` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`sid`),
  KEY `mid` (`mid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `store_branch`
--

INSERT INTO `store_branch` (`sid`, `sname`, `mid`, `location`) VALUES
('111', 'Tunali', 3, 'Ankara - Tunali Hilmi Caddesi No:12'),
('112', 'Besiktas', 4, 'Istanbul - Kadirgalar Caddesi No:3'),
('113', 'Bilkent', 5, 'Ankara - Bilkent Center No:8 '),
('114', 'Kadikoy', 6, 'Istanbul - Rihtim Caddesi No:44'),
('115', 'new branch', 7, 'Ankara');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `password` varchar(10) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `address` text,
  `phoneNumber` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `name`, `password`, `type`, `address`, `phoneNumber`, `email`) VALUES
(1, 'Emad Aghbar', '123', 'customer', 'Bilkent - 73 dorm', '0599792551', 'e.agh@hotmail.com'),
(2, 'Mohammed Barhm', '1234', 'admin', 'Bilkent - 76 dorm', '05424337756', 'Mohammed@hotmail.com'),
(3, 'Maen Mallah', '12345', 'manager', 'Bilkent - 75 dorm', '05424337789', 'Maen@hotmail.com'),
(4, 'Nabeel Abu Baker', '1111', 'manager', 'Bilkent', '05421569321', 'Nabeel@hotmail.com'),
(5, 'Fuad Amireh', '1212', 'manager', 'Bilkent', '05548563218', 'Fuad@hotmail.com'),
(6, 'Firas', '1234', 'manager', 'Bilkent - 76 dorm', '05424337756', 'Mohammed@hotmail.com'),
(7, 'Ahmed', '123', 'manager', 'Ankara ', '059785412', 'ahmed@hotmail.com'),
(8, 'Abdullah', '33', 'customer', 'Ankara - bilkent', '04974654323', 'Abdullah@gmail.com'),
(9, 'Nisa', '123', 'customer', 'sadf', '0599792551', '123@hotmail.com');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `branch_has`
--
ALTER TABLE `branch_has`
  ADD CONSTRAINT `branch_has_ibfk_1` FOREIGN KEY (`bid`) REFERENCES `book` (`bid`),
  ADD CONSTRAINT `branch_has_ibfk_2` FOREIGN KEY (`sid`) REFERENCES `store_branch` (`sid`);

--
-- Constraints for table `customer_has`
--
ALTER TABLE `customer_has`
  ADD CONSTRAINT `customer_has_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`),
  ADD CONSTRAINT `customer_has_ibfk_2` FOREIGN KEY (`bid`) REFERENCES `books` (`bid`),
  ADD CONSTRAINT `customer_has_ibfk_3` FOREIGN KEY (`sid`) REFERENCES `store_branch` (`sid`);

--
-- Constraints for table `store_branch`
--
ALTER TABLE `store_branch`
  ADD CONSTRAINT `store_branch_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `users` (`uid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
