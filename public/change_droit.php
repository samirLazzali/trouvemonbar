<?php
include("Vue.php");


if ($_SESSION['droits']==2) {
    affiche_info("Changement des droits.");
    echo '<form action="modif_droit.php" method="post">' .
        ajout_champ('text', '', 'pseudo', 'Pseudo a modifier', 'pseudo', 1) . '<br/>' .
        '<label for="droits">Nouveux droits (0=eleve, 1=BdA, 2=Prez)</label><input name="droits" id="droits" type="number" min = "0" max="2" />' . '<br/>' .
        ajout_champ('submit', 'Envoyer', 'soumission', '', '', 0) . "\n" .
        '</form>';

}
print "<a href=\"index.php\">Menu</a><br/>\n";