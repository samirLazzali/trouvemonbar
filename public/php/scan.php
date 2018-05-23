<?php
/**
 * Created by PhpStorm.
 * User: clement
 * Date: 07/05/18
 * Time: 15:59
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

$manga = $_GET['manga'];
$mangaurl = urlencode($manga);
$chap = $_GET['chap'];
$count = $chapitreRepository->Size($manga,$chap);
if (!isset($_GET['page'])){
    $page = 1;
}
else { $page = $_GET['page'];}
$next = $page + 1;
$prev = $page - 1;
entete();
?>
    <script>
        function leftArrowPressed() {
            <?php
            if ($page > 1)
                echo "window.location.href = \"http://localhost:8080/php/scan.php?manga=$mangaurl&chap=$chap&page=$prev\";";
            else
                echo "window.location.href = \"http://localhost:8080/php/index.php\";"?>
        }
        function rightArrowPressed() {
            <?php
            if ($page<$count)
                echo "window.location.href = \"http://localhost:8080/php/scan.php?manga=$mangaurl&chap=$chap&page=$next\";";
            else
                echo "window.location.href = \"http://localhost:8080/php/index.php\";";?>
        }
        document.onkeydown = function(evt) {
            evt = evt || window.event;
            switch (evt.keyCode) {
                case 37:
                    leftArrowPressed();
                    break;
                case 39:
                    rightArrowPressed();
                    break;
            }
            return;
        };
    </script>
<?php
bandeau();
container();
print "<h1>".$manga."- chapitre ".$chap."</h1>";
if(!is_dir("mangas/$manga/$manga-$chap")){
    exit("le dossier du chapitre n'existe pas");
}
$files = glob("mangas/$manga/$manga-$chap/$page.*");
if ($page > 1){
    $prev = $page - 1;
    print '<button type="button" onclick="location.href=\'scan.php?manga='.$mangaurl.'&chap='.$chap.'&page='.$prev.'\'">Previous</button>';
    print "\n";
}

print "<select id='selectPageUp' onchange=\"location = this.value\">\n";
for ($i = 1; $i <= $count; $i++){
    if ($i == $page) {
        print "<option value=\"http://localhost:8080/php/scan.php?manga=$mangaurl&chap=$chap&page=$i\" selected='selected'>page $i</option>\n";
    }
    else {
        print "<option value=\"http://localhost:8080/php/scan.php?manga=$mangaurl&chap=$chap&page=$i\">page $i</option>\n";
    }
}
print "</select>\n";
if ($page < $count){
    $next = $page + 1;
    print '<button type="button" onclick="location.href=\'scan.php?manga='.$mangaurl.'&chap='.$chap.'&page='.$next.'\'">Next</button>';
}
print "<br/>\n";
foreach ($files as $file){
    if ($page == $count){
        print "<a href='index.php'><img src='$file' style='max-width: 100%' alt='image $manga-$chap-$page'></a><br/>\n";
    }
    else {
        print "<a href='scan.php?manga=$mangaurl&chap=$chap&page=$next'><img src='$file' style='max-width: 100%' alt='image $manga-$chap-$page'></a><br/>\n";
    }
}
if ($page > 1){
    print '<button type="button" onclick="location.href=\'scan.php?manga='.$mangaurl.'&chap='.$chap.'&page='.$prev.'\'">Previous</button>';
    print "\n";
}
print "<select id='selectPageDown' onchange=\"location = this.value\">\n";
for ($i = 1; $i <= $count; $i++){
    if ($i == $page) {
        print "<option value=\"http://localhost:8080/php/scan.php?manga=$mangaurl&chap=$chap&page=$i\" selected='selected'>page $i</option>\n";
    }
    else {
        print "<option value=\"http://localhost:8080/php/scan.php?manga=$mangaurl&chap=$chap&page=$i\">page $i</option>\n";
    }
}
print "</select>\n";
if ($page < $count){
    print '<button type="button" onclick="location.href=\'scan.php?manga='.$mangaurl.'&chap='.$chap.'&page='.$next.'\'">Next</button>';
    print "\n";
}
?>
</div>
<?php
pied();