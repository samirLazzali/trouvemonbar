<!DOCTYPE html>
<html>
<meta charset="UTF-8">
	<head>
      <link href="projet.css" rel="stylesheet" type="text/css" />
	  <title>Agendassos : Bienvenue</title>
	</head>
	<body class="modal-form">
	<div class="modal-form">
	<?php
		
		
	$bdd=new PDO('mysql:host=localhost;dbname=projet','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	$reponse = $bdd->query('SELECT * FROM users');
	function get_reunions($user){
		$bdd2=new PDO('mysql:host=localhost;dbname=projet','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		$req=$bdd2->query('SELECT id_reunion FROM participer_a,users WHERE ' . $user .'.id=participer_a.id_user ');
		while ($boucle = $req -> fetch())
		{
			$sql2=$bdd2->query('SELECT date FROM reunion WHERE ' . $boucle['id_reunion'] . '=reunion.id ');
		}
		return $sql2;
	}
	$s=0;
	$l=0;
	if (isset($_POST['pass']) AND isset($_POST['user']))
	{
		while($donnees = $reponse->fetch())
		{
			if($donnees['pseudo']==$_POST['user']) 
			{
				if($donnees['mdp']==$_POST['pass'])
				{
					?><h1> Connecté : 
					<?php 
					echo htmlspecialchars($_POST['user']); 
					?>	
					</h1>
					<p>
					<?php 
					echo get_reunions($donnees);
					?>
					</p>
				<?php
				}
				else 
				{
					echo " <h1> mot de passe incorrect </h1>";
				}
			}
			else 
			{
				$s++;
			}
		$l++;	
		}
		if($l==$s)
		{
			echo " <h1> nom de compte incorrect </h1>";
		}
	}
				?>
	
	
	</div>
	</body>
</html>