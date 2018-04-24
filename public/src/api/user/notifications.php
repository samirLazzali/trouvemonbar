<?php

require_once("../../config.php");
require_once("User.php");

$u = verify_logged_in();

$notifications = $u->getNotifications();

$appreciations = $notifications[0];
$mentions = $notifications[1];

foreach($appreciations as $appreciation)
{
    $appreciation->getAuthor();
    $appreciation->getPost();
}

var_dump($notifications);