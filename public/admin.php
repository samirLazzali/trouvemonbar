Dans la page dont on veut limiter l_affichage aux gens connectés:

    <?php
    require('control_connexion.php');
    ?>

control_connexion.php

    <?php
    session_start();
if ((!isset($_SESSION['login'])) || ($SESSION['login'] == ''))
    { echo '<p> Vous devez vous <a href="connexioon.php">connecter</a>.<p>'."\"
      exit();
}
