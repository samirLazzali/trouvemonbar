<?php
if(isset($_POST['cac']) AND ($_POST['acc'] == 'Accueil')) { header("location:index.php"); }
if(isset($_POST['ap']) AND ($_POST['ap'] == 'Apéral')) { header("location:a_propos_aperal.php"); }
if(isset($_POST['oe']) AND ($_POST['oe'] == 'Oenologiie')) { header("location:a_propos_oeno.php"); }
if(isset($_POST['reu']) AND ($_POST['reu'] == 'Réunion')) { header("location:oenologie.php"); }
if(isset($_POST['clas']) AND ($_POST['clas'] == 'Classement')) { header("location:classement.php"); }
if(isset($_POST['adm']) AND ($_POST['adm'] == 'Admin')) { header("location:Admin.php"); }