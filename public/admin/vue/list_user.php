<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Meetiie</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="public/css/nav.css">
	<link rel="stylesheet" href="public/css/list_user.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
	<body>

<?php include_once('vue/include/header.php'); ?>

<br />
<br />
<div class="container">
  <div id="list_user" class=" container-fluid">
    <table class="table table-bordered text-center">
      <thead>
        <tr>
          <th>Id</th>
          <th>Mail</th>
          <th>Statut</th>
          <th>Modifier</th>
        </tr>
      </thead>

  		<tbody>
  <?php foreach ($all_user as $elt) :  ?>
  			<tr>
  				<td><?php echo $elt['id']; ?></td>
  				<td><?php echo $elt['mail']; ?></td>
  				<td><?php echo $elt['statut']; ?></td>
  				<td>
            <form method="post" action="">
              <div class="form-group">
                <label for="change_statut">Changer le statut</label>
                <select name="statut" class="form-control" id="change_statut">
                  <option value="0">Rendre admin</option>
                  <option value="1">Rendre simple utilisateur</option>
                  <option value="2">Bannir</option>
                </select>
                <br />
                <input type="hidden" name="id_user" value="<?php echo $elt['id']; ?>" />
                <input type="submit" class="btn btn-warning" value="Changer" />
              </div>
            </form>
          </td>
  			</tr>
  <?php endForeach; ?>
  		</tbody>

    </table>
  </div>
</div>

<div class="container-fluid">

  <?php include_once('../vue/include/footer.php'); ?>


</div>

	<script src="public/js/display_menu.js"></script>


	</body>

</html>
