CREATE TABLE evenements(
  id int NOT NULL,
  organisateur int NOT NULL,
  nom varchar(100) NOT NULL,
  description text,
  lieu varchar(100) NOT NULL,
  date date NOT NULL,
  date_creation date NOT NULL,
  date_modif date DEFAULT NULL,
  before varchar(100) DEFAULT NULL,
  prix double precision NOT NULL,
  musique int DEFAULT NULL,
  categorie int DEFAULT NULL,
  table_participants varchar(100) NOT NULL
);

INSERT INTO evenements (id, organisateur, nom, description, lieu, date, date_creation, date_modif, before, prix, musique, categorie, table_participants) VALUES
(4, 1, 'First Event', NULL, 'Chez moi', '2018-05-08', '2018-05-08', NULL, NULL, 0, NULL, 1, 'participants3897910314'),
(5, 1, 'First Event', NULL, 'Chez moi', '2018-05-09', '2018-05-09', NULL, NULL, 0, NULL, 1, 'p2411932048');


CREATE TABLE musiques (
  id int NOT NULL,
  musique varchar(100) NOT NULL
) ;


CREATE TABLE p2411932048 (
  id int NOT NULL
) ;


INSERT INTO p2411932048 (id) VALUES
(1);


CREATE TABLE participants3897910314 (
  id int NOT NULL
) ;


CREATE TABLE users (
  id int NOT NULL,
  firstname varchar(100) NOT NULL,
  lastname varchar(100) NOT NULL,
  birthday date NOT NULL,
  nickname varchar(100) NOT NULL,
  domicile varchar(100) NOT NULL,
  mdp varchar(100) NOT NULL,
  id_groupe int NOT NULL
) ;

INSERT INTO users (id, firstname, lastname, birthday, nickname, domicile, mdp, id_groupe) VALUES
(1, 'Martin', 'Dufour', '1997-08-27', 'Feuj', 'maison', 'martin', 2);


ALTER TABLE categories
  ADD PRIMARY KEY (id);

--
-- Index pour la table evenements
--
ALTER TABLE evenements
  ADD PRIMARY KEY (id),
  ADD KEY organisateur_id (organisateur),
  ADD KEY musique_id (musique),
  ADD KEY categorie_id (categorie),
  ADD KEY participants_table_nom (table_participants);

--
-- Index pour la table musiques
--
ALTER TABLE musiques
  ADD PRIMARY KEY (id);

--
-- Index pour la table p2411932048
--
ALTER TABLE p2411932048
  ADD PRIMARY KEY (id);

--
-- Index pour la table participants3897910314
--
ALTER TABLE participants3897910314
  ADD PRIMARY KEY (id);

--
-- Index pour la table users
--
ALTER TABLE users
  ADD PRIMARY KEY (id);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table categories
--
ALTER TABLE categories
  MODIFY id cast(11 as int) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table evenements
--
ALTER TABLE evenements
  MODIFY id cast(11 as int) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table musiques
--
ALTER TABLE musiques
  MODIFY id cast(11 as int) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table users
--
ALTER TABLE users
  MODIFY id cast(11 as int) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
