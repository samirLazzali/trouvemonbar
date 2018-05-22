<?php
/**
 * Created by PhpStorm.
 * User: jo
 * Date: 24/04/18
 * Time: 15:23
 *
 * This page is used by a user to review his own files, or to check another user's public files
 */
    require "../src/app/helpers.php";

if(!Auth::logged())
    redirect("index.php");

//is the user looking at the page admin
Auth::get_user();
$me = Auth::user();
$isAdmin = $me->isAdmin();

//is the user looking at the page the owner of the account
$userid=$_GET['user'];
$myid=$_SESSION['user'];

//list of users file
try {
    $filelist = (new User($userid))->hisfiles();
}catch(Exception $e)
{
    error_log($e);
}

$layout = new Layout("users");
include view("files_view.php");
$layout->show("List de fichier ");



