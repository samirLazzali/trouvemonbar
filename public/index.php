<?php

session_start();
header('Content-type: text/html; charset = utf-8');
include('includes/config.php');

include('includes/functions.php');
actualiser_session();

$titre = '';


if(isset($_SESSION['id_user'])) {
    include('includes/connected_index.php');
}
else {
    include('includes/top.php'); ?>
    <div id="contenu">
        <p>
            Depuis 2018, la communauté CATisfaction vise à mettre en relation les différents amoureux des chats afin que leur compagnions
            préférés puisse eux aussi avoir droit à l'amour. Vous en avez marre des chaleurs de votre chatte, ou bien encore vous souhaitez que votre
            matou adoré vive lui aussi une grande romance, ce site est fait pour vous. Grâce à notre grande communauté d'utilisateurs, vous trouverez ici
            le partenaire idéal de votre félin et selon vos préférences grâce à notre système de recherche.<br/>

            CATisfaction : Le meilleur site de rencontre pour félins
            N'hésitez pas à vous <a href="membres/inscription.php">inscrire</a>
        </p>
    </div><?php
}

include('includes/bottom.php');
?>