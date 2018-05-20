<?php
//include("authentication.php");
include("../src/viewfunctions.php");
include("../src/annonce.php");
include("../src/sidebar.php");
session_start();
$username=$_SESSION['username'];
$email=$_SESSION['email'];
$id=$_SESSION['id'];

$connection = dbConnect();
$rows = dbQuery($connection,"SELECT COUNT(*) AS nb FROM annonce WHERE op='$id'");

header_t("Les Bons Bails");
if(!verif_authent()) { // si le gars est authentified ==>  acces aux offres
    displayLogin();
}

dispSidebar();
?>


<div class="main">

<div class=annonce>
	<div class=title style="text-align:center;"> Mon Profil
	</div>
	<div> 
		<br>

		Username : <strong> <?php echo $username?> </strong>

		<br>
		<br>

		Email : <strong> <?php echo $email?> </strong>
		<br>
		<br>

		Annonces Publiées : <strong>  <?php foreach ($rows as $row) {echo $row->nb; }?> </strong>
		<br>
		<br>
		
	</div>
</div>

</div>

<?php
footer();
?>