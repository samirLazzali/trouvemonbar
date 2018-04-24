var STATUS_OK = 200;
var STATUS_ERROR = 400;
var ERROR_NotFound = 404;
var ERROR_EmailRegistered = 460;
var ERROR_UsernameRegistered = 461;
var ERROR_PasswordWeak = 462;
var ERROR_FieldMissing = 463;
var ERROR_WrongPassword = 464;
var ERROR_Permissions = 465;
var ERROR_InvalidType = 466;

function validate_input_signup() {
    var fUsername = document.getElementById("field-username");
    var fPassword = document.getElementById("field-password");
    var fEmail = document.getElementById("field-email");

    var infoboxMissingField = document.getElementById("info-missing-field");
    var infoboxEmail = document.getElementById("info-email-registered");
    var infoboxUsername = document.getElementById("info-username-registered");
    var infoboxPassword = document.getElementById("info-password-weak");

    infoboxMissingField.style.display = "none";
    infoboxEmail.style.display = "none";
    infoboxUsername.style.display = "none";
    infoboxPassword.style.display = "none";

    if (fEmail.value == "")
    {
        infoboxMissingField.innerHTML = "Vous devez fournir votre adresse e-mail.";
        infoboxMissingField.style.display = "block";
        return false;
    }
    else if (fUsername.value == "")
    {
        infoboxMissingField.innerHTML = "Vous devez choisir un nom d'utilisateur.";
        infoboxMissingField.style.display = "block";
        return false;
    }
    else if (fPassword.value == "") {
        infoboxMissingField.innerHTML = "Vous devez choisir un mot de passe.";
        infoboxMissingField.style.display = "block";
        return false;
    }


    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200)
        {
            var result = JSON.parse(xhttp.responseText);
            if (result["status"] == STATUS_OK)
            {
                document.location.href = "login";
            }
            else
            {
                switch(result["status"])
                {
                    case (ERROR_EmailRegistered):
                        infoboxEmail.style.display = "block";
                        return false;
                    case (ERROR_UsernameRegistered):
                        infoboxUsername.style.display = "block";
                        return false;
                    case (ERROR_PasswordWeak):
                        infoboxPassword.style.display = "block";
                        return false;
                    default:
                        infoboxMissingField.innerHTML("Une erreur s'est produite : " + result["description"] + " (Code " + result["status"] + ")");
                        return false;
                }
            }
        }
    };
    xhttp.open("POST", "/api/user/new.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("username=" + fUsername.value + "&password=" + fPassword.value + "&email=" + fEmail.value);
    return false;
}

function login()
{
    var fieldUsername = document.getElementById("field-username");
    var fieldPassword = document.getElementById("field-password");

    var username = fieldUsername.value.trim();
    var password = fieldPassword.value.trim();

    var infobox = document.getElementById("infobox");
    infobox.style.display = "none";

    if (username == "")
    {
        infobox.innerHTML = "Vous devez entrer un nom d'utilisateur.";
        infobox.style.display = "block";
        return false;
    }
    else if (password == "")
    {
        infobox.innerHTML = "Vous devez entrer votre mot de passe.";
        infobox.style.display = "block";
        return false;
    }
    else
    {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200)
            {
                var result = JSON.parse(xhttp.responseText);
                if (result["status"] == STATUS_OK)
                    document.location.href = "/main";
                else
                {
                    console.log("Erreur de connexion.")
                    infobox.style.display = "block";
                    switch(result["status"])
                    {
                        case (ERROR_WrongPassword):
                            infobox.innerHTML = "Le mot de passe entré est incorrect.";
                            return false;
                        case (ERROR_NotFound):
                            infobox.innerHTML = "Aucun utilisateur trouvé avec ces informations.";
                            return false;
                        default:
                            infobox.innerHTML("Une erreur s'est produite : " + result["description"] + " (Code " + result["status"] + ")");
                            return false;
                    }
                }
            }
            else
                console.log("Mauvais statut '" + status);
        };
        xhttp.open("POST", "/api/user/login.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("identifier=" + username + "&password=" + password);
        return false;
    }
}