<?php
include("../src/annonce.php"); 
include("../src/sidebar.php"); 
include("../src/viewfunctions.php");
session_start();

header_t("Create Annonce");

dispSidebar();
?>

<div class="main">
    <h2>Créer une annonce</h2>
    <div class="annonce">
<?php displayFormCreate(); ?>
    </div>
</div>
</div>

<script type="text/javascript">
togglecacher();
</script>

<?php footer(); ?>
