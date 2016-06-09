-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2016 at 03:55 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbnewcms`
--

-- --------------------------------------------------------

--
-- Table structure for table `demos`
--

CREATE TABLE `demos` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `public` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `demos`
--

INSERT INTO `demos` (`id`, `title`, `content`, `public`) VALUES
(2, ' Letraset sheets containing', '<div class="lc" style="margin: 0px; font-size: 11px; clear: left; float: left; width: 348px; text-align: center;">\r\n<p style="text-align: justify; line-height: 14px; margin-bottom: 14px;"><strong style="font-family: Arial, Helvetica, sans;"><br />Lorem Ipsum</strong><span style="font-family: Arial, Helvetica, sans;">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ips</span><span style="color: #ff0000;">um has been the industry''s standar</span><span style="font-family: Arial, Helvetica, sans;">d dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>\r\n</div>', '2016-03-01'),
(5, '像をアッ像をアッ', '像をアッ像をアッ像をアッ像をアッ像をアッ像をアッ像をアッ像をアッ像をアッ像をアッ像をアッ像をアッ像をアッ像をアッ像をアッ像をアッ像をアッ像をアッ像をアッ像をアッ像をアッ像をアッ像をアッ像をアッ像をアッ像をアッ', '2016-03-01'),
(6, 'Mới th&ecirc;m', '&lt;p&gt;&lt;strong&gt;&lt;span style=&quot;font-size:14px&quot;&gt;b&amp;agrave;i viết n&amp;agrave;y&lt;/span&gt;&lt;/strong&gt; mới th&amp;ecirc;m n&amp;egrave;&amp;nbsp;&lt;/p&gt;\r\n', '2016-06-01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level` tinyint(3) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `level`) VALUES
(1, 'root', 'sha256:1000:pn4JYga2tJ/Ai1TwVO6bssskPhM/7P9W:dwv/8t3adoP0i2aVMCmkhuvuOLxNKOsN', 'root', 1),
(2, 'con', 'sha256:1000:ksGNJlxDFOvKuXFB3jxNc2E4yiCnfkuK:kjT2pwQ1pDzAWX19HvqmdaGLDW8nXPeG', 'chip', 0),
(9, 'nakanishi', 'sha256:1000:cBJhgQjf5LiEej4wiEwd4F5NEnUdR7Jb:UvEk24QuKqkkOZMS8GjmKllOz0OIiJ81', 'nakanishi', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `demos`
--
ALTER TABLE `demos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `demos`
--
ALTER TABLE `demos`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
