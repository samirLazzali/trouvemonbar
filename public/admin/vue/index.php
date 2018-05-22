<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Meetiie</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="public/css/nav.css">
	<link rel="stylesheet" href="public/css/index.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
	<body>

<?php include_once('vue/include/header.php'); ?>

<br />
<br />
<div class="container">
	<div id="news" class="container">
		<h2><?php echo $titre; ?></h2>
		<form method="post" action="">
			<div class="form-group">
			  <label for="sujet">Sujet</label>
			  <input type="text" value="<?php echo $sujet; ?>" placeholder="sujet" required name="sujet" maxlength="255" class="form-control" id="sujet" />
			</div>

			<div class="form-group">
			  <label for="message">Message</label>
			  <textarea class="form-control" placeholder="Corps du message" required name="message" rows="5" id="message"><?php echo $message; ?></textarea>
			</div>
			<input type="hidden" name="<?php echo $name_edit; ?>" value="<?php echo $edit; ?>" />
			<input type="submit" value="Envoyer" class="btn btn-default" />
		</form>

		<?php foreach ($newsletter as $elt) : ?>
		<div class="sujet">
			<h3><?php echo secureData($elt['sujet']); ?><span class="pull-right"><a href="index.php?edit=<?php echo $elt['id']; ?>">Éditer</a> <a href="index.php?supp=<?php echo $elt['id']; ?>" onclick="return confirm('Etes-vous sur de vouloir supprimer cette news ?')">Supprimer</a></span></h3>
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
</div>

<div class="container-fluid">

	<?php include_once('../vue/include/footer.php'); ?>


</div>

	<script src="public/js/display_menu.js"></script>


	</body>

</html>
