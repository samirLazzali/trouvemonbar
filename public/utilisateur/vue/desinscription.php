<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Desinscription - formulaire</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="public/css/nav.css">
	<link rel="stylesheet" href="public/css/parametres.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
	<body>

<?php include_once('vue/include/header.php'); ?>

<div class="container">

	<div class="param text-center">
	<?php echo (($code != "") ? $error[$code] : $code); ?>
			<h2>Questionnaire</h2>
			<hr />
			<form class="form" method="post" action="desinscription.php">


			  <?php for ($i = 0; $i < count($quest_list); $i++) { ?>
					<label for="<?php echo $i; ?>"><?php echo $quest_list[$i]['question']; ?></label>
			        <select class="form-control" name="rep[]" required>
						<option></option>
						<?php foreach (unserialize($quest_list[$i]['reponses']) as $elt) { ?>
						<option><?php echo $elt; ?></option>
			  <?php } ?>
					</select>
			  <?php } ?>
			  <br />
			  <div class="form-inline">
				<label for="pass">Mot de passe</label>
				<input type="password" name="pass" class="form-control" id="pass" required>
			  </div>
			  <br />
			  <br />
			  <input type="submit" class="btn btn-default" value="Envoyer et se désinscrire" />
			</form>
			<h2>Se désinscrire sans questionnaire</h2>
			<hr />
			<form class="form" method="post" action="desinscription.php">
			  <div class="form-inline">
				<label for="pass">Mot de passe</label>
				<input type="password" name="pass" class="form-control" id="pass" required>
			  </div>
			  <br />
			  <br />
			  <input type="hidden" class="btn btn-default" name="de_sans_quest" />
			  <input type="submit" class="btn btn-default" value="Se désinscrire" />
			</form>

	</div>
</div>
<div class="container-fluid">
	<?php include_once('vue/include/footer.php'); ?>
</div>

	</body>

</html>
