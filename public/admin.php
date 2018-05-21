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
    echo '<title> Administration  </title>';
    echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">';
    echo '<link rel="stylesheet" type="text/css"  href="style_index.css">';
    echo '<link rel="stylesheet" href="css/bootstrap.css">';
    echo '<link rel="stylesheet" href="css/style.css">';
    echo '<link rel="stylesheet" href="css/form.css">';

    echo '</head>';
    echo '<body>';

    menu_navigation();
    echo '<br />';
    echo '<br />';
    echo '<br />';
    
    echo '<div class="gtco-container">';

    echo '<div class="form-c">';
    echo '<div class="form-c-head">Planifier une réunion :</div>';
    echo '<form method = "post" action="#">';
    echo '<label for="soiree"><span class="txt">Soirée</span><input type="text" class="input-field" name="soiree" value="" /></label>';
    echo '<label for="date"><span class="txt">Date <span class="required">*</span></span><input type="date" class="input-field" name="date" value="" /></label>';
    echo '<label for="cr"><span>Compte Rendu <span class="required">*</span></span><input type="text" class="input-field" name="cr" value="" /></label>';
    echo '<input type ="submit" name="submit" value="Ajouter"/>';
    echo '</form>';
    echo '</div>';
    echo '</div>';
    echo '</div>';

    echo '<div class="gtco-container">';
    echo '<br />';
    echo '<br />';
    echo '<div class="form-c">';
    echo '<div class="form-c-head">Ajouter une recette :</div>';
    echo '<form method = "post" action="#">';
    echo '<label for="recette"><span class="txt">Recette <span class="required">*</span></span><input type="text" class="input-field" name="recette" value="" /></label>';
    echo '<input type ="submit" name="submit" value="Ajouter"/>';
    echo '</form>';
    echo '</div>';
    echo '</div>';

    echo '</div>';

    echo '<div class="gtco-container">';
    echo '<br />';
    echo '<br />';
    echo '<div class="form-c">';
    echo '<div class="form-c-head">Ajouter un vin :</div>';
    echo '<form method = "post" action="#">';
    echo '<label for="nomvin"><span class="txt">Nom du vin <span class="required">*</span></span><input type="text" class="input-field" name="nomvin" value="" /></label>';
    echo '<input type ="submit" name="submit" value="Ajouter"/>';
    echo '</form>';
    echo '</div>';
    echo '</div>';
    echo '</div>';


    echo '<div class="gtco-container">';
    echo '<br />';
    echo '<br />';
    echo '<div class="form-c">';
    echo '<div class="form-c-head">Préparatif</div>';
    echo '<form method = "post" action="#">';
    echo '<label for="recette"><span class="txt">Soirée <span class="required">*</span></span><input type="text" class="input-field" name="soiree"  /></label>';
    echo '<label for="recette"><span class="txt">Ingrédients <span class="required">*</span></span><textarea rows="10" cols="59" class="input-field" name="ingredient" ></textarea></label>';
    echo '<input type ="submit" name="submit" value="Ajouter"/>';
    echo '</form>';
    echo '</div>';
    echo '</div>';

    echo '</div>';

    $iid=$connection->query("SELECT 'id' FROM public.reunion")->fetchAll();

     $irec=$connection->query("SELECT * FROM public.recette");
    $j=1;
    if (!$irec) {
        $ids=$irec->fetchAll();
        foreach ($ids as $id) {
            $j++;
        }
    }
    if(isset($_POST['recette'])){
            $req=$connection->prepare('INSERT INTO public.recette(id_rec,recettes) VALUES(:id_rec,:recettes)');
            $req->execute(['id_rec' => $j,
            'recettes'=> $_POST['recette'],
            ]);
    }
    
    
     $ivin=$connection->query("SELECT * FROM public.liste_vins");
    $j=1;
    if (!$ivin) {
        $ids=$ivins->fetchAll();
        foreach ($ids as $id) {
            $j++;
        }
    }
    if(isset($_POST['nomvin'])){
            $req=$connection->prepare('INSERT INTO public.liste_vins(id_vin,nom) VALUES(:id_vin,:nom)');
            $req->execute(['id_vin' => $j,
            'nom'=> $_POST['nomvin'],
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

    if(isset($_POST['soiree']) && $_POST['ingredient']){
        $connection->exec('DELETE FROM public.participants_course');
        $req=$connection->prepare('INSERT INTO public.participants_course(id_par,soiree,pseudo,course) VALUES(:id_par,:soiree,:pseudo,:course)');
        $req->execute(['id_par' => '0',
            'soiree' => $_POST['soiree'],
            'pseudo' => $_SESSION['pseudo'],
            'course' => $_POST['ingredient'],
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


