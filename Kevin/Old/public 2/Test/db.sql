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
INSERT INTO "user"(login,firstname, lastname, birthday, password, administrateur) VALUES ('Jaime','Jaime', 'King', '1924-05-30','azerty',false);
INSERT INTO "user"(login,firstname, lastname, birthday, password, administrateur) VALUES ('Vick','Vicky', 'Pearson', '1982-12-12','azerty',false);
INSERT INTO "user"(login,firstname, lastname, birthday, password, administrateur) VALUES ('Silvi','Silvia', 'Mcguire', '1971-03-02','azerty',false);
INSERT INTO "user"(login,firstname, lastname, birthday, password, administrateur) VALUES ('Brend','Brendan', 'Pena', '1950-02-17','azerty',false);
INSERT INTO "user"(login,firstname, lastname, birthday, password, administrateur) VALUES ('Jack','Jackie', 'Cohen', '1967-01-27','azerty',false);
INSERT INTO "user"(login,firstname, lastname, birthday, password, administrateur) VALUES ('Del','Delores', 'Williamson', '1961-07-19','azerty',false);