<?php
include("../src/annonce.php"); 
include("../src/sidebar.php"); 
include("../src/viewfunctions.php");
session_start();

header_t("Create Annonce");

dispSidebar();
?>

<div class="main">
    <div class="annonce">
	<div class="title">
	    <i class="fas fa-arrow-circle-down"></i> CREATE ANNOUNCEMENT
	</div>
<?php displayFormCreate(); ?>
    </div>
</div>
</div>

<script type="text/javascript">
togglecacher();
</script>

<?php footer(); ?>
