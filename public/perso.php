<?php
//include("authentication.php");
include("../src/viewfunctions.php");
include("../src/annonce.php");
include("../src/sidebar.php");
session_start();
$username=$_SESSION['username'];
$email=$_SESSION['email'];
//$id=$_SESSION["id"]
login();

$connection = dbConnect();
//$id=getId();
$rows = dbQuery($connection,"SELECT id FROM users WHERE username='$username'");

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
		<!-- <br>
		Id : <strong> <?php foreach ($rows as $row) {echo $row->id; }?> </strong>
		<br>
		<br> -->
		<br>

		Username : <strong> <?php echo $username?> </strong>

		<br>
		<br>

		Email : <strong> <?php echo $email?> </strong>
		<br>
		<br>
		
	</div>
</div>

</div>

<?php
footer();
?>