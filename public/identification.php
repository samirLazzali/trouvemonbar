<?php
/**
 * Created by PhpStorm.
 * User: guyonneau
 * Date: 01/05/18
 * Time: 13:30
 */
require '../vendor/autoload.php';




?>
<?php
session_start();
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');

$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
$userRepository = new \User\UserRepository($connection);
$user=$userRepository->fetchAll();

if ($_GET['action']=='Sinscrire'){
    $userRepository->insert($identifiant,$Adresse_mail,$Mot_de_passe,$Nom,$Prenom,$Date_naissance);


}


else {
    if ($_GET['action'] == 'Connexion') {
        $ID = $_GET['identifiant'];
        $password = $_GET['password'];
        if (!empty($password) && !empty($ID)) {
            $count=0;
            foreach ($user as $gens)
            {
                if ($gens->pseudo=="$ID" && $gens->mdp=="$password")
                {
                    $count=$count+1;
                    $_SESSION['rang']=$gens->rang;
                }

            }
            if ($count == 1) {

                $_SESSION['identifiant']=$ID;

                header('Location: main2.php');
                exit();
            } elseif ($count == 0) {
                $erreur = 'Mauvais login/Mot de passe';
                echo "$erreur";
            } else {
                $erreur = 'Problème dans la base de données : plusieurs membres ont les mêmes identifiants de connexion.';
                echo "$erreur";
            }
        } else {
            $erreur = 'Au moins un des champs est vide.';
            echo "$erreur";
        }
    }
}


