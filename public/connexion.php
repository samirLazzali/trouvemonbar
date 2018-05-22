<?php
include "vue.php";
include "model.php";
session_start();

if (isset($_SESSION['pseudo'])){
  header('Location: index.php'); 
  exit;
}
?>
<!doctype html>
  <html>

    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="initial-scale=1.0">
      <title>connexion</title>
      <link href="http://fonts.googleapis.com/css?family=Montserrat:400,400,700|Ubuntu:300,400" rel="stylesheet" type="text/css">
      <link rel="stylesheet" href="css/standardize.css">
      <link rel="stylesheet" href="css/connexion-grid.css">
      <link rel="stylesheet" href="css/connexion.css">
    </head>

    <body class="body page-connexion clearfix">

      <?php
      head(NULL);
      ?>
<?php
if (!isset($_POST['email'])){
  echo '<section class="connexion connexion-3 clearfix">
      <form method="post" id="connexionform" action="">
        <div class="log clearfix">
          <p id="emailtext" class="pseudo">E-mail :</p>
          <input id="email" class="_input _input-1" placeholder="E-mail" type="text" name="email"/>
          <p id ="mdptext" class="mdp">Mot de Passe :</p>
          <input id="mdp" class="_input _input-2" placeholder="Mot de passe" type="password" name="mdp"/>
          <div class="element"></div>
          <input type="submit" id="envoi" class="_button" value="Envoyer">
        </div>
      </form>
    </section>
    <p class="connexion connexion-4">connexion</p>
    <footer class="contact clearfix">
      <div class="reseau clearfix">
        <div class="facebook"></div>
        <div class="twitter"></div>
        <div class="discord"></div>
      </div>
      <div class="adresse">
        <p>1, square de la Résistance</p>
        <p>91 000 Evry</p>
  </div>
    </footer>
  </body>
  </html>
  <script src="js/connexion.js"></script>';
}
else{


  $mdp = htmlspecialchars(md5($_POST['mdp']));
  $email = htmlspecialchars($_POST['email']);

  $db = db_connect();
  $query=$db->prepare('SELECT * FROM Membre WHERE email = ?');
  $query->execute(array($email));
  $data=$query->fetch();

    if (strcmp($mdp, $data['password']) == 0) // Acces OK !
    {

        $_SESSION['pseudo'] = $data['login'];

        $_SESSION['id_groupe'] = $data['id_groupe'];

        $_SESSION['email'] = $data['email'];

        $_SESSION['firstname'] = $data['firstname'];

        $_SESSION['lastname'] = $data['lastname'];
        
        $_SESSION['birthday'] = $data['birthday'];

        $_SESSION['id'] = $data['id'];

        $query->CloseCursor();

        echo '<p style="color:black"> Connexion réussie. Cliquez <a href="index.php"> ici </a> pour revenir à l\'accueil.</p>';
    }
    else // Acces pas OK !
    {
    echo '<p style="color:red"> Mot de passe ou e-mail incorrect. Vous pouvez réessayer en cliquant sur <a href="">ici</a> </p>';
    }
}
?>
