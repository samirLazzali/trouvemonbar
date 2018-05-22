document.getElementById("connexionform").addEventListener("submit", function (e) {
    //Comptage du nombre d'erreurs au moment de l'envoie du formulaire
    errorCount = 0;

    // Test courriel Regex
    var regexCourriel = /.+@.+\..+/;
    if (!regexCourriel.test(document.getElementById("email").value) || document.getElementById("email").value === "" ) {
        document.getElementById("emailtext").textContent = "E-mail non valide, réessayez :";
        document.getElementById("emailtext").style.color = "red";
        errorCount ++;
    }
    else{
        document.getElementById("emailtext").textContent = "E-mail :";
        document.getElementById("emailtext").style.color = "black";
    }

    if (document.getElementById("mdp").value === ""){
        document.getElementById("mdptext").textContent = "Veuillez saisir le mot de passe :";
        document.getElementById("mdptext").style.color = "red";
        errorCount ++;
    }
    else{
        document.getElementById("mdptext").textContent = "Mot de Passe :";
        document.getElementById("mdptext").style.color = "black";
    }

    // Annulation de l'envoie si il y a une erreur ou plus
    if (errorCount > 0){
        e.preventDefault();
        document.getElementById("mdp").value = "";
    }
});