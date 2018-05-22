<?php

/* Ce fichier affiche la page d'inscription, avec ses trois champs textes, son champ à choix multiples et son questionnaire de guilde.*/

include("pageAccueil.php");


enTete("Inscription");

fin_enTete();



inscription();

formulaireGuilde(); 

pied();



 

/* Affiche les trois champs textes ainsi que le champ à choix multiples.*/
function inscription(){
    echo "<script src='inscription.js'>  </script>";
    echo '<form action="inscrit.php" method="post" onsubmit="return verification(this)" name="formulaire_inscription"/> ';
    echo '     <p> Nom Personnage : <input type="text" size="25" maxlength="18"  name="personame" onfocus="focusFunctionPerso()" onblur="blurFunctionPerso(this.value)" id="perso" /> <span id="aidePerso"> </span>  </p>';
    echo '     <p> Nom Utilisateur :<input type="text" size="25" maxlength="18" name="username" onfocus="focusFunctionUser()" onblur="blurFunctionUser(this.value)" id="user" " /> <span id="aideUser"> </span> </p>';
    echo '     <p> Mot de passe :<input type="password" size="25" maxlength="18" name="password" onfocus="focusFunctionMdp()" onblur="blurFunctionMdp(this.value)" id="mdp" " /> <span id="aideMdp"> </span> </p>';
    echo '<p>Arme : <select name="arme" class="onglets" >' ;
    echo '<option value="epee"> Epée </option>' ;
    echo '<option value="baton"> Baton de magie </option>' ;
    echo '</select></p>' ;
    

}



/* Le questionnaire ainsi qu'un champ caché result, mis à jour à chaque réponse grâce au javascript, permettant de récuperer le resultat par la methode post.*/
function formulaireGuilde()
{
echo '
</br> <p> Quelle est votre guilde ? Faites-le test !</p> </br>


' ;

print "
<input type='hidden' name='result' id='result' value='0' />

<div class='question' >
<fieldset>
<legend><p> Le groupe que vous dirigez vient de sauver une petite ville. Vous mettez cette réussite sur le compte de:</p> </legend>
<button type='button' name='reponse1'  onclick='ajout1moins();grey_out(this.name)' disable='false' id='r1' value='Votre capacité à mener vos hommes correctement' class='onglets' >Votre capacité à mener vos hommes correctement</button> </br> 
<button type='button' name='reponse1' onclick='ajout1plus();grey_out(this.name)' id='r2' value='Les compétences et la cohésion du groupe' class='onglets' />Les compétences et la cohésion du groupe</button>  </br>
</fieldset> </br> </br>
</div>


<div class='question' >
<fieldset>
<legend> <p>Un ami qui ne vous a jusque là jamais remboursé vous demande encore de l'argent. Vous avez pas mal de marge niveau argent : </p> </legend>
<input type='button' name='reponse2' onclick='ajout2moins();grey_out(this.name)'  value='Vous acceptez de lui prêter une dernière fois' class='onglets' /> </br>
<input type='button' name='reponse2' onclick='ajout2plus();grey_out(this.name)'  value='Vous refusez, il ne vous a jamais remboursé après tout' class='onglets' /> </br>
</fieldset> </br> </br>
</div>


<div class='question' >
<fieldset>
<legend>  <p> Préférez-vous avoir: </p> </legend>
<input type='button' name='reponse3' onclick='ajout3moins();grey_out(this.name)' value='Un travail stable de rémunération moyenne' class='onglets' />   </br> 
<input type='button' name='reponse3' onclick='ajout3plus();grey_out(this.name)'  value='Un travail instable mais très lucratif' class='onglets' /> </br>
</fieldset> </br> </br>
</div>


<div class='question' >
<fieldset>
<legend>  <p> D'un point de vue professionnel, vous préferez gérer un projet:  </p> </legend>
<input type='button' name='reponse4' onclick='ajout1moins();grey_out(this.name)' value='Au fur et à mesure' class='onglets' />  </br> 
<input type='button' name='reponse4' onclick='ajout1plus();grey_out(this.name)'  value='En planifiant tout à l&#39avance' class='onglets' /> </br>
</fieldset> </br> </br>
</div>



<div class='question' >
<fieldset>
<legend>  <p> On vous propose un projet pas particulièrement compliqué. Vous préférez:  </p> </legend>
<input type='button' name='reponse5' onclick='ajout2moins();grey_out(this.name)'  value='Le faire vous même' class='onglets' />  </br> 
<input type='button' name='reponse5' onclick='ajout2plus();grey_out(this.name)'  value='Le faire faire par quelqu&#39un d&#39autre' class='onglets' />  </br>
</fieldset> </br> </br>
</div>



<div classe='question' >
<fieldset>
<legend>  <p> Vous avez un examen à passer et vous êtes sûr de le réussir. Vous allez:  </p> </legend>
<input type='button' name='reponse6' onclick='ajout3moins();grey_out(this.name)'  value='Travailler encore plus pour réussir mieux que les autres' class='onglets' />  </br> 
<input type='button' name='reponse6' onclick='ajout3plus();grey_out(this.name)'  value='Aider ceux qui ont du mal pour que tout le monde ait ses chances' class='onglets' /> </br>
</fieldset> </br> </br>
</div>



<div classe='question' >
<fieldset>
<legend>  <p> Vous souhaitez présenter votre dernière réalisation (artistique, scientifique technologique, etc.) en public. Choisissez-vous:  </p> </legend>
<input type='button' name='reponse7' onclick='ajout1plus();grey_out(this.name)'  value='Un petit comité d&#39experts' class='onglets' />  </br> 
<input type='button' name='reponse7' onclick='ajout1moins();grey_out(this.name)'  value='Un très large public mais peu concerné' class='onglets' /> </br>
</fieldset> </br> </br>
</div>




<div classe='question' >
<fieldset>
<legend>  <p> Vous louez un logement à une famille dont le père a disparu depuis quelques semaines. Ils ont du mal à payer et demandent un peu plus de temps. </p> </legend>
<input type='button' name='reponse8' onclick='ajout2plus();grey_out(this.name)'  value='Vous exigez le payement' class='onglets' />   </br> 
<input type='button' name='reponse8' onclick='ajout2moins();grey_out(this.name)'  value='Vous leur laissez un peu de temps' class='onglets' /> </br>
</fieldset> </br> </br>


<div classe='question' >
<fieldset>
<legend>  <p> Vous préférez vous entourer:  </p> </legend>
<input type='button' name='reponse9' onclick='ajout3moins();grey_out(this.name)' value='D&#39un petit groupe d&#39amis fiables à 100%' class='onglets' />  </br> 
<input type='button' name='reponse9' onclick='ajout3plus();grey_out(this.name)' value='D&#39un grand groupe d&#39amis incertains' class='onglets' /> </br>
</fieldset> </br> </br>
</div>


<div classe='question' >
<fieldset>
<legend>  <p> La vengeance, vous l'aimez:  </p> </legend>
<input type='button' name='reponse10' onclick='ajout1plus();grey_out(this.name)'  value='froide' class='onglets' /> </br> 
<input type='button' name='reponse10' onclick='ajout1moins();grey_out(this.name)'  value='chaude' class='onglets' /> </br>
</fieldset> </br> </br>
</div>


<div classe='question' >
<fieldset>
<legend>  <p> De manière générale, vous préférez lorsque vous pouvez:  </p> </legend>
<input type='button' name='reponse11' onclick='ajout2moins();grey_out(this.name)'  value='Aider les autres' class='onglets' /> </br> 
<input type='button' name='reponse11' onclick='ajout2plus();grey_out(this.name)' value='Vous faire aider'  class='onglets' /> </br>
</fieldset> </br> </br>
</div>


<div classe='question' >
<fieldset>
<legend>  <p> Un de vos concurrents directs est en difficulté et vous pouvez l'aider:  </p> </legend>
<input type='button' name='reponse12' onclick='ajout3moins();grey_out(this.name)' value='Tant pis pour la concurrence, vous l&#39aidez' class='onglets' />  </br> 
<input type='button' name='reponse12' onclick='ajout3plus();grey_out(this.name)'  value='Vous ne l&#39aidez pas, cela vous fera moins de concurrence' class='onglets' />  </br>
</fieldset> </br> </br>
</div>




<p> <input type='submit' value='Confirmer' name='inscription' class='onglets' /></p>
</form>


<p> <a href='index.php'><input type='button' name='Retour Accueil' value='Retour Accueil' class='onglets'/></a></p>

" ;

}








?>