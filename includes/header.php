<head>
    <link rel="stylesheet" type="text/css" href="css/template.css">
    <link rel="stylesheet" type="text/css" href="css/relo.css">
    <meta charset="UTF-8">
    <title>Page d'acceuil</title>
    <script>
        function affiche(x) {
            var elt = document.getElementById(x);
            if(elt.style.display=="none") {
                elt.style.display = "block";
            }
            else {
                elt.style.display="none";
            }
        }
    </script>
    <?php include("fonctions.php");?>
</head>