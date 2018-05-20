<?php
session_start();

include("model.php");
include("menuView.php");

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
    <script   src="https://code.jquery.com/jquery-3.3.1.js"
              integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="   crossorigin="anonymous"></script>

</head>

<body class="body page-catalogue clearfix">
<?php

genMenu();

tab($_SESSION['menu']);



?>

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

</body>
</html>