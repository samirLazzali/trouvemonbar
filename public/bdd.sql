CREATE TABLE Recette (
	id SERIAL NOT NULL,
	nom Varchar(50) NOT NULL,
	description TEXT,
	cout SMALLINT,
	difficulte SMALLINT,
	temps TIME,
	PRIMARY KEY (id)
);

CREATE TABLE Aliment (
	nom Varchar(20) NOT NULL,
	recette_id INT REFERENCES Recette(id),
	description TEXT,
	cout SMALLINT,
	PRIMARY KEY (nom)
);

CREATE TABLE usergroup(
	nom Varchar(20),
	description TEXT,
	PRIMARY KEY (nom)
);

CREATE TABLE utilisateur(
	login Varchar(50) NOT NULL,
	firstname Varchar(50) NOT NULL,
	lastname Varchar(50) NOT NULL,
	birthday DATE,
	password INT,
	groupe Varchar(20),
	PRIMARY KEY (login),
	CONSTRAINT fk_usergroup_nom
		FOREIGN KEY (groupe)
		REFERENCES usergroup(nom)
);

INSERT INTO Recette (id, nom, description, cout, difficulte, temps)
	VALUES (1, 'couscous', 'Délicieux', 2, 2, '03:00');

INSERT INTO Recette (id, nom, description, cout, difficulte, temps)
	VALUES (2, 'raclette', 'Plat qui réchauffe', 3, 1, '00:30');

INSERT INTO Aliment (nom, recette_id, description, cout)
	VALUES ('Fromage', 2, 'Sert à manger des raclettes', 3);

INSERT INTO Aliment (nom, recette_id, description, cout)
	VALUES ('merguez', 1, 'Un peu piquant', 1);

INSERT INTO Usergroup (nom, description)
	VALUES ('Premium', 'Obtient divers avantages');

INSERT INTO Usergroup (nom, description)
	VALUES ('Admin', 'Administrateur');

INSERT INTO utilisateur (login, firstname, lastname, birthday, password, groupe)
	VALUES ('Agammon', 'Paul', 'Barbé', '1997-08-26', 1234, 'Admin');

INSERT INTO utilisateur (login, firstname, lastname, birthday, password, groupe)
	VALUES ('Chacky', 'Alban', 'Thaumur', '1997-02-26', 5943, 'Admin');
