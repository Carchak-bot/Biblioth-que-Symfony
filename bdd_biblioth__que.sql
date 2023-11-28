-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 27 nov. 2023 à 14:48
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bdd_bibliothèque`
--
CREATE DATABASE IF NOT EXISTS `bdd_bibliothèque` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `bdd_bibliothèque`;

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20231120152641', '2023-11-20 16:27:12', 1018),
('DoctrineMigrations\\Version20231122084213', '2023-11-22 11:23:36', 86),
('DoctrineMigrations\\Version20231122104326', '2023-11-22 11:43:31', 74);

-- --------------------------------------------------------

--
-- Structure de la table `livre`
--

CREATE TABLE `livre` (
  `id` int(11) NOT NULL,
  `id_emprunteur_id` int(11) DEFAULT NULL,
  `titre` varchar(255) NOT NULL,
  `auteur` varchar(255) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `date_de_paruption` int(11) NOT NULL,
  `image_name` varchar(255) DEFAULT NULL,
  `pages_nombres` varchar(255) DEFAULT NULL,
  `categorie` varchar(255) NOT NULL,
  `statut` tinyint(1) NOT NULL,
  `isbn_nombre` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `livre`
--

INSERT INTO `livre` (`id`, `id_emprunteur_id`, `titre`, `auteur`, `description`, `date_de_paruption`, `image_name`, `pages_nombres`, `categorie`, `statut`, `isbn_nombre`, `updated_at`) VALUES
(1, NULL, 'The End and Deathh', 'Dan Abnett', 'Sanguinus get shreked by the Horus Heresy', 15000000, NULL, '42', 'roman', 1, 1525693546, NULL),
(6, 3, 'Lili au pays du test', 'Moi', 'Test', 25081998, NULL, '156', 'Categorie 2', 1, 2147483647, NULL),
(7, NULL, 'fdsf', 'dsfsd', 'dsfsdf', 20232311, 'images-655f2bdb70367.jpg', '505', 'Categorie 1', 1, 5453, '2023-11-23 11:39:21'),
(8, 7, 'gfdgd', 'fdgdg', 'fdgdf', 20231111, 'image-655f4a513701b.png', '600', 'Categorie 1', 1, 5252, '2023-11-23 13:49:19'),
(9, 7, 'TAMERE', 'TONDARON', 'TES ENFANT', 20231116, 'moon-5061253_640-655f546cc60f2.jpg', '800', 'Categorie 1', 1, 2252, '2023-11-23 14:32:26'),
(10, 5, 'dsfdsfdsf', 'dsfdsf', 'dsfdsfdsf', 20231126, 'pokemon-655f61d3917d8.jpg', '900', 'Categorie 1', 0, 5456, '2023-11-23 15:29:37'),
(11, NULL, 'gdfg', 'TONDARON', 'dsfsdfs', 20231121, 'earth-11048_640-65646e6ba24a5.jpg', '105', 'Science-fiction', 0, 545464, '2023-11-27 11:24:40');

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

CREATE TABLE `membres` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `statut` varchar(255) NOT NULL,
  `photo_name` varchar(255) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `membres`
--

INSERT INTO `membres` (`id`, `nom`, `prenom`, `statut`, `photo_name`, `updated_at`) VALUES
(1, 'Von Topkek', 'Topkekus', 'Chomeur', 'CharlesEdouard_18.png', NULL),
(3, 'Testeurus', 'Testor', 'Testeurr', 'Blacksteel-Legion-final2.png', NULL),
(4, 'Testeur', 'Testorin', 'Testeur', 'Kroot_Chaos_IV_14.png', NULL),
(5, 'Testeurons', 'Testorino', 'Testeur', 'Kroot-Chaos_III_11.png', NULL),
(7, 'kev', 'kev', 'Testeurrrr', 'images-655f279d1d773.jpg', '2023-11-23 11:21:17'),
(8, 'sdfs', 'dsfdsf', 'dsfsdf', 'LOGO-AFPA-VERT-PNG-655f62024530d.png', '2023-11-23 15:30:26');

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `livre`
--
ALTER TABLE `livre`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_AC634F994EACD152` (`id_emprunteur_id`);

--
-- Index pour la table `membres`
--
ALTER TABLE `membres`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `livre`
--
ALTER TABLE `livre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `membres`
--
ALTER TABLE `membres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `livre`
--
ALTER TABLE `livre`
  ADD CONSTRAINT `FK_AC634F994EACD152` FOREIGN KEY (`id_emprunteur_id`) REFERENCES `membres` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
