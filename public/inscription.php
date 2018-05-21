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
session_start();
?>

    <html>
    <head>
        <title> Inscription  </title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css"  href="style_index.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/form.css">
    </head>
    <body>

<?php
menu_navigation()
?>
<br />
<br />
<br />

<div class="gtco-container">';

<div class="form-c">
<div class="form-c-head">Veuillez remplir les informations :</div>
<form method = "post" action="#" >
<label for="prenominsc"><span class="txt">Prénom <span class="required">*</span></span><input type="text" class="input-field" name="prenominsc" value="" /></label>
<label for="nominsc"><span class="txt">Nom <span class="required">*</span></span><input type="text" class="input-field" name="nominsc" value="" /></label>
<label for="mailinsc"><span class="txt">Mail <span class="required">*</span></span><input type="text" class="input-field" name="mailinsc" value="" /></label>
<label for="pseudoinsc"><span class="txt">Pseudo <span class="required">*</span></span><input type="text" class="input-field" name="pseudoinsc" value="" /></label>
<label for="mdpinsc"><span class="txt">Mot de passe <span class="required">*</span></span><input type="text" class="input-field" name="mdpinsc" value="" /></label>
<input type ="submit" name="submit" value="S'inscrire"/>
</form>
</div>
</div>

</div>
<?php
if (isset($_POST['prenominsc']) && isset($_POST['nominsc']) && isset($_POST['pseudoinsc']) && isset($_POST['mailinsc']) && isset($_POST['mdpinsc']) && $_POST!=null) {   //améliorer la condition
    $iid=$connection->query("SELECT 'id' FROM public.user")->fetchAll();
    $i=1;
    foreach($iid as $id){
        $i++;
    }
    echo $i;

    $req = $connection->prepare('INSERT INTO public.user(id,prenom,nom,score,pseudo,mdp,mail,inscription) VALUES(:id,:prenom,:nom,:score,:pseudo,:mdp,:mail,:inscription)');
    $test = $req->execute(['id' => $i,
        'prenom' => $_POST['prenominsc'],
        'nom' => $_POST['nominsc'],
        'score' => 0,
        'pseudo' => $_POST['pseudoinsc'],
        'mdp' => $_POST['mdpinsc'],
        'mail' => $_POST['mailinsc'],
        'inscription' => 1,
    ]); 
    
}
else{
    echo '<p>veuillez remplir tout les champs</p>';
}
?>
