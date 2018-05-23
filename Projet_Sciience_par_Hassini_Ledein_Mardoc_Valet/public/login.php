<?php
	require_once("en_tete.php");
	en_tete();
?>


	<section>
		
		<aside>
		
		</aside>
			
		<article>		
			<h1>Page de connection</h1>
			<form action="connection.php" method="post"><pre>
Identifiant  : <input type="text" name="login"><br>
Mot de passe : <input type="password" name="password"><br><br>
	       <input type="submit" value="Se connecter"></pre>
			</form>
			<br>
			<br>
			<br>
			<form action="https://oauth.iiens.net/authorize.php?oauth_token=40cefb1853f03c161ca224facf15de8105adc7881" method="post">
			      Se connecter avec Arise (pour les élèves de l'ENSIIE) :
			      <br>
			      <input type="submit" value="AriseID">
			</form>
			<br>
			<br>
			<br>
			<form action="inscription.php" method="post">
			      Pour créer un compte : 
			      <br>
			      <input type="submit" value="S'inscrire">
			</form>
			<br><br>
			<h1> A l'attention des développeurs : il faut<br>
				1) vérifier comment ça se passe avec Arise<br>
			    2) créer la page de connexion<br>
			    3)le lancement de la session    
			</h1>
		</article>
	
	</section>

       </div> <!-- On quitte le coeur de la page -->
<?php
	require_once("pied.php");
	pied();

