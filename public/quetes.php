<?php

/* Ce fichier affiche l'onglet quetes, où apparaissent :
   - soit les missions disponibles 
   - soit le temps restant à la quête
   suivant si le joueur est en quête ou non.*/

session_start() ;
include("pageAccueil.php") ;
include("donneesPerso.php") ;


enTete("Quêtes") ;

onglets() ;

fin_enTete() ;

if (estEnQuete()) {
    afficher_enQuete();
}
else{
    afficher_quetes() ;
}

pied() ;


/* Cette fonction affiche l'ensemble des quêtes disponibles trié par ordre croissant de niveau requis.*/
function afficher_quetes() {
    print " <h2> Quêtes disponibles : <h2> " ;
    print "<br/>" ;
    $tab = diff_quetes() ; /* Résultat de la recherche des quêtes dans la base de données.*/
    $tab2 = $_SESSION['tab'] ;
    $i = 0 ;

    while ($i < $tab->rowCount()) { /* On parcours l'ensemble des quêtes pour les afficher avec leurs propriétés (nom, niveau requis, récompense en or, durée).*/
        $i = $i+1 ;
        $row = $tab->fetch() ;
        if ($row[0] == 'Recherche_Pantoufle') {
            print "<h2> Recherche Pantoufle </h2>" ; /* Nom de la quête.*/
            print "<p> Ma chère poule dénommée pantoufle a disparue, trouvez la et rapportez la moi, elle a des plumes, une crete sur la tête et un bec, c'est la plus belle poule du monde ! </p>" ; /* Objectif.*/
            print "<ul>" ;
            print "<li> Niveau requis : $row[1] </li>" ; /* Niveau requis permettant l'accès à la quête.*/
            print "<li> Récompense : $row[2] </li>" ; /*Récompense en or.*/
            print "<li> Temps : $row[3] </li>" ; /*Durée de la quête.*/
            print "</ul>" ;
            if ($tab2[14] >= $row[1]) { /* Si le niveau du joueur est inférieur au niveau requis, on bloque l'accès à la quête. Sinon un bouton permettant le départ apparaît.*/
                print "<form method='post' action='adventure.php'> <input type='hidden' name='quete' value=$row[0] />
		     	 		       	     		  <input class='quete1' type='submit' name=$row[0] value='Partir'/>
								  </form>" ;
            }
        }
       
        if ($row[0] == 'Mise_à_l_épreuve') {
            print "<h2> Mise à l épreuve </h2>" ;
            print "<p> On a besoin de quelqu'un pour se débarasser d'une personne gênante ou au moins lui faire comprendre qu'elle ne doit plus causer de soucis </p>" ;
            print "<ul>" ;
            print "<li> Niveau requis : $row[1] </li>" ;
            print "<li> Récompense : $row[2] </li>" ;
            print "<li> Temps : $row[3] </li>" ;
            print "</ul>" ;
            if ($tab2[14] >= $row[1]) {
		print "<form method='post' action='adventure.php'> <input type='hidden' name='quete' value=$row[0] />
		     	 		       	     		  <input class='quete2' type='submit' name=$row[0] value='Partir'/>
								  </form>" ;
            }
        }
        
        if ($row[0] == 'Une_petite_course') {
            print "<h2> Une petite course </h2>" ;
            print "<p> Votre voisin à une course à faire dans le village voisin mais il s'est fait mal au dos, il vous demande d'y aller à sa place </p>" ;
            print "<ul>" ;
            print "<li> Niveau requis : $row[1] </li>" ;
            print "<li> Récompense : $row[2] </li>" ;
            print "<li> Temps : $row[3] </li>" ;
            print "</ul>" ;
            if ($tab2[14] >= $row[1]) {
		print "<form method='post' action='adventure.php'> <input type='hidden' name='quete' value=$row[0] />
		     	 		       	     		  <input class='quete3' type='submit' name=$row[0] value='Partir'/>
								  </form>" ;
            }
        }
        
        if ($row[0] == 'Participant_à_un_tournois') {
            print "<h2> Participant à un tournois </h2>" ;
            print "<p> Cherche participant au tournois, prête cheval et armure, pour remporter le prochain tournois, partage presque equitable de la recompense </p>" ;
            print "<ul>" ;
            print "<li> Niveau requis : $row[1] </li>" ;
            print "<li> Récompense : $row[2] </li>" ;
            print "<li> Temps : $row[3] </li>" ;
            print "</ul>" ;
            if ($tab2[14] >= $row[1]) {
                 print "<form method='post' action='adventure.php'> <input type='hidden' name='quete' value=$row[0] />
		     	 		       	     		  <input class='quete4' type='submit' name=$row[0] value='Partir'/>
								  </form>" ;
            }
        }
        
        if ($row[0] == 'Souris_dans_mon_auberge') {
            print "<h2> Souris dans mon auberge </h2>" ;
            print "<p> Mon auberge est infestée de souris depuis quelques temps, impossible de s'en debarasser, quelqu'un a t il une solution ? </p>" ;
            print "<ul>" ;
            print "<li> Niveau requis : $row[1] </li>" ;
            print "<li> Récompense : $row[2] </li>" ;
            print "<li> Temps : $row[3] </li>" ;
            print "</ul>" ;
            if ($tab2[14] >= $row[1]) {
		print "<form method='post' action='adventure.php'> <input type='hidden' name='quete' value=$row[0] />
		     	 		       	     		  <input class='quete5' type='submit' name=$row[0] value='Partir'/>
								  </form>" ;
            }
        }
        
        if ($row[0] == 'problème') {
            print "<p> problème !!! </p>" ;
        }
        print "<br/>" ;
    }
}


/* Cette fonction vérifie si le joueur est parti en quête.*/
function estEnQuete() {
    $nom_hote= "localhost" ;
    $nom_base = getenv('DB_NAME');
    $nom_user = getenv('DB_USER'); /* Connexion à la base de données */
    $mdp=getenv('DB_PASSWORD');
    $user = $_SESSION['userName'] ;
    
    $connection = new PDO("pgsql:host=postgres user=$nom_user dbname=$nom_base password=$mdp"); /* On recupère toute les lignes correspondant au nom d'utilisateur et au mot de passe indiqué. */
    
    $req = $connection->prepare("SELECT lastQuest FROM perso where username=? ;") ; /* Puis on effetue notre requête : récupérer l'intitulé de la quête en cours (null s'il n'y en a pas).*/
    $reponse = $req->execute([$user]) ;
    if(! $reponse) {
        exit("estEnQuete(): connection failed");
    }

    $row = $req->fetch();
    
    if($row[0] != null)
        return true;
    else
        return false;
}


/* Cette fonction affiche le temps restant pour effectuer une quête.*/
function afficher_enQuete() {
    print " <h2> Vous etes encore en quete... <h2> " ;
    print "<br/>" ;
    
    $nom_hote= "localhost" ;
    $nom_base = getenv('DB_NAME');
    $nom_user = getenv('DB_USER'); /* Connexion à la base de données */
    $mdp=getenv('DB_PASSWORD');
    $user = $_SESSION['userName'] ;
    
    $connection = new PDO("pgsql:host=postgres user=$nom_user dbname=$nom_base password=$mdp"); /* On recupère toute les lignes correspondant au nom d'utilisateur et au mot de passe indiqué. */
    
    $req = $connection->prepare("SELECT lastQuest, endTimeQuest FROM perso where username=?") ; /* Puis on effectue notre requête : récupérer l'intitulé et l'heure de fin de la quête en cours.*/
    $reponse = $req->execute([$user]);
    if(! $reponse) {
        exit("afficher_enQuete(): connection failed");
    }
    $row = $req->fetch();
    
    $nomQuete = $row[0] ; /* On a le nom de la quête. */
    $dateFinQuete = $row[1] ; /* On a l'heure à laquelle la quête se termine.*/
    $date = time(); /* On récupère l'heure actuelle.*/
    $remainingTime = $dateFinQuete - $date ; /* Ce qui permet de calculer le temps restant à la quête.*/

    print "<body onload='minutageGo()'>" ;
    echo '<form name="formulaire" method="post" action="finQuete.php">' ;
    print "<input type='hidden' name='quete' value=$nomQuete><br>" ;
    print "<input type='text' name='minuteur' value=$remainingTime readonly class='onglets'><br>" ;
    print "<input type='hidden' name='boutonFin' value='Quête terminée!' onClick='resetPage()' class='onglets'>" ;
    echo '</form>' ;
    print "</body>" ;
    
    ?>
    <script type="text/javascript">
    
    var attente ;
    function minutageGo(){
        var temps_restant = window.document.formulaire.minuteur.value ; /* On récupère la valeur affichée dans le champ du minuteur.*/
        temps_restant = parseInt(temps_restant) - 1; /* On la décrémente de 1.*/
        window.document.formulaire.minuteur.value = temps_restant; /* On ré-injecte dans le champs du minuteur.*/
        
        attente = setTimeout("minutageGo()", 1000); /* On relance la fonction après une seconde.*/
        if(temps_restant<=0) { /*Quand le timer atteint 0, */
            window.document.formulaire.minuteur.value = 0 ;	/* on le bloque à 0*/		 
            window.document.formulaire.boutonFin.type = "submit" ; /* et on affiche le bouton donnant accès aux récompenses.*/
        }
    }

    function resetPage() { /* N'est plus utile. Permettait d'actualiser la page.*/
    	     window.document.location.replace("quetes.php");
    }
    
    </script>
    <?php
}

/* Cette fonction récupère l'ensemble des quêtes disponibles triées par ordre croissant de niveau requis.*/
function diff_quetes() {
    $nom_hote= "localhost" ; 
    $nom_base = getenv('DB_NAME'); 
    $nom_user = getenv('DB_USER'); /* Connexion à la base de données */
    $mdp=getenv('DB_PASSWORD');
    
    $connection = new PDO("pgsql:host=postgres user=$nom_user dbname=$nom_base password=$mdp"); /* On recupère toute les lignes correspondant au nom d'utilisateur et au mot de passe indiqué. */
    
    $req = $connection->prepare("SELECT q_name, q_level, reward_money, q_time FROM adventure GROUP BY q_name ORDER BY q_level ;") ; /* Puis on effectue notre requête.*/
    $reponse = $req->execute([]);
    if ($reponse) {
        return($req) ;
    }
    else {
        return array('problème', 0, 0, 0) ; /* Un exit() est envisageable ici mais nous avons préféré retourné un élément traitable par la fonction afficher_quetes().*/
    }
}