/*
    a => Oxymore
    b => Iko
    c => Yéti
    d => Drascma
    e => Rhum
    f => 801
*/

/* Tout le monde suit Oxymore */
INSERT INTO Subscription (Followed, Follower) VALUES ('a', 'b');
INSERT INTO Subscription (Followed, Follower) VALUES ('a', 'c');
INSERT INTO Subscription (Followed, Follower) VALUES ('a', 'd');
INSERT INTO Subscription (Followed, Follower) VALUES ('a', 'e');
INSERT INTO Subscription (Followed, Follower) VALUES ('a', 'f');

/* Oxymore suit Rhum et Yéti */
INSERT INTO Subscription (Followed, Follower) VALUES ('e', 'a');
INSERT INTO Subscription (Followed, Follower) VALUES ('c', 'a');
