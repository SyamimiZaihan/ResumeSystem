-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2026 at 08:41 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `resume_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `achievements`
--

CREATE TABLE `achievements` (
  `id` int(11) NOT NULL,
  `personal_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `resume_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `achievements`
--

INSERT INTO `achievements` (`id`, `personal_id`, `title`, `date`, `description`, `created_at`, `resume_id`) VALUES
(12, 17, 'Dean\'s List Award', '2026-01-01', 'Diploma and Degree', '2026-01-05 19:28:58', NULL),
(13, 17, 'NICetech \'21 (National Level)', '2021-06-01', 'Gold Award (Team Leader) for developing an innovative web-based IT project', '2026-01-05 19:28:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE `certificates` (
  `id` int(11) NOT NULL,
  `personal_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `org` varchar(255) DEFAULT NULL,
  `issue_date` date DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `resume_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `certificates`
--

INSERT INTO `certificates` (`id`, `personal_id`, `name`, `org`, `issue_date`, `expiry_date`, `created_at`, `resume_id`) VALUES
(21, 17, 'CCNA: Introduction to Networks', 'CISCO', '2024-09-01', NULL, '2026-01-05 19:28:58', NULL),
(22, 17, 'Certificate of Completion (Power BI for Beginners)', 'Simplilearn', '2025-04-01', NULL, '2026-01-05 19:28:58', NULL),
(23, 17, 'Machine Learning Using SAS Viya', 'SAS', '2025-10-01', NULL, '2026-01-05 19:28:58', NULL),
(24, 17, 'Information Security for Dummies', 'EC-Council', '2024-06-01', NULL, '2026-01-05 19:28:58', NULL),
(25, 17, 'TOP CODERS 2025', 'thulija', '2025-05-01', NULL, '2026-01-05 19:28:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE `education` (
  `id` int(11) NOT NULL,
  `personal_id` int(11) NOT NULL,
  `level` varchar(100) DEFAULT NULL,
  `field` varchar(255) DEFAULT NULL,
  `school` varchar(255) DEFAULT NULL,
  `gpa` varchar(50) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `resume_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`id`, `personal_id`, `level`, `field`, `school`, `gpa`, `start_date`, `end_date`, `description`, `created_at`, `resume_id`) VALUES
(20, 17, 'Bachelor Degree', 'Information Technology', 'Universiti Tun Hussein Onn Malaysia (UTHM)', '3.85', '2023-10-01', '2026-08-01', 'Bachelor of Information Technology with Honours', '2026-01-05 19:28:58', NULL),
(21, 17, 'Diploma', 'Information Technology', 'Kolej Vokasional Perdagangan Johor Bahru', '3.80', '2018-01-01', '2022-08-01', 'Diploma in Database Management System Technology and Web Applications', '2026-01-05 19:28:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `experience`
--

CREATE TABLE `experience` (
  `id` int(11) NOT NULL,
  `personal_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `resume_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `experience`
--

INSERT INTO `experience` (`id`, `personal_id`, `title`, `company`, `start_date`, `end_date`, `description`, `created_at`, `resume_id`) VALUES
(10, 17, 'Internship in ICT Department Unit', 'Kolej Kemahiran Tinggi Mara Sri Gading', '2022-04-01', '2024-08-01', 'Assisted in developing and updating the official KKTM Sri Gading website using Joomla! while performing hardware maintenance and troubleshooting. Managed ICT data and asset documentation and supported users with system, hardware, and software issues.', '2026-01-05 19:28:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_details`
--

CREATE TABLE `personal_details` (
  `id` int(11) NOT NULL,
  `resume_id` int(11) DEFAULT NULL,
  `full_name` varchar(255) NOT NULL,
  `job_title` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `personal_details`
--

INSERT INTO `personal_details` (`id`, `resume_id`, `full_name`, `job_title`, `email`, `phone`, `address`, `linkedin`, `created_at`) VALUES
(17, NULL, 'Nurizzati Syamimi Binti Zaihan', 'Web Developer Internship', 'nurizzatizaihan@gmail.com', '+60198959967', 'Batu Pahat, Johor', 'https://www.linkedin.com/in/nurizzati-syamimi/', '2026-01-05 19:28:58');

-- --------------------------------------------------------

--
-- Table structure for table `resume`
--

CREATE TABLE `resume` (
  `resume_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` int(11) NOT NULL,
  `personal_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `level` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `resume_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `personal_id`, `name`, `level`, `created_at`, `resume_id`) VALUES
(23, 17, 'PHP', 'Intermediate', '2026-01-05 19:28:58', NULL),
(24, 17, 'MySQL', 'Intermediate', '2026-01-05 19:28:58', NULL),
(25, 17, 'Pyhton', 'Beginner', '2026-01-05 19:28:58', NULL),
(26, 17, 'Teamwork', 'Intermediate', '2026-01-05 19:28:58', NULL),
(27, 17, 'Time Management', 'Intermediate', '2026-01-05 19:28:58', NULL),
(28, 17, 'Communication', 'Intermediate', '2026-01-05 19:28:58', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `achievements`
--
ALTER TABLE `achievements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_achievements_personal` (`personal_id`),
  ADD KEY `resume_id` (`resume_id`);

--
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_certificates_personal` (`personal_id`),
  ADD KEY `resume_id` (`resume_id`);

--
-- Indexes for table `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_education_personal` (`personal_id`),
  ADD KEY `resume_id` (`resume_id`);

--
-- Indexes for table `experience`
--
ALTER TABLE `experience`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_experience_personal` (`personal_id`),
  ADD KEY `resume_id` (`resume_id`);

--
-- Indexes for table `personal_details`
--
ALTER TABLE `personal_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resume_id` (`resume_id`);

--
-- Indexes for table `resume`
--
ALTER TABLE `resume`
  ADD PRIMARY KEY (`resume_id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_skills_personal` (`personal_id`),
  ADD KEY `resume_id` (`resume_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `achievements`
--
ALTER TABLE `achievements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `experience`
--
ALTER TABLE `experience`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `personal_details`
--
ALTER TABLE `personal_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `resume`
--
ALTER TABLE `resume`
  MODIFY `resume_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `achievements`
--
ALTER TABLE `achievements`
  ADD CONSTRAINT `achievements_ibfk_1` FOREIGN KEY (`resume_id`) REFERENCES `resume` (`resume_id`),
  ADD CONSTRAINT `fk_achievements_personal` FOREIGN KEY (`personal_id`) REFERENCES `personal_details` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `certificates`
--
ALTER TABLE `certificates`
  ADD CONSTRAINT `certificates_ibfk_1` FOREIGN KEY (`resume_id`) REFERENCES `resume` (`resume_id`),
  ADD CONSTRAINT `fk_certificates_personal` FOREIGN KEY (`personal_id`) REFERENCES `personal_details` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `education`
--
ALTER TABLE `education`
  ADD CONSTRAINT `education_ibfk_1` FOREIGN KEY (`resume_id`) REFERENCES `resume` (`resume_id`),
  ADD CONSTRAINT `fk_education_personal` FOREIGN KEY (`personal_id`) REFERENCES `personal_details` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `experience`
--
ALTER TABLE `experience`
  ADD CONSTRAINT `experience_ibfk_1` FOREIGN KEY (`resume_id`) REFERENCES `resume` (`resume_id`),
  ADD CONSTRAINT `fk_experience_personal` FOREIGN KEY (`personal_id`) REFERENCES `personal_details` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `personal_details`
--
ALTER TABLE `personal_details`
  ADD CONSTRAINT `personal_details_ibfk_1` FOREIGN KEY (`resume_id`) REFERENCES `resume` (`resume_id`);

--
-- Constraints for table `skills`
--
ALTER TABLE `skills`
  ADD CONSTRAINT `fk_skills_personal` FOREIGN KEY (`personal_id`) REFERENCES `personal_details` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `skills_ibfk_1` FOREIGN KEY (`resume_id`) REFERENCES `resume` (`resume_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
