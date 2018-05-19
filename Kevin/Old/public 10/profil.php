<?php
session_start();

require_once '../vendor/autoload.php';
require_once 'Vue.php';

//postgres
$dbName = getenv('DB_NAME');
	$dbUser = getenv('DB_USER');
	$dbPassword = getenv('DB_PASSWORD');
	$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
    //$userRepository = new User\UserRepository($connection);
	//$amisRepository = new Amis\AmisRepository($connection);
	//$tweetRepository = new Tweet\TweetRepository($connection);
	//$tweets=$tweetRepository->fetchAll();
	//$messageRepository = new Message\MessageRepository($connection);
	$tweetManager = new Tweet\TweetManager($connection);

if(isset($_POST['visite'])){ // si formulaire soumis
	$pseudo = $_POST['pseudo']; 
}
else{
	$pseudo = $_GET['pseudo'];

}

/*$sth = $connection->prepare('SELECT id FROM "user" WHERE firstname=\''.$pseudo.'\'');
    $sth->execute();
    $result = $sth->fetch(PDO::FETCH_OBJ);*/

$id = $_GET['id'];

/*
if(!$result){
    print "Profil Introuvable";
}
*/



enTete("Profil de $pseudo", "CSS/style.css");

afficheMenu();
?>



<?php

if(!empty($pseudo)){
	$sth = $connection->prepare('SELECT * FROM "tweet" WHERE auteur='.$id);
    $sth->execute();
    $result = $sth->fetch(PDO::FETCH_OBJ);
    print "Profil de $pseudo : </br> Dernier Tweets </br>";



    while($result){
        $tweet = new Tweet\Tweet();
        $tweet
            ->setId($result->id)
            ->setAuteur($result->auteur)
            ->setDate(new \DateTime($result->date_envoie))
            ->setContenu($result->contenu);

        $tweetManager->show_tweet(prenom_user($result->auteur),$tweet);
        $result = $sth->fetch(PDO::FETCH_OBJ);
    }
}

else{
		print "Champ Vide";
}

	
?>
	<br/>
	
	<a href="accueil.php">Retour </a>
	</body>
</html>