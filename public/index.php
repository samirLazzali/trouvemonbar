<?php

session_start();
header('Content-type: text/html; charset = utf-8');
include('includes/config.php');

include('includes/functions.php');
actualiser_session();

$titre = '';

include('includes/top.php'); 
?>

		<div id="contenu">
			<p>Le meilleur site de rencontre pour félins
			N'hésitez pas à vous <a href="membres/inscription.php">inscrire</a>
			</p>
		</div>
<?php  
include('includes/bottom.php');
?>