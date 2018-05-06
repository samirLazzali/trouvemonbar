<?php

require "../src/app/helpers.php";

if(Auth::logged())
{
    $layout = new Layout("users");
    include view("index_view.php");
    $layout->show('Guiilde');
}
else {
    $layout = new Layout("visitors");
    include view("index_view.php");
    $layout->show('Guiilde');
}




