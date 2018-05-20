<?php
session_start();
require '../vendor/autoload.php';
include('menu.php');
//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new \User\UserRepository($connection);
$users = $userRepository->fetchAll();


if (isset($_SESSION['connect']) && $_SESSION['connect']==2) {
    echo '<html>';
    echo '<head>';
    echo '<title> profil  </title>';
    echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">';
    echo '<link rel="stylesheet" type="text/css"  href="style_index.css">';
    echo '<link rel="stylesheet" href="css/bootstrap.css">';
    echo '<link rel="stylesheet" href="css/style.css">';

    echo '</head>';
    echo '<body>';

    echo '<div class="banniere">';
    menu_navigation();
    echo '</div>';

    echo '<h1>Réunions</h1>';
    echo '<form method="post" action="#">';
    echo '    <fieldset><legend>Soirée </legend><input type ="text" name="soiree" /></fieldset>';
    echo '    <fieldset><legend>Date </legend><input type="date" name="date" /></fieldset>';
    echo '    <fieldset><legend>Compte Rendu</legend><input type="text" name="cr" /></fieldset>';
    echo '   <input type ="submit" name="submit" value="Ajouter"/>';
    echo '</form>';
    echo '</br>';
    echo '<h1>Réunions</h1>';
    echo '<form method="post" action="#">';
    echo '    <fieldset><legend>Recette </legend><input type ="text" name="recette" /></fieldset>';
    echo '    <fieldset><legend>Note </legend><input type ="number" name="note" min=0 max=5 /></fieldset>';
    echo '   <input type ="submit" name="submit" value="Ajouter"/>';
    echo '</form>';

    $iid=$connection->query("SELECT 'id' FROM public.reunion")->fetchAll();
    $irec=$connection->query("SELECT * FROM public.recette")->fetchAll();
    $j=1;
    foreach($irec as $id){
        $j++;
    }  
    echo $j;
    if(isset($_POST['recette'])){
        $req=$connection->prepare('INSERT INTO public.recette(id_rec,recettes,note,id_usr) VALUES(:id_rec,:recettes,:note,:id_usr)');
        $req->execute(['id_rec' => 2,
            'recettes'=>$_POST['recette'],
            'note'=>$_POST['note'],
            'id_usr' => $_SESSION['id'],
            ]);
    }

    $i=1;
    foreach($iid as $id){
        $i++;
    }
    if (isset($_POST['soiree']) && isset($_POST['date']) && isset($_POST['cr'])) {
        $req = $connection->prepare('INSERT INTO public.reunion(id_reu,soiree,cr,datee) VALUES(:id_reu,:soiree,:cr,:datee)');
        $req->execute(['id_reu'=> $i,
            'soiree' => $_POST['soiree'],
            'datee' => $_POST['date'],
            'cr' => $_POST['cr'],
        ]);
    }

        
    
}
else {
    echo '<link rel="stylesheet" href="css/style.css">';
    echo '<html>';
    echo '<body>';
    echo "<h2>Vous n'avez pas les droits d'administration !</h2>";
    echo "<a href='index.php'>Accueil</a>";
    echo '</body>';
    echo '</html>';
}


