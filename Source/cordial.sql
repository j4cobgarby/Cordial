-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2017 at 02:09 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'from `users`',
  `date_posted` date NOT NULL,
  `category` set('swar','hwar','gdev','wdev','meme','pics','pols','rand','meta') NOT NULL,
  `title` tinytext NOT NULL,
  `content` text NOT NULL,
  `likes` int(11) NOT NULL DEFAULT '0',
  `views` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

INSERT INTO `posts` (`post_id`, `user_id`, `date_posted`, `category`, `title`, `content`, `likes`, `views`) VALUES
(1, 1, '2017-06-04', 'meta', 'Jacob\'s first post!', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec pharetra purus id imperdiet iaculis. Phasellus nunc magna, vestibulum id massa et, ornare iaculis purus. Nunc tristique massa vel ante ultricies placerat. In suscipit, nunc in finibus varius, tortor lorem feugiat nisi, ut viverra lacus leo nec purus. Nam molestie sagittis dolor vitae mollis. Donec pretium suscipit aliquam. Curabitur ac cursus leo. Ut vestibulum arcu a vestibulum eleifend. In dignissim sapien et lacus iaculis, ac ornare neque luctus. Vestibulum a tortor vitae elit vulputate cursus. Phasellus bibendum metus dui, at volutpat ex ornare ac. Proin venenatis mauris et nunc hendrerit dictum.<br><br>Suspendisse sed metus ipsum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec ullamcorper orci id leo ullamcorper auctor. Pellentesque ultricies id ex in rutrum. Pellentesque vitae scelerisque enim. Nam eget sodales ante. Etiam et ante eu nisi pellentesque porta. Nam ultricies elit eu leo sagittis, id commodo tortor tincidunt. Nullam suscipit porttitor est, a ornare elit posuere in. Curabitur dictum lobortis efficitur. Cras hendrerit consequat purus id rhoncus.<br><br>Pellentesque mi lectus, condimentum in ultrices vel, porta vitae leo. Duis condimentum bibendum ligula sit amet molestie. Etiam non ex sit amet nisi commodo vestibulum in vel mi. Aliquam ullamcorper, turpis ac rutrum dictum, orci libero tincidunt sem, id ullamcorper enim odio nec odio. Suspendisse potenti. Nulla facilisi. Duis in tellus sagittis, posuere massa quis, lacinia orci.<br><br>Morbi non posuere metus, eget aliquet justo. In eu convallis justo. Curabitur convallis tellus sed est ultrices dictum. Vivamus felis massa, aliquet eget erat ut, imperdiet imperdiet nunc. Nunc tempor porta diam, id lacinia turpis dignissim sit amet. Interdum et malesuada fames ac ante ipsum primis in faucibus. Maecenas non varius dolor. Donec ut orci nisl. Proin eget cursus ex. Vestibulum venenatis scelerisque bibendum. Cras volutpat, leo sit amet maximus pretium, ligula diam lacinia purus, nec tempus augue nunc sed leo. Aliquam sed ullamcorper mi. Ut blandit turpis id dui scelerisque suscipit. Phasellus consequat urna ac leo congue blandit. Aenean interdum ex sit amet erat fermentum egestas. Etiam consectetur mauris sit amet pretium tempus.<br><br>Vestibulum id massa purus. Pellentesque et bibendum nunc. Integer venenatis malesuada nisi consequat vestibulum. Aliquam finibus mattis velit, a dignissim risus porta eget. Morbi feugiat placerat malesuada. Nullam a mauris erat. Aliquam erat volutpat. Sed vel enim ornare, ultricies tortor ut, congue enim. Morbi at fermentum mauris. Ut vitae ante eleifend, vehicula justo sit amet, feugiat sapien.<br><br>Proin tristique volutpat finibus. Ut et luctus sem. Sed auctor gravida venenatis. Etiam sed lectus egestas, viverra tellus at, porta nulla. Quisque ante augue, tincidunt sed elit non, consectetur scelerisque lorem. Etiam elementum enim dignissim tempor aliquam. Nam faucibus pulvinar mi, auctor auctor mauris accumsan vulputate. Donec tempor leo sit amet eleifend auctor.<br><br>Suspendisse iaculis mi eu neque condimentum, nec imperdiet erat consectetur. Sed et fringilla tellus, vitae cursus felis. Nulla nec ex quis ipsum placerat pulvinar. Aenean molestie tincidunt ex eget vehicula. Vestibulum mattis vehicula lacinia. Curabitur et augue velit. Nam commodo, ante vel rutrum efficitur, arcu risus aliquet lorem, at tristique leo ipsum et velit.<br><br>Donec rutrum nulla non mi laoreet, sit amet tincidunt ex mattis. Quisque auctor risus vel nisl dictum, id interdum dolor maximus. Aliquam ac ultricies ligula. Morbi ac tincidunt ligula, non faucibus massa. Pellentesque id odio ex. Nunc venenatis arcu turpis, porttitor gravida quam tempus a. Morbi vulputate eros turpis, in finibus metus volutpat quis. Nullam justo neque, finibus a dapibus at, convallis non libero. Curabitur non sapien quis turpis imperdiet ornare vitae ut felis. Sed egestas euismod turpis non feugiat.<br><br>Vivamus pretium tempor nisi a vestibulum. Suspendisse ut ligula nisi. Sed vel efficitur quam. Proin eu lorem ac sed.', 0, 0),
(2, 3, '2017-06-04', 'rand', 'A test post.', 'Test post one', 0, 0),
(3, 1, '2017-06-05', 'swar', 'Something to do with software....', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec pharetra purus id imperdiet iaculis. Phasellus nunc magna, vestibulum id massa et, ornare iaculis purus. Nunc tristique massa vel ante ultricies placerat. In suscipit, nunc in finibus varius, tortor lorem feugiat nisi, ut viverra lacus leo nec purus. Nam molestie sagittis dolor vitae mollis. Donec pretium suscipit aliquam. Curabitur ac cursus leo. Ut vestibulum arcu a vestibulum eleifend. In dignissim sapien et lacus iaculis, ac ornare neque luctus. Vestibulum a tortor vitae elit vulputate cursus. Phasellus bibendum metus dui, at volutpat ex ornare ac. Proin venenatis mauris et nunc hendrerit dictum.<br><br>Suspendisse sed metus ipsum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec ullamcorper orci id leo ullamcorper auctor. Pellentesque ultricies id ex in rutrum. Pellentesque vitae scelerisque enim. Nam eget sodales ante. Etiam et ante eu nisi pellentesque porta. Nam ultricies elit eu leo sagittis, id commodo tortor tincidunt. Nullam suscipit porttitor est, a ornare elit posuere in. Curabitur dictum lobortis efficitur. Cras hendrerit consequat purus id rhoncus.<br><br>Pellentesque mi lectus, condimentum in ultrices vel, porta vitae leo. Duis condimentum bibendum ligula sit amet molestie. Etiam non ex sit amet nisi commodo vestibulum in vel mi. Aliquam ullamcorper, turpis ac rutrum dictum, orci libero tincidunt sem, id ullamcorper enim odio nec odio. Suspendisse potenti. Nulla facilisi. Duis in tellus sagittis, posuere massa quis, lacinia orci.<br><br>Morbi non posuere metus, eget aliquet justo. In eu convallis justo. Curabitur convallis tellus sed est ultrices dictum. Vivamus felis massa, aliquet eget erat ut, imperdiet imperdiet nunc. Nunc tempor porta diam, id lacinia turpis dignissim sit amet. Interdum et malesuada fames ac ante ipsum primis in faucibus. Maecenas non varius dolor. Donec ut orci nisl. Proin eget cursus ex. Vestibulum venenatis scelerisque bibendum. Cras volutpat, leo sit amet maximus pretium, ligula diam lacinia purus, nec tempus augue nunc sed leo. Aliquam sed ullamcorper mi. Ut blandit turpis id dui scelerisque suscipit. Phasellus consequat urna ac leo congue blandit. Aenean interdum ex sit amet erat fermentum egestas. Etiam consectetur mauris sit amet pretium tempus', 0, 0);

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` tinytext CHARACTER SET ascii NOT NULL,
  `password` tinytext NOT NULL COMMENT 'Should probably be hashed',
  `date_joined` date NOT NULL,
  `is_admin` tinyint(1) NOT NULL COMMENT '1=true 0=false'
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

INSERT INTO `users` (`user_id`, `username`, `password`, `date_joined`, `is_admin`) VALUES
(1, 'j4cobgarby', 'Jacobg01', '2017-06-04', 1),
(2, 'testuser1', 'pass', '2017-06-04', 1),
(3, 'testuser2', 'pass', '2017-06-04', 0);

ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `USER` (`user_id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
