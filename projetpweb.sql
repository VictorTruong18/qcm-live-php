-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 18 nov. 2019 à 21:41
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projetpweb`
--

-- --------------------------------------------------------

--
-- Structure de la table `bilan`
--

DROP TABLE IF EXISTS `bilan`;
CREATE TABLE IF NOT EXISTS `bilan` (
  `id_bilan` int(11) NOT NULL AUTO_INCREMENT,
  `id_test` int(11) NOT NULL,
  `id_etu` int(11) NOT NULL,
  `note_test` int(11) NOT NULL,
  `date_bilan` date NOT NULL,
  PRIMARY KEY (`id_bilan`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `bilan`
--

INSERT INTO `bilan` (`id_bilan`, `id_test`, `id_etu`, `note_test`, `date_bilan`) VALUES
(1, 2, 1, 14, '2019-11-18'),
(2, 3, 4, 12, '2019-11-08'),
(3, 1, 2, 16, '2019-11-02'),
(4, 7, 1, 19, '2019-11-01');

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

DROP TABLE IF EXISTS `etudiant`;
CREATE TABLE IF NOT EXISTS `etudiant` (
  `id_etu` int(11) NOT NULL AUTO_INCREMENT,
  `genre` text COLLATE utf8_bin NOT NULL,
  `nom` text COLLATE utf8_bin NOT NULL,
  `prenom` text COLLATE utf8_bin NOT NULL,
  `email` text COLLATE utf8_bin NOT NULL,
  `login_etu` text COLLATE utf8_bin NOT NULL,
  `pass_etu` text COLLATE utf8_bin NOT NULL,
  `matricule` text COLLATE utf8_bin NOT NULL,
  `num_grpe` text COLLATE utf8_bin NOT NULL,
  `date_etu` date NOT NULL,
  `bConnect` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_etu`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`id_etu`, `genre`, `nom`, `prenom`, `email`, `login_etu`, `pass_etu`, `matricule`, `num_grpe`, `date_etu`, `bConnect`) VALUES
(1, 'M.', 'Tor', 'Michaël', 'michael.tor@etu.parisdescartes.fr', 'tor', 'a06ad5dbbfe4f53e49edb4064cfbe275727b1e98', '22701007', '206', '2017-09-01', 0),
(2, 'M.', 'Moustache', 'Félix', 'felix.moustache@etu.parisdescartes.fr', 'moustach', 'b45c8e654464ac3250a1e6bcdd3d944d5b6f3195', '22701011', '207', '2017-09-01', 0),
(3, 'M.', 'Nguyen', 'Rémi', 'paule.nguyen@etuparisdescartes.fr', 'nguyen1', '79415ace1535e3dbe779d110ae8b2407170fe53b', '22701012', '201', '2017-09-01', 0),
(4, 'Melle.', 'Nguyen', 'Paule', 'paule.nguyen@etuparisdescartes.fr', 'nguyen2', 'fd52fd4c888314f1cc71f20035cfc396cbd9fce5', '22701027', '202', '2017-09-01', 0),
(5, 'M.', 'Noirclerc', 'Thomas', 'toto@hotmail.fr', 'toutou', 'toutou', '556987', '202', '2019-11-18', 0),
(6, 'Melle.', 'PO', 'gertrude', 'gertrude.l@parisdescartes.com', 'gert', 'gigi', '9446617', '207', '2019-11-18', 0),
(7, 'Melle', 'SMITH', 'Jennyfer', 'jenjen@parisdescartes.com', 'jeff', 'jeff', '2211000', '206', '2019-11-18', 0);

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

DROP TABLE IF EXISTS `groupe`;
CREATE TABLE IF NOT EXISTS `groupe` (
  `id_grpe` int(11) NOT NULL,
  `num_grpe` int(11) NOT NULL,
  PRIMARY KEY (`id_grpe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `groupe`
--

INSERT INTO `groupe` (`id_grpe`, `num_grpe`) VALUES
(0, 201),
(1, 202),
(2, 203),
(3, 204),
(4, 205),
(5, 206),
(6, 207);

-- --------------------------------------------------------

--
-- Structure de la table `grpetudiants`
--

DROP TABLE IF EXISTS `grpetudiants`;
CREATE TABLE IF NOT EXISTS `grpetudiants` (
  `id_grpe` int(11) NOT NULL,
  `id_etu` int(11) NOT NULL,
  PRIMARY KEY (`id_grpe`,`id_etu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `grpetudiants`
--

INSERT INTO `grpetudiants` (`id_grpe`, `id_etu`) VALUES
(0, 0),
(1, 1),
(2, 2),
(3, 3),
(4, 0),
(4, 1),
(5, 2),
(5, 3),
(6, 0),
(6, 1),
(6, 2),
(6, 3);

-- --------------------------------------------------------

--
-- Structure de la table `professeur`
--

DROP TABLE IF EXISTS `professeur`;
CREATE TABLE IF NOT EXISTS `professeur` (
  `id_prof` int(11) NOT NULL AUTO_INCREMENT,
  `nom` text COLLATE utf8_bin NOT NULL,
  `prenom` text COLLATE utf8_bin NOT NULL,
  `email` text COLLATE utf8_bin NOT NULL,
  `login_prof` text COLLATE utf8_bin NOT NULL,
  `pass_prof` text COLLATE utf8_bin NOT NULL,
  `date_prof` date NOT NULL,
  `bConnect` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_prof`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `professeur`
--

INSERT INTO `professeur` (`id_prof`, `nom`, `prenom`, `email`, `login_prof`, `pass_prof`, `date_prof`, `bConnect`) VALUES
(1, 'Prof', 'Esseur', 'professeur@parisdescartes.fr', 'professeur', 'e718ab41a00fe697cc1973be2104f5df4ed0b538', '2017-10-01', 0),
(2, 'pavy', 'antoine', '', 'pavy', '04e53096233a95a01b62b732db5534d23ce987bd', '0000-00-00', 1),
(3, 'Sylvain', 'Durif', 'merlinlhommevert@orianna.world', 'christcosmique', '60e03fa792f847022a7b2a33fe4dc3c4765da325', '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Structure de la table `qcm`
--

DROP TABLE IF EXISTS `qcm`;
CREATE TABLE IF NOT EXISTS `qcm` (
  `id_qcm` int(11) NOT NULL AUTO_INCREMENT,
  `id_test` int(11) NOT NULL,
  `id_quest` int(11) NOT NULL,
  `bAutorise` tinyint(1) NOT NULL,
  `bBloque` tinyint(1) NOT NULL,
  `bAnnule` int(11) NOT NULL,
  PRIMARY KEY (`id_qcm`)
) ENGINE=InnoDB AUTO_INCREMENT=172 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `id_quest` int(11) NOT NULL AUTO_INCREMENT,
  `id_theme` int(11) NOT NULL,
  `titre` text COLLATE utf8_bin NOT NULL,
  `texte` text COLLATE utf8_bin NOT NULL,
  `bmultiple` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_quest`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `question`
--

INSERT INTO `question` (`id_quest`, `id_theme`, `titre`, `texte`, `bmultiple`) VALUES
(1, 1, 'MVC', 'Que veut dire MVC ?', 0),
(2, 2, 'Addition', '1+2=', 0),
(3, 2, 'Multiplication', '2*2=', 0),
(4, 1, 'Complexité', 'Quicksort ? ', 1),
(5, 1, 'VAR', 'What is a variable ?', 0),
(6, 1, 'BDD', 'Qu\'est-ce qu\'une clé primaire ?', 0),
(7, 1, 'Reseaux', 'Que veut dire IP ?\r\n', 0),
(8, 1, 'PROG', 'Quels langages sont réels ?', 1),
(9, 2, 'AAV', 'Quel language?', 1);

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

DROP TABLE IF EXISTS `reponse`;
CREATE TABLE IF NOT EXISTS `reponse` (
  `id_rep` int(11) NOT NULL AUTO_INCREMENT,
  `id_quest` int(11) NOT NULL,
  `texte_rep` text COLLATE utf8_bin NOT NULL,
  `bvalide` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_rep`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `reponse`
--

INSERT INTO `reponse` (`id_rep`, `id_quest`, `texte_rep`, `bvalide`) VALUES
(1, 1, 'Modèle Contrôle Vue', 1),
(2, 1, 'Modélisation Conception Vue', 0),
(3, 1, 'Modélisation Contrôle Vérification', 0),
(4, 9, 'c++', 0),
(5, 9, 'html', 0),
(6, 9, 'java', 1),
(8, 4, 'téta n', 0),
(9, 4, 'téta nlogn', 1),
(10, 5, 'A value ', 1),
(11, 5, 'Something we d\'ont care', 0),
(12, 2, '6', 0),
(13, 2, '3', 1),
(14, 2, '39', 0),
(15, 3, '8', 0),
(16, 3, '1', 0),
(17, 3, '4', 1),
(18, 6, 'Une clé de bras mais en primaire', 0),
(19, 6, 'La clé d\'une couleur primaire ', 0),
(20, 6, 'L\'identifiant de la classe : non-nul et unique', 1),
(21, 7, 'International Problem', 0),
(22, 7, 'Internet Protocol', 1),
(23, 7, 'Insert Protocol', 0),
(24, 7, 'Information Program', 0),
(25, 8, 'Python', 1),
(26, 8, 'Timo', 0),
(27, 8, 'Java', 1),
(28, 8, 'Popo', 0);

-- --------------------------------------------------------

--
-- Structure de la table `resultat`
--

DROP TABLE IF EXISTS `resultat`;
CREATE TABLE IF NOT EXISTS `resultat` (
  `id_res` int(11) NOT NULL AUTO_INCREMENT,
  `id_test` int(11) NOT NULL,
  `id_etu` int(11) NOT NULL,
  `id_quest` int(11) NOT NULL,
  `date_res` date NOT NULL,
  `id_rep` int(11) NOT NULL,
  PRIMARY KEY (`id_res`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `test`
--

DROP TABLE IF EXISTS `test`;
CREATE TABLE IF NOT EXISTS `test` (
  `id_test` int(11) NOT NULL AUTO_INCREMENT,
  `id_prof` int(11) NOT NULL,
  `num_grpe` text COLLATE utf8_bin NOT NULL,
  `titre_test` text COLLATE utf8_bin NOT NULL,
  `date_test` date NOT NULL,
  `bActif` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_test`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `test`
--

INSERT INTO `test` (`id_test`, `id_prof`, `num_grpe`, `titre_test`, `date_test`, `bActif`) VALUES
(1, 1, '207', 'Anglais', '2017-10-11', 0),
(2, 2, '206', 'Test sur les connaissances vues en cours', '2017-10-01', 0),
(3, 3, '203', 'Mathématiques', '0000-00-00', 0),
(4, 2, '201', 'Droit Informatique', '0000-00-00', 0),
(5, 3, '204', 'Conjugaison', '2017-10-11', 0),
(6, 1, '203', 'SGBD', '2017-10-11', 0),
(7, 2, '206', 'Test AAV', '2017-10-11', 0);

-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

DROP TABLE IF EXISTS `theme`;
CREATE TABLE IF NOT EXISTS `theme` (
  `id_theme` int(11) NOT NULL AUTO_INCREMENT,
  `titre_theme` text COLLATE utf8_bin NOT NULL,
  `desc_theme` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_theme`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `theme`
--

INSERT INTO `theme` (`id_theme`, `titre_theme`, `desc_theme`) VALUES
(1, 'PWEB', 'Connaissance du cours'),
(2, 'Programmation en Java', 'Connaissance théorique ');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
