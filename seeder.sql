-- MySQL dump 10.13  Distrib 5.7.41, for Linux (x86_64)
--
-- Host: localhost    Database: csra
-- ------------------------------------------------------
-- Server version	5.7.41

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
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event` varchar(255) DEFAULT NULL,
  `type` enum('automatic','manual') DEFAULT NULL,
  `source_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (1,'Escaneo de puertos','automatic',NULL,NULL,'2023-03-30 18:07:33'),(2,'Inundacin de paquetes (synFlood)','automatic',NULL,NULL,'2023-03-30 18:07:33'),(3,'Ataque de fuerza bruta','automatic',NULL,NULL,'2023-03-30 18:07:33'),(4,'Deteccin de malware en estacin de trabajo','automatic',NULL,NULL,'2023-03-30 18:07:33'),(5,'Deteccin de trfico malicioso','automatic',NULL,NULL,'2023-03-30 18:07:33'),(6,'PUA detectada','automatic',NULL,NULL,'2023-03-30 18:07:33'),(7,'PUA limpiada','automatic',NULL,NULL,'2023-03-30 18:07:33'),(8,'Proteccin en tiempo real desactivado','automatic',NULL,NULL,'2023-03-30 18:07:33'),(9,'Deteccin de datos personales','automatic',NULL,NULL,'2023-03-30 18:07:33'),(10,'Correos a buzones personales con informacin restringida','automatic',NULL,NULL,'2023-03-30 18:07:33'),(11,'Compartir informacin restringida en onedrive con usuarios externos','automatic',NULL,NULL,'2023-03-30 18:07:33'),(12,'Deteccin de archivos malilciosos - malware','automatic',NULL,NULL,'2023-03-30 18:07:33'),(13,'Privilegios especiales asignados al nuevo inicio de sesin','automatic',NULL,NULL,'2023-03-30 18:07:33'),(14,'Creacin o desactivacin de usuarios fuera de horario laboral','automatic',NULL,NULL,'2023-03-30 18:07:33'),(15,'Vulnerabilidades detectadas','automatic',NULL,NULL,'2023-03-30 18:07:33'),(16,'Prdida/robo de porttiles','automatic',NULL,NULL,'2023-03-30 18:07:34'),(19,'Malware encontrado','automatic',1861,5,'2023-04-05 10:50:56'),(20,'Display bloqueado','automatic',1738,3,'2023-04-06 12:43:32'),(24,'TEST','automatic',121,1212,'2023-04-17 10:48:05'),(27,'Pedro','automatic',56456,46,'2023-05-13 18:40:43');
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kri_event`
--

DROP TABLE IF EXISTS `kri_event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kri_event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kri_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kri_event`
--

LOCK TABLES `kri_event` WRITE;
/*!40000 ALTER TABLE `kri_event` DISABLE KEYS */;
INSERT INTO `kri_event` VALUES (10,6,9,'2023-05-14 13:11:41'),(11,6,12,'2023-05-14 13:11:41');
/*!40000 ALTER TABLE `kri_event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kris`
--

DROP TABLE IF EXISTS `kris`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kris` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kri` varchar(255) DEFAULT NULL,
  `objective` varchar(255) DEFAULT NULL,
  `propertie_id` int(11) DEFAULT NULL,
  `percentage` int(3) DEFAULT NULL,
  `syntax` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kris`
--

LOCK TABLES `kris` WRITE;
/*!40000 ALTER TABLE `kris` DISABLE KEYS */;
INSERT INTO `kris` VALUES (6,'Deteccion de archivos','Detectar archivos maliciosos y compararlos con los archivos privados de los usuarios de sophos',1,20,'9-12','2023-05-14 13:11:41');
/*!40000 ALTER TABLE `kris` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_qualifier`
--

DROP TABLE IF EXISTS `master_qualifier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `master_qualifier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `high` int(11) DEFAULT NULL,
  `medium` int(11) DEFAULT NULL,
  `low` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_qualifier`
--

LOCK TABLES `master_qualifier` WRITE;
/*!40000 ALTER TABLE `master_qualifier` DISABLE KEYS */;
/*!40000 ALTER TABLE `master_qualifier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `properties`
--

DROP TABLE IF EXISTS `properties`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `properties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `propertie` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `properties`
--

LOCK TABLES `properties` WRITE;
/*!40000 ALTER TABLE `properties` DISABLE KEYS */;
INSERT INTO `properties` VALUES (1,'confidencialidad','2023-03-28 21:29:32'),(2,'disponibilidad','2023-03-28 21:29:32'),(3,'integridad','2023-03-28 21:29:32');
/*!40000 ALTER TABLE `properties` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qualifiers`
--

DROP TABLE IF EXISTS `qualifiers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `qualifiers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) DEFAULT NULL,
  `value` int(11) DEFAULT NULL,
  `kri_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qualifiers`
--

LOCK TABLES `qualifiers` WRITE;
/*!40000 ALTER TABLE `qualifiers` DISABLE KEYS */;
INSERT INTO `qualifiers` VALUES (11,'Bajo',1,6,'2023-05-14 13:11:41'),(12,'Medio',3,6,'2023-05-14 13:11:41'),(13,'Alto',5,6,'2023-05-14 13:11:41'),(14,'Extremo',7,6,'2023-05-14 13:11:41');
/*!40000 ALTER TABLE `qualifiers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `records`
--

DROP TABLE IF EXISTS `records`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `records` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `source_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `reported_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `records`
--

LOCK TABLES `records` WRITE;
/*!40000 ALTER TABLE `records` DISABLE KEYS */;
INSERT INTO `records` VALUES (1,1861,5,'2023-01-21 12:00:00','2023-05-14 14:38:08'),(2,1861,5,'2023-01-21 12:00:00','2023-05-14 14:42:31'),(3,1738,3,'2023-01-23 13:00:00','2023-05-14 14:42:31'),(4,1861,5,'2023-01-21 12:00:00','2023-05-14 14:42:34'),(5,1738,3,'2023-01-23 13:00:00','2023-05-14 14:42:34'),(6,1861,5,'2023-01-21 12:00:00','2023-05-14 14:42:35'),(7,1738,3,'2023-01-23 13:00:00','2023-05-14 14:42:35'),(8,1861,5,'2023-01-21 12:00:00','2023-05-14 14:42:36'),(9,1738,3,'2023-01-23 13:00:00','2023-05-14 14:42:36'),(10,1861,5,'2023-01-21 12:00:00','2023-05-14 14:42:44'),(11,121,1212,'2023-01-21 12:00:00','2023-05-14 14:43:24'),(12,121,1212,'2023-01-21 12:00:00','2023-05-14 14:43:25'),(13,121,1212,'2023-01-21 12:00:00','2023-05-14 14:43:26'),(14,121,1212,'2023-01-21 12:00:00','2023-05-14 14:43:26'),(15,121,1212,'2023-01-21 12:00:00','2023-05-14 14:43:27'),(16,56456,46,'2023-01-21 12:00:00','2023-05-14 14:43:46'),(17,56456,46,'2023-01-21 12:00:00','2023-05-14 14:43:47'),(18,56456,46,'2023-01-21 12:00:00','2023-05-14 14:43:47'),(19,56456,46,'2023-01-21 12:00:00','2023-05-14 14:43:48'),(20,56456,46,'2023-01-21 12:00:00','2023-05-14 14:43:48'),(21,56456,466,'2023-01-21 12:00:00','2023-05-14 14:45:50');
/*!40000 ALTER TABLE `records` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `risk_kri`
--

DROP TABLE IF EXISTS `risk_kri`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `risk_kri` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `risk_id` int(11) DEFAULT NULL,
  `kri_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `risk_kri`
--

LOCK TABLES `risk_kri` WRITE;
/*!40000 ALTER TABLE `risk_kri` DISABLE KEYS */;
INSERT INTO `risk_kri` VALUES (1,1,1,'2023-03-30 19:34:49'),(2,1,2,'2023-03-30 19:34:49');
/*!40000 ALTER TABLE `risk_kri` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `risks`
--

DROP TABLE IF EXISTS `risks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `risks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) DEFAULT NULL,
  `propertie_id` int(11) DEFAULT NULL,
  `risk` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `risks`
--

LOCK TABLES `risks` WRITE;
/*!40000 ALTER TABLE `risks` DISABLE KEYS */;
INSERT INTO `risks` VALUES (1,3,3,'Prdida financiera causada por Acceso no autorizado','2023-03-30 18:06:22'),(2,3,2,'Sancin legal causada por Fuga de informacin malintencionada','2023-03-30 18:06:22'),(3,3,3,'Prdida financiera causada por Fuga de informacin por error involuntario','2023-03-30 18:06:22'),(4,2,1,'Prdida operativa causada por Ingeniera social/Spear Phising, Cryptojacking/Cryptomining, Cloud-Jacking, Ramsonware, Cyber espionaje, IoT, Hacktivism, Crimen organizado, Fearware, Coordinated attack, Cyber warfare','2023-03-30 18:06:22'),(5,4,1,'Prdida operativa causada por Ataque Fuerza bruta, Desbordamiento buffer, XSS, MiM, Spoof, Inyeccion SQL','2023-03-30 18:06:22'),(6,4,1,'Perdida de capacidad tecnolgica causada por Suplantacin de identidad','2023-03-30 18:06:22'),(7,5,1,'Perdida de capacidad tecnolgica causada por Abuso o elevacin de privilegios','2023-03-30 18:06:22'),(8,5,3,'Prdida financiera causada por Modificacin de la informacin por error involuntario','2023-03-30 18:06:22'),(9,1,3,'Sancin legal causada por Modificacin de la informacin malintencionada','2023-03-30 18:06:22'),(10,4,2,'Prdida financiera causada por Robo','2023-03-30 18:06:22'),(11,2,1,'Prdida operativa causada por Ataque informtico (Malware, APT, BackDoor, DoS)','2023-03-30 18:06:22'),(12,3,2,'Prdida operativa causada por Corte o fallas en el suministro elctrico','2023-03-30 18:06:22'),(13,4,1,'Prdida operativa causada por Dao por agua, humedad o lquidos','2023-03-30 18:06:22'),(14,3,2,'Perdida de capacidad tecnolgica causada por Denegacin de servicio malintencionado','2023-03-30 18:06:22'),(15,2,2,'Perdida de capacidad tecnolgica causada por Denegacin de servicio por error involuntario','2023-03-30 18:06:22'),(16,2,3,'Prdida operativa causada por Descarga elctrica','2023-03-30 18:06:22'),(17,3,2,'Prdida estratgica causada por Destruccin de la informacin por error involuntario','2023-03-30 18:06:22'),(18,2,2,'Prdida financiera causada por Destruccin o eliminacin de la informacin malintencionada','2023-03-30 18:06:22'),(19,4,2,'Prdida financiera causada por Fuego','2023-03-30 18:06:22'),(20,3,1,'Prdida operativa causada por Interferencia electromagntica','2023-03-30 18:06:22'),(21,3,3,'Prdida operativa causada por Paro','2023-03-30 18:06:23'),(22,2,1,'Prdida operativa causada por Pandemias (Covid-19, emergentes)','2023-03-30 18:06:23'),(23,4,1,'Prdida operativa causada por Terremoto','2023-03-30 18:06:24');
/*!40000 ALTER TABLE `risks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sources`
--

DROP TABLE IF EXISTS `sources`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sources` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `source` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sources`
--

LOCK TABLES `sources` WRITE;
/*!40000 ALTER TABLE `sources` DISABLE KEYS */;
/*!40000 ALTER TABLE `sources` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `types`
--

DROP TABLE IF EXISTS `types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `types`
--

LOCK TABLES `types` WRITE;
/*!40000 ALTER TABLE `types` DISABLE KEYS */;
INSERT INTO `types` VALUES (1,'estrategico','2023-03-28 22:02:20'),(2,'financiero','2023-03-28 22:02:20'),(3,'legal','2023-03-28 22:02:20'),(4,'operacional','2023-03-30 17:27:18'),(5,'tecnologico','2023-03-30 17:27:18');
/*!40000 ALTER TABLE `types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'DragonyteEvol','acuarionevol@outlook.com','$2y$10$Ws65FRcPjyK6eSI0bDcPIurUe.QlzLG6zctOAuwIzXBcsWI./7GSq','2023-03-26 10:26:18');
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

-- Dump completed on 2023-09-04 10:39:18
