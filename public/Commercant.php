<?php
session_start();
if (isset($_SESSION['id_ad'])) {

    $a=1 ;

}
else{
    $a=0;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style-connexion.css"/>
    <title>Nouveau compte Commercant</title>
</head>


<body>
<div class = "corps">
    <header class = "tete">
        <div class = "logo"><a href="index.php"><img src="../img/logo/logo.png" alt="logo_manger_pas_cher" class="logo"/></a></div>

        <div class = "phrase_accroche"><p class = "phrase_accroche"><a href="index.php" class="phrase_approche">Une autre vision de la consommation </a></p></div>

        <div class = "espace_commercant">
            <div class = "espace_commercants">
                <a href="index.php" class="espace_commercants"> Retourner à l'accueil </a>
            </div>
        </div>

    </header>
    <?php
    if ($a==1){

    echo'<section class="inscription">
        <header class= "inscription">
            <h1> Inscrivez-vous</h1>

       </header>

        <article class= "creation_compte_gen">
            <form action="Creation_Compte_Centre_Commercial.php" method="post">

                <div class="creation_compte">
                    Enseigne : <div class="compte_form"> <input type="text" size="16" maxlength="15" value="enseigne" name="enseigne" /> </div>
                </div>
                <div class="creation_compte">
                    Horaire ouverture : <div class="compte_form"><input type="number" size="16" maxlength="15" value="0" name="horaire_debut" /></div>
                </div>
                <div class="creation_compte">
                    Horaire fermeture : <div class="compte_form"> <input type="number" size="16" maxlength="15" value="0" name="horaire_fin" /> </div>
                </div>
                <div class="creation_compte">
                    Adresse : <div class="compte_form"> <input type="text" size="41" maxlength="40" value="adresse" name="adresse" /> </div>
                </div>
                <div class="creation_compte">
                    <input type="submit" value="Envoyer" name="Bouton">
                </div>
            </form>
        </article>
    </section>';
    }
    else{
    echo "Vous êtes pas connectés en tant que commercant";
    }
    ?>
</div>
</body>

