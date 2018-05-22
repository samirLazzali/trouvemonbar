<?php
   $dbName = getenv('DB_NAME');
   $dbUser = getenv('DB_USER');
   $dbPassword = getenv('DB_PASSWORD');
   $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

   if(array_key_exists("ajouequip",$_POST) && $_POST['ajouequip']){
       $match = $_POST['equipe1'] . " - " . $_POST['equipe2'];
       $date = $_POST['matchdate'];
       $requete = "INSERT INTO matchs(nom_match,date_m,cote_1,cote_N,cote_2) VALUES ('$match', '$date', '0','0','0');";	
       $rep = $connection->prepare($requete);
       $rep->execute();
      
   }
   if(array_key_exists("supprequip",$_POST) && $_POST['supprequip']){
       $match = $_POST['equipe1'] . " - " . $_POST['equipe2'];
       $requete = "DELETE FROM pronostics WHERE match_n = '$match';";
       $rep = $connection->prepare($requete);
       $rep->execute();
       $requete = "DELETE FROM matchs WHERE nom_match = '$match';";
       $rep = $connection->prepare($requete);
       $rep->execute();
   }
   if(array_key_exists("banuser",$_POST) && $_POST['banuser']){
       $nom = $_POST['user'];
       $requete = "UPDATE utilisateur SET mdp = '-1' WHERE nom = '$nom';";
       $rep = $connection->prepare($requete);
       $rep->execute();
   }
   if(array_key_exists("score",$_POST) && $_POST['score']){
     $match = $_POST['match'];
     $sc = $_POST['res'];

     $requete = "UPDATE matchs SET resultat = '$sc' WHERE nom_match = '$match';";
     $rep = $connection->prepare($requete);
     $rep->execute();

     $cote = 0;
     if($sc == 1){
       $requete = "SELECT cote_1 FROM matchs WHERE nom_match = '$match';";
       $rep = $connection->prepare($requete);
       $rep->execute();
       $cotep = $rep->fetch();
       $cote = $_POST['cote1'];
     }
     else if($sc == 2){
       $requete = "SELECT cote_2 FROM matchs WHERE nom_match = '$match';";
       $rep = $connection->prepare($requete);
       $rep->execute();
       $cotep = $rep->fetch();
       $cote = $_POST['cote2'];
     }
     else{
       $requete = "SELECT cote_N FROM matchs WHERE nom_match = '$match';";
       $rep = $connection->prepare($requete);
       $rep->execute();
       $cotep = $rep->fetch();
       $cote = $_POST['coteN'];
     }

     $requete = "SELECT id_grp,utilisateur_n,mise FROM pronostics WHERE match_n = '$match' AND pron = '$sc'";
     $rep = $connection->prepare($requete);
     $rep->execute();

     foreach($rep as $a){
       $grp = $a['id_grp'];
       $user = $a['utilisateur_n'];
       $gain = $a['mise'] * $cote;
       $requete = "UPDATE groupe SET solde = solde + '$gain'  WHERE id_grp = '$grp' AND utilisateur_n = '$user';";
       $rep = $connection->prepare($requete);
       $rep->execute();
     }
   }

   header('Location: membre.php');
   ?>