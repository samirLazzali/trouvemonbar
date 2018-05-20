<?php
/**
 * Created by PhpStorm.
 * User: jo
 * Date: 20/05/18
 * Time: 13:49
 */
require "../../src/app/helpers.php";

//redirect if userdoesnt have the rights
Auth::get_user();
if(!Auth::logged()) redirect("../index.php");
if(!Auth::user()->isAdmin()) redirect("../index.php");

$game = $_GET['game'];
$commentid = $_GET['comment'];
if(!Comment::remove_comment($commentid))
    flash("Erreur : le commentaire n'a pas pu être retiré");

redirect("../view_game.php?id=$game");