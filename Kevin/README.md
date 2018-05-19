#Projet_Web : TwittIIe


## POUR LA sécurité : 

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

test_input($debitInit) DANS LES WHERE


POUR METTRE à jour msg : AJAX AUSSI


### 1/05/18

+ CHAT defilant? OK

MAIS UN Probleme tjr : raffraichissement automatique -> OK actualisation auto toute les 10 secs


+ Nombre de like et possibilité de like
    Modification de  :
        nbLike()
        tweet()
        Liker() -> OKKKK
        Dislike si déjà liker


ATTENTION ---------> POUR Les modifications dans SQL, utiliser ID au lieu du pseudo

pb -> TABLE AMIS PAS BONNE : Il faut mettre id des users en attribut ---> OKKKKKK


Ajout CSS pour messages 


PROBLEME : Affichage de laccueil pas bon pour petit ecran


12/05
# Commentaire
+ getCommentaires -> Ok
+ afficheCommentaires -> Ok

A faire :
+ ajout bouton pour ecrire commentaires

### 13/05
+ Ajout de getListeTweets($id) dans Modele.php
+ Ajout de afficheListeTweets($T) dans Vue.php
+ Modification de profil.php

+ 

### 16/05

+ Faire les notifs ???
+ Finir commentaires -> Ajout envoie par post OK

+ FAIRE MESSAGE EN MODE POST ???

+ NOMS d'utilisateur cliquable 




### 17/05

+ Hashtag cliquables puis affiche page avec tous les autres tweets contenants hashtag similaire
+ getTweetId
+ getTweetLikes
+ Deconnexion??? Ok



+ Hashtag -> Marche pas encore

pb dans ecrire tweet !!!



### 19/05
+ AJout suggestion hashtag
+ ajout des hashtags cliquables
+ Recherche d'hashtag 
+ Ajout Je n'aime pas


+ AJOUT Du travail de Julien sur profil : ajout et suppression de d'amis


















