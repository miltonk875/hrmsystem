-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2025 at 01:35 PM
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
-- Database: `basic_hrm_system_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Technology & Engineering', '2025-12-04 12:35:00', '2025-12-04 18:09:17'),
(2, 'Business Operations', '2025-12-04 12:35:12', '2025-12-04 18:09:33'),
(4, 'Sales & Business Development', '2025-12-04 12:35:29', '2025-12-04 18:09:46'),
(5, 'Marketing', '2025-12-04 12:36:22', '2025-12-04 18:10:00'),
(6, 'Finance & Accounting', '2025-12-04 12:36:30', '2025-12-04 18:10:12'),
(7, 'Human Resources (HR)', '2025-12-04 18:10:33', '2025-12-04 18:10:33'),
(8, 'Customer Support', '2025-12-04 18:10:44', '2025-12-04 18:10:44'),
(9, 'Legal & Compliance', '2025-12-04 18:10:53', '2025-12-04 18:10:53'),
(10, 'Research & Development', '2025-12-04 18:11:02', '2025-12-04 18:11:02'),
(11, 'Creative & Content', '2025-12-04 18:11:11', '2025-12-04 18:11:11');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `first_name`, `last_name`, `email`, `department_id`, `status`, `created_by`, `created_at`, `updated_at`, `updated_by`) VALUES
(4, 'Brennan', 'Robles', 'bycacehe@mailinator.com', 9, 1, 1, '2025-12-05 00:09:27', '2025-12-05 00:51:47', 1),
(5, 'Fay', 'Nicholson', 'tumar@mailinator.com', 2, 1, 1, '2025-12-05 00:10:05', '2025-12-05 00:10:05', NULL),
(6, 'Ruth', 'Gibson', 'kogodof@mailinator.com', 4, 1, 1, '2025-12-05 00:11:30', '2025-12-05 00:11:30', NULL),
(7, 'Courtney', 'Ewing', 'fitypymeq@mailinator.com', 6, 1, 1, '2025-12-05 00:12:50', '2025-12-05 00:12:50', NULL),
(8, 'Castor', 'Holt', 'waqaguvi@mailinator.com', 10, 1, 1, '2025-12-05 00:14:33', '2025-12-05 00:14:33', NULL),
(9, 'Brennan', 'Robles', 'bycacehert@mailinator.com', 9, 1, 1, '2025-12-05 00:49:13', '2025-12-05 00:49:13', NULL),
(10, 'Brennan', 'Robles', 'bycacehety@mailinator.com', 9, 1, 1, '2025-12-05 00:49:34', '2025-12-05 00:49:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employee_skill`
--

CREATE TABLE `employee_skill` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `skill_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_skill`
--

INSERT INTO `employee_skill` (`id`, `employee_id`, `skill_id`) VALUES
(4, 4, 4),
(22, 4, 5),
(3, 4, 111),
(6, 5, 6),
(5, 5, 7),
(7, 5, 10),
(10, 6, 6),
(9, 6, 10),
(8, 6, 38),
(12, 7, 12),
(11, 7, 25),
(15, 8, 12),
(14, 8, 15),
(16, 8, 16),
(13, 8, 60),
(17, 9, 4),
(18, 9, 111),
(19, 10, 4),
(21, 10, 12),
(20, 10, 111);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(5, '2025_12_04_144656_create_departments_table', 1),
(6, '2025_12_05_004934_create_skills_table', 1),
(7, '2025_12_05_010628_create_employees_table', 1),
(8, '2025_12_05_062313_create_employee_skill_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('sWZW2dCH2AXVzFQyx6gCmaNHgqmlQsLicamMjCOq', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiU0gydFk0Z0RSSWxTYmJXcHhMRjIyQjhWeDNkTjBYVG5jNE1reFdveCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fX0=', 1764938139);

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'PHP', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(2, 'Laravel', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(3, 'JavaScript', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(4, 'TypeScript', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(5, 'Python', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(6, 'Java', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(7, 'C#', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(8, 'Ruby', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(9, 'Go', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(10, 'Rust', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(11, 'HTML/CSS', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(12, 'React', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(13, 'Vue.js', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(14, 'Angular', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(15, 'Next.js', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(16, 'jQuery', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(17, 'Bootstrap', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(18, 'Tailwind CSS', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(19, 'Node.js', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(20, 'Express.js', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(21, 'Django', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(22, 'Flask', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(23, 'Spring Boot', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(24, 'ASP.NET', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(25, 'MySQL', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(26, 'PostgreSQL', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(27, 'MongoDB', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(28, 'Redis', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(29, 'SQLite', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(30, 'Oracle', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(31, 'AWS', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(32, 'Azure', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(33, 'Google Cloud', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(34, 'Docker', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(35, 'Kubernetes', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(36, 'CI/CD', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(37, 'Jenkins', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(38, 'GitHub Actions', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(39, 'Linux', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(40, 'Nginx', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(41, 'Git', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(42, 'GitHub', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(43, 'GitLab', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(44, 'Jira', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(45, 'Trello', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(46, 'Data Analysis', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(47, 'SQL', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(48, 'Power BI', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(49, 'Tableau', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(50, 'Excel Advanced', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(51, 'Google Analytics', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(52, 'Machine Learning', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(53, 'Data Visualization', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(54, 'TensorFlow', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(55, 'Manual Testing', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(56, 'Automation Testing', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(57, 'Selenium', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(58, 'Cypress', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(59, 'Jest', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(60, 'PHPUnit', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(61, 'Postman', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(62, 'Figma', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(63, 'Adobe XD', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(64, 'Sketch', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(65, 'Adobe Photoshop', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(66, 'UI Design', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(67, 'UX Design', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(68, 'UX Research', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(69, 'Wireframing', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(70, 'Prototyping', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(71, 'Android Development', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(72, 'iOS Development', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(73, 'React Native', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(74, 'Flutter', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(75, 'Cybersecurity', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(76, 'Network Security', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(77, 'Penetration Testing', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(78, 'Project Management', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(79, 'Agile', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(80, 'Scrum', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(81, 'Kanban', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(82, 'Team Leadership', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(83, 'Communication', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(84, 'Problem Solving', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(85, 'Critical Thinking', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(86, 'Time Management', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(87, 'Team Collaboration', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(88, 'Public Speaking', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(89, 'Presentation Skills', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(90, 'Negotiation', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(91, 'Digital Marketing', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(92, 'SEO', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(93, 'SEM', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(94, 'Social Media Marketing', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(95, 'Content Marketing', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(96, 'Email Marketing', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(97, 'Marketing Strategy', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(98, 'Sales Strategy', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(99, 'CRM', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(100, 'Content Writing', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(101, 'Copywriting', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(102, 'Technical Writing', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(103, 'Video Editing', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(104, 'Graphic Design', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(105, 'Recruitment', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(106, 'Talent Acquisition', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(107, 'Employee Relations', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(108, 'Payroll Management', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(109, 'Accounting', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(110, 'Financial Analysis', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(111, 'Budgeting', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(112, 'Tax Management', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(113, 'Customer Service', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(114, 'Technical Support', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(115, 'Customer Success', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(116, 'RESTful API', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(117, 'GraphQL', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(118, 'Microservices', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(119, 'API Integration', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(120, 'Blockchain', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(121, 'AI/ML', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(122, 'WordPress', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(123, 'Shopify', '2025-12-04 13:02:53', '2025-12-04 13:02:53'),
(124, 'Web Scraping', '2025-12-04 13:02:53', '2025-12-04 13:02:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$12$DmbS43jjCTVJmTCOpqzNpe0YRwHo2Q99lpYrZPjV8OtupmSghHW3O', 1, NULL, '2025-12-05 11:15:10', '2025-12-05 11:15:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `departments_name_unique` (`name`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employees_email_unique` (`email`),
  ADD KEY `employees_department_id_foreign` (`department_id`);

--
-- Indexes for table `employee_skill`
--
ALTER TABLE `employee_skill`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employee_skill_employee_id_skill_id_unique` (`employee_id`,`skill_id`),
  ADD KEY `employee_skill_skill_id_foreign` (`skill_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `skills_name_unique` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `employee_skill`
--
ALTER TABLE `employee_skill`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `employee_skill`
--
ALTER TABLE `employee_skill`
  ADD CONSTRAINT `employee_skill_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `employee_skill_skill_id_foreign` FOREIGN KEY (`skill_id`) REFERENCES `skills` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
