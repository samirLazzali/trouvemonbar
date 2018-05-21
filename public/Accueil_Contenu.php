<?php
$eMan = new EvenementsManager($DB);

if (isset($_GET['categorie'])) 
	$events = $eMan->getAll($_GET['categorie']);
else 
	$events = $eMan->getAll();



foreach ($events as $e) {
	$pMan = new ParticipantsManager($DB);
	$nbParticipants = count($pMan->getAll($e->table_participants));

	echo "<div>";		
	echo '<div class="float-right" style="color : gray ; font-style : italic">' . $e->date_creation . '</div>';
	echo '<h2 class="page-header">' . $e->nom . '<br>';
	echo '<small style="color : gray ; font-style : italic"> le ' . $e->date . '</small>';
	echo '<a href="Accueil.php?categorie=' . $e->categorie .' " class="btn btn-outline-info float-right"">' . $eMan->getCategorie($e->categorie) . '</a>';
	echo '</h2>';
	if (strlen($e->description) > 0)
		echo '<br>';
	echo '<p>' . substr($e->description, 0, 150)  . '</p>';
	if (strlen($e->description) > 0)
		echo '<br>';
	echo '<a id="details" href="Evenement_Detaille.php?id=' . $e->id . '" class="btn btn-info">Détails<img src="images/arrow.png" height="30" width="30"></a>';
	$part;
	if ($nbParticipants == 0)
		$part = "Aucun participant";
	else if ($nbParticipants == 1)
		$part = "1 partipant";
	else
		$part = $nbParticipants . ' participants';
	echo '<p class="text-right" href="#">'. $part . '</p>';
	echo '</div><hr>';
}
?>



