
<?php
require '../src/Message/Message.php';

include("../src/Vue.php");


/* Recupération des users*/
require '../vendor/autoload.php';

//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new \User\UserRepository($connection);
$users = $userRepository->fetchAll();

include '../src/Message/MessageRepository.php';
$messageRepository = new \Message\MessageRepository($connection);
$messages = $messageRepository->fetchAll();

$pseudo = Moi;




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

foreach ($messages as $message) : 
	echo '<p>'.$message->getId().' ';
	echo $message->getEmetteur().' ';
	echo $message->getRecepteur().' ';
	echo $message->getContenu().'</p>';
endforeach;







affiche_message($msg1);

pied();
?>



