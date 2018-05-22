CREATE DATABASE local31 CHARACTER SET 'utf8';




CREATE TABLE `local31`.`serie` ( `id_serie` SERIAL NOT NULL AUTO_INCREMENT ,
`nom_serie` VARCHAR(100) NOT NULL ,
`nb_tomes` INT NOT NULL , `nb_tomes_local` INT NOT NULL ,
`auteur` VARCHAR(100) NOT NULL ,
`resume` TEXT NOT NULL ,
`tags` VARCHAR(100) NOT NULL ,
PRIMARY KEY (`id_serie`)) 
ENGINE = MyISAM;

CREATE TABLE `local31`.`livres` (
`id_livre` SERIAL NOT NULL AUTO_INCREMENT ,
`titre` VARCHAR(80) NOT NULL ,
`auteur` VARCHAR(80) NOT NULL ,
`edition` VARCHAR(80) NOT NULL ,
`date_de_parution` DATE NOT NULL ,
`sorte` ENUM('bd','manga','roman') NOT NULL ,
`serie` VARCHAR(80) NOT NULL ,
`id_serie` INT NOT NULL ,
`tome` INT NOT NULL ,
`langue` VARCHAR(80) NOT NULL ,
`resume` TEXT NOT NULL ,
`dessinateur` VARCHAR(40) NULL ,
`tag1` VARCHAR(40) NOT NULL ,
`tag2` VARCHAR(40) NULL ,
`tag3` VARCHAR(40) NULL ,
`emprunte` INT NOT NULL ,
PRIMARY KEY (`id_livre`))
ENGINE = MyISAM;


CREATE TABLE `local31`.`emprunteurs` (
`id_emprunteur` SERIAL NOT NULL AUTO_INCREMENT ,
`prenom` VARCHAR(40) NOT NULL ,
`nom` VARCHAR(40) NOT NULL ,
`pseudo` VARCHAR(40) NOT NULL ,
`promo` INT NOT NULL ,
`mail` VARCHAR(40) NOT NULL ,
`mdp` VARCHAR(40) NOT NULL ,
`admin` VARCHAR(40) NOT NULL,
PRIMARY KEY (`id_emprunteur`),
UNIQUE (`pseudo`))
ENGINE = MyISAM;


CREATE TABLE `local31`.`emprunts` (
`id_emprunt` SERIAL NOT NULL AUTO_INCREMENT ,
`id_livre` INT NOT NULL ,
`emprunteur` VARCHAR(40) NOT NULL ,
`date_emprunt` DATE NOT NULL ,
`date_retour` DATE NULL ,
PRIMARY KEY (`id_emprunt`))
ENGINE = MyISAM;


INSERT INTO serie (nom_serie,nb_tomes,nb_tomes_local,auteur,resume,tags)
VALUES
('Les forêts d Opale','10','2','Arleston Christophe','resume','Magie, Aventure'),
('Troll de Troy','22','7','Arleston Christophe','resume','franco-belge, fantastique medieval, humour'),
('Torpedo','15','5','Sanchez Abuli','resume','policier'),
('Asterix','37','9','René Goscinny','resume','franco-belge, humour, aventure'),
('Fondation','7','7','Isaac Asimov','resume','Science-fiction'),
('Sherlock Holmes','4','3','Arthur Conan Doyle','resume','policier'),
('Hunger games','3','3','Suzanne Collins','resume','Aventures, Science-fiction, Dystopie'),
('Fly','37','37','Riku Sanjo','resume','Aventure, Action');


INSERT INTO livres (titre,auteur,edition,date_de_parution,sorte,serie,id_serie,tome,langue,resume,tag1,tag2,tag3,emprunte)
VALUES
('Hunger games','Collins','Pocket Jeunesse','2009/09/01','Roman','Hunger games','7','1','français','resume','Aventure','Science-fiction','Dystopie','0'),
('Hunger games: l embrasement','Collins','Pocket Jeunesse','2010/05/06','Roman','Hunger games','7','2','français','resume','Aventure','Science-fiction','Dystopie','0'),
('Hunger games: la révolte','Collins','Pocket Jeunesse','2011/05/05','Roman','Hunger games','7','3','français','resume','Aventure','Science-fiction','Dystopie','0');


INSERT INTO livres (titre,auteur,edition,date_de_parution,sorte,serie,id_serie,tome,langue,resume,tag1,emprunte)
VALUES
('Fondation','Asimov','Gnome Press','1951/01/01','Roman','Fondation','5','1','français','resume','science-fiction','0'),
('Fondation et empire','Asimov','Gnome Press','1952/01/01','Roman','Fondation','5','2','français','resume','science-fiction','0'),
('Seconde Fondation','Asimov','Gnome Press','1953/01/01','Roman','Fondation','5','3','français','resume','science-fiction','0'),
('Fondation foudroyée','Asimov','Gnome Press','1982/06/01','Roman','Fondation','5','4','français','resume','science-fiction','0'),
('Terre et Fondation','Asimov','Gnome Press','1986/01/01','Roman','Fondation','5','5','français','resume','science-fiction','0'),
('prélude à la Fondation','Asimov','Gnome Press','1988/01/01','Roman','Fondation','5','6','français','resume','science-fiction','0'),
('L aube à la Fondation','Asimov','Gnome Press','1993/01/01','Roman','Fondation','5','7','français','resume','science-fiction','0'),
('Le chien des Baskerville','Doyle','Hachette','1905/01/01','Roman','Sherlock Holmes','6','3','français','resume','policier','0'),
('Une étude en rouge','Doyle','Hachette','1903/01/01','Roman','Sherlock Holmes','6','1','français','resume','policier','0'),
('Les aventures de Sherlock Holmes','Doyle','Hachette','1902/01/01','Roman','Sherlock Holmes','6','0','français','resume','policier','0');


INSERT INTO livres (titre,auteur,edition,date_de_parution,sorte,serie,id_serie,tome,langue,resume,dessinateur,tag1,emprunte)
VALUES
('Le bracelet de Cohars','Arleston','Soleil','2000/01/01','BD','Les forêts d Opale','1','1','français','resume','Pellet','franco-belge','0'),
('L envers du grimoire','Arleston','Soleil','2001/08/01','BD','Les forêtsd Opale','1','2','français','resume','Pellet','franco-belge','0'),
('Histoires trolles','Arleston','Soleil','1997/06/01','BD','Troll de Troy','2','1','français','resume','Mourrier','fantasy','0'),
('Le scalp du vénérable','Arleston','Soleil','1998/06/01','BD','Troll de Troy','2','2','français','resume','Mourrier','fantasy','0'),
('Comme un vol de pétaures','Arleston','Soleil','1999/05/01','BD','Troll de Troy','2','3','français','resume','Mourrier','fantasy','0'),
('Le feu occulte','Arleston','Soleil','2000/06/01','BD','Troll de Troy','2','4','français','resume','Mourrier','fantasy','0'),
('Le scalp du vénérable','Arleston','Soleil','1998/06/01','BD','Troll de Troy','2','5','français','resume','Mourrier','fantasy','0'),
('Les maléfices de Thaumaturge','Arleston','Soleil','2001/08/01','BD','Troll de Troy','2','6','français','resume','Mourrier','fantasy','0'),
('Plume de Sage','Arleston','Soleil','2004/04/01','BD','Troll de Troy','2','7','français','resume','Mourrier','fantasy','0'),
('Dieu reconnaitra les tiens!','Abuli','Albin Michel','1990/01/01','BD','Torpedo','3','10','français','resume','Bernet','policier','0'),
('Sale temps!','Abuli','Albin Michel','1987/01/01','BD','Torpedo','3','6','français','resume','Bernet','policier','0'),
('En voiture Simone','Abuli','Albin Michel','1986/01/01','BD','Torpedo','3','5','français','resume','Bernet','policier','0'),
('Mort au comptant','Abuli','Albin Michel','1990/01/01','BD','Torpedo','3','2','français','resume','Bernet','policier','0'),
('Tuer c est vivre','Abuli','Albin Michel','1983/01/01','BD','Torpedo','3','1','français','resume','Bernet','policier','0');


INSERT INTO livres (titre,auteur,edition,date_de_parution,sorte,serie,id_serie,tome,langue,resume,dessinateur,tag1,tag2,emprunte)
VALUES
('La zizanie','Goscinny','Hachette','1970/01/01','BD','Asterix','4','15','français','resume','Uderzo','aventure','humour','0'),
('Asterix en Corse','Goscinny','Hachette','1973/01/01','BD','Asterix','4','20','français','resume','Uderzo','aventure','humour','0'),
('Asterix le gaulois','Goscinny','Hachette','1959/08/29','BD','Asterix','4','1','français','resume','Uderzo','aventure','humour','0'),
('Asterix legionnaire','Goscinny','Hachette','1967/01/01','BD','Asterix','4','10','français','resume','Uderzo','aventure','humour','0'),
('Le grand fossé','Goscinny','Hachette','1980/01/01','BD','Asterix','4','19','français','resume','Uderzo','aventure','humour','0'),
('Astérix aux jeux olympiques','Goscinny','Hachette','1968/01/01','BD','Asterix','4','12','français','resume','Uderzo','aventure','humour','0'),
('Asterix chez les belges','Goscinny','Hachette','1979/01/01','BD','Asterix','4','24','français','resume','Uderzo','aventure','humour','0'),
('La grande traversée','Goscinny','Hachette','1975/01/01','BD','Asterix','4','22','français','resume','Uderzo','aventure','humour','0'),
('Asterix chez les bretons','Goscinny','Hachette','1966/08/31','BD','Asterix','4','8','français','resume','Uderzo','aventure','humour','0'),
('Le précepteur du héros','Sanjo','J ai lu','1989/02/01','Manga','Fly','8','1','français','resume','Inada','aventure','action','0'),
('La confraontation!! Hado contre Aban','Sanjo','J ai lu','1989/04/01','Manga','Fly','8','2','français','resume','Inada','aventure','action','0'),
('Disciples d Aban, tous unis','Sanjo','J ai lu','1989/06/01','Manga','Fly','8','3','français','resume','Inada','aventure','action','0'),
('Le rassemblement des 6 généraux','Sanjo','J ai lu','1989/08/01','Manga','Fly','8','4','français','resume','Inada','aventure','action','0'),
('L éclair du glaive de la justice','Sanjo','J ai lu','1989/10/01','Manga','Fly','8','5','français','resume','Inada','aventure','action','0'),
('Que de cruauté général Freeze','Sanjo','J ai lu','1989/12/01','Manga','Fly','8','6','français','resume','Inada','aventure','action','0'),
('Le sauveur immortel','Sanjo','J ai lu','1990/02/01','Manga','Fly','8','7','français','resume','Inada','aventure','action','0'),
('Maintenant ... l incarnation supreme','Sanjo','J ai lu','1990/04/01','Manga','Fly','8','8','français','resume','Inada','aventure','action','0'),
('Le chevalier du dragon','Sanjo','J ai lu','1990/06/01','Manga','Fly','8','9','français','resume','Inada','aventure','action','0'),
('La bataille entre le père et le fils','Sanjo','J ai lu','1990/08/01','Manga','Fly','8','10','français','resume','Inada','aventure','action','0'),
('Le secret de la naissance de Fly...','Sanjo','J ai lu','1990/10/01','Manga','Fly','8','11','français','resume','Inada','aventure','action','0'),
('La plus grande des batailles que la Terre ait connue','Sanjo','J ai lu','1990/12/01','Manga','Fly','8','12','français','resume','Inada','aventure','action','0'),
('Ou est l épée la plus puissante','Sanjo','J ai lu','1991/02/01','Manga','Fly','8','13','français','resume','Inada','aventure','action','0'),
('Le super démon: une redoutable créature','Sanjo','J ai lu','1991/04/01','Manga','Fly','8','14','français','resume','Inada','aventure','action','0'),
('Le grand débarquement du rocher du démon','Sanjo','J ai lu','1991/06/01','Manga','Fly','8','15','français','resume','Inada','aventure','action','0'),
('L épée de Fly','Sanjo','J ai lu','1991/08/01','Manga','Fly','8','16','français','resume','Inada','aventure','action','0'),
('La résurection du démon','Sanjo','J ai lu','1991/10/01','Manga','Fly','8','17','français','resume','Inada','aventure','action','0'),
('La garde d acier','Sanjo','J ai lu','1991/12/01','Manga','Fly','8','18','français','resume','Inada','aventure','action','0'),
('La confrontation','Sanjo','J ai lu','1992/02/01','Manga','Fly','8','19','français','resume','Inada','aventure','action','0'),
('Le serment de la lance magique','Sanjo','J ai lu','1992/04/01','Manga','Fly','8','20','français','resume','Inada','aventure','action','0'),
('Adieu, Mon fils','Sanjo','J ai lu','1992/06/01','Manga','Fly','8','21','français','resume','Inada','aventure','action','0'),
('L apparition du palais de Ban','Sanjo','J ai lu','1992/08/01','Manga','Fly','8','22','français','resume','Inada','aventure','action','0'),
('Prélude à l apocalypse','Sanjo','J ai lu','1992/10/01','Manga','Fly','8','23','français','resume','Inada','aventure','action','0'),
('Le cinquième talisman','Sanjo','J ai lu','1992/12/01','Manga','Fly','8','24','français','resume','Inada','aventure','action','0'),
('Par le pouvoir de Minakator','Sanjo','J ai lu','1993/02/01','Manga','Fly','8','25','français','resume','Inada','aventure','action','0'),
('Sus à l ennemi','Sanjo','J ai lu','1993/04/01','Manga','Fly','8','26','français','resume','Inada','aventure','action','0'),
('Le duel du vrai dragon','Sanjo','J ai lu','1993/06/01','Manga','Fly','8','27','français','resume','Inada','aventure','action','0'),
('Le grand heros ressucite','Sanjo','J ai lu','1993/08/01','Manga','Fly','8','28','français','resume','Inada','aventure','action','0'),
('La naissance d une armée surpuissante','Sanjo','J ai lu','1993/10/01','Manga','Fly','8','29','français','resume','Inada','aventure','action','0'),
('L adieu au combat','Sanjo','J ai lu','1993/12/01','Manga','Fly','8','30','français','resume','Inada','aventure','action','0'),
('Le second éveil','Sanjo','J ai lu','1994/02/01','Manga','Fly','8','31','français','resume','Inada','aventure','action','0'),
('Combat décisif de Myst','Sanjo','J ai lu','1994/04/01','Manga','Fly','8','32','français','resume','Inada','aventure','action','0'),
('Myst et Kilvan','Sanjo','J ai lu','1994/06/01','Manga','Fly','8','33','français','resume','Inada','aventure','action','0'),
('La véritable résurection du dieu du mal','Sanjo','J ai lu','1994/08/01','Manga','Fly','8','34','français','resume','Inada','aventure','action','0'),
('Se livrer à fond au combat','Sanjo','J ai lu','1994/08/01','Manga','Fly','8','35','français','resume','Inada','aventure','action','0'),
('S enflammer','Sanjo','J ai lu','1994/10/01','Manga','Fly','8','36','français','resume','Inada','aventure','action','0');

INSERT INTO emprunteurs (id_emprunteur,prenom,nom,pseudo,promo,mail,mdp,admin)
VALUES
('1','admin','admin','admin','2000','admin@fr','admin','1');

