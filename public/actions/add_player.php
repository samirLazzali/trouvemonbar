<?php
require "../../src/app/helpers.php";
$userid = htmlspecialchars($_GET['user']);
$gameid = htmlspecialchars($_GET['game']);

if(!Auth::logged())redirect("../view_game.php?id=$gameid");

if(!Participation::insert_participation($userid, $gameid))
    flash("Erreur : le joueur n'a pas pu être ajouté");
