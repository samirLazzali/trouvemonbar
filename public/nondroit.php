<?php
//include("authentication.php");
include("../src/viewfunctions.php");
include("../src/annonce.php");
include("../src/sidebar.php");
session_start();
login();

header_t("Les Bons Bails");
if(!verif_authent()) { // si le gars est authentified ==>  acces aux offres
    displayLogin();
}
if(verif_authent())
{
	dispSidebar();

}
//dispSidebar();
?>

<div class="main">

<div class=annonce>
    <div class=errorimg> <img src="https://s2.qwant.com/thumbr/0x0/d/3/476c64f30da915f49e82e6cc5c90a4fb7dffb9a2951106386de84ee281a3ac/erroricon1.png?u=https%3A%2F%2Fblog.sqlauthority.com%2Fwp-content%2Fuploads%2F2016%2F01%2Ferroricon1.png&q=0&b=1&p=0&a=1" alt="error could not show img"> </div>
	<div class=title style="text-align:center;"> <strong> UNABLE TO ACCESS QUERY </strong>
	</div>
	<div> 
		<br>
		Sorry, the content you're trying to access is unavailable.
		<br>
		<br>
		You probably don't have the required rights to access them.
		<br>
		<a href="main.php"><strong> Go Back </strong></a>
		<br>
	</div>
</div>

</div>

<?php
footer();
?>
