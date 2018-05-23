<?php
/**
 * Rendu bien effectué
 *
 * PHP Version 7.0
 *
 * @category Manga
 * @package  Public
 * @author   Eric COLONIA <ercol@outlook.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     localhost:8080/success.php
 */
require "connexion.php";
$i=1;
global $connection;
$exe =new Execute($connection);
$req="Select max(id) AS max from membre_emprunt ; ";
$rows=$exe->exec_sql($req);
foreach($rows as $row):
    echo "</br>";

    $id=$row->max;
endforeach;
$id++;
$pass=sha1($_POST['Password']);
$exe->insert_membre($id, $_POST['prenom'], $_POST['nom'], $_POST['pseudo'], $_POST['promotion'], $pass);


?>


<html>
<head>
    <title>Succés</title>
    <link rel="stylesheet" type="text/css" href="succes.css">
<meta charset="utf-8">
</head>
<body>
<?php
echo "<script> 
				window.location.replace('index.php?succes')
</script>";
exit;
?>
</body>
</html>
