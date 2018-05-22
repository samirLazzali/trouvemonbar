<?php
session_start();
?>


<!DOCTYPE html>
<html>




<head>
    <title>Act.It!</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style type="text/css">



        body{

            font-family: "Lato",sans-serif;
            height: 100%;
            background-color: ghostwhite;
        }
        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            width: 100%;
            position: fixed;
            top: 0;
            background-color: #f1f1f1;
        }
        .g {
            float: left;
        }
        .d {
            float: right;
        }
        li a {
            display: block;
            color: #000;
            padding: 8px 16px;
            text-decoration: none;
        }

        /* Change the link color on hover */
        li a:hover {
            background-color: #555;
            color: white;
        }
        li a.active {
            background-color: #4CAF50;
            color: white;
        }

        .page_g{
            padding:20px;
            margin-top:35px;
            position: relative;
            font-size: 11em;
            color: ghostwhite;
            text-shadow: 2px 2px 2px  black;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }

        .titre {
            text-align: center;

        }

        #intro {
            background-color: #4CAF50;
            /*background: linear-gradient(ghostwhite, lightgrey);*/
        }


        .first {
            margin:0;
            height: 57em;
            background-color: ghostwhite;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            /*background: linear-gradient(to right, #1483ff, ghostwhite, #1483ff);*/
        }
        .first h1{
            padding: 1.5em;
            color:#4CAF50;
            font-size: 4em;
            text-shadow: 2px 2px 2px  black;



        }
        .first p{
            padding: 1em;
            text-align: center;
            margin-left: 25%;
            margin-right: 25%;
            font-size: 1.2em;
        }

        .footer {
            padding: 20px;
            text-align: center;
            background: #4CAF50;
            margin-top: 20px;
            color: ghostwhite;
            font-size: 1.2em;
        }
        .bouton{
            text-align: center;
            background: linear-gradient(to right, ghostwhite,lightgrey, ghostwhite,lightgrey,ghostwhite) ;


        }

        .column {
            text-align: center;
            box-sizing: border-box;
            float: left;
            width: 50%;
            padding: 15px;
            background: linear-gradient(to right, lightgrey,ghostwhite, lightgrey);

        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }
        @media screen and (max-width: 600px) {
            .column {
                width: 100%;
            }

            /* Style inputs */
            input[type=text], select, textarea {
                width: 100%;
                padding: 12px;
                border: 1px solid #ccc;
                margin-top: 6px;
                margin-bottom: 16px;
                resize: vertical;
            }

            input[type=submit] {
                background-color: #4CAF50;
                color: white;
                padding: 12px 20px;
                border: none;
                cursor: pointer;
            }

            input[type=submit]:hover {
                background-color: #45a049;
            }


            /* Style the container/contact section */
            .container {
                border-radius: 5px;
                background-color: #f2f2f2;
                padding: 10px;
            }

    </style>
</head>




<body>

<!--Barre de navigation-->

<div>
    <ul>
        <li class = "g"><a href="index.php#accueil">Accueil</a></li>
        <li class = "g"><a href="index.php#Recherche">Recherche</a></li>
        <li class = "g"><a href="index.php#contact">Contact</a></li>
        <li class = "g"><a class="active" href="index.php#about">Nous</a></li>


        <?php
        if (isset($_SESSION['login']) && isset($_SESSION['pwd'])) {
            echo '<li class = "d">';
            echo '<a href="./logout.php">Déconnexion</a>';
            echo '</li>';
            echo '<li class = "d">';
            echo '<a href="./profil.php">'.$_SESSION['login'].'</a>';
            echo '</li>';
        }
        else {
            echo '<li class = "d">';
            echo '<a href="./creationUtilisateur.html">Création</a>';
            echo '</li>';
            echo '<li class = "d">';
            echo '<a class = "active" href="./identification.html">Identification</a>';
            echo '</li>';
        }
        ?>

    </ul>
</div>


<div id="intro" class="page_g">
    <h1 class="titre"><strong>Act.It!</strong></h1>
</div>


<!-- Partie Accueil-->

<div id="accueil" class="first" >
    <h1 class="titre"><strong>Accueil</strong></h1>
    <p>
        <span style="text-shadow: 1px 1px 1px  black; font-size:1.3em; color: #1ad53a; font-weight: bold;">Act.It!</span> <br><br>
        Vous cherchez où déjeunez puis une activité ? Vous voulez planifier un repas puis des divertissements ? <br><br>
        <span style="text-shadow: 1px 1px 1px  black; font-size:1.3em; color: #1ad53a; font-weight: bold;">ActIt!</span> est là pour vous ! Nous vous aidons à trouver la meilleure formule restauration/activité selon vos critères. Il ne reste plus qu'à y aller !
    </p>
</div>

<!-- Partie Recherche-->

<div class="row" id="Recherche">
    <h2 class="titre"> Rechercher une formule</h2>
    <form action="recherche.php" method="post">
        <div class="column" style="height: 300px;">
            <h3 >Critères</h3>

            <p style="font-size: 18px;">
                Prix maximal :
                <input type="text" name="prix" style="width: 20%; margin: 15px;">
                Nombre de personne :
                <input type="text" name="nbpers" style="width: 20%; margin:15px;"><br><br>

                Type d'activité :
                <input type="radio" name="type_act" value="culturelle"> Culturelle
                <input type="radio" name="type_act" value="sportive"> Sportive<br>
            </p>


        </div>

        <div class="column" style="height: 300px;">
            <p style="font-size: 18px;">
                Ville:
                <input type="text" name="ville" style="width: 20%; margin:15px;"><br><br>
                Horaire :
                <input type="radio" name="heure" value="journee"> journée
                <input type="radio" name="heure" value="soir"> Soir
                <input type="radio" name="heure" value="indifferent"> Indifférent<br>

            </p>
        </div>
        <div  class="bouton">
            <p>
                <input type="submit" value="Rechercher">
            </p>
        </div>

    </form>
</div>

<!--Partie Contact-->
<div id="contact">
    <div class="container">
        <div style="text-align:center">
            <h2>Nous contacter</h2>
            <p>Pour passer nous voir, ou nous envoyer un mail :</p>
        </div>
        <div class="row">
            <div class="column">
                <div id="map" style="width:100%;height:500px"></div>
            </div>
            <div class="column" style="height: 530px;">

                <p style="text-align: center;"><span style="color: #555555; font-weight: bold; "><i style ="font-size:24px;" class="fa">&#xf276;</i> Mail :</span>  www.contact@actit.fr </p>
                <p style="text-align: center;"><span style="color: #555555; font-weight: bold;"><i style ="font-size:24px;" class="material-icons">&#xe0be;</i> Adresse :</span> 1 Square de la Résistance, 91000 Evry, France </p>


            </div>
        </div>
    </div>

    <!-- Initialize Google Maps -->
    <script>
        function myMap() {
            var myCenter = new google.maps.LatLng(48.6267365,2.4324744000000464);
            var mapCanvas = document.getElementById("map");
            var mapOptions = {center: myCenter, zoom: 12};
            var map = new google.maps.Map(mapCanvas, mapOptions);
            var marker = new google.maps.Marker({position:myCenter});
            marker.setMap(map);
        }
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA0mL9V4xb5y8r1fA0g7ak0EP8E-Nmn4a4&callback=myMap"></script>
    <!--<h3 class="titre">contact</h3>
    <p>
        <a href="https://db4sgowjqfwig.cloudfront.net/campaigns/92944/assets/664629/Some_type_of_summoning_circle_by_Fusanari.png?1479409857">Nos coordonnées</a>
    </p>
</div>-->
    <div id="about">
        <h4 class="titre">Nous</h4>
        <p style="text-align: center">
            Nous sommes un groupe de quatre étudiants en informatique et ce site internet est le résultat de notre projet web.
        </p>
    </div>

    <div class="footer">
        <h2>Act.It!</h2>
    </div>
</body>
</html>
