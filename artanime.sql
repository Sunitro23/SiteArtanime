-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 22 juin 2022 à 12:45
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `artanime`
--
CREATE DATABASE IF NOT EXISTS `artanime` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `artanime`;

-- --------------------------------------------------------

--
-- Structure de la table `activites`
--

DROP TABLE IF EXISTS `activites`;
CREATE TABLE IF NOT EXISTS `activites` (
  `idActivites` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(30) NOT NULL,
  `description` varchar(4000) NOT NULL,
  `color` varchar(20) NOT NULL,
  PRIMARY KEY (`idActivites`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `activites`
--

INSERT INTO `activites` (`idActivites`, `titre`, `description`, `color`) VALUES
(12, 'Eveil à la danse', 'Eveil a la danse', '#9ef4ff');

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `login` varchar(20) NOT NULL,
  `mdp` varchar(42) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`login`, `mdp`) VALUES
('A.Masse', '*3D4AC83FC432B0089DB4A6325CC05BABA94BAC86');

-- --------------------------------------------------------

--
-- Structure de la table `animateurs`
--

DROP TABLE IF EXISTS `animateurs`;
CREATE TABLE IF NOT EXISTS `animateurs` (
  `idAnim` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `description` varchar(2500) NOT NULL,
  `imgAnim` varchar(30) NOT NULL,
  PRIMARY KEY (`idAnim`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `animateurs`
--

INSERT INTO `animateurs` (`idAnim`, `nom`, `prenom`, `description`, `imgAnim`) VALUES
(2, 'ELYN', 'Christiane', 'Le Pilates est pratiquée au tapis avec ou sans accessoires ou à l\'aide d\'appareils. Elle a pour objectif le développement des muscles profonds, l\'amélioration de la posture, l\'équilibrage musculaire et l\'assouplissement articulaire, pour un entretien, une amélioration ou une restauration des fonctions physiques.', 'ELYN.webp'),
(3, 'DJAFOUR', 'Houda', 'Houda , animatrice de danse orientale Et berbère depuis 10 ans.\r\nLa danse orientale est un art qui allie sensualité grâce et technique sur des rythmes du moyen et proche orient.. Les musiques peuvent-être lentes ou très rythmées. . modernes ou traditionnelles comme Le. baladi ou le sharky par exemple .Elle attire pour son côté magique des milles et une nuit. Nous souhaiterions développer dans nos cours les étapes d\'apprentissage suivantes : découvertes et exercices de rythme, découverte et apprentissage des bases de la danse orientale (rond orientaux, le sharky, le tremblement, le twist ….)\r\n\r\nEn fonction de leur niveau de danse les élèves pourront apprendre à manier des accessoires : voiles, foulards, cannes, éventail, aile d\'Isis, tambourin etc... Les élèves auront l\'occasion de préparer une chorégraphie qui sera le fruit de leur travail ..La danse est aussi un loisir c\'est pourquoi les élèves auront l\'opportunité de donner leurs idées et d\'exprimer leur imagination.', 'HoudaDJAFOUR.webp'),
(4, 'NOWAK', 'Adrien', 'Bonjour à tous, avec moi, vous apprendrez les bases du piano et comment savoir lire une partition rapidement (vous verrez c\'est très facile !). Dans un cours d\'une heure par semaine, nous mêleront donc piano et solfège pour que l\'apprentissage soit plus intéressant. Débutant ou amateur en solfège, tout le monde est accepté ! Nous apprendrons aussi comment accompagner des chansons et déchiffrer des accords ! Bref, curieux du piano, vous êtes les bienvenus.', 'AndreAnim.webp');

-- --------------------------------------------------------

--
-- Structure de la table `conseiladmin`
--

DROP TABLE IF EXISTS `conseiladmin`;
CREATE TABLE IF NOT EXISTS `conseiladmin` (
  `idCA` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `imgCA` varchar(30) NOT NULL,
  `fonction` varchar(30) NOT NULL,
  PRIMARY KEY (`idCA`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `conseiladmin`
--

INSERT INTO `conseiladmin` (`idCA`, `nom`, `prenom`, `imgCA`, `fonction`) VALUES
(2, 'NOWAK', 'André', 'ANDRE.png', 'Président'),
(3, 'CALVANUS', 'Myriam', 'CALVANUS.webp', 'Trésorière'),
(4, 'HYZARD', 'Claudine', 'HYZARD.webp', 'Trésorière Adjointe'),
(6, 'SULMON', 'Stéphane', 'SULMON.webp', 'Administrateur'),
(7, 'LEFEBVRE', 'Julie', 'JLEFEBVRE.webp', 'Administratrice'),
(8, 'GAILLET', 'Thomas', 'GAILLET.webp', 'Administrateur');

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

DROP TABLE IF EXISTS `cours`;
CREATE TABLE IF NOT EXISTS `cours` (
  `idCours` int(11) NOT NULL AUTO_INCREMENT,
  `jour` int(11) NOT NULL,
  `heureDebut` int(11) NOT NULL,
  `heureFin` int(11) NOT NULL,
  `idActivites` int(11) NOT NULL,
  `idAnim` int(11) NOT NULL,
  `addresse` varchar(60) NOT NULL,
  `niveau` varchar(20) NOT NULL,
  PRIMARY KEY (`idCours`),
  KEY `idActivites` (`idActivites`),
  KEY `idAnim` (`idAnim`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cours`
--

INSERT INTO `cours` (`idCours`, `jour`, `heureDebut`, `heureFin`, `idActivites`, `idAnim`, `addresse`, `niveau`) VALUES
(1, 1, 12, 15, 12, 2, 'Rue des Sans Abris', 'Enfant');

-- --------------------------------------------------------

--
-- Structure de la table `evenements`
--

DROP TABLE IF EXISTS `evenements`;
CREATE TABLE IF NOT EXISTS `evenements` (
  `idEvent` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(30) NOT NULL,
  `description` varchar(4000) NOT NULL,
  `date` date NOT NULL,
  `addresse` varchar(60) NOT NULL,
  `horaires` varchar(25) NOT NULL,
  PRIMARY KEY (`idEvent`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `evenements`
--

INSERT INTO `evenements` (`idEvent`, `titre`, `description`, `date`, `addresse`, `horaires`) VALUES
(10, 'ZUMBA PARTY', 'Ambiance Fluo.', '2019-10-11', 'Salle Kerkhove Leers', '19h à 22h');

-- --------------------------------------------------------

--
-- Structure de la table `imageactivite`
--

DROP TABLE IF EXISTS `imageactivite`;
CREATE TABLE IF NOT EXISTS `imageactivite` (
  `idImgA` int(11) NOT NULL AUTO_INCREMENT,
  `imgName` varchar(60) NOT NULL,
  `idActivites` int(11) NOT NULL,
  PRIMARY KEY (`idImgA`),
  KEY `idActivites` (`idActivites`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `imageactivite`
--

INSERT INTO `imageactivite` (`idImgA`, `imgName`, `idActivites`) VALUES
(12, 'eveildanse.webp', 12);

-- --------------------------------------------------------

--
-- Structure de la table `imageevent`
--

DROP TABLE IF EXISTS `imageevent`;
CREATE TABLE IF NOT EXISTS `imageevent` (
  `idImgE` int(11) NOT NULL AUTO_INCREMENT,
  `imgName` varchar(60) NOT NULL,
  `idEvent` int(11) NOT NULL,
  PRIMARY KEY (`idImgE`),
  KEY `idEvent` (`idEvent`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `imageevent`
--

INSERT INTO `imageevent` (`idImgE`, `imgName`, `idEvent`) VALUES
(8, 'zumbapart.webp', 10);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cours`
--
ALTER TABLE `cours`
  ADD CONSTRAINT `cours_ibfk_1` FOREIGN KEY (`idActivites`) REFERENCES `activites` (`idActivites`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cours_ibfk_2` FOREIGN KEY (`idAnim`) REFERENCES `animateurs` (`idAnim`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `imageactivite`
--
ALTER TABLE `imageactivite`
  ADD CONSTRAINT `imageactivite_ibfk_1` FOREIGN KEY (`idActivites`) REFERENCES `activites` (`idActivites`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `imageevent`
--
ALTER TABLE `imageevent`
  ADD CONSTRAINT `imageevent_ibfk_1` FOREIGN KEY (`idEvent`) REFERENCES `evenements` (`idEvent`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
