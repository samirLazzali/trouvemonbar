<?php

session_start();
include("vue.php");
include("config.php");
enTete("Suppression");
page_accueil();
page_connect();
page_inscription();
page_profil();
page_deconnection();


if (!isset($_POST["oui"])){
    echo "<p> Veux-tu vraiment supprimer l'annonce suivante : </p>";
    echo $_SESSION["titre"];
    echo "<form action='supprimer.php' method='post'>
        <input type='submit' value='Oui' name='oui'> <input type='submit' value='Non' name='non' formaction='index.php'>
        </form>";
}
else {

    if ($_SESSION["type"]=='trouve') {

        $id = $_SESSION["id"];
        $query = $db->prepare(" DELETE FROM Trouve WHERE id=?");
        $query2 = $db->prepare(" DELETE FROM Objet WHERE id=?");
        if ($query->execute(array($id)) && $query2->execute(array($id))) {
            $query->closeCursor();
            $query2->closeCursor();
            echo ' <h1 class="succes" align = "center">L\'annonce a été supprimée ! </h1></p> ';
            unset($_SESSION["id"]);
            unset($_SESSION["type"]);
        }
        else{
            affiche_erreur("Réessaye!");
        }

    }
    else if ($_SESSION["type"]=='vendre') {
        $id = $_SESSION["id"];
        $query = $db->prepare(" DELETE FROM Vendre WHERE id=?");
        $query2 = $db->prepare(" DELETE FROM Objet WHERE id=?");
        if ($query->execute(array($id))&& $query2->execute(array($id))) {
            $query->closeCursor();
            $query2->closeCursor();

            echo ' <h1 class="succes" align = "center">L\'annonce a été supprimée ! </h1></p> ';
            unset($_SESSION["id"]);
            unset($_SESSION["type"]);
        }
        else{
            affiche_erreur("Réessaye!");
        }
    }

}
