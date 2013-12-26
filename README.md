p4a.test-csie15.biz
===================

P4- Conflict Minerals Resources and community buz

Is an application built to bring awareness about conflict minerals.
The site has a mini twitter functionalities aspects where users can:
1. Login
2. Signup
3. Udpate Profile picture
4. Add/edit and Delete Posts
5. Follow/unfollow Friends.

Additionally as part of this new application - I added a conflict Mineral Device tool
For users to check if they have electronic devices that are manufactured by companies that do not follow
a strict supply chain process according to the Dodd-Frank US Law, that company must be able to trace the provenance
of all minerals sources to ensure that they have not be refined with conflict minerals.

The tool will render a score that is associated with the company. For each devices added - users are assigned an average score
that makes up their status as either green-yellow or red.

Known Bugg:
1. There is a caching issue. I have not been able to determine if browsers or php related.
2. You will need to refresh page to ensure that user status is not of the previous session.
3. At the time of this post - I fetched the HEAD file into my live environment creating insertion from GIT.
4. I am attempting to revert by creating a new Branch called your_branch.
5. Prior to the last minute git issue - all pages validated successfully :-)


Database structure

-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 23, 2013 at 05:17 AM
-- Server version: 5.5.29
-- PHP Version: 5.4.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `tessie_p4a_test-csie15_biz`
--

-- --------------------------------------------------------

--
-- Table structure for table `company_rankings`
--

CREATE TABLE `company_rankings` (
  `company_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) NOT NULL,
  `score` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`company_id`),
  UNIQUE KEY `company_name` (`company_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `company_rankings`
--

INSERT INTO `company_rankings` (`company_id`, `company_name`, `score`, `description`) VALUES
(1, 'Apple Inc.', 38, 'Apple products include laptops, digital music players, smartphones, and tablets.'),
(2, 'Motorola Mobility', 35, 'Motorola Mobility products include smart phones, mobile phones, tablets, DVD players, and modems. '),
(3, 'Intel', 60, 'Intel products include processors, chipsets, and motherboards.'),
(4, 'HP', 54, 'HP products include laptops, desktops, printers, smartphones, and cameras.'),
(5, 'Philips', 48, 'Philips products include televisions and home theater products.'),
(6, 'Acer', 40, 'Acer products include laptops, tablets, desktops, and projectors.'),
(7, 'Dell', 40, 'Dell products include laptops, desktops, printers, televisions, and projectors.'),
(8, 'Nokia', 35, 'Nokia products include mobile phones, smart phones, and laptops.'),
(9, 'IBM', 28, 'IBM products include software, printers, computers, and routers.'),
(10, 'LG', 27, 'LG products include televisions, projectors, Blu-ray products, mobile phones, washer-dryers, vacuums, and refrigerators.'),
(11, 'Samsung', 27, 'Samsung products include televisions, Blu-ray products, DVD players, smart phones, tablets, cameras, camcorders, and laptops.'),
(12, 'Lenovo', 17, 'Lenovo products include laptops, desktops, tablets, workstations, and webcams.'),
(13, 'Nintendo', 0, 'Nintendo products include videogames and videogame consoles.'),
(14, 'HTC', 4, 'HTC products include smartphones, cellphones, and tablets.'),
(15, 'Sharp', 8, 'Sharp products include televisions, Blu-ray products, DVD players, and calculators.'),
(16, 'Nikon', 8, 'Nikon products include cameras and lab equipment.'),
(17, 'Canon', 8, 'Canon products include cameras, camcorders, projectors, and printers.');

-- --------------------------------------------------------

--
-- Table structure for table `device_type`
--

CREATE TABLE `device_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `device_type`
--

INSERT INTO `device_type` (`id`, `name`) VALUES
(7, 'cameras'),
(2, 'cell phones'),
(9, 'desktop computers'),
(6, 'DVD player'),
(10, 'laptops'),
(3, 'mp3 players'),
(4, 'smartphones'),
(8, 'tablets'),
(1, 'TV'),
(5, 'video games, video consoles');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `created` int(11) NOT NULL,
  `modified` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  PRIMARY KEY (`post_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `created`, `modified`, `user_id`, `content`) VALUES
(3, 1387169357, 1387169520, 5, 'Very excited to hear about Conflict Minerals resources - there is something wrong about the site, I can''t follow other users?\r\n'),
(6, 1387170653, 1387170653, 2, 'VERY NICE DEVICE TOOL, KEEP IT UP'),
(7, 1387170746, 1387170746, 2, 'Where I can I follow more resources about these kinds things'),
(8, 1387388988, 1387388988, 1, 'I would like to try the Ajax features I just added'),
(9, 1387389375, 1387762204, 1, 'Hello World -2'),
(10, 1387389491, 1387389491, 1, 'Still testing database'),
(11, 1387389531, 1387389531, 1, 'still testing');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `created` int(11) NOT NULL,
  `modified` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_login` int(11) NOT NULL,
  `timezone` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `created`, `modified`, `token`, `password`, `last_login`, `timezone`, `location`, `first_name`, `last_name`, `email`, `image`) VALUES
(1, 1386536046, 1386536046, '5f871fe85eec732f5add81ce7d1f5416b77abe81', '5ac9bb69c20bf05a01d3c1627f66972ca0807de5', 0, '', '', 'Mark', 'Melhorn', 'ivan@gmail.com', '1.JPG'),
(2, 1386896648, 1386896648, '7e4f56fdc43bece68497e7b911253d499ec7f09a', '56d1c31698b4032a43962db09b6ae6de64a1dea9', 0, '', '', 'Isabelle', 'Silva', 'Isabelle@france.com', ''),
(3, 1387084557, 1387084557, 'a17fc7d69daf23d26cb150b2cb9e537a1195a2c9', '5ac9bb69c20bf05a01d3c1627f66972ca0807de5', 0, '', '', 'Mike', 'Safwat', 'mike.safwat@efxnews.com', ''),
(4, 1387168497, 1387168497, '168c85c822dd083192dcf9654b4d6306e9694f65', '56d1c31698b4032a43962db09b6ae6de64a1dea9', 0, '', '', 'Susan', 'Buck', 'susan@fas.harvard.edu', ''),
(5, 1387169115, 1387169115, '513e75e3c32291a47454566f16db9ef12eef5aec', '5ac9bb69c20bf05a01d3c1627f66972ca0807de5', 0, '', '', 'James', 'Bond', 'james.bond@gmail.com', ''),
(6, 1387409013, 1387409013, '8c463f984626eb5b758a21a5efedb60e16289457', '391b16b99bcf3a6a42be588fe844cfae48977111', 0, '', '', 'Dan', 'Mitchell', 'dan@gmail.com', ''),
(7, 1387493638, 1387493638, '5281a8fb2f4214e62875e6b2ad2ca8c0c1645cec', '5ac9bb69c20bf05a01d3c1627f66972ca0807de5', 0, '', '', 'carine', 'M', 'carine.melhorn@gmail.com', '7.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users_devices`
--

CREATE TABLE `users_devices` (
  `device_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'equivalent to serial number',
  `user_id` int(11) NOT NULL,
  `device_type_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  PRIMARY KEY (`device_id`),
  KEY `user_id` (`user_id`),
  KEY `device_type_name` (`device_type_id`),
  KEY `company_id` (`company_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=69 ;

--
-- Dumping data for table `users_devices`
--

INSERT INTO `users_devices` (`device_id`, `user_id`, `device_type_id`, `company_id`) VALUES
(7, 1, 1, 1),
(10, 3, 3, 2),
(11, 3, 1, 10),
(13, 1, 5, 13),
(15, 2, 9, 1),
(16, 1, 7, 16),
(17, 1, 5, 13),
(18, 1, 1, 10),
(19, 1, 9, 3),
(20, 1, 6, 15),
(25, 1, 3, 1),
(26, 1, 2, 1),
(27, 1, 9, 3),
(28, 1, 9, 3),
(29, 2, 5, 13),
(30, 2, 7, 16),
(31, 2, 9, 3),
(32, 2, 8, 3),
(33, 2, 2, 8),
(34, 3, 5, 13),
(36, 6, 7, 13),
(38, 1, 3, 8),
(39, 1, 8, 13),
(40, 1, 5, 13),
(41, 1, 5, 13),
(42, 1, 5, 13),
(43, 1, 7, 16),
(44, 1, 5, 13),
(45, 1, 9, 13),
(46, 1, 9, 13),
(47, 1, 5, 13),
(48, 1, 5, 13),
(49, 1, 5, 13),
(50, 1, 5, 13),
(51, 1, 2, 11),
(55, 1, 2, 13),
(57, 1, 9, 3),
(59, 1, 2, 13),
(60, 1, 7, 13),
(61, 1, 5, 13),
(62, 5, 7, 13),
(63, 5, 7, 16),
(64, 5, 5, 13),
(65, 5, 5, 11),
(66, 5, 9, 3),
(67, 2, 5, 13),
(68, 1, 10, 5);

-- --------------------------------------------------------

--
-- Table structure for table `users_users`
--

CREATE TABLE `users_users` (
  `user_user_id` int(11) NOT NULL AUTO_INCREMENT,
  `created` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_id_followed` int(11) NOT NULL,
  PRIMARY KEY (`user_user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `users_users`
--

INSERT INTO `users_users` (`user_user_id`, `created`, `user_id`, `user_id_followed`) VALUES
(3, 1387084665, 3, 1),
(12, 1387169966, 1, 3),
(13, 1387169967, 1, 4),
(14, 1387169969, 1, 5),
(17, 1387171330, 2, 1),
(18, 1387171331, 2, 2),
(19, 1387171333, 2, 3),
(20, 1387171334, 2, 4),
(21, 1387171335, 2, 5),
(22, 1387171390, 5, 1),
(23, 1387171391, 5, 2),
(24, 1387171391, 5, 3),
(25, 1387171392, 5, 4),
(26, 1387171394, 5, 5),
(27, 1387407529, 1, 1),
(28, 1387469211, 1, 2),
(29, 1387594480, 3, 4),
(30, 1387594482, 3, 5),
(31, 1387668199, 1, 6);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_devices`
--
ALTER TABLE `users_devices`
  ADD CONSTRAINT `users_devices_ibfk_3` FOREIGN KEY (`company_id`) REFERENCES `company_rankings` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_devices_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_devices_ibfk_5` FOREIGN KEY (`device_type_id`) REFERENCES `device_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_users`
--
ALTER TABLE `users_users`
  ADD CONSTRAINT `users_users_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

