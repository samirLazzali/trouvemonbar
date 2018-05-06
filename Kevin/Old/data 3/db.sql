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
    emetteur VARCHAR NOT NULL ,
    recepteur VARCHAR NOT NULL ,
    date_envoie timestamp,
    contenu VARCHAR
);

INSERT INTO "message"(emetteur, recepteur, date_envoie, contenu) VALUES ('John', 'Jaime', '1967-11-22 09:03:12', 'Bonjour');
INSERT INTO "message"(emetteur, recepteur, date_envoie, contenu) VALUES ('Jackie', 'Alonzo', '1967-11-22 12:55:39', 'Allo ');
INSERT INTO "message"(emetteur, recepteur, date_envoie, contenu) VALUES ('Brendan', 'Otis', '1967-11-22 11:53:39', 'Au revoir');
INSERT INTO "message"(emetteur, recepteur, date_envoie, contenu) VALUES ('Manuel', 'Otis', '1967-11-22 23:55:22', 'Salut');
INSERT INTO "message"(emetteur, recepteur, date_envoie, contenu) VALUES ('Otis', 'Manuel', '1967-11-22 15:22:22', 'Merci');


CREATE TABLE "tweet" (
  id SERIAL PRIMARY KEY ,
  auteur VARCHAR NOT NULL ,
  date timestamp ,
  contenu VARCHAR
);
INSERT INTO "tweet"(auteur, date, contenu) VALUES ('John', '1999-12-23 12:45:23', '****');
INSERT INTO "tweet"(auteur, date, contenu) VALUES ('Jackie', '1999-12-23 12:45:23', '****');
INSERT INTO "tweet"(auteur, date, contenu) VALUES ('Brendan', '1999-12-23 12:45:23', '****');
INSERT INTO "tweet"(auteur, date, contenu) VALUES ('Otis', '1999-12-23 12:45:23', '****');

/*CREATE TABLE "like" (
  tweet_id int FOREIGN KEY REFERENCES tweet(id) ,
  user_id int FOREIGN KEY REFERENCES user(id)
);

INSERT INTO "like"(tweet_id, user_id) VALUES (1, 1);
INSERT INTO "like"(tweet_id, user_id) VALUES (1, 2);
INSERT INTO "like"(tweet_id, user_id) VALUES (1, 3);*/


















