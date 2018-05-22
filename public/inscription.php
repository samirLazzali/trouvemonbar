<?php
session_start();
include "vue.php";
include "model.php";
if (isset($_SESSION['pseudo'])){
    header('Location: index.php'); 
}
?>
<!doctype php>
    <html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0">
    <title>inscription</title>
    <link href="http://fonts.googleapis.com/css?family=Ubuntu:400,300,400|Montserrat:400,700" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/standardize.css">
    <link rel="stylesheet" href="css/inscription-grid.css">
    <link rel="stylesheet" href="css/inscription.css">
    </head>
    <body class="body page-inscription clearfix">
<?php
$pseudo = "";
if (isset($_SESSION["pseudo"])){
    $pseudo = $_SESSION["pseudo"];
}
head($pseudo);

if (!isset($_POST['pseudo'])){

    echo '
    <section class="inscription inscription-3 clearfix">
        <form method="post" action="" id="forminscription">
        <div class="log clearfix">
            <p class="email">E-mail :</p>
            <input id="email"class="_input _input-1" placeholder="E-mail" type="text" name="email"/>
            <p class="confirmationmail">Confirmation E-mail :</p>
            <input id = "confirmationemail" class="_input _input-2" placeholder="Confirmation E-mail" type="text"/>
            <p class="prenom">Pseudo :</p>
            <input id="pseudo" class="_input _input-3" placeholder="Pseudo" type="text" name="pseudo"/>
            <p class="nom">Nom :</p>
            <input id="nom" class="_input _input-4" placeholder="Nom" type="text" name="nom"/>
            <p class="naissance">Date de naissance :</p>
            <input id="date" type="text" class="_input _input-5" placeholder="Date de naissance (JJ/MM/AAAA)" type="text" name="date"/>
            <p class="mdp">Mot de passe :</p>
            <input id="mdp" class="_input _input-6" type="password" placeholder="Mot de passe" type="text" name="mdp"/>
            <p class="confirmationmdp">Confirmation Mot de passe :</p>
            <input id="confirmationmdp" class="_input _input-7" type="password" placeholder="Confirmation mot de passe" type="text"/>
            <div class="element"></div>
        </div>••
        <ul id="errorlist" class="erreur">
            <li id="mail_regex_error"></li>
            <li id="mail_confirmation_error"></li>
            <li id="pseudo_format_error"></li>
            <li id="nom_format_error"></li>
            <li id="date_regex_error"></li>
            <li id="mdp_confirmation_error"></li>
        </ul>
        </section>
        <div class="inscription inscription-4"></div>
        <p class="inscripion">Inscription</p>
        <input type="submit" id="envoi" class="_button" value="Envoyer">
        </form>
    <footer class="contact clearfix">
        <div class="reseau clearfix">
        <div class="facebook"></div>
        <div class="twitter"></div>
        <div class="discord"></div>
        </div>
        <div class="adresse">
        <p>1, square de la Résistance</p>
        <p>91 000 Evry</p>
    </div>
    </footer>
    </body>
    </html>
    <script src="js/inscription.js"></script>';
}

else //On est dans le cas traitement

{
    $pseudo_exists = NULL;
    $email_exists = NULL;

    //On récupère les variables
    $errorCount = 0;
    $temps = time(); 
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $email = htmlspecialchars($_POST['email']);
    $mdp = htmlspecialchars(md5($_POST['mdp']));
    $nom = htmlspecialchars($_POST['nom']);
    $date = htmlspecialchars($_POST['date']);

	$db = db_connect();
    //Vérification du pseudo
    //Il faut que le pseudo n'ait jamais été utilisé
    $query=$db->prepare('SELECT COUNT(*) AS nbr FROM Membre WHERE login =?');
    $query->execute(array($pseudo));
    $pseudo_free=($query->fetchColumn()==0)?1:0;
    $query->CloseCursor();
    if(!$pseudo_free)
    {
        $pseudo_exists = "Votre pseudo est déjà utilisé par un membre";
        $errorCount++;
    }

    //Vérification de l'adresse email
    //Il faut que l'adresse email n'ait jamais été utilisée
    $query=$db->prepare('SELECT COUNT(*) AS nbr FROM Membre WHERE email = ?');
    $query->execute(array($email));
    $mail_free=($query->fetchColumn()==0)?1:0;
    $query->CloseCursor();
    if(!$mail_free)
    {
        $email_exists = "Votre adresse email est déjà utilisée par un membre";
        $errorCount++;
    }

    if ($errorCount==0)

    {
 
    echo'<h1>Inscription terminée</h1>';
    echo'<p style="color:black">Bienvenue '.stripslashes(htmlspecialchars($_POST['pseudo'])).' vous êtes maintenant inscrit sur le site !</p> <p style="color:black">Cliquez <a href="connexion.php">ici</a> pour vous connecter.</p>';
    echo $_POST['nom'];
    $query=$db->prepare('INSERT INTO Membre (login, firstname, lastname, birthday,password, email, id_groupe)
                VALUES (:pseudo, :prenom, :nom, :date, :mdp, :email, :id_groupe)');
	$query->bindValue(':pseudo', $pseudo, PDO::PARAM_INT);
	$query->bindValue(':email', $email, PDO::PARAM_STR);
	$query->bindValue(':prenom', '', PDO::PARAM_STR);
	$query->bindValue(':nom', $nom, PDO::PARAM_STR);
	$query->bindValue(':date', $date, PDO::PARAM_STR);
    $query->bindValue(':mdp', $mdp, PDO::PARAM_STR);
    $query->bindValue(':email', $email, PDO::PARAM_STR);
	$query->bindValue(':id_groupe', 1, PDO::PARAM_STR);
    $query->execute();

         
    //Et on définit les variables de sessions
    $query->CloseCursor();
    }

    else{
        echo'<h1 style="color:black">Inscription interrompue</h1>';

        echo'<p style="color:black"> Une ou plusieurs erreurs se sont produites pendant l\'inscription.</p>';

        echo'<p style="color:black">'.$errorCount.' '.'erreur(s)</p>';

        echo'<p style="color:red">'.$pseudo_exists.'</p>';

        echo'<p style="color:red">'.$email_exists.'</p>';
       
        echo'<p style="color:black">Cliquez <a href="./inscription.php">ici</a> pour recommencer</p>';
    }
}
?>