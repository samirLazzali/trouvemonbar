<?php
/**
 * Created by PhpStorm.
 * User: clement
 * Date: 19/04/18
 * Time: 22:05
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
    <p>
        <div class="container_upload">
            <form action="upload.php" method="post" enctype="multipart/form-data">
                Ajouter un chapitre :<br/>
                Choisir les images à télécharger:
                <input type="file" name="fileToUpload[]" id="fileToUpload" multiple="multiple"/><br/>
                <input type="submit" value="Choisir le chapitre"/>
            </form>
            <br/>
            <form action="newmanga.php" method="post">
    <p>Ajouter un manga : </p>
    Nom du manga :
    <input type="text" name="nom" required/><br/>
    Auteur :
    <input type="text" name="auteur" required/><br/>
    Genre :
    <select name="genre">
        <option value="shonen">Shônen</option>
        <option value="seinen">Seinen</option>
        <option value="shojo">Shôjo</option>
    </select><br/>
    Statut :
    <select name="statut" onchange="affichageDate(this.value)">
        <option value="coming soon">coming soon</option>
        <option value="en cours">en cours</option>
        <option value="terminé">terminé</option>
    </select><br/>
    <div id="debut_manga" style="display:none">Date de début :<input type="date" name="debut"/><br/></div>
    <div id="fin_manga" style="display:none">Date de fin :<input type="date" name="fin"/></div>
    <input type="submit" value="Ajouter"/>
    </form>
</div>
</p>
</div>
<?php pied() ?>


<script>
    function affichageDate(valeur) {
        if (valeur == "coming soon") {
            document.getElementById('fin_manga').style.display = 'none';
            document.getElementById('debut_manga').style.display = 'none';
        }
        else if (valeur == "en cours") {
            document.getElementById('fin_manga').style.display = 'none';
            document.getElementById('debut_manga').style.display = 'block';
        }
        else {
            document.getElementById('fin_manga').style.display = 'block';
            document.getElementById('debut_manga').style.display = 'block';
        }
    }
</script>

<script>
    window.onscroll = function() {myFunction()};

    var header = document.getElementById("myHeader");
    var sticky = header.offsetTop;

    function myFunction() {
        if (window.pageYOffset >= sticky) {
            header.classList.add("sticky");
        } else {
            header.classList.remove("sticky");
        }
    }
</script>

</body>
</html>

