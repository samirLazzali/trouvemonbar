<?php

include ("Vue.php");

    echo '<form action="valid.php" method="post">'.
        ajout_champ('text', '', 'identif', 'Identifiant', 'identif', 1).'<br/>'.
        ajout_champ('password', '', 'mdp', 'Mot de passe', 'mdp', 1).'<br/>'.
        "<fieldset>
	<legend>Choix:</legend>\n".
        ajout_champ("radio", "c", "choix", "Creation", "c", 1)."<br/>\n".
        ajout_champ("radio", "m", "choix", "Modification", "m", 1)."<br/>\n".
        ajout_champ("radio", "a", "choix", "Authentification", "m", 1)."<br/>\n".
        "</fieldset>\n".
        ajout_champ('submit', 'Envoyer', 'soumission', '', '', 0)."\n".
        '</form>';
if ($_SESSION['droits'] != null && $_SESSION['droits']==2) {
    print "<a href=\"change_droit.php\">Modification des droits</a><br/>\n";
}
print "<a href=\"index.php\">Menu</a><br/>\n";
?>