<?php
/**
 * Created by PhpStorm.
 * User: clement
 * Date: 19/04/18
 * Time: 22:04
 */
require '../../vendor/autoload.php';
include("Modele.php");
include("Vue.php");
//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$mangaRepository = new \User\MangaRepository($connection);
$mangas = $mangaRepository->fetchAll();
?>

<?php entete() ?>

<?php bandeau()?>
<div class="container">

    <table class="listemanga">
            <tr>
                <th>Nom</th>
                <th>Auteur</th>
                <th>Genre</th>
                <th>Statut</th>
            </tr>

        <?php
        foreach ($mangas as $manga) : ?>
            <tr>
                <td><?php echo "<a href=\"manga.php?manga={$manga->getNom()}\" style=\"color: black; text-decoration: none;\">".$manga->getNom()."</a>" ?></td>
                <td><em><?php echo $manga->getAuteur() ?></em></td>
                <td><?php echo $manga->getGenre() ?></td>
                <td><em><?php echo $manga->getStatut() ?></em></td>
            </tr>
        <?php endforeach; ?>

    </table>
</div>

<?php pied() ?>