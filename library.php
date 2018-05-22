<?php
session_start();

?>

<html>
<head>
<meta charset="utf-8">
<h1> Formulaire pour la recherche de livre</h1>
<h2>Session de <?php echo $_SESSION['login']; ?></h2>
</head>
<link rel="stylesheet" href="recherche.css" type="text/css">

<body>
<h1>  Résultat de la recherche du <?php echo date("d/m/Y");?></h1>
</br></br>
<a href="profil.php">Retour au profil</a>
</br></br>
<a href="recherche.php">Retour à la recherche de livre</a>
</br></br>
<?php

$titre = $_GET['titre'];
$auteur = $_GET['auteur'];
$dessinateur = $_GET['dessinateur'];
$serie = $_GET['serie'];
$tome = $_GET['tome'];


$tmp="";
// on vérifie si l'utilisateur a bien rempli le formulaire
if(isset($_GET['type'])){
	$tmp = $tmp."((";
	foreach($_GET['type'] as $value){
		$tmp = $tmp."sorte LIKE \"".$value."\" OR ";
	}
	$tmp= $tmp."1=0) AND 1=1) AND ";
}

if(isset($_GET['langue'])){
	$tmp = $tmp."((";
	foreach($_GET['langue'] as $value){
		$tmp = $tmp."langue LIKE \"".$value."\" OR ";
	}
	$tmp= $tmp."1=0) AND 1=1) AND ";
}

if(isset($_GET['groupe'])){
	$tmp = $tmp."((";
	foreach($_GET['groupe'] as $value){
		$tmp = $tmp."(tag1 LIKE \"".$value."\" OR tag2 LIKE \"".$value."\" OR tag3 LIKE \"".$value."\" OR 1=0 ) AND ";
	}
	$tmp= $tmp."1=1) AND 1=1) AND ";
}


if(!($titre=="")){
    $tmp = $tmp." titre LIKE '%$titre%' AND ";
}
if(!($auteur=="")){
    $tmp= $tmp." auteur LIKE '%$auteur%' AND ";
}
if(!($dessinateur=="")){
    $tmp = $tmp." dessinateur LIKE '%$dessinateur%' AND ";
}
if(!($serie=="")){
    $tmp= $tmp." serie LIKE '%$serie%' AND ";
}
if(!($tome=="")){
    $tmp= $tmp." tome LIKE '%$tome%' AND ";
}
$tmp = $tmp."1=1;";


$requete = "SELECT * FROM livres WHERE $tmp"; // on crée la requête


if(!($connexion = mysqli_connect('localhost', 'root', 'mdp', 'local31')))// on se connecte à la base de donnée
    {
        echo "Error : Database connect";
    }


$reponse = mysqli_query($connexion, $requete);




if($reponse){
$nbTuples = mysqli_num_rows($reponse);
if($nbTuples!=0){
echo "<ul>";

while ($tupleCourant = mysqli_fetch_assoc($reponse) ){
?>

<?php 
	
	$now=$tupleCourant['titre'];
	$now_titre=utf8_encode("$now");
	?>
	<li>Titre :  <?php echo "$now_titre"; ?>
<?php
	$id_livre = $tupleCourant['id_livre'];
	
	?>

<?php


$now=$tupleCourant['serie'];
$now_serie=utf8_encode("$now");
echo " de   ".$tupleCourant['auteur']." de la série ".$now_serie.". Son id est ".$tupleCourant['id_livre']." .</li>";
}
echo "</ul>";
}

else{ // aucun résultat trouvé
	echo "Aucun résultat";
}

}

else // erreur lors de la recherche
{
echo "Problème d'éxécution à la recherche";
}


mysqli_close($connexion);
echo "</p>";
?>
</body></html>




      