<?php
	require_once 'en_tete.php';
	en_tete();
  require __DIR__ . '/database.php';

function getLivreList(){
  $db = DB();
  $query = $db->query('SELECT * FROM "Livre"');
  while($livre = $query->fetch()){
    $Author[] = $livre['auteur'];
    $Title[] = $livre['titre'];
    $Disponibilite[] = $livre['disponibilite'];
  }
  return [$Author, $Title, $Disponibilite];
}

function getLivreListCon($nom){
  $db = DB();
  $query = $db->query('SELECT * FROM "Livre" WHERE auteur='."'"."$nom"."'".' OR titre='."'"."$nom"."'");
  while($livre = $query->fetch()){
    $Author[] = $livre['auteur'];
    $Title[] = $livre['titre'];
    $Disponibilite[] = $livre['disponibilite'];
  }
  return [$Author, $Title, $Disponibilite];
}

function printL($T){
  echo "<ul>";
  $n = count($T);
  for($i=0; $i<$n; $i++){
    echo "<li>";
    for($j=0; $j<count($T[$i]); $j++){
      echo $T[$i][$j]." - ";
    }
    echo "</li>";
  }
  echo "</ul>";
}
?>

	<section>
		
		<aside>
		
		</aside>
			
		<article>		
			<h1>Affichage de la bibliothèque</h1>







			<!-- Mise en place du formulaire -->


			

			    

			<!-- Là où on affiche les suggestions...  -->

			<p>Suggestions : <span id="nameHint"></span></p>
      <form action="bibliotheque.php" method="POST">
        <input type = "text" name = "nom" placeholder="Titre ou auteur">
        <input type="submit" name = "btnValider">
        <?php
        if(isset($_POST['btnValider'])){
          $T = getLivreListCon($_POST['nom']);
          printL($T);
        }
        ?>
      </form>

			    

			<!-- Bouton pour afficher ce que l\'on souhaite voir de la base  -->
      <form action="bibliotheque.php" method="POST">
        <input type = "submit" name = "btnAfficher" value="Afficher tous les livres">
        <?php
        if(isset($_POST['btnAfficher'])){
          $T = getLivreList();
          printL($T);
        }
        ?>
      </form>
			<!-- <p id="reponse" style="display:none">Hello JavaScript!</p> -->
			<!-- <p id="reponse" style="display:none" onkeyup="loadDoc(auteur)" ></p> -->

			    
			    
			<p id="publist"> </p>



		</article>
	
	</section>
    
<?php
	require_once 'pied.php';
  	pied();

