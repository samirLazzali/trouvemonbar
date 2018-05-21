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

<br/><br/><br/><br/>
<br/>
<br/>

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
   			$tuple=$connection->query("SELECT * FROM public.participants_course WHERE id_par=0")->fetch();

    if(isset($_POST['part']) && $_SESSION['connect']>=1){
        $check=0;
        $req_check=$connection->query("SELECT pseudo FROM public.participants_course ")->fetchAll();
        foreach ($req_check as $r){
            if ($r['pseudo']==$_SESSION['pseudo']){
                $check=1;
            }
        }
        if ($check==0) {
            $req = $connection->prepare('INSERT INTO public.participants_course(id_par,soiree,pseudo,course) VALUES(:id_par,:soiree,:pseudo,:course)');
            $req->execute(['id_par' => $j,
                'soiree' => $tuple['soiree'],
                'pseudo' => $_SESSION['pseudo'],
                'course' => $tuple['course'],
            ]);
        }
    }
    	$soir=$tuple['soiree'];
        $turec=$connection->query("SELECT * FROM public.participants_course")->fetchAll();
        if(!empty($turec)){
        	?>
           		<tr>
               		<td><?php echo $tuple['soiree'] ?></td>
               		<td><?php echo $tuple['course'] ?></td>
               		<td><?php foreach ($turec as $res){
               				  if($res['soiree']==$soir){
               				  	echo $res['pseudo'].'<br/>';
               				  }
               				}?>
               		</td>

            		</tr>
        	<?php 
        }
        
?>
    </table>
    <?php 
    echo '</form>';
    echo '</br>';
    echo '<form method="post" action="#">';
    echo '    <fieldset><legend></legend><input type ="hidden" name="part" value=1 /></fieldset>';
    echo '   <input type ="submit" name="submit" value="Participer"/>';
    echo '</form>';
  

