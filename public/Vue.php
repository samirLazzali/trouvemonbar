<?php

//session_start();


/* Recupération des users*/
//require_once '../vendor/autoload.php';
require_once 'Modele.php';

function enTeteConnexion($titre, $style){
    print "<!DOCTYPE html>\n";
    print "<html>\n";
    print "  <head>\n";
    print "    <meta charset=\"utf-8\" />\n";
    print "    <title>$titre</title>\n";
    print "    <link rel=\"stylesheet\" href=\"$style\"/>\n";
    print "  </head>\n";

    print "  <body>\n";

    print "<nav id=\"fontmenu\">\n";
    print "<ul id=\"menu\">\n";
    print "    <li>\n";
    print "        <span class=\"nomsite\">twitIIE</span>\n";
    print "    </li>\n";
    print "    <li>\n";
    print "        <a href=\"index.php\">\n";
    print "         Connexion\n";
    print "        </a>\n";
    print "    </li>\n";
    print "    <li>\n";
    print "        <a href=\"Inscription.php\">\n";
    print "         Inscription\n";
    print "        </a>\n";
    print "    </li>\n";
    print "</nav>\n";
    print "<h1>$titre</h1>\n";

}

function enTete($titre, $style)
{
    print "<!DOCTYPE html>\n";
    print "<html>\n";
    print "  <head>\n";
    print "    <meta charset=\"utf-8\" />\n";
    print "    <title>$titre</title>\n";
    print "    <link rel=\"stylesheet\" href=\"$style\"/>\n";
    print "  </head>\n";

    print "  <body>\n";
   // print "    <header><h1>$titre</h1></header>\n";
}

function pied(){
    print "  </body>\n";
    print "</html>";
}

function footer(){
    print "<footer>\n";
    print "<div>\n";
    print "    <p>Twiitie 2018</p>\n";
    print "</div>\n";
    print "</footer>";
}


function affiche($str) {
    echo $str;
}

function affiche_info($str) {
    echo '<p>'.$str.'</p>';
}

function affiche_erreur($str) {
    echo '<p class="erreur">'.$str.'</p>';
}


function titreH1($titre){
    print "<h1>$titre</h1>\n";
}


/*
 *  Affiche le menu navigation
 */
function afficheMenu($chemin){

    print "<nav id=\"fontmenu\">\n";
    print "<ul id=\"menu\">\n";
    print "    <li>\n";
    print "        <span class=\"nomsite\">twitIIE</span>\n";
    print "    </li>\n";
    print "    <li>\n";
    print "        <a href=\"$chemin/accueil.php\">\n";
    print "         Accueil <img src=\"$chemin/icones/home.png\" alt=\"accueil\"/>\n";
    print "        </a>\n";
    print "    </li>\n";
    print "    <li>\n";
    print "        <a href=\"$chemin/profil.php?pseudo=".loginUserID($_SESSION['id'])."&id=".$_SESSION['id']."\">\n";
    print "        Mon Profil <img src=\"$chemin/icones/profil.png\" alt=\"profil\"/>\n";
    print "         </a>\n";
    print "    </li>\n";
    print "    <li>\n";
    print "        <a href=\"$chemin/Modifier_profil.php\">\n";
    print "        Edition profil <img src=\"$chemin/icones/editionprofil.png\" alt=\"edition_profil\"/>\n";
    print "        </a>\n";
    print "    </li>\n";
    print "    <li>\n";
    print "         <a href=\"$chemin/Message/Msg_Ecrire.php\">\n";
    print "        Message <img src=\"$chemin/icones/message.png\" alt=\"message\"/>\n";
    print "        </a>\n";
    print "    </li>\n";
    print "    <li>\n";
    print "        <a href=\"$chemin/deconnexion.php\">\n";
    print "        Déconnexion <img src=\"$chemin/icones/logout.png\" alt=\"bouton de déconnexion\"/>\n";
    print "        </a>\n";
    print "    </li>\n";
    print "</ul>\n";
    print "</nav>\n";
}


/* Fonctions pour messages */

function affiche_message($message){
    echo 'Message de '.$message->getEmetteur().' à '.
        ($message->getDate())->format('H:i:s').' le '.
        ($message->getDate())->format('Y-m-d').': ';
    echo $message->getContenu();
    print "</br>";
}

/*
 *
 */
function listeDiscussion($listeAmis){
    print "<p class=\"titre\">Vos amis:</p>\n";
    foreach($listeAmis as $F){
        echo '<button id=\''.$F['id'].'\' onclick="document.getElementById(\'h1\').innerHTML=\'Ma conversation avec '.$F['login'].'\'; document.getElementById(\'envoyer\').value='.$F['id'].'; Conversation(); document.getElementById(\'chat\').style.display = \'block\';">'.$F['login'].'</button>';
        print("\n");
    }
}

/*
 * Affiche la liste des amis
 */
function afficheListeAmis($listeAmis){
    print "<div class=\"amis\">Vos amis:<br/>\n";
    foreach($listeAmis as $F){
        echo "<a href=\"profil.php?pseudo=".$F['login']."&id=".$F['id']."\">@".$F['login']."</a><br/>\n";
    }
    print "</div>\n";
}


function afficheTweet($tweet, $likes){
    echo ajoutNomLien('@'.loginUserID($tweet->getAuteur()))." a tweeté à ".
        ($tweet->getDate())->format('H:i:s')." le ".($tweet->getDate())->format('Y-m-d').
        "</br><br/> ".ajoutNomLien(ajoutHashtagLien($tweet->getContenu()))."<br/></br>";
    print "\n";
    echo "        <button id=\"".$tweet->getId()."\" onclick=\"Liker(".$tweet->getId().")\">";

    if (dejaLiker($tweet->getId())) {
        echo "Je n'aime plus";
    }
    else {
        echo "J'aime";
    }
    echo "</button> Likes : ".$likes;
    print "\n";
}

/*
 * $listeTweets est un tableau de 2 colonnes avec une colonne pour les tweets et l'autre pour likes
 */
function afficheListeTweets($listeTweets){
    print "<div class=\"alltweets\">Derniers Tweets :<br/><br/>\n";
    for($i=0; $i<sizeof($listeTweets); $i++){
        echo "    <div class=\"tweets\">";
        echo afficheTweet($listeTweets[$i][1], $listeTweets[$i][0]);
        print "\n";
        echo "        <button id=\"Comment\" onclick=\"afficherCommentaire(".$listeTweets[$i][1]->getId().")\">Commenter</button>";
        print "\n    </div>\n";
    }
    print "</div>\n";
}



/*
 * Affiche tous les commentaires d'un tweet
 */
function afficherCommentaires($T) {
    print "<ul>\n";
    foreach ($T as $res) :
        echo '        <li>'.loginUserID($res->getOwnerId()).' ';
        echo 'a commenté à '.($res->getDate())->format('H:i:s')." le ".($res->getDate())->format('Y-m-d').' : ';
        echo $res->getContenu().' '."\n";


        /* Ajout bouton pour ecrire commentaire */
        echo '      <button onclick="afficherChampId('.$res->getId().');" class="inputbutton">Répondre</button>'."\n";

        if ($_SESSION['admin'] == "true") {
            //AFFICHE BOUTON SUPPRESSION*/
            echo '<form method="POST" action="Commentaire/deleteCommentaire.php">'."\n";
            echo '<input type="hidden" name="id_commentaire" value="'.$res->getId().'">'."\n";
            echo '<input type="button" value="Supprimer commentaire" onclick="if(confirm(\'Voulez-vous vraiment supprimer ce commentaire ?\')){this.form.submit();}" class="inputbutton">'."\n";
            echo "</form>\n";
        }
        echo '</br>';
        echo '      <form method="POST" action="Commentaire/envoiCommentaire.php" class="champCommentaire" id="'.$res->getId().'">'."\n";
        echo '        <input type="hidden" name="type_parent" value="commentaire">'."\n";
        echo '      <input type="hidden" name="id_parent" value="'.$res->getId().'">'."\n";
        echo '      <input type="hidden" name="TargetOwner" value="'.$res->getTargetId().'">'."\n";
        echo '        <input type="text" size=50 name="contenu" placeholder="Veuillez saisir votre commentaire ...">'."\n";
        echo '        <input type="submit" value="Envoyer" onclick="alert(\'Commentaire Envoyé\')" class="inputbutton">'."\n";
        echo "</form>\n";


        afficherCommentaires(getCommentaires($res->getId(), "commentaire"));
        print "</li>\n";
    endforeach;
    echo '</ul>';
}



/*
 * $text est un string
 * Remplace les @ par des liens cliquables vers les profils
 */
function ajoutNomLien($text){
    $T = explode(" ", $text);
    for ($i=0; $i<count($T); $i++){
        if (isset($T[$i][0])) {
            if ('@' == $T[$i][0]) {
                $id = idUserLogin(substr($T[$i], 1));
                if ($id != FALSE) {
                    $T[$i] = "<a href=\"profil.php?pseudo=".substr($T[$i],1)."&id=".$id."\">$T[$i]</a>";
                }
            }
        }
    }
    return implode(" ",$T);
}

/*
 * $text est un string
 * Remplace les hashtag # par des liens cliquables vers une page contenant tous les tweets avec ce hashtag
 */
function ajoutHashtagLien($text){
    $T = explode(" ", $text);
    for ($i=0; $i<count($T); $i++){
        if (isset($T[$i][0])) {
            if ('#' == $T[$i][0]) {
                $T[$i] = "<a href=\"hashtagTweet.php?hashtag=".substr($T[$i], 1)."\">$T[$i]</a>";
            }
        }
    }
    return implode(" ",$T);
}

/*
 * $text est un string
 * Utilisation de ajoutNomLien et ajoutHashtagLien
 */
function ajoutLienNH($text){
    return ajoutNomLien(ajoutHashtagLien($text));
}








