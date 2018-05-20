<?php
/**
 * Created by PhpStorm.
 * User: KevinXu
 * Date: 12/05/2018
 * Time: 16:32
 */
session_start();
require '../vendor/autoload.php';
require_once 'Vue.php';
require_once 'Modele.php';





$T_id = $_GET['T_id'];
$id_user = $_SESSION['id'];

/*
echo "tweet_id = ".$T_id."</br>";
echo "user_id = ".$id_user;
*/


$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");


$tweetManager = new Tweet\TweetManager($connection);
$tweet = $tweetManager->get($T_id);




$listeCommentaire1 = getCommentaires($T_id, "tweet");


enTete("Tweet", "CSS/style.css");
afficheMenu();
titreH1("Tweet de ".prenom_user($tweet->getAuteur()));
?>
<script src="fonctionsJS.js"></script>
<script>
    function afficherChampId(ID){
        document.getElementById(ID).style.display = "inline";
    }

    function champVide(id){
        var doc = document.getElementById(id);
        if (doc.value == ""){
            alert("Commentaire vide");
        }
    }
</script>



<div class="conteneur">

<div class="tweet">
    <div class="tweettext">
    <?php
        afficheTweet($tweet, getTweetLikes($tweet->getId()));
        print "</br></br>";
        echo '<form method="POST" action="Commentaire/envoiCommentaire.php">'."\n";
        echo '<input type="hidden" name="type_parent" value="tweet">'."\n";
        echo '<input type="hidden" name="id_parent" value="'.$tweet->getId().'">'."\n";
        echo '<input type="hidden" name="TargetOwner" value="'.$tweet->getAuteur().'">'."\n";
        echo '<input type="text" size=50 name="contenu" placeholder="Veuillez saisir votre commentaire ...">'."\n";
        echo '<input type="submit" value="Envoyer" onclick="alert(\'Commentaire Envoyé\')" class="inputbutton">'."\n";
        echo "</form>\n";

    if (isset($_SESSION['admin'])) {
        //AFFICHE BOUTON SUPPRESSION*/
        echo '<form method="POST" action="Tweet/deleteTweet.php">'."\n";
        echo '<input type="hidden" name="idTweet" value="'.$tweet->getId().'">'."\n";
        echo '<input type="button" value="Supprimer le tweet" onclick="if(confirm(\'Commentaire Envoyé\')){this.form.submit();}" class="inputbutton">'."\n";
        echo "</form>\n";
    }
    ?>
    </div>
    <div class="listeCommentaires">
    <?php
        afficherCommentaires($listeCommentaire1);

    ?>
    </div>
</div>
    
    <?php
    $friendList = get_friendList($_SESSION['id']);
    afficheListeAmis($friendList);
    ?>

</div>


<?php
footer();
pied();
?>