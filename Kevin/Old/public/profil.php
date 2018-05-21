<?php
session_start();

require_once '../vendor/autoload.php';
require_once 'Vue.php';
require_once 'Modele.php';


if(isset($_POST['visite'])){ // si formulaire soumis
    $pseudo = $_POST['pseudo'];
}
else{
    $pseudo = $_GET['pseudo'];
}

/*$sth = $connection->prepare('SELECT id FROM "user" WHERE firstname=\''.$pseudo.'\'');
    $sth->execute();
    $result = $sth->fetch(PDO::FETCH_OBJ);*/

$id = idUserLogin($pseudo);


enTete("Profil de $pseudo", "CSS/style.css");
afficheMenu();

titreH1("Profil de $pseudo");




?>
<script src="fonctionsJS.js"></script>




<?php
print "<center>";

if(!is_ami($_SESSION['id'],$id) && $id!=$_SESSION['id'] ){
    print "<div class=\"informations\">";
    print "Nombre d'amis : ";
    echo getNbAmis($id);
    print " Nombre de tweets : ";
    echo getNbTweet($id);
    print "<br/>";
    print "<form id='ajouteramis' method='post' action='Amis/ajouteramis.php'>";
    print "<input type='hidden' name='personne' value=\"$id\"></input><br/>";
    print "<input  type='submit' value='Ajouter' onclick='alert(\"Ami ajouté !\");'>";
    print "</form>";
    print "</div>";
}

else if($id!=$_SESSION['id']){
    print "<div class=\"informations\">";
    print "Nombre d'amis : ";
    echo getNbAmis($id);
    print " Nombre de tweets : ";
    echo getNbTweet($id);
    print "<br/>";
    print "<form id='supprimer' method='post' action='Amis/supprimeramis.php'>";
    print "<input type='hidden' name='personne' value=\"$id\"></input><br/>";
    print "<input  type='submit' value='Supprimer' onclick='alert(\"Ami supprimé !\");'>";
    print "</form>";
    print "</div>";
}
else if ($id==$_SESSION['id']){
    print "<div class=\"informations\">";
    print "Nombre d'amis : ";
    echo getNbAmis($id);
    print " Nombre de tweets : ";
    echo getNbTweet($id);
    print "<br/>";
    print "</div>";
}

if(!empty($pseudo)){
    print "<br/>";
    $tweets = getTweetId($id);
    afficheListeTweets($tweets);
    print "</center>";
}
else{
    print "Champ Vide";
}

pied();
?>
