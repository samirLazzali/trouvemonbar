<?php
/*$sujet = "Mail du site";
$message = $_POST['mess'];
$destinataire = 'mickael.ferreri@orange.fr';
$headers = "From: \"mickael.ferreri@laposte.com \"<mickael.ferreri@laposte.com >\n";
$headers .= "Reply-To: mickael.ferreri@orange.fr\n";
$headers .= "Content-Type: text/plain; charset=\"iso-8859-1\"";
if(mail($destinataire,$sujet,$message,$headers))
{
    echo "L'e-mail a bien été envoyé.";
}
else
{
    echo "Une erreur d'envoi.";
}*/
include("Vue.php");
include "entete.php";
bandeau();

$mail = 'mickael.ferreri@laposte.com'; // Déclaration de l'adresse de destination.

if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui présentent des bogues.

{

    $passage_ligne = "\r\n";

}

else

{

    $passage_ligne = "\n";

}

//=====Déclaration des messages au format texte et au format HTML.

$message_txt = "Salut à tous, voici un e-mail envoyé par un script PHP.";

$message_html = "<html><head></head><body><b>Salut à tous</b>, voici un e-mail envoyé par un <i>script PHP</i>.</body></html>";

//==========




//=====Création de la boundary.

$boundary = "-----=".md5(rand());

$boundary_alt = "-----=".md5(rand());

//==========



//=====Définition du sujet.

$sujet = "Hey mon ami !";

//=========



//=====Création du header de l'e-mail.

$header = "From: \"SiteBdA\"<mickael.ferreri@orange.fr>".$passage_ligne;

$header.= "Reply-to: \"SiteBdA\" <mickael.ferreri@orange.fr>".$passage_ligne;

$header.= "MIME-Version: 1.0".$passage_ligne;

$header.= "Content-Type: multipart/mixed;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;

//==========



//=====Création du message.

$message = $passage_ligne."--".$boundary.$passage_ligne;

$message.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary_alt\"".$passage_ligne;

$message.= $passage_ligne."--".$boundary_alt.$passage_ligne;

//=====Ajout du message au format texte.

$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;

$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;

$message.= $passage_ligne.$message_txt.$passage_ligne;

//==========



$message.= $passage_ligne."--".$boundary_alt.$passage_ligne;



//=====Ajout du message au format HTML.

$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;

$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;

$message.= $passage_ligne.$message_html.$passage_ligne;

//==========



//=====On ferme la boundary alternative.

$message.= $passage_ligne."--".$boundary_alt."--".$passage_ligne;

//==========







$message.= $passage_ligne."--".$boundary.$passage_ligne;



//=====Envoi de l'e-mail.
if(mail($mail,$sujet,$message,$header))
{
    echo "L'e-mail a bien été envoyé.";
}
else
{
    echo "Une erreur d'envoi.";
}



//==========
echo'
<p>
    <a href= "index.php"  > Menu </a>
</p>';

pied();
?>