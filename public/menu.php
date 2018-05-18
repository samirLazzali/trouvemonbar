<?php
function menu_navigation()
{
    echo '<nav class="gtco-nav" role="navigation">';
    echo '<div class="gtco-container">';
    echo '<div class="row">';
    echo '<div class="col-sm-4 col-xs-12">';
    echo '<div id="gtco-logo"><a href="index.html">Apéral <em>-</em> Oenologiie</a></div>';
    echo '</div>';
    echo '<div class="col-xs-8 text-right menu-1">';
    echo '<ul>';
    echo '<li><a href="index.php">Accueil</a></li>';
    echo '<li><a href="a_propos_aperal.php">Apéral</a></li>';
    echo '<li><a href="a_propos_oeno.php">Oenologiie</a></li>';
    echo '<li><a href="reunion.php">Réunions</a></li>';
    echo '<li><a href="classement.php">Classement</a></li>';
    echo '<li><a href="profil.php">Profil</a></li>';
    echo '<li><a href="admin.php">Admin</a></li>';
    echo '<li class="btn-cta"><a href="inscription.php"><span>S\'inscrire</span></a></li>';
    echo '<li class="btn-cta"><a href="connexion.php"><span>Se connecter</span></a></li>';
    echo '</ul>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</nav>';
}

function menu_connexion(){
}

function sous_menu_aperal(){
    /* echo '<form method = "post" class="sous_menu" action ="changement_de_page.php" id="boutons_aperal">';
    echo '<div class="bouton"><input type="submit" class="button" name="propA" value="A propos" ></div>';
    echo '<div class="bouton"><input type="submit" class="button" name="prepA" value="Préparatif" ></div>';
    echo '<div class="bouton"><input type="submit" class="button" name="rec" value="Recettes" ></div>';
    echo '<div class="bouton"><input type="submit" class="button" name="inta" value="Intendance" ></div>';
    echo '<div class="bouton"><input type="submit" class="button" name="ava" value="Avis" ></div>';
    echo '</form>'; */
    echo '<nav class="gtco-nav" role="navigation">';
    echo '<div class="gtco-container">';
    echo '<div class="row">';
    echo '<div class="col-sm-4 col-xs-12">';
    echo '<div id="gtco-logo"><a href="index.html">Apéral <em>-</em> Oenologiie</a></div>';
    echo '</div>';
    echo '<div class="col-xs-8 text-right menu-1">';
    echo '<ul>';
    echo '<li><a href="index.php">Accueil</a></li>';
    echo '<li><a href="a_propos_aperal.php">Apéral</a></li>';
    echo '<li><a href="a_propos_oeno.php">Oenologiie</a></li>';
    echo '<li><a href="reunion.php">Réunions</a></li>';
    echo '<li><a href="classement.php">Classement</a></li>';
    echo '<li><a href="profil.php">Profil</a></li>';
    echo '<li><a href="admin.php">Admin</a></li>';
    echo '<li class="btn-cta"><a href="inscription.php"><span>S\'inscrire</span></a></li>';
    echo '<li class="btn-cta"><a href="connexion.php"><span>Se connecter</span></a></li>';
    echo '</ul>';
    echo '</div>';
    echo '</div>';
    echo '</div>';

    echo '<div class="row2">';
    echo '<div class="col-xs-8 text-right menu-1">';
    echo '<ul>';
    echo '<li><a href="index.php">Nique</a></li>';
    echo '<li><a href="a_propos_aperal.php">les</a></li>';
    echo '<li><a href="a_propos_oeno.php">pd</a></li>';
    echo '<li><a href="reunion.php">Réunions</a></li>';
    echo '<li><a href="classement.php">Classement</a></li>';
    echo '</ul>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</nav>';

}

function sous_menu_oenologie(){
    /* echo '<form method = "post" class="sous_menu" action ="changement_de_page.php" id="boutons_aperal">';
    echo '<div class="bouton"><input type="submit" class="button" name="propO" value="A propos" ></div>';
    echo '<div class="bouton"><input type="submit" class="button" name="prepO" value="Préparatif" ></div>';
    echo '<div class="bouton"><input type="submit" class="button" name="avO" value="Avis" ></div>';
    echo '<div class="bouton"><input type="submit" class="button" name="vin" value="Liste des vins" ></div>';
    echo '</form>'; */
    echo '<nav class="gtco-nav" role="navigation">';
        echo '<div class="gtco-container">';
        echo '<div class="row">';
	        echo '<div class="col-sm-4 col-xs-12">';
	        echo '<div id="gtco-logo"><a href="index.html">Apéral <em>-</em> Oenologiie</a></div>';
		            echo '</div>';
		            echo '<div class="col-xs-8 text-right menu-1">';
			                    echo '<ul>';
			                    echo '<li><a href="index.php">Accueil</a></li>';
					                        echo '<li><a href="a_propos_aperal.php">Apéral</a></li>';
					                        echo '<li><a href="a_propos_oeno.php">Oenologiie</a></li>';
								                        echo '<li><a href="reunion.php">Réunions</a></li>';
								                        echo '<li><a href="classement.php">Classement</a></li>';
											                            echo '<li><a href="profil.php">Profil</a></li>';
											                            echo '<li><a href="admin.php">Admin</a></li>';
														                                    echo '<li class="btn-cta"><a href="inscription.php"><span>S\'inscrire</span></a></li>';
														                                    echo '<li class="btn-cta"><a href="connexion.php"><span>Se connecter</span></a></li>';
																		                                        echo '</ul>';
        echo '</div>';
    cho '</div>';
	echo '</div>';

																												    echo '<div class="row2">';
																												    echo '<div class="col-xs-8 text-right menu-1">';
																												        echo '<ul>';
																												        echo '<li><a href="index.php">Nique</a></li>';
																													    echo '<li><a href="a_propos_aperal.php">les</a></li>';
																													    echo '<li><a href="a_propos_oeno.php">pd</a></li>';
																													        echo '<li><a href="reunion.php">Réunions</a></li>';
																													        echo '<li><a href="classement.php">Classement</a></li>';
																														    echo '</ul>';
																														    echo '</div>';
																														        echo '</div>';
																														        echo '</div>';
																															    echo '</nav>';

}
