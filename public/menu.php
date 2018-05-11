<?php
function menu_navigation()
{
    echo '<form method = "post" action = "changement_de_page.php" id = "menu_bouton" >';
    echo '<div class = "bouton" ><input type = "submit" class="button" name = "acc" value = "Accueil" ></div >';
    echo '<div class = "bouton" ><input type = "submit" class="button" name = "ap" value = "Apéral" ></div >';
    echo '<div class = "bouton" ><input type = "submit" class="button" name = "oe" value = "Oenologiie" ></div >';
    echo '<div class = "bouton" ><input type = "submit" class="button" name = "reu" value = "Réunion" ></div >';
    echo '<div class = "bouton" ><input type = "submit" class="button" name = "clas" value = "Classement" ></div >';
    echo '<div class = "bouton" ><input type = "submit" class="button" name = "adm" value = "Admin" ></div >';
    echo '</form>';
}

function menu_connexion(){
    echo '<form method = "post" action = "changement_de_page.php" id="boutons_connexion">';
    echo '<div classe="bouton"><input type="submit" class="button" name="co" value="Se connecter" ></div>';
    echo '<div classe="bouton"><input type="submit" class="button" name="ins" value="inscription" ></div>';
    echo '</form>';
}

function sous_menu_aperal(){
    echo '<form method = "post" class="sous_menu" action ="changement_de_page.php" id="boutons_aperal">';
    echo '<div classe="bouton"><input type="submit" class="button" name="propA" value="A propos" ></div>';
    echo '<div classe="bouton"><input type="submit" class="button" name="prepA" value="Préparatif" ></div>';
    echo '<div classe="bouton"><input type="submit" class="button" name="rec" value="Recettes" ></div>';
    echo '<div classe="bouton"><input type="submit" class="button" name="inta" value="Intendance" ></div>';
    echo '<div classe="bouton"><input type="submit" class="button" name="ava" value="Avis" ></div>';
    echo '</form>';
}