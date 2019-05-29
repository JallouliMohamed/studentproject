-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 25 avr. 2018 à 00:09
-- Version du serveur :  5.7.19
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projetpfe`
--

-- --------------------------------------------------------

--
-- Structure de la table `affectation`
--

DROP TABLE IF EXISTS `affectation`;
CREATE TABLE IF NOT EXISTS `affectation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` int(11) DEFAULT NULL,
  `prof_id` int(11) DEFAULT NULL,
  `entreprise_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `college` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `middlename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` int(11) NOT NULL,
  `department` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `level` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hours` int(11) NOT NULL,
  `course` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `monitor` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F4DD61D3ABC1F7FE` (`prof_id`),
  KEY `IDX_F4DD61D3A4AEAFEA` (`entreprise_id`),
  KEY `IDX_F4DD61D3CB944F1A` (`student_id`),
  KEY `IDX_F4DD61D3E1159985` (`monitor`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `affectation`
--

INSERT INTO `affectation` (`id`, `status`, `prof_id`, `entreprise_id`, `student_id`, `college`, `email`, `firstname`, `middlename`, `lastname`, `phone`, `department`, `level`, `hours`, `course`, `monitor`) VALUES
(1, 3, 20, 1, 21, 'wafa', 'azd@azd.com', 'azd', 'adz', 'azd', 52749, 'a21', 'Graduated', 5, 'math', 54);

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

DROP TABLE IF EXISTS `entreprise`;
CREATE TABLE IF NOT EXISTS `entreprise` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `owner_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D19FA607E3C61F9` (`owner_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `entreprise`
--

INSERT INTO `entreprise` (`id`, `name`, `description`, `image`, `location`, `owner_id`) VALUES
(1, 'Focus', 'Nous fournissons des solutions intégrées avec des services professionnels pour tirer le meilleur parti de la technologie IT', '9c5e497998f1e9251db3020defcf286c.jpg', 'tunis', 57),
(2, 'vermeg', 'Vermeg is a Tunis-based financial software supplier. It was established in 1994, initially under the name of BFI and was spun off from BFI in 2002.  Securities Processing Software and Fund Administration Systems are the core business of Vermeg.', '0e91c845a79d5c396015aee421af5cb9.jpg', 'france', 57),
(3, 'Sofrecom', 'Sofrecom, filiale d\'Orange, a développé depuis 50 ans un savoir-faire unique dans les métiers de l\'opérateur, qui en fait aujourd\'hui l\'un des leaders mondiaux du conseil et de l\'ingénierie.', 'd21e83d3990ec15c8742f470ac2f81a4.jpg', 'netherland', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `internship`
--

DROP TABLE IF EXISTS `internship`;
CREATE TABLE IF NOT EXISTS `internship` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `supervisor_id` int(11) DEFAULT NULL,
  `affectation_id` int(11) DEFAULT NULL,
  `startdate` datetime NOT NULL,
  `finishdate` datetime NOT NULL,
  `monitor_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_10D1B00CA76ED395` (`user_id`),
  KEY `IDX_10D1B00C19E9AC5F` (`supervisor_id`),
  KEY `IDX_10D1B00C6D0ABA22` (`affectation_id`),
  KEY `IDX_10D1B00C4CE1C902` (`monitor_id`),
  KEY `IDX_10D1B00CCB944F1A` (`student_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `internship`
--

INSERT INTO `internship` (`id`, `user_id`, `supervisor_id`, `affectation_id`, `startdate`, `finishdate`, `monitor_id`, `student_id`, `status`) VALUES
(6, 57, 59, 1, '2013-01-01 00:00:00', '2013-01-01 00:00:00', 54, 21, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `thread_id` int(11) DEFAULT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `body` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B6BD307FE2904019` (`thread_id`),
  KEY `IDX_B6BD307FF624B39D` (`sender_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id`, `thread_id`, `sender_id`, `body`, `created_at`) VALUES
(1, 1, 21, 'raze', '2018-04-01 16:45:46'),
(2, 1, 21, 'zae', '2018-04-01 16:45:56');

-- --------------------------------------------------------

--
-- Structure de la table `message_metadata`
--

DROP TABLE IF EXISTS `message_metadata`;
CREATE TABLE IF NOT EXISTS `message_metadata` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message_id` int(11) DEFAULT NULL,
  `participant_id` int(11) DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4632F005537A1329` (`message_id`),
  KEY `IDX_4632F0059D1C3019` (`participant_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `message_metadata`
--

INSERT INTO `message_metadata` (`id`, `message_id`, `participant_id`, `is_read`) VALUES
(1, 1, 22, 0),
(2, 1, 21, 1),
(3, 2, 22, 0),
(4, 2, 21, 1);

-- --------------------------------------------------------

--
-- Structure de la table `messenger`
--

DROP TABLE IF EXISTS `messenger`;
CREATE TABLE IF NOT EXISTS `messenger` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `body` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `who_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E22A4301F624B39D` (`sender_id`),
  KEY `IDX_E22A4301F4E25B21` (`who_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `messenger`
--

INSERT INTO `messenger` (`id`, `body`, `subject`, `file`, `sender_id`, `who_id`) VALUES
(1, 'your student has been accepted for an internship in out entreprise', 'Succes', 'azea.jpg', 57, 20),
(2, 'hello student you have been accepted by the entreprise', 'gratz', '03ffb94663d4f1bcc50c07686029a22b.pdf', 20, 21),
(3, 'you have been accepted by the provider', 'gratz', '56d63d105d9c5699cda0b9b2ee714949.pdf', 20, 21),
(4, 'hahahahaha', 'hahaha', 'fd8b35ccc061e5041c09f063bc664743.pdf', 20, 21);

-- --------------------------------------------------------

--
-- Structure de la table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entityname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `texto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_BF5476CAA76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `notification`
--

INSERT INTO `notification` (`id`, `entityname`, `user_id`, `texto`) VALUES
(1, 'Notification', 21, 'the teacher accepted your internship'),
(6, 'Notification', 21, 'the teacher accepted your internship');

-- --------------------------------------------------------

--
-- Structure de la table `stage`
--

DROP TABLE IF EXISTS `stage`;
CREATE TABLE IF NOT EXISTS `stage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entreprise` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `monitor` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `proffesor` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `student` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `thread`
--

DROP TABLE IF EXISTS `thread`;
CREATE TABLE IF NOT EXISTS `thread` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_by_id` int(11) DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `is_spam` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_31204C83B03A8386` (`created_by_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `thread`
--

INSERT INTO `thread` (`id`, `created_by_id`, `subject`, `created_at`, `is_spam`) VALUES
(1, 21, 'ahla', '2018-04-01 16:45:46', 0);

-- --------------------------------------------------------

--
-- Structure de la table `thread_metadata`
--

DROP TABLE IF EXISTS `thread_metadata`;
CREATE TABLE IF NOT EXISTS `thread_metadata` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `thread_id` int(11) DEFAULT NULL,
  `participant_id` int(11) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `last_participant_message_date` datetime DEFAULT NULL,
  `last_message_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_40A577C8E2904019` (`thread_id`),
  KEY `IDX_40A577C89D1C3019` (`participant_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `thread_metadata`
--

INSERT INTO `thread_metadata` (`id`, `thread_id`, `participant_id`, `is_deleted`, `last_participant_message_date`, `last_message_date`) VALUES
(1, 1, 22, 0, NULL, '2018-04-01 16:45:56'),
(2, 1, 21, 0, '2018-04-01 16:45:56', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prof_id` int(11) DEFAULT NULL,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `role` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D64992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_8D93D649A0D96FBF` (`email_canonical`),
  UNIQUE KEY `UNIQ_8D93D649C05FB297` (`confirmation_token`),
  KEY `IDX_8D93D649ABC1F7FE` (`prof_id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `prof_id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`, `role`, `image`) VALUES
(20, NULL, 'teacher', 'teacher', 'teacher@google.com', 'teacher@google.com', 1, NULL, '$2y$13$Dv/HNH3LhgDBfMGvrunw5erCPAiVkz.ryxuZr/A69fRFH0LxO/v9O', '2018-04-24 23:11:59', NULL, NULL, 'a:0:{}', 'professeur', '278eee74987537646bc7854552343218.jpg'),
(21, 20, 'student', 'student', 'test@gmail.com', 'test@gmail.com', 1, NULL, '$2y$13$usl9YlCrlSHrLAXEvluNYuN4OjIq2avMYd3SBCbtKKzBbh8FS4wCO', '2018-04-24 23:10:28', NULL, NULL, 'a:0:{}', 'etudiant', '21d5f4438f4e064bf17b44697642f3de.jpg'),
(22, 20, 'student1', 'student1', 'student1@google.com', 'student1@google.com', 1, NULL, '$2y$13$zYh6bx2gXo8q23HO.PqmuuJEtzsZU5WqYa4zRTRhPetSfC93xDbXK', '2018-04-07 05:48:45', NULL, NULL, 'a:0:{}', 'etudiant', 'c5366026c2888fd6634a135b58f7d367.jpg'),
(23, NULL, 'admin', 'admin', 'admin@admin.com', 'admin@admin.com', 1, NULL, '$2y$13$JKqcD4iysLTOqFCabp0rlOeQ0Af3kTA6RdXUG9dXyu4HnAcEeRg7y', '2018-03-17 19:12:28', NULL, NULL, 'a:2:{i:0;s:10:\"ROLE ADMIN\";i:1;s:10:\"ROLE_ADMIN\";}', 'Admin', '0bf8899896002a629dcc7982ca89b8ac.jpg'),
(24, 20, 'student2', 'student2', 'azeaze@eazd.com', 'azeaze@eazd.com', 1, NULL, '$2y$13$iiWWDbb9vTfOy/ACXxC/LuCF4x4V9y4rXaZkioO9Jxn1OCOyr7GCq', '2018-03-17 17:15:52', NULL, NULL, 'a:0:{}', 'etudiant', 'c1c1500684df085fa3fb314635878aa3.jpg'),
(31, NULL, 'teacher1', 'teacher1', 'teacher1@google.com', 'teacher1@google.com', 1, NULL, '$2y$13$GcHUGaQV2M0JQxbOk8Wu1uJ1Wc8IgMKJ8dcz/08p80F2fjkxOyVde', '2018-03-18 16:41:59', NULL, NULL, 'a:0:{}', 'professeur', '9f2b267640d537355fac26768746b456.jpg'),
(33, 31, 'student4', 'student4', 'student2@student.com', 'student2@student.com', 1, NULL, '$2y$13$F9.lsRWCeZinXX1LnLue0ek8nkcLwd/w0je.UqR.8Lzi0YflQJuzy', '2018-03-17 18:09:45', NULL, NULL, 'a:0:{}', 'etudiant', 'f51b4045551179a2c8af254cffffb3f6.jpg'),
(53, NULL, 'teacher9', 'teacher9', 'teach2@gmail.com', 'teach2@gmail.com', 1, NULL, '$2y$13$MJEf9DfYM9j.eueo.pxX5OEx3D2JSed9lCgJMmtRXSnJzm0chkhgS', '2018-04-08 12:53:04', NULL, NULL, 'a:0:{}', 'professeur', '4c0f911df9b33a108a8a0213c25ea87b.jpg'),
(54, NULL, 'monitor', 'monitor', 'monitor@gmail.com', 'monitor@gmail.com', 1, NULL, '$2y$13$N2QwPscVspQ0dz6H48RMXeDuOJZUxCQFeWGdSYqfHXDs3JCZadGZO', '2018-04-24 17:22:31', NULL, NULL, 'a:0:{}', 'monitor', '436070cd8eb78042061b72fb9b8b79d7.jpg'),
(55, NULL, 'monitor2', 'monitor2', 'monitor2@gmail.com', 'monitor2@gmail.com', 1, NULL, '$2y$13$UG/o516YyDiVoyvWkUKh9.UWXfJEu0xeJIbGGEgpqgumBuTub.OyS', '2018-04-08 13:20:32', NULL, NULL, 'a:0:{}', 'monitor', '5d15b5e05aa303f6f6c5895614b51f1e.jpg'),
(56, 20, 'student10', 'student10', 'student10@gmail.com', 'student10@gmail.com', 1, NULL, '$2y$13$EsXz6lVIm69VuiR1Ybfgvu9U3yyttMQFCcGJQZGSRd/kxNNDNJiS6', '2018-04-08 16:29:50', NULL, NULL, 'a:0:{}', 'etudiant', 'b01b27caf36b988e8194ac82d01e05c7.jpg'),
(57, NULL, 'provider', 'provider', 'provider@provider.com', 'provider@provider.com', 1, NULL, '$2y$13$zfCaYqZcuQG7bVDUD.qMu.RLaq3/MK4rdyQBicOsOMJZF.3y5dZ6S', '2018-04-24 17:23:59', NULL, NULL, 'a:0:{}', 'provider', 'f1a016c3fc62208f144ea3ea27fa62b3.jpg'),
(59, NULL, 'supervisor', 'supervisor', 'supervisor@supervisor.com', 'supervisor@supervisor.com', 1, NULL, '$2y$13$Y5/In7kp6/93FH0uUpjz8edC9TM1xAmuHoLrtH2quwIsrHlfMd8Vm', '2018-04-24 10:44:49', NULL, NULL, 'a:0:{}', 'supervisor', 'bc075ed3144cc5ca85cd96b6a31615ae.jpg');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `affectation`
--
ALTER TABLE `affectation`
  ADD CONSTRAINT `FK_F4DD61D3A4AEAFEA` FOREIGN KEY (`entreprise_id`) REFERENCES `entreprise` (`id`),
  ADD CONSTRAINT `FK_F4DD61D3ABC1F7FE` FOREIGN KEY (`prof_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_F4DD61D3CB944F1A` FOREIGN KEY (`student_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_F4DD61D3E1159985` FOREIGN KEY (`monitor`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `entreprise`
--
ALTER TABLE `entreprise`
  ADD CONSTRAINT `FK_D19FA607E3C61F9` FOREIGN KEY (`owner_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `internship`
--
ALTER TABLE `internship`
  ADD CONSTRAINT `FK_10D1B00C19E9AC5F` FOREIGN KEY (`supervisor_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_10D1B00C4CE1C902` FOREIGN KEY (`monitor_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_10D1B00C6D0ABA22` FOREIGN KEY (`affectation_id`) REFERENCES `affectation` (`id`),
  ADD CONSTRAINT `FK_10D1B00CA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_10D1B00CCB944F1A` FOREIGN KEY (`student_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `FK_B6BD307FE2904019` FOREIGN KEY (`thread_id`) REFERENCES `thread` (`id`),
  ADD CONSTRAINT `FK_B6BD307FF624B39D` FOREIGN KEY (`sender_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `message_metadata`
--
ALTER TABLE `message_metadata`
  ADD CONSTRAINT `FK_4632F005537A1329` FOREIGN KEY (`message_id`) REFERENCES `message` (`id`),
  ADD CONSTRAINT `FK_4632F0059D1C3019` FOREIGN KEY (`participant_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `messenger`
--
ALTER TABLE `messenger`
  ADD CONSTRAINT `FK_E22A4301F4E25B21` FOREIGN KEY (`who_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_E22A4301F624B39D` FOREIGN KEY (`sender_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `FK_BF5476CAA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `thread`
--
ALTER TABLE `thread`
  ADD CONSTRAINT `FK_31204C83B03A8386` FOREIGN KEY (`created_by_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `thread_metadata`
--
ALTER TABLE `thread_metadata`
  ADD CONSTRAINT `FK_40A577C89D1C3019` FOREIGN KEY (`participant_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_40A577C8E2904019` FOREIGN KEY (`thread_id`) REFERENCES `thread` (`id`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D649ABC1F7FE` FOREIGN KEY (`prof_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
