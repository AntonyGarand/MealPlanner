-- MySQL dump 10.13  Distrib 5.1.72, for Win64 (unknown)
--
-- Host: localhost    Database: monmenu_garandantony
-- ------------------------------------------------------
-- Server version	5.1.72-community

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
-- Table structure for table `recette`
--

DROP TABLE IF EXISTS `recette`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recette` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `preparation` text NOT NULL,
  `ingredients` text NOT NULL,
  `tempsPreparation` varchar(25) NOT NULL,
  `tempsCuisson` varchar(25) NOT NULL,
  `tempsTotal` varchar(25) NOT NULL,
  `nom` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recette`
--

LOCK TABLES `recette` WRITE;
/*!40000 ALTER TABLE `recette` DISABLE KEYS */;
INSERT INTO `recette` VALUES (46,'ndsa','ndu','sa','dwqd','dnsaoi','Recette demo'),(47,'Mettre le pain et les raisins au four','pain\r\nraisin\r\n','2h','2h','4h','Pain raisin'),(48,'Battre les oeufs\r\nCuire','Oeufs\r\nFarine','2h','3h','5h','Crêpes'),(49,'Mélager le tout','Pain\r\nBananes\r\n','30 mins','2h ','2h30','Pain aux bananes');
/*!40000 ALTER TABLE `recette` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `repas`
--

DROP TABLE IF EXISTS `repas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `repas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jour` int(11) NOT NULL COMMENT 'Int 0-6 en fonction de la journée. 0 - lundi, 1 - mardi, 2 - mercredi',
  `nbConvives` int(11) NOT NULL,
  `typeRepas` int(11) NOT NULL COMMENT 'Int de 1-3 en fonction de la période. 1 - déjeuner, 2 diner, 3 souper',
  `description` text NOT NULL,
  `recette_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `recette_id` (`recette_id`),
  CONSTRAINT `repas_ibfk_1` FOREIGN KEY (`recette_id`) REFERENCES `recette` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `repas`
--

LOCK TABLES `repas` WRITE;
/*!40000 ALTER TABLE `repas` DISABLE KEYS */;
INSERT INTO `repas` VALUES (18,1,1,1,'toto',46),(20,1,1,1,'nuildsa',47),(21,1,1,1,'Repas demo',46),(22,1,1,1,'toto',47),(23,1,1,1,'toto',47),(24,1,1,1,'toto',47),(25,1,1,1,'toto',47),(26,1,1,1,'toto',47),(27,1,1,1,'toto',47),(28,1,1,1,'toto',47),(29,1,1,1,'Déjeuner',48),(30,3,1,1,'Déjeuner mercredi',48),(31,3,1,1,'Déjeuner mercredi',48);
/*!40000 ALTER TABLE `repas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-10-05 11:33:21
