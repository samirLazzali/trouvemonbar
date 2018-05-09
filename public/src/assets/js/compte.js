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

    if(!newPostActive)
        div.innerHTML = "";
}

function newPost_onBlur()
{
    var div = document.getElementById("new-post-content");
    div.innerHTML = div.innerHTML.trim();
    newPostActive = div.innerHTML != "";
    if(!newPostActive)
        div.innerHTML = "Nouvelle publication...";
}

function sendNewPost()
{
    var div = document.getElementById("new-post-content");

    if (div.innerHTML.trim() == "")
        return;

    CreatePost(div.innerHTML, null);

    div.innerHTML = "";
    newPost_onBlur();
}

function CreatePost(value, user_Response)
{
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "/api/post/new", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    if(user_Response == null){
        xhttp.send("content="+value);
    }
    else {
        xhttp.send("content=" + value + "&ResponseTo=" + user_Response);
    }
}


function Change_info()
{
    var nmail = document.getElementById("new-email");
    var npwd = document.getElementById("new-password");
    var nusername = document.getElementById("new-username");

    var mfieldpwd = document.getElementById("info-empty-pwd");
    var infoboxMissingField = document.getElementById("info-missing-field");

    mfieldpwd.style.display = "none";
    infoboxMissingField.style.display = "none";

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
                    case (ERROR_FieldMissing):
                        mfieldpwd.style.display = "block";
                        return false;
                    case (ERROR_WrongPassword):
                        // La je sais pas quoi mettre, parce que si le mot de passe d'origine est pas bon, l'utilisateur est pas censé
                        //être déja connecté sur cette page
                        return false;
                    default:
                        infoboxMissingField.innerHTML("Une erreur s'est produite : " + result["description"] + " (Code " + result["status"] + ")");
                        return false;
                }
            }
        }
    };
    xhttp.open("POST", "/api/user/edit", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("username=" + nusername.value + "&password=" + npwd.value + "&email=" + nmail.value);
    return false;

}