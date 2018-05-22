
let tigre = 1 ;
let dragon = 1 ;
let tortue = 1 ;
let phenix = 1 ;

function focusFunctionPerso()
{
    document.getElementById("aidePerso").textContent="Entrez ici le nom de votre personnage";

}

function blurFunctionPerso(val)
{
    if (val.length < 2){
	document.getElementById("aidePerso").textContent="Nom de personnage trop court";
	document.getElementById("aidePerso").style.color = "red";
	return false;
    }
    else {
	document.getElementById("aidePerso").textContent=" ";
	return true;
    }
}

function focusFunctionUser()
{
    document.getElementById("aideUser").textContent="Entrez ici le nom d'utilisateur";
    
}

function blurFunctionUser(val)
{
    if (val.length < 2){
	document.getElementById("aideUser").textContent="Nom d'utilisateur trop court";
	document.getElementById("aideUser").style.color = "red";
	return false;
    }
    else {
	document.getElementById("aideUser").textContent=" ";
	return true;
    }
}

function focusFunctionMdp()
{
    document.getElementById("aideMdp").textContent="Entrez ici votre mot de passe";

}

function blurFunctionMdp(val)
{
    if (val.length < 4){
	document.getElementById("aideMdp").textContent="Longueur du mot de passe : faible";
	document.getElementById("aideMdp").style.color = "red";

    }
    else if (val.length > 4 && val.length <9){
	document.getElementById("aideMdp").textContent="Longueur du mot de passe : moyenne";
	document.getElementById("aideMdp").style.color = "orange";

    }
    else {
	document.getElementById("aideMdp").textContent="Longueur du mot de passe : élevée ";
	document.getElementById("aideMdp").style.color = "lightgreen";
    }
    return true;
}

function verification(f)
{
    if (blurFunctionPerso(f.personame.value) && blurFunctionUser(f.username.value) && blurFunctionMdp){
	return true;
    }
    else{
	alert("Veuillez remplir correctement le formulaire. ");
	return false;
    }
}






function maxa(a, b) {
    if (a > b) {
	return a ;
    } else {
	return b ;
    }
}


function alerte_salut() {
    alert("salut") ;
}


function update_result_alienor() {
    let x = 0 ;
    let max = maxa(phenix, maxa(tortue, maxa(dragon, tigre))) ;
    if (max === phenix) {
	x = 1 ;
    }
    else if (max === tortue) {
	x = 2 ;
    }
    else if (max === tigre) {
	x = 3 ;
    }
    else {
	x = 4 ;
    }

    document.getElementById("result").value = x ;
}



function ajout1moins() {
    tigre=tigre+1 ;
    dragon=dragon+1 ;
    phenix=phenix-1 ;
    tortue=tortue-1 ;
    update_result_alienor() ;
}



function ajout1plus()
{
    tigre=tigre-1 ;
    dragon=dragon-1 ;
    phenix=phenix+1 ;
    tortue=tortue+1 ;
    update_result_alienor() ;
}



function ajout2moins()
{
    tigre=tigre+1 ;
    dragon=dragon-1 ;
    phenix=phenix+1 ;
    tortue=tortue-1 ;
    update_result_alienor() ;
}


function ajout2plus()
{
    tigre=tigre-1 ;
    dragon=dragon+1 ;
    phenix=phenix-1 ;
    tortue=tortue+1 ;
    update_result_alienor() ;
}


function ajout3moins() {
    tigre=tigre-1 ;
    dragon=dragon+1 ;
    phenix=phenix+1 ;
    tortue=tortue-1 ;
    update_result_alienor() ;
}

function ajout3plus()
{
    tigre=tigre+1 ;
    dragon=dragon-1 ;
    phenix=phenix-1 ;
    tortue=tortue+1 ;
    update_result_alienor() ;
}




function grey_out(id)
{
    let buttons = document.getElementsByName(id);
    buttons[0].disabled = true;
    buttons[1].disabled = true;
}






