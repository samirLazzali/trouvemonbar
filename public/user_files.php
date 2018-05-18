<?php
/**
 * Created by PhpStorm.
 * User: jo
 * Date: 24/04/18
 * Time: 15:23
 *
 * This page is used by a user to review his own files, or to check another user's public files
 * @todo display the list of the user's files. The user id is passed via get method.
 */
    require "../src/app/helpers.php";
    require "../src/app/models/File.php";

if(!Auth::logged())
    redirect("index.php");

    $userid=$_GET['user'];
    $myid=$_SESSION['user'];
    $filelist=\User\File::filelist();
    $layout = new Layout("users");
    include view("files_view.php");
    $layout->show("List de fichier ");



