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


CREATE TABLE "message" (
    id SERIAL PRIMARY KEY ,
    emetteur int references "user"(id) ,
    recepteur int references "user"(id) ,
    date_envoie timestamp,
    contenu VARCHAR
);

INSERT INTO "message"(emetteur, recepteur, date_envoie, contenu) VALUES ('1', '7', '1967-11-22 09:03:12', 'Bonjour');
INSERT INTO "message"(emetteur, recepteur, date_envoie, contenu) VALUES ('7', '4', '1967-11-22 12:55:39', 'Allo ');
INSERT INTO "message"(emetteur, recepteur, date_envoie, contenu) VALUES ('9', '3', '1967-11-22 11:53:39', 'Au revoir');
INSERT INTO "message"(emetteur, recepteur, date_envoie, contenu) VALUES ('8', '7', '1967-11-22 23:55:22', 'Salut');
INSERT INTO "message"(emetteur, recepteur, date_envoie, contenu) VALUES ('2', '5', '1967-11-22 15:22:22', 'Merci');


CREATE TABLE "amis" (
    id SERIAL PRIMARY KEY ,
    personne1 int references "user"(id) ,
    personne2 int references "user"(id) 
);


INSERT INTO "amis"(personne1, personne2) VALUES ('1', '7');
INSERT INTO "amis"(personne1, personne2) VALUES ('7', '2');
INSERT INTO "amis"(personne1, personne2) VALUES ('3', '7');
INSERT INTO "amis"(personne1, personne2) VALUES ('8', '7');

CREATE TABLE "tweet" (
  id SERIAL PRIMARY KEY ,
  auteur int references "user"(id),
  date_envoie timestamp ,
  contenu VARCHAR
);
INSERT INTO "tweet"(auteur, date_envoie, contenu) VALUES ('1', '1999-12-23 12:45:23', '****');
INSERT INTO "tweet"(auteur, date_envoie, contenu) VALUES ('2', '1999-12-23 12:45:23', '****');
INSERT INTO "tweet"(auteur, date_envoie, contenu) VALUES ('3', '1999-12-23 12:45:23', '****');
INSERT INTO "tweet"(auteur, date_envoie, contenu) VALUES ('5', '1999-12-23 12:45:23', '****');

CREATE TABLE "like" (
  tweet_id int references "tweet"(id) ,
  user_id int references "user"(id)
);

INSERT INTO "like"(tweet_id, user_id) VALUES (1, 1);
INSERT INTO "like"(tweet_id, user_id) VALUES (1, 2);
INSERT INTO "like"(tweet_id, user_id) VALUES (1, 3);

CREATE TABLE "commentaire" (
  id_comment SERIAL PRIMARY KEY ,
  tweet_id int references "tweet"(id) ,
  date_envoie timestamp ,
  contenu VARCHAR
);
INSERT INTO "tweet"(auteur, date_envoie, contenu) VALUES ('John', '1999-12-23 12:45:23', '****');









