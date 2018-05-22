<?php
try
{
    $db = new PDO('mysql:host=localhost;dbname=golriie', 'root', '');
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}
?>
