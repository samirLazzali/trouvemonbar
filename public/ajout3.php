<?php


require '../vendor/autoload.php';
require '../src/Media/Media.php';
require '../src/Media/MediaRepository.php';
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

$tags=array();

if(isset($_GET['animaux'])){
    if ($_GET['animaux'] == 'animaux') {
        $tags=array_merge($tags,array(1));

    }}
if(isset($_GET['melancolique'])){
    if ($_GET['melancolique'] == 'melancolique') {
        $tags=array_merge($tags,array(2));
    }}
if(isset($_GET['drole'])){
    if ($_GET['drole'] == 'drole') {
        $tags=array_merge($tags,array(3));
    }}
if(isset($_GET['paysages'])){
    if ($_GET['paysages'] == 'paysage') {
        $tags=array_merge($tags,array(4));
    }}
if(isset($_GET['cuisine'])){
    if ($_GET['cuisine'] == 'cuisine') {
        $tags=array_merge($tags,array(5));
    }}
if(isset($_GET['peinture'])){
    if ($_GET['peinture'] == 'peinture') {
        $tags=array_merge($tags,array(6));

    }}
if(isset($_GET['sculpture'])){
    if ($_GET['sculpture'] == 'sculpture') {
        $tags=array_merge($tags,array(7));
    }}
if(isset($_GET['code'])){
    if ($_GET['code'] == 'code') {
         $tags=array_merge($tags,array(8));
    }}
if(isset($_GET['troll'])){
    if ($_GET['troll'] == 'troll') {
        $tags=array_merge($tags,array(9));
    }}
if(isset($_GET['wtf'])){
    if ($_GET['wtf'] == 'wtf') {
        $tags=array_merge($tags,array(10));
    }}
	

$MediaRepository= new \Media\MediaRepository($connection);
$MediaRepository->import($_GET['fileselect'],$_GET['fileselect'],'Alias',$_GET['type'],$tags);

header('Location: main2.php');
exit();

?>