<?php
session_start();
include("../src/annonce.php"); 
include("../src/viewfunctions.php");

header_t("Create Annonce");
?>

<div class="main">
    <div class="annonce">
	<div class="title">
	    <i class="fas fa-arrow-circle-down"></i> CREATE ANNOUNCEMENT
	</div>
<?php displayFormCreate(); ?>
    </div>
</div>

<script type="text/javascript">
  togglecacher();
</script>

<?php
	    footer();
	    ?>
