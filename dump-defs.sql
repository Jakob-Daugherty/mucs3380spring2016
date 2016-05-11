-- MySQL dump 10.13  Distrib 5.5.49, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: test
-- ------------------------------------------------------
-- Server version	5.5.49-0ubuntu0.14.04.1

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
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `username` varchar(16) NOT NULL,
  `user_type` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `salt` varchar(20) NOT NULL,
  `hashed_password` varchar(256) NOT NULL,
  `name_first` varchar(30) DEFAULT NULL,
  `name_last` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_type` (`user_type`),
  CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`user_type`) REFERENCES `employee_permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee`
--

LOCK TABLES `employee` WRITE;
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee_permissions`
--

DROP TABLE IF EXISTS `employee_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee_permissions` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee_permissions`
--

LOCK TABLES `employee_permissions` WRITE;
/*!40000 ALTER TABLE `employee_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `employee_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expired_waiver`
--

DROP TABLE IF EXISTS `expired_waiver`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expired_waiver` (
  `student_id` int(11) NOT NULL,
  `waiver_id` int(11) NOT NULL,
  `initialized` datetime NOT NULL,
  `expires` datetime NOT NULL,
  PRIMARY KEY (`student_id`,`waiver_id`),
  KEY `waiver_id` (`waiver_id`),
  CONSTRAINT `expired_waiver_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE CASCADE,
  CONSTRAINT `expired_waiver_ibfk_2` FOREIGN KEY (`waiver_id`) REFERENCES `waiver` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expired_waiver`
--

LOCK TABLES `expired_waiver` WRITE;
/*!40000 ALTER TABLE `expired_waiver` DISABLE KEYS */;
/*!40000 ALTER TABLE `expired_waiver` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `available` tinyint(1) NOT NULL,
  `item_condition_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `item_condition_id` (`item_condition_id`),
  KEY `location_id` (`location_id`),
  CONSTRAINT `item_ibfk_1` FOREIGN KEY (`item_condition_id`) REFERENCES `item_condition` (`id`) ON DELETE CASCADE,
  CONSTRAINT `item_ibfk_2` FOREIGN KEY (`location_id`) REFERENCES `location` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item`
--

LOCK TABLES `item` WRITE;
/*!40000 ALTER TABLE `item` DISABLE KEYS */;
/*!40000 ALTER TABLE `item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item_category`
--

DROP TABLE IF EXISTS `item_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item_category` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `waiver` int(11) DEFAULT NULL,
  `item_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`),
  CONSTRAINT `item_category_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item_category`
--

LOCK TABLES `item_category` WRITE;
/*!40000 ALTER TABLE `item_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `item_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item_condition`
--

DROP TABLE IF EXISTS `item_condition`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item_condition` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item_condition`
--

LOCK TABLES `item_condition` WRITE;
/*!40000 ALTER TABLE `item_condition` DISABLE KEYS */;
/*!40000 ALTER TABLE `item_condition` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item_condition_update`
--

DROP TABLE IF EXISTS `item_condition_update`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item_condition_update` (
  `item_condition_id_old` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_condition_id_new` int(11) NOT NULL,
  `date_time` datetime NOT NULL,
  `employee_id` int(11) NOT NULL,
  `item_condition_updatecol` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`date_time`,`item_id`),
  KEY `item_id` (`item_id`),
  CONSTRAINT `item_condition_update_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item_condition_update`
--

LOCK TABLES `item_condition_update` WRITE;
/*!40000 ALTER TABLE `item_condition_update` DISABLE KEYS */;
/*!40000 ALTER TABLE `item_condition_update` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `location`
--

DROP TABLE IF EXISTS `location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `terminal_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`terminal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `location`
--

LOCK TABLES `location` WRITE;
/*!40000 ALTER TABLE `location` DISABLE KEYS */;
/*!40000 ALTER TABLE `location` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `username` varchar(16) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name_first` varchar(30) DEFAULT NULL,
  `name_last` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
/*!40000 ALTER TABLE `student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_item_transaction`
--

DROP TABLE IF EXISTS `student_item_transaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student_item_transaction` (
  `transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `item_condition_id` int(11) NOT NULL,
  `transaction_type` varchar(50) DEFAULT NULL,
  `transaction_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`transaction_id`),
  KEY `student_id` (`student_id`),
  KEY `item_id` (`item_id`),
  KEY `employee_id` (`employee_id`),
  KEY `location_id` (`location_id`),
  KEY `item_condition_id` (`item_condition_id`),
  CONSTRAINT `student_item_transaction_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE CASCADE,
  CONSTRAINT `student_item_transaction_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE,
  CONSTRAINT `student_item_transaction_ibfk_3` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`) ON DELETE CASCADE,
  CONSTRAINT `student_item_transaction_ibfk_4` FOREIGN KEY (`location_id`) REFERENCES `location` (`id`) ON DELETE CASCADE,
  CONSTRAINT `student_item_transaction_ibfk_5` FOREIGN KEY (`item_condition_id`) REFERENCES `item_condition` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_item_transaction`
--

LOCK TABLES `student_item_transaction` WRITE;
/*!40000 ALTER TABLE `student_item_transaction` DISABLE KEYS */;
/*!40000 ALTER TABLE `student_item_transaction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `waiver`
--

DROP TABLE IF EXISTS `waiver`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `waiver` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `waiver`
--

LOCK TABLES `waiver` WRITE;
/*!40000 ALTER TABLE `waiver` DISABLE KEYS */;
/*!40000 ALTER TABLE `waiver` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-05-08 15:37:04


--The MIT License (MIT)
--Copyright (c) 2016 Hunter Ginther, Jakob Daugherty, Zach Dolan, Kevin Free, Michael McLaughlin, and Alyssa Nielsen 
--
--Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
--
--THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.