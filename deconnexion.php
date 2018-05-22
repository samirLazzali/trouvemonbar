<?php
session_start();

$_SESSION['login']=null;
$_SESSION['tuple']=array(); // on vide la variable $_SESSION

session_destroy(); // on détruit la session


header('Location: index.html');// on redirige vers l'acceuil

exit;
?>