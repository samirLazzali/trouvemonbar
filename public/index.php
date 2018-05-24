<?php
session_start();
header('Content-type: text/html; charset=utf-8');

$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");


$membre = $connection->query('SELECT * FROM membres');

?>

<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="initial-scale=1.0">
  <title>index</title>
  <link href="http://fonts.googleapis.com/css?family=Montserrat:400,400|Kite+One:400,400" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/standardize.css">
  <link rel="stylesheet" href="css/index-grid.css">
  <link rel="stylesheet" href="css/index.css">
</head>
<body class="body page-index clearfix">
  <div class="photo_accroche clearfix">
    <header class="cuisine clearfix">
      <div class="logo"></div>
      <p class="accroche">L'association des fins gourmets de l'ENSIIE !</p>
<?php
        if(!isset($_SESSION['membre_id']))
        {
?>
            <div onClick="window.location.href='./membres/connexion.php';" class="connexion connexion-1 clearfix">
            <p class="connexion">Connexion</p>
            </div>
            <div onClick="window.location.href='./membres/inscription.php';" class="inscription inscription-1 clearfix">
                <p class="inscription">Inscription</p>
            </div>
            <?php
        }
        else
        {
            ?>
            <div onClick="window.location.href='./membres/moncompte.php';" class="connexion connexion-1 clearfix">
                <p class="connexion">Mon compte</p>
            </div>
            <div onClick="window.location.href='./membres/deconnexion.php';" class="connexion connexion-1 clearfix">
            <p class="connexion">Deconnexion</p>
            </div>
            <?php
        }
        ?>



      <nav class="navigation clearfix">
        <div onClick="window.location='index.php';" class="accueil accueil-1 clearfix">
          <p class="accueil">Accueil</p>
        </div>
        <div onClick="window.location='menu.php';" class="menu menu-1 clearfix">
          <p class="menu">Menu</p>
        </div>
        <div onClick="window.location='reservation.php';" class="reservation reservation-1 clearfix">
          <p class="reservation">Réservation</p>
        </div>
        <div onClick="window.location='catalogue.php';" class="recettes recettes-1 clearfix">
          <p class="recettes">Recettes</p>
        </div>
      </nav>
    </header>
    <div class="transparent"></div>
  </div>
  <section class="accueil accueil-3 clearfix">
    <div class="bandeau clearfix">
      <div class="ligne_gauche clearfix">
        <p class="ligne">--------</p>
      </div>
      <h2 class="titre_bandeau">CuIsInE en quelques mots, c'est ...</h2>
      <div class="ligne_droite clearfix">
        <p class="ligne">--------</p>
      </div>
    </div>
    <div class="photo_presentation"></div>
    <div class="text">
      <p>Bienvenue à toi chercheur de nouvelles saveurs !
</p>
      <p>Voici le site de l'association CuIsInE, l'association qui va te mettre vraiment bien ! Tu en as marre de manger des phats tout seul ? Tu veux partager un bon moment entre potes ? Alors n'hésites plus et viens t'amuser avec nous !</p>
      <p>Au programme : des jeudis cuisine, des repas de soirée, des repas entre potes et des expériences culinaires comme tu n'en as jamais faite !</p>
      <p>Nous n'attendons plus que toi !</p>
       
</div>

<div>
 <?php
        if(isset($_SESSION['membre_admin']) && $_SESSION['membre_admin']!=0)
        {
        ?>
        <table class="table table-bordered table-hover table-striped">
            <thead style="font-weight: bold">
            <td class="membre">Pseudo</td>
            <td class="membre">Adresse mail</td>
            <td class="membre">Banni</td>
            </thead>
            <?php /** @var \User\User $user */
            while($users = $membre->fetch()) { ?>
                <tr>
                    <td  class="membre"><?php echo $users['membre_pseudo'] ?></td>
                    <td  class="membre"><?php echo $users['membre_mail'] ?></td>
                    <td  class="membre"><?php echo $users['membre_banni'] ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
        <?php
        }
        ?>
	</div
  </section>


  <footer class="cuisine cuisine-2 clearfix">
    <p class="adresse">1, square de la Résistance</p>
    <p class="code_postal">91000 Evry</p>
  </footer>
</body>
</html>