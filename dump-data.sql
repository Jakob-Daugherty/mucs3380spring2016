-- MySQL dump 10.13  Distrib 5.5.49, for debian-linux-gnu (x86_64)
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
-- Dumping data for table `employee`
--

LOCK TABLES `employee` WRITE;
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
INSERT INTO `employee` VALUES (0,'test123',0,'test1234@test.com','1708374490','$2y$10$XMh71lT/wZ.lby87JTeBuODUwY4XwKEwumIW3f8yHI4HpbW198ucm','te','st'),(123456,'adminUser',1,'testemail@mail.missouri.edu','1419814819','$2y$10$3FleH8rp.AcSuPg4BDAm7epLg3sw6yZ1XcS0VIMmDRQXTSV/4wWwK','Adam','U'),(654321,'regularUser',0,'test@mail.missouri.edu','2106281797','$2y$10$18yilYZNmpONY9DKG0ZIh.sqNkRSfW.6Y/siAfVofEfX.cII9qRxu','Dude','U'),(1111111,'joe',0,'asdf@asdf.com','696394387','$2y$10$/ZO3BSgW7KQGfUnj3Ob1yOzLurpehR5/947iqDg18Wzk9pdWsMJNm','joe','asdf'),(8888888,'testUser',1,'testUser@test.com','1028707474','$2y$10$70bhXJSJnVQBklSYu.48K.aB1s5YQqjF6PghKtsVdgKj6/5OkHiGi','Test','User'),(11111111,'test',0,'111@222.com','994205531','$2y$10$d.a298ejuUoFSg9989Phv.5sv1Q0urHgIiQ8UpAAcPJ77AV3RVmW6','test','test'),(11223344,'test',0,'test@mizzou.edu','1435774244','$2y$10$DXllTvQxp5uvx55yV1Iv7OGQRaHCLexEuXY.GvZkHCn9l7lDC/Q0q','John','Doe'),(15526277,'alyssa',0,'alyssa@test.com','401094136','$2y$10$YGXLwzIg01Q7/CtC8vY7quk.ZzTWTpz4wGs0tcZ4J1Y70hmy9KRGe','alyssa','alyssa'),(661667838,'test2',0,'tester@test.com','1971597224','$2y$10$KxIKtnyptmr8gvtC7Ywu4.q8C79TyKBqND9T2Fm8r0aSPQEsU3AqO','tester','123'),(777777777,'regularTest',0,'testReg@test.com','151113724','$2y$10$RoL.llnfcLEyMGiv1Ga6sOiRQCSG1nFP9N.R7BUbL9YghnTAWt7aq','Test','Reg');
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `employee_permissions`
--

LOCK TABLES `employee_permissions` WRITE;
/*!40000 ALTER TABLE `employee_permissions` DISABLE KEYS */;
INSERT INTO `employee_permissions` VALUES (0,'regular'),(1,'admin');
/*!40000 ALTER TABLE `employee_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `expired_waiver`
--

LOCK TABLES `expired_waiver` WRITE;
/*!40000 ALTER TABLE `expired_waiver` DISABLE KEYS */;
INSERT INTO `expired_waiver` VALUES (1,1,'2016-05-01 10:34:43','2017-05-01 11:59:59');
/*!40000 ALTER TABLE `expired_waiver` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `item`
--

LOCK TABLES `item` WRITE;
/*!40000 ALTER TABLE `item` DISABLE KEYS */;
INSERT INTO `item` VALUES (0,'',1,1,0),(1,'Mac-1',1,1,0),(2,'Mac-2',1,1,1),(3,'Mac-3',1,3,0),(4,'PC-4',1,2,1),(5,'Bike-1',1,1,1),(6,'Mac-4',1,1,1),(456725,'laptop',1,1,0),(123456790,'Michael',1,1,0),(1234567890,'NewItem',1,1,0);
/*!40000 ALTER TABLE `item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `item_category`
--

LOCK TABLES `item_category` WRITE;
/*!40000 ALTER TABLE `item_category` DISABLE KEYS */;
INSERT INTO `item_category` VALUES (0,'',0,0),(1,'MACS',1,1),(2,'MACS',1,2),(3,'MACS',1,3),(4,'PCS',1,4),(5,'Bike',2,5),(6,'MACS',1,2),(9,'test',1,1);
/*!40000 ALTER TABLE `item_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `item_condition`
--

LOCK TABLES `item_condition` WRITE;
/*!40000 ALTER TABLE `item_condition` DISABLE KEYS */;
INSERT INTO `item_condition` VALUES (0,''),(1,'Good'),(2,'Fair'),(3,'poor'),(4,'unworking'),(5,'Unknown Problem'),(8,'test'),(1234567890,'Bad');
/*!40000 ALTER TABLE `item_condition` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `item_condition_update`
--

LOCK TABLES `item_condition_update` WRITE;
/*!40000 ALTER TABLE `item_condition_update` DISABLE KEYS */;
INSERT INTO `item_condition_update` VALUES (1,1,3,'2016-05-01 10:00:00',2,NULL);
/*!40000 ALTER TABLE `item_condition_update` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `location`
--

LOCK TABLES `location` WRITE;
/*!40000 ALTER TABLE `location` DISABLE KEYS */;
INSERT INTO `location` VALUES (0,'',0),(0,'Student Center',1),(1,'Memorial Student Union',2),(3,'test',1);
/*!40000 ALTER TABLE `location` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` VALUES (0,'test','test@mizzou.edu','Luke','Parker'),(1,'tre335','tre335@mizzou.edu','Trey','Evans'),(2,'hel3er','hel3er@mizzou.edu','Heath','Leadger');
/*!40000 ALTER TABLE `student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `student_item_transaction`
--

LOCK TABLES `student_item_transaction` WRITE;
/*!40000 ALTER TABLE `student_item_transaction` DISABLE KEYS */;
/*INSERT INTO `student_item_transaction` VALUES (2,2,123456,1,1,'Out','2016-05-01 10:34:43'),(2,2,654321,1,1,'IN','2016-05-01 11:50:00')*/;
/*!40000 ALTER TABLE `student_item_transaction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `waiver`
--

LOCK TABLES `waiver` WRITE;
/*!40000 ALTER TABLE `waiver` DISABLE KEYS */;
INSERT INTO `waiver` VALUES (0,''),(1,'General Checkout'),(2,'Bike Checkout'),(3,'test'),(123,'test');
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

-- Dump completed on 2016-05-08 15:45:13
