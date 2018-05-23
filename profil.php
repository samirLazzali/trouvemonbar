<?php
/**
 * Profil
 *
 * PHP Version 7.0
 *
 * @category Identite
 * @package  Public
 * @author   Eric COLONIA <ercol@outlook.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     localhost:8080/profil.php
 */
require "identite.php";
$source='https://fonts.googleapis.com/css?family=';
if (isset($_GET['membre'])) {
    $user=$_GET['membre'];
} else {
    $user=$_SESSION['login'];
}
?>

<html>
<head>
<meta charset="utf-8">
<title> Profil de <?php echo $user; ?>  </title>
<link href="<?php echo $source; ?>Ubuntu" rel="stylesheet"/>
<link href="<?php echo $source; ?>Exo" rel="stylesheet"/>

<link rel="stylesheet" type="text/css" href="profil.css">
</head>

<body>
<h1> Profil de <?php echo $user; ?> </h1>
<div class="ligne_verticale"></div>
<div class="ligne_verticale1"></div>

<div class="profile">
<?php
$strParams=['\'' => '&#39'];
global $connection;
$exe=new Execute($connection);
$req="Select * from Membre_emprunt where pseudo='$user';";
$rows=$exe->exec_sql($req);
foreach($rows as $row):
    echo "Pseudo : ";
    echo $row->pseudo;
    echo "</br>";
    echo"Promotion : ";
    echo $row->promotion;
    echo "</br>";
    echo"Nombre d'emprunt encore autorisées : ";
    echo $row->emprunts_max;
    echo "</br>";
    $requete="Select * from bakabar_logins JOIN membre_emprunt 
		on bakabar_logins.login=membre_emprunt.pseudo 
		where bakabar_logins.login = '$user';";
    $rows=$exe->exec_sql($requete);
    if (sizeof($rows) == 0 && $admin==1) {
        echo "<div class='bouton'> 
		<a href='admin.php?membre=".strtr($user, $strParams)."'> Mettre ".$user."admin?  </a> 
</div>";
    }
endforeach;



?>

</div>


<div class="emprunt">
 
<?php
$reque="Select titre from media where dernEmprunteur=$row->id; ";
$rows=$exe->exec_sql($reque);

if (sizeof($rows)==0) {
    echo "Vous n'avez emprunté aucun manga";

    echo"<div class='trans'>
			<img src='Pics_transparent/Question.png' alt=Question />
		</div>";
} else {
    
    echo "<div class='emprunte'>Les mangas que vous avez empruntés :
<div class='bouton'>
<a href='rendre.php'> Tout rendre </a>

</div> 
</div>";
    $i=0;
    echo"<table>";
    foreach($rows as $row):
        if ($i%2 == 0) {
            echo"	<tr>
	<td style='width : 600px;background-color :grey;'>";
            echo "</br> <center><p style='font-size : large;'>";
            echo $row->titre;
            echo "</p></center>";
            echo"	</td>
		
	</tr>";
            $i++;
        } else {
            echo"	<tr>
	<td style='border : 1px solid grey;'>";
            echo "</br> <center><p style='font-size : large;'>";
            echo $row->titre;
            echo "</p></center>";
            echo"	</td>
		
	</tr>";
            $i++;
        }
    endforeach;
    echo"</table>";
    echo "<div class='trans1'><img style='width : 200px;' src='Pics_transparent/Kakashi.jpg' alt='Kakashi' /></div>";
 

}
?>


</div>



<div class="baka">
<a href="index.php"> <img style="max-width : 200px;"src="logo_text.png" alt="baka"/> </a>

</div>

</body>
</html>
