<?php
/**
 * Created by PhpStorm.
 * User: chenzeyu
 * Date: 2018/5/5
 * Time: 21:34
 */
require '../../vendor/autoload.php';
include("config.php");
function db_connect() {
    global $dbUser, $dbName, $dbPassword;
    $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
    return $connection;
}

function db_fetchAll_Users($connection){
    $UsersRepository = new \User\UsersRepository($connection);
    $users = $UsersRepository->fetchAll();
    return $users;
}

function db_fetchAll_Mangas($connection){
    $mangaRepository = new \User\MangaRepository($connection);
    $mangas = $mangaRepository->fetchAll();
    return $mangas;
}
