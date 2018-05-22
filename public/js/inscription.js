document.getElementById("forminscription").addEventListener("submit", function (e) {
    //Comptage du nombre d'erreurs au moment de l'envoie du formulaire
    errorCount = 0;

    // Test courriel Regex
    var regexCourriel = /.+@.+\..+/;
    if (!regexCourriel.test(document.getElementById("email").value) || document.getElementById("email").value === "" ) {
        document.getElementById("mail_regex_error").textContent = "Adresse e-mail invalide.";
        errorCount ++;
    }
    else{
        document.getElementById("mail_regex_error").textContent = "";
    }

    // Test date regex
    var regexDate = /^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/;
    if (!regexDate.test(document.getElementById("date").value) || document.getElementById("date").value ==''){
        document.getElementById("date_regex_error").textContent = "Date invalide (JJ/MM/AAAA)";
        errorCount ++;
    }
    else{
        document.getElementById("date_regex_error").textContent = "";
    }

    //Test verification courriel
    if (document.getElementById("email").value !== document.getElementById("confirmationemail").value){
        document.getElementById("mail_confirmation_error").textContent = "Les deux adresses e-mail ne sont pas identiques.";
        errorCount ++;
    }
    else{
        document.getElementById("mail_confirmation_error").textContent = "";
    }

    //Test pseudo
    var pseudo = document.getElementById("pseudo").value
    if (pseudo === ""){
        document.getElementById("pseudo_format_error").textContent = "Veuillez indiquer un pseudo.";
        errorCount ++;
    }
    else if (pseudo.length > 30){
        document.getElementById("pseudo_format_error").textContent = "Pseudo trop long";
        errorCount ++;
    }
    else{
        document.getElementById("pseudo_format_error").textContent = "";
    }

    //Test nom
    if (document.getElementById('nom').value === ""){
        document.getElementById("nom_format_error").textContent = "Veuillez indiquer un nom.";
        errorCount ++;
    }
    else{
        document.getElementById("nom_format_error").textContent = "";
    }

    //Test mdp
    if (document.getElementById("mdp").value !== document.getElementById("confirmationmdp").value || document.getElementById("mdp").value === ""){
        document.getElementById("mdp_confirmation_error").textContent = "Les deux mots de passe ne sont pas identiques ou sont vides";
        errorCount ++;
    }
    else{
        document.getElementById("mdp_confirmation_error").textContent = "";
    }
    


    // Annulation de l'envoie si il y a une erreur ou plus
    if (errorCount > 0){
        e.preventDefault();
        document.getElementById("mdp").value = "";
        document.getElementById("confirmationmdp").value= "";

    }


});