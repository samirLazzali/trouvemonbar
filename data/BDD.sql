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

CREATE TABLE IF NOT EXISTS Appreciations (
	ID TEXT,
    Author TEXT,
    Timestamp INT,
    Type TEXT,
	PRIMARY KEY(ID)
);
