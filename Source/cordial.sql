-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2017 at 03:33 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cordial`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `date_posted` date NOT NULL,
  `content` text CHARACTER SET utf32 COLLATE utf32_bin NOT NULL,
  `image_link` tinytext COMMENT 'NULL for no image, otherwise, a valid image URL must be specified',
  `in_reply_to` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `date_posted`, `content`, `image_link`, `in_reply_to`, `user_id`, `post_id`) VALUES
(2, '2017-06-15', 'you did me a concern fren', NULL, 0, 1, 17),
(3, '2017-06-15', 'test reply', NULL, 2, 1, 17),
(4, '2017-06-15', 'bork', 'https://lh3.googleusercontent.com/0WExMf-zzMwD2qWrbNy0KpNBD5IKuJ5y0Ib0n00_ykiWmHAizguQe1kOt_LIYIQP9A=w300', 0, 1, 17),
(5, '2017-06-15', 'heck you did me the real big frighten\r\n', NULL, 0, 1, 17),
(6, '2017-06-15', '.', 'http://i3.kym-cdn.com/photos/images/newsfeed/001/037/338/2a1.png', 0, 1, 17),
(13, '2017-06-15', '.', 'https://media.giphy.com/media/l0ErG4swoqcfSVvEs/giphy.gif', 4, 1, 17),
(22, '2017-06-15', 'm8 that\'s a lighthouse', NULL, 12, 1, 17),
(23, '2017-06-15', 'THIS POST IS GAY', NULL, 0, 6, 17),
(25, '2017-06-15', 'test\'\'\'\'', NULL, 13, 1, 17),
(27, '2017-06-15', 'here is a meme for u', 'https://media.giphy.com/media/l0ErG4swoqcfSVvEs/giphy.gif', 0, 8, 17),
(28, '2017-06-15', 'thamk u for an meme', NULL, 27, 1, 17),
(29, '2017-06-15', 'You\'re gay', NULL, 23, 1, 17),
(30, '2017-06-15', 'i like this one', 'http://biblical-blue.com/images/products/thread.jpg', 0, 6, 19),
(31, '2017-06-15', 'Why', NULL, 30, 1, 19),
(32, '2017-06-15', 'WHY Do you LIKE htat thread', 'http://img.clipartall.com/question-mark-clip-art-to-download-2-clipart-question-mark-513_579.jpg', 30, 1, 19),
(33, '2017-06-15', 'because it\'s religious', 'http://media.salemwebnetwork.com/cms/CW/faith/38222-cross-sunrise-1200.1200w.tn.jpg', 32, 6, 19),
(35, '2017-06-15', 'Fidget', 'https://i5.walmartimages.com/asr/7d33a628-5ac9-4568-b3d8-a7e68d518e76_1.7f938887b584cf46a8439c9eb8339a77.jpeg?odnHeight=450&amp;odnWidth=450&amp;odnBg=FFFFFF', 0, 1, 21),
(36, '2017-06-16', 'YOU SUCK BOOOO', NULL, 0, 1, 24),
(37, '2017-06-16', '\'ello **_threre_** bo**yo**', NULL, 0, 1, 25),
(38, '2017-06-16', 'NO you do', NULL, 36, 1, 24),
(39, '2017-06-17', 'test', NULL, 0, 1, 24),
(41, '2017-06-19', '**Hello, world**', NULL, 0, 6, 25),
(42, '2017-06-19', '..........', NULL, 41, 6, 25),
(43, '2017-06-19', 'dog', 'https://i.ytimg.com/vi/nomNd-1zBl8/maxresdefault.jpg', 0, 1, 24);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'from `users`',
  `date_posted` date NOT NULL,
  `category` set('swar','hwar','gdev','wdev','sci','meme','pics','pols','rand','meta') NOT NULL,
  `title` tinytext NOT NULL,
  `content` text NOT NULL,
  `likes` int(11) NOT NULL DEFAULT '0',
  `views` int(11) NOT NULL DEFAULT '0',
  `pinned` tinyint(1) NOT NULL COMMENT 'pinned posts stick at the top of the post list'
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `date_posted`, `category`, `title`, `content`, `likes`, `views`, `pinned`) VALUES
(24, 1, '2017-06-16', 'hwar', 'Kewl title', '```\r\ncodeTest();\r\n\r\nwhile (true) {\r\n  print(\"Cool\")\r\n}\r\n```\r\n\r\n```\r\nTestttt!!\r\n```\r\n\r\n# Hello, world!', 2, 0, 0),
(25, 1, '2017-06-16', 'swar', 'code', 'well hello **right there** *boyo*\r\n```\r\ntest();\r\n```', 3, 0, 0),
(26, 1, '2017-06-18', 'swar', 'Test', 'test', 1, 0, 0),
(28, 1, '2017-06-18', 'sci', 'ttt', 'tttt', 1, 0, 0),
(29, 1, '2017-06-18', 'sci', 'test', 'test', 0, 0, 0),
(33, 1, '2017-06-21', 'wdev', 'test', 'new', 1, 0, 0),
(34, 1, '2017-06-21', 'swar', 'dwdjiowad', 'awdwad', 2, 0, 0),
(35, 1, '2017-06-21', 'meta', 'AJAX', 'AJAX', 0, 0, 0),
(36, 7, '2017-06-21', 'swar', 'new', 'ddd', 0, 0, 0),
(37, 1, '2017-06-22', 'meta', 'A pinned post', 'This is pinned to the top of the page', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` tinytext CHARACTER SET ascii NOT NULL,
  `password` tinytext NOT NULL COMMENT 'SHA-256',
  `date_joined` date NOT NULL,
  `is_admin` tinyint(1) NOT NULL COMMENT '0 = false, nonzero = true',
  `bio` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `date_joined`, `is_admin`, `bio`) VALUES
(1, 'j4cobgarby', '2b20198fafa67b9232800e2cfaefa7b3be61cfe2662281a1d0b004aca1291235', '2017-06-11', 1, 'The first/main developer of Cordial &lt;b&gt;Test&lt;/b&gt;'),
(2, 'user2', '2b20198fafa67b9232800e2cfaefa7b3be61cfe2662281a1d0b004aca1291235', '2017-06-11', 0, ''),
(3, 'user3', '2b20198fafa67b9232800e2cfaefa7b3be61cfe2662281a1d0b004aca1291235', '2017-06-11', 0, ''),
(4, 'user4', '2b20198fafa67b9232800e2cfaefa7b3be61cfe2662281a1d0b004aca1291235', '2017-06-11', 0, ''),
(6, 'zacg', '9970626666560a32465d4ce10d28f3233365af833e15eed59884d9477862c379', '2017-06-14', 0, '** Hello, world **'),
(7, 'jacoob', '2b20198fafa67b9232800e2cfaefa7b3be61cfe2662281a1d0b004aca1291235', '2017-06-15', 0, 'j4cobgarby\'s secondary account'),
(8, 'cordialmemesupplycrate', '9970626666560a32465d4ce10d28f3233365af833e15eed59884d9477862c379', '2017-06-15', 0, ''),
(9, 'WWWWWWWWWWWWWWWWWWWWWWWWW', '2b20198fafa67b9232800e2cfaefa7b3be61cfe2662281a1d0b004aca1291235', '2017-06-18', 0, ''),
(10, 'newaccount', '9970626666560a32465d4ce10d28f3233365af833e15eed59884d9477862c379', '2017-06-19', 0, ''),
(11, '18jasdenifa', 'b7eeb5e5fd0dda8d4994e1291af18433987b73c5021cede4f35cdf8d9e66058a', '2017-06-19', 0, ''),
(26, 'aguy', '2b20198fafa67b9232800e2cfaefa7b3be61cfe2662281a1d0b004aca1291235', '2017-06-20', 0, ''),
(27, 'testingpriv', '2b20198fafa67b9232800e2cfaefa7b3be61cfe2662281a1d0b004aca1291235', '2017-06-20', 0, ''),
(28, 'test', '2b20198fafa67b9232800e2cfaefa7b3be61cfe2662281a1d0b004aca1291235', '2017-06-20', 0, ''),
(29, 'testguy', '2b20198fafa67b9232800e2cfaefa7b3be61cfe2662281a1d0b004aca1291235', '2017-06-20', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `user_liked_posts`
--

CREATE TABLE `user_liked_posts` (
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

--
-- Dumping data for table `user_liked_posts`
--

INSERT INTO `user_liked_posts` (`user_id`, `post_id`) VALUES
(9, 32),
(9, 31),
(6, 30),
(6, 25),
(1, 30),
(1, 27),
(1, 33),
(1, 34),
(1, 28),
(1, 26),
(7, 25),
(7, 24),
(7, 34),
(1, 25),
(1, 24);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `comment_id` (`in_reply_to`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `USER` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_liked_posts`
--
ALTER TABLE `user_liked_posts`
  ADD KEY `USER_INDEX` (`user_id`),
  ADD KEY `POST_INDEX` (`post_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
