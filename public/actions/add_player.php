<?php
require "../../src/app/helpers.php";
$userid = $_GET['user'];
$gameid = $_GET['game'];

if(!Participation::insert_participation($userid, $gameid))
    flash("Erreur : le joueur n'a pas pu être ajouté");

redirect("../view_game.php?id=$gameid");