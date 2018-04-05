<?php

require_once("User.php");
require_once("Post.php");
require_once("Appreciation.php");

$user = User::create("Oxymore", "thomas.kowalski@ensiie.fr", "motdepasse");
$post = Post::post($user, "Salut, c'est Thomas, il est " . time());
$appreciation = Appreciation::createLike($post, $author);

var_dump($user);
var_dump($post);
var_dump($apprciations);

$post2 = Post::post($user, "Salut, deuxième post.");

var_dump($user->findPosts());

?>