<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Meetiie</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="public/css/index.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
	<body>

<div class="container-fluid">

<div>
<?php include_once('vue/include/header.php'); ?>

	<section class="row">
		<div class="row col-md-offset-3 col-md-6 accueil">
			<aside class="col-md-6 text-center">
				<h1><strong id="count"><?php echo $display_count; ?></strong> se sont inscrits</h1>
				<p>
					Madame, Mademoiselle, Monsieur,<br /><br />Bienvenue sur Meetiie, le <strong>PREMIER</strong>
					site de rencontre fait par des étudiants, pour les étudiants !<br />Venez tenter l'expérience, gratuite,
					marrante, de RErecontrer vos camarades d'Ecole. Découvrez-les sous un nouveau visage, sans voir leurs
					visages ! Accumulez les surprises : nouvelles rencontres (amoureuses ou amicales), découverte de la vraie
					personnalité de vos amis.<br />
					Inscrivez-vous dans l'<strong>anonymat</strong>, restez anonyme, matchez des états d'esprit et tentez de
					gravir les échelons :  Michelle, Nadia et Maman de Stifler (pour les filles) ou Sherminator, Pause-Caca et Stifler (pour les gars),
					en augmentant vos <strong>MATCHs</strong> pour finir premier : <strong>Mister Meetiie</strong>
				</p>
			</aside>

			<article class="col-md-5 col-md-offset-1 choix-sexe">
				<form method="post" action="inscription.php" class="text-center" id="form-inline" onsubmit="return submitInscription();">
					<div class="search-sexe">
					  <h4 class="text-center">Vous recherchez...</h4>
						  <input class="btn btn-default btn-homme" type="button" value="Homme" />
						  <br />
						  <br />
						  <input class="btn btn-default btn-femme" type="button" value="Femme" />
						  <br />
						  <br />
						  <input class="btn btn-default btn-both" type="button" value="Les deux" />
						  <br />
					</div>

					<div class="id-sexe">
					   <h4 class="text-center"><button class="btn btn-default retour" type="button"> &laquo; </button> Vous êtes...</h4>
						  <input class="btn btn-default btn-homme" type="button" value="Homme" />
						  <br />
						  <br />
						  <input class="btn btn-default btn-femme" type="button" value="Femme" />
						  <br />
					</div>

					<div class="info">
					  <h4 class="text-center"><button class="btn btn-default retour" type="button"> &laquo;	</button> Informations complémentaires</h4>
						  <div class="form-group" id="mail-div">
							  <input id="mail" name="mail" class="form-control" type="text" placeholder="E-mail">
						      <small class="text-muted" id="mail-info">
							  </small>
						  </div>

						  <div class="form-group">
							  <input id="date" name="date" class="form-control" type="date">
						      <small class="text-muted" id="date-info">
							  </small>
						  </div>

						  <div class="form-group" id="password-div">
								<input id="password" name="password" class="form-control" type="password" placeholder="Mot de passe">
								<small class="text-muted" >
								  Le mot de passe doit contenir au moins 6 caractères.
								</small>
						  </div>
						  <br />
						   <div class="form-group">

						  <input type="hidden" name="search-sexe" value="" />
						  <input type="hidden" name="id-sexe" value="" />
						  <input type="submit" class="btn btn-primary" />
                    </div></div>
				</form>
			</article>
		</div>
	</section>
</div>


<?php include_once('vue/include/footer.php'); ?>


</div>

	<script>
$(function(){
/**Menu accueil en jquery**/
	function setSexe(s) {
		if (s == 'Femme')
			return 'F';
		else if(s == 'Homme')
			return 'H';
		else if(s == 'Les deux')
			return 'D';
		else
			return 'undefined';
	}
	var return_form = 0;
	/*
	evenements sur les boutons de l'accueil
	*/
	$('.search-sexe input').click(function(){
		$('input[name=search-sexe]').val(setSexe($(this).val()));
		$('.search-sexe').hide('fast', function(){
			$( ".id-sexe" ).show( "fast" );
		});


		return_form = 1;
	});

	$('.id-sexe input').click(function(){
		$('input[name=id-sexe]').val(setSexe($(this).val()));
		$('.id-sexe').hide('fast', function(){
			$( ".info" ).show( "fast" );
		});


		return_form = 2;
	});

	$('.retour').click(function(){
		if (return_form == 1) {
			$('.id-sexe').hide('fast', function(){
				$( ".search-sexe" ).show( "fast" );
			});

		}else {
			$('.info').hide('fast', function(){
				$( ".id-sexe" ).show( "fast");
			});

			return_form = 1;
		}

	});
	$('input, button').click(function(){
		$('.test').html('id-sexe : ' + $('input[name=id-sexe]').val()
		+'<br />'+'search-sexe : ' + $('input[name=search-sexe]').val()
		);
	});
});


/**Vérification formulaire**/
var mail = document.getElementById('mail');
var mail_div = document.getElementById('mail-div');
var mail_info = document.getElementById('mail-info');

var datein = document.getElementById('date');
var datein_info = document.getElementById('date-info');

var pass = document.getElementById('password');
var pass_div = document.getElementById('password-div');

var regex_mail = /^([a-zA-Z0-9._-]+)@([a-zA-Z0-9._-]+)\.([a-z]{2,8})$/;

var validmail = false;
var validdate = false;
var validpass = false;

mail.addEventListener('keyup',function(){
	if (!regex_mail.test(this.value.trim())) {
		mail_div.className = "form-group has-error has-feedback";
		mail_info.innerText = "Le mail n'est pas au bon format !";
		validmail = false;
	}else {
		var xhr = new XMLHttpRequest();

		xhr.onreadystatechange = function() {
			if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
				if (xhr.responseText == "exist") {
					mail_div.className = "form-group has-error has-feedback";
					mail_info.innerText = "Le mail est déjà pris";
					validmail = false;
				}else {
					mail_div.className = "form-group has-success has-feedback";
					mail_info.innerText = "";
					validmail = true;
				}


			}
		};

		xhr.open("GET", "existMail.php?mail=" + encodeURIComponent(this.value.trim()), true);
		xhr.send(null);

	}
});

datein.addEventListener('change',function(){
	var ecart = ((new Date().getFullYear())-(new Date(this.value).getFullYear()));
	if (ecart < 18 || ecart > 99) {
		datein_info.innerText = "Il faut avoir entre 18 et 99 ans pour pouvoir s'inscrire !";
		validdate = false;
	}else {
		datein_info.innerText = "";
		validdate = true;
	}
});

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
	if (!validmail || !validpass || !validdate) {
		alert("Renseignez les informations avant et au bon format !")
		return false;
	}
}


/*Reset le compteur*/
var count = document.getElementById('count');

setInterval(function(){
		var xhr = new XMLHttpRequest();

		xhr.onreadystatechange = function() {
			if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
				count.textContent = xhr.responseText;

			}
		};


		xhr.open("GET", "index.php?count");
		xhr.send(null);
}, 1000);

	</script>
	</body>
</html>
