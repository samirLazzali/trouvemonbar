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
$messageRepository = new Message\MessageRepository($connection);
$tweets=$tweetRepository->fetchAll();
$tweetManager = new Tweet\TweetManager($connection);
$content = $_POST['textarea']; 
$pseudo = $_POST['pseudo']; 
$date = new DateTime();
$tweet = new Tweet\Tweet();
$tweet
                ->setAuteur($pseudo)
                ->setDate($date->format('Y-m-d H:i:s'))
                ->setContenu($content);

$tweetManager->add($tweet);
header("Location: accueil.php");
?>



