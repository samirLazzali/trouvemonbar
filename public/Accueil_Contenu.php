<?php

$eMan = new EvenementsManager($DB);
$events = $eMan->getAll();

foreach ($events as $e) {
	# code...
}



