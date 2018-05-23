<?php 
/**
 * Page de Connexion
 *
 * PHP Version 7.0
 *
 * @category Connexion
 * @package  Public
 * @author   Eric COLONIA <ercol@outlook.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     localhost:8080/pageconnexion.php
 */
require "identite.php";
$source='https://fonts.googleapis.com/css?family=';

?>

<html>
<head>
<meta charset="utf-8">
<title> Connexion</title>
<link href="<?php echo $source; ?>Exo" rel="stylesheet"/>
<link rel="stylesheet" href="pageconnexion.css">
</head>
<body>

<div class="mot">
<?php 

if (isset($_GET['wronglogin'])) {
    echo"<p> Mauvais login </p>";

}
if (isset($_GET['wrongpass'])) {
    echo"<p> Mauvais mot de passe </p>";
}
if (isset($_GET['Nonconnected'])) {
    echo "Connectez vous pour emprunter ce manga";
}
?>

</div>
<div class="log">
<center  >Authentification </center>
<p style="padding-top:20px;">Login</p> 
<form action=<?php echo" $_SERVER[HTTP_REFERER]"?> method="post">
<input style="font-size:20px;color:blue;width:200px;"type="text" name="login" placeholder='Login'/>
</br>
<p style="padding-top:30px;">Password</p> 
<input style="font-size:20px;color:blue;width:200px;"type="password" name="password" placeholder='Password' />
</br><p style="padding-bottom : 30px;"></p>
<center>
<input style="font-size:20px;color:blue;width:200px;" type="submit" name="Connexion" value ="Connexion"/>
</center>
</form>
</div>
<a href="index.php"> <img style="max-width:200px;"src="logo_text.png" alt="baka"/> </a>

</body>
</html>
