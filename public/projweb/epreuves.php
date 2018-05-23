<?php 

session_start();
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$GLOBALS['dbName']=$dbName;
$GLOBALS['dbUser']=$dbUser;
$GLOBALS['dbPassword']=$dbPassword;
$GLOBALS['connection']=$connection;

function printEpreuves(){
  $req="SELECT nom_e FROM epreuve";
  $result=$GLOBALS['connection']->query($req);
  $result=$result->fetchAll();
  $n=count($result);
  $i=0;
  while($i<$n){
    $nom=$result[$i][0];
    $link="epreuve.php?nom=".urlencode($nom);
    echo "<a href=$link>$nom</a>";
    echo "<br/>";
    $i++;
  }
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
<title>Épreuves</title>
</head>
<body>
<link rel="stylesheet" type="text/css" href="style.css" />

<div class="hero-image">
  <div class="hero-text">
    <h1>MISTERIIE</h1>
    <p>Edition 2018/2019</p>
  </div>
</div>
<div class="navbar">
  <a href="#accueil"><a href="./main.html">Accueil</a></a>
  <a href="#candidats"><a href="./classement.php">Classement</a></a>
  <a href='#epreuves'><a href="./epreuves.php">Épreuves</a></a>
  <a href="#login"><a href="./login.html">Login</a>
  <a href="#signup"><a href="./Inscription.html">S'enregistrer</a></a>
  <a href="#admin"><a href="./administration.php">Administration</a></a>
  <a href="#deconnexion"><a href="./deconnexion.php">Déconnexion</a></a>
</div>

<hr/>
<h1> Liste des épreuves de la compétition </h1>
<div class="main">
  <p>
    <?php printEpreuves();?>
  </p>
</div>
</body></html>
 


</body>
</html>
