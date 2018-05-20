<!DOCTYPE html>
<html lang="fr">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/calendar.css">
    <title> <?=$title ?>  </title>
</head>
<body>

<!-- Navbar -->
<?php echo $this->navbar->getHtml(); ?>

<div class="flashes">
<!-- Flashed messages -->
<?php
    $flashes = flash();
    foreach ($flashes as $flash) {
        echo " <p class='alert alert-warning'> $flash </p>";
    }?>

</div>

<div class="contenu">
    <?= $this->contents ?>
</div>

<!-- ATTENTION ! booststrap est maintenant importé depuis des sites externes
@todo : faire en sorte que l'app héberge bootstrap
<link rel="script" href="js/jquery-3.3.1.min.js">
<link rel="script" href="js/bootstrap.bundle.min.js">
<link rel="script" href="js/bootstrap.min.js">
-->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>



</html>