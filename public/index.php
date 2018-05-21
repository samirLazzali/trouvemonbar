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
    $req_count = $connection->query('SELECT COUNT(*) AS nbr FROM public.reunion')->fetch();
    if ($req_count['nbr']!=0) {
        $req = $connection->query('SELECT * FROM public.reunion WHERE id_reu= (SELECT MAX(id_reu) FROM public.reunion)');
        $res = $req->fetchAll();
        foreach ($res as $reu) {
            echo "soirée: {$reu['soiree']} <br/>
             date: {$reu['datee']} <br/>
             compt rendue: {$reu['cr']} <br/>";
            $id = $reu['id_reu'];
        }
        $count_part=$connection->query('SELECT COUNT(*) AS nbr1 FROM public.participants')->fetch();
        $n=$count_part['nbr1'];
        if ($n!=0) {
            $req_part = $connection->query("SELECT pseudo FROM public.participants ")->fetchAll();
            echo 'participants:</br> ';
            foreach ($req_part as $reu) {
                echo "{$reu['pseudo']} </br>";
            }
        }
        else{
            echo 'participant: aucun';
        }
        if (isset($_SESSION['connect']) && $_SESSION['connect']>=1) {
            ?>
            <form action="#" method="post">
                <input type="hidden" value="1" name="caché">
                <input type="submit" name="participer" value="Participer">
            </form>
            <?php
        }
    }
    else{
         echo "pas de réunion plannifiée";
    }
    ?>
</body>
</html>

</div>
</div>
</div>
</div>


<?php
if (isset($_POST['caché']) && $_POST['caché']==1 ){
    if (isset($_SESSION['connect']) && $_SESSION['connect']>=1) {
        $iid = $connection->query("SELECT COUNT(*) AS nbr_reu FROM public.reunion")->fetch();
        $nbr_reu=$iid['nbr_reu'];
        $check=0;
        $req_check=$connection->query("SELECT pseudo FROM public.participants WHERE id_reu=$nbr_reu ")->fetchAll();
        foreach ($req_check as $r){
            if ($r['pseudo']==$_SESSION['pseudo']){
                $check=1;
            }
        }
        if ($check==0) {
            echo "$nbr_reu";
            $req = $connection->prepare('INSERT INTO public.participants(id_reu,pseudo) VALUES (:id_reu,:pseudo)');
            $req->execute(['id_reu' => $nbr_reu,
                'pseudo' => $_SESSION['pseudo'],
            ]);
        }
    }
    else {
        echo 'veuillez vous connectez avant de participer';
        echo '<a href="connexion.php"> Se connecter</a>';
    }
}
?>
