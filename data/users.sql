/* Insertion de quelques utilisateurs */
INSERT INTO Users (ID, Username, Email, Password, Moderator) VALUES ('a', 'Oxymore', 'thomas.kowalski@ensiie.fr', '$2y$12$bZ8u12c3LG4cWZPkeSBmBOqJoQqBltYzUlrJ5.7B.tiuUnPRZVNSO', false);
INSERT INTO Users (ID, Username, Email, Password, Moderator) VALUES ('b', 'Iko', 'pierrick.barbarroux@ensiie.fr', '$2y$12$bZ8u12c3LG4cWZPkeSBmBOqJoQqBltYzUlrJ5.7B.tiuUnPRZVNSO', false);
INSERT INTO Users (ID, Username, Email, Password, Moderator) VALUES ('c', 'Yéti', 'thibaut.milhaud@ensiie.fr', '$2y$12$bZ8u12c3LG4cWZPkeSBmBOqJoQqBltYzUlrJ5.7B.tiuUnPRZVNSO', false);
INSERT INTO Users (ID, Username, Email, Password, Moderator) VALUES ('d', 'Drascma', 'florian.barre@ensiie.fr', '$2y$12$bZ8u12c3LG4cWZPkeSBmBOqJoQqBltYzUlrJ5.7B.tiuUnPRZVNSO', false);
INSERT INTO Users (ID, Username, Email, Password, Moderator) VALUES ('e', 'Rhum', 'lucas.rioust@ensiie.fr', '$2y$12$bZ8u12c3LG4cWZPkeSBmBOqJoQqBltYzUlrJ5.7B.tiuUnPRZVNSO', false);
INSERT INTO Users (ID, Username, Email, Password, Moderator) VALUES ('f', '801', 'matthis.pillonel@ensiie.fr', '$2y$12$bZ8u12c3LG4cWZPkeSBmBOqJoQqBltYzUlrJ5.7B.tiuUnPRZVNSO', false);

/* Insertion de quelques publications */
INSERT INTO Post (ID, Author, Content, Timestamp, Repost, ResponseTo) 
    VALUES ('paa', 'a', 'Salut, c''est Thomas !', 1523813283, NULL, NULL);
INSERT INTO Post (ID, Author, Content, Timestamp, Repost, ResponseTo) 
    VALUES ('pba', 'b', 'Salut, c''est Pierrick !', 1523813284, NULL, NULL);
INSERT INTO Post (ID, Author, Content, Timestamp, Repost, ResponseTo) 
    VALUES ('pca', 'c', 'Salut, c''est Thibaut !', 1523813285, NULL, NULL);
INSERT INTO Post (ID, Author, Content, Timestamp, Repost, ResponseTo) 
    VALUES ('pda', 'd', 'Salut, c''est Drascma !', 1523813286, NULL, NULL);

/* Avec un repost */
INSERT INTO Post(ID, Author, Content, Timestamp, Repost, ResponseTo)
    VALUES ('pab', 'a', 'Je suis à l''ENSIIE', 1523813320, NULL, NULL);
INSERT INTO Post(ID, Author, Content, Timestamp, Repost, ResponseTo)
    VALUES ('pbb', 'b', NULL, 1523813325, 'pab', NULL);
INSERT INTO Post(ID, Author, Content, Timestamp, Repost, ResponseTo)
    VALUES ('pcb', 'c', NULL, 1523813330, 'pab', NULL);

/* Avec une réponse */
INSERT INTO Post(ID, Author, Content, Timestamp, Repost, ResponseTo)
    VALUES ('pac', 'a', 'Comment allez-vous aujourd''hui ?', 1523814456, NULL, NULL);
INSERT INTO Post(ID, Author, Content, Timestamp, Repost, ResponseTo)
    VALUES ('pcc', 'c', 'Je vais bien !', 1523814465, NULL, 'pac');
INSERT INTO Post(ID, Author, Content, Timestamp, Repost, ResponseTo)
    VALUES ('pec', 'e', 'Je suis malade :(', 1523814475, NULL, 'pac');
