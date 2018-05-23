<?php

include('db.php');

try {
	$dbb = db_connect();
} catch(Exception $e) {
    die('Erreur : '.$e->getMessage());
}


function get_main_content() {
	global $root_adress;
	$resu = array();
	if(isset($_GET['search']) && $_GET['search']!="") {

		$search = $_GET['search'];
		$resu = get_directory_search($search);

	} elseif(isset($_GET['directory']) && $_GET['directory']!="" ) {

		$id_directory = $_GET['directory'];

		if(can_access_directory($id_directory)) {
			$resu = get_content_directory($id_directory);
		} else {
			header("Location: ".$root_adress."home.php");
			die();
		}

	} elseif(isset($_GET['deposit']) && $_GET['deposit']!="" ) {

		$id_deposit = $_GET['deposit'];

		if(basename($_SERVER['PHP_SELF'])=='deposit.php') {
			$resu = get_content_deposit($id_deposit);
		} elseif(can_access_deposit($id_deposit)) {
			$resu = get_content_deposit($id_deposit);
		} else {
			header("Location: ".$root_adress."home.php");
			die();
		}

	} elseif(isset($_GET['employee']) && $_GET['employee']=="true" ) {

		$resu = get_employee_working_with_user($_SESSION['id']);

	} else {

		$resu = get_content_home();

	}
	return $resu;
}


function create_company($organisation_name,$url,$email_user) {
	global $dbb;

	$req1 = 'INSERT INTO company (name, url, id_user) VALUES ('.$organisation_name.', '.$url.', (SELECT id FROM user WHERE email='.$email_user.'))';

	$req2 = 'INSERT INTO employee (id_company, id_user) VALUES ((SELECT id FROM company WHERE id_user=(SELECT id FROM user WHERE email='.$email_user.')), (SELECT id FROM user WHERE email='.$email_user.'))';

	db_transaction($dbb,array($req1,$req2));
}



function create_professional_account($firstname,$lastname,$email,$password,$organisation_name,$url) {
	$req1 = 'INSERT INTO user (firstname, lastname, email, pwd) VALUES ('.$firstname.', '.$lastname.', '.$email.', '.$password.')';


	$req2 = 'INSERT INTO company (name, url, id_user) VALUES ('.$organisation_name.', '.$url.', (SELECT id FROM user WHERE email='.$email.'))';


	$req3 = 'INSERT INTO employee (id_company, id_user) VALUES ((SELECT id FROM company WHERE id_user=(SELECT id FROM user WHERE email='.$email.')), (SELECT id FROM user WHERE email='.$email.'))';


	global $dbb;
	db_transaction($dbb,array($req1,$req2,$req3));
}



function create_personnal_account($firstname,$lastname,$email,$password) {
	$req = 'INSERT INTO user (firstname, lastname, email, pwd) VALUES ('.$firstname.', '.$lastname.', '.$email.', '.$password.')';

	global $dbb;
	db_query($dbb,$req);
}



function verify_connection($email,$password) {
	global $root_adress;

	$user_data = connect_user($email,$password);
	if($user_data[0]==-1) {

		header("Location: ".$root_adress."index.php?signin=true&error=true");
		die();

	} else {

		$id = $user_data[0];
		$firstname = $user_data[1];
		$lastname = $user_data[2];
		$email = $user_data[3];
		$date_signedup =$user_data[4];
		create_session_values($id,$firstname,$lastname,$email,$date_signedup);
		header("Location: ".$root_adress."home.php");
		die();

	}
}



function update_password($old_password,$new_password) {

	global $dbb;
	$user_data = connect_user($_SESSION['email'],$old_password);

	if($user_data[0]==-1) {
		return false;
	} else {

		$query = 'UPDATE user SET pwd='.$new_password.' WHERE id='.$_SESSION['id'];

		db_query($dbb,$query);

		return true;
	}
}



function connect_user($email,$password) {

	global $dbb;
	$query = 'SELECT id,firstname,lastname,email,date_signedup FROM user WHERE email='.$email.' AND pwd='.$password;
	$req = db_query($dbb,$query);

	if( ($res=db_fetch($req)) ) {
		return array($res['id'],$res['firstname'],$res['lastname'],$res['email'],$res['date_signedup']);
	}

	return array(-1,-1,-1);
}


function no_user_with_email($email) {
	global $dbb;
	$query = 'SELECT id FROM user WHERE email='.$email;
	$req = db_query($dbb,$query);

	if(($res=db_fetch($req))) {
		return false;
	} else return true;

	return false;
}


function get_company_name() {
	global $dbb;

	$query = 'SELECT name FROM company WHERE id=(SELECT id_company FROM company WHERE id_user='.$_SESSION['id'].')';
	$req = db_query($dbb,$query);

	if(($res=db_fetch($req))) return $res['name'];

	return '';
}



function get_aside_file($content) {
	global $dbb,$str_account,$str_password,$str_usage,$str_employee,$str_create_file_deposit,$str_file_deposit,$str_your_directories;
	$aside_files = array();
	$bool = true;

	if(isset($_GET['admin']) && $_GET['admin']=="true") {
		array_push($aside_files, array($str_account,"title",""));
		array_push($aside_files, array($str_password,'settings',"?admin=true&password=true"));

		if(is_professional_account()) {
			$name = get_company_name();
			array_push($aside_files, array($name,"title",""));
			array_push($aside_files, array($str_employee,'settings',"?admin=true&employee=true"));
		} else {
			array_push($aside_files, array($str_usage,'settings',"?admin=true&usage=true"));
		}

		return $aside_files;
	}


	if(!(isset($_GET['deposit']) && $_GET['deposit']!="") && is_professional_account()) {
		array_push($aside_files, array($str_create_file_deposit,"add","?create=deposit"));
	}
	

	/*Recupere tous les depots de dossiers qui ont ete crees par l'utilisateur ou par un autre membre de la meme entreprise*/
	$query = 
		'SELECT id, id_user, date_creation, name FROM deposit WHERE (id_user IN (SELECT id_user FROM employee WHERE id_company=(SELECT id_company FROM employee WHERE id_user='.$_SESSION['id'].')) OR id_user='.$_SESSION['id'].')';
	$req = db_query($dbb,$query);

	while ( ($res=db_fetch($req)) ) {
		if($bool) {
			$bool = false;
			array_push($aside_files, array($str_file_deposit,"title",""));
		}
		array_push($aside_files, array($res['name'],'deposit',"?deposit=".$res['id']));
	}

	$bool = true;


	/*Recupere tous les dossiers qui ont ete deposes par l'utilisateur*/
	$query2 = 'SELECT id, name FROM directory WHERE id_user='.$_SESSION['id'];
	$req2 = db_query($dbb,$query2);

	while ( ($res2=db_fetch($req2)) ) {
		if($bool) {
			$bool = false;
			array_push($aside_files, array($str_your_directories,"title",""));
		}
		array_push($aside_files, array($res2['name'],'directory',"?directory=".$res2['id']));
	}

	return $aside_files;
}



function get_deposit_structure($id) { 
	global $dbb;
	$array = array();

	$query = 'SELECT id_type FROM deposit_model WHERE id_deposit='.$id;
	$req = db_query($dbb,$query);

	while ( ($res=db_fetch($req)) ) {
		$query2 = 'SELECT type FROM type WHERE id='.$res['id_type'];
		$req2 = db_query($dbb,$query2);

		if ( ($res2=db_fetch($req2)) ) 
			array_push($array, array(	'id_content' => '',
										'name' => $res2['type'],
										'type' => 'file',
										'date_added' => ''));
	}
	return $array;
}


function can_access_deposit($id_deposit) {
	global $dbb;

	$q1 = 'SELECT id_user FROM employee WHERE id_company=(SELECT id_company FROM employee WHERE id_user='.$_SESSION['id'].')';
	$query = 'SELECT id FROM deposit WHERE id='.$id_deposit.' AND (id_user='.$_SESSION['id'].' OR id_user IN ('.$q1.'))';
	$req = db_query($dbb,$query);

	return ($res=db_fetch($req));
}



function can_access_directory($id_directory) {
	global $dbb;
	$bool = false;

	$query0 = 'SELECT id_user FROM directory WHERE id='.$id_directory.' AND id_user='.$_SESSION['id'];
	$req0 = db_query($dbb,$query0);
	if($res0=db_fetch($req0)) return true;


	$query = 'SELECT id_deposit FROM deposit_contain WHERE id_directory='.$id_directory;
	$req = db_query($dbb,$query);

	while($res=db_fetch($req)) {
		$bool = $bool || can_access_deposit($res['id_deposit']);
	}

	return $bool;
}


function can_access_file($id_file) {
	global $dbb;
	$bool = false;

	$query = 'SELECT id_directory FROM directory_contain WHERE id_file='.$id_file;
	$req = db_query($dbb,$query);

	while($res=db_fetch($req)) {
		$bool = $bool || can_access_directory($res['id_directory']);
	}

	return $bool;
}



function get_content_deposit($id) { 
	global $dbb;
	$array = array();

	$query = 'SELECT id,date_creation,id_user FROM directory WHERE id IN (SELECT id_directory FROM deposit_contain WHERE id_deposit='.$id.')';

	while ( ($res=db_fetch($req)) ) {
		$query2 = 'SELECT firstname, lastname FROM user WHERE id='.$res['id_user'];
		$req2 = db_query($dbb,$query2);

		if ( ($res2=db_fetch($req2)) )
			array_push($array, array(	'id_content' => $res['id'],
										'name' => $res2['firstname']." ".$res2['lastname'],
										'type' => 'directory',
										'date_added' => $res['date_creation']));
	}
	return $array;
}



function get_content_directory($id) {
	global $dbb;
	$array = array();
	$query = 'SELECT id_file, name, date_added FROM directory_contain WHERE id_directory='.$id;

	$req = db_query($dbb,$query);
	while ( ($res=db_fetch($req)) ) {
		array_push($array, array(	'id_content' => $res['id_file'],
									'name' => get_file_type($res['id_file']),/*$res['name'],*/
									'type' => 'file',
									'date_added' => $res['date_added']));
	}
	return $array;
}



function get_employee_working_with_user($id_user) {
	global $dbb;
	$array = array();

	$query = 'SELECT id_user FROM employee WHERE id_company=(SELECT id_company FROM employee WHERE id_user='.$id_user.') ';
	$req = db_query($dbb,$query);

	while ( ($res=db_fetch($req)) ) {

		if($res['id_user']==$_SESSION['id']) continue;

		$query2 = 'SELECT firstname,lastname FROM user WHERE id='.$res['id_user'];
		$req2 = db_query($dbb,$query2);
		if ( ($res2=db_fetch($req2)) ) {
			array_push($array, array(	'id_content' => $res['id_user'],
										'name' => $res2['firstname']." ".$res2['lastname'],
										'type' => 'user',
										'date_added' => ""));
		}
	}
	return $array;
}



function get_directory_search($search) {
	global $dbb;

	$array = array();

	if(is_professional_account()) {
		$name = explode(" ", $search);
		if(count($name)>1) $str = 	'OR firstname LIKE "%'.$name[0].'%" OR lastname LIKE "%'.$name[1].'%"'.
									'OR firstname LIKE "%'.$name[1].'%" OR lastname LIKE "%'.$name[0].'%"';
		else $str = '';

		$query0 = 'SELECT id,firstname,lastname FROM user WHERE firstname LIKE "%'.$search.'%" OR lastname LIKE "%'.$search.'%" '.$str;
		$req0 = db_query($dbb,$query0);

		while ( ($res0=db_fetch($req0) )) {

			$query = 'SELECT id,date_creation,id_user FROM directory WHERE id_user='.$res0['id'];
			$req = db_query($dbb,$query);
			if ( ($res=db_fetch($req)) ) {

				$q2 = 'SELECT id_deposit FROM deposit_contain WHERE id_directory='.$res['id'];
				$query2 = 'SELECT name FROM deposit WHERE id=('.$q2.')';
				$req2 = db_query($dbb,$query2);
				if ( ($res2=db_fetch($req2)) ) {
					array_push($array, array(	'id_content' => $res['id'],
												'name' => $res2["name"].": ".$res0['firstname']." ".$res0["lastname"],
												'type' => 'directory',
												'date_added' => $res['date_creation']));
				}
			}
		}

	} else {
		$query = 'SELECT id,name FROM deposit WHERE name LIKE "%'.$search.'%"';
		$req = db_query($dbb,$query);
		while ( ($res=db_fetch($req) )) {
			array_push($array, array(	'id_content' => $res['id'],
										'name' => $res["name"],
										'type' => 'deposit',
										'date_added' => ''));
		}
	}

	return $array;
}


function get_content_home() {

	return array();
}


function get_should_content_deposit($id) {

	global $dbb;
	$array = array();

	$query = 'SELECT id_type FROM deposit_model WHERE id_deposit='.$id;
	$req = db_query($dbb,$query);

	while ( ($res=db_fetch($req)) ) {
		
		$id_type = $res['id_type'];
		$query2 = 'SELECT type FROM type WHERE id='.$id_type;
		$req2 = db_query($dbb,$query2);
		if ( ($res2=db_fetch($req2)) ) {

			$query3 = 'SELECT id FROM file WHERE id_type='.$id_type.' AND id_user='.$_SESSION['id'];
			$req3 = db_query($dbb,$query3);
			if(($res3=db_fetch($req3))) $date = $res3['id'];
			else $date = '';

			array_push($array, array(	'id_content' => $id_type,
										'name' => $res2['type'],
										'type' => 'file',
										'date_added' => $date));
		}
	}
	return $array;
}



function get_deposit_information($id) {
	global $dbb;
	$resu = array('name'=>'','description'=>'','number'=>0);

	$query = 'SELECT name FROM deposit WHERE id='.$id;
	$req = db_query($dbb,$query);

	if ( ($res=db_fetch($req)) ) {
		$resu['name'] = $res['name'];
		$resu['description'] = '';
	}

	$query2 = 'SELECT count(id_type) AS `num` FROM deposit_model WHERE id_deposit='.$id;
	$req2 = db_query($dbb,$query2);
	if ( ($res2=db_fetch($req2)) ) $resu['number'] = $res2['num'];

	return $resu;
}





function get_file_information($id_file) {
	global $dbb;
	global $root_adress;

	if(isset($_POST['submit']) && isset($_FILES['file']) && is_your_file($_GET['file'])) {
		$folder = download_file($_FILES['file'],$id_file);

		$query = 'UPDATE file SET address='.$folder.' WHERE id='.$id_file;
		db_query($dbb,$query);

		if(isset($_GET['file'])) {

			if(isset($_GET['directory'])) {
				header("Location: ".$root_adress."display.php?file=".$_GET['file']."&directory=".$_GET['directory']);
				die();
			}

			if(isset($_GET['deposit'])) {
				header("Location: ".$root_adress."display.php?file=".$_GET['file']."&deposit=".$_GET['deposit']);
				die();
			}

			header("Refresh:0");

		} else header("Refresh:0");
	}



	global $dbb;
	$resu = array('title'=>'','address'=>'');

	$query = 'SELECT address,id_type,id_user FROM file WHERE id='.$id_file;
	$req = db_query($dbb,$query);

	if ( ($res=db_fetch($req)) ) {
		$resu['address'] = $res['address'];

		$query3 = 'SELECT type FROM type WHERE id='.$res["id_type"];
		$req3 = db_query($dbb,$query3);
		if ( ($res3=db_fetch($req3)) ) {

			if($res["id_user"]==$_SESSION['id']) {
				$resu['title'] = 'Your '.$res3['type'];
			} else {
				$query2 = 'SELECT firstname,lastname FROM user WHERE id='.$res["id_user"];
				$req2 = db_query($dbb,$query2);
				if ( ($res2=db_fetch($req2)) ) {
					$resu['title'] = $res3['type'].': '.$res2['firstname']." ".$res2['lastname'];
				}
			}

		}
	}
	return $resu;
}



function get_file_type($id_file) {
	global $dbb;

	$query = 'SELECT id_type FROM file WHERE id='.$id_file;
	$req = db_query($dbb,$query);

	if ( ($res=db_fetch($req)) ) {

		$query2 = 'SELECT type FROM type WHERE id='.$res["id_type"];
		$req2 = db_query($dbb,$query2);
		if ( ($res2=db_fetch($req2)) ) {
			return $res2['type'];
		}
	}
	return '';
}



function get_annotations($content) {
	global $address_from_root ;
	global $root_adress;
	global $str_file_deposit_empty_for_moment,$str_when_someone_will_fulfil,$str_to_fulfil_go_to_address,$str_note,$str_no_results,$str_no_results_containing_all_search_term,$str_your_search,$str_did_not_match_any_doc;
	$title_annotations = '';
	$annotations = '';

	if(isset($_GET['create']) && $_GET['create']=="deposit") {
		return array('','','');
	}

	if(isset($_GET['deposit']) && count($content)<=0) {
		$title_annotations = $str_file_deposit_empty_for_moment;
		$annotations = $str_when_someone_will_fulfil.'<br>'.$str_to_fulfil_go_to_address.'
						<a href="'.$root_adress.'deposit.php?deposit='.$_GET['deposit'].'">'.$root_adress.'deposit.php?deposit='.$_GET['deposit'].'</a>';
		return array($title_annotations,$annotations);
	}

	if(isset($_GET['deposit'])) {
		$title_annotations = $str_note;
		$annotations = $str_to_fulfil_go_to_address.'
						<a href="'.$root_adress.'deposit.php?deposit='.$_GET['deposit'].'">'.$root_adress.'deposit.php?deposit='.$_GET['deposit'].'</a>';
		return array($title_annotations,$annotations);
	}

	if(isset($_GET['search'])) {
		if(count($content)<=0) {
			$title_annotations = $str_no_results;
			$annotations = $str_no_results_containing_all_search_term.'<br>'.
							$str_your_search.' - "'.$_GET['search'].'" - '.$str_did_not_match_any_doc;
		} else {
			$title_annotations = 'Results for "'.$_GET['search'].'"';
		}
		return array($title_annotations,$annotations);
	}

	if(isset($_GET['admin']) && $_GET['admin']=="true") {
		return array('','');
	}

    global $str_lets_get_started,$str_overview,$str_addoc_feat_file_management,$str_manage_your_account,$str_customize_xp_by_managing_settings,$str_to_access_to_your_account_page,$str_click_me_icon,$str_manage_file_deposit,$str_use_create_file_deposit_btn_t,$str_use_searchbar_to_pro,$str_key_icon;

	if(count($content)<=0) {
		$title_annotations = $str_lets_get_started;
		$annotations = '	<br><span class="annotations_title">'.$str_overview.'</span><br>
							'.$str_addoc_feat_file_management.'.<br>

							<br><span class="annotations_title">'.$str_manage_your_account.'</span><br>
							'.$str_customize_xp_by_managing_settings.'.
							'.$str_to_access_to_your_account_page.' 
							'.$str_click_me_icon.'<br>';
		if(is_professional_account())
			$annotations = $annotations.'
							<br><span class="annotations_title">'.$str_manage_file_deposit.'</span><br>
							'.$str_use_create_file_deposit_btn_t.'<br>
							'.$str_use_searchbar_to_pro.'<br>';

		$annotations = $annotations.'
							<br><span class="annotations_title">'.$str_key_icon.'</span><br>
							<img src="'.$address_from_root.'image/useful/deposit.png" alt="deposit" width="25px" height="25px"/>= Deposit<br>
							<img src="'.$address_from_root.'image/useful/repertory.png" alt="deposit" width="25px" height="25px"/>= Directory<br>
							<img src="'.$address_from_root.'image/useful/user.png" alt="deposit" width="25px" height="25px"/>= User<br>';
							/*<br><span class="annotations_title">Manage your directories</span><br>
							Use "Create Directory" button in the left panel to create a new directory in the current folder<br>
							Use the searchBar or use the left panel to find for a directory<br>*/
	}

	return array($title_annotations,$annotations);
}




function get_header_file($content) {
	global $dbb, $root_adress;
	global $str_error,$str_error_try_again_later,$str_file_deposit_name_already_created,$str_file_deposit_created,$str_pwd_updated,$str_successfully_modified_pwd,$str_click,$str_here,$str_to_return_to_your_home,$str_user_removed,$str_is_no_more_one_employee,$str_usage_changed,$str_now_using_pro_version,$str_now_create_file_deposit,$str_home;

	if((isset($_GET['directory']) && $_GET['directory']!="")) {

		$query1 = 'SELECT id_user, name FROM directory WHERE id='.$_GET['directory'];
		$req1 = db_query($dbb,$query1);
		if(($res=db_fetch($req1))) {

			if($res['id_user']==$_SESSION['id']) {
				$title = $res['name'];
				$subtitle = '';
				return array($title,$subtitle,'');
			} else {
				
				$query2 = 'SELECT firstname, lastname FROM user WHERE id='.$res['id_user'];
				$req2 = db_query($dbb,$query2);
				if(($res2=db_fetch($req2))) {
					$title = $res2['firstname']." ".$res2['lastname'];
					$subtitle = '';
					return array($title,$subtitle,'');
				}
			}

		} else return array($str_error,$str_error_try_again_later,'');


		return array($_GET['directory'],'','');

	} elseif((isset($_GET['deposit']) && $_GET['deposit']!="")) {

		$array = get_deposit_information($_GET['deposit']);
		return array($array['name'],$array['description'],'');

	} elseif(isset($_GET['create']) && $_GET['create']=="deposit") {

		if(isset($_POST['submit']) && !isset($_POST['select_type']) && check_value('name_hidden') && isset($_POST['description_hidden']) && check_value('number_files_hidden') && $_POST['number_files_hidden']!=0) {
		
			header('Refresh: 3; URL='.$root_adress.'home.php');
			$n = $_POST['number_files_hidden'];
			


			$query = 'SELECT id_user FROM employee WHERE id_company IN (SELECT id_company FROM employee WHERE id_user='.$_SESSION['id'].')';
			$query0 = 'SELECT id FROM deposit WHERE name='.$_POST['name_hidden'].' AND (id_user='.$_SESSION['id'].' OR id_user IN ('.$query.'))';
			$req = db_query($dbb,$query0);


			if ( !($res=db_fetch($req)) ) {

				$query = array();

				$query1 = 'INSERT INTO deposit (id_user, name) VALUES ('.$_SESSION['id'].', '.$_POST['name_hidden'].')';;

				array_push($query, $query1);

				$i=0;
				while(($i<$n) && isset($_POST['file'.$i])) {

					$query2 = 'INSERT INTO deposit_model (id_deposit, id_type) VALUES ((SELECT id FROM deposit WHERE id_user='.$_SESSION['id'].' AND name='.$_POST['name_hidden'].'), (SELECT id FROM type WHERE type='.$_POST['file'.$i].'))';
					array_push($query, $query2);
					$i++;
				}

				db_transaction($dbb,$query);

			} else {
				return array($_POST['name_hidden'].": ".$str_error,$str_file_deposit_name_already_created,'');
			}

			return array($_POST['name_hidden'],$str_file_deposit_created,'');
		}
		return array('','','');
	} elseif(isset($_GET['search'])) {
		return array('Search','','');
	} elseif(isset($_GET['admin']) && $_GET['admin']=="true") {

		if(isset($_GET['done']) && $_GET['done']=="true") {

			if(isset($_GET['password']) && $_GET['password']=="true") {
				$title = $str_pwd_updated;
				$subtitle = $str_successfully_modified_pwd.'<br>
							'.$str_click.' <a href="home.php" style="color: #f07d47;">'.$str_here.'</a> '.$str_to_return_to_your_home;
				return array($title,$subtitle,'');
			}

			if(isset($_GET['user']) && $_GET['user']!="") {
				$array = get_user_info($_GET['user']);
				if($array[0]==-1) array('','','');

				$title = $str_user_removed;
				$subtitle = $array[0].' '.$array[1].' '.$str_is_no_more_one_employee.'<br>
							'.$str_click.' <a href="home.php" style="color: #f07d47;">'.$str_here.'</a> '.$str_to_return_to_your_home;
				return array($title,$subtitle,'');
			}

			if(isset($_GET['usage']) && $_GET['usage']=="pro") {
				$title = $str_usage_changed;
				$subtitle = ' '.$str_now_using_pro_version.'<br>
							'.$str_now_create_file_deposit.'<br>
							'.$str_click.' <a href="home.php" style="color: #f07d47;">'.$str_here.'</a> '.$str_to_return_to_your_home;
				return array($title,$subtitle,'');
			}
		}

		return array('','','');
	} else {
		return array($str_home,'','');
	}
}





function get_files($content) {
	$files = array();

	if(check_value('select_type') && check_value('name_hidden') && check_value('number_files_hidden') && isset($_POST['description_hidden'])) {

		$n = $_POST['number_files_hidden'];

		array_push($files, create_file_value($n-1,'',$_POST['select_type'],''));
		$i=0;
		while(($i<$n-1) && isset($_POST['file'.$i])) {
			array_push($files, create_file_value($i,'',$_POST['file'.$i],''));
			$i++;
		}

		return $files;

	}

	for($i=0;$i<count($content);$i++) {
		array_push($files,create_file_value($content[$i]['id_content'],$content[$i]['type'],$content[$i]['name'],$content[$i]['date_added']));
	}

	return $files;
}



/*Renvoit tous les types de fichier que l'on peut mettre (utile lors de la creation d'un nouveau depot d efichier*/
function get_type_file_values() {

	global $dbb;
	$query = 'SELECT id,type FROM type';
	$req = db_query($dbb,$query);

	if ( ($res=db_fetch($req)) ) {
		$resu = array();
		array_push($resu, $res['type']);
		while( ($res=db_fetch($req)) ) {
			array_push($resu, $res['type']);
		}
		return $resu;
	}
	return array();
}



function get_type_file_id($id_deposit) {

	global $dbb;
	$query = 'SELECT id_type FROM deposit_model WHERE id_deposit='.$id_deposit;
	$req = db_query($dbb,$query);

	if ( ($res=db_fetch($req)) ) {
		$resu = array();
		array_push($resu, $res['id_type']);
		while( ($res=db_fetch($req)) ) {
			array_push($resu, $res['id_type']);
		}
		return $resu;
	}
	return array();
}


function is_professional_account() {

	global $dbb;

	$query = 'SELECT id_company FROM employee WHERE id_user='.$_SESSION['id'];
	$req = db_query($dbb,$query);

	return ($res=db_fetch($req));
		
}


function is_your_file($id_file) {
	global $dbb;

	$query = 'SELECT id_user FROM file WHERE id='.$id_file;
	$req = db_query($dbb,$query);

	if ($res=db_fetch($req)) {
		return ($res['id_user']==$_SESSION['id']);
	} else return false;
}



function account_exist($email) {

	global $dbb;

	$query = 'SELECT id FROM user WHERE email='.$email;
	$req = db_query($dbb,$query);

	return ($res=db_fetch($req));
		
}


function account_already_company($email) {

	global $dbb;

	$query = 'SELECT id_company FROM employee WHERE id_user=(SELECT id FROM user WHERE email='.$email.')';
	$req = db_query($dbb,$query);

	return ($res=db_fetch($req));
		
}



function get_user_info($id) {

	global $dbb;

	$query = 'SELECT firstname,lastname,email FROM user WHERE id='.$id;
	$req = db_query($dbb,$query);
	if($res=db_fetch($req)) {
		return array($res['firstname'],$res["lastname"],$res["email"]);
	}

	return array(-1,-1,-1);
		
}



function remove_employee_from_company($id) {
	global $dbb;

	$query = 'DELETE FROM employee WHERE id_user='.$id;
	$req = db_query($dbb,$query);
}



function get_form_input() {
	global $root_adress;
	global $str_using_personnal_version,$str_usage,$str_with_pro_version_can_create_deposit,$str_move_to_pro,$str_pls_enter_name_orga,$str_can_not_insert_special_char_name_orga,$str_name_of_your_organisation,$str_url_optionnal,$str_pls_insert_email,$str_remove_employee_from_company,$str_user_does_not_exist,$str_user_already_in_a_company,$str_email_of_employee,$str_add_employee;
	
	global $str_wrong_pwd,$str_pwd_6_char_or_more,$str_pls_insert_old_pwd,$str_pls_insert_new_pwd,$str_pls_insert_confirm_new_pwd,$str_new_pwd_and_confirm_new_pwd_not_same,$str_old_pwd,$str_new_pwd,$str_confirm_new_pwd,$str_change_your_pwd,$str_update;
	
	global $str_add_a_file,$str_file_name,$str_file_deposit_name,$str_description_of_deposit,$str_number_of_files,$str_create_deposit,$str_choose_type_file,$str_what_should_complete_file_contai,$str_click_add_file_to,$str_insert_name_file_deposit,$str_continue;

	if(isset($_GET['admin']) && $_GET['admin']=="true" && !isset($_GET['done'])) {

		if(isset($_GET['usage']) && $_GET['usage']="true") {
			$title = $str_usage;
			$subtitle = $str_using_personnal_version.'<br>
						'.$str_with_pro_version_can_create_deposit.'.';
			$button = $str_move_to_pro;
			$url_value = '';
			$error = '';

			if(isset($_POST['name_organisation']) && $_POST['name_organisation']=="") {
				$error = $str_pls_enter_name_orga.". ";
			} elseif(isset($_POST['name_organisation']) && contains_special_char($_POST['name_organisation'])) {
				$error = $str_can_not_insert_special_char_name_orga.". ";
			} elseif(check_value('name_organisation') && isset($_POST['url'])) {
				create_company($_POST['name_organisation'],$_POST['url'],$_SESSION['email']);
				header("Location: ".$root_adress."home.php?done=true&usage=pro&admin=true");
				die();
			}

			$input1 = array("text",$str_name_of_your_organisation,"name_organisation","",'');
			$input2 = array("url",$str_url_optionnal,"url",$url_value,'');

			return array($title,$subtitle,$button,array($input1,$input2),$error);
		}

		if(isset($_GET['user']) && $_GET['user']!="") {

			if(isset($_POST['submit'])) {
				remove_employee_from_company($_GET['user']);
				header("Location: ".$root_adress."home.php?done=true&user=".$_GET['user']."&admin=true");
				die();
			}

			$array = get_user_info($_GET['user']);
			if($array[0]==-1) return array('','','',array(),'');
			$title = $array[0].' '.$array[1];
			$subtitle = 'Email: '.$array[2];

			return array($title,$subtitle,$str_remove_employee_from_company,array(),'');
		}

		if(isset($_GET['employee']) && $_GET['employee']=="true") {

			$error = '';
			if(isset($_POST['add_employee_email']) && $_POST['add_employee_email']=="") {
				$error = $str_pls_insert_email;
			} elseif(isset($_POST['add_employee_email']) && !account_exist($_POST['add_employee_email'])) {
				$error = $str_user_does_not_exist;
			} elseif(isset($_POST['add_employee_email']) && account_already_company($_POST['add_employee_email'])) {
				$error = $str_user_already_in_a_company;
			} elseif(isset($_POST['add_employee_email']) && account_exist($_POST['add_employee_email'])) {

				add_employee_company($_POST['add_employee_email']);
				header("Refresh:0");
				die();
			}

			$input1 = array('email',$str_email_of_employee,'add_employee_email','','');
			return array('','',$str_add_employee,array($input1),$error);
		}

		if(isset($_GET['password']) && $_GET['password']=="true") {

			$bool = isset($_POST['old_pwd']) && isset($_POST['new_pwd1']) && isset($_POST['new_pwd2']);
			$bool2 = $bool ? ($_POST['old_pwd']!="") && ($_POST['new_pwd1']!="") && ($_POST['new_pwd2']!="") : false;
			$bool3 = $bool2 ? (strlen($_POST['new_pwd1'])>5) : false;
			$bool4 = $bool3 ? ($_POST['new_pwd1']==$_POST['new_pwd2']) : false;
			$error = '';

			if($bool4) {
				$statut = update_password($_POST['old_pwd'],$_POST['new_pwd1']);
				if($statut) {

					header("Location: ".$root_adress."home.php?done=true&admin=true&password=true");
					die();
					return array('','','',array(),'');
					
				}
				else $error = $str_wrong_pwd.". ";
			}


			if($bool2 && !$bool3) {
				if(strlen($_POST['new_pwd1'])<6) $error = $error.$str_pwd_6_char_or_more.". ";
			}


			if($bool && !$bool2) {
				if($_POST['old_pwd']=="") $error = $error.$str_pls_insert_old_pwd.". ";
				if($_POST['new_pwd1']=="") $error = $error.$str_pls_insert_new_pwd.". ";
				if($_POST['new_pwd2']=="") $error = $error.$str_pls_insert_confirm_new_pwd.". ";
			} 

			if($bool3 && !$bool4) {
				$error = $error.$str_new_pwd_and_confirm_new_pwd_not_same;
			}


			$array = array();

			$input1 = array('password',$str_old_pwd,'old_pwd','','');
			$input2 = array('password',$str_new_pwd,'new_pwd1','','');
			$input3 = array('password',$str_confirm_new_pwd,'new_pwd2','','');

			array_push($array, $input1);
			array_push($array, $input2);
			array_push($array, $input3);

			return array($str_change_your_pwd,'',$str_update,$array,$error);
		}

		return array('','','',array(),'');

	} elseif(!isset($_GET['create']) || $_GET['create']!="deposit") {
		return array('','','',array(),'');
	} else {
		$bool_val1 = isset($_POST['name_deposit']) && $_POST['name_deposit']=="";

		if(isset($_POST['submit']) && !isset($_POST['select_type']) && check_value('name_hidden') && isset($_POST['description_hidden']) && check_value('number_files_hidden') && $_POST['number_files_hidden']!=0) {

			return array('','','',array(),'');

		} elseif(check_value('select_type') && check_value('name_hidden') && check_value('number_files_hidden') && isset($_POST['description_hidden'])) {

			$name = $_POST['name_hidden'];
			$description = $_POST['description_hidden'];
			$n = $_POST['number_files_hidden'];
			$array = array();

			$submit = array('submit','','add_submit',$str_add_a_file,'');
			array_push($array, array('hidden',$str_file_name,'file'.($n-1),$_POST['select_type'],'readonly'));
			$i=0;
			while(($i<$n-1) && isset($_POST['file'.$i])) {
				array_push($array, array('hidden',$str_file_name,'file'.$i,$_POST['file'.$i],'readonly'));
				$i++;
			}
			$input1 = array('hidden',$str_file_deposit_name,'name_hidden',$name,'');
			$input2 = array('hidden',$str_description_of_deposit,'description_hidden',$description,'');
			$input3 = array('hidden',$str_number_of_files,'number_files_hidden',$n,'');

			array_push($array, $submit);
			array_push($array, $input1);
			array_push($array, $input2);
			array_push($array, $input3);

			return array($name,$description,$str_create_deposit,$array,'');

		} elseif(check_value('name_hidden') && isset($_POST['description_hidden']) && check_value('number_files_hidden')) {

			$n = $_POST['number_files_hidden'];
			$name = $_POST['name_hidden'];
			$description = $_POST['description_hidden'];
			$array = array();

			$i=0;
			while(($i<$n) && isset($_POST['file'.$i])) {
				array_push($array, array('hidden','File '.$i,'file'.$i,$_POST['file'.$i],''));
				$i++;
			}

			$values = get_type_file_values();
			$select = array('select',$str_choose_type_file,'select_type',$values,'');
			$input1 = array('hidden',$str_file_deposit_name,'name_hidden',$name,'');
			$input2 = array('hidden',$str_description_of_deposit,'description_hidden',$description,'');
			$input3 = array('hidden',$str_number_of_files,'number_files_hidden',$n+1,'');

			array_push($array, $select);
			array_push($array, $input1);
			array_push($array, $input2);
			array_push($array, $input3);

			return array($name,'',$str_add_a_file,$array,'');

		} elseif(check_value('name_deposit') && isset($_POST['description_deposit']) && check_value('number_files_hidden')) {

			$n = $_POST['number_files_hidden'];
			$name = $_POST['name_deposit'];
			$description = $_POST['description_deposit'];
			$indications = $str_what_should_complete_file_contain."<br>".$str_click_add_file_to;

			$input1 = array('hidden',$str_file_deposit_name,'name_hidden',$name,'');
			$input2 = array('hidden',$str_description_of_deposit,'description_hidden',$description,'');
			$input3 = array('hidden',$str_number_of_files,'number_files_hidden','0','');

			return array($name,$description,$str_add_a_file,array($input1,$input2,$input3),$indications);

		} else {

			$error = "";
			$input2_val = isset($_POST['description_deposit']) ? $_POST['description_deposit'] : "";
			$input1_val = isset($_POST['name_deposit']) ? $_POST['name_deposit'] : "";
			if($bool_val1) $error = "Please insert a name for the new File Deposit. ";

			$input1 = array('text',$str_file_deposit_name ,'name_deposit',$input1_val,'');
			$input2 = array('textarea',$str_description_of_deposit,'description_deposit',$input2_val,'');
			$input3 = array('hidden',$str_number_of_files,'number_files_hidden','0','');

			return array($str_create_deposit,'',$str_continue,array($input1,$input2,$input3),$error);
		}
	}
}


function add_employee_company($email) {
	global $dbb;

	$q1 = 'SELECT id FROM user WHERE email='.$email;
	$q2 = 'SELECT id_company FROM employee WHERE id_user='.$_SESSION['id'];

	$r1 = db_query($dbb,$q1);
	if( ($re1=db_fetch($r1)) ) {
		$r2 = db_query($dbb,$q2);
		if( ($re2=db_fetch($r2)) ) {
			$query ='INSERT INTO employee (id_user,id_company) VALUES ('.$re1['id'].','.$re2['id_company'].')';
			$req = db_query($dbb,$query);
		}
	}
}



function create_new_directory($name,$description,$id_user,$fi,$input,$n,$deposit_id,$files_array) {
	global $dbb;
	$type_file = get_type_file_id($deposit_id);
	if (count($type_file)!=$n) {echo "PB, n=".$n.' et count($type_file)='.count($type_file) ;exit(22);}

	$query0 = 'INSERT INTO directory (id_user, name)  VALUES ('.$id_user.', '.$name.')';
	$req0 = db_query($dbb,$query0);


	$query1 = 'SELECT id FROM directory WHERE name='.$name.' AND id_user='.$id_user;
	$req1 = db_query($dbb,$query1);
	if ( ($res1=db_fetch($req1)) ) $id_directory = $res1['id'];
	else exit(0);


	$query2 = 'INSERT INTO deposit_contain (id_deposit, id_directory, annotations)  VALUES ('.$deposit_id.', '.$id_directory.', '.$description.')';
	$req2 = db_query($dbb,$query2);


	for($i=0;$i<$n;$i++) {
		if(isset($input['file'.$i])) {
			$file_id = $input['file'.$i];
			$name_file = '';

			$query3 = 'SELECT type FROM type WHERE id='.$file_id;
			$req3 = db_query($dbb,$query3);
			if ( ($res3=db_fetch($req3)) ) $name_file = $res3['type'];

		} else {
			$query3 = 'INSERT INTO file (id_type, id_user, address)  VALUES ('.$type_file[$i].', '.$id_user.', '.$id_user."file".$i.')';
			$req3 = db_query($dbb,$query3);

			$query4 = 'SELECT id FROM file WHERE address='.$id_user."file".$i.' AND id_user='.$id_user;
			$req4 = db_query($dbb,$query4);

			if ( ($res4=db_fetch($req4)) ) {
				$file_id = $res4['id'];
				$folder = download_file($fi['file'.$i],$file_id);
				if($folder=="") exit(0);

				$query5 = 'UPDATE file SET address='.$folder.' WHERE id='.$file_id;
				$req5 = db_query($dbb,$query5);

				$name_file = $fi['file'.$i]['name'];
			}
		}


		$query6 = 'INSERT INTO directory_contain (id_directory, id_file, name)  VALUES ('.$id_directory.', '.$file_id.', '.$name_file.')';
		$req6 = db_query($dbb,$query6);

	}
}



function update_file($id_user,$id_type,$address) {

	$query1 = 'UPDATE FROM file SET address='.$address.' WHERE id_type='.$id_type.' AND id_user='.$id_user.'';
	$req1 = db_query($dbb,$query1);

}
