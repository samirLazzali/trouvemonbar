<?php 
session_start();
//on n'a besoin de session_start ici
// parce que on a deja commance la session dans la identification.php
//
?>
<html>

<title>Act.It</title>
<meta charset="UTF-8">


<head>
    <style type="text/css">
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


        img{

            max-width:12%;
            max-height: 12%;
            /*border-color: #4CAF50;*/
            border: solid 4px #4CAF50;
        }
        p{
            font-size: 20px;
        }

        #profil{
            text-align: center;
            margin-top: 50px;
        }

        #info{
            margin-left: 44%;
            margin-top: 10px;
        }

        button{
            background-color: #4CAF50;
            color:white;
            border:none;
            font-size: 17px;
            height: 35px;
            margin-bottom: 10px;
            width: 300px;
        }
        footer{
            height: 10%;
            width: 100%;
            background-color: #4CAF50;
            bottom: 0px;
            text-align: center;
            position: absolute;
            padding:15px;
            font-size: 100%;
            color:ghostwhite;
        }
    </style>
</head>
<body>
	<div>
    <ul>
        <li class = "g" style="font-family: Lato, sans-serif"><a href="index.php#accueil">Accueil</a></li>
        <li class = "g" style="font-family: Lato, sans-serif"><a href="index.php#Recherche">Recherche</a></li>
        <li class = "g" style="font-family: Lato, sans-serif"><a href="index.php#contact">Contact</a></li>
        <li class = "g" style="font-family: Lato, sans-serif"><a class="active" href="index.php#about">Nous</a></li>

        <?php
        	echo '<li class = "d">';
            echo '<a href="./logout.php" style="font-family: Lato, sans-serif">Déconnexion</a>';
            echo '</li>';
//            echo '<li class = "d">';
//            echo '<a href="./profil.php">'.$_SESSION['login'].'</a>';
//            echo '</li>';
            echo '<li class = "d">';
            echo '<a href="./profilEdit.html" style="font-family: Lato, sans-serif">'."Edit your profil".'</a>';
            echo '</li>';
        ?>

    </ul>
</div>
	<div id = "profil">
		<img src="profil.jpg" alt="default profile image">
	</div>
	<div id = "info">
		<?php

		$dbName = getenv('DB_NAME');
		$dbUser = getenv('DB_USER');
		$dbPassword = getenv('DB_PASSWORD');
//        $dbName="postgres";
//        $dbUser="postgres";
//        $dbPassword='123456';
		try{
			$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
//            $connection = new PDO("pgsql:host=localhost user=$dbUser dbname=$dbName password=$dbPassword");

        }
		catch(Exeption $e){
			die('Erreur : ');
		}
		$identifiant = $_SESSION['login'];
		$reponse = $connection->query("SELECT pseudo,nom,prenom,mail,telephone FROM compte WHERE pseudo = '$identifiant'");
		$profil = $reponse->fetchAll(); 
		echo '<p>Pseudo : '.$profil[0]['pseudo'].'</p>';
		echo '<p>Nom : '.$profil[0]['nom'].'</p>';
		echo '<p>Prenom : '.$profil[0]['prenom'].'</p>';
		echo '<p>Mail : '.$profil[0]['mail'].'</p>';
		echo '<p>Téléphone : '.$profil[0]['telephone'].'</p>';
        $connection=null;
		?>


	</div>
    <div style="text-align: center;">
        <?php
        $dbName = getenv('DB_NAME');
        $dbUser = getenv('DB_USER');
        $dbPassword = getenv('DB_PASSWORD');
//        $dbName="postgres";
//        $dbUser="postgres";
//        $dbPassword='123456';
        try{
            $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
//            $connection = new PDO("pgsql:host=localhost user=$dbUser dbname=$dbName password=$dbPassword");

        }
        catch(Exeption $e){
            die('Erreur : ');
        }
        $identifiant = $_SESSION['login'];
        $reponse = $connection->query("SELECT id_admin FROM Administrateur  WHERE pseudo = '$identifiant'");
        $d = $reponse ->fetch();
        if ($d[0] != ""){
            echo '<a href="creationAct.php"><button  >créer une Activité</button></a></br>';
            echo '<a href="newAd.html"><button>nommer un nouvel Administrateur</button></a>';
        }

        ?>
    </div>
        
	
</body>
<footer>
		<div id = "foot">
		<h1>Act.it</h1>
	</div>
</footer>
</html> 