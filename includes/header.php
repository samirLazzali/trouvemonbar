<?php
session_start();
include("includes/id.php");
include("includes/debut.php");?>

<!DOCTYPE html>
<html lang="fr">
<body>
<h1 id="title">
    <div class="cadre">
        <a href="index.php"><img class="home" src="img/logo.png" alt="Logo" height ="88" width="94"></a>
        <span id="title1">GolrIIE</span>
    </div>
</h1>
<?php
    if ($id!=0) {
        include("./includes/menuderoulant.php");
    }
    else{
            include("./includes/menuderoulant2.php");
    }
?>
</body>
</html>