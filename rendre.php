<?php
/**
 * Rendre un manga
 *
 * PHP Version 7.0
 *
 * @category Manga
 * @package  Public
 * @author   Eric COLONIA <ercol@outlook.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     localhost:8080/rendre.php
 */
require "identite.php";
$req="Select * from Membre_emprunt where pseudo='$_SESSION[login]';";
global $connection;
$exe= new Execute($connection);
$rows=$exe->exec_sql($req);

foreach($rows as $row):
    $req="Select code from media where dernEmprunteur='$row->id'; ";
endforeach;
$rows=$exe->exec_sql($req);
foreach($rows as $row) :
    $req="UPDATE media SET dispoOuiNon ='oui' Where code='$row->code'; ";
    $exe->exec_sql($req);
    $req="UPDATE media SET dernEmprunteur=null where code='$row->code'; ";
    $exe->exec_sql($req);
endforeach;

echo "<script> 
				window.location.replace('index.php?rendu')
</script>";
exit();
?>
</html>



