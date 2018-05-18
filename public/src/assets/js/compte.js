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

var newPostActive = false;

function newPost_onFocus()
{
    var div = document.getElementById("new-post-content");
    addClass(div, "post-content-active");
    removeClass(div, "field-validated");

    if(!newPostActive)
        div.innerHTML = "";
}

function newPost_onBlur()
{
    var div = document.getElementById("new-post-content");
    removeClass(div, "post-content-active");

    div.innerHTML = div.innerHTML.trim();
    newPostActive = div.innerHTML != "";
    if(!newPostActive)
        div.innerHTML = "Nouvelle publication...";
}

function sendNewPost()
{
    var div = document.getElementById("new-post-content");

    if(!newPostActive)
        return;

    if (div.innerHTML.trim() == "")
    {
        console.log("Not sending empty post.");
        return;
    }

    account_createPost(div.innerHTML, null);

    div.innerHTML = "";
    newPost_onBlur();
}

function account_createPost(value, user_Response)
{
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.status == 200 && this.readyState == 4)
        {
            var result = JSON.parse(xhttp.responseText);
            if (result["status"] == STATUS_OK)
            {
                var div = document.getElementById("new-post-content");
                addClass(div, "field-validated");
                setTimeout(function() {
                    removeClass(div, "field-validated");
                }, 1500);
            }
            else
            {
                console.log("Can't post.");
            }
        }
    }
    xhttp.open("POST", "/api/post/new", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    if(user_Response == null){
        xhttp.send("content=" + value);
    }
    else {
        xhttp.send("content=" + value + "&ResponseTo=" + user_Response);
    }
}

function accountFields_color() {
    var nmail = document.getElementById("new-email");
    var nusername = document.getElementById("new-username");

    removeClass(nmail, "field-validated");
    removeClass(nusername, "field-validated");
    removeClass(nmail, "invalid-field");
    removeClass(nusername, "invalid-field");
}

function passwordFields_color() {
    var fieldCurrent = document.getElementById("current-password");
    var fieldNew = document.getElementById("new-password");

    removeClass(fieldCurrent, "field-validated");
    removeClass(fieldNew, "field-validated");
    removeClass(fieldCurrent, "invalid-field");
    removeClass(fieldNew, "invalid-field");
}


function updatePassword() {
    var fieldCurrentPassword = document.getElementById("current-password");
    var fieldNewPassword = document.getElementById("new-password");

    fieldCurrentPassword.blur();
    fieldNewPassword.blur();

    if (fieldCurrentPassword.value == "")
    {
        addClass(fieldCurrentPassword, "invalid-field");
        fieldCurrentPassword.focus();
        return false;
    }

    if (fieldNewPassword.value == "")
    {
        addClass(fieldNewPassword, "invalid-field");
        fieldNewPassword.focus();
        return false;
    }

    var infoboxPassword = document.getElementById("info-password");
    infoboxPassword.style.display = "none";

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200)
        {
            passwordFields_color();
            var result = JSON.parse(xhttp.responseText);
            if (result["status"] == STATUS_OK)
            {
                addClass(fieldCurrentPassword, "field-validated");
                addClass(fieldNewPassword, "field-validated");
                fieldNewPassword.value = "";
                return false;
            }
            else
            {
                switch(result["status"]) {
                    case ERROR_FieldMissing:
                        infoboxPassword.style.display = "block";
                        infoboxPassword.innerHTML = "Vous avez oublié de remplir un champ.";
                        return false;
                    case ERROR_WrongPassword:
                        infoboxPassword.style.display = "block";
                        infoboxPassword.innerHTML = "Le mot de passe actuel est incorrect.";
                        fieldCurrentPassword.focus();
                        fieldCurrentPassword.select();
                        return false;
                    default:
                        infoboxPassword.style.display = "block";
                        infoboxPassword.innerHTML = "Une erreur s'est produite : " + result["description"] + " (Code " + result["status"] + ")";
                        return false;
                }
            }
        }
    }
    xhttp.open("POST", "/api/user/editpassword");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("newpassword=" + fieldNewPassword.value + "&password=" + fieldCurrentPassword.value);
    return false;
}

function updateAccount()
{
    var fieldEmail = document.getElementById("new-email");
    var fieldUsername = document.getElementById("new-username");

    fieldEmail.blur();
    fieldUsername.blur();

    if (fieldEmail.value == "")
    {
        addClass(fieldEmail, "invalid-field");
        fieldEmail.focus();
        return false;
    }

    if (fieldUsername.value == "") {
        addClass(fieldUsername, "invalid-field");
        fieldUsername.focus();
        return false;
    }



    var infoboxMissingField = document.getElementById("info-missing-field");

    infoboxMissingField.style.display = "none";

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200)
        {
            accountFields_color();
            console.log(xhttp.responseText);
            var result = JSON.parse(xhttp.responseText);
            if (result["status"] == STATUS_OK)
            {
                addClass(fieldUsername, "field-validated");
                addClass(fieldEmail, "field-validated");
            }
            else
            {
                switch(result["status"])
                {
                    case (ERROR_FieldMissing):
                        infoboxMissingField.style.display = "block";
                        return false;
                    case ERROR_UsernameRegistered:
                        infoboxMissingField.style.display = "block";
                        infoboxMissingField.innerHTML = "Ce nom d'utilisateur est déjà utilisé !";
                        addClass(fieldUsername, "invalid-field");
                        fieldUsername.focus();
                        return false;
                    case ERROR_EmailRegistered:
                        infoboxMissingField.style.display = "block";
                        infoboxMissingField.innerHTML = "Cet e-mail est déjà enregistré !";
                        addClass(fieldEmail, "invalid-field");
                        fieldEmail.focus();
                        return false;
                    default:
                        infoboxMissingField.style.display = "block";
                        infoboxMissingField.innerHTML = "Une erreur s'est produite : " + result["description"] + " (Code " + result["status"] + ")";
                        return false;
                }
            }
        }
    };
    xhttp.open("POST", "/api/user/edit", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("username=" + fieldUsername.value + "&email=" + fieldEmail.value);
    return false;

}