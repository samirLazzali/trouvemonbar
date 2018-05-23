<?php

function db_query($db,$query){
	return pg_query( $db , $query  );
}

function db_fetch($rep){
	return pg_fetch_assoc( $rep );
}

function print_tab_st($id_sitet) {
    $requete="SELECT nom_st, nom_v FROM Stite_touristique WHERE id_st=$id_sitet;";
    $conn=db_connect();
    if (!$conn) echo 'erreur: connexion à la base de données impossible';
    $result =  db_query($conn,$requete);
    if (!$result) echo 'erreur: la requête ne peut pas être executée';
    if (db_count($result)==0) echo 'erreur: pas de site touristique trouvé avec le nom donné';
    else {
        $row=db_fetch($result);
        echo "<table>
          <caption>Quelques informations sur ce site touristique</caption>
          <tr><th>Nom du site</th><th>Ville</th></tr>
          <tr><td>$row['nom_st']</td><td>$row['nom_v']</td></tr>
        </table>";
    }
}

function print_lien_st($id_sitet) {
  $requete="SELECT lienwiki_st FROM Site_touristique WHERE id_s=$id_sitet;";
  $conn=db_connect();
  if (!$conn) echo 'erreur: connexion à la base de données impossible';
  $result =  db_query($conn,$requete);
  if (!$result) echo 'erreur: la requête ne peut pas être executée';
  if (db_count($result)==0) echo 'erreur: pas de site touristique trouvé avec le nom donné';
  else {
    $row=db_fetch($result);
    echo "<a href='$row['lienwiki_st']'>Lien du site Wikipedia :</a>";
  }
}

?>
