<?php

function file_type_class($file) {
	$extension = get_type_file($file);
	if($extension=="jpg" || $extension=="jpeg")	return "file_type_jpg";
	elseif($extension=="png") 					return "file_type_png";
	elseif($extension=="pdf")					return "file_type_pdf";
	elseif($extension=="-d")					return "file_type_directory";
	elseif($extension=="-p")					return "file_type_profil";
	else 										return "file_type_unknown";
}

function check_value($name_var) {
	$bool = true;
	if(!isset($_POST[$name_var])) return false;
	else return ($_POST[$name_var]!='');
}


function download_file($file,$name) {
    global $root_adress;
    
	if(isset($file) && $file['error'] == 0) {
		$repertory = dirname(__FILE__)."/file/";

		$pos = strripos($file["name"],".");
    	$extension = substr($file["name"],$pos);
    	$tab= explode("?",$extension);
    	$extension = $tab[0];

    	$folder=$repertory.$name.$extension;
    	move_uploaded_file($file["tmp_name"], $folder);

    	return $folder;
    }
    return "";
}