<?php

session_start();
include("vue.php");
include("config.php");
enTete("Terminer une annonce");
page_accueil();
page_connect();
page_inscription();
page_profil();
page_deconnection();

if (!isset($_POST["mailc"])){

    echo "<p> Renseigne le mail de celui a recupéré l'objet de l'annonce : </p>";
    echo $_SESSION["titre"];
    echo "<form action='terminer.php' method='post'>
         <input type='email' name='mailc' >
        <input type='submit' value='Terminer' name='terminer'> <input type='submit' value='Annuler' name='Annuler' formaction='index.php'>
        </form>";
}
else {
    $mailc=$_POST["mailc"];
    $date = date("Y-m-d");
    if ($_SESSION["type"]=='trouve') {


        $id = $_SESSION["id"];
        $query = $db->prepare(" DELETE FROM Trouve WHERE id=?");
        $query2 = $db->prepare(" DELETE FROM Objet WHERE id=?");
        $req =$db->prepare("INSERT INTO Termine (id,fin_date, mail_client) VALUES (:id,:fin, :mailc)");



        if( $req->execute(array('id'=>$id, 'fin'=>$date, 'mailc'=>$mailc))) {
            $req->closeCursor();
            if ($query->execute(array($id))){
                if($query2->execute(array($id))) {
                    $query->closeCursor();
                    $query2->closeCursor();

                    echo ' <h1 class="succes" align = "center">L\'annonce a été supprimée ! </h1></p> ';
                    unset($_SESSION["id"]);
                    unset($_SESSION["type"]);
                }
                else {
                    affiche_erreur("Réessaye!");
                }
            }
            else {
                affiche_erreur("Réessaye!");
            }
        }
        else{
            affiche_erreur("Réessaye, le mail ne correspond pas!");
        }

    }
    else if ($_SESSION["type"]=='vendre') {

        $id = $_SESSION["id"];
        $query = $db->prepare(" DELETE FROM Vendre WHERE id=?");
        $query2 = $db->prepare(" DELETE FROM Objet WHERE id=?");
        $req = $db->prepare("INSERT INTO Termine (id,fin_date, mail_client) VALUES (:id,:fin, :mailc)");

        if( $req->execute(array('id'=>$id, 'fin'=>$date, 'mailc'=>$mailc))) {
            $req->closeCursor();
            if ($query->execute(array($id))){
                if($query2->execute(array($id))) {
                    $query->closeCursor();
                    $query2->closeCursor();

                    echo ' <h1 class="succes" align = "center">L\'annonce a été supprimée ! </h1></p> ';
                    unset($_SESSION["id"]);
                    unset($_SESSION["type"]);
                }
                else {
                    affiche_erreur("Réessaye!2");
                }
            }
            else {
                affiche_erreur("Réessaye!1");
            }
        }
        else{
            affiche_erreur("Réessaye, le mail ne correspond pas!");
        }
    }

}