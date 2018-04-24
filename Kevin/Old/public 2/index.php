
<?php

include("../src/Vue.php");


/* Recupération des users*/
require '../vendor/autoload.php';
require '../src/Message/MessageRepository.php';

//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new \User\UserRepository($connection);
$users = $userRepository->fetchAll();

$messageRepository = new \Message\MessageRepository($connection);
$messages = $messageRepository->fetchAll();





//enTete("Vos Messages", "CSS/stylesheet1.css");
$msg1 = new \Message\Message();

//$msg1->setEmetteur();
$msg1->setRecepteur($users['1']->getFirstname());
$msg1->setDate(new DateTime);
$msg1->setId(1);
$msg1->setContenu("Bonjour, comment tu vas?");



foreach ($users as $user) : 
	echo '<p>'.$user->getId().' ';
	echo $user->getFirstname().' ';
	echo $user->getLastname().' ';
	echo $user->getAge().' years'.'</p>';
endforeach;

echo 'MESSAGES : ';

foreach ($messages as $message) : 
	affiche_message($message);
endforeach;


affiche_message($msg1);










pied();
?>



