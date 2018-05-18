/* CREATE TYPE type_user AS ENUM ('Administrateur', 'Humain', 'Chat');
CREATE TYPE type_sex AS ENUM ('Male','Femelle','Attack helicopter');
CREATE TYPE type_size AS ENUM ('Miniscule','Petite','Moyenne','Grande','Géante','Ur momma');
CREATE TYPE type_coat AS ENUM ('Nu','Court','Mi-long','Long');
CREATE TYPE type_pattern AS ENUM ('Solide','Tabby','Colourpoint','Bicolore','Ecaille de tortue','Calico','Mink','Sepia'); */

DROP DATABASE IF EXISTS Catisfaction;
CREATE DATABASE IF NOT EXISTS Catisfaction;

DROP TABLE IF EXISTS Utilisateur;
CREATE TABLE IF NOT EXISTS Utilisateur(
	id_user INTEGER(4) AUTO_INCREMENT PRIMARY KEY NOT NULL,
	login VARCHAR(100) NOT NULL,
	mail VARCHAR(255) NOT NULL,
	password VARCHAR(50) NOT NULL,
	phone_number INTEGER(10) NOT NULL
	/* user_type type_user */
	);
	
DROP TABLE IF EXISTS Connected;
CREATE TABLE IF NOT EXISTS Connected(
	id_connected INTEGER(4) UNIQUE KEY NOT NULL
	);
	   
DROP TABLE IF EXISTS Cats;
CREATE TABLE IF NOT EXISTS Cats(
       id_cat INTEGER(4) AUTO_INCREMENT PRIMARY KEY NOT NULL,
       name_cat VARCHAR(100) NOT NULL,
       /*sex type_sex NOT NULL, */
       birthday_cat DATE,
       purety BOOLEAN,
	   /* size type_size,
       coat type_coat,
       pattern type_pattern, */
       weight FLOAT(10) 
	   );

DROP TABLE IF EXISTS Breeds;
CREATE TABLE IF NOT EXISTS Breeds(
       id_breed INTEGER(4) AUTO_INCREMENT PRIMARY KEY,
       name_breed VARCHAR(100) NOT NULL
	   );
	   
DROP TABLE IF EXISTS Colors;   
CREATE TABLE IF NOT EXISTS Colors(
       id_color INTEGER(4) AUTO_INCREMENT PRIMARY KEY,
       name_color VARCHAR(100) NOT NULL
       );

DROP TABLE IF EXISTS Personality_traits;	   
CREATE TABLE IF NOT EXISTS Personality_traits(
       id_trait INTEGER(4) AUTO_INCREMENT PRIMARY KEY,
       name_trait VARCHAR(100) NOT NULL
       );

DROP TABLE IF EXISTS Cat_color;	   
CREATE TABLE IF NOT EXISTS Cat_colors(
		cat INTEGER(4),
		color INTEGER(4),
		FOREIGN KEY (cat) REFERENCES Cats(id_cat),
		FOREIGN KEY (color) REFERENCES Colors(id_color),
		PRIMARY KEY (cat,color)
		);

DROP TABLE IF EXISTS Cat_breed;		
CREATE TABLE IF NOT EXISTS Cat_breed(
		cat INTEGER(4),
		breed INTEGER(4),
		FOREIGN KEY (cat) REFERENCES Cats(id_cat),
		FOREIGN KEY (breed) REFERENCES Breeds(id_breed),
		PRIMARY KEY (cat,breed)
		);

DROP TABLE IF EXISTS Cat_personality;
CREATE TABLE IF NOT EXISTS Cat_personality(
		cat INTEGER(4),
		trait INTEGER(4),
		FOREIGN KEY (cat) REFERENCES Cats(id_cat),
		FOREIGN KEY (trait) REFERENCES Personality_traits(id_trait),
		PRIMARY KEY(cat,trait)
		);

DROP TABLE IF EXISTS Searched_traits;
CREATE TABLE IF NOT EXISTS Searched_traits(
		cat INTEGER(4),
		trait INTEGER(4),
		FOREIGN KEY (cat) REFERENCES Cats(id_cat),
		FOREIGN KEY (trait) REFERENCES Personality_traits(id_trait),
		PRIMARY KEY(cat,trait)
		);

DROP TABLE IF EXISTS Searched_breeds;	   
CREATE TABLE IF NOT EXISTS Searched_breeds(
		cat INTEGER(4),
		breed INTEGER(4),
		FOREIGN KEY (cat) REFERENCES Cats(id_cat),
		FOREIGN KEY (breed) REFERENCES Breeds(id_breed),
		PRIMARY KEY(cat,breed)
		);

DROP TABLE IF EXISTS Searched_colors;	   
CREATE TABLE IF NOT EXISTS Searched_colors(
		cat INTEGER(4),
		color INTEGER(4),
		FOREIGN KEY (cat) REFERENCES Cats(id_cat),
		FOREIGN KEY (color) REFERENCES Colors(id_color),
		PRIMARY KEY(cat,color)
		);


INSERT INTO Colors VALUES ('1','Noir');
INSERT INTO Colors VALUES ('2','Bleu');
INSERT INTO Colors VALUES ('3','Chocolat');
INSERT INTO Colors VALUES ('4','Lilas');
INSERT INTO Colors VALUES ('5','Cannelle');
INSERT INTO Colors VALUES ('6','Fauve');
INSERT INTO Colors VALUES ('7','Roux');
INSERT INTO Colors VALUES ('8','Crème');
INSERT INTO Colors VALUES ('9','Blanc');
INSERT INTO Colors VALUES ('10','Ambre');
INSERT INTO Colors VALUES ('11','Ambre clair');
INSERT INTO Colors VALUES ('12','Abricot');


INSERT INTO Personality_traits VALUES('1','Malicieux');
INSERT INTO Personality_traits VALUES('2','Joueur');
INSERT INTO Personality_traits VALUES('3','Calin');
INSERT INTO Personality_traits VALUES('4','Paresseux');
INSERT INTO Personality_traits VALUES('5','Bruyant');
INSERT INTO Personality_traits VALUES('6','Tonique');
INSERT INTO Personality_traits VALUES('7','Emotif');
INSERT INTO Personality_traits VALUES('8','Chasseur');

/*
INSERT INTO "breeds"(id_breed,name_breed) VALUES ('1','');
INSERT INTO "breeds"(id_breed,name_breed) VALUES ('2','');
INSERT INTO "breeds"(id_breed,name_breed) VALUES ('3','');
INSERT INTO "breeds"(id_breed,name_breed) VALUES ('4','');
INSERT INTO "breeds"(id_breed,name_breed) VALUES ('5','');
INSERT INTO "breeds"(id_breed,name_breed) VALUES ('6','');
INSERT INTO "breeds"(id_breed,name_breed) VALUES ('7','');
INSERT INTO "breeds"(id_breed,name_breed) VALUES ('8','');
INSERT INTO "breeds"(id_breed,name_breed) VALUES ('9','');
INSERT INTO "breeds"(id_breed,name_breed) VALUES ('10','');
INSERT INTO "breeds"(id_breed,name_breed) VALUES ('11','');
INSERT INTO "breeds"(id_breed,name_breed) VALUES ('12','');
INSERT INTO "breeds"(id_breed,name_breed) VALUES ('13','');
INSERT INTO "breeds"(id_breed,name_breed) VALUES ('14','');
INSERT INTO "breeds"(id_breed,name_breed) VALUES ('15','');
INSERT INTO "breeds"(id_breed,name_breed) VALUES ('16','');
INSERT INTO "breeds"(id_breed,name_breed) VALUES ('17','');
INSERT INTO "breeds"(id_breed,name_breed) VALUES ('18','');
INSERT INTO "breeds"(id_breed,name_breed) VALUES ('19','');
INSERT INTO "breeds"(id_breed,name_breed) VALUES ('20',''); */
