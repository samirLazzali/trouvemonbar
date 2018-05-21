<?php
session_start();
include("includes/id.php");
include("includes/debut.php");?>

<!DOCTYPE html>
<html lang="fr">
<body>
<h1 id="title">
    <a href="index.php"><img class="home" src="img/logo.png" alt="Logo" height ="88" width="94"></a>
    <span id="title1">GolrIIE</span>
    <a href="index.php"><img class="dc" src="img/logo.png" alt="Logo" height ="88" width="94"></a>
</h1>
<?php
    if ($id!=0) {
        include("include/menuderoulant.php");
    }
    else[
            include("include/menuderoulant2.php"};
    }
?>
</body>
</html>