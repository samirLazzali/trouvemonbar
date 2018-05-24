CREATE TABLE "user" (
    id SERIAL PRIMARY KEY ,
    statut INT ,
    pseudo VARCHAR NOT NULL ,
    nom VARCHAR NOT NULL ,
    email VARCHAR NOT NULL 
);

/*statut = 3 si bureau
           2 si membres
           1 si ensiie
           0 si exté*/
CREATE TABLE "type" (
    id SERIAL PRIMARY KEY ,
    nom VARCHAR NOT NULL
);

CREATE TABLE "recette" (
    id SERIAL PRIMARY KEY ,
    id_author INT ,
    id_type INT ,
    titre VARCHAR NOT NULL ,
    ingredients VARCHAR NOT NULL ,
    instructions VARCHAR NOT NULL ,
    done INT ,
    pub INT
);
/*done = 0 si jamais faite
         1 si jeudi cuisine
         2 si soirée
         3 si autre
  pub = 0 si public
        1 si ensiie
        2 si membres*/

CREATE TABLE "CR" (
    id SERIAL PRIMARY KEY ,
    id_secgen INT ,
    id_prez INT ,
    id_presents VARCHAR NOT NULL ,
    contenu VARCHAR NOT NULL 
);

INSERT INTO "user"(statut,pseudo,nom,email) VALUES (2,'MissTurtle','Hennenfent', 'emilie.hennenfent@ensiie.fr');

INSERT INTO "type"(nom) VALUES ('Boisson');
INSERT INTO "type"(nom) VALUES ('Entrée');
INSERT INTO "type"(nom) VALUES ('Plat');
INSERT INTO "type"(nom) VALUES ('Dessert');

INSERT INTO "recette"(id_author,id_type,titre,ingredients,instructions,done,pub) VALUES (1,1,'Potion magique (Astérix et Obélix)','4 citrons \n 2àcl de jus de myrtille \n 15cl de jus de fraise \n 1cs de jus de betterave \n 1cs de jus de carotte \n 1cs de bicarbonate de soude \n 80g de sucre semoule \n miel à volonté','Faites tiédir le jus de myrtille et 8cl d eau dans un petit chaudron. Puis délayer le bicarbonate de soude et le sucre dans le chaudron. \n Lorsque le mélange est bleu très foncé ajoutez le jus de citron en une seule fois et mélangez, votre potion doit se mettre à bouilloner et passer du bleu foncé au rouge rubis. \n Versez alors le jus de carotte, celui de fraise et celui de betterave et mélangez doucement. Goutez et ajoutez du miel à votre bon vouloir. \n Astuce : Les myrtilles peuvent être remplacées par du cassis',0,0);

