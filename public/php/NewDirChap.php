<?php
/**
 * Created by PhpStorm.
 * User: clement
 * Date: 05/05/18
 * Time: 20:37
 */
require '../../vendor/autoload.php';
include("Modele.php");
include("Vue.php");
//include ("db.php");
//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$chapitreRepository = new \User\ChapitreRepository($connection);
$chapitres = $chapitreRepository->fetchAll();
$mangaRepository =new \User\MangaRepository($connection);
?>

<?php entete() ?>

<?php bandeau()?>

<div class="container">
<?php
$nom_manga = isset($_POST['nom_manga']) ? $_POST['nom_manga'] : NULL;
$nom = isset($_POST['nom']) ? $_POST['nom'] : NULL;
$num = isset($_POST['num']) ? $_POST['num'] : NULL;
if ($nom_manga == NULL || $nom == NULL || $num == NULL){
    exit("erreur lors de l'ajout du chapitre. Veuillez vérifier que vous avez bien donné un numéro et un nom au chapitre");
}
$target_dir = "mangas/$nom_manga/$nom_manga-$num";
if (is_dir($target_dir)){
    deleteDir($target_dir);
    $chapitreRepository->delete_chapitre($num,$nom_manga);
    $mangaRepository->add_chap($nom_manga,-1);
}
mkdir($target_dir);
$count = 0;
$path="../tmp_chap";
$ignore = array( 'cgi-bin', '.', '..' );
$dh = @opendir( $path);
while( false !== ( $file = readdir( $dh ) ) )
{
    if( !in_array( $file, $ignore ) )
    {
        if( !is_dir( "$path/$file" ) )
        {
            rename($path."/".$file, $target_dir."/".$file);
            $count++;
        }
    }
}
$mangaRepository->add_chap($nom_manga,1);
closedir( $dh );
$chapitreRepository->new_chapitre($nom,$num,$count,$nom_manga);
echo "chapitre uploadé";
?>
</div>

<?php pied() ?>