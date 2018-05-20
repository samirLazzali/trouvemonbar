<!DOCTYPE html>

<html>

	<head>
		<meta charset="utf-8" />
		<title>Ingrédients nécessaire pour une recette donnée</title>
	</head>


<?php

function listeIngredients ($id_recette)
{
	$dbName = getenv('DB_NAME');
	$dbUser = getenv('DB_USER');
	$dbPassword = getenv('DB_PASSWORD');
	$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

	$prep = $connection->prepare('SELECT id_ingredient FROM recette_ingredient WHERE id_recette = ?');
	$prep->execute(array($id_recette));
	$i = 0;
	while ($donnees = $prep->fetch())
	{
		$liste[$i] = $donnees['id_ingredient'];
		$i++;
	}

	$requete = $connection->prepare('SELECT nom FROM ingredient WHERE id = ?');
	for ($i = 0; $i < count($liste); $i++) 
	{
		$requete->execute(array($liste[$i]));
		$reponse = $requete->fetch();
		$ingredient[$i] = $reponse['nom'];
	}

	return $ingredient;

}

function listeQuantite ($id_recette)
{
	$dbName = getenv('DB_NAME');
	$dbUser = getenv('DB_USER');
	$dbPassword = getenv('DB_PASSWORD');
	$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

	$prep = $connection->prepare('SELECT quantite FROM recette_ingredient WHERE id_recette = ?');
	$prep->execute(array($id_recette));
	$i = 0;
	while ($donnees = $prep->fetch())
	{
		$quantite[$i] = $donnees['quantite'];
		$i++;
	}

	return $quantite;
}

function menuSemaine ($tab_id_recette)
{
	$listeCourseIngredient = array();
	$listeCourseQuantite = array();
	foreach ($tab_id_recette as $recette) 
	{
		$listeIngredient = listeIngredients($recette);
		$listeQte = listeQuantite($recette);
		foreach ($listeIngredient as $ingredient) 
		{
			if (in_array($ingredient, $listeCourseIngredient))
			{
				$rangIngredientCourse = array_search($ingredient, $listeCourseIngredient);
				$rangIngredient = array_search($ingredient, $listeIngredient);
				$listeCourseQuantite[$rangIngredientCourse] += $listeQte[$rangIngredient];
			}
			else
			{
				array_push($listeCourseIngredient, $ingredient);
				$rangIngredient = array_search($ingredient, $listeIngredient);
				array_push($listeCourseQuantite, $listeQte[$rangIngredient]);
			}
		}
	}
	$menu['ingredient'] = $listeCourseIngredient;
	$menu['quantite'] = $listeCourseQuantite;
	return $menu;
}

?>

	<body>
		
		<form action="id_recette.php" method="POST">
			<p>Entrer l'id d'une recette :</p>
			<input type="text" name="id_recette">
			<a href="id_recette_post.php"><button type="submit">Envoyer</button></a>
		</form>

	</body>

<?php

if (isset($_POST['id_recette']))
{
	if (preg_match("#[0-9]*#", $_POST['id_recette']))
	{
		$liste = listeIngredients ($_POST['id_recette']);
		$quantite = listeQuantite ($_POST['id_recette']);
		$i = 0;
		foreach ($liste as $ingredient) 
		{
			echo '<p>' . $ingredient . ' (' . $quantite[$i] . ')</p>';
			$i++;
		}
	}
}

?>

<p><br /></p>

<p>Liste de course :<br />

<?php

$tab[0] = 1;
$tab[1] = 2;
$menu = menuSemaine($tab);

for ($i = 0; $i < count($menu['ingredient']); $i++)
{
	echo '<p>' . $menu['ingredient'][$i] . ' (' . $menu['quantite'][$i] . ')</p>';
}

?>

</p>

</html>