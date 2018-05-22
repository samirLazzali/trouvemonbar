<?php
session_start();
$_SESSION['id'] = 2;
function chargerClasse($classe) {
	require $classe . '.php';
}
if (empty($_SESSION['id']))
{
	//header("Location: connexion.php");
}

spl_autoload_register('chargerClasse');
?>
<!DOCTYPE html>
<html>
<head>
	<?php include "upperBar.php";
	$dbName = getenv('DB_NAME'); 
	$dbUser = getenv('DB_USER'); 
	$dbPassword = getenv('DB_PASSWORD'); 
	$DB = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
	
	$eMan = new EvenementsManager($DB);
	$e = $eMan->getId($_GET['id']);
	$uMan = new UserManager($DB);
	$pMan = new ParticipantsManager($DB);

	if (isset($_GET['inscription'])) {
		$pMan->add($_SESSION['id'], $e->table_participants);
	}
	if (isset($_GET['desinscription'])) {
		$pMan->remove($_SESSION['id'], $e->table_participants);
	}

	?>
	<title> <?= $e->nom ?></title>
	<metac charset="utf-8">
	<script src="Evenement_Detaille.js"> </script>
	<link rel="stylesheet" type="text/css" href="Evenement_Detaille.css">
	<link rel="stylesheet" type="text/css" href="main.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
	
</head>
<body>
	<div class="container">
	<h4>  <?= $e->nom ?> </h4>
	<br/>
	<h4>  Organisateur  </h4>
	<p>  <?= $uMan->getId($e->organisateur)->firstname . ' ' . $uMan->getId($e->organisateur)->lastname ?></p>
	<br/>
	<h4>Participants </h4>
	<ul class="list-group">
    	<?php

    	$participants = $pMan->getAll($e->table_participants);
    	$participe = false;
    	foreach ($participants as $p) {
    		if ($p->id == $_SESSION['id']){
    			$participe = true;
    			echo '<li class="list-group-item list-group-item-success">' . $p->firstname . ' ' . $p->lastname  . '</li>';
    		}
    		else
    			echo '<li class="list-group-item">' . $p->firstname . ' ' . $p->lastname  . '</li>';
    	}
    	?> 
	</ul>
	<br/>
	<h4> Lieu de l'événement : </h4>
	<p> <?= $e->lieu ?></p>
	<br/>
	<h4> Prix de la participation :  </h4>
	<p> <?= $e->prix ?></p>
	<br/>
	<h4> Description  </h4>
	<br/>
	<p> <em> <?=$e->description ?></em> </p>
	<br/>
	<h4> Catégorie : </h4>
	<p><?= $eMan->getCategorie($e->categorie) ?></p>
	<br/>
	<h4> Type de musique : </h4>
	<p> <?= $eMan->getMusique($e->musique) ?></p>
	<br/>

	<?php
	if (!$participe) {
		echo '<center><a class = "btn btn-success btn-lg" href="Evenement_Detaille.php?id='. $_GET['id'] . '&inscription=1" style="margin: 0 auto"> Participer</center></a>';
	}
	else
		echo '<center><a class = "btn btn-danger btn-lg" href="Evenement_Detaille.php?id='. $_GET['id'] . '&desinscription=1"> Se désinscrire</a></center>';
	?>
	<br><br><br>
	
</div>

</body>
</html>