<?php
session_start();

include('../model.php');

if(!isset($_SESSION['connected']) || !$_SESSION['connected']) {
	header('Location: index.php');
}

if(isset($_GET['disconnected'])) {
	session_destroy();
	header('Location: index.php');
}


function create_tab_user() {
	global $dbb;
	$array = array();
	$query = 'SELECT id,firstname,lastname,email,pwd,date_signedup FROM user';
	$req = db_query($dbb,$query);

	while ( ($res=db_fetch($req)) ) {
		array_push($array, array($res['id'],$res['firstname']." ".$res["lastname"],$res["email"],$res["pwd"],$res["date_signedup"]));
	}

	return $array;
}

function create_tab_deposit() {
	global $dbb;
	$array = array();
	$query = 'SELECT id,id_user,date_creation,name FROM deposit';
	$req = db_query($dbb,$query);

	while ( ($res=db_fetch($req)) ) {
		array_push($array, array($res['id'],$res['name'],$res['id_user'],'YES',$res["date_creation"]));
	}

	return $array;
}

function create_tab_directory() {
	global $dbb;
	$array = array();
	$query = 'SELECT id,id_user,date_creation,name FROM directory';
	$req = db_query($dbb,$query);

	while ( ($res=db_fetch($req)) ) {
		array_push($array, array($res['id'],$res['name'],$res['id_user'],'YES',$res["date_creation"]));
	}

	return $array;
}

function display_tab_element($tab,$head) {
	print "<div class=\"limiter\">
			<div class=\"container-table100\">
				<div class=\"wrap-table100\">
					<div class=\"table100 ver2 m-b-110\">\n";
	print "			<div class=\"table100-head\">
						<table>
							<thead>
								<tr class=\"row100 head\">\n";
	for($i=1;$i<6;$i++) {
		print "							<th class=\"cell100 column".$i."\">".$head[$i-1]."</th>\n";
	}
	print "						</tr>
							</thead>
						</table>
					</div>

					<div class=\"table100-body js-pscroll\">
						<table>
							<tbody>\n";
	for($i=0;$i<count($tab);$i++) {
		print "						<tr class=\"row100 body\">\n";
		for($j=0;$j<5;$j++) {
			print "							<td class=\"cell100 column".($j+1)."\">".$tab[$i][$j]."</td>\n";
		}
		print "						</tr>\n";
	}
	print "					</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>\n";
}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="home.css">
		<title></title>
	</head>
	<body>
		<div class="tabs">
			<div class="tab">
				<input name="checkbox-tabs-group" type="radio" id="checkbox1" class="checkboxtab" checked>
				<label for="checkbox1">User</label>
				<div class="content">
<?php
$tab = create_tab_user();
$head = array('id','user','email','pwd','date signed up');
display_tab_element($tab,$head);
?>
				</div>
			</div>
			
			<div class="tab">
				<input name="checkbox-tabs-group" type="radio" id="checkbox2" class="checkboxtab">
				<label for="checkbox2">Deposit</label>
				<div class="content">
<?php
$tab = create_tab_deposit();
$head = array('id','name','id user','active','date creation');
display_tab_element($tab,$head);
?>
				</div>
			</div>
			
			<div class="tab">
				<input name="checkbox-tabs-group" type="radio" id="checkbox3" class="checkboxtab">
				<label for="checkbox3">Directory</label>
				<div class="content">
<?php
$tab = create_tab_directory();
$head = array('id','name','id user','active','date creation');
display_tab_element($tab,$head);
?>
				</div>
			</div>
		</div>
		<a href="?disconnected=true" class="button">Disconnect</a>
	</body>
</html>