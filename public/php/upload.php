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

$chapitreRepository = new \User\ChapitreRepository($connection);
$chapitres = $chapitreRepository->fetchAll();
$mangaRepository = new \User\MangaRepository($connection);
$mangas = $mangaRepository->fetchAll();
?>

<?php entete() ?>

<?php bandeau()?>


<div class="container">
<?php
$target_dir = "../tmp_chap/";
if (is_dir($target_dir)){
    deleteDir($target_dir);
}
mkdir($target_dir);
$total = count($_FILES['fileToUpload']['name']);
$uploadOk = 1;
for($i=0; $i<$total; $i++) {
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"][$i]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"][$i]);
        if ($check == false) {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    // taille maximum de 5Mo par image
    if ($_FILES["fileToUpload"]["size"][$i] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.<br/>";
    // if everything is ok, try to upload file
    }
    else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_file)) {
        }
        else {
            echo "Sorry, there was an error uploading your file.<br/>";
        }
    }
}
if ($uploadOk == 1){
    echo "fichiers chargés avec succés";
}
?>

    <form action="NewDirChap.php" method="post">
        Choisir le manga :
        <select name="nom_manga">
            <?php foreach ($mangas as $manga){
                $nom=$manga->getNom();
                print "<option value=\"$nom\">$nom</option>";
            }
            ?>
        </select><br/>
        Choisir le numéro du chapitre :
        <input type="number" name="num"><br/>
        Écrire le nom du chapitre :
        <input type="text" name="nom"/><br/>
        <input type="submit" value="submit"/>
    </form>
</div>

<?php pied() ?>