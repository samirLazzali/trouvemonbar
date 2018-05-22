<?php
include_once('../modele/DataUser.class.php');
include_once('modele/Newsletter.class.php');
include_once('../controleur/secure.php');
include_once('controleur/checkStatut.php');


$titre = 'Ajouter une nouvelle newsletter';

/*Supprimer une news*/
if (isset($_GET['supp'])) {
  $supp_news = (int) secureData($_GET['supp']);
  $connect_news = new Newsletter($bdd, $_SESSION['id']);

  $result = $connect_news->deleteNewsletter($supp_news);

  if (!$result || $result->rowCount() == 0) {
    header('Location: index.php');
    exit(1);
  }

}else if (isset($_POST['sujet']) && isset($_POST['message']) && !isset($_POST['edit'])) {
  /*Ajouter une nouvelle news*/
  $sujet = secureData($_POST['sujet']);
  $message = secureData($_POST['message']);

  if (!empty($sujet) && !empty($message)) {
    $connect_news = new Newsletter($bdd, $_SESSION['id']);
    $connect_news->newNewsletter($sujet, $message);
  }

}else if (isset($_POST['sujet']) && isset($_POST['message']) && isset($_POST['edit'])) {
  /*Changer une news*/
  $sujet = secureData($_POST['sujet']);
  $message = secureData($_POST['message']);
  $id_news = (int) secureData($_POST['edit']);

    if (!empty($sujet) && !empty($message) && !empty($id_news)) {
      $connect_news = new Newsletter($bdd, $_SESSION['id']);
      $connect_news->updateNewsletter($id_news,$sujet, $message);
    }

      header('Location: index.php');
      exit(1);
}

/*Variables d'édition*/
$edit = "";
$name_edit = "";

$sujet = "";
$message = "";

if (isset($_GET['edit'])) {
  $edit = secureData($_GET['edit']);
  $name_edit = "edit";

  $rep = Newsletter::getNewsletter($bdd, $edit);
  if ($rep) {
    $rep_fetch = $rep->fetch();

    $sujet = $rep_fetch['sujet'];
    $message = $rep_fetch['message'];

    $titre = 'Zone d\'édition';
  }

}
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
