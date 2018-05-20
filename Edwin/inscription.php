<?php
// on teste si le visiteur a soumis le formulaire
if (isset($_POST['inscription']) && $_POST['inscription'] == 'Inscription') {
	// on teste l'existence de nos variables. On teste également si elles ne sont pas vides
	if ((isset($_POST['login']) && !empty($_POST['login'])) && (isset($_POST['password']) && !empty($_POST['password'])) && (isset($_POST['pass_confirm']) && !empty($_POST['pass_confirm']))) {
	// on teste les deux mots de passe
	if ($_POST['password'] != $_POST['pass_confirm']) {
		$erreur = 'Les 2 mots de passe sont différents.';
	}
	else {
		//postgres
	$dbName = getenv('DB_NAME');
	$dbUser = getenv('DB_USER');
	$dbPassword = getenv('DB_PASSWORD');
	try {
		$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
	}
	catch(Execption $e){
		die('Erreur : '.$e->getMessage());
	}

		// on recherche si ce login est déjà utilisé par un autre membre
		$sql = $connection->prepare('SELECT count(*) FROM user WHERE login=?');
		$sql->execute(array($_POST['login']));
    	$result = $sql->fetch(PDO::FETCH_OBJ);
		

		if ($result[0] == 0) {
		$sql =  $connection->prepare('INSERT INTO user(login,firstname,lastname,password) VALUES(?,?,?,?)');
		$sql->execute(array($_POST['login'],$_POST['firstname'],$_POST['lastname'],$_POST['password']));
    	$result = $sql->fetch(PDO::FETCH_OBJ);
		//mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());

		session_start();
		$_SESSION['login'] = $_POST['login'];
		header('Location: succes.php');\
		exit();
		}
		else {
		$erreur = 'Un membre possède déjà ce login.';
		}
	}
	}
	else {
	$erreur = 'Au moins un des champs est vide.';
	}
}
?>

<html>
<head>
<title>Inscription</title>
</head>
<h1>BIENVENUE SUR TWITIIE </h1>
<body>
Inscription à l'espace membre :<br/>
<form action="inscription.php" method="post">
<span class="formulaire"> Login : <input type="text" name="login"/><br/> </span>
<span class="formulaire">Mot de passe : <input type="password" name="password"/><br/></span>
<span class="formulaire">Confirmation du mot de passe : <input type="password" name="pass_confirm"/><br/> </span>
<span class="formulaire">Nom : <input type="text" name="lastname"/><br/> </span>
<span class="formulaire">Prenom : <input type="text" name="firstname"/><br/> </span>
<span class="formulaire">Date de naissance : <input type="date(Y-m-d)" name="bday"/> <br/> </span>
<input type="submit" name="inscription" value="Inscription">
</form>
<?php
if (isset($erreur)) echo '<br />',$erreur;
?>
</body>
</html>
