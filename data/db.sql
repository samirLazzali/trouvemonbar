/* BASE PAR DEFAULT
CREATE TABLE IF NOT EXISTS "user" (
	id SERIAL PRIMARY KEY ,
	firstname VARCHAR NOT NULL ,
	lastname VARCHAR NOT NULL ,
	birthday date
);

INSERT INTO "user"(firstname, lastname, birthday) VALUES ('John', 'Doe', '1967-11-22');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Yvette', 'Angel', '1932-01-24');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Amelia', 'Waters', '1981-12-01');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Manuel', 'Holloway', '1979-07-25');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Alonzo', 'Erickson', '1947-11-13');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Otis', 'Roberson', '1995-01-09');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Jaime', 'King', '1924-05-30');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Vicky', 'Pearson', '1982-12-12)');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Silvia', 'Mcguire', '1971-03-02');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Brendan', 'Pena', '1950-02-17');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Jackie', 'Cohen', '1967-01-27');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Delores', 'Williamson', '1961-07-19');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Jean-Michel', 'Poitou', '1961-07-19');
*/

--DROP TABLE users;
CREATE TABLE IF NOT EXISTS "users" (
	user_id SERIAL PRIMARY KEY,
	name VARCHAR NOT NULL ,
	email VARCHAR NOT NULL ,
	username VARCHAR NOT NULL,
	password VARCHAR NOT NULL,
	role VARCHAR  NOT NULL,
	address VARCHAR,
	city VARCHAR,
	country VARCHAR,
	zip VARCHAR,
	bio TEXT
	);



INSERT INTO "users"(name, email, username, password, role) VALUES ('Remi HUGUET', 'isssou@ensiie.fr', 'issou', 'tanche1','admin');
INSERT INTO "users"(name, email, username, password, role)  VALUES ('Johan CHAGON', 'pohan@ensiie.fr', 'POHAN', 'tanche2','admin');
INSERT INTO "users"(name, email, username, password, role) VALUES ('Nicolas ETHEVE', 'carry@ensiie.fr', 'CARRY', 'tanche3','admin');
INSERT INTO "users"(name, email, username, password, role) VALUES ('Valentin LE STRAT', 'ward@ensiie.fr', 'WARD', 'tanche4','admin');
INSERT INTO "users"(name, email, username, password, role) VALUES ('member', 'member@ensiie.fr', 'member', 'member','member');


--DROP TABLE "Nutriments" CASCADE;
CREATE TABLE IF NOT EXISTS "Nutriments"(
	nutri_id SERIAL PRIMARY KEY,
	n_name VARCHAR NOT NULL
	);

INSERT INTO "Nutriments"(n_name) VALUES ('Protéines');
INSERT INTO "Nutriments"(n_name) VALUES ('Glucides');
INSERT INTO "Nutriments"(n_name) VALUES ('Lipides');
INSERT INTO "Nutriments"(n_name) VALUES ('Énergie');
INSERT INTO "Nutriments"(n_name) VALUES ('Fibres');

--DROP TABLE "Aliments" CASCADE;
CREATE TABLE IF NOT EXISTS "Aliments"(
	alim_id SERIAL PRIMARY KEY,
	a_name VARCHAR NOT NULL
	);

INSERT INTO "Aliments"(a_name) VALUES ('Pomme');
INSERT INTO "Aliments"(a_name) VALUES ('Banane');
INSERT INTO "Aliments"(a_name) VALUES ('Boudin noir');


--DROP TABLE "Aliments_Nutriments";
CREATE TABLE IF NOT EXISTS "Aliments_Nutriments"(
	alim_id INT NOT NULL,
	nutri_id  INT NOT NULL,
	quantity DECIMAL,
	PRIMARY KEY (alim_id, nutri_id),
	FOREIGN KEY (alim_id)  REFERENCES "Aliments" (alim_id),
	FOREIGN KEY (nutri_id) REFERENCES "Nutriments" (nutri_id)
   );

INSERT INTO "Aliments_Nutriments" VALUES (1, 1, 0.290);
INSERT INTO "Aliments_Nutriments" VALUES (1, 2, 10.39);
INSERT INTO "Aliments_Nutriments" VALUES (1, 3, 0.17);
INSERT INTO "Aliments_Nutriments" VALUES (1, 4, 52);
INSERT INTO "Aliments_Nutriments" VALUES (1, 5, 2.4);

INSERT INTO "Aliments_Nutriments" VALUES (2, 1, 1.09);
INSERT INTO "Aliments_Nutriments" VALUES (2, 2, 12.23);
INSERT INTO "Aliments_Nutriments" VALUES (2, 3, 0.33);
INSERT INTO "Aliments_Nutriments" VALUES (2, 4, 89);
INSERT INTO "Aliments_Nutriments" VALUES (2, 5, 2.6);

INSERT INTO "Aliments_Nutriments" VALUES (3, 1, 15);
INSERT INTO "Aliments_Nutriments" VALUES (3, 2, 1.3);
INSERT INTO "Aliments_Nutriments" VALUES (3, 3, 35);
INSERT INTO "Aliments_Nutriments" VALUES (3, 4, 379);
INSERT INTO "Aliments_Nutriments" VALUES (3, 5, 0);