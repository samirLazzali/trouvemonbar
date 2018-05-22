<?php
session_start();
?>

<html>
<link rel="stylesheet" href="main.css" type="text/css">
	<body>
		<header>
		<h1>PinTutu</h1>
		<div class="parametre">
		<form action="parametres.php" formethod="post">
		<input type="submit" name="Paramètres" value="parametre"/>
		</form>
            <form action="ajout.php" formethod="post">
                <input type="submit" name="ajout" value="Ajouter du contenu"/>
            </form>
		</div>
		</header>
		<?php


		if (isset($_SESSION['identifiant'])) {

            echo '<main>
			<aside>
			<h2>Choix des tags</h2>
			<p>
			<form action="main.php" formmethod="post">
				Animaux: <input type="checkbox" name="animaux" value="animaux"/></br>
				Mélancolique: <input type="checkbox" name="melancolique" value="melancolique"/></br>
                Drôle: <input type="checkbox" name="drole" value="drole"/></br>
				Paysages: <input type="checkbox" name="paysages" value="paysages"/></br>
				Cuisine: <input type="checkbox" name="cuisine" value="cuisine"/></br>
				Peinture:<input type="checkbox" name="peinture" value="peinture"/></br>
				Sculpture:<input type="checkbox" name="sculpture" value="sculpture"/></br>
				Musique:<input type="checkbox" name="musique" value="musique"/></br>
				Code:<input type="checkbox" name="code" value="code"/></br>
				Troll:<input type="checkbox" name="troll" value="troll"/></br>
				WTF:<input type="checkbox" name="wtf" value="wtf"/></br>
				<input type="submit", value="Rechercher"/>
			</form>
			</p>
			</aside>
			<div class="mosaique">
			<img src="Image/cloud.jpg" alt="image1"/ width="100" height="100">
			<img src="Image/ricarhino.jpg" alt="image2"/width="100" height="100"><br/>
			<img src="Image/oxymore.jpg" alt="image3"/ width="100" height="100">
			<img src="Image/ghhh.jpg" alt="image4"/width="100" height="100"></br>
			<img src="Image/hugal.jpg" alt="image5"/width="100" height="100">
			<img src="Image/clochette.jpg" alt="image6"/width="100" height="100"></br>
			</div>
			</main>';
        }
		else{
			echo 'Session expirée';
			}
		?>
		</body>
<html>
		