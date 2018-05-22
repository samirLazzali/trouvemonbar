<?php
include "vue.php";
include "model.php";
session_start();


if (!isset($_SESSION['pseudo'])){
  header('Location: index.php'); 
}

$pseudo = $_SESSION['pseudo'];
$mail = $_SESSION['email'];
$birthday = $_SESSION['birthday'];

?>

<?php
if (!isset($_POST["newMail"])){
echo '
<!doctype html>
  <html>

    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="initial-scale=1.0">
      <title>profil</title>
      <link href="http://fonts.googleapis.com/css?family=Ubuntu:400,400|Montserrat:400,700" rel="stylesheet" type="text/css">
      <link rel="stylesheet" href="css/standardize.css">
      <link rel="stylesheet" href="css/profil-grid.css">
      <link rel="stylesheet" href="css/profil.css">
    </head>

    <body class="body page-profil clearfix">';
    $pseudo = NULL;
    if (isset($_SESSION["pseudo"])){
    $pseudo = $_SESSION["pseudo"];
    }
    head($pseudo);

    echo '<section class="profil profil-3 clearfix">

        <div class="log clearfix">
          <div class="avatar"></div>
          <form id="formprofil" method="post" action="">
          <p class="pseudo">Profil de '.htmlspecialchars($pseudo).'</p>
          <p id="mailtext" class="mail">E-mail :</p>
          <input id="mail_bdd" class="mail_bdd" type="text" name="newMail" value='.htmlspecialchars($mail).'>
          <p id="naissancetext" class="naissance">Date de naissance :</p>
          <input id="naissance_bdd" class="naissance_bdd" type="text" name="newDate" value='.htmlspecialchars($birthday).'>
          <input type="submit" id="envoi" class="_button" value="Modifier son profil">
          </form>
        </div>

      </section>';
      footer();

      echo '</body>';
      echo '</html>';
      echo '<script src="js/profil.js"></script>';
    }
  else{
    $bd = db_connect();
    $req = $bd->prepare('UPDATE Membre SET email = :newmail, birthday = :newbirthday WHERE id = :id');
    $req->execute(array('newmail' => htmlspecialchars($_POST['newMail']),'newbirthday' => htmlspecialchars($_POST['newDate']),'id' => $_SESSION['id']));

    $_SESSION['email'] = htmlspecialchars($_POST['newMail']);
    $_SESSION['birthday'] = htmlspecialchars($_POST['newDate']);
    echo '<p style="color:black"> Modifications réussies ! <a href=profil.php> Revenir au profil </a> </p>';
    echo '<p style="color:black"> Nouveau e-mail : '.htmlspecialchars($_POST['newMail']).'</p>';
    echo '<p style="color:black"> Nouvelle date de naissance : '.htmlspecialchars($_POST['newDate']).'</p>';
    echo '<p style="color:black">'.$_SESSION['id'].'</p>';

  }
  ?>