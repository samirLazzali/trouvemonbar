<?php

/* Ce fichier affiche l'onglet profil.*/

session_start() ;
include("pageAccueil.php") ;

enTete("Profil") ;

onglets() ;

fin_enTete() ;

arme() ;

password() ;


delete() ;



pied() ;


/* Affiche le boutton de changement d'arme permettant de passer d'une épée à un bâton de magie et inversement. (voir arme.php)*/
function arme() {
    echo ' <br/> <br/>
    <p><a href="arme.php"><input type="button" name="Changer d arme" value="Changer d arme" class="onglets" /></a></p>';

}


/* Champs texte permettant de changer de mot de passe. (voir password.php)*/
function password() {
    echo '<form action="password.php" method="post">';
    echo '     <p>  Ancien mot de passe :  <input type="password" size="20" maxlength="18" name="ancien_password" </p> ';
    echo '<br/>' ;
    echo '      Nouveau mot de passe : <input type="password" size="20" maxlength="18" name="password" />';
    echo ' </br> </br>   <input type="submit" value="Confirmer" name="modification" class="onglets" />';
    echo '</form>' ;

}


/* Affiche un boutton permettant la suppression du compte. (voir delete.php)*/
function delete() {
    echo ' <br/> <br/>
    <p><a href="delete.php"><input type="button" name="Supprimer le compte" value="Supprimer le compte" class="onglets" /></a></p>';

}