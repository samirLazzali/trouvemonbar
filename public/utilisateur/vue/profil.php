<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Profil</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="public/css/nav.css">
	<link rel="stylesheet" href="public/css/profil.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
	<body>

<?php include_once('vue/include/header.php'); ?>

<div class="container">

	<div class="param text-center">
			<h2>Changer le sexe recherché</h2>
			<hr />
			<form class="form-inline" method="post" action="profil.php">
			  <div class="radio">
				 <label><input type="radio" name="s" id="H" value="H" <?php echo ($sexe == 'H') ? 'checked' : ''; ?>>Homme</label>
			  </div>

			  <div class="radio">
				 <label><input type="radio" name="s" id="F" value="F" <?php echo ($sexe == 'F') ? 'checked' : ''; ?>>Femme</label>
			  </div>

			  <div class="radio">
				 <label><input type="radio" name="s" id="D" value="D" <?php echo ($sexe == 'D') ? 'checked' : ''; ?>>Les deux</label>
			  </div>
			  <br />
			  <br />
			  <input type="submit" class="btn btn-default" value="Changer" />
			</form>

			<h2>Tags</h2>
			<hr />
			<form class="form-inline" method="post" action="profil.php">
			  <div class="form-check">
			  <?php foreach($tags_list as $tag) { ?>
					<label><input type="checkbox" <?php echo (in_array($tag, $tags)) ? 'checked' : '';?> name="tags[]" value="<?php echo $tag;?>"><?php echo $tag;?></label>
			  <?php } ?>
				</div>
			  <br />
			  <br />
			  <input type="hidden" class="btn btn-default" name="clear_tag" />
			  <input type="submit" class="btn btn-default" value="Changer" />
			</form>
			<small class="text-muted" >Les tags permettront de vous faire les meilleurs suggestions dans les matchs.
			</small>

	</div>
</div>
<div class="container-fluid">
	<?php include_once('vue/include/footer.php'); ?>
</div>

	</body>

</html>
