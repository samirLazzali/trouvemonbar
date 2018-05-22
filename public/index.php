<?php
session_start();
if(!isset($_SESSION['connect']))
{
    $_SESSION['connect'] = 0;
}
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

</head>
<body>

<?php
menu_navigation();
?>

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
        echo 'Veuillez vous connecter avant de participer';
        echo '<a href="connexion.php">Se connecter</a>';
    }
}
?>


<div class="gtco-container2">
                            
<br />
<br />
<br />
<br />
<br /><br /><br />               


<h2>Prochaine Soirée :</h2>
    <?php
    $req_count = $connection->query('SELECT COUNT(*) AS nbr FROM public.reunion')->fetch();
    if ($req_count['nbr']!=0) {
        $req = $connection->query('SELECT * FROM public.reunion WHERE id_reu= (SELECT MAX(id_reu) FROM public.reunion)');
        $res = $req->fetchAll();
        foreach ($res as $reu) {
            echo "<p>Soirée : {$reu['soiree']} <br/>
             Date : {$reu['datee']} <br/>
             Compte Rendu de la réunion : {$reu['cr']} <br/></p>";
            $id = $reu['id_reu'];
        }
        $count_part=$connection->query('SELECT COUNT(*) AS nbr1 FROM public.participants')->fetch();
        $n=$count_part['nbr1'];
        if ($n!=0) {
            $req_part = $connection->query("SELECT pseudo FROM public.participants WHERE id_reu = $id")->fetchAll();
            echo '<p>Participants :</br> ';
            foreach ($req_part as $reu) {
                echo "{$reu['pseudo']} </br>";
	    }
	    echo '</p>';
        }
        else{
            echo '<p>Participants : Aucun</p>';
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
	echo '<p>';
	echo "Aucune réunion planifiée";
	echo '</p>';
    }
    ?>
</body>
</html>

</div>
</div>
</div>
</div>


