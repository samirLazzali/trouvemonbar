<?php
/**
 * Created by PhpStorm.
 * User: guyonneau
 * Date: 22/05/18
 * Time: 10:40
 */

require '../src/TagContenuMedia/TagContenuMediaRepository.php';
require '../src/Media/MediaRepository.php';
require '../src/Media/Media.php';
session_start();

$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');

$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
$MediaRepository= new \Media\MediaRepository($connection);
$Medias = $MediaRepository->fetchAll();


?>




<html>
<link rel="stylesheet" href="main.css" type="text/css">
<body>
<header>
    <h1>PinTutu</h1>
    <div class="parametre">
        <form action="parametres.php" formethod="post">
            <input type="submit" name="Paramètres" value="Parametres"/>
        </form>
        <form action="main2.php" formethod="post">
            <input type="submit" name="Paramètres" value="Menu principal"/>
        </form>
        <form action="ajout.php" formethod="post">
            <input type="submit" name="ajout" value="Ajouter du contenu"/>
        </form>
        <form action="index.php" formethod="post">
            <input type="submit" name="deconnexion" value="Déconnexion">
        </form>
    </div>
</header>
<?php
if (isset($_SESSION['identifiant'])) {


    echo '<main>
			
			<div class="mosaique">';


    foreach ($Medias as $media) {
        $count = 1;



            if ($media->valide=="0") {
                        echo ' <img src="Image/' . $media->id_media . '" alt="image1" / width="100" height="100">';
                        echo '<form action="main2.php" method="get">
                                <input type="hidden" name="id_media" value='.$media->id_media.'>
                                <input type="submit" name="submit" value="Valider">
                            </form>';


                        if ($count % 4 == 0) {
                            echo '<br/>';

                        }
                        $count = $count + 1;

                    }
                }

echo ' </div>
			</main>';


    }




else {
    echo 'Session expirée';
}

?>
</body>
</html>
