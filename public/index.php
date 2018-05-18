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
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/magnific-popu.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.them.default.min.css">
    <link rel="stylesheet" href="css/style.css">

    <script src="js/modernizr-2.6.2.min.js"></script>

</head>
<body>

<div class="banniere">
<?php
menu_navigation();
menu_connexion();
?>
</div>


<header id="gtco-header" class="gtco-cover" role="banner" style="background-image: url(images/img_4.jpg)">
                <div class="overlay"></div>
                <div class="gtco-container">
                        <div class="row">
                                <div class="col-md-12 col-md-offset-0 text-left">


                                        <div class="row row-mt-15em">
                                                <div class="col-md-7 mt-text animate-box" data-animate-effect="fadeInUp">
                                                        <span class="intro-text-small">Welcome to Splash</span>
                                                        <h1>Build website using this template.</h1>
                                                </div>


<h3>Prochaine réunion</h3>
<form action id="prochaine_réunion">
    <?php echo $date_reunion ?>
    <input type="submit" value="Participer">
</form>
</body>
</html>

</div>
</div>
</div>
</div>


