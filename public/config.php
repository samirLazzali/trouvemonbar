<?php
/* Le fichier config.php doit contenir l\'initialisation des variables php $nomBase avec le nom de la base de données dans laquelle vous avez créé la relation tp_client et $nomuser avec votre login */
require '../vendor/autoload.php';
$nom_hote= "postgres";
$nom_base = getenv("DB_NAME");
$nom_user = getenv("DB_USER");
$mdp_db= getenv("DB_PASSWORD");

$AUTHENT=1;

?>
