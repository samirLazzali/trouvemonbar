<?php
session_start();
require '../vendor/autoload.php'; 
//postgres 
$dbName = getenv('DB_NAME'); 
$dbUser = getenv('DB_USER'); 
$dbPassword = getenv('DB_PASSWORD'); 
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
$userRepository = new \User\UserRepository($connection);
if (!empty($_POST)){
	$userRepository->modif($_POST['firstname'],$_POST['lastname'],$_POST['domicile'],$_POST['bd'],$_POST['old_mdp'],$_POST['new_mdp'],$_POST['new_mdp_verif']);
}

if (empty($_SESSION['id']))
{
	header("Location: connexion.php");
}

?>
<!DOCTYPE html>

<html>
<head>
	<title>Mon Profil</title>
	<meta charset="utf-8">	

	<link rel="stylesheet" href="MonProfil.css" type="text/css">
	<link rel="stylesheet" type="text/css" href="main.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
	

</head>	
<body>
<script>
	function affiche_form_mdp(){
		var x = document.getElementById('modif_mdp');
		if (x.style.display === 'none') {
			x.style.display = 'block';
		}	
	       	else {
			x.style.display = 'none';      
		}
	}

</script>

<?php include "upperBar.php" ?>

<center><h2>Gestion des informations du compte</h2></br>
<div class="container">

<a href="./deconnexion.php"/><button>Se déconnecter</button></a><br/></br>
<?php

echo '<p><b><h5>Votre pseudo :&nbsp;&nbsp;'.$_SESSION['pseudo']. '</h5></b></p>'
?>



    <span id="modif_infos" style="display:block;"><button onclick="affiche_form_mdp()">Modifiez votre mot de passe</button></br></br></span>


<form action="MonProfil.php" method="post">

    <span id ="modif_mdp" style="display:none;">

    <label for="old_mdp"><b>Votre mot de passe :</b></label>
    <input type="password" name="old_mdp">
    <br/><br/>
    <label for="new_mdp"><b>Nouveau mot de passe :</b></label>
    <input type="password" name="new_mdp">
    <br/><br/>
    <label for="new_mdp_verif"><b>Verification nouveau mot de passe :</b></label>
    <input type="password" name="new_mdp_verif">
    <br/><br/>

    </span>


    <label for="firstname"><b>Prénom :</b></label>
    <input type="text" name="firstname" value=<?php echo $_SESSION['firstname'] ?> >
	<br/>
    <br/>
    <label for="lastname"><b>Nom :</b></label>
    <input type="text" name="lastname" value=<?php echo $_SESSION['lastname'] ?> >
    <br/><br/>
    <label for="domicile"><b>Domicile :</b></label>
    <input type="text" name="domicile" value=<?php echo $_SESSION['domicile'] ?> >
    <br/><br/>
    <label for="bd"><b>Date de naissance :</b></label>
    <input type="date" name="bd" value=<?php echo $_SESSION['birthday'] ?> >
    <br/><br/>

    <button type="submit">Changez vos informations</button>
  </div>
</form>
</center>

