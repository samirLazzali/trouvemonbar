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


<header id="gtco-header" class="gtco-cover" role="banner" style="background-image: url(images/img_4.jpg)">
                <div class="overlay"></div>
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
    $req = $connection->query('SELECT * FROM public.reunion WHERE datee= (SELECT MAX(datee) FROM public.reunion)');
    $res=$req->fetchAll();
    foreach ($res as $reu){
        echo "soirée: {$reu['soiree']} </br>
         date: {$reu['datee']} </br>
         compt renude: {$reu['cr']} </br>
         liste des participant: {$reu['participant']} </br> ";
    }
    ?>
                        <form action="#" method="post">
                            <input type="submit" name="participer" value="Participer">
                        </form>
</body>
</html>

</div>
</div>
</div>
</div>


<?php
if (isset ($_POST['participer'])) {
    $req2 = $connection->query('SELECT participant FROM public.reunion WHERE datee = (SELECT MAX(datee) FROM public.reunion)');
    $participants = $req2->fetchAll();
    foreach ($participants as $part) {
        $req = $connection->prepare('UPDATE public.reunion SET participant=:participant');
        $test = $req->execute([':participant' => $part."</br>".$_SESSION['prenom']." ".$_SESSION['nom']]);
    }
}

?>