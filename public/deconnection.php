<?php
session_start();
$connecte=0;
if (isset($_SESSION['logged'])){
    $connecte = 1;
}
if ($connecte==0) {
    header("Location:index.php");
    exit();
}
session_destroy();
?>

<!DOCTYPE html>
<html>
<?php
include("affichage.php");
head("mp.css","Aperal : Deconnection");
_header();
?>
<body>
<div id="main">
    <div id="article_connection">
        <?php
            echo "<a href=\"index.php\">deconnecté</a>";
        ?>
    </div>
</div>
</body>
<?php
_footer();
?>
</html>