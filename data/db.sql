-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  sam. 19 mai 2018 à 08:54
-- Version du serveur :  5.6.38
-- Version de PHP :  7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `projetWeb`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `categorie` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `categorie`) VALUES
(1, 'club B\r\n');

-- --------------------------------------------------------

--
-- Structure de la table `evenements`
--

CREATE TABLE `evenements` (
  `id` int(11) NOT NULL,
  `organisateur` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `description` text,
  `lieu` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `date_creation` date NOT NULL,
  `date_modif` date DEFAULT NULL,
  `before` varchar(100) DEFAULT NULL,
  `prix` float NOT NULL,
  `musique` int(11) DEFAULT NULL,
  `categorie` int(11) DEFAULT NULL,
  `table_participants` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `evenements`
--

INSERT INTO `evenements` (`id`, `organisateur`, `nom`, `description`, `lieu`, `date`, `date_creation`, `date_modif`, `before`, `prix`, `musique`, `categorie`, `table_participants`) VALUES
(4, 1, 'First Event', NULL, 'Chez moi', '2018-05-08', '2018-05-08', NULL, NULL, 0, NULL, 1, 'participants3897910314'),
(5, 1, 'First Event', NULL, 'Chez moi', '2018-05-09', '2018-05-09', NULL, NULL, 0, NULL, 1, 'p2411932048');

-- --------------------------------------------------------

--
-- Structure de la table `musiques`
--

CREATE TABLE `musiques` (
  `id` int(11) NOT NULL,
  `musique` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `p2411932048`
--

CREATE TABLE `p2411932048` (
  `id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `p2411932048`
--

INSERT INTO `p2411932048` (`id`) VALUES
(1);

-- --------------------------------------------------------

--
-- Structure de la table `participants3897910314`
--

CREATE TABLE `participants3897910314` (
  `id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `birthday` date NOT NULL,
  `nickname` varchar(100) NOT NULL,
  `domicile` varchar(100) NOT NULL,
  `mdp` varchar(100) NOT NULL,
  `id_groupe` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `birthday`, `nickname`, `domicile`, `mdp`, `id_groupe`) VALUES
(1, 'Martin', 'Dufour', '1997-08-27', 'Feuj', 'maison', 'martin', 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `evenements`
--
ALTER TABLE `evenements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `organisateur_id` (`organisateur`),
  ADD KEY `musique_id` (`musique`),
  ADD KEY `categorie_id` (`categorie`),
  ADD KEY `participants_table_nom` (`table_participants`);

--
-- Index pour la table `musiques`
--
ALTER TABLE `musiques`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `p2411932048`
--
ALTER TABLE `p2411932048`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `participants3897910314`
--
ALTER TABLE `participants3897910314`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `evenements`
--
ALTER TABLE `evenements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `musiques`
--
ALTER TABLE `musiques`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
