<?php
/**
 * Liste des membres
 *
 * PHP Version 7.0
 *
 * @category Membre
 * @package  Public
 * @author   Eric COLONIA <ercol@outlook.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     localhost:8080/membre.php
 */

 require_once "identite.php";
?>

<html>
    <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="membre.css" />
    </head>
    <body>
<a href="index.php"> <img style="max-width : 200px;" src="logo_text.png" alt="baka" /> </a>
    <div class="membre">
<?php
$i=0;
$strParams=['\'' => '&#39'];
global $connection;
$requete="Select * from membre_emprunt; ";
$exe= new Execute($connection);
$rows=$exe->exec_sql($requete);
echo"<table id='table_manga'> 
        <tr id='table-header' style='font-size : 20px;height : 50px;'>
        <th style='background-color : #9ACD32;text-align : center ;
 vertical-align : middle ; width : 30%;'> Voici la liste des membres!
</th>
        </tr>
        <tbody>";
foreach($rows as $row) :
    if ($i%2==0) {
        echo " 
				<tr>
		<td style=' background-color : #7FFFD4;vertical-align : middle;
		' title='membre' class='membre' >".$row->pseudo." 
			<div class='bouton'> 
		<a href='profil.php?membre=".strtr($row->pseudo, $strParams)."'> Voir le profil  </a> 
</div> 
</td>
		</tr>";
        $i++;
    } else {
        echo " 
				<tr>
		<td style=' font-family : Open Sans, sans-serif;
vertical-align : middle;' title='membre' class='membre' >".$row->pseudo." 
		<div class='bouton'> 
<a href='profil.php?membre=".strtr($row->pseudo, $strParams)."'> Voir le profil  </a> 
</div> 
</td>
		</tr>";
        $i++;
    }
endforeach;
echo"</tbody>";
echo "</table>";
 
?>

</div>
<a href="index.php> Revenir à l'index </a>


</body>
</html>
