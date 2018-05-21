
<ul class="list-group">
	<li class="list-group-item text-center bg-dark" style="color: white"> Catégories</li>
	<?php
	$eMan = new EvenementsManager($DB);
	$categories = $eMan->getAllCategories();
	foreach ($categories as $categorie) {
		if (isset($_GET['categorie']) && $_GET['categorie'] == $categorie['id']) {
			echo '<a href="Accueil.php?categorie='. $categorie['id'] . '" class="list-group-item bg-dark" style="color: white">'. $categorie['categorie'] .'</a>';
		}
		else {
			echo '<a href="Accueil.php?categorie='. $categorie['id'] . '" class="list-group-item">'. $categorie['categorie'] .'</a>';
		}
		
	}
	?>
</ul>