-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Mar 07, 2026 at 06:38 AM
-- Server version: 9.4.0
-- PHP Version: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parosis-akademi`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us_page_infos`
--

CREATE TABLE `about_us_page_infos` (
  `id` bigint UNSIGNED NOT NULL,
  `breadcrumb_title` json DEFAULT NULL,
  `breadcrumb_home` json DEFAULT NULL,
  `breadcrumb_current` json DEFAULT NULL,
  `section1_label` json DEFAULT NULL,
  `section1_title` json DEFAULT NULL,
  `section1_description` json DEFAULT NULL,
  `section1_features` json DEFAULT NULL,
  `field_styles` json DEFAULT NULL,
  `default_styles` json DEFAULT NULL,
  `section1_feature1_title` json DEFAULT NULL,
  `section1_feature1_description` json DEFAULT NULL,
  `section1_feature1_icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `section1_feature2_title` json DEFAULT NULL,
  `section1_feature2_description` json DEFAULT NULL,
  `section1_feature2_icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `section1_image1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `section1_image2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `section1_stat_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `section1_stat_text` json DEFAULT NULL,
  `categories_label` json DEFAULT NULL,
  `categories_title` json DEFAULT NULL,
  `categories_button_text` json DEFAULT NULL,
  `video_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logos_text` json DEFAULT NULL,
  `cta_label` json DEFAULT NULL,
  `cta_title` json DEFAULT NULL,
  `cta_description` json DEFAULT NULL,
  `cta_button_text` json DEFAULT NULL,
  `cta_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `section2_label` json DEFAULT NULL,
  `section2_title` json DEFAULT NULL,
  `section2_description` json DEFAULT NULL,
  `section2_features` json DEFAULT NULL,
  `section2_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `section2_stat_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `section2_stat_text` json DEFAULT NULL,
  `testimonial_label` json DEFAULT NULL,
  `testimonial_title` json DEFAULT NULL,
  `faq_label` json DEFAULT NULL,
  `faq_title` json DEFAULT NULL,
  `faq_image1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `faq_image2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `faq_image3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blog_label` json DEFAULT NULL,
  `blog_title` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about_us_page_infos`
--

INSERT INTO `about_us_page_infos` (`id`, `breadcrumb_title`, `breadcrumb_home`, `breadcrumb_current`, `section1_label`, `section1_title`, `section1_description`, `section1_features`, `field_styles`, `default_styles`, `section1_feature1_title`, `section1_feature1_description`, `section1_feature1_icon`, `section1_feature2_title`, `section1_feature2_description`, `section1_feature2_icon`, `section1_image1`, `section1_image2`, `section1_stat_number`, `section1_stat_text`, `categories_label`, `categories_title`, `categories_button_text`, `video_image`, `video_url`, `logos_text`, `cta_label`, `cta_title`, `cta_description`, `cta_button_text`, `cta_image`, `section2_label`, `section2_title`, `section2_description`, `section2_features`, `section2_image`, `section2_stat_number`, `section2_stat_text`, `testimonial_label`, `testimonial_title`, `faq_label`, `faq_title`, `faq_image1`, `faq_image2`, `faq_image3`, `blog_label`, `blog_title`, `created_at`, `updated_at`) VALUES
(1, '{\"en\": \"HAKKIMIZDA EN\", \"tr\": \"HAKKIMIZDA\"}', '{\"tr\": null}', '{\"tr\": null}', '{\"tr\": null}', '{\"tr\": null}', '{\"tr\": null}', '{\"en\": [{\"icon\": \"\", \"title\": \"Face-to-face Teaching\", \"bg_color\": \"#42AC98\", \"description\": \"Excepteur sint occaecat cupidatat non proident sunt in culpa qui officia deserunt mollit.\"}, {\"icon\": \"\", \"title\": \"24/7 Support Available\", \"bg_color\": \"#D73B3E\", \"description\": \"Excepteur sint occaecat cupidatat non proident sunt in culpa qui officia deserunt mollit.\"}], \"tr\": [{\"icon\": \"\", \"title\": \"Face-to-face Teaching\", \"bg_color\": \"#42AC98\", \"description\": \"Excepteur sint occaecat cupidatat non proident sunt in culpa qui officia deserunt mollit.\"}, {\"icon\": \"\", \"title\": \"24/7 Support Available\", \"bg_color\": \"#D73B3E\", \"description\": \"Excepteur sint occaecat cupidatat non proident sunt in culpa qui officia deserunt mollit.\"}]}', '{\"s2f_0\": {\"fontStyle\": \"\", \"textAlign\": \"left\", \"fontWeight\": \"\"}, \"s2f_3\": {\"textAlign\": \"center\"}, \"cta_label\": {\"color\": \"#ffcd20\"}, \"breadcrumb_home\": {\"color\": \"#d73b3e\", \"opacity\": \"\", \"fontSize\": \"\", \"fontStyle\": \"\", \"textAlign\": \"\", \"fontFamily\": \"\", \"fontWeight\": \"\"}, \"cta_description\": {\"color\": \"#fffffF\"}, \"breadcrumb_title\": {\"color\": \"#000000\", \"opacity\": \"\", \"fontSize\": \"\", \"fontStyle\": \"\", \"textAlign\": \"\", \"fontFamily\": \"\", \"fontWeight\": \"\"}, \"breadcrumb_current\": {\"color\": \"#5f5d5d\", \"opacity\": \"\", \"fontSize\": \"\", \"fontStyle\": \"\", \"textAlign\": \"\", \"fontFamily\": \"\", \"fontWeight\": \"\"}}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '{\"tr\": null}', '{\"tr\": null}', '{\"tr\": null}', '{\"tr\": null}', NULL, NULL, '{\"en\": \"Bizimle iş birliği yapan <strong>250+</strong> şirketle tanışın\", \"tr\": \"Bizimle iş birliği yapan <strong>250+</strong> şirketle tanışın\"}', '{\"en\": \"ONLİNE KURSLAR\", \"tr\": \"ONLİNE KURSLAR\"}', '{\"tr\": null}', '{\"en\": \"Profesyonel eğitmenlerimizle kariyer hedeflerinize ulaşmanız için en uygun kursları keşfedin.\", \"tr\": \"Profesyonel eğitmenlerimizle kariyer hedeflerinize ulaşmanız için en uygun kursları keşfedin.\"}', '{\"tr\": null}', NULL, '{\"tr\": null}', '{\"tr\": null}', '{\"tr\": null}', '{\"en\": [\"Our Expert Trainers\", \"Online Remote Learning\", \"Easy to follow curriculum\", \"Lifetime Access\"], \"tr\": [\"Our Expert Trainers\", \"Online Remote Learning\", \"Easy to follow curriculum\", \"Lifetime Access\"]}', NULL, NULL, '{\"tr\": null}', '{\"tr\": null}', '{\"tr\": null}', '{\"tr\": null}', '{\"tr\": null}', NULL, NULL, NULL, '{\"tr\": null}', '{\"tr\": \"Son Yazılarımız\"}', '2026-02-24 22:08:21', '2026-02-28 15:38:38');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint UNSIGNED NOT NULL,
  `title` json DEFAULT NULL,
  `content` json DEFAULT NULL,
  `short_description` json DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `published_at` datetime DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `content`, `short_description`, `image`, `published_at`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, '{\"en\": \"The Future of Education in the Digital Age\", \"tr\": \"Dijital Çağda Eğitimin Geleceği\"}', '{\"en\": \"<p>Education in the digital age is rapidly changing. AI, virtual reality and online platforms are democratizing education.</p><h5>Key Trends</h5><p>Personalized learning experiences, micro-learning and gamification are among the key trends.</p>\", \"tr\": \"<p>Dijital çağda eğitim hızla değişiyor. Yapay zeka, sanal gerçeklik ve online platformlar eğitimi demokratikleştiriyor.</p><h5>Öne Çıkan Trendler</h5><p>Kişiselleştirilmiş öğrenme deneyimleri, mikro öğrenme ve oyunlaştırma en önemli trendler arasında yer alıyor.</p>\"}', '{\"en\": \"Discover how technology is transforming education.\", \"tr\": \"Teknolojinin eğitim dünyasını nasıl dönüştürdüğünü keşfedin.\"}', NULL, '2026-02-22 21:50:00', 1, 0, '2026-02-23 21:50:08', '2026-02-24 04:12:54'),
(2, '{\"en\": \"Best Practices in Software Development\", \"tr\": \"Yazılım Geliştirmede En İyi Pratikler\"}', '{\"en\": \"<p>We discuss the paths you should follow to improve quality in software development processes.</p><p>Clean code, test-driven development and continuous integration practices form the foundation of successful projects.</p>\", \"tr\": \"<p>Yazılım geliştirme süreçlerinde kaliteyi artırmak için izlemeniz gereken yolları ele alıyoruz.</p><p>Clean code, test-driven development ve sürekli entegrasyon pratikleri başarılı projelerin temelini oluşturur.</p>\"}', '{\"en\": \"Fundamental principles for successful software projects.\", \"tr\": \"Başarılı yazılım projeleri için temel prensipler.\"}', NULL, '2026-02-20 21:50:08', 1, 1, '2026-02-23 21:50:08', '2026-02-23 21:50:08'),
(3, '{\"en\": \"Career Planning: Where to Start?\", \"tr\": \"Kariyer Planlaması: Nereden Başlamalı?\"}', '{\"en\": \"<p>Career planning is the first step you need to take to achieve your goals.</p><p>Identify your strengths, research industry trends and get support from mentors.</p>\", \"tr\": \"<p>Kariyer planlaması, hedeflerinize ulaşmak için atmanız gereken ilk adımdır.</p><p>Güçlü yönlerinizi belirleyin, sektör trendlerini araştırın ve mentorlardan destek alın.</p>\"}', '{\"en\": \"A step-by-step guide to planning your career.\", \"tr\": \"Kariyerinizi planlamak için adım adım rehber.\"}', NULL, '2026-02-18 21:50:08', 1, 2, '2026-02-23 21:50:08', '2026-02-23 21:50:08'),
(4, '{\"en\": \"Comparison of Online Education Platforms\", \"tr\": \"Online Eğitim Platformlarının Karşılaştırması\"}', '{\"en\": \"<p>Online education platforms are becoming increasingly popular. We examine the differences between Udemy, Coursera and local platforms.</p>\", \"tr\": \"<p>Online eğitim platformları giderek daha fazla tercih ediliyor. Udemy, Coursera ve yerel platformlar arasındaki farkları inceliyoruz.</p>\"}', '{\"en\": \"We compare the most popular online education platforms.\", \"tr\": \"En popüler online eğitim platformlarını karşılaştırıyoruz.\"}', NULL, '2026-02-16 21:50:08', 1, 3, '2026-02-23 21:50:08', '2026-02-23 21:50:08'),
(5, '{\"en\": \"AI and Machine Learning Trends\", \"tr\": \"Yapay Zeka ve Makine Öğrenmesi Trendleri\"}', '{\"en\": \"<p>Artificial intelligence is becoming more integrated into our daily lives. Here are the AI trends that stand out in 2026.</p>\", \"tr\": \"<p>Yapay zeka her geçen gün hayatımıza daha fazla giriyor. İşte 2026 yılında öne çıkan AI trendleri.</p>\"}', '{\"en\": \"Latest developments in artificial intelligence in 2026.\", \"tr\": \"2026 yılında yapay zeka alanındaki son gelişmeler.\"}', NULL, '2026-02-13 21:50:08', 1, 4, '2026-02-23 21:50:08', '2026-02-23 21:50:08'),
(6, '{\"en\": \"How to Develop Effective Communication Skills?\", \"tr\": \"Etkili İletişim Becerileri Nasıl Geliştirilir?\"}', '{\"en\": \"<p>Communication skills are the key to success in both business and social relationships.</p><p>Learn active listening, empathy and open communication techniques.</p>\", \"tr\": \"<p>İletişim becerileri hem iş hayatında hem de sosyal ilişkilerde başarının anahtarıdır.</p><p>Aktif dinleme, empati ve açık iletişim tekniklerini öğrenin.</p>\"}', '{\"en\": \"Strengthen your communication skills in business and social life.\", \"tr\": \"İş ve sosyal hayatta iletişim becerilerinizi güçlendirin.\"}', 'uploads/blogs/1771906395_photo-1504328345606-18bbc8c9d7d1.jpg', '2026-02-09 21:50:00', 1, 5, '2026-02-23 21:50:08', '2026-02-24 04:13:15');

-- --------------------------------------------------------

--
-- Table structure for table `blog_blog_category`
--

CREATE TABLE `blog_blog_category` (
  `id` bigint UNSIGNED NOT NULL,
  `blog_id` bigint UNSIGNED NOT NULL,
  `blog_category_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_blog_category`
--

INSERT INTO `blog_blog_category` (`id`, `blog_id`, `blog_category_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, NULL, NULL),
(2, 2, 3, NULL, NULL),
(3, 3, 1, NULL, NULL),
(4, 4, 1, NULL, NULL),
(5, 5, 1, NULL, NULL),
(6, 6, 1, NULL, NULL),
(7, 6, 2, NULL, NULL),
(8, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blog_blog_tag`
--

CREATE TABLE `blog_blog_tag` (
  `id` bigint UNSIGNED NOT NULL,
  `blog_id` bigint UNSIGNED NOT NULL,
  `blog_tag_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_blog_tag`
--

INSERT INTO `blog_blog_tag` (`id`, `blog_id`, `blog_tag_id`, `created_at`, `updated_at`) VALUES
(1, 1, 3, NULL, NULL),
(2, 2, 4, NULL, NULL),
(3, 2, 5, NULL, NULL),
(4, 2, 6, NULL, NULL),
(5, 3, 2, NULL, NULL),
(6, 3, 3, NULL, NULL),
(7, 4, 3, NULL, NULL),
(8, 4, 4, NULL, NULL),
(9, 4, 5, NULL, NULL),
(10, 5, 4, NULL, NULL),
(11, 6, 2, NULL, NULL),
(12, 6, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` json DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`id`, `name`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, '{\"en\": \"Education\", \"tr\": \"Eğitim\"}', 1, 0, '2026-02-24 03:41:03', '2026-02-24 03:53:41'),
(2, '{\"en\": \"Technology\", \"tr\": \"Teknoloji\"}', 1, 1, '2026-02-24 03:41:03', '2026-02-24 03:53:41'),
(3, '{\"en\": \"Career\", \"tr\": \"Kariyer\"}', 1, 2, '2026-02-24 03:41:03', '2026-02-24 03:53:41'),
(4, '{\"en\": \"Personal Development\", \"tr\": \"Kişisel Gelişim\"}', 1, 4, '2026-02-24 03:41:03', '2026-02-24 03:53:41'),
(5, '{\"en\": \"Announcements\", \"tr\": \"Duyurular\"}', 1, 3, '2026-02-24 03:41:03', '2026-02-24 03:53:41');

-- --------------------------------------------------------

--
-- Table structure for table `blog_page_infos`
--

CREATE TABLE `blog_page_infos` (
  `id` bigint UNSIGNED NOT NULL,
  `title` json DEFAULT NULL,
  `field_styles` json DEFAULT NULL,
  `default_styles` json DEFAULT NULL,
  `breadcrumb_home` json DEFAULT NULL,
  `breadcrumb_current` json DEFAULT NULL,
  `detail_breadcrumb_current` json DEFAULT NULL,
  `sidebar_search_title` json DEFAULT NULL,
  `sidebar_search_placeholder` json DEFAULT NULL,
  `sidebar_categories_title` json DEFAULT NULL,
  `sidebar_popular_title` json DEFAULT NULL,
  `sidebar_contact_title` json DEFAULT NULL,
  `sidebar_tags_title` json DEFAULT NULL,
  `sidebar_contact_phone_label` json DEFAULT NULL,
  `sidebar_contact_phone` json DEFAULT NULL,
  `sidebar_contact_email_label` json DEFAULT NULL,
  `sidebar_contact_email` json DEFAULT NULL,
  `sidebar_contact_address_label` json DEFAULT NULL,
  `sidebar_contact_address` json DEFAULT NULL,
  `cta_label` json DEFAULT NULL,
  `cta_title` json DEFAULT NULL,
  `cta_description` json DEFAULT NULL,
  `cta_button_text` json DEFAULT NULL,
  `cta_button_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cta_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_page_infos`
--

INSERT INTO `blog_page_infos` (`id`, `title`, `field_styles`, `default_styles`, `breadcrumb_home`, `breadcrumb_current`, `detail_breadcrumb_current`, `sidebar_search_title`, `sidebar_search_placeholder`, `sidebar_categories_title`, `sidebar_popular_title`, `sidebar_contact_title`, `sidebar_tags_title`, `sidebar_contact_phone_label`, `sidebar_contact_phone`, `sidebar_contact_email_label`, `sidebar_contact_email`, `sidebar_contact_address_label`, `sidebar_contact_address`, `cta_label`, `cta_title`, `cta_description`, `cta_button_text`, `cta_button_url`, `cta_image`, `created_at`, `updated_at`) VALUES
(1, '{\"en\": \"Blog & News\", \"tr\": \"Blog & Haberler\"}', '[]', '[]', '{\"en\": \"HOME\", \"tr\": \"ANA SAYFA\"}', '{\"en\": \"BLOG\", \"tr\": \"BLOG\"}', '{\"en\": \"Blog Details\", \"tr\": \"Blog Detayı\"}', '{\"en\": \"Search Here\", \"tr\": \"Arama\"}', '{\"tr\": null}', '{\"en\": \"Categories\", \"tr\": \"Kategoriler\"}', '{\"en\": \"Popular Posts\", \"tr\": \"Popüler Yazılar\"}', '{\"en\": \"Contact Us\", \"tr\": \"İletişim\"}', '{\"en\": \"Tags\", \"tr\": \"Etiketler\"}', '{\"en\": \"24/7 Support\", \"tr\": \"7/24 Destek\"}', '{\"en\": \"+532 321 33 33\", \"tr\": \"+532 321 33 33\"}', '{\"en\": \"Send Message\", \"tr\": \"Mesaj Gönderin\"}', '{\"en\": \"info@parosisakademi.com\", \"tr\": \"info@parosisakademi.com\"}', '{\"en\": \"Our Location\", \"tr\": \"Adresimiz\"}', '{\"en\": \"Istanbul, Turkey\", \"tr\": \"İstanbul, Türkiye\"}', '{\"en\": \"Blog\", \"tr\": \"Blog\"}', '{\"en\": \"Start your education journey today\", \"tr\": \"Eğitim yolculuğunuza bugün başlayın\"}', '{\"en\": \"Reach your career goals with our expert instructors.\", \"tr\": \"Uzman eğitmenlerimizle kariyer hedeflerinize \\r\\nulaşın.\"}', '{\"en\": \"Apply Now\", \"tr\": \"Başvur\"}', '#', NULL, '2026-02-23 21:50:08', '2026-03-02 03:12:58');

-- --------------------------------------------------------

--
-- Table structure for table `blog_tags`
--

CREATE TABLE `blog_tags` (
  `id` bigint UNSIGNED NOT NULL,
  `name` json DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_tags`
--

INSERT INTO `blog_tags` (`id`, `name`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, '{\"en\": \"Certificate\", \"tr\": \"Sertifika\"}', 1, 1, '2026-02-24 03:41:03', '2026-02-24 03:53:45'),
(2, '{\"en\": \"Online Education\", \"tr\": \"Online Eğitim\"}', 1, 0, '2026-02-24 03:41:03', '2026-02-24 03:53:45'),
(3, '{\"en\": \"Workshop\", \"tr\": \"Workshop\"}', 1, 2, '2026-02-24 03:41:03', '2026-02-24 03:53:45'),
(4, '{\"en\": \"AI\", \"tr\": \"Yapay Zeka\"}', 1, 3, '2026-02-24 03:41:03', '2026-02-24 03:53:45'),
(5, '{\"en\": \"Programming\", \"tr\": \"Programlama\"}', 1, 4, '2026-02-24 03:41:03', '2026-02-24 03:53:45'),
(6, '{\"en\": \"Design\", \"tr\": \"Tasarım\"}', 1, 5, '2026-02-24 03:41:03', '2026-02-24 03:53:45'),
(7, '{\"en\": \"Business\", \"tr\": \"İş Hayatı\"}', 1, 6, '2026-02-24 03:41:03', '2026-02-24 03:53:45');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('marmotech-cache-f2df5918d5958ff542658ac55740e3a5c9121d5c', 'i:1;', 1772779204),
('marmotech-cache-f2df5918d5958ff542658ac55740e3a5c9121d5c:timer', 'i:1772779204;', 1772779204),
('marmotech-cache-f3ca67389f7b801264ff67b19b5ae11a9fc42207', 'i:1;', 1772794149),
('marmotech-cache-f3ca67389f7b801264ff67b19b5ae11a9fc42207:timer', 'i:1772794149;', 1772794149),
('marmotech-cache-setting.advanced.maintenance_mode', 's:1:\"0\";', 1772908066),
('marmotech-cache-settings.group.advanced', 'a:3:{s:16:\"custom_body_code\";s:0:\"\";s:16:\"custom_head_code\";s:0:\"\";s:16:\"maintenance_mode\";s:1:\"0\";}', 1772856593),
('marmotech-cache-settings.group.general', 'a:7:{s:14:\"copyright_text\";s:50:\"© 2026 Parosis Akademi. Tüm hakları saklıdır.\";s:12:\"site_address\";s:0:\"\";s:16:\"site_description\";s:44:\"Geleceğin teknolojisine yön veren akademi.\";s:10:\"site_email\";s:0:\"\";s:9:\"site_name\";s:15:\"Parosis Akademi\";s:10:\"site_phone\";s:0:\"\";s:8:\"timezone\";s:15:\"Europe/Istanbul\";}', 1772856593),
('marmotech-cache-settings.group.logos', 'a:4:{s:10:\"admin_logo\";s:0:\"\";s:7:\"favicon\";s:0:\"\";s:11:\"footer_logo\";s:0:\"\";s:11:\"header_logo\";s:0:\"\";}', 1772856593),
('marmotech-cache-settings.group.mail', 'a:7:{s:15:\"mail_encryption\";s:3:\"tls\";s:17:\"mail_from_address\";s:0:\"\";s:14:\"mail_from_name\";s:15:\"Parosis Akademi\";s:9:\"mail_host\";s:0:\"\";s:11:\"mail_mailer\";s:3:\"log\";s:9:\"mail_port\";s:3:\"587\";s:13:\"mail_username\";s:0:\"\";}', 1772856551),
('marmotech-cache-settings.group.seo', 'a:7:{s:19:\"google_analytics_id\";s:0:\"\";s:21:\"google_tag_manager_id\";s:0:\"\";s:16:\"meta_description\";s:0:\"\";s:13:\"meta_keywords\";s:0:\"\";s:10:\"meta_title\";s:15:\"Parosis Akademi\";s:10:\"robots_txt\";s:22:\"User-agent: *\nAllow: /\";s:11:\"sitemap_url\";s:12:\"/sitemap.xml\";}', 1772856593),
('marmotech-cache-settings.group.social', 'a:7:{s:12:\"facebook_url\";s:0:\"\";s:13:\"instagram_url\";s:0:\"\";s:12:\"linkedin_url\";s:0:\"\";s:10:\"tiktok_url\";s:0:\"\";s:11:\"twitter_url\";s:0:\"\";s:15:\"whatsapp_number\";s:0:\"\";s:11:\"youtube_url\";s:0:\"\";}', 1772856593),
('marmotech-cache-settings.group.validation_attributes', 'a:0:{}', 1772856551),
('marmotech-cache-settings.group.validation_messages', 'a:0:{}', 1772856551),
('marmotech-cache-settings.group.vm_blog_cat_order', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_blog_cat_store', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_blog_cat_translate', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_blog_cat_update', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_blog_order', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_blog_store', 'a:0:{}', 1772857366),
('marmotech-cache-settings.group.vm_blog_tag_order', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_blog_tag_store', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_blog_tag_translate', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_blog_tag_update', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_blog_translate', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_blog_update', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_cart_add', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_cart_remove', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_cart_update', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_checkout_coupon', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_checkout_process', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_class_store', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_class_update', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_client_logo_order', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_client_logo_store', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_client_logo_update', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_contact_send', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_coupon_store', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_coupon_update', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_course_cat_order', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_course_cat_store', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_course_cat_translate', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_course_cat_update', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_course_order', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_course_store', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_course_translate', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_course_update', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_faq_order', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_faq_store', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_faq_translate', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_faq_update', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_language_default', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_language_order', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_language_store', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_language_toggle', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_language_update', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_menu_order', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_menu_store', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_menu_translate', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_menu_update', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_order_status', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_page_upload_image', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_pre_reg_convert', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_pre_reg_store', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_pre_reg_update', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_product_attr_order', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_product_attr_store', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_product_attr_translate', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_product_attr_update', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_product_attr_value_store', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_product_attr_value_update', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_product_cat_order', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_product_cat_store', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_product_cat_translate', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_product_cat_update', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_product_gallery', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_product_image_order', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_product_order', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_product_store', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_product_translate', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_product_update', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_product_variants', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_role_store', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_role_update', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_settings_general', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_settings_logos', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_settings_mail', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_settings_seo', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_settings_sitemap_store', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_settings_sitemap_update', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_settings_social', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_settings_test_mail', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_slider_item_order', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_slider_item_store', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_slider_item_translate', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_slider_item_update', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_slider_order', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_slider_store', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_slider_update', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_student_recreate_normal', 'a:0:{}', 1772858155),
('marmotech-cache-settings.group.vm_student_recreate_pre', 'a:0:{}', 1772858155),
('marmotech-cache-settings.group.vm_student_store_normal', 'a:0:{}', 1772858155),
('marmotech-cache-settings.group.vm_student_store_pre', 'a:0:{}', 1772858155),
('marmotech-cache-settings.group.vm_student_update_normal', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_student_update_pre', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_teacher_order', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_teacher_store', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_teacher_translate', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_teacher_update', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_testimonial_order', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_testimonial_store', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_testimonial_translate', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_testimonial_update', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_user_login', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_user_store', 'a:0:{}', 1772858198),
('marmotech-cache-settings.group.vm_user_update', 'a:0:{}', 1772858198),
('marmotech-cache-spatie.permission.cache', 'a:3:{s:5:\"alias\";a:5:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";s:1:\"j\";s:10:\"is_visible\";}s:11:\"permissions\";a:20:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:10:\"accounting\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:5;}}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:15:\"accounting_edit\";s:1:\"c\";s:3:\"web\";}i:2;a:3:{s:1:\"a\";i:3;s:1:\"b\";s:13:\"students_edit\";s:1:\"c\";s:3:\"web\";}i:3;a:3:{s:1:\"a\";i:4;s:1:\"b\";s:6:\"delete\";s:1:\"c\";s:3:\"web\";}i:4;a:3:{s:1:\"a\";i:5;s:1:\"b\";s:11:\"delete_user\";s:1:\"c\";s:3:\"web\";}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:7:\"student\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:12:\"class_delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:11:\"user_delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:5:\"class\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:4;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:14:\"student_delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:4:\"user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:7:\"content\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:14:\"content_delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:4:\"shop\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:11:\"shop_delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:4:\"page\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:16;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:4:\"menu\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:17;a:4:{s:1:\"a\";i:18;s:1:\"b\";s:8:\"language\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:18;a:4:{s:1:\"a\";i:19;s:1:\"b\";s:8:\"settings\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:19;a:4:{s:1:\"a\";i:21;s:1:\"b\";s:9:\"developer\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}}s:5:\"roles\";a:5:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:10:\"SuperAdmin\";s:1:\"c\";s:3:\"web\";s:1:\"j\";i:0;}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:5:\"Admin\";s:1:\"c\";s:3:\"web\";s:1:\"j\";i:1;}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:11:\"Kordinatör\";s:1:\"c\";s:3:\"web\";s:1:\"j\";i:1;}i:3;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:8:\"Muhasebe\";s:1:\"c\";s:3:\"web\";s:1:\"j\";i:1;}i:4;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:8:\"Eğitmen\";s:1:\"c\";s:3:\"web\";s:1:\"j\";i:1;}}}', 1772865545);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `client_logos`
--

CREATE TABLE `client_logos` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `client_logos`
--

INSERT INTO `client_logos` (`id`, `name`, `image`, `url`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'TechVision', 'assets-front/img/images/th-1/client-logo-1.png', NULL, 0, 1, '2026-02-24 21:14:05', '2026-02-24 21:14:05'),
(2, 'CloudBase', 'assets-front/img/images/th-1/client-logo-2.png', NULL, 1, 1, '2026-02-24 21:14:05', '2026-02-24 21:14:05'),
(3, 'DataFlow', 'assets-front/img/images/th-1/client-logo-3.png', NULL, 2, 1, '2026-02-24 21:14:05', '2026-02-24 21:14:05'),
(4, 'SmartHub', 'assets-front/img/images/th-1/client-logo-4.png', NULL, 3, 1, '2026-02-24 21:14:05', '2026-02-24 21:14:05'),
(5, 'InnoSoft', 'assets-front/img/images/th-1/client-logo-5.png', NULL, 4, 1, '2026-02-24 21:14:05', '2026-02-24 21:14:05'),
(6, 'NexGen Labs', 'assets-front/img/images/th-1/client-logo-3.png', 'https://nexgenlabs.com', 5, 1, '2026-02-24 21:15:05', '2026-02-24 21:15:05'),
(7, 'ByteWorks', 'assets-front/img/images/th-1/client-logo-1.png', NULL, 6, 1, '2026-02-24 21:15:05', '2026-02-24 21:15:05'),
(8, 'PixelCraft', 'assets-front/img/images/th-1/client-logo-4.png', 'https://pixelcraft.io', 7, 1, '2026-02-24 21:15:05', '2026-02-24 21:15:05'),
(9, 'CoreStack', 'assets-front/img/images/th-1/client-logo-2.png', NULL, 8, 1, '2026-02-24 21:15:05', '2026-02-24 21:15:05'),
(10, 'AeroDigital', 'assets-front/img/images/th-1/client-logo-5.png', 'https://aerodigital.co', 9, 1, '2026-02-24 21:15:05', '2026-02-24 21:15:05');

-- --------------------------------------------------------

--
-- Table structure for table `contact_page_infos`
--

CREATE TABLE `contact_page_infos` (
  `id` bigint UNSIGNED NOT NULL,
  `title` json DEFAULT NULL,
  `field_styles` json DEFAULT NULL,
  `default_styles` json DEFAULT NULL,
  `subtitle` json DEFAULT NULL,
  `description` json DEFAULT NULL,
  `form_title` json DEFAULT NULL,
  `form_description` json DEFAULT NULL,
  `phones` json DEFAULT NULL,
  `emails` json DEFAULT NULL,
  `addresses` json DEFAULT NULL,
  `phone_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_line_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_line_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `map_embed_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cta_label` json DEFAULT NULL,
  `cta_title` json DEFAULT NULL,
  `cta_description` json DEFAULT NULL,
  `cta_button_text` json DEFAULT NULL,
  `cta_button_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cta_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `form_name_placeholder` json DEFAULT NULL,
  `form_email_placeholder` json DEFAULT NULL,
  `form_message_placeholder` json DEFAULT NULL,
  `form_privacy_text` json DEFAULT NULL,
  `form_button_text` json DEFAULT NULL,
  `contact_form_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `form_action_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `breadcrumb_home` json DEFAULT NULL,
  `breadcrumb_current` json DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_page_infos`
--

INSERT INTO `contact_page_infos` (`id`, `title`, `field_styles`, `default_styles`, `subtitle`, `description`, `form_title`, `form_description`, `phones`, `emails`, `addresses`, `phone_1`, `phone_2`, `email_1`, `email_2`, `address_line_1`, `address_line_2`, `map_embed_url`, `created_at`, `updated_at`, `cta_label`, `cta_title`, `cta_description`, `cta_button_text`, `cta_button_url`, `cta_image`, `form_name_placeholder`, `form_email_placeholder`, `form_message_placeholder`, `form_privacy_text`, `form_button_text`, `contact_form_image`, `form_action_url`, `breadcrumb_home`, `breadcrumb_current`) VALUES
(1, '{\"tr\": null}', '{\"cta_label\": {\"color\": \"#ffcd20\", \"opacity\": \"\", \"fontSize\": \"\", \"fontStyle\": \"\", \"textAlign\": \"\", \"fontFamily\": \"\", \"fontWeight\": \"\"}, \"cta_title\": {\"color\": \"#ffffff\", \"opacity\": \"\", \"fontSize\": \"\", \"fontStyle\": \"\", \"textAlign\": \"\", \"fontFamily\": \"\", \"fontWeight\": \"\"}, \"breadcrumb_home\": {\"color\": \"#d73b3E\", \"opacity\": \"\", \"fontSize\": \"\", \"fontStyle\": \"\", \"textAlign\": \"\", \"fontFamily\": \"\", \"fontWeight\": \"\"}, \"cta_description\": {\"color\": \"#ffffff\", \"opacity\": \"\", \"fontSize\": \"\", \"fontStyle\": \"\", \"textAlign\": \"\", \"fontFamily\": \"\", \"fontWeight\": \"\"}}', NULL, '{\"tr\": null}', '{\"tr\": null}', '{\"tr\": null}', '{\"tr\": null}', '[\"+532 321 33 39\", \"+532 321 33 34\"]', '[\"info@parosisakademi.com\"]', '[\"Istanbul, Turkiye\"]', '+532 321 33 39', '+532 321 33 34', 'info@parosisakademi.com', 'destek@parosisakademi.com', 'Istanbul, Turkiye', NULL, NULL, '2026-02-22 22:18:13', '2026-02-28 14:25:07', '{\"en\": \"HEMEN BASLAYIN\", \"tr\": \"HEMEN BASLAYIN\"}', '{\"en\": \"Uygun Fiyatli Online Kurslar & Ogrenme Firsatlari\", \"tr\": \"Uygun Fiyatli Online Kurslar & Ogrenme Firsatlari\"}', '{\"en\": \"Kariyerinizi bir adim oteye tasiyacak egitimlerle tanismaya hazir misiniz? Hemen kayit olun ve ogrenmeye baslayin.\", \"tr\": \"Kariyerinizi bir adim oteye tasiyacak egitimlerle tanismaya hazir misiniz? Hemen kayit olun ve ogrenmeye baslayin.\"}', '{\"tr\": null}', NULL, NULL, '{\"tr\": null}', '{\"tr\": null}', '{\"tr\": null}', '{\"tr\": null}', '{\"tr\": null}', NULL, NULL, '{\"tr\": \"ANA SAYFA\"}', '{\"tr\": null}');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('percentage','fixed') COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` decimal(10,2) NOT NULL,
  `min_order_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `max_discount_amount` decimal(10,2) DEFAULT NULL,
  `usage_limit` int DEFAULT NULL,
  `used_count` int NOT NULL DEFAULT '0',
  `starts_at` date DEFAULT NULL,
  `expires_at` date DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `code`, `type`, `value`, `min_order_amount`, `max_discount_amount`, `usage_limit`, `used_count`, `starts_at`, `expires_at`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'HOSGELDIN10', 'percentage', 10.00, 0.00, NULL, NULL, 4, NULL, NULL, 1, '2026-03-04 21:15:30', '2026-03-05 03:32:15'),
(2, 'BAHAR25', 'percentage', 25.00, 200.00, 100.00, 100, 47, '2026-03-01', '2026-04-30', 1, '2026-03-04 21:15:30', '2026-03-04 21:15:30'),
(3, 'INDIRIM50', 'fixed', 50.00, 150.00, NULL, 200, 128, '2026-02-01', '2026-06-30', 1, '2026-03-04 21:15:30', '2026-03-04 21:15:30'),
(4, 'VIP40', 'percentage', 40.00, 500.00, 250.00, 20, 18, '2026-01-01', '2026-12-31', 1, '2026-03-04 21:15:30', '2026-03-04 21:15:30'),
(5, 'YILBASI30', 'percentage', 30.00, 100.00, NULL, 500, 312, '2025-12-20', '2026-01-05', 1, '2026-03-04 21:15:30', '2026-03-04 21:15:30'),
(6, 'ESKIKOD', 'fixed', 25.00, 0.00, NULL, NULL, 89, NULL, NULL, 0, '2026-03-04 21:15:30', '2026-03-04 21:15:30'),
(7, 'FLASH20', 'fixed', 20.00, 75.00, NULL, 50, 50, '2026-03-01', '2026-03-31', 1, '2026-03-04 21:15:30', '2026-03-04 21:15:30'),
(8, 'YAZ2026', 'percentage', 15.00, 100.00, 75.00, 1000, 0, '2026-06-01', '2026-08-31', 1, '2026-03-04 21:15:30', '2026-03-04 21:15:30');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint UNSIGNED NOT NULL,
  `title` json DEFAULT NULL,
  `short_description` json DEFAULT NULL,
  `content` json DEFAULT NULL,
  `what_you_learn` json DEFAULT NULL,
  `why_choose` json DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inner_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lesson_count` int DEFAULT NULL,
  `language` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `student_count` int DEFAULT NULL,
  `has_certification` tinyint(1) NOT NULL DEFAULT '0',
  `instructor_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instructor_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '0',
  `published_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `title`, `short_description`, `content`, `what_you_learn`, `why_choose`, `image`, `inner_image`, `price`, `duration`, `lesson_count`, `language`, `student_count`, `has_certification`, `instructor_name`, `instructor_image`, `is_active`, `sort_order`, `published_at`, `created_at`, `updated_at`) VALUES
(1, '{\"ar\": \"تطوير الويب باستخدام PHP و Laravel\", \"de\": \"Webentwicklung mit PHP & Laravel\", \"en\": \"Web Development with PHP & Laravel\", \"tr\": \"PHP & Laravel ile Web Geliştirme\"}', '{\"ar\": \"تعلم بناء تطبيقات ويب احترافية من الصفر\", \"de\": \"Lernen Sie professionelle Webanwendungen von Grund auf zu erstellen.\", \"en\": \"Learn to build professional web applications from scratch. Modern backend development with Laravel framework.\", \"tr\": \"Sıfırdan profesyonel web uygulamaları geliştirmeyi öğrenin. Laravel framework ile modern backend geliştirme.\"}', '{\"ar\": \"<p>هذه الدورة الشاملة تعلم PHP و Laravel بعمق.</p>\", \"de\": \"<p>Dieser umfassende Kurs lehrt PHP und das Laravel-Framework eingehend.</p>\", \"en\": \"<p>This comprehensive course teaches PHP and Laravel framework in depth. You will work on real-world projects covering database management, API development, authentication and more.</p>\", \"tr\": \"<p>Bu kapsamlı kurs, PHP programlama dilini ve Laravel framework\'ünü derinlemesine öğretir. Veritabanı yönetimi, API geliştirme, kimlik doğrulama ve daha fazlasını kapsayan gerçek dünya projeleri üzerinde çalışacaksınız.</p><p>Kurs boyunca 5 farklı proje geliştirecek ve portföyünüzü güçlendireceksiniz.</p>\"}', '{\"ar\": \"<ul><li>أساسيات PHP</li><li>بنية Laravel MVC</li></ul>\", \"de\": \"<ul><li>PHP Grundlagen und fortgeschrittene Konzepte</li><li>Laravel MVC-Architektur</li></ul>\", \"en\": \"<ul><li>PHP fundamentals and advanced concepts</li><li>Laravel MVC architecture</li><li>Database operations with Eloquent ORM</li><li>RESTful API development</li></ul>\", \"tr\": \"<ul><li>PHP temel ve ileri kavramlar</li><li>Laravel MVC yapısı</li><li>Eloquent ORM ile veritabanı işlemleri</li><li>RESTful API geliştirme</li><li>Authentication ve Authorization</li></ul>\"}', '{\"ar\": \"<ul><li>تعلم عملي</li><li>دعم المدربين الخبراء</li></ul>\", \"de\": \"<ul><li>Praxisnahes Projektlernen</li><li>Expertenunterstützung</li></ul>\", \"en\": \"<ul><li>Hands-on project learning</li><li>Expert instructor support</li><li>Career support with certificate</li></ul>\", \"tr\": \"<ul><li>Uygulamalı projelerle öğrenme</li><li>Uzman eğitmen desteği</li><li>Sertifika ile kariyer desteği</li><li>7/24 destek hattı</li></ul>\"}', NULL, NULL, '₺2.500', '16 Hafta', 48, 'Türkçe', 234, 1, 'Dr. Ahmet Yılmaz', NULL, 1, 1, '2026-01-09 15:18:00', '2026-02-24 15:18:06', '2026-03-04 00:05:58'),
(2, '{\"ar\": \"أساسيات تصميم UI/UX\", \"de\": \"UI/UX Design Grundlagen\", \"en\": \"UI/UX Design Fundamentals\", \"tr\": \"UI/UX Tasarım Temelleri\"}', '{\"ar\": \"تعلم أساسيات تجربة المستخدم وتصميم الواجهات\", \"de\": \"Lernen Sie die Grundlagen von User Experience und Interface Design.\", \"en\": \"Learn the fundamentals of user experience and interface design. Modern design workflows with Figma.\", \"tr\": \"Kullanıcı deneyimi ve arayüz tasarımının temellerini öğrenin. Figma ile modern tasarım workflow\'ları.\"}', '{\"ar\": \"<p>تغطي هذه الدورة أساسيات تصميم المنتجات الرقمية.</p>\", \"de\": \"<p>Dieser Kurs behandelt die Grundlagen des digitalen Produktdesigns.</p>\", \"en\": \"<p>This course covers digital product design fundamentals including user research, wireframing, prototyping and visual design principles.</p>\", \"tr\": \"<p>Bu kurs, dijital ürün tasarımının temellerini kapsar. Kullanıcı araştırması, wireframing, prototipleme ve görsel tasarım prensiplerini gerçek projeler üzerinde uygulayacaksınız.</p>\"}', '{\"ar\": \"<ul><li>التصميم باستخدام Figma</li></ul>\", \"de\": \"<ul><li>Design mit Figma</li></ul>\", \"en\": \"<ul><li>Design with Figma</li><li>Wireframing and prototyping</li><li>Color theory and typography</li></ul>\", \"tr\": \"<ul><li>Figma ile tasarım</li><li>Wireframe ve prototipleme</li><li>Renk teorisi ve tipografi</li><li>Kullanıcı araştırması</li></ul>\"}', '{\"ar\": \"<ul><li>دعم بناء المحفظة</li></ul>\", \"de\": \"<ul><li>Unterstützung beim Portfolio-Aufbau</li></ul>\", \"en\": \"<ul><li>Portfolio building support</li><li>Real client projects</li></ul>\", \"tr\": \"<ul><li>Portföy oluşturma desteği</li><li>Gerçek müşteri projeleri</li><li>Sektör uzmanlarıyla networking</li></ul>\"}', NULL, NULL, '₺1.800', '12 Hafta', 36, 'Türkçe', 189, 1, 'Elif Kara', NULL, 1, 2, '2025-12-26 15:18:06', '2026-02-24 15:18:06', '2026-02-24 15:18:06'),
(3, '{\"ar\": \"استراتيجيات التسويق الرقمي\", \"de\": \"Digitale Marketingstrategien\", \"en\": \"Digital Marketing Strategies\", \"tr\": \"Dijital Pazarlama Stratejileri\"}', '{\"ar\": \"قم بتنمية علامتك التجارية مع SEO ووسائل التواصل الاجتماعي\", \"de\": \"Wachsen Sie Ihre Marke mit SEO, Social Media und Google Ads.\", \"en\": \"Grow your brand with SEO, social media, Google Ads and content marketing.\", \"tr\": \"SEO, sosyal medya, Google Ads ve içerik pazarlaması ile markanızı büyütün.\"}', '{\"ar\": \"<p>تغطي هذه الدورة جميع أبعاد التسويق الرقمي.</p>\", \"de\": \"<p>Dieser Kurs deckt alle Dimensionen des digitalen Marketings ab.</p>\", \"en\": \"<p>This course covers all dimensions of digital marketing, combining theory with practice.</p>\", \"tr\": \"<p>Dijital pazarlamanın tüm boyutlarını kapsayan bu kurs, teorik bilgiyi pratik uygulamalarla birleştirir. Google Analytics, Meta Business Suite ve diğer araçları etkin kullanmayı öğreneceksiniz.</p>\"}', '{\"ar\": \"<ul><li>تحسين محركات البحث</li></ul>\", \"de\": \"<ul><li>SEO-Optimierung</li></ul>\", \"en\": \"<ul><li>SEO optimization</li><li>Google Ads management</li><li>Social media strategy</li></ul>\", \"tr\": \"<ul><li>SEO optimizasyonu</li><li>Google Ads yönetimi</li><li>Sosyal medya stratejisi</li><li>E-posta pazarlama</li><li>İçerik pazarlama</li></ul>\"}', '{\"ar\": \"<ul><li>اتجاهات الصناعة الحالية</li></ul>\", \"de\": \"<ul><li>Aktuelle Branchentrends</li></ul>\", \"en\": \"<ul><li>Current industry trends</li><li>Real campaign management</li></ul>\", \"tr\": \"<ul><li>Güncel sektör trendleri</li><li>Gerçek kampanya yönetimi</li><li>Google sertifika hazırlığı</li></ul>\"}', NULL, NULL, '₺1.200', '10 Hafta', 30, 'Türkçe', 312, 1, 'Mehmet Demir', NULL, 1, 3, '2026-02-17 15:18:06', '2026-02-24 15:18:06', '2026-02-24 15:18:06'),
(4, '{\"ar\": \"تطوير الواجهات باستخدام React.js\", \"de\": \"Frontend-Entwicklung mit React.js\", \"en\": \"Frontend Development with React.js\", \"tr\": \"React.js ile Frontend Geliştirme\"}', '{\"ar\": \"تقنيات تطوير الواجهات الحديثة\", \"de\": \"Moderne Frontend-Entwicklungstechniken.\", \"en\": \"Modern frontend development techniques. React, Redux, hooks and component architecture.\", \"tr\": \"Modern frontend geliştirme teknikleri. React, Redux, hooks ve component mimarisi.\"}', '{\"ar\": \"<p>تعلم نظام React.js البيئي من البداية إلى النهاية.</p>\", \"de\": \"<p>Lernen Sie das React.js-Ökosystem von Anfang bis Ende.</p>\", \"en\": \"<p>Learn the React.js ecosystem from start to finish.</p>\", \"tr\": \"<p>React.js ekosistemini baştan sona öğrenin. JSX, state yönetimi, routing, API entegrasyonu ve performans optimizasyonu konularında uzmanlaşın.</p>\"}', '{\"ar\": \"<ul><li>أساسيات React و JSX</li></ul>\", \"de\": \"<ul><li>React Grundlagen und JSX</li></ul>\", \"en\": \"<ul><li>React fundamentals and JSX</li><li>Hooks and state management</li><li>Redux Toolkit</li></ul>\", \"tr\": \"<ul><li>React temelleri ve JSX</li><li>Hooks ve state yönetimi</li><li>Redux Toolkit</li><li>React Router</li><li>API entegrasyonu</li></ul>\"}', '{\"ar\": \"<ul><li>أحدث منهج React 19</li></ul>\", \"de\": \"<ul><li>Aktuellster React 19 Lehrplan</li></ul>\", \"en\": \"<ul><li>Latest React 19 curriculum</li><li>10+ real projects</li></ul>\", \"tr\": \"<ul><li>En güncel React 19 müfredatı</li><li>10+ gerçek proje</li><li>Canlı code review seansları</li></ul>\"}', NULL, NULL, '₺2.200', '14 Hafta', 42, 'Türkçe', 276, 1, 'Zeynep Aydın', NULL, 1, 4, '2026-01-01 15:18:06', '2026-02-24 15:18:06', '2026-02-24 15:18:06'),
(5, '{\"ar\": \"ريادة الأعمال وإدارة الشركات الناشئة\", \"de\": \"Unternehmertum & Startup-Management\", \"en\": \"Entrepreneurship & Startup Management\", \"tr\": \"Girişimcilik ve Startup Yönetimi\"}', '{\"ar\": \"خطط لكل خطوة من رحلة شركتك الناشئة\", \"de\": \"Planen Sie jeden Schritt Ihrer Startup-Reise.\", \"en\": \"Plan every step of your startup journey from idea to funding round.\", \"tr\": \"Fikir aşamasından yatırım turuna kadar startup yolculuğunuzun her adımını planlayın.\"}', '{\"ar\": \"<p>افهم نظام الشركات الناشئة البيئي.</p>\", \"de\": \"<p>Verstehen Sie das Startup-Ökosystem.</p>\", \"en\": \"<p>Understand the startup ecosystem, build your business model, develop an MVP and pitch to investors.</p>\", \"tr\": \"<p>Startup ekosistemini anlayın, iş modelinizi oluşturun, MVP geliştirin ve yatırımcılara pitch yapın. Başarılı girişimcilerden gerçek deneyimler dinleyin.</p>\"}', '{\"ar\": \"<ul><li>نموذج العمل التجاري</li></ul>\", \"de\": \"<ul><li>Business Model Canvas</li></ul>\", \"en\": \"<ul><li>Business model canvas</li><li>MVP development</li><li>Pitch deck preparation</li></ul>\", \"tr\": \"<ul><li>İş modeli canvas</li><li>MVP geliştirme</li><li>Pitch deck hazırlama</li><li>Finansal planlama</li></ul>\"}', '{\"ar\": \"<ul><li>لقاء مستثمرين حقيقيين</li></ul>\", \"de\": \"<ul><li>Treffen Sie echte Investoren</li></ul>\", \"en\": \"<ul><li>Meet real investors</li><li>Mentorship support</li></ul>\", \"tr\": \"<ul><li>Gerçek yatırımcılarla tanışma</li><li>Mentorluk desteği</li><li>Demo Day katılımı</li></ul>\"}', NULL, NULL, '₺1.500', '8 Hafta', 24, 'Türkçe', 145, 0, 'Can Özkan', NULL, 1, 5, '2026-02-17 15:18:06', '2026-02-24 15:18:06', '2026-02-24 15:18:06'),
(6, '{\"ar\": \"علم البيانات باستخدام Python\", \"de\": \"Data Science mit Python\", \"en\": \"Data Science with Python\", \"tr\": \"Python ile Veri Bilimi\"}', '{\"ar\": \"تحليل البيانات والتصور باستخدام Python\", \"de\": \"Datenanalyse und Visualisierung mit Python.\", \"en\": \"Data analysis and visualization with Python, Pandas, NumPy and machine learning.\", \"tr\": \"Python, Pandas, NumPy ve makine öğrenmesi ile veri analizi ve görselleştirme.\"}', '{\"ar\": \"<p>تدريب شامل من أساسيات علم البيانات.</p>\", \"de\": \"<p>Umfassende Schulung von den Grundlagen der Datenwissenschaft.</p>\", \"en\": \"<p>Comprehensive training from data science fundamentals to advanced machine learning techniques.</p>\", \"tr\": \"<p>Veri biliminin temellerinden ileri düzey makine öğrenmesi tekniklerine kadar kapsamlı bir eğitim. Gerçek veri setleri üzerinde projeler geliştirin.</p>\"}', '{\"ar\": \"<ul><li>برمجة Python</li></ul>\", \"de\": \"<ul><li>Python-Programmierung</li></ul>\", \"en\": \"<ul><li>Python programming</li><li>Pandas and NumPy</li><li>Data visualization</li></ul>\", \"tr\": \"<ul><li>Python programlama</li><li>Pandas ve NumPy</li><li>Veri görselleştirme (Matplotlib, Seaborn)</li><li>Makine öğrenmesi (scikit-learn)</li></ul>\"}', '{\"ar\": \"<ul><li>المهارة الأكثر طلباً</li></ul>\", \"de\": \"<ul><li>Gefragteste Branchenfähigkeit</li></ul>\", \"en\": \"<ul><li>Most in-demand industry skill</li><li>Kaggle competition prep</li></ul>\", \"tr\": \"<ul><li>Sektörde en çok aranan beceri</li><li>Kaggle yarışma hazırlığı</li><li>Kariyer danışmanlığı</li></ul>\"}', NULL, NULL, '₺2.800', '18 Hafta', 54, 'Türkçe', 198, 1, 'Prof. Ayşe Kaya', NULL, 1, 6, '2025-12-31 15:18:06', '2026-02-24 15:18:06', '2026-02-24 15:18:06'),
(7, '{\"ar\": \"دورة المحادثة الإنجليزية (B2)\", \"de\": \"Englisch Sprechkurs (B2)\", \"en\": \"English Speaking Course (B2)\", \"tr\": \"İngilizce Konuşma Kursu (B2)\"}', '{\"ar\": \"اكتسب مهارات التحدث بالإنجليزية بطلاقة\", \"de\": \"Fließend Englisch sprechen lernen.\", \"en\": \"Gain fluent English speaking skills. One-on-one practice with native instructors.\", \"tr\": \"Akıcı İngilizce konuşma becerisi kazanın. Native eğitmenlerle birebir pratik.\"}', '{\"ar\": \"<p>تقدم هذه الدورة ممارسة المحادثة.</p>\", \"de\": \"<p>Dieser Kurs bietet Sprechpraxis vom Alltag bis zum Business-Englisch.</p>\", \"en\": \"<p>This course offers speaking practice from everyday conversation to business English.</p>\", \"tr\": \"<p>Bu kurs, günlük konuşmadan iş İngilizcesine kadar geniş bir yelpazede konuşma pratiği sunar. Her hafta native speaker eğitmenlerle canlı oturumlar.</p>\"}', '{\"ar\": \"<ul><li>أنماط المحادثة اليومية</li></ul>\", \"de\": \"<ul><li>Tägliche Konversationsmuster</li></ul>\", \"en\": \"<ul><li>Daily conversation patterns</li><li>Business English</li><li>Presentation skills</li></ul>\", \"tr\": \"<ul><li>Günlük konuşma kalıpları</li><li>İş İngilizcesi</li><li>Sunum yapma becerileri</li><li>Telaffuz düzeltme</li></ul>\"}', '{\"ar\": \"<ul><li>مدربون ناطقون أصليون</li></ul>\", \"de\": \"<ul><li>Muttersprachliche Lehrer</li></ul>\", \"en\": \"<ul><li>Native speaker instructors</li><li>Small group sessions</li></ul>\", \"tr\": \"<ul><li>Native speaker eğitmenler</li><li>Küçük grup oturumları (max 6 kişi)</li><li>IELTS hazırlık desteği</li></ul>\"}', NULL, NULL, '₺900', '12 Hafta', 24, 'İngilizce / Türkçe', 420, 1, 'Sarah Johnson', NULL, 1, 7, '2026-01-17 15:18:06', '2026-02-24 15:18:06', '2026-02-24 15:18:06'),
(8, '{\"ar\": \"التصميم الجرافيكي باستخدام Adobe Illustrator\", \"de\": \"Grafikdesign mit Adobe Illustrator\", \"en\": \"Graphic Design with Adobe Illustrator\", \"tr\": \"Adobe Illustrator ile Grafik Tasarım\"}', '{\"ar\": \"أتقن تصميم الشعارات والأيقونات والرسوم التوضيحية\", \"de\": \"Meistern Sie Logo-, Icon- und Illustrationsdesign.\", \"en\": \"Master logo, icon, illustration and print material design.\", \"tr\": \"Logo, ikon, illüstrasyon ve basılı materyal tasarımında ustalaşın.\"}', '{\"ar\": \"<p>تعلم جميع أدوات Adobe Illustrator.</p>\", \"de\": \"<p>Lernen Sie alle Adobe Illustrator-Werkzeuge.</p>\", \"en\": \"<p>Learn all Adobe Illustrator tools. Vector drawing, logo design processes and corporate identity creation.</p>\", \"tr\": \"<p>Adobe Illustrator\'ın tüm araçlarını öğrenin. Vektörel çizim, logo tasarım süreçleri, kurumsal kimlik oluşturma ve baskıya hazır dosya üretimi.</p>\"}', '{\"ar\": \"<ul><li>تقنيات الرسم المتجه</li></ul>\", \"de\": \"<ul><li>Vektorzeichentechniken</li></ul>\", \"en\": \"<ul><li>Vector drawing techniques</li><li>Logo design process</li><li>Corporate identity</li></ul>\", \"tr\": \"<ul><li>Vektörel çizim teknikleri</li><li>Logo tasarım süreci</li><li>Kurumsal kimlik</li><li>Baskı dosyası hazırlama</li></ul>\"}', '{\"ar\": \"<ul><li>مدرب معتمد من Adobe</li></ul>\", \"de\": \"<ul><li>Adobe-zertifizierter Ausbilder</li></ul>\", \"en\": \"<ul><li>Adobe certified instructor</li><li>Freelance career guidance</li></ul>\", \"tr\": \"<ul><li>Adobe sertifikalı eğitmen</li><li>Freelance kariyer rehberliği</li><li>50+ uygulama projesi</li></ul>\"}', NULL, NULL, '₺1.400', '10 Hafta', 30, 'Türkçe', 167, 1, 'Burak Şahin', NULL, 1, 8, '2025-12-31 15:18:06', '2026-02-24 15:18:06', '2026-02-24 15:18:06'),
(9, '{\"ar\": \"إدارة وسائل التواصل الاجتماعي\", \"de\": \"Social Media Management\", \"en\": \"Social Media Management\", \"tr\": \"Sosyal Medya Yönetimi\"}', '{\"ar\": \"استراتيجية المحتوى وإدارة المجتمع\", \"de\": \"Content-Strategie und Community-Management.\", \"en\": \"Content strategy and community management for Instagram, TikTok, LinkedIn and YouTube.\", \"tr\": \"Instagram, TikTok, LinkedIn ve YouTube için içerik stratejisi ve topluluk yönetimi.\"}', '{\"ar\": \"<p>تعلم إدارة منصات التواصل الاجتماعي باحترافية.</p>\", \"de\": \"<p>Lernen Sie Social-Media-Plattformen professionell zu verwalten.</p>\", \"en\": \"<p>Learn to professionally manage social media platforms.</p>\", \"tr\": \"<p>Sosyal medya platformlarını profesyonelce yönetmeyi öğrenin. İçerik planlaması, topluluk yönetimi, reklam optimizasyonu ve analitik raporlama.</p>\"}', '{\"ar\": \"<ul><li>تخطيط تقويم المحتوى</li></ul>\", \"de\": \"<ul><li>Content-Kalenderplanung</li></ul>\", \"en\": \"<ul><li>Content calendar planning</li><li>Reel and story production</li><li>Ad management</li></ul>\", \"tr\": \"<ul><li>İçerik takvimi planlama</li><li>Reel ve story üretimi</li><li>Reklam yönetimi</li><li>Analitik ve raporlama</li></ul>\"}', '{\"ar\": \"<ul><li>تجربة إدارة علامة تجارية حقيقية</li></ul>\", \"de\": \"<ul><li>Echte Markenmanagement-Erfahrung</li></ul>\", \"en\": \"<ul><li>Real brand management experience</li><li>Canva and CapCut training included</li></ul>\", \"tr\": \"<ul><li>Gerçek marka yönetimi deneyimi</li><li>Canva ve CapCut eğitimi dahil</li><li>Staj imkanı</li></ul>\"}', NULL, NULL, '₺950', '8 Hafta', 24, 'Türkçe', 385, 0, 'Selin Yıldız', NULL, 1, 9, '2026-01-12 15:18:06', '2026-02-24 15:18:06', '2026-02-24 15:18:06');

-- --------------------------------------------------------

--
-- Table structure for table `course_categories`
--

CREATE TABLE `course_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` json DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_categories`
--

INSERT INTO `course_categories` (`id`, `name`, `icon`, `color`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, '{\"ar\": \"برمجة\", \"de\": \"Software\", \"en\": \"Software\", \"tr\": \"Yazılım\"}', NULL, '#DE1EF9', 1, 1, '2026-02-24 15:18:06', '2026-02-24 21:40:32'),
(2, '{\"ar\": \"تصميم\", \"de\": \"Design\", \"en\": \"Design\", \"tr\": \"Tasarım\"}', NULL, '#42AC98', 1, 2, '2026-02-24 15:18:06', '2026-02-24 21:40:32'),
(3, '{\"ar\": \"تسويق\", \"de\": \"Marketing\", \"en\": \"Marketing\", \"tr\": \"Pazarlama\"}', NULL, '#DF4343', 1, 3, '2026-02-24 15:18:06', '2026-02-24 21:40:32'),
(4, '{\"ar\": \"تطوير الأعمال\", \"de\": \"Geschäftsentwicklung\", \"en\": \"Business\", \"tr\": \"İş Geliştirme\"}', NULL, '#543EE4', 1, 4, '2026-02-24 15:18:06', '2026-02-24 21:40:32'),
(5, '{\"ar\": \"تعليم اللغات\", \"de\": \"Sprache\", \"en\": \"Language\", \"tr\": \"Dil Eğitimi\"}', NULL, '#FF6B35', 1, 5, '2026-02-24 15:18:06', '2026-02-24 21:40:32');

-- --------------------------------------------------------

--
-- Table structure for table `course_course_category`
--

CREATE TABLE `course_course_category` (
  `id` bigint UNSIGNED NOT NULL,
  `course_id` bigint UNSIGNED NOT NULL,
  `course_category_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_course_category`
--

INSERT INTO `course_course_category` (`id`, `course_id`, `course_category_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 2, NULL, NULL),
(3, 3, 3, NULL, NULL),
(4, 4, 1, NULL, NULL),
(5, 5, 4, NULL, NULL),
(6, 6, 1, NULL, NULL),
(7, 7, 5, NULL, NULL),
(8, 8, 2, NULL, NULL),
(9, 9, 3, NULL, NULL),
(10, 1, 2, NULL, NULL),
(11, 1, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `course_page_infos`
--

CREATE TABLE `course_page_infos` (
  `id` bigint UNSIGNED NOT NULL,
  `title` json DEFAULT NULL,
  `field_styles` json DEFAULT NULL,
  `default_styles` json DEFAULT NULL,
  `breadcrumb_home` json DEFAULT NULL,
  `breadcrumb_current` json DEFAULT NULL,
  `detail_breadcrumb_current` json DEFAULT NULL,
  `search_placeholder` json DEFAULT NULL,
  `search_button_text` json DEFAULT NULL,
  `result_text` json DEFAULT NULL,
  `detail_what_learn_title` json DEFAULT NULL,
  `detail_why_choose_title` json DEFAULT NULL,
  `sidebar_info_title` json DEFAULT NULL,
  `sidebar_price_label` json DEFAULT NULL,
  `sidebar_instructor_label` json DEFAULT NULL,
  `sidebar_certification_label` json DEFAULT NULL,
  `sidebar_lessons_label` json DEFAULT NULL,
  `sidebar_duration_label` json DEFAULT NULL,
  `sidebar_language_label` json DEFAULT NULL,
  `sidebar_students_label` json DEFAULT NULL,
  `sidebar_contact_title` json DEFAULT NULL,
  `sidebar_contact_phone_label` json DEFAULT NULL,
  `sidebar_contact_phone` json DEFAULT NULL,
  `sidebar_contact_email_label` json DEFAULT NULL,
  `sidebar_contact_email` json DEFAULT NULL,
  `sidebar_contact_address_label` json DEFAULT NULL,
  `sidebar_contact_address` json DEFAULT NULL,
  `cta_label` json DEFAULT NULL,
  `cta_title` json DEFAULT NULL,
  `cta_description` json DEFAULT NULL,
  `cta_button_text` json DEFAULT NULL,
  `cta_button_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cta_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_page_infos`
--

INSERT INTO `course_page_infos` (`id`, `title`, `field_styles`, `default_styles`, `breadcrumb_home`, `breadcrumb_current`, `detail_breadcrumb_current`, `search_placeholder`, `search_button_text`, `result_text`, `detail_what_learn_title`, `detail_why_choose_title`, `sidebar_info_title`, `sidebar_price_label`, `sidebar_instructor_label`, `sidebar_certification_label`, `sidebar_lessons_label`, `sidebar_duration_label`, `sidebar_language_label`, `sidebar_students_label`, `sidebar_contact_title`, `sidebar_contact_phone_label`, `sidebar_contact_phone`, `sidebar_contact_email_label`, `sidebar_contact_email`, `sidebar_contact_address_label`, `sidebar_contact_address`, `cta_label`, `cta_title`, `cta_description`, `cta_button_text`, `cta_button_url`, `cta_image`, `created_at`, `updated_at`) VALUES
(1, '{\"ar\": \"دوراتنا\", \"de\": \"Unsere Kurse\", \"en\": \"Our Courses\", \"tr\": \"Kurslarımız\"}', '{\"title\": {\"color\": \"\", \"opacity\": \"100\", \"fontSize\": \"\", \"fontStyle\": \"\", \"textAlign\": \"\", \"fontFamily\": \"\", \"fontWeight\": \"\"}, \"cta_label\": {\"color\": \"#ffcf24\", \"opacity\": \"\", \"fontSize\": \"\", \"fontStyle\": \"\", \"textAlign\": \"\", \"fontFamily\": \"\", \"fontWeight\": \"\"}, \"cta_title\": {\"color\": \"#ffffff\", \"opacity\": \"\", \"fontSize\": \"\", \"fontStyle\": \"\", \"textAlign\": \"\", \"fontFamily\": \"\", \"fontWeight\": \"\"}, \"breadcrumb_home\": {\"color\": \"#ff0000\"}, \"cta_description\": {\"color\": \"#ffffff\", \"opacity\": \"\", \"fontSize\": \"\", \"fontStyle\": \"\", \"textAlign\": \"\", \"fontFamily\": \"\", \"fontWeight\": \"\"}, \"breadcrumb_current\": {\"color\": \"\", \"fontSize\": \"\", \"fontStyle\": \"\", \"textAlign\": \"\", \"fontFamily\": \"\", \"fontWeight\": \"\"}, \"sidebar_language_label\": {\"textAlign\": \"center\"}, \"sidebar_contact_phone_label\": {\"textAlign\": \"left\"}}', NULL, '{\"ar\": \"الرئيسية\", \"de\": \"STARTSEITE\", \"en\": \"HOME\", \"tr\": \"ANA SAYFA\"}', '{\"ar\": \"الدورات\", \"de\": \"KURSE\", \"en\": \"COURSES\", \"tr\": \"KURSLAR\"}', '{\"ar\": \"تفاصيل الدورة\", \"de\": \"Kursdetails\", \"en\": \"Course Details\", \"tr\": \"Kurs Detayı\"}', '{\"ar\": \"ابحث عن دورتك...\", \"de\": \"Kurse suchen...\", \"en\": \"Search courses...\", \"tr\": \"Kursunuzu arayın...\"}', '{\"ar\": \"بحث\", \"de\": \"Suchen\", \"en\": \"Search\", \"tr\": \"Ara\"}', '{\"ar\": \"دورات تم العثور عليها\", \"de\": \"Kurse gefunden\", \"en\": \"courses found\", \"tr\": \"kurs bulundu\"}', '{\"ar\": \"ماذا ستتعلم؟\", \"de\": \"Was werden Sie lernen?\", \"en\": \"What Will You Learn?\", \"tr\": \"Neler Öğreneceksiniz?\"}', '{\"ar\": \"لماذا هذه الدورة؟\", \"de\": \"Warum dieser Kurs?\", \"en\": \"Why This Course?\", \"tr\": \"Neden Bu Kurs?\"}', '{\"ar\": \"معلومات الدورة:\", \"de\": \"Kursinformationen:\", \"en\": \"Course Information:\", \"tr\": \"Kurs Bilgileri:\"}', '{\"ar\": \"السعر:\", \"de\": \"Preis:\", \"en\": \"Price:\", \"tr\": \"Fiyat:\"}', '{\"ar\": \"المدرب:\", \"de\": \"Dozent:\", \"en\": \"Instructor:\", \"tr\": \"Eğitmen:\"}', '{\"ar\": \"شهادة:\", \"de\": \"Zertifikat:\", \"en\": \"Certificate:\", \"tr\": \"Sertifika:\"}', '{\"ar\": \"الدروس:\", \"de\": \"Lektionen:\", \"en\": \"Lessons:\", \"tr\": \"Dersler:\"}', '{\"ar\": \"المدة:\", \"de\": \"Dauer:\", \"en\": \"Duration:\", \"tr\": \"Süre:\"}', '{\"ar\": \"اللغة:\", \"de\": \"Sprache:\", \"en\": \"Language:\", \"tr\": \"Dil:\"}', '{\"ar\": \"الطلاب:\", \"de\": \"Studenten:\", \"en\": \"Students:\", \"tr\": \"Öğrenciler:\"}', '{\"ar\": \"اتصل بنا\", \"de\": \"Kontakt\", \"en\": \"Contact Us\", \"tr\": \"İletişim\"}', '{\"ar\": \"دعم على مدار الساعة\", \"de\": \"24/7 Support\", \"en\": \"24/7 Support\", \"tr\": \"7/24 Destek\"}', '{\"ar\": \"+90 532 321 33 33\", \"de\": \"+90 532 321 33 33\", \"en\": \"+90 532 321 33 33\", \"tr\": \"+90 532 321 33 33\"}', '{\"ar\": \"أرسل رسالة\", \"de\": \"Nachricht senden\", \"en\": \"Send Message\", \"tr\": \"Mesaj Gönderin\"}', '{\"ar\": \"info@parosisakademi.com\", \"de\": \"info@parosisakademi.com\", \"en\": \"info@parosisakademi.com\", \"tr\": \"info@parosisakademi.com\"}', '{\"ar\": \"عنواننا\", \"de\": \"Unsere Adresse\", \"en\": \"Our Address\", \"tr\": \"Adresimiz\"}', '{\"ar\": \"إسطنبول، تركيا\", \"de\": \"Istanbul, Türkei\", \"en\": \"Istanbul, Turkey\", \"tr\": \"İstanbul, Türkiye\"}', '{\"ar\": \"ابدأ الآن\", \"de\": \"JETZT STARTEN\", \"en\": \"GET STARTED\", \"tr\": \"HEMEN BAŞLAYIN\"}', '{\"ar\": \"ابدأ رحلتك التعليمية اليوم\", \"de\": \"Starten Sie Ihre Lernreise heute\", \"en\": \"Start your learning journey today\", \"tr\": \"Eğitim yolculuğunuza bugün başlayın\"}', '{\"ar\": \"حقق أهدافك مع مدربينا الخبراء.\", \"de\": \"Erreichen Sie Ihre Ziele mit unseren Experten.\", \"en\": \"Reach your goals with our expert instructors. Thousands of students have shaped their careers with Parosis Academy.\", \"tr\": \"Uzman eğitmenlerimizle hedeflerinize ulaşın. Binlerce öğrenci kariyerini Parosis Akademi ile  \\r\\nşekillendirdi.\"}', '{\"ar\": \"سجل الآن\", \"de\": \"Jetzt anmelden\", \"en\": \"Sign Up Now\", \"tr\": \"Hemen Kaydol\"}', '/kurslar', NULL, '2026-02-24 15:18:06', '2026-02-28 07:07:11');

-- --------------------------------------------------------

--
-- Table structure for table `emergency_contacts`
--

CREATE TABLE `emergency_contacts` (
  `id` bigint UNSIGNED NOT NULL,
  `student_id` bigint UNSIGNED NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `relationship` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `emergency_contacts`
--

INSERT INTO `emergency_contacts` (`id`, `student_id`, `full_name`, `relationship`, `phone`, `address`, `created_at`, `updated_at`) VALUES
(7, 12, 'Cihan Omur', 'Magni vitae dolor re', NULL, 'Geylani', '2025-09-29 12:21:03', '2025-09-29 12:51:10'),
(8, 13, 'Hannah Macias', 'Aliquam do id ullam', '13428946696', 'Temporibus laborum e', '2025-09-29 13:01:52', '2025-09-29 13:01:52'),
(9, 14, '123', '123', '05393518739', '123', '2025-10-04 14:29:34', '2025-10-04 14:29:34');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint UNSIGNED NOT NULL,
  `question` json DEFAULT NULL,
  `answer` json DEFAULT NULL,
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`, `category_id`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(2, '{\"en\": \"What documents are required for registration?\", \"tr\": \"Kayıt için hangi belgeler gereklidir?\"}', '{\"en\": \"For registration, you need a copy of your ID, 2 passport photos, and a document showing your education status (diploma or student certificate). After filling out the online pre-registration form, you can deliver these documents to our office.\", \"tr\": \"Kayıt için kimlik fotokopisi, 2 adet vesikalık fotoğraf ve öğrenim durumunuzu gösteren bir belge (diploma veya öğrenci belgesi) gereklidir. Online ön kayıt formunu doldurduktan sonra bu belgeleri ofisimize teslim edebilirsiniz.\"}', NULL, 0, 1, '2026-02-23 15:42:43', '2026-02-23 15:42:43'),
(3, '{\"en\": \"How long do the courses last?\", \"tr\": \"Kurslar ne kadar sürüyor?\"}', '{\"en\": \"Course durations vary by program. Our basic level courses are typically 3 months, intermediate 4-6 months, and advanced 6-9 months. These periods may be shorter in our intensive programs. You can check our course pages for detailed information.\", \"tr\": \"Kurs süreleri programa göre değişmektedir. Temel seviye kurslarımız genellikle 3 ay, orta seviye 4-6 ay, ileri seviye ise 6-9 ay sürmektedir. Yoğun programlarımızda bu süreler daha kısa olabilir. Detaylı bilgi için kurs sayfalarımızı inceleyebilirsiniz.\"}', NULL, 1, 1, '2026-02-23 15:42:43', '2026-02-23 15:42:43'),
(4, '{\"en\": \"Do you have an online education option?\", \"tr\": \"Online eğitim seçeneğiniz var mı?\"}', '{\"en\": \"Yes, many of our courses are offered both in-person and online. Our online classes are conducted live via Zoom and are recorded. You can watch the classes you missed later.\", \"tr\": \"Evet, birçok kursumuz hem yüz yüze hem de online olarak sunulmaktadır. Online derslerimiz canlı olarak Zoom üzerinden gerçekleştirilmekte ve kayıt altına alınmaktadır. Kaçırdığınız dersleri daha sonra izleyebilirsiniz.\"}', NULL, 2, 1, '2026-02-23 15:42:43', '2026-02-23 15:42:43'),
(5, '{\"en\": \"Do you offer installment options?\", \"tr\": \"Taksit imkanı sunuyor musunuz?\"}', '{\"en\": \"Yes, we offer flexible payment plans for all our courses. You can pay in 3, 6, or 9 installments with a credit card. We also have special discounts for cash payments and upfront registrations. Contact our advisors for details.\", \"tr\": \"Evet, tüm kurslarımız için esnek ödeme planları sunmaktayız. Kredi kartına 3, 6 veya 9 taksit yapabilirsiniz. Ayrıca nakit ödemelerde ve peşin kayıtlarda özel indirimlerimiz bulunmaktadır. Detaylar için danışmanlarımızla görüşebilirsiniz.\"}', NULL, 3, 1, '2026-02-23 15:42:43', '2026-02-23 15:42:43'),
(6, '{\"en\": \"Who are your instructors?\", \"tr\": \"Eğitmenleriniz kimlerdir?\"}', '{\"en\": \"Our instructors are professionals with at least 5 years of experience in their fields, actively working in the industry. All of them have pedagogical training and hold international certificates. You can find detailed information about our instructors on our Teachers page.\", \"tr\": \"Eğitmenlerimiz alanlarında en az 5 yıl deneyime sahip, sektörde aktif olarak çalışan profesyonellerdir. Tamamı pedagojik formasyon eğitimi almış olup, uluslararası sertifikalara sahiptir. Eğitmen kadromuz hakkında detaylı bilgiyi Eğitmenler sayfamızdan inceleyebilirsiniz.\"}', NULL, 4, 1, '2026-02-23 15:42:43', '2026-02-23 15:42:43'),
(7, '{\"en\": \"What happens in case of absenteeism?\", \"tr\": \"Devamsızlık durumunda ne olur?\"}', '{\"en\": \"Students who are absent for more than 20% of the total class hours cannot qualify for a certificate. However, make-up classes are arranged for excused absences. It is sufficient to notify us in advance for illness or mandatory situations.\", \"tr\": \"Toplam ders saatinin %20\'sinden fazla devamsızlık yapan öğrenciler sertifika almaya hak kazanamazlar. Ancak mazeret durumlarında telafi dersleri düzenlenmektedir. Hastalık veya zorunlu durumlar için önceden bildirimde bulunmanız yeterlidir.\"}', NULL, 5, 1, '2026-02-23 15:42:43', '2026-02-23 15:42:43'),
(8, '{\"en\": \"Do you provide certificates?\", \"tr\": \"Sertifika veriyor musunuz?\"}', '{\"en\": \"Yes, all students who successfully complete our courses receive an internationally recognized certificate. Our certificates are approved by the Ministry of Education and can be verified with a QR code. We also offer international exam preparation at the end of some programs.\", \"tr\": \"Evet, kurslarımızı başarıyla tamamlayan tüm öğrencilerimize uluslararası geçerliliği olan sertifika verilmektedir. Sertifikalarımız MEB onaylıdır ve QR kod ile doğrulanabilir. Ayrıca bazı programlarımız sonunda uluslararası sınav hazırlığı da sunmaktayız.\"}', NULL, 6, 1, '2026-02-23 15:42:43', '2026-02-23 15:42:43'),
(9, '{\"en\": \"Can I take a trial class?\", \"tr\": \"Deneme dersi alabilir miyim?\"}', '{\"en\": \"Of course! We offer free trial classes for all our courses. By attending a trial class, you can get to know our educational environment, instructor, and curriculum closely. You can make an appointment for a trial class through our website or by phone.\", \"tr\": \"Elbette! Tüm kurslarımız için ücretsiz deneme dersi imkanı sunuyoruz. Deneme dersine katılarak eğitim ortamımızı, eğitmenimizi ve müfredatımızı yakından tanıyabilirsiniz. Deneme dersi için web sitemizden veya telefonla randevu alabilirsiniz.\"}', NULL, 7, 1, '2026-02-23 15:42:43', '2026-02-23 15:42:43');

-- --------------------------------------------------------

--
-- Table structure for table `faq_page_infos`
--

CREATE TABLE `faq_page_infos` (
  `id` bigint UNSIGNED NOT NULL,
  `title` json DEFAULT NULL,
  `field_styles` json DEFAULT NULL,
  `default_styles` json DEFAULT NULL,
  `subtitle` json DEFAULT NULL,
  `description` json DEFAULT NULL,
  `breadcrumb_home` json DEFAULT NULL,
  `breadcrumb_current` json DEFAULT NULL,
  `section_label` json DEFAULT NULL,
  `section_title` json DEFAULT NULL,
  `cta_label` json DEFAULT NULL,
  `cta_title` json DEFAULT NULL,
  `cta_description` json DEFAULT NULL,
  `cta_button_text` json DEFAULT NULL,
  `form_title` json DEFAULT NULL,
  `form_description` json DEFAULT NULL,
  `form_name_placeholder` json DEFAULT NULL,
  `form_email_placeholder` json DEFAULT NULL,
  `form_message_placeholder` json DEFAULT NULL,
  `form_privacy_text` json DEFAULT NULL,
  `form_button_text` json DEFAULT NULL,
  `cta_button_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cta_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_form_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `form_action_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faq_page_infos`
--

INSERT INTO `faq_page_infos` (`id`, `title`, `field_styles`, `default_styles`, `subtitle`, `description`, `breadcrumb_home`, `breadcrumb_current`, `section_label`, `section_title`, `cta_label`, `cta_title`, `cta_description`, `cta_button_text`, `form_title`, `form_description`, `form_name_placeholder`, `form_email_placeholder`, `form_message_placeholder`, `form_privacy_text`, `form_button_text`, `cta_button_url`, `cta_image`, `contact_form_image`, `form_action_url`, `created_at`, `updated_at`) VALUES
(2, '{\"en\": \"Frequently Asked Questions\", \"tr\": \"Sıkça Sorulan Sorular\"}', NULL, NULL, '{\"en\": \"What you wonder\", \"tr\": \"Merak ettikleriniz\"}', '{\"en\": \"We compiled the most frequently asked questions for you.\", \"tr\": \"Öğrencilerimizin en çok sorduğu soruları sizin için derledik.\"}', '{\"en\": \"Home\", \"tr\": \"Ana Sayfa\"}', '{\"en\": \"FAQ\", \"tr\": \"SSS\"}', '{\"en\": \"FAQ\", \"tr\": \"SSS\"}', '{\"en\": \"Frequently Asked Questions\", \"tr\": \"Sıkça Sorulan Sorular\"}', '{\"en\": \"GET STARTED\", \"tr\": \"BAŞLAYIN\"}', '{\"en\": \"Start your education journey today\", \"tr\": \"Eğitim yolculuğunuza bugün başlayın\"}', '{\"en\": \"Reach your goals with our expert instructors.\", \"tr\": \"Uzman eğitmenlerimizle hedeflerinize ulaşın.\"}', '{\"en\": \"Enroll Now\", \"tr\": \"Hemen Kaydol\"}', '{\"en\": \"CONTACT US\", \"tr\": \"BİZE ULAŞIN\"}', '{\"en\": \"Could not find your question? Write to us\", \"tr\": \"Sorunuzu bulamadınız mı? Bize yazın\"}', '{\"en\": \"Full Name\", \"tr\": \"Ad Soyad\"}', '{\"en\": \"Your email address\", \"tr\": \"E-posta adresiniz\"}', '{\"en\": \"Write your question here...\", \"tr\": \"Sorunuzu buraya yazın...\"}', '{\"en\": \"I agree to the Privacy Policy.\", \"tr\": \"Gizlilik Politikasını kabul ediyorum.\"}', '{\"en\": \"Send Your Message\", \"tr\": \"Mesajınızı Gönderin\"}', NULL, NULL, NULL, 'https://formspree.io/f/mdkngdke', '2026-02-23 15:42:43', '2026-02-23 15:42:43');

-- --------------------------------------------------------

--
-- Table structure for table `footer_page_infos`
--

CREATE TABLE `footer_page_infos` (
  `id` bigint UNSIGNED NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_text` json DEFAULT NULL,
  `links_title` json DEFAULT NULL,
  `contact_title` json DEFAULT NULL,
  `newsletter_title` json DEFAULT NULL,
  `newsletter_text` json DEFAULT NULL,
  `newsletter_button` json DEFAULT NULL,
  `newsletter_placeholder` json DEFAULT NULL,
  `copyright_text` json DEFAULT NULL,
  `support_label` json DEFAULT NULL,
  `email_label` json DEFAULT NULL,
  `address_label` json DEFAULT NULL,
  `social_links` json DEFAULT NULL,
  `nav_links` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `footer_page_infos`
--

INSERT INTO `footer_page_infos` (`id`, `logo`, `about_text`, `links_title`, `contact_title`, `newsletter_title`, `newsletter_text`, `newsletter_button`, `newsletter_placeholder`, `copyright_text`, `support_label`, `email_label`, `address_label`, `social_links`, `nav_links`, `created_at`, `updated_at`) VALUES
(1, 'assets-front/img/logo-parosis-akademi.svg', '{\"tr\": \"Gelecegin teknolojisine yon veren akademi. Kariyerinizi bir adim oteye tasiyin.\"}', '{\"tr\": \"Baglantilar\"}', '{\"tr\": \"Iletisim\"}', '{\"tr\": \"Abone Olun\"}', '{\"tr\": \"Bultenimize abone olmak icin e-posta adresinizi girin\"}', '{\"tr\": \"Abone Ol\"}', '{\"tr\": \"E-posta girin\"}', '{\"tr\": \"Copyright 2026 Parosis Akademi | Tum Haklari Saklidir\"}', '{\"tr\": \"7/24 Destek\"}', '{\"tr\": \"Mesaj Gonderin\"}', '{\"tr\": \"Adresimiz\"}', '[{\"url\": \"https://www.facebook.com\", \"icon\": \"assets-front/img/icons/icon-dark-facebook.svg\", \"name\": \"Facebook\"}, {\"url\": \"https://www.twitter.com\", \"icon\": \"assets-front/img/icons/icon-dark-twitter.svg\", \"name\": \"Twitter\"}, {\"url\": \"https://www.instagram.com\", \"icon\": \"assets-front/img/icons/icon-dark-instagram.svg\", \"name\": \"Instagram\"}, {\"url\": \"https://www.dribbble.com\", \"icon\": \"assets-front/img/icons/icon-dark-dribbble.svg\", \"name\": \"Dribbble\"}]', '[{\"url\": \"/hakkimizda\", \"label\": {\"tr\": \"Hakkimizda\"}}, {\"url\": \"/kurslar\", \"label\": {\"tr\": \"Kurslarimiz\"}}, {\"url\": \"#\", \"label\": {\"tr\": \"Fiyatlandirma\"}}, {\"url\": \"/iletisim\", \"label\": {\"tr\": \"Iletisim\"}}, {\"url\": \"/blog\", \"label\": {\"tr\": \"Haberler\"}}, {\"url\": \"/sss\", \"label\": {\"tr\": \"SSS\"}}]', '2026-03-04 02:58:46', '2026-03-04 03:29:42');

-- --------------------------------------------------------

--
-- Table structure for table `home_page_infos`
--

CREATE TABLE `home_page_infos` (
  `id` bigint UNSIGNED NOT NULL,
  `welcome_label` json DEFAULT NULL,
  `welcome_title` json DEFAULT NULL,
  `welcome_description` json DEFAULT NULL,
  `welcome_features` json DEFAULT NULL,
  `welcome_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `welcome_stat_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `welcome_stat_text` json DEFAULT NULL,
  `categories_label` json DEFAULT NULL,
  `categories_title` json DEFAULT NULL,
  `categories_button_text` json DEFAULT NULL,
  `categories_button_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `features` json DEFAULT NULL,
  `courses_label` json DEFAULT NULL,
  `courses_title` json DEFAULT NULL,
  `blog_label` json DEFAULT NULL,
  `blog_title` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `why_label` json DEFAULT NULL,
  `why_title` json DEFAULT NULL,
  `why_description` json DEFAULT NULL,
  `why_items` json DEFAULT NULL,
  `why_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `why_stat_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `why_stat_text` json DEFAULT NULL,
  `client_logo_text` text COLLATE utf8mb4_unicode_ci,
  `funfact_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `funfact_items` json DEFAULT NULL,
  `field_styles` json DEFAULT NULL,
  `default_styles` json DEFAULT NULL,
  `testimonial_label` json DEFAULT NULL,
  `testimonial_title` json DEFAULT NULL,
  `testimonial_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `testimonial_stat_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `testimonial_stat_text` json DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `home_page_infos`
--

INSERT INTO `home_page_infos` (`id`, `welcome_label`, `welcome_title`, `welcome_description`, `welcome_features`, `welcome_image`, `welcome_stat_number`, `welcome_stat_text`, `categories_label`, `categories_title`, `categories_button_text`, `categories_button_url`, `features`, `courses_label`, `courses_title`, `blog_label`, `blog_title`, `created_at`, `updated_at`, `why_label`, `why_title`, `why_description`, `why_items`, `why_image`, `why_stat_number`, `why_stat_text`, `client_logo_text`, `funfact_image`, `funfact_items`, `field_styles`, `default_styles`, `testimonial_label`, `testimonial_title`, `testimonial_image`, `testimonial_stat_number`, `testimonial_stat_text`) VALUES
(1, '{\"tr\": \"PAROSIS\'E HOS GELDINIZ\"}', '{\"tr\": \"Dijital Online Akademi: Yaratici Mukemmellige Giden Yolunuz\"}', '{\"tr\": null}', '{\"tr\": [\"Our Expert Trainers\", \"Online Remote Learning\", \"Easy to follow curriculum\", \"Lifetime Access\"]}', NULL, '9394', '{\"tr\": null}', '{\"tr\": null}', '{\"tr\": \"Ogrenmek Istediginiz En Iyi Kategoriler\"}', '{\"tr\": null}', NULL, '{\"tr\": [{\"icon\": \"assets-front/img/icons/feature-icon-1.svg\", \"title\": \"Educator Support\", \"bg_color\": \"#FFCD20\", \"description\": \"Excepteur sint occaecat cupidatat non the proident sunt in culpa\"}, {\"icon\": \"assets-front/img/icons/feature-icon-2.svg\", \"title\": \"Top Instructor\", \"bg_color\": \"#6FC081\", \"description\": \"Excepteur sint occaecat cupidatat non the proident sunt in culpa\"}, {\"icon\": \"assets-front/img/icons/feature-icon-3.svg\", \"title\": \"Award Wining\", \"bg_color\": \"#DF4343\", \"description\": \"Excepteur sint occaecat cupidatat non the proident sunt in culpa\"}]}', '{\"tr\": null}', '{\"tr\": null}', '{\"tr\": null}', '{\"tr\": null}', '2026-02-26 15:07:03', '2026-03-01 19:01:23', '{\"tr\": null}', '{\"tr\": null}', '{\"tr\": null}', '{\"tr\": [{\"icon\": \"assets-front/img/icons/content-icon-1.svg\", \"title\": \"Face-to-face Teaching\", \"bg_color\": \"#20B9AB\", \"description\": \"Excepteur sint occaecat cupidatat non proident sunt in culpa qui officia for this is a for that an deserunt mollit.\"}, {\"icon\": \"assets-front/img/icons/content-icon-2.svg\", \"title\": \"24/7 Support Available\", \"bg_color\": \"#DF4343\", \"description\": \"Excepteur sint occaecat cupidatat non proident sunt in culpa qui officia for this is a for that an deserunt mollit.\"}]}', NULL, '69K', '{\"tr\": null}', '{\"tr\":null}', NULL, '{\"tr\": [{\"text\": \"Student enrolled\", \"number\": \"5923\"}, {\"text\": \"Classes completed\", \"number\": \"8497\"}, {\"text\": \"Learners report\", \"number\": \"7554\"}, {\"text\": \"Top instructors\", \"number\": \"2755\"}]}', '{\"ff_text_0\": {\"color\": \"rgba(255,255,255,0.8)\", \"opacity\": \"\", \"fontSize\": \"\", \"fontStyle\": \"\", \"textAlign\": \"\", \"fontFamily\": \"\", \"fontWeight\": \"\"}, \"welcome_label\": {\"color\": \"#84994f\"}, \"welcome_title\": {\"color\": \"#011c1a\", \"fontSize\": \"2rem\"}, \"why_stat_number\": {\"color\": \"#dd4646\", \"fontSize\": \"\", \"fontFamily\": \"\"}, \"categories_title\": {\"fontSize\": \"1.875rem\", \"fontFamily\": \"\"}, \"welcome_stat_number\": {\"color\": \"#DF4343\", \"opacity\": \"\", \"fontSize\": \"1.5rem\", \"fontStyle\": \"\", \"textAlign\": \"\", \"fontFamily\": \"\", \"fontWeight\": \"bold\"}}', '{\"feat_desc\": {\"color\": \"#404040\", \"fontSize\": \"\", \"textAlign\": \"\"}, \"welcome_label\": {\"color\": \"#84994F\", \"fontSize\": \"0.875rem\", \"textAlign\": \"right\"}}', '{\"tr\": null}', '{\"tr\": null}', NULL, NULL, '{\"tr\": null}');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint UNSIGNED NOT NULL,
  `name` json DEFAULT NULL,
  `locale` varchar(230) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '0',
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `sort_order` int UNSIGNED NOT NULL DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `locale`, `is_active`, `is_default`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES
(1, '{\"ar\": \"التركية\", \"en\": \"Turkish\", \"tr\": \"Türkçe\"}', 'tr', 1, 1, 0, 1, '2026-02-22 14:01:39', '2026-02-23 03:35:32'),
(2, '{\"ar\": \"الإنجليزية (أمريكا)\", \"en\": \"English (US)\", \"tr\": \"İngilizce (ABD)\"}', 'en', 1, 0, 3, 1, '2026-02-22 14:01:39', '2026-02-23 03:35:32'),
(3, '{\"ar\": \"الإنجليزية (بريطانيا)\", \"en\": \"English (UK)\", \"tr\": \"İngilizce (İngiltere)\", \"en-gb\": \"English (UK)\"}', 'en-gb', 0, 0, 4, 1, '2026-02-22 14:01:39', '2026-02-23 03:35:32'),
(4, '{\"ar\": \"العربية\", \"en\": \"Arabic\", \"tr\": \"Arapça\"}', 'ar', 1, 0, 2, 1, '2026-02-22 14:01:39', '2026-02-23 03:35:32'),
(5, '{\"ar\": \"الألمانية\", \"de\": \"Deutsch\", \"en\": \"German\", \"tr\": \"Almanca\"}', 'de', 1, 0, 1, 1, '2026-02-22 14:01:39', '2026-02-23 03:35:32'),
(6, '{\"ar\": \"الفرنسية\", \"en\": \"French\", \"fr\": \"Français\", \"tr\": \"Fransızca\"}', 'fr', 0, 0, 7, 1, '2026-02-22 14:01:39', '2026-02-23 03:35:32'),
(7, '{\"ar\": \"الإسبانية\", \"en\": \"Spanish\", \"es\": \"Español\", \"tr\": \"İspanyolca\"}', 'es', 0, 0, 5, 1, '2026-02-22 14:01:39', '2026-02-23 03:35:32'),
(8, '{\"ar\": \"الإيطالية\", \"en\": \"Italian\", \"it\": \"Italiano\", \"tr\": \"İtalyanca\"}', 'it', 0, 0, 9, 1, '2026-02-22 14:01:39', '2026-02-23 03:35:32'),
(9, '{\"ar\": \"البرتغالية\", \"en\": \"Portuguese\", \"pt\": \"Português\", \"tr\": \"Portekizce\"}', 'pt', 0, 0, 14, 1, '2026-02-22 14:01:39', '2026-02-23 03:35:32'),
(10, '{\"ar\": \"البرتغالية (البرازيل)\", \"en\": \"Portuguese (Brazil)\", \"tr\": \"Portekizce (Brezilya)\", \"pt-br\": \"Português (Brasil)\"}', 'pt-br', 0, 0, 15, 1, '2026-02-22 14:01:39', '2026-02-23 03:35:32'),
(11, '{\"ar\": \"الروسية\", \"en\": \"Russian\", \"ru\": \"Русский\", \"tr\": \"Rusça\"}', 'ru', 0, 0, 16, 1, '2026-02-22 14:01:39', '2026-02-23 03:35:32'),
(12, '{\"ar\": \"الصينية (المبسطة)\", \"en\": \"Chinese (Simplified)\", \"tr\": \"Çince (Basitleştirilmiş)\", \"zh-cn\": \"中文 (简体)\"}', 'zh-cn', 0, 0, 19, 1, '2026-02-22 14:01:39', '2026-02-23 03:35:32'),
(13, '{\"ar\": \"الصينية (التقليدية)\", \"en\": \"Chinese (Traditional)\", \"tr\": \"Çince (Geleneksel)\", \"zh-tw\": \"中文 (繁體)\"}', 'zh-tw', 0, 0, 20, 1, '2026-02-22 14:01:39', '2026-02-23 03:35:32'),
(14, '{\"ar\": \"اليابانية\", \"en\": \"Japanese\", \"ja\": \"日本語\", \"tr\": \"Japonca\"}', 'ja', 0, 0, 10, 1, '2026-02-22 14:01:39', '2026-02-23 03:35:32'),
(15, '{\"ar\": \"الكورية\", \"en\": \"Korean\", \"ko\": \"한국어\", \"tr\": \"Korece\"}', 'ko', 0, 0, 11, 1, '2026-02-22 14:01:39', '2026-02-23 03:35:32'),
(16, '{\"ar\": \"الهندية\", \"en\": \"Hindi\", \"hi\": \"हिन्दी\", \"tr\": \"Hintçe\"}', 'hi', 0, 0, 8, 1, '2026-02-22 14:01:39', '2026-02-23 03:35:32'),
(17, '{\"ar\": \"الهولندية\", \"en\": \"Dutch\", \"nl\": \"Nederlands\", \"tr\": \"Hollandaca\"}', 'nl', 0, 0, 12, 1, '2026-02-22 14:01:39', '2026-02-23 03:35:32'),
(18, '{\"ar\": \"البولندية\", \"en\": \"Polish\", \"pl\": \"Polski\", \"tr\": \"Lehçe\"}', 'pl', 0, 0, 13, 1, '2026-02-22 14:01:39', '2026-02-23 03:35:32'),
(19, '{\"ar\": \"السويدية\", \"en\": \"Swedish\", \"sv\": \"Svenska\", \"tr\": \"İsveççe\"}', 'sv', 0, 0, 17, 1, '2026-02-22 14:01:39', '2026-02-23 03:35:32'),
(20, '{\"ar\": \"الفارسية\", \"en\": \"Persian\", \"fa\": \"فارسی\", \"tr\": \"Farsça\"}', 'fa', 0, 0, 6, 1, '2026-02-22 14:01:39', '2026-02-23 03:35:32'),
(21, '{\"ar\": \"الأردية\", \"en\": \"Urdu\", \"tr\": \"Urduca\", \"ur\": \"اردو\"}', 'ur', 0, 0, 18, 1, '2026-02-22 14:01:39', '2026-02-23 03:35:32');

-- --------------------------------------------------------

--
-- Table structure for table `lesson_classes`
--

CREATE TABLE `lesson_classes` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `day` varchar(230) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time` time NOT NULL DEFAULT '07:00:00',
  `end_time` time NOT NULL DEFAULT '07:00:00',
  `price` decimal(12,2) NOT NULL,
  `quota` int UNSIGNED NOT NULL,
  `teacher_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `course_time` varchar(230) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lesson_classes`
--

INSERT INTO `lesson_classes` (`id`, `name`, `day`, `time`, `end_time`, `price`, `quota`, `teacher_id`, `start_date`, `end_date`, `course_time`, `created_at`, `updated_at`) VALUES
(2, '12323', '', '00:00:00', '00:00:00', 0.00, 213123, '4', '2025-09-10', '2025-09-25', '123', '2025-09-28 17:34:41', '2025-09-29 13:53:06'),
(3, '123123213', NULL, '00:00:00', '00:00:00', 0.00, 213123, '2', '2025-09-10', '2025-09-25', '123', '2025-09-28 17:35:13', '2025-09-28 17:35:13');

-- --------------------------------------------------------

--
-- Table structure for table `lesson_class_days`
--

CREATE TABLE `lesson_class_days` (
  `id` bigint UNSIGNED NOT NULL,
  `lesson_class_id` bigint UNSIGNED DEFAULT NULL,
  `day` varchar(230) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_time` time NOT NULL DEFAULT '07:00:00',
  `end_time` time NOT NULL DEFAULT '07:00:00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lesson_class_days`
--

INSERT INTO `lesson_class_days` (`id`, `lesson_class_id`, `day`, `start_time`, `end_time`, `created_at`, `updated_at`) VALUES
(1, 3, 'Salı', '07:30:00', '12:30:00', '2025-09-28 17:35:13', '2025-09-28 17:35:13'),
(2, 3, 'Perşembe', '07:30:00', '13:00:00', '2025-09-28 17:35:13', '2025-09-28 17:35:13'),
(3, 3, 'Cumartesi', '07:30:00', '11:30:00', '2025-09-28 17:35:13', '2025-09-28 17:35:13'),
(13, 2, 'Pazartesi', '08:00:00', '08:30:00', '2025-09-29 13:53:06', '2025-09-29 13:53:06');

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `id` bigint UNSIGNED NOT NULL,
  `parent_id` bigint UNSIGNED DEFAULT NULL,
  `label` json DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#',
  `target` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '_self',
  `sort_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `parent_id`, `label`, `url`, `target`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, NULL, '{\"tr\": \"Ana Sayfa\"}', '/', '_self', 0, 1, '2026-03-04 08:15:16', '2026-03-04 09:29:33'),
(2, NULL, '{\"tr\": \"Kurslar\"}', '#', '_self', 1, 1, '2026-03-04 08:15:16', '2026-03-04 09:29:33'),
(3, 2, '{\"tr\": \"Kurslarımız\"}', '/kurslar', '_self', 1, 1, '2026-03-04 08:15:16', '2026-03-04 09:15:07'),
(4, NULL, '{\"tr\": \"Sayfalar\"}', '#', '_self', 2, 1, '2026-03-04 08:15:16', '2026-03-04 09:29:33'),
(5, 4, '{\"tr\": \"Ürünler\"}', '#', '_self', 0, 1, '2026-03-04 08:15:16', '2026-03-04 09:29:00'),
(6, 5, '{\"tr\": \"Ürünler\"}', '/urunler', '_self', 0, 1, '2026-03-04 08:15:16', '2026-03-04 09:28:56'),
(7, 5, '{\"tr\": \"Ürün Detayı\"}', '/urun-detay', '_self', 1, 1, '2026-03-04 08:15:16', '2026-03-04 09:28:56'),
(8, 5, '{\"tr\": \"Sepet\"}', '/sepet', '_self', 2, 1, '2026-03-04 08:15:16', '2026-03-04 09:29:23'),
(9, 5, '{\"tr\": \"Ödeme\"}', '/odeme', '_self', 3, 1, '2026-03-04 08:15:16', '2026-03-04 09:29:25'),
(10, 4, '{\"tr\": \"Eğitmenler\"}', '#', '_self', 4, 1, '2026-03-04 08:15:16', '2026-03-04 09:29:17'),
(11, 10, '{\"tr\": \"Eğitmenler\"}', '/egitmenler', '_self', 0, 1, '2026-03-04 08:15:16', '2026-03-04 08:15:16'),
(12, 4, '{\"tr\": \"SSS\"}', '/sss', '_self', 3, 1, '2026-03-04 08:15:16', '2026-03-04 09:29:17'),
(13, NULL, '{\"tr\": \"Haberler\"}', '#', '_self', 5, 1, '2026-03-04 08:15:16', '2026-03-04 09:29:33'),
(14, 13, '{\"tr\": \"Blog\"}', '/blog', '_self', 0, 1, '2026-03-04 08:15:16', '2026-03-04 09:29:35'),
(15, NULL, '{\"tr\": \"Hakkımızda\"}', '/hakkimizda', '_self', 3, 1, '2026-03-04 08:15:16', '2026-03-04 09:29:33'),
(16, NULL, '{\"tr\": \"İletişim\"}', '/iletisim', '_self', 4, 1, '2026-03-04 08:15:16', '2026-03-04 09:29:33');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_08_24_103129_create_languages_table', 1),
(5, '2025_08_26_132838_add_few_column_to_users_table', 1),
(6, '2025_08_26_134024_create_permission_tables', 1),
(7, '2025_09_08_130001_create_lesson_classes_table', 1),
(8, '2025_09_08_140055_create_students_table', 1),
(9, '2025_09_08_140105_create_student_guardians_table', 1),
(10, '2025_09_08_140128_create_emergency_contacts_table', 1),
(11, '2025_09_09_094201_create_student_payments_table', 1),
(12, '2025_09_09_094223_create_student_payments_installments_table', 1),
(13, '2025_09_14_170444_add_few_column_to_student_payments_installments_table', 1),
(14, '2025_09_22_093713_add_few_column_to_students_table', 2),
(15, '2025_09_22_112315_add_few_column_to_student_payments_table', 3),
(16, '2025_09_22_124922_alter_class_id_nullable_on_students_table', 4),
(17, '2025_09_22_130851_add_few_column_to_students_table', 5),
(18, '2025_09_28_173024_create_lesson_class_days_table', 6),
(19, '2025_09_29_091608_add_few_column_to_student_payments_installments_table', 7),
(20, '2026_02_22_140832_add_is_default_to_languages_table', 8),
(21, '2026_02_22_151742_standardize_language_locale_codes', 9),
(22, '2026_02_22_221747_create_contact_page_infos_table', 10),
(23, '2026_02_23_032540_add_sort_order_to_languages_table', 11),
(24, '2026_02_23_033635_add_cta_fields_to_contact_page_infos_table', 12),
(25, '2026_02_23_035730_add_form_dynamic_fields_to_contact_page_infos_table', 13),
(26, '2026_02_23_042610_add_breadcrumb_fields_to_contact_page_infos_table', 14),
(27, '2026_02_23_050000_add_dynamic_contact_fields_to_contact_page_infos_table', 15),
(28, '2026_02_23_060000_create_faqs_table', 16),
(29, '2026_02_23_060001_create_faq_page_infos_table', 16),
(30, '2026_02_23_070000_create_teachers_table', 17),
(31, '2026_02_23_070001_create_teacher_page_infos_table', 17),
(32, '2026_02_23_080000_create_blogs_table', 18),
(33, '2026_02_23_080001_create_blog_page_infos_table', 18),
(34, '2026_02_24_010000_create_blog_categories_table', 19),
(35, '2026_02_24_010001_create_blog_tags_table', 19),
(36, '2026_02_24_010002_create_blog_category_pivot_table', 19),
(37, '2026_02_24_010003_create_blog_tag_pivot_table', 19),
(38, '2026_02_24_010004_remove_category_tags_from_blogs_table', 19),
(39, '2026_02_24_010000_add_sidebar_search_placeholder_to_blog_page_infos_table', 20),
(40, '2026_02_24_020000_create_courses_table', 21),
(41, '2026_02_24_020001_create_course_categories_table', 21),
(42, '2026_02_24_020002_create_course_course_category_table', 21),
(43, '2026_02_24_020003_create_course_page_infos_table', 21),
(44, '2026_02_24_152340_add_result_text_to_course_page_infos_table', 22),
(45, '2026_02_24_080000_create_client_logos_table', 23),
(46, '2026_02_24_090000_create_testimonials_table', 24),
(47, '2026_02_24_100000_add_icon_and_color_to_course_categories_table', 25),
(48, '2026_02_24_110000_create_about_us_page_infos_table', 26),
(49, '2026_02_24_120000_add_section1_features_to_about_us_page_infos_table', 27),
(50, '2026_02_25_010000_add_faq_images_to_about_us_page_infos_table', 28),
(51, '2026_02_25_020000_create_sliders_table', 29),
(52, '2026_02_25_020001_create_slider_items_table', 29),
(53, '2026_02_26_010000_create_home_page_infos_table', 30),
(54, '2026_02_26_020000_add_categories_button_url_to_home_page_infos_table', 31),
(55, '2026_02_26_030000_add_features_and_why_to_home_page_infos_table', 32),
(56, '2026_02_26_163930_add_client_logo_text_to_home_page_infos_table', 33),
(57, '2026_02_26_164741_add_funfact_fields_to_home_page_infos_table', 34),
(59, '2026_02_27_010000_add_testimonial_fields_to_home_page_infos_table', 35),
(60, '2026_02_28_010000_add_title_style_to_course_page_infos_table', 36),
(61, '2026_02_28_020000_add_field_styles_to_course_page_infos_table', 37),
(62, '2026_02_28_030000_add_field_styles_to_blog_page_infos_table', 38),
(63, '2026_02_28_040000_add_field_styles_to_teacher_page_infos_table', 39),
(64, '2026_02_28_050000_add_field_styles_to_faq_page_infos_table', 40),
(65, '2026_02_28_060000_add_field_styles_to_contact_page_infos_table', 41),
(66, '2026_02_28_070000_add_field_styles_to_about_us_page_infos_table', 42),
(67, '2026_02_28_080000_add_field_styles_to_home_page_infos_table', 43),
(68, '2026_03_01_010000_add_default_styles_to_home_page_infos_table', 44),
(69, '2026_03_01_020000_add_default_styles_to_about_us_page_infos_table', 45),
(70, '2026_03_01_020001_add_default_styles_to_contact_page_infos_table', 45),
(71, '2026_03_01_020002_add_default_styles_to_faq_page_infos_table', 46),
(72, '2026_03_01_020003_add_default_styles_to_teacher_page_infos_table', 46),
(73, '2026_03_01_020004_add_default_styles_to_blog_page_infos_table', 47),
(74, '2026_03_01_020005_add_default_styles_to_course_page_infos_table', 47),
(75, '2026_03_04_010000_create_footer_page_infos_table', 48),
(76, '2026_03_04_020000_convert_social_urls_to_social_links_json', 49),
(77, '2026_03_04_030000_create_navbar_page_infos_table', 50),
(78, '2026_03_04_040000_create_menu_items_table', 51),
(79, '2026_03_04_100450_add_visibility_toggles_to_navbar_page_infos', 52),
(80, '2026_03_05_010000_create_product_categories_table', 53),
(81, '2026_03_05_020000_create_products_table', 53),
(82, '2026_03_05_030000_create_product_product_category_table', 53),
(83, '2026_03_05_040000_create_product_attributes_table', 53),
(84, '2026_03_05_050000_create_product_attribute_values_table', 53),
(85, '2026_03_05_060000_create_product_variants_table', 53),
(86, '2026_03_05_070000_create_product_variant_attribute_value_table', 54),
(87, '2026_03_05_080000_create_product_images_table', 54),
(88, '2026_03_05_090000_create_orders_table', 54),
(89, '2026_03_05_100000_create_order_items_table', 54),
(90, '2026_03_05_025000_add_features_to_products_table', 55),
(91, '2026_03_05_110000_create_coupons_table', 56),
(92, '2026_03_05_120000_add_coupon_fields_to_orders_table', 56),
(93, '2026_03_05_200000_create_shop_page_infos_table', 57),
(94, '2026_03_05_070824_add_style_columns_to_shop_page_infos_table', 58),
(95, '2026_03_05_101027_add_checkout_form_labels_to_shop_page_infos_table', 59),
(96, '2026_03_05_101908_add_checkout_placeholders_to_shop_page_infos_table', 60),
(97, '2026_03_05_210000_create_settings_table', 61),
(98, '2026_03_05_220000_create_sitemap_entries_table', 62);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User\\User', 1),
(4, 'App\\Models\\User\\User', 4),
(5, 'App\\Models\\User\\User', 5),
(2, 'App\\Models\\User\\User', 6),
(3, 'App\\Models\\User\\User', 6),
(4, 'App\\Models\\User\\User', 6),
(5, 'App\\Models\\User\\User', 6);

-- --------------------------------------------------------

--
-- Table structure for table `navbar_page_infos`
--

CREATE TABLE `navbar_page_infos` (
  `id` bigint UNSIGNED NOT NULL,
  `nav_items` json DEFAULT NULL,
  `search_placeholder` json DEFAULT NULL,
  `search_button_text` json DEFAULT NULL,
  `register_button_text` json DEFAULT NULL,
  `login_button_text` json DEFAULT NULL,
  `show_search` tinyint(1) NOT NULL DEFAULT '1',
  `show_register_button` tinyint(1) NOT NULL DEFAULT '1',
  `show_login_button` tinyint(1) NOT NULL DEFAULT '1',
  `show_social_links` tinyint(1) NOT NULL DEFAULT '1',
  `show_cart_button` tinyint(1) NOT NULL DEFAULT '1',
  `show_side_info_button` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `navbar_page_infos`
--

INSERT INTO `navbar_page_infos` (`id`, `nav_items`, `search_placeholder`, `search_button_text`, `register_button_text`, `login_button_text`, `show_search`, `show_register_button`, `show_login_button`, `show_social_links`, `show_cart_button`, `show_side_info_button`, `created_at`, `updated_at`) VALUES
(1, '[{\"url\": \"/\", \"label\": {\"tr\": \"Ana Sayfa\"}}, {\"url\": \"#\", \"label\": {\"tr\": \"Kurslar\"}, \"children\": [{\"url\": \"/kurslar\", \"label\": {\"tr\": \"Kurslarımız\"}}]}, {\"url\": \"#\", \"label\": {\"tr\": \"Sayfalar\"}, \"children\": [{\"url\": \"#\", \"label\": {\"tr\": \"Ürünler\"}, \"children\": [{\"url\": \"/urunler\", \"label\": {\"tr\": \"Ürünler\"}}, {\"url\": \"/urun-detay\", \"label\": {\"tr\": \"Ürün Detayı\"}}, {\"url\": \"/sepet\", \"label\": {\"tr\": \"Sepet\"}}, {\"url\": \"/odeme\", \"label\": {\"tr\": \"Ödeme\"}}]}, {\"url\": \"#\", \"label\": {\"tr\": \"Eğitmenler\"}, \"children\": [{\"url\": \"/egitmenler\", \"label\": {\"tr\": \"Eğitmenler\"}}]}, {\"url\": \"/sss\", \"label\": {\"tr\": \"SSS\"}}]}, {\"url\": \"#\", \"label\": {\"tr\": \"Haberler\"}, \"children\": [{\"url\": \"/blog\", \"label\": {\"tr\": \"Blog\"}}]}, {\"url\": \"/hakkimizda\", \"label\": {\"tr\": \"Hakkımızda\"}}, {\"url\": \"/iletisim\", \"label\": {\"tr\": \"İletişim\"}}]', '{\"tr\": \"Kursunuzu arayın\"}', '{\"tr\": \"Ara\"}', '{\"tr\": \"Kayıt Ol\"}', '{\"tr\": \"Giriş Yap\"}', 1, 1, 1, 1, 1, 0, '2026-03-04 03:42:40', '2026-03-04 10:46:35');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `order_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','processing','shipped','delivered','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_district` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_zip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Türkiye',
  `subtotal` decimal(10,2) NOT NULL DEFAULT '0.00',
  `shipping_cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `coupon_id` bigint UNSIGNED DEFAULT NULL,
  `coupon_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `customer_note` text COLLATE utf8mb4_unicode_ci,
  `admin_note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_number`, `status`, `customer_name`, `customer_email`, `customer_phone`, `shipping_address`, `shipping_city`, `shipping_district`, `shipping_zip`, `shipping_country`, `subtotal`, `shipping_cost`, `total`, `coupon_id`, `coupon_code`, `discount_amount`, `customer_note`, `admin_note`, `created_at`, `updated_at`) VALUES
(1, 'ORD-20260301-0001', 'delivered', 'Ahmet Yılmaz', 'ahmet@example.com', '0532 111 22 33', 'Atatürk Cad. No:45/3', 'İstanbul', 'Kadıköy', NULL, 'Türkiye', 209.80, 0.00, 209.80, NULL, NULL, 0.00, 'Lütfen zile basın.', NULL, '2026-03-04 15:22:15', '2026-03-04 15:22:15'),
(2, 'ORD-20260302-0001', 'pending', 'Elif Demir', 'elif.demir@example.com', '0544 222 33 44', 'Cumhuriyet Mah. 3. Sok. No:12', 'Ankara', 'Çankaya', NULL, 'Türkiye', 399.80, 0.00, 399.80, NULL, NULL, 0.00, NULL, NULL, '2026-03-04 15:22:15', '2026-03-04 15:22:15'),
(3, 'ORD-20260303-0001', 'processing', 'Mehmet Kaya', 'mehmet.kaya@example.com', '0555 333 44 55', 'Zübeyde Hanım Cad. No:78/A', 'İzmir', 'Bornova', NULL, 'Türkiye', 569.70, 0.00, 569.70, NULL, NULL, 0.00, 'Hediye paketi yapılabilir mi?', NULL, '2026-03-04 15:22:15', '2026-03-04 15:22:15'),
(4, 'ORD-20260303-0002', 'shipped', 'Zeynep Arslan', 'zeynep@example.com', '0533 444 55 66', 'Bağdat Cad. No:120', 'İstanbul', 'Maltepe', NULL, 'Türkiye', 489.80, 0.00, 489.80, NULL, NULL, 0.00, NULL, 'Aras Kargo - 123456789', '2026-03-04 15:22:15', '2026-03-04 15:22:15'),
(5, 'ORD-20260304-0001', 'cancelled', 'Can Öztürk', 'can.ozturk@example.com', '0542 555 66 77', 'Atatürk Blv. No:55', 'Bursa', 'Nilüfer', NULL, 'Türkiye', 59.90, 0.00, 59.90, NULL, NULL, 0.00, NULL, 'Müşteri iptal talep etti.', '2026-03-04 15:22:15', '2026-03-04 15:22:15'),
(6, 'ORD-20260304-0006', 'pending', 'jj j kmj', 'chnomr2@gmail.com', NULL, 'gbhnujm', 'Dilovasi', 'Dilovasi', NULL, 'Türkiye', 1648.90, 0.00, 1648.90, NULL, NULL, 0.00, NULL, NULL, '2026-03-04 19:08:02', '2026-03-04 19:08:02'),
(7, 'ORD-20260305-0001', 'pending', 'Cihan Omur', 'chnomr2@gmail.com', '11231231', '123213213213', 'Dilovasi', 'Dilovasi', NULL, 'Türkiye', 269.70, 0.00, 242.73, 1, 'HOSGELDIN10', 26.97, 'zile basma', NULL, '2026-03-05 03:32:15', '2026-03-05 03:32:15');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED DEFAULT NULL,
  `product_variant_id` bigint UNSIGNED DEFAULT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `variant_info` json DEFAULT NULL,
  `product_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `unit_price` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_variant_id`, `product_name`, `variant_info`, `product_image`, `quantity`, `unit_price`, `total_price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, 'Akademi Defter Seti (3\'lü)', NULL, NULL, 1, 119.90, 119.90, '2026-03-04 15:22:15', '2026-03-04 15:22:15'),
(2, 1, 2, NULL, 'Matematik Problemleri Kitabı', NULL, NULL, 1, 89.90, 89.90, '2026-03-04 15:22:15', '2026-03-04 15:22:15'),
(3, 2, 4, NULL, 'Akademi Logolu Tişört', '{\"Renk\": \"Mavi\", \"Beden\": \"M\"}', NULL, 2, 199.90, 399.80, '2026-03-04 15:22:15', '2026-03-04 15:22:15'),
(4, 3, 7, NULL, 'Bilim ve Teknoloji Ansiklopedisi', NULL, NULL, 1, 249.90, 249.90, '2026-03-04 15:22:15', '2026-03-04 15:22:15'),
(5, 3, 6, NULL, 'Akademi Sweatshirt', '{\"Beden\": \"L\"}', NULL, 1, 299.90, 299.90, '2026-03-04 15:22:15', '2026-03-04 15:22:15'),
(6, 4, 8, NULL, 'Grafik Tablet (Başlangıç)', NULL, NULL, 1, 449.90, 449.90, '2026-03-04 15:22:15', '2026-03-04 15:22:15'),
(7, 4, 9, NULL, 'Renkli Yapışkan Not Seti', NULL, NULL, 1, 39.90, 39.90, '2026-03-04 15:22:15', '2026-03-04 15:22:15'),
(8, 5, 5, NULL, 'Premium Kalem Seti', '{\"Renk\": \"Siyah\"}', NULL, 1, 59.90, 59.90, '2026-03-04 15:22:15', '2026-03-04 15:22:15'),
(9, 6, 1, 45, 'Akademi Defter Seti (3\'lü)', '{\"Renk\": \"Kırmızı\", \"Beden\": \"S\"}', 'uploads/products/1772638693_download.png', 8, 149.90, 1199.20, '2026-03-04 19:08:02', '2026-03-04 19:08:02'),
(10, 6, 2, NULL, 'Matematik Problemleri Kitabı', NULL, NULL, 1, 89.90, 89.90, '2026-03-04 19:08:02', '2026-03-04 19:08:02'),
(11, 6, 5, NULL, 'Premium Kalem Seti', NULL, NULL, 1, 59.90, 59.90, '2026-03-04 19:08:02', '2026-03-04 19:08:02'),
(12, 6, 6, NULL, 'Akademi Sweatshirt', NULL, NULL, 1, 299.90, 299.90, '2026-03-04 19:08:02', '2026-03-04 19:08:02'),
(13, 7, 2, NULL, 'Matematik Problemleri Kitabı', NULL, NULL, 3, 89.90, 269.70, '2026-03-05 03:32:15', '2026-03-05 03:32:15');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'accounting', 'web', '2025-10-01 17:40:47', '2025-10-01 17:40:47'),
(2, 'accounting_edit', 'web', '2025-10-01 17:42:34', '2025-10-01 17:42:34'),
(3, 'students_edit', 'web', '2025-10-01 17:42:34', '2025-10-01 17:42:34'),
(4, 'delete', 'web', '2025-10-01 17:42:35', '2025-10-01 17:42:35'),
(5, 'delete_user', 'web', '2025-10-01 17:48:02', '2025-10-01 17:48:02'),
(6, 'student', 'web', '2025-10-04 11:13:39', '2025-10-04 11:13:39'),
(7, 'class_delete', 'web', '2025-10-04 11:13:39', '2025-10-04 11:13:39'),
(8, 'user_delete', 'web', '2025-10-04 11:13:39', '2025-10-04 11:13:39'),
(9, 'class', 'web', '2025-10-04 11:13:39', '2025-10-04 11:13:39'),
(10, 'student_delete', 'web', '2025-10-04 11:13:39', '2025-10-04 11:13:39'),
(11, 'user', 'web', '2025-10-04 11:13:39', '2025-10-04 11:13:39'),
(12, 'content', 'web', '2026-03-06 03:31:17', '2026-03-06 03:31:17'),
(13, 'content_delete', 'web', '2026-03-06 03:31:17', '2026-03-06 03:31:17'),
(14, 'shop', 'web', '2026-03-06 03:31:17', '2026-03-06 03:31:17'),
(15, 'shop_delete', 'web', '2026-03-06 03:31:17', '2026-03-06 03:31:17'),
(16, 'page', 'web', '2026-03-06 03:31:17', '2026-03-06 03:31:17'),
(17, 'menu', 'web', '2026-03-06 03:31:17', '2026-03-06 03:31:17'),
(18, 'language', 'web', '2026-03-06 03:31:17', '2026-03-06 03:31:17'),
(19, 'settings', 'web', '2026-03-06 03:31:17', '2026-03-06 03:31:17'),
(21, 'developer', 'web', '2026-03-06 06:37:55', '2026-03-06 06:37:55');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `name` json DEFAULT NULL,
  `short_description` json DEFAULT NULL,
  `description` json DEFAULT NULL,
  `features` json DEFAULT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `sale_price` decimal(10,2) DEFAULT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `manage_stock` tinyint(1) NOT NULL DEFAULT '1',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `short_description`, `description`, `features`, `sku`, `image`, `price`, `sale_price`, `stock`, `manage_stock`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, '{\"en\": \"Academy Notebook Set (3-pack)\", \"tr\": \"Akademi Defter Seti (3\'lü)\"}', '{\"en\": \"Includes lined, grid and plain notebooks.\", \"tr\": \"Çizgili, kareli ve düz defter içerir.\"}', '{\"en\": \"Custom designed 3-pack notebook set with Parosis Academy logo. A4 size, 100 sheets. Durable spiral binding.\", \"tr\": \"Parosis Akademi logolu özel tasarım 3\'lü defter seti. A4 boyutunda, 100 yaprak. Dayanıklı spiralli cilt.\"}', '{\"tr\": \"[{\\\"key\\\":\\\"Malzeme\\\",\\\"value\\\":\\\"Ka\\\\u011f\\\\u0131t, karton kapak\\\"},{\\\"key\\\":\\\"Boyut\\\",\\\"value\\\":\\\"A5 (14.8 x 21 cm)\\\"},{\\\"key\\\":\\\"Sayfa Say\\\\u0131s\\\\u0131\\\",\\\"value\\\":\\\"120 sayfa\\\"},{\\\"key\\\":\\\"A\\\\u011f\\\\u0131rl\\\\u0131k\\\",\\\"value\\\":\\\"450 gr\\\"}]\"}', 'DEFTER-SET-3', 'uploads/products/1772638693_download.png', 149.90, 119.90, 50, 1, 1, 1, '2026-03-04 14:56:48', '2026-03-04 16:51:31'),
(2, '{\"en\": \"Mathematics Problems Book\", \"tr\": \"Matematik Problemleri Kitabı\"}', '{\"en\": \"Advanced math problems and solutions.\", \"tr\": \"İleri düzey matematik problemleri ve çözümleri.\"}', '{\"en\": \"Comprehensive mathematics book with 500+ problems. Ideal for university entrance exam preparation. Detailed solutions section included.\", \"tr\": \"Matematik Problemleri Kitabı, lise ve üniversite sınavlarına hazırlanan öğrenciler için kapsamlı bir kaynak niteliğindedir. 1500\'den fazla çözümlü ve çözümsüz problem içeren bu kitap, temel cebir konularından ileri analiz problemlerine kadar geniş bir yelpazede alıştırmalar sunar. Her bölüm, konu anlatımı, örnek çözümler ve zorluk seviyesine göre sıralanmış problemlerden oluşmaktadır.\"}', '{\"tr\": \"[{\\\"key\\\":\\\"Yazar\\\",\\\"value\\\":\\\"Prof. Dr. Ahmet Y\\\\u0131lmaz\\\"},{\\\"key\\\":\\\"Sayfa Say\\\\u0131s\\\\u0131\\\",\\\"value\\\":\\\"320 sayfa\\\"},{\\\"key\\\":\\\"Bask\\\\u0131\\\",\\\"value\\\":\\\"3. Bask\\\\u0131, 2025\\\"},{\\\"key\\\":\\\"Boyut\\\",\\\"value\\\":\\\"16 x 24 cm\\\"},{\\\"key\\\":\\\"Konu\\\",\\\"value\\\":\\\"Cebir, Geometri, Analiz\\\"},{\\\"key\\\":\\\"Seviye\\\",\\\"value\\\":\\\"Lise ve \\\\u00dcniversite Haz\\\\u0131rl\\\\u0131k\\\"}]\"}', 'KITAP-MAT-001', NULL, 89.90, NULL, 120, 1, 1, 2, '2026-03-04 14:56:48', '2026-03-04 16:53:54'),
(3, '{\"en\": \"Turkish Grammar Guide\", \"tr\": \"Türkçe Dilbilgisi Rehberi\"}', '{\"en\": \"Comprehensive Turkish grammar resource.\", \"tr\": \"Kapsamlı Türkçe dilbilgisi kaynağı.\"}', '{\"en\": \"Turkish grammar rules from A to Z. Practice exercises and exam questions for reinforcement.\", \"tr\": \"Türkçe Dilbilgisi Rehberi, Türk dilinin temel kurallarını anlaşılır bir dille aktaran kapsamlı bir kaynak kitaptır. Ses bilgisi, biçim bilgisi, söz dizimi ve anlam bilgisi konularını detaylı örneklerle ele alır. Her bölümde test soruları ve konu tekrar bölümleri yer almaktadır.\"}', '{\"tr\": \"[{\\\"key\\\":\\\"Yazar\\\",\\\"value\\\":\\\"Do\\\\u00e7. Dr. Elif Kaya\\\"},{\\\"key\\\":\\\"Sayfa Say\\\\u0131s\\\\u0131\\\",\\\"value\\\":\\\"280 sayfa\\\"},{\\\"key\\\":\\\"Bask\\\\u0131\\\",\\\"value\\\":\\\"1. Bask\\\\u0131, 2026\\\"},{\\\"key\\\":\\\"Boyut\\\",\\\"value\\\":\\\"14 x 21 cm\\\"},{\\\"key\\\":\\\"Konu\\\",\\\"value\\\":\\\"T\\\\u00fcrk\\\\u00e7e Dilbilgisi, Yaz\\\\u0131m Kurallar\\\\u0131\\\"},{\\\"key\\\":\\\"Kapsam\\\",\\\"value\\\":\\\"TYT, AYT ve KPSS uyumlu\\\"}]\"}', 'KITAP-TR-001', NULL, 69.90, NULL, 80, 1, 1, 3, '2026-03-04 14:56:48', '2026-03-04 16:53:54'),
(4, '{\"en\": \"Academy Logo T-Shirt\", \"tr\": \"Akademi Logolu Tişört\"}', '{\"en\": \"100% cotton, comfortable fit.\", \"tr\": \"%100 pamuk, rahat kesim.\"}', '{\"en\": \"Custom designed t-shirt with Parosis Academy logo. 100% organic cotton, 180 gsm fabric. Crew neck, comfortable fit.\", \"tr\": \"Parosis Akademi logolu premium tişört, %100 organik pamuktan üretilmiştir. Rahat kesimi ve nefes alan kumaşı ile günlük kullanıma idealdir. Akademi logomuz DTF dijital baskı tekniği ile uygulanmış olup yıkama sonrası solmaz ve çatlamaz.\"}', '{\"tr\": \"[{\\\"key\\\":\\\"Malzeme\\\",\\\"value\\\":\\\"%100 Organik Pamuk\\\"},{\\\"key\\\":\\\"A\\\\u011f\\\\u0131rl\\\\u0131k\\\",\\\"value\\\":\\\"180 gr\\\\/m\\\\u00b2\\\"},{\\\"key\\\":\\\"Beden\\\",\\\"value\\\":\\\"XS, S, M, L, XL, XXL\\\"},{\\\"key\\\":\\\"Renk\\\",\\\"value\\\":\\\"Siyah, Beyaz, Lacivert\\\"},{\\\"key\\\":\\\"Y\\\\u0131kama\\\",\\\"value\\\":\\\"30\\\\u00b0C makine y\\\\u0131kama\\\"},{\\\"key\\\":\\\"Bask\\\\u0131\\\",\\\"value\\\":\\\"DTF dijital bask\\\\u0131, solmaz\\\"}]\"}', 'TISORT-AKD', NULL, 199.90, NULL, 0, 0, 1, 4, '2026-03-04 14:56:48', '2026-03-04 16:53:54'),
(5, '{\"en\": \"Premium Pen Set\", \"tr\": \"Premium Kalem Seti\"}', '{\"en\": \"5 different thickness fineliner pen set.\", \"tr\": \"5 farklı kalınlıkta fineliner kalem seti.\"}', '{\"en\": \"Professional quality fineliner pen set. 5 different tips from 0.1mm to 0.8mm. Ideal for note-taking, drawing and writing.\", \"tr\": \"Premium Kalem Seti, öğrenciler ve profesyoneller için tasarlanmış yüksek kaliteli yazı ve çizim gereçlerinden oluşur. Sedir ağacından üretilen gövdesi ergonomik tutuş sağlar, grafit uçları pürüzsüz yazı deneyimi sunar. Şık metal kutusu ile hediye olarak da idealdir.\"}', '{\"tr\": \"[{\\\"key\\\":\\\"\\\\u0130\\\\u00e7erik\\\",\\\"value\\\":\\\"12 adet HB kalem, 4 renkli kalem, 2 silgi\\\"},{\\\"key\\\":\\\"Malzeme\\\",\\\"value\\\":\\\"Sedir a\\\\u011fac\\\\u0131 g\\\\u00f6vde, grafit u\\\\u00e7\\\"},{\\\"key\\\":\\\"U\\\\u00e7 Kal\\\\u0131nl\\\\u0131\\\\u011f\\\\u0131\\\",\\\"value\\\":\\\"0.5mm - 2mm aras\\\\u0131\\\"},{\\\"key\\\":\\\"Kutu\\\",\\\"value\\\":\\\"Metal teneke kutu\\\"},{\\\"key\\\":\\\"Men\\\\u015fei\\\",\\\"value\\\":\\\"T\\\\u00fcrkiye\\\"}]\"}', 'KALEM-PRM', NULL, 59.90, NULL, 0, 0, 1, 5, '2026-03-04 14:56:48', '2026-03-04 16:53:54'),
(6, '{\"en\": \"Academy Sweatshirt\", \"tr\": \"Akademi Sweatshirt\"}', '{\"en\": \"Warm and stylish design.\", \"tr\": \"Sıcak tutan, şık tasarım.\"}', '{\"en\": \"Ideal Parosis Academy sweatshirt for winter months. Inner fleece fabric. Kangaroo pocket, hooded.\", \"tr\": \"Akademi Sweatshirt, soğuk günlerde sıcak tutarken şık görünmenizi sağlar. Pamuk-polyester karışımlı kumaşı dayanıklı ve rahat bir kullanım sunar. İç yüzeyindeki yumuşak tüylü astar ekstra konfor sağlar. Kanguru cebi ve ayarlanabilir kapüşonu ile günlük kullanım için idealdir.\"}', '{\"tr\": \"[{\\\"key\\\":\\\"Malzeme\\\",\\\"value\\\":\\\"%80 Pamuk, %20 Polyester\\\"},{\\\"key\\\":\\\"A\\\\u011f\\\\u0131rl\\\\u0131k\\\",\\\"value\\\":\\\"320 gr\\\\/m\\\\u00b2\\\"},{\\\"key\\\":\\\"Beden\\\",\\\"value\\\":\\\"S, M, L, XL, XXL\\\"},{\\\"key\\\":\\\"\\\\u0130\\\\u00e7 Y\\\\u00fczey\\\",\\\"value\\\":\\\"Yumu\\\\u015fak t\\\\u00fcyl\\\\u00fc astar\\\"},{\\\"key\\\":\\\"Kap\\\\u00fc\\\\u015fon\\\",\\\"value\\\":\\\"Ayarlanabilir ba\\\\u011fc\\\\u0131kl\\\\u0131\\\"},{\\\"key\\\":\\\"Cep\\\",\\\"value\\\":\\\"Kanguru cep\\\"},{\\\"key\\\":\\\"Y\\\\u0131kama\\\",\\\"value\\\":\\\"30\\\\u00b0C hassas y\\\\u0131kama\\\"}]\"}', 'SWEAT-AKD', NULL, 349.90, 299.90, 0, 0, 1, 6, '2026-03-04 14:56:48', '2026-03-04 16:53:54'),
(7, '{\"en\": \"Science & Technology Encyclopedia\", \"tr\": \"Bilim ve Teknoloji Ansiklopedisi\"}', '{\"en\": \"Comprehensive visual encyclopedia.\", \"tr\": \"Görsel destekli kapsamlı ansiklopedi.\"}', '{\"en\": \"1000-page visual science and technology encyclopedia. Designed for students aged 8-16.\", \"tr\": \"Bilim ve Teknoloji Ansiklopedisi, genç meraklı zihinler için hazırlanmış kapsamlı bir başvuru kaynağıdır. Fizikten biyolojiye, kimyadan uzay bilimlerine kadar geniş bir yelpazede bilimsel konuları anlaşılır bir dille ve zengin görseller eşliğinde sunar. Her bölümde interaktif QR kodları ile videolu ek içeriklere erişim sağlanır.\"}', '{\"tr\": \"[{\\\"key\\\":\\\"Yazar\\\",\\\"value\\\":\\\"Parosis Akademi Yay\\\\u0131nlar\\\\u0131\\\"},{\\\"key\\\":\\\"Sayfa Say\\\\u0131s\\\\u0131\\\",\\\"value\\\":\\\"640 sayfa\\\"},{\\\"key\\\":\\\"Bask\\\\u0131\\\",\\\"value\\\":\\\"Renkli, ku\\\\u015fe ka\\\\u011f\\\\u0131t\\\"},{\\\"key\\\":\\\"Cilt\\\",\\\"value\\\":\\\"Sert kapak, iplik diki\\\\u015fli\\\"},{\\\"key\\\":\\\"Boyut\\\",\\\"value\\\":\\\"21 x 29.7 cm (A4)\\\"},{\\\"key\\\":\\\"Konu\\\",\\\"value\\\":\\\"Fizik, Kimya, Biyoloji, Teknoloji\\\"},{\\\"key\\\":\\\"Hedef Kitle\\\",\\\"value\\\":\\\"Ortaokul ve lise \\\\u00f6\\\\u011frencileri\\\"}]\"}', 'KITAP-ANS-001', NULL, 249.90, NULL, 35, 1, 1, 7, '2026-03-04 14:56:48', '2026-03-04 16:53:54'),
(8, '{\"en\": \"Graphics Tablet (Starter)\", \"tr\": \"Grafik Tablet (Başlangıç)\"}', '{\"en\": \"Entry-level tablet for digital drawing.\", \"tr\": \"Dijital çizim için giriş seviyesi tablet.\"}', '{\"en\": \"Starter level graphics tablet. 6x4 inch work area, 8192 pressure sensitivity. USB connected, Windows/Mac compatible.\", \"tr\": \"Başlangıç seviyesi grafik tablet, dijital sanat ve tasarım dünyasına adım atmak isteyenler için ideal bir üründür. 8192 seviye basınç hassasiyeti ile kağıt üzerinde çizim yapar gibi doğal bir deneyim sunar. USB-C ve Bluetooth bağlantısı ile tüm cihazlarınızla uyumlu çalışır.\"}', '{\"tr\": \"[{\\\"key\\\":\\\"\\\\u00c7al\\\\u0131\\\\u015fma Alan\\\\u0131\\\",\\\"value\\\":\\\"10 x 6 in\\\\u00e7 (254 x 152 mm)\\\"},{\\\"key\\\":\\\"Bas\\\\u0131n\\\\u00e7 Hassasiyeti\\\",\\\"value\\\":\\\"8192 seviye\\\"},{\\\"key\\\":\\\"\\\\u00c7\\\\u00f6z\\\\u00fcn\\\\u00fcrl\\\\u00fck\\\",\\\"value\\\":\\\"5080 LPI\\\"},{\\\"key\\\":\\\"Ba\\\\u011flant\\\\u0131\\\",\\\"value\\\":\\\"USB-C, Bluetooth 5.0\\\"},{\\\"key\\\":\\\"Uyumluluk\\\",\\\"value\\\":\\\"Windows, macOS, Android, Linux\\\"},{\\\"key\\\":\\\"Pil \\\\u00d6mr\\\\u00fc\\\",\\\"value\\\":\\\"10 saat (kablosuz kullan\\\\u0131m)\\\"},{\\\"key\\\":\\\"A\\\\u011f\\\\u0131rl\\\\u0131k\\\",\\\"value\\\":\\\"250 gr\\\"},{\\\"key\\\":\\\"Garanti\\\",\\\"value\\\":\\\"2 y\\\\u0131l resmi garanti\\\"}]\"}', 'TECH-TABLET-001', NULL, 599.90, 449.90, 15, 1, 1, 8, '2026-03-04 14:56:48', '2026-03-04 16:53:54'),
(9, '{\"en\": \"Colorful Sticky Note Set\", \"tr\": \"Renkli Yapışkan Not Seti\"}', '{\"en\": \"6 colors, 600 sheets sticky notes.\", \"tr\": \"6 renk, 600 yaprak yapışkan not.\"}', '{\"en\": \"6 different pastel color sticky note set. 100 sheets each color. 76x76mm size. Strong adhesive, no residue.\", \"tr\": \"Renkli Yapışkan Not Seti, ders çalışırken veya ofiste notlarınızı organize etmek için mükemmel bir araçtır. 6 farklı canlı renkte toplam 600 yaprak içerir. Özel yapıştırıcısı sayesinde yüzeylerde iz bırakmadan kolayca yapıştırılıp çıkarılabilir.\"}', '{\"tr\": \"[{\\\"key\\\":\\\"\\\\u0130\\\\u00e7erik\\\",\\\"value\\\":\\\"6 renk x 100 yaprak = 600 yaprak\\\"},{\\\"key\\\":\\\"Boyut\\\",\\\"value\\\":\\\"76 x 76 mm\\\"},{\\\"key\\\":\\\"Renkler\\\",\\\"value\\\":\\\"Sar\\\\u0131, Pembe, Ye\\\\u015fil, Mavi, Turuncu, Mor\\\"},{\\\"key\\\":\\\"Yap\\\\u0131\\\\u015ft\\\\u0131r\\\\u0131c\\\\u0131\\\",\\\"value\\\":\\\"Yeniden yap\\\\u0131\\\\u015ft\\\\u0131r\\\\u0131labilir, iz b\\\\u0131rakmaz\\\"},{\\\"key\\\":\\\"Ka\\\\u011f\\\\u0131t\\\",\\\"value\\\":\\\"80 gr\\\\/m\\\\u00b2 FSC sertifikal\\\\u0131\\\"}]\"}', 'KIRT-NOT-006', NULL, 39.90, NULL, 200, 1, 1, 9, '2026-03-04 14:56:48', '2026-03-04 16:53:54'),
(10, '{\"en\": \"Sketch Pad A3\", \"tr\": \"Eskiz Defteri A3\"}', '{\"en\": \"Thick textured paper, 50 sheets.\", \"tr\": \"Kalın dokulu kağıt, 50 yaprak.\"}', '{\"en\": \"A3 size professional sketch pad. 200 gsm textured paper. Ideal for pencil, charcoal and pastel works.\", \"tr\": \"Eskiz Defteri A3, profesyonel ve amatör sanatçılar için tasarlanmış yüksek kaliteli bir çizim defteridir. 200 gr/m² ağırlığında asitsiz dokulu kağıdı, karakalem, kömür, pastel ve hafif suluboya çalışmaları için idealdir. Spiral cildi sayesinde tam 180° açılır ve rahat çizim imkanı sunar.\"}', '{\"tr\": \"[{\\\"key\\\":\\\"Boyut\\\",\\\"value\\\":\\\"A3 (29.7 x 42 cm)\\\"},{\\\"key\\\":\\\"Sayfa Say\\\\u0131s\\\\u0131\\\",\\\"value\\\":\\\"50 yaprak \\\\/ 100 sayfa\\\"},{\\\"key\\\":\\\"Ka\\\\u011f\\\\u0131t A\\\\u011f\\\\u0131rl\\\\u0131\\\\u011f\\\\u0131\\\",\\\"value\\\":\\\"200 gr\\\\/m\\\\u00b2\\\"},{\\\"key\\\":\\\"Ka\\\\u011f\\\\u0131t T\\\\u00fcr\\\\u00fc\\\",\\\"value\\\":\\\"Dokulu, asitsiz \\\\u00e7izim ka\\\\u011f\\\\u0131d\\\\u0131\\\"},{\\\"key\\\":\\\"Cilt\\\",\\\"value\\\":\\\"Spiral ciltli, sert arka kapak\\\"},{\\\"key\\\":\\\"Kullan\\\\u0131m\\\",\\\"value\\\":\\\"Karakalem, k\\\\u00f6m\\\\u00fcr, pastel, suluboya\\\"}]\"}', 'KIRT-ESKIZ-A3', NULL, 129.90, NULL, 0, 1, 0, 10, '2026-03-04 14:56:48', '2026-03-04 16:53:54');

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes`
--

CREATE TABLE `product_attributes` (
  `id` bigint UNSIGNED NOT NULL,
  `name` json DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_attributes`
--

INSERT INTO `product_attributes` (`id`, `name`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, '{\"en\": \"Size\", \"tr\": \"Beden\"}', 1, 1, '2026-03-04 14:56:48', '2026-03-04 14:56:48'),
(2, '{\"en\": \"Color\", \"tr\": \"Renk\"}', 1, 2, '2026-03-04 14:56:48', '2026-03-04 14:56:48');

-- --------------------------------------------------------

--
-- Table structure for table `product_attribute_values`
--

CREATE TABLE `product_attribute_values` (
  `id` bigint UNSIGNED NOT NULL,
  `product_attribute_id` bigint UNSIGNED NOT NULL,
  `name` json DEFAULT NULL,
  `color_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_attribute_values`
--

INSERT INTO `product_attribute_values` (`id`, `product_attribute_id`, `name`, `color_code`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, '{\"en\": \"S\", \"tr\": \"S\"}', NULL, 1, 1, '2026-03-04 14:56:48', '2026-03-04 14:56:48'),
(2, 1, '{\"en\": \"M\", \"tr\": \"M\"}', NULL, 1, 2, '2026-03-04 14:56:48', '2026-03-04 14:56:48'),
(3, 1, '{\"en\": \"L\", \"tr\": \"L\"}', NULL, 1, 3, '2026-03-04 14:56:48', '2026-03-04 14:56:48'),
(4, 1, '{\"en\": \"XL\", \"tr\": \"XL\"}', NULL, 1, 4, '2026-03-04 14:56:48', '2026-03-04 14:56:48'),
(5, 2, '{\"en\": \"Red\", \"tr\": \"Kırmızı\"}', '#E53E3E', 1, 1, '2026-03-04 14:56:48', '2026-03-04 14:56:48'),
(6, 2, '{\"en\": \"Blue\", \"tr\": \"Mavi\"}', '#3B82F6', 1, 2, '2026-03-04 14:56:48', '2026-03-04 14:56:48'),
(7, 2, '{\"en\": \"Black\", \"tr\": \"Siyah\"}', '#1A1A1A', 1, 3, '2026-03-04 14:56:48', '2026-03-04 14:56:48'),
(8, 2, '{\"en\": \"White\", \"tr\": \"Beyaz\"}', '#FFFFFF', 1, 4, '2026-03-04 14:56:48', '2026-03-04 14:56:48');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` json DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `name`, `image`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, '{\"en\": \"Stationery\", \"tr\": \"Kırtasiye\"}', NULL, 1, 1, '2026-03-04 14:56:48', '2026-03-04 14:56:48'),
(2, '{\"en\": \"Books\", \"tr\": \"Kitaplar\"}', NULL, 1, 2, '2026-03-04 14:56:48', '2026-03-04 14:56:48'),
(3, '{\"en\": \"Clothing\", \"tr\": \"Giyim\"}', NULL, 1, 3, '2026-03-04 14:56:48', '2026-03-04 14:56:48'),
(4, '{\"en\": \"Technology\", \"tr\": \"Teknoloji\"}', NULL, 1, 4, '2026-03-04 14:56:48', '2026-03-04 14:56:48');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, 'uploads/products/1772639673_0_download.png', 1, '2026-03-04 15:54:33', '2026-03-04 15:54:33'),
(2, 1, 'uploads/products/1772639673_1_download.jpg', 2, '2026-03-04 15:54:33', '2026-03-04 15:54:33'),
(3, 1, 'uploads/products/1772639673_2_download.svg', 3, '2026-03-04 15:54:33', '2026-03-04 15:54:33');

-- --------------------------------------------------------

--
-- Table structure for table `product_product_category`
--

CREATE TABLE `product_product_category` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `product_category_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_product_category`
--

INSERT INTO `product_product_category` (`id`, `product_id`, `product_category_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 2, NULL, NULL),
(3, 3, 2, NULL, NULL),
(4, 4, 3, NULL, NULL),
(5, 5, 1, NULL, NULL),
(6, 6, 3, NULL, NULL),
(7, 7, 2, NULL, NULL),
(8, 7, 4, NULL, NULL),
(9, 8, 4, NULL, NULL),
(10, 9, 1, NULL, NULL),
(11, 10, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_variants`
--

CREATE TABLE `product_variants` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_variants`
--

INSERT INTO `product_variants` (`id`, `product_id`, `sku`, `price`, `stock`, `image`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 4, 'TISORT-AKD-S-Kırmızı', NULL, 20, NULL, 1, 1, '2026-03-04 14:56:48', '2026-03-04 14:56:48'),
(2, 4, 'TISORT-AKD-S-Mavi', NULL, 17, NULL, 1, 2, '2026-03-04 14:56:48', '2026-03-04 14:56:48'),
(3, 4, 'TISORT-AKD-S-Siyah', NULL, 22, NULL, 1, 3, '2026-03-04 14:56:48', '2026-03-04 14:56:48'),
(4, 4, 'TISORT-AKD-M-Kırmızı', NULL, 11, NULL, 1, 4, '2026-03-04 14:56:48', '2026-03-04 14:56:48'),
(5, 4, 'TISORT-AKD-M-Mavi', NULL, 30, NULL, 1, 5, '2026-03-04 14:56:48', '2026-03-04 14:56:48'),
(6, 4, 'TISORT-AKD-M-Siyah', NULL, 29, NULL, 1, 6, '2026-03-04 14:56:48', '2026-03-04 14:56:48'),
(7, 4, 'TISORT-AKD-L-Kırmızı', NULL, 9, NULL, 1, 7, '2026-03-04 14:56:48', '2026-03-04 14:56:48'),
(8, 4, 'TISORT-AKD-L-Mavi', NULL, 8, NULL, 1, 8, '2026-03-04 14:56:48', '2026-03-04 14:56:48'),
(9, 4, 'TISORT-AKD-L-Siyah', NULL, 22, NULL, 1, 9, '2026-03-04 14:56:48', '2026-03-04 14:56:48'),
(10, 4, 'TISORT-AKD-XL-Kırmızı', 219.90, 28, NULL, 1, 10, '2026-03-04 14:56:48', '2026-03-04 14:56:48'),
(11, 4, 'TISORT-AKD-XL-Mavi', 219.90, 11, NULL, 1, 11, '2026-03-04 14:56:48', '2026-03-04 14:56:48'),
(12, 4, 'TISORT-AKD-XL-Siyah', 219.90, 25, NULL, 1, 12, '2026-03-04 14:56:48', '2026-03-04 14:56:48'),
(13, 5, 'KALEM-PRM-Kırmızı', NULL, 33, NULL, 1, 1, '2026-03-04 14:56:48', '2026-03-04 14:56:48'),
(14, 5, 'KALEM-PRM-Mavi', NULL, 46, NULL, 1, 2, '2026-03-04 14:56:48', '2026-03-04 14:56:48'),
(15, 5, 'KALEM-PRM-Siyah', NULL, 35, NULL, 1, 3, '2026-03-04 14:56:48', '2026-03-04 14:56:48'),
(16, 5, 'KALEM-PRM-Beyaz', NULL, 37, NULL, 1, 4, '2026-03-04 14:56:48', '2026-03-04 14:56:48'),
(17, 6, 'SWEAT-AKD-S', NULL, 8, NULL, 1, 1, '2026-03-04 14:56:48', '2026-03-04 14:56:48'),
(18, 6, 'SWEAT-AKD-M', NULL, 12, NULL, 1, 2, '2026-03-04 14:56:48', '2026-03-04 14:56:48'),
(19, 6, 'SWEAT-AKD-L', NULL, 17, NULL, 1, 3, '2026-03-04 14:56:48', '2026-03-04 14:56:48'),
(20, 6, 'SWEAT-AKD-XL', 329.90, 11, NULL, 1, 4, '2026-03-04 14:56:48', '2026-03-04 14:56:48'),
(45, 1, 'DEFTER-SET-3-S-KIR', 149.90, 4, NULL, 1, 1, '2026-03-04 15:20:28', '2026-03-04 15:48:13'),
(46, 1, 'DEFTER-SET-3-S-MAV', 149.90, 0, NULL, 1, 2, '2026-03-04 15:20:28', '2026-03-04 15:20:28'),
(47, 1, 'DEFTER-SET-3-S-SIY', 149.90, 0, NULL, 1, 3, '2026-03-04 15:20:28', '2026-03-04 15:20:28'),
(48, 1, 'DEFTER-SET-3-S-BEY', 149.90, 0, NULL, 1, 4, '2026-03-04 15:20:28', '2026-03-04 15:20:28'),
(49, 1, 'DEFTER-SET-3-KIR-M', 149.90, 0, NULL, 1, 5, '2026-03-04 15:20:28', '2026-03-04 15:20:28'),
(50, 1, 'DEFTER-SET-3-M-MAV', 149.90, 0, NULL, 1, 6, '2026-03-04 15:20:28', '2026-03-04 15:20:28'),
(51, 1, 'DEFTER-SET-3-M-SIY', 149.90, 0, NULL, 1, 7, '2026-03-04 15:20:28', '2026-03-04 15:20:28'),
(52, 1, 'DEFTER-SET-3-M-BEY', 149.90, 0, NULL, 1, 8, '2026-03-04 15:20:28', '2026-03-04 15:20:28'),
(53, 1, 'DEFTER-SET-3-KIR-L', 149.90, 0, NULL, 1, 9, '2026-03-04 15:20:28', '2026-03-04 15:20:28'),
(54, 1, 'DEFTER-SET-3-MAV-L', 149.90, 0, NULL, 1, 10, '2026-03-04 15:20:28', '2026-03-04 15:20:28'),
(55, 1, 'DEFTER-SET-3-L-SIY', 149.90, 0, NULL, 1, 11, '2026-03-04 15:20:28', '2026-03-04 15:20:28'),
(56, 1, 'DEFTER-SET-3-L-BEY', 149.90, 0, NULL, 1, 12, '2026-03-04 15:20:28', '2026-03-04 15:20:28'),
(57, 1, 'DEFTER-SET-3-KIR-XL', 149.90, 0, NULL, 1, 13, '2026-03-04 15:20:28', '2026-03-04 15:20:28'),
(58, 1, 'DEFTER-SET-3-MAV-XL', 149.90, 0, NULL, 1, 14, '2026-03-04 15:20:28', '2026-03-04 15:20:28'),
(59, 1, 'DEFTER-SET-3-SIY-XL', 149.90, 0, NULL, 1, 15, '2026-03-04 15:20:28', '2026-03-04 15:20:28'),
(60, 1, 'DEFTER-SET-3-XL-BEY', 149.90, 0, NULL, 1, 16, '2026-03-04 15:20:28', '2026-03-04 15:20:28');

-- --------------------------------------------------------

--
-- Table structure for table `product_variant_attribute_value`
--

CREATE TABLE `product_variant_attribute_value` (
  `id` bigint UNSIGNED NOT NULL,
  `product_variant_id` bigint UNSIGNED NOT NULL,
  `product_attribute_value_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_variant_attribute_value`
--

INSERT INTO `product_variant_attribute_value` (`id`, `product_variant_id`, `product_attribute_value_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 1, 5, NULL, NULL),
(3, 2, 1, NULL, NULL),
(4, 2, 6, NULL, NULL),
(5, 3, 1, NULL, NULL),
(6, 3, 7, NULL, NULL),
(7, 4, 2, NULL, NULL),
(8, 4, 5, NULL, NULL),
(9, 5, 2, NULL, NULL),
(10, 5, 6, NULL, NULL),
(11, 6, 2, NULL, NULL),
(12, 6, 7, NULL, NULL),
(13, 7, 3, NULL, NULL),
(14, 7, 5, NULL, NULL),
(15, 8, 3, NULL, NULL),
(16, 8, 6, NULL, NULL),
(17, 9, 3, NULL, NULL),
(18, 9, 7, NULL, NULL),
(19, 10, 4, NULL, NULL),
(20, 10, 5, NULL, NULL),
(21, 11, 4, NULL, NULL),
(22, 11, 6, NULL, NULL),
(23, 12, 4, NULL, NULL),
(24, 12, 7, NULL, NULL),
(25, 13, 5, NULL, NULL),
(26, 14, 6, NULL, NULL),
(27, 15, 7, NULL, NULL),
(28, 16, 8, NULL, NULL),
(29, 17, 1, NULL, NULL),
(30, 18, 2, NULL, NULL),
(31, 19, 3, NULL, NULL),
(32, 20, 4, NULL, NULL),
(73, 45, 1, NULL, NULL),
(74, 45, 5, NULL, NULL),
(75, 46, 1, NULL, NULL),
(76, 46, 6, NULL, NULL),
(77, 47, 1, NULL, NULL),
(78, 47, 7, NULL, NULL),
(79, 48, 1, NULL, NULL),
(80, 48, 8, NULL, NULL),
(81, 49, 2, NULL, NULL),
(82, 49, 5, NULL, NULL),
(83, 50, 2, NULL, NULL),
(84, 50, 6, NULL, NULL),
(85, 51, 2, NULL, NULL),
(86, 51, 7, NULL, NULL),
(87, 52, 2, NULL, NULL),
(88, 52, 8, NULL, NULL),
(89, 53, 3, NULL, NULL),
(90, 53, 5, NULL, NULL),
(91, 54, 3, NULL, NULL),
(92, 54, 6, NULL, NULL),
(93, 55, 3, NULL, NULL),
(94, 55, 7, NULL, NULL),
(95, 56, 3, NULL, NULL),
(96, 56, 8, NULL, NULL),
(97, 57, 4, NULL, NULL),
(98, 57, 5, NULL, NULL),
(99, 58, 4, NULL, NULL),
(100, 58, 6, NULL, NULL),
(101, 59, 4, NULL, NULL),
(102, 59, 7, NULL, NULL),
(103, 60, 4, NULL, NULL),
(104, 60, 8, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_visible` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `is_visible`, `created_at`, `updated_at`) VALUES
(1, 'SuperAdmin', 'web', 0, '2025-09-18 13:02:12', '2025-09-18 13:02:12'),
(2, 'Admin', 'web', 1, '2025-09-18 13:02:12', '2025-09-18 13:02:12'),
(3, 'Kordinatör', 'web', 1, '2025-09-18 13:02:12', '2025-09-18 13:02:12'),
(4, 'Eğitmen', 'web', 1, '2025-09-18 13:02:12', '2025-09-18 13:02:12'),
(5, 'Muhasebe', 'web', 1, '2025-10-01 17:22:59', '2025-10-01 17:22:59');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(21, 1),
(1, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(13, 2),
(14, 2),
(15, 2),
(16, 2),
(17, 2),
(18, 2),
(19, 2),
(21, 2),
(1, 3),
(6, 3),
(10, 3),
(9, 4),
(1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('0hQgz8E8maFm2ilsgHhL7RdjlEeeKkFiErpObwL7', 1, '140.82.114.21', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiRGRrTmRQUldkWGV0T2QzUkpMRVladzBjSDNXMjRFQThHZ0lIQ0dOayI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0MzoiaHR0cDovL2xvY2FsaG9zdDo4MDE0L3BhbmVsL3BhZ2VzL2VkaXQvc2hvcCI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM2OiJodHRwOi8vbG9jYWxob3N0OjgwMTQvcGFuZWwvc2V0dGluZ3MiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1772729183),
('0UAIrobYrF6X6YHRwkv2NfsffDPg3kG0oZrKraTD', 6, '140.82.114.21', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVFo0Z1lUTVdBWlNvMFJBMW45ems0czZ5akg3ZzdYSzBVVWh6QlJrUyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAxNC9wYW5lbC9wYWdlcy9lZGl0L2Fib3V0Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Njt9', 1772794105),
('2ns5JBoNWEBGhYqUdWnxGxU1gcABgAhmQs6b420w', 1, '160.79.104.10', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiUWlyanFOTTkyUmJ0aWlTYmxUTG0zcDYyMFY2RklGQzVJb1JrNEZuVSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0MzoiaHR0cDovL2xvY2FsaG9zdDo4MDE0L3BhbmVsL3BhZ2VzL2VkaXQvc2hvcCI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQzOiJodHRwOi8vbG9jYWxob3N0OjgwMTQvcGFuZWwvcGFnZXMvZWRpdC9zaG9wIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1772708595),
('bE20mmPzMGKESyaUNXh5fLb5FB3Ne70gP2oXku1R', 1, '160.79.104.10', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiWEhPN3pnMUFOeTFja1FUV21zYmI5SERPbUl4czhyMWFBeVRHbFBJciI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNjoiaHR0cDovL2xvY2FsaG9zdDo4MDE0L3BhbmVsL3NldHRpbmdzIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTY6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAxNC9wYW5lbC9zZXR0aW5ncy92YWxpZGF0aW9uLW1lc3NhZ2VzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1772771811),
('bGk4r1r15LI09tISGtdXSRMnw6YM1wzS3eE6m3b8', 1, '160.79.104.10', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiT1I3RkxZTlRlRXlmR0JGZDVuT3VWVUxWczVCdWp3eEVjeFpSdnNTbiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNjoiaHR0cDovL2xvY2FsaG9zdDo4MDE0L3BhbmVsL3NldHRpbmdzIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAxNC9wYW5lbC9zZXR0aW5ncyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1772746521),
('M91zJUG22OVL4C4hrCaGGG6hfaHAq0eOvQzSMCOE', NULL, '127.0.0.1', 'curl/7.81.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQTZkNU0xV2NHbzloeVppZjJJN1ExRzNEa1RUWTB6ZVBuckZzNlQxNCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozODoiaHR0cDovL2xvY2FsaG9zdC9wYW5lbC9wYWdlcy9lZGl0L3Nob3AiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozODoiaHR0cDovL2xvY2FsaG9zdC9wYW5lbC9wYWdlcy9lZGl0L3Nob3AiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1772705098),
('x8puj5gjQMbV7N6JAApE1fhuCitpYdpJSxsCAC6W', NULL, '140.82.114.21', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWWM4dmp3TE52ZlJhTmlxVUtjMWtiVFhmVTNSM2E5MEFRVXlxNHVkUiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0NDoiaHR0cDovL2xvY2FsaG9zdDo4MDE0L3BhbmVsL3BhZ2VzL2VkaXQvYWJvdXQiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyMToiaHR0cDovL2xvY2FsaG9zdDo4MDE0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1772821666),
('xKnF5cQd7lwsWiCjY9rjIaM78zUk8DEEKcrzpArM', 1, '140.82.114.21', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiNHYwNWkwRDNoOFBlOWZFcHB2RU1BcVRLZzBFaHRzTGIxOVNmOVlpeCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo1NjoiaHR0cDovL2xvY2FsaG9zdDo4MDE0L3BhbmVsL3NldHRpbmdzL3ZhbGlkYXRpb24tbWVzc2FnZXMiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo1NjoiaHR0cDovL2xvY2FsaG9zdDo4MDE0L3BhbmVsL3NldHRpbmdzL3ZhbGlkYXRpb24tbWVzc2FnZXMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1772783551);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'general',
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `group`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'general', 'site_name', 'Parosis Akademi', '2026-03-05 12:35:56', '2026-03-05 12:35:56'),
(2, 'general', 'site_description', 'Geleceğin teknolojisine yön veren akademi.', '2026-03-05 12:35:56', '2026-03-05 12:35:56'),
(3, 'general', 'site_phone', '', '2026-03-05 12:35:56', '2026-03-05 12:35:56'),
(4, 'general', 'site_email', '', '2026-03-05 12:35:56', '2026-03-05 12:35:56'),
(5, 'general', 'site_address', '', '2026-03-05 12:35:56', '2026-03-05 12:35:56'),
(6, 'general', 'copyright_text', '© 2026 Parosis Akademi. Tüm hakları saklıdır.', '2026-03-05 12:35:56', '2026-03-05 12:35:56'),
(7, 'general', 'timezone', 'Europe/Istanbul', '2026-03-05 12:35:56', '2026-03-05 12:35:56'),
(8, 'logos', 'header_logo', '', '2026-03-05 12:35:56', '2026-03-05 12:35:56'),
(9, 'logos', 'footer_logo', '', '2026-03-05 12:35:56', '2026-03-05 12:35:56'),
(10, 'logos', 'favicon', '', '2026-03-05 12:35:56', '2026-03-05 12:35:56'),
(11, 'logos', 'admin_logo', '', '2026-03-05 12:35:56', '2026-03-05 12:35:56'),
(12, 'seo', 'meta_title', 'Parosis Akademi', '2026-03-05 12:35:56', '2026-03-05 12:35:56'),
(13, 'seo', 'meta_description', '', '2026-03-05 12:35:56', '2026-03-05 12:35:56'),
(14, 'seo', 'meta_keywords', '', '2026-03-05 12:35:56', '2026-03-05 12:35:56'),
(15, 'seo', 'google_analytics_id', '', '2026-03-05 12:35:56', '2026-03-05 12:35:56'),
(16, 'seo', 'google_tag_manager_id', '', '2026-03-05 12:35:56', '2026-03-05 12:35:56'),
(17, 'seo', 'robots_txt', 'User-agent: *\nAllow: /', '2026-03-05 12:35:56', '2026-03-05 12:35:56'),
(18, 'mail', 'mail_mailer', 'log', '2026-03-05 12:35:56', '2026-03-05 12:35:56'),
(19, 'mail', 'mail_host', '', '2026-03-05 12:35:56', '2026-03-05 12:35:56'),
(20, 'mail', 'mail_port', '587', '2026-03-05 12:35:56', '2026-03-05 12:35:56'),
(21, 'mail', 'mail_username', '', '2026-03-05 12:35:56', '2026-03-05 12:35:56'),
(23, 'mail', 'mail_encryption', 'tls', '2026-03-05 12:35:56', '2026-03-05 12:35:56'),
(24, 'mail', 'mail_from_address', '', '2026-03-05 12:35:56', '2026-03-05 12:35:56'),
(25, 'mail', 'mail_from_name', 'Parosis Akademi', '2026-03-05 12:35:56', '2026-03-05 12:35:56'),
(26, 'social', 'facebook_url', '', '2026-03-05 12:35:56', '2026-03-05 12:35:56'),
(27, 'social', 'twitter_url', '', '2026-03-05 12:35:56', '2026-03-05 12:35:56'),
(28, 'social', 'instagram_url', '', '2026-03-05 12:35:56', '2026-03-05 12:35:56'),
(29, 'social', 'linkedin_url', '', '2026-03-05 12:35:56', '2026-03-05 12:35:56'),
(30, 'social', 'youtube_url', '', '2026-03-05 12:35:56', '2026-03-05 12:35:56'),
(31, 'social', 'tiktok_url', '', '2026-03-05 12:35:56', '2026-03-05 12:35:56'),
(32, 'social', 'whatsapp_number', '', '2026-03-05 12:35:56', '2026-03-05 12:35:56'),
(33, 'advanced', 'maintenance_mode', '0', '2026-03-05 12:35:56', '2026-03-05 12:35:56'),
(34, 'advanced', 'custom_head_code', '', '2026-03-05 12:35:56', '2026-03-05 12:35:56'),
(35, 'advanced', 'custom_body_code', '', '2026-03-05 12:35:56', '2026-03-05 12:35:56'),
(36, 'seo', 'sitemap_url', '/sitemap.xml', '2026-03-05 15:44:30', '2026-03-05 16:00:24');

-- --------------------------------------------------------

--
-- Table structure for table `shop_page_infos`
--

CREATE TABLE `shop_page_infos` (
  `id` bigint UNSIGNED NOT NULL,
  `products_title` json DEFAULT NULL,
  `products_breadcrumb_home` json DEFAULT NULL,
  `products_breadcrumb_current` json DEFAULT NULL,
  `products_search_placeholder` json DEFAULT NULL,
  `products_search_button` json DEFAULT NULL,
  `products_all_text` json DEFAULT NULL,
  `products_add_to_cart` json DEFAULT NULL,
  `products_detail_button` json DEFAULT NULL,
  `products_empty_text` json DEFAULT NULL,
  `detail_title` json DEFAULT NULL,
  `detail_breadcrumb_products` json DEFAULT NULL,
  `detail_discount_text` json DEFAULT NULL,
  `detail_add_to_cart` json DEFAULT NULL,
  `detail_sku_label` json DEFAULT NULL,
  `detail_category_label` json DEFAULT NULL,
  `detail_description_tab` json DEFAULT NULL,
  `detail_features_tab` json DEFAULT NULL,
  `detail_related_subtitle` json DEFAULT NULL,
  `detail_related_title` json DEFAULT NULL,
  `detail_related_button` json DEFAULT NULL,
  `detail_trust_1` json DEFAULT NULL,
  `detail_trust_2` json DEFAULT NULL,
  `detail_trust_3` json DEFAULT NULL,
  `cart_title` json DEFAULT NULL,
  `cart_breadcrumb_current` json DEFAULT NULL,
  `cart_empty_title` json DEFAULT NULL,
  `cart_empty_description` json DEFAULT NULL,
  `cart_empty_button` json DEFAULT NULL,
  `cart_items_header` json DEFAULT NULL,
  `cart_summary_header` json DEFAULT NULL,
  `cart_subtotal` json DEFAULT NULL,
  `cart_shipping` json DEFAULT NULL,
  `cart_shipping_free` json DEFAULT NULL,
  `cart_total` json DEFAULT NULL,
  `cart_checkout_button` json DEFAULT NULL,
  `cart_continue_shopping` json DEFAULT NULL,
  `cart_coupon_label` json DEFAULT NULL,
  `cart_coupon_placeholder` json DEFAULT NULL,
  `cart_coupon_apply` json DEFAULT NULL,
  `cart_coupon_remove` json DEFAULT NULL,
  `cart_coupon_discount` json DEFAULT NULL,
  `cart_trust_1` json DEFAULT NULL,
  `cart_trust_2` json DEFAULT NULL,
  `cart_trust_3` json DEFAULT NULL,
  `checkout_title` json DEFAULT NULL,
  `checkout_breadcrumb_cart` json DEFAULT NULL,
  `checkout_breadcrumb_current` json DEFAULT NULL,
  `checkout_step_1` json DEFAULT NULL,
  `checkout_step_2` json DEFAULT NULL,
  `checkout_step_3` json DEFAULT NULL,
  `checkout_payment_title` json DEFAULT NULL,
  `checkout_payment_subtitle` json DEFAULT NULL,
  `checkout_delivery_title` json DEFAULT NULL,
  `checkout_delivery_subtitle` json DEFAULT NULL,
  `checkout_submit_button` json DEFAULT NULL,
  `checkout_summary_header` json DEFAULT NULL,
  `checkout_ssl_info` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `field_styles` json DEFAULT NULL,
  `default_styles` json DEFAULT NULL,
  `checkout_card_number_label` json DEFAULT NULL,
  `checkout_card_name_label` json DEFAULT NULL,
  `checkout_card_expiry_label` json DEFAULT NULL,
  `checkout_card_cvv_label` json DEFAULT NULL,
  `checkout_card_holder_label` json DEFAULT NULL,
  `checkout_card_expiry_preview` json DEFAULT NULL,
  `checkout_name_label` json DEFAULT NULL,
  `checkout_email_label` json DEFAULT NULL,
  `checkout_phone_label` json DEFAULT NULL,
  `checkout_address_label` json DEFAULT NULL,
  `checkout_city_label` json DEFAULT NULL,
  `checkout_district_label` json DEFAULT NULL,
  `checkout_note_label` json DEFAULT NULL,
  `checkout_card_number_ph` json DEFAULT NULL,
  `checkout_card_name_ph` json DEFAULT NULL,
  `checkout_card_expiry_ph` json DEFAULT NULL,
  `checkout_card_cvv_ph` json DEFAULT NULL,
  `checkout_name_ph` json DEFAULT NULL,
  `checkout_email_ph` json DEFAULT NULL,
  `checkout_phone_ph` json DEFAULT NULL,
  `checkout_address_ph` json DEFAULT NULL,
  `checkout_city_ph` json DEFAULT NULL,
  `checkout_district_ph` json DEFAULT NULL,
  `checkout_note_ph` json DEFAULT NULL,
  `checkout_card_preview_name` json DEFAULT NULL,
  `checkout_optional_text` json DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shop_page_infos`
--

INSERT INTO `shop_page_infos` (`id`, `products_title`, `products_breadcrumb_home`, `products_breadcrumb_current`, `products_search_placeholder`, `products_search_button`, `products_all_text`, `products_add_to_cart`, `products_detail_button`, `products_empty_text`, `detail_title`, `detail_breadcrumb_products`, `detail_discount_text`, `detail_add_to_cart`, `detail_sku_label`, `detail_category_label`, `detail_description_tab`, `detail_features_tab`, `detail_related_subtitle`, `detail_related_title`, `detail_related_button`, `detail_trust_1`, `detail_trust_2`, `detail_trust_3`, `cart_title`, `cart_breadcrumb_current`, `cart_empty_title`, `cart_empty_description`, `cart_empty_button`, `cart_items_header`, `cart_summary_header`, `cart_subtotal`, `cart_shipping`, `cart_shipping_free`, `cart_total`, `cart_checkout_button`, `cart_continue_shopping`, `cart_coupon_label`, `cart_coupon_placeholder`, `cart_coupon_apply`, `cart_coupon_remove`, `cart_coupon_discount`, `cart_trust_1`, `cart_trust_2`, `cart_trust_3`, `checkout_title`, `checkout_breadcrumb_cart`, `checkout_breadcrumb_current`, `checkout_step_1`, `checkout_step_2`, `checkout_step_3`, `checkout_payment_title`, `checkout_payment_subtitle`, `checkout_delivery_title`, `checkout_delivery_subtitle`, `checkout_submit_button`, `checkout_summary_header`, `checkout_ssl_info`, `created_at`, `updated_at`, `field_styles`, `default_styles`, `checkout_card_number_label`, `checkout_card_name_label`, `checkout_card_expiry_label`, `checkout_card_cvv_label`, `checkout_card_holder_label`, `checkout_card_expiry_preview`, `checkout_name_label`, `checkout_email_label`, `checkout_phone_label`, `checkout_address_label`, `checkout_city_label`, `checkout_district_label`, `checkout_note_label`, `checkout_card_number_ph`, `checkout_card_name_ph`, `checkout_card_expiry_ph`, `checkout_card_cvv_ph`, `checkout_name_ph`, `checkout_email_ph`, `checkout_phone_ph`, `checkout_address_ph`, `checkout_city_ph`, `checkout_district_ph`, `checkout_note_ph`, `checkout_card_preview_name`, `checkout_optional_text`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '{\"tr\": \"\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-05 04:21:55', '2026-03-05 10:06:37', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sitemap_entries`
--

CREATE TABLE `sitemap_entries` (
  `id` bigint UNSIGNED NOT NULL,
  `loc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `changefreq` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'monthly',
  `priority` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0.5',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `name`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Ana Sayfa Slider', 0, 1, '2026-02-26 02:44:26', '2026-02-26 03:58:19');

-- --------------------------------------------------------

--
-- Table structure for table `slider_items`
--

CREATE TABLE `slider_items` (
  `id` bigint UNSIGNED NOT NULL,
  `slider_id` bigint UNSIGNED NOT NULL,
  `title` json DEFAULT NULL,
  `highlight_text` json DEFAULT NULL,
  `description` json DEFAULT NULL,
  `button_text` json DEFAULT NULL,
  `button_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `background_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `slider_items`
--

INSERT INTO `slider_items` (`id`, `slider_id`, `title`, `highlight_text`, `description`, `button_text`, `button_url`, `image`, `background_image`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, '{\"tr\": \"En İyi Online Eğitim Platformu\"}', '{\"tr\": \"Online\"}', '{\"tr\": \"Profesyonel eğitmenlerimizle kariyer hedeflerinize ulaşmanız için en uygun kursları keşfedin.\"}', '{\"tr\": \"Tüm Kursları Görüntüle\"}', '/kurslar', 'assets-front/img/images/th-1/hero-img-1.png', 'uploads/sliders/1772075584_bg_download.jpg', 0, 1, '2026-02-26 02:44:26', '2026-02-26 03:13:04'),
(2, 1, '{\"tr\": \"Geleceğin Teknolojisine Yön Verin\"}', '{\"tr\": \"Teknolojisine\"}', '{\"tr\": \"Yapay zeka, web geliştirme ve veri bilimi alanlarında uzmanlaşın.\"}', '{\"tr\": \"Hemen Başlayın\"}', '/kurslar', 'assets-front/img/images/th-1/hero-img-1.png', NULL, 1, 1, '2026-02-26 02:44:26', '2026-02-26 03:58:19'),
(3, 1, '{\"tr\": \"Uzman Eğitmenlerle Öğrenin\"}', '{\"tr\": \"Uzman\"}', '{\"tr\": \"Alanında deneyimli eğitmenlerden birebir destek alarak kendinizi geliştirin.\"}', '{\"tr\": \"Eğitmenleri Keşfet\"}', '/egitmenler', 'assets-front/img/images/th-1/hero-img-1.png', NULL, 2, 1, '2026-02-26 02:44:26', '2026-02-26 03:58:19');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint UNSIGNED NOT NULL,
  `registration_type` enum('1','2') COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('Erkek','Kadın') COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_date` date DEFAULT NULL,
  `school_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `national_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blood_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `class_id` bigint UNSIGNED DEFAULT NULL,
  `has_allergy` tinyint(1) NOT NULL DEFAULT '0',
  `allergy_detail` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `student_phone` varchar(230) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `registiration_term` text COLLATE utf8mb4_unicode_ci,
  `meets_status` varchar(230) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `registration_type`, `full_name`, `gender`, `birth_date`, `school_name`, `national_id`, `blood_type`, `notes`, `class_id`, `has_allergy`, `allergy_detail`, `created_at`, `updated_at`, `is_active`, `student_phone`, `registiration_term`, `meets_status`) VALUES
(10, '1', 'Cameran Turner', 'Erkek', '1989-07-28', NULL, NULL, NULL, 'Optio accusamus at', NULL, 0, NULL, '2025-09-29 12:18:32', '2025-09-29 13:29:53', 1, NULL, NULL, 'Görüşüldü'),
(11, '2', 'Cihan Omur', 'Kadın', '2025-09-12', 'Germane Lewis', '12312312312', 'A+', '1212321', 2, 2, NULL, '2025-09-29 12:20:50', '2025-09-29 12:20:50', 1, '05391293123', '2025 Güz,2026 Bahar', NULL),
(12, '2', 'bCihan Omur', 'Kadın', '2025-09-12', 'Germane Lewis', '12312312312', 'A+', '1212321', 2, 2, NULL, '2025-09-23 00:00:00', '2026-02-22 19:08:42', 1, '05391293123', '2026 Bahar,2025 Güz', NULL),
(13, '2', 'Camilla Crawford', 'Kadın', '2022-11-14', 'Armand Branch', '12312312312', 'B-', 'Ut facere in eos au', 2, 1, 'Vero veniam minima', '2017-12-27 00:00:00', '2025-09-29 13:24:29', 1, NULL, '2026 Yaz,2025 Yaz', NULL),
(14, '2', 'Cihan Omur', 'Kadın', '2025-10-06', 'Germane Lewis', '77651111188', 'A-', '213', 2, 2, NULL, '2025-10-04 14:29:34', '2025-10-04 14:29:34', 1, '05391293123', '2026 Güz', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_guardians`
--

CREATE TABLE `student_guardians` (
  `id` bigint UNSIGNED NOT NULL,
  `student_id` bigint UNSIGNED NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `national_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `relationship` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `education_level` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_address` text COLLATE utf8mb4_unicode_ci,
  `work_address` text COLLATE utf8mb4_unicode_ci,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_guardians`
--

INSERT INTO `student_guardians` (`id`, `student_id`, `full_name`, `national_id`, `relationship`, `birth_date`, `education_level`, `job`, `phone_1`, `phone_2`, `email`, `home_address`, `work_address`, `active`, `created_at`, `updated_at`) VALUES
(11, 10, 'Cade Hutchinson', NULL, 'Alias ex et amet se', NULL, NULL, NULL, '19311598373', NULL, NULL, NULL, NULL, 1, '2025-09-29 12:18:32', '2026-03-04 02:12:46'),
(12, 12, 'Cihan Omur222222', '12312312312', 'Dolorem minima aute', '2000-11-11', 'Diğer', 'insaatci', '05393518739', '05393518739', 'sadac@mailinator.com', 'Dicta consequat Bea', 'Accusamus nulla dolo', 1, '2025-09-29 12:21:03', '2025-09-29 12:51:10'),
(13, 12, 'ahmet y', '12213123123', 'baba', '2000-11-11', 'Diğer', 'Diğer', '05393518739', '05393518739', 'ad@as.com', '05393518739', '05393518739', 1, '2025-09-29 12:53:52', '2026-02-22 19:28:37'),
(14, 13, 'Lavinia Mullins', '12312312312', 'Illum vitae nesciun', '1975-11-07', 'Diğer', 'insaatci', '12113193818', '17818988284', 'rudu@mailinator.com', 'In dolore sed offici', 'Excepturi amet reru', 1, '2025-09-29 13:01:52', '2025-09-29 13:24:29'),
(15, 14, 'Cihan Omur', '12312312312', '123', '2025-10-02', 'İlkokul', '123', '19215855444', NULL, '123@123.com', '123', '123', 1, '2025-10-04 14:29:34', '2025-10-04 14:29:34');

-- --------------------------------------------------------

--
-- Table structure for table `student_payments`
--

CREATE TABLE `student_payments` (
  `id` bigint UNSIGNED NOT NULL,
  `student_id` bigint UNSIGNED NOT NULL,
  `class_id` bigint UNSIGNED NOT NULL,
  `installment_count` int UNSIGNED DEFAULT '0',
  `total_price` varchar(230) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `total_payed_price` varchar(230) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `start_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `registiration_term` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_payments`
--

INSERT INTO `student_payments` (`id`, `student_id`, `class_id`, `installment_count`, `total_price`, `total_payed_price`, `start_date`, `created_at`, `updated_at`, `registiration_term`) VALUES
(7, 12, 2, 12, '1000', '0.35', '2025-09-01', '2025-09-29 12:21:03', '2025-09-29 12:26:00', '2026 Bahar,2025 Güz'),
(8, 13, 3, 12, '120', '20', '2025-09-01', '2025-09-29 13:01:52', '2025-10-01 17:35:18', '2026 Yaz,2025 Yaz'),
(9, 13, 2, 0, '0', '0', NULL, '2025-10-01 17:32:00', '2025-10-01 17:32:00', '2026 Yaz,2025 Yaz'),
(10, 14, 2, 0, '0', '0', NULL, '2025-10-04 14:29:34', '2025-10-04 14:29:34', '2026 Güz'),
(11, 12, 2, 0, '0', '0', NULL, '2025-10-04 14:32:11', '2025-10-04 14:32:11', '2026 Bahar,2025 Güz'),
(12, 12, 2, 0, '0', '0', NULL, '2025-10-04 14:32:47', '2025-10-04 14:32:47', '2026 Bahar,2025 Güz'),
(13, 12, 2, 0, '0', '0', NULL, '2025-10-04 14:33:00', '2025-10-04 14:33:00', '2026 Bahar,2025 Güz'),
(14, 12, 2, 0, '0', '0', NULL, '2025-10-04 14:33:04', '2025-10-04 14:33:04', '2026 Bahar,2025 Güz'),
(15, 12, 2, 0, '0', '0', NULL, '2025-10-04 14:33:12', '2025-10-04 14:33:12', '2026 Bahar,2025 Güz'),
(16, 12, 2, 0, '0', '0', NULL, '2025-10-04 14:33:38', '2025-10-04 14:33:38', '2026 Bahar,2025 Güz'),
(17, 12, 2, 2, '10', '0', '2025-10-01', '2025-10-04 14:33:41', '2025-10-04 14:33:49', '2026 Bahar,2025 Güz'),
(18, 12, 2, 0, '0', '0', NULL, '2026-02-22 19:28:37', '2026-02-22 19:28:37', '2026 Bahar,2025 Güz');

-- --------------------------------------------------------

--
-- Table structure for table `student_payments_installments`
--

CREATE TABLE `student_payments_installments` (
  `id` bigint UNSIGNED NOT NULL,
  `student_id` bigint UNSIGNED NOT NULL,
  `student_payment_id` bigint UNSIGNED NOT NULL,
  `order` int UNSIGNED DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `installment_price` varchar(230) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `payed_price` varchar(230) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `payment_type` varchar(230) COLLATE utf8mb4_unicode_ci DEFAULT 'Nakit',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `payyed_date` date DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_payments_installments`
--

INSERT INTO `student_payments_installments` (`id`, `student_id`, `student_payment_id`, `order`, `payment_date`, `installment_price`, `payed_price`, `payment_type`, `created_at`, `updated_at`, `payyed_date`, `note`) VALUES
(347, 12, 7, 1, '2025-09-01', '83.03', '0.35', 'Nakit', '2025-09-29 12:44:04', '2025-09-29 12:44:04', NULL, NULL),
(348, 12, 7, 2, '2025-09-01', '117', '0.00', 'Nakit', '2025-09-29 12:44:04', '2025-09-29 12:44:04', NULL, NULL),
(349, 12, 7, 3, '2025-09-01', '50', '0.00', 'Nakit', '2025-09-29 12:44:04', '2025-09-29 12:44:04', NULL, NULL),
(350, 12, 7, 4, '2025-09-01', '83.33', '0.00', 'Nakit', '2025-09-29 12:44:04', '2025-09-29 12:44:04', NULL, NULL),
(351, 12, 7, 5, '2025-09-01', '83.33', '0.00', 'Nakit', '2025-09-29 12:44:04', '2025-09-29 12:44:04', NULL, NULL),
(352, 12, 7, 6, '2025-09-01', '83.33', '0.00', 'Nakit', '2025-09-29 12:44:04', '2025-09-29 12:44:04', NULL, NULL),
(353, 12, 7, 7, '2025-09-01', '83.33', '0.00', 'Nakit', '2025-09-29 12:44:04', '2025-09-29 12:44:04', NULL, NULL),
(354, 12, 7, 8, '2025-09-01', '83.33', '0.00', 'Nakit', '2025-09-29 12:44:04', '2025-09-29 12:44:04', NULL, NULL),
(355, 12, 7, 9, '2025-09-01', '83.33', '0.00', 'Nakit', '2025-09-29 12:44:04', '2025-09-29 12:44:04', NULL, NULL),
(356, 12, 7, 10, '2025-09-01', '83.33', '0.00', 'Nakit', '2025-09-29 12:44:04', '2025-09-29 12:44:04', NULL, NULL),
(357, 12, 7, 11, '2025-09-01', '83.33', '0.00', 'Nakit', '2025-09-29 12:44:04', '2025-09-29 12:44:04', NULL, NULL),
(358, 12, 7, 12, '2025-09-01', '83.33', '0.00', 'Nakit', '2025-09-29 12:44:04', '2025-09-29 12:44:04', NULL, NULL),
(383, 13, 8, 1, '2025-09-01', '10', '10', 'Nakit', '2025-10-01 17:35:18', '2025-10-01 17:35:18', '2025-10-01', NULL),
(384, 13, 8, 2, '2025-09-01', '10.00', '10', 'Nakit', '2025-10-01 17:35:18', '2025-10-01 17:35:18', '2025-10-01', NULL),
(385, 13, 8, 3, '2025-09-01', '10.00', '0.00', 'Nakit', '2025-10-01 17:35:18', '2025-10-01 17:35:18', NULL, NULL),
(386, 13, 8, 4, '2025-09-01', '10.00', '0.00', 'Nakit', '2025-10-01 17:35:18', '2025-10-01 17:35:18', NULL, NULL),
(387, 13, 8, 5, '2025-09-01', '10.00', '0.00', 'Nakit', '2025-10-01 17:35:18', '2025-10-01 17:35:18', NULL, NULL),
(388, 13, 8, 6, '2025-09-01', '10.00', '0.00', 'Nakit', '2025-10-01 17:35:18', '2025-10-01 17:35:18', NULL, NULL),
(389, 13, 8, 7, '2025-09-01', '10.00', '0.00', 'Nakit', '2025-10-01 17:35:18', '2025-10-01 17:35:18', NULL, NULL),
(390, 13, 8, 8, '2025-09-01', '10.00', '0.00', 'Nakit', '2025-10-01 17:35:18', '2025-10-01 17:35:18', NULL, NULL),
(391, 13, 8, 9, '2025-09-01', '10.00', '0.00', 'Nakit', '2025-10-01 17:35:18', '2025-10-01 17:35:18', NULL, NULL),
(392, 13, 8, 10, '2025-09-01', '10.00', '0.00', 'Nakit', '2025-10-01 17:35:18', '2025-10-01 17:35:18', NULL, NULL),
(393, 13, 8, 11, '2025-09-01', '10.00', '0.00', 'Nakit', '2025-10-01 17:35:18', '2025-10-01 17:35:18', NULL, NULL),
(394, 13, 8, 12, '2025-09-01', '10.00', '0.00', 'Nakit', '2025-10-01 17:35:18', '2025-10-01 17:35:18', NULL, NULL),
(395, 12, 17, 1, '2025-10-01', '5.00', '0.00', 'Nakit', '2025-10-04 14:33:49', '2025-10-04 14:33:49', NULL, NULL),
(396, 12, 17, 2, '2025-11-01', '5.00', '0.00', 'Nakit', '2025-10-04 14:33:49', '2025-10-04 14:33:49', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` bigint UNSIGNED NOT NULL,
  `name` json DEFAULT NULL,
  `title` json DEFAULT NULL,
  `short_description` json DEFAULT NULL,
  `bio` json DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dribbble_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `name`, `title`, `short_description`, `bio`, `image`, `phone`, `email`, `facebook_url`, `twitter_url`, `dribbble_url`, `instagram_url`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, '{\"en\": \"Ayse Yilmaz\", \"tr\": \"Ayşe Yılmaz\"}', '{\"en\": \"Digital Marketing Expert\", \"tr\": \"Dijital Pazarlama Uzmanı\"}', '{\"en\": \"Expert instructor with over 10 years of experience in digital marketing, certified by Google and Meta.\", \"tr\": \"Dijital pazarlama alanında 10 yılı aşkın deneyime sahip, Google ve Meta sertifikalı uzman eğitmen.\"}', '{\"en\": \"<p>Ayse Yilmaz is an expert with over 10 years of experience in digital marketing.</p>\", \"tr\": \"<p>Ayşe Yılmaz, dijital pazarlama alanında 10 yılı aşkın deneyime sahip bir uzmandır.</p>\"}', NULL, '+90 532 123 45 67', 'ayse@parosisakademi.com', 'https://facebook.com', 'https://twitter.com', NULL, 'https://instagram.com', 1, 1, '2026-02-23 17:10:11', '2026-02-23 17:10:11'),
(2, '{\"en\": \"Mehmet Kaya\", \"tr\": \"Mehmet Kaya\"}', '{\"en\": \"Graphic Design Instructor\", \"tr\": \"Grafik Tasarım Eğitmeni\"}', '{\"en\": \"Award-winning graphic designer specializing in Adobe Creative Suite and UI/UX design.\", \"tr\": \"Adobe Creative Suite ve UI/UX tasarım konularında uzman, ödüllü grafik tasarımcı.\"}', '{\"en\": \"<p>Mehmet Kaya is an award-winning designer with over 8 years of graphic design experience.</p>\", \"tr\": \"<p>Mehmet Kaya, 8 yılı aşkın grafik tasarım deneyimine sahip ödüllü bir tasarımcıdır.</p>\"}', NULL, '+90 533 456 78 90', 'mehmet@parosisakademi.com', 'https://facebook.com', NULL, 'https://dribbble.com', 'https://instagram.com', 1, 2, '2026-02-23 17:10:11', '2026-02-23 17:10:11'),
(3, '{\"en\": \"Zeynep Demir\", \"tr\": \"Zeynep Demir\"}', '{\"en\": \"Web Development Expert\", \"tr\": \"Web Geliştirme Uzmanı\"}', '{\"en\": \"Expert in full-stack web development, experienced in React and Laravel.\", \"tr\": \"Full-stack web geliştirme konusunda uzman, React ve Laravel teknolojilerinde deneyimli.\"}', '{\"en\": \"<p>Zeynep Demir is a software engineer specializing in modern web technologies.</p>\", \"tr\": \"<p>Zeynep Demir, modern web teknolojileri konusunda uzmanlaşmış bir yazılım mühendisidir.</p>\"}', NULL, '+90 534 789 01 23', 'zeynep@parosisakademi.com', NULL, 'https://twitter.com', NULL, 'https://instagram.com', 1, 3, '2026-02-23 17:10:11', '2026-02-23 17:10:11'),
(4, '{\"en\": \"Ali Ozturk\", \"tr\": \"Ali Öztürk\"}', '{\"en\": \"Data Science Instructor\", \"tr\": \"Veri Bilimi Eğitmeni\"}', '{\"en\": \"Academic experienced in Python, machine learning and data analysis.\", \"tr\": \"Python, makine öğrenmesi ve veri analizi konularında deneyimli akademisyen.\"}', '{\"en\": \"<p>Ali Ozturk is an academic with a PhD in data science and artificial intelligence.</p>\", \"tr\": \"<p>Ali Öztürk, veri bilimi ve yapay zeka alanında doktora derecesine sahip bir akademisyendir.</p>\"}', NULL, NULL, 'ali@parosisakademi.com', 'https://facebook.com', 'https://twitter.com', NULL, NULL, 1, 4, '2026-02-23 17:10:11', '2026-02-23 17:10:11'),
(5, '{\"en\": \"Elif Sahin\", \"tr\": \"Elif Şahin\"}', '{\"en\": \"English Language Instructor\", \"tr\": \"İngilizce Eğitmeni\"}', '{\"en\": \"Cambridge CELTA certified, 12 years of English teaching experience.\", \"tr\": \"Cambridge CELTA sertifikalı, 12 yıllık İngilizce öğretim deneyimi.\"}', '{\"en\": \"<p>Elif Sahin is an experienced English instructor with Cambridge CELTA certification.</p>\", \"tr\": \"<p>Elif Şahin, Cambridge CELTA sertifikalı deneyimli bir İngilizce eğitmenidir.</p>\"}', NULL, '+90 536 012 34 56', 'elif@parosisakademi.com', NULL, NULL, NULL, 'https://instagram.com', 1, 5, '2026-02-23 17:10:11', '2026-02-23 17:10:11'),
(6, '{\"en\": \"Can Aydin\", \"tr\": \"Can Aydın\"}', '{\"en\": \"Music Instructor\", \"tr\": \"Müzik Eğitmeni\"}', '{\"en\": \"Conservatory graduate, expert instructor in piano and music theory.\", \"tr\": \"Konservatuar mezunu, piyano ve müzik teorisi konusunda uzman eğitmen.\"}', '{\"en\": \"<p>Can Aydin is a graduate of Istanbul University State Conservatory.</p>\", \"tr\": \"<p>Can Aydın, İstanbul Üniversitesi Devlet Konservatuarı mezunudur.</p>\"}', NULL, NULL, 'can@parosisakademi.com', 'https://facebook.com', NULL, NULL, 'https://instagram.com', 1, 6, '2026-02-23 17:10:11', '2026-02-23 17:10:11');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_page_infos`
--

CREATE TABLE `teacher_page_infos` (
  `id` bigint UNSIGNED NOT NULL,
  `title` json DEFAULT NULL,
  `field_styles` json DEFAULT NULL,
  `default_styles` json DEFAULT NULL,
  `subtitle` json DEFAULT NULL,
  `breadcrumb_home` json DEFAULT NULL,
  `breadcrumb_current` json DEFAULT NULL,
  `detail_breadcrumb_current` json DEFAULT NULL,
  `cta_label` json DEFAULT NULL,
  `cta_title` json DEFAULT NULL,
  `cta_description` json DEFAULT NULL,
  `cta_button_text` json DEFAULT NULL,
  `cta_button_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cta_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teacher_page_infos`
--

INSERT INTO `teacher_page_infos` (`id`, `title`, `field_styles`, `default_styles`, `subtitle`, `breadcrumb_home`, `breadcrumb_current`, `detail_breadcrumb_current`, `cta_label`, `cta_title`, `cta_description`, `cta_button_text`, `cta_button_url`, `cta_image`, `created_at`, `updated_at`) VALUES
(1, '{\"en\": \"Our Teachers\", \"tr\": \"Eğitmenlerimiz\"}', '{\"title\": {\"textAlign\": \"center\"}}', NULL, '{\"en\": \"TEACHERS\", \"tr\": \"EĞİTMENLER\"}', '{\"en\": \"HOME\", \"tr\": \"ANA SAYFA\"}', '{\"en\": \"OUR TEACHERS\", \"tr\": \"EĞİTMENLER\"}', '{\"en\": \"TEACHER DETAILS\", \"tr\": \"EĞİTMEN DETAY\"}', '{\"en\": \"GET STARTED\", \"tr\": \"HEMEN BAŞLAYIN\"}', '{\"en\": \"Start your learning journey today\", \"tr\": \"Eğitim yolculuğunuza bugün başlayın\"}', '{\"en\": \"Reach your goals with our expert instructors. Take one step closer to your career goals like thousands of our students.\", \"tr\": \"Uzman eğitmenlerimizle hedeflerinize ulaşın. Siz de binlerce öğrencimiz gibi kariyer hedefinize bir adım daha yaklaşın.\"}', '{\"en\": \"Enroll Now\", \"tr\": \"Hemen Kaydol\"}', '/kurslar', NULL, '2026-02-23 16:06:53', '2026-02-28 07:34:35');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` json DEFAULT NULL,
  `quote` json NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` int NOT NULL DEFAULT '5',
  `sort_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `role`, `quote`, `image`, `rating`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Ayşe Yılmaz', '{\"tr\": \"Yazılım Mühendisi\"}', '{\"tr\": \"Parosis Akademi sayesinde kariyerimde büyük bir sıçrama yaşadım. Eğitmenler çok ilgili ve müfredat güncel.\"}', NULL, 5, 0, 1, '2026-02-24 21:23:51', '2026-02-24 21:23:51'),
(2, 'Mehmet Kaya', '{\"tr\": \"Grafik Tasarımcı\"}', '{\"tr\": \"Kurslar çok kapsamlı ve uygulamalı. Öğrendiklerimi hemen iş hayatımda kullanmaya başladım.\"}', NULL, 5, 1, 1, '2026-02-24 21:23:51', '2026-02-24 21:23:51'),
(3, 'Zeynep Demir', '{\"tr\": \"Üniversite Öğrencisi\"}', '{\"tr\": \"Online eğitim platformları arasında en kalitelisi. Hem teorik hem pratik bilgi ediniyorsunuz.\"}', NULL, 4, 2, 1, '2026-02-24 21:23:51', '2026-02-24 21:23:51'),
(4, 'Ali Çelik', '{\"tr\": \"Proje Yöneticisi\"}', '{\"tr\": \"Ekibimle birlikte kurumsal eğitim aldık. Profesyonel yaklaşım ve zengin içerik için teşekkürler.\"}', NULL, 5, 3, 1, '2026-02-24 21:23:51', '2026-02-24 21:23:51'),
(5, 'Fatma Aksoy', '{\"tr\": \"Veri Analisti\"}', '{\"tr\": \"Veri bilimi kursları mükemmeldi. Sıfırdan başlayıp ileri seviyeye ulaştım. Herkese tavsiye ederim.\"}', NULL, 5, 4, 1, '2026-02-24 21:23:51', '2026-02-24 21:23:51'),
(6, 'Burak Şahin', '{\"tr\": \"Freelance Geliştirici\"}', '{\"tr\": \"Esnek ders programı ve kaliteli içerik. Freelance kariyerime Parosis ile başladım diyebilirim.\"}', NULL, 4, 5, 1, '2026-02-24 21:23:51', '2026-02-24 21:23:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(230) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_url` varchar(230) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_visible` tinyint(1) DEFAULT '1',
  `phone` varchar(230) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `image_url`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `is_visible`, `phone`) VALUES
(1, 'Super Admin', 'developer@admin.com', 'superadmin', NULL, NULL, '$2y$12$3L6oCrtOtlrutU3cQGIJGecUo8X2d3u6UtBTdyxfofyu5stxZs9OS', NULL, '2025-09-18 13:02:12', '2025-09-18 13:02:12', 0, '05393518739'),
(4, 'egitmen1 soyad2', 'dev@gmail.com', NULL, NULL, NULL, '$2y$12$Xw/5KRI2BoNJjsLkRTb3Ju3wVxNzH.u1R5my9yritFF64O2WOhvzG', NULL, '2025-09-29 13:52:45', '2025-10-04 14:07:15', 1, '5393518739'),
(5, 'muhasebe', 'muhasebe@gmail.com', NULL, NULL, NULL, '$2y$12$Zq0OF8iJfucwZH8v8UQcQ..2yZ99BahBuU0VnayTBZlzA8Jr1QkSS', NULL, '2025-10-04 13:50:21', '2025-10-04 13:50:21', 1, '05393518738'),
(6, 'deneme', 'deneme@admin.com', NULL, NULL, NULL, '$2y$12$TQu6cBubXOQyv.42hITLXuHjzrYKxTL.KWH307tVsDdEno4PztMt.', NULL, '2026-03-06 10:47:52', '2026-03-06 10:47:52', 1, '1231231231');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us_page_infos`
--
ALTER TABLE `about_us_page_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_blog_category`
--
ALTER TABLE `blog_blog_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blog_blog_category_blog_id_foreign` (`blog_id`),
  ADD KEY `blog_blog_category_blog_category_id_foreign` (`blog_category_id`);

--
-- Indexes for table `blog_blog_tag`
--
ALTER TABLE `blog_blog_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blog_blog_tag_blog_id_foreign` (`blog_id`),
  ADD KEY `blog_blog_tag_blog_tag_id_foreign` (`blog_tag_id`);

--
-- Indexes for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_page_infos`
--
ALTER TABLE `blog_page_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_tags`
--
ALTER TABLE `blog_tags`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `client_logos`
--
ALTER TABLE `client_logos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_page_infos`
--
ALTER TABLE `contact_page_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupons_code_unique` (`code`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_categories`
--
ALTER TABLE `course_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_course_category`
--
ALTER TABLE `course_course_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_course_category_course_id_foreign` (`course_id`),
  ADD KEY `course_course_category_course_category_id_foreign` (`course_category_id`);

--
-- Indexes for table `course_page_infos`
--
ALTER TABLE `course_page_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emergency_contacts`
--
ALTER TABLE `emergency_contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emergency_contacts_student_id_foreign` (`student_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `faqs_category_id_index` (`category_id`);

--
-- Indexes for table `faq_page_infos`
--
ALTER TABLE `faq_page_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `footer_page_infos`
--
ALTER TABLE `footer_page_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_page_infos`
--
ALTER TABLE `home_page_infos`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lesson_classes`
--
ALTER TABLE `lesson_classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lesson_class_days`
--
ALTER TABLE `lesson_class_days`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lesson_class_days_lesson_class_id_foreign` (`lesson_class_id`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_items_parent_id_index` (`parent_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `navbar_page_infos`
--
ALTER TABLE `navbar_page_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_number_unique` (`order_number`),
  ADD KEY `orders_coupon_id_foreign` (`coupon_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`),
  ADD KEY `order_items_product_variant_id_foreign` (`product_variant_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_sku_unique` (`sku`);

--
-- Indexes for table `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_attribute_values`
--
ALTER TABLE `product_attribute_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_attribute_values_product_attribute_id_foreign` (`product_attribute_id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_product_category`
--
ALTER TABLE `product_product_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_product_category_product_id_foreign` (`product_id`),
  ADD KEY `product_product_category_product_category_id_foreign` (`product_category_id`);

--
-- Indexes for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_variants_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_variant_attribute_value`
--
ALTER TABLE `product_variant_attribute_value`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pvav_variant_fk` (`product_variant_id`),
  ADD KEY `pvav_attr_value_fk` (`product_attribute_value_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_group_key_unique` (`group`,`key`),
  ADD KEY `settings_group_index` (`group`);

--
-- Indexes for table `shop_page_infos`
--
ALTER TABLE `shop_page_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sitemap_entries`
--
ALTER TABLE `sitemap_entries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider_items`
--
ALTER TABLE `slider_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `slider_items_slider_id_foreign` (`slider_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `students_class_id_foreign` (`class_id`);

--
-- Indexes for table `student_guardians`
--
ALTER TABLE `student_guardians`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_guardians_student_id_foreign` (`student_id`);

--
-- Indexes for table `student_payments`
--
ALTER TABLE `student_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_payments_class_id_foreign` (`class_id`),
  ADD KEY `student_payments_student_id_foreign` (`student_id`);

--
-- Indexes for table `student_payments_installments`
--
ALTER TABLE `student_payments_installments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_payments_installments_student_id_foreign` (`student_id`),
  ADD KEY `student_payments_installments_student_payment_id_foreign` (`student_payment_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_page_infos`
--
ALTER TABLE `teacher_page_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `about_us_page_infos`
--
ALTER TABLE `about_us_page_infos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `blog_blog_category`
--
ALTER TABLE `blog_blog_category`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `blog_blog_tag`
--
ALTER TABLE `blog_blog_tag`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `blog_page_infos`
--
ALTER TABLE `blog_page_infos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blog_tags`
--
ALTER TABLE `blog_tags`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `client_logos`
--
ALTER TABLE `client_logos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `contact_page_infos`
--
ALTER TABLE `contact_page_infos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `course_categories`
--
ALTER TABLE `course_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `course_course_category`
--
ALTER TABLE `course_course_category`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `course_page_infos`
--
ALTER TABLE `course_page_infos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `emergency_contacts`
--
ALTER TABLE `emergency_contacts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `faq_page_infos`
--
ALTER TABLE `faq_page_infos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `footer_page_infos`
--
ALTER TABLE `footer_page_infos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `home_page_infos`
--
ALTER TABLE `home_page_infos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `lesson_classes`
--
ALTER TABLE `lesson_classes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lesson_class_days`
--
ALTER TABLE `lesson_class_days`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `navbar_page_infos`
--
ALTER TABLE `navbar_page_infos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product_attributes`
--
ALTER TABLE `product_attributes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_attribute_values`
--
ALTER TABLE `product_attribute_values`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_product_category`
--
ALTER TABLE `product_product_category`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `product_variant_attribute_value`
--
ALTER TABLE `product_variant_attribute_value`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `shop_page_infos`
--
ALTER TABLE `shop_page_infos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sitemap_entries`
--
ALTER TABLE `sitemap_entries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `slider_items`
--
ALTER TABLE `slider_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `student_guardians`
--
ALTER TABLE `student_guardians`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `student_payments`
--
ALTER TABLE `student_payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `student_payments_installments`
--
ALTER TABLE `student_payments_installments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=397;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `teacher_page_infos`
--
ALTER TABLE `teacher_page_infos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog_blog_category`
--
ALTER TABLE `blog_blog_category`
  ADD CONSTRAINT `blog_blog_category_blog_category_id_foreign` FOREIGN KEY (`blog_category_id`) REFERENCES `blog_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `blog_blog_category_blog_id_foreign` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `blog_blog_tag`
--
ALTER TABLE `blog_blog_tag`
  ADD CONSTRAINT `blog_blog_tag_blog_id_foreign` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `blog_blog_tag_blog_tag_id_foreign` FOREIGN KEY (`blog_tag_id`) REFERENCES `blog_tags` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course_course_category`
--
ALTER TABLE `course_course_category`
  ADD CONSTRAINT `course_course_category_course_category_id_foreign` FOREIGN KEY (`course_category_id`) REFERENCES `course_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_course_category_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `emergency_contacts`
--
ALTER TABLE `emergency_contacts`
  ADD CONSTRAINT `emergency_contacts_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lesson_class_days`
--
ALTER TABLE `lesson_class_days`
  ADD CONSTRAINT `lesson_class_days_lesson_class_id_foreign` FOREIGN KEY (`lesson_class_id`) REFERENCES `lesson_classes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD CONSTRAINT `menu_items_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `menu_items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `order_items_product_variant_id_foreign` FOREIGN KEY (`product_variant_id`) REFERENCES `product_variants` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `product_attribute_values`
--
ALTER TABLE `product_attribute_values`
  ADD CONSTRAINT `product_attribute_values_product_attribute_id_foreign` FOREIGN KEY (`product_attribute_id`) REFERENCES `product_attributes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_product_category`
--
ALTER TABLE `product_product_category`
  ADD CONSTRAINT `product_product_category_product_category_id_foreign` FOREIGN KEY (`product_category_id`) REFERENCES `product_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_product_category_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD CONSTRAINT `product_variants_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_variant_attribute_value`
--
ALTER TABLE `product_variant_attribute_value`
  ADD CONSTRAINT `pvav_attr_value_fk` FOREIGN KEY (`product_attribute_value_id`) REFERENCES `product_attribute_values` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pvav_variant_fk` FOREIGN KEY (`product_variant_id`) REFERENCES `product_variants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `slider_items`
--
ALTER TABLE `slider_items`
  ADD CONSTRAINT `slider_items_slider_id_foreign` FOREIGN KEY (`slider_id`) REFERENCES `sliders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `lesson_classes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_guardians`
--
ALTER TABLE `student_guardians`
  ADD CONSTRAINT `student_guardians_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_payments`
--
ALTER TABLE `student_payments`
  ADD CONSTRAINT `student_payments_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `lesson_classes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_payments_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_payments_installments`
--
ALTER TABLE `student_payments_installments`
  ADD CONSTRAINT `student_payments_installments_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_payments_installments_student_payment_id_foreign` FOREIGN KEY (`student_payment_id`) REFERENCES `student_payments` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
