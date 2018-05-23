<?php

include("vue.php");

//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new \User\UserRepository($connection);
$users = $userRepository->fetchAll();

enTete("Manger pas cher","Une autre vision de la consomation");

echo '<div id = "menu">';
lien("indexprof.php","Acceuil");
lien("articles.php","Articles");
echo "</div>";

echo '<div>';
echo ' <div id= "categorie">';
affiche_liste_article();
echo ' </div>';
echo ' <div id = "corp">';
affiche_info("Présentation ...");
affiche_info("Produits du moment ...");
echo '  <div id = "pub">';
affiche_info("pub1");
affiche_info("pub2");
echo '  </div>';
echo ' </div>';
echo ' <div>';
affiche_info("panier");
echo ' </div>';
echo '</div>';
foot();
pied();
?>


