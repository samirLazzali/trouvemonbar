<?php
//menu de navigation
if(isset($_POST['acc']) AND ($_POST['acc'] == 'Accueil')) { header("location:index.php"); }
if(isset($_POST['ap']) AND ($_POST['ap'] == 'Apéral')) { header("location:a_propos_aperal.php"); }
if(isset($_POST['oe']) AND ($_POST['oe'] == 'Oenologiie')) { header("location:a_propos_oeno.php"); }
if(isset($_POST['reu']) AND ($_POST['reu'] == 'Réunion')) { header("location:reunion.php"); }
if(isset($_POST['clas']) AND ($_POST['clas'] == 'Classement')) { header("location:classement.php"); }
if(isset($_POST['adm']) AND ($_POST['adm'] == 'Admin')) { header("location:Admin.php"); }

//menu connection
if(isset($_POST['co']) AND ($_POST['co'] == "Se connecter")) { header("location:connexion.php"); }
if(isset($_POST['ins']) AND ($_POST['ins'] == "inscription")) {header("location:inscription.php"); }

//sous_menu aperal
if(isset($_POST['propA']) AND ($_POST['propA'] == "A propos")) { header("location:a_propos_aperal.php"); }
if(isset($_POST['prepA']) AND ($_POST['prepA'] == "Préparatif")) { header("location:preparatif_aperal.php"); }
if(isset($_POST['rec']) AND ($_POST['rec'] == "Recettes")) { header("location:recette.php"); }
if(isset($_POST['inta']) AND ($_POST['inta'] == "Intendance")) { header("location:intendance.php"); }
if(isset($_POST['ava']) AND ($_POST['ava'] == "Avis")) { header("location:avis_aperal.php"); }


//sous_menu_oenologie
if(isset($_POST['propO']) AND ($_POST['propO'] == "A propos")) { header("location:a_propos_oeno.php"); }
if(isset($_POST['prepO']) AND ($_POST['prepO'] == "Préparatif")) { header("location:preparatif_oeno.php"); }
if(isset($_POST['avO']) AND ($_POST['avO'] == "Avis")) { header("location:avis_oeno.php"); }
if(isset($_POST['vin']) AND ($_POST['vin'] == "Liste des vins")) { header("location:liste_des_vins.php"); }