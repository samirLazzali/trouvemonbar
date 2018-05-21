<?php
session_start();
require '../vendor/autoload.php';
include('menu.php');
//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new \User\UserRepository($connection);
$users = $userRepository->fetchAll();
?>


<html>
<head>
    <title> Accueil  </title>
    <!-- Latest compiled and minified CSS -->
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"  href="style_index.css">

    <!-- Modif Gub -->

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">
    <!-- Animate.css -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">

    <script src="js/modernizr-2.6.2.min.js"></script>

</head>
<body>

<div class="banniere">
<?php
menu_navigation();
?>
</div>


<header id="gtco-header" class="gtco-cover" role="banner" style="background-image: url(images/bg.jpg)">
                <div class="gtco-container">
                        <div class="row">
                                <div class="col-md-12 col-md-offset-0 text-left">


					<div class="row row-mt-15em">
<br />
<br />
<br />
<br />
<h1>Nique les pd.</h1>
                                        


<h3>Prochaine réunion</h3>
    <?php
    $req = $connection->query('SELECT * FROM public.reunion WHERE id_reu= (SELECT MAX(id_reu) FROM public.reunion)');
    if (!$req) {
        $res = $req->fetchAll();
        foreach ($res as $reu) {
            echo "soirée: {$reu['soiree']} <br/>
             date: {$reu['datee']} <br/>
             compt rendue: {$reu['cr']} <br/>";
        }
        if ($_SESSION['connect']>=1) {
            ?>
            <form action="#" method="post">
                <input type="submit" name="participer" value="Participer">
            </form>
            <?php
        }
        $req_part = $connection->query('SELECT pseudo FROM public.Participants NATURAL JOIN public.reunion WHERE datee = (SELECT MAX(datee) FROM public.reunion)');
        if ($req_part!=0) {
            echo 'participants: ';
            $participant=$req_part->fetchAll();
            foreach ($req_part as $reu) {
                echo "{$reu['pseudo']} </br>";
            }
        }
        else{
            echo 'aucun';
        }
    }
    else{
         echo "pas de réunion plannifié";
    }
    ?>
</body>
</html>

</div>
</div>
</div>
</div>


<?php
if (isset ($_POST['participer'])) {
    if (isset($_SESSION['connect'])) {
        $iid = $connection->query("SELECT 'id' FROM public.reunion")->fetchAll();
        $i = 0;
        foreach ($iid as $id) {
            $i++;
        }
        $req = $connection->prepare('INSERT INTO public.reunion(id_reu,pseudo) VALUES :id_reu,:pseudo');
        $req->execute(['id_reu' => $i,
            'pseudo' => $_SESSION['pseudo'],
        ]);
    }
    else {
        echo 'veuillez vous connectez avant de participer';
        echo '<a href="connexion.php"> Se connecter</a>';
    }
}
?>
