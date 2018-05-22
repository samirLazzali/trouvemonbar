<?php
include_once('modele/DataUser.class.php');
include_once('controleur/secure.php');
include_once('controleur/checkStatut.php');


$count = DataUser::countUser($bdd)->fetch();

$display_count = 10;

if ($count)
	$display_count = $count[0];

if (isset($_GET['count']))
	echo $display_count;
else
	include_once("vue/index.php");