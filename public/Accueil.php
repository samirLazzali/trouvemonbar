
<!DOCTYPE html>
<html>
<head>
	<title>Accueil</title>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="">
	<meta name="viewport" content="width=device">
	<link rel="stylesheet" type="text/css" href="main.css">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
	
</head>
<body style="margin= 0">

	<?php include "upperBar.php"
	$dbName = getenv('DB_NAME'); 
	$dbUser = getenv('DB_USER'); 
	$dbPassword = getenv('DB_PASSWORD'); 
	$DB = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword"); 
	?>

	<div class="container">
		<div class="row">

			<div class="container col-md-9 col-xs-9">
				<?php //include "Accueil_Contenu.php" ?>
				<div>
					<div class="float-right">11/03</div>
					<h2 class="page-header"> Titre de l'évènement <br>
						<small>le 13/05 à 15:00</small>
					</h2>
					
					<p> Description sur qposdifjqpoisdjfpoqi dfpoiq dfopiqj dpfoiqj pdoifjq podifjq podifj qpoidfj qpoidjf qpoidfj qpoidjf qpodijf qpoidjf qpoidjf qdspoif jqpodifjmqzijmirj amoeirj ... </p>
					
					<p class="text-right text-primary" href="#">11 participants</p>

				</div>
				<hr>
				<div>
					<div class="float-right">11/03</div>
					<h2 class="page-header"> Titre de l'évènement </h2>
					
					<p> Description sur qposdifjqpoisdjfpoqi dfpoiq dfopiqj dpfoiqj pdoifjq podifjq podifj qpoidfj qpoidjf qpoidfj qpoidjf qpodijf qpoidjf qpoidjf qdspoif jqpodifjmqzijmirj amoeirj ... </p>
					<p class="text-right text-primary">11 participants</p>

				</div>
				<hr>
			</div>

			<div class="container col-md-3 col-xs-3">
				<?php include "Categories.php" ?>
			</div>

		</div>
	</div>

</body>
</html>

