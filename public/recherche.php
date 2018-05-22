<?php 
session_start(); 
?>


<!DOCTYPE html>
<html>

<head>
    <title>Act.It!</title>
    <meta charset="UTF-8">
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

        .column {
            text-align: center;
            box-sizing: border-box;
            float: left;
            width: 50%;
            padding: 15px;
            background: linear-gradient(to right, lightgrey,ghostwhite, lightgrey);
            height: 1000px;

        }

        img{

            width:500px;

            /*border-color: #4CAF50;*/
        }
    </style>
</head>

<body>

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
	<div>
		<?php
		$prix = $_POST['prix'];
		$nbpers = $_POST['nbpers'];
		$ville = $_POST['ville'];
		$horaire = $_POST['heure'];
		$act = $_POST['type_act'];

		$dbName = getenv('DB_NAME');
		$dbUser = getenv('DB_USER');
		$dbPassword = getenv('DB_PASSWORD');
		try
		{
			$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
		}
		catch(Exeption $e){
			die('Erreur : ');
		}

		if ($horaire != 'indifferent'){
			if ($act == 'culturelle'){

				$resultat = $connection->query("SELECT nom,urli,description,plage_horaire,adresse,url,tel,prix_moyen from activite_culturelle NATURAL JOIN entreprise where prix_moyen<'$prix'/2 and ville = '$ville'");
				$d = $resultat->fetch();


			} 
			else if($act == 'sportive'){
				$resultat = $connection->query("SELECT nom,urli,description,plage_horaire,adresse,url,tel,prix_moyen from activite_sportive NATURAL JOIN entreprise where prix_moyen<'$prix'/2 and ville = '$ville' ");
				$d = $resultat->fetch();

			}
			else{
				echo '<body onLoad="alert(\'vous devez choisir une activité culturelle ou sportive\')">';
		    	echo '<meta http-equiv="refresh" content="0;URL=index.php#Recherche">';
			}
		}

		else  {
			if ($act == 'culturelle'){

				$resultat = $connection->query("SELECT nom,urli,description,plage_horaire,adresse,url,tel,prix_moyen from activite_culturelle NATURAL JOIN entreprise where prix_moyen<'$prix'/2 and ville = '$ville' and plage_horaire = '$horaire' ");
				$d = $resultat->fetch();


			} 
			else if($act == 'sportive'){
				$resultat = $connection->query("SELECT nom,urli,description,plage_horaire,adresse,url,tel,prix_moyen from activite_sportive NATURAL JOIN entreprise where prix_moyen<'$prix'/2 and ville = '$ville' and plage_horaire = '$horaire'");
				$d = $resultat->fetch();

			}
			else{
				echo '<body onLoad="alert(\'vous devez choisir une activité culturelle ou sportive\')">';
		    	echo '<meta http-equiv="refresh" content="0;URL=index.php#Recherche">';
			}
		}

		$resultat = $connection->query("SELECT nom,urli,description,adresse,ville,url,tel,prix_moyen from restaurant NATURAL JOIN entreprise where prix_moyen<'$prix'/2 and ville = '$ville'");
		$resto = $resultat->fetch();


		echo '<div class="column" >';
		if (count($d) == 0){
			echo '<h1>Aucun resultat trouvé</h1>';
		}
		else {
			echo '<h1>'.$d[0]."</h1>";
			echo '<img src = "'.$d[1].' "alt = "image '.$d[0].'">';
			echo '<p> <strong>Description : </strong>'.$d[2].'</p>';
			echo '<p> <strong>Periode : </strong>'.$d[3].'</p>';
			echo '<p> <strong>Adresse : </strong>'.$d[4].'</p>';
			echo '<p> <strong>Site Web : </strong>'.$d[5].'</p>';
			echo '<p> <strong>Télephone : </strong>'.$d[6].'</p>';
			echo '<h4> <strong>Prix moyen : </strong>'.$d[7]." euros</h4>";
		}
		echo '</div>';

		echo '<div class="column" >';
		if (count($resto) == 0){
			echo '<h1>Aucun resultat trouvé</h1>';
		}
		else {
			echo '<h1>'.$resto[0]."</h1>";
			echo '<img src = "'.$resto[1].' "alt = "image '.$d[0].'">';
			echo '<p> <strong>Description : </strong>'.$resto[2].'</p>';
			echo '<p> <strong>Adresse : </strong>'.$resto[4].'</p>';
			echo '<p> <strong>Site Web : </strong>'.$resto[5].'</p>';
			echo '<p> <strong>Télephone : </strong>'.$resto[6].'</p>';
			echo '<h4> <strong>Prix moyen : </strong>'.$resto[7]." euros</h4>";
		}
		echo '</div>';






		?>
	</div>









</body>