## Usage
 * Il n'y a pas de docker fourni ici, l'explication se trouve dans le rapport /rapport.pdf
 * La connexion sql se configure via le fichier /public/modele/connect_bdd.php à configurer préalablement
 * Le site utilise un système de mail à configurer préalablement :
	* Dans le fichier /public/controleur/inscription.php la variable '$site' a changé selon l'hébergeur
	* Dans le php.ini selon le fournisseur d'accès
	* Pour ne pas utiliser de mail de validation, il suffit de remplacer \'valid_mail\' par \'utilisateur'\ ou admin dans la class DataUser qui
    se trouve dans le fichier /public/modele/DataUser.class.php
 * Le fichier db_postgre.sql permet de créer les tables nécessaires au bon fonctionnement du site
## Application
Lien du site diffusé publiquement : https://tinyurl.com/meetiie
