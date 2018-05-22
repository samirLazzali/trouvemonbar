<?php
/**
 * Created by PhpStorm.
 * User: guyonneau
 * Date: 01/05/18
 * Time: 13:29
 */
require '../vendor/autoload.php';
include("TPVue.php");

$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');

$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
$userRepository = new \User\UserRepository($connection);

/*$ID = $_POST['Identifiant'];
$mail= $_POST[1];
$password = $_POST[2];
$nom = $_POST[3];
$prenom = $_POST[4];
$birthday= $_POST[5];*/
?>

<html>
<header>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="parametres.css">
    <h1>PinTutu</h1>
    <div class="parametre">
    </div>
</header>
<body>

<div class="formulaire">

    <?php
    	     affiche_info("Inscription");
           affiche_info("Veuillez rentrez vos informations");
           echo '<form action="creation_compte.php" formmethod="get">
               Identifiant<input type="text"  size="20" maxlength="18" name="Identifiant"><br/>
               Adresse mail<input type="text"  size="20" maxlength="18" name="Adresse_mail"><br/>
               Mot de passe<input type="password" size="20" maxlength="18" name="Mot_de_passe"><br/>
               Nom <input type="text" size="20" maxlength="18" name="Nom"><br/>
               Prénom<input type="text" size="20" maxlength="18" name="Prenom"><br/>
               Date de naissance<input type="date" size="20" maxlength="18" name="Date_naissance"><br/>
                 <input type="submit" name="action" value="Sinscrire">
                  </form>';



    ?>
</body>
</html>
