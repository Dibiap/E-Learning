-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 10, 2024 at 04:55 AM
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
-- Database: `elearnings`
--

-- --------------------------------------------------------

--
-- Table structure for table `attachment`
--
-- Error reading structure for table elearnings.attachment: #1146 - Table &#039;elearnings.attachment&#039; doesn&#039;t exist
-- Error reading data for table elearnings.attachment: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `elearnings`.`attachment`&#039; at line 1

-- --------------------------------------------------------

--
-- Table structure for table `company`
--
-- Error reading structure for table elearnings.company: #1146 - Table &#039;elearnings.company&#039; doesn&#039;t exist
-- Error reading data for table elearnings.company: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `elearnings`.`company`&#039; at line 1

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(10) UNSIGNED NOT NULL,
  `department_id` int(11) NOT NULL,
  `lecturer_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `unit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `department_id`, `lecturer_id`, `name`, `code`, `unit`) VALUES
(13, 3, 3, 'Database', '434', 3),
(14, 3, 5, 'Algorithms', '412', 4);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(10) UNSIGNED NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `faculty_id`, `name`) VALUES
(3, 1, 'Computer Science'),
(10, 11, 'Accounting'),
(11, 11, 'Marketing'),
(12, 9, 'Quantity Survey'),
(13, 8, 'English'),
(14, 8, 'Socials'),
(15, 1, 'Mathematics');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`id`, `name`) VALUES
(1, 'Science'),
(8, 'Humanities'),
(9, 'Evironment'),
(11, 'Management');

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--
-- Error reading structure for table elearnings.feedbacks: #1146 - Table &#039;elearnings.feedbacks&#039; doesn&#039;t exist
-- Error reading data for table elearnings.feedbacks: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `elearnings`.`feedbacks`&#039; at line 1

-- --------------------------------------------------------

--
-- Table structure for table `lecturers`
--

CREATE TABLE `lecturers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `faculty_id` varchar(50) NOT NULL,
  `department_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lecturers`
--

INSERT INTO `lecturers` (`id`, `user_id`, `faculty_id`, `department_id`) VALUES
(3, 17, '1', '3'),
(4, 18, '8', '13'),
(5, 19, '1', '3');

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `id` int(10) UNSIGNED NOT NULL,
  `lecturer_id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `topic` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `attachment` text DEFAULT NULL,
  `video` text DEFAULT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`id`, `lecturer_id`, `faculty_id`, `department_id`, `course_id`, `topic`, `content`, `attachment`, `video`, `datetime`) VALUES
(6, 5, 1, 3, 14, 'New Topic', '<p>qwwqerw</p>\n\n<p>wewgterg</p>\n\n<p>&lt;script&gt;</p>\n\n<p>alert(&#39;Hello World&#39;);</p>\n\n<p>&lt;/script&gt;</p>\n', 'attachments/RSU-E-LEARNING-2024-07-30-05:33:44pm768835.zip', NULL, '2024-07-30 15:33:44'),
(7, 5, 1, 3, 14, 'Bubble Sort', '<p>qaw</p>\n\n<p>oiltrf8uir</p>\n\n<p>tyejjkyukyu</p>\n', 'attachments/RSU-E-LEARNING-2024-07-30-05:34:49pm343975.zip', NULL, '2024-07-30 15:34:49'),
(13, 5, 1, 3, 14, 'Merge Sort', '<h1 style=\"text-align:center\">Merge Sort</h1>\r\n\r\n<p style=\"text-align:center\">Uses Divide and Conquer Algorithm</p>\r\n\r\n<p style=\"text-align:center\">All the sorting algorthims seems cool</p>\r\n\r\n<p style=\"text-align:center\"><u><strong>Steps</strong></u></p>\r\n\r\n<ul>\r\n	<li style=\"text-align: justify;\">First Split the list into two different list recursively until each sub, sub, ..., sub-list contains just&nbsp; element</li>\r\n	<li style=\"text-align: justify;\">Sort each list/element on the same level and merge them</li>\r\n	<li style=\"text-align: justify;\">then proceed with the merged list to sort the other lists in the same level as this sorted list</li>\r\n	<li style=\"text-align: justify;\">and so on until we get to the root</li>\r\n</ul>\r\n', '', NULL, '2024-07-31 09:12:40'),
(14, 3, 1, 3, 13, 'Relational Database', '<h1>Relational Database<img alt=\"Randome Picture\" src=\"https://picsum.photos/150/150\" style=\"border-style:solid; border-width:1px; float:left; height:150px; margin:10px; width:150px\" /></h1>\r\n\r\n<p>This type of database makes use of rows and columns - like tables to store information</p>\r\n\r\n<p><u><strong>Examples are:</strong></u></p>\r\n\r\n<ul>\r\n	<li>MySQL</li>\r\n	<li>PostgreSQL</li>\r\n	<li>SQLite</li>\r\n</ul>\r\n', '', NULL, '2024-07-31 10:21:53'),
(16, 5, 1, 3, 14, 'New Topic', '<p>wegtqrewg</p>\r\n\r\n<p>qegergqerg<strong>rereqger</strong></p>\r\n', 'attachments/RSU-E-LEARNING-2024-08-10-04:13:25am840478.zip', NULL, '2024-08-10 02:13:25'),
(19, 5, 1, 3, 14, 'New Lesson With Attachment and Video', '<h1>This Lecture</h1>\r\n\r\n<p><span style=\"font-size:14px\">contains an attachment and a video</span></p>\r\n', 'attachments/RSU-E-LEARNING-ZIP-2024-08-10-04:44:29am63758.zip', 'videos/RSU-E-LEARNING-VIDEO-2024-08-10-04:44:29am821196.mp4', '2024-08-10 02:35:04');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--
-- Error reading structure for table elearnings.logs: #1146 - Table &#039;elearnings.logs&#039; doesn&#039;t exist
-- Error reading data for table elearnings.logs: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `elearnings`.`logs`&#039; at line 1

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `id` int(10) UNSIGNED NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `correct` varchar(255) NOT NULL,
  `wrong1` varchar(255) NOT NULL,
  `wrong2` varchar(255) NOT NULL,
  `wrong3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`id`, `lesson_id`, `question`, `correct`, `wrong1`, `wrong2`, `wrong3`) VALUES
(1, 13, 'What is the topic', 'Merge Sort', 'Bubble Sort', 'Selection Sort', 'Insertion Sort'),
(2, 13, 'What is the name of the lecturer', 'Prosper', 'Not Prosper', 'Still Not Prosper', 'Absolutely Not Prosper');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `matric` varchar(20) NOT NULL,
  `faculty_id` varchar(50) NOT NULL,
  `department_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `user_id`, `matric`, `faculty_id`, `department_id`) VALUES
(5, 16, 'DE.2020/4228', '1', '3');

-- --------------------------------------------------------

--
-- Table structure for table `supervisors`
--

CREATE TABLE `supervisors` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supervisors`
--

INSERT INTO `supervisors` (`id`, `user_id`, `company_id`) VALUES
(2, 14, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `password` varchar(60) NOT NULL,
  `role` set('student','lecturer','admin') DEFAULT NULL,
  `loginkey` varchar(60) CHARACTER SET gb2312 COLLATE gb2312_chinese_nopad_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `phone`, `password`, `role`, `loginkey`) VALUES
(2, 'admin', 'admin', 'admin@gmail.com', '09114895572', '$2y$10$2nV8gty7hxjhQw59CB/sg.aCvwVVriFsiYDThFJWY1TJCb2FU8dPK', 'admin', '$2y$10$y5i3FHmtP3eO.jdUl6ncNuzI4t99XPosgYYP5ltEzue/60i8POzGG'),
(16, 'Student', 'Student', 'student@gmail.com', '123490', '$2y$10$X3iWj8G3.SWcQWYxjme7vuZE3RGfNj.9.D9dhiMTfrYQmS21gpe1W', 'student', '$2y$10$gMU7cdcfQVHVvatSyFTrHOmbkPFCehSKiQrNDMvSmAvw5Wmb0agfC'),
(17, 'Teacher', 'Teacher', 'teacher@gmail.com', '98765232131', '$2y$10$euY/594uN3O6NHs6pL/ILOSkpyf2roMQWYFROni33mTU25u2q12Xy', 'lecturer', '$2y$10$YiEoNeOelIgFijpcAa226eWEZwMyQBNOQNAVGm5CeNLninXKbG7vi'),
(18, 'Lecturer', 'Lecturer', 'lecturer@gmail.com', '463789201', '$2y$10$BCgetVN3fDb2iOkHMmzXnuXgM4vvcKbS1PX1d3e7VZaQAlucAWdQa', 'lecturer', '$2y$10$A48jt.bJoaAinGP7I9PcG.kGaBvIoyjZf3TF21Ube5M1712X5US16'),
(19, 'Prosper', 'Prosper', 'Prosper@gmail.com', '73282938', '$2y$10$r28.L4HTalNzrHpXyl45AufpA5mlck8/i9eo76bps564Y/B1gYKC2', 'lecturer', '$2y$10$r5WJswPhw8q2pBcQT71sBOOKs75DQ0mnTHAyYlC8NTl3ksPo4BXzi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lecturers`
--
ALTER TABLE `lecturers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supervisors`
--
ALTER TABLE `supervisors`
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
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `lecturers`
--
ALTER TABLE `lecturers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `supervisors`
--
ALTER TABLE `supervisors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
