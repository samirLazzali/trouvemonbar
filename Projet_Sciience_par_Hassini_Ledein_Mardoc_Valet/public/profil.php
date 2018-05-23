<?php
	require_once("en_tete.php");
	en_tete();
?>


	<section>
		
		<aside>
		
		</aside>
			
		<article>


			<h1>Profil</h1>
			<h3>Vous pouvez modifier votre profil</h3>
			<p>Vous ne devez pas laisser un champs vide ni mettre de caractères spéciaux !</p>
			<form action="inscrit.php" method="post"><pre>
Nom                        : <input type="text" name="name"><br>
Prénom                     : <input type="text" name="firstname"><br>
Pseudo                     : <input type="text" name="nickname"><br>
Adresse mail               : <input type="text" name="mail"><br>
Citation personnelle       : <input type="text" name="quote" value="Que nul n entre ici s il n est géomètre"><br>
Votre scientifique préféré : <input type="text" name="scientist" value="Descartes"><br>
Mot de passe               : <input type="password" name="password"><br>
Confirmez le mot de passe  : <input type="password" name="password2"><br>
      Avatar                     : <input type="file" name="nom" /><br>
			             <input type="submit" value="Modifier">
			      </pre>
			</form>
			      
			<h1>A l'attention des développeurs :<br>
			      2) il faut vérifier que les mots de passe sont les memes<br>
			      3) empecher les caractères spéciaux ! <br>
			</h1>


		</article>
	
	</section>

       </div> <!-- On quitte le coeur de la page -->

<?php
	require_once("pied.php");
	pied();
?>
