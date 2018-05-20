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

if($_POST['validate'] != 'ok') {
?>	
		<div id="contenu">
					
			<h1>Formulaire de connexion</h1>
			<p>Pour vous connecter, indiquez votre nom d'utilisateur et votre mot de passe.<br/>
			Vous pouvez aussi cocher l'option "Me connecter automatiquement à mon
			prochain passage." pour laisser une trace sur votre ordinateur pour être
			connecté automatiquement.<br/></p>
			
			<form name="connexion" id="connexion" method="post" action="connexion.php">
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
					<tr>
					<td><input type="submit" value="Connexion" /></td>
					<td><input type="checkbox" name="cookie" id="cookie"/> <label for="cookie">Me connecter automatiquement à mon prochain passage.</label></td>

					</tr>
				</table>
				</fieldset>
			</form>
			
			<h2>Options</h2>
			<p><a href="inscription.php">Je ne suis pas inscrit.</a><br/>
			<a href="moncompte.php?action=reset">J'ai oublié mon mot de passe.</a>
			</p>
			<?php
}

else	{
				$dbName = getenv('DB_NAME');
				$dbUser = getenv('DB_USER');
				$dbPassword = getenv('DB_PASSWORD');
				$connexion = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
				$result = $connexion->query("SELECT COUNT(id_user) AS nbr, id_user, login, password FROM Utilisateur WHERE
				login = '".$_POST['login']."' GROUP BY id_user");
				global $queries;
				$queries++;
				if($result->nbr == 1)
				{
					if(md5($_POST['password']) == $result->password)
					{
						$_SESSION['id_user'] = $result->id_user;
						$_SESSION['login'] = $result->login;
						$_SESSION['password'] = $result->password;
						unset($_SESSION['connexion_login']);
						
						if(isset($_POST['cookie']) && $_POST['cookie'] == 'on')
						{
							setcookie('id_user', $result->id_user, time()+365*24*3600);
							setcookie('password', $result->password, time()+365*24*3600);
						}
						
						$informations = Array(
										false,
										'Connexion réussie',
										'Vous êtes désormais connecté avec le nom d\'utilisateur <span class="login">'.htmlspecialchars($_SESSION['login'], ENT_QUOTES).'</span>.',
										'',
										ROOTPATH.'/index.php',
										3
										);
						require_once('../information.php');
						exit();
					}
					
					else
					{
						$_SESSION['connexion_login'] = $_POST['login'];
						$informations = Array(
										true,
										'Mauvais mot de passe',
										'Vous avez fourni un mot de passe incorrect.',
										' - <a href="'.ROOTPATH.'/index.php">Index</a>',
										ROOTPATH.'/membres/connexion.php',
										3
										);
						require_once('../information.php');
						exit();
					}
				}
				
				else if($result->nbr > 1)
				{
					$informations = Array(
									true,
									'Doublon',
									'Deux membres ou plus ont le même nom d\'utilisateur, contactez un administrateur pour régler le problème.',
									' - <a href="'.ROOTPATH.'/index.php">Index</a>',
									ROOTPATH.'/contact.php',
									3
									);
					require_once('../information.php');
					exit();
				}
				
				else
				{
					$informations = Array(
									true,
									'Nom d\'utilisateur inconnu',
									'Le nom d\'utilisateur <span class="login">'.htmlspecialchars($_POST['login'], ENT_QUOTES).'</span> n\'existe pas dans notre base de données. Vous avez probablement fait une erreur.',
									' - <a href="'.ROOTPATH.'/index.php">Index</a>',
									ROOTPATH.'/membres/connexion.php',
									5
									);
					require_once('../information.php');
					exit();
				}
			}
			?>			
		</div>

		<?php
		include('../includes/bottom.php');
		?>