<?php


session_start();
header('Content-type: text/html; charset=utf-8');
include('../includes/config.php');

/********Actualisation de la session...**********/


$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

include('../includes/fonctions.php');


/********Fin actualisation de session...**********/
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0">
    <title>inscription</title>
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400|Kite+One:400,400|Bitter:400" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../css/standardize.css">
    <link rel="stylesheet" href="../css/inscription-grid.css">
    <link rel="stylesheet" href="../css/inscription.css">
</head>
<body class="body page-inscription clearfix">
<header class="cuisine cuisine-1 clearfix">
    <div class="logo"></div>
    <p class="accroche">L'association des fins gourmets de l'ENSIIE !</p>
    <div onClick="window.location='connexion.php';" class="connexion connexion-1 clearfix">
        <p class="connexion">Connexion</p>
    </div>
    <div onClick="window.location='inscription.php';" class="inscription inscription-1 clearfix">
        <p class="inscription inscription-2">Inscription</p>
    </div>
    <nav class="navigation clearfix">
        <div onClick="window.location='../index.php';" class="accueil accueil-1 clearfix">
            <p class="accueil">Accueil</p>
        </div>
        <div onClick="window.location='../menu.php';" class="menu menu-1 clearfix">
            <p class="menu">Menu</p>
        </div>
        <div onClick="window.location='../reservation.php';" class="reservation reservation-1 clearfix">
            <p class="reservation">Réservation</p>
        </div>
        <div onClick="window.location='../catalogue.php';" class="recettes recettes-1 clearfix">
            <p class="recettes">Recettes</p>
        </div>
    </nav>
</header>

<?php
if(isset($_SESSION['membre_id']))
{
    header('Location: '.ROOTPATH.'/index.php');
    exit();
}




$_SESSION['erreurs'] = 0;


//Pseudo

if(isset($_POST['pseudo']))

{

    $pseudo = trim($_POST['pseudo']);

    $pseudo_result = checkpseudo($pseudo,$connection);

    if($pseudo_result == 'tooshort')

    {

        $_SESSION['pseudo_info'] = '<span class="erreur">Le pseudo '.htmlspecialchars($pseudo, ENT_QUOTES).' est trop court, vous devez en choisir un plus long (minimum 3 caractères).</span><br/>';

        $_SESSION['form_pseudo'] = '';

        $_SESSION['erreurs']++;

    }



    else if($pseudo_result == 'toolong')

    {

        $_SESSION['pseudo_info'] = '<span class="erreur">Le pseudo '.htmlspecialchars($pseudo, ENT_QUOTES).' est trop long, vous devez en choisir un plus court (maximum 32 caractères).</span><br/>';

        $_SESSION['form_pseudo'] = '';

        $_SESSION['erreurs']++;

    }



    else if($pseudo_result == 'exists')

    {

        $_SESSION['pseudo_info'] = '<span class="erreur">Le pseudo '.htmlspecialchars($pseudo, ENT_QUOTES).' est déjà pris, choisissez-en un autre.</span><br/>';

        $_SESSION['form_pseudo'] = '';

        $_SESSION['erreurs']++;

    }



    else if($pseudo_result == 'ok')

    {

        $_SESSION['pseudo_info'] = '';

        $_SESSION['form_pseudo'] = $pseudo;

    }



    else if($pseudo_result == 'empty')

    {

        $_SESSION['pseudo_info'] = '<span class="erreur">Vous n\'avez pas entré de pseudo.</span><br/>';

        $_SESSION['form_pseudo'] = '';

        $_SESSION['erreurs']++;

    }

}


else

{

    header('Location: ../index.php');

    exit();

}


//Mot de passe

if(isset($_POST['mdp']))

{

    $mdp = trim($_POST['mdp']);

    $mdp_result = checkmdp($mdp, '');

    if($mdp_result == 'tooshort')

    {

        $_SESSION['mdp_info'] = '<span class="erreur">Le mot de passe entré est trop court, changez-en pour un plus long (minimum 4 caractères).</span><br/>';

        $_SESSION['form_mdp'] = '';

        $_SESSION['erreurs']++;

    }



    else if($mdp_result == 'toolong')

    {

        $_SESSION['mdp_info'] = '<span class="erreur">Le mot de passe entré est trop long, changez-en pour un plus court. (maximum 50 caractères)</span><br/>';

        $_SESSION['form_mdp'] = '';

        $_SESSION['erreurs']++;

    }



    else if($mdp_result == 'nofigure')

    {

        $_SESSION['mdp_info'] = '<span class="erreur">Votre mot de passe doit contenir au moins un chiffre.</span><br/>';

        $_SESSION['form_mdp'] = '';

        $_SESSION['erreurs']++;

    }



    else if($mdp_result == 'noupcap')

    {

        $_SESSION['mdp_info'] = '<span class="erreur">Votre mot de passe doit contenir au moins une majuscule.</span><br/>';

        $_SESSION['form_mdp'] = '';

        $_SESSION['erreurs']++;

    }



    else if($mdp_result == 'ok')

    {

        $_SESSION['mdp_info'] = '';

        $_SESSION['form_mdp'] = $mdp;

    }



    else if($mdp_result == 'empty')

    {

        $_SESSION['mdp_info'] = '<span class="erreur">Vous n\'avez pas entré de mot de passe.</span><br/>';

        $_SESSION['form_mdp'] = '';

        $_SESSION['erreurs']++;


    }

}


else

{

    header('Location: ../index.php');

    exit();

}


//Mot de passe suite

if(isset($_POST['mdp_verif']))

{

    $mdp_verif = trim($_POST['mdp_verif']);

    $mdp_verif_result = checkmdpS($mdp_verif, $mdp);

    if($mdp_verif_result == 'different')

    {

        $_SESSION['mdp_verif_info'] = '<span class="erreur">Le mot de passe de vérification diffère du mot de passe.</span><br/>';

        $_SESSION['form_mdp_verif'] = '';

        $_SESSION['erreurs']++;

        if(isset($_SESSION['form_mdp'])) unset($_SESSION['form_mdp']);

    }



    else

    {

        if($mdp_verif_result == 'ok')

        {

            $_SESSION['form_mdp_verif'] = $mdp_verif;

            $_SESSION['mdp_verif_info'] = '';

        }



        else

        {

            $_SESSION['mdp_verif_info'] = str_replace('passe', 'passe de vérification', $_SESSION['mdp_info']);

            $_SESSION['form_mdp_verif'] = '';

            $_SESSION['erreurs']++;

        }

    }

}


else

{

    header('Location: ../index.php');

    exit();

}


//mail

if(isset($_POST['mail']))

{

    $mail = trim($_POST['mail']);

    $mail_result = checkmail($mail,$connection);

    if($mail_result == 'isnt')

    {

        $_SESSION['mail_info'] = '<span class="erreur">Le mail '.htmlspecialchars($mail, ENT_QUOTES).' n\'est pas valide.</span><br/>';

        $_SESSION['form_mail'] = '';

        $_SESSION['erreurs']++;

    }



    else if($mail_result == 'exists')

    {

        $_SESSION['mail_info'] = '<span class="erreur">Le mail '.htmlspecialchars($mail, ENT_QUOTES).' est déjà pris, <a href="../contact.php">contactez-nous</a> si vous pensez à une erreur.</span><br/>';

        $_SESSION['form_mail'] = '';

        $_SESSION['erreurs']++;

    }



    else if($mail_result == 'ok')

    {

        $_SESSION['mail_info'] = '';

        $_SESSION['form_mail'] = $mail;

    }



    else if($mail_result == 'empty')

    {

        $_SESSION['mail_info'] = '<span class="erreur">Vous n\'avez pas entré de mail.</span><br/>';

        $_SESSION['form_mail'] = '';

        $_SESSION['erreurs']++;

    }

}


else

{

    header('Location: ../index.php');

    exit();

}


//mail suite

if(isset($_POST['mail_verif']))

{

    $mail_verif = trim($_POST['mail_verif']);

    $mail_verif_result = checkmailS($mail_verif, $mail);

    if($mail_verif_result == 'different')

    {

        $_SESSION['mail_verif_info'] = '<span class="erreur">Le mail de vérification diffère du mail.</span><br/>';

        $_SESSION['form_mail_verif'] = '';

        $_SESSION['erreurs']++;

    }



    else

    {

        if($mail_result == 'ok')

        {

            $_SESSION['mail_verif_info'] = '';

            $_SESSION['form_mail_verif'] = $mail_verif;

        }



        else

        {

            $_SESSION['mail_verif_info'] = str_replace(' mail', ' mail de vérification', $_SESSION['mail_info']);

            $_SESSION['form_mail_verif'] = '';

            $_SESSION['erreurs']++;

        }

    }

}


else

{

    header('Location: ../index.php');

    exit();

}

/*************Fin étude******************/






/**********Fin entête et titre***********/

?>



<div class="inscription inscription-5 clearfix">


<!--Test des erreurs et envoi-->
			<?php
            $sqlbug=false;

            if($_SESSION['erreurs'] > 0)

            {

                if($_SESSION['erreurs'] == 1) $_SESSION['nb_erreurs'] = '<span class="erreur">Il y a eu 1 erreur.</span><br/>';

                else $_SESSION['nb_erreurs'] = '<span class="erreur">Il y a eu '.$_SESSION['erreurs'].' erreurs.</span><br/>';

                ?>

                <h1>Inscription non validée.</h1>

                <p>Vous avez rempli le formulaire d'inscription du site et nous vous en remercions, cependant, nous n'avons

                pas pu valider votre inscription, en voici les raisons :<br/>

                <?php

                echo $_SESSION['nb_erreurs'];

                echo $_SESSION['pseudo_info'];

                echo $_SESSION['mdp_info'];

                echo $_SESSION['mdp_verif_info'];

                echo $_SESSION['mail_info'];

                echo $_SESSION['mail_verif_info'];




                if($sqlbug !== true)

                {

                    ?>

                    Nous vous proposons donc de revenir à la page précédente pour corriger les erreurs. </p>

                    <div class="center"><a href="inscription.php">Retour</a></div>

                    <?php

                }



                else

                {

                    ?>

                    Une erreur est survenue dans la base de données, votre formulaire semble ne pas contenir d'erreurs, donc

                    il est possible que le problème vienne de notre côté.</p>



                    <div class="center"><a href="inscription.php">Retenter une inscription</a> </div>

                    <?php

                }

            }

			if($_SESSION['erreurs'] == 0)
			{
			    $insertion = $connection->prepare('INSERT INTO membres(membre_pseudo,membre_mdp,membre_mail,membre_banni,membre_admin) VALUES( :pseudo, :mdp, :mail, 0,0);');
			    $insertion->execute(array(':pseudo' => $pseudo, ':mdp' => $mdp, ':mail' => $mail));

				if($insertion->setFetchMode())
				{
					$queries++;
					vidersession();


				    ?>
	    		    <h1>Inscription validée !</h1>
			        <p>Nous vous remercions de vous être inscrit, votre inscription a été validée !<br/>
			        Vous pouvez vous connecter avec vos identifiants <a href="connexion.php">ici</a>.
			        </p>
				    <?php
				}

				else
                {

					if($_SESSION['erreurs'] == 0)
					{
						$sqlbug = true; //plantage SQL.
						$_SESSION['erreurs']++;
					}
				}
			}





    ?>

</div>
</body>
</html>

<!--fin-->
