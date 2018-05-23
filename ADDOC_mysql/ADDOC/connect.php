<?php

function all_variables_set($array) {
	$resu = true;
	for ($i;$i<count($array);$i++) {
		$resu = $resu && isset($_POST[$array[$i]]);
	}
	return $resu;
}

function contains_special_char($var) {
	$special_char = '%#^.!@&()+/"?`~<>{}[]|=-:;,§*$£';
	$resu = false;
	for($i=0;$i<strlen($special_char);$i++) {
		$resu = $resu || !(strrpos($var, $special_char[$i])===false);
	}
	return $resu;
}

function contains_number($var) {
	return (strspn($var,'1234567890') > 0);
}

function validate_email($email) {
	return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validate_url($url) {
	//$url = filter_var($url, FILTER_SANITIZE_URL);
	return filter_var($url, FILTER_VALIDATE_URL);
}

function make_string_safe($string) {
	return htmlspecialchars($string);
}