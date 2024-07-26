-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 26, 2024 at 02:10 PM
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

CREATE TABLE `attachment` (
  `student_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`, `address`, `datetime`) VALUES
(1, 'Harvoxx Tech Hub', 'Elzazi Plaza', '2024-06-18 19:16:02'),
(2, 'Whyte Creativity', 'Elzazi Plaza', '2024-06-18 19:16:03'),
(3, 'RSU', 'Tazi Plaza', '2024-06-18 19:16:03'),
(4, 'NLNG', 'Plaza', '2024-06-18 19:16:03');

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
(12, 3, 3, 'Database', '434', 3);

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

CREATE TABLE `feedbacks` (
  `id` int(10) UNSIGNED NOT NULL,
  `supervisor_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `log_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `feedback` text NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedbacks`
--

INSERT INTO `feedbacks` (`id`, `supervisor_id`, `student_id`, `log_id`, `company_id`, `feedback`, `datetime`) VALUES
(4, 2, 3, 4, 1, 'When ever When ever When ever When ever When ever When ever When ever When ever When ever When ever When ever When ever When ever When ever When ever When ever When ever When ever ', '2024-06-20 23:21:59'),
(9, 2, 3, 5, 1, 'Srew Ya! Srew Ya! Srew Ya! Srew Ya! Srew Ya! Srew Ya! Srew Ya! Srew Ya! Srew Ya! Srew Ya! Srew Ya! Srew Ya! Srew Ya! Srew Ya! ', '2024-06-21 10:11:58'),
(13, 2, 4, 8, 1, 'trying', '2024-06-22 11:41:29'),
(17, 2, 3, 9, 1, ' and at Child giggles academy Im the best and at Child giggles academy Im the best and at Child giggles academy Im the best and at Child giggles academy Im the best and at Child giggles academy Im the best and at Child giggles academy', '2024-06-22 11:46:04'),
(18, 2, 4, 7, 1, 'Damn Bloody Damn', '2024-06-22 11:59:18');

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
(4, 18, '8', '13');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `activity` text NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `user_id`, `company_id`, `activity`, `datetime`) VALUES
(4, 13, 1, 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eligendi odio omnis natus aut ab, facere, mollitia cumque nihil repellendus a ipsam. Modi voluptatibus quia facere incidunt nihil soluta dolor veritatis quod officia unde ipsum eum blanditiis, facilis fugiat repudiandae et quibusdam dicta, mollitia ut doloribus optio sunt earum eveniet. Officiis?\r\n098765321 qwertyuiop 1234567890 asfghjkl 1234567890 mnbvcxz 0987654321 098765321 qwertyuiop 1234567890 asfghjkl 1234567890 mnbvcxz 0987654321 098765321 qwertyuiop 1234567890 asfghjkl 1234567890 mnbvcxz 0987654321 098765321 qwertyuiop 1234567890 asfghjkl 1234567890 mnbvcxz 0987654321 ', '2024-06-19 10:30:19'),
(5, 13, 1, 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eligendi odio omnis natus aut ab, facere, mollitia cumque nihil repellendus a ipsam. Modi voluptatibus quia facere incidunt nihil soluta dolor veritatis quod officia unde ipsum eum blanditiis, facilis fugiat repudiandae et quibusdam dicta, mollitia ut doloribus optio sunt earum eveniet. Officiis?\r\n098765321 qwertyuiop 1234567890 asfghjkl 1234567890 mnbvcxz 0987654321 098765321 qwertyuiop 1234567890 asfghjkl 1234567890 mnbvcxz 0987654321 098765321 qwertyuiop 1234567890 asfghjkl 1234567890 mnbvcxz 0987654321 098765321 qwertyuiop 1234567890 asfghjkl 1234567890 mnbvcxz 0987654321 ', '2024-06-20 00:33:16'),
(7, 15, 1, 'What the hell What the hell What the hell What the hell What the hell What the hell What the hell What the hell What the hell What the hell What the hell What the hell What the hell What the hell What the hell What the hell What the hell What the hell What the hell What the hell What the hell What the hell What the hell What the hell What the hell What the hell What the hell What the hell What the hell What the hell What the hell What the hell What the hell ', '2024-06-19 20:14:58'),
(8, 15, 1, 'Part 2 Part 2 Part 2 Part 2 Part 2 Part 2 Part 2 Part 2 Part 2 Part 2 Part 2 Part 2 Part 2 Part 2 Part 2 Part 2 Part 2 Part 2 Part 2 Part 2 Part 2 Part 2 Part 2 Part 2 Part 2 Part 2 Part 2 Part 2 Part 2 Part 2 Part 2 Part 2 Part 2 Part 2 Part 2 Part 2 Part 2 Part 2 Part 2 Part 2 Part 2 Part 2 Part 2 Part 2 Part 2 Part 2 Part 2 Part 2 Part 2 Part 2 Part 2 Part 2 Part 2 Part 2 Part 2 Part 2 Part 2 Part 2 Part 2 Part 2 Part 2 Part 2 Part 2 Part 2 ', '2024-06-20 20:15:58'),
(9, 13, 1, 'Im the best and at Child giggles academy Im the best and at Child giggles academy Im the best and at Child giggles academy Im the best and at Child giggles academy Im the best and at Child giggles academy Im the best and at Child giggles academy Im the best and at Child giggles academy Im the best and at Child giggles academy ', '2024-06-21 10:13:20'),
(10, 15, 1, 'I lost my PC I lost my PC I lost my PC I lost my PC I lost my PC I lost my PC I lost my PC I lost my PC I lost my PC I lost my PC I lost my PC I lost my PC I lost my PC I lost my PC I lost my PC I lost my PC I lost my PC I lost my PC I lost my PC I lost my PC I lost my PC I lost my PC I lost my PC I lost my PC I lost my PC I lost my PC I lost my PC I lost my PC I lost my PC I lost my PC I lost my PC I lost my PC I lost my PC I lost my PC I lost my PC I lost my PC I lost my PC I lost my PC ', '2024-06-21 10:14:01'),
(12, 15, 1, 'Bloody Hell, Shit Bloody Hell, Shit Bloody Hell, Shit Bloody Hell, Shit Bloody Hell, Shit Bloody Hell, Shit Bloody Hell, Shit Bloody Hell, Shit Bloody Hell, Shit Bloody Hell, Shit Bloody Hell, Shit Bloody Hell, Shit Bloody Hell, Shit Bloody Hell, Shit Bloody Hell, Shit Bloody Hell, Shit Bloody Hell, Shit Bloody Hell, Shit Bloody Hell, Shit Bloody Hell, Shit Bloody Hell, Shit Bloody Hell, Shit Bloody Hell, Shit Bloody Hell, Shit Bloody Hell, Shit Bloody Hell, Shit Bloody Hell, Shit Bloody Hell, Shit Bloody Hell, Shit Bloody Hell, Shit Bloody Hell, Shit Bloody Hell, Shit Bloody Hell, Shit Bloody Hell, Shit ', '2024-06-22 11:22:36');

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
(3, 13, 'DE:2020/4316', 'Science', 'Computer Science'),
(4, 15, 'DE.2020/4276', 'Science', 'Computer Science'),
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
(2, 'admin', 'admin', 'admin@gmail.com', '09114895572', '$2y$10$2nV8gty7hxjhQw59CB/sg.aCvwVVriFsiYDThFJWY1TJCb2FU8dPK', 'admin', '$2y$10$IBCXrKO6YRvjmuGEzuThBORi6CtO3.vFufFS9szFTn73prF.h4ezC'),
(16, 'Student', 'Student', 'student@gmail.com', '123490', '$2y$10$X3iWj8G3.SWcQWYxjme7vuZE3RGfNj.9.D9dhiMTfrYQmS21gpe1W', 'student', '$2y$10$xaxu6FbZuBp7d8T9MtA/geNTq7Mu.Nkvp/wXZbyFm3ebYU0YNCDZ.'),
(17, 'Teacher', 'Teacher', 'teacher@gmail.com', '98765232131', '$2y$10$euY/594uN3O6NHs6pL/ILOSkpyf2roMQWYFROni33mTU25u2q12Xy', 'lecturer', '$2y$10$iBYZy3M6/R6tZ98ZH8oxguMkb1.W6bRtR/bDGanLNbuINpYiJ6l06'),
(18, 'Lecturer', 'Lecturer', 'lecturer@gmail.com', '463789201', '$2y$10$BCgetVN3fDb2iOkHMmzXnuXgM4vvcKbS1PX1d3e7VZaQAlucAWdQa', 'lecturer', '$2y$10$A48jt.bJoaAinGP7I9PcG.kGaBvIoyjZf3TF21Ube5M1712X5US16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lecturers`
--
ALTER TABLE `lecturers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
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
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `lecturers`
--
ALTER TABLE `lecturers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `supervisors`
--
ALTER TABLE `supervisors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
