<?php
/**
 * Created by PhpStorm.
 * User: jo
 * Date: 24/04/18
 * Time: 15:24
 *
 * Display the details for a single game
 * @todo if the current user is the game's creator, display a "Start game" button at the bottom of the page. This button sets the game's status to "running",
 * @todo add the game to the google calendar, and sends an invite to each participant
 */

require "../src/app/helpers.php";


if(Auth::logged()) {

    $gameid = $_GET['id'];

    // Si le paramètre id est manquant ou invalide
    if (empty($gameid) or !is_numeric($gameid) or !isset($gameid))
        error("404");

    else {

        try {
            $game = new Game($gameid);
            $creator = new User($game->getCreator());
        } catch (Exception $e) {
            error("500", $e->getMessage());
        }

        $oneshots = $game->one_shot_schedules();
        $reccurrents = $game->reccurrent_schedules();
        $comments = $game->comments();
        $players = $game->players();
        $isOwner = $game->getCreator() == $_SESSION['user'];

        $layout = new Layout("users");
        include view("game_view.php");
        $layout->show($game->getName());

    }
}
else {
    $gameid = $_GET['id'];

    // Si le paramètre id est manquant ou invalide
    if (empty($gameid) or !is_numeric($gameid) or !isset($gameid))
        error("404");

    else {

        try {
            $game = new Game($gameid);
            $creator = new User($game->getCreator());
        } catch (Exception $e) {
            error("500", $e->getMessage());
        }

        $oneshots = $game->one_shot_schedules();
        $reccurrents = $game->reccurrent_schedules();
        $comments = $game->comments();
        $players = $game->players();
        $isOwner = false;

        $layout = new Layout("visitors");
        include view("game_view.php");
        $layout->show($game->getName());
    }
}

