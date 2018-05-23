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
                <a href="index.php" class="espace_commercants"> Retourner à l'accueil </a>
            </div>
        </div>

    </header>


    <section class="inscription">
        <header class= "inscription">
            

        </header>

        <article>
            <ul class = "footer">
                <h4 class = "footer">Fonctionalité</h4>
                <li><a href='ml_data.php'> create_csv_from_dt </a></li>
                <li><a href='create_dt_from_csv.php'> create sql from csv </a></li>
                <li><a href='recomandation.php'> recommandation systeme </a></li>
                <li><a href='index.php'> acceuil </a></li>
            </ul>
                
                <p>Pour obtenir les recommendations:<br/> 
                - telecharger data.csv avec <a href='ml_data.php'> create_csv_from_dt </a><br/>
                - deplacer le fichier obtenue dans le dossier src du site<br/> 
                - lancer le programme recommand-sys.m avec octave<br/> 
                - clique sur le lien <a href='recomandation.php'> recommandation systeme </a></p>
            
        </article>
    </section>

</div>
</body>


