-- MySQL dump 10.13  Distrib 8.0.21, for macos10.15 (x86_64)
--
-- Host: localhost    Database: willy_wangky
-- ------------------------------------------------------
-- Server version	8.0.21

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `add_stock`
--

DROP TABLE IF EXISTS `add_stock`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `add_stock` (
  `id` int NOT NULL,
  `id_chocolate` int DEFAULT NULL,
  `jumlah` int DEFAULT NULL,
  `status` varchar(20) DEFAULT 'PENDING',
  PRIMARY KEY (`id`),
  KEY `id_chocolate` (`id_chocolate`),
  CONSTRAINT `add_stock_ibfk_1` FOREIGN KEY (`id_chocolate`) REFERENCES `chocolate` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `add_stock`
--

LOCK TABLES `add_stock` WRITE;
/*!40000 ALTER TABLE `add_stock` DISABLE KEYS */;
INSERT INTO `add_stock` VALUES (1,1,2,'APPROVED');
/*!40000 ALTER TABLE `add_stock` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chocolate`
--

DROP TABLE IF EXISTS `chocolate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `chocolate` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` int NOT NULL,
  `amount` int NOT NULL,
  `sold` int NOT NULL DEFAULT '0',
  `description` text,
  `file_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `chocolate_chk_1` CHECK ((`amount` >= 0)),
  CONSTRAINT `chocolate_chk_2` CHECK ((`price` > 0))
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chocolate`
--

LOCK TABLES `chocolate` WRITE;
/*!40000 ALTER TABLE `chocolate` DISABLE KEYS */;
INSERT INTO `chocolate` VALUES (1,'Cardburry',35000,0,2,'Enak murah bergizi','Screen Shot 2020-11-29 at 00.28.02-2.png'),(2,'Silver Queen',25000,0,0,'Low profile chocolate','Screen Shot 2020-11-29 at 00.32.36-33.png'),(3,'Monggo',40000,0,0,'Coklat aseli produk lokal','Screen Shot 2020-11-29 at 00.34.30-69.png');
/*!40000 ALTER TABLE `chocolate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transaction` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `id_chocolate` int NOT NULL,
  `amount` int NOT NULL,
  `total_price` int NOT NULL,
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `address` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  KEY `id_chocolate` (`id_chocolate`),
  CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`),
  CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`id_chocolate`) REFERENCES `chocolate` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction`
--

LOCK TABLES `transaction` WRITE;
/*!40000 ALTER TABLE `transaction` DISABLE KEYS */;
INSERT INTO `transaction` VALUES (1,2,1,1,35000,'2020-11-28 17:43:19','ITB'),(2,3,1,1,35000,'2020-11-28 17:44:22','Bandung');
/*!40000 ALTER TABLE `transaction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','admin','admin@gmail.com','SUPER_USER'),(2,'fab','fab','fab@gmail.com','USER'),(3,'hasan','hasan','hasan@gmail.com','USER');
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

-- Dump completed on 2020-11-29 17:19:06
