CREATE TABLE "utilisateur" (
  "id" SERIAL primary key NOT NULL,
  "mail" varchar(255) NOT NULL,
  "statut" varchar(255) NOT NULL,
  "code_validation" varchar(255) DEFAULT NULL,
  "mdp" text NOT NULL,
  "date_dernier_co" timestamp NOT NULL,
  "date_inscription" timestamp NOT NULL,

  UNIQUE (mail)
);
CREATE TABLE "profil" (
  "id" SERIAL primary key NOT NULL,
  "id_utilisateur" int references utilisateur(id) on delete cascade NOT NULL,
  "id_sexe" varchar(10) NOT NULL,
  "search_sexe" varchar(10) NOT NULL,
  "tags" text,
  "date_naissance" timestamp NOT NULL
);
CREATE TABLE "qadmin" (
  "id" SERIAL primary key NOT NULL,
  "id_admin" int references utilisateur(id) on delete cascade NOT NULL,
  "question" varchar(255) NOT NULL,
  "reponses" text NOT NULL,
  "date_q" timestamp NOT NULL
);
CREATE TABLE "qutilisateur" (
  "id" SERIAL primary key NOT NULL,
  "id_utilisateur" int NOT NULL,
  "mail" varchar(255) NOT NULL,
  "question" int references qadmin(id) on delete cascade NOT NULL,
  "reponse" text NOT NULL,
  "date_q" timestamp NOT NULL
);
CREATE TABLE "sex_appeal" (
  "id" SERIAL primary key NOT NULL,
  "id_admin" int NOT NULL,
  "nom" varchar(255) NOT NULL,
  "pallier" int NOT NULL,
  "genre" varchar(10) NOT NULL,
  "date_update" timestamp NOT NULL
);
CREATE TABLE "suggestion" (
  "id" SERIAL primary key NOT NULL,
  "id_cible" int references utilisateur(id) on delete cascade NOT NULL,
  "id_utilisateur" int references utilisateur(id) on delete cascade NOT NULL,
  "resultat" int NOT NULL,
  "etat_lu" int NOT NULL DEFAULT 0,
  "date_match" timestamp NOT NULL
);
CREATE TABLE "suggestiontotal" (
  "id" SERIAL primary key NOT NULL,
  "id_utilisateur" int references utilisateur(id) on delete cascade NOT NULL,
  "nombre_match_cumule" int NOT NULL DEFAULT 0,
  "date_update" timestamp NOT NULL
);
CREATE TABLE "newsletter" (
  "id" SERIAL primary key NOT NULL,
  "id_admin" int NOT NULL,
  "sujet" varchar(255) NOT NULL,
  "message" text NOT NULL,
  "date_news" timestamp NOT NULL
);
CREATE TABLE "chat" (
  "id" SERIAL primary key NOT NULL,
  "id_chat" text NOT NULL,
  "id_cible" int references utilisateur(id) on delete cascade NOT NULL,
  "id_utilisateur" int references utilisateur(id) on delete cascade NOT NULL,
  "message" varchar(2000) NOT NULL,
  "etat_lu" int NOT NULL DEFAULT 0,
  "date_message" timestamp NOT NULL
);
