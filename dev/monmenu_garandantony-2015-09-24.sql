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
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recette`
--

LOCK TABLES `recette` WRITE;
/*!40000 ALTER TABLE `recette` DISABLE KEYS */;
INSERT INTO `recette` VALUES (1,'faire+chauffer','lazagne','4+heures','5+heures','9+heures','Lazagne'),(44,'Mettre le tout ensemble au four','Farine\r\nOeufs\r\nRaisins','2 heures','4 heures','6 heures','Pain aux raisins ');
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
  `jour` int(11) NOT NULL COMMENT 'Jour de la semaine (Lundi, Mardi, ...)',
  `nbConvives` int(11) NOT NULL,
  `typeRepas` int(11) NOT NULL COMMENT 'Int de 1-3 en fonction de la période. 1 - déjeuner, 2 diner, 3 souper',
  `description` text NOT NULL,
  `recette_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `recette_id` (`recette_id`),
  CONSTRAINT `repas_ibfk_1` FOREIGN KEY (`recette_id`) REFERENCES `recette` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `repas`
--

LOCK TABLES `repas` WRITE;
/*!40000 ALTER TABLE `repas` DISABLE KEYS */;
INSERT INTO `repas` VALUES (41,1,1337,3,'Souper',1),(42,1,1337,3,'Souper',1),(43,1,2,1,'Lundi matin',44);
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

-- Dump completed on 2015-09-24  9:29:18
