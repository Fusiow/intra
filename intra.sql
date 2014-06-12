-- phpMyAdmin SQL Dump
-- version 4.1.9
-- http://www.phpmyadmin.net
--
-- Client :  localhost:3306
-- Généré le :  Jeu 12 Juin 2014 à 09:35
-- Version du serveur :  5.5.36
-- Version de PHP :  5.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `intra`
--

-- --------------------------------------------------------

--
-- Structure de la table `forums`
--

CREATE TABLE IF NOT EXISTS `forums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `author` varchar(12) NOT NULL,
  `module` int(11) NOT NULL,
  `subject` int(11) NOT NULL,
  `text` text NOT NULL,
  `type` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `forums`
--

INSERT INTO `forums` (`id`, `title`, `author`, `module`, `subject`, `text`, `type`, `date`) VALUES
(1, '', 'lsolofri', 0, 0, '', 0, '0000-00-00'),
(2, 'ewfewfwf', 'lsolofri', 0, 0, '', 0, '0000-00-00'),
(3, 'ewfewfwf', 'lsolofri', 0, 0, '', 0, '0000-00-00'),
(4, 'test subject', 'lsolofri', 1, 0, 'eewfefwffwe', 0, '0000-00-00'),
(5, 'test subject', 'lsolofri', 2, 1, 'eewfefwffwe', 0, '0000-00-00'),
(6, 'wefefwfe', '6038', 2, 1, 'wefwefefwef', 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Structure de la table `forum_response`
--

CREATE TABLE IF NOT EXISTS `forum_response` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(12) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `vote` int(11) NOT NULL,
  `as_vote` text NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `modules`
--

CREATE TABLE IF NOT EXISTS `modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `is_inscrit` text NOT NULL,
  `date_begin` date NOT NULL,
  `semester` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `modules`
--

INSERT INTO `modules` (`id`, `name`, `description`, `is_inscrit`, `date_begin`, `semester`) VALUES
(1, 'Test Module', 'Ceci est un putain de super test', '', '2014-06-06', 1),
(2, 'test Module2', 'ceci est un putain de test', '', '2014-06-05', 1);

-- --------------------------------------------------------

--
-- Structure de la table `semesters`
--

CREATE TABLE IF NOT EXISTS `semesters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_begin` date NOT NULL,
  `date_end` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `semesters`
--

INSERT INTO `semesters` (`id`, `date_begin`, `date_end`) VALUES
(1, '2014-06-04', '2014-06-30');

-- --------------------------------------------------------

--
-- Structure de la table `subjects`
--

CREATE TABLE IF NOT EXISTS `subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `is_inscrit` text NOT NULL,
  `module_id` int(11) NOT NULL,
  `date_begin` date NOT NULL,
  `date_end` date NOT NULL,
  `hour_begin` int(11) NOT NULL,
  `hour_end` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `description`, `is_inscrit`, `module_id`, `date_begin`, `date_end`, `hour_begin`, `hour_end`) VALUES
(1, 'Faire des choses', 'Faut faire des trucs, genre plein de choses.', '', 2, '2014-06-18', '2014-06-20', 20, 18);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
