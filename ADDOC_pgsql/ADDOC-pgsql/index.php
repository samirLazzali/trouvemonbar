<?php

include('config.php');
include('lang/'.$lang.'.php');
include('view.php');
include('model.php');

$action = '';
$method = 'post';

$bool_val = isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['url']) && isset($_POST['name_organisation']);

$bool_val2 = (isset($_POST['email_signin']) && isset($_POST['password_signin']));

$is_personnal_account = isset($_GET['account']) && $_GET['account']=='personnal';

if(isset($_GET['disconnect']) && $_GET['disconnect']=='true') {

	disconnect();
	header('Location: http://localhost/ADDOC/index.php?signin=true');
	die();

} elseif(isset($_GET['account']) && $_GET['account']=="choose") {

	$button1 = $str_personnal;
	$link1 = 'index.php?signup=true&account=personnal';
	$button2 = $str_professional;
	$link2 = 'index.php?signup=true';
	$text = $str_choose_use_addoc;
	display_head('Sign Up','form.css','');
	display_page_buttons($text,$button1,$link1,$button2,$link2);

} elseif(isset($_GET['choose']) && $_GET['choose']=="true") {

	$button1 = $str_sign_up;
	$link1 = 'index.php?account=choose';
	$button2 = $str_sign_in;
	$link2 = 'index.php?signin=true';
	$text = $str_already_an_account_or;
	display_head($str_sign_up,'form.css','');
	display_page_buttons($text,$button1,$link1,$button2,$link2);

} elseif( check_value('email_signin') && check_value('password_signin') ) {

	verify_connection($_POST['email_signin'],$_POST['password_signin']);

} elseif( (isset($_GET['signin']) && $_GET['signin']=="true") ||  $bool_val2 || (isset($_GET['error']) && $_GET['error']=="true")) {

	if((isset($_GET['error']) && $_GET['error']=="true")) {
		$error = $str_no_account_for_email_or_wrong_pwd;
		$error = $error."<br>".$str_do_not_have_account."<a href=\"index.php\" alt=\"sign up\">".$str_sign_up."</a>";
		$email_value = '';
		$password_value = '';

	} elseif($bool_val2) {

		$email_value = $_POST['email_signin'];
		$password_value = $_POST['password_signin'];

		$error = '';
		$err = 'Please enter your';

		if($_POST['email_signin']=='') 						$error = $error.$err." Email. ";
		if($_POST['password_signin']=='') 					$error = $error.$err." Password. ";
		if(!validate_email($_POST['email_signin']))			$error = $error."Please insert a valid email. ";

	} else {
		$error = '';
		$email_value = '';
		$password_value = '';
	}

	$title = $str_sign_in;
	$subtitle = $str_use_email_pwd_access_file_manager;
	$submit = $str_sign_in;
	$text = $str_no_account_sign_up;
	$link = 'index.php?account=choose';

	$inputs = array(	array("text","Email","email_signin",$email_value,''),
	                	array("password","Password","password_signin",$password_value,''));
	display_head('Sign Up','form.css','');
	display_form($action,$method,$title,$subtitle,$inputs,$submit,$error,$text,$link);
	print errors_form();


} elseif(check_value('firstname') && check_value('lastname') && check_value('email') && check_value('password') && (!contains_special_char($_POST['firstname'])) && (!contains_special_char($_POST['lastname'])) && validate_email($_POST['email']) && strlen($_POST['password'])>=6
	 && ((check_value('name_organisation') && !contains_special_char($_POST['name_organisation']) && isset($_POST['url'])) || $is_personnal_account)) {

	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	if(!$is_personnal_account) {
		$organisation_name = $_POST['name_organisation'];
		$url = $_POST['url'];
	}

	if(!no_user_with_email($email)) {
		header("Location: ".$root_adress."index.php?user=exist");
	}

	if(!$is_personnal_account) create_professional_account($firstname,$lastname,$email,$password,$organisation_name,$url);
	else create_personnal_account($firstname,$lastname,$email,$password);

	/*NOT IMPLEMENTED YET*/
	/*display_title_subtitle_page('Confirm email','Last step! Please confirm your email');*/

	header("Location: ".$root_adress."index.php?signin=true");
	die();

} elseif((check_value('name_organisation') && isset($_POST['url']) && (!contains_special_char($_POST['name_organisation']))) || $bool_val || $is_personnal_account) {

	

	if($bool_val) {
		$firstname_value = $_POST['firstname'];
		$lastname_value = $_POST['lastname'];
		$email_value = $_POST['email'];


		$error = '';
		$err = $str_pls_enter_your;
		$error2 = $str_can_not_insert_special_char;

		if($_POST['firstname']=='') 					$error = $error.$err." ".$str_first_name.". ";
		if($_POST['lastname']=='') 						$error = $error.$err." ".$str_last_name.". ";
		if($_POST['email']=='') 						$error = $error.$err." ".$str_email.". ";
		if($_POST['password']=='') 						$error = $error.$err." ".$str_password.". ";
		if(contains_special_char($_POST['firstname']))	$error = $error.$error2.$str_in_your." ".$str_first_name.". ";
		if(contains_special_char($_POST['lastname']))	$error = $error.$error2.$str_in_your." ".$str_last_name.". ";
		if(!validate_email($_POST['email']))			$error = $error.$str_please_insert_valid_email.". ";
		if(strlen($_POST['password'])<6)				$error = $error.$str_pwd_6_char_or_more;
	} else {
		$firstname_value = '';
		$lastname_value = '';
		$email_value = '';

		$error = '';
	}
	

	$title = $str_sign_up_now;
	if ($is_personnal_account) $subtitle = $str_personnal_account;
	else $subtitle = $str_professional_account;
	$submit = $str_sign_up;
	$text = $str_already_an_account;
	$link = 'index.php?signin=true';


	$inputs = array(	array("text","First Name","firstname",$firstname_value,''),
	                	array("text","Last Name","lastname",$lastname_value,''),
	                	array("email","Email","email",$email_value,''),
	                	array("password","Password","password",'',''));
	if (!$is_personnal_account) {
		array_push($inputs, array("hidden","Url","url",$_POST['url'],''));
		array_push($inputs, array("hidden",$str_orga_name,"name_organisation",$_POST['name_organisation'],''));
	}

	display_head($str_sign_up,'form.css','');
	display_form($action,$method,$title,$subtitle,$inputs,$submit,$error,$text,$link);
	print errors_form();

} else {

	if(isset($_POST['url'])) $url_value = $_POST['url'];
	else $url_value = '';

	if(isset($_POST['name_organisation']) && $_POST['name_organisation']=='') {
		$error = $str_pls_enter_name_orga;
	} elseif(isset($_POST['name_organisation']) && contains_special_char($_POST['name_organisation'])) {
		$error = $str_can_not_insert_special_char_name_orga;
	} elseif(isset($_GET['user']) && $_GET['user']=="exist") {
		$error = $str_someone_use_this_email;
		$error = $error." <a href=\"index.php?signin=true\" alt=\"sign in\">".$str_sign_in."</a>";
	} else $error = '';

	$title = $str_sign_up_now;
	$subtitle = $str_professional_account;
	$submit = $str_continue;
	$text = $str_already_an_account;
	$link = 'index.php?signin=true';

	$inputs = array(	array("text",$str_name_of_your_organisation,"name_organisation","",''),
	                	array("url","Url (optionnal)","url",$url_value,''));

	display_head($str_sign_up,'form.css','');
	display_form($action,$method,$title,$subtitle,$inputs,$submit,$error,$text,$link);
	print errors_form();

}

display_footer();