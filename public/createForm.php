<?php
include("../src/annonce.php"); 
include("../src/sidebar.php"); 
include("../src/viewfunctions.php");
session_start();

if (isset($_GET['edit']) && $_GET['edit']) {
    $idToGet = $_GET['edit'];
    $annonce = Annonce::getAnnonceById($idToGet);

    if ($_SESSION['username'] != $annonce->op && !isset($_SESSION['admin']));
}

header_t("Create Annonce");

dispSidebar();
?>

<div class="main">
    <h2>Créer une annonce</h2>
    <div class="annonce">
<?php (isset($idToGet)?displayFormCreate($annonce):displayFormCreate()); ?>
    </div>
<?php Annonce::status(); ?>
</div>

<?php footer(); ?>
