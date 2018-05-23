<?php

$pays = $POST[’recherche_pays’];
echo " <p>Résultat pour la recherche : $pays  <br/>";
/*on veut un pays qui contienne la chaine rentree*/

$requete = "SELECT * FROM Pays WHERE nom_p LIKE ’%$pays%’;";
$connexion = pg_connect("host=localhost dbname=db.sql");
$reponse = pg_query($connexion, $requete);
if($reponse){
$nbTuples = pg_num_rows($reponse);
echo "<ul>";
while ($tupleCourant = pg_fetch_assoc($reponse)){
echo "<li> Nom du pays :  $tupleCourant[’nom_p’], ";
echo "Capitale :  $tupleCourant[’capitale’]</li>";
}
echo "</ul>";
}
else{echo "Probleme a l execution de la requete sur les pays";}
pg_close($connexion);
echo "</p>";
?>
