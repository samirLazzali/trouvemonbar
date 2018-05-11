<?php
function menu_navigation()
{
    echo '<form method = "post" action = "changement_de_page.php" id = "menu_bouton" >';
    echo '<div classe = "bouton" ><input type = "submit" name = "acc" value = "Accueil" ></div >';
    echo '<div classe = "bouton" ><input type = "submit" name = "ap" value = "Apéral" ></div >';
    echo '<div classe = "bouton" ><input type = "submit" name = "oe" value = "Oenologiie" ></div >';
    echo '<div classe = "bouton" ><input type = "submit" name = "reu" value = "Réunion" ></div >';
    echo '<div classe = "bouton" ><input type = "submit" name = "clas" value = "Classement" ></div >';
    echo '<div classe = "bouton" ><input type = "submit" name = "adm" value = "Admin" ></div >';
    echo '</form>';
}

function menu_connexion(){
    echo '<form method = "post" action = "changement_de_page.php" id="boutons_connexion">';
    echo '<div classe="bouton"><input type="submit" name="co" value="Se connecter" ></div>';
    echo '<div classe="bouton"><input type="submit" name="ins" value="S\'inscrire" ></div>';
    echo '</form>';
}
