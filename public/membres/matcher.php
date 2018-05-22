<?php

session_start();
header('Content-type: text/html; charset = utf-8');
include('../includes/config.php');

include('../includes/functions.php');
actualiser_session();

$titre = 'Matcher';
include('../includes/mfunctions.php');

include('../includes/toptop.php');


$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connexion = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
$chatsPossedes = $connexion->query("SELECT id_cat, name_cat
                                            FROM Cats
                                            WHERE owner=".$_SESSION['id_user']);
while($chat=$chatsPossedes->fetch(PDO::FETCH_OBJ)){ # En gros on récupère sous forme d'un tableau de string la table à afficher pour chacun des chats du connecté
  $namesChatsPossedes[] = $chat->name_cat;
  $tabAff[] = affCompat($chat->id_cat);
}

?>

<script>
  function affMatch() {
      var x = document.forms["choix"]["liste"].value;
      if (x==-1) {
          document.getElementById("matcher").innerHTML = "";
      } else {
          document.getElementById("matcher").innerHTML = <?php echo json_encode($tabAff); ?>[x];
      }
      /* myFunction(); */
  }
</script>

<?php
include('../includes/topbot.php');
?>


<div id="contenu">
    <form NAME="choix">
        <select NAME="liste" onChange="affMatch()">
            <OPTION VALUE=-1 > Choisir une option
            <?php
                if (!empty($tabAff)){
                    for ($i = 0; $i<sizeof($tabAff); $i++) {
                        echo '<OPTION VALUE='.$i.'>'.$namesChatsPossedes[$i];
                }
            }
        ?>
        </select>
    </form>

    <table id="matcher"></table>
</div>

<?php

include('../includes/bottom.php');
?>