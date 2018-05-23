<?php
require '../../vendor/autoload.php';
include("Vue.php");
include("Modele.php");
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$chapitreRepository = new \User\ChapitreRepository($connection);
$chapitres = $chapitreRepository->fetchAll();
session_start() ;
?>

<?php entete() ?>

<?php bandeau() ?>
<div class="container">
    <div class="row">
        <div class="column">
            <?php
            $count = $chapitreRepository->limit_ten_chap();
            $last_chapters = $chapitreRepository->last_chaps($count);
            ?>
            <ul class="chapitres">
                <?php
                foreach( $last_chapters as $chap){
                    print "<a href=\"scan.php?manga={$chap->getNomManga()}&chap={$chap->getNum()}\"><li>{$chap->getNom()} --- {$chap->getNomManga()}</li></a>\n";
                }

                ?>
            </ul>
        </div>
        <div class="column">
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam dapibus tellus est, in volutpat tortor scelerisque sit amet. Cras sit amet nibh in ligula hendrerit dictum. Ut convallis pellentesque aliquam. Phasellus non purus id sapien vestibulum semper eget eget tellus. Nullam fringilla quam at mauris consequat, in vehicula lectus accumsan. Aenean consequat ante ac elementum aliquam. Donec blandit sem turpis, sed euismod mi suscipit id. Proin vel lectus non purus viverra luctus quis in urna. Ut diam erat, porttitor efficitur quam ac, accumsan mattis metus.
            </p>
            <hr noshade="true" size="1"/>
            <p>
                In nulla risus, tincidunt et mi nec, tempor faucibus nibh. Nulla imperdiet posuere lobortis. Interdum et malesuada fames ac ante ipsum primis in faucibus. Vivamus congue quam libero, in porta lectus varius in. Nam porta, ex nec ullamcorper faucibus, felis nibh maximus dolor, rhoncus aliquam mi lectus imperdiet mi. Donec maximus lacus vitae posuere consequat. Sed commodo lectus quis tempor posuere. Aliquam facilisis quis libero eget aliquet. Cras vulputate finibus metus, vitae cursus mauris rhoncus eu. Cras sit amet ultricies ipsum. Phasellus turpis felis, posuere sit amet nisl nec, finibus efficitur neque. Suspendisse purus augue, aliquam et ornare efficitur, hendrerit ut tortor.
            </p>
            <hr noshade="true" size="1"/>
            <p>
                Morbi eu egestas nisl. Quisque ac nulla mattis, aliquam tellus et, pretium magna. Vestibulum a euismod dui. Nulla vel dui neque. Nullam consectetur orci non massa tempor aliquet. Sed egestas semper nulla, non porta neque lacinia at. Proin id libero erat.
            </p>
            <hr noshade="true" size="1"/>
            <p>
                Maecenas dapibus ipsum non facilisis maximus. Vivamus non urna nisl. Morbi lobortis, nunc sit amet interdum sodales, eros dolor efficitur turpis, in vulputate nisi eros a enim. Vestibulum in orci pellentesque, egestas sapien at, aliquet massa. Sed hendrerit finibus purus. Cras eget dui mattis, dictum lacus consectetur, sodales nulla. Donec vitae aliquam ante, vel lacinia felis. Phasellus venenatis orci ut accumsan elementum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam finibus velit id orci placerat pharetra. Mauris tincidunt accumsan nisl et porta. Proin pretium pretium quam at consectetur. Pellentesque blandit dui non nibh euismod, ut scelerisque ipsum ullamcorper. Ut odio nulla, dignissim at ornare non, varius ut velit. Praesent eu dignissim justo. Etiam suscipit rutrum orci, vitae ullamcorper diam blandit nec.
            </p>
            <hr noshade="true" size="1"/>
            <p>
                Nullam finibus laoreet tellus, vitae accumsan sem rhoncus non. Fusce malesuada mi nec dictum porta. Pellentesque ut neque tincidunt, sagittis metus at, tempor ligula. Fusce tincidunt ut ipsum eget mollis. Aliquam ac consectetur risus. Fusce enim est, venenatis et pulvinar et, euismod et est. In hac habitasse platea dictumst. Suspendisse potenti. Curabitur tempor dolor id pellentesque euismod. Quisque vitae odio sit amet velit porta accumsan. Mauris quis urna eros. Aliquam ullamcorper nunc erat, eget condimentum neque varius ac.
            </p>
        </div>
    </div>

</div>
<?php pied() ?>
