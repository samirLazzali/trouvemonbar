<?php
/**
 * Liste_des_mangas
 *
 * PHP Version 7.0
 *
 * @category Mangas
 * @package  Public
 * @author   Eric COLONIA <ercol@outlook.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     localhost:8080/list_manga.php
 */
require "identite.php";
$source='https://fonts.googleapis.com/css?family=';

?>


<html>
<head>
<title> Liste manga </title>
<meta charset="utf-8">
<link rel="stylesheet" href="list_manga.css" />
<link href="https://fonts.googleapis.com/css?fammily=Ubuntu" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css?fammily=Open+Sans" rel="stylesheet"/>
<link href="<?php echo $source; ?>Exo" rel="stylesheet"/>
</head>
<body>
<?php
$strParams=['\'' => '&#39'];
global $connection;
$req="SELECT distinct serie from media where type='manga' ";
$exe=new Execute($connection);
$rows=$exe->exec_sql($req);
?>
<a href="index.php"> <img style="max-width : 200px;" src="logo_text.png"a alt="baka"/></a>

<table id='table_manga'> 
        <tr id='table-header' style='font-size : 20px;height : 50px;'>
        <th style='background-color : #FF1493;text-align : center ;
 vertical-align : middle ; width : 30%;'> Voici la liste des mangas!
</th>
        </tr>
        <tbody>

<?php
$i=0;
foreach($rows as $row):
    if ($i%2==0) {
        echo " 
				<tr>
		<td style='font-size : 20px;height : 60px; background-color : orange;vertical-align : middle;
' title='manga' class='manga' >".$row->serie." <div class='bouton'> 
		<a href='emprunt.php?titre=".strtr($row->serie, $strParams)."'> Emprunt  </a> 
</div> 
</td>
		</tr>";
        $i++;
    } else {
        echo " 
				<tr>
		<td style=' font-size : 20px;height : 60px;font-family : Open Sans, sans-serif;
vertical-align : middle;' title='manga' class='manga' >".$row->serie." 
		<div class='bouton'> 
<a href='emprunt.php?titre=".strtr($row->serie, $strParams)."'> Emprunt  </a> 
</div> 
</td>
		</tr>";
        $i++;
    }
endforeach;



echo"</tbody>";
echo "</table>";
 
?>

</body>

</html>

