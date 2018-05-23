<?php

function db_query($db,$query){
	return pg_query( $db , $query  );
}

function db_fetch($rep){
	return pg_fetch_assoc( $rep );
}

function print_tab_pays($id_pays) {
    $requete="SELECT nom_p, code_p, devise, langue, capitale, continent FROM Pays WHERE id_p=$id_pays;";
    $conn=db_connect(../data/db.sql);
    if (!$conn) echo 'erreur: connexion à la base de données impossible';
    $result =  db_query($conn,$requete);
    if (!$result) echo 'erreur: la requête ne peut pas être executée';
    if (db_count($result)==0) echo 'erreur: pas de pays trouvé avec le numéro donné';
    else {
        $row=db_fetch($result);
        echo "<table>
          <caption>Quelques informations sur ce pays</caption>
          <tr><th>Nom du Pays</th><th>Code ISO</th><th>Devise</th><th>Langue</th><th>Capitale</th><th>Continent</th></tr>
          <tr><td>$row['nom_p']</td><td>$row['code_p']</td><td>$row['devise']</td><td>$row['langue']</td><td>$row['capitale']</td><td>$row['continent']</td></tr>
        </table>";
    }
}

function print_drapeau($id_pays) {
  $requete="SELECT drapeau FROM Pays WHERE id_p=$id_pays;";
  $conn=db_connect();
  if (!$conn) echo 'erreur: connexion à la base de données impossible';
  $result =  db_query($conn,$requete);
  if (!$result) echo 'erreur: la requête ne peut pas être executée';
  if (db_count($result)==0) echo 'erreur: pas de pays trouvé avec le nom donné';
  else {
    $row=db_fetch($result);
    echo "<img src="$row['drapeau']" alt="Drapeau du Pays" />";
  }
}

function print_liste_villes($id_pays) {
  $requete="SELECT nom_v FROM Ville NATURAL JOIN Pays WHERE id_p=$id_pays;";
  $conn=db_connect();
  if (!$conn) echo 'erreur: connexion à la base de données impossible';
  $result =  db_query($conn,$requete);
  if (!$result) echo 'erreur: la requête ne peut pas être executée';
  if (db_count($result)==0) echo 'erreur: pas de pays trouvé avec le nom donné';
  else {
    $row=db_fetch($result);
    //faire la liste des villes
  }
}

function print_lien_pays($id_pays) {
  $requete="SELECT lienwiki_p FROM Pays WHERE id_p=$id_pays;";
  $conn=db_connect();
  if (!$conn) echo 'erreur: connexion à la base de données impossible';
  $result =  db_query($conn,$requete);
  if (!$result) echo 'erreur: la requête ne peut pas être executée';
  if (db_count($result)==0) echo 'erreur: pas de pays trouvé avec le nom donné';
  else {
    $row=db_fetch($result);
    echo "<a href='$row['lienwiki_p']'>Lien du site Wikipedia :</a>";
  }
}

?>
