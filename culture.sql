-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2025 at 01:41 AM
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
-- Database: `culture`
--

-- --------------------------------------------------------

--
-- Table structure for table `achats`
--

CREATE TABLE `achats` (
  `id_achat` bigint(20) UNSIGNED NOT NULL,
  `id_utilisateur` bigint(20) UNSIGNED NOT NULL,
  `type_item` enum('contenu','media') NOT NULL,
  `id_item` bigint(20) UNSIGNED NOT NULL,
  `montant` decimal(10,2) NOT NULL,
  `devise` varchar(10) NOT NULL DEFAULT 'FCFA',
  `statut` enum('en_attente','complété','échoué','annulé') NOT NULL DEFAULT 'en_attente',
  `reference_paiement` varchar(100) NOT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `date_paiement` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `commentaires`
--

CREATE TABLE `commentaires` (
  `id_commentaire` bigint(20) UNSIGNED NOT NULL,
  `texte` text NOT NULL,
  `date` date NOT NULL DEFAULT '2025-11-21',
  `note` int(11) DEFAULT NULL,
  `id_utilisateur` bigint(20) UNSIGNED DEFAULT NULL,
  `id_contenu` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `commentaires`
--

INSERT INTO `commentaires` (`id_commentaire`, `texte`, `date`, `note`, `id_utilisateur`, `id_contenu`, `created_at`, `updated_at`) VALUES
(1, 'Jaime se contenu quie nous parle des riche de l\'afrique .', '2025-12-01', 5, 1, 2, '2025-12-01 13:30:47', '2025-12-01 13:30:47'),
(2, 'Jaime se contenu quie nous parle des riche de l\'afrique .', '2025-12-01', 5, 1, 2, '2025-12-01 13:35:14', '2025-12-01 13:35:14'),
(3, 'Jaime se contenu quie nous parle des riche de l\'afrique .', '2025-12-01', 5, 1, 2, '2025-12-01 13:37:34', '2025-12-01 13:37:34');

-- --------------------------------------------------------

--
-- Table structure for table `contenus`
--

CREATE TABLE `contenus` (
  `id_contenu` bigint(20) UNSIGNED NOT NULL,
  `titre` varchar(255) NOT NULL,
  `id_type_contenu` bigint(20) UNSIGNED NOT NULL,
  `id_auteur` bigint(20) UNSIGNED NOT NULL,
  `id_region` bigint(20) UNSIGNED NOT NULL,
  `id_langue` bigint(20) UNSIGNED NOT NULL,
  `id_parent` bigint(20) UNSIGNED DEFAULT NULL,
  `id_moderateur` bigint(20) UNSIGNED DEFAULT NULL,
  `texte` text DEFAULT NULL,
  `date_creation` date NOT NULL DEFAULT '2025-11-21',
  `statut` enum('brouillon','en_attente','publie','rejete') NOT NULL DEFAULT 'brouillon',
  `date_validation` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contenus`
--

INSERT INTO `contenus` (`id_contenu`, `titre`, `id_type_contenu`, `id_auteur`, `id_region`, `id_langue`, `id_parent`, `id_moderateur`, `texte`, `date_creation`, `statut`, `date_validation`, `created_at`, `updated_at`) VALUES
(2, 'La Richesse Culturelle de l\'Afrique de l\'Ouest : Un Héritage Méconnu', 1, 1, 2, 2, NULL, NULL, 'L\'Afrique de l\'Ouest est un creuset de cultures, de langues et de traditions. Des masques sacrés des Dogons aux cités anciennes de Djenné, cet article explore la profondeur de cet héritage...', '2025-11-24', 'publie', '2025-11-24', '2025-11-24 06:47:52', '2025-11-24 08:44:53'),
(3, 'Le Trésor Royal d\'Abomey : Histoire des Rois et des Amazones', 1, 3, 16, 2, NULL, NULL, '<b>L\'Émergence du Dahomey et la Stratégie Militaire</b> : Le royaume, fondé au début du XVIIe siècle par le roi Houegbadja, s\'est rapidement imposé par sa stratégie militaire agressive et sa capacité à centraliser le pouvoir. L\'une des innovations les plus marquantes fut la création du corps des \"Mino\" ou Amazones. Leur rôle n\'était pas seulement symbolique ; elles constituaient une force de frappe redoutable et disciplinée. L\'article complet décortique l\'organisation sociétale et militaire qui a permis au Dahomey de dominer le commerce régional, y compris la traite négrière, et comment cette puissance s\'est confrontée aux puissances coloniales françaises au XIXe siècle. Nous analysons les règnes des figures clés comme Ghézo et Béhanzin, et l\'impact de l\'incendie du palais, un acte de résistance symbolique, qui a marqué la fin de l\'indépendance du royaume. Cet héritage, préservé aujourd\'hui par les efforts de restauration et de documentation, révèle une complexité politique et culturelle souvent simplifiée dans les récits populaires.', '2025-12-08', 'publie', '2025-12-08', '2025-12-08 09:46:09', '2025-12-08 09:47:05');

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
-- Table structure for table `langues`
--

CREATE TABLE `langues` (
  `id_langue` bigint(20) UNSIGNED NOT NULL,
  `nom_langue` varchar(100) NOT NULL,
  `code_langue` varchar(5) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `langues`
--

INSERT INTO `langues` (`id_langue`, `nom_langue`, `code_langue`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Fon', 'Fon', 'Description de la langue fon', '2025-11-21 23:22:57', '2025-11-21 23:22:57'),
(2, 'Français', 'fr', 'Langue romane parlée en France, en Europe, et dans plusieurs pays africains.\r\nUtilisée comme langue officielle dans de nombreuses institutions internationales.', '2025-11-23 23:33:08', '2025-11-23 23:33:08'),
(3, 'Yoruba', 'yo', 'Langue nigéro-congolaise parlée principalement au Nigéria, au Bénin et au Togo.\r\nRiche en tonalités et très présente dans les pratiques culturelles et religieuses.', '2025-11-23 23:36:34', '2025-11-23 23:36:34'),
(4, 'goun', 'gou', 'Description de la langue goun', '2025-11-23 23:37:38', '2025-11-23 23:37:38'),
(5, 'Adja', 'aja', 'Langue majoritairement parlée dans le Couffo et le Mono.', '2025-12-08 06:48:40', '2025-12-08 06:48:40'),
(6, 'Bariba', 'bba', 'Langue dominante dans le Borgou, au nord-est.', '2025-12-08 06:48:40', '2025-12-08 06:48:40'),
(7, 'Dendi', 'den', 'Langue commerciale et culturelle du nord (Alibori).', '2025-12-08 06:48:40', '2025-12-08 06:48:40'),
(8, 'Mahi', 'mhi', 'Langue du centre du Bénin (Collines).', '2025-12-08 06:48:40', '2025-12-08 06:48:40'),
(9, 'Mina', 'min', 'Langue côtière, souvent confondue avec le Goun.', '2025-12-08 06:48:40', '2025-12-08 06:48:40'),
(10, 'Biali (Biyobe)', 'biali', 'Langue parlée dans l\'Atacora.', '2025-12-08 06:48:40', '2025-12-08 06:48:40');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id_media` bigint(20) UNSIGNED NOT NULL,
  `id_type_media` bigint(20) UNSIGNED NOT NULL,
  `Chemin` varchar(255) NOT NULL,
  `nom_fichier` varchar(255) DEFAULT NULL,
  `titre` varchar(255) DEFAULT NULL,
  `largeur` int(11) DEFAULT NULL,
  `hauteur` int(11) DEFAULT NULL,
  `duree` int(11) DEFAULT NULL COMMENT 'Durée en secondes pour vidéo/audio',
  `taille_fichier` bigint(20) DEFAULT NULL COMMENT 'Taille en bytes',
  `mime_type` varchar(255) DEFAULT NULL,
  `extension` varchar(10) DEFAULT NULL,
  `is_premium` tinyint(1) NOT NULL DEFAULT 0,
  `prix` decimal(8,2) DEFAULT NULL,
  `resolution` varchar(255) DEFAULT NULL COMMENT 'Ex: 1920x1080, 4K, HD',
  `auteur_original` varchar(255) DEFAULT NULL,
  `copyright` varchar(255) DEFAULT NULL,
  `tags` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`tags`)),
  `is_valide` tinyint(1) NOT NULL DEFAULT 1,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_utilisateur` bigint(20) UNSIGNED NOT NULL,
  `id_contenu` bigint(20) UNSIGNED DEFAULT NULL,
  `statut` enum('actif','inactif','en_attente') NOT NULL DEFAULT 'actif',
  `downloads` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id_media`, `id_type_media`, `Chemin`, `nom_fichier`, `titre`, `largeur`, `hauteur`, `duree`, `taille_fichier`, `mime_type`, `extension`, `is_premium`, `prix`, `resolution`, `auteur_original`, `copyright`, `tags`, `is_valide`, `description`, `created_at`, `updated_at`, `id_utilisateur`, `id_contenu`, `statut`, `downloads`) VALUES
(1, 2, '\"C:\\xampp82\\htdocs\\Culture\\public\\storage\\medias\\téléchargement.jpeg\"', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 1, 'Fête de la Gani\" Nikki - Bénin Culture/ traditions - Vie traditionnelle', '2025-11-24 07:25:53', '2025-11-24 08:11:22', 0, NULL, 'actif', 0),
(2, 2, 'medias/images/BYnSNdKCVOuKbVcpewUOeJgYuszlIde5O7KX79hP.png', 'piclumen-1765189331125.png', 'Histoire du Royaume du Dahomey', 1344, 768, NULL, 1918103, 'image/png', 'png', 0, 100.00, '1344x768', 'SALAOU', NULL, '[]', 1, 'Aucune', '2025-12-10 10:24:02', '2025-12-10 10:24:02', 3, 3, 'actif', 0),
(3, 3, 'medias/vidéos/eN9N5L6X9gWF1nZGkqEKG9RcHtFZ3wJrjEoWRDfp.mp4', 'video_2025-12-10_22-42-54.mp4', 'Vaudou Bénin', NULL, NULL, NULL, 3923866, 'video/mp4', 'mp4', 0, 200.00, NULL, 'SALAOU', NULL, '[\"art\",\"culture\",\"benin\"]', 1, 'Aucune', '2025-12-10 20:49:29', '2025-12-10 20:49:29', 3, NULL, 'actif', 0);

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
(4, '2025_11_20_150516_create_roles_table', 1),
(5, '2025_11_20_151033_create_langues_table', 1),
(6, '2025_11_20_151224_create_regions_table', 1),
(7, '2025_11_20_151411_create_type_contenus_table', 1),
(8, '2025_11_20_151553_create_type_medias_table', 1),
(9, '2025_11_20_151912_create_utilisateurs_table', 1),
(10, '2025_11_20_152208_create_contenus_table', 1),
(11, '2025_11_20_152538_create_media_table', 1),
(12, '2025_11_20_153815_create_parler_table', 1),
(13, '2025_11_20_154409_create_commentaires_table', 1),
(14, '2025_11_23_203136_add_details_to_type_contenus_table', 2),
(15, '2025_11_23_235408_create_personal_access_tokens_table', 3),
(16, '2025_11_24_004334_change_statut_column_type_on_utilisateurs_table', 4),
(17, '2025_11_24_074621_change_statut_column_type_on_contenus_table', 5),
(18, '2025_11_26_020051_add_two_factor_columns_to_users_table', 6),
(19, '2025_11_26_031451_add_two_factor_columns_to_utilisateurs_table', 7),
(20, '2025_11_30_025216_add_id_utilisateur_to_media_table', 8),
(21, '2025_12_03_150953_create_achats_table', 8),
(22, '2025_12_09_090616_add_id_contenu_to_media_table', 9),
(23, '2025_12_10_082856_add_media_attributes_to_media_table', 10),
(24, '2025_12_10_111904_add_nom_fichier_and_statut_to_media_table', 11),
(25, '2025_12_10_112301_add_downloads_to_media_table', 12);

-- --------------------------------------------------------

--
-- Table structure for table `parler`
--

CREATE TABLE `parler` (
  `id_region` bigint(20) UNSIGNED NOT NULL,
  `id_langue` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id_region` bigint(20) UNSIGNED NOT NULL,
  `nom_region` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `population` bigint(20) UNSIGNED DEFAULT NULL,
  `superficie` decimal(10,2) DEFAULT NULL,
  `localisation` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id_region`, `nom_region`, `description`, `population`, `superficie`, `localisation`, `created_at`, `updated_at`) VALUES
(1, 'Cotonou', 'Capital économique du Bénin', 758000, 79.00, 'Lac Nokoué au nord – L’océan Atlantique au sud', '2025-11-23 17:33:51', '2025-11-23 23:16:53'),
(2, 'Parakou', 'Parakou est la grande ville stratégique du nord, un hub commercial vital entre le sud du Bénin et les pays sahéliens. C’est une ville dynamique, très animée, connue pour son marché “Arzèkè” et sa culture Bariba.', 255000, 441.00, 'Nord-est du Bénin, département du Borgou.', '2025-11-23 23:18:32', '2025-11-23 23:18:32'),
(3, 'Bohicon', 'Bohicon est la ville-carrefour du centre, hyper active grâce à son grand marché et son trafic routier. On y trouve une ambiance commerciale forte, un mélange de traditions fon et de modernité.', 150000, 44.00, 'Centre du Bénin, département du Zou, juste à côté d’Abomey.', '2025-11-23 23:19:46', '2025-11-23 23:19:46'),
(4, 'Natitingou', 'Natitingou est une ville montagneuse, culturelle, respirant la tradition Somba. Elle est aussi la porte d’entrée des sites touristiques naturels et du parc animalier Pendjari.', 130000, 3045.00, 'Nord-ouest du Bénin, département de l’Atacora, proche des montagnes et du parc Pendjari.', '2025-11-23 23:21:08', '2025-11-23 23:21:08'),
(5, 'Alibori', 'Département du nord-est, frontalier avec le Niger.', 867463, 26242.00, 'Nord-Est', '2025-12-08 06:48:40', '2025-12-08 06:48:40'),
(6, 'Atacora', 'Région montagneuse du nord-ouest, abritant les Tata Somba.', 841242, 20499.00, 'Nord-Ouest', '2025-12-08 06:48:40', '2025-12-08 06:48:40'),
(7, 'Atlantique', 'Zone péri-urbaine autour de Cotonou.', 1406502, 3233.00, 'Sud', '2025-12-08 06:48:40', '2025-12-08 06:48:40'),
(8, 'Borgou', 'Département central et nordique, avec Parakou comme capitale.', 1214249, 25856.00, 'Centre-Nord', '2025-12-08 06:48:40', '2025-12-08 06:48:40'),
(9, 'Collines', 'Région du centre-sud, connue pour ses collines et sa culture Mahi.', 952303, 13931.00, 'Centre', '2025-12-08 06:48:40', '2025-12-08 06:48:40'),
(10, 'Couffo', 'Petit département du sud-ouest, riche en culture Adja.', 745863, 2404.00, 'Sud-Ouest', '2025-12-08 06:48:40', '2025-12-08 06:48:40'),
(11, 'Donga', 'Région du nord-ouest, avec Djougou comme centre urbain.', 543130, 11126.00, 'Nord', '2025-12-08 06:48:40', '2025-12-08 06:48:40'),
(12, 'Littoral', 'Le plus petit département, abritant la capitale économique Cotonou.', 678852, 79.00, 'Côtier', '2025-12-08 06:48:40', '2025-12-08 06:48:40'),
(13, 'Mono', 'Région côtière du sud-ouest.', 495405, 1605.00, 'Sud-Ouest', '2025-12-08 06:48:40', '2025-12-08 06:48:40'),
(14, 'Ouémé', 'Région du sud-est, avec Porto-Novo comme capitale politique.', 1357605, 2814.00, 'Sud-Est', '2025-12-08 06:48:40', '2025-12-08 06:48:40'),
(15, 'Plateau', 'Région du sud-est, culture Yoruba et Nago.', 716766, 3264.00, 'Sud-Est', '2025-12-08 06:48:40', '2025-12-08 06:48:40'),
(16, 'Zou', 'Région centrale, fief historique du royaume d\'Abomey.', 851966, 5243.00, 'Centre', '2025-12-08 06:48:40', '2025-12-08 06:48:40');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id_role` bigint(20) UNSIGNED NOT NULL,
  `nom_role` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id_role`, `nom_role`, `created_at`, `updated_at`) VALUES
(1, 'Utilisateur', '2025-11-23 16:55:28', '2025-11-23 16:55:28'),
(2, 'Admin', '2025-11-23 23:00:47', '2025-11-23 23:00:47'),
(3, 'Editeur', '2025-11-23 23:01:15', '2025-11-23 23:01:15'),
(4, 'Modérateur', '2025-11-23 23:01:49', '2025-11-23 23:01:49'),
(5, 'Manager', '2025-11-24 09:57:08', '2025-11-24 09:57:08'),
(6, 'Manager', '2025-12-08 06:43:50', '2025-12-08 06:43:50');

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
('VK6SOHoGQ8UclfKHtCbwXUqlffcsKsMwZoTHDEzG', 3, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.6261.95 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiYXFTb083NTJObEEwS1RUaFU5RGpobGQwcTM3OUk5QmNzZmtieEt3dCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjQ3OiJodHRwOi8vbG9jYWxob3N0L0N1bHR1cmUvcHVibGljL3VzZXIvY29udGVudXMvMyI7czo1OiJyb3V0ZSI7czoxODoidXNlci5jb250ZW51cy5zaG93Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mzt9', 1765413575);

-- --------------------------------------------------------

--
-- Table structure for table `type_contenus`
--

CREATE TABLE `type_contenus` (
  `id_type` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(50) NOT NULL,
  `slug` varchar(120) NOT NULL,
  `icone_css` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `type_contenus`
--

INSERT INTO `type_contenus` (`id_type`, `nom`, `slug`, `icone_css`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Article Détaillé', 'article', 'bi bi-file-earmark-text', 'Contenu textuel long et structuré : essai, analyse historique ou mythe.', '2025-12-08 07:05:17', '2025-12-08 07:05:17'),
(2, 'Documentaire Vidéo', 'video', 'bi bi-camera-video', 'Contenu dont le média principal est une vidéo (interview, performance, documentaire).', '2025-12-08 07:05:17', '2025-12-08 07:05:17'),
(3, 'Recette de Cuisine', 'recette', 'bi bi-egg-fried', 'Format structuré dédié aux recettes traditionnelles (ingrédients, étapes, temps de préparation).', '2025-12-08 07:05:17', '2025-12-08 07:05:17'),
(4, 'Fichier Audio', 'audio', 'bi bi-music-note-list', 'Contenu dont le média principal est un enregistrement sonore (conte oral, musique rituelle).', '2025-12-08 07:05:17', '2025-12-08 07:05:17'),
(5, 'Lieu Historique/Site', 'site', 'bi bi-pin-map', 'Fiche détaillée sur un lieu (musée, temple, village), avec informations géographiques.', '2025-12-08 07:05:17', '2025-12-08 07:05:17'),
(6, 'Biographie/Portrait', 'portrait', 'bi bi-person-badge', 'Fiche biographique centrée sur une figure importante du patrimoine béninois.', '2025-12-08 07:05:17', '2025-12-08 07:05:17'),
(7, 'Rapport/Archive PDF', 'rapport', 'bi bi-file-pdf', 'Document volumineux destiné à être téléchargé ou consulté en ligne.', '2025-12-08 07:05:17', '2025-12-08 07:05:17');

-- --------------------------------------------------------

--
-- Table structure for table `type_medias`
--

CREATE TABLE `type_medias` (
  `id_type` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `type_medias`
--

INSERT INTO `type_medias` (`id_type`, `nom`, `created_at`, `updated_at`) VALUES
(1, 'pdf', '2025-11-24 00:03:53', '2025-11-24 00:03:53'),
(2, 'Image', '2025-11-24 00:04:19', '2025-11-24 00:04:19'),
(3, 'Vidéo', '2025-11-24 00:04:37', '2025-11-24 00:04:37'),
(4, 'Audio', '2025-11-24 00:05:07', '2025-11-24 00:05:07');

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
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id_utilisateur` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `id_role` bigint(20) UNSIGNED NOT NULL,
  `sexe` char(1) DEFAULT NULL,
  `id_langue` bigint(20) UNSIGNED DEFAULT NULL,
  `date_inscription` date NOT NULL DEFAULT '2025-11-21',
  `date_naissance` date DEFAULT NULL,
  `statut` enum('actif','inactif','suspendu') NOT NULL DEFAULT 'inactif',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_utilisateur`, `nom`, `prenom`, `email`, `mot_de_passe`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `id_role`, `sexe`, `id_langue`, `date_inscription`, `date_naissance`, `statut`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'SALAOU', 'souleyman', 'souleymansalaou5@gmail.com', '$2y$12$CR60kpJ1s81G5dgeFOoHueU3/iT9PuUJl0EzztWbvQMBLBrBcJXXu', '3AERGYVN4D6BEGHQ5WIKNJRID3XFQU2D', '[\"66460f1b68\",\"f6cd4db482\",\"3cd2fa709e\",\"18dda5ba25\",\"ef439e19c9\",\"58e89d75c3\",\"da226bbe0e\",\"befe18e1c6\"]', '2025-11-26 05:29:37', 2, 'M', 3, '2025-11-24', '2004-05-12', 'actif', 'SvaEL2iJ06SzkWDlZwwz8EaHltduQGxjrYUN9OgBxZu8mAaiE1pnTGVqKFxW', '2025-11-23 23:44:42', '2025-11-26 05:32:18'),
(2, 'Comlan', 'Maurice', 'maurice.comlan@uac.bj', '$2y$12$eZn2i7BN5shLFnZF8vySvO28aO./sIHGKg/Q29d39Tzd.pyxc9fi6', NULL, NULL, NULL, 2, 'M', 2, '2025-11-26', '1111-01-01', 'actif', NULL, '2025-11-26 08:16:09', '2025-11-26 09:26:40'),
(3, 'salaou', 'akorede', 'akoredesalaou278@gmail.com', '$2y$12$xB1YVaPcXkIgkB5qjYJxzeUgTGrisfET3ZyL.33/H61tj4JCPraRe', 'XHB25YIEBNEJPE4IULACN4NOJ3XSEYN3', NULL, '2025-12-05 08:25:52', 1, 'A', 2, '2025-11-30', NULL, 'actif', NULL, '2025-11-30 01:16:09', '2025-12-05 20:41:31'),
(4, 'salaou', 'soule', 'salaousouleyman511@gmail.com', '$2y$12$Pt3whiFs2RD5gdeIgdNP/uUdjf5ERMOKEmDmoe886J385exKdd7p6', NULL, NULL, NULL, 1, 'A', NULL, '2025-12-08', NULL, 'actif', NULL, '2025-12-08 09:54:25', '2025-12-08 09:54:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `achats`
--
ALTER TABLE `achats`
  ADD PRIMARY KEY (`id_achat`),
  ADD UNIQUE KEY `achats_reference_paiement_unique` (`reference_paiement`),
  ADD KEY `achats_id_utilisateur_type_item_id_item_index` (`id_utilisateur`,`type_item`,`id_item`),
  ADD KEY `achats_reference_paiement_index` (`reference_paiement`),
  ADD KEY `achats_transaction_id_index` (`transaction_id`),
  ADD KEY `achats_statut_date_paiement_index` (`statut`,`date_paiement`);

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
-- Indexes for table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id_commentaire`),
  ADD KEY `commentaires_id_utilisateur_foreign` (`id_utilisateur`),
  ADD KEY `commentaires_id_contenu_foreign` (`id_contenu`);

--
-- Indexes for table `contenus`
--
ALTER TABLE `contenus`
  ADD PRIMARY KEY (`id_contenu`),
  ADD KEY `contenus_id_type_contenu_foreign` (`id_type_contenu`),
  ADD KEY `contenus_id_auteur_foreign` (`id_auteur`),
  ADD KEY `contenus_id_region_foreign` (`id_region`),
  ADD KEY `contenus_id_langue_foreign` (`id_langue`),
  ADD KEY `contenus_id_parent_foreign` (`id_parent`),
  ADD KEY `contenus_id_moderateur_foreign` (`id_moderateur`);

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
-- Indexes for table `langues`
--
ALTER TABLE `langues`
  ADD PRIMARY KEY (`id_langue`),
  ADD UNIQUE KEY `langues_nom_langue_unique` (`nom_langue`),
  ADD UNIQUE KEY `langues_code_langue_unique` (`code_langue`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id_media`),
  ADD KEY `media_id_type_media_foreign` (`id_type_media`),
  ADD KEY `media_id_contenu_foreign` (`id_contenu`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parler`
--
ALTER TABLE `parler`
  ADD PRIMARY KEY (`id_region`,`id_langue`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id_region`),
  ADD UNIQUE KEY `regions_nom_region_unique` (`nom_region`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `type_contenus`
--
ALTER TABLE `type_contenus`
  ADD PRIMARY KEY (`id_type`),
  ADD UNIQUE KEY `type_contenus_nom_unique` (`nom`),
  ADD UNIQUE KEY `type_contenus_slug_unique` (`slug`);

--
-- Indexes for table `type_medias`
--
ALTER TABLE `type_medias`
  ADD PRIMARY KEY (`id_type`),
  ADD UNIQUE KEY `type_medias_nom_unique` (`nom`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id_utilisateur`),
  ADD UNIQUE KEY `utilisateurs_email_unique` (`email`),
  ADD KEY `utilisateurs_id_role_foreign` (`id_role`),
  ADD KEY `utilisateurs_id_langue_foreign` (`id_langue`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `achats`
--
ALTER TABLE `achats`
  MODIFY `id_achat` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id_commentaire` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contenus`
--
ALTER TABLE `contenus`
  MODIFY `id_contenu` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- AUTO_INCREMENT for table `langues`
--
ALTER TABLE `langues`
  MODIFY `id_langue` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id_media` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id_region` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id_role` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `type_contenus`
--
ALTER TABLE `type_contenus`
  MODIFY `id_type` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `type_medias`
--
ALTER TABLE `type_medias`
  MODIFY `id_type` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id_utilisateur` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `achats`
--
ALTER TABLE `achats`
  ADD CONSTRAINT `achats_id_utilisateur_foreign` FOREIGN KEY (`id_utilisateur`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `commentaires_id_contenu_foreign` FOREIGN KEY (`id_contenu`) REFERENCES `contenus` (`id_contenu`) ON DELETE CASCADE,
  ADD CONSTRAINT `commentaires_id_utilisateur_foreign` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`) ON DELETE SET NULL;

--
-- Constraints for table `contenus`
--
ALTER TABLE `contenus`
  ADD CONSTRAINT `contenus_id_auteur_foreign` FOREIGN KEY (`id_auteur`) REFERENCES `utilisateurs` (`id_utilisateur`),
  ADD CONSTRAINT `contenus_id_langue_foreign` FOREIGN KEY (`id_langue`) REFERENCES `langues` (`id_langue`),
  ADD CONSTRAINT `contenus_id_moderateur_foreign` FOREIGN KEY (`id_moderateur`) REFERENCES `utilisateurs` (`id_utilisateur`) ON DELETE SET NULL,
  ADD CONSTRAINT `contenus_id_parent_foreign` FOREIGN KEY (`id_parent`) REFERENCES `contenus` (`id_contenu`) ON DELETE SET NULL,
  ADD CONSTRAINT `contenus_id_region_foreign` FOREIGN KEY (`id_region`) REFERENCES `regions` (`id_region`),
  ADD CONSTRAINT `contenus_id_type_contenu_foreign` FOREIGN KEY (`id_type_contenu`) REFERENCES `type_contenus` (`id_type`);

--
-- Constraints for table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_id_contenu_foreign` FOREIGN KEY (`id_contenu`) REFERENCES `contenus` (`id_contenu`) ON DELETE SET NULL,
  ADD CONSTRAINT `media_id_type_media_foreign` FOREIGN KEY (`id_type_media`) REFERENCES `type_medias` (`id_type`);

--
-- Constraints for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD CONSTRAINT `utilisateurs_id_langue_foreign` FOREIGN KEY (`id_langue`) REFERENCES `langues` (`id_langue`) ON DELETE SET NULL,
  ADD CONSTRAINT `utilisateurs_id_role_foreign` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id_role`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
