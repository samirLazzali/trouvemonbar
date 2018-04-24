
<?php
$pseudo = $_POST['pseudo'];


/************** VUE *////////////////////////s
function enTete($titre, $style)
{
	print "<!DOCTYPE html>\n";
	print "<html>\n";
	print "  <head>\n";
	print "    <meta charset=\"utf-8\" />\n";
	print "    <title>$titre</title>\n";
	print "    <link rel=\"stylesheet\" href=\"$style\"/>\n";
	print "  </head>\n";

	print "  <body>\n";
	print "    <header><h1> $titre </h1></header>\n";
}

function pied(){
	print "  </body>\n";
	print "</html>";
}

function affiche($str) {
	echo $str;
}


function affiche_info($str) {
	echo '<p>'.$str.'</p>';
}

function affiche_erreur($str) {
	echo '<p class="erreur">'.$str.'</p>';
}


/* Fonctions pour messages */

function affiche_message($message){
    echo 'Message de '.$message->getEmetteur().' à '.
    ($message->getDate())->format('H:i:s').' le '.
    ($message->getDate())->format('Y-m-d').': ';
    echo $message->getContenu();
}




/* Recupération des users*/
require '../vendor/autoload.php';
require '../src/Message/MessageRepository.php';
require '../src/Message/MessageManager.php';

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

$msg1->setEmetteur("Dupont");
$msg1->setRecepteur($users['1']->getFirstname());
$msg1->setDate(new DateTime);
$msg1->setContenu("Bonjour, comment tu vas?");



/*foreach ($users as $user) : 
	echo '<p>'.$user->getId().' ';
	echo $user->getFirstname().' ';
	echo $user->getLastname().' ';
	echo $user->getAge().' years'.'</p>';
endforeach;*/

/*
foreach ($messages as $message) : 
	affiche_message($message);
endforeach;

*/

//affiche_message($msg1);




//$msgManager->add($msg1);

/* A MODIFIER */
$recepteur = "Otis";

/* MESSAGE MANAGER */
$msgManager = new \Message\MessageManager($connection);


?>

<html>
<script>
	function Conv(){

		var Msgs = <?php
					$messageRepository = new \Message\MessageRepository($connection);
					$messages = $messageRepository->fetchAll();
					$n = count($messages);
					echo '[';
					for ($k=$n-6; $k<$n; $k++){
						echo '"';
						echo affiche_message($messages[$k]);
						echo '"';
						if ($k != $n-1){
							echo ",";
						}
					}
					echo ']';

                    ?> ;
		
		document.getElementById("m1").innerHTML = Msgs[0];
		document.getElementById("m2").innerHTML = Msgs[1];
		document.getElementById("m3").innerHTML = Msgs[2];
		document.getElementById("m4").innerHTML = Msgs[3];
		document.getElementById("m5").innerHTML = Msgs[4];
		document.getElementById("m6").innerHTML = Msgs[5];
	}

	function EnvoiMessage(){
		var Champ = document.getElementById("msg");
		var Msg = Champ.value;
//console.log("test");

		var xhttp;
		if (Msg.length == 0) { 
			return;
		}
		xhttp = new XMLHttpRequest();
		xhttp.open("GET", "EnvoieMsg.php?m="+Msg+"&pseudo=<?php echo $pseudo; ?>", true);
		xhttp.send(); 
		Champ.value = "";

		/* Rechargement des msgs*/
				document.getElementById("m1").innerHTML = Msg;

	}	

</script>

<body onLoad="Conv()">


<h1 id="h1">Mes conversations: <?php echo $pseudo ?></h1> 

<p id="dialogue"></p>

<div id="chatbox" class="chatbox" disabled="disabled">

	<ul>
		<li id="m1"></li>
		<li id="m2"></li>
		<li id="m3"></li>
		<li id="m4"></li>
		<li id="m5"></li>
		<li id="m6"></li>
	</ul>
	
</div>	


<div>
	<textarea id="msg" placeholder="Votre message ..." rows="5" cols="50"></textarea>

	<button type="button" onclick="EnvoiMessage(); Conv();">Envoyer</button>
</div>




<?php
pied();
?>





