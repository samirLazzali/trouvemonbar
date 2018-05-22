<?php

session_start();
if (!isset($_SESSION['pseudo']) || $_SESSION['id_groupe'] != 2){
    header('Location: index.php');
}
?>

<!DOCTYPE html>

<html>

	<head>
		<meta charset='utf-8' />
		<title>page d'administration DTC</title>
	</head>

	<body>
		<h1>Page d'administration</h1>
		<nav>
			<div class=CRUB>
				<p><a href="crubControler.php">Accès au CRUB</a></p>
			</div>
			<div class=newsletter>
				<p><a href="newsletter.php">Rédaction d'une newsletter</a></p>
			</div>
		</nav>
	</body>

</html>