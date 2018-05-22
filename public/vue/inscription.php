<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Meetiie</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="public/css/inscription.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
	<body>

<div class="container-fluid">

<div>
<?php include_once('vue/include/header.php'); ?>

	<section class="row">
		<div class="row col-md-offset-3 col-md-6 accueil">
			<article class="col-md-12">
				<p>
				<a class="retour" href="index.php">Retour</a>
				<br />
				<?php echo (($code != "") ? $error[$code] : $code); ?>
				</p>
			</article>

		</div>
	</section>
</div>


<?php include_once('vue/include/footer.php'); ?>


</div>

	</body>
</html>
