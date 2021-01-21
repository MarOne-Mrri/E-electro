-- MySQL dump 10.13  Distrib 5.7.30, for Linux (i686)
--
-- Host: localhost    Database: store
-- ------------------------------------------------------
-- Server version	5.7.30-0ubuntu0.16.04.1

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
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article` (
  `id_article` varchar(150) NOT NULL,
  `marque` varchar(30) NOT NULL,
  `prix_unitaire` decimal(7,2) NOT NULL,
  `categorie` varchar(50) NOT NULL,
  PRIMARY KEY (`id_article`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article`
--

LOCK TABLES `article` WRITE;
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
INSERT INTO `article` VALUES ('Apple iPad Mini -Wi-Fi, 64GB- - Space Gray -Latest Model-','APPLE',3400.00,'tablette tactile'),('Fire 7 Tablet -7  display, 16 GB- - Black','FIRE',600.00,'tablette tactile'),('Google - Pixel 3a with 64GB Memory Cell Phone -Unlocked- - Just Black','GOOGLE',3786.50,'smartphone'),('Honor 9X -128GB, 6GB- 6.59 , 3 AI Cameras, 4000mAh Battery, Dual SIM GSM Unlocked US   Global 4G LTE International Model STK-LX3','HUAWEI',2270.00,'smartphone'),('HTC U11 64GB Single SIM Factory Unlocked Android OS Smartphone -Sapphire Blue- - International Version','HTC',3250.00,'smartphone'),('Insignia NS-32DF310NA19 32-inch Smart HD TV - Fire TV Edition','INSIGNIA',1399.99,'tv'),('LG 22LJ4540 TV, 22-Inch 1080p IPS LED - 2017 Mode','LG',1500.00,'tv'),('Samsung Galaxy Tab A 8.0  32 GB Wifi Android 9.0 Pie Tablet Black -2019- - SM-T290NZKAXAR','SAMSUNG',1350.00,'tablette tactile'),('Vizio D32F-G D-Series 32  Class 1080p LED LCD Smart Full-Array LED LCD TV -2019 Model- -Renewed-','VIZIO',1799.90,'tv');
/*!40000 ALTER TABLE `article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `client` (
  `id_client` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `mot_passe` varchar(255) NOT NULL,
  `date_naissance` date DEFAULT NULL,
  `adresse` varchar(50) DEFAULT NULL,
  `ville` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_client`),
  UNIQUE KEY `client_idx` (`prenom`,`nom`),
  UNIQUE KEY `client_idx1` (`mail`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client`
--

LOCK TABLES `client` WRITE;
/*!40000 ALTER TABLE `client` DISABLE KEYS */;
INSERT INTO `client` VALUES (1,'nc','pc','a@gmail.com','*6BB4837EB74329105EE4568DDA7DC67ED2CA2AD9',NULL,NULL,NULL),(2,'you','me','b@gmail.com','*6691484EA6B50DDDE1926A220DA01FA9E575C18A',NULL,NULL,NULL);
/*!40000 ALTER TABLE `client` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commande`
--

DROP TABLE IF EXISTS `commande`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `commande` (
  `id_commande` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `valide` tinyint(1) NOT NULL DEFAULT '0',
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id_commande`),
  KEY `client_commande_fk` (`client_id`),
  CONSTRAINT `client_commande_fk` FOREIGN KEY (`client_id`) REFERENCES `client` (`id_client`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commande`
--

LOCK TABLES `commande` WRITE;
/*!40000 ALTER TABLE `commande` DISABLE KEYS */;
/*!40000 ALTER TABLE `commande` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ligne`
--

DROP TABLE IF EXISTS `ligne`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ligne` (
  `article_id` varchar(100) NOT NULL,
  `commande_id` int(11) NOT NULL,
  `quantite` smallint(6) NOT NULL DEFAULT '1',
  `prix` decimal(10,2) NOT NULL,
  PRIMARY KEY (`article_id`,`commande_id`),
  KEY `commande_ligne_fk` (`commande_id`),
  CONSTRAINT `article_ligne_fk` FOREIGN KEY (`article_id`) REFERENCES `article` (`id_article`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `commande_ligne_fk` FOREIGN KEY (`commande_id`) REFERENCES `commande` (`id_commande`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ligne`
--

LOCK TABLES `ligne` WRITE;
/*!40000 ALTER TABLE `ligne` DISABLE KEYS */;
/*!40000 ALTER TABLE `ligne` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-07-25 11:55:47
