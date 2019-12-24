-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2019 at 04:51 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projects_scegroup`
--

-- --------------------------------------------------------

--
-- Table structure for table `sceg_admin`
--

CREATE TABLE `sceg_admin` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `mail_id` varchar(350) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `password` varchar(350) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sceg_admin`
--

INSERT INTO `sceg_admin` (`id`, `name`, `mail_id`, `mobile`, `password`, `status`, `created`) VALUES
(1, 'Administrator', 'admin@gmail.com', 9876543210, 'admin@123', 1, '2019-09-13 17:31:58');

-- --------------------------------------------------------

--
-- Table structure for table `sceg_site_details`
--

CREATE TABLE `sceg_site_details` (
  `id` int(11) NOT NULL,
  `site_name` varchar(350) NOT NULL,
  `site_url` varchar(350) NOT NULL,
  `site_logo` text NOT NULL,
  `site_favicon` varchar(250) DEFAULT NULL,
  `address` text NOT NULL,
  `state` varchar(350) NOT NULL,
  `city` varchar(350) NOT NULL,
  `pincode` int(6) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `email_id` varchar(350) NOT NULL,
  `facebook` text DEFAULT NULL,
  `twitter` text DEFAULT NULL,
  `instagram` text DEFAULT NULL,
  `linkedin` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sceg_site_details`
--

INSERT INTO `sceg_site_details` (`id`, `site_name`, `site_url`, `site_logo`, `site_favicon`, `address`, `state`, `city`, `pincode`, `mobile`, `email_id`, `facebook`, `twitter`, `instagram`, `linkedin`, `status`, `created`, `updated`) VALUES
(1, 'scegroup', 'scegroup.in', 'uploads/sitedetails/logo.png', 'uploads/sitedetails/58766f0dc697c1c66e7df771b357c524.png', 'Mainroad,Lakshmipuram', 'Andhrapradesh', 'Guntur', 522415, '9876543210', 'info@scegroup.in', 'http://facebook.com', 'http://twitter.com', 'http://instagram.com', 'http://linkedin.com', 1, '2019-12-23 05:16:42', '2019-12-23 05:48:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sceg_admin`
--
ALTER TABLE `sceg_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sceg_site_details`
--
ALTER TABLE `sceg_site_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sceg_admin`
--
ALTER TABLE `sceg_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sceg_site_details`
--
ALTER TABLE `sceg_site_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
