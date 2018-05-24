<?php

function bandeau()
{
	echo '<header>';
	echo '<div class="connexion"> <a href="authentification.php">connexion</a></div>';
    echo '<img src="bandeau2.png" alt="" width="100%"/>';
	echo '</header>';
	echo '<nav>';
	echo '
	<div class="el"> <a href="index.php">accueil</a> </div> 
	<div class="el"> <a href="sorties.php">sorties</a> </div> 
	<div class="el"> <a href="boite_a_idees.php">boite à idées</a> </div> 
	<div class="el"> <a href="newsletter.php">newsletters</a> </div> 
	<div class="el"> <a href="liste_assoc.php">associations artistiques</a> </div> 
	<div class="el"> <a href="presentation.php">le bureau</a> </div>';
	print '</nav>';
}

?>

