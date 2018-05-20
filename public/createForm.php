<?php
include("../src/annonce.php"); 
include("../src/sidebar.php"); 
include("../src/viewfunctions.php");
session_start();

$idToGet = -1;
if (isset($_GET['edit']) && $_GET['edit']) {
    $idToGet = $_GET['edit'];
    $annonce = Annonce::getAnnonceById($idToGet);

    if ($annonce == null || ($_SESSION['username'] != $annonce->op && !$_SESSION['admin'])) {
	header("Refresh:0; url=createForm.php");
	exit();
    }
}

header_t("Create Annonce");

dispSidebar();
?>

<div class="main">
    <h2>Créer une annonce</h2>
    <div class="annonce">
<?php ($idToGet!=-1?displayFormCreate($annonce):displayFormCreate()); ?>
    </div>
<?php Annonce::status(); ?>
</div>

<?php footer(); ?>
