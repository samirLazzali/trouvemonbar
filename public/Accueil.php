<?php
function chargerClasse($classe) {
  require $classe . '.php';
}
spl_autoload_register('chargerClasse');
?>
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
	<?php include "upperBar.php";
	$dbName = "projetWeb";
	$dbUser = "root"; 
	$dbPassword = "root"; 
	$DB = new PDO("mysql:host=localhost;dbname=$dbName;charset=utf8", 'root', 'root');
	?>
	<div class="container">
		<?php 
			if (isset($_POST['creer_evenement'])) {
				$eMan = new EvenementsManager($DB);
				$eMan->add(new Evenement($_POST));
			}
		?>
		<div class="row">

			<div class="container col-md-9 col-xs-9">
				<?php include "Accueil_contenu.php" ?>
			</div>
				
			<div class="container col-md-3 col-xs-3">
				<?php include "Categories.php" ?>
			</div>

		</div>
	</div>

</body>
</html>

