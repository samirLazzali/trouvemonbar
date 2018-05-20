<?php

require "../../src/app/helpers.php";

if(!Auth::logged()) redirect("../view_game.php?id=$gameid");


$date = date("Y-m-d", time());
$userid = $_SESSION['user'];
$content = htmlspecialchars($_POST['content']);
$gameid = htmlspecialchars($_POST['gameid']);

//can't add an empty comment
if($content == "") redirect("../view_game.php?id=$gameid");


if( ! ($id = Comment::insert_comment($date, $content, $gameid, $userid) ))
    flash("Erreur, le message n'a pas pu être ajouté");

redirect("../view_game.php?id=$gameid");
