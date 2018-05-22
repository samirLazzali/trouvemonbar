
CREATE TABLE "user" (
  id SERIAL PRIMARY KEY,
  username varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  passwords varchar(255) NOT NULL
);

INSERT INTO "user" (username, passwords, email) VALUES ('remi', 'tanche', 'remihuguet@ensiie.fr');