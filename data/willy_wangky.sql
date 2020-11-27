-- MariaDB dump 10.17  Distrib 10.4.14-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: willy_wangky
-- ------------------------------------------------------
-- Server version	10.4.14-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `chocolate`
--

DROP TABLE IF EXISTS `chocolate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chocolate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `sold` int(11) NOT NULL DEFAULT 0,
  `description` text DEFAULT NULL,
  `file_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `CONSTRAINT_1` CHECK (`amount` > 0),
  CONSTRAINT `CONSTRAINT_2` CHECK (`price` > 0)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chocolate`
--

LOCK TABLES `chocolate` WRITE;
/*!40000 ALTER TABLE `chocolate` DISABLE KEYS */;
INSERT INTO `chocolate` VALUES (1,'Coklat Manis',50000,14,6,'Coklat manis dengan sedikit sentuhan asin, khas Indonesia','choco-3.jpg'),(2,'Teuscher',550000,10,0,'Brand coklat terbaik didunia','choco-5.jpg'),(3,'Kuliah',12500000,99,0,'The image explains it well...','kuliah.PNG'),(4,'Kuliah Deui',12500000,99,0,'Aduhhh UKT mahal...','kuliah.PNG'),(6,'Mata',1000000,99,0,'Mata jun','cobain.jpg'),(7,'Yang Keenam',1000,10,0,'Nu ka genep','MemesTilting.PNG'),(8,'Tujuh',1000,10,0,'Nu ka tujuh','TTD.PNG'),(9,'Dalapan',8000,10,0,'Nu ka dalapan','kuliah.PNG'),(10,'Salapan',9000,10,0,'Nu ka salapan','kuliah.PNG'),(11,'Sapuluh',10000,10,0,'Nu ka sapuluh','kuliah.PNG'),(12,'Baleg',12500,6969,0,'Cik nu baleg atulah MPPL SI IMK, lieur lieur teuing','kuliah.PNG'),(14,'Ngeunah Pisan',50000,49,20,'Hayang ka warteg ngan hoream kumaha nya. Isuk nuju milarian naon wae kitu? Moal ulin jeung babaturan ieu','warteg-1-56.png');
/*!40000 ALTER TABLE `chocolate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_chocolate` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  `address` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  KEY `id_chocolate` (`id_chocolate`),
  CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`),
  CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`id_chocolate`) REFERENCES `chocolate` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction`
--

LOCK TABLES `transaction` WRITE;
/*!40000 ALTER TABLE `transaction` DISABLE KEYS */;
INSERT INTO `transaction` VALUES (1,305,1,1,50000,'2020-10-24 16:39:51','Asik'),(2,305,1,5,250000,'2020-10-25 11:38:20','Jalan Singkong'),(3,305,14,20,1000000,'2020-10-25 11:38:52','Kamana wae');
/*!40000 ALTER TABLE `transaction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=648 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (2,'fabian','2472ee727ed8de9a818fc657a6895646','fabian','user'),(3,'zunan','e399c1af5ad536d1d04f68089e74c28a','zunanalfikri@gmail.com','USER'),(305,'fab1','fab1','fab1@fab.fab','USER'),(630,'fab2','fab2','fab2@fab.fab','USER'),(642,'admin2','admin2','admin2@admin.admin','SUPER_USER'),(643,'admin','admin','admin@admin.admin','SUPER_USER'),(644,'fab3','fab3','fab3@fab.fab','USER'),(645,'fab4','fab4','fab4@fab.fab','USER'),(646,'fab5','fab5','fab5@fab.fab','USER'),(647,'fab6','fab6','fab6@fab.fab','USER');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-10-25 18:54:54
