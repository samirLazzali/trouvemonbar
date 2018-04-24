<?php
echo 'ca marche 1';
?>


<html>
<head>
    <title> Acceuil  </title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"  href="style_index.css">
</head>
<body>
<form method="post" action="changement_de_page.php" id="menu_bouton">
    <div classe="bouton"><input type="submit" name="acc" value="Accueil" ></div>
    <div classe="bouton"><input type="submit" name="ap" value="Apéral" ></div>
    <div classe="bouton"><input type="submit" name="oe" value="Oenologiie" ></div>
    <div classe="bouton"><input type="submit" name="reu" value="Réunion" ></div>
    <div classe="bouton"><input type="submit" name="clas" value="Classement" ></div>
    <div classe="bouton"><input type="submit" name="adm" value="Admin" ></div>
</form>
