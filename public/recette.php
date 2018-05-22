<?php
session_start();
if(!isset($_SESSION['connect']))
{
        $_SESSION['connect'] = 0;
}
if(!isset($_SESSION['id']))
{
            $_SESSION['id'] = -1;
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
    <title> Recettes  </title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"  href="style_index.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/form.css">
</head>
<body>

<?php
menu_aperal();
?>

<br />
<br />
<br />
<br />
<div class="container">
<h2>Recettes</h2>

    <table>
        <tr>
        <th>Id de la recette</th>
        <th>Nom de la recette</th>
        <th>Note</th>
        </tr>
        <?php /** @var \User\User $user */
    	  $irec=$connection->query("SELECT * FROM public.note")->fetchAll();
    	  $j=1;
    	  foreach($irec as $id){
       			 $j++;
   			 }
        $iid = $connection->query("SELECT COUNT(*) AS nbr_rec FROM public.recette")->fetch();
        $nbr_rec=$iid['nbr_rec'];
        $check=0;
        $req_check=$connection->query("SELECT id_usr FROM public.note ")->fetchAll();
        foreach ($req_check as $r){
            if ($r['id_usr']==$_SESSION['id']){
                $check=1;
            }
        }
        if ($check==0) {
            if(isset($_POST['note']) && $_SESSION['connect']>=1) {
                 $req = $connection->prepare('INSERT INTO public.note(note,id_rec,id_vente,id_usr) VALUES(:note,:id_rec,:id_vente,:id_usr)');
                 $req->execute(['note' => $_POST['note'],
                    'id_rec' => $_POST['id'],
                    'id_vente' => $j,
                    'id_usr' => $_SESSION['id'],
                ]);
            }
    }

        $turec=$connection->query("SELECT * FROM public.recette")->fetchAll();

        if(!empty($turec)){
        	foreach ($turec as $res){
        		$id_recette=$res['id_rec'];
        	    $tunote=$connection->query("SELECT AVG(note) AS moyenne FROM public.note WHERE id_rec=$id_recette")->fetch();

        	?>
           		<tr>
               		<td><?php echo $res['id_rec'] ?></td>
               		<td><?php echo $res['recettes'] ?></td>
               		<td><?php echo $tunote['moyenne'];?></td>

            		</tr>
        	<?php }	
        }
        
?>
    </table>
<?php
    echo '<br />';
    echo '<br />';	
    echo '<div class="container">';

    echo '<div class="form-c">';
    echo '<div class="form-c-head">Noter une recette :</div>';
    echo '<form method = "post" action="#">';
    echo '<label for="recette"><span class="txt">ID de la Recette <span class="required">*</span></span><input type="text" class="input-field" name="id" /></label>';
    echo '<label for="note"><span class="txt">Note <span class="required">*</span></span><input type="number" class="input-field" name="note" min=0 max=5 /></label>';
    echo '<input type ="submit" name="submit" value="Noter"/>';
    echo '</form>';
    echo '</div>';
    echo '</div>';
    echo '</div>';


?>
</div>
  </body>


