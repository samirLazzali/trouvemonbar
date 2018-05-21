<?php

session_start();
header('Content-type: text/html; charset=utf-8');
include('../includes/config.php');
include('../includes/functions.php');
actualiser_session();

if(isset($_SESSION['id_user']))
{
	$informations = Array(
					true,
					'Vous êtes déjà connecté',
					'Vous êtes déjà connecté avec le nom d\'utilisateur <span class="login">'.htmlspecialchars($_SESSION['login'], ENT_QUOTES).'</span>.',
					' - <a href="'.ROOTPATH.'/membres/deconnection.php">Se déconnecter</a>',
					ROOTPATH.'/index.php',
					5
					);
	
	require_once('../information.php');
	exit();
}


$titre = 'Connexion';
include('../includes/top.php');
?>	
		<div id="contenu">
					
			<h1>Formulaire de connexion</h1>
			<p>Pour vous connecter, indiquez votre nom d'utilisateur et votre mot de passe.<br/>
			Vous pouvez aussi cocher l'option "Me connecter automatiquement à mon
			prochain passage." pour laisser une trace sur votre ordinateur pour être
			connecté automatiquement.<br/></p>
			
			<form name="connexion" id="connexion" method="post" action="champs_connexion.php">
				<fieldset><legend>Connexion</legend>
				<table>
					<tr>
					<td><label for="login" class="float">Nom d'utilisateur :</label></td>
					<td><input type="text" name="login" id="login" value="<?php if(isset($_SESSION['connexion_login'])) echo $_SESSION['connexion_login']; ?>"/></td>
					</tr>
					<tr>
					<td><label for="password" class="float">Mot de passe :</label></td>
					<td><input type="password" name="password" id="password"/></td>
					</tr>
					<tr>
					<td><input type="hidden" name="validate" id="validate" value="ok"/></td>
					<td></td>
					</tr>
				</table>
					<input type="submit" value="Connexion" /><br/>
					<input type="checkbox" name="cookie" id="cookie"/> <label for="cookie">Me connecter automatiquement à mon prochain passage.</label>
				</fieldset>
			</form>
			
			<h2>Options</h2>
			<p><a href="inscription.php">Je ne suis pas inscrit.</a><br/>
			</p>		
		</div>

		<?php
		include('../includes/bottom.php');
		?>