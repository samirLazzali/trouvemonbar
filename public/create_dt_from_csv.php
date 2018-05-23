<?php
$handle = fopen("crt_data.csv", "r");

$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");





while (($tab = fgetcsv($handle, 1000, ',')) != FALSE) {
	$categorie = $tab[0];
	$types = $tab[1];
	$marque = $tab[2];
	$prix = $tab[3];
	$date_de_peremption = $tab[4];
	$reduction = $tab[5];
	$quantite = $tab[6];
	$id_centre_commercial = $tab[7];
	$image = $tab[8];
	echo $categorie;
	$connection->exec("INSERT INTO Produit(categorie, types, marque, prix, date_de_peremption, reduction, quantite, id_centre_commercial, image)
    	VALUES ('$categorie', '$types', '$marque', '$prix', '$date_de_peremption', '$reduction', '$quantite', '$id_centre_commercial', '$image')");
	for ($i=0; $i < sizeof($tab); $i++) { 
		echo $tab[$i]."<br />";
	}
}




?>