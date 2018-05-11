/* CREATE TYPE type_user AS ENUM ('Administrateur', 'Humain', 'Chat');
CREATE TYPE type_sex AS ENUM ('Male','Femelle','Attack helicopter');
CREATE TYPE type_size AS ENUM ('Miniscule','Petite','Moyenne','Grande','Géante','Ur momma');
CREATE TYPE type_coat AS ENUM ('Nu','Court','Mi-long','Long');
CREATE TYPE type_pattern AS ENUM ('Solide','Tabby','Colourpoint','Bicolore','Ecaille de tortue','Calico','Mink','Sepia'); */

DROP DATABASE IF EXISTS catisfaction;
CREATE DATABASE IF NOT EXISTS catisfaction;

DROP TABLE IF EXISTS utilisateur ;
CREATE TABLE IF NOT EXISTS utilisateur(
       id_user SERIAL PRIMARY KEY,
       login VARCHAR NOT NULL,
       password VARCHAR NOT NULL,
	   phone_number INTEGER(10),
       /* type type_user NOT NULL, */
	   mail VARCHAR NOT NULL
	   );
	   
DROP TABLE IF EXISTS cats;
CREATE TABLE IF NOT EXISTS cats(
       id_cat SERIAL PRIMARY KEY ,
       name_cat VARCHAR NOT NULL ,
       /*sex type_sex NOT NULL , */
       birthday_cat DATE ,
       purety BOOLEAN ,
	   /* size type_size ,
       coat type_coat ,
       pattern type_pattern , */
       weight FLOAT 
	   );

DROP TABLE IF EXISTS breeds;
CREATE TABLE IF NOT EXISTS breeds(
       id_breed SERIAL PRIMARY KEY ,
       name_breed VARCHAR NOT NULL
	   );
	   
DROP TABLE IF EXISTS colors;   
CREATE TABLE IF NOT EXISTS colors(
       id_color SERIAL PRIMARY KEY ,
       name_color VARCHAR NOT NULL
       );

DROP TABLE IF EXISTS personality_traits;	   
CREATE TABLE IF NOT EXISTS personality_traits(
       id_trait SERIAL PRIMARY KEY,
       name_trait VARCHAR NOT NULL
       );

DROP TABLE IF EXISTS cat_color;	   
CREATE TABLE IF NOT EXISTS cat_colors(
		FOREIGN KEY (cat) REFERENCES cats(id_cat),
		FOREIGN KEY (color) REFERENCES colors(id_color),
		PRIMARY KEY (cat,color)
		);

DROP TABLE IF EXISTS cat_breed;		
CREATE TABLE IF NOT EXISTS cat_breed(
		FOREIGN KEY (cat) REFERENCES cats(id_cat),
		FOREIGN KEY (breed) REFERENCES breeds(id_breed),
		PRIMARY KEY (cat,breed)
		);

DROP TABLE IF EXISTS cat_personality;
CREATE TABLE IF NOT EXISTS cat_personality(
       FOREIGN KEY (cat) REFERENCES cats(id_cat),
       FOREIGN KEY (trait) REFERENCES personality_traits(id_trait),
       PRIMARY KEY(cat,trait)
       );

DROP TABLE IF EXISTS searched_traits;
CREATE TABLE IF NOT EXISTS searched_traits(
       FOREIGN KEY (cat) REFERENCES cats(id_cat),
       FOREIGN KEY (trait) REFERENCES personality_traits(id_trait),
       PRIMARY KEY(cat,trait)
       );

DROP TABLE IF EXISTS searched_breeds;	   
CREATE TABLE IF NOT EXISTS searched_breeds(
       FOREIGN KEY (cat) REFERENCES cats(id_cat),
       FOREIGN KEY (breed) REFERENCES personality_traits(id_breed),
       PRIMARY KEY(cat,breed)
       );

DROP TABLE IF EXISTS searched_colors;	   
CREATE TABLE IF NOT EXISTS searched_colors(
       FOREIGN KEY (cat) REFERENCES cats(id_cat),
       FOREIGN KEY (color) REFERENCES colors(id_color),
       PRIMARY KEY(cat,color)
       );

/* INSERT INTO "colors"(id_color,name_color) VALUES ('1','Noir');
INSERT INTO "colors"(id_color,name_color) VALUES ('2','Bleu');
INSERT INTO "colors"(id_color,name_color) VALUES ('3','Chocolat');
INSERT INTO "colors"(id_color,name_color) VALUES ('4','Lilas');
INSERT INTO "colors"(id_color,name_color) VALUES ('5','Cannelle');
INSERT INTO "colors"(id_color,name_color) VALUES ('6','Fauve');
INSERT INTO "colors"(id_color,name_color) VALUES ('7','Roux');
INSERT INTO "colors"(id_color,name_color) VALUES ('8','Crème');
INSERT INTO "colors"(id_color,name_color) VALUES ('9','Blanc');
INSERT INTO "colors"(id_color,name_color) VALUES ('10','Ambre');
INSERT INTO "colors"(id_color,name_color) VALUES ('11','Ambre clair');
INSERT INTO "colors"(id_color,name_color) VALUES ('12','Abricot');

INSERT INTO "personality_traits"(id_trait,name_trait) VALUES('1','');
INSERT INTO "personality_traits"(id_trait,name_trait) VALUES('2','');
INSERT INTO "personality_traits"(id_trait,name_trait) VALUES('3','');
INSERT INTO "personality_traits"(id_trait,name_trait) VALUES('4','');
INSERT INTO "personality_traits"(id_trait,name_trait) VALUES('5','');
INSERT INTO "personality_traits"(id_trait,name_trait) VALUES('6','');
INSERT INTO "personality_traits"(id_trait,name_trait) VALUES('7','');
INSERT INTO "personality_traits"(id_trait,name_trait) VALUES('8','');
INSERT INTO "personality_traits"(id_trait,name_trait) VALUES('9','');
INSERT INTO "personality_traits"(id_trait,name_trait) VALUES('10','');

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
