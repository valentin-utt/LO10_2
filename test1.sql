-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 27, 2019 at 03:00 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test1`
--

-- --------------------------------------------------------

--
-- Table structure for table `likes_table`
--

DROP TABLE IF EXISTS `likes_table`;
CREATE TABLE IF NOT EXISTS `likes_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project_table`
--

DROP TABLE IF EXISTS `project_table`;
CREATE TABLE IF NOT EXISTS `project_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner` mediumtext COLLATE utf8_unicode_520_ci NOT NULL,
  `name` mediumtext COLLATE utf8_unicode_520_ci NOT NULL,
  `cat` mediumtext COLLATE utf8_unicode_520_ci NOT NULL,
  `description` mediumtext COLLATE utf8_unicode_520_ci NOT NULL,
  `place` mediumtext COLLATE utf8_unicode_520_ci NOT NULL,
  `img` mediumtext COLLATE utf8_unicode_520_ci NOT NULL,
  `vid` mediumtext COLLATE utf8_unicode_520_ci NOT NULL,
  `mode` mediumtext COLLATE utf8_unicode_520_ci NOT NULL,
  `goal` float NOT NULL,
  `longitude` double DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `fund` float DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

--
-- Dumping data for table `project_table`
--

INSERT INTO `project_table` (`id`, `owner`, `name`, `cat`, `description`, `place`, `img`, `vid`, `mode`, `goal`, `longitude`, `latitude`, `fund`) VALUES
(34, 'valentin.guilloux@utt.fr', 'Voiture solaire', 'design_tech', 'Un projet de voiture solaire par un club des étudiants de l\'UTT.', 'UTT', 'https://www.ecosources.info/images/energie_transport/voiture_solaire_Eclectic.jpg', 'https://www.youtube.com/watch?v=HecSq29L6DI', 'Cagnote', 1500, 4.06649591050645, 48.269078, 75),
(36, 'nicolas.huchon@utt.fr', 'Sensibilisation aux plats vegans', 'food', 'Une journÃ©e de sensibilisation aux plats vegans par une association de l\'universitÃ© de Rennes', 'Rennes', 'https://static.cuisineaz.com/680x357/i102638-plats-vegans.jpg', 'https://www.youtube.com/watch?v=xSKjeFaTe_A', 'Forfait', 20, -1.6800198, 48.1113387, 0),
(40, 'jade.venault@utt.fr', 'Sculture superbe', 'art', 'Un magnifique projet des Ã©tudiants des beaux-art', 'Versailles', 'https://www.wanda-collection.com/ori-deco-moderne-jardin-statue-poisson-petit-modele-brun-50cm-4397.jpg', 'https://www.youtube.com/watch?v=9Uw-yyAeUQk', 'Cagnote', 5000, 2.1266886, 48.8035403, 0),
(41, 'pierre.dupont@gmail.com', 'Station mÃ©tÃ©o', 'design_tech', 'Un projet de construction de  station mÃ©tÃ©o autonome par des Ã©tudiants de genie climatique de l\'universitÃ© de Toulouse. L\'argent permetrat d\'Ã©tudier les micros variations climatiques du dÃ©partement de la haute garrone.', 'Toulouse', 'https://www.meteo-shopping.fr/pics/Station-meteo-Vantage-Vue-Station_meteo_Vantage_Vue_6250EU_Davis_Instruments.jpg', 'https://www.youtube.com/watch?v=oFZAq1sNgMU', 'Forfait', 150, 1.4442469, 43.6044622, 0),
(42, 'typhaine.machard@laposte.net', 'Court mÃ©trage : la vie de Victor Hugo', 'cinema', 'Un projet cinematographique d\'un club d\'Ã©tudiant en Ã©cole de thÃ©atre : retracer la vie du cÃ©lÃ©bre Victor Hugo dans sa pÃ©riode d\'isolation insulaire de la fin de sa vie.', 'Bourges', 'https://odiaspora.org/wp-content/uploads/2017/03/tournage-d-un-court-metrage.jpeg', 'https://www.youtube.com/watch?v=kZqVqsQGi-g', 'Cagnote', 1500, 2.398932, 47.0805693, 0),
(43, 'robin.dupont@gmail.com', 'Nouvelle fresque murale', 'art', 'L\'association des Ã©tudiants peintres de la licence art plastique de l\'universitÃ© de Bordeaux propose une cagnote pour rÃ©aliser une  fresque murale sur le batiment de la mairie de la ville. ', 'Bordeaux', 'https://www.chakipet.com/wp-content/uploads/mlle-hipolyte-papier-1.jpg', 'https://www.youtube.com/watch?v=gQ0M9mh4XpY', 'Cagnote', 250, -0.5800364, 44.841225, 0),
(44, 'robin.dupont@gmail.com', 'Sous-marin experimental', 'design_tech', 'L\'association de robotique des Ã©tudiants de l\'Ã©cole nationale d\'ingÃ©nieurs de Brest ont pour projet de construire un sous marin autonome.', 'Brest', 'http://www.yonder.fr/sites/default/files/news/A-Four%20Seasons%20__%20%20Landaa%20Giraavaru__%20DeepFlight%20Adventures%20MLG_758.jpg', 'https://www.youtube.com/watch?v=7UPeBA311xE', 'Cagnote', 20000, -4.4860088, 48.3905283, 0),
(46, 'valentin.guilloux@utt.fr', 'Course D\'auto-Stop', 'game', 'Un projet d\'un club Ã©tudiant de Lyon qui vous emenera au bout de monde pour la bonne cause humanitaire. Vivez l\'aventure de partir en binÃ´me vers une destination inconnue avec 2 â‚¬ en poche par jour.\r\n', 'Lyon', 'https://admin.rezopouce.fr/uploads/actualites/98b18b6b9187e2085a5c2807404928da.jpg', ' https://www.youtube.com/watch?v=hVG4ZXY5YAU', 'Forfait', 150, 4.8320114, 45.7578137, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

DROP TABLE IF EXISTS `user_table`;
CREATE TABLE IF NOT EXISTS `user_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` longtext COLLATE utf8_unicode_520_ci NOT NULL,
  `email` longtext COLLATE utf8_unicode_520_ci NOT NULL,
  `password` longtext COLLATE utf8_unicode_520_ci NOT NULL,
  `student` longtext COLLATE utf8_unicode_520_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`id`, `pseudo`, `email`, `password`, `student`) VALUES
(20, 'Valentin Guilloux', 'valentin.guilloux@utt.fr', 'secret', 'yes'),
(21, 'Nicolas Huchon', 'nicolas.huchon@utt.fr', 'secret', 'yes'),
(22, 'Jade Venault', 'jade.venault@utt.fr', 'secret', 'yes'),
(23, 'Pierre Dupond', 'pierre.dupont@gmail.com', 'secret', 'yes'),
(24, 'typhaine machard', 'typhaine.machard@laposte.net', 'secret', 'yes'),
(25, 'Robin Dupont', 'robin.dupont@gmail.com', 'secret', 'yes');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
