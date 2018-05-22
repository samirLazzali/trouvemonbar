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

INSERT INTO evenements (id, organisateur, nom, description, lieu, date, date_creation, date_modif, before, prix, musique, categorie, table_participants) VALUES
(4, 'Feuj', 'First Event', NULL, 'Chez moi', '2018-05-08', '2018-05-08', NULL, NULL, 0, NULL, 1, 'participants3897910314'),
(5, 'Feuj', 'First Event', NULL, 'Chez moi', '2018-05-09', '2018-05-09', NULL, NULL, 0, NULL, 1, 'p2411932048');
INSERT INTO evenements (id, organisateur, nom, description, lieu, date, date_creation, date_modif, before, prix, musique, categorie, table_participants) VALUES
(6, 'Leji', 'T pa prè', 'Venez chez oim les couz','Grotte','2018-06-24',NULL,NULL,'grotte',5,NULL,1,'');

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

INSERT INTO "user" (id, firstname, lastname, birthday, nickname, domicile, mdp, id_groupe) VALUES
(1, 'Martin', 'Dufour', '1997-08-27', 'Feuj', 'maison', 'martin', 2);
INSERT INTO "user" (id, firstname, lastname, birthday, nickname, domicile, mdp, id_groupe) VALUES
(2, 'Quentin', 'Pichollet', '1997-08-19', 'Pichet', 'Orléans', '2f3497b77103fbaa8794550ed1c2c75b', 2);
INSERT INTO "user" (id, firstname, lastname, birthday, nickname, domicile, mdp, id_groupe) VALUES/*mabite*/
(3,'Christian','Morello', '1997-11-01', 'Leji','Besançon','78d1a0fddcd80f7e2f430fafae076cae',2);
INSERT INTO "user" (id, firstname, lastname, birthday, nickname, domicile, mdp, id_groupe) VALUES/*sabite*/
(4,'Hugues', 'Genin', '1998-03-24','Barnum','Valenciennes','d41d8cd98f00b204e9800998ecf8427e',2);
INSERT INTO "user" (id, firstname, lastname, birthday, nickname, domicile, mdp, id_groupe) VALUES
(5,'Thomas','Gubeno', '1998-12-04', 'Gub','Grasse','2db191ecb92a3f0357416048467939a1',1);/*gemlateub*/
INSERT INTO "user" (id, firstname, lastname, birthday, nickname, domicile, mdp, id_groupe) VALUES
(6,'Paul','Thibaud', '1997-05-12', 'Hansen','Orléans','8b16f9fb30774e1bab277eeaa0c88e46',1);/*fortnitevie*/
INSERT INTO "user" (id, firstname, lastname, birthday, nickname, domicile, mdp, id_groupe) VALUES
(7,'JB','Skutnik', '1997-08-23', 'Spoutnik','Lille','0f28337fe1fb96456aadc9644382c186',1);/*chibron*/
INSERT INTO "user" (id, firstname, lastname, birthday, nickname, domicile, mdp, id_groupe) VALUES
(8,'Yassir','Checkour', '1997-04-25', 'Yass','Casablanca','3b83beaa93c93eb761fd1d42b0287920',2);/*damn*/



