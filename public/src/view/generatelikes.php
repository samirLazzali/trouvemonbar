<?php

require_once("../config.php");

$SQL = "SELECT * FROM Post ORDER BY RANDOM() LIMIT 1";
$db = connect();
$st = $db->prepare($SQL);
$st->execute();

$rows = $st->fetchAll();

$posts = array();
foreach($rows as $row)
    $posts[] = Post::fromRow($row);

$users = array();

$SQL = "SELECT * FROM Users";
$st = $db->prepare($SQL);
$st->execute();

$rows = $st->fetchAll();

foreach($rows as $row)
    $users[] = User::fromRow($row);

foreach($posts as $post)
{
    $usersGonnaLike = array_rand($users,rand(0, count($users) / 5));
    $usersGonnaDislike = array_rand($users, rand(0, count($users) / 5));

    foreach($usersGonnaLike as $u) {
        $u = $users[$u];
        Appreciation::createLike($post, $u);
    }


    foreach($usersGonnaDislike as $u) {
        $u = $users[$u];
        Appreciation::createDislike($post, $u);
    }
}

echo "g fini lol";