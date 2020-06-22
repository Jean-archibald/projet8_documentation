-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  lun. 22 juin 2020 à 16:13
-- Version du serveur :  5.7.26
-- Version de PHP :  7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `test_Projet8todolist`
--

-- --------------------------------------------------------

--
-- Structure de la table `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_done` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci COMMENT '(DC2Type:array)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `roles`) VALUES
(1, 'JohnTest0', '$2y$10$WyMSmN0QqpgnMpFFnd/bl.5e978zVOu27R0ppfBKAq1JrPjjWbM9i', 'testemail0@test.fr', 'a:1:{i:0;s:9:\"ROLE_USER\";}'),
(2, 'JohnTest1', '$2y$10$WyMSmN0QqpgnMpFFnd/bl.5e978zVOu27R0ppfBKAq1JrPjjWbM9i', 'testemail1@test.fr', 'a:1:{i:0;s:9:\"ROLE_USER\";}'),
(3, 'JohnTest2', '$2y$10$WyMSmN0QqpgnMpFFnd/bl.5e978zVOu27R0ppfBKAq1JrPjjWbM9i', 'testemail2@test.fr', 'a:1:{i:0;s:9:\"ROLE_USER\";}'),
(4, 'JohnTest3', '$2y$10$WyMSmN0QqpgnMpFFnd/bl.5e978zVOu27R0ppfBKAq1JrPjjWbM9i', 'testemail3@test.fr', 'a:1:{i:0;s:9:\"ROLE_USER\";}'),
(5, 'JohnTest4', '$2y$10$WyMSmN0QqpgnMpFFnd/bl.5e978zVOu27R0ppfBKAq1JrPjjWbM9i', 'testemail4@test.fr', 'a:1:{i:0;s:9:\"ROLE_USER\";}'),
(6, 'JohnTest5', '$2y$10$WyMSmN0QqpgnMpFFnd/bl.5e978zVOu27R0ppfBKAq1JrPjjWbM9i', 'testemail5@test.fr', 'a:1:{i:0;s:9:\"ROLE_USER\";}'),
(7, 'JohnTest6', '$2y$10$WyMSmN0QqpgnMpFFnd/bl.5e978zVOu27R0ppfBKAq1JrPjjWbM9i', 'testemail6@test.fr', 'a:1:{i:0;s:9:\"ROLE_USER\";}'),
(8, 'JohnTest7', '$2y$10$WyMSmN0QqpgnMpFFnd/bl.5e978zVOu27R0ppfBKAq1JrPjjWbM9i', 'testemail7@test.fr', 'a:1:{i:0;s:9:\"ROLE_USER\";}'),
(9, 'JohnTest8', '$2y$10$WyMSmN0QqpgnMpFFnd/bl.5e978zVOu27R0ppfBKAq1JrPjjWbM9i', 'testemail8@test.fr', 'a:1:{i:0;s:9:\"ROLE_USER\";}'),
(10, 'JohnTest9', '$2y$10$WyMSmN0QqpgnMpFFnd/bl.5e978zVOu27R0ppfBKAq1JrPjjWbM9i', 'testemail9@test.fr', 'a:1:{i:0;s:9:\"ROLE_USER\";}');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_527EDB25A76ED395` (`user_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `FK_527EDB25A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
