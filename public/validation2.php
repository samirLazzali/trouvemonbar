<?php

mysql_connect("localhost", "root", "");

mysql_select_db("db");

$quete = mysql_query("SELECT * FROM utilisateur");


while($validation = mysql_fetch_array($quete))

{
  //affichage
echo 'Qualité: ';
echo $validation['sexe'];

echo 'Pseudo: ';
echo $validation['pseudo'];

echo 'Nom: ';
echo $validation['nom'];

echo 'Prénom: ';
echo $validation['prenom'];

echo ' E-mail: ';
echo $validation['email'];

echo ' Mot de passe: ';
echo $validation['mdp'];

echo ' Ville: ';
echo $validation['nom_v'];

echo ' Pays: ';
echo $validation['nom_p'];


echo '<a href="validation.php?action=accepter&id='.$validation['pseudo'].'">Accepter</a>';
echo '<a href="validation.php?action=refuser&id='.$validation['pseudo'].'">Refuser</a>';

echo '<br/>';
}



if(isset($_GET['action']) AND isset($_GET['pseudo']))
{
$action = $_GET['action'];

if($action == "accepter")
{
$id = $_GET['id'];

$quete2 = mysql_query("SELECT * FROM utilisateur WHERE pseudo='$pseudo'");
$connexion = mysql_fetch_array($quete2);

$qualite = $validation['qualite'];
$pseudo = $validation['pseudo'];
$nom = $validation['nom'];
$prenom = $validation['prenom'];
$email = $validation['email'];
$passeword = $validation['mdp'];
$ville = $validation['nom_v'];
$pays = $validation['nom_p'];

mysql_query("INSERT INTO connexion VALUES('$id', '$title', '$userpseudo' '$username', '$userprename', '$usermail', '$password' '$ville', '$pays')");
}
mysql_query("DELETE FROM utilisateur WHERE id='$id'");

}

elseif($action == "refuser")
{
$id = $_GET['id'];
mysql_query("DELETE FROM validation WHERE id='$id'");
}



?>
