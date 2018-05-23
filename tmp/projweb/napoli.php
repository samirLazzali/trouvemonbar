<?php 

session_start();

if(!isset($_SESSION['pseudo'])){
	echo "Vous n'êtes pas connecté <br/>";
	echo "<a href='login.html'> Retour vers la page de login </a><br/>";
}

else{
	echo "<html>";
	echo "<head>";
	echo '<title>Espace membre</title>';
	echo 'Bienvenue ';
	echo $_SESSION['pseudo'];
	echo '</head>';
	echo '<body>';
    echo '!<br/>';
    echo '</body>';
    echo '</html>';
}
?>