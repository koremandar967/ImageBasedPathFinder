-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 23, 2017 at 12:54 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `imagemap`
--

-- --------------------------------------------------------

--
-- Table structure for table `gpsloc`
--

CREATE TABLE IF NOT EXISTS `gpsloc` (
  `uid` int(20) NOT NULL,
  `latitude` varchar(50) NOT NULL,
  `longitude` varchar(50) NOT NULL,
  `datetime` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gpsloc`
--


-- --------------------------------------------------------

--
-- Table structure for table `places`
--

CREATE TABLE IF NOT EXISTS `places` (
  `PID` int(5) NOT NULL AUTO_INCREMENT,
  `PTitle` varchar(150) NOT NULL,
  `Pinfo` text NOT NULL,
  `Pdate` varchar(25) NOT NULL,
  `City` text NOT NULL,
  `Latitude` double NOT NULL,
  `Longitude` double NOT NULL,
  PRIMARY KEY (`PID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `places`
--

INSERT INTO `places` (`PID`, `PTitle`, `Pinfo`, `Pdate`, `City`, `Latitude`, `Longitude`) VALUES
(10, 'sdfas fsd f', 'asdfsdaf', '2017-03-07', 'Sangli', 16.69556319585078, 74.40530747578129),
(11, 'asfsd', 'ffsdf', '2017-03-10', 'Sangli', 16.45, 74.55);

-- --------------------------------------------------------

--
-- Table structure for table `placesimg`
--

CREATE TABLE IF NOT EXISTS `placesimg` (
  `piid` int(10) NOT NULL AUTO_INCREMENT,
  `pid` int(10) NOT NULL,
  `Pfile` text NOT NULL,
  `pichashval` text NOT NULL,
  `grayhashval` text NOT NULL,
  PRIMARY KEY (`piid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `placesimg`
--

INSERT INTO `placesimg` (`piid`, `pid`, `Pfile`, `pichashval`, `grayhashval`) VALUES
(1, 10, '1489175054aa9.png', '0fffefef00800501', ''),
(2, 10, '1490264145cmd6.jpg', '071f3f3303030100', '0000000000000000'),
(3, 10, '1490264210cmd6.jpg', '071f3f3303030100', '0000000000000000'),
(4, 10, '1490264301cmd6.jpg', '071f3f3303030100', 'f8f8f8fcfcfcfefe'),
(5, 10, '14902644321.jpg', 'ffffc3e7cb7e0001', 'ffe7c3c7cbcb0000'),
(6, 10, '14902644632.jpg', 'ffe7c3c3c7c30000', 'ff00c7c7d7d70000');

-- --------------------------------------------------------

--
-- Table structure for table `userdb`
--

CREATE TABLE IF NOT EXISTS `userdb` (
  `Uid` int(5) NOT NULL AUTO_INCREMENT,
  `Uname` varchar(50) NOT NULL,
  `UMob` varchar(15) NOT NULL,
  `Upass` varchar(50) NOT NULL,
  `Ujoindate` varchar(30) NOT NULL,
  `Email` varchar(150) NOT NULL,
  `Address` text NOT NULL,
  `city` varchar(100) NOT NULL,
  PRIMARY KEY (`Uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `userdb`
--

INSERT INTO `userdb` (`Uid`, `Uname`, `UMob`, `Upass`, `Ujoindate`, `Email`, `Address`, `city`) VALUES
(5, 'Pranita Savarde', '7777888899', 'aaaa', '', '', '', ''),
(6, 'leena nikalje', '8600916933', 'leena', '', '', '', ''),
(9, 'aaaa', 'GROUP', '', '', '', '', ''),
(10, 'bbbbb', 'GROUP', '', '', '', '', ''),
(13, 'abc xyz', '1234243543', 'abc123', 'Sat-Oct-2016', '', '', ''),
(14, 'abc xyz', '9876543212', 'abc123', 'Sat-Oct-2016', '', '', ''),
(15, 'shilpa patil', '9876543210', '123abc', 'Sat-Oct-2016', '', '', ''),
(16, 'abc xyz', '1234567891', 'abc123', 'Wed-Oct-2016', '', '', ''),
(17, 'monika patil', '8906490155', 'mona@5932', 'Thu-Oct-2016', '', '', ''),
(18, 'xyz abc', '9172621297', 'shubha1234', 'Thu-Nov-2016', '', '', ''),
(19, 'komal surve', '9876543219', '987654', '04-11-2016 08:58:31', '', '', ''),
(20, 'shubhangi magdum', '9890164190', 's123', '04-11-2016 09:07:47', '', '', ''),
(21, 'abc xyz', '4561237894', 'abcdef', '04-11-2016 11:46:31', '', '', ''),
(22, 'abc pqr', '7507160454', '123456', '04-11-2016 11:46:36', '', '', ''),
(23, 'pqr abc', '8806420215', 'pqrabc1', '04-11-2016 11:53:58', '', '', ''),
(24, 'abc wxy', '9579893302', 'aaa', '05-11-2016 12:03:20', 'asd@Ad.in', 'asdsad', 'asd'),
(25, 'abcd xyz', '9172621299', '123456', '05-11-2016 12:46:00', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `userreg`
--

CREATE TABLE IF NOT EXISTS `userreg` (
  `UID` int(5) NOT NULL AUTO_INCREMENT,
  `Fname` varchar(25) NOT NULL,
  `Lname` varchar(25) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Pass` varchar(20) NOT NULL,
  PRIMARY KEY (`UID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `userreg`
--

INSERT INTO `userreg` (`UID`, `Fname`, `Lname`, `Email`, `Pass`) VALUES
(3, 'aaa', 'aaa', 'aaa', 'aaa'),
(4, 'sss', 'sss', 'sss', 'sss');
