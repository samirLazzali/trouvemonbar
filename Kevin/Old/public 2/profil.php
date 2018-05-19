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

$id = idUser($pseudo);

/*
if(!$result){
    print "Profil Introuvable";
}
*/



enTete("Profil de $pseudo", "CSS/style.css");
afficheMenu();

titreH1("Profil de $pseudo");


?>
<script src="fonctionsJS.js"></script>


<div class="conteneur">

<?php

if(!empty($pseudo)){
    $tweets = getTweetId($id);
    afficheListeTweets($tweets);
}
else{
		print "Champ Vide";
}



pied();
?>
