<?php

function dispSidebar() {
    print "<div class=sidebar>";
    print "<h2>Actions</h2>";
    print "<div class=sidenav>";
    print "<br>";
    print "<a class=m-link href=\"perso.php\">Mon Profil</a></br>";
    print "<br>";
    print "<a class=m-link href=\"createForm.php\">Nouvelle annonce</a></br>";
    print "<br>";
    print "<a class=m-link href=\"apropos.php\">A propos</a></br>";
    print "<br>";
    print "<a class=m-link href=\"contact.php\">Contact</a></br>";
    print "<br>";
    if (isset($_SESSION['admin']) && $_SESSION['admin'])
	print "<a class=m-link href=\"admin.php\">Administration</a></br></br>";
    print "</div>";
    print "</div>";
}

?>
