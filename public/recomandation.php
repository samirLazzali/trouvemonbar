<?php

session_start();


$handle = fopen("../src/recomand.csv", "r");

$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$_SESSION['produit_1'] =1;
$_SESSION['produit_2'] =2;
$_SESSION['produit_3'] =3;
$_SESSION['produit_4'] =4;
$_SESSION['produit_5'] =5;

if (isset($_SESSION['id_utilisateur'])){
	$id = $_SESSION['id_utilisateur'];
	$i = 0;
	$mat = [];
	while (($tab = fgetcsv($handle, 1000, ',')) != FALSE){
		$mat[$i] = $tab;
		$i++;
	}
    if ($id-1 < $i ) {
        $_SESSION['produit_1'] = $mat[0][$id - 1];
        $_SESSION['produit_2'] = $mat[1][$id - 1];
        $_SESSION['produit_3'] = $mat[2][$id - 1];
        $_SESSION['produit_4'] = $mat[3][$id - 1];
        $_SESSION['produit_5'] = $mat[4][$id - 1];
    }
    else{
        $_SESSION['produit_1'] =1;
        $_SESSION['produit_2'] =2;
        $_SESSION['produit_3'] =3;
        $_SESSION['produit_4'] =4;
        $_SESSION['produit_5'] =5;
    }
}

/*echo $_SESSION['produit_1'];
echo $_SESSION['produit_2'];
echo $_SESSION['produit_3'];
echo $_SESSION['produit_4'];
echo $_SESSION['produit_5'];*/

?>