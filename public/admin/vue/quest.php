<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Meetiie</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="public/css/nav.css">
	<link rel="stylesheet" href="public/css/quest.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
	<body>

<?php include_once('vue/include/header.php'); ?>
<div class="container">

	<div class="param text-center">
			<h2>Ajouter une nouvelle question</h2>
			<hr />
			<form class="form-inline" method="post" action="quest.php">
			  <div class="form-group has-default has-feedback">
				<label for="quest">Question</label>
				<input type="text" name="quest" class="form-control" id="quest" required maxlength="255">
			  </div>
			  <div class="form-group has-default has-feedback" id="password-div">
				<label for="reponse">Ajouter une réponse</label>
				<input type="text" name="reponse" class="form-control" id="reponse" />
				<button type="button" id="add_reponse" class="btn btn-default" >Ajouter</button>
			  </div>
			  <br />
			  <br />
			  <div id="list_reponse">
			  </div>
			  <br />
			  <input type="submit" class="btn btn-default" value="Ajouter la question" />
			</form>
			<?php echo (($code != "") ? $error[$code] : $code); ?>
			<h2>Toutes les questions</h2>
			<hr />
			<div class="table-responsive">
			<table class="table">
			<thead>
				<tr>
					<th>#</th>
					<th>Id admin</th>
					<th>Questions</th>
					<th>Réponses</th>
					<th>Date création</th>
					<th>Paramètres</th>
				</tr>
			</thead>

			<tbody>
			<?php for ($i = 0; $i < count($all_questions); $i++) { ?>
			<tr>
				<td><?php echo $all_questions[$i]['id']; ?></td>
				<td><?php echo $all_questions[$i]['id_admin']; ?></td>
				<td><?php echo $all_questions[$i]['question']; ?></td>
				<td>
				<ul class="list-group">
				  <?php foreach (unserialize($all_questions[$i]['reponses']) as $elt) { ?>
				  <li class="list-group-item"><?php echo secureData($elt); ?></li>
				  <?php } ?>
				</ul>
				</td>
				<td><?php echo $all_questions[$i]['date_q']; ?></td>
				<td><a href="quest.php?supp=<?php echo $all_questions[$i]['id']; ?>">Supprimer</a></td>
			</tr>
			<?php } ?>

			</tbody>

			</table>
			</div>
	</div>
</div>
<div class="container-fluid">

	<?php include_once('../vue/include/footer.php'); ?>

</div>

	<script src="public/js/display_menu.js"></script>
	<script>
$(function(){
	$('#add_reponse').click(function(){
		if ($('#reponse').val()) {
			$('#list_reponse').append('<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-remove"></span>'+$('#reponse').val()+'</button>');
			$('#list_reponse').append('<input type="hidden" class="'+$('#reponse').val()+'" name="reponses[]" value="'+$('#reponse').val()+'" />');

			$('#reponse').val('');

			$('#list_reponse button').click(function(){
				var class_button = $(this).text();
				$('#list_reponse .'+class_button).remove();
				$(this).remove();
			});
		}
	});








});



	</script>
	</body>

</html>
