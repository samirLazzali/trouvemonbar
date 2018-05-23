Create Table Produit (
   id_produit CHAR(13) PRIMARY KEY,
   categorie VARCHAR(15) ,
   types VARCHAR(15),
   marque VARCHAR (15),
   prix INTEGER,
   date_de_peremption VARCHAR (50),
   reduction INTEGER,
   quantite INTEGER,
   id_centre_commercial CHAR(15),
   FOREIGN KEY (id_centre_commercial) REFERENCES Centre_Commercial(id_centre_commercial));