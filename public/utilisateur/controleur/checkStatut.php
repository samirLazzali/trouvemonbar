<?php
$statut = checkStatut($bdd);

if ($statut == 'invite') {
	header('Location: ../');
	exit(1);
}