<?php 

$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$GLOBALS['dbName']=$dbName;
$GLOBALS['dbUser']=$dbUser;
$GLOBALS['dbPassword']=$dbPassword;
$GLOBALS['connection']=$connection;

function printCandidatsEpreuves($id){
  echo "<br/>";
  $req="SELECT DISTINCT(id_candidat) FROM candidat_epreuve WHERE id_epreuve=$id"; //On récupère les id des épreuves dans lesquelles participent le candidat
  //$rep=$GLOBALS['connection']->prepare($req);
  //$rep->execute();
  $result=$GLOBALS['connection']->query($req);
  $result=$result->fetchAll();
  $n=count($result);
  $i=0;
  while($i<$n){
    $id_c=$result[$i][0];
    $req="SELECT prenom_c,pseudo_c,nom_c FROM candidat WHERE id_candidat=$id_c";
    $rep=$GLOBALS['connection']->prepare($req);
    $rep->execute();
    $res=$rep->fetch(PDO::FETCH_ASSOC);
    $prenom=$res['prenom_c'];
    $nom=$res['nom_c'];
    $pseudo=$res['pseudo_c'];
    $nom=$res['nom_c'];
    $link="profil.php?pseudo=".$pseudo;
    echo $prenom." ".$pseudo." ".$nom." : ";
    echo "<a href=$link>$pseudo</a>"; 
    echo "<br/>";
    $i++;
  }
  echo "<br/>";
}


?>