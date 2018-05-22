<?php

/* Ce fichier attribue les récompenses d'une quête à un joueur après que celui-ci ait terminé une quête. Puis le redirige vers l'onglet des quêtes.*/

session_start() ;
include("donneesPerso.php") ;

finQuete();

header('Location: quetes.php');


/* Cette fonction attribue les récompenses d'une quête au joueur.*/
function finQuete() {
    $quete = $_POST['quete']; /* On récupère le nom de la quête depuis un formulaire.*/
    $nom_hote= "localhost";
    $nom_base = getenv('DB_NAME');
    $nom_user = getenv('DB_USER');
    $mdp=getenv('DB_PASSWORD');
    $user = $_SESSION['userName'];
    
    $connection = new PDO("pgsql:host=postgres user=$nom_user dbname=$nom_base password=$mdp");

    $req0 = $connection->prepare("SELECT * FROM adventure WHERE q_name=? ;") ;
    $reponse0 = $req0->execute([$quete]);
    if(! $reponse0) {
        exit("partir_enQuete(): connection failed");
    }
    $row0 = $req0->fetch();

    $xp_won = $row0[5] ; /* On récupère l'xp donné par la quête depuis la base de donnée.*/
    $gold_won = $row0[2] ; /* On récupère l'or donné par la quête depuis la base de donnée.*/
    $niveauQuete = $row0[1] ; /* On récupère le niveau requis de la quête depuis la base de donnée.*/

    $req1 = $connection->prepare("SELECT gear, strength, mind, sword_skill, staff_skill, money, charac_lvl, charac_xp, guild FROM perso where username=?") ; /* On récupère l'ensemble des données nécéssaires au calcul des récompenses.*/
    $reponse1 = $req1->execute([$user]);
    if(!$reponse1) {
        exit("afficher_enQuete(): connection failed1");
    	}
    $row = $req1->fetch();

    $gear = $row[0];
    $strength = $row[1];
    $mind = $row[2];
    $sword_skill = $row[3];
    $staff_skill = $row[4];
    $money = $row[5];
    $charac_lvl = $row[6];
    $charac_xp = $row[7];
    $guild = $row[8];
    
    $result = (float) mt_rand() / mt_getrandmax(); /* Chance de succès de la quête.*/
    
    if(strcmp($row[0], "baton") == 0) {
        $successChance = (float) min(0.99, ($mind + 5*$staff_skill + 5 * $niveauQuete)/(($niveauQuete+1)*100*2)) ;
    	}
    else {
        $successChance = (float) min(0.99, ($strength + 5*$sword_skill + 5 * $niveauQuete)/(($niveauQuete+1)*100*2)) ;
    	}
    
    if($result < $successChance) /* Si on réussit la quête, on gagne plus de points de guilde.*/
        $pts = 10 * ($niveauQuete+1) ;
    else
        $pts = 1 ;
        
    $drop = (float) mt_rand() / mt_getrandmax(); /* Chance de drop des objets.*/
    $lootSword = (float) mt_rand() / mt_getrandmax(); /* Chance de drop d'une amélioration d'épée.*/
    $lootStaff = (float) mt_rand() / mt_getrandmax(); /* Chance de drop d'une amélioration de bâton de magie.*/
    $loot = 0 ; /* Indicateur des objets récupérés.*/
    if($drop < 0.5) { /* On a 50% de chances de looter quelque chose.*/
        if(strcmp($gear, "baton") == 0) { /* Si on possède un bâton,*/
            if($lootSword < 0.4) /* on a 40% de chances de récupérer une amélioration d'épée.*/
                $loot++;
            if($lootStaff < 0.6) /* et 60% de chances de récupérer une amélioration de bâton.*/
                $loot = $loot + 2;
        }
        else { /* Si on possède une épée,*/
            if($lootSword < 0.6) /* on a 60% de chances de récupérer une amélioration d'épée.*/
                $loot++;
            if($lootStaff < 0.4) /* et 40% de chances de récupérer une amélioration de bâton.*/
                $loot = $loot + 2;
        }
    }
    
    calcul_niveau($charac_xp + $xp_won, $charac_lvl, $strength, $mind) ; /* On effectue la montée de niveau qui met à jour la base de données.*/

    /* Puis on met jour les compétences d'épée et de bâton, l'argent et l'xp gagné suivant les récompenses obtenues. Puis on reset la quête du joueur.*/
    $req2 = $connection->prepare("UPDATE perso 
                                 SET sword_skill=?, staff_skill=?, money=?, charac_xp=?, lastQuest=?, endTimeQuest=?
                                 WHERE username=?") ;
    switch($loot){
        case 0:
            $reponse2 = $req2->execute([$sword_skill, $staff_skill, $money + $gold_won, $charac_xp + $xp_won, null, null, $user]);
	    if(! $reponse2) {
            	 exit("afficher_enQuete(): connection failed2");
    		 }
            break;
        case 1:
            $reponse2 = $req2->execute([$sword_skill+1, $staff_skill, $money + $gold_won, $charac_xp + $xp_won, null, null, $user]);
	    if(! $reponse2) {
            	 exit("afficher_enQuete(): connection failed3");
    		 }
            break;
        case 2:
            $reponse2 = $req2->execute([$sword_skill, $staff_skill+1, $money + $gold_won, $charac_xp + $xp_won, null, null, $user]);
	    if(! $reponse2) {
            	 exit("afficher_enQuete(): connection failed4");
    		 }
            break; 
        case 3:
            $reponse2 = $req2->execute([$sword_skill+1, $staff_skill+1, $money + $gold_won, $charac_xp + $xp_won, null, null, $user]);
	    if(! $reponse2) {
            	 exit("afficher_enQuete(): connection failed5");
    		 }
            break;
    }

    $req3 = $connection->prepare("SELECT guild_points FROM guilde WHERE guild_name=?"); /* Enfin on attribue les points gagnés à la guilde du joueur.*/
    $reponse3 = $req3->execute([$guild]) ;
    if(! $reponse3) {
    	 exit("afficher_enQuete(): connection failed6");
	 }
    $current_pts=$req3->fetch();

    $req4 = $connection->prepare("UPDATE guilde SET guild_points=? WHERE guild_name=?");
    $reponse4 = $req4->execute([$current_pts[0] + $pts, $guild]);

    if(! $reponse4) {
    	 exit("afficher_enQuete(): connection failed7");
	 }
}