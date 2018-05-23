<?php

include('config.php');
include('lang/'.$lang.'.php');
include('view.php');
include('file.php');
include('model.php');

$bool = isset($_SESSION['id']) && isset($_SESSION['firstname']) && isset($_SESSION['lastname']) && isset($_SESSION['date_signedup']) && isset($_SESSION['email']);

$bool2 = isset($_POST['submit']) && check_value('number');



if($bool) {
	$content = get_main_content();
	$aside = get_aside_file($content);
}
else $aside = array();

if(isset($_GET['deposit'])) {

	$id = $_GET['deposit'];
	$info = get_deposit_information($id);
	$name = $info['name'];
	$description = $info['description'];
	$n = $info['number'];

	$content = get_should_content_deposit($id);
	$array = get_files($content);

	if($bool2) {
		if(!isset($_SESSION['id']) || !isset($_SESSION['firstname']) || !isset($_SESSION['lastname']) || !isset($_SESSION['date_signedup']) || !isset($_SESSION['email'])) {

		} else {
			create_new_directory($name,$description,$_SESSION['id'],$_FILES,$_POST,$n,$id,$array);
			header('Location: '.$root_adress.'home.php');
		}
	}


	

	$annotations = $str_to_fulfil_properly_file;

	

	$form_title = '';
	$form_subtitle = '';
	$form_submit = 'Send file';
	$form_input = array(array('hidden',$str_number_of_files,'number',$n,''));
	$form_error = '';



	display_head('ADDOC','style.css','');
	if ($bool) display_search_bar($_SESSION['firstname'],$_SESSION['lastname'],$_SESSION['email']);
	else display_search_bar('','','');
	display_aside($aside);
	display_head_file_deposit($name,$description,'');
	display_annotations('Help',$annotations);
	display_form('','post',$form_title,$form_subtitle,$form_input,$form_submit,$form_error,'','');
	display_files_deposit($array,count($array),'',$id);
	display_script_input_change();

} else {

	$title = $str_error_has_occured;
	$subtitle = $str_deposit_removed_or_wrong_link;
	$search = '';
	header('Refresh: 5; URL='.$root_adress.'home.php');

	display_head('ADDOC','style.css','');
	if ($bool) display_search_bar($_SESSION['firstname'],$_SESSION['lastname'],$_SESSION['email']);
	else display_search_bar('','','');
	display_aside($aside);
	display_head_file_deposit($title,$subtitle,$search);
}


display_footer();