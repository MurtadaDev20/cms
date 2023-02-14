-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 14, 2023 at 12:37 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cate_id` int(11) NOT NULL,
  `category` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cate_id`, `category`) VALUES
(2, 'تعلم لغة php'),
(4, 'المقالات'),
(5, 'رياضة');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `com_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `comment` text NOT NULL,
  `status` text NOT NULL,
  `com_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`com_id`, `post_id`, `user_id`, `title`, `comment`, `status`, `com_date`) VALUES
(2, 6, 1, 'موضوع شيق ورائع', 'شكراً لك على هذا الطرح الجميل', 'published', '2016-04-01 : 06-33-59pm'),
(3, 6, 1, 'dgfads', 'adsgasfafva', 'published', '2016-04-01 : 06-51-59pm'),
(4, 10, 1, 'مقال جميل جدا', 'رائع جداً استمر في طرح المواضيع المفيدة', 'published', '2016-04-13 : 12-41-30pm'),
(5, 7, 5, 'fff', 'sdfsdfd', 'published', '2023-02-09 : 03-23-31pm'),
(6, 7, 5, 'fff', 'sdfsdfd', 'published', '2023-02-09 : 03-23-35pm'),
(7, 8, 5, 'df', 'fdddddddddddddddd', 'published', '2023-02-09 : 03-24-11pm'),
(8, 11, 6, 'dfgghg', 'gfgggggggg', 'dreft', '2023-02-09 : 04-02-09pm');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `post` longtext NOT NULL,
  `category` text NOT NULL,
  `image` text NOT NULL,
  `author` text NOT NULL,
  `status` text NOT NULL,
  `post_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `title`, `post`, `category`, `image`, `author`, `status`, `post_date`) VALUES
(3, 'ما هو لوريم ايبسوم ', '<div>\r\n<div class=\"rc\">\r\n<p dir=\"rtl\" style=\"text-align: justify;\">لوريم إيبسوم(Lorem Ipsum) هو ببساطة نص شكلي (بمعنى أن الغاية هي الشكل وليس المحتوى) ويُستخدم في صناعات المطابع ودور النشر. كان لوريم إيبسوم ولايزال المعيار للنص الشكلي منذ القرن الخامس عشر عندما قامت مطبعة مجهولة برص مجموعة من الأحرف بشكل عشوائي أخذتها من نص، لتكوّن كتيّب بمثابة دليل أو مرجع شكلي لهذه الأحرف. خمسة قرون من الزمن لم تقضي على هذا النص، بل انه حتى صار مستخدماً وبشكله الأصلي في الطباعة والتنضيد الإلكتروني. انتشر بشكل كبير في ستينيّات هذا القرن مع إصدار رقائق \"ليتراسيت\" (Letraset) البلاستيكية تحوي مقاطع من هذا النص، وعاد لينتشر مرة أخرى مؤخراَ مع ظهور برامج النشر الإلكتروني مثل \"ألدوس بايج مايكر\" (Aldus PageMaker) والتي حوت أيضاً على نسخ من نص لوريم إيبسوم.</p>\r\n</div>\r\n</div>', 'الأخبار', 'images/posts/post56eda15155e2f.jpg', '1', 'published', '2016-Mar-19'),
(6, 'ما هو لوريم ايبسوم ', '<p style=\"text-align: right;\">لوريم إيبسوم(Lorem Ipsum) هو ببساطة نص شكلي (بمعنى أن الغاية هي الشكل وليس المحتوى) ويُستخدم في صناعات المطابع ودور النشر. كان لوريم إيبسوم ولايزال المعيار للنص الشكلي منذ القرن الخامس عشر عندما قامت مطبعة مجهولة برص مجموعة من الأحرف بشكل عشوائي أخذتها من نص، لتكوّن كتيّب بمثابة دليل أو مرجع شكلي لهذه الأحرف. خمسة قرون من الزمن لم تقضي على هذا النص، بل انه حتى صار مستخدماً وبشكله الأصلي في الطباعة والتنضيد الإلكتروني. انتشر بشكل كبير في ستينيّات هذا القرن مع إصدار رقائق \"ليتراسيت\" (Letraset) البلاستيكية تحوي مقاطع من هذا النص، وعاد لينتشر مرة أخرى مؤخراَ مع ظهور برامج النشر الإلكتروني مثل \"ألدوس بايج مايكر\" (Aldus PageMaker) والتي حوت أيضاً على نسخ من نص لوريم إيبسوم.</p>', 'المقالات', 'images/posts/post56f6f0457f532.jpg', '1', 'published', '2016-Mar-26'),
(7, 'ما هو لوريم ايبسوم ', '<p style=\"text-align: justify;\">لوريم إيبسوم(Lorem Ipsum) هو ببساطة نص شكلي (بمعنى أن الغاية هي الشكل وليس المحتوى) ويُستخدم في صناعات المطابع ودور النشر. كان لوريم إيبسوم ولايزال المعيار للنص الشكلي منذ القرن الخامس عشر عندما قامت مطبعة مجهولة برص مجموعة من الأحرف بشكل عشوائي أخذتها من نص، لتكوّن كتيّب بمثابة دليل أو مرجع شكلي لهذه الأحرف. خمسة قرون من الزمن لم تقضي على هذا النص، بل انه حتى صار مستخدماً وبشكله الأصلي في الطباعة والتنضيد الإلكتروني. انتشر بشكل كبير في ستينيّات هذا القرن مع إصدار رقائق \"ليتراسيت\" (Letraset) البلاستيكية تحوي مقاطع من هذا النص، وعاد لينتشر مرة أخرى مؤخراَ مع ظهور برامج النشر الإلكتروني مثل \"ألدوس بايج مايكر\" (Aldus PageMaker) والتي حوت أيضاً على نسخ من نص لوريم إيبسوم.</p>', 'تعلم لغة php', 'images/posts/post570e232e7a90e.jpg', '1', 'published', '2016-Mar-26'),
(8, 'ما هو لوريم ايبسوم ', '<p style=\"text-align: right;\">لوريم إيبسوم(Lorem Ipsum) هو ببساطة نص شكلي (بمعنى أن الغاية هي الشكل وليس المحتوى) ويُستخدم في صناعات المطابع ودور النشر. كان لوريم إيبسوم ولايزال المعيار للنص الشكلي منذ القرن الخامس عشر عندما قامت مطبعة مجهولة برص مجموعة من الأحرف بشكل عشوائي أخذتها من نص، لتكوّن كتيّب بمثابة دليل أو مرجع شكلي لهذه الأحرف. خمسة قرون من الزمن لم تقضي على هذا النص، بل انه حتى صار مستخدماً وبشكله الأصلي في الطباعة والتنضيد الإلكتروني. انتشر بشكل كبير في ستينيّات هذا القرن مع إصدار رقائق \"ليتراسيت\" (Letraset) البلاستيكية تحوي مقاطع من هذا النص، وعاد لينتشر مرة أخرى مؤخراَ مع ظهور برامج النشر الإلكتروني مثل \"ألدوس بايج مايكر\" (Aldus PageMaker) والتي حوت أيضاً على نسخ من نص لوريم إيبسوم.</p>', 'الأخبار', '', '1', 'published', '2016-Mar-26'),
(9, 'ما هو لوريم ايبسوم ', '<p>لوريم إيبسوم(Lorem Ipsum) هو ببساطة نص شكلي (بمعنى أن الغاية هي الشكل وليس المحتوى) ويُستخدم في صناعات المطابع ودور النشر. كان لوريم إيبسوم ولايزال المعيار للنص الشكلي منذ القرن الخامس عشر عندما قامت مطبعة مجهولة برص مجموعة من الأحرف بشكل عشوائي أخذتها من نص، لتكوّن كتيّب بمثابة دليل أو مرجع شكلي لهذه الأحرف. خمسة قرون من الزمن لم تقضي على هذا النص، بل انه حتى صار مستخدماً وبشكله الأصلي في الطباعة والتنضيد الإلكتروني. انتشر بشكل كبير في ستينيّات هذا القرن مع إصدار رقائق \"ليتراسيت\" (Letraset) البلاستيكية تحوي مقاطع من هذا النص، وعاد لينتشر مرة أخرى مؤخراَ مع ظهور برامج النشر الإلكتروني مثل \"ألدوس بايج مايكر\" (Aldus PageMaker) والتي حوت أيضاً على نسخ من نص لوريم إيبسوم.</p>', 'الأخبار', 'images/posts/post56f6f09a75403.jpg', '1', 'published', '2016-Mar-26'),
(10, 'ما هو لوريم ايبسوم ', '<p>لوريم إيبسوم(Lorem Ipsum) هو ببساطة نص شكلي (بمعنى أن الغاية هي الشكل وليس المحتوى) ويُستخدم في صناعات المطابع ودور النشر. كان لوريم إيبسوم ولايزال المعيار للنص الشكلي منذ القرن الخامس عشر عندما قامت مطبعة مجهولة برص مجموعة من الأحرف بشكل عشوائي أخذتها من نص، لتكوّن كتيّب بمثابة دليل أو مرجع شكلي لهذه الأحرف. خمسة قرون من الزمن لم تقضي على هذا النص، بل انه حتى صار مستخدماً وبشكله الأصلي في الطباعة والتنضيد الإلكتروني. انتشر بشكل كبير في ستينيّات هذا القرن مع إصدار رقائق \"ليتراسيت\" (Letraset) البلاستيكية تحوي مقاطع من هذا النص، وعاد لينتشر مرة أخرى مؤخراَ مع ظهور برامج النشر الإلكتروني مثل \"ألدوس بايج مايكر\" (Aldus PageMaker) والتي حوت أيضاً على نسخ من نص لوريم إيبسوم.</p>', 'الأخبار', 'images/posts/post56f6f0bd72366.jpg', '1', 'published', '2016-Mar-26'),
(11, 'fgjhfgjg', '<p style=\"text-align: left;\"><strong>ffggggfg</strong></p>\r\n<ol>\r\n<li style=\"text-align: left;\">ghjghjghjgh</li>\r\n<li style=\"text-align: left;\">gjkhjkjhkh</li>\r\n<li style=\"text-align: left;\">hjkhjkjhkjkjkhj</li>\r\n</ol>\r\n<p><strong>hkhjkhhj</strong></p>\r\n<p style=\"text-align: center;\"><strong>ghfghfghfghghghgh</strong></p>\r\n<p style=\"text-align: center;\"><strong>iouik</strong></p>\r\n<p style=\"text-align: left;\"><strong>jklhjkjkjkjk</strong></p>\r\n<p style=\"text-align: left;\"><span style=\"color: #ff6600;\"><em><strong>uilhjkjkjkjkjkjkjkj<img src=\"tiny/plugins/emoticons/img/smiley-innocent.gif\" alt=\"innocent\" /></strong></em></span></p>\r\n<p style=\"text-align: left;\">&nbsp;</p>', 'تعلم لغة php', 'images/posts/post63e50ab316dd4.png', '6', 'published', '2023-Feb-09');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `setting_id` int(11) NOT NULL,
  `site_name` text NOT NULL,
  `logo` text NOT NULL,
  `slide` text NOT NULL,
  `slide_value` int(11) NOT NULL,
  `section_a` text NOT NULL,
  `section_a_value` int(11) NOT NULL,
  `section_b` text NOT NULL,
  `section_b_value` int(11) NOT NULL,
  `tab_a` text NOT NULL,
  `tab_a_value` int(11) NOT NULL,
  `tab_b` text NOT NULL,
  `tab_b_value` int(11) NOT NULL,
  `tab_c` text NOT NULL,
  `tab_c_value` int(11) NOT NULL,
  `facebook` text NOT NULL,
  `twitter` text NOT NULL,
  `google` text NOT NULL,
  `instegram` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`setting_id`, `site_name`, `logo`, `slide`, `slide_value`, `section_a`, `section_a_value`, `section_b`, `section_b_value`, `tab_a`, `tab_a_value`, `tab_b`, `tab_b_value`, `tab_c`, `tab_c_value`, `facebook`, `twitter`, `google`, `instegram`) VALUES
(1, 'اكاديمية مرتضى', 'images/logo56f6fbc49be95.png', 'الأخبار', 3, 'الأخبار', 3, 'الأخبار', 4, 'المقالات', 3, 'الأخبار', 3, 'تعلم لغة php', 9, '#', '#', '#', '#');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `gender` text NOT NULL,
  `avatar` text NOT NULL,
  `about_user` text NOT NULL,
  `facebook` text NOT NULL,
  `twitter` text NOT NULL,
  `youtube` text NOT NULL,
  `reg_date` text NOT NULL,
  `role` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `gender`, `avatar`, `about_user`, `facebook`, `twitter`, `youtube`, `reg_date`, `role`) VALUES
(1, 'مرتضى', 'murtada@admin.com', '202cb962ac59075b964b07152d234b70', 'male', 'images/avatar/user570e92007f731.jpg', 'أعمل في هذا المجال منذ حوالي 4 سنوات', '#', '#', '#', '2016-03-16', 'admin'),
(3, 'خليل', 'khalil@yahoo.com', '81dc9bdb52d04dc20036dbd8313ed055', 'male', 'images/avatar/user56f4faf7eb7fc.jpg', '<p style=\"text-align: center;\">شخصية متفائله جداً</p>', '#', '#', '', '2016-03-19', 'user'),
(4, 'ساره', 'sara_mohammed@hotmail.com', '202cb962ac59075b964b07152d234b70', 'female', 'images/avatar/user56f50a30f377e.jpg', '<p style=\"text-align: center;\"><strong>شخصية متفائله جداً</strong></p>', '#', '#', '#', '2016-03-19', 'writer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cate_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`com_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
