
<?php include("epreuvesData.php");?>



<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
<title>Epreuves</title>
</head>
<body>
<link rel="stylesheet" type="text/css" href="style.css" />

<div class="hero-image">
  <div class="hero-text">
    <h1>MISTERIIE</h1>
    <p>Edition 2018/2019</p>
  </div>
</div>
<div class="navbar">
  <a href="#accueil"><a href="./main.html">Accueil</a></a>
  <a href="#informations"><a href="./informations.html">Informations</a></a>
  <a href="#candidats"><a href="./candidats.html">Candidats</a></a>
  <a href="#contact"><a href="./contact.html">Contact</a></a>
  <a href="#monprofil"><a href="./monprofil.html">Mon profil</a></a>
  <a href="#parametres"><a href="./parametres.html">Paramètres</a></a>
  <a href="#login"><a href="./login.html">Login</a>
  <a href="#signup"><a href="./signup.html">S'enregistrer</a></a>
</div>

<hr/>

<div class="main">
  <p>
    Bienvenue dans la fameuse épreuve des poteaux. Voici la liste des candidats qui participent à l'épreuve : <br/>
    <?php printCandidatsEpreuves(1);?>

    <span class="warning">Ceux qui ne se sont pas encore inscrits pour l'épreuve cliquez <a href="inscriptionPoteaux.html">ici</a>.</span> 
  </p>
</div>
 


</body>
</html>
