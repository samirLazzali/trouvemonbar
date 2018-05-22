
  <body>
    <div id="bandeau">
      CATISFACTION
    </div>
    <div id="menu">
			<?php
			$dbName = getenv('DB_NAME');
			$dbUser = getenv('DB_USER');
			$dbPassword = getenv('DB_PASSWORD');
				
			$connexion = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
			$infos = $connexion -> query("SELECT user_type FROM Utilisateur WHERE id_user = ".intval($_SESSION['id_user']));
			$infos -> setFetchMode(PDO::FETCH_OBJ);
			$fetch = $infos -> fetch();
				
			global $queries;
			$queries++;
	 if(isset($_SESSION['id_user']))
	 {
	 ?>
      <a href="<?php echo ROOTPATH; ?>/index.php">Accueil</a>   &nbsp;<a href="<?php echo ROOTPATH; ?>/membres/moncompte.php">Gérer mon compte</a>   &nbsp;<a href="<?php echo ROOTPATH; ?>/membres/matcher.php">Matcher mes chats</a>   &nbsp;<a href="<?php echo ROOTPATH; ?>/membres/deconnexion.php">Se déconnecter</a>
      <?php if($fetch->user_type == 0) { echo ROOTPATH; ?>/admin/crud.php">Administration</a>   &nbsp; <?php
	 }}
	 
	 else
	 {
	 ?>
      <a href="<?php echo ROOTPATH; ?>/index.php">Accueil</a>   &nbsp;<a href="<?php echo ROOTPATH; ?>/membres/inscription.php">Inscription</a>   &nbsp;<a href="<?php echo ROOTPATH; ?>/membres/connexion.php">Connexion</a>
      <?php
	 }
	 ?>
      
    </div>

    
    <div id="bande_g">     
    </div>
    <div id="bande_d">
    </div>
