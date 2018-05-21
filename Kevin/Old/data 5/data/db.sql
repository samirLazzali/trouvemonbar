CREATE TABLE "user" (
    id SERIAL PRIMARY KEY ,
    login VARCHAR NOT NULL,
    firstname VARCHAR NOT NULL ,
    lastname VARCHAR NOT NULL ,
    birthday date,
    password VARCHAR NOT NULL,
    administrateur BOOLEAN
);

INSERT INTO "user"(login,firstname, lastname, birthday, password, administrateur) VALUES ('Johnny','John','Doe', '1967-11-22','azerty',false);
INSERT INTO "user"(login,firstname, lastname, birthday, password, administrateur) VALUES ('Yvette1','Yvette', 'Angel', '1932-01-24','azerty',false);
INSERT INTO "user"(login,firstname, lastname, birthday, password, administrateur) VALUES ('Amel','Amelia', 'Waters', '1981-12-01','azerty',false);
INSERT INTO "user"(login,firstname, lastname, birthday, password, administrateur) VALUES ('Manu','Manuel', 'Holloway', '1979-07-25','azerty',false);
INSERT INTO "user"(login,firstname, lastname, birthday, password, administrateur) VALUES ('Alonz','Alonzo', 'Erickson', '1947-11-13','azerty',false);
INSERT INTO "user"(login,firstname, lastname, birthday, password, administrateur) VALUES ('Ot','Otis', 'Roberson', '1995-01-09','azerty',false);
INSERT INTO "user"(login,firstname, lastname, birthday, password, administrateur) VALUES ('Jaime','Jaime', 'King', '1924-05-30','azerty',true);
INSERT INTO "user"(login,firstname, lastname, birthday, password, administrateur) VALUES ('Vick','Vicky', 'Pearson', '1982-12-12','azerty',false);
INSERT INTO "user"(login,firstname, lastname, birthday, password, administrateur) VALUES ('Silvi','Silvia', 'Mcguire', '1971-03-02','azerty',false);
INSERT INTO "user"(login,firstname, lastname, birthday, password, administrateur) VALUES ('Brend','Brendan', 'Pena', '1950-02-17','azerty',false);
INSERT INTO "user"(login,firstname, lastname, birthday, password, administrateur) VALUES ('Jack','Jackie', 'Cohen', '1967-01-27','azerty',false);
INSERT INTO "user"(login,firstname, lastname, birthday, password, administrateur) VALUES ('Del','Delores', 'Williamson', '1961-07-19','azerty',false);



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
  contenu VARCHAR(300)
);
INSERT INTO "tweet"(auteur, date_envoie, contenu) VALUES ('1', '1999-12-23 12:45:23', '****');
INSERT INTO "tweet"(auteur, date_envoie, contenu) VALUES ('2', '1999-12-23 12:45:24', '****');
INSERT INTO "tweet"(auteur, date_envoie, contenu) VALUES ('3', '1999-12-23 12:45:25', '****');
INSERT INTO "tweet"(auteur, date_envoie, contenu) VALUES ('5', '1999-12-23 12:45:26', '****');

CREATE TABLE "like" (
  tweet_id int references "tweet"(id) ,
  user_id int references "user"(id)
);

INSERT INTO "like"(tweet_id, user_id) VALUES (1, 1);
INSERT INTO "like"(tweet_id, user_id) VALUES (1, 2);
INSERT INTO "like"(tweet_id, user_id) VALUES (1, 3);


CREATE TYPE typeDeCommentaire AS ENUM ('tweet', 'commentaire');

CREATE TABLE "commentaire" (
  id SERIAL PRIMARY KEY ,
  owner_id int REFERENCES "user"(id) ,
  target_id int REFERENCES "user"(id) ,
  date_envoie timestamp ,
  contenu VARCHAR ,
  parent_id integer ,
  parent_type typeDeCommentaire
);
INSERT INTO "commentaire"(owner_id, target_id, date_envoie, contenu, parent_id, parent_type) VALUES ('1','2', '1999-12-23 12:45:23', '****', '2', 'tweet');
INSERT INTO "commentaire"(owner_id, target_id, date_envoie, contenu, parent_id, parent_type) VALUES ('1','7', '1999-12-23 12:45:23', 'FAZFAZFAZFAZ', '2', 'tweet');
INSERT INTO "commentaire"(owner_id, target_id, date_envoie, contenu, parent_id, parent_type) VALUES ('1','7', '1999-12-23 12:45:23', 'FAZFAZFAZFAZ', '3', 'tweet');
INSERT INTO "commentaire"(owner_id, target_id, date_envoie, contenu, parent_id, parent_type) VALUES ('1','7', '1999-12-23 12:45:23', '1234555555', '1', 'tweet');
INSERT INTO "commentaire"(owner_id, target_id, date_envoie, contenu, parent_id, parent_type) VALUES ('1','7', '1999-12-23 12:45:23', 'bonjour', '1', 'commentaire');
INSERT INTO "commentaire"(owner_id, target_id, date_envoie, contenu, parent_id, parent_type) VALUES ('1','7', '1999-12-23 12:45:23', 'aurevoir', '1', 'commentaire');


CREATE TABLE "hashtag" (
  id SERIAL PRIMARY KEY ,
  mot VARCHAR UNIQUE
);
INSERT INTO "hashtag"(mot) VALUES ('paris');
INSERT INTO "hashtag"(mot) VALUES ('tt');


CREATE TABLE "hashtagEtTweet" (
  id_hashtag int REFERENCES "hashtag"(id) ,
  id_tweet int REFERENCES "tweet"(id)
);
INSERT INTO "hashtagEtTweet"(id_hashtag, id_tweet) VALUES (1, 2);







