<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
<title>Page Title</title>
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
  <a href="#candidats"><a href="./liste.php">Candidats</a></a>
  <a href="#contact"><a href="./contact.html">Contact</a></a>
  <a href="#monprofil"><a href= <?php if(isset($_SESSION['status']) && $_SESSION['status']=='candidat'){$link="profil.php?pseudo=".$_SESSION['pseudo']; echo $link;} ?>> Mon profil </a></a>
  <a href="#parametres"><a href="./parametres.html">Paramètres</a></a>
  <a href="#login"><a href="./login.html">Login</a>
  <a href="#signup"><a href="./Inscription.html">S'enregistrer</a></a>
</div>

<hr/>

<div class="main">
  <p>
    
  </p>
</div>
 


</body>
</html>
