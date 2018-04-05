<?php

require_once("User.php");
require_once("Post.php");
require_once("Appreciation.php");

$user = new User(uniqid(), "Oxymore", "thomas.kowalski@ensiie.fr");

var_dump($user->findPosts());

?>