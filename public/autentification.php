<?php

/* Ce fichier gère l'autentification en général à partir de la page d'accueil */

session_start();
include("config.php");

Rechercher() ;


function Rechercher() {

    $userName = $_POST["username"];
    $password = $_POST["password"];                      /* on récupère les données du formulaire de la page d'accueil */
    $tableau = get_id($userName,$password);


    if ($tableau[0] == 0) {
        $_SESSION['userName'] = $userName ;    /* si l'utilisateur est reconnu on l'envoie sur la page d'accueil de son personnage avec le nom d'utilisateur en variable de session */
        header('Location: accueilPerso.php');
        exit();
    }
    
    else {
    	 print "<!DOCTYPE html>\n";		
    	 print "<html>\n";                               /* Sinon on génère une page indiquant qu'il y a eu une erreur de mot de passe ou d'identifiant */
    	 print "  <body>\n";
    	 print "</br> <h1> Erreur : Identifiant inexistant ou mot de passe incorect !</h1> ";
    	 echo '<p><a href="index.php"><input type="button" name="Retour Accueil" value="Retour Accueil"/></a></p>';
    	 print "</body> </html>";
    }
}


/* Verifie que l'utilisateur est bien dans la base de données et non banni */
function get_id($userName,$password)
{
    $nom_hote= "localhost" ; 
    $nom_base = getenv('DB_NAME'); 
    $nom_user = getenv('DB_USER');        /* Connexion à la base de données */
    $mdp=getenv('DB_PASSWORD');
    
    $connection = new PDO("pgsql:host=postgres user=$nom_user dbname=$nom_base password=$mdp");
    $requete = $connection->prepare("SELECT * FROM users WHERE username = ? AND password = ? ;");           /*on recupère toute les lignes correspondant au nom d'utilisateur et au mot de passe indiqué */
    $reponse = $requete->execute([$userName,$password]);
    
    if ($reponse) {
        if($requete->rowCount()==1){              /* On vérifie qu'il n'y a bien qu'une seule correspondance */
            $tuple=$requete->fetch();
	    if ($tuple[3] != 'banned') {
                return array(0,$tuple['username']);         /* On verifie que cette personne n'est pas bannie */
	    }
	    else {
	        header('Location: index.php') ;       /* Si elle l'est on renvoie sur la page d'accueil */
		exit() ;
	    }
        }
        else{
            return array(-1,0);        /* en cas d'erreur de connection */
        }
     }
     else {
          return array(-2,0);
     }
}


?>