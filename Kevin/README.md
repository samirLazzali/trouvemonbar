Projet_Web : TwittIIe

Journal 26/04



POUR LA sécurité : 

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

test_input($debitInit) DANS LES WHERE


POUR METTRE à jour msg : AJAX AUSSI


1/05/18

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
















