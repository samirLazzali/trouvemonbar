<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Meetiie</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="public/css/nav.css">
	<link rel="stylesheet" href="public/css/niveau.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
	<body>
<?php include_once('vue/include/header.php'); ?>

<div class="container text-center" id="ajout_niveau">
	<?php echo ($code == "") ? "" : $error[$code]; ?>
  <h2>Ajouter un nouveau niveau</h2>
  <small class="text-muted error">Veuillez faire attention à ne pas mettre un niveau identique à ceux déjà existants</small>
  <form method="post" action="" class="form-group">
    <label for="nom_niveau">Nom du palier</label>
    <input type="text" name="nom_niveau" class="form-control" id="nom_niveau" maxlength="255" required />
    <br />
    Genre
    <div class="radio">
     <label><input type="radio" name="s_niveau" id="H" value="H" required>Homme</label>
    </div>
    <div class="radio">
     <label><input type="radio" name="s_niveau" id="F" value="F" required>Femme</label>
    </div>

    <label for="nombre_niveau">Niveau du palier</label>
    <input type="number" name="nombre_niveau" class="form-control" id="nombre_niveau"  min="0" required />

    <br />
    <input type="submit" class="btn btn-default" value="Ajouter" />
  </form>

  <hr />
  <h2>Tous les niveaux</h2>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>id</th>
        <th>id_admin</th>
        <th>Nom</th>
        <th>Palier</th>
        <th>Genre</th>
        <th>Date_update</th>
        <th>Options</th>
      </tr>
    </thead>

		<tbody>
<?php foreach ($niveaux as $elt) :  ?>
			<tr>
				<td><?php echo $elt['id']; ?></td>
				<td><?php echo $elt['id_admin']; ?></td>
				<td><?php echo $elt['nom']; ?></td>
				<td><?php echo $elt['pallier']; ?></td>
				<td><?php echo $genres[$elt['genre']]; ?></td>
				<td><?php echo $elt['date_update']; ?></td>
				<td><a href="niveau.php?delete=<?php echo $elt['id']; ?>">Supprimer</a></td>
			</tr>
<?php endForeach; ?>
		</tbody>

  </table>

</div>

<div class="container-fluid">


	<?php include_once('../vue/include/footer.php'); ?>


</div>

  <script src="public/js/display_menu.js"></script>

  </body>

</html>
