

CREATE TABLE IF NOT EXISTS "users" (
  user_id SERIAL PRIMARY KEY,
  name VARCHAR NOT NULL ,
  firstname VARCHAR NOT NULL ,
  nickname VARCHAR NOT NULL,
  quote VARCHAR NOT NULL,
  scientist VARCHAR  NOT NULL,
  password VARCHAR
  );



CREATE TABLE IF NOT EXISTS "Livre"(
  livre_id SERIAL PRIMARY KEY,
  titre VARCHAR NOT NULL,
  auteur VARCHAR NOT NULL,
  categorie VARCHAR, 
  resume VARCHAR ,
  isbn INT,
  editeur VARCHAR,
  nbpages INT,
  annee INT,
  prix INT,
  disponibilite INT NOT NULL
);


CREATE TYPE type_role AS ENUM ('prez', 'vice_prez', 'sec_gen','tresorie', 'membre', 'membre_ext', 'iien');

CREATE TABLE IF NOT EXISTS "Utilisateur" (
  id SERIAL PRIMARY KEY,
  nom VARCHAR NOT NULL,
  prenom VARCHAR NOT NULL,
  username VARCHAR NOT NULL,
  password VARCHAR NOT NULL,
  role type_role NOT NULL,
  email VARCHAR NOT NULL,
  avatar VARCHAR NOT NULL,
  citation VARCHAR,
  scientifique_prefere VARCHAR,
  signup_date INT NOT NULL
);



CREATE TABLE "Tab_role" (
  role type_role NOT NULL,
  est_admin BOOLEAN NOT NULL
);





INSERT INTO "Livre" (titre, auteur, categorie, resume, editeur, nbpages, annee, prix, disponibilite) VALUES ('Le Temps des robots est-il venu ?', 'Jean-Philippe Braly avec Jean-Gabriel Ganascia', 'Intelligence artificielle', null, 'Quae', '175','2017','19',5);
INSERT INTO "Livre" (titre, auteur, categorie,  resume, editeur, nbpages, annee, prix, disponibilite) VALUES ('Le mythe de la Singularité – Faut-il craindre l’intelligence artificielle ?', 'Jean-Gabriel Ganascia', 'Intelligence artificielle', null, 'du Seuil', '135','2017','18',3);
INSERT INTO "Livre" (titre, auteur, categorie,  resume, editeur, nbpages, annee, prix, disponibilite) VALUES ('Intelligence artificielle vers une domination programmée ?', 'Jean-Gabriel Ganascia', 'Intelligence artificielle', null, 'Le Cavalier Bleu', '215','2017','20',9);
INSERT INTO "Livre" (titre, auteur, categorie,  resume, editeur, nbpages, annee, prix, disponibilite) VALUES ('La logique', 'Gilles Dowek', 'Logique', null, 'Poche – Le Pommier', '96','2015','7',58);
INSERT INTO "Livre" (titre, auteur, categorie,  resume, editeur, nbpages, annee, prix, disponibilite) VALUES ('Mathématiques et mystères', 'Jean-Paul Delahaye', 'Mathématiques', 'Ce livre révèle les liens entre les mathématiques et l’informatique au travers de la cryptographie, de la logique...', 'Belin', '192','2016','24',8);
INSERT INTO "Livre" (titre, auteur, categorie,  resume, editeur, nbpages, annee, prix, disponibilite) VALUES ('Flatland', 'Edwin A. Abbott', 'Mathématiques',  'Roman discutant des différentes dimensions, et de pleins d’autres choses !', 'Librio', '125','2013','3',9);
INSERT INTO "Livre" (titre, auteur, categorie,  resume, editeur, nbpages, annee, prix, disponibilite) VALUES ('Les bâtisseurs du ciel', 'Jean-Pierre Luminet', 'Astronomie', 'Raconte la vie de Kepler, Newton, Copernic et Galilée', 'Jean-Claude Lattès', '1639','2010','29',11);
INSERT INTO "Livre" (titre, auteur, categorie,  resume, editeur, nbpages, annee, prix, disponibilite) VALUES ('Les trous noir, à la poursuite de l’invisible', 'Alain Riazuelo', 'Astronomie',   null, 'De Boeck SUP', '240','2018',null,15);
INSERT INTO "Livre" (titre, auteur, categorie,  resume, editeur, nbpages, annee, prix, disponibilite) VALUES ('Cosmos', 'Stuart Lowe et Chris North', 'Astronomie', null, 'Vigot', '224','2016','29',1);
INSERT INTO "Livre" (titre, auteur, categorie,  resume, editeur, nbpages, annee, prix, disponibilite) VALUES ('L’histoire des mathématiques', 'Richard Mankievicz', 'Mathématiques', null, 'Seuil', '192','2002',null,0);
INSERT INTO "Livre" (titre, auteur, categorie,  resume, editeur, nbpages, annee, prix, disponibilite) VALUES ('Le langage C – Norme ANSI', 'Brian W. Kernighan et Dennis M. Ritchie', 'Informatique', 'Ce livre (de référence) permet de connaître parfaitement le langage C (norme ANSI) au travers de divers exercices. Un autre livre complémentaire existe, contenant les corrigés', 'Dunod', '280','1997',null,8);
INSERT INTO "Livre" (titre, auteur, categorie,  resume, editeur, nbpages, annee, prix, disponibilite) VALUES ('Apprentissage de la programmation avec OCaml','Catherine Dubois et Valérie Ménissier-Morain', 'Informatique', 'Ce livre permet de découvrir le langage OCaml de manière tout à fait agréable à lire.', 'Hermes-Sciences', '450','2004',null,1);
INSERT INTO "Livre" (titre, auteur, categorie,  resume, editeur, nbpages, annee, prix, disponibilite) VALUES ('Le langage Caml','Pierre Weis et Xavier Leroy', 'Informatique', 'Ce livre est accompagné du livre de référence du langage Caml.', 'Dunod', '370','1999',null,7);
INSERT INTO "Livre" (titre, auteur, categorie,  resume, editeur, nbpages, annee, prix, disponibilite) VALUES ('Initiation à la théorie des graphes','Christian Roux', 'Mathématiques', null, 'Ellipses', '210','2009',null,5);
INSERT INTO "Livre" (titre, auteur, categorie,  resume, editeur, nbpages, annee, prix, disponibilite) VALUES ('Théorème vivant','Cédric Villani', 'Mathématiques', null, 'Ce roman reflète la vie d’un chercheur, notamment celle de Cédric Villani !', '310','2014','6',20);
INSERT INTO "Livre" (titre, auteur, categorie,  resume, editeur, nbpages, annee, prix, disponibilite) VALUES ('La relativité','Albert Einstein', 'Physique', null, 'Payot Rivages', '220','2013','7',22);
INSERT INTO "Livre" (titre, auteur, categorie,  resume, editeur, nbpages, annee, prix, disponibilite) VALUES ('Le Beau Livre des Maths – De Pythagore à la 57e dimension','Clifford A. Pickover', 'Mathématiques', 'Vous aimez les images et les histoires mathématiques ? Ce livre est pour vous !' , 'Dunod', '528','2010','29',1);
INSERT INTO "Livre" (titre, auteur, categorie, resume, editeur, nbpages, annee, prix, disponibilite) VALUES ('Problèmes pour mathématiciens, petits et grands','Paul Halmos', 'Mathématiques',  null , 'Cassini', '334','2001','15',6);
INSERT INTO "Livre" (titre, auteur, categorie, resume, editeur, nbpages, annee, prix, disponibilite) VALUES ('Quinze livres des éléments géométriques d’Euclide et livre du mesme trad. en françois','Euclide', 'Mathématiques',  'Tout mathématicien devrait avoir ce livre chez lui !', 'Hachette Livre et BnF', null,'1632',null,4);




