-- MySQL dump 10.13  Distrib 5.5.34, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: shop
-- ------------------------------------------------------
-- Server version	5.5.34-0ubuntu0.12.04.1

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
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admins` (
  `admin_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'admin','3a523780ee1bbb78bb52bc657449d257','wss.world@gmail.com');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `customer_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `quote_id` int(11) unsigned DEFAULT NULL,
  `rating` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (1,'wss','d93591bdf7860e1e4ee2fca799911215','wss.suri@yandex.ru',3,NULL),(5,'Zeus','f0e8fb430bbdde6ae9c879a518fd895f','z.ues@gmail.com',NULL,NULL),(6,'Ursa','0c920d0ce6ea3da29d8864c616b2490f','ur@gma.com',NULL,NULL),(7,'WEr','58992f3e27ccae361ea737f48ec9da63','sewr@fsfl.com',NULL,NULL),(8,'aaa','c52598520e2b234ea38b80349a673900','ddd@ddd.com',NULL,NULL),(9,'Sniper','0e2a290ca156cc762a0bbb90c2a4c0a5','s-niper@mail.com',NULL,NULL),(10,'Viper','098890dde069e9abad63f19a0d9e1f32','vip@vimail.net',NULL,NULL),(11,'Dexter','c52598520e2b234ea38b80349a673900','Dex@mail.com',NULL,NULL),(12,'Dima','d9964c10e57873dcef7350198df7316d','dimon@mgail.com',4,NULL),(13,'Blo','ec6a6536ca304edf844d1d248a4f08dc','blosius@blos.com',0,NULL),(14,'Blo2','ec6a6536ca304edf844d1d248a4f08dc','blosius@blos.com',0,NULL),(15,'Blo3','81dc9bdb52d04dc20036dbd8313ed055','wss.suri@yandex.ru',NULL,NULL),(16,'Blo3','81dc9bdb52d04dc20036dbd8313ed055','blosius@blos.com',NULL,NULL),(17,'Blo4','81dc9bdb52d04dc20036dbd8313ed055','brain@gmail.com',NULL,NULL),(18,'Blo5','81dc9bdb52d04dc20036dbd8313ed055','ddd@ddd.com',5,NULL),(19,'Blo6','81dc9bdb52d04dc20036dbd8313ed055','brain@gmail.com',7,NULL),(20,'Qwerst','81dc9bdb52d04dc20036dbd8313ed055','qwerst1@mail.com',NULL,NULL);
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_reviews`
--

DROP TABLE IF EXISTS `product_reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_reviews` (
  `review_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) unsigned DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `rating` decimal(10,2) DEFAULT NULL,
  `text_review` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`review_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_reviews`
--

LOCK TABLES `product_reviews` WRITE;
/*!40000 ALTER TABLE `product_reviews` DISABLE KEYS */;
INSERT INTO `product_reviews` VALUES (1,11,'klon777','wss.suri@yandex.ru',2.00,'blblbob'),(2,11,'klon777','wss.world@gmail.com',4.00,'sadfasdf'),(3,11,'sergei','wanek_777@mail.ru',4.00,'sdfsadf'),(4,11,'wss','asdf',5.00,'hihhihih'),(5,11,'wss2','wanek_777@mail.ru',4.00,'&#1084;&#1086;&#1081; &#1082;&#1086;&#1084;&#1077;&#1085;&#1090;'),(6,12,'Sergei','wanek_777@mail.ru',1.00,'Kloiii');
/*!40000 ALTER TABLE `product_reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `product_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `sku` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `price` float DEFAULT NULL,
  `special_price` float DEFAULT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'Iphone 3G','753159','https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcS9PfMgsH_lafNyTkeUIjy8mfNqI7VenxqLDw69wQng2aFXhEVGbw',4500,4499),(11,'Iphone 4','4569852','http://paulov.ru/files/2012/02/step1-2.jpg',13490,NULL),(12,'Iphone 4G','12365478','http://www.apple-iphone.ru/iphone4/iphone4.jpg',19000,18990),(13,'Iphone 5','557878794','http://appsgrade.ru/wp-content/uploads/2013/03/iphone5-v-moskve.png',23000,NULL),(14,'Iphone 5S','753159','http://www.oszone.net/figs/u/316767/131014123221/iphone-5s-shop-le-monde-edit.jpg',26000,NULL),(15,'Samsung Galax S','999779797','http://technocrash.ru/wp-content/uploads/2010/08/Samsung-Captivate-i897_1.jpg',6010,4000),(16,'Samsung Galax S2','2992458924','http://s.4pda.to/wp-content/uploads/2013/01/galaxy-s-ii-plus-product-image-1-320x480.jpg',10000,9500),(17,'Samsung Galax S3','3998547475441333','http://www.droid-life.com/wp-content/uploads/2012/06/galaxy-s3-review.jpg',19000,NULL),(18,'Samsung Galax S4','47851145588417','http://s4galaxy.ru/wp-content/uploads/2013/06/samsung_galaxy_s_4_zoom_1.jpg',26000,NULL);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quote_items`
--

DROP TABLE IF EXISTS `quote_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quote_items` (
  `item_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `quote_id` int(11) unsigned NOT NULL,
  `qty` int(11) unsigned DEFAULT NULL,
  `product_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quote_items`
--

LOCK TABLES `quote_items` WRITE;
/*!40000 ALTER TABLE `quote_items` DISABLE KEYS */;
INSERT INTO `quote_items` VALUES (5,3,2,11),(6,0,3,17),(7,0,1,11);
/*!40000 ALTER TABLE `quote_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quotes`
--

DROP TABLE IF EXISTS `quotes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quotes` (
  `quote_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `address_id` int(11) unsigned DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL,
  `shipping` int(11) unsigned DEFAULT NULL,
  `grand_total` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`quote_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quotes`
--

LOCK TABLES `quotes` WRITE;
/*!40000 ALTER TABLE `quotes` DISABLE KEYS */;
INSERT INTO `quotes` VALUES (1,NULL,NULL,NULL,NULL),(2,NULL,NULL,NULL,NULL),(3,NULL,NULL,NULL,NULL),(4,NULL,NULL,NULL,NULL),(5,NULL,NULL,NULL,NULL),(6,NULL,NULL,NULL,NULL),(7,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `quotes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-01-14 13:56:14
