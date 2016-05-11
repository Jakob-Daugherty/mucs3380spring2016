-- MySQL dump 10.13  Distrib 5.7.9, for osx10.9 (x86_64)
--
-- Host: localhost    Database: FinalProject
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
INSERT INTO `employee` VALUES (0,'test123',0,'test1234@test.com','1708374490','$2y$10$XMh71lT/wZ.lby87JTeBuODUwY4XwKEwumIW3f8yHI4HpbW198ucm','te','st'),(123456,'adminUser',1,'testemail@mail.missouri.edu','1419814819','$2y$10$3FleH8rp.AcSuPg4BDAm7epLg3sw6yZ1XcS0VIMmDRQXTSV/4wWwK','Adam','U'),(654321,'regularUser',0,'test@mail.missouri.edu','2106281797','$2y$10$18yilYZNmpONY9DKG0ZIh.sqNkRSfW.6Y/siAfVofEfX.cII9qRxu','Dude','U'),(1111111,'joe',0,'asdf@asdf.com','696394387','$2y$10$/ZO3BSgW7KQGfUnj3Ob1yOzLurpehR5/947iqDg18Wzk9pdWsMJNm','joe','asdf'),(8888888,'testUser',1,'testUser@test.com','1028707474','$2y$10$70bhXJSJnVQBklSYu.48K.aB1s5YQqjF6PghKtsVdgKj6/5OkHiGi','Test','User'),(11111111,'test',0,'111@222.com','994205531','$2y$10$d.a298ejuUoFSg9989Phv.5sv1Q0urHgIiQ8UpAAcPJ77AV3RVmW6','test','test'),(11223344,'test',0,'test@mizzou.edu','1435774244','$2y$10$DXllTvQxp5uvx55yV1Iv7OGQRaHCLexEuXY.GvZkHCn9l7lDC/Q0q','John','Doe'),(12400190,'Michael',1,'McLaughlinMichael1994@hotmail.com','1768285899','$2y$10$jzp3bXXzFBrxdyOpR5ZAEucJx0yHaZ64DsBCSHlTJqmf8dXk7uzmG','Michael','McLaughlin'),(15526277,'alyssa',0,'alyssa@test.com','401094136','$2y$10$YGXLwzIg01Q7/CtC8vY7quk.ZzTWTpz4wGs0tcZ4J1Y70hmy9KRGe','alyssa','alyssa'),(88888888,'John',0,'you@whatever.com','1359558067','$2y$10$zw.TeUlN3gx7ADvAEvj/uOlifZfk1w056IViaYxMQVM0VUFh/qdaG','John','Doe'),(123456789,'alyssa',1,'alyssa@test.com','1338049613','$2y$10$EefefVuIFV7AcEB0J8b6kujVaANrtli3x1HO.KENVjkOuMbvXICkG','alyssa','nielsen'),(661667838,'test2',0,'tester@test.com','1971597224','$2y$10$KxIKtnyptmr8gvtC7Ywu4.q8C79TyKBqND9T2Fm8r0aSPQEsU3AqO','tester','123'),(777777777,'regularTest',0,'testReg@test.com','151113724','$2y$10$RoL.llnfcLEyMGiv1Ga6sOiRQCSG1nFP9N.R7BUbL9YghnTAWt7aq','Test','Reg');
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
INSERT INTO `employee_permissions` VALUES (0,'regular'),(1,'admin');
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
INSERT INTO `expired_waiver` VALUES (1,1,'2016-05-01 10:34:43','2017-05-01 11:59:59');
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
INSERT INTO `item` VALUES (1,'PC-3',1,1,1),(2,'Mac-2',1,1,1),(4,'PC-4',1,2,1),(5,'Bike-1',1,1,1),(6,'Mac-4',1,1,1);
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
  `checkout_window` int(5) DEFAULT NULL,
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
INSERT INTO `item_category` VALUES (2,'MACS',1,2,2),(4,'PCS',1,4,2),(5,'Bike',2,5,NULL),(6,'MACS',1,2,2);
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
INSERT INTO `item_condition` VALUES (0,''),(1,'Good'),(2,'Fair'),(3,'poor'),(4,'unworking'),(5,'Unknown Problem'),(8,'test'),(1234567890,'Bad');
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
INSERT INTO `location` VALUES (0,'Student Center',1),(1,'Memorial Student Union',2),(3,'test',1);
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
INSERT INTO `student` VALUES (0,'test','test@mizzou.edu','Luke','Parker'),(1,'tre335','tre335@mizzou.edu','Trey','Evans'),(2,'hel3er','hel3er@mizzou.edu','Heath','Leadger');
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
  `checkout_window` datetime DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_item_transaction`
--

LOCK TABLES `student_item_transaction` WRITE;
/*!40000 ALTER TABLE `student_item_transaction` DISABLE KEYS */;
INSERT INTO `student_item_transaction` VALUES (2,2,2,123456,1,2,'In','2016-05-04 11:00:00','0000-00-00 00:00:00');
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
INSERT INTO `waiver` VALUES (0,'General Checkout'),(1,'Laptop Checkout'),(2,'Bike Checkout'),(3,'Charger Checkout'),(123,'Charger Checkout');
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

-- Dump completed on 2016-05-11 13:54:10
