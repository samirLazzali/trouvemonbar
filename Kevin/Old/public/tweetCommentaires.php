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
$id_user = $_GET['pseudo_id'];


echo "tweet_id = ".$T_id."</br>";
echo "user_id = ".$id_user;




$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

/*
 *
 * Renvoie les commentaires d'un tweet ou d'un commentaire
 *
 * $type = 'tweet' ou 'commentaire
 */
function getCommentaires($T_id, $type) {
    global $connection;
    $sth = $connection->prepare('SELECT * FROM "commentaire" WHERE parent_id = \''.$T_id.'\' AND parent_type =\''.$type.'\' ');
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
 * Renvoie true si un commentaire a des commentaire, 0 sinon. PAS UTILE
 */
function Commenter($C_id){
    global $connection;

    $req = $connection->prepare('SELECT * FROM \"commentaire\" WHERE parent_id = \''.$C_id.'\' AND parent_type=\'commentaire\'');
    $req->execute();
    if ($req->rowCount() == 0){
        return false;
    }
    else{
        return true;
    }
}


$listeCommentaire1 = getCommentaires($T_id, "tweet");
$tweetManager = new Tweet\TweetManager($connection);

$tweet = $tweetManager->get($T_id);




function afficherCommentaires($T) {
    print "<ul>\n";
    foreach ($T as $res) :
        echo '    <li>'.prenom_user($res->getOwnerId()).' ';
        echo 'a commenté à '.($res->getDate())->format('H:i:s')." le ".($res->getDate())->format('Y-m-d').' : ';
        echo $res->getContenu().' ';

       //if (Commenter($res->getId())){
            afficherCommentaires(getCommentaires($res->getId(), "commentaire"));

        print "</li>\n";
    endforeach;
    echo '</ul>';
}

//afficherCommentaires($listeCommentaire1);


enTete("Tweet", "CSS/style.css");

afficheMenu();
titreH1("Tweet de ".prenom_user($tweet->getAuteur()));
?>


<div class="conteneur">

<div class="tweet">
    <p class="tweettext">
    <?php
        $tweetManager->show_tweet(prenom_user($tweet->getAuteur()), $tweet);
    ?>
    </p>
    <div class="listeCommentaires">
    <?php
        afficherCommentaires($listeCommentaire1);

    ?>
    </div>
</div>
</div>


<?php
pied();
?>