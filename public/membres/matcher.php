<?php

session_start();
header('Content-type: text/html; charset = utf-8');
include('../includes/config.php');

include('../includes/functions.php');
actualiser_session();

$titre = 'Matcher';
include('../includes/mfunctions.php');
include('../includes/top.php');

echo $_SESSION['id_user'];
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connexion = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
$chatsPossedes = $connexion->query("SELECT id_cat, name_cat
                                              FROM Cats
                                              NATURAL JOIN Utilisateur
                                              WHERE id_user=".$_SESSION['id_user']);

while($chat=$chatsPossedes->fetch(PDO::FETCH_OBJ)){ # En gros on récupère sous forme d'un tableau de string la table à afficher pour chacun des chats du connecté
    $namesChatsPossedes[] = $chat->name_cat;
    $tabAff[] = affCompat($chat->id_cat);
}
#affMenu();
?>

<table id='matcher'>
    la table d'origine
</table>

<script>
    function affMatch() {
        var x = document.forms["choix"]["liste"].value;
        document.getElementById('matcher').innerHTML = "num" + tab[x];
    }

    var tab = <?php json_encode($tab); ?>;
/*
    <form NAME="choix">
        <select NAME="liste" onChange="affMatch()">
            <OPTION VALUE=0 > Choisir une option
            var i;
            for (i = 0; i<tab.lenght; i++) {
                <OPTION VALUE=i >chat
            }
        </select>
        <input type="submit" value="Matcher !">
    </form>
    */
</script>

<form NAME="choix">
        <select NAME="liste" onChange="affMatch()">
            <OPTION VALUE=0 > Choisir une option
            <?php
                if (!empty($tabAff)){
                    for ($i = 0; $i<sizeof($tabAff); $i++) {
                        echo '<OPTION VALUE='.$i.'>'.$namesChatsPossedes[$i];
                }
            }
            ?>
        </select>
        <input type="submit" value="Matcher !">
    </form>
<?php

include('../includes/bottom.php');
?>