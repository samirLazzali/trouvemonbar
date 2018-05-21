<?php
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
    <title> Préparatifs  </title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"  href="style_index.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">

</head>
<body>

    <?php
    menu_aperal();
    ?>



</div>
<h3><?php echo 'Préparatifs' ?></h3>

    <table class="table table-bordered table-hover table-striped">
        <thead style="font-weight: bold">
        <td>Soirée</td>
        <td>Liste des courses</td>
        <td>Participants</td>
        </thead>
        <?php /** @var \User\User $user */
    	  $irec=$connection->query("SELECT * FROM public.participants_course")->fetchAll();
    	  $j=1;
    	  foreach($irec as $id){
       			 $j++;
   			 }  
    if(isset($_POST['note']) && $_SESSION['connect']>=1){
        $req=$connection->prepare('INSERT INTO public.participants_course(id_par,soiree,pseudo,course) VALUES(:id_par,:soiree,:pseudo,:course)');
        $req->execute(['id_par'=>j,
        	'soiree'=>$_POST['soiree'],
        	'pseudo'=>$_SESSION['pseudo'],
        	'course'=>$_POST['course']
            ]);
    }

        $turec=$connection->query("SELECT * FROM public.participants_course")->fetchAll();

        if(!empty($turec)){
        	foreach ($turec as $res){
        	?>
           		<tr>
               		<td><?php echo $res[''] ?></td>
               		<td><?php echo $res['recettes'] ?></td>
               		<td><?php echo $tunote['moyenne'];?></td>

            		</tr>
        	<?php }	
        }
        
?>
    </table>
    <?php 
    echo '</form>';
    echo '</br>';
    echo '<h1>Donnez une note</h1>';
    echo '<form method="post" action="#">';
    echo '    <fieldset><legend>Id de la Recette </legend><input type ="number" name="recette" /></fieldset>';
    echo '    <fieldset><legend>Note </legend><input type ="number" name="note" min=0 max=5 /></fieldset>';
    echo '   <input type ="submit" name="submit" value="Votez"/>';
    echo '</form>';
  

