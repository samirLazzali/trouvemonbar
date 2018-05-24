<?php
/**
 * Created by PhpStorm.
 * User: mickael
 * Date: 22/05/18
 * Time: 13:56
 */

include("Vue.php");
include ("db.php");
include ("entete.php");

bandeau();
enTete("Liste des inscrits");

if ($_SESSION['droits'] != null && $_SESSION['droits']>=1) {
    $db = db_connect();
    $id = $_POST['id_sortie'];
    $res = db_query($db, "SELECT pseudo FROM \"projet_bda\".\"Eleve_participe_Sortie\" JOIN   \"projet_bda\".\"Eleve\" ON id_eleve = \"Eleve_id_eleve\" WHERE \"Sortie_id_sortie\"='$id';");
    db_fetch($res);
    $count = db_count($res);
    $i = 0;
    while ($i < $count)
    {
        $i = $i + 1;
        $ligne = $res->fetch();
        affiche_info($ligne->pseudo);
    }


}
?>