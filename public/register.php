<?php
require_once "fonctions.php";
page_top("Filigrane | Inscription")
?>

	<div class="row">
		<div class="column side" id="left_col" style="background-color:#000000;"><img src="Pictures/Sidebar_1.png"></div>
	
		<div class="column middle" style="background-color:#bbb;">
			
			<h1>Inscription</h1>

			<form action="registercheck.php" method="POST">
				<div class="form-group">
					<label for="">Pseudo</label>
					<input type="text" name="username" class="form-control" required/>

				</div>

				<div class="form-group">
					<label for="">Mail</label>
					<input type="text" name="email" class="form-control" required/>

				</div>

				<div class="form-group">
					<label for="">Mot de Passe</label>
					<input type="password" name="password" class="form-control" required/>

				</div>


				<div class="form-group">
					<label for="">Confirmer votre mot de passe</label>
					<input type="password" name="password_confirm" class="form-control" required/>

				</div>

				<button type="submit" class="btn btn-primary">M'inscrire</button>
			</form>
		</div>
			
		<div class="column side" id="right_col" style="background-color:#000000;"><img src="Pictures/Sidebar_2.png"></div>
	</div>

	<div class="footer">
		<p>"Les decks contrôle ne sont qu'une illusion" - Karn, 2018</p>
	</div>
	
    </body>
</html>












