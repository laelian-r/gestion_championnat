-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 06 fév. 2026 à 15:59
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion_championnat`
--

-- --------------------------------------------------------

--
-- Structure de la table `championship`
--

DROP TABLE IF EXISTS `championship`;
CREATE TABLE IF NOT EXISTS `championship` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `won_point` int NOT NULL,
  `lost_point` int NOT NULL,
  `draw_point` int NOT NULL,
  `type_ranking` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `championship`
--

INSERT INTO `championship` (`id`, `name`, `start_date`, `end_date`, `won_point`, `lost_point`, `draw_point`, `type_ranking`) VALUES
(1, 'Championnat du monde', '2026-02-06', '2026-03-06', 10, 0, 1, 'Ligue 1');

-- --------------------------------------------------------

--
-- Structure de la table `country`
--

DROP TABLE IF EXISTS `country`;
CREATE TABLE IF NOT EXISTS `country` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `team_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5373C966296CD8AE` (`team_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `country`
--

INSERT INTO `country` (`id`, `name`, `team_id`) VALUES
(1, 'France', 1),
(2, 'Italie', 2);

-- --------------------------------------------------------

--
-- Structure de la table `day`
--

DROP TABLE IF EXISTS `day`;
CREATE TABLE IF NOT EXISTS `day` (
  `id` int NOT NULL AUTO_INCREMENT,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `championship_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E5A0299094DDBCE9` (`championship_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20260204092319', '2026-02-04 10:24:52', 200),
('DoctrineMigrations\\Version20260204102844', '2026-02-04 11:31:50', 183),
('DoctrineMigrations\\Version20260204105810', '2026-02-04 11:58:36', 54),
('DoctrineMigrations\\Version20260204111037', '2026-02-04 12:10:54', 204),
('DoctrineMigrations\\Version20260204111403', '2026-02-04 12:14:19', 32),
('DoctrineMigrations\\Version20260204150750', '2026-02-04 16:08:13', 388),
('DoctrineMigrations\\Version20260204151227', '2026-02-04 16:12:33', 219),
('DoctrineMigrations\\Version20260204152123', '2026-02-04 16:21:35', 132),
('DoctrineMigrations\\Version20260204152705', '2026-02-04 16:27:33', 267),
('DoctrineMigrations\\Version20260204153943', '2026-02-04 16:39:48', 314),
('DoctrineMigrations\\Version20260206140911', '2026-02-06 15:09:35', 794);

-- --------------------------------------------------------

--
-- Structure de la table `game`
--

DROP TABLE IF EXISTS `game`;
CREATE TABLE IF NOT EXISTS `game` (
  `id` int NOT NULL AUTO_INCREMENT,
  `team1_point` int NOT NULL,
  `team2_point` int NOT NULL,
  `team1_id` int NOT NULL,
  `team2_id` int NOT NULL,
  `day_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_232B318CE72BCFA4` (`team1_id`),
  KEY `IDX_232B318CF59E604A` (`team2_id`),
  KEY `IDX_232B318C9C24126` (`day_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `id_role` int NOT NULL AUTO_INCREMENT,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id_role`, `role`) VALUES
(1, 'Admin'),
(2, 'Utilisateur');

-- --------------------------------------------------------

--
-- Structure de la table `team`
--

DROP TABLE IF EXISTS `team`;
CREATE TABLE IF NOT EXISTS `team` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `creation_date` date NOT NULL,
  `stade` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL,
  `president` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coach` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `team`
--

INSERT INTO `team` (`id`, `name`, `creation_date`, `stade`, `logo`, `president`, `coach`) VALUES
(1, 'PSG', '1970-08-12', 'Parc des Princes', '6985bc5874d26.png', 'Nasser Al-Khelaïfi', 'Luis Enrique'),
(2, 'Inter', '1908-03-09', 'San Siro', '6985b7a6e43bf.png', 'Giuseppe Marotta', 'Cristian Chivu'),
(3, 'Marseille', '1970-08-12', 'Parc des Princes', '6985bbf22b9a5.png', 'Nasser Al-Khelaïfi', 'Luis Enrique');

-- --------------------------------------------------------

--
-- Structure de la table `team_championship`
--

DROP TABLE IF EXISTS `team_championship`;
CREATE TABLE IF NOT EXISTS `team_championship` (
  `id` int NOT NULL AUTO_INCREMENT,
  `championship_id` int NOT NULL,
  `team_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E32BD3A894DDBCE9` (`championship_id`),
  KEY `IDX_E32BD3A8296CD8AE` (`team_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_role` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`),
  KEY `IDX_8D93D649DC499668` (`id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `email`, `password`, `created_at`, `id_role`) VALUES
(1, 'John', 'Doe', 'john.doe@email.com', '$2y$13$LXO6RELitrDEjxxEQZ0kqOd.5BcN.jzSfQhrFl9lYI2gDU/Zyw4Ey', '2026-02-04 15:08:58', 2),
(2, 'Laélian', 'Roux', 'laelian.roux@gmail.com', '$2y$13$DnI441ddMC/y5V/n0xSs1.gp//.jvYZZY2fkvujS18qMMbhlpHUZa', '2026-02-04 15:22:18', 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `country`
--
ALTER TABLE `country`
  ADD CONSTRAINT `FK_5373C966296CD8AE` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`);

--
-- Contraintes pour la table `day`
--
ALTER TABLE `day`
  ADD CONSTRAINT `FK_E5A0299094DDBCE9` FOREIGN KEY (`championship_id`) REFERENCES `championship` (`id`);

--
-- Contraintes pour la table `game`
--
ALTER TABLE `game`
  ADD CONSTRAINT `FK_232B318C9C24126` FOREIGN KEY (`day_id`) REFERENCES `day` (`id`),
  ADD CONSTRAINT `FK_232B318CE72BCFA4` FOREIGN KEY (`team1_id`) REFERENCES `team` (`id`),
  ADD CONSTRAINT `FK_232B318CF59E604A` FOREIGN KEY (`team2_id`) REFERENCES `team` (`id`);

--
-- Contraintes pour la table `team_championship`
--
ALTER TABLE `team_championship`
  ADD CONSTRAINT `FK_E32BD3A8296CD8AE` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`),
  ADD CONSTRAINT `FK_E32BD3A894DDBCE9` FOREIGN KEY (`championship_id`) REFERENCES `championship` (`id`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D649DC499668` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
