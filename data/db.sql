/* CREATE TYPE type_user AS ENUM ('Administrateur', 'Humain', 'Chat'); remplacés par 0 1 2 */
/* CREATE TYPE type_sex AS ENUM ('Male','Femelle','Attack helicopter'); remplacés par 0 1 2 */
/* CREATE TYPE type_size AS ENUM ('Miniscule','Petite','Moyenne','Grande','Géante','Ur momma'); remplacés par 0-5*/
/* CREATE TYPE type_coat AS ENUM ('Nu','Court','Mi-long','Long'); remplacés par 0-3 */
DROP TYPE IF EXISTS type_pattern CASCADE;
CREATE TYPE type_pattern AS ENUM ('Solide','Tabby','Colourpoint','Bicolore','Ecaille de tortue','Calico','Mink','Sepia');

DROP TABLE IF EXISTS Utilisateur CASCADE;
CREATE TABLE IF NOT EXISTS Utilisateur(
	id_user SERIAL PRIMARY KEY NOT NULL,
	login VARCHAR NOT NULL,
	mail VARCHAR NOT NULL,
	password VARCHAR NOT NULL,
	phone_number VARCHAR NOT NULL,
	user_type INTEGER NOT NULL CHECK (0 <= user_type AND user_type < 3)
	);
	
DROP TABLE IF EXISTS Connected CASCADE;
CREATE TABLE IF NOT EXISTS Connected(
	id_connected INTEGER UNIQUE NOT NULL
	);
	   
DROP TABLE IF EXISTS Cats CASCADE;
CREATE TABLE IF NOT EXISTS Cats(
       id_cat SERIAL PRIMARY KEY NOT NULL,
       owner INTEGER NOT NULL,
       FOREIGN KEY (owner) REFERENCES Utilisateur(id_user),
       name_cat VARCHAR NOT NULL,
       purety BOOLEAN,
       pattern type_pattern NOT NULL,

       birthday_cat DATE,
       sage_min INTEGER,
       sage_max INTEGER,

       sex INTEGER NOT NULL CHECK (0 <= sex AND sex < 3),
       ssex INTEGER NOT NULL CHECK (0 <= sex AND sex < 3),

       csize INTEGER CHECK (0 <= csize AND csize < 6),
       scsize_min INTEGER CHECK (0 <= csize AND csize < 6),
       scsize_max INTEGER CHECK (0 <= csize AND csize < 6),

       coat INTEGER CHECK (0<=coat AND coat < 4),
       scoat_min INTEGER CHECK (0<=coat AND coat < 4),
       scoat_max INTEGER CHECK (0<=coat AND coat < 4),

       weight FLOAT CHECK (0<weight),
       sweight_min FLOAT CHECK (0<weight),
       sweight_max FLOAT CHECK (0<weight)
	   );

		/* contient aussi une race (Cat_breed), une ou plusieurs couleurs (Cat_color) et traits de caractères (cat_personnality) 
		et les critères de recherche correspondants + pattern recherchés */

DROP TABLE IF EXISTS Breeds CASCADE;
CREATE TABLE IF NOT EXISTS Breeds(
       id_breed SERIAL PRIMARY KEY NOT NULL,
       name_breed VARCHAR NOT NULL
	   );
	   
DROP TABLE IF EXISTS Colors CASCADE;
CREATE TABLE IF NOT EXISTS Colors(
       id_color SERIAL PRIMARY KEY NOT NULL,
       name_color VARCHAR NOT NULL
       );

DROP TABLE IF EXISTS Personality_traits CASCADE;
CREATE TABLE IF NOT EXISTS Personality_traits(
       id_trait SERIAL PRIMARY KEY NOT NULL,
       name_trait VARCHAR NOT NULL
       );

DROP TABLE IF EXISTS Cat_colors CASCADE;
CREATE TABLE IF NOT EXISTS Cat_colors(
		cat INTEGER,
		color INTEGER,
		FOREIGN KEY (cat) REFERENCES Cats(id_cat),
		FOREIGN KEY (color) REFERENCES Colors(id_color),
		PRIMARY KEY (cat,color)
		);

DROP TABLE IF EXISTS Cat_breed CASCADE;
CREATE TABLE IF NOT EXISTS Cat_breed(
		cat INTEGER,
		breed INTEGER,
		FOREIGN KEY (cat) REFERENCES Cats(id_cat),
		FOREIGN KEY (breed) REFERENCES Breeds(id_breed),
		PRIMARY KEY (cat,breed)
		);

DROP TABLE IF EXISTS Cat_personality CASCADE;
CREATE TABLE IF NOT EXISTS Cat_personality(
		cat INTEGER,
		trait INTEGER,
		FOREIGN KEY (cat) REFERENCES Cats(id_cat),
		FOREIGN KEY (trait) REFERENCES Personality_traits(id_trait),
		PRIMARY KEY(cat,trait)
		);

DROP TABLE IF EXISTS Searched_traits CASCADE;
CREATE TABLE IF NOT EXISTS Searched_traits(
		cat INTEGER,
		trait INTEGER,
		FOREIGN KEY (cat) REFERENCES Cats(id_cat),
		FOREIGN KEY (trait) REFERENCES Personality_traits(id_trait),
		PRIMARY KEY(cat,trait)
		);

DROP TABLE IF EXISTS Searched_breeds CASCADE;
CREATE TABLE IF NOT EXISTS Searched_breeds(
		cat INTEGER,
		breed INTEGER,
		FOREIGN KEY (cat) REFERENCES Cats(id_cat),
		FOREIGN KEY (breed) REFERENCES Breeds(id_breed),
		PRIMARY KEY(cat,breed)
		);

DROP TABLE IF EXISTS Searched_colors CASCADE;
CREATE TABLE IF NOT EXISTS Searched_colors(
		cat INTEGER,
		color INTEGER,
		FOREIGN KEY (cat) REFERENCES Cats(id_cat),
		FOREIGN KEY (color) REFERENCES Colors(id_color),
		PRIMARY KEY(cat,color)
		);

DROP TABLE IF EXISTS Searched_patterns CASCADE;
CREATE TABLE IF NOT EXISTS Searched_patterns(
		cat INTEGER NOT NULL,
		pattern type_pattern NOT NULL,
		FOREIGN KEY (cat) REFERENCES Cats(id_cat),
		PRIMARY KEY(cat,pattern)
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
INSERT INTO Personality_traits VALUES('9','Calme');


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
INSERT INTO Breeds VALUES ('21','chat de goutière');


INSERT INTO Utilisateur VALUES ('1','Jesus','Jesus@paradise.net','406fcef6cb90b615f5e4c5239f05d4dc','0001001001','0'); /* mdp Amen0 :*/
INSERT INTO Utilisateur VALUES ('2','Alphabet','boss@google.net','0c4ea8bb1bd4ef54defc54a73d5c9612','0008008008','1'); /* mdp Ch1en */
INSERT INTO Utilisateur VALUES ('3','Clochard','mauvais@rue.com','483a6adfa09079059fd9eb3849932724','9876543210','1'); /* mdp SNCF2merde */
INSERT INTO Utilisateur VALUES ('4','Jean-Eudes','je.dieseman@diese.org','42f66f9ed55f43a0eb4bd560e7cf87a5','0154879632','1'); /* mdp D1eseRecherche */
INSERT INTO Utilisateur VALUES ('5','Manu','manu@lolywood.lol','d2327508d0641a64591eaf5d6188de35','0147852369','1'); /* mdp L0lywood */

INSERT INTO Cats VALUES ('1','1','Pierre',TRUE,'Solide','0001-12-25',NULL,NULL, '0','1', '1',NULL,NULL, '1',NULL,NULL, 5,NULL,NULL);
INSERT INTO Cat_colors VALUES ('1','9');
INSERT INTO Cat_breed VALUES ('1','14');
INSERT INTO Cat_personality VALUES ('1','9');
INSERT INTO Searched_traits VALUES ('1','9');
INSERT INTO Searched_breeds VALUES ('1','11');

INSERT INTO Cats VALUES ('2','2','Google',FALSE,'Bicolore','1995-04-26','8','15', '0','1', '2','0','2', '2','1',NULL, '6','4','10');
INSERT INTO Cat_colors VALUES ('2','9');
INSERT INTO Cat_colors VALUES ('2','2');
INSERT INTO Cat_breed VALUES ('2','9');
INSERT INTO Cat_personality VALUES ('2','2');
INSERT INTO Cat_personality VALUES ('2','5');
INSERT INTO Searched_traits VALUES ('2','7');
INSERT INTO Searched_traits VALUES ('2','9');
INSERT INTO Searched_breeds VALUES ('2','6');
INSERT INTO Searched_breeds VALUES ('2','8');
INSERT INTO Searched_colors VALUES ('2','1');
INSERT INTO Searched_patterns VALUES ('2','Calico');

INSERT INTO Cats VALUES ('3','3','Duchesse',FALSE,'Solide','2003-04-26','3',NULL, '1','0', '1','2',NULL, '2','1',NULL, '5','6','15');
INSERT INTO Cat_colors VALUES ('3','9');
INSERT INTO Cat_breed VALUES ('3','2');
INSERT INTO Cat_personality VALUES ('3','3');
INSERT INTO Cat_personality VALUES ('3','7');
INSERT INTO Cat_personality VALUES ('3','9');
INSERT INTO Searched_traits VALUES ('3','8');
INSERT INTO Searched_breeds VALUES ('3','21');
INSERT INTO Searched_breeds VALUES ('3','10');
INSERT INTO Searched_colors VALUES ('3','3');
INSERT INTO Searched_colors VALUES ('3','9');
INSERT INTO Searched_patterns VALUES ('3','Colourpoint');

INSERT INTO Cats VALUES ('4','1','Angel',FALSE,'Colourpoint','2009-05-16','7',NULL, '0','1', '4','1',NULL, '2','2',NULL, '5','6','15');
INSERT INTO Cat_colors VALUES ('4','9');
INSERT INTO Cat_colors VALUES ('4','3');
INSERT INTO Cat_breed VALUES ('4','21');
INSERT INTO Cat_personality VALUES ('4','1');
INSERT INTO Cat_personality VALUES ('4','8');
INSERT INTO Searched_traits VALUES ('4','2');
INSERT INTO Searched_patterns VALUES ('4','Colourpoint');
INSERT INTO Searched_patterns VALUES ('4','Solide');

INSERT INTO Cats VALUES ('5','3','Marie',FALSE,'Ecaille de tortue','20013-07-27',NULL,'10', '1','0', '4',NULL,'3', '3','1',NULL, '15','4','12');
INSERT INTO Cat_colors VALUES ('5','5');
INSERT INTO Cat_colors VALUES ('5','4');
INSERT INTO Cat_colors VALUES ('5','2');
INSERT INTO Cat_breed VALUES ('5','14');
INSERT INTO Cat_personality VALUES ('5','5');
INSERT INTO Cat_personality VALUES ('5','4');
INSERT INTO Cat_personality VALUES ('5','1');
INSERT INTO Searched_traits VALUES ('5','9');
INSERT INTO Searched_patterns VALUES ('5','Colourpoint');
INSERT INTO Searched_patterns VALUES ('5','Solide');
INSERT INTO Searched_patterns VALUES ('5','Bicolore');


INSERT INTO Cats VALUES ('6','5','Winston',FALSE,'Tabby','2014-06-01',NULL,'3', '0','1', '2','0',2, '1','1',NULL, '4',NULL,'4');
INSERT INTO Cat_colors VALUES ('6','1');
INSERT INTO Cat_colors VALUES ('6','6');
INSERT INTO Cat_colors VALUES ('6','8');
INSERT INTO Cat_breed VALUES ('6','21');
INSERT INTO Cat_personality VALUES ('6','1');
INSERT INTO Cat_personality VALUES ('6','2');
INSERT INTO Cat_personality VALUES ('6','6');
INSERT INTO Searched_traits VALUES ('6','7');
INSERT INTO Searched_patterns VALUES ('6','Solide');