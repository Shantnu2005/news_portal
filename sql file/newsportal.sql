-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2025 at 12:04 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newsportal`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `id` int(11) NOT NULL,
  `AdminUserName` varchar(255) DEFAULT NULL,
  `AdminPassword` varchar(255) DEFAULT NULL,
  `AdminEmailId` varchar(255) DEFAULT NULL,
  `userType` int(11) DEFAULT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`id`, `AdminUserName`, `AdminPassword`, `AdminEmailId`, `userType`, `CreationDate`, `UpdationDate`) VALUES
(1, 'admin', 'f925916e2754e5e03f75dd58a5733251', 'phpgurukulofficial@gmail.com', 1, '2024-01-09 18:30:00', '2024-01-31 05:42:52'),
(3, 'subadmin', 'f925916e2754e5e03f75dd58a5733251', 'sudamin@gmail.in', 0, '2024-01-09 18:30:00', '2024-01-31 05:43:01'),
(4, 'suadmin2', 'f925916e2754e5e03f75dd58a5733251', 'sbadmin@test.com', 0, '2024-01-09 18:30:00', '2024-01-31 05:43:01');

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `id` int(11) NOT NULL,
  `CategoryName` varchar(200) DEFAULT NULL,
  `Description` mediumtext DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `Is_Active` int(1) DEFAULT NULL,
  `photo` longblob DEFAULT NULL,
  `Image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`id`, `CategoryName`, `Description`, `PostingDate`, `UpdationDate`, `Is_Active`, `photo`, `Image`) VALUES
(13, 'Politics', 'Covers national and international political news, government policies, elections, and diplomatic relations.', '2025-03-15 20:15:31', NULL, 1, NULL, 'uploads/category_images/360_F_383262947_guuIGJvjy6cvB0XjbprVZ48wAHWMboS7.jpg'),
(14, 'Business & Economy', 'Focuses on market trends, stock updates, corporate news, trade policies, and economic developments.', '2025-03-15 20:21:54', NULL, 1, NULL, 'uploads/category_images/group-discussion-topics-on-business-and-economy.png'),
(15, 'Sports', 'Sports news', '2025-03-27 06:59:05', NULL, 1, NULL, 'uploads/category_images/360_F_278427683_zeS9ihPAO61QhHqdU1fOaPk2UClfgPcW.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tblcomments`
--

CREATE TABLE `tblcomments` (
  `id` int(11) NOT NULL,
  `postId` int(11) DEFAULT NULL,
  `name` varchar(120) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `comment` mediumtext DEFAULT NULL,
  `postingDate` timestamp NULL DEFAULT current_timestamp(),
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblpages`
--

CREATE TABLE `tblpages` (
  `id` int(11) NOT NULL,
  `PageName` varchar(200) DEFAULT NULL,
  `PageTitle` mediumtext DEFAULT NULL,
  `Description` longtext DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblpages`
--

INSERT INTO `tblpages` (`id`, `PageName`, `PageTitle`, `Description`, `PostingDate`, `UpdationDate`) VALUES
(1, 'aboutus', 'About News Portal', '<p style=\"color: #ffffff; font-family: \'Mercury SSm A\', \'Mercury SSm B\', Georgia, Times, \'Times New Roman\', \'Microsoft YaHei New\', \'Microsoft Yahei\', SimSun, serif; font-size: 26px;\">\r\n    Welcome to News Portal, your one-stop destination for staying informed and up-to-date with the latest news and developments from around the world.<br>\r\n\r\n    At <span style=\"color: #ffffff;\">News Portal</span>, we understand the importance of reliable and timely information in today\'s fast-paced world. Our team of dedicated journalists and editors work tirelessly to bring you the most relevant and engaging stories from a variety of sources, ensuring that you are always well-informed on the issues that matter most to you.<br>\r\n\r\n    Whether you\'re interested in politics, sports, entertainment, technology, or business, you\'ll find it all here on <span style=\"color: #ffffff;\">News Portal</span>. Our user-friendly interface makes it easy to navigate through the latest headlines, explore in-depth articles, and discover new perspectives on the events shaping our world.<br>\r\n\r\n    But <span style=\"color: #ffffff;\">News Portal</span> is more than just a news website – it\'s a community of curious minds and engaged citizens who come together to discuss, debate, and share ideas. We believe in the power of journalism to inspire change and foster understanding, and we\'re committed to providing a platform where voices from all walks of life can be heard.<br>\r\n\r\n    Join us on our mission to inform, inspire, and empower. Together, we can make a difference.\r\n</p>\r\n', '2024-01-14 18:30:00', '2025-03-27 11:02:43'),
(2, 'contactus', 'Contact Details', '<p><br></p><p><b>Address :&nbsp; </b>New Delhi India</p><p><b>Phone Number : </b>+91 -01234567890</p><p><b>Email -id : </b>phpgurukulofficial@gmail.com</p>', '2024-01-15 18:30:00', '2024-01-31 05:44:24');

-- --------------------------------------------------------

--
-- Table structure for table `tblposts`
--

CREATE TABLE `tblposts` (
  `id` int(11) NOT NULL,
  `PostTitle` longtext DEFAULT NULL,
  `CategoryId` int(11) DEFAULT NULL,
  `SubCategoryId` int(11) DEFAULT NULL,
  `PostDetails` longtext CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `Is_Active` int(1) DEFAULT NULL,
  `PostUrl` mediumtext DEFAULT NULL,
  `PostImage` varchar(255) DEFAULT NULL,
  `viewCounter` int(11) DEFAULT NULL,
  `postedBy` varchar(255) DEFAULT NULL,
  `lastUpdatedBy` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblposts`
--

INSERT INTO `tblposts` (`id`, `PostTitle`, `CategoryId`, `SubCategoryId`, `PostDetails`, `PostingDate`, `UpdationDate`, `Is_Active`, `PostUrl`, `PostImage`, `viewCounter`, `postedBy`, `lastUpdatedBy`) VALUES
(15, ' Virat Kohli Leads RCB to Victory in IPL 2025 Opener', 15, 25, '<p data-start=\"188\" data-end=\"487\" class=\"\">Virat Kohli showcased his brilliance in the IPL 2025 opener, leading Royal Challengers Bengaluru (RCB) to a convincing 7-wicket victory over Kolkata Knight Riders (KKR). Kohli played an unbeaten knock of 59 runs and partnered with Phil Salt, who contributed 56 runs, forming a crucial 95-run stand.</p><p data-start=\"489\" data-end=\"510\" class=\"\"><strong data-start=\"489\" data-end=\"508\">Key Highlights:</strong></p><ul data-start=\"511\" data-end=\"693\">\r\n<li data-start=\"511\" data-end=\"566\" class=\"\">\r\n<p data-start=\"513\" data-end=\"566\" class=\"\">Kohli’s unbeaten 59 anchored RCB’s chase with ease.</p>\r\n</li>\r\n<li data-start=\"567\" data-end=\"628\" class=\"\">\r\n<p data-start=\"569\" data-end=\"628\" class=\"\">Phil Salt’s explosive 56 provided the necessary momentum.</p>\r\n</li>\r\n<li data-start=\"629\" data-end=\"693\" class=\"\">\r\n<p data-start=\"631\" data-end=\"693\" class=\"\">RCB’s strategy against CSK’s spinners is the next focus point.</p>\r\n</li>\r\n</ul><p data-start=\"695\" data-end=\"939\" class=\"\">Off the field, Kohli grabbed attention with his uncanny resemblance to a Turkish actor, drawing humorous comparisons from fans referencing Anushka Sharma’s film <em data-start=\"856\" data-end=\"877\">Rab Ne Bana Di Jodi</em>. Kohli remains a crowd favorite, both on and off the field.</p><p>\r\n\r\n\r\n\r\n</p><p data-start=\"941\" data-end=\"1010\" class=\"\">Stay tuned for RCB’s next encounter against Chennai Super Kings! ??</p>', '2020-03-18 07:22:28', '2021-03-18 07:45:48', 1, '-Virat-Kohli-Leads-RCB-to-Victory-in-IPL-2025-Opener', 'd3950afd92242152477b795a793c14bfjpeg', 3, 'admin', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblsubcategory`
--

CREATE TABLE `tblsubcategory` (
  `SubCategoryId` int(11) NOT NULL,
  `CategoryId` int(11) DEFAULT NULL,
  `Subcategory` varchar(255) DEFAULT NULL,
  `SubCatDescription` mediumtext DEFAULT NULL,
  `Image` varchar(255) NOT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `Is_Active` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblsubcategory`
--

INSERT INTO `tblsubcategory` (`SubCategoryId`, `CategoryId`, `Subcategory`, `SubCatDescription`, `Image`, `PostingDate`, `UpdationDate`, `Is_Active`) VALUES
(25, 15, 'Cricket', 'Cricket news', 'uploads/subcategory_images/2604895.jpg', '2025-03-27 07:03:23', NULL, 1),
(26, 15, 'Kabaddi', 'Kabaddi news', 'uploads/subcategory_images/Pro-Kabaddi-2018-Bengaluru-Bulls-Riders-defenders-all-rounders.jpg', '2025-03-27 07:05:16', NULL, 1),
(27, 15, 'Football', 'Football news', 'uploads/subcategory_images/7e186ce3aa6bfb53f2cb27e084dd0759.jpg', '2025-03-27 07:13:56', NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `AdminUserName` (`AdminUserName`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcomments`
--
ALTER TABLE `tblcomments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `postId` (`postId`);

--
-- Indexes for table `tblpages`
--
ALTER TABLE `tblpages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblposts`
--
ALTER TABLE `tblposts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `postcatid` (`CategoryId`),
  ADD KEY `postsucatid` (`SubCategoryId`),
  ADD KEY `subadmin` (`postedBy`);

--
-- Indexes for table `tblsubcategory`
--
ALTER TABLE `tblsubcategory`
  ADD PRIMARY KEY (`SubCategoryId`),
  ADD KEY `catid` (`CategoryId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tblcomments`
--
ALTER TABLE `tblcomments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblpages`
--
ALTER TABLE `tblpages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblposts`
--
ALTER TABLE `tblposts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tblsubcategory`
--
ALTER TABLE `tblsubcategory`
  MODIFY `SubCategoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblcomments`
--
ALTER TABLE `tblcomments`
  ADD CONSTRAINT `pid` FOREIGN KEY (`postId`) REFERENCES `tblposts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblposts`
--
ALTER TABLE `tblposts`
  ADD CONSTRAINT `postcatid` FOREIGN KEY (`CategoryId`) REFERENCES `tblcategory` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `postsucatid` FOREIGN KEY (`SubCategoryId`) REFERENCES `tblsubcategory` (`SubCategoryId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `subadmin` FOREIGN KEY (`postedBy`) REFERENCES `tbladmin` (`AdminUserName`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblsubcategory`
--
ALTER TABLE `tblsubcategory`
  ADD CONSTRAINT `catid` FOREIGN KEY (`CategoryId`) REFERENCES `tblcategory` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
