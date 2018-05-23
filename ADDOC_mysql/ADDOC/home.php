<?php

include('config.php');
include('lang/'.$lang.'.php');
include('view.php');
include('file.php');
include('model.php');



$content = get_main_content();

$aside = get_aside_file($content);

$array = get_header_file($content);
$title = $array[0];
$subtitle = $array[1];
$search = $array[2];

$array = get_annotations($content);
$title_annotations = $array[0];
$annotations = $array[1];

$form = get_form_input();
$form_title = $form[0];
$form_subtitle = $form[1];
$form_submit = $form[2];
$form_input = $form[3];
$form_error = $form[4];


$array = get_files($content);
$letter = '';



display_head('ADDOC','style.css','');
display_search_bar($_SESSION['firstname'],$_SESSION['lastname'],$_SESSION['email']);
display_aside($aside);
if($title!='') display_head_file_deposit($title,$subtitle,$search);
if($title_annotations!='' || $annotations!='') display_annotations($title_annotations,$annotations);
if($form_submit!='') display_form('','post',$form_title,$form_subtitle,$form_input,$form_submit,$form_error,'','');
if(isset($_GET['deposit']) || isset($_GET['search']) || isset($_GET['employee'])) display_directories($array,count($array),$letter);
else display_files($array,count($array),$letter);
display_footer();