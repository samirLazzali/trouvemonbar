<?php

session_start();

$prenom = $_SESSION['prénom'];
$id = $_SESSION['id'];

/* Recupération des users*/
require_once '../vendor/autoload.php';
require_once 'Vue.php';

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

/* MESSAGE MANAGER */
//$msgManager = new \Message\MessageManager($connection);




/************** VUE *****************/







?>

<html>
<script>
	function Conversation(){ /* PAS BON : FAIRE avec AJAX */
		var xhttp;
		xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
 			if (this.readyState == 4 && this.status == 200) {// 4 = request finished and response is ready, 200 = "OK"
 				var Res = this.responseText;
	 			var Msgs = Res.split(",,")
	 			var chat = document.getElementById("chatbox");
	 			chat.innerHTML = "";
                for(var i=0;i<Msgs.length;i++){
                    chat.innerHTML += Msgs[i];
                    chat.innerHTML += '</br></br>';
                }
                chat.scrollTop = chat.scrollHeight;

                /******************* ACTUALISATION AUTOMATIQUE ******************/
                window.setTimeout(" Conversation();", 1000*10, "JavaScript"); 		}
		};
		xhttp.open("GET", "Msg/Msg_Conversation.php?emetteur="+ document.getElementById('envoyer').value +"&recepteur=<?php echo $id; ?>" , true);
		xhttp.send();

	}

	function EnvoiMessage(){
		var Champ = document.getElementById("sendField");
		var Msg = Champ.value;
//console.log("test");

		var xhttp;
		if (Msg.length == 0) { 
			return;
		}
		xhttp = new XMLHttpRequest();
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {// 4 = request finished and response is ready, 200 = "OK"
                Conversation();
            }
        };
		xhttp.open("GET", "Msg/Msg_Envoie.php?m="+Msg+"&emetteur=<?php echo $id; ?>"+"&recepteur="+ document.getElementById('envoyer').value , true);
		xhttp.send(); 
		Champ.value = "";
	}


</script>

<head>
    <link rel="stylesheet" href="../CSS/style.css">
    <title>Mes messages (<?php echo $_SESSION['prénom']; ?>)</title>
</head>
<body>

<!-- <nav id="fontmenu">
    <ul id="menu">
        <li>
            <span class="nomsite">Twitiie</span>
        </li>
        <li>
            <a href="../accueil.php">Accueil</a>
        </li>
        <li>
            <a href=<?php //echo "../edition.php?pseudo=".$_SESSION['prénom'] ?>>Mon Profil</a>
        </li>
        <li>
            <a href="Msg_Ecrire.php">Message</a></br>

        </li>
    </ul>
</nav>
-->

<?php

    afficheMenu();
?>



<div class="conteneur">



<div class="chat_liste_amis">
    <?php
        listeDiscussion(get_friendList($id));
    ?>
</div>

<section>
<h1 id="h1"></h1>

<p id="dialogue"></p>

    <div>
        <div id="chatbox" class="chatbox"></div>
        <div>
            <input type="text" id="sendField" placeholder="Votre message ..." onkeypress="if (event.keyCode==13){EnvoiMessage();}" ></input>

            <button type="button" id="envoyer" onclick="EnvoiMessage()">Envoyer</button>
            <button onclick="Conversation();">Recharger</button>

        </div>
    </div>
</section>

</div>



<!-- <a href="../accueil.php?idLike=2">Retour à l'accueil</a><br> -->
<?php
pied();
?>





