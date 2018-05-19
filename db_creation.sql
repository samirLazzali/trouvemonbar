DROP TABLE IF EXISTS post;
DROP TABLE IF EXISTS categorie;
DROP TABLE IF EXISTS post_categorie;
DROP TABLE IF EXISTS tag;
DROP TABLE IF EXISTS upvote;
DROP TABLE IF EXISTS moderateur;
DROP TABLE IF EXISTS commentaire;


CREATE TABLE post(
    id_post INTEGER,
    titre VARCHAR(30),
    link VARCHAR(50),
    upvotes INTEGER
);

CREATE TABLE categorie(
    nom_categorie VARCHAR(20),
    img VARCHAR(50)
);

CREATE TABLE usr(
    id_usr INTEGER,
    pseudo VARCHAR(10),
    pw VARCHAR(20),
    administrator INTEGER
);

CREATE TABLE post_categorie(
    nom_categorie VARCHAR(20),
    id_post INTEGER
);

CREATE TABLE tag(
    id_post INTEGER,
    nom_tag VARCHAR(10)
);

CREATE TABLE upvote(
    id_usr INTEGER,
    id_action INTEGER,
    valeur INTEGER
);

CREATE TABLE moderateur(
    id_usr INTEGER,
    categorie VARCHAR
);

CREATE TABLE commentaire(
    id_commentaire INTEGER,
    id_action INTEGER,
    id_usr INTEGER,
    d_publication DATE,
    intitule VARCHAR(300)
);