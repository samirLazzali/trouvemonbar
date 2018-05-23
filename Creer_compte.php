<?php
$source='https://fonts.googleapis.com/css?family=';
?>
<html>
    <head>
     <meta charset="utf-8">
    <title>Creation de compte</title>
<link href="<?php echo $source; ?>Exo" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="Creer-compte.css">
    </head>
   
<body>
<a href="index.php"> <img style="max-width : 200px;" src="logo_text.png" alt="baka"/> </a>
<div class="mov">
<img style="width : 400px" src="Pics_transparent/Welcome.png" alt="Welcome" />
</div>
<div class="text-center">
<p>
Veuillez remplir ce formulaire pour vous creer un compte
</p>
</div>
<div class="inscription">
<form action="succes.php" method="post">
    <p>
Votre Pseudo : </p>
<input placeholder="Pseudo" style="font-size : 20px;width : 200px;color : brown;"type="text" name="pseudo"/>
<p>
Votre Prenom</p>
<input placeholder="Prenom" style="font-size : 20px;width : 200px;color : brown;"type="text" name="prenom"/>
</br>
<p>Votre nom :</p> 
<input placeholder="Nom"  style="font-size : 20px;width : 200px;color : brown;"type="text" name="nom"/>
</br>
<p>Promo :</p> 
<input placeholder="promotion" style="font-size : 20px;width : 200px;color : brown;"type="text" name="promotion"/>
</br>
<p>Votre mot de passe :</p>
<input placeholder="Password" style="font-size : 20px;width : 200px;color : brown;" type="Password" name="Password"/>
<p></p>
<center>
<input style="color : brown;width : 200px;font-size : 20px;" type="submit" value="Creer"/>
</center>
</p>
</form>
</div>
</body>

</html>
