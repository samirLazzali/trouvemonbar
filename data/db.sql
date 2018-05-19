/* CREATE TYPE type_user AS ENUM ('Administrateur', 'Humain', 'Chat');
CREATE TYPE type_sex AS ENUM ('Male','Femelle','Attack helicopter');
CREATE TYPE type_size AS ENUM ('Miniscule','Petite','Moyenne','Grande','Géante','Ur momma');
CREATE TYPE type_coat AS ENUM ('Nu','Court','Mi-long','Long');
CREATE TYPE type_pattern AS ENUM ('Solide','Tabby','Colourpoint','Bicolore','Ecaille de tortue','Calico','Mink','Sepia'); */

DROP TABLE IF EXISTS Utilisateur;
CREATE TABLE IF NOT EXISTS Utilisateur(
	id_user SERIAL PRIMARY KEY NOT NULL,
	login VARCHAR NOT NULL,
	mail VARCHAR NOT NULL,
	password VARCHAR NOT NULL,
	phone_number INTEGER NOT NULL
	/* user_type type_user */
	);
	
DROP TABLE IF EXISTS Connected;
CREATE TABLE IF NOT EXISTS Connected(
	id_connected INTEGER UNIQUE KEY NOT NULL
	);
	   
DROP TABLE IF EXISTS Cats;
CREATE TABLE IF NOT EXISTS Cats(
       id_cat SERIAL PRIMARY KEY NOT NULL,
       name_cat VARCHAR NOT NULL,
       /*sex type_sex NOT NULL, */
       birthday_cat DATE,
       purety BOOLEAN,
	   /* size type_size,
       coat type_coat,
       pattern type_pattern, */
       weight FLOAT 
	   );

DROP TABLE IF EXISTS Breeds;
CREATE TABLE IF NOT EXISTS Breeds(
       id_breed SERIAL PRIMARY KEY NOT NULL,
       name_breed VARCHAR NOT NULL
	   );
	   
DROP TABLE IF EXISTS Colors;   
CREATE TABLE IF NOT EXISTS Colors(
       id_color SERIAL PRIMARY KEY NOT NULL,
       name_color VARCHAR NOT NULL
       );

DROP TABLE IF EXISTS Personality_traits;	   
CREATE TABLE IF NOT EXISTS Personality_traits(
       id_trait SERIAL PRIMARY KEY NOT NULL,
       name_trait VARCHAR NOT NULL
       );

DROP TABLE IF EXISTS Cat_color;	   
CREATE TABLE IF NOT EXISTS Cat_colors(
		cat INTEGER,
		color INTEGER,
		FOREIGN KEY (cat) REFERENCES Cats(id_cat),
		FOREIGN KEY (color) REFERENCES Colors(id_color),
		PRIMARY KEY (cat,color)
		);

DROP TABLE IF EXISTS Cat_breed;		
CREATE TABLE IF NOT EXISTS Cat_breed(
		cat INTEGER,
		breed INTEGER,
		FOREIGN KEY (cat) REFERENCES Cats(id_cat),
		FOREIGN KEY (breed) REFERENCES Breeds(id_breed),
		PRIMARY KEY (cat,breed)
		);

DROP TABLE IF EXISTS Cat_personality;
CREATE TABLE IF NOT EXISTS Cat_personality(
		cat INTEGER,
		trait INTEGER,
		FOREIGN KEY (cat) REFERENCES Cats(id_cat),
		FOREIGN KEY (trait) REFERENCES Personality_traits(id_trait),
		PRIMARY KEY(cat,trait)
		);

DROP TABLE IF EXISTS Searched_traits;
CREATE TABLE IF NOT EXISTS Searched_traits(
		cat INTEGER,
		trait INTEGER,
		FOREIGN KEY (cat) REFERENCES Cats(id_cat),
		FOREIGN KEY (trait) REFERENCES Personality_traits(id_trait),
		PRIMARY KEY(cat,trait)
		);

DROP TABLE IF EXISTS Searched_breeds;	   
CREATE TABLE IF NOT EXISTS Searched_breeds(
		cat INTEGER,
		breed INTEGER,
		FOREIGN KEY (cat) REFERENCES Cats(id_cat),
		FOREIGN KEY (breed) REFERENCES Breeds(id_breed),
		PRIMARY KEY(cat,breed)
		);

DROP TABLE IF EXISTS Searched_colors;	   
CREATE TABLE IF NOT EXISTS Searched_colors(
		cat INTEGER,
		color INTEGER,
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

INSERT INTO Breeds VALUES ('1','Siamois');
INSERT INTO Breeds VALUES ('2','Persan');
INSERT INTO Breeds VALUES ('3','Ragdoll');
INSERT INTO Breeds VALUES ('4','Bengan');
INSERT INTO Breeds VALUES ('5','Sphynx');
INSERT INTO Breeds VALUES ('6','Abyssin');
INSERT INTO Breeds VALUES ('7','Burmese');
INSERT INTO Breeds VALUES ('8','Bobtail américain');
INSERT INTO Breeds VALUES ('9','British Shorthair');
INSERT INTO Breeds VALUES ('10','Maine coon');
INSERT INTO Breeds VALUES ('11','Sacré de Birmanie');
INSERT INTO Breeds VALUES ('12','Sibérien');
INSERT INTO Breeds VALUES ('13','Cornish rex');
INSERT INTO Breeds VALUES ('14','Ocicat');
INSERT INTO Breeds VALUES ('15','Norvégien');
INSERT INTO Breeds VALUES ('16','Tonkinois');
INSERT INTO Breeds VALUES ('17','Manx');
INSERT INTO Breeds VALUES ('18','Angora Turc');
INSERT INTO Breeds VALUES ('19','Savannah');
INSERT INTO Breeds VALUES ('20','Himalayen');
