-- phpMyAdmin SQL Dump
-- version 4.4.9
-- http://www.phpmyadmin.net
--
-- Client :  localhost:3306
-- Généré le :  Lun 20 Juillet 2015 à 19:28
-- Version du serveur :  5.5.42
-- Version de PHP :  5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `minichat`
--

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `date_time_msg` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `messages`
--

INSERT INTO `messages` (`id`, `pseudo`, `message`, `date_time_msg`) VALUES
(1, 'Tom', 'Il fait beau aujourd''hui, vous ne trouvez pas ?', '2015-07-16 23:15:45'),
(2, 'John', 'Ouais, ça faisait un moment qu''on n''avait pas vu la lumière du soleil !', '2015-07-16 23:47:48'),
(3, 'Patrice', 'Ça vous tente d''aller à la plage aujourd''hui ? Y''a de super vagues !', '2015-07-18 04:05:14'),
(4, 'Tom', 'Cool, bonne idée ! J''amène ma planche !', '2015-07-18 04:15:00'),
(5, 'John', 'Comptez sur moi !', '2015-07-18 05:20:00'),
(6, 'Chris', 'Attendez, j''arrive, on va bien se marrer !!!', '2015-07-18 08:00:07'),
(7, 'Tom', 'Tu arrives vers quelle heure Chris ? Juste pour réserver... :)', '2015-07-18 09:00:00'),
(8, 'John', 'Je serai là vers 15h', '2015-07-18 10:15:15'),
(9, 'Chris', 'J''arrive à 15h30', '2015-07-19 03:24:25'),
(10, 'Tom', 'Excellent, content que tout le monde vienne !!!', '2015-07-19 04:10:25'),
(11, 'Pierre', 'Perso j''arrive à 14h30 avec Cathy', '2015-07-19 06:10:00'),
(12, 'Chris', 'Cathy vient ??? Trop cool :)', '2015-07-19 06:21:00'),
(13, 'Cathy', 'Oui je viens, trop contente de vous voir :)', '2015-07-19 06:25:55'),
(14, 'John', 'good mega news :D', '2015-07-19 06:30:08'),
(15, 'Elodie', 'Génial Cathy je suis contente que tu viennes !!! :)', '2015-07-19 06:40:11'),
(16, 'Chris', 'C''était royal, le spot est excellent !!! Content d''avoir voir vu tout la team... :)', '2015-07-20 02:04:00'),
(17, 'John', 'Manquait juste l''araignée...', '2015-07-20 02:11:00'),
(18, 'John', 'Il fait quoi maintenant', '2015-07-20 02:15:00'),
(19, 'Elodie', 'Il est en Australie, au soleil. Il vous embrasse tous. ;) :)', '2015-07-20 03:10:16'),
(20, 'John', 'Tu es en contact avec lui ?', '2015-07-20 04:00:00'),
(21, 'Elodie', 'Un peu oui... :p :)', '2015-07-20 05:03:40'),
(22, 'Chris', 'Ah ah ah ;) :p', '2015-07-20 06:13:00'),
(23, 'Cathy', 'On peut m''expliquer ??? ', '2015-07-20 06:19:48'),
(24, 'Chris', 'Ils sont mariés... :)', '2015-07-20 07:30:10'),
(25, 'Cathy', 'pfff ^^ Congrats :)', '2015-07-20 08:35:21'),
(26, 'Elodie', 'Il rentre fin août. :)', '2015-07-20 09:15:49'),
(27, 'Elodie', 'Petit mariage dans la stricte intimité mais grosse fête prévue à la rentrée avec vous tous mes ami(e)s :)', '2015-07-20 19:06:37');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
