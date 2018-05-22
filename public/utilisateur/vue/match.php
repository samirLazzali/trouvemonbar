<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Meetiie</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="public/css/nav.css">
	<link rel="stylesheet" href="public/css/match.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
	<body>

<?php include_once('vue/include/header.php'); ?>

<div class="container">
  <div class="match text-center">
    <h2 id="pseudo"><strong></strong></h2>
    <p id="tags"><img src="public/image/loading.gif" alt="Chargement en cours" /></p>
    <p id="genre"></p>
    <div id="reponse">
      <button type="button" class="btn btn-success" id="oui">Matché !</button>
      <button type="button" class="btn btn-danger" id="non">Refuser</button>
    </div>
  </div>

</div>


<div class="container-fluid">

	<?php include_once('vue/include/footer.php'); ?>


</div>

  <script>
    var pseudo = document.getElementById('pseudo');
    var tags = document.getElementById('tags');
    var genre = document.getElementById('genre');
    var reponse = document.getElementById('reponse');

		var id = -1;

function getMatch(id_match = "", result_match = "") {
      var xhr = new XMLHttpRequest();

      reponse.style.display = 'none';

      xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
          var match = JSON.parse(xhr.responseText);
          if (!match) {
						pseudo.innerHTML = 'Aucune suggestion';
						tags.innerHTML = '';
						genre.innerHTML = '';
            reponse.style.display = 'none';
          }else {
            if (!match['tags'])
              match['tags'] = 'aucun tags';


						if (match['id_sexe'] == 'H')
							match['id_sexe'] = 'Homme'
						else
							match['id_sexe'] = 'Femme';


            pseudo.innerText = "Numéro " + match['id_utilisateur'];
            tags.innerHTML = "<strong>Tags</strong> " + match['tags'];
            genre.innerHTML = "<strong>Genre</strong> " + match['id_sexe'];
            reponse.style.display = 'block';

						id = match['id_utilisateur'];
          }
        }
      };

      xhr.open("GET", "match.php?match=" + encodeURIComponent(id_match) + "&result=" + encodeURIComponent(result_match));
      xhr.send(null);
}
getMatch();

var oui = document.getElementById('oui');
var non = document.getElementById('non');

oui.onclick = function() {
  pseudo.innerHTML = '';
  tags.innerHTML = '<img src="public/image/loading.gif" alt="Chargement en cours" />';
	genre.innerHTML = '';
  getMatch(id, 'o');
}

non.onclick = function() {
  pseudo.innerHTML = '';
  tags.innerHTML = '<img src="public/image/loading.gif" alt="Chargement en cours" />';
	genre.innerHTML = '';
	getMatch(id, 'n');
}

  </script>

	</body>

</html>
