-- phpMyAdmin SQL Dump
-- version 3.5.7deb1.precise~ppa.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 20, 2013 at 10:13 AM
-- Server version: 5.5.28-0ubuntu0.12.04.2
-- PHP Version: 5.3.10-1ubuntu3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `isupport`
--

-- --------------------------------------------------------

--
-- Table structure for table `creator`
--

CREATE TABLE IF NOT EXISTS `creator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `mobile_no` varchar(10) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `ActivationCode` varchar(10) NOT NULL,
  `is_active` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `creator`
--

INSERT INTO `creator` (`id`, `name`, `username`, `password`, `mobile_no`, `email`, `ActivationCode`, `is_active`) VALUES
(3, 'BJP Udaipur', 'bjpudaipur', '123', '9783807100', NULL, '1913', 1);

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `creator_id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `code` varchar(45) DEFAULT NULL,
  `planned_on_date` datetime DEFAULT NULL,
  `total_effected` int(11) DEFAULT NULL,
  `total_support` int(11) DEFAULT NULL,
  `total_participants` int(11) DEFAULT NULL,
  `current_participants` int(11) DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT NULL,
  `indian_locations_id` int(11) NOT NULL,
  `effective_location` varchar(45) DEFAULT NULL,
  `show_success_rate` tinyint(4) DEFAULT NULL,
  `data_on_screen` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_event_creator` (`creator_id`),
  KEY `fk_event_indian_locations1` (`indian_locations_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `creator_id`, `name`, `code`, `planned_on_date`, `total_effected`, `total_support`, `total_participants`, `current_participants`, `is_active`, `indian_locations_id`, `effective_location`, `show_success_rate`, `data_on_screen`, `created_at`) VALUES
(2, 3, 'Katariya ji ko fansane ke virodh main', 'KT4CONG', '2013-05-20 00:00:00', 500000, NULL, NULL, NULL, 1, 2, 'Rajasthan Whole', NULL, 'Total Online Participants', '2013-05-19 22:47:16');

-- --------------------------------------------------------

--
-- Table structure for table `indian_locations`
--

CREATE TABLE IF NOT EXISTS `indian_locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `indian_locations`
--

INSERT INTO `indian_locations` (`id`, `name`) VALUES
(1, 'India Complate'),
(2, 'Rajasthan'),
(3, 'Delhi'),
(4, 'UP');

-- --------------------------------------------------------

--
-- Table structure for table `participant`
--

CREATE TABLE IF NOT EXISTS `participant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `mobile_no` varchar(45) DEFAULT NULL,
  `ActivationCode` varchar(45) DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT NULL,
  `is_participant` tinyint(4) DEFAULT NULL,
  `joined_at` datetime DEFAULT NULL,
  `last_participated_till` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_participent_event1` (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sms`
--

CREATE TABLE IF NOT EXISTS `sms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mobile_no` varchar(45) DEFAULT NULL,
  `creator_id` int(11) DEFAULT NULL,
  `participant_id` int(11) DEFAULT NULL,
  `is_to_participant` tinyint(4) DEFAULT NULL,
  `message` text,
  PRIMARY KEY (`id`),
  KEY `fk_sms_creator1` (`creator_id`),
  KEY `fk_sms_participant1` (`participant_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `fk_event_creator` FOREIGN KEY (`creator_id`) REFERENCES `creator` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_event_indian_locations1` FOREIGN KEY (`indian_locations_id`) REFERENCES `indian_locations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `participant`
--
ALTER TABLE `participant`
  ADD CONSTRAINT `fk_participent_event1` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sms`
--
ALTER TABLE `sms`
  ADD CONSTRAINT `fk_sms_creator1` FOREIGN KEY (`creator_id`) REFERENCES `creator` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_sms_participant1` FOREIGN KEY (`participant_id`) REFERENCES `participant` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
