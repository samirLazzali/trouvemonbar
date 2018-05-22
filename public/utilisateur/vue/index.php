<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Meetiie</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="public/css/index.css">
	<link rel="stylesheet" href="public/css/nav.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
	<body>

<?php include_once('vue/include/header.php'); ?>
<div class="container" id="news">
	<?php foreach ($newsletter as $elt) : ?>
	<div class="sujet">
		<h3><?php echo secureData($elt['sujet']); ?></h3>
		<p>
			<?php echo secureData($elt['message']); ?><br />

		</p>
		<p class="date_news"><small class="text-muted"><?php echo secureData($elt['date_news']); ?></small></p>
	</div>

	<?php endforeach; ?>

	<?php if (count($newsletter) != 0) { ?>
	<ul class="pager">
		<li class="previous" style="display: <?php echo $display_previous; ?>;"><a href="index.php?page=<?php echo ($page - 1); ?>">Précédent</a></li>
		<li class="next"><a href="index.php?page=<?php echo ($page + 1); ?>">Suivant</a></li>
	</ul>
<?php }else { ?>

	<h4>Aucune newsletter pour le moment</h4>

<?php } ?>
</div>
<div class="container-fluid">

	<?php include_once('vue/include/footer.php'); ?>


</div>

	</body>

</html>
