<?php

session_start();

if(!isset($_SESSION['userpseudo']))

{

echo 'Vous n\'êtes pas connecté au site. Vous ne pouvez donc pas venir sur cette page.';

exit;

}

//  Récupération de l'utilisateur et de son pass hashé

$req = $bdd->prepare('SELECT pseudo, passeword FROM utilisateur WHERE pseudo = :pseudo');
$req->execute(array('pseudo' => $pseudo));

$resultat = $req->fetch();


// Comparaison du pass envoyé via le formulaire avec la base
$isPasswordCorrect = password_verify($_POST['passeword'], $resultat['passeword']);


if (!$resultat)
{
    echo 'Mauvais identifiant ou mot de passe !';
}

else
{
    if ($isPasswordCorrect) {
        session_start();
        $_SESSION['pseudo'] = $resultat['pseudo'];
        echo 'Vous êtes connecté !';

    }
    else {
        echo 'Mauvais identifiant ou mot de passe !';
    }
}


//Désormais, sur toutes les pages du site, on pourra indiquer au membre qu'il est connecté grâce à la présence des variables$_SESSION.
if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
{
    echo 'Bonjour ' . $_SESSION['pseudo'];
}
?>
