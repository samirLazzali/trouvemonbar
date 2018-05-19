<?php
//session_start();

//$prenom = $_SESSION['prénom'];
//$id = $_SESSION['id'];

/* Recupération des users*/
//require_once '../vendor/autoload.php';


//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");



/* Les Managers */

$tweetManager = new Tweet\TweetManager($connection);
$commentaireManager = new Commentaire\CommentaireManager($connection);
$messageManager = new Message\MessageManager($connection);

/*$userRepository = new \User\UserRepository($connection);
$users = $userRepository->fetchAll();

$messageRepository = new \Message\MessageRepository($connection);
$messages = $messageRepository->fetchAll();*/


/* Fonction pour recuperer le prenom de quelqu'un */
function prenom_user($id_user){
    global $connection;
    $sth = $connection->prepare('SELECT * FROM "user" WHERE id=\''.$id_user.'\';');
    $sth->execute();
    $result = $sth->fetch(PDO::FETCH_OBJ);
    return $result->firstname;
}


function get_friendList($id){
    global $connection;
    $sth = $connection->prepare('SELECT * FROM "amis" WHERE personne1=\''.$id.'\' OR personne2=\''.$id.'\' ');
    $sth->execute();
    $result = $sth->fetch(PDO::FETCH_OBJ);

    $Res = array();
    $i=0;
    while($result){
        $Res[$i] = array();
        if($result->personne1 == $id){
            $Res[$i]['id'] = $result->personne2;
            $Res[$i]['prénom'] = prenom_user($result->personne2) ;
        }
        else{
            $Res[$i]['id'] = $result->personne1;
            $Res[$i]['prénom'] = prenom_user($result->personne1) ;
        }
        $result = $sth->fetch(PDO::FETCH_OBJ);
        $i++;
    }

    return $Res;
}

/* echo '<pre>';                     POUR AFFICHER ARRAY
    echo '</pre>';*/


function liker($T_id, $id){
    global $connection;
    /*
     * Test si on a déjà liké ce tweet
     */
    $req = $connection->prepare("SELECT * FROM \"like\" WHERE tweet_id = $T_id AND user_id=$id");
    $req->execute();

    if ($req->rowCount() == 1){
        $connection->exec("DELETE FROM \"like\" WHERE tweet_id = $T_id AND user_id=$id");
    }
    else{
        $sth = $connection->prepare('INSERT INTO "like"(tweet_id, user_id) VALUES (:tweet_id, :user_id)');
        $sth->bindValue(':tweet_id', $T_id);
        $sth->bindValue(':user_id', $id);
        $sth->execute();
    }

}


function getTweetAmis($id){
    global $connection;
    $sth = $connection->prepare('SELECT tweet.id,auteur,contenu,date_envoie FROM "amis" JOIN "tweet" ON personne1=auteur WHERE personne2=\''.$id.'\' UNION SELECT tweet.id,auteur,contenu,date_envoie FROM "amis" JOIN "tweet" ON personne2=auteur WHERE personne1=\''.$id.'\'  ');
    $sth->execute();
    $result = $sth->fetch(PDO::FETCH_OBJ);
    $res = array();
    $i = 0;
    while($result){
        /********************** AJOUT POUR RECUPERER NB DE LIKES *******************************/
        $likes_res = $connection->prepare('SELECT count(tweet_id) AS nb FROM "like" WHERE tweet_id='.$result->id);
        $likes_res->execute();
        $likes = $likes_res->fetch(PDO::FETCH_OBJ);

        $res[$i][] = $likes->nb;

        $tweet = new Tweet\Tweet();
        $tweet->setAuteur($result->auteur)
            ->setContenu($result->contenu)
            ->setDate(new \DateTime($result->date_envoie))
            ->setId($result->id);

        $res[$i][] = $tweet;
        $i++;
       /* echo "[\"".prenom_user($result->auteur)."\",\"$result->contenu\",\"$result->date_envoie\",\"$result->id\",\"".$likes->nb."\"]";
        $result = $sth->fetch(PDO::FETCH_OBJ);*/
        $result = $sth->fetch(PDO::FETCH_OBJ);
     }
     return $res;
}



function ecrireCommentaire($idParent, $type, $contenu, $TargetOwner){

    global $commentaireManager;

    $com = new \Commentaire\Commentaire();
    $com
        ->setOwnerId($_SESSION['id'])
        ->setTargetId($TargetOwner)
        ->setDate(new \DateTime())
        ->setContenu($contenu)
        ->setParentId($idParent)
        ->setParentType($type);

    $commentaireManager->add($com);

}










