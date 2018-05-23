<?php

include('other.php');
include('connect.php');

$error1 = 'Please enter your ';
$error2 = 'Password must be 6 characters or more';
$error3 = 'You cannot insert special characters';
$error4 = 'Someone\'s already using that email. If that’s you, Sign in.';

function display_head($title,$css,$script) {
	print "<!DOCTYPE html>\n";
    print "<html lang=\"en\">\n";
    print "  <head>\n";
    print "    	<meta charset=\"utf-8\" />\n";
    print "		<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\n";
    print "    	<title>$title</title>\n";
    print "    	<link rel=\"stylesheet\" href=\"css/".$css."\"/>\n";
    print "		<link href=\"http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css\" rel=\"stylesheet\">\n";
    if($script!='') print "    ".$script."\n";
    print "  </head>\n";
  

    print "  <body>\n";
}

function display_search_bar($firstname,$lastname,$email) {
	global $address_from_root;

    print "	<nav>\n";
	print "		<a href=\"index.php\"><img src=\"".$address_from_root."image/logo/logo2.png\" alt=\"logo ADDOC\" id=\"logo_nav\" /></a>\n";
	print "		<div class=\"wrap\">\n";
	print "			<form class=\"search\" action=\"\" method=\"get\">\n";
	print "				<input type=\"text\" class=\"searchTerm\" placeholder=\"What are you looking for?\" name=\"search\">\n";
	print "				<button type=\"submit\" class=\"searchButton\">\n";
	print "					<i class=\"fa fa-search\"></i>\n";
	print "				</button>\n";
	print "			</form>\n";
	print "		</div>\n";
	print "		<div class=\"dropdown\">";
	print "			<img src=\"".$address_from_root."image/useful/settings.png\" alt=\"settings\" class=\"icon_nav icon_settings\" />\n";
	print "			<div class=\"dropdown-account\"><img src=\"".$address_from_root."image/useful/user.png\" alt=\"account\" class=\"icon_nav icon_account\" />\n";
	print "			<div class=\"dropdown-content-account\">\n";
	if (!isset($_SESSION['id'])) {
		print "<a href=\"index.php?choose=true\">Connect</a>";
	}
	else {
		print "<div class=\"dropdown-account-preview\">\n";
		print "	<img src=\"".$address_from_root."image/useful/user2.png\" alt=\"settings\" class=\"dropdown-account-preview-icon\" />\n";
		print " <p class=\"dropdown-account-preview-text\">".$firstname." ".$lastname."</p>\n";
		print " <p class=\"dropdown-account-preview-text\">".$email."</p>\n";
		print "</div>\n";
		print "<a href=\"home.php?admin=true\"><div class=\"dropdown-account-preview-text2\">Go to admin</div></a>\n";
		print "<a href=\"index.php?disconnect=true\"><div class=\"dropdown-account-preview-text2\">Log out</div></a>\n";
	}
	print "			</div></div>\n";
	print "		</div>\n";
    print "	</nav>\n";
}

function display_aside($files) {
	print "	<aside class=\"aside_elements\">\n";
	print create_list_files($files,count($files));
	print "	</aside>\n";
	print "	<aside class=\"aside_style\">\n";
	print "	</aside>\n";
}

function display_files($array,$size_array,$letter) {
	if(isset($_GET['directory'])) $id_dir = $_GET['directory'];
	else $id_dir = "";

	if($letter!='') {
		print " <div class=\"letter_separation_files\">\n";
		print "		<h1 class=\"letter_file_order\">".$letter."</h1>\n";
		print "		<div class=\"flat_separator\"></div>\n";
		print "	</div>\n";
	}
	print "	<div class=\"content\" >\n";
	for($i=0;$i<$size_array;$i++) {
		print "<a href=\"display.php?file=".get_id_file($array[$i])."&directory=".$id_dir."\">\n";
		print "	<div class=\"file_square ".file_type_class($array[$i])."\">\n";
		print " 	<div class=\"file_name\">";
		print get_name_file($array[$i]);
		print "		</div>\n";
		print "	</div>\n";
		print "</a>\n";
	}
	print "	</div>\n";
}

function display_directories($array,$size_array,$letter) {
	global $address_from_root;

	if($letter!='') {
		print " <div class=\"letter_separation_files\">\n";
		print "		<h1 class=\"letter_file_order\">".$letter."</h1>\n";
		print "		<div class=\"flat_separator\"></div>\n";
		print "	</div>\n";
	}
	print "	<div class=\"content\" >\n";
	for($i=0;$i<$size_array;$i++) {

		if(get_id_file($array[$i])=="")
			print "	<a class=\"directory_line\" href=\"\">\n";
		elseif(get_type_file($array[$i]) == "user")
			print "	<a class=\"directory_line\" href=\"?user=".get_id_file($array[$i])."&admin=true\">\n";
		elseif(get_type_file($array[$i]) == "deposit")
			print "	<a class=\"directory_line\" href=\"deposit.php?deposit=".get_id_file($array[$i])."\">\n";
		else
			print "	<a class=\"directory_line\" href=\"?directory=".get_id_file($array[$i])."\">\n";


		print "	<div>\n";


		if(get_type_file($array[$i]) == "user")
			print "		<img class=\"file_home_icon\" src=\"".$address_from_root."image/useful/user.png\" alt=\"repertory\"/>\n";
		elseif(get_type_file($array[$i]) == "deposit")
			print "		<img class=\"file_home_icon\" src=\"".$address_from_root."image/useful/deposit.png\" alt=\"repertory\"/>\n";
		else
			print "		<img class=\"file_home_icon\" src=\"".$address_from_root."image/useful/repertory.png\" alt=\"repertory\"/>\n";



		print " 	<div class=\"directory_name\">";
		print get_name_file($array[$i]);
		print "		</div>\n";
		print " 	<div class=\"directory_date\">";
		print get_date_file($array[$i]);
		print "		</div>\n";
		print "	</div>\n";
		print " </a>\n";
	}
	print "	</div>\n";
}

function display_files_deposit($array,$size_array,$letter,$id_deposit) {
	if($letter!='') {
		print " <div class=\"letter_separation_files\">\n";
		print "		<h1 class=\"letter_file_order\">".$letter."</h1>\n";
		print "		<div class=\"flat_separator\"></div>\n";
		print "	</div>\n";
	}
	print "	<div class=\"content\" >\n";
	for($i=0;$i<$size_array;$i++) {

		$empty = 'empty ';
		$id_file = get_date_file($array[$i]);
		if($id_file!="") print " <a href=\"display.php?file=".$id_file."&deposit=".$id_deposit."\">";
		if($id_file!="") $empty = 'full ';

		print "	<div class=\"".$empty."file_square ".file_type_class($array[$i])."\" id=\"file".$i."_square\" >\n";
		print " 	<div class=\"file_name\">";
		print get_name_file($array[$i]);
		print "		</div>\n";

		if($id_file=="") print "	<input type=\"file\" class=\"input_file_square\" form=\"form\" name=\"file".$i."\" onchange=\"change_input(this.name);\" />\n";
		else print "	<input type=\"hidden\" class=\"input_file_square\" form=\"form\" name=\"file".$i."\" onchange=\"change_input(this.name);\" value=\"".get_date_file($array[$i])."\"/>\n";
		print "	</div>\n";

		if($id_file!="") print " </a>";
	}
	print "	</div>\n";
}

function display_script_input_change() {
	print "<script>\n";
	print "	function change_input(name) {\n";
	print "		var square = document.getElementById(name+\"_square\");\n";
	print "		square.style.borderColor = \"green\";\n";
	print "		square.style.backgroundColor = \"#90ee90\";\n";
	print "		square.style.opacity = \"1\";\n";
	print "	}\n";
	print "</script>\n";
}


function display_footer() {
    print "  </body>\n";
    print "</html>";
}

function create_list_files($array,$size_array) {
	global $address_from_root;

	$resu = "<ul class=\"files\">\n";
	$resu = $resu."<a href=\"home.php\">\n";
	$resu = $resu."	<li class=\"file\" >";
	$resu = $resu."	<img class=\"file_home_icon\" src=\"".$address_from_root."image/useful/home.png\" alt=\"home\"/>";
	$resu = $resu."	Home";
	$resu = $resu."	</li>";
	$resu = $resu."</a>\n";
	for ($i=0;$i<$size_array;$i++) {
		$class = "";
		$img = "";

		if($array[$i][1]=="title") {
			$class = "class=\"file_title_aside\"";
			$target = "";
			$resu = $resu."	<div class=\"aside_title_seperator\"></div>";
		} elseif ($array[$i][1]=="add") {
			$class = "class=\"file\"";
			$target = $array[$i][2];
			$img = "	<img class=\"file_home_icon\" src=\"".$address_from_root."image/useful/add.png\" alt=\"add\"/>";
		} elseif ($array[$i][1]=="settings") {
			$class = "class=\"file\"";
			$target = $array[$i][2];
			$img = "	<img class=\"file_home_icon\" src=\"".$address_from_root."image/useful/settings.png\" alt=\"add\"/>";
		} elseif ($array[$i][1]=="deposit") {
			$class = "class=\"file\"";
			$target = $array[$i][2];
			$img = "	<img class=\"file_home_icon\" src=\"".$address_from_root."image/useful/deposit.png\" alt=\"add\"/>";
		} else {
			$class = "class=\"file\"";
			$target = $array[$i][2];
			$img = "	<img class=\"file_home_icon\" src=\"".$address_from_root."image/useful/repertory.png\" alt=\"repertory\"/>";
		}
		$resu = $resu."<a href=\"home.php".$target."\">\n";
		$resu = $resu."<li ".$class." >".$img.$array[$i][0]."</li>\n";
		$resu = $resu."</a>\n";
	}
	$resu = $resu."</ul>\n";
	return $resu;
}


function display_form($action,$method,$title,$subtitle,$array,$submit,$error,$text,$link) {
	global $address_from_root;
	$n = count($array);

	print "	<div class=\"content\">\n";
	print "		<header class=\"title_logo_form\">\n";
	print "     	<img src=\"".$address_from_root."image/logo/logo3.png\" alt=\"logo ADDOC\" class=\"logo_form\"/>\n";
	print "        		<h1 class=\"title_form\">".$title."</h1>\n";
	if($subtitle!='' ) {
		print "        		<h4 class=\"subtitle_form\">".$subtitle."</h4>\n";
	}
	print "        		<h4 class=\"error_form\" id=\"main_error_form\">".$error."</h4>\n";
	print "	    </header>\n";
	print "		<form class=\"form\" id=\"form\" action=\"".$action."\" method=\"".$method."\" enctype=\"multipart/form-data\">\n";
	for($i=0;$i<$n;$i++) {
		if($array[$i][0]=='submit' && ($i+1<count($array)) && ($array[$i+1][0]=='submit') && (($i-1<0) || ($array[$i-1][0]!='submit'))) {
			print "			<div class=\"container_two_submit\">\n";
		}
		if($array[$i][0]=='fieldset') {
			print "			<fieldset>\n";
		} elseif($array[$i][0]=='\fieldset') {
			print "			</fieldset>\n";
		} elseif($array[$i][0]=='select') {
			print "			".create_select($array[$i][1],$array[$i][2],$array[$i][3]);
		} elseif($array[$i][0]=='textarea') {
			print "			".create_textarea($array[$i][1],$array[$i][2],$array[$i][3]);
		} else {
			$script = 'onkeyup="void_input(this);" onkeypress="return blockSpecialChar(event);"';
			if($array[$i][0]=="url") $script='';
			if($array[$i][0]=="password") $script = 'onkeyup="void_input(this);password_input(this);"';
			print "			".create_input($array[$i][0],$array[$i][1],$array[$i][2],$array[$i][3],$script." ".$array[$i][4]);
		}
		if($array[$i][0]=='submit' && ($i-1>=0) && ($array[$i-1][0]=='submit') && (($i-2<0) || ($array[$i-2][0]!='submit')) ) {
			print "			</div>\n";
		}
	}   
	//print "        <button class=\"btn\" type=\"submit\">".$submit."</button>\n";
	print "        <input name=\"submit\" class=\"btn\" type=\"submit\" value=\"".$submit."\">\n";
	print "		</form>\n";
	if($text!='') {
		print "		<div class=\"under_form_element\">\n";
		if($link!="") print "<a href=\"".$link."\" >\n";
		print "<p class=\"under_form_text\">".$text."</p>\n";
		if($link!="") print "</a>\n";
		print "		</div>\n";
	}
	print "	</div>\n";
}


function create_input($type,$placeholder,$id,$value,$script) {
	if($value!='') $va = "value=\"".$value."\" ";
	else $va = '';
	$ty = "type=\"".$type."\" ";
	$pl = "placeholder=\"".$placeholder."\" ";
	$ID = "id=\"".$id."\" ";
	$na = "name=\"".$id."\" ";
	$class = ($type=="submit") ? "class=\"submit_container_form\"" : "class=\"input_container_form\"" ;

	$resu = "<div ".$class.">";
	$resu = $resu."<input class=\"form_input\" ".$ty.$pl.$ID.$na.$va.$script."/>";
	$resu = $resu."</div>\n";

	return $resu;
}


function create_select($placeholder,$id,$values_array) {
	$ID = "id=\"".$id."\" ";
	$na = "name=\"".$id."\" ";

	$resu = "<select ".$ID.$na.">\n";
	$resu = $resu."<option value=\"".$placeholder."\">".$placeholder."</option>";
	for($i=0;$i<count($values_array);$i++) {
		$resu = $resu."<option value=\"".$values_array[$i]."\">".$values_array[$i]."</option>";
	}
	$resu = $resu."</select>\n";
	return $resu;
}

function create_textarea($placeholder,$id,$value) {
	$ID = "id=\"".$id."\" ";
	$na = "name=\"".$id."\" ";
	$cl = "class=\"textarea_form\" ";
	$pl = "placeholder=\"".$placeholder."\" ";

	$class = "class=\"input_container_form\"" ;
	$resu = "<div ".$class.">";
	$resu = $resu."<textarea ".$ID.$na.$cl.$pl.">\n";
	$resu = $resu.$value;
	$resu = $resu."</textarea>\n";
	$resu = $resu."</div>\n";
	return $resu;
}


function errors_form() {
	$resu = "<script type=\"text/javascript\">\n";
	$resu =  $resu.void_error_form();
	$resu = $resu."	</script>\n";
	return $resu;
}

function void_error_form() {
	$resu = "	
	function void_input(\$element) {
		if(\$element.value=='') {
			var error = document.getElementById('main_error_form');
			error.innerHTML = '".$GLOBALS['error1']."'.concat(\$element.placeholder);
		}
	}
	function password_input(\$element) {
		var error = document.getElementById('main_error_form');
		if(\$element.value.length<6 && \$element.value.length>0) {
			error.innerHTML = '".$GLOBALS['error2']."';
		}
		if(\$element.value.length>=6) {
			error.innerHTML = '';
		}
	}
	function blockSpecialChar(e) {
		var error = document.getElementById('main_error_form');
        var k;
        document.all ? k = e.keyCode : k = e.which;
        var is_special_char = ((k >= 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 32 || k == 46 || (k >= 48 && k <= 57));
        if(is_special_char===false) {
        	error.innerHTML = '".$GLOBALS['error3']."';
        }
        return is_special_char;
    }
	";
	return $resu;
}

function display_head_file_deposit($title,$subtitle,$search) {
	print "	<div class=\"content\">";
	print "		<h3 class=\"content_file_title\">".$title."</h3>\n";
	print "		<h5 class=\"content_file_subtitle\">".$subtitle."</h5>\n";
	if($search!='') {
		print " 	<div class=\"separator\"></div>\n";
		print "			<div class=\"search2\">\n";
		print "				<input type=\"text\" class=\"searchTerm2\" placeholder=\"".$search."\">\n";
		print "				<button type=\"submit\" class=\"searchButton2\">\n";
		print "					<i class=\"fa fa-search\"></i>\n";
		print "				</button>\n";
		print "			</div>\n";
	}
	print "	</div>\n";
}


function display_button_head_file_deposit($array_text,$action) {
	print "	<div class=\"content\">";
	print "		<div class=\"actionButtonsContent\">";
	for($i=0;$i<count($array_text);$i++) {
		print "			<button class=\"actionButton\">\n";
		print "				".$array_text[$i]."\n";
		print "			</button>\n";
	}
	print "		</div>\n";
	print "	</div>\n";
}

function display_annotations($title_annotations,$annotations) {
	print "	<div class=\"content\">";
	print " 	<p class=\"annotations\">"
					."<span class=\"annotations_title\">".$title_annotations."</span><br>"
					.$annotations
				."</p>";
	print "	</div>\n";
}

function display_title_subtitle_page($title,$subtitle) {
	global $address_from_root;

	print "<div class=\"only_title_page_logo\"><img src=\"".$address_from_root."image/logo/logo3.png\" alt=\"logo ADDOC\" class=\"logo_form only_title_page_logo\"/></div>\n";
	print "	<h1 class=\"only_title_page_title\">".$title."</h1>\n";
	print " <h3 class=\"only_title_page_subtitle\">".$subtitle."</h3>\n";
}

function display_page_buttons($text,$button1,$link1,$button2,$link2) {
	global $address_from_root;

	print "<div class=\"only_title_page_logo\"><img src=\"".$address_from_root."image/logo/logo3.png\" alt=\"logo ADDOC\" class=\"logo_form only_title_page_logo\"/></div>\n";
	print "	<div class=\"choose_page_content\">\n";
	print "	<p>".$text."</p>";
	print " <a href=\"".$link1."\" alt=\"sign in\" class=\"choose_page_button\">".$button1."</a>\n";
	print " <a href=\"".$link2."\" alt=\"sign in\" class=\"choose_page_button\">".$button2."</a>\n";
	print "	</div>\n";
}

function display_header_file_page($title,$address,$directory_link,$is_your_file) {
	global $address_from_root;

	print "<nav>\n";
  	print "	<a href=\"".$directory_link."\">\n";
	print "		<img src=\"".$address_from_root."image/useful/arrow-left.png\" alt=\"arrow left\" class=\"arrow-left-header\" />\n";
	print "	</a>\n";
	print "	<div class=\"wrap\">\n";
	print "		<p class=\"title_file\">".$title."</p>\n";
	print "	</div>\n";
	print "	<div class=\"right_actions_header\">\n";

	/*print "		<a href=\"#popup1\" class=\"upload_file_link\">\n";
	print "		Change";
	print "		</a>\n";*/

    if($is_your_file) {
		print "		<a href=\"#popup1\" >\n";
		print "			<img src=\"".$address_from_root."image/useful/upload.png\" alt=\"upload\" class=\"upload-header action_icon\" />\n";
		print "		</a>\n";
	}

	print "		<a href=\"".$address."\" download>\n";
	print "			<img src=\"".$address_from_root."image/useful/save.png\" alt=\"save\" class=\"save-header action_icon\" />\n";
	print "		</a>\n";
	print "		<a href=\"\">\n";
	print "			<img src=\"".$address_from_root."image/useful/print.png\" alt=\"print\" class=\"print-header action_icon\" />\n";
	print "		</a>\n";
	print "	</div>\n";
	print "</nav>\n";
}



function display_popup() {
	print "<div id=\"popup1\" class=\"popup_square\">\n";
	print "		<div class=\"popup\">\n";
	print "			<h2>Change file</h2>\n";
	print "			<a class=\"close\" href=\"#\">&times;</a>\n";
	print "			<form class=\"content_popup \" action=\"\" method=\"post\" enctype=\"multipart/form-data\">\n";
	print "				<label id=\"#bb\"> Choose Your File\n";
	print "			    	<input type=\"file\" id=\"file\" name=\"file\"  size=\"60\" >\n";
	print "			    </label>\n";
	print "			    <input type=\"submit\" name=\"submit\" value=\"Upload\">\n";
	print "			</form>\n";
	print "		</div>\n";
	print "	</div>\n";
}



function display_content_file($address,$is_image) {
	if($is_image) $class = 'image_display';
	else $class = 'pdf_display';

	print "<div class=\"content_file_display\">\n";
	print "	<object class=\"".$class."\" data=\"".$address."\">\n";
	print "		<p>If you can't see the file properly, click <a href=\"".$address."\">here</a></p>\n";
	print "	</object>\n";
	print "</div>\n";
}