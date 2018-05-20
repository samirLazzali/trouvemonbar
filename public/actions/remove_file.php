<?php
require "../../src/app/helpers.php";
//redirect if userdoesnt have the rights
Auth::get_user();
if(!Auth::logged()) redirect("../index.php");
if(!Auth::user()->isAdmin()) redirect("../index.php");


if(isset($_GET['file']) && !empty($_GET['file'])) {
    $file = $_GET['file'];
    if(! ((new File($file))->remove()) )
        flash("Erreur : lefichier n'a pas été retiré");

}

if(isset($_GET['user']) && !empty($_GET['user'])) {
    $user = $_GET['user'];
    redirect("../user_files.php?user=$user");
}
redirect("../userlist.php");
