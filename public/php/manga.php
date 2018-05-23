<?php
/**
 * Created by PhpStorm.
 * User: clement
 * Date: hmmmm
 * Time: 23:02
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
$chapitreRepository = new \User\ChapitreRepository($connection);
$mangas = $mangaRepository->fetchAll();
$manga = $_GET['manga'];
$_SESSION['manga'] = $manga;
session_start() ;
entete();
bandeau();?>
    <div class="container">
        <?php print "<h1>".$manga."</h1>"
        ?>
        <div class="row">
            <div class="column">
                <?php
                foreach ($mangas as $m) {
                    if ($manga == $m->getNom()) {
                        $count = $m->getNbChap();
                        $mem = $m;
                        if ($count <= 1){
                            echo "$count chapitre disponible :";
                        }
                        else{
                            echo "$count chapitres disponibles :";
                        }
                        print "<ul class=\"chapitres\">\n";
                        $chapitres = $chapitreRepository->chap_from($manga,$m->getNbChap());
                        foreach( $chapitres as $chap) {
                            print "<a href=\"scan.php?manga=" . urlencode($chap->getNomManga()) . "&chap={$chap->getNum()}\"><li>{$chap->getNom()} --- {$chap->getNomManga()}</li></a>\n";
                        }
                        print "</ul>";
                    }
                }

                ?>
            </div>
            <div class="column">
                <?php
                $files = scandir("mangas/$manga");
                $countim = 0;
                foreach ($files as $file){
                    if (!is_dir($file)) {
                        $imageFileType = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                            && $imageFileType != "gif"){
                        }
                        else{
                            $countim = 1;
                            print "<img src=\"./mangas/$manga/$file\" style=\"max-height: 400px\" alt=\"image $manga\"/><br/>\n";
                        }
                    }
                }
                if ($countim == 0 && $_SESSION['admin']==1)
                    print "<form action=\"imagemanga.php\" method=\"post\" enctype=\"multipart/form-data\">
                            Ajouter une image de couverture :<br/>
                            <input type=\"file\" name=\"fileToUpload\" id=\"fileToUpload\">
                            <input type=\"submit\" value=\"Valider\" name=\"submit\">
                             </form>";
                if ($mem->getDescription()!=NULL)
                    print "<p>".urldecode($mem->getDescription())."</p>";
                else if ($_SESSION['admin']==0)
                    print "<p>résumé bientôt disponible</p>";
                else{
                    print "<br/><form action=\"desc.php\" method=\"post\" id=\"usrform\">
                                <textarea rows=\"4\" cols=\"50\" name=\"comment\" placeholder='Ajouter un résumé'></textarea>
                                <input type=\"submit\" value=\"Valider\" name=\"submit\">
                                </form><br>";
                }
                ?>
            </div>
        </div>

    </div>
<?php pied() ?>