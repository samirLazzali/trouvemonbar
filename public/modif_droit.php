<?php
include("Vue.php");
include ("db.php");

if ($_SESSION['droits'] != null && $_SESSION["droits"]==2){
    $db=db_connect();
    $pseudo=$_POST["pseudo"];
    $droits=$_POST["droits"];

    $res=db_query($db,"SELECT prenom,nom,pseudo,id_eleve FROM \"projet_bda\".\"Eleve\" JOIN \"projet_bda\".\"Personne\" ON \"Personne_identifiant\"=identifiant WHERE pseudo='$pseudo';");

    $i=0;
    echo '<form action="modif_droit_fin.php" method="post">'.
        "<fieldset>
        <legend>Choix:</legend>\n";

    db_fetch($res);
    $count=db_count($res);
    while ($i<$count){
        $recup=$res->fetch();
        $p=$recup->prenom;
        $ps=$recup->pseudo;
        $n=$recup->nom;
        echo ajout_champ("radio", $recup->id_eleve, "choix", "'$p' \"'$ps'\" '$n'", "c", 1)."<br/>\n";
        $i=$i+1;
    }
    echo "</fieldset>\n";
    echo ajout_champ('hidden',$pseudo,"pseudo","","pseudo",1);
    echo ajout_champ('hidden',$droits,"droits","","droits",1);
    echo ajout_champ('submit', 'Envoyer', 'soumission', '', '', 0)."\n".
    '</form>';
    db_close($res);
}
print "<a href=\"index.php\">Menu</a><br/>\n";