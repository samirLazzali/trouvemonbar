<?php

function header()
{
	?> <header class="container clearfix">

        <div class="caddie"></div>
        <h1 class="titre">Dans ton caddie !</h1>

        <div onClick="window.location='inscription.php';" class="inscription inscription-1 clearfix">
          <p class="inscription">Inscription</p>
        </div>

        <section onClick="window.location='connexion.php';" class="connexion connexion-1 clearfix">
          <p class="connexion">Connexion</p>
        </section>

        <nav class="menu clearfix">

          <div class="accueil accueil-1 clearfix">
            <p onClick="window.location='index.php';" class="accueil">Accueil</p>
          </div>

          <div onClick="window.location='recette.php';" class="hasard hasard-1 clearfix">
            <div class="hasard">
              <p>Recette au&nbsp;</p>
              <p>hasard</p>
            </div>
          </div>
          
          <div onClick="window.location='catalogue.php';" class="catalogue catalogue-1 clearfix">
            <p class="catalogue">Catalogue</p>
          </div>

          <div onClick="window.location='profil.php';" class="profil profil-1 clearfix">
            <p class="profil">Mon profil</p>
          </div>

        </nav>

      </header>
    <?php
}

function footer ()
{
	?> <footer class="contact clearfix">

        <div class="reseau clearfix">
          <div class="facebook"></div>
          <div class="twitter"></div>
          <div class="discord"></div>
        </div>

        <div class="adresse">
          <p>1, square de la résistance</p>
          <p>91000 Evry</p>
        </div>

      </footer>
    <?php
}

function content ($page_name)
{
	switch ($page_name)
	{
		case (index):
			?>
			<section class="presentation presentation-1 clearfix">
		        <p class="presentation">Ceci est un paragraphe de texte à compléter dès que l'on saura quoi mettre dedans...</p>
		      </section>

		      <section class="engagement clearfix">

		        <h2 class="accroche">Voici encore une zone de texte pour donner nos engagements pour atteindre le CAC 40 !</h2>

		        <div class="container1 clearfix">
		          <h3 class="qualite">Qualité</h3>
		          <p class="text1">Bla bla bla pipo pipo</p>
		        </div>

		        <div class="container2 clearfix">
		          <h3 class="technologie">Technologie</h3>
		          <p class="text2">Bla bla bla pipo pipo</p>
		        </div>

		        <div class="container3 clearfix">
		          <h3 class="service">Service</h3>
		          <p class="text3">Bla bla bla pipo pipo</p>
		        </div>

		    </section>

		    <section class="nouveau nouveau-1 clearfix">

		        <h2 class="nouveau">Nouveauté</h2>

		        <aside class="recette1 recette1-1"></aside>

		        <article class="recette1 recette1-2 clearfix">
		          <h4 class="titre1">Gâteau gourmand aux fruits rouges</h4>
		          <p class="recette1">Voici une délicieuse recette de gâteau aux fruits rouges !</p>
		        </article>

		        <aside class="recette2 recette2-1"></aside>

		        <article class="recette2 recette2-2 clearfix">
		          <h4 class="titre2">La Croziflette</h4>
		          <p class="recette2">Une recette gourmande et originale !</p>
		        </article>

		        <aside class="recette3 recette3-1"></aside>

		        <article class="recette3 recette3-2 clearfix">
		          <h4 class="titre3">Tiramisu</h4>
		          <p class="recette3">Le fameux gâteau italien dans vos assiettes !</p>
		        </article>

		    </section>
		    <?php
		    break;
		case (connexion):
			?>
			<section class="connexion connexion-3 clearfix">

		        <div class="log clearfix">
		          <form action="connexion_post.php" method="POST">
		          <p class="pseudo">Pseudo :</p>
		          <input class="_input _input-1" placeholder="Pseudo" type="text" name="pseudo">
		          <p class="mdp">Mot de passe :</p>
		          <input class="_input _input-2" placeholder="Mot de passe" type="text" name="password">
		          <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Se souvenir de moi?

		          <div class="element"></div>
		          <button type="submit" class="_button">envoyer</button>
		          </form>
		        </div>

		    </section>
		    <?php
		    break;
		case (inscription):
			?>
			<section class="inscription inscription-3 clearfix">

		        <p class="erreur">Texte d'erreur si une donnée rentrée n'est pas correcte.</p>

		        <div class="log clearfix">
		          <form action="inscription_post.php" method="POST">
		          <p class="pseudo">Pseudo :</p>
		          <input class="_input _input-1" placeholder="Pseudo" type="text">
		          <p class="mdp">Mot de passe :</p>
		          <input class="_input _input-2" placeholder="Mot de passe" type="text">
		          <p class="confirmation confirmation-1">Confirmation :</p>
		          <input class="_input _input-3" placeholder="Mot de passe" type="text">
		          <p class="confirmation confirmation-2">E-mail :</p>
		          <input class="_input _input-4" placeholder="e-mail" type="text">
		          <div class="element"></div>
		          <input type="submit" class="_button">envoyer</button>
		          </form>
		        </div>

		    </section>
		    <?php
		    break;
		case (catalogue):
			?>
			<section class="catalogue catalogue-3 clearfix">
		        <div class="recherche"></div>
		    </section>

		    <p class="recherche recherche-2">Recherche :</p>

		    <input class="_input" placeholder="Nom, Ingrédients, coût, difficulté..." type="text">
		    <button class="_button">Rechercher</button>
		    <?php
		    break;
		case (recette):
			?>
			<section class="recette clearfix">

		        <div class="presentation clearfix">
		          <div class="photo"></div>
		          <h3 class="nom">Nom de la recette</h3>
		          <p class="difficulte">Difficulté :</p>
		          <p class="cout">Coût :</p>
		        </div>

		        <div class="necessaire clearfix">

		          <div class="ingredients"></div>

		          <div class="nom_ingredients clearfix">
		            <p class="course">Liste de course :</p>
		          </div>

		          <div class="liste clearfix">
		            <div class="text">
		              <p>- Mascarpone (250g)</p>
		              <p>- oeufs (4)</p>
		              <p>- Sucre roux (150g)</p>
		              <p>- Biscuits à la cuillère (18)</p>
		              <p>- Nesquik</p>
		              <p>- café noir</p>
		            </div>
		          </div>

		        </div>

		        <div class="description"></div>

		    </section>

		    <p class="description description-2">Description de la réalisation de la recette :</p>
		    <?php
		    break;
		case (profil):
			?>
			<section class="profil profil-3 clearfix">

		        <div class="log clearfix">
		          <div class="avatar"></div>
		          <p class="pseudo">Pseudo profil</p>
		          <p class="mail">e-mail :</p>
		          <p class="mail_bdd">e-mail associé au compte</p>
		          <p class="naissance">date de naissance :</p>
		          <p class="naissance_bdd">date de naissance associée au compte</p>
		          <p class="plat">Plat préféré :</p>
		          <p class="plat_bdd">plat préféré associé au compte</p>
		          <p class="presentation">Petite présentation :</p>
		          <p class="presentation_bdd">Petit texte de présentation pour que les autres puissent nous connaître !</p>
		          <button onClick="window.location='modification_profil.html';" class="_button">Modifier son profil</button>
		        </div>

		    </section>
		    <?php
		    break;
		case (modification_profil):
			?>
			<section class="profil profil-3 clearfix">

		        <p class="text">Message d'erreur si les données rentrées ne sont pas conforme !</p>

		        <div class="log clearfix">
		          <div class="avatar"></div>
		          <p class="pseudo">Pseudo profil</p>
		          <p class="mdp">mot de passe :</p>
		          <input class="_input _input-1" placeholder="Tapez votre mot de passe" type="text">
		          <p class="mail mail-1">Confirmation :</p>
		          <input class="_input _input-2" placeholder="Confirmez votre mot de passe" type="text">
		          <p class="mail mail-2">e-mail :</p>
		          <input class="_input _input-3" placeholder="Nouvel e-mail" type="text">
		          <p class="naissance">date de naissance :</p>
		          <input class="_input _input-4" placeholder="Nouvelle date de naissance" type="text">
		          <p class="plat">Plat préféré :</p>
		          <input class="_input _input-5" placeholder="Nouveau plat préféré" type="text">
		          <p class="presentation">Petite présentation :</p>
		          <input class="_input _input-6" placeholder="Nouvelle présentation" type="text">
		          <button onClick="window.location='modification_profil.html';" class="_button">Modifier son profil</button>
		        </div>

		    </section>
		    <?php
		    break;
		default :
			echo 'Page not found';
			break;

	}
}

?>