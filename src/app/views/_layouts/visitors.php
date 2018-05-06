<!DOCTYPE html>
<html lang="fr">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title> <?=$title ?>  </title>
</head>
<body>

<!-- Navbar -->
<?php echo $this->navbar->getHtml(); ?>

<div class="flashes">
    <!-- Flashed messages -->
    <?php $flashes = flash();
        foreach ($flashes as $flash) {
            echo " <p class='alert alert-warning'> $flash </p>";
        }?>

</div>

<div class="contenu">
    <?= $this->contents ?>
</div>

</body>
<link rel="script" href="../js/bootstrap.min.js">

</html>