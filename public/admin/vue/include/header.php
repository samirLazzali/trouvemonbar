<header class="row">
	<nav class="navbar navbar-default col-md-12">
	  <div class="container-fluid">
		<div class="navbar-header">
		 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
		  <a class="navbar-brand" href="index.php"><img width="120px" src="../public/image/logo/logo_meetie_sans_fond.png" alt="Accueil" /></a>
		</div>
		<div class="collapse navbar-collapse" id="menu">
			<ul class="nav navbar-nav">
			  <li class="active"><a href="index.php"><span class="glyphicon glyphicon-home"></span> &nbsp;Accueil</a></li>
			  <li><a href="niveau.php">Ajuster les paliers</a></li>
			  <li><a href="quest.php">Questionnaire</a></li>
			  <li><a href="list_user.php">Utilisateurs</a></li>
			</ul>

			<div class="list-group" id="sous_menu">
			  <a href="../utilisateur/parametres.php" class="list-group-item">Paramètres du compte</a>
			</div>

			 <ul class="nav navbar-nav navbar-right menu_config">
			  <li><a class="" href="../utilisateur"><span class="glyphicon glyphicon-chevron-right"></span> Passer au mode joueur</a></li>
			  <li class="parametres_pos"><a class="parametres" href="#"><span class="glyphicon glyphicon-user"></span> &nbsp;Numéro <?php echo $_SESSION['id']; ?></a></li>
			  <li><a class="deconnect" href="../utilisateur/deconnect.php"><span class="glyphicon glyphicon-log-in"></span> &nbsp;Déconnexion</a></li>
			</ul>
	  </div>
	</nav>
<header>
