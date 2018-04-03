CREATE TABLE IF NOT EXISTS User (
	ID TEXT,
	Username TEXT,
	Email TEXT,
    Password TEXT,
    Moderator BOOLEAN,
	PRIMARY KEY(ID)
);

CREATE TABLE IF NOT EXISTS Post (
	ID TEXT,
	Author TEXT,
	Content TEXT,
    Timestamp INT,
    Repost TEXT,
    ResponseTo TEXT,
	PRIMARY KEY(ID)
);

CREATE TABLE IF NOT EXISTS Appreciation (
	ID TEXT,
	Post TEXT,
    Author TEXT,
    Timestamp INT,
    Type TEXT,
	PRIMARY KEY(ID)
);

INSERT INTO User VALUES("a", "Oxymore", "thomas.kowalski@ensiie.fr", "HASH", 1);
INSERT INTO User VALUES("b", "Yéti", "thibaut.milhaud@ensiie.fr", "HASH", 1);
INSERT INTO User VALUES("c", "Iko", "pierrick.barbarroux@ensiie.fr", "HASH", 1);
INSERT INTO User VALUES("d", "Drascma", "florient.barre@ensiie.fr", "HASH", 1);