<!DOCTYPE html>
<html>
  <head>
    <?php
       
       if(isset($titre) && trim($titre) != '')
       $titre = $titre.' : '.TITRESITE;
       
       else
       $titre = TITRESITE;
       ?>
    <title><?php echo $titre; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="language" content="fr" />
    <link rel="stylesheet" type="text/css" href="../style.css"/>
  </head>
  
  
  <body>
    <div id="bandeau">
      CATISFACTION
    </div>
    <div id="menu">
      <?php
	 if(isset($_SESSION['id_user']))
	 {
	 ?>
      <a href="<?php echo ROOTPATH; ?>/index.php">Accueil</a>   &nbsp;<a href="<?php echo ROOTPATH; ?>/membres/moncompte.php">Gérer mon compte</a>   &nbsp;<a href="<?php echo ROOTPATH; ?>/membres/deconnexion.php">Se déconnecter</a>
      <?php
	 }
	 
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
