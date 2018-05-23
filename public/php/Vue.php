<?php
/**
 * Created by PhpStorm.
 * Date: 2018/5/3
 * Time: 10:07
 */
function entete(){
    print "<!DOCTYPE html>\n";
    print "<html xmlns=\"http://www.w3.org/1999/html\">\n";
    print "<head>\n";
    print "<link rel=\"stylesheet\" href=\"..\css\style1.css\"/>";
    print "<title>SCANATION</title>";
    print "</head>\n";
    print "<body>\n";
}



function bandeau(){
    print "<div class=\"Nomdusite\"><a href='index.php' id='bgimg' style=\"color: white; text-decoration: none;\">SCANATION</a></div> ";
    print "<div id =\"navbar\">\n";
    print "<a class='lien'  href=\"index.php\">Accueil</a>\n";
    /*print "<a class='lien' href=\"lecture.php\">Lecture en ligne</a>\n";*/
    print "<a class='lien' href=\"classement.php\">Mangas</a>\n";
    print "<a class='img_lien' href=\"Profil.php\"><img src='default_icon.png'/></a>\n";

    if( isset($_SESSION["admin"]) && isset($_SESSION["uname"]))
    {
        if ($_SESSION["admin"] == 1 ) {
            print "<a class='lien'  href=\"Ajout.php\">Upload</a>\n";
            print "<a class='lien'  href=\"Ladatabasa.php\">Utilisateurs</a>\n";
            print "<a class='lien'  href=\"Grantadmin.php\">Droits</a>\n";
        }
    }

    print "</div>\n";
}

function container()
{
    echo '<div class="container" >';
}

function pied(){
    print "<div class=\"footer\">\n";
    print "<footer>\n";
    print "Clément Veyssière, Eric Wang, Shuo Xu, Zeyu Chen | © Copyright 2018 | ENSIIE\n";
    print "</footer>\n";
    print "</div>\n";
    print '<script>
    window.onscroll = function() {StickyHeader()};

    var header = document.getElementById("navbar");
    var sticky = header.offsetTop;

    function StickyHeader() {
        if (window.pageYOffset >= sticky) {
            header.classList.add("sticky");
        } else {
            header.classList.remove("sticky");
        }
    }
    </script>';
    print "</body>\n</html>";

}

/* Page de connexion */
function vue_connexion() {
    echo '
    <h1>Bienvenue sur SCANATION.</h1>
    <p>Pour lire des mangas, veuillez d\'abord vous identifier</p><br/>
    <form action="VerifMDP.php" method="post">
        <label>Identifiant</label>
        <input type="text" name="uname" size="12" required/><br/>
        <label>Mot de passe</label>
        <input type="password" name="mdp" size="8" required/><br/><br/>
        <input class="btn1" type="submit" value="Valider"/><br/><br/>
    </form>
    <form action="Inscription.php" method="post">
        <input class="btn1" type="submit" value="S\'inscrire"/>
    </form><br/>
    
    <form action="Correcter.php" method="post">
        <input class="btn1" type="submit" value="Mot de passe oublié"/>
    </form>
    
    <div class="clearfix"></div>';
}


function vue_deconnexion() {
    echo '
    <p>La déconnexion a bien eu lieu.</p>
    <p>Merci d\'avoir utilisé SCANATION.</p><br/>';
}

function vue_insciption() {
    echo '
    <h1>Bienvenue sur SCANATION.</h1>
    <p>Veuillez faire une nouvelles inscription.</p><br/>
    <form action="InsertProf.php" method="post">
        <label>Pseudo</label>
        <input type="text" name="uname" size="8"/><br/>
        <label>Mot de passe</label>
        <input type="password" name="mdp" size="8"/><br/>
        <label>Date de naissance</label>
        <input type="date" name="dnais" size="8"/><br/>
        <input class="btn1" type="submit" value="Je valide."/>
    </form>
    <div class="clearfix"></div>';
}

function vue_correctMDP() {
    echo '
    <h1>Bienvenue sur SCANATION.</h1>
    <p>Veuillez refaire votre mot de passes. Inserez votre informations.</p><br/>
    <form action="CorrecteMDP.php" method="post">
        <label>Pseudo</label>
        <input type="text" name="uname" size="8"/><br/>
        <label>Date de naissance</label>
        <input type="date" name="dnais" size="8"/><br/>
        <label>Nouveau mot de passe</label>
        <input type="password" name="mdp1" size="8"/><br/>
        <label>Validez nouveau mot de passe</label>
        <input type="password" name="mdp2" size="8"/><br/>
        <input class="btn1" type="submit" value="Je confirme."/>
    </form>
    <div class="clearfix"></div>';
}


function vue_update(){
    echo '
    <h1>Bienvenue sur SCANATION.</h1>
    <p>Modifier votre date de naissance</p><br/>
    <form action="UpdateClient.php" method="post">
        <label>Date de Naissance</label>
        <input type="date" name="dnais" size="8"/><br/><br/>
        <input class="btn1" type="submit" value="Je valide."/>
    </form>
    <div class="clearfix"></div>';
}

/* Affichage basique d'une chaîne */
function affiche($str) { echo $str; }
/* Affichage d'une information */
function affiche_info($str) { echo '<p>'.$str.'</p>'; }
/* Affichage d'une erreur */
function affiche_erreur($str) { echo '<p class="erreur">'.$str.'</p>'; }
