<?php
require '../vendor/autoload.php';
//postgres
$dbName = getenv('DB_NAME');
	$dbUser = getenv('DB_USER');
	$dbPassword = getenv('DB_PASSWORD');
	$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
    $userRepository = new User\UserRepository($connection);
	$amisRepository = new Amis\AmisRepository($connection);
	$tweetRepository = new Tweet\TweetRepository($connection);
	$tweets=$tweetRepository->fetchAll();
	$messageRepository = new Message\MessageRepository($connection);
	$tweetManager = new Tweet\TweetManager($connection);



if(isset($_POST['visite'])){ // si formulaire soumis
	$pseudo = $_POST['pseudo']; 
}
else{
	$pseudo = $_GET['pseudo'];
}





	
?>

<html>
	<head>
		
	</head>
	<body>

<?php

if(!empty($pseudo)){
	$sth = $connection->prepare('SELECT firstname FROM "user"');
    $sth->execute();
    $result = $sth->fetch(PDO::FETCH_OBJ);
    while($result){
      	if($pseudo==$result->firstname){
      		print "Profil de $pseudo : </br> Dernier Tweets </br>";
			$tweets = $tweetManager->get($pseudo);
			$tweet = $tweets->fetch(PDO::FETCH_OBJ);
			while($tweet){
				$tweetManager->show_tweet($tweet);
				$tweet = $tweets->fetch(PDO::FETCH_OBJ);
			}
			break;
      	}
        $result = $sth->fetch(PDO::FETCH_OBJ);
    }

    if(!$result){
    		print "Profil Introuvable";
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