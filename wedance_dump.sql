-- MySQL dump 10.13  Distrib 5.7.39, for osx10.12 (x86_64)
--
-- Host: 127.0.0.1    Database: wedance
-- ------------------------------------------------------
-- Server version	5.7.39

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `wedance_blog_posts`
--

DROP TABLE IF EXISTS `wedance_blog_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wedance_blog_posts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `wedance_blog_posts_slug_unique` (`slug`),
  KEY `wedance_blog_posts_author_id_foreign` (`author_id`),
  CONSTRAINT `wedance_blog_posts_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `wedance_users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wedance_blog_posts`
--

LOCK TABLES `wedance_blog_posts` WRITE;
/*!40000 ALTER TABLE `wedance_blog_posts` DISABLE KEYS */;
INSERT INTO `wedance_blog_posts` VALUES (1,'Découvrez la passion de la Bachata','<p>La bachata est bien plus qu\'une simple danse : c\'est une véritable expérience sensorielle. Originaire de la République dominicaine, cette danse a conquis les cœurs à travers le monde grâce à sa musicalité envoûtante et ses mouvements sensuels.</p>\n\n<p>Au fil des années, la bachata a évolué, passant des ruelles de Saint-Domingue aux studios de danse modernes. Elle se décline aujourd’hui en plusieurs styles : traditionnelle, moderne et sensual, chacun offrant une expérience unique.</p>\n\n<p>Pour progresser en bachata, la régularité est la clé. Prendre des cours avec un professeur expérimenté, danser avec différents partenaires et écouter beaucoup de musique sont autant de façons de s\'améliorer rapidement. Ne soyez pas intimidé : l’important est de se laisser porter par le rythme et de s’amuser !</p>','/images/blog/1.jpg',1,'2025-05-22 17:57:38','2025-05-22 17:57:38','decouvrez-la-passion-de-la-bachata'),(2,'Les bienfaits insoupçonnés de la Salsa','<p>Danser la salsa, c’est bien plus que s’amuser : c’est aussi un excellent moyen de rester en forme et de se sentir bien dans son corps. Grâce à ses mouvements dynamiques, la salsa permet de travailler l\'endurance, la coordination et le tonus musculaire.</p>\n\n<p>Au-delà des bienfaits physiques, la salsa est aussi bénéfique pour le moral. Elle permet de se socialiser, de vaincre la timidité et de gagner en confiance. De nombreux danseurs témoignent d’un réel changement dans leur vie personnelle grâce à cette pratique.</p>\n\n<p>Si vous cherchez une activité complète, joyeuse et accessible à tous, la salsa est faite pour vous. Alors n’attendez plus : chaussez vos chaussures de danse et rejoignez la piste !</p>','/images/blog/2.png',1,'2025-05-22 17:57:38','2025-05-22 17:57:38','les-bienfaits-insoupconnes-de-la-salsa'),(3,'Comment progresser rapidement en danse latine','<p>La progression en danse latine dépend de plusieurs facteurs clés. Le premier est la régularité : assister à des cours chaque semaine permet de consolider ses acquis et de développer sa technique progressivement.</p>\n\n<p>Le choix d’un bon partenaire est également essentiel. Avec quelqu’un de patient et à l’écoute, on apprend plus facilement à gérer la connexion et les déplacements.</p>\n\n<p>N’oubliez pas l’écoute musicale : elle vous aide à mieux anticiper les accents et à rendre votre danse plus fluide. Enfin, participer à des soirées est indispensable pour appliquer vos connaissances dans un contexte réel. La pratique, c’est ce qui fait toute la différence !</p>','/images/blog/3.jpg',1,'2025-05-22 17:57:38','2025-05-22 17:57:38','comment-progresser-rapidement-en-danse-latine'),(4,'Top 5 des musiques incontournables pour vos soirées Salsa','<p>Rien ne vaut une bonne playlist pour assurer l’ambiance d’une soirée salsa. Voici notre top 5 des musiques qui mettront tout le monde sur la piste :</p>\n\n<p><strong>1. Marc Anthony – Vivir Mi Vida :</strong> Un hymne à la joie de vivre, parfait pour démarrer la soirée.</p>\n<p><strong>2. Grupo Niche – Una Aventura :</strong> Ce classique colombien allie romantisme et rythme entraînant.</p>\n<p><strong>3. Héctor Lavoe – Periódico de Ayer :</strong> Un incontournable du répertoire salsa new-yorkaise.</p>\n<p><strong>4. Romeo Santos – Propuesta Indecente :</strong> Une touche de bachata fusionnée à la salsa pour varier les plaisirs.</p>\n<p><strong>5. La Maxima 79 – Salsa Italiana :</strong> Une preuve que la salsa est universelle !</p>\n\n<p>Ajoutez ces morceaux à votre playlist et laissez la magie opérer !</p>','/images/blog/4.jpg',1,'2025-05-22 17:57:38','2025-05-22 17:57:38','top-5-des-musiques-incontournables-pour-vos-soirees-salsa'),(5,'Zouk : l\'art de la connexion entre partenaires','<p>Le Zouk est une danse née aux Antilles, célèbre pour ses mouvements fluides et sa musicalité sensuelle. Contrairement à d’autres danses plus techniques, le Zouk met l’accent sur la connexion entre les partenaires, presque comme une conversation silencieuse.</p>\n\n<p>Cette connexion se crée grâce à des techniques précises : guidage subtil, placement du corps, et surtout écoute mutuelle. Le regard, la respiration et les micro-mouvements jouent un rôle central dans la communication non verbale.</p>\n\n<p>Pour progresser en Zouk, il est conseillé de travailler sa posture, sa souplesse et sa conscience corporelle. Participer à des stages, filmer ses danses, et prendre le temps d’analyser ses sensations sont des outils précieux pour ressentir pleinement la magie du Zouk.</p>','/images/blog/5.png',1,'2025-05-22 17:57:38','2025-05-22 17:57:38','zouk-lart-de-la-connexion-entre-partenaires');
/*!40000 ALTER TABLE `wedance_blog_posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wedance_cache`
--

DROP TABLE IF EXISTS `wedance_cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wedance_cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wedance_cache`
--

LOCK TABLES `wedance_cache` WRITE;
/*!40000 ALTER TABLE `wedance_cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `wedance_cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wedance_cache_locks`
--

DROP TABLE IF EXISTS `wedance_cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wedance_cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wedance_cache_locks`
--

LOCK TABLES `wedance_cache_locks` WRITE;
/*!40000 ALTER TABLE `wedance_cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `wedance_cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wedance_chat_messages`
--

DROP TABLE IF EXISTS `wedance_chat_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wedance_chat_messages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `chat_session_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `role` enum('user','assistant') COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `wedance_chat_messages_chat_session_id_foreign` (`chat_session_id`),
  KEY `wedance_chat_messages_user_id_foreign` (`user_id`),
  CONSTRAINT `wedance_chat_messages_chat_session_id_foreign` FOREIGN KEY (`chat_session_id`) REFERENCES `wedance_chat_sessions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `wedance_chat_messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `wedance_users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wedance_chat_messages`
--

LOCK TABLES `wedance_chat_messages` WRITE;
/*!40000 ALTER TABLE `wedance_chat_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `wedance_chat_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wedance_chat_sessions`
--

DROP TABLE IF EXISTS `wedance_chat_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wedance_chat_sessions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `wedance_chat_sessions_user_id_foreign` (`user_id`),
  CONSTRAINT `wedance_chat_sessions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `wedance_users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wedance_chat_sessions`
--

LOCK TABLES `wedance_chat_sessions` WRITE;
/*!40000 ALTER TABLE `wedance_chat_sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `wedance_chat_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wedance_comments`
--

DROP TABLE IF EXISTS `wedance_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wedance_comments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `commentable_id` bigint(20) unsigned NOT NULL,
  `commentable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `wedance_comments_user_id_foreign` (`user_id`),
  KEY `wedance_comments_commentable_type_commentable_id_index` (`commentable_type`,`commentable_id`),
  CONSTRAINT `wedance_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `wedance_users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wedance_comments`
--

LOCK TABLES `wedance_comments` WRITE;
/*!40000 ALTER TABLE `wedance_comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `wedance_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wedance_course_categories`
--

DROP TABLE IF EXISTS `wedance_course_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wedance_course_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `wedance_course_categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wedance_course_categories`
--

LOCK TABLES `wedance_course_categories` WRITE;
/*!40000 ALTER TABLE `wedance_course_categories` DISABLE KEYS */;
INSERT INTO `wedance_course_categories` VALUES (1,'Salsa','salsa','2025-05-22 17:57:38','2025-05-22 17:57:38'),(2,'Bachata','bachata','2025-05-22 17:57:38','2025-05-22 17:57:38'),(3,'Lindy Hop','lindy-hop','2025-05-22 17:57:38','2025-05-22 17:57:38'),(4,'Zouk','zouk','2025-05-22 17:57:38','2025-05-22 17:57:38'),(5,'Lady Styling','lady-styling','2025-05-22 17:57:38','2025-05-22 17:57:38');
/*!40000 ALTER TABLE `wedance_course_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wedance_course_levels`
--

DROP TABLE IF EXISTS `wedance_course_levels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wedance_course_levels` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `wedance_course_levels_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wedance_course_levels`
--

LOCK TABLES `wedance_course_levels` WRITE;
/*!40000 ALTER TABLE `wedance_course_levels` DISABLE KEYS */;
INSERT INTO `wedance_course_levels` VALUES (1,'Débutant','debutant','2025-05-22 17:57:38','2025-05-22 17:57:38'),(2,'Intermédiaire','intermediaire','2025-05-22 17:57:38','2025-05-22 17:57:38'),(3,'Avancé','avance','2025-05-22 17:57:38','2025-05-22 17:57:38');
/*!40000 ALTER TABLE `wedance_course_levels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wedance_courses`
--

DROP TABLE IF EXISTS `wedance_courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wedance_courses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price` decimal(8,2) NOT NULL,
  `duration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `day_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instructor_id` bigint(20) unsigned DEFAULT NULL,
  `course_category_id` bigint(20) unsigned DEFAULT NULL,
  `course_level_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `wedance_courses_course_category_id_foreign` (`course_category_id`),
  KEY `wedance_courses_course_level_id_foreign` (`course_level_id`),
  KEY `wedance_courses_instructor_id_foreign` (`instructor_id`),
  CONSTRAINT `wedance_courses_course_category_id_foreign` FOREIGN KEY (`course_category_id`) REFERENCES `wedance_course_categories` (`id`) ON DELETE SET NULL,
  CONSTRAINT `wedance_courses_course_level_id_foreign` FOREIGN KEY (`course_level_id`) REFERENCES `wedance_course_levels` (`id`) ON DELETE SET NULL,
  CONSTRAINT `wedance_courses_instructor_id_foreign` FOREIGN KEY (`instructor_id`) REFERENCES `wedance_users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wedance_courses`
--

LOCK TABLES `wedance_courses` WRITE;
/*!40000 ALTER TABLE `wedance_courses` DISABLE KEYS */;
INSERT INTO `wedance_courses` VALUES (1,'Salsa Débutant','Les bases de la salsa pour bien démarrer.',20.00,'2 heures','Lundi 18:00','salsa1.jpg',5,1,1,NULL,NULL),(2,'Salsa Intermédiaire','Améliorez votre style en salsa.',22.00,'2 heures','Mercredi 19:00','salsa2.jpg',6,1,2,NULL,NULL),(3,'Bachata Débutant','Cours de bachata pour débutants.',20.00,'1h30','Mardi 18:00','bachata1.jpg',7,2,1,NULL,NULL),(4,'Bachata Avancé','Techniques avancées de bachata.',25.00,'2 heures','Jeudi 20:00','bachata2.jpg',8,2,3,NULL,NULL),(5,'Lindy Hop Débutant','Danse swing pour les débutants.',18.00,'1h30','Mercredi 17:00','lindy1.jpg',9,3,1,NULL,NULL),(6,'Zouk Intermédiaire','Travail de fluidité et musicalité.',21.00,'2 heures','Lundi 19:30','zouk2.jpg',10,4,2,NULL,NULL),(7,'Lady Styling Avancé','Travail des isolations, posture et style.',23.00,'2 heures','Vendredi 20:00','lady1.jpg',11,5,3,NULL,NULL);
/*!40000 ALTER TABLE `wedance_courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wedance_events`
--

DROP TABLE IF EXISTS `wedance_events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wedance_events` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `date` datetime NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `organizer_id` bigint(20) unsigned DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `wedance_events_slug_unique` (`slug`),
  KEY `wedance_events_organizer_id_foreign` (`organizer_id`),
  CONSTRAINT `wedance_events_organizer_id_foreign` FOREIGN KEY (`organizer_id`) REFERENCES `wedance_users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wedance_events`
--

LOCK TABLES `wedance_events` WRITE;
/*!40000 ALTER TABLE `wedance_events` DISABLE KEYS */;
INSERT INTO `wedance_events` VALUES (1,'Soirée Bachata','Plongez dans l’univers envoûtant de la Bachata lors de cette soirée exceptionnelle ! Profitez d’un DJ Live qui vous fera vibrer sur les meilleurs morceaux de Bachata. L’ambiance chaleureuse et festive vous garantit une nuit inoubliable. Des animations de groupe, des démonstrations par des danseurs professionnels, ainsi que des surprises tout au long de la soirée vous attendent. Rejoignez la communauté des passionnés de danse dans l’un des plus beaux lieux de Bruxelles : l’Albert Hall. Dress code : élégant avec une touche latine. Préparez-vous à vivre une expérience unique où la danse et le plaisir seront à l’honneur.','2025-05-25 20:00:00','Albert Hall, Bruxelles',5,'events/soiree-bachata.jpg','soiree-bachata',NULL,NULL),(2,'Stage Salsa Intermédiaire','Ce stage intensif s’adresse aux danseurs et danseuses de niveau intermédiaire qui souhaitent perfectionner leur technique et enrichir leur style. Pendant plusieurs heures, vous aurez la chance d’apprendre avec des professeurs invités de renommée internationale. Le programme comprend : technique des tours, travail du style, musicalité, expression corporelle et connexion avec le partenaire. Des ateliers spécifiques et des séances de pratique vous permettront de progresser à votre rythme. Vivez une immersion totale dans l’univers de la salsa, dans le cadre convivial du Studio Mambo à Bruxelles. Réservez votre place rapidement car le nombre de participants est limité !','2025-06-10 18:30:00','Studio Mambo, Bruxelles',5,'events/stage-salsa.jpg','stage-salsa-intermediaire',NULL,NULL),(3,'Zouk Weekend','Le WEDANCE Loft ouvre ses portes pour un week-end 100% dédié au Zouk. Deux jours de pur bonheur avec des workshops intensifs animés par des artistes internationaux. Initiez-vous ou perfectionnez votre style dans un cadre unique et convivial. Au programme : techniques de guidage et de connexion, travail sur la fluidité des mouvements, musicalité et style personnel. Des soirées dansantes prolongeront l’expérience jusque tard dans la nuit avec DJ et ambiance de folie. De nombreuses animations, des démonstrations et des surprises rythmeront l’événement. Repas et boissons seront disponibles sur place pour un week-end inoubliable dédié à la danse et au partage.','2025-07-06 10:00:00','WEDANCE Loft',5,'events/zouk-weekend.jpg','zouk-weekend',NULL,NULL);
/*!40000 ALTER TABLE `wedance_events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wedance_failed_jobs`
--

DROP TABLE IF EXISTS `wedance_failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wedance_failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `wedance_failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wedance_failed_jobs`
--

LOCK TABLES `wedance_failed_jobs` WRITE;
/*!40000 ALTER TABLE `wedance_failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `wedance_failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wedance_gallery_media`
--

DROP TABLE IF EXISTS `wedance_gallery_media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wedance_gallery_media` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `wedance_gallery_media_event_id_foreign` (`event_id`),
  CONSTRAINT `wedance_gallery_media_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `wedance_events` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wedance_gallery_media`
--

LOCK TABLES `wedance_gallery_media` WRITE;
/*!40000 ALTER TABLE `wedance_gallery_media` DISABLE KEYS */;
INSERT INTO `wedance_gallery_media` VALUES (1,'Photo 1','/images/gallery/1.jpg',NULL,'2025-05-22 17:57:38','2025-05-22 17:57:38'),(2,'Photo 2','/images/gallery/2.jpg',NULL,'2025-05-22 17:57:38','2025-05-22 17:57:38'),(3,'Photo 3','/images/gallery/3.jpg',NULL,'2025-05-22 17:57:38','2025-05-22 17:57:38'),(4,'Photo 4','/images/gallery/4.jpg',NULL,'2025-05-22 17:57:38','2025-05-22 17:57:38'),(5,'Photo 5','/images/gallery/5.jpg',NULL,'2025-05-22 17:57:38','2025-05-22 17:57:38'),(6,'Photo 6','/images/gallery/6.jpg',NULL,'2025-05-22 17:57:38','2025-05-22 17:57:38'),(7,'Photo 7','/images/gallery/7.jpg',NULL,'2025-05-22 17:57:38','2025-05-22 17:57:38'),(8,'Photo 8','/images/gallery/8.jpg',NULL,'2025-05-22 17:57:38','2025-05-22 17:57:38'),(9,'Photo 9','/images/gallery/9.jpg',NULL,'2025-05-22 17:57:38','2025-05-22 17:57:38'),(10,'Photo 10','/images/gallery/10.jpg',NULL,'2025-05-22 17:57:38','2025-05-22 17:57:38'),(11,'Photo 11','/images/gallery/11.jpg',NULL,'2025-05-22 17:57:38','2025-05-22 17:57:38'),(12,'Photo 12','/images/gallery/12.jpg',NULL,'2025-05-22 17:57:38','2025-05-22 17:57:38');
/*!40000 ALTER TABLE `wedance_gallery_media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wedance_job_batches`
--

DROP TABLE IF EXISTS `wedance_job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wedance_job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wedance_job_batches`
--

LOCK TABLES `wedance_job_batches` WRITE;
/*!40000 ALTER TABLE `wedance_job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `wedance_job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wedance_jobs`
--

DROP TABLE IF EXISTS `wedance_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wedance_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `wedance_jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wedance_jobs`
--

LOCK TABLES `wedance_jobs` WRITE;
/*!40000 ALTER TABLE `wedance_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `wedance_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wedance_likes`
--

DROP TABLE IF EXISTS `wedance_likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wedance_likes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `likeable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `likeable_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `wedance_likes_user_id_likeable_id_likeable_type_unique` (`user_id`,`likeable_id`,`likeable_type`),
  KEY `wedance_likes_likeable_type_likeable_id_index` (`likeable_type`,`likeable_id`),
  CONSTRAINT `wedance_likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `wedance_users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wedance_likes`
--

LOCK TABLES `wedance_likes` WRITE;
/*!40000 ALTER TABLE `wedance_likes` DISABLE KEYS */;
/*!40000 ALTER TABLE `wedance_likes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wedance_messages`
--

DROP TABLE IF EXISTS `wedance_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wedance_messages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_id` bigint(20) unsigned DEFAULT NULL,
  `course_trial` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wedance_messages`
--

LOCK TABLES `wedance_messages` WRITE;
/*!40000 ALTER TABLE `wedance_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `wedance_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wedance_migrations`
--

DROP TABLE IF EXISTS `wedance_migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wedance_migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wedance_migrations`
--

LOCK TABLES `wedance_migrations` WRITE;
/*!40000 ALTER TABLE `wedance_migrations` DISABLE KEYS */;
INSERT INTO `wedance_migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2025_03_11_213427_add_two_factor_columns_to_users_table',1),(5,'2025_03_11_213447_create_personal_access_tokens_table',1),(6,'2025_03_15_204324_create_course_categories_table',1),(7,'2025_03_15_204333_create_course_levels_table',1),(8,'2025_03_19_190552_create_courses_table',1),(9,'2025_03_19_190602_create_events_table',1),(10,'2025_03_19_190611_create_blog_posts_table',1),(11,'2025_03_19_190719_create_testimonials_table',1),(12,'2025_03_19_190729_create_registrations_table',1),(13,'2025_03_19_190738_create_payments_table',1),(14,'2025_04_13_121905_create_team_members_table',1),(15,'2025_05_06_185944_create_gallery_media_table',1),(16,'2025_05_07_090642_create_comments_table',1),(17,'2025_05_07_093222_create_likes_table',1),(18,'2025_05_07_111440_create_messages_table',1),(19,'2025_05_10_065423_create_chat_sessions_table',1),(20,'2025_05_10_065436_create_chat_messages_table',1);
/*!40000 ALTER TABLE `wedance_migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wedance_password_reset_tokens`
--

DROP TABLE IF EXISTS `wedance_password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wedance_password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wedance_password_reset_tokens`
--

LOCK TABLES `wedance_password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `wedance_password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `wedance_password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wedance_payments`
--

DROP TABLE IF EXISTS `wedance_payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wedance_payments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `registration_id` bigint(20) unsigned NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `wedance_payments_user_id_foreign` (`user_id`),
  KEY `wedance_payments_registration_id_foreign` (`registration_id`),
  CONSTRAINT `wedance_payments_registration_id_foreign` FOREIGN KEY (`registration_id`) REFERENCES `wedance_registrations` (`id`) ON DELETE CASCADE,
  CONSTRAINT `wedance_payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `wedance_users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wedance_payments`
--

LOCK TABLES `wedance_payments` WRITE;
/*!40000 ALTER TABLE `wedance_payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `wedance_payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wedance_personal_access_tokens`
--

DROP TABLE IF EXISTS `wedance_personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wedance_personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `wedance_personal_access_tokens_token_unique` (`token`),
  KEY `wedance_personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wedance_personal_access_tokens`
--

LOCK TABLES `wedance_personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `wedance_personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `wedance_personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wedance_registrations`
--

DROP TABLE IF EXISTS `wedance_registrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wedance_registrations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `course_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `wedance_registrations_user_id_foreign` (`user_id`),
  KEY `wedance_registrations_course_id_foreign` (`course_id`),
  CONSTRAINT `wedance_registrations_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `wedance_courses` (`id`) ON DELETE CASCADE,
  CONSTRAINT `wedance_registrations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `wedance_users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wedance_registrations`
--

LOCK TABLES `wedance_registrations` WRITE;
/*!40000 ALTER TABLE `wedance_registrations` DISABLE KEYS */;
/*!40000 ALTER TABLE `wedance_registrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wedance_sessions`
--

DROP TABLE IF EXISTS `wedance_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wedance_sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `wedance_sessions_user_id_index` (`user_id`),
  KEY `wedance_sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wedance_sessions`
--

LOCK TABLES `wedance_sessions` WRITE;
/*!40000 ALTER TABLE `wedance_sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `wedance_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wedance_team_members`
--

DROP TABLE IF EXISTS `wedance_team_members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wedance_team_members` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quote` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `telegram_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vk_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `wedance_team_members_user_id_foreign` (`user_id`),
  CONSTRAINT `wedance_team_members_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `wedance_users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wedance_team_members`
--

LOCK TABLES `wedance_team_members` WRITE;
/*!40000 ALTER TABLE `wedance_team_members` DISABLE KEYS */;
INSERT INTO `wedance_team_members` VALUES (1,5,'Coach de salsa','/images/teams/kate-main.jpg','/images/teams/kate-avatar.png','La salsa, c\'est bien plus qu\'une danse, c\'est un langage universel.','Professeur de salsa, danseuse professionnelle avec plus de 5 ans d\'expérience. Allie technique et bonne humeur.','https://t.me/username','https://wa.me/32471234567','https://vk.com/kate_salsa','2025-05-22 17:57:38','2025-05-22 17:57:38'),(2,6,'Coach de bachata','/images/teams/eva-main.jpg','/images/teams/eva-avatar.png','Danser, c’est respirer autrement.','Spécialiste de la bachata moderne. Enseigne avec passion et patience tous les niveaux.','https://t.me/username','https://wa.me/32471234567','https://vk.com/kate_salsa','2025-05-22 17:57:38','2025-05-22 17:57:38'),(3,7,'Chorégraphe & animateur','/images/teams/leo-main.jpg','/images/teams/leo-avatar.png','Chaque pas est une émotion.','Ancien compétiteur international, Leo apporte une énergie incroyable à chaque atelier.','https://t.me/username','https://wa.me/32471234567','https://vk.com/kate_salsa','2025-05-22 17:57:38','2025-05-22 17:57:38'),(4,8,'Responsable des événements','/images/teams/sofia-main.jpg','/images/teams/sofia-avatar.png','Un bon événement est une danse bien menée.','Organisatrice hors pair, elle s’occupe des soirées et stages avec le sourire.','https://t.me/username','https://wa.me/32471234567','https://vk.com/kate_salsa','2025-05-22 17:57:38','2025-05-22 17:57:38'),(5,9,'Coach débutants','/images/teams/nina-main.jpg','/images/teams/nina-avatar.png','Chaque danse commence par un premier pas.','Excellente pédagogue, elle accompagne les nouveaux élèves avec douceur et rigueur.','https://t.me/username','https://wa.me/32471234567','https://vk.com/kate_salsa','2025-05-22 17:57:38','2025-05-22 17:57:38'),(6,10,'Coach lady styling','/images/teams/july-main.jpg','/images/teams/july-avatar.png','Le style, c’est l’attitude.','Elle enseigne l’élégance et la présence scénique dans chaque mouvement.','https://t.me/username','https://wa.me/32471234567','https://vk.com/kate_salsa','2025-05-22 17:57:38','2025-05-22 17:57:38'),(7,11,'Professeure de salsa','/images/teams/diana-main.jpg','/images/teams/diana-avatar.png','La salsa, c’est la passion, le rythme et le sourire !','Partage sa passion pour la salsa avec énergie et précision. Elle vous guidera pas à pas dans une ambiance chaleureuse.','https://t.me/username','https://wa.me/32471234567','https://vk.com/kate_salsa','2025-05-22 17:57:38','2025-05-22 17:57:38');
/*!40000 ALTER TABLE `wedance_team_members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wedance_testimonials`
--

DROP TABLE IF EXISTS `wedance_testimonials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wedance_testimonials` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` tinyint(4) NOT NULL DEFAULT '5',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `wedance_testimonials_user_id_foreign` (`user_id`),
  CONSTRAINT `wedance_testimonials_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `wedance_users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wedance_testimonials`
--

LOCK TABLES `wedance_testimonials` WRITE;
/*!40000 ALTER TABLE `wedance_testimonials` DISABLE KEYS */;
INSERT INTO `wedance_testimonials` VALUES (1,1,'Designer UX','/images/testimonials/hannah.png','Une ambiance incroyable et des cours de bachata super bien structurés. On progresse sans même s’en rendre compte !',5,'2025-05-22 17:57:38','2025-05-22 17:57:38'),(2,2,'Développeuse front-end','/images/testimonials/lucie.png','J’ai adoré mon expérience chez Wedance ! Les profs sont à l’écoute et l’énergie du groupe est géniale.',5,'2025-05-22 17:57:38','2025-05-22 17:57:38'),(3,3,'Chef de projet','/images/testimonials/tania.png','Une école où l’on se sent vraiment bienvenu. Les soirées dansantes sont un vrai plus pour pratiquer.',4,'2025-05-22 17:57:38','2025-05-22 17:57:38'),(4,4,'Directeur artistique','/images/testimonials/alex.png','Excellente pédagogie et ambiance chaleureuse. J’ai redécouvert la salsa avec plaisir.',5,'2025-05-22 17:57:38','2025-05-22 17:57:38'),(5,5,'Photographe','/images/testimonials/maya.png','Wedance, c’est plus qu’une école de danse : c’est une vraie famille ! Merci pour ces moments inoubliables.',5,'2025-05-22 17:57:38','2025-05-22 17:57:38'),(6,6,'Coach bien-être','/images/testimonials/diana.png','Les cours sont dynamiques et accessibles à tous. Idéal pour se détendre après le travail.',5,'2025-05-22 17:57:38','2025-05-22 17:57:38');
/*!40000 ALTER TABLE `wedance_testimonials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wedance_users`
--

DROP TABLE IF EXISTS `wedance_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wedance_users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) unsigned DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `wedance_users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wedance_users`
--

LOCK TABLES `wedance_users` WRITE;
/*!40000 ALTER TABLE `wedance_users` DISABLE KEYS */;
INSERT INTO `wedance_users` VALUES (1,'Test User','test@example.com','2025-05-22 17:57:34','$2y$12$GxpkCPp/ule.VYDJjdOg/ezXDLhMz55/IboA4uemA3SCAy4MrehnG',NULL,NULL,NULL,'user','RGrG0FJkBj',NULL,NULL,'2025-05-22 17:57:34','2025-05-22 17:57:34'),(2,'Admin User','admin@wedance.com',NULL,'$2y$12$FSKDFnI.t2i4Wmc2fvM78.GUqgV5K1lebZTAtCTvugaqi9vhZQOve',NULL,NULL,NULL,'admin',NULL,NULL,NULL,'2025-05-22 17:57:35','2025-05-22 17:57:35'),(3,'Teacher User','teacher@wedance.com',NULL,'$2y$12$kF7cJzliQi9Q/Jr5C7s0e.xnJdSNk2k/Uo2T3SKu5Wd/sVhRg1Va2',NULL,NULL,NULL,'teacher',NULL,NULL,NULL,'2025-05-22 17:57:35','2025-05-22 17:57:35'),(4,'Regular User','user@wedance.com',NULL,'$2y$12$EsWbLWFNYcwly1IzbHZE.O5G/9YVLC742cmiel3lHkcaF4p.cV.za',NULL,NULL,NULL,'user',NULL,NULL,NULL,'2025-05-22 17:57:35','2025-05-22 17:57:35'),(5,'Kate Retina','kate@wedance.com',NULL,'$2y$12$CQWM8mEgiIgNyI5O6TGZR.wxHcvll1JwsYOW5HJSSBIMOeXlPizbq',NULL,NULL,NULL,'teacher',NULL,NULL,NULL,'2025-05-22 17:57:38','2025-05-22 17:57:38'),(6,'Eva Marie','eva@wedance.com',NULL,'$2y$12$p08q67N5wtJp3Wv.L6.A1OdquWZQYWcKQAO/DK6I/bnwgrCzk3p9a',NULL,NULL,NULL,'teacher',NULL,NULL,NULL,'2025-05-22 17:57:38','2025-05-22 17:57:38'),(7,'Leo Martinez','leo@wedance.com',NULL,'$2y$12$iuGwHYrDir/b1A.TL7h6MOdinjlHUPzNqcwyDUrt8uI0wyy/2n.bO',NULL,NULL,NULL,'teacher',NULL,NULL,NULL,'2025-05-22 17:57:38','2025-05-22 17:57:38'),(8,'Sofia Lopez','sofia@wedance.com',NULL,'$2y$12$FTCviJPDlmLTbiZmvFVa.O.QnymW0OJ6LFVQ4gggonvznYh32l2hm',NULL,NULL,NULL,'teacher',NULL,NULL,NULL,'2025-05-22 17:57:38','2025-05-22 17:57:38'),(9,'Nina Da Costa','nina@wedance.com',NULL,'$2y$12$Ug.Cvh67OLRPdXEXBEVnyelZB4iSqB3/7YNgT.IP7mittxZ8GZc/6',NULL,NULL,NULL,'teacher',NULL,NULL,NULL,'2025-05-22 17:57:38','2025-05-22 17:57:38'),(10,'July Morel','july@wedance.com',NULL,'$2y$12$RtAPQmUviFJOnvBOgSt27eXbfsEAK899pVJInqR2UnL7lo2ScVi6W',NULL,NULL,NULL,'teacher',NULL,NULL,NULL,'2025-05-22 17:57:38','2025-05-22 17:57:38'),(11,'Diana Benali','maya@wedance.com',NULL,'$2y$12$uf7VH/cpjobHKzEukF1x4ORTdRn5KZSc7d9ziMq6U7nrcrP2Qni16',NULL,NULL,NULL,'teacher',NULL,NULL,NULL,'2025-05-22 17:57:38','2025-05-22 17:57:38');
/*!40000 ALTER TABLE `wedance_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-05-22 22:05:46
