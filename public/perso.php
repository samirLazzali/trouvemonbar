<?php
//include("authentication.php");
include("../src/viewfunctions.php");
include("../src/annonce.php");
include("../src/sidebar.php");

protectAccess();

$username=$_SESSION['username'];
$email=$_SESSION['email'];
$id=$_SESSION['id'];

$connection = dbConnect();
$annonces = Annonce::getAnnonces("SELECT annonce.id,
    annonce.titre,
    annonce.offer,
    annonce.postdate,
    users.username,
    annonce.description,
    annonce.genre,
    annonce.semestre,
    annonce.module,
    annonce.paiement,
    annonce.service FROM (annonce JOIN users ON annonce.op = users.id) WHERE users.username = '$username' ORDER BY postdate DESC LIMIT 10");


header_t("Les Bons Bails");

dispSidebar();
?>

<div class="main">
    <h2>Mon profil</h2>
	<div class="annonce create" id="form_border">
	    <form action="editUser.php" method="post">
	    <input type="number" name="id" style="display: none;" value="<?php print $id; ?>">
	    <div class="field-wrap">
		<label class="active">
		    Surnom<span class="req">*</span>
		</label>
		<input type="text" name="username" required autocomplete="off" value="<?php print $username; ?>">
            </div>
	    <div class="field-wrap">
		<label class="active">
		    Email<span class="req">*</span>
		</label>
		<input type="email" name="email" required autocomplete="off" value="<?php print $email; ?>">
            </div>
	    <div class="field-wrap">
		<label>
		    Nouveau mot de passe<span class="req">*</span>
		</label>
		<input type="password" name="p1" required autocomplete="off" value="">
            </div>
	    <div class="field-wrap">
		<label>
		    Répéter le mot de passe<span class="req">*</span>
		</label>
		<input type="password" name="p2" required autocomplete="off" value="">
            </div>
	    <span class="choice"><input type="submit" name="submit" value="Modifier"></span>
	    </form>
	</div>
    <h2>Mes annonces</h2>
	Annonces Publiées : <strong>  <?php print sizeof($annonces); ?> </strong>
<?php

foreach ($annonces as $an)
    $an->display();
?>

</div>
<script src=js/perso.js></script>

<?php
footer();
?>
