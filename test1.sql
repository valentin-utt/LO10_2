-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 12 juin 2019 à 10:33
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `test1`
--

-- --------------------------------------------------------

--
-- Structure de la table `fund_table`
--

DROP TABLE IF EXISTS `fund_table`;
CREATE TABLE IF NOT EXISTS `fund_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `fund` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

--
-- Déchargement des données de la table `fund_table`
--

INSERT INTO `fund_table` (`id`, `user_id`, `project_id`, `fund`) VALUES
(5, 20, 43, 10),
(6, 20, 44, 0),
(7, 20, 44, 40),
(8, 20, 36, 0),
(9, 20, 42, 1),
(10, 20, 47, 10),
(11, 20, 47, 1000),
(12, 20, 47, 1000),
(13, 20, 47, 1000),
(14, 20, 47, 10),
(15, 20, 47, 10),
(16, 20, 47, 40),
(17, 20, 47, 2),
(18, 20, 47, 2),
(19, 20, 47, 2),
(20, 20, 47, 2);

-- --------------------------------------------------------

--
-- Structure de la table `likes_table`
--

DROP TABLE IF EXISTS `likes_table`;
CREATE TABLE IF NOT EXISTS `likes_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

--
-- Déchargement des données de la table `likes_table`
--

INSERT INTO `likes_table` (`id`, `project_id`, `user_id`) VALUES
(17, 40, 20);

-- --------------------------------------------------------

--
-- Structure de la table `project_table`
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
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

--
-- Déchargement des données de la table `project_table`
--

INSERT INTO `project_table` (`id`, `owner`, `name`, `cat`, `description`, `place`, `img`, `vid`, `mode`, `goal`, `longitude`, `latitude`, `fund`) VALUES
(34, 'valentin.guilloux@utt.fr', 'Voiture solaire', 'design_tech', 'Un projet de voiture solaire par un club des étudiants de l\'UTT.', 'UTT', 'https://www.ecosources.info/images/energie_transport/voiture_solaire_Eclectic.jpg', 'https://www.youtube.com/watch?v=HecSq29L6DI', 'Cagnote', 1500, 4.06649591050645, 48.269078, 76),
(36, 'nicolas.huchon@utt.fr', 'Sensibilisation aux plats vegans', 'food', 'Une journée de sensibilisation aux plats vegans organisé dans le centre ville de Rennes.', 'Rennes', 'https://static.cuisineaz.com/680x357/i102638-plats-vegans.jpg', 'https://www.youtube.com/watch?v=xSKjeFaTe_A', 'Forfait', 20, -1.6800198, 48.1113387, 15),
(40, 'jade.venault@utt.fr', 'Sculture superbe', 'art', 'Un magnifique projet des Ã©tudiants des beaux-art', 'Versailles', 'https://www.wanda-collection.com/ori-deco-moderne-jardin-statue-poisson-petit-modele-brun-50cm-4397.jpg', 'https://www.youtube.com/watch?v=9Uw-yyAeUQk', 'Cagnote', 5000, 2.1266886, 48.8035403, 2000),
(41, 'pierre.grangaud@utt.fr', 'Station météo', 'design_tech', 'Un projet de construction de  station météo autonome par des étudiants de genie climatique de l\'Université de Technologie de Troyes. L\'argent permetrat d\'étudier les micros variations climatiques du département de la haute garrone.', 'Toulouse', 'https://www.meteo-shopping.fr/pics/Station-meteo-Vantage-Vue-Station_meteo_Vantage_Vue_6250EU_Davis_Instruments.jpg', 'https://www.youtube.com/watch?v=oFZAq1sNgMU', 'Forfait', 150, 1.4442469, 43.6044622, 5),
(42, 'nicolas.huchon@utt.fr', 'Court métrage : la vie de Victor Hugo', 'cinema', 'Un projet cinematographique d\'un club d\'étudiant : retracer la vie du célèbre Victor Hugo dans sa période d\'isolation insulaire de la fin de sa vie.', 'Bourges', 'https://odiaspora.org/wp-content/uploads/2017/03/tournage-d-un-court-metrage.jpeg', 'https://www.youtube.com/watch?v=kZqVqsQGi-g', 'Cagnote', 1500, 2.398932, 47.0805693, 1),
(43, 'jade.venault@utt.fr', 'Nouvelle fresque murale', 'art', 'Un projet pour les étudiants peintres qui propose une cagnote pour réaliser une  fresque murale sur le batiment de la mairie de la ville de Bordeaux ', 'Bordeaux', 'https://www.chakipet.com/wp-content/uploads/mlle-hipolyte-papier-1.jpg', 'https://www.youtube.com/watch?v=gQ0M9mh4XpY', 'Cagnote', 250, -0.5800364, 44.841225, 130),
(44, 'alexis.comte@utt.fr', 'Sous-marin experimental', 'design_tech', 'L\'association de robotique des étudiants de l\'UTT ont pour projet de construire un sous marin autonome.', 'Brest', 'http://www.yonder.fr/sites/default/files/news/A-Four%20Seasons%20__%20%20Landaa%20Giraavaru__%20DeepFlight%20Adventures%20MLG_758.jpg', 'https://www.youtube.com/watch?v=7UPeBA311xE', 'Cagnote', 20000, -4.4860088, 48.3905283, 1545),
(46, 'valentin.guilloux@utt.fr', 'Course D\'auto-Stop', 'game', 'Un projet d\'un club étudiant de Lyon qui vous emenera au bout de monde pour la bonne cause humanitaire. Vivez l\'aventure de partir en binôme vers une destination inconnue avec 2 € en poche par jour.\r\n', 'Lyon', 'https://admin.rezopouce.fr/uploads/actualites/98b18b6b9187e2085a5c2807404928da.jpg', ' https://www.youtube.com/watch?v=hVG4ZXY5YAU', 'Forfait', 150, 4.8320114, 45.7578137, 0),
(47, 'valentin.guilloux@utt.fr', 'Peinture', 'art', 'une belle description', 'Rosière', 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c5/Edvard_Munch%2C_1893%2C_The_Scream%2C_oil%2C_tempera_and_pastel_on_cardboard%2C_91_x_73_cm%2C_National_Gallery_of_Norway.jpg/260px-Edvard_Munch%2C_1893%2C_The_Scream%2C_oil%2C_tempera_and_pastel_on_cardboard%2C_91_x_73_cm%2C_National_Gallery_of_Norway.jpg', 'https://www.youtube.com/watch?v=oWJZVq2SNPk', 'Cagnote', 1500, 4.0565359, 48.293151, 3078);

-- --------------------------------------------------------

--
-- Structure de la table `ue_table`
--

DROP TABLE IF EXISTS `ue_table`;
CREATE TABLE IF NOT EXISTS `ue_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `ue_sigle` varchar(50) COLLATE utf8_unicode_520_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=269 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

--
-- Déchargement des données de la table `ue_table`
--

INSERT INTO `ue_table` (`id`, `user_id`, `ue_sigle`) VALUES
(261, 20, 'LO10'),
(262, 20, 'IF08'),
(263, 20, 'IF11'),
(264, 20, 'IF05'),
(267, 22, 'PO03'),
(268, 22, 'LO10');

-- --------------------------------------------------------

--
-- Structure de la table `user_table`
--

DROP TABLE IF EXISTS `user_table`;
CREATE TABLE IF NOT EXISTS `user_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` longtext COLLATE utf8_unicode_520_ci NOT NULL,
  `email` longtext COLLATE utf8_unicode_520_ci NOT NULL,
  `password` longtext COLLATE utf8_unicode_520_ci NOT NULL,
  `student` longtext COLLATE utf8_unicode_520_ci NOT NULL,
  `studentid` int(10) NOT NULL,
  `branch` varchar(10) COLLATE utf8_unicode_520_ci NOT NULL,
  `level` varchar(10) COLLATE utf8_unicode_520_ci NOT NULL,
  `speciality` varchar(10) COLLATE utf8_unicode_520_ci NOT NULL,
  `access_token` varchar(32) COLLATE utf8_unicode_520_ci NOT NULL,
  `img_url` varchar(150) COLLATE utf8_unicode_520_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

--
-- Déchargement des données de la table `user_table`
--

INSERT INTO `user_table` (`id`, `pseudo`, `email`, `password`, `student`, `studentid`, `branch`, `level`, `speciality`, `access_token`, `img_url`) VALUES
(20, 'Valentin GUILLOUX', 'valentin.guilloux@utt.fr', 'secret', 'true', 38248, 'ISI', '6', 'MPL', '3cb09c4e686e1be293d24529cd426f21', 'https://s3-eu-west-1.amazonaws.com/projector.image/guillouv_official.jpg'),
(21, 'Nicolas Huchon', 'nicolas.huchon@utt.fr', 'secret', 'yes', 0, '', '', '', '', ''),
(22, 'Jade VENAULT', 'jade.venault@utt.fr', 'secret', 'true', 38100, 'ISI', '5', 'MPL', 'a1b907f2308643d93218e880a5cc9a17', 'https://s3-eu-west-1.amazonaws.com/projector.image/venaultj_official.jpg'),
(23, 'Pierre Grandgaud', 'pierre.grangaud@utt.fr', 'secret', 'yes', 0, '', '', '', '', ''),
(24, 'Alexis Comte', 'alexis.comte@utt.fr', 'secret', 'yes', 0, '', '', '', '', ''),
(25, 'Robin Dupont', 'robin.dupont@gmail.com', 'secret', 'yes', 0, '', '', '', '', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
