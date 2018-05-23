<?php
/**
 * Created by PhpStorm.
 * User: clement
 * Date: 30/04/18
 * Time: 23:07
 */
require '../../vendor/autoload.php';
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
$mangaRepository = new \User\MangaRepository($connection);
$mangas = $mangaRepository->fetchAll();
include("Modele.php");
include("Vue.php");
?>

<?php entete() ?>

<?php bandeau()?>

<div class="container">
    <?php
        $nom = isset($_POST['nom']) ? $_POST['nom'] : NULL;
        $auteur = isset($_POST['auteur']) ? $_POST['auteur'] : NULL;
        $genre = isset($_POST['genre']) ? $_POST['genre'] : NULL;
        $statut = isset($_POST['statut']) ? $_POST['statut'] : NULL;
        $debut = isset($_POST['debut']) ? $_POST['debut'] : NULL;
        $fin = isset($_POST['fin']) ? $_POST['fin'] : NULL;
        foreach ($mangas as $manga){
            if ($_POST['nom'] === $manga->getNom()){
                exit("erreur : le manga existe déjà");
            }
        }
        if ($statut === "coming soon"){

            $test = $mangaRepository->new_manga($nom,$auteur,$genre,$statut,0,0,0,NULL,NULL);
            if ($test != false){
                if (!is_dir("mangas")) {
                    mkdir("mangas");
                }
                mkdir("mangas/$nom");
                echo "Nouveau manga ${_POST['nom']} ajouté";
            }
            else{
                echo "erreur lors de l'ajout du manga. Veuillez réessayer";
            }
        }
        elseif ($statut === "en cours"){
            $test = $mangaRepository->new_manga($nom,$auteur,$genre,$statut,0,0,0,$debut,NULL);
            if ($test != false){
                if (!is_dir("mangas")) {
                    mkdir("mangas");
                }
                mkdir("mangas/$nom");
                echo "Nouveau manga ${_POST['nom']} ajouté";
            }
            else{
                echo "erreur lors de l'ajout du manga. Veuillez réessayer";
            }
        }
        else{
            $test = $mangaRepository->new_manga($nom,$auteur,$genre,$statut,0,0,0,$debut,$fin);
            if ($test != false){
                if (!is_dir("mangas")) {
                    mkdir("mangas");
                }
                mkdir("mangas/$nom");
                echo "Nouveau manga ${_POST['nom']} ajouté";
            }
            else{
                echo "erreur lors de l'ajout du manga. Veuillez réessayer";
            }
        }
    ?>
</div>

<?php pied() ?>
