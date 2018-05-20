<?php
/**
 * Created by PhpStorm.
 * User: jo
 * Date: 24/04/18
 * Time: 15:23
 *
 * This page is for displaying the list of games that users have created
 *
 * @todo query the list of all games and display it
 * @todo create a search function (systems, creators, table status)
 * @todo display looking for players only by default
 * @todo create game button
 * @todo if "create game" is disabled, a tooltip says "login to create your game" when mousing over the button
 */

require "../src/app/helpers.php";
$gamelist = Game::gamelist();

if(Auth::logged())
{
    $disabled="";

    Auth::get_user();
    $isAdmin=Auth::user()->isAdmin();

    $layout = new Layout("users");
    include view("game_list_view.php");
    $layout->show('Tables');
}
else {
    $disabled="disabled";
    $isAdmin = false;
    $layout = new Layout("visitors");
    include view("game_list_view.php");
    $layout->show('Tables');
}