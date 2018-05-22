<?php
session_start();

/**
 * Created by PhpStorm.
 * User: agammon
 * Date: 5/22/18
 * Time: 10:41 AM
 */



include("vue.php");
include ("recetteView.php");
include ("id_recette.php");
include("model.php");
?>

    <!doctype html>
    <html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=1.0">
        <title>Recette</title>
        <link href="http://fonts.googleapis.com/css?family=Ubuntu:400,400|Montserrat:400,700" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="css/standardize.css">
        <link rel="stylesheet" href="css/recette-grid.css">
        <link rel="stylesheet" href="css/recette.css">

    </head>

    <body class="body page-recette clearfix">


<?php
    $pseudo = NULL;
    if (isset($_SESSION["pseudo"])){
        $pseudo = $_SESSION["pseudo"];
    }
    head($pseudo);

    $liste=menuSemaine($_SESSION['menu']);
    $i=0;

    print'<section style="color:black">';
    for($i=0;$i<count($liste['ingredient'])-1;$i++){
        print "<p>" . $liste['ingredient'][$i]['nom'] . ": ". $liste['quantite'][$i] . $liste['ingredient'][$i]['unite']."</p>";
    }
    print'</section>';
    ?>



      <footer class="contact clearfix">

        <div class="reseau clearfix">
          <div class="facebook"></div>
          <div class="twitter"></div>
          <div class="discord"></div>
        </div>

        <div class="adresse">
          <p>1, square de la résistance</p>
          <p>91000 Evry</p>
        </div>

      </footer>

    </body>

  </html>
