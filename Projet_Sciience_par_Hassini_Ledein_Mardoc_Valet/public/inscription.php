<?php
	require_once("en_tete.php");
	en_tete();
?>

	<section>
		
		<aside>
		
		</aside>
			
		<article>		
			<h1>Page d'inscription</h1> <br>
			<h3>Inscrivez-vous pour accéder à plus de fonctionnalités</h3>
			<p>Vous ne devez pas laisser un champs vide ni mettre de caractères spéciaux !</p>
<form action="inscrit.php" method="post"><pre>
      Nom                        : <input type="text" name="name"><br>
      Prénom                     : <input type="text" name="firstname"><br>
      Pseudo                     : <input type="text" name="nickname"><br>
      Adresse mail               : <input type="text" name="mail"><br>
      Citation personnelle       : <input type="text" name="quote" value="Que nul n'entre ici s'il n'est géomètre"><br>
      Votre scientifique préféré : <input type="text" name="scientist" value="Descartes"><br>
      Mot de passe               : <input type="password" name="password"><br>
      Confirmez le mot de passe  : <input type="password" name="password2"><br>
      
      				   <input type="submit" value="S'inscrire">
      </pre>
</form>
      
			
		</article>
	
	</section>




<?php
	require_once("pied.php");
	pied();
?>
