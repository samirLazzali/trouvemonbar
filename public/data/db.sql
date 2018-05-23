CREATE TABLE Pays (
id_p SERIAL PRIMARY KEY ,
nom_p VARCHAR NOT NULL ,
code_p VARCHAR NOT NULL ,
devise VARCHAR NOT NULL ,
langue VARCHAR NOT NULL ,
capitale VARCHAR NOT NULL ,
continent VARCHAR NOT NULL ,
lienwiki_p VARCHAR NOT NULL
);

CREATE TABLE Ville (
id_v SERIAL PRIMARY KEY ,
nom_v VARCHAR NOT NULL ,
nom_p VARCHAR NOT NULL ,
population INT ,
superficie FLOAT ,
lienwiki_v VARCHAR NOT NULL
);

CREATE TABLE Site_touristique (
id_st SERIAL PRIMARY KEY ,
nom_st VARCHAR NOT NULL ,
nom_v VARCHAR NOT NULL ,
lienwiki_st VARCHAR NOT NULL
);

CREATE TABLE Utilisateur (
id_u SERIAL PRIMARY KEY,
pseudo VARCHAR NOT NULL,
nom VARCHAR NOT NULL ,
prenom VARCHAR NOT NULL ,
email VARCHAR NOT NULL ,
nom_p VARCHAR ,
nom_v VARCHAR ,
mdp VARCHAR NOT NULL,
qualite VARCHAR NOT NULL,
type VARCHAR NOT NULL
);

INSERT INTO Pays(id_p, nom_p, code_p, devise, langue, capitale, continent, lienwiki_p) VALUES (1, 'France', 'FR', 'Euro', 'français', 'Paris', 'Europe','https://fr.wikipedia.org/wiki/France');
INSERT INTO Pays(id_p, nom_p, code_p, devise, langue, capitale, continent, lienwiki_p) VALUES (2, 'Royaume-Uni', 'GB', 'Livre Sterling', 'anglais', 'Londres', 'Europe','https://fr.wikipedia.org/wiki/Royaume-Uni');
INSERT INTO Pays(id_p, nom_p, code_p, devise, langue, capitale, continent,lienwiki_p) VALUES (3, 'Italie', 'IT', 'Euro', 'italien', 'Rome', 'Europe','https://fr.wikipedia.org/wiki/Italie');
INSERT INTO Pays(id_p, nom_p, code_p, devise, langue, capitale, continent, lienwiki_p) VALUES (4, 'Etats-Unis', 'US', 'Dollar Américain', 'anglais', 'Washington', 'Amérique','https://fr.wikipedia.org/wiki/Etats_Unis');
INSERT INTO Pays(id_p, nom_p, code_p, devise, langue, capitale, continent, lienwiki_p) VALUES (5, 'Egypte', 'EG', 'Livre égyptienne', 'arabe', 'Le Caire', 'Afrique','https://fr.wikipedia.org/wiki/%C3%89gypte');
INSERT INTO Pays(id_p, nom_p, code_p, devise, langue, capitale, continent, lienwiki_p) VALUES (6, 'Inde', 'IN', 'Roupie indienne', 'hindi', 'New Delhi', 'Asie','https://fr.wikipedia.org/wiki/Inde');

INSERT INTO Ville(id_v, nom_v, nom_p, population, superficie, lienwiki_v) VALUES (1, 'Paris', 'France', 2206488, 105.40,'https://fr.wikipedia.org/wiki/Paris');
INSERT INTO Ville(id_v, nom_v, nom_p, population, superficie, lienwiki_v) VALUES (2, 'Londres', 'Royaume-Uni', 8673713, 1572,'https://fr.wikipedia.org/wiki/Londres');
INSERT INTO Ville(id_v, nom_v, nom_p, population, superficie, lienwiki_v) VALUES (3, 'Rome', 'Italie', 2877215, 1285.31,'https://fr.wikipedia.org/wiki/Rome');
INSERT INTO Ville(id_v, nom_v, nom_p, population, superficie, lienwiki_v) VALUES (4, 'New York', 'Etats-Unis', 8537673, 1214.4,'https://fr.wikipedia.org/wiki/New_York');
INSERT INTO Ville(id_v, nom_v, nom_p, population, superficie, lienwiki_v) VALUES (5, 'Le Caire', 'Egypte', 15452409, 210,'https://fr.wikipedia.org/wiki/Le_Caire');
INSERT INTO Ville(id_v, nom_v, nom_p, population, superficie,lienwiki_v) VALUES (6, 'Naples', 'Italie', 968736, 117.27,'https://fr.wikipedia.org/wiki/Naples');
INSERT INTO Ville(id_v, nom_v, nom_p, population, superficie, lienwiki_v) VALUES (7, 'Agra', 'Inde', 1686976, 188.4,'https://fr.wikipedia.org/wiki/Agra');
INSERT INTO Ville(id_v, nom_v, nom_p, population, superficie, lienwiki_v) VALUES (8, 'Bayonne', 'France', 49207, 21.68,'https://fr.wikipedia.org/wiki/Bayonne');

INSERT INTO Site_touristique(id_st, nom_st, nom_v, lienwiki_st) VALUES (1, 'Tour Eiffel', 'Paris','https://fr.wikipedia.org/wiki/Tour_Eiffel');
INSERT INTO Site_touristique(id_st, nom_st, nom_v,lienwiki_st) VALUES (2, 'Notre Dame de Paris', 'Paris','https://fr.wikipedia.org/wiki/Cath%C3%A9drale_Notre-Dame_de_Paris');
INSERT INTO Site_touristique(id_st, nom_st, nom_v, lienwiki_st) VALUES (3, 'British Museum', 'Londres','https://fr.wikipedia.org/wiki/British_Museum');
INSERT INTO Site_touristique(id_st, nom_st, nom_v,lienwiki_st) VALUES (4, 'Colisée', 'Rome','https://fr.wikipedia.org/wiki/Colis%C3%A9e');
INSERT INTO Site_touristique(id_st, nom_st, nom_v,lienwiki_st) VALUES (5, 'Statue de la Liberté', 'Londres','https://fr.wikipedia.org/wiki/Statue_de_la_Libert%C3%A9');
INSERT INTO Site_touristique(id_st, nom_st, nom_v,lienwiki_st) VALUES (6, 'Times Square', 'New York','https://fr.wikipedia.org/wiki/Times_Square');
INSERT INTO Site_touristique(id_st, nom_st, nom_v,lienwiki_st) VALUES (7, 'Pyramides de Gizeh', 'Le Caire','https://fr.wikipedia.org/wiki/Pyramides_de_Gizeh');
INSERT INTO Site_touristique(id_st, nom_st, nom_v,lienwiki_st) VALUES (8, 'Taj Mahal', 'Agra','https://fr.wikipedia.org/wiki/Taj_Mahal');
INSERT INTO Site_touristique(id_st,nom_st,nom_v,lienwiki_st) VALUES (9,'Vieux Bayonne','Bayonne','http://');

INSERT INTO Utilisateur (id_u,pseudo,nom,prenom,email,nom_p,nom_v,mdp,qualite,type) VALUES (1,'Tonks','Quillere','Manon','qmanon64@gmail.com','France','Bayonne','Les2V','f','a');
INSERT INTO Utilisateur (id_u,pseudo,nom,prenom,email,nom_p,nom_v,mdp,qualite,type) VALUES (2,'Margalotte','Seguin','Margaux','margaux.seguin@ensiie.fr','France','Paris','melissandre','f','a');
INSERT INTO Utilisateur (id_u,pseudo,nom,prenom,email,nom_p,nom_v,mdp,qualite,type) VALUES (3,'Soleil','Carlo','Solene','solene.carlo@ensiie.fr','France','Paris','Chang','f','u');
