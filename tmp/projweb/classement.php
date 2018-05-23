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

function getScore($id_candidat){
  $req="SELECT SUM(note) FROM candidat_epreuve WHERE id_candidat=$id_candidat";
  $rep=$GLOBALS['connection']->prepare($req);
  $rep->execute();
  $result=$rep->fetch(PDO::FETCH_ASSOC);
  $score=$result['sum'];
  return((int)$score);
}

function getCandidateScoreArray(){
  $req="SELECT id_candidat FROM candidat";
  $ids=$GLOBALS['connection']->query($req);
  $ids=$ids->fetchAll(); //array des id des candidats
  $i=0;
  $n=count($ids);
  $arr=array();
  while($i<$n){
    $id=$ids[$i][0];
    $note=getScore($id);
    $arr[$id]=$note;
    $i++;
  }
  return $arr;
}

function getRankingArray(){
  $arr=getCandidateScoreArray();
  $newArr= new ArrayObject($arr);
  $newArr->asort();
  $id=count($newArr);
  $simpleArray=array();
  $i=0;
  foreach ($newArr as $key => $value) {
    $simpleArray[$i]=$key;
    $i++;
  }
  return(array_reverse($simpleArray));
}

function printRanking(){
  $idArr=getRankingArray();
  $rank=1;
  echo "<p id='classement'>";
  foreach($idArr as $id){
    $score=getScore($id);
    $req="SELECT prenom_c,pseudo_c,nom_c FROM candidat WHERE id_candidat=$id";
    $rep=$GLOBALS['connection']->prepare($req);
    $rep->execute();
    $result=$rep->fetch(PDO::FETCH_ASSOC);
    $prenom=$result['prenom_c'];
    $pseudo=$result['pseudo_c'];
    $nom=$result['nom_c'];
    $link="profil.php?pseudo=".$pseudo;
    echo (string)$rank.". ".$prenom." <a href=$link>".$pseudo."</a> ".$nom." : ".(string)$score."pts<br/>";
    $rank++;
  }
  echo "</p>";
}
?>





<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
<title>Classement</title>
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
<h1> Classement actuel des candidats </h1>
<?php printRanking();?>
</body>
</html>
