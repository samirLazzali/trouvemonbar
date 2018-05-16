<?php
require_once("../config.php");

$SQL = $_POST['SQL'];
try
{
    $db = connect();
    $db->exec($SQL);
}
catch (Exception $e)
{
    echo "Erreur lors de l'exécution.\n";
    echo $SQL . "\n";
    echo $e->getMessage();
}