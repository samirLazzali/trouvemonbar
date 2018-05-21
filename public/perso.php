<?php
include("../src/viewfunctions.php");
include("../src/annonce.php");
include("../src/sidebar.php");
include("../src/user.php");

protectAccess();

if (isset($_GET['edit']) && $_GET['edit'])
    $id=$_GET['edit'];
else
    $id=$_SESSION['id'];

if (($user = User::getUserById($id)) == null) {
    header("Refresh:0; url=perso.php");
    exit();
}

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
    annonce.service FROM (annonce JOIN users ON annonce.op = users.id) WHERE users.username = '$user->username' ORDER BY postdate DESC LIMIT 10");


header_t("Les Bons Bails");

dispSidebar();
?>

<div class="main">
<h2>Profil de <?php print $user->username; ?></h2>
<?php User::displayUserForm($user, $_SESSION['admin']); ?>
    <h2>Annonces de <?php print $user->username; ?>: <strong><?php print sizeof($annonces); ?></strong> annonce<?php print (sizeof($annonces) == 1?"":"s"); ?> publiée<?php print (sizeof($annonces) == 1?"":"s"); ?></h2>
<?php

foreach ($annonces as $an)
    $an->display();
?>

</div>

<?php
footer();
?>
