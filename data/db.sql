CREATE TABLE IF NOT EXISTS Users (
	ID CHAR(13),
	Username TEXT,
	Email TEXT,
    Password TEXT,
    Moderator BOOLEAN,
	PRIMARY KEY(ID)
);

CREATE TABLE IF NOT EXISTS Post (
	ID CHAR(13),
	Author CHAR(13),
	Content TEXT,
    Timestamp INT,
    Repost TEXT,
    ResponseTo TEXT,
	PRIMARY KEY(ID)
);

CREATE TABLE IF NOT EXISTS Appreciation (
	ID CHAR(13),
	Post CHAR(13),
    Author CHAR(13),
    Timestamp INT,
    Type TEXT,
	PRIMARY KEY(ID)
);
