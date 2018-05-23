<?php

function db_query($db,$query){
	return pg_query( $db , $query  );
}

function db_fetch($rep){
	return pg_fetch_assoc( $rep );
}

function print_tab_ville($id_ville) {
    $requete="SELECT nom_v, nom_p, population, superficie FROM Ville WHERE id_v=$id_ville;";
    $conn=db_connect();
    if (!$conn) echo 'erreur: connexion à la base de données impossible';
    $result =  db_query($conn,$requete);
    if (!$result) echo 'erreur: la requête ne peut pas être executée';
    if (db_count($result)==0) echo 'erreur: pas de ville trouvée avec le nom donné';
    else {
        $row=db_fetch($result);
        echo "<table>
          <caption>Quelques informations sur cette ville</caption>
          <tr><th>Nom de la ville</th><th>Pays</th><th>Population</th><th>Superficie</th></tr>
          <tr><td>$row['nom_v']</td><td>$row['nom_p']</td><td>$row['population']</td><td>$row['superficie']</td></tr>
        </table>";
    }
}

function print_liste_st($id_ville) {
  $requete="SELECT nom_st FROM Site_touristique NATURAL JOIN Ville WHERE id_v=$id_ville;";
  $conn=db_connect();
  if (!$conn) echo 'erreur: connexion à la base de données impossible';
  $result =  db_query($conn,$requete);
  if (!$result) echo 'erreur: la requête ne peut pas être executée';
  if (db_count($result)==0) echo 'erreur: pas de ville trouvée avec le nom donné';
  else {
    $row=db_fetch($result);
    //faire la liste des sites touristiques
  }
}

function print_lien_ville($id_ville) {
  $requete="SELECT lienwiki_v FROM Ville WHERE id_v=$id_ville;";
  $conn=db_connect();
  if (!$conn) echo 'erreur: connexion à la base de données impossible';
  $result =  db_query($conn,$requete);
  if (!$result) echo 'erreur: la requête ne peut pas être executée';
  if (db_count($result)==0) echo 'erreur: pas de ville trouvée avec le nom donné';
  else {
    $row=db_fetch($result);
    echo "<a href='$row['lienwiki_v']'>Lien du site Wikipedia :</a>";
  }
}

?>
