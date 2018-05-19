<?php
/**
 * Created by PhpStorm.
 * User: jo
 * Date: 06/05/18
 * Time: 16:03
 */
//add the game to the db
require "../../src/app/helpers.php";

$gamename = htmlspecialchars($_POST["gamename"]);
$gamedesc = htmlspecialchars($_POST["gamedesc"]);
$duration = htmlspecialchars($_POST["duration"]);
$gamesystemid = htmlspecialchars($_POST["gamesystem"]);
$creator = htmlspecialchars($_POST["creator"]);

if(isset($_POST["oneshots"]))
    $oneshots = $_POST["oneshots"];
else
    $oneshots = false;

if(isset($_POST["reccurents"]))
    $reccurents = $_POST["reccurents"];
else
    $reccurents = false;

//try to insert the game : store the $id if successful
if( ($id = Game::insert_game( $gamename, $gamedesc, $duration, $gamesystemid, $creator )) !== false )
{
    //for each schedule in the hidden field, get this schedule info

    if($oneshots !== false) {

        //insert each oneshot
        foreach ($oneshots as $oneshot) {
            $data = json_decode($oneshot, true);
            $success = Schedule::insert_oneshot($data['date'], $data['starttime'], $data['endtime'], $id);
            if(!$success) flash("Erreur : un horaire de oneshot na pas ete ajoute");
        }
    }

    //insert each reccurent schedule
    if($reccurents !== false) {
        foreach ($reccurents as $reccurent) {
            $data = json_decode($reccurent, true);
            $success = Schedule::insert_reccurent($data['dayofweek'], $data['reccurence'], $data['starttime'], $data['endtime'], $id);
            if(!$success) flash("Erreur : un horaire recurrent n'a pas ete insere");


        }
    }

    //send the mail notification
   if(! (Mail::game_created(new Game($id))) )
       flash("Erreur : le mail n'a pas pu être envoye");

}
else
    flash("Erreur : la table n'a pas pu être ajoutée");


redirect("../games.php");


