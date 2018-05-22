<?php
include_once('../modele/DataUser.class.php');
include_once('modele/Newsletter.class.php');
include_once('../controleur/secure.php');
include_once('controleur/checkStatut.php');

include_once('modele/Niveau.class.php');

$code = "";
$error = [
  "ok" => '<span class="ok">Modification réussi</span>',
  "invalid_data" => '<span class="error">Données invalides</span>',
  "error_bdd" => '<span class="error">Problème base de donnée</span>'
];

$niveau_o = new Niveau($bdd, $_SESSION['id']);

if (isset($_POST['nom_niveau']) && isset($_POST['s_niveau']) && isset($_POST['nombre_niveau'])) {
  $nom_niveau = secureData($_POST['nom_niveau']);
  $genre = secureData($_POST['s_niveau']);
  $nombre_niveau = (int) secureData($_POST['nombre_niveau']);


  /*Vérification de la validité des données utilisateurs*/
  if (in_array($genre, ['H', 'F']) && strlen($nom_niveau) < 255) {

    if ($niveau_o->newNiveau($nom_niveau, $nombre_niveau, $genre))
      $code = "ok";
    else
      $code = "error_bdd";
  }else
    $code = "invalid_data";
}else if (isset($_GET['delete'])) {
  $delete = (int) secureData($_GET['delete']);

  if ($niveau_o->deleteNiveau($delete))
    $code = "ok";
}

$niveaux = $niveau_o->getNiveaux()->fetchAll();

$genres = [
  "H" => 'Homme',
  "F" => 'Femme'
];

include_once("vue/niveau.php");

?>
