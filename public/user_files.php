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

    Auth::get_user();
    $isAdmin = Auth::user()->isAdmin();
    $userid=$_GET['user'];
    $myid=$_SESSION['user'];
    $filelist=File::filelist();
    $layout = new Layout("users");
    include view("files_view.php");
    $layout->show("List de fichier ");



