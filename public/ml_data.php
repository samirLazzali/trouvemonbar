<?php
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");


//Premiere ligne = nom des champs (
$xls_output = "\"\",\"id_produit\",\"id_utilisateur\",\"etoile\"";
$xls_output .= "\n";

//Requete SQL
$rep = $connection->query("SELECT id_produit, ut.id_utilisateur, etoile FROM note AS nt JOIN utilisateur AS ut ON nom_utilisateur = nt.id_utilisateur ORDER BY ut.id_utilisateur;")->fetchAll();

$i = 1;
//Boucle sur les resultats
foreach ($rep as $data) {
	$xls_output .= "\"$i\",$data[id_produit],$data[id_utilisateur],$data[etoile]\n";
}

 
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: attachment; filename=data.csv");
print $xls_output;
exit;
?>