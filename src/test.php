<?php

require_once("classes/User.php");
require_once("classes/Post.php");
require_once("classes/Appreciation.php");

$user = User::create("Oxymore", "thomas.kowalski@ensiie.fr", "motdepasse");
if ($user == User::Error_EmailExists)
{
    $user = User::fromUsername("Oxymore");
}
$post = Post::post($user, "Salut, c'est Thomas, il est " . time());
$appreciation = Appreciation::createLike($post, $user);

var_dump($user);
var_dump($post);
var_dump($appreciation);

$post2 = Post::post($user, "Salut, deuxième post.");

var_dump($user->findPosts());

?>