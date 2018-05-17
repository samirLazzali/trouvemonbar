<?php

require "../../src/app/helpers.php";


$date = date("Y-m-d", time());
$userid = $_SESSION['user'];
$content = $_POST['content'];
$gameid = $_POST['gameid'];

if( ! ($id = Comment::insert_comment($date, $content, $gameid, $userid) ))
    flash("Erreur, le message n'a pas pu être ajouté");

redirect("../view_game.php?id=$gameid");
