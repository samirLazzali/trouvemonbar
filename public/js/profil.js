document.getElementById("formprofil").addEventListener("submit", function (e) {
    //Comptage du nombre d'erreurs au moment de l'envoie du formulaire
    errorCount = 0;

    // Test courriel Regex
    var regexCourriel = /.+@.+\..+/;
    if (!regexCourriel.test(document.getElementById("mail_bdd").value) || document.getElementById("mail_bdd").value === "" ) {
        document.getElementById("mailtext").textContent = "E-mail : Adresse e-mail invalide.";
        document.getElementById("mailtext").style.color = "red";
        errorCount ++;
    }
    else{
        document.getElementById("mailtext").textContent = "E-mail :";
        document.getElementById("mailtext").style.color = "black";
    }

    // Test date
    var regexDate = /^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/;
    if (!regexDate.test(document.getElementById("naissance_bdd").value) || document.getElementById("naissance_bdd").value ==''){
        document.getElementById("naissancetext").textContent = "Date invalide (JJ/MM/AAAA)";
        document.getElementById("naissancetext").style.color = "red";
        errorCount ++;
    }
    else{
        document.getElementById("naissancetext").textContent = "";
        document.getElementById("naissancetext").style.color = "black";
    }

    // Annulation de l'envoie si il y a une erreur ou plus
    if (errorCount > 0){
        e.preventDefault();
    }


});