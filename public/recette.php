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
    <title> Oenologie  </title>
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
<h3><?php echo 'Recettes' ?></h3>

    <table class="table table-bordered table-hover table-striped">
        <thead style="font-weight: bold">
        <td>#</td>
        <td>Nom de la recette</td>
        <td>Note</td>
        </thead>
        <?php /** @var \User\User $user */
        $tuple=$connection->query("SELECT * FROM public.recette")->fetchAll();
        if(!empty($tuple)){
        	foreach ($tuple as $res){
        	?>
           		<tr>
               		<td><?php echo $res['id_rec'] ?></td>
               		<td><?php echo $res['recettes'] ?></td>
           			<td><?php echo $res['note'] ?></td>
            		</tr>
        	<?php }	
        }?>
    </table>
    <?php 
    echo '</form>';
    echo '</br>';
    echo '<h1>Donnez une note</h1>';
    echo '<form method="post" action="#">';
    echo '    <fieldset><legend>Recette </legend><input type ="text" name="recette" /></fieldset>';
    echo '    <fieldset><legend>Note </legend><input type ="number" name="note" min=0 max=5 /></fieldset>';
    echo '   <input type ="submit" name="submit" value="Votez"/>';
    echo '</form>';

    if(isset($_POST['note'])){

        $req=$connection->prepare('INSERT INTO public.recette(recettes,note,id) VALUES(:recettes,:note,:id)');
        $req->execute(['recettes'=>$_POST['recette'],
            'note'=>$_POST['note'],
            'id' => $_SESSION['id'],
            ]);
    }


