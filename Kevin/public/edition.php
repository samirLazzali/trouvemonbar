<?php
$pseudo = $_GET['id']; 
?>
<html>
<head>
	<title>Modification du profil de <?php echo $pseudo ?> </title>
</head>
<body>
	Modification du profil de <?php echo $pseudo ?> :<br>
	<form>
		Modifier le pseudo :<br>
		<input type="text" id="pseudo"  value=<?php echo $pseudo?>><br>
		Modifier le mot de passe :<br>
		<input type="password" id="mdp" ><br>
		<button>Changer</button>
	</form>
	<a href="index.php">Retour </a><br>
</body>
</html>
