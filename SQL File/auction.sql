-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2018 at 11:19 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `auction`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE IF NOT EXISTS `addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country` text NOT NULL,
  `fullname` text NOT NULL,
  `mobile` text NOT NULL,
  `pincode` int(6) NOT NULL,
  `street_address` text NOT NULL,
  `landmark` text NOT NULL,
  `city` text NOT NULL,
  `state` varchar(100) NOT NULL,
  `user_email` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `admin_user`
--

CREATE TABLE IF NOT EXISTS `admin_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `dateRegistration` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `contactNo` varchar(12) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `auction`
--

CREATE TABLE IF NOT EXISTS `auction` (
  `auction_id` int(11) NOT NULL AUTO_INCREMENT,
  `status` int(1) NOT NULL,
  `starting_Price` int(11) NOT NULL,
  `final_Price` int(11) NOT NULL,
  `start_date` text NOT NULL,
  `end_date` text NOT NULL,
  `winner_name` text NOT NULL,
  `winner_email` text NOT NULL,
  `seller_email` text NOT NULL,
  `seller_contact` text NOT NULL,
  PRIMARY KEY (`auction_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bidders`
--

CREATE TABLE IF NOT EXISTS `bidders` (
  `bidderId` int(11) NOT NULL AUTO_INCREMENT,
  `Amount` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `bidder_Email` text NOT NULL,
  `date_bidded` text NOT NULL,
  `prod_Id` int(11) NOT NULL,
  PRIMARY KEY (`bidderId`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `carousel`
--

CREATE TABLE IF NOT EXISTS `carousel` (
  `car_Id` int(11) NOT NULL AUTO_INCREMENT,
  `image3` text NOT NULL,
  `description` text NOT NULL,
  `linkId` int(11) NOT NULL,
  PRIMARY KEY (`car_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ccc`
--

CREATE TABLE IF NOT EXISTS `ccc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE IF NOT EXISTS `contact_us` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `subject` text NOT NULL,
  `message` text NOT NULL,
  `date_contacted` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `otp`
--

CREATE TABLE IF NOT EXISTS `otp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` text NOT NULL,
  `type` varchar(20) NOT NULL,
  `OTP` text NOT NULL,
  `Time_Stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `product_Id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `image1` text NOT NULL,
  `seller` varchar(50) NOT NULL,
  `initial_Price` int(11) NOT NULL,
  `current_Price` int(11) NOT NULL,
  `final_Price` int(11) NOT NULL,
  `description` text NOT NULL,
  `category` varchar(50) NOT NULL,
  `is_Auction_Over` int(11) NOT NULL,
  `date_Added` text NOT NULL,
  `date_Started` text NOT NULL,
  `date_End` text NOT NULL,
  `is_verified` int(11) NOT NULL,
  `winner` int(1) NOT NULL,
  `winnder` text NOT NULL,
  PRIMARY KEY (`product_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE IF NOT EXISTS `product_category` (
  `category_Id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  PRIMARY KEY (`category_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(30) NOT NULL,
  `email_id` text NOT NULL,
  `password` text NOT NULL,
  `contact_no` text NOT NULL,
  `address` text NOT NULL,
  `state` varchar(30) NOT NULL,
  `city` varchar(25) NOT NULL,
  `pincode` int(7) NOT NULL,
  `gender` varchar(7) NOT NULL,
  `dob` text NOT NULL,
  `card_no` text NOT NULL,
  `account_status` int(1) NOT NULL,
  `two_step_verfication` int(1) NOT NULL,
  `date_registration` text NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
