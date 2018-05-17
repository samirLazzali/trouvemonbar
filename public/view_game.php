<?php
/**
 * Created by PhpStorm.
 * User: jo
 * Date: 24/04/18
 * Time: 15:24
 *
 * Display the details for a single game
 * @todo display game details
 * @todo create an "add comment" button
 * @todo if the current user is the game's creator, display a "Add to the game" button next to each comment. This button adds the comment author to the game
 * @todo if the current user is the game's creator, display a "Start game" button at the bottom of the page. This button sets the game's status to "running",
 * @todo add the game to the google calendar, and sends an invite to each participant
 */
 
require "../src/app/models/Game.php";
require "../src/app/helpers.php";

    $gameid =$_GET['id'];

    // Si le paramètre id est manquant ou invalide
   if(empty( $gameid) or !is_numeric( $gameid)){

        include "../src/app/views/erreur_parametre_game.php";

    }
    else {



        //$infos_game = $gameid->__construct($gameid);
        $query = db()->prepare("SELECT * FROM game  natural join users WHERE  game.creator = users.userid AND gameid =?");
        $query->execute([$gameid]);
        $game_infos=$query->fetch();

        if($query->rowCount() != 1) throw  new  Exception("Game can't be found :".$gameid );
        else
            include "../src/app/views/game_view.php";


    }