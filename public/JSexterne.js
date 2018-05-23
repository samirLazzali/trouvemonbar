function validateForm() {
    var x = document.forms["myForm"]["titre"].value;
    if (x == "") {
        alert("Votre annonce doit comporter un titre");
        return false;
    }
    var x1 = document.forms["myForm"]["description"].value;
    if (x1 == "") {
        alert("Veuillez décrire votre annonce");
        return false;
    }
    var x2 = document.forms["myForm"]["email"].value;
    if (x2 == "") {
        alert("Veuillez ajoutez votre adresse mail");
        return false;
    }
}

function afficher(idDiv) {
    var div = document.getElementById(idDiv);
    div.style.display = "block";
}

function cacher(idDiv) {
    var div = document.getElementById(idDiv);
    div.style.display = "none";
}
