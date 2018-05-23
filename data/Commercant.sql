Create Table Commercant(
     id_commercant CHAR(13) PRIMARY KEY,
     nom_commercant VARCHAR(15),
     prenom_commercant VARCHAR(15),
	    mot_de_passe VARCHAR(15),
	    id_centre_commercial CHAR(13),
	    FOREIGN KEY (id_centre_commercial) REFERENCES Centre_Commercial(id_centre_commercial));

