<?php
// D'abord, je me connecte à la base de données.
mysql_connect("localhost", "root", "");
mysql_select_db("db");

//verfier que le formulaire a été bien rempli
if(!empty($_POST['username']))
{

// D'abord, je me connecte à la base de données.
mysql_connect("localhost", "root", "");
mysql_select_db("db");


$passeword = mysql_real_escape_string(htmlspecialchars($_POST['passeword']));
$passeword_conf = mysql_real_escape_string(htmlspecialchars($_POST['$passeword_conf']));

// Je mets aussi certaines sécurités ici…
if($passeword == $passeword_conf)
{
  $title = mysql_real_escape_string(htmlspecialchars($_POST['title']));
  $username = mysql_real_escape_string(htmlspecialchars($_POST['username']));
  $userprename = mysql_real_escape_string(htmlspecialchars($_POST['userprename']));
  $usermail = mysql_real_escape_string(htmlspecialchars($_POST['usermail']));
  $ville  = mysql_real_escape_string(htmlspecialchars($_POST['ville']));
  $pays  = mysql_real_escape_string(htmlspecialchars($_POST['pays']));

  // Je vais crypter le mot de passe.
$passeword = sha1($passeword);

mysql_query("INSERT INTO utilisateur VALUES('', '$title', '$userpseudo' '$username', '$userprename', '$usermail', '$password' '$ville', '$pays')");
}


else{
echo 'Les deux mots de passe que vous avez rentrés ne correspondent pas…';
}





// Je vais crypter le mot de passe.

$passe = sha1($passe);

?>
}
?>
