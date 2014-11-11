-- MySQL dump 10.13  Distrib 5.5.37, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: newsapp
-- ------------------------------------------------------
-- Server version	5.5.37-0ubuntu0.13.10.1

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
-- Current Database: `newsapp`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `newsapp` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `newsapp`;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'business'),(2,'health'),(3,'sports'),(4,'weather'),(5,'celebrity'),(6,'games'),(7,'movies'),(8,'music'),(9,'food'),(10,'travel');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `category_no` int(11) NOT NULL,
  `date` varchar(50) NOT NULL,
  `text` text,
  `user_id` int(11) NOT NULL,
  `date_created` varchar(50) NOT NULL,
  `date_modify` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES (1,'The Craftsman','business',1,'2014-11-24 18:04:41','Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. <br/> Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia. ',1,'2014-09-24 18:04:41','2014-10-15 21:59:43'),(4,'The House ','health',2,'2014-10-29 13:05:27','<p>Nullamlacus dui ipsum conseqlo borttis non euisque morbipen a sdapibulum orna.</p>\r\n<p>Urnau ltrices quis curabitur pha sellent esque congue magnisve stib ulum quismodo nulla et.</p>lorem ipsum dolor sit ame ttreb Health',1,'2014-09-25 13:02:27','2014-10-21 16:05:42'),(12,'Hallo Hallo Trends ','food',9,'2014-10-25 16:21:35','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. \r\n<br/>\r\n',1,'2014-09-25 16:21:35','2014-10-15 22:19:20'),(15,'Maze runner','trivia',1,'2014-10-31 18:19:59','Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.',1,'2014-09-26 18:19:59','2014-10-23 22:00:49'),(16,'Gilas Pilipinas','sports',3,'2014-10-25 21:32:16','Gilas Pilipinas nasungkit din ang kauna unahang panalo sa FIBA ngayong 2014',1,'2014-10-09 22:32:16','2014-10-21 16:02:45'),(17,'Metro Manila Flood','weather',4,'2014-10-26 00:38:46','the metro manila rain is a big harm to commuters any where in mm is so much flood due to rain',1,'2014-10-09 23:38:46','2014-10-21 15:34:49'),(18,'Paolo Balesteros featured in cosmopolitan US','celebrity',5,'2014-10-29 00:03','Paolo Balesteros featured in cosmopolitan US ... and many more',1,'2014-10-10 00:04:48','2014-10-21 15:33:33'),(21,'Kenshin at Philippines','movies',7,'2014-10-28 16:00','kenshin kyoto ... bla bla blha\r\n\r\n\r\nKenshin at Philippines',1,'2014-10-12 16:01:04','2014-10-21 15:32:53'),(22,'QC food Festival','food',9,'2014-10-27 21:30','QC food Festival at maginhawa .. celebrating the anniversary of qc ... bla bla bla ... foodie would love the food cart they <strong> love </strong>',1,'2014-10-15 21:34:22','2014-10-21 15:32:38'),(23,'Sarah Geronimo New Album the Song of love','music',8,'2014-10-27 21:35','Sarah Geronimo realease her new album Song of Love ... her 8th album , she will be having a Mall tour this coming december .',1,'2014-10-15 21:37:57','2014-10-21 15:32:26'),(24,'Piso Fair Promo this coming 2015','travel',10,'2014-10-29 21:38','A good news to travelers ..  a cebupac. will release their aniv. promo Piso Fair this coming Jan 2015 to all domestic flight so keep updated on this. dont miss. Happy travel ',1,'2014-10-15 21:41:26','2014-10-21 15:31:32'),(25,'Your news ','celebrity',5,'2014-10-21 19:55','An unfavorable day for travels by air or for rock climbing. Think to be more openhearted with others and to take the first steps in case of dispute or disagreement; don\'t hold too fast to your positions, otherwise possibilities of open dialogue would be more and more reduced. You\'ll seriously look for frankness in your relations with your children. Very good day for chatting up, for love and also for marriage.',1,'2014-10-21 19:56:56','2014-10-23 21:34:43'),(26,'Healthy Crunchies','food',9,'2014-10-23 23:00','Popcorn is in fact a whole grain! Have the air-popped variety to avoid any added fat and sodium. One cup of air-popped popcorn has only 31 calories, but contains 6 grams of carbs, 1 of which is fibre.',1,'2014-10-21 22:23:14','2014-10-23 22:11:47'),(27,'The passengers','business',1,'2014-10-24 22:00:56','There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.',1,'2014-10-23 22:01:47',NULL),(30,'Movie Mart','movies',7,'2014-10-23 22:19:32','movies lorem ipsum dolor sit amet test test',1,'2014-10-23 22:19:47',NULL);
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_roles` varchar(50) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `user_email` (`user_email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Janna','Doe','lorem@gmail.com','Admin','$5$rounds=500000$0fe86e53f03d68c1$ycRpSsogSmyMEHflOCFpKWWJlWP.XPKgWnEgK5vHVo5'),(2,'Johny','ipsum','ipsum@gmail.com','Admin','$5$rounds=500000$bd690fa34a312734$NtsfbTLDRgL4kCRzeCy1dCnYMdVyRkPiGg6HG355vp8');
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

-- Dump completed on 2014-10-23 22:38:39
