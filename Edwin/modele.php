<?php
//session_start();

//$prenom = $_SESSION['prénom'];
//$id = $_SESSION['id'];

/* Recupération des users*/
require '../vendor/autoload.php';


//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");



/* Les Managers */

$tweetManager = new Tweet\TweetManager($connection);
$commentaireManager = new Commentaire\CommentaireManager($connection);
$messageManager = new Message\MessageManager($connection);
$hashtagManager = new Hashtag\HashtagManager($connection);
$userManager = new User\UserManager($connection);

/*$userRepository = new \User\UserRepository($connection);
$users = $userRepository->fetchAll();

$messageRepository = new \Message\MessageRepository($connection);
$messages = $messageRepository->fetchAll();*/




date_default_timezone_set('Europe/Paris');


function config($login,$nom, $prenom, $id, $admin) {
    // session_start();
    $_SESSION['login'] = $login;
    $_SESSION['admin'] = $admin;
    $_SESSION['nom'] = $nom;
    $_SESSION['prénom'] = $prenom;
    $_SESSION['id'] = $id;
}


/*Fonction pour recuperer le prenom de quelqu'un*/
function prenom_user($id_user){
    global $userManager;
    $user = $userManager->get($id_user);
    return $user->getFirstname();
}

function idUser($pseudo){
    global $connection;
    $sth = $connection->prepare('SELECT * FROM "user" WHERE firstname=\''.$pseudo.'\';');
    $sth->execute();
    if ($sth->rowCount() == 0){
        return FALSE;
    }
    $result = $sth->fetch(PDO::FETCH_OBJ);
    return $result->id;
}


function idUserLogin($login){
    global $connection;
    $sth = $connection->prepare('SELECT * FROM "user" WHERE login=\''.$login.'\';');
    $sth->execute();
    if ($sth->rowCount() == 0){
        return FALSE;
    }
    $result = $sth->fetch(PDO::FETCH_OBJ);
    return $result->id;
}

function loginUserID($id){
    global $userManager;
    $user = $userManager->get($id);
    return $user->getLogin();
}

/*On récupère l'user correspondant au login*/
function loginUser($login){
    global $connection;
    $user = new User\User();
    $sth = $connection->prepare('SELECT * FROM "user" WHERE login=\''.$login.'\';');
    $sth->execute();
    if ($sth->rowCount() == 0){
        return FALSE;
    }
    $result = $sth->fetch(PDO::FETCH_OBJ);

    $user->setLogin($result->login)
        ->setFirstname($result->firstname)
        ->setLastname($result->lastname)
        ->setId($result->id)
        ->setAdministrateur($result->administrateur);
    return $user;
}



function get_friendList($id){
    global $connection;
    $sth = $connection->prepare('SELECT * FROM "amis" WHERE personne1=\''.$id.'\' ');
    $sth->execute();
    $result = $sth->fetch(PDO::FETCH_OBJ);

    $Res = array();
    $i=0;
    while($result){
        $Res[$i] = array();
        if($result->personne1 == $id){
            $Res[$i]['id'] = $result->personne2;
            $Res[$i]['login'] = loginUserID($result->personne2) ;
        }
        else{
            $Res[$i]['id'] = $result->personne1;
            $Res[$i]['login'] = loginUserID($result->personne1) ;
        }
        $result = $sth->fetch(PDO::FETCH_OBJ);
        $i++;
    }

    return $Res;
}

/*
 * Test si on a déjà liké un tweet
 * Renvoie TRUE si c'est le cas, FALSE sinon
 */
function dejaLiker($T_id){
    global $connection;
    $req = $connection->prepare("SELECT * FROM \"like\" WHERE tweet_id = $T_id AND user_id=".$_SESSION['id']);
    $req->execute();

    if ($req->rowCount() == 1){
        return TRUE;
    }
    else{
        return FALSE;
    }
}

/*
 * Ajout d'un like
 */
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



/********************** TWEET ************************/

/*
 * Renvoie le nombre de likes du tweet $T_id
 */
function getTweetLikes($T_id){
    global $connection;
    $likes_res = $connection->prepare('SELECT count(tweet_id) AS nb FROM "like" WHERE tweet_id='.$T_id);
    $likes_res->execute();
    $likes = $likes_res->fetch(PDO::FETCH_OBJ);
    return $likes->nb;
}

/*
 * Renvoie un tableau contenant tous les tweets des amis de l'utilisateur ayant pour id=$id
 */
function getTweetAmis($id){
    global $connection;
    $sth = $connection->prepare('SELECT tweet.id,auteur,contenu,date_envoie FROM "amis" JOIN "tweet" ON personne2=auteur WHERE personne1=\''.$id.'\' ORDER BY date_envoie DESC');
    $sth->execute();
    $result = $sth->fetch(PDO::FETCH_OBJ);
    $res = array();
    $i = 0;
    while($result){
        /********************** AJOUT POUR RECUPERER NB DE LIKES *******************************/
        $res[$i][] = getTweetLikes($result->id);

        $tweet = new Tweet\Tweet();
        $tweet->setAuteur($result->auteur)
            ->setContenu($result->contenu)
            ->setDate(new \DateTime($result->date_envoie))
            ->setId($result->id);

        $res[$i][] = $tweet;
        $i++;

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


function deleteTweet($id){
    global $tweetManager;

    $tweet = new Tweet\Tweet();
    $tweet->setId($id);
    $tweetManager->delete($tweet);
}

/*
 * Renvoie un tableau contenant tous les tweets de l'utilisateur $id
 */
function getTweetId($id){
    global $connection;
    $sth = $connection->prepare('SELECT * FROM "tweet" WHERE auteur='.$id.' ORDER BY date_envoie DESC');
    $sth->execute();
    $result = $sth->fetch(PDO::FETCH_OBJ);

    $T = array();
    $i = 0;

    while($result) {
        $T[$i][] = getTweetLikes($result->id);

        $tweet = new Tweet\Tweet();
        $tweet
            ->setId($result->id)
            ->setAuteur($result->auteur)
            ->setDate(new \DateTime($result->date_envoie))
            ->setContenu($result->contenu);
        $T[$i][] = $tweet;
        $result = $sth->fetch(PDO::FETCH_OBJ);
        $i++;
    }

    return $T;
}


/*
 * ajoute un tweet
 * Renvoie le tweet qui vient d'être ajouter
 */
function ajoutTweet($content)
{
    global $tweetManager;
    $date = new DateTime();
    $tweet = new Tweet\Tweet();

    $tweet
        ->setAuteur($_SESSION['id'])
        ->setDate($date)
        ->setContenu($content);

    $tweetManager->add($tweet);

    return $tweet;
}


/********************** COMMENTAIRE ***************************/

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



/********************* HASHTAG *********************/

/*
 * Renvoie la liste des hashtags présents dans un tweet
 */
function listeHashtags($text){
    $text = str_replace("\n","",$text);
    $text = str_replace("\r","",$text);
    $text = str_replace("\t","",$text);

    $T = explode(" ", $text);
    $res = array();
    for ($i=0; $i<count($T); $i++){
        if (isset($T[$i][0])) {
            if ('#' == $T[$i][0]) {
                $res[] = addslashes(strtolower(substr($T[$i], 1)));
            }
        }
    }
    return $res;
}

/*
 * ajoute tous les hashtags présents dans un tweet
 */
function ajoutHashtag($tweet)
{
    global $connection;
    global $hashtagManager;
    $res = listeHashtags($tweet->getContenu());
    $i = 0;
    while ($i < count($res)) {
        $sth = $connection->prepare('SELECT * FROM "hashtag" WHERE mot = \''.$res[$i].'\'');
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            /* Ajout du nouveau Hashtag */
            $hashtag = new \Hashtag\Hashtag();
            $hashtag->setMot($res[$i]);
            $hashtagManager->add($hashtag);
            /* Ajout dans hashtagEtTweet */
            $sth = $connection->prepare('SELECT * FROM "hashtag" WHERE mot =\''.$res[$i].'\'');
            $sth->execute();
            $result = $sth->fetch(PDO::FETCH_ASSOC);
        }

        $sth2 = $connection->prepare('INSERT INTO "hashtagEtTweet"(id_hashtag, id_tweet) VALUES (:id_hashtag, :id_tweet)');
        $sth2->bindValue(':id_hashtag', $result['id']);
        $sth2->bindValue(':id_tweet', $tweet->getId());
        $sth2->execute();
        $i++;
        //  echo "id TWEET =".$tweet->getId();
    }
}

/*
 * Renvoie l'id d'un hashtag, -1 sinon
 */
function getHashtagId($mot){
    global $connection;
    $sth = $connection->prepare('SELECT * FROM "hashtag" WHERE mot = \''.strtolower($mot).'\'');
    $sth->execute();
    $result = $sth->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        return $result['id'];
    }
    return -1;
}

/*
 * renvoie la liste des tweets contenant l'hashtag d'id $idH
 */
function getTweetsHashtag($idH){
    global $connection;
    $req = $connection->prepare('SELECT * FROM "hashtagEtTweet" JOIN "tweet" ON id_tweet=id WHERE id_hashtag = \''.$idH.'\' ORDER BY date_envoie DESC');
    $req->execute();
    $result = $req->fetch(PDO::FETCH_OBJ);
    $T = array();
    $i=0;
    while($result) {
        $T[$i][0] = getTweetLikes($result->id);

        $tweet = new Tweet\Tweet();
        $tweet->setAuteur($result->auteur)
            ->setContenu($result->contenu)
            ->setDate(new \DateTime($result->date_envoie))
            ->setId($result->id);

        $T[$i][1] = $tweet;
        $result = $req->fetch(PDO::FETCH_OBJ);

        $i++;
    }
    return $T;
}


/****************** MESSAGE ********************/
/*
 * ajoute un tweet
 * Renvoie le tweet qui vient d'être ajouter
 */
function ajoutMessage($content, $recepteur, $emetteur)
{
    global $messageManager;
    $date = new DateTime();
    $msg = new \Message\Message();

    $msg->setEmetteur($emetteur)
        ->setRecepteur($recepteur)
        ->setDate($date)
        ->setContenu($content);

    $messageManager->add($msg);

    return $msg;
}


/******************* Profil *****************/

function getNbAmis($id){
    global $connection;
    $nbamis_res = $connection->prepare('SELECT count(id) AS nb FROM "amis" WHERE personne2='.$id);
    $nbamis_res->execute();
    $nbamis = $nbamis_res->fetch(PDO::FETCH_OBJ);
    return $nbamis->nb;
}


function getNbTweet($id){
    global $connection;
    $nbtweet_res = $connection->prepare('SELECT count(id) AS nb FROM "tweet" WHERE auteur='.$id);
    $nbtweet_res->execute();
    $nbtweet = $nbtweet_res->fetch(PDO::FETCH_OBJ);
    return $nbtweet->nb;
}

function is_ami($id1,$id2){
    global $connection;
    $req = $connection->prepare("SELECT count(id) as nb FROM \"amis\" WHERE personne1 = $id1 AND personne2=$id2");
    $req->execute();
    $req = $req->fetch(PDO::FETCH_OBJ);
    return ($req->nb!=0);
}

function ajouteramis($id1,$id2){
    global $connection;
    $sth = $connection->prepare('INSERT INTO "amis"(personne1, personne2) VALUES (:id1, :id2)');
    $sth->bindValue(':id1', $id1);
    $sth->bindValue(':id2', $id2);
    $sth->execute();
}

function supprimeramis($id1,$id2){
    global $connection;
    $connection->exec("DELETE FROM \"amis\" WHERE personne1 = $id1 AND personne2=$id2");
}


