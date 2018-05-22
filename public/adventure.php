<?php

/* Ce fichier permet le départ en quête d'un joueur et affiche un timer indiquant le temps restant à la quête.*/

session_start() ;
include("pageAccueil.php") ;

enTete("Quête en cours...");

onglets();

fin_enTete();

partir_enQuete() ;

afficher_enQuete();

pied() ;


/* Cette fonction met à jour la base de données pour stocker le nom de la quête lancée par le joueur ainsi que l'heure à laquelle celle-ci se termine.*/
function partir_enQuete() {
    $quete = $_POST['quete'] ;
    $user = $_SESSION['userName'] ;
    
    $nom_hote= "localhost" ;
    $nom_base = getenv('DB_NAME');
    $nom_user = getenv('DB_USER');
    $mdp=getenv('DB_PASSWORD');

    $connection = new PDO("pgsql:host=postgres user=$nom_user dbname=$nom_base password=$mdp");

    $req0 = $connection->prepare("SELECT q_time FROM adventure WHERE q_name=? ;") ; /* On récupère a durée de la quête.*/
    $reponse0 = $req0->execute([$quete]);
    if(! $reponse0) {
        exit("partir_enQuete(): connection failed");
    }
    $row0 = $req0->fetch();

    $time =  time() + $row0[0] ; /* On calcul l'heure à laquelle la quête se termine.*/
    
    $req = $connection->prepare("UPDATE perso SET lastQuest=?, endTimeQuest=? WHERE username=?;") ; /* On stocke les informations sur la quête du joueur.*/
    $reponse = $req->execute([$quete, $time, $user]) ;
    if(! $reponse) {
        exit("partir_enQuete(): connection failed");
    }
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
