<!DOCTYPE html>

<html>

	<head>
		<meta charset='utf-8' />
		<title>Rédaction newsletter</title>
	</head>

	<body>
		<h1>Rédaction d'une newsletter</h1>
		<form action='newsletter_post.php' method='POST'>
			<p>Titre :</p>
			<input type="text" name="titre">
			<p>Contenu :</p>
			<textarea name="newsletter"></textarea>
			<p></p>
			<input type="submit">
		</form>
	</body>