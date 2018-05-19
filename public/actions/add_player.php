<?php
require "../../src/app/helpers.php";
$userid = htmlspecialchars($_GET['user']);
$gameid = htmlspecialchars($_GET['game']);

if(!Participation::insert_participation($userid, $gameid))
    flash("Erreur : le joueur n'a pas pu être ajouté");

redirect("../view_game.php?id=$gameid");