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

$pseudo=$_GET['pseudo'];
$req="SELECT prenom_c,pseudo_c,nom_c,id_candidat FROM candidat WHERE pseudo_c=". $GLOBALS['connection']->quote($pseudo)."";
$rep=$GLOBALS['connection']->prepare($req);
$rep->execute();
$result=$rep->fetch(PDO::FETCH_ASSOC);

$nom=$result['nom_c'];
$prenom=$result['prenom_c'];
$id_candidat=$result['id_candidat'];

function ableToRate(){
  return($_SESSION['status']=='jury');
}
//Cette fonction affiche la lsite des épreuves auxquelles participe le candidat sous forme de liste déroulante
function printListeEpreuves(){
  //Récupération de la liste des épreuves auxquelles participe le candidat
  global $id_candidat;
  global $pseudo;
  $req="SELECT id_epreuve FROM candidat_epreuve WHERE id_candidat=$id_candidat"; //On récupère les id des épreuves dans lesquelles participent le candidat
  $result=$GLOBALS['connection']->query($req);
  $result=$result->fetchAll();
  // On affiche la liste déroulante 
  $n=count($result);
  $i=0;
  echo "<label for='epreuve'> Quelle épreuve souhaitez vous noter ?</label><br/>";
  echo "<select name='epreuve' id='epreuve'>";
  while($i<$n){
    $id=$result[$i][0];
    $req="SELECT nom_e FROM epreuve WHERE id_epreuve=$id";
    $rep=$GLOBALS['connection']->prepare($req);
    $rep->execute();
    $res=$rep->fetch(PDO::FETCH_ASSOC);
    $nom=$res['nom_e'];
    $encodedName=urlencode($nom);
    echo "<option value=$encodedName>$nom</option>";
    $i++;
  }
  echo "</select>";
  echo "<br/>";
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
<title>Notation</title>
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
  <a href="#admin"><a href="./administration.html">Administration</a></a>
  <a href="#deconnexion"><a href="./deconnexion.php">Déconnexion</a></a>
</div>
<form method="post" action=<?php $link="notation.php?pseudo=".$pseudo;echo $link;?>>
    <?php printListeEpreuves();?> 
    <label for="note">Note (entre 0 et 20) </label> : <input type="value" name="note" id="note" size="2" maxlength="2"><br/><br/>
    <input type="submit" value="Valider"/>
</form>
<div>Nota : si vous avez déjà noté un candidat pour une épreuve, la note précédente sera supprimée.</div>

</body>
</html>
