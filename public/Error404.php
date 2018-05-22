<?php
if(session_status()==PHP_SESSION_NONE)
{
    session_start();
}
require_once "fonctions.php";
page_top("Filigrane | 404");
?>

	<div class="row">
		<div class="column side" id="left_col" style="background-color:#000000;"><img src="Pictures/Sidebar_1.png"></div>
	
		<div class="column middle" style="background-color:#bbb;">
		<h1>Error 404</h1>
		<p>Cette page n'existe pas (encore) !</p>
		</div>
			
		<div class="column side" id="right_col" style="background-color:#000000;"><img src="Pictures/Sidebar_2.png"></div>
	</div>

	<div class="footer">
		<p>"Les decks contrôle ne sont qu'une illusion" - Karn, 2018</p>
	</div>
	
	</body>
</html>