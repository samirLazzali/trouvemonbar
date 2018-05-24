<?php
/**
 * Created by PhpStorm.
 * User: mickael
 * Date: 24/04/18
 * Time: 15:36
 */
include ("Vue.php");
include "entete.php";
bandeau();
enTete("Presentation du bureau");
affiche_info("President: Rainman");
affiche_info("Vice-president: Oxymore");
affiche_info("Sec' Gen: LDG");
affiche_info("Trez: Murlock");
?>


    <input type="button" onclick="document.getElementById('contacter').style.display='block'" value="Nous contacter">

    <p id="contacter" style="display:none">

        BdA@example.net

<p>
    <a href= 'index.php'  > Menu </a>
</p>
<?php
pied();
?>