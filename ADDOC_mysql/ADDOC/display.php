<?php

include('config.php');

include('view.php');
include('file.php');
include('model.php');

/*
if(!isset($_GET['file']) || !isset($_GET['directory']) ||
	$_GET['file']=="" || $_GET['directory']=="") {
	header('Location: home.php');
}*/

$id_file = $_GET['file'];

if (!can_access_file($id_file)) {
	header("Location: ".$address_from_root."home.php");
}

if(isset($_GET['directory'])) {
	$id_directory = $_GET['directory'];
	$directory_link = 'home.php?directory='.$id_directory;
} elseif (isset($_GET['deposit'])) {
	$directory_link = 'deposit.php?deposit='.$_GET['deposit'];
} else {
	$directory_link = 'home.php';
}



$array = get_file_information($id_file);
$title = $array['title'];


$address = str_replace('/storage/ssd5/045/5859045/public_html','',$array['address']);


$is_image = true;
$pos = strripos($address,".");
$extension = substr($address,$pos);
$tab = explode("?",$extension);
$extension = $tab[0];
if($extension=='pdf') $is_image = false;

$can_modify_file = is_your_file($id_file);

display_head($title,'file.css','');
display_popup();
display_header_file_page($title,$address,$directory_link,$can_modify_file);
display_content_file($address,$is_image);
display_footer();