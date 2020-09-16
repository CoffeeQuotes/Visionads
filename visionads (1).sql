-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 19, 2018 at 08:48 AM
-- Server version: 5.7.19
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `visionads`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_user`
--

DROP TABLE IF EXISTS `admin_user`;
CREATE TABLE IF NOT EXISTS `admin_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL DEFAULT '0',
  `password` varchar(200) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COMMENT='Admin User Table';

--
-- Dumping data for table `admin_user`
--

INSERT INTO `admin_user` (`id`, `username`, `password`, `created_at`) VALUES
(2, 'voodoo', '$2y$10$3b0INOyJ58vaBn5dI7m.K.T9bE70TGjPsZA9nSsVjq545MIMUe6zu', '2018-03-13 05:23:56'),
(3, 'shishir', '$2y$10$BCMQnbJy1zozIg5midmA1eXPCdMJABhM3ZqpHdcuzMegLBX1glvFS', '2018-03-13 05:32:46');

-- --------------------------------------------------------

--
-- Table structure for table `campaigns`
--

DROP TABLE IF EXISTS `campaigns`;
CREATE TABLE IF NOT EXISTS `campaigns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(200) NOT NULL DEFAULT '0',
  `url` varchar(200) NOT NULL DEFAULT '0',
  `region` varchar(100) NOT NULL DEFAULT 'World Wide',
  `target` varchar(100) NOT NULL DEFAULT 'Smartphone Android',
  `status` enum('Pending','Disapproved','Approved') NOT NULL DEFAULT 'Pending',
  `description` text NOT NULL,
  `campaign_budget` decimal(10,0) NOT NULL DEFAULT '10',
  PRIMARY KEY (`id`),
  KEY `FK_campaigns_users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 COMMENT='Campiagn Table';

--
-- Dumping data for table `campaigns`
--

INSERT INTO `campaigns` (`id`, `user_id`, `title`, `url`, `region`, `target`, `status`, `description`, `campaign_budget`) VALUES
(1, 3, 'Test Again', 'http://www.test.com', 'World Wide', 'Smartphone Android', 'Disapproved', 'Hello Test', '30'),
(2, 3, 'New', 'http://www.zero.com/zero', 'World Wide', 'Smartphone Android', 'Approved', 'New Campaign', '20'),
(3, 3, 'Test No Two', 'http://www.test.com/test', 'World Wide', 'Smartphone Android', 'Approved', 'It\'s not important', '40'),
(5, 3, 'Voodoo', 'http://www.magick.com/voodoo', 'World Wide', 'Smartphone Android', 'Pending', 'My Voodoo Magick', '20'),
(7, 3, 'Hello', 'http://www.test.com', 'Andorra', 'Windows', 'Pending', 'hello test again', '20'),
(10, 3, 'Hello World', 'http://www.test.com', 'Azerbaijan', 'Mac', 'Pending', 'jas', '20'),
(11, 3, 'cnew', 'htttp://www.foryou.com', 'Andorra', 'Smartphone Android', 'Pending', 'dsadjl', '122');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL DEFAULT '0',
  `email` varchar(255) NOT NULL DEFAULT '0',
  `password` varchar(100) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COMMENT='User Tables';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(3, 'shishir', 'sky8052785942ocean@gmail.com', '$2y$10$urEvW3NjNdV33DaNxusIzuUMPIfV.cJmEe3NLS689esCKouUt.0xC', '2018-03-11 10:53:17'),
(4, 'user', 'sky@sky.com', '$2y$10$RldgyQ7X5Mfc8TAUgfRlx.vs2l2RiMd/TszcCSVOJ6vY.vWrNB9Wi', '2018-03-17 10:44:33');

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

DROP TABLE IF EXISTS `wallets`;
CREATE TABLE IF NOT EXISTS `wallets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `amount` decimal(10,0) NOT NULL DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_wallets_users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COMMENT='user wallets';

--
-- Dumping data for table `wallets`
--

INSERT INTO `wallets` (`id`, `user_id`, `amount`, `timestamp`) VALUES
(1, 3, '380', '2018-03-12 04:29:34');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `campaigns`
--
ALTER TABLE `campaigns`
  ADD CONSTRAINT `FK_campaigns_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `wallets`
--
ALTER TABLE `wallets`
  ADD CONSTRAINT `FK_wallets_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
