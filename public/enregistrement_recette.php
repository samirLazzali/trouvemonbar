<?php

	session_start();

	function connexion(){

		$dbName = getenv('DB_NAME');
		$dbUser = getenv('DB_USER');
		$dbPassword = getenv('DB_PASSWORD');
		$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

		return $connection;

	}


	function enregistrer_recette($id_auteur, $id_type, $titre, $ingredients, $instructions, $done, $pub){

		if (isset($_POST['id_auteur']) && isset($_POST['id_type']) && isset($_POST['titre']) && isset($_POST['ingredients']) && isset($_POST['instructions']) && isset($_POST['done']) && isset($_POST['pub'])) {

			$bdd = connexion();

			$req = $bdd -> prepare('INSERT INTO recette(id_auteur, id_type, titre, ingredients, instructions, done, pub) VALUES(?, ?, ?, ?, ?, ?, ?)');

			$req->execute(array($_POST['id_auteur'], $_POST['id_type'], $_POST['titre'], $_POST['ingredients'], $_POST['instructions'], $_POST['done'], $_POST['pub']));

			return true;
		}

		return false;
	}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="initial-scale=1.0">
  <title>index</title>
  <link href="http://fonts.googleapis.com/css?family=Montserrat:400,400|Kite+One:400,400" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/standardize.css">
  <link rel="stylesheet" href="css/index-grid.css">
  <link rel="stylesheet" href="css/index.css">
</head>
<body class="body page-index clearfix">
  <div class="photo_accroche clearfix">
    <header class="cuisine clearfix">
      <div class="logo"></div>
      <p class="accroche">L'association des fins gourmets de l'ENSIIE !</p>
<?php
        if(!isset($_SESSION['membre_id']))
        {
?>
            <div onClick="window.location.href='./membres/connexion.php';" class="connexion connexion-1 clearfix">
            <p class="connexion">Connexion</p>
            </div>
            <div onClick="window.location.href='./membres/inscription.php';" class="inscription inscription-1 clearfix">
                <p class="inscription">Inscription</p>
            </div>
            <?php
        }
        else
        {
            ?>
            <div onClick="window.location.href='./membres/moncompte.php';" class="connexion connexion-1 clearfix">
                <p class="connexion">Mon compte</p>
            </div>
            <div onClick="window.location.href='./membres/deconnexion.php';" class="connexion connexion-1 clearfix">
            <p class="connexion">Deconnexion</p>
            </div>
            <?php
        }
        ?>



      <nav class="navigation clearfix">
        <div onClick="window.location='index.php';" class="accueil accueil-1 clearfix">
          <p class="accueil">Accueil</p>
        </div>
        <div onClick="window.location='menu.php';" class="menu menu-1 clearfix">
          <p class="menu">Menu</p>
        </div>
        <div onClick="window.location='reservation.php';" class="reservation reservation-1 clearfix">
          <p class="reservation">Réservation</p>
        </div>
        <div onClick="window.location='catalogue.php';" class="recettes recettes-1 clearfix">
          <p class="recettes">Recettes</p>
        </div>
      </nav>
    </header>
 <div class="proposition clearfix">
<?php

if (isset($_POST['id_auteur']) && isset($_POST['id_type']) && isset($_POST['titre']) && isset($_POST['ingredients']) && isset($_POST['instructions']) && isset($_POST['done']) && isset($_POST['pub']))
{
    if (enregistrer_recette($_POST['id_auteur'], $_POST['id_type'], $_POST['titre'], $_POST['ingredients'], $_POST['instructions'], $_POST['done'], $_POST['pub'])) {
        $_SESSION['proposition'] = true;
        ?>
        <h1>Recette validée !</h1>
        <?php
    }
    else
        {
            ?>
            <h1>Recette refusée !</h1>
            <?php
        }
}
else
{
    ?>
    <h1>Recette refusée !</h1>
    <?php
}

?>
</div>
