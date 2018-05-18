<?php
function menu_navigation()
{
    echo '<nav class="gtco-nav" role="navigation">';
    echo '<div class="gtco-container">';
    echo '<div class="row">';
    echo '<div class="col-sm-4 col-xs-12">';
    echo '<div id="gtco-logo"><a href="index.html">Apéral <em>-</em> Oenologiie</a></div>';
    echo '</div>';
    echo '<div class="col-xs-8 text-right menu-1">';
    echo '<ul>';
    echo '<li><a href="index.php">Accueil</a></li>';
    echo '<li><a href="a_propos_aperal.php">Apéral</a></li>';
    echo '<li><a href="a_propos_oeno.php">Oenologiie</a></li>';
    echo '<li><a href="reunion.php">Réunions</a></li>';
    echo '<li><a href="classement.php">Classement</a></li>';
    echo '<li><a href="profil.php">Profil</a></li>';
    echo '<li><a href="admin.php">Admin</a></li>';
    echo '<li class="btn-cta"><a href="reunion.php"><span>PUTE</span></a></li>';
    echo '<li class="btn-cta"><a href="reunion.php"><span>PUTE (2)</span></a></li>';
    echo '</ul>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</nav>';
    /*
    echo '<form method = "post" action = "changement_de_page.php" id = "menu_bouton" >';
    echo '<li><div class = "" ><input type = "submit" class="button" name = "acc" value = "Accueil" ></div ></li>';
    echo '<div class = "bouton" ><input type = "submit" class="button" name = "ap" value = "Apéral" ></div >';
    echo '<div class = "bouton" ><input type = "submit" class="button" name = "oe" value = "Oenologiie" ></div >';
    echo '<div class = "bouton" ><input type = "submit" class="button" name = "reu" value = "Réunion" ></div >';
    echo '<div class = "bouton" ><input type = "submit" class="button" name = "clas" value = "Classement" ></div >';
    echo '<div class ="bouton" ><input type = "submit" class="button" name ="profil" value = "Profil" ></div >';
    echo '<div class = "bouton" ><input type = "submit" class="button" name = "adm" value = "Admin" ></div >';
    echo '</form>';
     */
}

function menu_connexion(){
    echo '<form method = "post" action = "changement_de_page.php" id="boutons_connexion">';
    echo '<div class="bouton"><input type="submit" class="button" name="co" value="Se connecter" ></div>';
    echo '<div class="bouton"><input type="submit" class="button" name="ins" value="inscription" ></div>';
    echo '</form>';
}

function sous_menu_aperal(){
    echo '<form method = "post" class="sous_menu" action ="changement_de_page.php" id="boutons_aperal">';
    echo '<div class="bouton"><input type="submit" class="button" name="propA" value="A propos" ></div>';
    echo '<div class="bouton"><input type="submit" class="button" name="prepA" value="Préparatif" ></div>';
    echo '<div class="bouton"><input type="submit" class="button" name="rec" value="Recettes" ></div>';
    echo '<div class="bouton"><input type="submit" class="button" name="inta" value="Intendance" ></div>';
    echo '<div class="bouton"><input type="submit" class="button" name="ava" value="Avis" ></div>';
    echo '</form>';
}

function sous_menu_oenologie(){
    echo '<form method = "post" class="sous_menu" action ="changement_de_page.php" id="boutons_aperal">';
    echo '<div class="bouton"><input type="submit" class="button" name="propO" value="A propos" ></div>';
    echo '<div class="bouton"><input type="submit" class="button" name="prepO" value="Préparatif" ></div>';
    echo '<div class="bouton"><input type="submit" class="button" name="avO" value="Avis" ></div>';
    echo '<div class="bouton"><input type="submit" class="button" name="vin" value="Liste des vins" ></div>';
    echo '</form>';
}
