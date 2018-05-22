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
    <link rel="icon" type="image/png" href="/img/favicon.ico">

