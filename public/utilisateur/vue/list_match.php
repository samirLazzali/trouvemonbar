<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Meetiie</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="public/css/nav.css">
	<link rel="stylesheet" href="public/css/list_match.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
	<body>

<?php include_once('vue/include/header.php'); ?>


<div class="container list_match text-center">
  <h2>Tableau de chasse</h2>
  <div class="list-group">
<?php foreach($list_match as $match) : ?>
    <li class="list-group-item <?php echo (!$match['etat_lu']) ? 'non_lu': '' ?>">
      <strong>Numéro </strong><?php echo $match['id_cible']; ?><br />
      <strong>Genre </strong><?php echo $genres[$match['id_sexe']]; ?><br />
      <strong>Tags </strong><?php echo (empty($match['tags'])) ? 'Aucun tags': $match['tags']; ?><br />
      <a href="chat.php?id=<?php echo $match['id_cible']; ?>">Discuter</a>
			<br />
			<a style="color: red;" onclick="return confirm('Voulez-vous vraiment Supprimer cette affinité ?');" href="list_match.php?delete=<?php echo $match['id_cible']; ?>">Supprimer</a>
   </li>
<?php endforeach; ?>

  </div>
</div>



<div class="container-fluid">

	<?php include_once('vue/include/footer.php'); ?>


</div>


	</body>

</html>
