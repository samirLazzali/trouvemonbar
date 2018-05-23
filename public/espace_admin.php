<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style-connexion.css"/>
    <title>Connexion !</title>
</head>
<body>
<div class = "corps">
    <header class = "tete">
        <div class = "logo"><a href="index.php"><img src="../img/logo/logo.png" alt="logo_manger_pas_cher" class="logo"/></a></div>

        <div class = "phrase_accroche"><p class = "phrase_accroche"><a href="index.php" class="phrase_approche">Une autre vision de la consommation </a></p></div>

        <div class = "espace_commercant">
            <div class = "espace_commercants">
                <a href="index.php" class="espace_commercants"> Retourner à l'acceuil </a>
            </div>
        </div>

    </header>


    <section class="inscription">
        <header class= "inscription">
            <h1> Connectez-vous administrateur </h1>

        </header>

        <article class= "creation_compte_adm">
            <form action="Connexion_Administrateur.php" method="post">

                <div class="creation_compte">
                    Nom : <div class="compte_form"> <input type="text" size="16" maxlength="15" value="nom" name="nom" /> </div>
                </div>
                <div class="creation_compte">
                    Mot de passe : <div class="compte_form"> <input type="password" size="16" maxlength="15" value="mot_de_passe" name="mot_de_passe" /> </div>
                </div>
                <div class="creation_compte">
                    <input type="submit" value="Envoyer" name="Bouton">
                </div>
            </form>
        </article>
    </section>

</div>
</body>


