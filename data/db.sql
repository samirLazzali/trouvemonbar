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
DROP TABLE IF EXISTS "user","evenements","musiques","categories","Type","Groupe","p2411932048","participants3897910314";

CREATE TABLE categories (
  id int NOT NULL,
  categorie varchar(100) NOT NULL
) ;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO categories (id, categorie) VALUES
(1, 'club Brn');
INSERT INTO categories (id, categorie) VALUES
(2, 'Soirée ENSIIE');
INSERT INTO categories (id, categorie) VALUES
(3, 'Soirée TSP');

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

-- --------------------------------------------------------

--
-- Structure de la table `musiques`
--

CREATE TABLE musiques (
  id int NOT NULL,
  musique varchar(100) NOT NULL
) ;

INSERT INTO musiques (id, musique) VALUES (1, 'Hip-Hop');
INSERT INTO musiques (id, musique) VALUES (2, 'Soul');
INSERT INTO musiques (id, musique) VALUES (3, 'Electro');
INSERT INTO musiques (id, musique) VALUES (4, 'Hardtek');
INSERT INTO musiques (id, musique) VALUES (5, 'Pop');

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

INSERT INTO "user" (firstname, lastname, birthday, nickname, domicile, mdp, id_groupe) VALUES
('Martin', 'Dufour', '1997-08-27', 'Feuj', 'maison', 'martin', 2);
INSERT INTO "user" (firstname, lastname, birthday, nickname, domicile, mdp, id_groupe) VALUES
('Quentin', 'Pichollet', '1997-08-19', 'Pichet', 'Orléans', '2f3497b77103fbaa8794550ed1c2c75b', 2);
INSERT INTO "user" (firstname, lastname, birthday, nickname, domicile, mdp, id_groupe) VALUES/*mabite*/
('Christian','Morello', '1997-11-01', 'Leji','Besançon','78d1a0fddcd80f7e2f430fafae076cae',2);
INSERT INTO "user" (firstname, lastname, birthday, nickname, domicile, mdp, id_groupe) VALUES/*sabite*/
('Hugues', 'Genin', '1998-03-24','Barnum','Valenciennes','d41d8cd98f00b204e9800998ecf8427e',2);
