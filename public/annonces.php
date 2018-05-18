<?php

include '../src/annonce.php';
include '../src/accessdb.php';

$annonces = getAnnonces();

foreach ($annonces as $an) {
    $an->display();
}

?>
