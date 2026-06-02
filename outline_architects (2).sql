-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 02, 2026 at 08:49 AM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `outline_architects`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `career_jobs`
--

DROP TABLE IF EXISTS `career_jobs`;
CREATE TABLE IF NOT EXISTS `career_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `department` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `employment_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `experience` int NOT NULL,
  `short_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `career_jobs`
--

INSERT INTO `career_jobs` (`id`, `title`, `slug`, `department`, `location`, `employment_type`, `experience`, `short_description`, `description`, `status`, `created_date`, `created_at`, `updated_at`) VALUES
(1, 'admin operator', 'admin-operator-6a17da847681e', 'admin', 'pachalam', 'full-time', 3, 'Admin Operator responsible for managing daily office operations, coordinating administrative tasks, maintaining records, and ensuring smooth workflow within the organization.', 'We are looking for a detail-oriented and organized Admin Operator to support our daily business operations. The ideal candidate will handle administrative responsibilities, maintain office records, coordinate with team members, manage schedules, and ensure efficient communication across departments. The role requires strong organizational skills, multitasking abilities, and proficiency in office management tools. Candidates should be proactive, professional, and capable of maintaining a productive and well-structured work environment while supporting the company’s operational and administrative needs.', 1, '2026-05-28', '2026-05-28 00:32:44', '2026-05-28 00:32:44');

-- --------------------------------------------------------

--
-- Table structure for table `common_seo_parameters`
--

DROP TABLE IF EXISTS `common_seo_parameters`;
CREATE TABLE IF NOT EXISTS `common_seo_parameters` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `keyword` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `common_seo_parameters_post_id_foreign` (`post_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `common_seo_parameters`
--

INSERT INTO `common_seo_parameters` (`id`, `keyword`, `post_id`, `created_at`, `updated_at`) VALUES
(3, 'diamond', 170, '2026-03-18 06:16:02', '2026-03-18 06:16:02'),
(4, 'green forest', 170, '2026-03-18 06:16:02', '2026-03-18 06:16:02'),
(5, 'project', 171, '2026-03-19 00:56:54', '2026-03-19 00:56:54'),
(6, 'nice', 171, '2026-03-19 00:56:54', '2026-03-19 00:56:54'),
(9, 'laravel', 169, '2026-04-02 07:12:01', '2026-04-02 07:12:01'),
(10, 'php', 169, '2026-04-02 07:12:01', '2026-04-02 07:12:01');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `project_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `phone`, `project_type`, `message`, `is_read`, `created_at`, `updated_at`) VALUES
(1, 'cilfa', 'cilfamdigitz@gmail.com', '9878678767', 'abc', 'abcefghifklmop', 0, '2026-05-18 07:49:21', '2026-05-18 07:49:21'),
(2, 'Cilfa Vj', 'cilfamdigitz@gmail.com', '6787875645', 'abc', 'jhgfdshgftdszxcv', 0, '2026-05-27 00:17:29', '2026-05-27 00:17:29');

-- --------------------------------------------------------

--
-- Table structure for table `custom_css`
--

DROP TABLE IF EXISTS `custom_css`;
CREATE TABLE IF NOT EXISTS `custom_css` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `content_css` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `custom_css`
--

INSERT INTO `custom_css` (`id`, `content_css`, `created_at`, `updated_at`) VALUES
(2, '@media (max-width: 575.98px) {\r\n    .ct-pg__form-row {\r\n        flex-direction: column;\r\n        gap: 0;\r\n    }\r\n\r\n}', '2026-05-29 04:15:59', '2026-05-29 04:15:59');

-- --------------------------------------------------------

--
-- Table structure for table `custom_javascripts`
--

DROP TABLE IF EXISTS `custom_javascripts`;
CREATE TABLE IF NOT EXISTS `custom_javascripts` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `content_script` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `custom_javascripts`
--

INSERT INTO `custom_javascripts` (`id`, `content_script`, `created_at`, `updated_at`) VALUES
(1, 'const cursorRing = document.createElement(\'div\');\r\n\r\ncursorRing.style.cssText = `\r\n    position: fixed;\r\n    width: 12px;\r\n    height: 12px;\r\n    border: 1px solid #dc2626;\r\n    border-radius: 50%;\r\n    background: transparent;\r\n    pointer-events: none;\r\n    z-index: 99999;\r\n    transform: translate(-50%, -50%);\r\n    transition: width .2s ease, height .2s ease;\r\n`;\r\n\r\ndocument.body.appendChild(cursorRing);\r\n\r\nlet mouseX = 0;\r\nlet mouseY = 0;\r\nlet ringX = 0;\r\nlet ringY = 0;\r\n\r\ndocument.addEventListener(\'mousemove\', (e) => {\r\n    mouseX = e.clientX;\r\n    mouseY = e.clientY;\r\n});\r\n\r\nfunction animate() {\r\n    ringX += (mouseX - ringX) * 0.25;\r\n    ringY += (mouseY - ringY) * 0.25;\r\n\r\n    cursorRing.style.left = ringX + \'px\';\r\n    cursorRing.style.top = ringY + \'px\';\r\n\r\n    requestAnimationFrame(animate);\r\n}\r\n\r\nanimate();\r\n\r\ndocument.querySelectorAll(\'a, button\').forEach(el => {\r\n    el.addEventListener(\'mouseenter\', () => {\r\n        cursorRing.style.width = \'18px\';\r\n        cursorRing.style.height = \'18px\';\r\n    });\r\n\r\n    el.addEventListener(\'mouseleave\', () => {\r\n        cursorRing.style.width = \'12px\';\r\n        cursorRing.style.height = \'12px\';\r\n    });\r\n});', '2026-05-29 06:21:21', '2026-05-29 06:32:21');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gallery_categories`
--

DROP TABLE IF EXISTS `gallery_categories`;
CREATE TABLE IF NOT EXISTS `gallery_categories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `gallery_categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gallery_categories`
--

INSERT INTO `gallery_categories` (`id`, `name`, `slug`, `description`, `is_active`, `sort_order`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Collection drives', 'collection-drives', NULL, 1, 0, '2025-11-21 15:05:10', '2025-11-25 03:12:41', NULL),
(2, 'Awareness program', 'awareness-program', NULL, 1, 0, '2025-11-25 03:13:16', '2025-11-25 03:13:16', NULL),
(3, 'Corporate events', 'corporate-events', NULL, 1, 0, '2025-11-25 03:13:28', '2025-11-25 03:13:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `highlights`
--

DROP TABLE IF EXISTS `highlights`;
CREATE TABLE IF NOT EXISTS `highlights` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_applications`
--

DROP TABLE IF EXISTS `job_applications`;
CREATE TABLE IF NOT EXISTS `job_applications` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `job_id` bigint UNSIGNED NOT NULL,
  `job_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `job_department` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job_location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `full_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `experience` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover_letter` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `resume_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `resume_original_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resume_file_size` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','reviewed','shortlisted','rejected','hired') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `admin_notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `reviewed_at` timestamp NULL DEFAULT NULL,
  `reviewed_by` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `terms_agreed` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `job_applications_job_id_index` (`job_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
CREATE TABLE IF NOT EXISTS `members` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `show_html` tinyint NOT NULL DEFAULT '0' COMMENT '0 = Plain Text, 1 = HTML/CKEditor',
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keyword` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `members_slug_unique` (`slug`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `name`, `designation`, `description`, `show_html`, `image`, `slug`, `keyword`, `created_at`, `updated_at`) VALUES
(2, 'Rahul Sharma', 'Founder & CEO', 'Visionary leader with 20+ years of experience in architecture and project management.', 0, 'uploads/members/rahul-sharma.webp', 'rahul-sharma', NULL, '2026-05-21 07:54:17', '2026-05-28 06:33:56'),
(4, 'Karan Mehta', 'Project Director', 'Expert in delivering complex projects with precision, quality, and on-time execution.', 0, 'uploads/members/karan-mehta.webp', 'karan-mehta', NULL, '2026-05-22 00:30:58', '2026-05-28 06:33:56'),
(3, 'Anita Verma', 'Design Director', 'Creative strategist passionate about transforming ideas into extraordinary spaces.', 0, 'uploads/members/anita-verma.webp', 'anita-verma', NULL, '2026-05-22 00:29:45', '2026-05-28 06:33:56'),
(5, 'Neha Iyer', 'Operations Director', '<p>Drives operational excellence and ensures seamless project delivery across teams.</p>', 1, 'uploads/members/neha-iyer.webp', 'neha-iyer', NULL, '2026-05-22 00:32:09', '2026-06-01 06:11:55');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_09_05_110840_create_post_categories_table', 1),
(5, '2025_09_05_170409_create_posts_table', 1),
(6, '2025_09_05_200200_create_product_categories_table', 1),
(7, '2025_09_05_200628_create_products_table', 1),
(8, '2025_09_05_211853_create_product_images_table', 1),
(9, '2025_09_30_071156_create_programs_table', 1),
(10, '2025_09_30_092659_rename_name_to_title_in_programs_table', 1),
(11, '2025_09_30_120447_add_start_end_date_to_programs_table', 1),
(12, '2025_09_30_133149_create_multiple_images_table', 1),
(13, '2025_10_01_091857_create_events_table', 1),
(14, '2025_10_01_094318_create_event_multiple_images_table', 1),
(15, '2025_10_04_163520_create_highlights_table', 1),
(16, '2025_10_08_101213_add_location_to_events_table', 1),
(17, '2025_10_16_080928_create_orders_table', 1),
(18, '2025_10_16_082608_create_order_items_table', 1),
(19, '2025_10_16_094637_add_order_status_to_orders_table', 1),
(20, '2025_10_16_121045_add_address_to_orders_table', 1),
(21, '2025_10_17_053133_add_profile_fields_to_users_table', 1),
(22, '2025_10_17_054233_create_transactions_table', 1),
(23, '2025_10_17_071936_create_event_bookings_table', 1),
(24, '2025_10_17_095553_add_phonenumber_to_orders_table', 1),
(25, '2025_10_18_054105_add_amount_to_transactions_table', 1),
(26, '2025_10_18_061712_create_projects_table', 1),
(27, '2025_11_15_225805_add_message_to_orders_table', 2),
(28, '2026_02_25_022048_create_services_table', 3),
(29, '2026_02_25_142510_create_multiple_post_images_table', 4),
(30, '2026_02_25_133221_create_contact_requests_table', 5),
(31, '2026_02_26_052042_create_locations_table', 6),
(32, '2026_02_26_120305_add_text_fields_to_services_table', 7),
(33, '2026_03_16_115325_create_service_images_table', 8),
(34, '2026_03_17_022544_create_contact_submissions_table', 9),
(35, '2026_03_17_025024_recreate_contact_submissions_table', 10),
(36, '2026_03_17_062732_create_seo_parameters_table', 11),
(37, '2026_03_17_063157_create_common_seo_parameters_table', 12),
(38, '2026_03_17_175059_add_seo_fields_to_posts_table', 13),
(39, '2026_03_18_103201_add_timestamps_to_common_seo_parameters_table', 14),
(40, '2026_03_18_114201_remove_seo_fields_from_posts_table', 15),
(41, '2026_03_17_125009_create_project_categories_table', 16),
(42, '2026_03_17_125134_create_projects_table', 17),
(43, '2026_03_18_092305_add_image_to_projects_table', 18),
(44, '2026_03_19_060855_create_project_images_table', 19),
(45, '2026_03_23_120706_add_slug_to_services_table', 20),
(46, '2026_03_31_122217_create_enquiries_table', 21),
(47, '2026_03_31_061052_create_solar_calculators_table', 22),
(48, '2026_04_01_111441_update_enquiries_table_make_location_email_nullable', 23),
(49, '2026_05_18_091049_create_services_table', 24),
(50, '2026_05_18_130735_create_contacts_table', 25),
(51, '2026_05_21_124351_create_members_table', 26),
(52, '2026_05_22_094216_add_icon_image_to_services_table', 27),
(53, '2026_05_23_092408_create_portfolio_categories_table', 28),
(54, '2026_05_23_092417_create_portfolios_table', 29),
(55, '2026_05_29_090420_create_custom_css_table', 30),
(56, '2026_05_29_101529_create_custom_javascripts_table', 31),
(57, '2026_06_01_093315_add_show_html_to_members_table', 32),
(58, '2026_06_01_093520_add_show_html_to_posts_table', 33),
(59, '2026_06_01_115558_add_show_html_to_services_table', 34),
(60, '2026_06_01_115637_add_show_html_to_portfolios_table', 35);

-- --------------------------------------------------------

--
-- Table structure for table `multiple_images`
--

DROP TABLE IF EXISTS `multiple_images`;
CREATE TABLE IF NOT EXISTS `multiple_images` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `program_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `multiple_images_program_id_foreign` (`program_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `multiple_post_images`
--

DROP TABLE IF EXISTS `multiple_post_images`;
CREATE TABLE IF NOT EXISTS `multiple_post_images` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `post_id` bigint UNSIGNED NOT NULL,
  `image_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `multiple_post_images_post_id_foreign` (`post_id`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `portfolios`
--

DROP TABLE IF EXISTS `portfolios`;
CREATE TABLE IF NOT EXISTS `portfolios` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `portfolio_category_id` bigint UNSIGNED NOT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `show_html` tinyint NOT NULL DEFAULT '0' COMMENT '0 = Plain Text, 1 = HTML/CKEditor',
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keywords` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `portfolios_slug_unique` (`slug`),
  KEY `portfolios_portfolio_category_id_foreign` (`portfolio_category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `portfolios`
--

INSERT INTO `portfolios` (`id`, `portfolio_category_id`, `title`, `slug`, `body`, `show_html`, `image`, `location`, `keywords`, `created_at`, `updated_at`) VALUES
(1, 1, 'TechCorp Offices', 'techcorp-offices', 'Modern and innovative office space designed for productivity, collaboration, and a professional corporate environment by Outline Architects', 0, 'uploads/portfolios/techcorp-offices.webp', 'Pune, India', NULL, '2026-05-23 04:44:59', '2026-05-28 05:38:36'),
(2, 1, 'Innovate Workspace', 'innovate-workspace', 'A modern workspace crafted to inspire innovation, collaboration, and productivity with smart design solutions by Outline Architects.', 0, 'uploads/portfolios/innovate-workspace.webp', 'Bangalore, India', NULL, '2026-05-23 04:48:44', '2026-05-28 05:38:36'),
(3, 2, 'Premium Residence', 'premium-residence', 'A luxurious residence designed with elegance, comfort, and timeless architectural excellence by Outline Architects.', 0, 'uploads/portfolios/premium-residence.webp', 'Hyderabad, India', NULL, '2026-05-23 04:50:20', '2026-05-28 05:38:36'),
(4, 3, 'Project Experience Center', 'project-experience-center', 'An immersive experience center designed to showcase innovation, creativity, and interactive architectural excellence by Outline Architects.', 0, 'uploads/portfolios/project-experience-center.webp', 'Delhi, India', NULL, '2026-05-23 04:52:24', '2026-05-28 05:38:36'),
(5, 5, 'Industrial Facility', 'industrial-facility', 'A modern industrial facility designed for efficiency, functionality, and sustainable operational excellence by Outline Architects.', 0, 'uploads/portfolios/industrial-facility.webp', 'Chakan, Pune', NULL, '2026-05-23 04:53:31', '2026-05-28 05:38:36'),
(6, 2, 'Modern Residence', 'modern-residence', 'A contemporary residence crafted with modern aesthetics, comfort, and functional living spaces by Outline Architects.', 0, 'uploads/portfolios/modern-residence.webp', 'Lonavala, India', NULL, '2026-05-23 04:54:41', '2026-05-28 05:38:36'),
(7, 4, 'Learning Commons', 'learning-commons', 'A dynamic learning space designed to encourage creativity, collaboration, and an inspiring educational environment by Outline Architects.', 0, 'uploads/portfolios/learning-commons.webp', 'Bangalore, India', NULL, '2026-05-23 04:55:47', '2026-05-28 05:38:36'),
(8, 5, 'Creative Studios', 'creative-studios', 'Creative Studios at Outline Architects is where ideas become innovative design.', 0, 'uploads/portfolios/creative-studios.webp', 'Bangalore, India', NULL, '2026-05-23 04:57:43', '2026-05-28 05:38:36'),
(9, 2, 'The Urban Hotel', 'the-urban-hotel', 'The Urban Hotel by Outline Architects is a contemporary hospitality space designed for comfort, style, and a vibrant city experience.', 0, 'uploads/portfolios/the-urban-hotel.webp', 'Goa, India', NULL, '2026-05-23 05:01:38', '2026-05-28 05:38:36'),
(10, 5, 'Corporate Headquarters', 'corporate-headquarters', 'Corporate Headquarters by Outline Architects is a modern workspace designed for efficiency, identity, and executive excellence.', 0, 'uploads/portfolios/corporate-headquarters.webp', 'Mumbai, India', NULL, '2026-05-23 05:03:01', '2026-05-28 05:38:36');

-- --------------------------------------------------------

--
-- Table structure for table `portfolio_categories`
--

DROP TABLE IF EXISTS `portfolio_categories`;
CREATE TABLE IF NOT EXISTS `portfolio_categories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keywords` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `portfolio_categories_slug_unique` (`slug`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `portfolio_categories`
--

INSERT INTO `portfolio_categories` (`id`, `name`, `slug`, `keywords`, `created_at`, `updated_at`) VALUES
(1, 'COMMERCIAL', 'commercial', NULL, '2026-05-23 04:22:41', '2026-05-23 04:22:41'),
(2, 'RESIDENTIAL', 'residential', NULL, '2026-05-23 04:23:37', '2026-05-23 04:23:37'),
(3, 'HOSPITALITY', 'hospitality', NULL, '2026-05-23 04:24:16', '2026-05-23 04:24:16'),
(4, 'INSTITUTIONAL', 'institutional', NULL, '2026-05-23 04:25:23', '2026-05-23 04:25:23'),
(5, 'INDUSTRIAL', 'industrial', NULL, '2026-05-23 04:25:50', '2026-05-23 04:25:50');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `show_html` tinyint NOT NULL DEFAULT '0' COMMENT '0 = Plain Text, 1 = HTML/CKEditor',
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_category_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `featured` int DEFAULT NULL,
  `gallery_category_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `posts_slug_unique` (`slug`),
  KEY `posts_post_category_id_foreign` (`post_category_id`),
  KEY `posts_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=302 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `slug`, `body`, `show_html`, `image`, `video_url`, `post_category_id`, `user_id`, `published`, `created_at`, `updated_at`, `featured`, `gallery_category_id`) VALUES
(243, 'Designing Spaces. | Inspiring Business.', 'designing-spaces-inspiring-business', '<p>We create innovative office and commercial interiors that elevate experiences and reflect your brand.</p>', 1, 'posts/designing-spaces-inspiring-business.webp', NULL, 56, 1, 0, '2026-05-18 00:15:33', '2026-06-01 06:07:46', NULL, NULL),
(244, 'About Outline', 'about-outline', '<h2><strong>10+</strong></h2><p>Years Of<br>Experience</p>', 0, NULL, NULL, 57, 1, 0, '2026-05-18 01:44:17', '2026-05-18 02:03:22', NULL, NULL),
(245, 'We Design. We Plan.We Deliver Excellence.', 'we-design-we-planwe-deliver-excellence', '<p>Outline Architects | Project Management is a multidisciplinary design firm specialising in office interiors, commercial interiors, workspace planning and end-to-end project management. We blend creativity, functionality and precision to deliver spaces that inspire productivity and growth.</p>', 0, 'posts/we-design-we-planwe-deliver-excellence.webp', NULL, 58, 1, 0, '2026-05-18 01:45:05', '2026-05-28 05:30:02', NULL, NULL),
(246, 'What We Do', 'what-we-do', '<h2><strong>Our Services</strong></h2>', 0, 'posts/what-we-do.webp', NULL, 59, 1, 0, '2026-05-18 03:58:22', '2026-05-28 05:30:02', NULL, NULL),
(247, 'Spaces That Speak Excellence', 'spaces-that-speak-excellence', '<p>Explore our portfolio of office and commercial projects crafted with creativity, detail and precision.</p>', 0, NULL, NULL, 60, 1, 0, '2026-05-18 05:21:35', '2026-05-18 05:21:35', NULL, NULL),
(248, 'TechCorp Offices', 'techcorp-offices', '<p>Pune</p>', 0, 'posts/techcorp-offices.webp', NULL, 61, 1, 0, '2026-05-18 05:22:09', '2026-05-28 05:30:02', NULL, NULL),
(249, 'Innovate Workspace', 'innovate-workspace', '<p>Bangalore</p>', 0, 'posts/innovate-workspace.webp', NULL, 61, 1, 0, '2026-05-18 05:23:13', '2026-05-28 05:30:02', NULL, NULL),
(250, 'Corporate Headquarters', 'corporate-headquarters', '<p>Mumbai</p>', 0, 'posts/corporate-headquarters.webp', NULL, 61, 1, 0, '2026-05-18 05:23:43', '2026-05-28 05:30:02', NULL, NULL),
(251, 'Project Experience Center', 'project-experience-center', '<p>Delhi</p>', 0, 'posts/project-experience-center.webp', NULL, 61, 1, 0, '2026-05-18 05:24:18', '2026-05-28 05:30:02', NULL, NULL),
(252, 'Fintech Hub', 'fintech-hub', '<p>Hyderabad</p>', 0, 'posts/fintech-hub.webp', NULL, 61, 1, 0, '2026-05-18 05:24:46', '2026-05-28 05:30:02', NULL, NULL),
(253, 'Creative Studio', 'creative-studio', '<p>Chennai</p>', 0, 'posts/creative-studio.webp', NULL, 61, 1, 0, '2026-05-18 05:25:15', '2026-05-28 05:30:02', NULL, NULL),
(254, 'Why Choose Us', 'why-choose-us', '<h4><strong>Our Promise</strong></h4><p>To deliver innovative, sustainable and functional spaces that elevate business and inspire people.</p>', 0, NULL, NULL, 62, 1, 0, '2026-05-18 06:19:22', '2026-05-18 06:32:08', NULL, NULL),
(255, 'We Create More Than Just Spaces', 'we-create-more-than-just-spaces', '<ul><li>Creative &amp; Functional Designs<br>&nbsp;</li><li>End-to-End Solutions<br>&nbsp;</li><li>Timely Delivery<br>&nbsp;</li><li>Quality Assurance<br>&nbsp;</li><li>Client-Centric Approach</li></ul>', 0, 'posts/we-create-more-than-just-spaces.webp', NULL, 52, 1, 0, '2026-05-18 06:20:40', '2026-05-28 05:30:03', NULL, NULL),
(256, '10+', '10', '<p>Years Of Experience</p>', 0, 'posts/10.webp', NULL, 4, 1, 0, '2026-05-18 06:45:38', '2026-05-28 05:30:03', NULL, NULL),
(257, '250+', '250', '<p>Projects Completed</p>', 0, 'posts/250.webp', NULL, 4, 1, 0, '2026-05-18 06:46:11', '2026-05-28 05:30:03', NULL, NULL),
(258, '150+', '150', '<p>Happy Clients</p>', 0, 'posts/150.webp', NULL, 4, 1, 0, '2026-05-18 06:46:36', '2026-05-28 05:30:03', NULL, NULL),
(259, '35+', '35', '<p>Team Members</p>', 0, 'posts/35.webp', NULL, 4, 1, 0, '2026-05-18 06:47:02', '2026-05-28 05:30:03', NULL, NULL),
(260, 'Clients Love Sharing', 'clients-love-sharing', '<h2><strong>What Our Clients</strong><br><strong>Say About Us</strong></h2>', 0, NULL, NULL, 63, 1, 0, '2026-05-18 06:51:54', '2026-05-18 06:51:54', NULL, NULL),
(261, 'Outline Architects transformed our workspace into a modern, collaborative environment. Their attention to detail and professionalism is exceptional.', 'outline-architects-transformed-our-workspace-into-a-modern-collaborative-environment-their-attention-to-detail-and-professionalism-is-exceptional', '<p><strong>Rohit Sharma</strong></p><p>CEO, TechCorp Solutions</p>', 0, 'posts/outline-architects-transformed-our-workspace-into-a-modern-collaborative-environment-their-attention-to-detail-and-professionalism-is-exceptional.webp', NULL, 8, 1, 0, '2026-05-18 06:52:34', '2026-05-28 05:30:03', NULL, NULL),
(262, 'A highly creative and professional team. They delivered our project on time with outstanding quality and commitment to excellence.', 'a-highly-creative-and-professional-team-they-delivered-our-project-on-time-with-outstanding-quality-and-commitment-to-excellence', '<p><strong>Anita Verma</strong></p><p>Director, Innovate Pvt. Ltd.</p>', 0, 'posts/a-highly-creative-and-professional-team-they-delivered-our-project-on-time-with-outstanding-quality-and-commitment-to-excellence.webp', NULL, 8, 1, 0, '2026-05-18 06:53:36', '2026-05-28 05:30:03', NULL, NULL),
(263, 'From planning to execution, the experience was seamless. Our new office truly reflects our brand and boosts team morale every day.', 'from-planning-to-execution-the-experience-was-seamless-our-new-office-truly-reflects-our-brand-and-boosts-team-morale-every-day', '<p><strong>Karan Mehta</strong></p><p>Founder, Creative Studio</p>', 0, 'posts/from-planning-to-execution-the-experience-was-seamless-our-new-office-truly-reflects-our-brand-and-boosts-team-morale-every-day.webp', NULL, 8, 1, 0, '2026-05-18 06:54:13', '2026-05-28 05:30:03', NULL, NULL),
(264, 'Let\'s Discuss Your Project', 'lets-discuss-your-project', '<p>Share your ideas with us and let\'s build spaces that inspire, engage and elevate your business.</p>', 0, 'posts/lets-discuss-your-project.webp', NULL, 64, 1, 0, '2026-05-18 07:09:08', '2026-05-28 05:30:04', NULL, NULL),
(265, '+91 98765-43210', '91-98765-43210', NULL, 0, NULL, NULL, 10, 1, 0, '2026-05-18 07:35:08', '2026-05-18 07:35:08', NULL, NULL),
(266, 'info@outlinespace.com', 'info-at-outlinespacecom', NULL, 0, NULL, NULL, 11, 1, 0, '2026-05-18 07:35:46', '2026-05-18 07:35:46', NULL, NULL),
(267, '7th Floor, Inspire Tower, Baker Road, Pune – 411045 Maharashtra, India', '7th-floor-inspire-tower-baker-road-pune-411045-maharashtra-india', NULL, 0, NULL, NULL, 12, 1, 0, '2026-05-18 07:36:09', '2026-05-18 07:36:09', NULL, NULL),
(268, 'Mon–Sat: 09:00 AM – 07:00 PM', 'mon-sat-0900-am-0700-pm', NULL, 0, NULL, NULL, 66, 1, 0, '2026-05-18 07:59:07', '2026-05-18 07:59:07', NULL, NULL),
(269, 'Our Story', 'our-story', '<p><strong>Our Promise</strong></p><p>To deliver innovative, sustainable, and functional spaces that elevate businesses and inspire people.</p>', 0, NULL, NULL, 67, 1, 0, '2026-05-21 05:55:20', '2026-05-21 05:55:20', NULL, NULL),
(270, 'Built on Vision. Driven by Purpose.', 'built-on-vision-driven-by-purpose', '<p>Founded with a vision to redefine the way spaces are conceived and delivered, Outline Architects brings together creativity, technical expertise, and a client-centric approach to every project.</p><p>From workplace and commercial interiors to large-scale project management, we partner with our clients from concept to completion — ensuring every detail reflects purpose, quality, and innovation.</p>', 0, 'posts/built-on-vision-driven-by-purpose.webp', NULL, 68, 1, 0, '2026-05-21 06:04:37', '2026-05-28 05:30:05', NULL, NULL),
(271, 'Our Values', 'our-values', '<h2><strong>The Principles That Guide Us</strong></h2>', 0, NULL, NULL, 70, 1, 0, '2026-05-21 06:58:56', '2026-05-21 06:58:56', NULL, NULL),
(272, 'Integrity', 'integrity', '<p>We build trust through transparency, honesty, and ethical practices.</p>', 0, 'posts/integrity.webp', NULL, 71, 1, 0, '2026-05-21 07:38:23', '2026-05-28 05:30:05', NULL, NULL),
(273, 'Innovation', 'innovation', '<p>We embrace creativity and new ideas to drive better solutions.</p>', 0, 'posts/innovation.webp', NULL, 71, 1, 0, '2026-05-21 07:38:51', '2026-05-28 05:30:05', NULL, NULL),
(274, 'Collaboration', 'collaboration', '<p>We work closely with our clients and partners to achieve shared success.</p>', 0, 'posts/collaboration.webp', NULL, 71, 1, 0, '2026-05-21 07:39:30', '2026-05-28 05:30:05', NULL, NULL),
(275, 'Excellence', 'excellence', '<p>We are committed to the highest standards in every detail.</p>', 0, 'posts/excellence.webp', NULL, 71, 1, 0, '2026-05-21 07:39:59', '2026-05-28 05:30:05', NULL, NULL),
(276, 'Sustainability', 'sustainability', '<p>We design and deliver responsible solutions for a better tomorrow.</p>', 0, 'posts/sustainability.webp', NULL, 71, 1, 0, '2026-05-21 07:40:34', '2026-05-28 05:30:05', NULL, NULL),
(277, 'Meet Our Leadership', 'meet-our-leadership', '<h2><strong>The Minds Behind the Vision</strong></h2>', 0, NULL, NULL, 72, 1, 0, '2026-05-22 00:49:24', '2026-05-22 00:49:24', NULL, NULL),
(278, 'Comprehensive Services', 'comprehensive-services', '<p>We combine creative design with technical expertise and meticulous planning&nbsp;</p><p>to deliver spaces that are functional, sustainable, and inspiring.</p>', 0, NULL, NULL, 73, 1, 0, '2026-05-23 00:15:07', '2026-05-23 00:51:53', NULL, NULL),
(279, 'More Than Design. We Deliver Value.', 'more-than-design-we-deliver-value', '<p>Our integrated approach ensures every project is handled with precision, transparency, and a commitment to excellence.</p>', 0, NULL, NULL, 74, 1, 0, '2026-05-23 00:16:11', '2026-05-23 00:16:11', NULL, NULL),
(280, 'Client-Focused', 'client-focused', '<p>We listen, collaborate, and deliver solutions tailored for your needs.</p>', 0, 'posts/client-focused.webp', NULL, 75, 1, 0, '2026-05-23 00:25:30', '2026-05-28 05:30:05', NULL, NULL),
(281, 'Innovative Approach', 'innovative-approach', '<p>Smart strategies that bring your vision to life brilliantly.</p><p>&nbsp;</p><p><br>&nbsp;</p>', 0, 'posts/innovative-approach.webp', NULL, 75, 1, 0, '2026-05-23 00:27:12', '2026-05-28 05:30:06', NULL, NULL),
(282, 'Quality Assurance', 'quality-assurance', '<p>Highest standards in design, documentation, and delivery.</p>', 0, 'posts/quality-assurance.webp', NULL, 75, 1, 0, '2026-05-23 00:27:51', '2026-05-28 05:30:06', NULL, NULL),
(283, 'On-Time Delivery', 'on-time-delivery', '<p>Efficient planning and execution to deliver projects on schedule.</p>', 0, 'posts/on-time-delivery.webp', NULL, 75, 1, 0, '2026-05-23 00:28:21', '2026-05-28 05:30:06', NULL, NULL),
(284, 'Our Services|Design. Plan. Deliver.', 'our-servicesdesign-plan-deliver', '<p>From concept to completion, we provide end-to-end architecture and project management solutions tailored to your vision and goals.</p>', 0, 'posts/our-servicesdesign-plan-deliver.webp', NULL, 76, 1, 0, '2026-05-23 00:35:13', '2026-05-28 05:30:06', NULL, NULL),
(285, 'Our Work. | Built on Trust.', 'our-work-built-on-trust', '<p>Explore a curated selection of projects that reflect our passion for design, attention to detail, and commitment to delivering exceptional spaces.</p><p><br>&nbsp;</p>', 0, 'posts/our-work-built-on-trust.webp', NULL, 77, 1, 0, '2026-05-23 07:22:03', '2026-05-28 05:30:07', NULL, NULL),
(286, 'Designing Spaces. | Inspiring Impact.', 'designing-spaces-inspiring-impact', '<p>Outline Architects is a multidisciplinary design firm passionate about creating innovative, functional, and sustainable spaces that elevate experiences and drive business success.</p>', 0, 'posts/designing-spaces-inspiring-impact.webp', NULL, 78, 1, 0, '2026-05-23 08:04:45', '2026-05-28 05:30:07', NULL, NULL),
(287, 'Let\'s Build | Something Great |  Together.', 'lets-build-something-great-together', '<p>Have a project in mind? We\'d love to hear from you. Reach out to our team and let\'s create spaces that inspire.</p><p>&nbsp;</p><p><br>&nbsp;</p>', 0, 'posts/lets-build-something-great-together.webp', NULL, 80, 1, 0, '2026-05-27 01:09:37', '2026-05-28 05:30:08', NULL, NULL),
(288, 'Build Your |  Future With Us.', 'build-your-future-with-us', '<p>We’re always looking for talented and motivated individuals who share our passion for design and excellence. Let’s build inspiring spaces together.</p><p>&nbsp;</p>', 0, 'posts/build-your-future-with-us.webp', NULL, 81, 1, 0, '2026-05-28 00:29:04', '2026-05-28 05:30:08', NULL, NULL),
(289, 'Career Growth', 'career-growth', '<p>Grow your skills with exciting projects, hands-on experience, and continuous learning opportunities.</p>', 0, 'posts/career-growth.webp', NULL, 82, 1, 0, '2026-05-28 01:08:46', '2026-05-28 05:30:08', NULL, NULL),
(290, 'Creative Work Culture', 'creative-work-culture', '<p>Work in a collaborative environment where creativity, innovation, and fresh ideas are always encouraged.</p>', 0, 'posts/creative-work-culture.webp', NULL, 82, 1, 0, '2026-05-28 01:09:54', '2026-05-28 05:30:08', NULL, NULL),
(291, 'Inspiring Projects', 'inspiring-projects', '<p>Be part of impactful architectural and interior projects that shape modern and functional spaces.</p>', 0, 'posts/inspiring-projects.webp', NULL, 82, 1, 0, '2026-05-28 01:10:30', '2026-05-28 05:30:08', NULL, NULL),
(292, 'Supportive Team', 'supportive-team', '<p>Join a passionate and friendly team that values teamwork, respect, and professional growth.</p>', 0, 'posts/supportive-team.webp', NULL, 82, 1, 0, '2026-05-28 01:11:11', '2026-05-28 05:30:08', NULL, NULL),
(293, 'outlinearchitects', 'outlinearchitects', '<p>outlinearchitects</p>', 0, 'posts/outlinearchitects.webp', NULL, 14, 1, 0, '2026-05-28 01:44:38', '2026-05-28 05:30:09', NULL, NULL),
(294, 'We design and deliver innovative office and commercial interiors with creativity, precision and passion.', 'we-design-and-deliver-innovative-office-and-commercial-interiors-with-creativity-precision-and-passion', '<p>Stay connected with us on social media for updates, project showcases and design inspiration.</p>', 0, NULL, NULL, 83, 1, 0, '2026-05-28 01:56:38', '2026-05-28 01:56:38', NULL, NULL),
(300, 'Get In Touch', 'get-in-touch', 'We\'d Love To Hear From You', 0, NULL, NULL, 84, 1, 0, '2026-06-01 23:50:09', '2026-06-01 23:50:09', NULL, NULL),
(301, 'Apply to job banner', 'apply-to-job-banner', NULL, 0, 'posts/apply-to-job-banner.webp', NULL, 85, 1, 0, '2026-06-01 23:56:59', '2026-06-01 23:56:59', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `post_categories`
--

DROP TABLE IF EXISTS `post_categories`;
CREATE TABLE IF NOT EXISTS `post_categories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `post_categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_categories`
--

INSERT INTO `post_categories` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Slider', 'slider', '2025-09-06 04:10:42', '2025-09-06 04:10:42'),
(2, 'About S', 'about-s', '2025-09-07 04:57:37', '2025-09-07 04:57:37'),
(3, 'Features', 'features', '2025-09-07 16:41:19', '2025-09-07 16:41:19'),
(4, 'Counter', 'counter', '2025-09-07 17:23:48', '2025-09-07 17:23:48'),
(5, 'Whychooseus', 'whychooseus', '2025-09-07 17:29:56', '2025-09-07 17:29:56'),
(6, 'Facilities', 'facilities', '2025-09-07 17:36:20', '2025-09-07 17:36:20'),
(7, 'Gallery', 'gallery', '2025-09-07 18:01:21', '2025-09-07 18:01:21'),
(8, 'Testimonials', 'testimonials', '2025-09-07 18:09:50', '2025-09-07 18:09:50'),
(9, 'Faq', 'faq', '2025-09-07 18:18:39', '2025-09-07 18:18:39'),
(10, 'Phone', 'phone', '2025-09-07 18:22:56', '2025-09-07 18:22:56'),
(11, 'Email', 'email', '2025-09-07 18:25:20', '2025-09-07 18:25:20'),
(12, 'Address', 'address', '2025-09-08 01:01:13', '2025-09-08 01:01:13'),
(13, 'Social Icons', 'social-icons', '2025-09-08 01:05:16', '2025-09-08 01:05:16'),
(14, 'Logo', 'logo', '2025-09-08 01:16:16', '2025-09-08 01:16:16'),
(15, 'Highlights', 'Highlights', NULL, NULL),
(16, 'commondonation', 'commondonation', NULL, NULL),
(17, 'Cancellation and  Refunds', 'cancellation-and-refunds', '2025-11-15 15:40:27', '2025-11-15 15:40:27'),
(18, 'termsandconditions', 'termsandconditions', '2025-11-15 16:25:48', '2025-11-15 16:25:48'),
(19, 'shipping', 'shipping', '2025-11-15 16:26:03', '2025-11-15 16:26:03'),
(20, 'privacy', 'privacy', '2025-11-15 16:26:16', '2025-11-15 16:26:16'),
(21, 'timing', 'timing', NULL, NULL),
(22, 'innerbanner', 'innerbanner', NULL, NULL),
(23, 'Second logo', 'second-logo', '2025-11-24 17:19:24', '2025-11-24 17:19:24'),
(24, 'About Us Home', 'about-us-home', '2025-11-24 22:43:02', '2025-11-24 22:43:02'),
(25, 'Blogs', 'blogs', '2025-11-25 01:33:27', '2025-11-25 01:33:27'),
(26, 'Companies', 'companies', '2025-11-26 19:38:14', '2025-11-26 19:38:14'),
(27, 'Common banner', 'common-banner', '2025-11-26 20:19:36', '2025-11-26 20:19:36'),
(28, 'Time', 'time', '2025-11-27 15:25:38', '2025-11-27 15:25:38'),
(29, 'Metal Scrap', 'metal-scrap', '2026-02-23 06:48:01', '2026-02-23 06:48:01'),
(30, 'Copper Scrap', 'copper-scrap', '2026-02-23 06:48:53', '2026-02-23 06:48:53'),
(31, 'banner', 'banner', '2026-02-24 01:09:28', '2026-02-24 01:09:28'),
(32, 'commitment', 'commitment', '2026-02-25 03:55:47', '2026-02-25 03:55:47'),
(33, 'diffservice', 'diffservice', '2026-02-25 07:21:27', '2026-02-25 07:21:27'),
(34, 'contact', 'contact', '2026-02-25 08:04:15', '2026-02-25 08:04:15'),
(37, 'sponsors', 'sponsors', '2026-03-12 02:48:54', '2026-03-12 02:48:54'),
(39, 'printingservice', 'printingservice', '2026-03-12 05:20:05', '2026-03-12 05:20:05'),
(40, 'brand', 'brand', '2026-03-12 05:56:26', '2026-03-12 05:56:26'),
(41, 'faqsection', 'faqsection', '2026-03-12 07:56:35', '2026-03-12 07:56:35'),
(42, 'casestudies', 'casestudies', '2026-03-13 00:14:00', '2026-03-13 00:14:00'),
(43, 'team', 'team', '2026-03-14 05:45:12', '2026-03-14 05:45:12'),
(44, 'twitterblogs', 'twitterblogs', '2026-03-15 23:43:35', '2026-03-15 23:43:35'),
(49, 'status', 'status', '2026-03-19 01:06:28', '2026-03-19 01:06:28'),
(50, 'Our Journey', 'our-journey', '2026-03-31 05:02:35', '2026-03-31 05:02:35'),
(51, 'Our Expertise', 'our-expertise', '2026-03-31 06:46:04', '2026-03-31 06:46:04'),
(52, 'why choose us', 'why-choose-us', '2026-03-31 07:40:53', '2026-03-31 07:40:53'),
(53, 'specifications', 'specifications', '2026-04-02 03:36:48', '2026-04-02 03:36:48'),
(54, 'product list', 'product-list', '2026-04-02 05:13:13', '2026-04-02 05:13:13'),
(55, 'projectlisting', 'projectlisting', '2026-04-04 00:54:28', '2026-04-04 00:54:28'),
(56, 'Home Banner', 'home-banner', '2026-05-18 00:13:10', '2026-05-18 00:13:10'),
(57, 'about us title', 'about-us-title', '2026-05-18 01:38:07', '2026-05-18 01:38:07'),
(58, 'home about us', 'home-about-us', '2026-05-18 01:39:04', '2026-05-18 01:39:04'),
(59, 'service Title', 'service-title', '2026-05-18 03:53:58', '2026-05-18 03:53:58'),
(60, 'featured work title', 'featured-work-title', '2026-05-18 05:17:48', '2026-05-18 05:17:48'),
(61, 'featured work', 'featured-work', '2026-05-18 05:18:50', '2026-05-18 05:18:50'),
(62, 'why choose us title', 'why-choose-us-title', '2026-05-18 06:12:55', '2026-05-18 06:12:55'),
(63, 'testimonials title', 'testimonials-title', '2026-05-18 06:50:19', '2026-05-18 06:50:19'),
(64, 'cta', 'cta', '2026-05-18 07:05:13', '2026-05-18 07:05:13'),
(66, 'timings', 'timings', '2026-05-18 07:58:04', '2026-05-18 07:58:04'),
(67, 'Our Story title', 'our-story-title', '2026-05-21 05:48:54', '2026-05-21 05:48:54'),
(68, 'Our Story', 'our-story', '2026-05-21 05:51:14', '2026-05-21 05:51:14'),
(70, 'Our Value title', 'our-value-title', '2026-05-21 06:56:05', '2026-05-21 06:56:05'),
(71, 'Our Values', 'our-values', '2026-05-21 06:56:11', '2026-05-21 06:56:11'),
(72, 'member title', 'member-title', '2026-05-22 00:42:00', '2026-05-22 00:42:00'),
(73, 'service content', 'service-content', '2026-05-22 08:13:59', '2026-05-22 08:13:59'),
(74, 'why choose us', 'why-choose-us-2', '2026-05-23 00:06:57', '2026-05-23 00:06:57'),
(75, 'why choose us card', 'why-choose-us-card', '2026-05-23 00:07:31', '2026-05-23 00:07:31'),
(76, 'service banner', 'service-banner', '2026-05-23 00:11:19', '2026-05-23 00:11:19'),
(77, 'portfolio banner', 'portfolio-banner', '2026-05-23 07:18:14', '2026-05-23 07:18:14'),
(78, 'about banner', 'about-banner', '2026-05-23 07:37:20', '2026-05-23 07:37:20'),
(80, 'contact banner', 'contact-banner', '2026-05-27 00:59:57', '2026-05-27 00:59:57'),
(81, 'careers banner', 'careers-banner', '2026-05-28 00:28:22', '2026-05-28 00:28:22'),
(82, 'career highlights', 'career-highlights', '2026-05-28 01:08:05', '2026-05-28 01:08:05'),
(83, 'footer content', 'footer-content', '2026-05-28 01:49:21', '2026-05-28 01:49:21'),
(84, 'contact content', 'contact-content', '2026-06-01 23:45:33', '2026-06-01 23:45:33'),
(85, 'apply job banner', 'apply-job-banner', '2026-06-01 23:56:00', '2026-06-01 23:56:00');

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

DROP TABLE IF EXISTS `programs`;
CREATE TABLE IF NOT EXISTS `programs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_date` timestamp NULL DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`id`, `title`, `created_date`, `start_date`, `end_date`, `description`, `image`, `video_id`, `created_at`, `updated_at`) VALUES
(1, 'Support Our Mission', '2025-11-17 01:21:00', NULL, NULL, 'Your contribution powers on-ground programmes, school outreach, recycling operations, and community initiatives. Transparent, accountable, and directed toward creating long-term environmental impact.', 'Program_images/1764027570_New Project (3) (1).jpg', NULL, '2025-11-08 14:59:08', '2025-11-24 23:39:30'),
(2, 'Recycle Your E-Waste', '2025-11-17 01:20:00', NULL, NULL, 'Give your old electronics a responsible ending. Drop off unused chargers, phones, and devices at our collection points and we’ll ensure they’re processed safely, ethically, and without harming the environment.', 'Program_images/1764027698_1764027337_sustainable-travel-concept (1).jpg', NULL, '2025-11-08 15:07:41', '2025-11-24 23:41:38'),
(3, 'Volunteer With Us', '2025-11-17 01:20:00', NULL, NULL, 'Your time can spark real change. Join our awareness drives, school programmes, and community events. Every hour you give strengthens our movement and helps more people understand how to protect the planet.', 'Program_images/1764027239_Gemini_Generated_Image_qiemkkqiemkkqiem (1).png', NULL, '2025-11-08 15:08:08', '2025-11-24 23:33:59');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2025-11-02 13:42:33', '2025-11-02 13:42:33'),
(2, 'user', '2025-11-02 13:42:33', '2025-11-02 13:42:33');

-- --------------------------------------------------------

--
-- Table structure for table `role_routes`
--

DROP TABLE IF EXISTS `role_routes`;
CREATE TABLE IF NOT EXISTS `role_routes` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_id` bigint UNSIGNED NOT NULL,
  `route_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `role_routes_role_id_route_name_unique` (`role_id`,`route_name`)
) ENGINE=InnoDB AUTO_INCREMENT=2117 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_routes`
--

INSERT INTO `role_routes` (`id`, `role_id`, `route_name`, `created_at`, `updated_at`) VALUES
(3, 2, 'user.dashboard', '2025-11-02 13:42:35', '2025-11-02 13:42:35'),
(1931, 1, 'admin.admin.roles.update_name', '2026-03-19 00:13:36', '2026-03-19 00:13:36'),
(1932, 1, 'admin.dashboard', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1933, 1, 'admin.dashboard.activity', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1934, 1, 'admin.dashboard.stats', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1935, 1, 'admin.dashboard.status-distribution', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1936, 1, 'admin.donations.export', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1937, 1, 'admin.donations.index', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1938, 1, 'admin.donations.show', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1939, 1, 'admin.events.create', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1940, 1, 'admin.events.destroy', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1941, 1, 'admin.events.edit', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1942, 1, 'admin.events.images.store', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1943, 1, 'admin.events.index', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1944, 1, 'admin.events.show', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1945, 1, 'admin.events.store', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1946, 1, 'admin.events.update', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1947, 1, 'admin.ewaste-donations.destroy', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1948, 1, 'admin.ewaste-donations.export', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1949, 1, 'admin.ewaste-donations.index', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1950, 1, 'admin.ewaste-donations.show', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1951, 1, 'admin.ewaste-donations.statistics', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1952, 1, 'admin.ewaste-donations.status', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1953, 1, 'admin.gallery-categories.create', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1954, 1, 'admin.gallery-categories.destroy', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1955, 1, 'admin.gallery-categories.edit', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1956, 1, 'admin.gallery-categories.index', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1957, 1, 'admin.gallery-categories.show', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1958, 1, 'admin.gallery-categories.store', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1959, 1, 'admin.gallery-categories.update', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1960, 1, 'admin.highlights.create', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1961, 1, 'admin.highlights.destroy', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1962, 1, 'admin.highlights.edit', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1963, 1, 'admin.highlights.index', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1964, 1, 'admin.highlights.show', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1965, 1, 'admin.highlights.store', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1966, 1, 'admin.highlights.update', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1967, 1, 'admin.orderitems.create', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1968, 1, 'admin.orderitems.destroy', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1969, 1, 'admin.orderitems.edit', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1970, 1, 'admin.orderitems.index', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1971, 1, 'admin.orderitems.show', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1972, 1, 'admin.orderitems.store', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1973, 1, 'admin.orderitems.update', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1974, 1, 'admin.orders.create', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1975, 1, 'admin.orders.destroy', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1976, 1, 'admin.orders.edit', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1977, 1, 'admin.orders.index', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1978, 1, 'admin.orders.show', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1979, 1, 'admin.orders.store', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1980, 1, 'admin.orders.update', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1981, 1, 'admin.page.create', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1982, 1, 'admin.page.destroy', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1983, 1, 'admin.page.edit', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1984, 1, 'admin.page.index', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1985, 1, 'admin.page.show', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1986, 1, 'admin.page.store', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1987, 1, 'admin.page.update', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1988, 1, 'admin.post-categories.create', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1989, 1, 'admin.post-categories.destroy', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1990, 1, 'admin.post-categories.edit', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1991, 1, 'admin.post-categories.index', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1992, 1, 'admin.post-categories.show', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1993, 1, 'admin.post-categories.store', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1994, 1, 'admin.post-categories.update', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1995, 1, 'admin.posts.create', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1996, 1, 'admin.posts.destroy', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1997, 1, 'admin.posts.edit', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1998, 1, 'admin.posts.index', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(1999, 1, 'admin.posts.show', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2000, 1, 'admin.posts.store', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2001, 1, 'admin.posts.update', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2002, 1, 'admin.product-categories.create', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2003, 1, 'admin.product-categories.destroy', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2004, 1, 'admin.product-categories.edit', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2005, 1, 'admin.product-categories.index', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2006, 1, 'admin.product-categories.show', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2007, 1, 'admin.product-categories.store', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2008, 1, 'admin.product-categories.update', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2009, 1, 'admin.products.create', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2010, 1, 'admin.products.destroy', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2011, 1, 'admin.products.edit', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2012, 1, 'admin.products.index', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2013, 1, 'admin.products.show', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2014, 1, 'admin.products.store', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2015, 1, 'admin.products.update', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2016, 1, 'admin.programs.create', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2017, 1, 'admin.programs.destroy', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2018, 1, 'admin.programs.edit', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2019, 1, 'admin.programs.images.store', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2020, 1, 'admin.programs.index', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2021, 1, 'admin.programs.show', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2022, 1, 'admin.programs.store', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2023, 1, 'admin.programs.update', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2024, 1, 'admin.project-categories.create', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2025, 1, 'admin.project-categories.destroy', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2026, 1, 'admin.project-categories.edit', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2027, 1, 'admin.project-categories.index', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2028, 1, 'admin.project-categories.show', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2029, 1, 'admin.project-categories.store', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2030, 1, 'admin.project-categories.update', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2031, 1, 'admin.projects.create', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2032, 1, 'admin.projects.destroy', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2033, 1, 'admin.projects.edit', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2034, 1, 'admin.projects.index', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2035, 1, 'admin.projects.show', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2036, 1, 'admin.projects.store', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2037, 1, 'admin.projects.update', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2038, 1, 'admin.roles.create', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2039, 1, 'admin.roles.edit_routes', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2040, 1, 'admin.roles.index', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2041, 1, 'admin.roles.store', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2042, 1, 'admin.roles.update_routes', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2043, 1, 'admin.support.destroy', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2044, 1, 'admin.support.edit', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2045, 1, 'admin.support.index', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2046, 1, 'admin.support.show', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2047, 1, 'admin.support.stats', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2048, 1, 'admin.support.update', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2049, 1, 'admin.transactions.create', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2050, 1, 'admin.transactions.destroy', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2051, 1, 'admin.transactions.edit', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2052, 1, 'admin.transactions.index', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2053, 1, 'admin.transactions.show', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2054, 1, 'admin.transactions.store', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2055, 1, 'admin.transactions.update', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2056, 1, 'admin.upload.image', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2057, 1, 'admin.user.change-password', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2058, 1, 'admin.user.change-password.form', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2059, 1, 'admin.users.create', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2060, 1, 'admin.users.edit', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2061, 1, 'admin.users.index', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2062, 1, 'admin.users.show', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2063, 1, 'admin.users.store', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2064, 1, 'admin.users.update', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2065, 1, 'admin.volunteers.destroy', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2066, 1, 'admin.volunteers.export', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2067, 1, 'admin.volunteers.index', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2068, 1, 'admin.volunteers.show', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2069, 1, 'admin.volunteers.statistics', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2070, 1, 'admin.volunteers.status', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2071, 1, 'blogs.details', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2072, 1, 'book.event', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2073, 1, 'cancellation-and-refunds', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2074, 1, 'contact.submit', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2075, 1, 'donate.create-order', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2076, 1, 'donate.form', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2077, 1, 'donate.store', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2078, 1, 'donate.submit', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2079, 1, 'donation.verify', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2080, 1, 'events', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2081, 1, 'events.details', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2082, 1, 'ewaste.donate', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2083, 1, 'ewaste.donate.form', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2084, 1, 'home.about', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2085, 1, 'home.blogs', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2086, 1, 'home.donate', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2087, 1, 'home.index', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2088, 1, 'home.portfolio', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2089, 1, 'home.programs', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2090, 1, 'home.time', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2091, 1, 'login', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2092, 1, 'logout', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2093, 1, 'password.confirm', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2094, 1, 'password.email', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2095, 1, 'password.request', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2096, 1, 'password.reset', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2097, 1, 'password.update', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2098, 1, 'privacy', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2099, 1, 'profile', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2100, 1, 'profile.edit', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2101, 1, 'profile.reports', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2102, 1, 'profile.update', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2103, 1, 'programs.details', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2104, 1, 'projects.details', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2105, 1, 'projects.list', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2106, 1, 'register', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2107, 1, 'sanctum.csrf-cookie', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2108, 1, 'shipping', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2109, 1, 'signup', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2110, 1, 'signup.post', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2111, 1, 'storage.local', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2112, 1, 'support', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2113, 1, 'support.submit', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2114, 1, 'termsandconditions', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2115, 1, 'volunteer.register', '2026-03-19 00:13:37', '2026-03-19 00:13:37'),
(2116, 1, 'volunteer.register.form', '2026-03-19 00:13:37', '2026-03-19 00:13:37');

-- --------------------------------------------------------

--
-- Table structure for table `seo_parameters`
--

DROP TABLE IF EXISTS `seo_parameters`;
CREATE TABLE IF NOT EXISTS `seo_parameters` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `route_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `og_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seo_parameters`
--

INSERT INTO `seo_parameters` (`id`, `route_name`, `title`, `meta_title`, `meta_description`, `og_image`, `created_at`, `updated_at`) VALUES
(1, '/', NULL, 'Designing Spaces. Inspiring Business.', 'We create innovative office and commercial interiors that elevate experiences and reflect your brand.', 'seo-images/mAqNsxSdghpYi2LlQGrkzG3SLxIh7IPjubZhijW2.jpg', '2026-03-18 03:14:46', '2026-06-01 08:12:07'),
(2, '/about-us', NULL, 'Designing Spaces. Inspiring Impact.', 'Outline Architects is a multidisciplinary design firm passionate about creating innovative, functional, and sustainable spaces that elevate experiences and drive business success.', 'seo-images/YXars70aJtxc2r1LdFlMDIe4xvMnLf5AmA8c6GTk.webp', '2026-06-01 07:58:21', '2026-06-01 07:58:21'),
(3, '/services', NULL, 'Home / Services Our Services Design. Plan. Deliver.', 'From concept to completion, we provide end-to-end architecture and project management solutions tailored to your vision and goals.', NULL, '2026-06-01 08:12:45', '2026-06-01 08:12:45'),
(4, '/portfolio', NULL, 'Our Work. Built on Trust.', 'Explore a curated selection of projects that reflect our passion for design, attention to detail, and commitment to delivering exceptional spaces.', NULL, '2026-06-01 08:13:42', '2026-06-01 08:13:42'),
(5, '/careers', NULL, 'Build Your Future With Us.', NULL, NULL, '2026-06-01 08:14:36', '2026-06-01 08:14:36'),
(6, '/contact', NULL, 'Let\'s Build Something Great Together.', 'Have a project in mind? We\'d love to hear from you. Reach out to our team and let\'s create spaces that inspire.', NULL, '2026-06-01 08:15:08', '2026-06-01 08:15:08');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `show_html` tinyint NOT NULL DEFAULT '0' COMMENT '0 = Plain Text, 1 = HTML/CKEditor',
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon_image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keyword` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `services_slug_unique` (`slug`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `slug`, `body`, `show_html`, `image`, `icon_image`, `keyword`, `created_at`, `updated_at`) VALUES
(1, 'Architecture', 'architecture-outline', 'Innovative architectural design that blends aesthetics, functionality, and sustainability.', 0, 'uploads/services/architecture.webp', 'uploads/services/icons/architecture-icon.webp', NULL, '2026-05-18 04:17:46', '2026-05-28 05:35:05'),
(2, 'Interior Design', 'interior-design', 'Creating beautiful, functional interiors that enhance experience and reflect your brand.', 0, 'uploads/services/interior-design.webp', 'uploads/services/icons/interior-design-icon.webp', NULL, '2026-05-18 04:18:16', '2026-05-28 05:35:05'),
(3, 'BIM Services', 'bim-services', 'Advanced BIM modelling for accurate planning, coordination, and smarter decision-making.', 0, 'uploads/services/bim-services.webp', 'uploads/services/icons/bim-services-icon.webp', NULL, '2026-05-18 04:18:43', '2026-05-28 05:35:05'),
(4, 'Project Management', 'project-management-outline', 'End-to-end interior execution from concept to completion.', 0, 'uploads/services/project-management.webp', 'uploads/services/icons/project-management-icon.webp', NULL, '2026-05-18 04:19:10', '2026-05-28 05:35:05'),
(5, 'Sustainable Design', 'sustainable-design', 'Eco-conscious solutions that minimise environmental impact and promote green living.', 0, 'uploads/services/sustainable-design.webp', 'uploads/services/icons/sustainable-design-icon.webp', NULL, '2026-05-18 04:19:37', '2026-05-28 05:35:05'),
(6, 'Space Planning', 'space-planning', 'Smart space utilisation strategies to optimise efficiency and support your goals.', 0, 'uploads/services/space-planning.webp', 'uploads/services/icons/space-planning-icon.webp', NULL, '2026-05-22 07:39:52', '2026-05-28 05:35:05'),
(7, 'Construction Support', 'construction-support', 'On-site support and coordination to ensure smooth execution and quality control.', 0, 'uploads/services/construction-support.webp', 'uploads/services/icons/construction-support-icon.webp', NULL, '2026-05-22 07:40:56', '2026-05-28 05:35:05'),
(8, 'Feasibility Studies', 'feasibility-studies', 'Detailed analysis and planning to assess project viability and maximise potential.', 0, 'uploads/services/feasibility-studies.webp', 'uploads/services/icons/feasibility-studies-icon.webp', NULL, '2026-05-22 07:41:45', '2026-05-28 05:35:05');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('oR2XwuDoy08I4m7IQwiZDrWJVlk1N8w2EyZGE1gR', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiMzh2RTJvb0dnZ2FLaTNVczJwUURoVkNOVXo3SmQ2Z0wwVUpnYm1DbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jb250YWN0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czo0OiJhdXRoIjthOjE6e3M6MjE6InBhc3N3b3JkX2NvbmZpcm1lZF9hdCI7aToxNzcyMDgzNjkxO319', 1772102425);

-- --------------------------------------------------------

--
-- Table structure for table `support_messages`
--

DROP TABLE IF EXISTS `support_messages`;
CREATE TABLE IF NOT EXISTS `support_messages` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('new','in_progress','resolved','closed') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'new',
  `admin_notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `support_messages`
--

INSERT INTO `support_messages` (`id`, `name`, `email`, `phone`, `subject`, `message`, `status`, `admin_notes`, `created_at`, `updated_at`) VALUES
(1, 'Mohammed shafi MC', 'nrproperties.in@gmail.com', '7025012220', 'Technical Issue', 'kjbk   iihhii', 'in_progress', NULL, '2025-11-20 16:50:26', '2025-11-20 16:50:47'),
(2, 'Mohammed shafi MC', 'mshafimcw@gmail.com', '08078334928', 'Partnership Inquiry', 'cbb fggdf gsdgdg', 'new', NULL, '2025-11-20 16:54:21', '2025-11-20 16:54:21'),
(3, 'B', 'bhavyanandakumar@gmail.com', 'test', 'test', 'testing testing testing testing testing testing testing testing', 'new', NULL, '2025-11-24 09:53:15', '2025-11-24 09:53:15'),
(4, 'Mohammed shafi MC', 'iamshafimc@gmail.com', '7025012220', 'General Inquiry', 'uggu  jhihi hi', 'new', NULL, '2025-11-26 20:53:42', '2025-11-26 20:53:42');

-- --------------------------------------------------------

--
-- Table structure for table `timings`
--

DROP TABLE IF EXISTS `timings`;
CREATE TABLE IF NOT EXISTS `timings` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `timings`
--

INSERT INTO `timings` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Monday: 9AM - 7PM', '2025-11-19 17:13:13', '2025-11-19 17:13:13'),
(2, 'Tuesday: 9AM - 7PM', '2025-11-19 17:13:13', '2025-11-19 17:13:13'),
(3, 'Wednesday: 9AM - 7PM', '2025-11-19 17:13:13', '2025-11-19 17:13:13'),
(4, 'Thursday: 9AM - 7PM', '2025-11-19 17:13:13', '2025-11-19 17:13:13'),
(5, 'Friday: 9AM - 7PM', '2025-11-19 17:13:13', '2025-11-19 17:13:13'),
(6, 'Saturday: 10AM - 5PM', '2025-11-19 17:13:13', '2025-11-19 17:13:13');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `from` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `to` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `transactions_transaction_code_unique` (`transaction_code`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `from`, `to`, `transaction_code`, `amount`, `created_at`, `updated_at`) VALUES
(11, 'iamshafimc@gmail.com', 'ENVED Foundation', 'pay_RkuMxjXqwpvdDt', 12.00, '2025-11-27 21:11:50', '2025-11-27 21:11:50'),
(13, 'iamshafimc@gmail.com', 'ENVED Foundation', 'pay_RkuP4YSHdNFbIx', 13.00, '2025-11-27 21:13:47', '2025-11-27 21:13:47'),
(15, 'iamshafimc@gmail.com', 'ENVED Foundation', 'pay_RkuRW2j53ibMau', 14.00, '2025-11-27 21:16:06', '2025-11-27 21:16:06'),
(16, 'iamshafimc@gmail.com', 'ENVED Foundation', 'pay_RkuSnFqXPinoXS', 10.00, '2025-11-27 21:17:20', '2025-11-27 21:17:20'),
(17, 'iamshafimc@gmail.com', 'ENVED Foundation', 'pay_RkuTwgAd5LfTv1', 10.00, '2025-11-27 21:18:24', '2025-11-27 21:18:24'),
(18, 'info2mpj@gmail.com', 'ENVED Foundation', 'pay_RozHp3KWLqpuoo', 50.00, '2025-12-08 04:36:31', '2025-12-08 04:36:31'),
(19, 'iamshafimc@gmail.com', 'ENVED Foundation', 'pay_RpflAOHK6GzgE9', 10.00, '2025-12-09 22:09:43', '2025-12-09 22:09:43'),
(20, 'iamshafimc@gmail.com', 'ENVED Foundation', 'pay_Rpfn0V4JZrKCaI', 11.00, '2025-12-09 22:11:04', '2025-12-09 22:11:04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cover_image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` bigint UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `profile_image`, `location`, `description`, `cover_image`, `role_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Shafi MC', 'iamshafimc@gmail.com', NULL, '$2y$12$i0ogXuIXO2FTrpyNZHj4P.H2.6TM1hBK65cabPD8E2BqUw7S1IO6.', 'uploads/profiles/1763338952_profile_user.jpg', 'Trivandrum', NULL, NULL, 1, 'T8Lhmfyw9F7IqlOhT7Pvk5ZZM3Y5Wc2zyckAZV0dR5Y3O9eCF4lgBpRAdtiL', NULL, '2025-11-20 22:00:57'),
(2, 'Admin Enved', 'envedonline@gmail.com', NULL, '$2y$12$GOfEwSR1zKYh.tdp50IFMuSNh2T4/qV3o.Jd5vwEgw6JcVyZbnzW6', NULL, NULL, NULL, NULL, 1, NULL, '2025-11-21 20:50:20', '2025-11-21 20:50:20');

-- --------------------------------------------------------

--
-- Table structure for table `volunteers`
--

DROP TABLE IF EXISTS `volunteers`;
CREATE TABLE IF NOT EXISTS `volunteers` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `preferred_causes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `additional_info` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `availability` enum('weekdays','weekends','both','flexible') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gdpr_consent` tinyint(1) NOT NULL DEFAULT '0',
  `marketing_consent` tinyint(1) NOT NULL DEFAULT '0',
  `status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `volunteers_email_index` (`email`),
  KEY `volunteers_status_index` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `volunteers`
--

INSERT INTO `volunteers` (`id`, `name`, `email`, `phone`, `location`, `preferred_causes`, `additional_info`, `availability`, `gdpr_consent`, `marketing_consent`, `status`, `created_at`, `updated_at`) VALUES
(4, 'Mohammed shafi MC', 'iamshafimcmm@gmail.com', '7025022220', 'jjj', '[\"Collection Drive\",\"E-waste Awareness\"]', NULL, 'weekdays', 1, 0, 'pending', '2025-11-27 16:30:17', '2025-11-27 16:30:17'),
(5, 'Mohammed shafi MC', 'iamshafimcf@gmail.com', '7025014220', 'kochi', '[\"Collection Drive\",\"E-waste Awareness\"]', NULL, 'weekdays', 1, 0, 'rejected', '2025-11-27 16:37:51', '2025-12-04 07:55:08'),
(6, 'B', 'bhavyanandakumar@gmail.com', '9961306222', 'Ernakulam', '[\"Collection Drive\"]', NULL, 'weekdays', 1, 0, 'approved', '2025-12-01 05:07:33', '2025-12-04 07:54:58'),
(7, 'midhun p joy', 'info2mpj@gmail.com', '09947156723', 'VYTTILA', '[\"Collection Drive\"]', NULL, 'weekdays', 1, 0, 'pending', '2025-12-08 04:35:13', '2025-12-08 04:35:13'),
(8, 'Angeleena Sajy', 'angeleenasajy@gmail.com', '94004 42773', 'Angamaly', '[\"Educational Sessions\",\"E-waste Awareness\"]', NULL, 'weekdays', 1, 0, 'pending', '2025-12-10 02:40:23', '2025-12-10 02:40:23');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `role_routes`
--
ALTER TABLE `role_routes`
  ADD CONSTRAINT `role_routes_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
