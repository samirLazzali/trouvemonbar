<?php

require '../vendor/autoload.php';

$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

session_start();


if ($_SESSION['identifiant']==NULL) {
    echo 'SESSION EXPIRE';
    echo '<form action="index.php" formmethod="get" >';
    echo '<input type="submit" value="Retour">';
    echo '</form>';
}
else {
    $user = $_SESSION['identifiant'];
}
?>


<html>
<link rel="stylesheet" href="parametres.css" type="text/css">
    <body>
    <header>
        <h1>PinTutu</h1>
        <div class="parametre">
            <form action="main2.php" formethod="post">
                <input type="submit" name="Paramètres" value="Menu principal"/>
            </form>
            <form action="ajout.php" formethod="post">
                <input type="submit" name="ajout" value="Ajouter du contenu"/>
            </form>
        </div>
    </header>
    <body>
    <?php
        $userRepository = new \User\UserRepository($connection);
        if (isset($_GET["modif_mdp"])) {
            $old = $_GET["old"];
            $new = $_GET["new"];
            $users=$userRepository->fetchAll();
            $count = 0;
            foreach ($users as $gens)
                    {
                        if ($gens->pseudo==$user && $gens->mdp==$old)
                        {
                            $count=$count+1;
                        }

                    }
                    if ($count == 1) {
                        $userRepository->modif_mdp($user, $new);
                      }
                    else {
                      echo 'Mauvais Mot de Passe';
                      echo '</body>';
                      exit();
                    }

        }
        $info_user = $userRepository->fetch($user)->fetch();
        $avatar = $info_user["avatar"];
        $pseudo = $info_user["pseudo"];
        $date = $info_user["date_naissance"];
        $nom = $info_user["nom"];
        $prenom = $info_user["prenom"];
        $rang = $info_user["rang"];
        $mail = $info_user["mail"];

    if ($avatar==NULL) {
        echo '<img src="Image/default.png" alt="avatardef">';
    }
    else {
        echo '<img src="Image/'.$avatar.' alt="avatar">';
    }



    echo '<form action="main2.php" formmethod="get" >';
    echo 'Pseudo : '.$pseudo.'</br>';
    if ($rang=="1") {
        echo 'Rang: Admin';
    }
    else {
        echo 'Rang: User';
    }
    echo '</br>';
    echo 'Date de naissance :';
    echo '<input type="date" size="20" maxlength="18" name="date" value="' . $date . '"></br>';
    echo 'Nom :';
    echo '<input type="text" size="20" maxlength="18" name="nom" value="' . $nom . '"></br>';
    echo 'Prenom :';
    echo '<input type="text" size="20" maxlength="18" name="prenom" value="' . $prenom . '"></br>';
    echo 'Mail :';
    echo '<input type="text" size="20" maxlength="18" name="mail" value="'.$mail.'"></br>';
    echo '<input type="submit" name="modif" value="Modifier">';
    echo '</form></br>';
    echo '<form action="Changemdp.php", formmethod="get">';
    echo '<input type="submit", value="Modifer mot de passe">';
    echo '</form>'  ;




    ?>
</html>
