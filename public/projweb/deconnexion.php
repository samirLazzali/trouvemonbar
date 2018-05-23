<?php 

session_start();



if(!isset($_SESSION['status'])){
	echo "Vous n'êtes pas connecté<br/>";
	echo "Retour à la page d'<a href='main.html'>accueil</a>";
}
else{
	session_destroy();
	echo "Vous êtes bien déconnecté<br/>";
	echo "Retour à la page d'<a href='main.html'>accueil</a>";
}

?>