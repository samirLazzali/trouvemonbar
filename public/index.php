<?php

//session_start();

require 'recomandation.php';



if (isset($_SESSION['ok'])) {

    if ($_SESSION['ok'] == -1) {
        echo '<script type="text/javascript" language="javascript">
        var temp = "Vous n\'etes pas connecté.. Réessayez !";
        alert(temp);
        </script>';
        $_SESSION['ok'] = 1;
    }
    else if ($_SESSION['ok'] == 0) {
        echo '<script type="text/javascript" language="javascript">
        var temp = "Vous etes connecté";
        alert(temp);
        </script>';
        $_SESSION['ok'] =  1;
    }
}


if (isset($_SESSION['login'])) {

    $nom = $_SESSION['login'];

}
else {
    $nom = "boloss";
}

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Manger pas cher</title>
	<link rel="stylesheet" href="style.css"/>
    <form action="Recherche_Produit.php" method="post">
    </head>
  
<body>
<div class = "corps">
	

<header id = "tete">
	<div class = "logo"><a href="index.php"><img src="../img/logo/logo.png" alt="logo_manger_pas_cher" class="logo"/></a></div>


	<div class = "phrase_accroche"><p class = "phrase_accroche"><a href="index.php" class="phrase_approche">Une autre vision de la consommation </a></p></div>

	<div class = "espace_commercant">
		<div class = "espace_commercants">	
				<a href="espace_commercants.php" class="espace_commercants"> Espace Commercants </a>
		</div>
		<div class = "espace_commercants">	
				<a href="espace_admin.php" class="espace_commercants"> Espace Administrateur </a>
		</div>
	</div>
</header>

<section class="sticky">
	<div class = "recherche_produit">
		<!--<div class="recherche_produit_text">
			Rechercher un produit: 
		</div>-->

        <div class="recherche_produit_form">
			<input type="text" size="30" maxlength="15" value="De quoi avez vous envie aujourd'hui?" name="recherche_produit" />
		</div>

        <!--<div class="recherche_produit_photo">
			<a href="#10"><img src="../img/recherche/recherche.png"/></a>
		</div>-->
        <div class="recherche_produit_photo">
            <input type="submit">
        </div>
	</div>

	
	
	<div class = "mon_panier">
		<div class="mon_compte_photo">
			<label class="bouton" for="panier"><img src="../img/compte/panier.png" alt="image_panier"/></label>
		</div>

		<div class="mon_compte_text">
			<p class = "mon_compte"> <label class="bouton" for="panier"> Mon Panier ▼ </label>
			</p>
		</div>
		<input type="checkbox" id="panier" />
	<div id="pop_panier"> 
		<ul>
			<li> <a class= "liste_panier" href= "Finaliser_Panier.php">Afficher mon panier</a>		</li>
			<li> <a class= "liste_panier" href= "Ensemble_de_Produit.php">Ajouter un produit	 </a>		</li>
			<li> <a class= "liste_panier" href= "Supp_Total_Panier.html">Supprimer mon Panier	</a>		</li>
		</ul>
	</div>
		
	</div>

	

	<div class = "mon_compte">
		<div class="mon_compte_photo">
			<label class="bouton" for="compte"><img src="../img/compte/mon_compte.png" alt="image_compte"/></label>
		</div>
		<div class="mon_compte_text">
			<p class = "mon_compte"> <!-- Bonjour,<?php echo $nom; ?> --> <label class="bouton" for="compte"> Mon Compte ▼ </label>
			</p>
		</div>
		<input type="checkbox" id="compte" />
		<div id="pop_compte"> 
			<ul>


				<li> <a class= "liste_panier" href= "Connexion.html">Connexion</a>		</li>
				<li> <a class= "liste_panier" href= "Affiche_Compte.php">Afficher mon Compte	 </a>		</li>
				<li> <a class= "liste_panier" href= "Modifier_mdp.html">Modifier Mot de Passe	</a>		</li>
				<li> <a class= "liste_panier" href= "Deconnexion.php" > Déconnexion  </a> </li>
			</ul>
	</div>
</section>



<nav id = "menu">
	<ul class = "menu">

		<div class= "menu"><a href="index.php" class="menu"> <li class = "menu"> ACCUEIL </li></a> </div>
		<div class= "menu"> <a href="Ensemble_de_Produit.php" class="menu"><li class = "menu">ARTICLES </li> </a></div>
        <div class= "menu"><a href="Compte.html" class="menu"><li class = "menu"> INSCRIVEZ-VOUS </li> </a></div>
		<div class= "menu"><a href="Connexion.html" class="menu"> <li class = "menu"> CONNECTEZ-VOUS  </li></a></div>
		<div class= "menu_deconnexion"> <a href="Deconnexion.php" class="menu"><li class = "menu">  DECONNEXION</li></a> </div>
	</ul>
</nav>


 <section class = "corp">
	<article class = "presentation">
		<h1>Qui sommes-nous ?</h1>
		<p>Nous sommes une organisation luttant contre la vie cher et le gaspillage crée par des étudiants engagés et reponsables.</p>
		<h1>Nos ambitions</h1>
		<p>Offrir à nos clients une alternative économique et écologique pour leurs achats alimentaires. Grâce à nous, ils pourront faire leurs courses en ligne, dans leurs enseignes favorites tout en ayant des réductions incroyables.</p>
		<h1>Que faisons-nous ?</h1>
		<p>Cette plate-forme permet à nos clients d'acheter en ligne des produits qui vont atteindre leur date de péremption à des prix plus bas que d'habitude. Tous nos produits sont proposés par des enseignes qui sont en partenariat avec nous. De plus, on propose un système de livraison gratuit.</p>
	</article>

	<aside class = "pubs">
		<div id="pub1" class = "pub1">
			<div class="js-iabbanner-class-receiver cd-iabbanner-class-receiver">
				<a href="https://courses-en-ligne.carrefour.fr/aux-petits-oignons" target="_blank" class="google-event" data-glaction="ecommerce" data-gldata="{&quot;ecommerce&quot;:&quot;promo_click&quot;,&quot;campaign_code&quot;:&quot;api_cms&quot;,&quot;campaign_name&quot;:&quot;ac_apo_bottom1_hp_2018&quot;,&quot;campaign_position&quot;:&quot;bottom1&quot;}">
				<img src="https://static7.portal.carrefour.fr/sites/default/files/2018-04/encart_desktop_arbo_apo_n_2017_drive.jpg" alt="encart_desktop_arbo_apo_n_2017_drive.jpg" class="js-iabbanner-class-receiver">
				</a>
    		</div>
		</div>
		<div id="pub2" class = "pub2">
		<div class="js-iabbanner-class-receiver cd-iabbanner-class-receiver">
            <a href="https://courses-en-ligne.carrefour.fr/edito/pikit" target="_self" class="google-event" data-glaction="ecommerce" data-gldata="{&quot;ecommerce&quot;:&quot;promo_click&quot;,&quot;campaign_code&quot;:&quot;api_cms&quot;,&quot;campaign_name&quot;:&quot;ac_pikit_bottom2_201804_m_s14&quot;,&quot;campaign_position&quot;:&quot;bottom2&quot;}">
            <img src="https://static7.portal.carrefour.fr/sites/default/files/2018-05/encart_desktop_pikit_generique.png" alt="encart_desktop_pikit_generique.png" class="js-iabbanner-class-receiver">
        	</a>
    </div>
		</div>
	</aside>
	
	<article id="carrousel">
	   <ul>
	   		<?php

            if (isset($_SESSION['produit_1']) && isset($_SESSION['produit_2']) && isset($_SESSION['produit_3']) && isset($_SESSION['produit_4']) && isset($_SESSION['produit_5'])) {
                $dbName = getenv('DB_NAME');
                $dbUser = getenv('DB_USER');
                $dbPassword = getenv('DB_PASSWORD');
                $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

                $p1 = $_SESSION['produit_1'];
                $p2 = $_SESSION['produit_2'];
                $p3 = $_SESSION['produit_3'];
                $p4 = $_SESSION['produit_4'];
                $p5 = $_SESSION['produit_5'];

                $rep = $connection->query("SELECT id_produit, categorie, marque, prix, date_de_peremption, reduction, quantite, image  FROM Produit WHERE id_produit = '$p1' 
																																					OR id_produit = '$p2'
																																					OR id_produit = '$p3'
																																					OR id_produit = '$p4'
																																					OR id_produit = '$p5'
																																					")->fetchAll();

                foreach ($rep as $data) {
                    $reduc = $data['reduction'] * 100 / $data['prix'];
                    $reduc = (floor($reduc * 10)) / 10;
                    echo '<li><figure><a href="Ensemble_de_Produit.php"><img class = "imgfig" src=' . $data['image'] . ' alt="photo" height=200 width=300 /><figcaption>-' . $reduc . '%</figcaption></a></figure></li>';
                }

            }
	   		?>
	       
	    </ul>
	    <button name="button" class="carrousel_btn prev"><h1><</h1></button>
		<button name="button" class="carrousel_btn next"><h1>></h1></button>
	</article>
	
  	
</section>

<footer>
	<ul class = "footer">
		<h4 class = "footer">Auteurs</h4>
		<li>Myr</li>
		<li>Téka</li>
		<li>Bode</li>
		<li>Grominet</li>
	</ul>
</footer>

</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){

	var $carrousel = $('#carrousel'), 
	    $fig = $('#carrousel figure'), 
	    indexfig = $fig.length - 1, 
	    i = 0, 
	    $currentfig = $fig.eq(i); 

	$fig.css('display', 'none'); 
	$currentfig.css('display', 'block'); 


	$('.next').click(function(){ 

	    i++; 

	    if( i <= indexfig ){
	        $fig.css('display', 'none'); 
	        $currentfig = $fig.eq(i); 
	        $currentfig.css('display', 'block'); 
	    }
	    else{
	        // i = indexfig;
	        i = 0;
	        $fig.css('display', 'none'); 
	        $currentfig = $fig.eq(i); 
	        $currentfig.css('display', 'block'); 
	    }
	    return false;
	});

	$('.prev').click(function(){ 

	    i--; 

	    if( i >= 0 ){
	        $fig.css('display', 'none');
	        $currentfig = $fig.eq(i);
	        $currentfig.css('display', 'block');
	    }
	    else{
	        // i = 0;
	        i = indexfig;
	        $fig.css('display', 'none'); 
	        $currentfig = $fig.eq(i); 
	        $currentfig.css('display', 'block'); 
	    }
	    return false;

	});

	function slidefig(){
	    setTimeout(function(){ 
							
	        if(i < indexfig){ 
		    i++; 
		}
		else{ 
		    i = 0;
		}

		$fig.css('display', 'none');

		$currentfig = $fig.eq(i);
		$currentfig.css('display', 'block');

		slidefig(); 

	    }, 7000); 
	}

	slidefig(); 

	});
</script>


</body>
</html>



