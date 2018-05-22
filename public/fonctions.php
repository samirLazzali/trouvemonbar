<?php
function debug($variable)
{
    echo '<pre>' . print_r($variable,true) . '</pre>';
}
function str_random($length)
{
    $alphabet="1234567890zertyuiopaqsdfghjklmwxcvbnAZERTYUIOPMLKJHGFDSQWXCVBN";
    return substr(str_shuffle(str_repeat($alphabet,$length)),0,$length);
}
function logged_only()
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['auth'])) {
        $_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'aller à cette page";
        header('Location: login.php');
        exit();
    }
}
function page_top($pagename)
{
    echo "<!DOCTYPE html>
<html>
    <head>
		<meta charset='UTF-8' />
		<title>".$pagename."</title>
		<link rel='stylesheet' href='index.css' type='text/css'>
	</head>
	
	<body>
	<div class='header'>
		<div class='title'><h2><a href='index.php'>Filigrane</a></h2></div>
			<div class='navbar'>
				<a href='index.php'>Accueil</a>
				<a href='Error404.php'>L'association</a>
				<div class='dropdown'>
					<button class='dropbtn'>Magic The Gathering
						<i class='fa fa-caret-down'></i>
					</button>
					<div class='dropdown-content'>
						<a href='Error404.php'>Règles</a>
						<a href='Error404.php'>Compétition</a>
						<a href='collection.php'>Collections</a>
						<a href='RechercheMagic.php'>Recherche de cartes</a>
					</div>
				</div>
				<div class='dropdown'>
					<button class='dropbtn'>Legend of the Five Rings
						<i class='fa fa-caret-down'></i>
					</button>
					<div class='dropdown-content'>
						<a href='Error404.php'>Premiers pas</a>
						<a href='Error404.php'>L'Univers de Rokugan</a>
						<a href='Error404.php'>Un peu de stratégie...</a>
					</div>
				</div>
				<div class='dropdown'>
					<button class='dropbtn'>Yu-Gi-Oh
						<i class='fa fa-caret-down'></i>
					</button>
					<div class='dropdown-content'>
						<a href='Error404.php'>Règles</a>
						<a href='Error404.php'>C'est l'heure du duel !</a>
						<a href='Error404.php'>...</a>
						<a href='Error404.php'>J'sais pas quoi écrire ici</a>
					</div>
				</div>
				<div class='dropdown'>
					<button class='dropbtn'>Mon Compte
						<i class='fa fa-caret-down'></i>
					</button>
					<div class='dropdown-content'>";
    if(isset($_SESSION['auth'])) {
        echo "<a href='account.php'>Mon profil</a>";
        echo "<a href='logout.php'>Se déconnecter</a>";
    }
    else echo "<a href='register.php'>S'inscrire</a><a href='login.php'>Se connecter</a>";
    echo "</div></div></div></div>";
}