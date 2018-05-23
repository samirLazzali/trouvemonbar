<?php

include ("config.php");

function vue_connexion() {

    echo '<section align = "center" class="formulaire">
        <p> Bonjour, bienvenue sur AMAZONIIE.
        Connecte toi! </p>

        <br/>

        <form action="connexion.php" method="post" class="formulaire">
			<label>Entre ton adresse mail :</label> <input type="email" name="mail" required /> <br/>
            <label>Entre ton mot de passe :</label> <input type="password" name="mdp" required /><br/>
            <input type="submit" value="Valider" name="valider"/>
        </form>

		<br/> 

		<p> Si tu ne t\'es pas encore inscrit(e), inscris toi! <p> 
		<form name="Inscription" action="inscription.php" method="post">
		<input type="submit" value="Inscription">
		</form>

        </section>';

}

function enTete($titre)
{
    print "<!DOCTYPE html>\n";
    print "<html>\n";
    print "  <head>\n";
    print "    <meta charset=\"utf-8\" />\n";
    print "    <title>$titre</title>\n";
    print "    <link rel=\"stylesheet\" href=\"style.css\"/>\n";
    echo '
    <style type="text/css">
        .wrapper{
             width: 500px;
            margin: 0 auto;
        }
    </style>';
    print "  </head>\n";
  
    print "  <body>\n";
    print "    <header class='page-header' ><h1> $titre </h1></header>\n";
}

function pied(){
    print "  </body>\n";
    print"</html>\n";
}

function page_connect()
{

	if (basename($_SERVER['SCRIPT_NAME'])!='connexion.php' && !isset($_SESSION["mail"])){/*voir chez Kalo*/
		echo "<p align = 'right'><a href='connexion.php'> Connecte toi! </a></p>"; }
}

function page_inscription()
{
    if (basename($_SERVER['SCRIPT_NAME'])!='inscription.php' && !isset($_SESSION["mail"])){/*voir chez Kalo*/
        echo "<p align = 'right'><a href='inscription.php'> Inscris toi! </a></p>"; }
}

function page_deconnection()
{
    if (basename($_SERVER['SCRIPT_NAME'])!='deconnexion.php' && isset($_SESSION["mail"])){/*voir chez Kalo*/
       echo "<p align = 'right'><a href='deconnexion.php'> <img src='deconnection.png' alt='Déconnection' style='width:50px;height:50px;'/></a></p>"; }
}

function page_accueil(){

    if (basename($_SERVER['SCRIPT_NAME'])!='index.php' ){/*voir chez Kalo*/
        echo "<p align = 'left'><a href='index.php'> <img src='home2.png' alt='Accueil' style='width:50px;height:50px;'/></a></p>"; }
}

function page_profil()
{
    if (basename($_SERVER['SCRIPT_NAME'])!='mon_profil.php' && isset($_SESSION["mail"])){/*voir chez Kalo*/
        echo "<p align = 'right'><a href='mon_profil.php'><img src='profil2.png' alt='Profil' style='width:50px;height:50px;'/> </a></p>"; }
}

function page_crud(){

    if(basename($_SERVER['SCRIPT_NAME'])=='index.php' && $_SESSION["admin"]=='t'){
        echo "<p align = 'right'><a href='CRUDindex.php'> Tableau de bord </a></p>";
    }
}

function affiche($str){
	echo $str;
}

function affiche_info($str){
	echo '<p>'.$str.'</p>';
}

function affiche_erreur($str) {
	echo '<p class="erreur" align = "center" >'.$str.'</p>';
}

function affiche_menu()
{
    echo '
	<h1 align = "center" >Bienvenue sur AMAZON<em>IIE</em></h1>
	<h1 align = "center"> <img src="iie1.jpg" alt"Une mascotte..."/></h1>
	<p align = "center"> Sur ce site tu vas pouvoir retrouver tes objets perdus, mais aussi reçevoir des offres de biens et services proposés par les iiens! </p>
	<nav>
	<ul>
		<li>
			<a href=objetsTrouves.php>Objets perdus ou trouvés</a>
		</li>
		<li>
			<a href=boutique.php>Objets et services à vendre</a>
		</li>
		<li>
		    <a href="Post_annonce.php">Déposer une annonce</a>
		</li>
		</li>
		    <form method="get" action="resultatrecherche.php">
            <input type="search" name="q" placeholder="Recherche..." />
            <input type="submit" value="Valider">
            </form>
		<li>
    </ul>
    </nav>';
    affiche_post_recent();
}

function affiche_boutique()
{
    global $db;
    echo '
    <h1 align = "center">Achats et ventes!</h1>
		<h1 align = "center"> <img src="shenzi.png" alt"Une mascotte3..."/></h1>
		<p align = "center"> Tu souhaites acheter ou vendre tes biens aux autres iiens?
		 A moins que tu ne préfères profiter des différents services qui te sont proposés? Massages, nourriture, coivoiturage... Tu trouveras toujours ton bonheur ici! </p>
		<h2>Ce qu\'on te propose:</h2>
    <form action="boutique.php" method="post">
        <select name="categorieV">' .
        '<optgroup label="catégorie">'.
        '<option value="logement">Logement</option>' .
        '<option value="location">Location</option>' .
        '<option value="covoiturage">Covoiturage</option>' .
        '<option value="massage">Massage</option>' .
        '<option value="objet">Objet</option>' .
        '<option value="autre">Autre</option> </optgroup>' .
        '</select> <input type="submit" value="valider"></form>' ;

    if ( isset($_POST["categorieV"])){
        $cat=$_POST["categorieV"];

        $query = $db->prepare('SELECT * FROM objet 
                                    NATURAL JOIN Vendre 
                                    WHERE categorie_V =?');

        $query->execute(array($cat));
        $donnees = $query->fetchAll();

        foreach ($donnees as $obj){
            $id=$obj["id"];
            $titre=$obj["titre"];
            $date=$obj["date"];
            $url='annonce.php?id='.$id.'&type=vendre';
            echo '<p class="annonce"> <a href='.$url.'> Annonce numéro ' .$id. ' : '
                .$titre. '
             postée le ' .$date.'</a> </p>';

        }
    }
}

function affiche_objTrouves()
{
    global $db;
    echo '
    <h1 align = "center">Rubrique des objets trouvés</h1>
		<h1 align = "center"> <img src="ed1.png" alt"Une mascotte2..."/></h1>
		<p align = "center"> Tu as perdu des affaires en soirée? 
		Tu possèdes quelque chose qui n\'est pas à toi? Nous avons ici la liste des objets trouvés par les élèves dans l\'école il te suffit de préciser ta recherche! </p>
		<h2>Les différentes catégories d\'objets trouvés:</h2>
    <form action="objetsTrouves.php" method="post">' . 'Catégories :' .
        '<select name="categorieT">' .
        '<option value="vetement">Vetement</option>' .
        '<option value="electronique">electronique</option>' .
        '<option value="sac">Sac</option>' .
        '<option value="cours">Cours</option>' .
        '<option value="cles">Clés</option>' .
        '<option value="portefeuille">Portefeuille</option>' .
        '<option value="bijoux">Bijoux</option>' .
        '<option value="lunettes">Lunettes</option>' .
        '<option value="autre">Autre</option>' .
        '</select> <input type="submit" value="valider"></form>' ;

    if ( isset($_POST["categorieT"])) {

        $cat = $_POST["categorieT"];
        echo $cat;

        $query = $db->prepare('SELECT * FROM objet 
                                    NATURAL JOIN Trouve 
                                    WHERE categorie_T = ?');
        $query->execute(array($cat));
        $donnees= $query->fetchAll();

        foreach ($donnees as $obj) {
            $id = $obj["id"];
            $titre = $obj["titre"];
            $date = $obj["date"];

            $url = 'annonce.php?id=' .$id. '&type=trouve';
            echo '<p class="annonce"> <a href=' .$url. '> Annonce numéro ' . $id . ' : '
                . $titre . '
             postée le ' . $date . '</a> </p>';

        }
    }
}


function ajout_champ(){
    /* fonction qui prend comme arguments dans l'ordre: type, value, name, label, id, (required), (step)
        (les arguments entre parenthèses ne sont pas obligatoires, mais doivent être à l'index prévu:
        par exemple, si on veut indiquer un argument step, il faut mettre un argument required)
    */

    $tmp='';
    //label
    if(! empty(func_get_arg(3))){
        $tmp.= '<label for="'.func_get_arg(4) .'">'.func_get_arg(3).':</label>';
    }
    $tmp .= '<input type="'.func_get_arg(0).'" ';
    if(! empty(func_get_arg(4))){
        $tmp.= 'id="'.func_get_arg(4).'" ';
    }
    if(! empty(func_get_arg(1))){
        $tmp.= 'value="'.func_get_arg(1).'" ';
    }
    if(! empty(func_get_arg(2))){
        $tmp.= 'name="'.func_get_arg(2).'" ';
    }
    if(func_num_args()>5 && func_get_arg(5)){
        $tmp.= 'required="required" ';
    }
    if(func_num_args() > 6 && func_get_arg(0) == "number" && func_get_arg(6) == -1){
        $tmp .= 'step="any" ';
    }

    $tmp.='>';
    return $tmp;
}


function affiche_form_annonce()
{
    echo '<script src="JSexterne.js"></script>'.
        '<form name="myForm" action="upload.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">' . 'Types d\'objets :' .
        '<input type="radio" name="objet" onclick="afficher(\'catT\'); cacher(\'catV\')">Objets trouvés ou perdus</input>'.
        '<input type="radio" name="objet" onclick="afficher(\'catV\'); cacher(\'catT\')">Objets ou services à vendre</input>'.
        '<div id="catT" style="display: none">'.'Catégories :'.
        '<select name="CatégorieT">' .
        '<option value="vetement">Vêtements</option>' .
        '<option value="electronique">Electronique</option>' .
        '<option value="sac">Sac</option>' .
        '<option value="cours">Cours</option>' .
        '<option value="clés">Clés</option>' .
        '<option value="portefeuille">Portefeuille</option>' .
        '<option value="bijoux">Bijoux</option>' .
        '<option value="lunettes">Lunettes</option>' .
        '<option value="autre">Autre</option>' .
        '</select>'.'</br>'.
        ajout_champ('text','',"endroit","Endroit trouvé ou perdu",0).
        '</div>' . '</br>' .
        '<div id="catV" style="display: none">'.'Catégories:'.
        '<select name="CatégorieV">' .
        '<option value="logement">Logement</option>' .
        '<option value="location">Location</option>' .
        '<option value="covoiturage">Covoiturage</option>' .
        '<option value="massage">Massage</option>' .
        '<option value="objet">Objets</option>' .
        '<option value="autre">Autre</option>' .
        '</select>'.'</br>'.'Prix:'.
        '<input type="number" name="prix" min="0"></input>'.
        '</div>'.
        ajout_champ('text', '', "titre", "Titre de l'annonce", 0) . '</br>' .
        '<textarea name="description" rows="5" cols="40" placeholder="Veuillez décricre votre annonce"></textarea>'.'</br>'.
        ajout_champ('file', '', "fileToUpload", '', "fileToUpload", 0) . '</br>' .
        ajout_champ('email', '', "email", "Email", 0) . '</br>' .
        ajout_champ('submit', 'Envoyer', 'soumission', '', '', 0) . "\n" .
        '</form>';
}

function affiche_post()
{
    echo
    '<h1 align="center">Déposer une annonce</h1>';
    affiche_form_annonce();
}

function affiche_post_recent()
{
    global $db;

    $query = $db->prepare('SELECT * FROM Objet ORDER BY date DESC');
    $query->execute();

    $donnes = $query->fetchAll();

    $requete = $db->query('SELECT COUNT(*) FROM Objet');
    $nbr = $requete->fetchColumn();
    $i=0;
    foreach ( $donnes as $obj ){


        if ($i <= min($nbr,5)){

            /*afficher une annnce*/
            $id = $obj["id"];
            $titre = $obj["titre"];
            $date = $obj["date"];
            $description=$obj["description"];

            $query2 = $db->prepare('SELECT COUNT(*) FROM Trouve WHERE id = :id');

            $query2->execute(array('id'=>$id));

            $data2 = $query2->fetchColumn();

            if ($data2 ==1){
                $type='trouve';
                $url = 'annonce.php?id='.$id.'&type='.$type;
                echo '<p class="annonce"> <a href='.$url.'> Annonce numéro ' .$id. ' : '
                    .$titre ;
                echo nl2br("\r\n");
                echo $description;
                echo nl2br("\r\n");
                echo 'C\'est un objet trouvé ';
                echo 'postée le ' .$date.'</a> </p>';
                $i++;

            }
            else{

                $query3 = $db->prepare('SELECT COUNT(*) FROM Vendre WHERE id = :id');

                $query3->execute(array('id'=>$id));

                $data3 = $query3->fetchColumn();
                /*echo 'id='.$id.'data3='.$data3;
                echo nl2br("\r\n");*/
                if ($data3==1) {

                    $type = 'vendre';
                    $url = 'annonce.php?id=' . $id . '&type=' . $type;
                    echo '<p class="annonce"> <a href=' . $url . '> Annonce numéro ' . $id . ' : '
                        . $titre;
                    echo nl2br("\r\n");
                    echo $description;
                    echo nl2br("\r\n");
                    echo 'C\'est un objet à vendre ';
                    echo 'postée le ' . $date . '</a> </p>';
                    $i++;
                }
                $query3->closeCursor();
            }
            $query2->closeCursor();

        }
        else{
            break;
        }
        $query->closeCursor();
    }
}


function vue_inscription() {

    echo '<section class="formulaire">
        <p class="message"> Bonjour, bienvenue sur AMAZONIIE.
        Inscris toi ! </p>

        <br/>

        <form action="inscription.php" method="post" class="formulaire" align = "center">
            
			<label>* Entre ton adresse mail  :</label> <input type="email" name="mail" required/> <br/>
			<label>* Entre ton nom :</label> <input type="text" name="nom" required /> <br/>
			<label>* Entre ton prenom :</label> <input type="text" name="prenom" required /> <br/>
            <label>* Entre ton mot de passe :</label> <input type="password" name="mdp" required /><br/>
            <label>* Confirme ton mot de passe :</label> <input type="password" name="confirmation" required/> <br/>
            <label>* Entre ton pseudo :</label> <input type="text" name="pseudo" required/> <br/>
            <label>De quelle promo es-tu ? :</label> <input type="number" name="promo" min="1968"  /> <br/>
            <label>Donne moi ton 06 :</label> <input type="tel" name="telephone"  /> <br/>
        
            <input type="submit" value="Valider" name="valider"/>
            <input type="reset" value="Effacer" name="Effacer"/>
        </form>

		<br/> 

		<p> Si tu t\'es déjà inscrit(e), connecte toi! <p> 
		<form name="connexion" action="connexion.php" method="post">
		<input type="submit" value="connexion">
		</form>

        </section>';

}

function vue_modif_profil() {



    echo '<div class="wrapper">
   
                <p >Veuillez remplir le formulaire pour pouvoir procéder à la mise à jour des données.</p>
                <form method="post">
                        <div><label>Nom</label>
                        <input type="text" name="nom" value="'.$_SESSION["nom"].'" class="form-control" required></div> 
                        <div><label>Prénom</label>
                        <input type="text" name="prenom" value="'.$_SESSION["prenom"].'" class="form-control" required>   </div>                 
                        <div> <label>Mot de passe</label>
                        <input type="password" name="mdp" class="form-control" required>    </div>                    
                        <div><label>Confirmation de mot de passe</label>
                        <input type="password" name="confirmation" class="form-control" required>    </div>                
                        <div><label>Pseudo</label>
                        <input type="text" name="pseudo" value="'.$_SESSION["pseudo"].'" class="form-control" required>   </div>                 
                        <div><label>Promotion</label>
                        <input type="text" name="promo" value="'.$_SESSION["promo"].'" class="form-control" >     </div>               
                        <div><label>Téléphone</label>
                        <input type="text" name="telephone" value="'.$_SESSION["telephone"].'" class="form-control"></div>
                    <div><input type="submit" class="btn btn-primary" value="Envoyer">
                    <a href="mon_profil.php" class="btn btn-default">Annuler</a></div>
                </form>
</div>';

    /*echo '<section class="formulaire">
        <p class="message"> Tes informations ! </p>

        <br/>

        <form action="modif_profil.php" method="post" class="formulaire" align = "center">
            
			<label>* Ton adresse mail  :</label> <input type="email" name="mail" value="' .$_SESSION["mail"] . '" disabled="disabled" required/> <br/>
			<label>* Entre ton nom :</label> <input type="text" name="nom_modif" value="' .$_SESSION["nom"].'" required /> <br/>
			<label>* Entre ton prenom :</label> <input type="text" name="prenom_modif" value="' .$_SESSION["prenom"].'" required /> <br/>
            <label>* Entre ton mot de passe :</label> <input type="password" name="mdp_modif" required /><br/>
            <label>* Confirme ton mot de passe :</label> <input type="password" name="confirmation_modif" required/> <br/>
            <label>* Entre ton pseudo :</label> <input type="text" name="pseudo_modif" value="' .$_SESSION["pseudo"]. '" required/> <br/>
            <label>De quelle promo es-tu ? :</label> <input type="number" name="promo_modif" min="1968" value="' .$_SESSION["promo"].'"  /> <br/>
            <label>Donne moi ton 06 :</label> <input type="tel" name="telephone_modif"  value="'.$_SESSION["telephone"].'" /> <br/>
        
            <input type="submit" value="Valider" name="valider"/>
            <input type="reset" value="Effacer" name="Effacer"/>
        </form>

		<br/> 

        </section>';*/

}

function fin_inscription($pseudo){
    echo ' <h1 class ="succes"  > Inscription terminée </h1>
        <p> Bienvenue ' . $pseudo .' ! Tu es maintenant inscrit(e) sur le site </p>';

}


function modif_faite(){
    echo ' <h1 class="succes" align = "center"> Modification réussie </h1></p> ';
}

function vue_deconnexion(){

    if (isset($_SESSION["mail"])) affiche_erreur('Vous n\'êtes pas connecté');

    session_start();
    session_destroy();
    echo '<p class="message" > Tu es à présent deconnecté(e) <br />
        Pour <a href="'.htmlspecialchars($_SERVER['HTTP_REFERER']).'"> revenir à la page précédente. </a> 
         <br /></p> ';
}

function vue_supprimer(){
    if (isset($_SESSION["admin"]) && $_SESSION["admin"]=='t'){
        echo "<form action='supprimer.php' >
                <input type='submit' value='supprimer'></form>";
    }

}

function vue_terminer($mail){
    if (isset($_SESSION["mail"]) && $_SESSION["mail"]==$mail){
        echo "<form action='terminer.php' >
                <input type='submit' value='Terminer'></form>";
    }

}

