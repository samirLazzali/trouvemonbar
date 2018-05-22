<?php
include_once('../modele/DataUser.class.php');
include_once('../admin/modele/Newsletter.class.php');
include_once('../controleur/secure.php');
include_once('controleur/checkStatut.php');

include_once('controleur/header.php');

/*Liste des news*/
$page = 0;
if (isset($_GET['page']))
  $page = (int) secureData($_GET['page']);

$step = 5;

$display_previous = "none";

if ($page > 0)
  $display_previous = "";

$newsletter_recup = Newsletter::getPagerNewsletter($bdd, $page * $step, ($page + 1) * $step);
$newsletter = [];

if ($newsletter_recup)
  $newsletter = $newsletter_recup->fetchAll();

if (!$newsletter && $page > 0) {
  header('Location: index.php');
  exit(1);
}

include_once("vue/index.php");

?>
