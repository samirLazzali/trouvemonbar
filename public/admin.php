<?php
include("../src/viewfunctions.php");
include("../src/annonce.php");
include("../src/sidebar.php");
include("../src/user.php");

protectAccess(true);

header_t("Les Bons Bails");

dispSidebar();
?>

<div class="main">
    <h2>Utilisateurs</h2>
    <div class=annonce>
	<?php User::displayAsTable(); ?>
    </div>
</div>

<?php
footer();
?>
