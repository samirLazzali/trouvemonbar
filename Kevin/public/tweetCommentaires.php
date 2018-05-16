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


/*
 * Renvoie les commentaires d'un tweet ou d'un commentaire
 *
 * $type = 'tweet' ou 'commentaire
 */
function getCommentaires($T_id, $type) {
    global $connection;
    $sth = $connection->prepare('SELECT * FROM "commentaire" WHERE parent_id = \''.$T_id.'\' AND parent_type =\''.$type.'\' ORDER BY date_envoie DESC');
    $sth->execute();
    $result = $sth->fetch(PDO::FETCH_OBJ);

    $Res = array();

    while ($result) {
        $com = new Commentaire\Commentaire();

        $com->setId($result->id)
           ->setOwnerId($result->owner_id)
           ->setTargetId($result->target_id)
           ->setDate(new \DateTime($result->date_envoie))
           ->setContenu($result->contenu)
           ->setParentId($result->parent_id)
           ->setParentType($result->parent_type);

       $Res[] = $com;
       $result = $sth->fetch(PDO::FETCH_OBJ);
    }

    return $Res;
}


/*
 * Affiche tous les commentaires d'un tweet
 */
function afficherCommentaires($T) {
    print "<ul>\n";
    foreach ($T as $res) :
        echo '    <li>'.prenom_user($res->getOwnerId()).' ';
        echo 'a commenté à '.($res->getDate())->format('H:i:s')." le ".($res->getDate())->format('Y-m-d').' : ';
        echo $res->getContenu().' ';


        /* Ajout bouton pour ecrire commentaire */
        echo '<button onclick="afficherChampId('.$res->getId().');">Répondre</button></br>';

        echo '<form method="POST" action="Commentaire/envoiCommentaire.php" class="champCommentaire" id="'.$res->getId().'">'."\n";
        echo '<input type="hidden" name="type_parent" value="commentaire">';
        echo '<input type="hidden" name="id_parent" value="'.$res->getId().'">';
        echo '<input type="hidden" name="TargetOwner" value="'.$res->getTargetId().'">';
        echo '<input type="text" size=50 name="contenu" placeholder="Veuillez saisir votre commentaire ...">'."\n";
        echo '<input type="submit" value="Envoyer">'."\n";
        echo "</form>\n";

        afficherCommentaires(getCommentaires($res->getId(), "commentaire"));
        print "</li>\n";
    endforeach;
    echo '</ul>';
}



$listeCommentaire1 = getCommentaires($T_id, "tweet");


enTete("Tweet", "CSS/style.css");
afficheMenu();
titreH1("Tweet de ".prenom_user($tweet->getAuteur()));
?>

<script>
    function afficherChampId(ID){
        document.getElementById(ID).style.display = "inline";
    }
</script>



<div class="conteneur">

<div class="tweet">
    <div class="tweettext">
    <?php
        $tweetManager->show_tweet(prenom_user($tweet->getAuteur()), $tweet);
     //   echo '<button onclick="afficherChampId('.$tweet->getId().');">Répondre</button></br>';

        echo '<form method="POST" action="Commentaire/envoiCommentaire.php">'."\n";
        echo '<input type="hidden" name="type_parent" value="tweet">';
        echo '<input type="hidden" name="id_parent" value="'.$tweet->getId().'">';
        echo '<input type="hidden" name="TargetOwner" value="'.$tweet->getAuteur().'">';
        echo '<input type="text" size=50 name="contenu" placeholder="Veuillez saisir votre commentaire ...">'."\n";
        echo '<input type="submit" value="Envoyer">'."\n";
        echo "</form>\n";

    if (isset($_SESSION['admin'])) {
        //AFFICHE BOUTON SUPPRESSION*/
        echo '<form method="POST" action="Tweet/deleteTweet.php">'."\n";
        echo '<input type="hidden" name="idTweet" value="'.$tweet->getId().'">';
        echo '<input type="submit" value="Supprimer le tweet">'."\n";
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