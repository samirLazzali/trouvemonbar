-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  sam. 19 mai 2018 à 09:33
-- Version du serveur :  5.6.38
-- Version de PHP :  7.2.1

/* SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO"; */
--
-- Base de données :  `projetWeb`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--
DROP TABLE IF EXISTS "user","evenements","musiques","categories","Type","Groupe";

CREATE TABLE categories (
  id int NOT NULL,
  categorie varchar(100) NOT NULL
) ;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO categories (id, categorie) VALUES
(1, 'club Brn');

-- --------------------------------------------------------

--
-- Structure de la table `evenements`
--

CREATE TABLE evenements (
  id SERIAL PRIMARY KEY ,
  organisateur varchar(100) NOT NULL,
  nom varchar(100) NOT NULL,
  description text,
  lieu varchar(100) ,
  date date ,
  date_creation date NOT NULL,
  date_modif date DEFAULT NULL,
  before varchar(100) DEFAULT NULL,
  prix double precision ,
  musique int DEFAULT NULL,
  categorie int DEFAULT NULL,
  table_participants varchar(100) 
) ;

--
-- Déchargement des données de la table `evenements`
--

/*INSERT INTO evenements (id, organisateur, nom, description, lieu, date, date_creation, date_modif, before, prix, musique, categorie, table_participants) VALUES
(4, 1, 'First Event', NULL, 'Chez moi', '2018-05-08', '2018-05-08', NULL, NULL, 0, NULL, 1, 'participants3897910314'),
(5, 1, 'First Event', NULL, 'Chez moi', '2018-05-09', '2018-05-09', NULL, NULL, 0, NULL, 1, 'p2411932048');*/

-- --------------------------------------------------------

--
-- Structure de la table `musiques`
--

CREATE TABLE musiques (
  id int NOT NULL,
  musique varchar(100) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Structure de la table `p2411932048`
--

CREATE TABLE p2411932048 (
  id int NOT NULL
) ;

--
-- Déchargement des données de la table `p2411932048`
--

INSERT INTO p2411932048 (id) VALUES
(1);

-- --------------------------------------------------------

--
-- Structure de la table `participants3897910314`
--

CREATE TABLE participants3897910314 (
  id int NOT NULL
) ;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE "user" (
  id SERIAL PRIMARY KEY ,
  firstname varchar(100) ,
  lastname varchar(100) ,
  birthday date ,
  nickname varchar(100) NOT NULL,
  domicile varchar(100) ,
  mdp varchar(100) NOT NULL,
  id_groupe int NOT NULL
) ;

--
-- Déchargement des données de la table `users`
--

INSERT INTO "user" (id, firstname, lastname, birthday, nickname, domicile, mdp, id_groupe) VALUES
(1, 'Martin', 'Dufour', '1997-08-27', 'Feuj', 'maison', 'martin', 2);
INSERT INTO "user" (id, firstname, lastname, birthday, nickname, domicile, mdp, id_groupe) VALUES
(2, 'Quentin', 'Pichollet', '1997-08-19', 'Pichet', 'Orléans', '2f3497b77103fbaa8794550ed1c2c75b', 2);


