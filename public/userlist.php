<?php
/**
 * Created by PhpStorm.
 * User: jo
 * Date: 06/05/18
 * Time: 01:01
 *
 * Display the list of this site's users.
 * @todo display the list
 * @todo clicking on a name leads to user_profile.php, passing the correct id via get.
 * @todo search bar (name, nick, games mastered)
 */

require "../src/app/helpers.php";


$userlist=User::userlist();
$layout = new Layout("users");
include view("user_list_view.php");
$layout->show("Tous les joueurs ");




