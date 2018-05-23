
function overdraw(champ, bool)
{
   if(bool)
      champ.style.backgroundColor = "#EF7354";
   else
      champ.style.backgroundColor = "";
}
 
function checkMDP(champ)
{
   if(champ.value != document.getElementById('pwd').value || champ.value.length<5)
   {
      overdraw(champ, true);
      return false;
   }
   else
   {
      overdraw(champ, false);
      return true;
   }
}

function checkPseudo(champ){
   if(champ.value.length < 2)
   {
      overdraw(champ, true);
      return false;
   }
   else
   {
      overdraw(champ, false);
      return true;
   }
}

function checkPrenom(champ){
   if(champ.value.length < 2)
   {
      overdraw(champ, true);
      return false;
   }
   else
   {
      overdraw(champ, false);
      return true;
   }
}

function checkNom(champ){
if(champ.value.length < 1)
   {
      overdraw(champ, true);
      return false;
   }
   else
   {
      overdraw(champ, false);
      return true;
   }	
}

function checkForm(formulaire)
{
   var pseudoOk = checkPseudo(formulaire.pseudo);
   var nomOk = checkNom(formulaire.nom);
   var prenomOk = checkPrenom(formulaire.prenom);
   var mdpOk=checkMDP(formulaire.pwd2);
   
   if(pseudoOk && prenomOk && nomOk && mdpOk)
      return true;
   else
   {
      alert("Veuillez remplir correctement tous les champs");
      return false;
   }
}