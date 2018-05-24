<?php
include("Vue.php");
include ("db.php");

if ($_SESSION['droits'] != null && $_SESSION['droits']==2) {
    $db = db_connect();
    $pseudo = $_POST['pseudo'];
    $droits = $_POST['droits'];
    $id = $_POST['choix'];
    db_query($db, "UPDATE \"projet_bda\".\"Eleve\" SET droits='$droits' WHERE id_eleve='$id';");

    affiche_info("Compte de '$pseudo' modifié");

}
print "<a href=\"change_droit.php\">Gestion des droits</a><br/>\n";
print "<a href=\"index.php\">Menu</a><br/>\n";