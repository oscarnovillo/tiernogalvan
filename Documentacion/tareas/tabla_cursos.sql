-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: clasesdaw
-- ------------------------------------------------------
-- Server version	5.7.20-log

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
-- Table structure for table `cursos`
--

DROP TABLE IF EXISTS `cursos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cursos` (
  `id_curso` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_curso` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `turno` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_curso`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cursos`
--

LOCK TABLES `cursos` WRITE;
/*!40000 ALTER TABLE `cursos` DISABLE KEYS */;
INSERT INTO `cursos` VALUES (1,'1º E.S.O.','ESO','m'),(2,'2º E.S.O.','ESO','m'),(3,'3º E.S.O.','ESO','m'),(4,'4º E.S.O.','ESO','m'),(5,'1º Bachillerato','BACH','m'),(6,'2º Bachillerato','BACH','m'),(7,'1º Mantenimiento de vehículos','FPB','m'),(8,'2º Mantenimiento de vehículos','FPB','m'),(9,'1º Mantenimiento de vehículos','FPB','t'),(10,'2º Mantenimiento de vehículos','FPB','t'),(11,'1º Carrocería','FPGM','m'),(12,'2º Carrocería','FPGM','m'),(13,'1º Instalaciones Eléctricas y Automáticas','FPGM','m'),(14,'2º Instalaciones Eléctricas y Automáticas','FPGM','m'),(15,'1º Instalaciones de Producción de Calor','FPGM',NULL),(16,'2º Instalaciones de Producción de Calor','FPGM','m'),(17,'1º ASIR','FPGS','t'),(18,'2º ASIR','FPGS','t'),(19,'1º Mantenimiento de Instalaciones Térmicas y Fluidos','FPGS','t'),(20,'2º Mantenimiento de Instalaciones Térmicas y Fluidos','FPGS','t'),(21,'1º Automoción','FPGS','t'),(22,'2º Automoción','FPGS','t'),(23,'1º DAW','FPGS','m'),(24,'2º DAW','FPGS','m');
/*!40000 ALTER TABLE `cursos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-05-20 20:16:41
