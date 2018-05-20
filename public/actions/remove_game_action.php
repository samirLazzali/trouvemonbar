<?php
/**
 * Created by PhpStorm.
 * User: jo
 * Date: 20/05/18
 * Time: 14:03
 */
require "../../src/app/helpers.php";

//redirect if userdoesnt have the rights
Auth::get_user();
if(!Auth::logged()) redirect("../index.php");
if(!Auth::user()->isAdmin()) redirect("../index.php");

$game = new Game($_GET['game']);
if(!$game->remove()) flash("Erreur : la table n'a pas pu être retirée");

redirect("../games.php");
