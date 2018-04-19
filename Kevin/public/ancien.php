
<?php
<script type="text/javascript">
	function UpdateDialogue(){
		var Dialogue = 
                <?php
                    $sth = $connection->prepare('SELECT contenu FROM "message"');
                    $sth->execute();
                    $result = $sth->fetch(PDO::FETCH_OBJ);
                    echo '[';
                    while($result){
                        echo '"';
                        echo "$result->firstname" ;
                        echo '"';
                        $result = $sth->fetch(PDO::FETCH_OBJ);
                        if($result){
                             echo ',';
                        }
                     }
                    echo ']';
                    ?> ;   
        $result = 

	}

</script>


require '../src/Message/Message.php';


/* Recupération des users*/
require '../vendor/autoload.php';

//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new \User\UserRepository($connection);
$users = $userRepository->fetchAll();

$pseudo = Moi;
?>

/* Récupération des messages pour un user */
/*require '../vendor/autoload.php';

//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$messageRepository = new \Message\MessageRepository($connection);
$messages = $messageRepository->fetchAll();
*/



include("../src/Vue.php");
include("../src/Message/Message.php");

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
/*
foreach ($messages as $message) : 
	echo '<p>'.$message->getId().' ';
	echo $message->getEmetteur().' ';
	echo $message->getRecepteur().' ';
	echo $message->getContenu().'</p>';
endforeach;


*/




affiche_message($msg1);

pied();
?>