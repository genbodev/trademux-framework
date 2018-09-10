-- MySQL dump 10.13  Distrib 5.1.41, for debian-linux-gnu (i486)
--
-- Host: localhost    Database: cms
-- ------------------------------------------------------
-- Server version	5.1.41-3ubuntu12.6

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
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) DEFAULT NULL,
  `title` varchar(1000) DEFAULT NULL,
  `alias` varchar(1000) DEFAULT NULL,
  `preview` text,
  `content` longtext,
  `create_date` datetime DEFAULT NULL,
  `modify_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `i_cat_id` (`cat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` VALUES (1,5,'Test Article','test_article','Test','<p>\r\n	ghfhfdjfhj hjhfjfhj fhjghjjgh</p>\r\n<p>\r\n	<img alt=\"\" src=\"/uploads/.thumbs/images/m_dynamic_sketch.png\" style=\"width: 90px; height: 100px\" /></p>\r\n<p>\r\n	gjkjhkhjkhjkhg&nbsp;</p>\r\n<p>\r\n	<img alt=\"\" src=\"/uploads/images/a_b605f6e6.jpg\" style=\"width: 100px; height: 100px\" /></p>\r\n<p>\r\n	lkl;kok[ok[</p>\r\n',NULL,'2010-11-29 18:30:11'),(2,0,'','','','',NULL,'2010-12-17 13:54:12'),(3,0,'blues','blues','test','<p>\r\n	adfsadfasdf</p>\r\n',NULL,'2010-12-17 13:54:25'),(4,5,'test','test','','<p>\r\n	asfdsaf</p>\r\n',NULL,'2010-12-17 13:54:36'),(5,0,'test','test','','<p>\r\n	adf</p>\r\n',NULL,'2010-12-20 11:48:27');
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(1000) NOT NULL,
  `alias` varchar(1000) NOT NULL,
  `description` text,
  `create_date` datetime DEFAULT NULL,
  `modify_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,0,'Category1','category1','desc cat 1','2010-11-26 20:03:00','0000-00-00 00:00:00'),(2,1,'Category11','category11','desc cat 11','2010-11-26 20:03:00','0000-00-00 00:00:00'),(3,0,'Category2','caterogy2','desc cat 2','2010-11-26 20:09:00','0000-00-00 00:00:00'),(4,0,'Category3','category3','Category3 desc','2010-11-29 09:58:30','2010-11-29 07:58:30'),(5,2,'Category111','category111','Category111 desc','2010-11-29 10:04:43','2010-11-29 08:04:43');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_items`
--

DROP TABLE IF EXISTS `menu_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `title` varchar(1000) DEFAULT NULL,
  `link` varchar(1000) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `desc` varchar(1000) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `modules`
--

DROP TABLE IF EXISTS `modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modules`
--

LOCK TABLES `modules` WRITE;
/*!40000 ALTER TABLE `modules` DISABLE KEYS */;
INSERT INTO `modules` VALUES (1,'*'),(2,'dbdiff'),(3,'accessmanager'),(4,'registration'),(5,'login'),(6,'indexpage'),(7,'content'),(8,'articlesmanager'),(9,'categoriesmanager'),(10,'menumanager'),(11,'profile');
/*!40000 ALTER TABLE `modules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roleaccess`
--

DROP TABLE IF EXISTS `roleaccess`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roleaccess` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL,
  `r` int(1) DEFAULT '0',
  `w` int(1) DEFAULT '0',
  `a` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `i_role_id` (`role_id`),
  KEY `i_module_id` (`module_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roleaccess`
--

LOCK TABLES `roleaccess` WRITE;
/*!40000 ALTER TABLE `roleaccess` DISABLE KEYS */;
INSERT INTO `roleaccess` VALUES (1,1,1,0,0,0),(2,2,1,1,1,1),(3,2,3,1,1,1),(4,2,2,1,1,1),(5,2,5,1,1,1),(6,2,4,1,1,1),(7,1,3,0,0,0),(8,1,2,0,0,0),(9,1,5,1,1,0),(10,1,4,1,1,0),(11,2,6,1,1,1),(12,1,6,1,0,0),(13,2,8,1,1,1),(14,2,9,1,1,1),(15,2,7,1,1,1),(16,2,10,1,1,1),(17,2,11,1,1,1);
/*!40000 ALTER TABLE `roleaccess` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Guest'),(2,'Admin');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `useraccess`
--

DROP TABLE IF EXISTS `useraccess`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `useraccess` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL,
  `r` int(1) DEFAULT '0',
  `w` int(1) DEFAULT '0',
  `a` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `i_user_id` (`user_id`),
  KEY `i_module_id` (`module_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `useraccess`
--

LOCK TABLES `useraccess` WRITE;
/*!40000 ALTER TABLE `useraccess` DISABLE KEYS */;
INSERT INTO `useraccess` VALUES (1,1,1,0,0,1),(2,1,3,0,0,1),(3,1,8,0,0,1),(4,1,9,0,0,1),(5,1,7,0,0,1),(6,1,2,0,0,1),(7,1,6,0,0,1),(8,1,5,0,0,1),(9,1,10,0,0,1),(10,1,11,0,0,1),(11,1,4,0,0,1);
/*!40000 ALTER TABLE `useraccess` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `login` varchar(255) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `name` varchar(500) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `date_add` datetime DEFAULT NULL,
  `date_last_modify` datetime DEFAULT NULL,
  `date_last_login` datetime DEFAULT NULL,
  `dismissed` tinyint(1) NOT NULL DEFAULT '0',
  `code` varchar(32) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `i_role_id` (`role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,2,'admin','73880b5a000db4dd413139d37e4f1cab','4d0f5f401a5e8','Admin','admin@admin.com','2010-11-25 18:09:32','2010-12-20 12:24:28','2010-12-21 13:51:51',0,NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2010-12-21 14:35:43
