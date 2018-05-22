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

<div class="fond">
<?php include_once('vue/include/header.php'); ?>

	<section class="row">
		<div class="row col-md-offset-3 col-md-6 accueil">
			<article class="col-md-12">
				<a class="retour" href="index.php">Retour</a>

				<br />
				<br />
				<?php echo (($code != "") ? $error[$code] : $code); ?>
				<form method="post" action="auth.php" class="form-horizontal text-center">
				    <div class="form-group">
					       <label class="control-label col-md-2" for="mail">Mail </label>
						  <div class="col-md-6">
							<input type="text" class="form-control" id="mail" placeholder="E-mail" name="mail">
						  </div>
					</div>
					<br />
				    <div class="form-group">
					       <label class="control-label col-md-2" for="password">Mot de passe </label>
						  <div class="col-md-6">
							<input type="password" class="form-control" id="password" placeholder="Mot de passe" name="password">
						  </div>
					</div>

					<input type="submit" class="btn btn-primary" />
				</form>
			</article>

		</div>
	</section>
</div>


<?php include_once('vue/include/footer.php'); ?>


</div>

	</body>
</html>
