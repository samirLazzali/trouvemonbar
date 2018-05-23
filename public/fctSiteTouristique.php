<!DOCTYPE html>
 <head>
    <link rel="stylesheet" href="presentation_pages.css" type="text/css">
  <link rel="stylesheet" href="tableau.css" type="text/css">
    <meta charset="utf-8" />
    <title>Resultat de ma recherche</title>
  </head>
<?php
require '../vendor/autoload.php';
require '../src/User/Site_touristique.php';
require '../src/User/Site_touristiqueRepository.php';

//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$site_touristiqueRepository = new \User\Site_touristiqueRepository($connection);
$site_touristiques = $site_touristiqueRepository->fetchAll();
?>
<html>
<head>
	<title>
		<?php echo $_POST['recherche_monument']; ?>
	</title>
</head>
<body>
   <nav>
    <ul>
      <li><a href="page_accueil.html">Accueil</a></li>
      <li><a href="recherche.html">Recherche destination</a></li>
      <li><a href="formulaire_contact.html">Contact</a></li>
    </ul>
    </nav>
	<h1>Quelques informations :</h1>
	<p>
	  <table class="table table-bordered table-hover table-striped">
            <thead style="font-weight: bold">
              <td>Nom du site touristique</td>
              <td>Nom de la ville</td>
            </thead>
            <?php /** @var \User\User $user */
		  foreach ($site_touristiques as $site_touristique) : ?>
            <tr>
              <td><?php if ($site_touristique->getNom_st()==$_POST['recherche_monument']) echo $site_touristique->getNom_st() ?></td>
              <td><?php if ($site_touristique->getNom_st()==$_POST['recherche_monument']) echo $site_touristique->getNom_v() ?></td>
 
	      <?php endforeach; ?>
	    </tr>
	  </table>
	</p>
	
</body>
</html>
