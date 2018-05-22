<?php
session_start();

include("model.php");
include("menuView.php");
include("vue.php");

?>
<!doctype html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0">
    <title>catalogue</title>
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,400,700|Ubuntu:400" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/standardize.css">
    <link rel="stylesheet" href="css/catalogue-grid.css">
    <link rel="stylesheet" href="css/catalogue.css">
    <link rel="stylesheet" href="css/index.css">
    <script   src="https://code.jquery.com/jquery-3.3.1.js"
              integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="   crossorigin="anonymous"></script>

</head>

<body class="body page-catalogue clearfix">
<?php


$pseudo = NULL;
if (isset($_SESSION["pseudo"])){
    $pseudo = $_SESSION["pseudo"];
}
head($pseudo);

genMenu();

tab($_SESSION['menu']);


?>

<a href="liste.php"><button class="modif" href="liste.php">Ma liste de course</button></a>

<script>
    function modifrecette(idd,ind){
           $.ajax({
               url : 'changerecette.php', // La ressource ciblée
               type : 'POST', // Le type de la requête HTTP.
               data : {index:ind},
               dataType : 'html',
               success : function(code_html,statut) {
                   $('#' + idd).html(code_html);
                   // alert(idd);
                },
            });

    }



</script>

<?php footer()?>
</body>
</html>