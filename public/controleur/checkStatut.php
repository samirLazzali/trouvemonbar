<?php
$statut = checkStatut($bdd);

if ($statut == 'utilisateur') {
	header('Location: utilisateur');
	exit(1);
}else if ($statut == 'admin') {
	header('Location: admin');
	exit(1);
}