<?php
/**
 * Created by PhpStorm.
 * User: clement
 * Date: 22/05/18
 * Time: 00:15
 */
require '../../vendor/autoload.php';
include("Modele.php");
include("Vue.php");
//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
$mangaRepository = new \User\MangaRepository($connection);

session_start();
$manga = $_SESSION['manga'];
$desc = $_POST['comment'];
$descu = urlencode($desc);
$mangaRepository->add_desc($manga,$descu);
header("Location: manga.php?manga=$manga");