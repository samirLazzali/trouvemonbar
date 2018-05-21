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

?>

<script>
	function Conversation(){
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


<?php
    enTete("Mes messages", "../CSS/style.css");
    afficheMenu();
    titreH1("Mes messages privés");
?>


<div class="conteneur_chat">
<div class="chat_liste_amis">
    <?php
        listeDiscussion(get_friendList($id));
    ?>
</div>

<section>
<h1 id="h1"></h1>

    <p id="dialogue"></p>
    <div id="chat" style="display: none">
        <div id="chatbox" class="chatbox"></div>
        <div>
            <input type="text" id="sendField" placeholder="Votre message ..." onkeypress="if (event.keyCode==13){EnvoiMessage();}" ></input>

            <button type="button" id="envoyer" onclick="EnvoiMessage()">Envoyer</button>
            <button onclick="Conversation();">Recharger</button>

        </div>
    </div>
</section>

</div>


<?php
pied();
?>





