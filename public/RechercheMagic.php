<?php
if(session_status()==PHP_SESSION_NONE)
{
    session_start();
}
require_once "fonctions.php";
page_top("Filigrane | Recherche");
?>

	<div class="row">
		<div class="column side" id="left_col" style="background-color:#000000;"><img src="Pictures/Sidebar_1.png"></div>
	
		<div class="column middle" style="background-color:#bbb;">
			<h2>Recherche de cartes</h2>
				<hr/>
				<br/>
				<form action="ResultatRecherche.php" method="post">
            <div class="search" id="search_left">
			Langue :
            <select name="lang">
                <option value="all" selected="selected">Toutes</option>
                <option value="fr">Français</option>
                <option value="en">Anglais</option>
            </select><br/>
            Nom : <input type="text" name="name"/><br/><br/>
            Coût converti : <input type="text" name="cmc" size="1"/><br/>
            <table id="couleur">
                <tr>
                    <td>
                        Couleurs<br/>
                        <input type="checkbox" name="color_W" value="W"/>Blanc<br/>
                        <input type="checkbox" name="color_U" value="U"/>Bleu<br/>
                        <input type="checkbox" name="color_B" value="B"/>Noir<br/>
                        <input type="checkbox" name="color_R" value="R"/>Rouge<br/>
                        <input type="checkbox" name="color_G" value="G"/>Vert<br/>
                        <input type="checkbox" name="color_C" value="C"/>Incolore<br/>
                    </td>
                    <td>
                        Identité couleur<br/>
                        <input type="checkbox" name="identity_W" value="W"/>Blanc<br/>
                        <input type="checkbox" name="identity_U" value="U"/>Bleu<br/>
                        <input type="checkbox" name="identity_B" value="B"/>Noir<br/>
                        <input type="checkbox" name="identity_R" value="R"/>Rouge<br/>
                        <input type="checkbox" name="identity_G" value="G"/>Vert<br/>
                        <input type="checkbox" name="identity_C" value="C"/>Incolore<br/>
                    </td>
                </tr>
            </table>
            </div>
			<div class="search" id="search_right">
			Types / sous-types : <input type="text" name="type"/><br/>
            Extension : <input type="text" name="set"/><br/>
            Rareté :
            <select name="rarity">
                <option value="N">Aucun choix</option>
                <option value="C">Commune</option>
                <option value="U">Inhabituelle</option>
                <option value="R">Rare</option>
                <option value="M">Rare Mythique</option>
                <option value="T">Timeshifted</option>
            </select><br/>
            Capacités : <input type="text" name="ability"/><br/>
            Texte d'ambiance : <input type="text" name="flavor"/><br/>
            Force : <input type="text" name="power" size="1"/>
            Endurance : <input type="text" name="toughness" size="1"/>
            Loyauté : <input type="text" name="loyalty" size="1"/><br/>
            Artiste : <input type="text" name="artist"/><br/>
            <br/>
			</div>
			<div class="search" id="submit_button">
            <input type="submit" value="Recherche"/>
			</div>
		</form>
			</div>
			
			<div class="column side" id="right_col" style="background-color:#000000;"><img src="Pictures/Sidebar_2.png"></div>
		</div>

		<div class="footer">
			<p>"Les decks contrôle ne sont qu'une illusion" - Karn, 2018</p>
		</div>
	
    </body>
</html>



