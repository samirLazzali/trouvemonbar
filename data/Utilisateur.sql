Create Table Utilisateur (
			 id_utilisateur CHAR(13) PRIMARY KEY,
			 nom_utilisateur VARCHAR(15),
			 prenom_utilisateur VARCHAR(15),
			 mot_de_passe VARCHAR(15),
			 adresse VARCHAR(50),
			 historique VARCHAR(15),
			 commande VARCHAR(15)

);



INSERT INTO Utilisateur (id_utilisateur, nom_utilisateur,prenom_utilisateur, mot_de_passe, adresse,historique,commande)
     VALUES ('OOOOOOOOOOOO1', 'TITI', 'Bastien', 'azerty','11 rue de Paris','NONE','NONE');

INSERT INTO Uilisateur (id_utilisateur, nom_utilisateur,prenom_utilisateur, mot_de_passe, adresse,historique,commande)
     VALUES('OOOOOOOOOOOO2', 'Baude', 'Bastien', 'azerty','11 rue du vieux port Marseille','NONE','NONE');