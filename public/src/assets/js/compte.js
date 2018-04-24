var newPostActive = false;
var newUsernameActive = false;
var newMdpActive = false;
var newEmailActive = false;

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

    //TODO: envoyer la requête pour poster !
    div.innerHTML = "";
    newPost_onBlur();
}


