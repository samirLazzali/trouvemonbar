CREATE TABLE "user" (
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



Create Table Utilisateur (
			 id_utilisateur SERIAL PRIMARY KEY,
			 nom_utilisateur VARCHAR(15),
			 prenom_utilisateur VARCHAR(15),
			 mot_de_passe VARCHAR(15),
			 adresse VARCHAR(50),
			 historique VARCHAR(15),
			 commande VARCHAR(15)

);

INSERT INTO Utilisateur (nom_utilisateur,prenom_utilisateur, mot_de_passe, adresse,historique,commande)
     VALUES ('TITI', 'Bastien', 'azerty','11 rue de Paris','NONE','NONE');

INSERT INTO Utilisateur (nom_utilisateur,prenom_utilisateur, mot_de_passe, adresse,historique,commande)
     VALUES('Baude', 'Bastien', 'azerty','11 rue du vieux port Marseille','NONE','NONE');




Create Table Centre_Commercial(
      id_centre_commercial SERIAL PRIMARY KEY,
			enseigne VARCHAR(15),
	    horaire_debut INTEGER,
	    horaire_fin INTEGER,
	    adresse VARCHAR(50));



INSERT INTO Centre_Commercial(enseigne, horaire_debut, horaire_fin, adresse)
    VALUES ('carrefour', '8', '21','16 rue lalala');

Create Table Produit (
   id_produit SERIAL PRIMARY KEY,
   categorie VARCHAR(15),
   types VARCHAR(15),
   marque VARCHAR (15),
   prix INTEGER,
   date_de_peremption DATE,
   reduction INTEGER,
   quantite INTEGER,
   id_centre_commercial INTEGER ,/*NOT NULL IDENTITY(1000, 1 ),comment bode a fait AUTO_INCREMENT */
   image VARCHAR(955),
   FOREIGN KEY (id_centre_commercial) REFERENCES Centre_Commercial(id_centre_commercial));


INSERT INTO Produit(categorie, types, marque, prix, date_de_peremption, reduction, quantite, id_centre_commercial,image)
    VALUES ('laitier', 'lait', 'danone','8','2017-05-19','2','2','1','http://img.lemde.fr/2017/06/22/0/0/276/233/534/0/60/0/8e068ea_28878-y9u3wo.vt083680k9.PNG');
INSERT INTO Produit(categorie, types, marque, prix, date_de_peremption, reduction, quantite, id_centre_commercial,image)
    VALUES ('laitier', 'yaourt', 'flambi','4','2018-05-19','2','5','1','https://www.usinenouvelle.com/mediatheque/3/8/6/000585683_image_896x598/nouvelle-marque-danone-yaourts.jpg');
INSERT INTO Produit(categorie, types, marque, prix, date_de_peremption, reduction, quantite, id_centre_commercial, image)
    VALUES ('laitier', 'fromage', 'babybel','20','2018-05-19','2','5','1', 'https://www.babybel.fr/sites/default/files/styles/500x500/public/products/img-product-1.png?itok=r0PEQmyY');

/*INSERT INTO Produit(id_produit, categorie, types, marque, prix, date_de_peremption, reduction, quantite, id_centre_commercial)
    VALUES ('002', 'laitier', 'lait', 'bab','16','2017-05-19','2','2','0003');
INSERT INTO Produit(id_produit, categorie, types, marque, prix, date_de_peremption, reduction, quantite, id_centre_commercial)
    VALUES ( '003','laitier', 'laita', 'babi','16','2018-05-19','2','5','0003');
INSERT INTO Produit     VALUES ( '004','laitier', 'laita', 'babi','16','2018-05-19','2','5','0003');*/
/*CREATE  FUNCTION maj() RETURNS TRIGGER AS $f_maj$
    AS 'select $1 + $2;'
    LANGUAGE SQL
    IMMUTABLE
    RETURNS NULL ON NULL INPUT;*/

/*

CREATE TRIGGER mise_a_jour_date AFTER INSERT
ON Produit
BEGIN
  DELETE FROM Produit WHERE date_de_peremption=CURRENT_DATE;
END;*/




Create Table Commercant(
     id_commercant SERIAL PRIMARY KEY,
     nom_commercant VARCHAR(15),
     prenom_commercant VARCHAR(15),
	   mot_de_passe VARCHAR(15),
	   id_centre_commercial INTEGER,
	   FOREIGN KEY (id_centre_commercial) REFERENCES Centre_Commercial(id_centre_commercial));





Create Table Panier(
    id_panier SERIAL PRIMARY KEY,
    id_produit  INTEGER ,
    id_client INTEGER,
    quantite_prise INTEGER,
    date_peremption DATE,
    date_recup DATE,
   /* FOREIGN KEY (id_produit) REFERENCES Produit(id_produit),*/
    FOREIGN KEY (id_client) REFERENCES Utilisateur(id_utilisateur));
/*INSERT into Panier(id_produit, id_client, quantite_prise, date_peremption, date_recup) VALUES ('1','1','1','2015-05-05','2015-05-06');
INSERT into Panier(id_produit, id_client, quantite_prise, date_peremption, date_recup) VALUES ('2','1','1','2015-04-02','2015-06-06');*/


Create Table Historique(
    id_panier SERIAL PRIMARY KEY,
    id_produit  INTEGER ,
    id_client INTEGER,
    quantite_prise INTEGER,
    date_peremption DATE,
    date_recup DATE,
   /* FOREIGN KEY (id_produit) REFERENCES Produit(id_produit),*/
    FOREIGN KEY (id_client) REFERENCES Utilisateur(id_utilisateur));
/*INSERT into Historique(id_produit, id_client, quantite_prise, date_peremption, date_recup) VALUES ('2','1','1','2015-05-05','2015-05-06');
INSERT into Historique(id_produit, id_client, quantite_prise, date_peremption, date_recup) VALUES ('2','1','1','2015-04-02','2015-06-06');*/



/*CREATE FUNCTION bobo () RETURNS TRIGGER AS
'
  DECLARE
    nocli integer;
  BEGIN
    IF NEW.quantite<>OLD.quantite THEN
      INSERT into  Centre_Commercial VALUES (''004'', ''bobo'', ''9'', ''21'',''16 rue lala'');
    END IF;
    RETURN NEW;
  END;
'
LANGUAGE 'plpgsql';

CREATE TRIGGER trig_bobo BEFORE update ON Produit
  FOR EACH ROW
  EXECUTE PROCEDURE bobo();*/

CREATE FUNCTION bobo1 () RETURNS TRIGGER AS
'
  DECLARE
    nocli integer;
  BEGIN
    SELECT quantite INTO nocli
     FROM Produit WHERE id_produit=NEW.id_produit;
      If nocli=0 THEN
    DELETE FROM Produit WHERE id_produit=NEW.id_produit;
  END IF;
    RETURN NEW;
  END;
'
LANGUAGE 'plpgsql';

CREATE TRIGGER trig_bobo1 AFTER update ON Produit
  FOR EACH ROW
  EXECUTE PROCEDURE bobo1();

CREATE FUNCTION date_bobo () RETURNS TRIGGER AS
'
 DECLARE
  total integer;
  BEGIN
    SELECT CURRENT_DATE - date_de_peremption INTO total
     From Produit WHERE CURRENT_DATE - date_de_peremption<0;
      IF total>0 THEN
       DELETE FROM Produit WHERE CURRENT_DATE - date_de_peremption<0;
      END IF;
       RETURN NEW;
END;
'
LANGUAGE 'plpgsql';


CREATE TRIGGER mise_a_jour_date AFTER INSERT
ON Produit
FOR EACH ROW EXECUTE PROCEDURE date_bobo();


CREATE FUNCTION f_mis_a_jour_panier () RETURNS TRIGGER AS
'
  DECLARE
   total integer;
  BEGIN
    SELECT quantite_prise INTO total
    FROM Panier WHERE id_produit = NEW.id_produit;
    UPDATE Produit SET quantite = quantite-total  WHERE id_produit = NEW.id_produit;
    RETURN NEW;
 END;
 '
LANGUAGE 'plpgsql';

CREATE TRIGGER mise_a_jour_qt AFTER INSERT
ON Panier
FOR EACH ROW EXECUTE PROCEDURE f_mis_a_jour_panier();



CREATE FUNCTION f_mis_a_jour_historique () RETURNS TRIGGER AS
'
  DECLARE
   total integer;
  BEGIN
    SELECT id_panier INTO total
    FROM Historique WHERE id_panier = NEW.id_panier;
   DELETE FROM Panier WHERE id_panier=total ;
    RETURN NEW;
 END;
 '
LANGUAGE 'plpgsql';

CREATE TRIGGER mise_a_jour_ht AFTER INSERT
ON Historique
FOR EACH ROW EXECUTE PROCEDURE f_mis_a_jour_historique();



/*CREATE FUNCTION annul_panier () RETURNS TRIGGER AS
'
  DECLARE
   total integer;
  BEGIN
    SELECT quantite_prise INTO total
    FROM Panier WHERE id_produit = OLD.id_produit;

    UPDATE Produit SET quantite = quantite+OLD.quantite_prise  WHERE id_produit = OLD.id_produit;
    RETURN NEW;
 END;
 '
LANGUAGE 'plpgsql';

CREATE TRIGGER annul_pa AFTER DELETE
ON Panier
FOR EACH ROW EXECUTE PROCEDURE annul_panier ();*/




Create TABLE Administrateur(
  id_ad SERIAL PRIMARY KEY,
   nom_administrateur VARCHAR(15),
    mot_de_passe VARCHAR(15)
);

INSERT into  Administrateur (nom_administrateur, mot_de_passe) VALUES  ('taillefer','titi');










Create Table Note (
   id_produit VARCHAR(15),
   id_utilisateur VARCHAR(15),
   etoile VARCHAR(15)
);
