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

$pseudo=htmlspecialchars($_GET['pseudo']);
$req="SELECT prenom_c,pseudo_c,nom_c,id_candidat,description,photo FROM candidat WHERE pseudo_c=". $GLOBALS['connection']->quote($pseudo)."";
$rep=$GLOBALS['connection']->prepare($req);
$rep->execute();
$result=$rep->fetch(PDO::FETCH_ASSOC);

$nom=$result['nom_c'];
$prenom=$result['prenom_c'];
$id_candidat=$result['id_candidat'];
$photo=$result['photo'];
$description=$result['description'];

function printNom(){
  global $nom;
  echo $nom;
}

function printPrenom(){
  global $prenom;
  echo $prenom;
}

function printPseudo(){
  global $pseudo;
  echo $pseudo;
}
function printPhoto(){
  global $photo;
  $link="../pics/".$photo;
  echo "<img src=$link alt='Photo du candidat' width=225 height=300/></br>";
}
function printEpreuves(){
  global $id_candidat;
  $req="SELECT DISTINCT(id_epreuve) FROM candidat_epreuve WHERE id_candidat=$id_candidat"; //On récupère les id des épreuves dans lesquelles participent le candidat
  //$rep=$GLOBALS['connection']->prepare($req);
  //$rep->execute();
  $result=$GLOBALS['connection']->query($req);
  $result=$result->fetchAll();
  $n=count($result);
  $i=0;
  while($i<$n){
    $id=$result[$i][0];
    $req="SELECT nom_e FROM epreuve WHERE id_epreuve=$id";
    $rep=$GLOBALS['connection']->prepare($req);
    $rep->execute();
    $res=$rep->fetch(PDO::FETCH_ASSOC);
    $nom=$res['nom_e']; 
    $link="epreuve.php?nom=".urlencode($nom);
    echo "- <a href=$link>$nom</a>"; 
    echo "<br/>";
    $i++;
  }
}

function printScore(){
  global $id_candidat;
  $req="SELECT SUM(note) FROM candidat_epreuve WHERE id_candidat=$id_candidat";
  $rep=$GLOBALS['connection']->prepare($req);
  $rep->execute();
  $result=$rep->fetch(PDO::FETCH_ASSOC);
  $score=$result['sum'];
  if ($score==0){
    echo "0";
  }
  else{
    echo $score;
  }
}
function printDescription(){
  global $id_candidat;
  $req="SELECT description FROM candidat WHERE id_candidat=$id_candidat";
  $rep=$GLOBALS['connection']->prepare($req);
  $rep->execute();
  $result=$rep->fetch(PDO::FETCH_ASSOC);
  echo $result['description'];
  echo "<br/>";
  }


?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
<title>Page Title</title>
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
<div class="main">
  <p>
    <?php printPhoto();?></br>
    Nom du candidat : <?php printPrenom();echo " ";printNom();?></br>
    Pseudo du candidat : <?php printPseudo();?><br/>
    Épreuves : <br/><?php printEpreuves();?><br/>
    Score total : <?php printScore();?> pts</br>
    Description du candidat : <br/><?php printDescription();?><br/><br/>
    Vous êtes un jury et vous souhaitez noter le candidat ? Cliquez <a href="noter.php?pseudo=<?php echo $_GET['pseudo'];?>"> ici </a><br/>
    <span id="edit"> Cliquez <a href="edit.php?pseudo=<?php echo $_GET['pseudo'];?>"> ici </a> pour éditer votre profil </span>
  </p>
</div>
</body>
</html>