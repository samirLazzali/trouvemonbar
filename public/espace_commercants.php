<?php

session_start();

if (isset($_SESSION['ok_commercant'])) {

    if ($_SESSION['ok_commercant'] == -1) {
        echo '<script type="text/javascript" language="javascript">
        var temp = "Vous n\'etes pas connecté.. Réessayez !";
        alert(temp);
        </script>';
        $_SESSION['ok_commercant'] = 1;
    }
    else if ($_SESSION['ok_commercant'] == 0) {
    echo '<script type="text/javascript" language="javascript">
    var temp = "Vous etes connecté";
    alert(temp);
    </script>';
    $_SESSION['ok_commercant'] =  1;
    }

}

?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Manger pas cher</title>
	<link rel="stylesheet" href="style.css"/>
</head>

<body>
    <div class = "corps">
    <header id = "tete">
        <div class = "logo"><a href="index.php"><img src="../img/logo/logo.png" alt="logo_manger_pas_cher" class="logo"/></a></div>
    
        <div class = "phrase_accroche"><p class = "phrase_accroche"><a href="index.php" class="phrase_approche">Une autre vision de la consommation </a></p></div>

        <div class = "espace_commercant">
                <div class = "espace_commercants">	
                        <a href="index.php" class="espace_commercants"> Retourner à l'accueil </a>
                </div>
            </div>
    
        <div class = "mon_commerce">
            <div class="mon_compte_photo">
                <a href="#10"><img src="../img/compte/mon_compte.png"/></a>
            </div>
            <div class="mon_compte_text">
                <p class = "mon_compte"> <a href="#10" class="mon_compte"> Mon Commerce ▼ </a> 
                </p>
            </div>
        </div>
    </header>

    <nav id = "menu_commercants">
        <ul class = "menu_commercants">

            <div class= "menu_commercants"><a href="Commercant.php" class= "menu_commercants"><li class = "menu_commercants">Compte Centre Commercial</li></a></div>
            <div class= "menu_commercants"><a href="Compte_Commercant.html" class= "menu_commercants"><li class = "menu_commercants">Creer compte commercant</li></a></div>
            <div class= "menu_commercants"><a href="Connexion_Pro.html" class= "menu_commercants"><li class = "menu_commercants">Se connecter Pro</li></a></div>
            <div class= "menu_commercants_ajout"><a href="Produit.html" class= "menu_commercants"><li class = "menu_commercants">Ajout Produit</li></a></div>
        </ul>
    </nav>
    <footer>
            <ul class = "footer">
                <h4 class = "footer">Auteurs</h4>
                <li>Myr</li>
                <li>Téka</li>
                <li>Bode</li>
                <li>Grominet</li>
            </ul>
    </footer>
    </div>
</body>
</html>