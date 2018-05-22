<?php
$statut = checkStatut($bdd);

if ($statut == 'invite' || $statut == 'utilisateur') {
	deconnect();
	header('Location: ../');
	exit(1);
}