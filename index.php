<?php
/**
 * Require
 *
 * PHP Version 7.0
 *
 * @category Require
 * @package  Require
 * @author   Eric COLONIA <ercol@outlook.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     localhost:8080/index.php
 */
 require_once "identite.php";


require_once "manga_aleatoire.php";
require_once "mangapref.php";
$repertoire="pics";
$doc="~/Documents/Ensiie/Projet Web/ensiie-project-master/public";
/*var current="index.php";*/
$source='https://fonts.googleapis.com/css?family=';
?>


<!DOCTYPE html>

<html>
 <head>
  <meta charset="UTF-8">
   <link rel="stylesheet" href="index.css" />
   <link href="<?php echo $source; ?>Pangolin" rel="stylesheet"/>
   <link href="<?php echo $source; ?>Gloria+Hallelujah" rel="stylesheet"/>
   <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
   <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <?php require_once "autocomplete.php";?>
   <title> Mangas </title> 
   <link rel="icon" type="image/png" href="favicon.png"/>
 </head>
<body>
<h1 class="text-center">
 <img src="logo_text.png"alt="BakaClub"style="max-width:300px;margin:0 auto;">
</h1>

<?php  
if (isset($_GET['Disconnected'])) {
    $_SESSION['login']='visiteur' ;
    $admin = 0 ;
    echo "Vous avez été deconnecté" ;
    echo "</br>";
}
if (isset($_GET['rendu'])) {
    echo"Vous avez bien rendu vos mangas! </br>";
}

if (isset($_GET['emprunt'])) {
    echo " Emprunt reussi! </br>";
}
if (isset($_GET['success'])) {
    echo" Le compte a bien ete cree ! </br>";
}
if (isset($_GET['admin'])) {
    echo "Bienvenue nouvel admin!</br> ";
}
if (isset($_GET['Nope'])) {
    echo" Pas de serie de ce nom dans la base de donnee ! </br>";
}
echo "Vous êtes connecté en tant que $_SESSION[login]";
if ($admin==1) {
    echo "Vous etes administrateur";
}
?>
<?php if ($_SESSION['login']=='visiteur') {
?>
<div class="log">
<div class="connect">
 <span classe="baka">C</span><span>o</span><span>n</span><span>n</span><span>e</span><span>x</span><span>i</span><span>o</span><span>n</span>
</div>
<form action="index.php" method="post">
<input placeholder="Login" type="text" name="login"/>
<input placeholder="password" type="password" name="password"/>
<br>
<input type="submit" value="Connexion"/>

</form>
<a href="Creer_compte.php"> Creer un compte </a>
<?php if (isset($_GET['wrongpass'])) {
    echo "<p> Mauvais mot de passe </p>";
}
?>
</div>

<?php } else {
    echo"<div class='log'>";


    echo "<a href=profil.php> Voir mon profil </a>";
    echo "</br>";
    echo" <a href='index.php?Disconnected'> Deconnexion </a>";
    echo "</div>";
}

?>

<div class="ui-widget">
<div class="indexrecherche">
<center>
<span style="background : blue;">E</span><span style="background : blue;">m</span><span style="background : blue;">p</span><span style="background : blue;">r</span><span style="background : blue;">u</span><span style="background : blue;">n</span><span style="background : blue;">t</span>
</center>
</span>
</div>
<div class="rechercheindex">
<form action='emprunt.php' method='post'>
Quel manga souhaitez vous emprunter?
</br>
<input type="text" size="50" placeholder= "Recherche" name="Recherche">
</form>
<div clas="liste_manga">
<a href="list_manga.php"> Ou voir la liste des mangas au Baka </a>
</div>
</div>
<div class="mangaaleatoire">
<center>
 <span>M</span><span>a</span><span>n</span><span>g</span><span>a</span> <span>a</span><span>l</span><span>é</span><span>a</span><span>t</span><span>o</span><span>i</span><span>r</span><span>e</span>
</center>
</div>
<div class="affichemanga">
<?php 

Affiche_manga();
global $titre;
$titre=$_SESSION['titre'];
echo"
</div>
<a href='emprunt.php?titre=$titre' > Emprunter ce manga? </a>";

?>
<div class="resume1">
<center> <span>R</span><span>é</span><span>s</span><span>u</span><span>m</span><span>é</span></center>
</div>

<div class="resume2">

</div>
</div>
<div class="trans">
<img style="opacity:0.5;filter:alpha(opacity=50);width :400px;" src="Pics_transparent/Girl_blue.jpg" alt=Umaru />

</div>
<div class="manga_pref">
<?php manga_pref(); ?>

</div>

<?php
if ($admin == 1) {
?>
<div class="membre">
    <a href='membre.php'> Liste des membres </a>
    </div>
<?php
}
?>
</body>
</html>


