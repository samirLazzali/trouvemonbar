<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Paramètres</title>
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
			<h2>Changer votre mot de passe</h2>
			<hr />
			<form class="form-inline" method="post" action="parametres.php" onsubmit="return submitInscription();">
			  <div class="form-group has-default has-feedback">
				<label for="pass_check">Ancien mot de passe</label>
				<input type="password" name="pass_check" class="form-control" id="pass_check">
			  </div>
			  <div class="form-group has-default has-feedback" id="password-div">
				<label for="new_pass">Nouveau mot de passe</label>
				<input type="password" name="new_pass" class="form-control" id="new_pass">
				<small class="text-muted" >
				Le mot de passe doit contenir au moins 6 caractères.
				</small>
			  </div>
			  <br />
			  <br />
			  <input type="submit" class="btn btn-default" value="Changer" />
			</form>
			<?php echo (($code != "") ? $error[$code] : $code); ?>
			<p style="text-align: left;"><a href="desinscription.php">Se désinscrire</a> </p>
	</div>
</div>
<div class="container-fluid">
	<?php include_once('vue/include/footer.php'); ?>
</div>
	<script>
var pass = document.getElementById('new_pass');
var pass_div = document.getElementById('password-div');

var validpass = false;



pass.addEventListener('keyup',function(){
	if (this.value.trim().length < 6) {
		pass_div.className = "form-group has-error has-feedback";
		validpass = false;
	}else {
		pass_div.className = "form-group has-success has-feedback";
		validpass = true;
	}
});

function submitInscription() {
	if (!validpass) {
		alert("Renseignez les informations avant et au bon format !")
		return false;
	}
}
	</script>
	</body>

</html>
